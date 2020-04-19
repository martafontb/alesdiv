<?php

// Default SC attributes
$defaults = array(
	'visual_style' => '',
	'boxed_content' => '',
	'category' => '',
	'exclude_category' => '',
	'order' => '',
	'columns' => '',
	'count' => '',

	'show_title_icon' => '',
	'show_media' => '',
	'show_date' => '',
	'show_categories' => '',
	'show_read_more' => '',
	'show_excerpt' => '',
	'show_likes' => '',

	'show_author' => '',
	'show_tags' => '',
	'show_comments' => '',
	'show_reading_time' => '',

	'slideshow' => 'no',
	'autoslide' => '', //"yes" or "no"
	'animation' => '', // "slide" or "fade"
	'interval' => '', // "slide" or "fade"
	'navigation' => '', // "slide" or "fade"

	'skip' => '', // Number of posts to skip
	'order_by' => '', // Change the ordering criteria, default: 'date' (http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters)
	'post_format' => '',
	'post_format_exclude' => '',
	'post_ids' => '',
	'post_ids_exclude' => '',
	'post_tags' => '',
	'post_tags_exclude' => '',
	// Negative categories added, multiple categories added

	'color' => '',
	'text_color' => '',
	'contents_color' => '',

);

global $ish_sc_count, $ish_sc_paginated_count, $ishfreelotheme_options;

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Default type of connecting multiple taxonomy "filters". Do not change this!
$tax_query = array(
	'relation' => 'AND'
);


if ( ( isset( $sc_atts['category'] ) && '' != $sc_atts['category'] ) || ( isset( $sc_atts['exclude_category'] ) && '' != $sc_atts['exclude_category'] ) ){
	// Display items from chosen categories

	$cats = explode( ',', $sc_atts['category'] );
	$neg_cats = explode( ',', $sc_atts['exclude_category'] );
	$cat_ids = array();
	$neg_cat_ids = array();

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'category' );
			if ($cat) $cat_ids[] = $cat->term_id;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'category' );
			if ($cat) $neg_cat_ids[] = $cat->term_id;

		}
	}

	if ( count( $cat_ids ) > 0 || count( $neg_cat_ids ) > 0 ){

		if ( count( $cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $cat_ids
			);
		}

		if ( count( $neg_cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $neg_cat_ids,
				'operator' => 'NOT IN'
			);
		}

	}
	else {

		$tax_query[] = array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => $cats
		);

	}

}
else{
	// Display items from all categories
	// $tax_query = array();
}

// Filter by post format
if ( ( isset( $sc_atts['post_format'] ) && '' != $sc_atts['post_format'] ) || ( isset( $sc_atts['post_format_exclude'] ) && '' != $sc_atts['post_format_exclude'] ) ){
	// Display items from chosen post formats

	if ( 'standard' == $sc_atts['post_format'] ){
		$sc_atts['post_format_exclude'] .= 'quote,video,audio,link,aside,image,chat,gallery,status';
	}

	$cats = explode( ',', $sc_atts['post_format'] );
	$neg_cats = explode( ',', $sc_atts['post_format_exclude'] );
	$cat_ids = array();
	$neg_cat_ids = array();

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', 'post-format-' . $cat_slug, 'post_format' );
			if ($cat) $cat_ids[] = $cat->term_id;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', 'post-format-' . $cat_slug, 'post_format' );
			if ($cat) $neg_cat_ids[] = $cat->term_id;

		}
	}

	if ( count( $cat_ids ) > 0 || count( $neg_cat_ids ) > 0 ){

		if ( count( $cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'post_format',
				'field' => 'id',
				'terms' => $cat_ids
			);
		}

		if ( count( $neg_cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'post_format',
				'field' => 'id',
				'terms' => $neg_cat_ids,
				'operator' => 'NOT IN'
			);
		}

	}
	else {

		$tax_query[] = array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => $cats
		);

	}

}
else {
	// Display items from all categories
	//$tax_query = array();
}

// Filter by tags
if ( ( isset( $sc_atts['post_tags'] ) && '' != $sc_atts['post_tags'] ) || ( isset( $sc_atts['post_tags_exclude'] ) && '' != $sc_atts['post_tags_exclude'] ) ){
	// Display items from chosen tags

	$cats = explode( ',', $sc_atts['post_tags'] );
	$neg_cats = explode( ',', $sc_atts['post_tags_exclude'] );
	$cat_ids = array();
	$neg_cat_ids = array();

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'post_tag' );
			if ($cat) $cat_ids[] = $cat->term_id;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'post_tag' );
			if ($cat) $neg_cat_ids[] = $cat->term_id;

		}
	}

	if ( count( $cat_ids ) > 0 || count( $neg_cat_ids ) > 0 ){

		if ( count( $cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'post_tag',
				'field' => 'id',
				'terms' => $cat_ids
			);
		}

		if ( count( $neg_cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'post_tag',
				'field' => 'id',
				'terms' => $neg_cat_ids,
				'operator' => 'NOT IN'
			);
		}

	}
	else {

		$tax_query[] = array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => $cats
		);

	}

}
else{
	// Display items from all categories
	//$tax_query = array();
}

$positive_ids = array();
$negative_ids = array();

// Filter by Post IDs
if ( ( isset( $sc_atts['post_ids'] ) && '' != $sc_atts['post_ids'] ) || ( isset( $sc_atts['post_ids_exclude'] ) && '' != $sc_atts['post_ids_exclude'] ) ){
	// Display items from chosen ids

	$cats = explode( ',', $sc_atts['post_ids'] );
	$neg_cats = explode( ',', $sc_atts['post_ids_exclude'] );

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$positive_ids[] = $cat_slug;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$negative_ids[] = $cat_slug;

		}
	}

}


$thumb_size = 'theme-large';
$grid = 'ish-grid3';

if ( is_numeric( $sc_atts['columns'] ) ){
	switch ( $sc_atts['columns'] ) {
		case '4' :
			$grid = 'ish-grid3';
			$thumb_size = 'theme-large';
			break;
		case '3' :
			$grid = 'ish-grid4';
			$thumb_size = 'theme-large';
			break;
		case '2' :
			$grid = 'ish-grid6';
			$thumb_size = 'theme-large';
			break;
		case '1' :
			$grid = 'ish-grid12';
			$thumb_size = 'theme-large';
			break;
		/*case '5' :
			$grid = 'ish-grid2';
			$thumb_size = 'theme-large';
			break;*/
		case '6' :
			$grid = 'ish-grid2';
			$thumb_size = 'theme-large';
			break;
		/*case '7' :
			$grid = 'ish-grid2';
			$thumb_size = 'theme-large';
			break;
		case '8' :
			$grid = 'ish-grid2';
			$thumb_size = 'theme-large';
			break;*/
		default :
			$grid = 'ish-grid3';
			$thumb_size = 'theme-large';
	}
}

$order = ( 'ASC' == strtoupper($sc_atts['order']) ) ? 'ASC' : 'DESC' ; // ASC OR DESC
$orderby = ( isset( $sc_atts['order_by'] ) && '' != $sc_atts['order_by'] ) ? $sc_atts['order_by'] : 'date';

$offset = ( isset( $sc_atts['skip'] ) && is_numeric( $sc_atts['skip'] ) ) ? $sc_atts['skip'] : '0';

// Get all Portfolio posts


// Note: you cannot combine post__in and post__not_in in the same query.
// https://codex.wordpress.org/Class_Reference/WP_Query
if ( count( $negative_ids ) > 0 ){

	$wpbp = new WP_Query( array(
			'post_type' =>  'post',
			'posts_per_page'  => $sc_atts['count'],
			'order' => $order,
			'orderby' => $orderby,
			'offset' => $offset,
			'post__not_in' => $negative_ids,
			'post_status' => 'publish',
			'tax_query' => $tax_query
		)
	);

}
elseif ( count( $positive_ids ) > 0 ) {
	$wpbp = new WP_Query( array(
			'post_type' =>  'post',
			'posts_per_page'  => $sc_atts['count'],
			'order' => $order,
			'orderby' => $orderby,
			'offset' => $offset,
			'post__in' => $positive_ids,
			'post_status' => 'publish',
			'tax_query' => $tax_query
		)
	);
}
else {
	$wpbp = new WP_Query(array(
			'post_type' => 'post',
			'posts_per_page' => $sc_atts['count'],
			'order' => $order,
			'orderby' => $orderby,
			'offset' => $offset,
			'post__in' => $positive_ids,
			'post__not_in' => $negative_ids,
			'post_status' => 'publish',
			'tax_query' => $tax_query
		)
	);
}

// SHORTCODE BEGIN
$return = '';

if ( $wpbp->have_posts() ) {

	$return .= '<div class="';

	// CLASSES
	$class = 'ish-sc_recent_posts ';
	$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
	$class .= ( '' != $sc_atts['visual_style'] ) ? ' ish-rp-' . esc_attr( $sc_atts['visual_style'] ) : '' ;
	$class .= ( '' != $sc_atts['boxed_content'] ) ? ' ish-rp-' . esc_attr( $sc_atts['boxed_content'] ) : '' ;
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
	$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;

	$return .= apply_filters( 'ish_sc_classes', $class, $tag );
	$return .= '"' ;

	// ID
	$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

	// STYLE
	if ( '' != $sc_atts['style'] ){
		$return .= ' style="';
		$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
		$return .= '"';
	}

	// TOOLTIP
	$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

	$return .= ' data-count="' . $sc_atts['columns'] . '"';
	$return .= '>';

	$return .= '<div class="ish-row">';

	$count = 0;

	$contents_color = ( '' != $sc_atts['contents_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['contents_color'] ) : '' ;

	while ( $wpbp->have_posts() ) {

		$wpbp->the_post();
		$count++;

		if ( $sc_atts['visual_style'] == 'fullwidth' ) {
			// Begin Full-Width Style

			$color_data = ishfreelotheme_get_color_data();

			if ('' != $sc_atts['color']) {
				$color_data['bg_class'] = ' ish-' . $sc_atts['color'];
				$color_data['bg_color'] = $sc_atts['color'];
			}
			if ('' != $sc_atts['text_color']) {
				$color_data['text_class'] = ' ish-text-' . $sc_atts['text_color'];
				$color_data['text_color'] = $sc_atts['text_color'];
			}

			$display_taglines = IshYoMetaBox::get( 'use_taglines', true, get_the_ID() );
			$tagline_1 = $tagline_2 = '';
			if ( 'true' == $display_taglines ) {
				$tagline_1 = IshYoMetaBox::get('tagline_1', true, get_the_ID() );
				$tagline_2 = IshYoMetaBox::get('tagline_2', true, get_the_ID() );
			}

			$bg_style = '';

			if ( has_post_thumbnail() ) {
				$img_id = get_post_thumbnail_id( get_the_ID() );
				$img_details = wp_get_attachment_image_src( $img_id, 'theme-large' );
				$bg_style = ' style="background-image: url(\'' . $img_details[0] . '\'); background-size: cover; background-position-y: 50%; background-position-x: 50%;"';
			}

			$return .= '<div class="' . join( ' ', get_post_class( 'wpb_row vc_row-fluid ish-row-notfull ish-row_section ish-post-' . get_the_ID() . $color_data['bg_class'] . $color_data['text_class'] ) ). '"' . $bg_style . '>';

			if ( has_post_thumbnail() ) {

				$return .= '<div class="ish-rp-img" ' . $bg_style . '></div>';

				$return .= ishfreelotheme_get_blog_overlay_div();

			}

			$return .= '<div class="ish-vc_row_inner">';

			$return .= '<div class="ish-post-content">';

			// Icon
			//$return .= '<span class="ish-post-icon"><i class="' . ishfreelotheme_get_post_format_icon() . '"></i></span>';

			// Title
			if ( 'true' == $display_taglines && ( '' != $tagline_1 ) ) {
				if ( '' != $tagline_1 ){ $return .= '<h3 class="ish-h4 ish-post-title">' . $tagline_1 . '</h3>'; }
			} else {
				$return .= '<h3 class="ish-h4 ish-post-title">' .  get_the_title() . '</h3>';
			}

			// Blog post details
			$return .= '<div class="rc-post-details">';

			$first = true;

			// Date
			if ('no' != $sc_atts['show_date']) {
				$return .= '<span class="ish-date-container">' . get_the_time(get_option('date_format')) . '</span>';
				$first = false;
			}

			// Category
			if ('no' != $sc_atts['show_categories']) {
				if ( has_category() ) {
					$return .= (!$first) ? '<span class="ish-spacer">/</span>' : '';

					$terms = get_the_terms(get_the_ID(), 'category');

					if (isset($terms) && '' != $terms) {
						$i = 0;
						foreach ($terms as $term) {
							$i++;
							$return .= $term->name;
							if (1 == $i) {
								// if ( count($terms) > $i ) { $return .= '...'; }
								break;
							}
						}
					}

					$first = false;
				}
			}

			// Likes
			if ('no' != $sc_atts['show_likes']) {
				if (function_exists( 'ishfreelotheme_get_likes')) {
					$return .= (!$first) ? '<span class="ish-spacer">/</span>' : '';
					$return .= '<span class="ish-likes-container">' . ishfreelotheme_get_likes( false, false ) . '</span>';
					$first = false;
				}
			}

			// Comments
			if ('no' != $sc_atts['show_comments']) {
				$return .= (!$first) ? '<span class="ish-spacer">/</span>' : '';
				$return .= '<span class="ish-comments-container">' . get_comments_number_text('0 ' . esc_html__('Comments', 'freelo'), '1 ' . esc_html__('Comment', 'freelo') , '% ' . esc_html__('Comments', 'freelo')) . '</span>';
				$first = false;
			}

			// Reading Time
			if ('no' != $sc_atts['show_reading_time']) {
				$reading_time = esc_html( IshYoMetaBox::get( 'post_reading_time', true, get_the_ID() ) );
				if ( $reading_time ) {
					$return .= ( ! $first ) ? '<span class="ish-spacer">/</span>' : '';
					//$return .= '<a href="' . get_the_permalink() . '">';
					$return .= '<span>';
					$return .= $reading_time . ' ';
					$return .= esc_html__( 'min. read', 'freelo' );
					$return .= '</span>';
					//$return .= '</a>';
					$first = false;
				}
			}

			$return .= '</div>'; // Post details
			$return .= '</div>'; // Post Content
			$return .= '</div>'; // Inner Row

			$return .= '<a href="' . get_permalink() . '" class="ish-rp-detail-link">';
			$return .= '</a>';

			$return .= '</div>'; // Row

		}// End Full-Width Style
		else {
			// Begin Classic Style

			$terms = get_the_terms(get_the_ID(), 'category');

			$color_data = ishfreelotheme_get_color_data();

			// set colors for media from tagline
			//$ish_tagline_text_color = ( '' != $color_data['text_class'] ) ? $color_data['text_class'] : ' ish-text-color4';
			//$ish_tagline_bg_color = ( '' != $color_data['bg_class'] ) ? $color_data['bg_class'] : ' ish-color5';

			if ('' != $sc_atts['color']) {
				$color_data['bg_class'] = ' ish-' . $sc_atts['color'];
				$color_data['bg_color'] = $sc_atts['color'];
			}
			if ('' != $sc_atts['text_color']) {
				$color_data['text_class'] = ' ish-text-' . $sc_atts['text_color'];
				$color_data['text_color'] = $sc_atts['text_color'];
			}

			// Backup if no colors
			if ('' == $color_data['bg_color']) {
				$color_data['bg_class'] = ' ish-color1';
				$color_data['bg_color'] = 'color1';
			}
			if ('' == $color_data['text_color']) {
				$color_data['text_class'] = ' ish-text-color3';
				$color_data['text_color'] = 'color3';
			}

			$return .= '<div class="ish-recent_posts_post ish-rc-post-' . get_the_ID() . ' ' . $grid . $color_data['bg_class'] . $contents_color . '">';

			$format = get_post_format();

			$post_icon = ishfreelotheme_get_post_format_icon();

			$return .= '<div class="recent_posts_post_content">';

			// Blog post media
			switch ($format) {

				case 'video':
					if ('no' != $sc_atts['show_media']) {
						ob_start();

						if ( ( 'true' == IshYoMetaBox::get('post_embedded_video', true, get_the_ID()) ) ) {
							ishfreelotheme_the_post_video( get_the_ID(), $color_data['bg_class'], $color_data['text_class'], '', true );
						}
						else {
							if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
								$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
								$return .= '<div class="main-post-image"><div class="ish-main-post-image-content" style="background-image: url(' . $img_details[0] . ');"><a href="' . get_permalink() . '"></a></div></div>';
							} else {
								$return .= '<div class="main-post-image ish-empty"><div class="ish-main-post-image-content"><a href="' . get_permalink() . '"><i class="' . $post_icon . '"></i></a></div></div>';
							}
						}

						$doc = ob_get_clean();
						$return .= str_replace(array("\r\n", "\n", "\r"), '', $doc);
					}
					break;

				case 'audio':
					if ('no' != $sc_atts['show_media']) {
						ob_start();

						if ( '' != IshYoMetaBox::get('post_audio', true, get_the_ID()) ) {
							ishfreelotheme_the_post_audio( get_the_ID(), $color_data['bg_class'], $color_data['text_class'], '', true );
						}
						else {
							if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
								$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
								$return .= '<div class="main-post-image"><div class="ish-main-post-image-content" style="background-image: url(' . $img_details[0] . ');"><a href="' . get_permalink() . '"></a></div></div>';
							} else {
								$return .= '<div class="main-post-image ish-empty"><div class="ish-main-post-image-content"><a href="' . get_permalink() . '"><i class="' . $post_icon . '"></i></a></div></div>';
							}
						}

						$doc = ob_get_clean();
						$return .= str_replace(array("\r\n", "\n", "\r"), '', $doc);
					}

					break;

				default:
					if ('no' != $sc_atts['show_media']) {
						if ((function_exists( 'has_post_thumbnail')) && (has_post_thumbnail())) {
							$img_details = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $thumb_size);
							$return .= '<div class="main-post-image"><div class="ish-main-post-image-content" style="background-image: url(' . $img_details[0] . ');"><a href="' . get_permalink() . '"></a></div></div>';
						} else {
							$return .= '<div class="main-post-image ish-empty"><div class="ish-main-post-image-content"><a href="' . get_permalink() . '"><i class="' . $post_icon . '"></i></a></div></div>';
						}
					}
			}

			// Blog title
			if ('no' != $sc_atts['show_title_icon']) {
				$return .= '<h5 class="ish-post-title"><a href="' . get_permalink() . '"><i class="' . $post_icon . '"></i>' . get_the_title() . '</a>' . '</h5>';
			} else {
				$return .= '<h5 class="ish-post-title">' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '</h5>';
			}

			// Blog post details
			$return .= '<div class="rc-post-details-top">';

			$first = true;

			if ('no' != $sc_atts['show_date']) {
				$return .= '<a href="' . get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')) . '">' . get_the_time(get_option('date_format')) . '</a> ';
				$first = false;
			}

			// Reading Time
			if ('no' != $sc_atts['show_reading_time']) {
				$reading_time = esc_html( IshYoMetaBox::get( 'post_reading_time', true, get_the_ID() ) );
				if ( $reading_time ) {
					$return .= ( ! $first ) ? '<span class="ish-spacer">/</span>' : '';
					$return .= '<a href="' . get_the_permalink() . '">';
					$return .= '<span>';
					$return .= $reading_time . ' ';
					$return .= esc_html__( 'min. read', 'freelo' );
					$return .= '</span>';
					$return .= '</a>';
					$first = false;
				}
			}

			// Comments
			if ('no' != $sc_atts['show_comments']) {
				$return .= (!$first) ? '<span class="ish-spacer">/</span>' : '';
				$return .= '<span>' . '<a href="' . get_comments_link() . '">' . get_comments_number_text('0 ' . esc_html__('Comments', 'freelo'), '1 ' . esc_html__('Comment', 'freelo') , '% ' . esc_html__('Comments', 'freelo')) . '</a>' . '</span>';
				//$return .= '<a href="' . get_comments_link() . '">' . get_comments_number() . '</a> ';
				$first = false;
			}

			// Likes
			if ('no' != $sc_atts['show_likes']) {
				if (function_exists( 'ishfreelotheme_get_likes')) {
					$return .= (!$first) ? '<span class="ish-spacer">/</span>' : '';
					$return .= ishfreelotheme_get_likes(false);
					$first = false;
				}
			}

			// Read more
			if ('no' != $sc_atts['show_read_more']) {
				$return .= (!$first) ? '<span class="ish-spacer">/</span>' : '';
				$return .= '<a href="' . get_permalink() . '">' . esc_html__('More', 'ishyoboy_assets') . '</a> ';
				$first = false;
			}

			$return .= '</div>';

			// Excerpt
			if ('no' != $sc_atts['show_excerpt']) {

				$post = get_post();

				if ( 'link' != $format && 'quote' != $format) {
					$excerpt = '';
					$excerpt = ishfreelotheme_custom_excerpt($post->post_content, 30);

					if ('' != $excerpt) {
						$return .= "\n\n" . '<div class="excerpt"><p>' . $excerpt . '</p></div>' . "\n\n";
					}
				}

				if ('link' == $format) {
					// Link data
					if ('no' != $sc_atts['show_excerpt']) {
						$return .= '<a href="' . esc_attr(ishfreelotheme_get_post_format_url()) . '" target="_blank" class="ish-button-big pt-link">' . ishfreelotheme_get_post_format_url_text() . '</a>';

						if ( has_excerpt() ){
							$excerpt = ishfreelotheme_custom_excerpt($post->post_content, 30);

							if ('' != $excerpt) {
								$return .= "\n\n" . '<div class="excerpt"><p>' . $excerpt . '</p></div>' . "\n\n";
							}
						}
					}
				}

				if ('quote' == $format) {
					// Quote data

					if ('no' != $sc_atts['show_excerpt']) {
						ob_start();
						$quote = ishfreelotheme_get_post_format_quote();
						if ('' != $quote) {
							echo '<blockquote class="post-quote-content">' . $quote;

							// Get Quote source
							$quote_source = ishfreelotheme_get_post_format_quote_source();
							if ('' != $quote_source) {

								// Get Quote URL
								$quote_url = ishfreelotheme_get_post_format_url();
								if ('' != $quote_url) {

									echo '<cite><a href="', $quote_url, '" target="_blank">', $quote_source, '</a></cite>';

								} else {

									echo '<cite>', $quote_source, '</cite>';

								}

							}

							echo '</blockquote>';
						}
						$return .= ob_get_clean();

						if ( has_excerpt() ){
							$excerpt = ishfreelotheme_custom_excerpt($post->post_content, 30);

							if ('' != $excerpt) {
								$return .= "\n\n" . '<div class="excerpt"><p>' . $excerpt . '</p></div>' . "\n\n";
							}
						}
					}
				}
			}

			// Blog post details
			$return .= '<div class="rc-post-details-bottom">';

			$first = true;

			// Author
			if ('no' != $sc_atts['show_author']) {
				$return .= '<span class="ish-by-author">' . esc_html__('By: ', 'freelo') . '</span>';
				$return .= '<span><a href="' . get_author_posts_url(get_the_ID()) . '">' . get_the_author() . '</a></span> ';
				$first = false;
			}

			// Categories
			if ('no' != $sc_atts['show_categories']) {
				if (has_category()) {
					$return .= (!$first) ? '<span class="ish-spacer">/</span>' : '';
					$return .= '<span> ';

					if (isset($terms) && '' != $terms) {
						$i = 0;
						foreach ($terms as $term) {
							$i++;
							$return .= '<a href="' . esc_attr(get_term_link($term)) . '">' . $term->name . '</a>' . " ";
							if (1 == $i) {
								// if ( count($terms) > $i ) { $return .= '...'; }
								break;
							}
						}
					}

					$return .= '</span> ';
					$first = false;
				}
			}

			// Tags
			if ('no' != $sc_atts['show_tags']) {
				if (has_tag()) {
					$terms = get_the_tags();
					$return .= (!$first) ? '<span class="ish-spacer">/</span>' : '';
					$return .= '<span> ';

					if (isset($terms) && '' != $terms) {
						$i = 0;
						foreach ($terms as $term) {
							$i++;
							$comma_separator = ( count($terms) == $i ) ? '' : ', ';
							$return .= '<a href="' . esc_attr(get_term_link($term)) . '">#' . $term->name . $comma_separator . '</a>' . " ";
							//if (1 == $i) {
								// if ( count($terms) > $i ) { $return .= '...'; }
								//break;
							//}
						}
					}

					$return .= '</span> ';
					$first = false;
				}
			}

			$return .= '</div>';

			// Read more button
			/*if ('no' != $sc_atts['show_read_more']){
				$return .=  '<a class="ish-recent_posts-read_more ish-sc_button ish-left ' . $color_data['bg_class'] . $color_data['text_class'] . '" href="' . get_permalink() . '">' . esc_html__( 'Read more', 'ishyoboy_assets') . '</a>';
			}*/

			$return .= '</div></div>';

			if (($count % $sc_atts['columns'] == 0) && ($count != $sc_atts['count']) && ($count != $wpbp->post_count)) {

				if ('yes' == $sc_atts['slideshow']) {
					$return .= '[/slide]
	                    [slide class="recent_posts_slide"]';
				} else {
					$return .= '</div><div style="clear: both;"></div><div class="ish-row">';
				}
			}
		} // End Classic Style

	}// Endwhile

	if ( 'yes' == $sc_atts['slideshow'] ){
		$return .= '[/slide][/slidable]';
	}
	else{
		$return .= '</div>';
	}

	// SHORTCODE END
	$return .= '</div>';

}

wp_reset_postdata();

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);