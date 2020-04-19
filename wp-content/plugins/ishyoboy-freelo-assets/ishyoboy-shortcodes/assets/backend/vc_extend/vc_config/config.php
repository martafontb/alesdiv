<?php

if ( is_admin() ) {
	do_action( 'ish_sc_before_admin_init' );
}
else{
	do_action( 'ish_sc_before_init' );
}

if ( is_admin() ) {

	// Register all fields types available in vc_param folder
	$vc_params_path = $this->PLUGIN_DIR_PATH . 'assets/backend/vc_extend/vc_params/';
	if ( is_dir( $vc_params_path ) ) {
		if ( $vc_params_dir = opendir( $vc_params_path ) ) {
			while ( ( $vc_param = readdir( $vc_params_dir ) ) !== false ) {
				if ( stristr( $vc_param, '.php' ) !== false ) {

					$param_name = strtolower( substr( $vc_param, 0, strpos( $vc_param, '.php' ) ) );

					vc_add_shortcode_param(
						$param_name,
						Array( &$this, 'custom_params_callback' ),
						ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/backend/js/vc_params/' . $param_name . '.js'
					);

				}
			}
		}
	}
}

	// Theme Colors Array
	$ish_theme_colors = $this->get_theme_colors_array();

	// Global attributes available in each shortcode
	$ish_global_params = Array(
		/*array(
			// OPTIONAL ATTRIBUTES TOGGLE
			'type' => 'ish_buttons_selector_full',
			'heading' => esc_html__( 'Use Advanced Global Attributes', 'ishyoboy_assets' ),
			'param_name' => 'global_atts',
			//'description' => esc_html__('Display advanced attributes', 'ishyoboy_assets' ),
			'value' => Array(
				__( 'No', 'ishyoboy_assets' ) => '',
				__( 'Yes', 'ishyoboy_assets' ) => 'yes',
			),
			'group' => esc_html__( 'Advanced', 'ishyoboy_assets'),
		),*/
		array(
			'type' => 'ish_buttons_selector_full',
			'heading' => esc_html__( 'Bottom Margin', 'ishyoboy_assets' ),
			'param_name' => 'bottom_margin',
			'value' => array(
				__( 'Default', 'ishyoboy_assets' ) => '',
				__( 'Half', 'ishyoboy_assets' ) => 'half',
				__( 'None', 'ishyoboy_assets' ) => 'none',
			),
			'description' => esc_html__( 'Change the default bottom margin and bring the next element closer.', 'ishyoboy_assets' ),
			/*'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			),*/
			'group' => esc_html__( 'Advanced', 'ishyoboy_assets'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Element ID', 'ishyoboy_assets' ),
			'param_name' => 'id',
			'value' => '',
			'description' => esc_html__('Use this field to add a unique ID to the element and then refer to it in your css or javascript file.', 'ishyoboy_assets' ),
			/*'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			),*/
			'group' => esc_html__( 'Advanced', 'ishyoboy_assets'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra CSS Class', 'ishyoboy_assets' ),
			'param_name' => 'css_class',
			'value' => '',
			'description' => esc_html__( 'If you wish to style particular content element differently, use this field to add a class name and then refer to it in your css file.', 'ishyoboy_assets' ),
			/*'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			),*/
			'group' => esc_html__( 'Advanced', 'ishyoboy_assets'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Inline CSS styles', 'ishyoboy_assets' ),
			'param_name' => 'style',
			'value' => '',
			'description' => esc_html__( 'Inline CSS style. Used by advanced HTML users to add custom CSS styles', 'ishyoboy_assets' ),
			/*'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			),*/
			'group' => esc_html__( 'Advanced', 'ishyoboy_assets'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Tooltip text', 'ishyoboy_assets' ),
			'param_name' => 'tooltip',
			'value' => '',
			'description' => esc_html__( 'Adds tooltip to the element', 'ishyoboy_assets' ),
			/*'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			),*/
			'group' => esc_html__( 'Advanced', 'ishyoboy_assets'),
		),
		array(
			'type' => 'ish_color_selector',
			'heading' => esc_html__( 'Tooltip Background Color', 'ishyoboy_assets' ),
			'param_name' => 'tooltip_color',
			'std' => 'color1',
			'value' => $ish_theme_colors,
			'description' => esc_html__( 'Change the color of the tooltip background', 'ishyoboy_assets' ),
			/*'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			),*/
			'group' => esc_html__( 'Advanced', 'ishyoboy_assets'),
		),
		array(
			'type' => 'ish_color_selector',
			'heading' => esc_html__( 'Tooltip Text Color', 'ishyoboy_assets' ),
			'param_name' => 'tooltip_text_color',
			'std' => 'color3',
			'value' => $ish_theme_colors,
			'description' => esc_html__( 'Change the color of the tooltip text', 'ishyoboy_assets' ),
			/*'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			),*/
			'group' => esc_html__( 'Advanced', 'ishyoboy_assets'),
		)
	);

	// Global Alignment array
	$ish_alignmment_params = array(
		__( 'No Alignment', 'ishyoboy_assets' ) => '',
		__( 'Align Left', 'ishyoboy_assets' ) => 'left',
		__( 'Align Center', 'ishyoboy_assets' ) => 'center',
		__( 'Align Right', 'ishyoboy_assets' ) => 'right',
	);
	$ish_alignmment_params_reduced = array(
		__( 'Align Left', 'ishyoboy_assets' ) => 'left',
		__( 'Align Right', 'ishyoboy_assets' ) => 'right',
	);

	// Global icons list
	$ish_available_icons_no_empty = $this->get_available_icons_array();
	$ish_available_icons = array_merge( array( esc_html__( 'No Icon', 'ishyoboy_assets' ) => ''), $ish_available_icons_no_empty );
	$ish_available_list_icons = $this->get_available_lists_icons_array();
	//$ish_available_icon_sets = $this->get_available_icon_sets_array();

	$ish_available_sidebars = $this->get_available_sidebars_array();
	$ish_available_menus = $this->get_available_menus_array();
	$ish_image_sizes = $this->get_available_image_sizes_array();

	$ish_post_categories = $this->get_available_taxonomy_terms('category');
	$ish_post_tags = $this->get_available_taxonomy_terms('post_tag');
	$ish_post_formats = $this->get_available_post_formats();
	$ish_portfolio_categories = $this->get_available_taxonomy_terms('portfolio-category');

	// Fix Begin - VC cannot handle empty arrays in "value" field. Either empty string or array with items
	$ish_post_categories = ( empty( $ish_post_categories ) ) ? '' : $ish_post_categories;
	$ish_post_tags = ( empty( $ish_post_tags ) ) ? '' : $ish_post_tags;
	$ish_post_formats = ( empty( $ish_post_formats ) ) ? '' : $ish_post_formats;
	$ish_portfolio_categories = ( empty( $ish_portfolio_categories ) ) ? '' : $ish_portfolio_categories;
	$ish_available_menus = ( empty( $ish_available_menus ) ) ? '' : $ish_available_menus;
	// Fix End

	$sc_paginated_count = 0;
	$ish_sc_gallery_count = 0;

	// Variables necessary for two galleries one after each other
	global $ishfreelotheme_all_sc_count, $ish_last_gallery_rel, $ish_last_gallery_id;
	$ishfreelotheme_all_sc_count = 0;
	$ish_last_gallery_id -1;

	// Variables necessary for row decorations paddings of previous sections
	global $ish_rows_count, $ishfreelotheme_rows_replace;
	$ish_rows_count = 0;
	$ishfreelotheme_rows_replace = Array();
	// Necessary for content entered before the VC rows by "the_content" filter
	$ishfreelotheme_rows_replace[] = ' ish-decor-padding-0 ';

	// Necessary for Autosuggest fields:
	global $ish_autosuggest_count;
	$ish_autosuggest_count = 0;

	global $pagenow;

	$ish_sc_settings = Array();

	$ish_sc_settings['vc_row'] = '';
	$ish_sc_settings['vc_column'] = '';
	$ish_sc_settings['ish_button'] = '';
	$ish_sc_settings['ish_box'] = '';
	$ish_sc_settings['ish_divider'] = '';
	$ish_sc_settings['ish_separator'] = '';
	$ish_sc_settings['ish_headline'] = '';
	$ish_sc_settings['ish_icon'] = '';
	$ish_sc_settings['ish_svg_icon'] = '';
	$ish_sc_settings['ish_icon_button_set'] = '';
	$ish_sc_settings['ish_image'] = '';
	$ish_sc_settings['ish_gallery'] = '';
	$ish_sc_settings['ish_list'] = '';
	$ish_sc_settings['ish_quote'] = '';
	$ish_sc_settings['ish_skills'] = '';
	$ish_sc_settings['ish_table'] = '';
	$ish_sc_settings['ish_pricing_table'] = '';
	$ish_sc_settings['ish_embed'] = '';
	$ish_sc_settings['ish_map'] = '';
	$ish_sc_settings['ish_social_share'] = '';
	$ish_sc_settings['ish_slidable'] = '';
	$ish_sc_settings['ish_sidebar'] = '';
	$ish_sc_settings['ish_menu'] = '';
	$ish_sc_settings['ish_portfolio'] = '';
	// Shortcodes for single PORTFOLIO-POST only
	if ( $this->is_post_type_admin_edit_page('portfolio-post') || ( defined('DOING_AJAX') && DOING_AJAX ) )
	{
		$ish_sc_settings['ish_portfolio_prev_next'] = '';
		$ish_sc_settings['ish_portfolio_categories'] = '';
	}
	// Shortcodes for single POST only
	if ( $this->is_post_type_admin_edit_page('post') || ( defined('DOING_AJAX') && DOING_AJAX ) )
	{
		$ish_sc_settings['ish_blog_media'] = '';
	}
	$ish_sc_settings['ish_recent_posts'] = '';
	$ish_sc_settings['ish_tabs'] = '';
	$ish_sc_settings['ish_tgg_acc'] = '';
	$ish_sc_settings['vc_updates'] = '';
	$ish_sc_settings['ish_cf7'] = '';
	$ish_sc_settings['ish_chart'] = '';
	$ish_sc_settings['ish_counter'] = '';
	$ish_sc_settings['ish_icon_text'] = '';

	$ish_sc_settings = apply_filters( 'ish_default_sc_settings_list', $ish_sc_settings );

	foreach ( $ish_sc_settings as $key => $value){

		$template = locate_template( $this->theme_locate_path . '/' . $this->SC_SETTINGS_DIR . $key . '.php' );

		if ( !$template ) {
			// LOOK IN PLUGIN
			$template = $this->PLUGIN_DIR_PATH . $this->SC_SETTINGS_DIR . $key . '.php';
		}

		// LOAD TEMPLATE
		if ( file_exists($template) ) {
			include( $template );
		}

	}

	if ( is_admin() ) {
		do_action( 'ish_sc_after_admin_init' );
	}
	else{
		do_action( 'ish_sc_after_init' );
	}
