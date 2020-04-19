<?php

vc_map( array(
	'name' => __( 'Portfolio', 'ishyoboy_assets' ),
	'base' => 'ish_portfolio',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	//'description' => __( 'aaa', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-briefcase',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(

			array(
				'type' => 'dropdown',
				'heading' => __( 'Portfolio Layout', 'ishyoboy_assets' ),
				'param_name' => 'layout',
				'value' => Array(
					__( 'Regular - 4:3 rectangles', 'ishyoboy_assets') => '',
					__( 'Regular - 16:9 rectangles', 'ishyoboy_assets') => 'rectangle16',
					__( 'Regular - 1:1 squares', 'ishyoboy_assets') => 'square',
					__( 'Masonry Regular - Various heights based on image size', 'ishyoboy_assets') => 'masonry-regular',
					__( 'Masonry Tiles - As set in Item detail - 1x1, 1x2, 2x1, 2x2', 'ishyoboy_assets') => 'masonry-tiles',
					__( 'Masonry Grid - 1x1 squares, first item 2x2', 'ishyoboy_assets') => 'masonry-grid',
				),
				'description' => __( 'Display items with different heights and widths.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Open on click', 'ishyoboy_assets' ),
				'param_name' => 'open_type',
				'admin_label' => true,
				'value' => Array(
					__( 'Detail Page', 'ishyoboy_assets') => '',
					__( 'Pop-up window with image', 'ishyoboy_assets') => 'image',
				),
				'description' => __( 'Define what to open after a user clicks on a portfolio item.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Pop-up Window Content', 'ishyoboy_assets' ),
				'param_name' => 'popup_content',
				'value' => Array(
					__( 'Featured Image', 'ishyoboy_assets') => '',
					__( 'Portfolio Gallery Images', 'ishyoboy_assets') => 'gallery'
				),
				'description' => __( 'Choose which images should appear in the pop-up window.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'open_type', 'value' => array('image') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Display Image Captions', 'ishyoboy_assets' ),
				'param_name' => 'use_captions',
				'std' => 'yes',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => 'yes',
					__( 'No', 'ishyoboy_assets' ) => 'no',

				),
				'description' => __( 'Display image captions in the pop-up window.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'open_type', 'value' => array('image') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Animation', 'ishyoboy_assets' ),
				'param_name' => 'animation',
				'admin_label' => true,
				'value' => Array(
					__( 'Zoom In', 'ishyoboy_assets') => '', // zoomin - Default is zoomin
					__( 'Zoom In & Rotate', 'ishyoboy_assets') => 'zoomin-rotate',
					__( '3D Flip', 'ishyoboy_assets') => 'flip',
					__( '3D Cube', 'ishyoboy_assets') => '3dcube',
				),
				'description' => __( 'Animation style on mouse over.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Text Animation', 'ishyoboy_assets' ),
				'param_name' => 'text_animation',
				'admin_label' => true,
				'value' => Array(
					__( 'Vertical', 'ishyoboy_assets') => '', // none - Default is zoomin
					__( 'Horizontal', 'ishyoboy_assets') => 'horizontal',
				),
				'description' => __( 'Text animation on mouse over.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'animation', 'value' => array('', 'zoomin-rotate') ),
			),
			array(
				//'type' => 'dropdown',
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Animation Direction', 'ishyoboy_assets' ),
				'param_name' => 'direction',
				'admin_label' => true,
				'value' => Array(
					__( 'Left', 'ishyoboy_assets') => '', // left - default is left
					__( 'Right', 'ishyoboy_assets') => 'right',
					__( 'Top', 'ishyoboy_assets') => 'top',
					__( 'Bottom', 'ishyoboy_assets') => 'bottom',
				),
				'description' => __( 'Direction of the animation on mouse over.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'animation', 'value' => array('flip', '3dcube') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Display on Mouse Over', 'ishyoboy_assets' ),
				'param_name' => 'inverse',
				'admin_label' => true,
				'value' => Array(
					__( 'Title & Category', 'ishyoboy_assets') => '',
					__( 'Image', 'ishyoboy_assets') => 'inverse',
				),
				'description' => __( 'Direction of the animation on mouse over.', 'ishyoboy_assets' )
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Categories', 'ishyoboy_assets' ),
				'param_name' => 'category',
				'std' => '',
				'value' => $ish_portfolio_categories,
				'description' => __( 'Comma separated list of categories to be displayed.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Exclude categories', 'ishyoboy_assets' ),
				'param_name' => 'exclude_category',
				'std' => '',
				'value' => $ish_portfolio_categories,
				'description' => __( 'Comma separated list of categories not to be excluded.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Display Filter', 'ishyoboy_assets' ),
				'param_name' => 'filter',
				'admin_label' => true,
				'value' => Array(
					__( 'No filter', 'ishyoboy_assets') => '',
					__( 'Fade', 'ishyoboy_assets') => 'fade',
					__( 'Fade & Reorganize', 'ishyoboy_assets') => 'organize',
					__( 'Link to category page', 'ishyoboy_assets') => 'link',
				),
				'description' => __( 'Categories buttons for users to filter the items.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Filter Title', 'ishyoboy_assets' ),
				'param_name' => 'filter_title',
				'value' => '',
				'description' => __( 'The title displayed above the filters.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'filter', 'not_empty' => true ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Filter Behavior:', 'ishyoboy_assets' ),
				'param_name' => 'filter_behavior',
				'value' => Array(
					__( 'Show selected categories only (if empty - show root/top level)', 'ishyoboy_assets') => 'top-level',
					__( 'Show sub-categories (if empty - show root/top level)', 'ishyoboy_assets') => 'sub-level',
				),
				'description' => __( 'What shall the filter display.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'filter', 'not_empty' => true ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Filter Active Background Color', 'ishyoboy_assets' ),
				'param_name' => 'filter_color',
				'std' => '',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				'dependency' => Array( 'element' => 'filter', 'not_empty' => true ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Filter Active Text Color', 'ishyoboy_assets' ),
				'param_name' => 'filter_text_color',
				'std' => '',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				'dependency' => Array( 'element' => 'filter', 'not_empty' => true ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Filter Alignment', 'ishyoboy_assets' ),
				'param_name' => 'filter_align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'filter', 'not_empty' => true ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Items Order', 'ishyoboy_assets' ),
				'param_name' => 'order',
				'admin_label' => true,
				'value' => Array(
					__( 'Latest First') => '', // DESC
					__( 'Oldest First') => 'ASC',
				),
				'description' => __( 'Which Portfolio items to display first.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Pagination', 'ishyoboy_assets' ),
				'param_name' => 'pagination',
				'admin_label' => true,
				'value' => Array(
					__( 'No') => '',
					__( 'Yes', 'ishyoboy_assets') => 'yes',
				),
				'description' => __( 'Display Pagination under the portfolio. If more portfolios are displayed on one page, ony the first will have pagination displayed.', 'ishyoboy_assets' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Items Count', 'ishyoboy_assets' ),
				'param_name' => 'per_page',
				'value' => '',
				'description' => __( 'Number of items to display (items per page if pagination active).', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Columns Count', 'ishyoboy_assets' ),
				'param_name' => 'columns',
				'admin_label' => true,
				'std' => 2,
				'value' => Array(
					'8' => 8,
					'7' => 7,
					'6' => 6,
					'5' => 5,
					'4' => 4,
					'3' => 3,
					'2' => 2,
				),
				'description' => __( 'Number of columns to display in the Portfolio Grid', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Categories', 'ishyoboy_assets' ),
				'param_name' => 'show_categories',
				'admin_label' => true,
				'value' => Array(
					__( 'No', 'ishyoboy_assets') => '',
					__( 'Yes', 'ishyoboy_assets') => 'yes',
				),
				'description' => __( 'Display item category on mouse over.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Border Width', 'ishyoboy_assets' ),
				'param_name' => 'border_width',
				'value' => '5', // if changed then change and portfolio shortcode inline otput as well
				'description' => __( 'Width in pixels to add a transparent border to each portfolio item. Set "0" to remove it completely.', 'ishyoboy_assets' )
			),

		),
		$ish_global_params
	)
) );