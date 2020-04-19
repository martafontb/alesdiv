<?php

vc_map(
	array(
		'name' => __( 'Divider', 'ishyoboy_assets' ),
		'base' => 'ish_divider',
		'class' => '',
		'show_settings_on_create' => false,
		'description' => sprintf ( __( 'Empty %spx space', 'ishyoboy_assets' ), ISHFREELOTHEMEGAP_SMALL ),
		'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
		'icon' => 'ish-icon-minus',
		//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'weight' => 900,
		'params' => array_merge(
			array(
				array(
					'type' => 'ish_buttons_selector_full',
					'heading' => __( 'Display on Mobile Devices', 'ishyoboy_assets' ),
					'param_name' => 'show_in_mobile',
					'std' => 'yes',
					'value' => array(
						__( 'Yes', 'ishyoboy_assets' ) => 'yes',
						__( 'No', 'ishyoboy_assets' ) => 'no',
					),
					'description' => __( 'Choose weather to show or hide this element in responsive version.', 'ishyoboy_assets' ),
				),
			),
			$ish_global_params
		)
	)
);