<?php

vc_map( array(
	'name' => esc_html__( 'Button', 'ishyoboy_assets' ),
	'base' => 'ish_button',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( esc_html__('Content', 'js_composer'), esc_html__('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-db-shape',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Text on the button', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => 'ish-button',
				'param_name' => 'el_text',
				'value' => esc_html__( 'Text on the button', 'ishyoboy_assets' ),
				//'description' => esc_html__( 'Text on the button.', 'ishyoboy_assets' ),
				//'admin_label' => true,
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'URL', 'ishyoboy_assets' ),
				'param_name' => 'url',
				'value' => '',
				//'description' => esc_html__( 'Select target URL', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Size', 'ishyoboy_assets' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Small', 'ishyoboy_assets' ) => 'small',
					__( 'Medium', 'ishyoboy_assets' ) => 'medium',
					__( 'Big', 'ishyoboy_assets' ) => 'big',
				),
				//'description' => esc_html__( 'Choose element size', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => esc_html__( 'Button Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => esc_html__( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => esc_html__( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color5',
				'value' => array_merge( array( esc_html__( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => esc_html__( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'std' => 'color4',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => esc_html__( 'Add Border', 'ishyoboy_assets' ),
				'param_name' => 'border',
				'value' => array(
					__( 'No', 'ishyoboy_assets' ) => '',
					__( 'Yes', 'ishyoboy_assets' ) => 'yes',
				),
				//'description' => esc_html__( 'change color of tooltip', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => esc_html__( 'Button Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => $ish_available_icons,
				'description' => esc_html__( 'Choose an icon which will be displayed inside the button.', 'ishyoboy_assets' ) . ' ' . sprintf( esc_html__( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => esc_html__( 'Icon alignment', 'ishyoboy_assets' ),
				'param_name' => 'icon_align',
				'value' => $ish_alignmment_params_reduced,
				'description' => esc_html__( 'Choose alignment for the icon', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'icon', 'not_empty' => true ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => esc_html__( 'Full-width', 'ishyoboy_assets' ),
				'param_name' => 'full_width',
				'value' => array(
					__( 'No', 'ishyoboy_assets' ) => '',
					__( 'Yes', 'ishyoboy_assets' ) => 'yes',
				),
				//'description' => esc_html__( 'change color of tooltip', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshButtonView',
) );