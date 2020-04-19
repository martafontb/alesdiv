<?php

vc_map( array(
	'name' => __( 'Navigation', 'ishyoboy_assets' ),
	'base' => 'ish_menu',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'description' => __( 'Navigation menu', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-menu',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Navigation Menu', 'ishyoboy_assets' ),
				'param_name' => 'menu',
				'admin_label' => true,
				'value' => $ish_available_menus,
				'description' => __( 'Select a Menu you previously prepared under Appearance -> Menus.', 'ishyoboy_assets' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Menu Depth', 'ishyoboy_assets' ),
				'class' => 'ish-button',
				'param_name' => 'depth',
				'value' => '0',
				'description' => __( 'A number representing the depth of the menu.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Menu Style', 'ishyoboy_assets' ),
				'param_name' => 'menu_style',
				'std' => 'background',
				'value' => Array(
					__( 'Text Links', 'ishyoboy_assets' ) => 'text',
					__( 'Bordered Links', 'ishyoboy_assets' ) => 'border',
					__( 'Background Color Links', 'ishyoboy_assets' ) => 'background',
				),
				'description' => __( 'Choose how the menu will look.', 'ishyoboy_assets' )
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Display Icons', 'ishyoboy_assets' ),
				'param_name' => 'icons',
				'std' => 'no',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'description' => __( 'Display icons for menu items as set in Appearance -> Menus.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color3',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				'dependency' => Array( 'element' => 'menu_style', 'value' => array( 'border', 'background' ) ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Active Background Color', 'ishyoboy_assets' ),
				'param_name' => 'active_bg_color',
				'std' => 'color5',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				'dependency' => Array( 'element' => 'menu_style', 'value' => array( 'border', 'background' ) ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Active Text Color', 'ishyoboy_assets' ),
				'param_name' => 'active_text_color',
				'std' => 'color4',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
		),
		$ish_global_params
	)
) );