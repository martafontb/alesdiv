<?php

/*
vc_remove_param( 'vc_column', 'el_class' );
vc_remove_param( 'vc_column_inner', 'el_class' );
*/

$setting = array (
	'js_view' => 'IshVcColumnView',
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Content Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Force first position on mobile devices', 'ishyoboy_assets' ),
				'param_name' => 'show_as_first',
				'value' => array(
					'No' => '',
					'Yes' => 'yes',
				),
				'description' => __( 'Move this column on first place when viewed on responsive layout.', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	)
);

// Remove the "bottom_margin" option
foreach ( $setting['params'] as $key => $param ){
	if ( 'bottom_margin' == $param['param_name'] ){
		unset( $setting['params'][ $key] );
	}
}

vc_map_update('vc_column', $setting);

$setting = array (
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Content Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Force first position on mobile devices', 'ishyoboy_assets' ),
				'param_name' => 'show_as_first',
				'value' => array(
					'No' => '',
					'Yes' => 'yes',
				),
				'description' => __( 'Move this column on first place when viewed on responsive layout.', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	)
);

// Remove the "bottom_margin" option
foreach ( $setting['params'] as $key => $param ){
	if ( 'bottom_margin' == $param['param_name'] ){
		unset( $setting['params'][ $key] );
	}
}

vc_map_update('vc_column_inner', $setting);