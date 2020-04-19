<?php
/*
 * Plugin Name: Main Navigation Widget
 * Plugin URI: http://www.ishyoboy.com
 * Description: A widget that displays the main navigation
 * Version: 1.0
 * Author: IshYoBoy
 * Author URI: http://www.ishyoboy.com
 */
class Ishyoboy_Main_Navigation_Widget extends WP_Widget {

	public $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ishyoboy-main-navigation-widget', // Base ID
			'Ishyo Main Navigation', // Name
			array(
				'description' => __( 'A widget that displays the main navigation. Mainly to be used in Sidenav Sidebar.', 'ishyoboy_assets' ),
				'widget_icon' => 'ish-icon-menu',
			)
		);

		// Default widget settings.
		$this->defaults = array(
			'title' => '',
			'widget_icon' => 'ish-icon-menu',
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget($args, $instance) {
		extract( $args );

		// Set default values if they don't exist
		if ( empty($instance) ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );
		}

		// Get menu
		$main_menu = ( function_exists( 'ishfreelotheme_get_mainnav_menu') ) ? ishfreelotheme_get_mainnav_menu() : '';

		// Get menu type class
		$nav_type_class = ( function_exists( 'ishfreelotheme_get_mainnav_type_class') ) ? ishfreelotheme_get_mainnav_type_class() : '';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo '' . $before_widget;


		if ( ! empty( $title ) ) {
			echo '' . $before_title . $title . $after_title;
		}

		if ( '' != $main_menu ) {
			wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu' => $main_menu, 'container' => '', 'menu_class' => 'ish-ph-mn-main_nav ish-widget-main_nav' . ' ' . $nav_type_class, 'fallback_cb' => 'ishfreelotheme_empty_menu_fallback' ) );
		}else{
			wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'menu_class' => 'ish-ph-mn-main_nav ish-widget-main_nav' . ' ' . $nav_type_class, 'fallback_cb' => 'ishfreelotheme_empty_menu_fallback' ) );
		}

		echo '' . $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		//$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		?>
		<p>
			<label for="<?php echo '' . $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo '' . $this->get_field_id('title'); ?>" name="<?php echo '' . $this->get_field_name('title'); ?>" value="<?php echo '' . $title; ?>" />
		</p>
		<?php

		echo '<p>'. sprintf( __('Make sure a menu has been set to be displayed in the <a href="%s">Main Menu</a> location.', 'ishyoboy_assets'), admin_url('nav-menus.php?action=locations') ) .'</p>';


	}

}

function freelo_register_widget_main_navigation() {
	register_widget( "Ishyoboy_Main_Navigation_Widget" );
}

add_action( 'widgets_init', 'freelo_register_widget_main_navigation' );