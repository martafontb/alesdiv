<?php

vc_map( array(
	'name' => __( 'Icon', 'ishyoboy_assets' ),
	'base' => 'ish_icon',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-heart',
	//'admin_enqueue_js' => array( ISHFREELOTHEME_SC_PLUGIN_URI . '/assets/backend/js/vc_shortcodes/' . 'ish_icon' . '.js' ),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => __( 'Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'std' => 'ish-icon-home',
				'value' => $ish_available_icons_no_empty,
				'description' => __( 'Choose an icon.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Type', 'ishyoboy_assets' ),
				'param_name' => 'type',
				'admin_label' => true,
				'value' => array(
					__( 'Simple', 'ishyoboy_assets' ) => 'simple',
					__( 'Square', 'ishyoboy_assets' ) => 'square',
					__( 'Circle', 'ishyoboy_assets' ) => 'circle',
					__( 'Hexagon', 'ishyoboy_assets' ) => 'hexagon',
					__( 'Hexagon Rounded', 'ishyoboy_assets' ) => 'hexagon_rounded',
				),
				//'description' => __( '', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Background Glow', 'ishyoboy_assets' ),
				'param_name' => 'bg_glow',
				'value' => Array(
					__( 'No Glow', 'ishyoboy_assets' ) => '',
					__( 'With Glow', 'ishyoboy_assets' ) => 'yes',
				),
				'description' => __( 'Adds a glow to the background of the icon.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => array( 'square', 'circle', 'hexagon', 'hexagon_rounded' ) ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Size', 'ishyoboy_assets' ),
				'param_name' => 'size',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Number - icon size in pixels', 'ishyoboy_assets' ),
			),

			array(
				'type' => 'textfield',
				'heading' => __( 'Width', 'ishyoboy_assets' ),
				'param_name' => 'width',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Number - icon width in pixels. Use if the icon should be wider than taller.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => 'simple' ), // Take into consideration width only if icon type is simple - change template code if logic changed
			),

			array(
				'type' => 'vc_link',
				'heading' => __( 'URL', 'ishyoboy_assets' ),
				'param_name' => 'url',
				'value' => '',
				//'description' => __( 'Select target URL', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshIconView',
) );