<?php

/*******************************************************************************************************************
 * Add custom meta boxes
 */

// Reading time
add_ishyo_meta_box('post_settings', array(
	'title'     => esc_html__( 'Post Settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'post_settings'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Reading Time', 'freelo' ),
			'id' => 'post_reading_time',
			'desc' => esc_html__( 'Minutes necessary to read the article.', 'freelo' ),
			'type' => 'text'
		)
	)
));


add_ishyo_meta_box('iyb_meta_post_link', array(
	'title'     => esc_html__( 'Link settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'iyb_meta_post_link'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => esc_html__( 'URL', 'freelo' ),
			'id' => 'post_url',
			'desc' => esc_html__( 'Add an URL link.', 'freelo' ),
			'type' => 'text'
		),
		array(
			'name' => esc_html__( 'Link Text', 'freelo' ),
			'id' => 'post_url_text',
			'desc' => esc_html__( 'Add text for the URL link.', 'freelo' ),
			'type' => 'text'
		)
	)
));

add_ishyo_meta_box('iyb_meta_post_quote', array(
	'title'     => esc_html__( 'Quote settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'iyb_meta_post_quote'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Quote', 'freelo' ),
			'id' => 'post_quote',
			'desc' => esc_html__( 'Add a quote', 'freelo' ),
			'type' => 'textarea'
		),
		array(
			'name' => esc_html__( 'Quote Source', 'freelo' ),
			'id' => 'post_quote_source',
			'desc' => esc_html__( 'Add the quote source', 'freelo' ),
			'type' => 'text'
		),
		array(
			'name' => esc_html__( 'URL', 'freelo' ),
			'id' => 'post_quote_url',
			'desc' => esc_html__( 'Add an external URL', 'freelo' ),
			'type' => 'text'
		)
	)
));

add_ishyo_meta_box('iyb_meta_post_audio', array(
	'title'     => esc_html__( 'Audio settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'iyb_meta_post_audio'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Adio file URL', 'freelo' ),
			'id' => 'post_audio',
			'default' => '',
			'desc' => esc_html__( 'Please enter the URL of the audio file.', 'freelo' ),
			'type' => 'text'
		)
	)
));

add_ishyo_meta_box('iyb_meta_post_video', array(
	'title'     => esc_html__( 'Video settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('post'), 'iyb_meta_post_video'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Embedded or Selfhosted video', 'freelo' ),
			'id' => 'post_embedded_video',
			'default' => 'true',
			'desc' => esc_html__( 'Use embedded video.', 'freelo' ),
			'type' => 'checkbox',
		),
		array(
			'name' => esc_html__( 'URL or Embedded Code', 'freelo' ),
			'id' => 'post_video',
			'desc' => esc_html__( 'Enter the URL or embed code of Vimeo.com or YouTube.com streaming services.', 'freelo' ) . '<br>' . esc_html__( 'To get the code, go to the external video page, click "share" button and copy the Embed code.', 'freelo' ),
			'type' => 'textarea'
		),
		array(
			'name' => esc_html__( 'MP4 file URL', 'freelo' ),
			'id' => 'post_video_mp4',
			'default' => '',
			'desc' => esc_html__( 'Please enter the URL of the .mp4 video file.', 'freelo' ),
			'type' => 'text'
		),
		array(
			'name' => esc_html__( 'WebM file URL', 'freelo' ),
			'id' => 'post_video_webm',
			'default' => '',
			'desc' => esc_html__( 'Please enter the URL of the .webm video file.', 'freelo' ),
			'type' => 'text'
		),
		array(
			'name' => esc_html__( 'Poster image', 'freelo' ),
			'id' => 'post_video_poster',
			'default' => '',
			'desc' => esc_html__( 'Please enter the URL of the poster image file.', 'freelo' ),
			'type' => 'text',
			'std' => ''
		),
	)
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishfreelotheme_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

add_ishyo_meta_box('taglines_settings', array(
	'title'     => esc_html__( 'Title/Taglines Area Settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'taglines_settings'),
	'context'   => 'after_title',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Hide Title', 'freelo' ),
			'id' => 'hide_title',
			'default' => 'false',
			'desc' => esc_html__( 'Hide Tile/Taglines Area when viewing detail (single) page.', 'freelo' ),
			'type' => 'checkbox',
		),
		array(
			'name' => esc_html__( 'Tile Position', 'freelo' ),
			'id' => 'title_area_style',
			'default' => '',
			'desc' => '',
			'type' => 'radio',
			'options' => Array(
				'' => esc_html__( 'Default (Theme Options)', 'freelo' ),
				'left' => esc_html__( 'Left aligned', 'freelo' ),
				'box' => esc_html__( 'Centered box', 'freelo' ),
			),
		),
		array(
			'name' => esc_html__( 'Replace Tile', 'freelo' ),
			'id' => 'use_taglines',
			'default' => 'false',
			'desc' => esc_html__( 'Use custom taglines instead of the title.', 'freelo' ),
			'type' => 'checkbox',
		),
		array(
			'name' => esc_html__( 'Main Tagline', 'freelo' ),
			'id' => 'tagline_1',
			'default' => '',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'text',
		),
		array(
			'name' => esc_html__( 'Sub Tagline', 'freelo' ),
			'id' => 'tagline_2',
			'default' => '',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'text',
		),
		array(
			'name' => esc_html__( 'Additional Text', 'freelo' ),
			'id' => 'tagline_additional',
			'default' => '',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'textarea',
		),
		array(
			'name' => esc_html__( 'BG Image', 'freelo' ),
			'id' => 'use_bg_image',
			'default' => 'false',
			'desc' => esc_html__( 'Use featured image as a background for the Title/Taglines area.', 'freelo' ),
			'type' => 'checkbox',
		),
		array(
			'name' => esc_html__( 'Image Parallax', 'freelo' ),
			'id' => 'bg_image_parallax',
			'default' => '',
			'desc' => '',
			'type' => 'radio',
			'options' => Array(
				'' => esc_html__( 'No parallax', 'freelo' ),
				'static' => esc_html__( 'Static', 'freelo' ),
				'dynamic' => esc_html__( 'Dynamic', 'freelo' ),
			),
		),
		array(
			'name' => esc_html__( 'Custom Colors', 'freelo' ),
			'id' => 'use_colors',
			'default' => 'false',
			'desc' => esc_html__( 'Use custom colors in the Title/Taglines Area.', 'freelo' ),
			'type' => 'checkbox',
		),
		array(
			'name' => esc_html__( 'BG color', 'freelo' ),
			'id' => 'title_color',
			'default' => '',
			'desc' => '', //  esc_html__( 'Used in Taglines and Full-width overview page.', 'freelo' ),
			'type' => 'color_selector',
		),
		array(
			'name' => esc_html__( 'Text color', 'freelo' ),
			'id' => 'title_text_color',
			'default' => '',
			'desc' => '', //  esc_html__( 'Used in Taglines and Full-width overview pages.', 'freelo' ),
			'type' => 'color_selector',
		),
		array(
			'name' => esc_html__( 'Color Opacity', 'freelo' ),
			'id' => 'title_color_opacity',
			'default' => '',
			'desc' => esc_html__( 'Number (0 - 100) in %. 100 - visible, 0 - invisible. Leave empty to use default value.', 'freelo' ),
			'type' => 'text',
		),

	)
));

$pages_arr = array('post');
add_ishyo_meta_box('ishyoboy_color_settings', array(
	'title'     => esc_html__( 'Color Settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'ishyoboy_color_settings'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Background color', 'freelo' ),
			'id' => 'color',
			'default' => '',
			'desc' => esc_html__( 'Used on overview page.', 'freelo' ),
			'type' => 'color_selector',
		),
		array(
			'name' => esc_html__( 'Text color', 'freelo' ),
			'id' => 'text_color',
			'default' => '',
			'desc' => esc_html__( 'Used on overview page.', 'freelo' ),
			'type' => 'color_selector',
		),
		array(
			'name' => esc_html__( 'Color Opacity', 'freelo' ),
			'id' => 'overview_color_opacity',
			'default' => '',
			'desc' => esc_html__( 'Overview page color opacity in %. 100 - visible, 0 - invisible. Leave empty to use default value.', 'freelo' ),
			'type' => 'text',
		),
	)
));

/*
$pages_arr = array('page');
if ( ishfreelotheme_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

add_ishyo_meta_box('ishyoboy_color_settings', array(
	'title'     => esc_html__( 'Color Settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'ishyoboy_color_settings'),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Background color', 'freelo' ),
			'id' => 'color',
			'default' => '',
			'desc' => esc_html__( 'Used in Taglines area.', 'freelo' ),
			'type' => 'color_selector',
		),
		array(
			'name' => esc_html__( 'Text color', 'freelo' ),
			'id' => 'text_color',
			'default' => '',
			'desc' => esc_html__( 'Used in Taglines area.', 'freelo' ),
			'type' => 'color_selector',
		)
	)
));*/

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishfreelotheme_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

add_ishyo_meta_box('page_settings', array(
	'title'     => esc_html__( 'Page Settings', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'page_settings'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Show breadcrumbs:', 'freelo' ),
			'id' => 'show_breadcrumbs',
			'default' => '',
			'desc' => esc_html__( 'To show/hide the breadcrumbs on all pages go to ', 'freelo' ) . '<a href="' . admin_url('themes.php?page=optionsframework') . '" target="_blank">Theme Options</a>',
			'type' => 'select',
			'options' => array(
				''		            => esc_html__( 'Default setting', 'freelo' ),
				//'none'              => esc_html__( 'Hide', 'freelo' ),
				//'breadcrumbs'       => esc_html__( 'Show', 'freelo' ),

				'none'              => esc_html__( 'None', 'freelo' ),
				'breadcrumbs'       => esc_html__( 'Breadcrumbs only', 'freelo' ),
				'icons'             => esc_html__( 'Social Icons only', 'freelo' ),
				'breadcrumbs-icons' => esc_html__( 'Breadcrumbs & Social Icons', 'freelo' ),
			)
		),
		array(
			'name' => esc_html__( 'Page Boxed / Unboxed layout:', 'freelo' ),
			'id' => 'boxed_layout',
			'default' => '',
			'desc' => esc_html__( 'To change the layout of the whole website go to ', 'freelo' ) . '<a href="' . admin_url('themes.php?page=optionsframework') . '" target="_blank">Theme Options</a>',
			'type' => 'select',
			'options' => array(
				''		    => esc_html__( 'Default setting', 'freelo' ),
				'boxed'		=> esc_html__( 'Boxed', 'freelo' ),
				'unboxed'	=> esc_html__( 'Unboxed', 'freelo' ),
			)
		)
	)
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishfreelotheme_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

/* // MOVED TO CPT
add_ishyo_meta_box('slides_urls', array(
	'title'     => esc_html__( 'Slide Settings', 'freelo' ),
	'pages'		=> array('slides'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Slide type', 'freelo' ),
			'id' => 'slide_type',
			'default' => 'content',
			'desc' => '',//  esc_html__( 'Choose how the lead content will be displayed. The "unboxed" version is usually used for full-width slider shortcodes.', 'freelo' ),
			'type' => 'radio',
			'options' => array(
				'content' => esc_html__( 'Content', 'freelo' ),
				'image' => esc_html__( 'Image', 'freelo' ),
			)
		),
		array(
			'name' => esc_html__( 'Slide url link', 'freelo' ),
			'id' => 'slide_url',
			'default' => '',
			'desc' => esc_html__( 'Enter the url which the slide will link to. E.g. http://www.ishyoboy.com', 'freelo' ),
			'type' => 'text',
		),
		array(
			'name' => esc_html__( 'New window', 'freelo' ),
			'id' => 'slide_url_nw',
			'default' => 'true',
			'desc' => esc_html__( 'Open link in a new window.', 'freelo' ),
			'type' => 'checkbox'
		)
	)
));
*/

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishfreelotheme_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

// Page Header options
add_ishyo_meta_box('header', array(
	'title'     => esc_html__( 'Header', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'header'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Header Colors Style', 'freelo' ),
			'id' => 'header_colors',
			'default' => '',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'select',
			'options' => array(
				''		    => esc_html__( 'Default Style', 'freelo' ),
				'alternative'	=> esc_html__( 'Alternative Style', 'freelo' ),
			),
		),
	)
));

$pages_arr = array('page');

// Page Main Navigation options
add_ishyo_meta_box('mainnav', array(
	'title'     => esc_html__( 'Main Navigation', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'mainnav'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Navigation Position', 'freelo' ),
			'id' => 'mainnav_pos',
			'default' => '',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'select',
			'options' => array(
				''		    => esc_html__( 'Default setting', 'freelo' ),
				'center'	=> esc_html__( 'Center', 'freelo' ),
				'left'		=> esc_html__( 'Left', 'freelo' ),
				'right'		=> esc_html__( 'Right', 'freelo' ),
			),
		),
		array(
			'name' => esc_html__( 'Navigation Menu', 'freelo' ),
			'desc' => '',
			'id' => 'mainnav_menu',
			'default' => '',
			'type' => 'menu_select'
		),
		array(
			'name' => esc_html__( 'Side Navigation Sidebar', 'freelo' ),
			'desc' => '',
			'id' => 'mainnav_sidebar',
			'default' => 'sidebar-sidenav',
			'type' => 'sidebar_select'
		)
	)
));


$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishfreelotheme_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

// Page, Blog & Portfolio Sidebars
add_ishyo_meta_box('blog_sidebars', array(
	'title'     => esc_html__( 'Sidebar', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'blog_sidebars'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Sidebar position', 'freelo' ),
			'id' => 'sb_pos',
			'default' => '',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'select',
			'options' => array(
				''		    => esc_html__( 'Default setting', 'freelo' ),
				'none'		=> esc_html__( 'No Sidebar', 'freelo' ),
				'left'		=> esc_html__( 'Left', 'freelo' ),
				'right'		=> esc_html__( 'Right', 'freelo' ),
			),
		),
		array(
			'name' => esc_html__( 'Sidebar', 'freelo' ),
			'desc' => '', //  esc_html__( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'freelo' ),
			'id' => 'sidebar',
			'default' => '',
			'type' => 'sidebar_select'
		)
	)
));


/*
$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishfreelotheme_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

// Expandable header
add_ishyo_meta_box('expandable_header', array(
	'title'     => 'Expandable header',
	'pages'		=> $pages_arr,
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Make header expandable:', 'freelo' ),
			'id' => 'use_header_sidebar',
			'default' => '',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'select',
			'options' => array(
				''		=> 'Default setting',
				'0'		=> 'Disable',
				'1'		=> 'Enable'
			)
		),
		array(
			'name' => esc_html__( 'Use expandable sidebar:', 'freelo' ),
			'id' => 'header_sidebar',
			'default' => '',
			'type' => 'sidebar_select'
		),
		array(
			'name' => esc_html__( 'Defaulf expandable state:', 'freelo' ),
			'id' => 'header_sidebar_on',
			'default' => '0',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'select',
			'options' => array(
				'0'		=> 'Closed',
				'1'		=> 'Opened'
			)
		)
	)
));
/**/


$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishfreelotheme_woocommerce_plugin_active() ){
	$pages_arr[] = 'product';
}

// Footer widget area
add_ishyo_meta_box('footer_widgets', array(
	'title'     => esc_html__( 'Footer Widget Area', 'freelo' ),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', $pages_arr, 'footer_widgets'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => esc_html__( 'Footer widget area:', 'freelo' ),
			'id' => 'use_fw_area',
			'default' => '',
			'desc' => '', //  esc_html__( '', 'freelo' ),
			'type' => 'select',
			'options' => array(
				''		=> esc_html__( 'Default setting', 'freelo' ),
				'0'		=> esc_html__( 'Disable', 'freelo' ),
				'1'		=> esc_html__( 'Enable', 'freelo' ),
			)
		),
		array(
			'name' => esc_html__( 'Use footer sidebar:', 'freelo' ),
			'id' => 'footer_sidebar',
			'default' => 'sidebar-footer',
			'type' => 'sidebar_select'
		),
	)
));

/* // MOVED TO CPT
add_ishyo_meta_box('portfolio_images_box', array(
	'title'     => esc_html__( 'Portfolio Gallery', 'freelo' ),
	'pages'		=> array('portfolio-post'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => '', //  esc_html__( 'Upload images', 'freelo' ),
			'id' => 'porfolio_images',
			'default' => '',
			'desc' => '',
			'type' => 'images2',
		)
	)
));*/