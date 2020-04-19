<?php

/*******************************************************************************************************************
 * Add custom meta boxes
 */
/*
add_ishyo_meta_box('slides_urls', array(
	'title'     => esc_html__('Slide Settings', 'ishyoboy_assets'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', 'slides_urls'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => esc_html__('Slide type', 'ishyoboy_assets'),
			'id' => 'slide_type',
			'default' => 'content',
			'desc' => '',//__('Choose how the lead content will be displayed. The "unboxed" version is usually used for full-width slider shortcodes.', 'ishyoboy_assets'),
			'type' => 'radio',
			'options' => array(
				'content' => esc_html__('Content', 'ishyoboy_assets'),
				'image' => esc_html__('Image', 'ishyoboy_assets'),
			)
		),
		array(
			'name' => esc_html__('Slide url link', 'ishyoboy_assets'),
			'id' => 'slide_url',
			'default' => '',
			'desc' => esc_html__('Enter the url which the slide will link to. E.g. http://www.ishyoboy.com', 'ishyoboy_assets'),
			'type' => 'text',
		),
		array(
			'name' => esc_html__('New window', 'ishyoboy_assets'),
			'id' => 'slide_url_nw',
			'default' => 'true',
			'desc' => esc_html__('Open link in a new window.', 'ishyoboy_assets'),
			'type' => 'checkbox'
		)
	)
));
*/

// Removed when shortcode portfolio_gallery was removed
/*
add_ishyo_meta_box('ishyoboy_portfolio_images_box', array(
	'title'     => esc_html__('Portfolio Gallery', 'ishyoboy_assets'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('portfolio-post'), 'ishyoboy_portfolio_images_box'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => '', //__('Upload images', 'ishyoboy_assets'),
			'id' => 'porfolio_images',
			'default' => '',
			'desc' => '',
			'type' => 'images2',
		)
	)
));
*/

add_ishyo_meta_box('ishyoboy_portfolio_settings', array(
	'title'     => esc_html__('Color Settings', 'ishyoboy_assets'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('portfolio-post'), 'ishyoboy_portfolio_settings'),
	'context'   => 'normal',
	'priority'  => 'core',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Background color', 'ishyoboy_assets' ),
			'id' => 'color',
			'default' => '',
			'desc' => esc_html__( 'Used on portfolio overview page.', 'ishyoboy_assets'),
			'type' => 'color_selector',
		),
		array(
			'name' => esc_html__( 'Text color', 'ishyoboy_assets' ),
			'id' => 'text_color',
			'default' => '',
			'desc' => esc_html__( 'Used on portfolio overview page.', 'ishyoboy_assets'),
			'type' => 'color_selector',
		),
		array(
			'name' => esc_html__('Masonry size', 'ishyoboy_assets'),
			'id' => 'masonry_size',
			'default' => '',
			'desc' => esc_html__( 'Used in Masonry Tiles overview.', 'ishyoboy_assets'),
			'type' => 'radio_random',
			'options' => array(
				'1_1' => esc_html__( '1 x 1', 'ishyoboy_assets' ),
				'1_2' => esc_html__( '1 x 2', 'ishyoboy_assets' ),
				'2_1' => esc_html__( '2 x 1', 'ishyoboy_assets' ),
				'2_2' => esc_html__( '2 x 2', 'ishyoboy_assets' ),
			)
		),
		array(
			'name' => esc_html__( 'Color Opacity', 'ishyoboy_assets' ),
			'id' => 'overview_color_opacity',
			'default' => '',
			'desc' => esc_html__( 'Overview page color opacity in %. 100 - visible, 0 - invisible. Leave empty to use default value.', 'ishyoboy_assets' ),
			'type' => 'text',
		),
	)
));