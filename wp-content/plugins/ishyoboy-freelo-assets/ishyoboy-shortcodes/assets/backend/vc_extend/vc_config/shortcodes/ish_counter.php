<?php

vc_map( array(
	'name' => __( 'Counter', 'ishyoboy_assets' ),
	'base' => 'ish_counter',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-sort-numeric',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Counter Value', 'ishyoboy_assets' ),
				'param_name' => 'el_text',
				'value' => __( '2000', 'ishyoboy_assets' ),
				'description' => __( 'Numeric value of the counter.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Value Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'std' => '',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
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
				'description' => __( 'Choose Text size', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => __( 'Counter Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => $ish_available_icons,
				'description' => __( 'Choose an icon which will be displayed before the counter.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Additional Text', 'ishyoboy_assets' ),
				'param_name' => 'additional_text',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Additional text after the counter.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Icon & Additional Text Color', 'ishyoboy_assets' ),
				'param_name' => 'icon_color',
				'std' => '',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Animation Duration', 'ishyoboy_assets' ),
				'param_name' => 'duration',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Time duration in seconds for the counter to animate from "0" to the counter value. Default is "1" second.', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshDefaultView',
) );