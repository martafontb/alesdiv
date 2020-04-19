<?php

vc_map( array(
	'name' => __( 'Row', 'js_composer' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'ish-icon-progress-0',
	'show_settings_on_create' => false,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'weight' => 1000,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Make row as section', 'ishyoboy_assets' ),
				'param_name' => 'section',
				'value' => Array(
					__( 'No', 'ishyoboy_assets') => '',
					__( 'Yes', 'ishyoboy_assets') => 'yes',
				),
				'description' => __( 'Adds bottom padding to the row to make it as a standalone section', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Section Type', 'ishyoboy_assets' ),
				'param_name' => 'full_width',
				'value' => Array(
					__( 'Regular', 'ishyoboy_assets' ) => '',
					__( 'Full-width', 'ishyoboy_assets' ) => 'full',
					__( 'Full-width with padding', 'ishyoboy_assets' ) => 'padding',
					__( 'Full-height - Regular', 'ishyoboy_assets' ) => 'full-height',
					__( 'Full-height - Full-width', 'ishyoboy_assets' ) => 'full-full-height',
					__( 'Full-height - Full-width with padding', 'ishyoboy_assets' ) => 'padding-full-height',
				),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
				'group' => __( 'Section Settings', 'ishyoboy_assets'),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Use Bottom Padding', 'ishyoboy_assets' ),
				'param_name' => 'padding_bottom',
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => __( 'Set "No" to remove the bottom padding and stick the content to the bottom.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'full_width', 'value' => array('', 'padding')),
				'group' => __( 'Section Settings', 'ishyoboy_assets'),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Top Decoration', 'ishyoboy_assets' ),
				'param_name' => 'top_svg',
				'value' => Array(
					__( 'No Decoration', 'ishyoboy_assets' ) => '',
				    __( 'Arrow Outside', 'ishyoboy_assets' ) => 'arrow-outside',
				    __( 'Arrow Inside', 'ishyoboy_assets' ) => 'arrow-inside',
				    __( 'Clouds Outside', 'ishyoboy_assets' ) => 'clouds-outside',
					__( 'Clouds Inside', 'ishyoboy_assets' ) => 'clouds-inside',
				    __( 'Curtain Outside', 'ishyoboy_assets' ) => 'curtain-outside',
					__( 'Curtain Inside', 'ishyoboy_assets' ) => 'curtain-inside',
				    __( 'Rounded Outside', 'ishyoboy_assets' ) => 'rounded-outside',
				    __( 'Rounded Inside', 'ishyoboy_assets' ) => 'rounded-inside',
				    __( 'Slope Left', 'ishyoboy_assets' ) => 'slope-left',
				    __( 'Slope Left with shadow', 'ishyoboy_assets' ) => 'slope-left-shadow',
				    __( 'Slope Right', 'ishyoboy_assets' ) => 'slope-right',
				    __( 'Slope Right with shadow', 'ishyoboy_assets' ) => 'slope-right-shadow',
				    __( 'Triangle Outside', 'ishyoboy_assets' ) => 'triangle-outside',
				    __( 'Triangle Inside', 'ishyoboy_assets' ) => 'triangle-inside',
				    __( 'Zigzag', 'ishyoboy_assets' ) => 'zigzag',
				),
				'description' => __( 'Adds top decoration to the section.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
				'group' => __( 'Section Settings', 'ishyoboy_assets'),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Bottom Decoration', 'ishyoboy_assets' ),
				'param_name' => 'bottom_svg',
				'value' => Array(
					__( 'No Decoration', 'ishyoboy_assets' ) => '',
					__( 'Arrow Outside', 'ishyoboy_assets' ) => 'arrow-outside',
					__( 'Arrow Inside', 'ishyoboy_assets' ) => 'arrow-inside',
					__( 'Clouds Outside', 'ishyoboy_assets' ) => 'clouds-outside',
					__( 'Clouds Inside', 'ishyoboy_assets' ) => 'clouds-inside',
					__( 'Curtain Outside', 'ishyoboy_assets' ) => 'curtain-outside',
					__( 'Curtain Inside', 'ishyoboy_assets' ) => 'curtain-inside',
					__( 'Rounded Outside', 'ishyoboy_assets' ) => 'rounded-outside',
					__( 'Rounded Inside', 'ishyoboy_assets' ) => 'rounded-inside',
					__( 'Slope Left', 'ishyoboy_assets' ) => 'slope-left',
					__( 'Slope Left with shadow', 'ishyoboy_assets' ) => 'slope-left-shadow',
					__( 'Slope Right', 'ishyoboy_assets' ) => 'slope-right',
					__( 'Slope Right with shadow', 'ishyoboy_assets' ) => 'slope-right-shadow',
					__( 'Triangle Outside', 'ishyoboy_assets' ) => 'triangle-outside',
					__( 'Triangle Inside', 'ishyoboy_assets' ) => 'triangle-inside',
					__( 'Zigzag', 'ishyoboy_assets' ) => 'zigzag',
				),
				'description' => __( 'Adds bottom decoration to the section.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
				'group' => __( 'Section Settings', 'ishyoboy_assets'),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Background Decoration', 'ishyoboy_assets' ),
				'param_name' => 'bg_svg',
				'value' => Array(
					__( 'No Decoration', 'ishyoboy_assets' ) => '',
					__( 'Glow', 'ishyoboy_assets' ) => 'glow',
					__( 'Diamonds', 'ishyoboy_assets' ) => 'diamonds',
					__( 'Triangles', 'ishyoboy_assets' ) => 'triangles',
					__( 'Squared', 'ishyoboy_assets' ) => 'squared',
					__( 'Abstract', 'ishyoboy_assets' ) => 'abstract',
					__( 'Stripes', 'ishyoboy_assets' ) => 'stripes',
				),
				'description' => __( 'Adds a glow to the background of the section if no background image is used.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
				'group' => __( 'Section Settings', 'ishyoboy_assets'),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Background Video WEBM File', 'ishyoboy_assets' ),
				'param_name' => 'bg_video_webm',
				'value' => '',
				'description' => __( 'WEBM Video File - Url of the .webm video file', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
				'group' => __( 'Section Settings', 'ishyoboy_assets'),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Background Video MP4 File', 'ishyoboy_assets' ),
				'param_name' => 'bg_video_mp4',
				'value' => '',
				'description' => __( 'MP4 Video File - For browsers which do not support WEBM format', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
				'group' => __( 'Section Settings', 'ishyoboy_assets'),
			),
			array(
				'type' => 'attach_image',
				'heading' => __('Background Video Image - Mobile Devices', 'ishyoboy_assets'),
				'param_name' => 'bg_video_image',
				'description' => __( 'Video Files are not used on Mobile devices to save bandwidth. Image fallback will be used instead.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
				'group' => __( 'Section Settings', 'ishyoboy_assets'),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
			),
			/*array(
				'type' => 'textfield',
				'heading' => __('Padding', 'ishyoboy_assets'),
				'param_name' => 'padding',
				'description' => __( 'You can use px, em, %, etc. or enter just number and it will use pixels. ', 'ishyoboy_assets')
			),
			array(
				'type' => 'textfield',
				'heading' => __('Bottom margin', 'ishyoboy_assets'),
				'param_name' => 'margin_bottom',
				'description' => __( 'You can use px, em, %, etc. or enter just number and it will use pixels. ', 'ishyoboy_assets')
			),*/
			array(
				'type' => 'textfield',
				'heading' => __( 'Background Opacity', 'ishyoboy_assets' ),
				'param_name' => 'bg_opacity',
				'value' => '', //__( '100', 'ishyoboy_assets' ),
				'description' => __( 'Number (0 - 100) representing the row opacity in %. 100 - visible, 0 - invisible.', 'ishyoboy_assets' ),
				//'admin_label' => true,
			),
			array(
				'type' => 'attach_image',
				'heading' => __('Background Image', 'ishyoboy_assets'),
				'param_name' => 'bg_image',
				'description' => ''
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Parallax Effect', 'ishyoboy_assets' ),
				'param_name' => 'parallax',
				'value' => Array(
					__( 'No', 'ishyoboy_assets') => '',
					__( 'Static', 'ishyoboy_assets') => 'static',
					__( 'Dynamic', 'ishyoboy_assets') => 'dynamic',
				),
				'description' => __( 'Adds parallax effect to the background image. The "dynamic" uses easing.', 'ishyoboy_assets' ),
				'dependency' => Array('element' => 'bg_image', 'not_empty' => true)
			),
			array(
				'type' => 'dropdown',
				'heading' => __('Background Repeat', 'ishyoboy_assets'),
				'param_name' => 'bg_image_repeat',
				'value' => array(
					__( 'Default', 'ishyoboy_assets') => '',
					__( 'Cover', 'ishyoboy_assets') => 'cover',
					__( 'Contain', 'ishyoboy_assets') => 'contain',
					__( 'No Repeat', 'ishyoboy_assets') => 'no-repeat'
				),
				'description' => '',
				'dependency' => Array('element' => 'parallax', 'value' => Array( '', 'dynamic' ))
			),
			array(
				// Also update in vc_row_inner
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Vertical Columns Align', 'ishyoboy_assets' ),
				'param_name' => 'vertical_align',
				'value' => Array(
					__( 'Default Alignment', 'ishyoboy_assets') => '',
					__( 'Top', 'ishyoboy_assets') => 'top',
					__( 'Middle', 'ishyoboy_assets') => 'middle',
					__( 'Bottom', 'ishyoboy_assets') => 'bottom',
				),
				'description' => '', //__( '', 'ishyoboy_assets' ),
				'group' => __( 'Advanced', 'ishyoboy_assets'),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Remove margin between columns', 'ishyoboy_assets' ),
				'param_name' => 'remove_column_margins',
				'value' => Array(
					__( 'No', 'ishyoboy_assets') => '',
					__( 'Yes', 'ishyoboy_assets') => 'yes',
				),
				'description' => __( 'Remove the margins between columns, so there are no gaps in between them.', 'ishyoboy_assets' ),
				'group' => __( 'Advanced', 'ishyoboy_assets'),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Center Responsive Content', 'ishyoboy_assets' ),
				'param_name' => 'center_content',
				'value' => Array(
					__( 'Use the Theme Options setting', 'ishyoboy_assets') => '',
					__( 'Yes', 'ishyoboy_assets') => 'yes',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => __( 'Manually override the Theme Options setting for centering the content in the responsive version.', 'ishyoboy_assets' ),
				//'dependency' => Array('element' => 'bg_image', 'not_empty' => true)
				'group' => __( 'Responsive', 'ishyoboy_assets'),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Switch to responsive layout:', 'ishyoboy_assets' ),
				'param_name' => 'responsive_point',
				'value' => Array(
					__( 'No', 'ishyoboy_assets') => '',
					__( '960px', 'ishyoboy_assets') => '960',
					__( '1280px', 'ishyoboy_assets') => '1280',
					// When adding new option, make sure to create media query for same value size in dynamic_responsive.php
				),
				'description' => __( 'If responsive layout is turned on, columns in this row will become 100% wide on this screen size.', 'ishyoboy_assets' ),
				'group' => __( 'Responsive', 'ishyoboy_assets'),
			),
			/*array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer'),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
			),*/
		),
		$ish_global_params
	),
	'js_view' => 'IshVcRowView'
) );

vc_map( array(
	'name' => __( 'Row', 'js_composer' ), //Inner Row
	'base' => 'vc_row_inner',
	'content_element' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'weight' => 1000,
	'show_settings_on_create' => false,
	'description' => __( 'Place content elements inside the row', 'js_composer' ),
	'params' => array_merge(
		array(
			array(
				// Also update in vc_row
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Vertical Columns Align', 'ishyoboy_assets' ),
				'param_name' => 'vertical_align',
				'value' => Array(
					__( 'Default Alignment', 'ishyoboy_assets') => '',
					__( 'Top', 'ishyoboy_assets') => 'top',
					__( 'Middle', 'ishyoboy_assets') => 'middle',
					__( 'Bottom', 'ishyoboy_assets') => 'bottom',
				),
				'description' => '', //__( '', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Remove margin between columns', 'ishyoboy_assets' ),
				'param_name' => 'remove_column_margins',
				'value' => Array(
					__( 'No', 'ishyoboy_assets') => '',
					__( 'Yes', 'ishyoboy_assets') => 'yes',
				),
				'description' => __( 'Remove the margins between columns, so there are no gaps in between them.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Switch to responsive layout:', 'ishyoboy_assets' ),
				'param_name' => 'responsive_point',
				'value' => Array(
					__( 'No', 'ishyoboy_assets') => '',
					__( '960px', 'ishyoboy_assets') => '960',
					__( '1280px', 'ishyoboy_assets') => '1280',
					// When adding new option, make sure to create media query for same value size in dynamic_responsive.php
				),
				'description' => __( 'If responsive layout is turned on, columns in this row will become 100% wide on this screen size.', 'ishyoboy_assets' ),
				'group' => __( 'Responsive', 'ishyoboy_assets'),
			),
		),
		$ish_global_params
	),
	'js_view' => 'VcRowView'
) );