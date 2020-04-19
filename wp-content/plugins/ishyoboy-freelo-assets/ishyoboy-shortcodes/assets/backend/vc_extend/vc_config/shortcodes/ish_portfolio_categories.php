<?php

vc_map( array(
	'name' => __( 'Portfolio Categories', 'ishyoboy_assets' ),
	'base' => 'ish_portfolio_categories',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'description' => __( 'List of categories', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-briefcase',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Link', 'ishyoboy_assets' ),
				'param_name' => 'links',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'description' => __( 'Link categories to category pages', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Display Categories As', 'ishyoboy_assets' ),
				'param_name' => 'behavior',
				'value' => Array(
					__( 'Text only', 'ishyoboy_assets' ) => '',
					__( 'Buttons', 'ishyoboy_assets' ) => 'buttons',
				),
				//'description' => __( '', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'links', 'value' => Array( '' ) ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				'dependency' => Array( 'element' => 'behavior', 'value' => 'buttons' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Add Border', 'ishyoboy_assets' ),
				'param_name' => 'border',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'dependency' => Array( 'element' => 'behavior', 'value' => 'buttons' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Text Size', 'ishyoboy_assets' ),
				'param_name' => 'text_size',
				'value' => array(
					__( 'Regular Text', 'ishyoboy_assets' ) => '',
					__( 'H1', 'ishyoboy_assets' ) => 'h1',
					__( 'H2', 'ishyoboy_assets' ) => 'h2',
					__( 'H3', 'ishyoboy_assets' ) => 'h3',
					__( 'H4', 'ishyoboy_assets' ) => 'h4',
					__( 'H5', 'ishyoboy_assets' ) => 'h5',
					__( 'H6', 'ishyoboy_assets' ) => 'h6',
				),
				'description' => __( 'Choose the size of the text.', 'ishyoboy_assets' ),
				//'dependency' => Array( 'element' => 'behavior', 'value' => Array( '' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Categories Tilte', 'ishyoboy_assets' ),
				'param_name' => 'el_text',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Text to be displayed before the categories.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Title Color', 'ishyoboy_assets' ),
				'param_name' => 'title_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				'dependency' => array( 'element' => 'el_text', 'not_empty' => true )
			),
		),
		$ish_global_params
	)
) );