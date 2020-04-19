<?php

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Ishyoboy_Shortcodes' ) ) :

	//require_once( 'assets/backend/classes/class-ish-plugin-base.php' );

	class Ishyoboy_Shortcodes extends Ish_Plugin_Base {

		private $global_sc_atts = array();
		private $config;
		private $SC_TEMPLATES_DIR;
		private $SC_SETTINGS_DIR;
		private $icon_sets_folder_path;
		public $ishfreelotheme_shortcodes;
		private $cache;
		protected static $_instance = null;

		/**
		 * Main Plugin Instance
		 *
		 * Ensures only one instance of plugin is loaded or can be loaded.
		 *
		 * @static
		 * @return Main instance
		 */
		public static function instance( $plugin_file ) {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self( $plugin_file );
			}
			return self::$_instance;
		}

		public function __construct() {

			// Necessary to set all global plugin variables
			parent::__construct( __FILE__ );

			// Necessary for symlinks to work
			$this->SC_TEMPLATES_DIR = 'assets/backend/vc_extend/shortcodes_templates/';
			$this->SC_SETTINGS_DIR = 'assets/backend/vc_extend/vc_config/shortcodes/';

			// ICON SETS (SVG ICONS) PATH
			$this->icon_sets_folder_path = 'assets/frontend/images/icon-sets/';

			$this->config = Array(
				'global_shortcode_class' => 'ish-sc-element',

			);

			/**
			 * TEXT WIDGET SHORTCODE FILTERS
			 */
			global $wp_embed;
			add_filter( 'widget_text', 'do_shortcode', 10 );
			add_filter( 'widget_title', 'do_shortcode', 10 );
			add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
			add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );



			define( 'ISHFREELOTHEME_SC_PLUGIN_URI', $this->PLUGIN_PLUGIN_URI );

			// Actions
			add_action( 'init', array(&$this, 'action_init'), 10 );

			// Change of hook needed from  VC 4.9.2
			//add_action( 'admin_enqueue_scripts', array(&$this, 'action_admin_scripts_init') );
			add_action( 'admin_print_scripts', array(&$this, 'action_admin_scripts_init') );

			add_action( 'wp_enqueue_scripts', array(&$this, 'action_frontend_scripts') );
			add_action( 'ish_theme_options_after_woocommerce_options', array(&$this, 'add_theme_options_gmaps_options'), 11 );

			$this->global_sc_atts = array(
				//'global_atts' => '',
				'bottom_margin' => '',
				'id' => '',
				'css_class' => '',
				'style' => '',
				'tooltip' => '',
				'tooltip_color' => '',
				'tooltip_text_color' => '',
			);


		}

		/**
		 * Adds Theme Options page
		 *
		 * Adds Theme Options page to themes by IshYoBoy using the  "ish_theme_options_after_woocommerce_options" hook
		 *
		 * @return void
		 */
		function add_theme_options_gmaps_options(){

			global $of_options;

			do_action( 'ish_theme_options_before_misc_options' );

			/* *************************************************************************************************************
			 * 8. Google Maps Options
			 */
			$of_options[] = array(
				'name'  => __( 'GMaps Options', 'ishyoboy_assets' ),
				'class' => 'gmaps-options',
				'type'  => 'heading'
			);


			// MAPS API KEY ******************************************************************************************
			$of_options[] = array(  'name' => __( 'Google Maps API Key', 'ishyoboy_assets' ),
			                        'desc' => '', //__( '', 'ishyoboy_assets' ),
			                        'id' => 'gmaps_info',
			                        'std' => '',
			                        'type' => 'gmaps-info');

			$of_options[] = array(  'name' => '', //__( '', 'ishyoboy_assets' ),
			                        'desc' => __( 'API key', 'ishyoboy_assets' ),
			                        'id' => 'google_maps_api_key',
			                        'std' => '',
			                        'type' => 'text');


			do_action( 'ish_theme_options_after_misc_options' );

		}

		/**
		 * Registers Frontend Scripts
		 *
		 * @return	void
		 */
		public function action_frontend_scripts() {

			global $ishfreelotheme_options;

			// JS - Global necessary to all shortcodes
			wp_enqueue_script('ishfreelotheme-shortcodes', ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/frontend/js/ishyoboy-shortcodes.js' , array('jquery'), '1.0', true);

			if ( ! $this->pagebuilder_active() ){
				wp_register_style( 'ishfreelotheme-fontello', ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/frontend/css/ish-fontello.css');
				wp_enqueue_style( 'ishfreelotheme-fontello' );
			}


			$user_font = $this->get_user_fontello_font();
			if ( ! empty( $user_font ) && isset( $user_font['json']->name ) ){
				if ( empty( $user_font['json']->name ) ) {$user_font['json']->name = 'fontello'; }
				wp_register_style( 'ishfreelotheme-user-fontello', $user_font['uri'] . 'fontello/css/' . $user_font['json']->name . '.css' );
				wp_enqueue_style( 'ishfreelotheme-user-fontello' );
			}

			// JS - Will be enqued inside each shortcode when used
			wp_register_script( 'ishfreelotheme-flexslider', ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/frontend/js/jquery.flexslider-min.js', array('jquery'), false, true );
			wp_register_script( 'ishfreelotheme-owl-slider', ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/frontend/js/owl.carousel.min.js', array('jquery'), false, true );

			if ( isset($ishfreelotheme_options) && isset($ishfreelotheme_options['google_maps_api_key']) && '' !== $ishfreelotheme_options['google_maps_api_key'] ) {
				wp_register_script( 'ishfreelotheme-gmaps', '//maps.googleapis.com/maps/api/js?v=3.exp&key=' . esc_attr($ishfreelotheme_options['google_maps_api_key']) . '&callback=initialize', array( 'jquery' ), false, true );
			} else {
				wp_register_script( 'ishfreelotheme-gmaps', '//maps.googleapis.com/maps/api/js?v=3.exp&callback=initialize', array( 'jquery' ), false, true );
			}

			// CSS
			wp_enqueue_style( 'ishfreelotheme-fe-shortcodes', ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/frontend/css/shortcodes.css', false, '1.0', 'all' );
		}

		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return	void
		 */
		public function action_admin_scripts_init() {

			// css - Adds styles to the DropDown Menu of the buttons
			wp_enqueue_style( 'ishfreelotheme-admin-shortcodes', ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/backend/css/admin-shortcodes.css', false, '1.0', 'all' );

			if ( ! $this->pagebuilder_active() ){
				wp_register_style( 'ishfreelotheme-fontello', ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/frontend/css/ish-fontello.css');
				wp_enqueue_style( 'ishfreelotheme-fontello' );
			}

			$user_font = $this->get_user_fontello_font();
			if ( ! empty( $user_font ) && isset( $user_font['json']->name ) ){
				if ( empty( $user_font['json']->name ) ) {$user_font['json']->name = 'fontello'; }
				wp_register_style( 'ishfreelotheme-user-fontello', $user_font['uri'] . 'fontello/css/' . $user_font['json']->name . '.css' );
				wp_enqueue_style( 'ishfreelotheme-user-fontello' );
			}

			// js
			wp_localize_script( 'jquery', 'ishfreelotheme_shortcodes', array('plugin_folder' => ISHFREELOTHEME_SC_PLUGIN_URI) );

			$this->vc_theme_colors_css();

			wp_register_script( 'ishfreelotheme-custom-views', ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/backend/js/composer-views-extend.js', array('vc-backend-min-js'), false, true );
			wp_enqueue_script('ishfreelotheme-custom-views');

			wp_localize_script( 'ishfreelotheme-custom-views', 'iyb_pagebuilder', Array(
				'main_button_title' => __( 'Switch to Page Builder', 'ishyoboy_assets' ),
				'main_button_title_revert' => __( 'Switch to WordPress Editor', 'ishyoboy_assets' ),
				'path_child' => get_stylesheet_directory_uri() . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path,
				'path_parent' => get_template_directory_uri() . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path,
				'path_plugin' => $this->PLUGIN_PLUGIN_URI . '/' . $this->icon_sets_folder_path,
				'trans_strings' => Array(
					'accordion' => __( 'Accordion', 'ishyoboy_assets' ),
					'toggle' => __( 'Toggle', 'ishyoboy_assets' ),
				)
			) );
		}

		/**
		 * Returns the shortcode HTML for the front-end
		 *
		 * @param array $atts - Shortcode attributes specified in the visual composer
		 * @param string $content - Shortcode content
		 * @param string $tag - Shortcode "tag" [tag]
		 *
		 * @return string
		 */
		public function shortcode_callback( $atts, $content = null, $tag ){

			global $ishfreelotheme_all_sc_count;

			do_action('ish_before_sc_callback', $atts, $content, $tag );

			$ishfreelotheme_all_sc_count += 1;

			// Added from VC 4.6.2
			$vc_atts = vc_map_get_attributes( $tag, $atts );
			if ( is_array($atts) ) {
				$atts = array_merge( $vc_atts, $atts );
			}
			else{
				$atts = $vc_atts;
			}

			$sc_filename = $tag . '.php';

			$output = '';

			$template = locate_template( $this->theme_locate_path . '/' . $this->SC_TEMPLATES_DIR . $sc_filename );

			if ( !$template ) {
				// LOOK IN PLUGIN
				$template = $this->PLUGIN_DIR_PATH . $this->SC_TEMPLATES_DIR . $sc_filename;
			}

			// LOAD TEMPLATE
			if ( file_exists($template) ) {
				ob_start();
				include( $template );
				$output = ob_get_contents();
				ob_end_clean();
			} else {
				trigger_error(sprintf( __( 'Wrong template for `%s` shortcode. Please make sure the template exists.', 'ishyoboy_assets' ), $tag) );
			}

			do_action('ish_after_sc_callback', $atts, $content, $tag );

			return $output;

		}

		/**
		 * Returns the contrast color for a given hex color value (e.g. #ffffff)
		 *
		 * @param string $hexcolor - The color in hex format "#ffffff"
		 * @return string
		 */
		public function get_color_contrast( $hexcolor ){

			if ( function_exists( 'ishfreelotheme_get_color_contrast' ) ) {
				// Theme function has a bigger priority
				return ishfreelotheme_get_color_contrast( $hexcolor );
			}
			else{
				// Remove the "#" from the beginning
				$hexcolor = substr( $hexcolor, 1);

				$r = hexdec(substr($hexcolor,0,2));
				$g = hexdec(substr($hexcolor,2,2));
				$b = hexdec(substr($hexcolor,4,2));
				$yiq = (($r*299)+($g*587)+($b*114))/1000;
				return ($yiq >= 250) ? '#000000' : '#ffffff';
			}
		}

		/**
		 * Adds <style> necessary for theme colors param type
		 *
		 * Loads all theme colors and adds <style> element if viewed in admin section to make theme color selector display
		 * the correct colors.
		 *
		 * @return array - color classes "color1", "color2", ...
		 */
		public function vc_theme_colors_css() {

			global $ishfreelotheme_options;

			echo '<style type="text/css">';

			for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ){

				echo '.ish_color_selector_item color' . $i . ', .ish_color_selector_container [data-ish-value="color' . $i . '"] { background-color: ' . $ishfreelotheme_options['color' . $i] . "; color: " . $this->get_color_contrast( $ishfreelotheme_options['color' . $i] ) . "; }\n";

				// Row
				echo '.wpb_row_container[data-ish-color="color' . $i . '"] > .wpb_vc_column > div { background: ' . $ishfreelotheme_options['color' . $i] . ";}\n";
				//echo '.wpb_row_container[data-ish-color^="color' . $i . '"] .wpb_vc_column_inner { background-color: rgba(255, 255, 255, 0.2)' . ";}\n";
				//echo '.wpb_row_container[data-ish-color^="color' . $i . '"] .wpb_content_element > .wpb_element_wrapper { background-color: rgba(255, 255, 255, 0.8)' . ";}\n";

				// Back-end elements
				if ( '#ffffff' != strtolower($ishfreelotheme_options['color' . $i]) ){
					echo '.wpb_content_element[class*=" wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_element[class^="wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_holder[class*=" wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_holder[class^="wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before { background-color: ' . $ishfreelotheme_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_content_element[class*=" wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_element[class^="wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_holder[class*=" wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_holder[class^="wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before { background-color: ' . $ishfreelotheme_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ishfreelotheme_options['color' . $i] ) . ";}\n";
				}


				// Skills
				if ( '#ffffff' != strtolower($ishfreelotheme_options['color' . $i]) ){
					echo '.wpb_ish_skills > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_skill > .wpb_element_wrapper:not([class*=" ish-color"]):before { background-color: ' . $ishfreelotheme_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_ish_skills > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_skill > .wpb_element_wrapper:not([class*=" ish-color"]):before  { background-color: ' . $ishfreelotheme_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ishfreelotheme_options['color' . $i] ) . ";}\n";
				}

				// Tabs
				if ( '#ffffff' != strtolower($ishfreelotheme_options['color' . $i]) ){
					echo '.wpb_ish_tabs > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_tab > .wpb_element_wrapper:not([class*=" ish-color"]):before { background-color: ' . $ishfreelotheme_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_ish_tabs > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_tab > .wpb_element_wrapper:not([class*=" ish-color"]):before  { background-color: ' . $ishfreelotheme_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ishfreelotheme_options['color' . $i] ) . ";}\n";
				}

				// Toggle
				if ( '#ffffff' != strtolower($ishfreelotheme_options['color' . $i]) ){
					echo '.wpb_ish_tgg_acc > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_tgg_acc_item > .wpb_element_wrapper:not([class*=" ish-color"]):before { background-color: ' . $ishfreelotheme_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_ish_tgg_acc > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_tgg_acc_item > .wpb_element_wrapper:not([class*=" ish-color"]):before  { background-color: ' . $ishfreelotheme_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ishfreelotheme_options['color' . $i] ) . ";}\n";
				}


			}

			echo '</style>' . "\n";
		}

		/**
		 * Calls the main config file to enhance VC functionality
		 *
		 * @return void
		 */
		public function load_vc_config() {
			$filename = 'assets/backend/vc_extend/vc_config/config.php';

			// LOOK FOR FILE IN THEME
			$config = locate_template( $filename );

			if ( !$config ) {
				// LOOK IN PLUGIN
				$config = $this->PLUGIN_DIR_PATH . $filename;
			}

			// LOAD FILE
			if ( file_exists( $config ) ) {

				require_once( $config );

			} else {

				trigger_error( __( 'Missing config file. Please make sure the file exists.', 'ishyoboy_assets' ) );

			}

		}

		/**
		 * Returns the HTML necessary for custom parameter types
		 *
		 * @param array $settings
		 * @param string $value
		 *
		 * @return string - color classes "color1", "color2", ...
		 */
		public function custom_params_callback( $settings, $value ) {

			// Necessary for compatibility with default vc params
			$param = $settings;
			$param_value = $value;
			$param_line = '';

			ob_start();
			include( 'assets/backend/vc_extend/vc_params/' . $param['type'] . '.php');
			$output = ob_get_contents();
			ob_end_clean();
			return $output;

		}

		/**
		 * Return a array of all available theme colors
		 *
		 * Tries to load all available colors from IshYoBoy themes and returns an array
		 *
		 * @return array - color classes "color1", "color2", ...
		 */
		public function get_theme_colors_array() {

			global $ishfreelotheme_options;

			$ish_theme_colors = Array();

			if ( ! empty( $ishfreelotheme_options ) ){

				for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ){

					if ( isset( $ishfreelotheme_options['color' . $i ] ) ){
						//$ish_theme_colors[ sprintf( __( 'Color %d', 'ishyoboy_assets' ), $i )  ] = 'color' . $i  ;
						$ish_theme_colors[ 'Color' . $i ] = 'color' . $i  ;
					}

				}

			}
			//$ish_theme_colors[ __( 'Advanced', 'ishyoboy_assets' ) ] = 'advanced';

			return $ish_theme_colors;

		}

		/**
		 * Return a array of all available categories
		 *
		 * @param string - taxonomy to load results from
		 * @return array - catgeory name, category slug
		 */
		public function get_available_taxonomy_terms( $taxonomy = 'category' ) {

			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => $taxonomy,
				'pad_counts'               => false

			);

			$categories = get_categories( $args );
			$return = Array();

			if ( ! empty( $categories ) ){

				foreach ( $categories as $category ){
					$return[ __( $category->name, 'ishyoboy_assets' ) ] = $category->slug;
				}

			}

			return $return;

		}

		/**
		 * Return a array of all available post formats
		 *
		 * @return array
		 */
		public function get_available_post_formats() {

			$post_formats = get_theme_support( 'post-formats' );
			$return = Array();

			if ( is_array( $post_formats[0] ) ) {

				foreach ( $post_formats[0] as $format ){
					$return[ $format ] = $format;
				}

			}

			return $return;

		}

		/**
		 * Return an array of all available ish-fontello icons
		 *
		 * Tries to load the ish-fontello config.json from the theme (if exists) or from the plugin and creates a list of
		 * all available icons in the icoinc font.
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_available_icons_array() {

			global $ishfreelotheme_options;

			if ( $this->pagebuilder_active() ){
				$icons_config_path = get_template_directory() . '/assets/frontend/font/config.json';
			}
			else{
				$icons_config_path = $this->PLUGIN_DIR_PATH . '/assets/frontend/font/config.json';
			}


			ob_start();
			include( $icons_config_path );
			$json = ob_get_contents();
			ob_end_clean();
			$json = json_decode($json);

			$output = Array();
			//$output['No icon'] = '';

			foreach ( $json->glyphs as $key => $val ){
				$icon_class = $json->css_prefix_text . $val->css;
				$output[ $icon_class ] = $icon_class;
			}

			return $output;

		}


		/**
		 * Return an array of all available image sizes
		 *
		 * @return array - associative array of Size Name and value
		 */
		public function get_available_image_sizes_array() {

			global $_wp_additional_image_sizes;

			//var_dump( $_wp_additional_image_sizes );

			$sizes_names = apply_filters( 'image_size_names_choose', array(
				'thumbnail' => __('Thumbnail'),
				'medium'    => __('Medium'),
				'large'     => __('Large'),
				'full'      => __('Full Size'),
			) );

			//var_dump( $sizes_names );

			$sizes = array();

			foreach( get_intermediate_image_sizes() as $s ){
				$sizes[ $s ] = array( 0, 0 );
				if( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ){
					$sizes[ $s ][0] = get_option( $s . '_size_w' );
					$sizes[ $s ][1] = get_option( $s . '_size_h' );
					if ( $s != 'thumbnail' ){
						$sizes[ $s ][1] = '9999';
					}
				}else{
					if( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) )
						$sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'], );
				}
			}

			//var_dump( $sizes );

			foreach ( $sizes_names as $size_key => $size_val ){
				if ( isset ( $sizes[$size_key] ) && is_array($sizes[$size_key]) ){
					if ( '9999' == $sizes[$size_key][1] ) { $sizes[$size_key][1] = 'variable'; }
					$sizes_names[$size_key] = $size_val . ' - ' . $sizes[$size_key][0] . ' x ' . $sizes[$size_key][1] . ' px';
				}
			}

			$sizes_names = array_flip( $sizes_names );

			return $sizes_names;

		}


		/**
		 * Return an array of all available sidebars
		 *
		 * Loads a list of all available sidebars from Set in Appearance -> Widgets
		 *
		 * @return array - "id" and "Sidebar name" pairs associative array
		 */
		public function get_available_sidebars_array() {

			global $ishfreelotheme_options;

			$output = Array();

			foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
				$output[ $sidebar['name'] ] = $sidebar['id'];
			}

			return $output;

		}

		/**
		 * Return an array of all available Menus
		 *
		 * Loads a list of all available Menus from Set in Appearance -> Menus
		 *
		 * @return array - "id" and "Menu name" pairs associative array
		 */
		public function get_available_menus_array() {

			$menus = get_terms( 'nav_menu', array( 'hide_empty' => false, 'taxonomy' => 'tax_nav_menu' ) );

			$output = Array();

			if ( ! empty( $menus ) && is_array( $menus ) ) {

				foreach ( $menus as $menu ) {
					$output[ $menu->name ] = $menu->term_id;
				}
			}

			return $output;
		}


		public function get_user_fontello_font(){

			if ( empty( $this->cache['user_fontello'] ) ){

				$this->cache['user_fontello']['path'] = $this->locate_template_in_plugin('fontello/config.json');

				if ( ! empty( $this->cache['user_fontello']['path'] ) ){

					ob_start();
					include( $this->cache['user_fontello']['path'] );
					$json = ob_get_contents();
					ob_end_clean();
					$this->cache['user_fontello']['json'] = json_decode( $json );

					if ( false !== strpos( $this->cache['user_fontello']['path'], STYLESHEETPATH ) ){
						$this->cache['user_fontello']['uri'] = 	get_stylesheet_directory_uri() . '/' . $this->theme_locate_path . '/';
					} elseif ( false !== strpos( $this->cache['user_fontello']['path'], TEMPLATEPATH ) ) {
						$this->cache['user_fontello']['uri'] = 	get_template_directory_uri() . '/' . $this->theme_locate_path . '/';
					}
					else{
						$this->cache['user_fontello'] = Array();
					}
				}
			}

			return $this->cache['user_fontello'];

		}


		/**
		 * Return an array of user icons
		 *
		 * Tries to load the ish-fontello config.json from the theme (if exists) or from the plugin and creates a list of
		 * all available icons in the icoinc font.
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_user_fontello_icons_array() {

			global $ishfreelotheme_options;

			$icons_config_path = $this->locate_template_in_plugin('fontello/config.json');

			ob_start();
			include( $icons_config_path );
			$json = ob_get_contents();
			ob_end_clean();
			$json = json_decode($json);

			$output = Array();

			if ( ! empty( $json ) ){
				foreach ( $json->glyphs as $key => $val ){
					$icon_class = $json->css_prefix_text . $val->css;
					$output[ $icon_class ] = $icon_class;
				}
			}

			return $output;

		}


		/**
		 * Return an array of all available ish-fontello icons with list icons in front
		 *
		 * Tries to load the ish-fontello config.json from the theme (if exists) or from the plugin and creates a list of
		 * all available icons in the icoinc font. The algorithm places the pre-defined list icons in front positions.
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_available_lists_icons_array() {

			global $ishfreelotheme_options;

			// List of icon-classes to be prioritized. Value is not important
			$priority_list = array(
				'ish-icon-ok' => 'ish-icon-ok',
				'ish-icon-cancel' => 'ish-icon-cancel',
				'ish-icon-plus' => 'ish-icon-plus',
				'ish-icon-minus' => 'ish-icon-minus',
				'ish-icon-circle' => 'ish-icon-circle',
				'ish-icon-circle-empty' => 'ish-icon-circle-empty',
				//'ish-icon-dot-circled' => 'ish-icon-dot-circled',
				'ish-icon-stop' => 'ish-icon-stop',
				//'ish-icon-check-empty' => 'ish-icon-check-empty',
				'ish-icon-check-empty-1' => 'ish-icon-check-empty-1',
				'ish-icon-right-open' => 'ish-icon-right-open',
			);

			if ( $this->pagebuilder_active() ){
				$icons_config_path = get_template_directory() . '/assets/frontend/font/config.json';
			}
			else{
				$icons_config_path = $this->PLUGIN_DIR_PATH . '/assets/frontend/font/config.json';
			}


			ob_start();
			include( $icons_config_path );
			$json = ob_get_contents();
			ob_end_clean();
			$json = json_decode($json);

			$output = Array();
			$empty['No icon'] = '';

			foreach ( $json->glyphs as $key => $val ){
				$icon_class = $json->css_prefix_text . $val->css;
				if ( ! isset( $priority_list[ $icon_class ] ) ){
					$output[ $icon_class ] = $icon_class;
				}
			}

			return array_merge($empty, $priority_list, $output);

		}


		/**
		 * Create an Array of files from a given path
		 *
		 * @param string $icons_path
		 * @param array $ignored_folders
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_icon_sets_icon_uri( $icon ){
			// icon == "folder_name/icon_file_name.svg"

			$icon_data = explode( '/' , $icon );

			if ( count( $icon_data ) < 3 ){
				// Compatibility with 2 params version
				$icon_data[2] = $icon_data[1];
				$icon_data[1] = $icon_data[0];
				$icon_data[0] = 'path_plugin';
			}

			if ( isset( $this->cache['icon_sets'][ $icon_data[1] ] ) ){
				return $this->cache['icon_sets'][ $icon_data[1] ] . $icon_data[1] . '/' .  $icon_data[2] ;
			}
			else{

				// 1. LOOK IN CHILD THEME
				$icons_path = STYLESHEETPATH . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
				$folder_uri = get_stylesheet_directory_uri() . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
				$icon_uri = $folder_uri . $icon_data[1] . '/' .  $icon_data[2];
				if ( ! file_exists( $icons_path . $icon_data[1] ) ) {

					// 2. LOOK IN PARENT THEME
					$icons_path = TEMPLATEPATH . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
					$folder_uri = get_template_directory_uri() . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
					$icon_uri = $folder_uri . $icon_data[1] . '/' .  $icon_data[2];
					if ( ! file_exists( $icons_path . $icon_data[1] ) ) {

						// 3. LOOK IN PLUGIN
						$icons_path = $this->PLUGIN_DIR_PATH . '/' . $this->icon_sets_folder_path;
						$folder_uri = $this->PLUGIN_PLUGIN_URI . '/' . $this->icon_sets_folder_path;
						$icon_uri = $folder_uri . $icon_data[1] . '/' .  $icon_data[2];
						if ( ! file_exists( $icons_path . $icon_data[1] ) ) {
							return false;
						}
						else{
							$this->cache['icon_sets'][ $icon_data[1] ] = $folder_uri;
						}
					}
					else{
						$this->cache['icon_sets'][ $icon_data[1] ] = $folder_uri;
					}

				} else{
					$this->cache['icon_sets'][ $icon_data[1] ] = $folder_uri;
				}

				return $icon_uri;

			}

		}

		/**
		 * Create an Array of files from a given path
		 *
		 * @param string $icons_path
		 * @param string $path_id
		 * @param array $ignored_folders
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_icon_sets_from_path( $icons_path, $path_id, &$ignored_folders ){

			$icon_sets = Array();

			if (  file_exists( $icons_path ) && $handle = opendir( $icons_path ) ) {
				while ( false !== ( $entry = readdir( $handle ) ) ) {
					if ( '.' != $entry  && '..' != $entry ) {

						// Remove all spaces from folder names
						// $key = str_replace(' ', '_', $entry );

						// Ignore folders starting with underscore
						if ( '_' == $entry[0] ){
							$ignored_folders[substr( $entry, 1)] = true;
						}
						else{

							if ( ! isset( $ignored_folders[ $entry ] ) ){

								$icon_sets[ $entry ] = Array();

								// Open Folder and list all icons filenames
								if ( $handle_inner = opendir( $icons_path . $entry ) ) {
									while ( false !== ( $icon = readdir( $handle_inner ) ) ) {
										if ( '.' != $icon  && '..' != $icon ) {
											$key = str_replace(' ', '_', $icon );
											$icon_sets[ $entry ][$key] = Array(
												'icon' => $icon,
												'path' => $path_id,
											);
										}
									}
									closedir( $handle_inner );
								}

							}

						}
					}
				}
				closedir( $handle );
			}

			return $icon_sets;

		}


		/**
		 * Load and all SVG icons from Child Theme, Theme and Plugin
		 *
		 * The function collects all icons from the Child Theme, Parent Theme and the Plugin itself with this priority.
		 * If the folder names differ, the icons are joined together from all three sources. If two folder names are
		 * equal, the one with the biggest priority is chosen and the rest are ignored.
		 *
		 * E.g.: If the folder "example" is available in all three sources. Only the ones from the Child Theme are
		 * used. The rest ( in Parent theme and Plugin) are ignored.
		 *
		 * To disable an icon set completely change the name to start with underscore (E.g.: "_example" ). This will
		 * disable the icons from all three sources.
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_available_icon_sets_array() {

			global $ishfreelotheme_options;

			$icon_sets = Array();
			$ignored_folders = Array();

			// 1. LOOK IN CHILD THEME
			$icons_path = STYLESHEETPATH . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
			$icons = $this->get_icon_sets_from_path( $icons_path, 'path_child', $ignored_folders );
			$icon_sets = array_merge( $icon_sets, $icons);

			// 2. LOOK IN PARENT THEME
			$icons_path = TEMPLATEPATH . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
			$icons = $this->get_icon_sets_from_path( $icons_path, 'path_parent', $ignored_folders );
			$icon_sets = array_merge( $icon_sets, $icons);

			// 3. LOOK IN PLUGIN
			$icons_path = $this->PLUGIN_DIR_PATH . '/' . $this->icon_sets_folder_path;
			$icons = $this->get_icon_sets_from_path( $icons_path, 'path_plugin', $ignored_folders );
			$icon_sets = array_merge( $icon_sets, $icons);

			return $icon_sets;

		}



		/**
		 * A filter to dd the global shortcode element class
		 *
		 * @param string $classes - shortcode classes
		 * @param string $tag - shortcode name
		 *
		 * @return string - shortcode classes
		 */
		public function add_global_sc_class( $classes, $tag ){
			$class = ( '' != $this->config['global_shortcode_class'] ) ? ( $this->config['global_shortcode_class'] . ' ' ) : '';
			return $class . $classes;
		}

		/**
		 * Extract all attributes after merging them with defaults and global atts
		 *
		 * @param array $defaults - Shortcode specific atts
		 * @param array $atts - Shortcode attributes as entered in Visual composer
		 *
		 * @return array - Array containing all final shortcode attributes values
		 */
		public function extract_sc_attributes( $defaults, $atts){
			$output = shortcode_atts(
				array_merge(
					$this->global_sc_atts,
					$defaults
				),
				$atts
			);

			// Empty global atts if not used
			/*if ( ! isset($atts['global_atts']) || 'yes' != $atts['global_atts']){
				foreach ( $this->global_sc_atts as $key => $val ){
					$output[$key] = '';
				}
			}*/

			// Change all color values from 'none' to ''
			foreach ( $output as $key => $val ){
				if ( ( 'none' == $val ) && ( false !== strpos( $key, 'color' ) ) ){
					// The key contains word color and the value is 'none'
					$output[$key] = '';
				}
			}

			return $output;
		}

		/*
		 * Detect if the current admin page is of the given post type
		 *
		 * @param string - the slug of the CPT
		 *
		 * @return boolean
		 */
		public function is_post_type_admin_edit_page( $cpt ){
			global $pagenow;

			if  (
				( 'post.php' == $pagenow && isset($_GET['post']) && $cpt == get_post_type($_GET['post']) )
				|| ( 'post-new.php' == $pagenow && isset($_GET['post_type']) && $cpt == $_GET['post_type'])
				|| ( 'post-new.php' == $pagenow && !isset($_GET['post_type']) && 'post' == $cpt )
				)
			{
				return true;
			}

			return false;
		}



		/**
		 * Include "vc_build_link" & "vc_parse_multi_attribute" to be able to parse URLs outside VC
		 *
		 * @return void
		 */
		public function load_helpers(){
			require_once( 'assets/backend/vc_extend/helpers/vc-functions.php');
		}

		/**
		 * REGISTERS TINYMCE RICH EDITOR BUTTONS
		 *
		 * @return void
		 */
		public function action_init() {

			if ( ! defined( 'ISHFREELOTHEMEGAP_BIG' ) ){
				define( 'ISHFREELOTHEMEGAP_BIG' , 60 );
			}
			if ( ! defined( 'ISHFREELOTHEMEGAP_SMALL' ) ){
				define( 'ISHFREELOTHEMEGAP_SMALL' , 60 );
			}

			// Filters
			add_filter( 'ish_sc_classes', array(&$this, 'add_global_sc_class'), 10, 2);

			global $ishfreelotheme_shortcodes;

			$ishfreelotheme_shortcodes = Array(
				'ish_button' => '',
				'ish_divider' => '',
				'ish_separator' => '',
				'ish_headline' => '',
				'ish_icon' => '',
				'ish_svg_icon' => '',
				'ish_icon_button_set' => '',
				'ish_image' => '',
				'ish_gallery' => '',
				'ish_list' => '',
				'ish_quote' => '',
				'ish_skills' => '',
				'ish_skill' => '',
				'ish_table' => '',
				'ish_pricing_table' => '',
				'ish_pricing_row' => '',
				'ish_embed' => '',
				'ish_map' => '',
				'ish_location' => '',
				'ish_social_share' => '',
				'ish_slidable' => '',
				'ish_slide' => '',
				'ish_sidebar' => '',
				'ish_menu' => '',
				'ish_portfolio' => '',
				'ish_portfolio_prev_next' => '',
				'ish_portfolio_categories' => '',
				//'ish_portfolio_gallery' => '',
				'ish_blog_media' => '',
				'ish_recent_posts' => '',
				'ish_tabs' => '',
				'ish_tab' => '',
				'ish_tgg_acc' => '',
				'ish_tgg_acc_item' => '',
				'ish_cf7' => '',
				'ish_box' => '',
				'ish_chart' => '',
				'ish_counter' => '',
				'ish_icon_text' => '',
			);

			$ishfreelotheme_shortcodes = apply_filters( 'ish_default_sc_list', $ishfreelotheme_shortcodes );

			if ( $this->visual_composer_active() ) {

				// Add Settings Page and remove default VC shortcodes
				if ( $this->pagebuilder_active() ){
					add_filter( 'ish_theme_options_section_content', array(&$this, 'add_theme_options_settings'), 10, 2);
					add_action( 'init', array(&$this, 'remove_default_vc_shortcodes'), 11 );
				}

				// Only load all shortcodes if plugin activated and loaded = not manually removed from plugins folder without deactivating
				if ( function_exists('vc_add_shortcode_param') ) {

					//Register all shortcodes
					foreach ( $ishfreelotheme_shortcodes as $tag => $func ){
						add_shortcode( $tag, Array( &$this, 'shortcode_callback' ) );
					}

					$this->load_vc_config();
				}

			}
			else{
				add_action( 'ish_before_sc_callback',  array( &$this, 'load_helpers' ) );
			}

			require_once( 'assets/backend/includes/theme-plugin-functions.php' );

		}

		/**
		 * Removes the default Visual Composer shortcodes
		 *
		 * Removes the default Visual Composer shortcodes unless set differently in Theme Options
		 *
		 * @return void
		 */
		public function remove_default_vc_shortcodes(){
			global $ishfreelotheme_options;

			if ( ! isset( $ishfreelotheme_options ) || ! isset( $ishfreelotheme_options['plugin_sc_enable_vc_shortcodes'] ) || ( '0' == $ishfreelotheme_options['plugin_sc_enable_vc_shortcodes'] ) ){
				if ( function_exists( 'vc_remove_element') ){

					// VC Shotcodes
					vc_remove_element('vc_separator');
					vc_remove_element('vc_zigzag');
					vc_remove_element('vc_text_separator');
					vc_remove_element('vc_message');
					vc_remove_element('vc_facebook');
					vc_remove_element('vc_tweetmeme');
					vc_remove_element('vc_googleplus');
					vc_remove_element('vc_pinterest');
					vc_remove_element('vc_toggle');
					vc_remove_element('vc_single_image');
					vc_remove_element('vc_gallery');
					vc_remove_element('vc_images_carousel');
					vc_remove_element('vc_tabs');
					vc_remove_element('vc_tour');
					vc_remove_element('vc_tab');
					vc_remove_element('vc_accordion');
					vc_remove_element('vc_accordion_tab');
					vc_remove_element('vc_teaser_grid');
					vc_remove_element('vc_posts_slider');
					vc_remove_element('vc_widget_sidebar');
					vc_remove_element('vc_button');
					vc_remove_element('vc_button2');
					vc_remove_element('vc_cta_button');
					vc_remove_element('vc_cta_button2');
					vc_remove_element('vc_video');
					vc_remove_element('vc_gmaps');
					//vc_remove_element('vc_raw_html');
					//vc_remove_element('vc_raw_js');
					vc_remove_element('vc_flickr');
					vc_remove_element('vc_progress_bar');
					vc_remove_element('vc_pie');
					vc_remove_element('vc_hoverbox');

					// 3-rd party plugins
					if ( is_admin() ) { vc_remove_element('contact-form-7'); };
					//vc_remove_element('layerslider_vc');
					//vc_remove_element('rev_slider_vc');
					//vc_remove_element('gravityform');

					// Widgets
					vc_remove_element('vc_wp_search');
					vc_remove_element('vc_wp_meta');
					vc_remove_element('vc_wp_recentcomments');
					vc_remove_element('vc_wp_calendar');
					vc_remove_element('vc_wp_pages');
					vc_remove_element('vc_wp_tagcloud');
					vc_remove_element('vc_wp_custommenu');
					vc_remove_element('vc_wp_text');
					vc_remove_element('vc_wp_posts');
					vc_remove_element('vc_wp_links');
					vc_remove_element('vc_wp_categories');
					vc_remove_element('vc_wp_archives');
					vc_remove_element('vc_wp_rss');

					// Remove the "VC: Custom Teaser" metabox
					global $vc_teaser_box;
					if ( is_object( $vc_teaser_box ) ){
						remove_action( 'admin_init', array( $vc_teaser_box, 'jsComposerEditPage' ), 6 );
					}


					//$vc_posts_grid_instance = $vc_manager->vc()->getShortCode('vc_posts_grid');
					//remove_action( 'admin_init', array( $vc_posts_grid_instance, 'jsComposerEditPage' ), 6 );
					vc_remove_element('vc_posts_grid');

					//$vc_carousel_instance = $vc_manager->vc()->getShortCode('vc_carousel');
					//remove_action( 'admin_init', array( $vc_carousel_instance, 'jsComposerEditPage' ), 6 );
					vc_remove_element('vc_carousel');

					vc_remove_element('vc_custom_heading');
					vc_remove_element('vc_empty_space');

					vc_remove_element('vc_media_grid');
					vc_remove_element('vc_masonry_grid');
					vc_remove_element('vc_masonry_media_grid');
					vc_remove_element('vc_basic_grid');
					vc_remove_element('vc_icon');
					vc_remove_element('vc_btn');
					vc_remove_element('vc_cta');

					vc_remove_element('vc_tta_tabs');
					vc_remove_element('vc_tta_tour');
					vc_remove_element('vc_tta_accordion');
					vc_remove_element('vc_line_chart');
					vc_remove_element('vc_round_chart');
					vc_remove_element('vc_tta_section');
					vc_remove_element('vc_tta_pageable');

					vc_remove_element('vc_section');

				}

			}
		}

		/**
		 * A filter to add a set of options to existing Theme Options section
		 *
		 * @param array $options - Array containing the section options
		 * @param string $section_class - The "name" of the section
		 *
		 * @return array - The filtered $options array
		 */
		public function add_theme_options_settings( $options, $section_class = null ) {

			if ( ! empty( $section_class ) && 'pluginsoptions' == $section_class ){
				$options[] = array(  'name'  => __( 'Visual Composer Shortcodes', 'ishyoboy_assets' ),
					'desc'  => __( 'Enable or disable the default Visual Composer shortcodes in IshYoBoy Pagebuilder', 'ishyoboy_assets'),
					'id'    => 'plugin_sc_enable_vc_shortcodes',
					'std'   => 0,
					'on'    => __( 'Enable', 'ishyoboy_assets' ),
					'off'   => __( 'Disable', 'ishyoboy_assets' ),
					'folds' => 0,
					'type'  => 'switch');
			}

			return $options;

		}

		public function buildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {
			$has_image = false;
			$style = '';
			if ( (int) $bg_image > 0 && ( $image_url = wp_get_attachment_url( $bg_image, 'large' ) ) !== false ) {
				$has_image = true;
				$style .= "background-image: url(" . $image_url . ");";
			}
			/*if ( ! empty( $bg_color ) ) {
				$style .= vc_get_css_color( 'background-color', $bg_color );
			}*/
			if ( ! empty( $bg_image_repeat ) && $has_image ) {
				if ( $bg_image_repeat === 'cover' ) {
					$style .= "background-repeat:no-repeat; background-size: cover;";
				} elseif ( $bg_image_repeat === 'contain' ) {
					$style .= "background-repeat:no-repeat; background-size: contain;";
				} elseif ( $bg_image_repeat === 'no-repeat' ) {
					$style .= 'background-repeat: no-repeat;';
				} elseif ( $bg_image_repeat === 'repeat' ) {
					$style .= 'background-repeat: repeat;';
				}
			}
			/*if ( ! empty( $font_color ) ) {
				$style .= vc_get_css_color( 'color', $font_color ); // 'color: '.$font_color.';';
			}*/
			if ( $padding != '' ) {
				$style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
			}
			if ( $margin_bottom != '' ) {
				$style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
			}

			return empty( $style ) ? $style : ' style="' . esc_attr( $style ) . '"';
		}


		public function get_css_fields( $value ) {

			$return = '';

			// Explode all 4 values (top, right, bottom, left);
			$four_values = explode( '#', $value);

			for ( $i = 0; $i < 4; $i++ ){
				if ( ! isset( $four_values[$i] ) ){
					$four_values[$i] = '0';
				}
			}

			$return =  ' ' . implode('px ', $four_values ) . 'px';
			$return = str_replace(' 0px', ' 0', $return );

			return $return;
		}

	}

	/**
	 * Returns the main instance of Plugin to prevent the need to use globals.
	 *
	 * @return Ishyoboy_Shortcodes
	 */
	function ISH_SC() {
		return Ishyoboy_Shortcodes::instance( __FILE__ );
	}

	// Global for backwards compatibility.
	$GLOBALS['ish_plugins_shortcodes'] = ISH_SC();

endif;

/**
 * Global Functions
 */

if ( ! function_exists( 'ishfreelotheme_colors_to_hex' ) ) {
	function ishfreelotheme_colors_to_hex($input){
		global $ishfreelotheme_options;
		$output = $input;

		if ( '' != $input && strpos( $input, 'color' ) === 0 ){
			if ( isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options[$input] ) ){
				$output = $ishfreelotheme_options[$input];
			}
		}

		return $output;
	}
}

if ( ! function_exists( 'ishfreelotheme_custom_excerpt' ) ) {
	function ishfreelotheme_custom_excerpt($custom_content, $limit, $search = null) {
		global $post;

		if ( has_excerpt() ){
			$custom_content = $post->post_excerpt;
		}

		$content = preg_replace('/\[[^\]]+\]/', ' ', $custom_content );  # strip shortcodes, keep shortcode content
		$content = wp_strip_all_tags( $content, true );

		if ( isset($search)){
			$content = explode(' ', $content);
			$index = ishfreelotheme_array_find($search, $content);
			$start = ( ($index - $limit / 2) < 0 ) ? 0 : $index - $limit / 2;
			$content = array_slice($content, $start, $limit);
		} else{
			$content = explode(' ', $content, $limit);
		}

		if ( count($content) >= $limit ) {
			array_pop($content);
			$content = implode( ' ', $content ) . '...';
		} else {
			$content = implode( ' ', $content );
		}
		//$content = preg_replace('/\[.+\]/','', $content);
		if ( isset($search)){
			$content = apply_filters( 'the_content', $content);
		}
		$content = str_replace(']]>', ']]&gt;', $content);
		$content = str_replace("&nbsp;", ' ', $content);
		//$content = str_ireplace($search, '<mark>' . $search . '</mark>' , $content);
		//$content = ishfreelotheme_search_excerpt_highlight($content);
		return $content;

		/*
		 * Alternative method with do_shortcode
		 *
		 * if ( empty( $custom_content ) && ! empty( $post->post_content ) ) {
			$text = wp_strip_all_tags( do_shortcode( $post->post_content ) );
			$excerpt_length = apply_filters( 'excerpt_length', 55 );
			$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

			return wp_strip_all_tags($text);
		}*/

	}
}