<?php

vc_map( array(
	'name' => __( 'Recent Blog Posts', 'ishyoboy_assets' ),
	'base' => 'ish_recent_posts',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	//'description' => __( 'aaa', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-article-alt',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(

		/*
		    'show_title_icon' => 'no',
			'show_media' => 'yes',
			'show_date' => 'yes',
			'show_categories' => 'yes',
			'show_read_more' => 'yes',

			'show_author' => 'no',
			'show_tags' => 'no',
			'show_comments' => 'no',

			'slideshow' => 'no',
			'autoslide' => '', //"yes" or "no"
			'animation' => '', // "slide" or "fade"
			'interval' => '', // "slide" or "fade"
			'navigation' => '', // "slide" or "fade"

			'show_excerpt' => 'yes',
			// Negative categories added, multiple categories added

		 */

		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Visual Style', 'ishyoboy_assets' ),
				'param_name' => 'visual_style',
				'std' => 'classic',
				'value' => Array(
					__( 'Classic', 'ishyoboy_assets' ) => 'classic',
					__( 'Full-width Stripes', 'ishyoboy_assets') => 'fullwidth',
				),
				'description' => '',
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Box content', 'ishyoboy_assets' ),
				'param_name' => 'boxed_content',
				'std' => 'boxed',
				'value' => Array(
					__( 'Boxed', 'ishyoboy_assets' ) => 'boxed',
					__( 'Un-boxed', 'ishyoboy_assets') => 'unboxed',
				),
				'description' => __( 'When element placed in full-width row.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('fullwidth') ),
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Categories', 'ishyoboy_assets' ),
				'param_name' => 'category',
				'std' => '',
				'value' => $ish_post_categories,
				'description' => __( 'Comma separated list of categories to be displayed.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Exclude categories', 'ishyoboy_assets' ),
				'param_name' => 'exclude_category',
				'std' => '',
				'value' => $ish_post_categories,
				'description' => __( 'Comma separated list of categories to be excluded.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Posts Order', 'ishyoboy_assets' ),
				'param_name' => 'order',
				'admin_label' => true,
				'value' => Array(
					__( 'Latest First') => '', // DESC
					__( 'Oldest First') => 'ASC',
				),
				'description' => __( 'Which posts to display first.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Columns Count', 'ishyoboy_assets' ),
				'param_name' => 'columns',
				'admin_label' => true,
				'std' => '3',
				'value' => Array(
					'6' => 6,
					'4' => 4,
					'3' => 3,
					'2' => 2,
					'1' => 1,
				),
				'description' => __( 'Number of columns to display the posts in.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Posts Count', 'ishyoboy_assets' ),
				'param_name' => 'count',
				'value' => '3',
				'description' => __( 'Number of posts to display.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Skip', 'ishyoboy_assets' ),
				'param_name' => 'skip',
				'value' => '',
				'description' => __( 'Number of posts to skip.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Order by', 'ishyoboy_assets' ),
				'param_name' => 'order_by',
				'value' => '',
				'description' =>
					sprintf( __( 'Change the ordering criteria. Default: "date". %s', 'ishyoboy_assets' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">' . __( 'Read More in WordPress Codex', 'ishyoboy_assets' ) . '</a>' ),
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Post Format', 'ishyoboy_assets' ),
				'param_name' => 'post_format',
				'std' => '',
				'value' => $ish_post_formats,
				'description' => __( 'Filter results by post format.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Exclude Post Format', 'ishyoboy_assets' ),
				'param_name' => 'post_format_exclude',
				'std' => '',
				'value' => $ish_post_formats,
				'description' => __( 'Filter results by post format.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Post IDs', 'ishyoboy_assets' ),
				'param_name' => 'post_ids',
				'value' => '',
				'description' => __( 'Filter results by post ID. Note: you cannot combine "include" and "exclude" in the same query.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Exclude Post IDs', 'ishyoboy_assets' ),
				'param_name' => 'post_ids_exclude',
				'value' => '',
				'description' => __( 'Filter results by post ID. Note: you cannot combine "include" and "exclude" in the same query.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Post Tags', 'ishyoboy_assets' ),
				'param_name' => 'post_tags',
				'std' => '',
				'value' => $ish_post_tags,
				'description' => __( 'Filter results by post tags.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Exclude Post Tags', 'ishyoboy_assets' ),
				'param_name' => 'post_tags_exclude',
				'std' => '',
				'value' => $ish_post_tags,
				'description' => __( 'Filter results by post tags.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Post Media', 'ishyoboy_assets' ),
				'param_name' => 'show_media',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Title Icon', 'ishyoboy_assets' ),
				'param_name' => 'show_title_icon',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Date', 'ishyoboy_assets' ),
				'param_name' => 'show_date',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic', 'fullwidth') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Reading Time', 'ishyoboy_assets' ),
				'param_name' => 'show_reading_time',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic', 'fullwidth') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Comments', 'ishyoboy_assets' ),
				'param_name' => 'show_comments',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic', 'fullwidth') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Likes', 'ishyoboy_assets' ),
				'param_name' => 'show_likes',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic', 'fullwidth') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Read More Button', 'ishyoboy_assets' ),
				'param_name' => 'show_read_more',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Author', 'ishyoboy_assets' ),
				'param_name' => 'show_author',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Categories', 'ishyoboy_assets' ),
				'param_name' => 'show_categories',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic', 'fullwidth') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Tags', 'ishyoboy_assets' ),
				'param_name' => 'show_tags',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),

			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Excerpt', 'ishyoboy_assets' ),
				'param_name' => 'show_excerpt',
				'admin_label' => true,
				'value' => Array(
					__( 'Yes', 'ishyoboy_assets') => '',
					__( 'No', 'ishyoboy_assets') => 'no',
				),
				'description' => '',
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Highlight Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				//'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Highlight Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				//'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'contents_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => 'none'), $ish_theme_colors ),
				'dependency' => Array( 'element' => 'visual_style', 'value' => array('', 'classic') ),
			),
		),
		$ish_global_params
	)
) );