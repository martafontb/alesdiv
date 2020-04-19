<?php

$integrated_icon = vc_map_integrate_shortcode( 'ish_icon', 'i_', __( 'Icon', 'ishyoboy_assets' ),
	array(
		'exclude' => array( 'align' ),
	),
	array(
		'element' => 'add_icon',
		'value' => 'icon',
	)
);

// Change Params settings
foreach ( $integrated_icon as $key => $val ){

	// Keep "Advanced" attributes in the same group
	if ( isset( $val['group']) && ( false !== strpos( $val['group'], __( 'Advanced', 'ishyoboy_assets') ) ) ){
		$integrated_icon[ $key ]['group'] = __( 'Icon', 'ishyoboy_assets' );
	}

	// Remove admin labels
	if ( isset( $val['admin_label']) ){
		$integrated_icon[ $key ]['admin_label'] = false;
	}

}

$integrated_svg_icon = vc_map_integrate_shortcode( 'ish_svg_icon', 'svgi_', __( 'SVG Icon', 'ishyoboy_assets' ),
	array(
		'exclude' => array( 'align' ),
	),
	array(
		'element' => 'add_icon',
		'value' => 'svg',
	)
);

// Change Params settings
foreach ( $integrated_svg_icon as $key => $val ){

	// Keep "Advanced" attributes in the same group
	if ( isset( $val['group']) && ( false !== strpos( $val['group'], __( 'Advanced', 'ishyoboy_assets') ) ) ){
		$integrated_svg_icon[ $key ]['group'] = __( 'SVG Icon', 'ishyoboy_assets' );
	}

	// Remove admin labels
	if ( isset( $val['admin_label']) ){
		$integrated_svg_icon[ $key ]['admin_label'] = false;
	}
}

vc_map( array(
	'name' => __( 'Text Block & Icon', 'ishyoboy_assets' ),
	'base' => 'ish_icon_text',
	'class' => '',
	'wrapper_class' => 'clearfix',
	'show_settings_on_create' => true,
	'icon' => 'ish-icon-doc-text',
	'weight' => 1000,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'description' => __( 'A block of text with icon or SVG icon', 'ishyoboy_assets' ),
	'params' => array_merge(
		array(
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => __( 'Text', 'js_composer' ),
				'param_name' => 'content',
				'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'js_composer' )
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				//'std' => '',
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
				'heading' => __( 'Add Icon', 'ishyoboy_assets' ),
				'param_name' => 'add_icon',
				'value' => Array(
					__( 'No Icon', 'ishyoboy_assets') => '',
					__( 'Icon', 'ishyoboy_assets') => 'icon',
					__( 'SVG Icon', 'ishyoboy_assets') => 'svg',
				),
				'description' => __( 'Adds additional icon to the text', 'ishyoboy_assets' ),
			),
			array(
				// Also update in vc_row_inner
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Vertical Alignment', 'ishyoboy_assets' ),
				'param_name' => 'vertical_align',
				'value' => Array(
					__( 'Default Alignment', 'ishyoboy_assets') => '',
					__( 'Top', 'ishyoboy_assets') => 'top',
					__( 'Middle', 'ishyoboy_assets') => 'middle',
					__( 'Bottom', 'ishyoboy_assets') => 'bottom',
				),
				'description' => '', //__( '', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'add_icon', 'not_empty' => true ),
			),
		),
		$integrated_icon,
		$integrated_svg_icon,
		Array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Rearrange on Mobile devices', 'ishyoboy_assets' ),
				'param_name' => 'responsive_center',
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => __( 'Move Icon and Text in separate lines on Mobile devices.', 'ishyoboy_assets' ),
				'group' => __( 'Advanced', 'ishyoboy_assets'),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshIconTextView',
) );