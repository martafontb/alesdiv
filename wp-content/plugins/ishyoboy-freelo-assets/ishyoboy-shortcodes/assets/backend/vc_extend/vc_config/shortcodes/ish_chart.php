<?php

vc_map( array(
	'name' => esc_html__( 'Chart', 'ishyoboy_assets' ),
	'base' => 'ish_chart',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( esc_html__('Content', 'js_composer'), esc_html__('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-chart-pie',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Text in the chart', 'ishyoboy_assets' ),
				'holder' => 'div',
				'param_name' => 'content',
				'value' => __( 'Text in the chart', 'ishyoboy_assets' ),
				//'description' => __( 'Text on the button.', 'ishyoboy_assets' ),
				//'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Text/Icon Size', 'ishyoboy_assets' ),
				'param_name' => 'text_size',
				'value' => '',
				'description' => __( 'Number. Font size value for the text and icon in pixels.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Percents', 'ishyoboy_assets' ),
				'param_name' => 'percent',
				'value' => '90',
				'description' => __( 'Choose what percentage the chart should show. A number from "0" to "100".', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Line Width', 'ishyoboy_assets' ),
				'param_name' => 'line_width',
				'value' => '10',
				'description' => __( 'A number representing the width of the chart line in pixels.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Size', 'ishyoboy_assets' ),
				'param_name' => 'size',
				'value' => '150',
				'description' => __( 'A number representing the size of the whole chart in pixels.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Animation Time', 'ishyoboy_assets' ),
				'param_name' => 'animation_time',
				'value' => '1',
				'description' => __( 'A number representing the length of animation in seconds.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Rounded Corners', 'ishyoboy_assets' ),
				'param_name' => 'rounded',
				'std' => '',
				'value' => Array(
					__( 'No', 'ishyoboy_assets') => '',
					__( 'Yes', 'ishyoboy_assets') => 'yes',
				),
				'description' => __( 'Should the chart line be rounded or not?', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Front Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color5',
				'value' =>  $ish_theme_colors,
				'description' => __( 'Color of the animated bar.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Back Color', 'ishyoboy_assets' ),
				'param_name' => 'back_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
				'description' => __( 'Color of the the background track.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'std' => '',
				'value' =>  array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
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
				'heading' => __( 'Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => $ish_available_icons,
				'description' => __( 'Choose an icon which will be displayed inside the button.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Icon alignment', 'ishyoboy_assets' ),
				'param_name' => 'icon_align',
				'value' => $ish_alignmment_params_reduced,
				'description' => __( 'Choose alignment for the icon', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'icon', 'not_empty' => true ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshButtonView',
) );