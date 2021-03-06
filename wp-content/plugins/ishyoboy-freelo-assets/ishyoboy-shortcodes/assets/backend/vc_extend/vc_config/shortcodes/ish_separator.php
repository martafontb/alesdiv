<?php

vc_map( array(
	'name' => __( 'Separator', 'ishyoboy_assets' ),
	'base' => 'ish_separator',
	'class' => '',
	'show_settings_on_create' => true,
	'description' => __( 'Text or simple Line', 'ishyoboy_assets' ),
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-ellipsis', //'ish-icon-strike',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Separator Type', 'ishyoboy_assets' ),
				'param_name' => 'type',
				'value' => array(
					__( 'Simple', 'ishyoboy_assets' ) => 'simple',
					__( 'Text', 'ishyoboy_assets' ) => 'text',
				),
				'description' => __( 'Choose Separator type', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Line Style', 'ishyoboy_assets' ),
				'param_name' => 'separator_style',
				'value' => array(
					__( 'Solid', 'ishyoboy_assets' ) => 'solid',
					__( 'Double', 'ishyoboy_assets' ) => 'double',
					__( 'Dashed', 'ishyoboy_assets' ) => 'dashed',
					__( 'Dotted', 'ishyoboy_assets' ) => 'dotted',
				),
				'description' => __( 'Choose Line style of Separator', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Line Height in Pixels', 'ishyoboy_assets' ),
				'param_name' => 'height',
				'value' => '',
				'description' => __( 'Enter number to set the height of line in pixels. E.g. "1" for 1px thin line.', 'ishyoboy_assets' ),
				//'dependency' => Array( 'element' => 'type', 'value' => Array( 'simple' ) ),
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Separator Text', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => 'ish-headline',
				'param_name' => "content",
				'value' => '', //__( '', 'ishyoboy_assets' ),
				//'description' => __( 'Enter the separator text.', 'ishyoboy_assets' ),
				//'admin_label' => true,
				'dependency' => Array( 'element' => 'type', 'value' => Array( 'text' ) ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Text Size', 'ishyoboy_assets' ),
				'param_name' => 'tag_size',
				'value' => array(
					__( 'H1', 'ishyoboy_assets' ) => 'h1',
					__( 'H2', 'ishyoboy_assets' ) => 'h2',
					__( 'H3', 'ishyoboy_assets' ) => 'h3',
					__( 'H4', 'ishyoboy_assets' ) => 'h4',
					__( 'H5', 'ishyoboy_assets' ) => 'h5',
					__( 'H6', 'ishyoboy_assets' ) => 'h6',
				),
				'description' => __( 'Choose Separator size', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => Array( 'text' ) ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Text Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => Array( 'text' ) ),
			),
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => __( 'Separator Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => $ish_available_icons,
				'description' => __( 'Choose an icon which will be displayed next to the separator text.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
				'dependency' => Array( 'element' => 'type', 'value' => Array( 'text' ) ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Icon alignment', 'ishyoboy_assets' ),
				'param_name' => 'icon_align',
				'value' => $ish_alignmment_params_reduced,
				'description' => __( 'Choose alignment for the icon', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'icon', 'not_empty' => true ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'HTML Element', 'ishyoboy_assets' ),
				'param_name' => 'tag',
				'std' => 'div',
				'value' => array(
					__( 'H', 'ishyoboy_assets' ) => 'h',
					__( 'DIV', 'ishyoboy_assets' ) => 'div',
				),
				'description' => __( 'Choose DIV if the regular headline elements are not suitable due to semantic or seo reasons.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => Array( 'text' ) ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color1',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Width in %', 'ishyoboy_assets' ),
				'param_name' => 'width_percent',
				'value' => '',
				'description' => __( 'Enter number to set the percentual width. E.g. "100" for 100%.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Opacity in %', 'ishyoboy_assets' ),
				'param_name' => 'opacity_percent',
				'value' => '',
				'description' => __( 'Enter number to set the percentual opacity. E.g. "100" for 100%.', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshDefaultView',
) );