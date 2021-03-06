<?php

vc_map( array(
	'name' => __( 'Portfolio Links', 'ishyoboy_assets' ),
	'base' => 'ish_portfolio_prev_next',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'description' => __( 'Prev/Next Links', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-briefcase',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Previous Text', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => '',
				'param_name' => 'prev_text',
				'value' => '',
				'description' => sprintf ( __( 'Leave empty to use the default text: %s', 'ishyoboy_assets' ), __( 'Older project &gt;', 'ishyoboy_assets' ) ),
				//'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Next Text', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => '',
				'param_name' => 'next_text',
				'value' => '',
				'description' => sprintf ( __( 'Leave empty to use the default text: %s', 'ishyoboy_assets' ), __( '&lt; Newer project', 'ishyoboy_assets' ) ),
				//'admin_label' => true,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color5',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'std' => 'color4',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Add Border', 'ishyoboy_assets' ),
				'param_name' => 'border',
				'std' => 'no',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => 'yes',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'description' => __( 'To have bordered buttons, remove the background color and set the text color.', 'ishyoboy_assets' ),
			),

		),
		$ish_global_params
	)
) );