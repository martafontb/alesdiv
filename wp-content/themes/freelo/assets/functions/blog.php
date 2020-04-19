<?php

/**
 * Checks if sidebar is used on the current page
 *
 * Checks if sidebar is used on the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @uses ishfreelotheme_get_sidebar_position()
 *
 * @param integer $post_id The ID of the current post or page
 * @return bool
 */
if ( ! function_exists( 'ishfreelotheme_blog_categories' ) ) {
	function ishfreelotheme_blog_categories( $post_id = null ){
		global $ishfreelotheme_options;

		$return = '';

		if ( isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options['show_blog_categories'] ) && '1' == $ishfreelotheme_options['show_blog_categories'] ){
			$return .= '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-section-filter"><div class="ish-vc_row_inner">';

			$return .= '<div class="ish-sc-element ish-sc_headline ish-center ish-h4">' . esc_html__( 'Categories', 'freelo' ) . '</div>';

			$args = array(
				'hierarchical'       => 0,
				'title_li'           => '',
				'show_option_none'   => '',
				'echo'               => 0,
			);

			$return .= '<nav><ul>';

			if ( 'page' == get_option('show_on_front') ) { $all_url = apply_filters( 'ishfreelotheme_sc_url', get_permalink( get_option('page_for_posts' ) ) ); }
			else { $all_url = site_url(); }

			$active_class = ( is_category() ) ? '': ' current-cat';

			$return .= '<li class="ish-all' . $active_class . '"><a href="' . $all_url . '" class="ish-all-link">' . esc_html__( 'All', 'freelo' ) . '</a></li>';
			$return .= wp_list_categories( $args );
			$return .= '</ul></nav>';
			$return .= '<div class="ish-sc_separator ish-separator-text ish-separator-double ish-separator-home-categories">
							<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
						</div>';

			$return .= '</div></div>';
		}

		return $return;
	}
}

/**
 * Outputs Blog Categories selector
 *
 * Outputs Blog Categories selector pre-styled for the Taglines section
 *
 * @return string
 */
if ( ! function_exists( 'ishfreelotheme_blog_taglines_categories' ) ) {
	function ishfreelotheme_blog_taglines_categories(){
		global $ishfreelotheme_options;

		$return = '';

		if ( isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options['show_blog_categories'] ) && '1' == $ishfreelotheme_options['show_blog_categories'] ){
			$return .= '<div class="ish-taglines-filter">';

			$return .= '<div class="ish-sc-element ish-sc_headline ish-left ish-h3"><span class="ish-icon ish-left"><span class="ish-icon-menu"></span></span>' . esc_html__( 'Categories', 'freelo' ) . '</div>';

			$args = array(
				'hierarchical'       => 0,
				'title_li'           => '',
				'show_option_none'   => '',
				'echo'               => 0,
			);

			$return .= '<nav><ul>';

			if ( 'page' == get_option('show_on_front') ) { $all_url = apply_filters( 'ishfreelotheme_sc_url', get_permalink( get_option('page_for_posts' ) ) ); }
			else { $all_url = site_url(); }

			$active_class = ( is_category() ) ? '': ' current-cat';

			$return .= '<li class="ish-all' . $active_class . '"><a href="' . $all_url . '" class="ish-all-link">' . esc_html__( 'All', 'freelo' ) . '</a></li>';
			$return .= wp_list_categories( $args );
			$return .= '</ul></nav>';

			$return .= '</div>';
		}

		return $return;
	}
}

/**
 * Checks if masonry size set in blog post and generates the necessary classes for the masonry overview page
 *
 * @return bool
 */
if ( ! function_exists( 'ishfreelotheme_get_blog_masonry_size_classes' ) ) {
	function ishfreelotheme_get_blog_masonry_size_classes(){
		global $post, $ishfreelotheme_options;

		$return = '';
		if ( isset($ishfreelotheme_options['blog_masonry_layout_style']) && 'tiles' == $ishfreelotheme_options['blog_masonry_layout_style'] ){
			$masonry_size = IshYoMetaBox::get('masonry_size', true, get_the_ID() );
			if ( empty( $masonry_size ) ){ $masonry_size = '1_1'; }
			$m_size = explode( '_', $masonry_size );
			$return .= ' ish-bpm-w' . $m_size[0] . ' ish-bpm-h' . $m_size[1];
		}

		return $return;
	}
}


/**
 * Retrieve protected post password form content.
 *
 * @since 1.0.0
 *
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 * @return string HTML content for password form for password protected post.
 */
if ( ! function_exists( 'ishfreelotheme_get_the_password_form_filter' ) ) {
	function ishfreelotheme_get_the_password_form_filter($post = 0)
	{
		$post = get_post($post);
		$label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
		$output = '
		<h3 class="ish-sc-element ish-sc_headline ish-center ish-color5">' . esc_html__( 'Password protected content', 'freelo' ) . '</h3>
		<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" class="post-password-form ish-color3 ish-text-color1 ish-bg-text-color1 ish-button-bg-color5 ish-button-text-color4" method="post">
		<p>' . esc_html__( 'This content is password protected.', 'freelo' ) . '<br>' . esc_html__( 'To view it please enter your password below:', 'freelo' ) . '</p>
		<div class="ish-sc-element ish-sc_divider"></div>
		<div>
			<div class="ish-grid2"></div>
			<div class="ish-grid4"><input name="post_password" id="' . $label . '" type="password" size="20" placeholder="' . esc_attr( esc_html__( 'Password:', 'freelo' ) ) . '" /></label></div>
			<div class="ish-grid4"><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'freelo' ) . '" /></div>
			<div class="ish-grid2"></div>
		</div>
		</form>
	';


		/**
		 * Filter the HTML output for the protected post password form.
		 *
		 * If modifying the password field, please note that the core database schema
		 * limits the password field to 20 characters regardless of the value of the
		 * size attribute in the form input.
		 *
		 * @since 2.7.0
		 *
		 * @param string $output The password form HTML output.
		 */
		return $output;
	}
}
add_filter( 'the_password_form', 'ishfreelotheme_get_the_password_form_filter' );

/**
 * Returns the length of the excerpt based on the masonry grid item size
 *
 * @param string $mas_classes The string containing masonry grid size classes generated by ishfreelotheme_get_blog_masonry_size_classes()
 *
 * @return integer length
 */
if ( ! function_exists( 'get_masonry_excerpt_length' ) ) {
	function get_masonry_excerpt_length( $mas_classes, $has_image = false ){

		if ( !empty( $mas_classes ) ){
			if ( false !== strpos($mas_classes, '-w2') ){
				if ( false !== strpos($mas_classes, '-h2') ){
					// 2x2
					$excerpt_length = 55;
				}else{
					// 2x1
					$excerpt_length = ( $has_image ) ? 30 : 55;
				}
			}else{
				if ( false !== strpos($mas_classes, '-h2') ){
					// 1x2
					$excerpt_length = ( $has_image ) ? 15 : 55;
				}else{
					// 1x1
					$excerpt_length = ( $has_image ) ? 10 : 15;
				}
			}
		}
		else{
			$excerpt_length = 55;
		}

		return $excerpt_length;
	}
}


if ( ! function_exists( 'ishfreelotheme_get_masonry_post_thumbnail' ) ) {
	function ishfreelotheme_get_masonry_post_thumbnail(){
		global $post;

		$return = '';

		if ( has_post_thumbnail() ) {
			$return = '<div class="ish-blog-post-media">';

			// POST THUMBNAIL URL
			$thumb_size = 'theme-large';
			$img_details = '';
			$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
			$return .= '<a href="' . get_permalink() . '" style="background-image: url(\'' . $img_details[0] . '\');">';
			$return .= get_the_post_thumbnail( get_the_ID(), $thumb_size );
			$return .= '</a>';

			$return .= '</div>';
		}

		return $return;

	}
}

if ( ! function_exists( 'ishfreelotheme_get_2columns_post_thumbnail' ) ) {
	function ishfreelotheme_get_2columns_post_thumbnail(){
		global $post;

		$return = '';

		if ( has_post_thumbnail() ) {
			$return = '<div class="ish-blog-image-content">';

			// POST THUMBNAIL URL
			$thumb_size = 'theme-large';
			$img_details = '';
			$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
			$return .= '<a href="' . get_permalink() . '">';
			$return .= get_the_post_thumbnail( get_the_ID(), $thumb_size );
			$return .= '</a>';

			$return .= '</div>';
		}

		return $return;

	}
}
