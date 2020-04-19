<?php

/**
 * Echo the breadcrumbs block
 *
 * Checks weather the breadcrumbs should be displayed and shows the part_breadcrumbs block
 *
 * @return void
 */
if ( ! function_exists( 'ishfreelotheme_show_breadcrumbs' ) ) {
	function ishfreelotheme_show_breadcrumbs( $echo = true ){

		global $ishfreelotheme_options, $ishfreelotheme_woo_id, $ishfreelotheme_id_404, $ish_show_taglines_separator;

		if ( is_404() ){
			$post_id = $ishfreelotheme_id_404;
		}
		elseif ( isset($ishfreelotheme_woo_id) ) {
			$post_id = $ishfreelotheme_woo_id;
		}else{
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		if ( is_home() ){

			if ( is_front_page() ){
				$show = '';
			}
			else{

				$home = get_post( get_option( 'page_for_posts' ) );
				if ( ! empty( $home ) ){
					$show = IshYoMetaBox::get('show_breadcrumbs', true, $home->ID );
				}
				else{
					$show = '';
				}

			}

		}elseif ( null != $post_id ){
			$show = IshYoMetaBox::get('show_breadcrumbs', true, $post_id );
		}else{
			if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
				$show = '';
			}else{
				$show = IshYoMetaBox::get('show_breadcrumbs' );
			}
		}

		if ( '' == $show ){
			// Get global options
			if ( isset( $ishfreelotheme_options['show_breadcrumbs'] ) ){
				$show = $ishfreelotheme_options['show_breadcrumbs'];
			}
		}

		if ( ( '' != $show )  &&  ( 'none' != $show )  ){

			$ish_show_taglines_separator = false;

			$return = '';
			$return .= '
			<div class="ish-part_breadcrumbs">
				<div class="ish-row ish-row-notfull">
					<div class="ish-row_inner">';

			if ( 'breadcrumbs' == $show || 'breadcrumbs-icons' == $show ) {
				$return .= ishfreelotheme_get_breadcrumbs();
			}

			if ( 'icons' == $show || 'breadcrumbs-icons' == $show  ) {
				if ( isset( $ishfreelotheme_options['social_icons'] ) && ( '' != $ishfreelotheme_options['social_icons']) && shortcode_exists('ish_icon') ) {
					$return .= '<div class="ish-pb-socials">';
					$return .= do_shortcode( $ishfreelotheme_options['social_icons'] );
					$return .= '</div>';
				}
			}

			$return .= '</div></div></div>';

			if ( $echo ){
				echo apply_filters( 'ishfreelotheme_show_breadcrumbs_output', $return );
			}
			else{
				return $return;
			}

		}

		return '';

	}
}




/**
 * Checks if first post should be featured or not
 *
 * Checks if first post should be featured or not on the current page based on the global (Theme Options)
 * blog setting
 *
 * @return bool
 */
if ( ! function_exists( 'ishfreelotheme_first_post_featured' ) ) {
	function ishfreelotheme_first_post_featured(){
		global $ishfreelotheme_options;

		if ( isset( $ishfreelotheme_options) && isset( $ishfreelotheme_options['blog_featured_post'] ) && 'first-post' == $ishfreelotheme_options['blog_featured_post'] ){
			return true;
		}

		return false;
	}
}


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
if ( ! function_exists( 'ishfreelotheme_has_sidebar' ) ) {
	function ishfreelotheme_has_sidebar( $post_id = null ){
		global $ishfreelotheme_options, $ishfreelotheme_globals;

		// Load from global "cache"
		if ( isset( $ishfreelotheme_globals[__FUNCTION__] ) ) return $ishfreelotheme_globals[__FUNCTION__];

		$sidebar_position = ishfreelotheme_get_sidebar_position( $post_id );

		if ( 'left' == $sidebar_position || 'right' == $sidebar_position){
			$ishfreelotheme_globals[__FUNCTION__] = true;
		}else{
			$ishfreelotheme_globals[__FUNCTION__] = false;
		}

		return $ishfreelotheme_globals[__FUNCTION__];
	}
}

/**
 * Return a string containing the sidebar position
 *
 * Checks the position of the sidebar for the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @param integer $post_id The ID of the current post or page
 * @return string "left", "right" or empty string if none;
 */
if ( ! function_exists( 'ishfreelotheme_get_sidebar_position' ) ) {
	function ishfreelotheme_get_sidebar_position($post_id = null){
		global $ishfreelotheme_options, $ishfreelotheme_globals;

		// Load from global "cache"
		if ( isset( $ishfreelotheme_globals[__FUNCTION__] ) ) return $ishfreelotheme_globals[__FUNCTION__];

		if ( $post_id ) {
			$id = $post_id;
		}else{
			$id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		if ( is_home() ){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$sidebar_position = isset( $meta['_ishmb_sb_pos'] ) ? $meta['_ishmb_sb_pos'][0] : '';
		}
		elseif( null != $id ){
			$sidebar_position = IshYoMetaBox::get('sb_pos', true, $id );
		}
		else{
			if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
				$sidebar_position = '';
			}
			else{
				$sidebar_position = IshYoMetaBox::get('sb_pos' );
			}
		}

		if ('' == $sidebar_position){
			// Use global settings

			if ( ( isset($ishfreelotheme_options['page_for_custom_post_type_portfolio-post']) && $id == $ishfreelotheme_options['page_for_custom_post_type_portfolio-post']) || (is_singular('portfolio-post')) || is_tax('portfolio-category')){
				// PORTFOLIO OVERVIEW
				if (isset($ishfreelotheme_options['show_portfolio_sidebar']) && '1' == $ishfreelotheme_options['show_portfolio_sidebar']){
					// Portfolio sidebar turned ON
					if (isset($ishfreelotheme_options['portfolio_sidebar_position']) && '' != $ishfreelotheme_options['portfolio_sidebar_position']){
						$sidebar_position = $ishfreelotheme_options['portfolio_sidebar_position'];
					}
					else{
						$sidebar_position = 'right';
					}
				}else{
					// Portfolio sidebar turned OFF
					$sidebar_position = '';
				}
			}else{

				if ( function_exists( 'is_woocommerce') && ( is_woocommerce() || is_woocommerce_page() ) ) {

					if (isset($ishfreelotheme_options['show_woocommerce_sidebar']) && '1' == $ishfreelotheme_options['show_woocommerce_sidebar']){
						// Sidebar ON
						if (isset($ishfreelotheme_options['woocommerce_sidebar_position']) && '' != $ishfreelotheme_options['woocommerce_sidebar_position']){
							$sidebar_position = $ishfreelotheme_options['woocommerce_sidebar_position'];
						}else{
							$sidebar_position = 'right';
						}
					}else{
						// Sidebar OFF
						$sidebar_position = '';
					}

				}
				else{

					if (is_home() || is_singular('post') || is_category() || is_tag() || is_archive() ){
						// BLOG OVERVIEW
						if (isset($ishfreelotheme_options['show_blog_sidebar']) && '1' == $ishfreelotheme_options['show_blog_sidebar']){
							// Blog sidebar turned ON
							if (isset($ishfreelotheme_options['blog_sidebar_position']) && '' != $ishfreelotheme_options['blog_sidebar_position']){
								$sidebar_position = $ishfreelotheme_options['blog_sidebar_position'];
							}
							else{
								$sidebar_position = 'right';
							}
						}
						else{
							// Blog sidebar turned OFF
							$sidebar_position = '';
						}
					}else{

						// REGULAR PAGE
						if (isset($ishfreelotheme_options['show_page_sidebar']) && '1' == $ishfreelotheme_options['show_page_sidebar']){
							// Page sidebar turned ON
							if (isset($ishfreelotheme_options['page_sidebar_position']) && '' != $ishfreelotheme_options['page_sidebar_position']){
								$sidebar_position = $ishfreelotheme_options['page_sidebar_position'];
							}
							else{
								$sidebar_position = 'right';
							}
						}
						else{
							// Page sidebar turned OFF
							$sidebar_position = '';
						}

					}
				}
			}
		}
		else{
		}

		$ishfreelotheme_globals[__FUNCTION__] = $sidebar_position;

		return $ishfreelotheme_globals[__FUNCTION__];
	}
}


/**
 * Return the current page's sidebar ID as string
 *
 * Checks which sidebar should be displayed on the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @uses ish_get_the_ID()
 *
 * @param integer $post_id; The ID of the current post or page
 *
 * @return string The ID of the sidebar which is set for the current page
 */
if ( ! function_exists( 'ishfreelotheme_get_sidebar' ) ) {
	function ishfreelotheme_get_sidebar($post_id = null){
		global $ishfreelotheme_options;

		if ( $post_id ) {
			$id = $post_id;
		}else{
			$id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$sidebar_position = isset( $meta['_ishmb_sb_pos'] ) ? $meta['_ishmb_sb_pos'][0] : '';
		}elseif( null != $id ){
			$sidebar_position = IshYoMetaBox::get('sb_pos', true, $id );
		}
		else{
			if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
				$sidebar_position = '';
			}else{
				$sidebar_position = IshYoMetaBox::get('sb_pos' );
			}
		}

		if ( '' != $sidebar_position){
			// Local settings exist
			if (is_home()){
				$sidebar = isset( $meta['_ishmb_sidebar'] ) ? $meta['_ishmb_sidebar'][0] : '';
			}else{
				$sidebar = IshYoMetaBox::get('sidebar', true, $id );
			}

		}else{
			// Use global settings
			if (( isset($ishfreelotheme_options['page_for_custom_post_type_portfolio-post']) && $id == $ishfreelotheme_options['page_for_custom_post_type_portfolio-post']) || is_singular('portfolio-post') || is_tax('portfolio-category') ){
				// PORTFOLIO OVERVIEW
				if (isset($ishfreelotheme_options['show_portfolio_sidebar']) && '1' == $ishfreelotheme_options['show_portfolio_sidebar']){
					// Portfolio sidebar set
					$sidebar = $ishfreelotheme_options['portfolio_sidebar'];
				}else{
					// Portfolio sidebar not set
					$sidebar = '';
				}
			}else{
				if ( function_exists( 'is_woocommerce') && ( is_woocommerce() || is_woocommerce_page() ) ) {

					if (isset($ishfreelotheme_options['show_woocommerce_sidebar']) && '1' == $ishfreelotheme_options['show_woocommerce_sidebar']){
						$sidebar = $ishfreelotheme_options['woocommerce_sidebar'];
					}else{
						$sidebar = '';
					}

				}
				else{

					if ( is_home() || is_singular('post') || is_category() || is_tag() || is_archive() ){
						// BLOG OVERVIEW
						if (isset($ishfreelotheme_options['show_blog_sidebar']) && '1' == $ishfreelotheme_options['show_blog_sidebar']){
							$sidebar = $ishfreelotheme_options['blog_sidebar'];
						}else{
							$sidebar = '';
						}
					}else{
						// REGULAR PAGE
						if (isset($ishfreelotheme_options['show_page_sidebar']) && '1' == $ishfreelotheme_options['show_page_sidebar']){
							$sidebar = $ishfreelotheme_options['page_sidebar'];
						}else{
							$sidebar = '';
						}
					}
				}
			}
		}
		return $sidebar;
	}
}

/**
 * Return the current page's sidenav sidebar ID as string
 *
 * Checks which sidenav sidebar should be displayed on the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @uses ish_get_the_ID()
 *
 * @param integer $post_id; The ID of the current post or page
 *
 * @return string The ID of the sidebar which is set for the current page
 */
if ( ! function_exists( 'ishfreelotheme_get_sidenav_sidebar' ) ) {
	function ishfreelotheme_get_sidenav_sidebar( $post_id = null ){
		global $ishfreelotheme_options;

		if ( $post_id ) {
			$id = $post_id;
		}else{
			$id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$sidebar_position = isset( $meta['_ishmb_mainnav_pos'] ) ? $meta['_ishmb_mainnav_pos'][0] : '';
		}elseif( null != $id ){
			$sidebar_position = IshYoMetaBox::get('mainnav_pos', true, $id );
		}
		else{
			if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
				$sidebar_position = '';
			}else{
				$sidebar_position = IshYoMetaBox::get('mainnav_pos' );
			}
		}

		if ( ( 'left' == $sidebar_position ) || ( 'right' == $sidebar_position ) ){
			// Local settings exist
			if (is_home()){
				$sidebar = isset( $meta['_ishmb_mainnav_sidebar'] ) ? $meta['_ishmb_mainnav_sidebar'][0] : '';
			}else{
				$sidebar = IshYoMetaBox::get('mainnav_sidebar', true, $id );
			}

		}else{
			// Use global settings
			if ( isset($ishfreelotheme_options['mainnav_sidebar']) ) {
				$sidebar = $ishfreelotheme_options['mainnav_sidebar'];
			}else{
				$sidebar = 'sidebar-sidenav';
			}

		}
		return $sidebar;
	}
}


/**
 * Return the content classes
 *
 * Return the content classes which will be used to position the sidebar and the content divs
 *
 * @uses ishfreelotheme_get_content_class()
 * @uses ishfreelotheme_get_sidebar_position()
 *
 * @param integer $post_id The ID of the current post or page
 *
 * @return string
 */
if ( ! function_exists( 'ishfreelotheme_get_content_class' ) ) {
	function ishfreelotheme_get_content_class($post_id = null){
		global $ishfreelotheme_options, $ishfreelotheme_globals;

		// Load from global "cache"
		if ( isset( $ishfreelotheme_globals[__FUNCTION__] ) ) return $ishfreelotheme_globals[__FUNCTION__];

		$sidebar_position = ishfreelotheme_get_sidebar_position($post_id);
		$class = '';

		switch ( $sidebar_position ){
			case 'none':
				$class = '';
				break;
			case 'left':
				$class = ' ish-pc-content ish-grid8 ish-with-sidebar ish-with-left-sidebar';
				break;
			case 'right':
				$class = ' ish-pc-content ish-grid8 ish-with-sidebar ish-with-right-sidebar';
				break;
			default :
				$class = '';
				break;
		}

		$ishfreelotheme_globals[__FUNCTION__] = $class;

		return $ishfreelotheme_globals[__FUNCTION__];
	}
}