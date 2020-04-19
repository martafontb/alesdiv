<?php

// Default SC attributes
$defaults = array(
	'open_type' => '',
	'popup_content' => '',
	'use_captions' => '',
	'animation' => '',
	'text_animation' => '',
	'direction' => '',
	'inverse' => '',
	'category' => '',
	'exclude_category' => '',
	'filter' => '',
	'filter_title' => '',
	'filter_align' => '',
	'filter_behavior' => '',
	'filter_color' => '',
	'filter_text_color' => '',
	'order' => '',
	'pagination' => '',
	'per_page' => '',
	'columns' => '',
	'layout' => '',
	'show_categories' => '',
	'border_width' => '',
);

global $ish_sc_count, $ish_sc_paginated_count, $ishfreelotheme_options;

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

$ish_sc_count++;

// Default items per page count
if ( ! is_numeric($sc_atts['per_page']) ) {
	$sc_atts['per_page'] = (isset($ishfreelotheme_options['portfolio_per_page']) && is_numeric($ishfreelotheme_options['portfolio_per_page'])) ? $ishfreelotheme_options['portfolio_per_page'] : '-1';
}

// Default type of connecting multiple taxonomy "filters". Do not change this!
$tax_query = array(
	'relation' => 'AND'
);

if ( ( isset( $sc_atts['category'] ) && '' != $sc_atts['category'] ) || ( isset( $sc_atts['exclude_category'] ) && '' != $sc_atts['exclude_category'] ) ){
	// Display items from a chosen category

	$cats = explode( ',', $sc_atts['category'] );
	$neg_cats = explode( ',', $sc_atts['exclude_category'] );
	$cat_ids = array();
	$neg_cat_ids = array();

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'portfolio-category' );
			if ($cat) $cat_ids[] = $cat->term_id;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'portfolio-category' );
			if ($cat) $neg_cat_ids[] = $cat->term_id;

		}
	}

	if ( count( $cat_ids ) > 0 || count( $neg_cat_ids ) > 0 ){

		if ( count( $cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'portfolio-category',
				'field' => 'id',
				'terms' => $cat_ids
			);
		}

		if ( count( $neg_cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'portfolio-category',
				'field' => 'id',
				'terms' => $neg_cat_ids,
				'operator' => 'NOT IN'
			);
		}

	}
	else {
		// Categories not found by slug
	}

}
else{
	// Display items from all categories
	// $tax_query = array();
}

$filter_otput = '';

if ( '' != $sc_atts['filter'] ){

	$terms = array();

	if ( '' != $sc_atts['category'] || '' != $sc_atts['exclude_category'] ){

		$cats = explode( ',', $sc_atts['category'] );
		$neg_cats = explode( ',', $sc_atts['exclude_category'] );
		$parent_ids = array();
		$neg_parent_ids = array();

		// Categories IDs list
		if ( ! empty( $cats ) ){
			foreach ( $cats as $cat_slug ){

				$cat_slug = trim( $cat_slug );
				$parent = get_term_by( 'slug', $cat_slug, 'portfolio-category' );
				if ($parent) $parent_ids[] = $parent->term_id;

			}
		}

		// Excluded Categories IDs list
		if ( ! empty( $neg_cats ) ){
			foreach ( $neg_cats as $cat_slug ){

				$cat_slug = trim( $cat_slug );
				$parent = get_term_by( 'slug', $cat_slug, 'portfolio-category' );
				if ($parent) $neg_parent_ids[] = $parent->term_id;

			}
		}

		if ( count( $parent_ids ) <= 0 ){
			// No positive category selected
			$t = array();
			$t = get_terms('portfolio-category', array(
				'parent'     => 0,
				'hide_empty' => 1,
				'hierarchical' => 0,
				'exclude' => $neg_parent_ids,
				'exclude_tree' => $neg_parent_ids,
				'taxonomy' => 'portfolio-category'
			));

			$terms = array_merge( $terms, $t);
		}
		else{
			// positive categories selected

			if ( 'top-level' == $sc_atts['filter_behavior'] ){
				// Display only the selected categories

				$t = array();
				$t = get_terms('portfolio-category', array(
					'hide_empty' => 1,
					'hierarchical' => 0,
					'include' => $parent_ids,
					'exclude' => $neg_parent_ids,
					'exclude_tree' => $neg_parent_ids,
					'taxonomy' => 'portfolio-category'
				));

				$terms = array_merge( $terms, $t);

			}
			else{
				// Display sub-categories of each selected category
				foreach ( $parent_ids as $pid ){

					$t = array();
					$t = get_terms('portfolio-category', array(
						'parent'     => $pid,
						'hide_empty' => 1,
						'hierarchical' => 0,
						'exclude' => $neg_parent_ids,
						'exclude_tree' => $neg_parent_ids,
						'taxonomy' => 'portfolio-category'
					));

					$terms = array_merge( $terms, $t);
				}

			}

		}

	}
	else{
		$terms = get_terms('portfolio-category', array(
			'parent'     => 0,
			'hide_empty' => 1,
			'hierarchical' => 1,
			'taxonomy' => 'portfolio-category'
		));
	}

	$count = count($terms);
	$i=0;
	$filter_otput = '';
	if ($count > 0) {

		$filter_classes = '';
		$f_align = ( '' != $sc_atts['filter_align'] ) ? (' ish-' . $sc_atts['filter_align'] ) : '' ;

		$f_colors = '';
		$f_colors .= ( '' != $sc_atts['filter_color'] ) ? (' ish-' . $sc_atts['filter_color'] ) : '' ;
		$f_colors .= ( '' != $sc_atts['filter_text_color'] ) ? (' ish-text-' . $sc_atts['filter_text_color'] ) : '' ;

		if ( '' != $sc_atts['filter']){
			$filter_otput .= '<div class="ish-section-filter' . $f_align . $f_colors . '"><div class="ish-vc_row_inner">';
			if ( '' != $sc_atts['filter_title'] ){
				$filter_otput .= '<div class="ish-sc-element ish-sc_headline ish-p-filter-headline ish-h4">' . $sc_atts['filter_title'] . '</div>';
			}
			$filter_otput .= '<nav class="ish-sc-element ish-p-filter' . $filter_classes . '" data-type="' . esc_attr( $sc_atts['filter'] ) . '"><ul>';
			$filter_otput .= '<li><a class="ish-active" href="#all" data-filter="*">' . esc_html__( 'All', 'ishyoboy_assets' ) . '</a></li>';
		}else{
			$filter_otput .= '<div class="ish-section-filter' . $f_align . '"><div class="ish-vc_row_inner">';
			if ( '' != $sc_atts['filter_title'] ){
				$filter_otput .= '<div class="ish-sc-element ish-sc_headline ish-p-filter-headline ish-h4">' . $sc_atts['filter_title'] . '</div>';
			}
			$filter_otput .= '<nav class="ish-sc-element ish-p-filter' . $filter_classes . '" data-type="' . esc_attr( $sc_atts['filter'] ) . '"><ul>';
		}

		$term_list = '';
		foreach ($terms  as $term) {
			$i++;
			$term_list .= '<li><a href="' . get_term_link($term->slug, 'portfolio-category') . '" data-filter=".pfilt-' . $term->slug . '">' . $term->name . '</a></li>';
			//$term_list .= '<li><a href="#pfilt-' . $term->slug . '" data-filter=".pfilt-' . $term->slug . '">' . $term->name . '</a></li>';
		}
		$filter_otput .= $term_list;
		$filter_otput .= '</ul></nav></div></div>';
	}
}

$thumb_size = 'theme-large';

$grid = 'grid3';

if ( is_numeric( $sc_atts['columns'] ) ){
	switch ( $sc_atts['columns'] ) {
		case '4' :
			$grid = 'grid3';
			$thumb_size = 'theme-large';
			break;
		case '3' :
			$grid = 'grid4';
			$thumb_size = 'theme-large';
			break;
		case '2' :
			$grid = 'grid6';
			$thumb_size = 'theme-large';
			break;
		case '1' :
			$grid = 'grid12';
			$thumb_size = 'theme-large';
			break;
		case '5' :
			$grid = 'grid2';
			$thumb_size = 'theme-large';
			break;
		case '6' :
			$grid = 'grid2';
			$thumb_size = 'theme-large';
			break;
		case '7' :
			$grid = 'grid2';
			$thumb_size = 'theme-large';
			break;
		case '8' :
			$grid = 'grid2';
			$thumb_size = 'theme-large';
			break;
		default :
			$grid = 'grid3';
			$thumb_size = 'theme-large';
	}
}

$paged = 1;

if ( ( '' != $sc_atts['pagination'] ) && is_numeric($sc_atts['per_page']) && (int)$sc_atts['per_page'] > 0 ){

	global $sc_paginated_count;

	$sc_paginated_count++;

	if ( $sc_paginated_count < 2 ){

		if ( is_front_page() ){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1;
		}
		else{
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
	}
}

$order = ('ASC' == strtoupper($sc_atts['order'])) ? 'ASC' : 'DESC' ; // ASC OR DESC

// Exclude the current post from the list when portfolio used on a single detail page
$p_not_in = Array();
$p_not_in = ( 'portfolio-post' == get_post_type( get_the_ID() ) && is_single() ) ? Array( get_the_ID() ) : Array();

// Get all Portfolio posts
$wpbp = new WP_Query( array(
		'post_type' =>  'portfolio-post',
		'posts_per_page'  => $sc_atts['per_page'],
		'paged' => $paged,
		'order' => $order,
		'post_status' => 'publish',
		'post__not_in' => $p_not_in,
		'tax_query' => $tax_query
	)
);


// SHORTCODE BEGIN
$return = '';

if ( $wpbp->have_posts() ) {

	// ANIMATION and INVERSE CLASS
	$portfolio_classes = '';
	if ( '' == $sc_atts['animation'] ) { $sc_atts['animation'] = 'zoomin'; }
	$portfolio_classes .= ' ish-p-' . $sc_atts['animation'];
	$portfolio_classes .= ( '' != $sc_atts['inverse'] ) ? '-' . $sc_atts['inverse'] : '';

	// DIRECTION for 'flip' and '3dcube' only
	if ( ( 'flip' == $sc_atts['animation'] ) || ( '3dcube' == $sc_atts['animation'] ) ){
		if ( '' == $sc_atts['direction'] ) { $sc_atts['direction'] = 'left'; }
		$portfolio_classes .=  '-' . $sc_atts['direction'];
	}

	// TEXT ANIMATION for 'zoomin' and 'zoomin-rotate' only
	if ( ( 'zoomin' == $sc_atts['animation'] ) || ( 'zoomin-rotate' == $sc_atts['animation'] ) ){
		$portfolio_classes .=  ( 'horizontal' == $sc_atts['text_animation'] ) ? ' ish-p-text-lr' : '';
	}

	// MASONRY
	if ( false  !== strpos( $sc_atts['layout'], 'masonry' ) ){
		$portfolio_classes .=  ' ish-p-packery';
	}

	$return .= '<div class="';

	// CLASSES
	$class = 'ish-sc_portfolio ';
	$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
	$class .= ( '' != $sc_atts['layout'] ) ? ' ish-layout-' . esc_attr( $sc_atts['layout'] ) : '' ;
	$class .= ( '' != $sc_atts['layout'] && false  == strpos( $sc_atts['layout'], 'masonry' ) ) ? ' ish-ratio-' . esc_attr( $sc_atts['layout'] ) : '' ;
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
	$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
	$class .= $portfolio_classes;

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

	// PRELOADER
	$return .= '<span class="ish-preloader"></span>';

	// FILTER OUTPUT
	$return .= $filter_otput;

	if ( '' == $sc_atts['border_width']){
		$sc_atts['border_width'] = 5;
	}

	$inner_style = ('' != $sc_atts['border_width']) ? ' style="width: calc( 100% + ' . esc_attr( 2 * (int)$sc_atts['border_width'] ) .'px ); margin: ' . esc_attr( -1 * (int)$sc_atts['border_width'] ) .'px;"' :  '';

	$return .= '<div class="ish-p-items-container"' . $inner_style . '>';
	$first_item = true;

	while ( $wpbp->have_posts() ) {

		$wpbp->the_post();

		$terms = get_the_terms(  get_the_ID(), 'portfolio-category' );

		$return .= '<div class="ish-p-col ';

		$first_category = '';
		$category = '';

		if ( isset( $terms ) && '' != $terms ) {
			foreach ( $terms as $term ) {
				$return .= ' pfilt-' . esc_attr( $term->slug );
				if ( '' == $category && '' == $first_category ) { $first_category = $term->name; }
				if ( '' == $category && 0 != $term->parent ) { $category = $term->name; }
			}
		}

		if ( '' == $category ){ $category = $first_category; }


		/*<?php echo ''. $cat ?> <?php echo '' . $sizesW[array_rand($sizesW)]; ?> <?php echo ''. $sizesH[array_rand($sizesH)]; ?>">';*/
		
		// Item masonry size
		if ( 'masonry-tiles' == $sc_atts['layout'] ){
			$masonry_size = IshYoMetaBox::get('masonry_size', true, get_the_ID() );
			if ( empty( $masonry_size ) ){ $masonry_size = '1_1'; }
			$m_size = explode( '_', $masonry_size );
			$return .= ' ish-p-col-w' . $m_size[0] . ' ish-p-col-h' . $m_size[1];
		}

		if ( 'masonry-grid' == $sc_atts['layout'] ){
			if ( $first_item ) {
				$masonry_size = '2_2';
				$first_item = false;
			}
			else {
				$masonry_size = '1_1';
			}
			$m_size = explode( '_', $masonry_size );
			$return .= ' ish-p-col-w' . $m_size[0] . ' ish-p-col-h' . $m_size[1];
		}

		$return .= '">';

		// POST THUMBNAIL URL
		$img_details = '';
		$img_full = '';

		// SET POP-UP WINDOW IMAGE SIZE
		$popup_size = apply_filters( 'ish_portfolio_sc_popup_image_size', 'theme-large', get_the_ID() );

		if ( has_post_thumbnail() ){
			$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
			$img_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'theme-large' );
		}

		if ( 'masonry-regular' == $sc_atts['layout'] ){
			$return .= get_the_post_thumbnail( get_the_ID() , $thumb_size );
		}

		if ( 'image' == $sc_atts['open_type'] ){

			$popup_gal = '';

			// Featured Image Only or Gallery
			switch ( $sc_atts['popup_content'] ){
				/* OLD: PORTFOLIO GALLERY SHORTCODE */
				/*
				case 'gallery' :
					// Portfolio Gallery

					$first_image = true;
					$popup_opener = '';

					$images = array_filter( explode( ',', IshYoMetaBox::get('porfolio_images', true, get_the_ID()) ) );
					if ( $images ){
						foreach ( $images as $attachment_id ) {
							if ( $first_image ){
								$popup_opener = '<a href="' . wp_get_attachment_url( $attachment_id ) . '" data-fancybox-group="portfolio-sc-' . $ish_sc_count .'-gallery-' . get_the_ID() . '" class="openfancybox-image">';
								$first_image = false;
							} else {
								$popup_gal .= '<a href="' . wp_get_attachment_url( $attachment_id ) . '" data-fancybox-group="portfolio-sc-' . $ish_sc_count .'-gallery-' . get_the_ID() . '" class="ish-popup-gal-images openfancybox-image"></a>';
							}
						}
					}

					if ( '' == $popup_opener  ){
						if ( is_array( $img_full )  ){
							$popup_opener = '<a href="' .  esc_attr($img_full[0]) . '" data-fancybox-group="portfolio-sc-' . $ish_sc_count .'-gallery-' . get_the_ID() . '" class="openfancybox-image">';
						}
						else{
							$popup_opener = '<a href="' . get_permalink() . '">';
						}
					}

					$return .= $popup_gal . $popup_opener;
					break;
				/**/

				case 'gallery' :
					// Portfolio Gallery

					$first_image = true;
					$popup_opener = '';

					$content = get_the_content();

					// Find the first ish_gallery shortcode if available
					preg_match('/\[ish_gallery.+?\]/', $content, $match_gallery);

					if ( ! empty( $match_gallery ) ){

						// Remove the opening and closing shortcode characters so 'shortcode_parse_atts' could work as expected
						$match_gallery[0]  = substr( $match_gallery[0], 1, -1);

						$gallery_attributes = shortcode_parse_atts( $match_gallery[0] );

						// Get all Image IDs
						if ( isset( $gallery_attributes['images'] ) && !empty( $gallery_attributes['images'] ) ){

							$images = array_filter( explode( ',', $gallery_attributes['images'] ) );

							$border_width = ('' != $sc_atts['border_width']) ? ' style="border-width: ' . esc_attr($sc_atts['border_width']) .'px;"' :  ' style="border-width: 5px;"';

							foreach ( $images as $attachment_id ) {

								// IMAGE CAPTION
								$img_caption = '';
								if ( 'yes' == $sc_atts['use_captions'] ) {
									$img_obj = get_post( $attachment_id );
									if ( is_object( $img_obj ) ) {
										$img_caption = $img_obj->post_excerpt;
									}
								}

								if ( $first_image ){
									$img_src = wp_get_attachment_image_src( $attachment_id, $popup_size);
									$popup_opener = '<a href="' . $img_src[0] . '" title="' . esc_attr( $img_caption ) . '" data-fancybox-group="portfolio-sc-' . $ish_sc_count .'-gallery-' . get_the_ID() . '" class="openfancybox-image"' . $border_width . '>';
									$first_image = false;
								} else {
									$img_src = wp_get_attachment_image_src( $attachment_id, $popup_size);
									$popup_gal .= '<a href="' . $img_src[0] . '" title="' . esc_attr( $img_caption ) . '" data-fancybox-group="portfolio-sc-' . $ish_sc_count .'-gallery-' . get_the_ID() . '" class="ish-popup-gal-images openfancybox-image"' . $border_width . '></a>';
								}
							}

						}

					}

					if ( '' == $popup_opener  ){

						$border_width = ('' != $sc_atts['border_width']) ? ' style="border-width: ' . esc_attr($sc_atts['border_width']) .'px;"' :  ' style="border-width: 5px;"';

						if ( is_array( $img_full )  ){

							// IMAGE CAPTION
							$img_caption = '';
							if ( 'yes' == $sc_atts['use_captions'] ) {
								$img_obj = get_post( get_post_thumbnail_id( get_the_ID() ) );
								if ( is_object( $img_obj ) ) {
									$img_caption = $img_obj->post_excerpt;
								}
							}

							$popup_opener = '<a href="' .  esc_attr($img_full[0]) . '" title="' . esc_attr( $img_caption ) . '" data-fancybox-group="portfolio-sc-' . $ish_sc_count .'-gallery-' . get_the_ID() . '" class="openfancybox-image"' . $border_width . '>';
						}
						else{
							$popup_opener = '<a href="' . get_permalink() . '"' . $border_width . '>';
						}
					}

					$return .= $popup_gal . $popup_opener;
					break;
					/**/

				default :
					// Featured Image Only

					$border_width = ('' != $sc_atts['border_width']) ? ' style="border-width: ' . esc_attr($sc_atts['border_width']) .'px;"' :  ' style="border-width: 5px;"';

					if ( is_array( $img_full )  ){

						// IMAGE CAPTION
						$img_caption = '';
						if ( 'yes' == $sc_atts['use_captions'] ) {
							$img_obj = get_post( get_post_thumbnail_id( get_the_ID() ) );
							if ( is_object( $img_obj ) ) {
								$img_caption = $img_obj->post_excerpt;
							}
						}

						$return .= '<a href="' .  esc_attr($img_full[0]) . '" title="' . esc_attr( $img_caption ) . '" data-fancybox-group="portfolio-sc-' . $ish_sc_count . '" class="openfancybox-image"' . $border_width . '>';
					}
					else{
						$return .= '<a href="' . get_permalink() . '"' . $border_width . '>';
					}
			}

		}
		else{
			$border_width = ('' != $sc_atts['border_width']) ? ' style="border-width: ' . esc_attr($sc_atts['border_width']) .'px;"' :  ' style="border-width: 5px;"';
			$return .= '<a href="' . get_permalink() . '"' . $border_width . '>';
		}

		// Image Container Begin
		$return .= '<div class="ish-p-item">';
		if ( is_array( $img_details ) ){
			$return .= '<div class="ish-p-img" style="background-image: url(\'' . $img_details[0] . '\');">';
		}
		else{
			$return .= '<div class="ish-p-img">';
		}

		$return .= '</div>';
		// Image Container End

		// Grid Item Color
		$bg_color = IshYoMetaBox::get('color', true, get_the_ID() );
		if ( empty( $bg_color ) ){ $bg_color = 'color5'; }

		// Grid Item Text Color
		$text_color = IshYoMetaBox::get('text_color', true, get_the_ID() );
		if ( empty( $text_color ) ){ $text_color = 'color4'; }

		// Color Opacity
		$color_opacity = IshYoMetaBox::get('overview_color_opacity', true, get_the_ID() );
		$color_opacity = trim(str_replace('%', '' , $color_opacity));

		$item_classes = '';

		$item_classes .= ' ish-' . $bg_color;
		$item_classes .= ' ish-text-' . $text_color;

		// Double img for color opacity layer - FLIP & 3DCUBE ONLY
		if ( ( 'flip' == $sc_atts['animation'] ) || ( '3dcube' == $sc_atts['animation'] ) && is_array( $img_details ) ){
			$return .= '<div class="ish-p-overlay' . $item_classes . '" style="background-image: url(\'' . $img_details[0] . '\');">';
		}
		else{
			$return .= '<div class="ish-p-overlay' . $item_classes . '">';
		}



		// Opacity
		$opacity_style = '';

		if ( '' != $color_opacity ){
			// Get the number
			if ( is_numeric( $color_opacity ) ){
				if ( $color_opacity > 100 ) { $color_opacity = 100; }
				else if ( $color_opacity < 0 ) { $color_opacity = 0; }
				else if ( $color_opacity > 0 && $color_opacity < 1  ) { $color_opacity = $color_opacity * 100; }
			}
			else {
				$color_opacity = '';
			}

			//
			if ( '' != $color_opacity ){
				$opacity_style = ' style="opacity: ' . ( $color_opacity / 100) . ';"';
			}
			else{
				// No opacity at all
			}
		}
		else{
			$color_opacity = ( defined('ISHFREELOTHEME_PORTFOLIO_OPACITY') ) ? ( ISHFREELOTHEME_PORTFOLIO_OPACITY / 100 ) : '0.3';
			$opacity_style = ' style="opacity: ' . $color_opacity . ';"';
		}

		//$return .= '<span' . $opacity_style . '></span>';


		$return .= '<div>';
		$return .= '<span class="ish-p-title">';
		$return .= '<span class="ish-p-box"' . $opacity_style . '>';
		$return .= '<span class="ish-p-headline">' . get_the_title() . '</span>';
		if ( 'yes' == $sc_atts['show_categories'] ) {
			$return .= '<span class="ish-p-cat">' . $category . '</span>';
		}
		$return .= '</span>';
		$return .= '</span>';
		$return .= '</div>';

		$return .= '</div>'; // ish-p-overlay close

		$return .= '</div>';
		$return .= '</a>';

		$return .= '</div>';

	}

	$return .= '</div>';

	if ( '' != $sc_atts['pagination'] && isset( $sc_paginated_count ) && ( $sc_paginated_count < 2 ) ){
		if ( $ish_pagination = ishfreelotheme_get_pagination('', 3, $wpbp->max_num_pages, $wpbp->query['paged']) ) {
			$return .= '<div class="ish-sc_separator ish-separator-text ish-separator-double ish-separator-portfolio-pagination">
							<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
						</div>';
			$return .= $ish_pagination;
		}
	}

	// SHORTCODE END
	$return .= '</div>';

}

wp_reset_postdata();

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);