<?php
/**
 * Meta box generator for WordPress
 * Compatible with custom post types
 *
 * Support input types: text, textarea, checkbox, select, radio
 *
 */

if ( ! class_exists( 'IshYoMetaBox' ) ) {
	class IshYoMetaBox {

		protected $meta_box;

		protected $id;
		static $prefix = '_ishmb_';

		// create meta box based on given data

		public function __construct($id, $opts) {
			if ( !is_admin() ) return;
			$this->meta_box = $opts;
			$this->id = $id;
			add_action( 'add_meta_boxes', array(&$this,
				'add'
			));
			add_action( 'save_post', array(&$this,
				'save'
			));
		}

		// Add meta box for multiple post types

		public function add() {
			foreach ($this->meta_box['pages'] as $bpage) {
				add_meta_box($this->id, $this->meta_box['title'], array(&$this,
					'show'
				) , $bpage, $this->meta_box['context'], $this->meta_box['priority']);
			}
		}

		// Callback function to show fields in meta box

		public function show($post) {

			// Use nonce for verification
			echo '<input type="hidden" name="' . $this->id . '_meta_box_nonce" value="', wp_create_nonce('ishyometabox' . $this->id) , '" />';

			if ('side' == $this->meta_box['context']){

				echo '<div>';
				foreach ($this->meta_box['fields'] as $field) {
					extract($field);

					if ( 'wp_editor' == $type){
						$wp_editor_id = str_replace('_', '', $id);
					}
					$id = self::$prefix . $id;

					$value = self::get($field['id']);
					if (empty($value) && !sizeof(self::get($field['id'], false))) {
						$value = isset($field['default']) ? $default : '';
					}
					echo '<div id="' . $id . '_boxitem">';
					echo '<p class="box_name">', '<strong>', $name, '</strong></p>';
					echo '<label class="screen-reader-text" for="', $id, '">', $name, '</label>';
					include( get_template_directory() . '/assets/framework/wp/posts/ishyo_meta_fields/' . $type . '.php' );
					if (isset($desc)) {

						if ( 'checkbox' != $type ) {
							echo '<br />';
						}

						echo '<p class="box_description">' . $desc . '</p>';
					}
					echo '</div>';
				}
				echo '</div>';

			}
			else{

				echo '<table class="form-table">';
				foreach ($this->meta_box['fields'] as $field) {
					extract($field);

					if ( 'wp_editor' == $type){
						$wp_editor_id = str_replace('_', '', $id);
					}
					$id = self::$prefix . $id;

					$value = self::get($field['id']);
					if (empty($value) && !sizeof(self::get($field['id'], false))) {
						$value = isset($field['default']) ? $default : '';
					}
					echo '<tr>', '<th style="width:20%"><label for="', $id, '">', $name, '</label></th>', '<td>';
					include( get_template_directory() . '/assets/framework/wp/posts/ishyo_meta_fields/' . $type . '.php' );
					if (isset($desc)) {

						if ( 'checkbox' != $type ) {
							echo '<br />';
						}

						echo '<span class="description">' . $desc . '</span>';
					}
					echo '</td></tr>';

				}
				echo '</table>';

			}

		}

		// Save data from meta box

		public function save($post_id) {

			// verify nonce
			if (!isset($_POST[$this->id . '_meta_box_nonce']) || !wp_verify_nonce($_POST[$this->id . '_meta_box_nonce'], 'ishyometabox' . $this->id)) {
				return $post_id;
			}

			// check autosave
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return $post_id;
			}

			// check permissions
			if ('post' == $_POST['post_type']) {
				if (!current_user_can('edit_post', $post_id)) {
					return $post_id;
				}
			} elseif (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
			foreach ($this->meta_box['fields'] as $field) {
				$name = self::$prefix . $field['id'];
				$sanitize_callback = (isset($field['sanitize_callback'])) ? $field['sanitize_callback'] : '';
				if (isset($_POST[$name]) || isset($_FILES[$name])) {
					$old = self::get($field['id'], true, $post_id);
					$new = $_POST[$name];
					if ($new != $old) {
						self::set($field['id'], $new, $post_id, $sanitize_callback);
					}
				} elseif ($field['type'] == 'checkbox') {
					self::set($field['id'], 'false', $post_id, $sanitize_callback);
				} else {
					self::delete($field['id'], $name);
				}
			}
		}
		static function get($name, $single = true, $post_id = null) {
			global $post;
			return get_post_meta(isset($post_id) ? $post_id : ( ( isset($post) && '' != $post) ? $post->ID : null ), self::$prefix . $name, $single);
		}
		static function set($name, $new, $post_id = null, $sanitize_callback = '') {
			global $post;

			$id = (isset($post_id)) ? $post_id : $post->ID;
			$meta_key = self::$prefix . $name;
			$new = ($sanitize_callback != '' && is_callable($sanitize_callback)) ? call_user_func($sanitize_callback, $new, $meta_key, $id) : $new;
			return update_post_meta($id, $meta_key, $new);
		}
		static function delete($name, $post_id = null) {
			global $post;
			return delete_post_meta(isset($post_id) ? $post_id : $post->ID, self::$prefix . $name);
		}
	};
}

if ( ! function_exists( 'add_ishyo_meta_box' ) ){
	function add_ishyo_meta_box($id, $opts) {
		new IshYoMetaBox($id, $opts);
	}
}