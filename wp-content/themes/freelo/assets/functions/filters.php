<?php

/**
 * Filter which handles the classes for "part_content"
 *
 * Checks if sidebar is used on the current page based on the local (page) settings and global (Theme Options)
 * setting
 *
 * @uses ishfreelotheme_has_sidebar()
 *
 * @param string $classes
 *
 * @return string - The modified classes
 */
if ( ! function_exists( 'ishfreelotheme_part_content_classes' ) ) {
	function ishfreelotheme_part_content_classes( $classes, $id = null ){
		global $ishfreelotheme_id_404;

		if ( is_404() ){
			$id = $ishfreelotheme_id_404;
		}

		if ( ishfreelotheme_has_sidebar( $id ) ){
			$classes .= ' ish-with-sidebar';
		} else {
			$classes .= ' ish-without-sidebar';
		}

		return $classes;
	}
}

if ( ! function_exists( 'ishfreelotheme_the_content_home_separator' ) ) {
	function ishfreelotheme_the_content_home_separator( $content ){

		global $ish_last_row_html;

		if ( is_home() && ! empty($content) ) {

			// Ensure no error will occur
			if ( !isset($ish_last_row_html) || empty($ish_last_row_html)){ $ish_last_row_html = ''; }

			// Find the first HTML tag end
			$last_row_closing_pos = strpos( $ish_last_row_html, '>');

			if ( is_numeric( $last_row_closing_pos ) ){

				// Other content added after the last row (maybe from a plugin or filter) - show separator in this case
				$check_pos  = strrpos( $content, $ish_last_row_html);
				if ( is_numeric( $check_pos ) && ( $check_pos + strlen($ish_last_row_html) + 1  < strlen($content) ) ){
					return $content;
				}

				// Section
				$check_pos = strpos( $ish_last_row_html, 'ish-row_section');
				if ( is_numeric( $check_pos ) && ($check_pos < $last_row_closing_pos) ){
					return $content;
				}

				// Background Color
				$check_pos = strpos( $ish_last_row_html, 'ish-color');
				if ( is_numeric( $check_pos ) && ($check_pos < $last_row_closing_pos) ){
					return $content;
				}

				// Background Image
				$check_pos = strpos( $ish_last_row_html, 'background-image:');
				if ( is_numeric( $check_pos ) && ($check_pos < $last_row_closing_pos) ){
					return $content;
				}

				// Manual Background Color
				$check_pos = strpos( $ish_last_row_html, 'background-color:');
				if ( is_numeric( $check_pos ) && ($check_pos < $last_row_closing_pos) ){
					return $content;
				}

				// Video BG
				$check_pos = strpos( $ish_last_row_html, 'ish-videobg');
				if ( is_numeric( $check_pos ) && ($check_pos < $last_row_closing_pos) ){
					return $content;
				}

				// Top SVG Decoration
				$check_pos = strpos( $ish_last_row_html, 'ish-row-svg-top');
				if ( is_numeric( $check_pos ) && ($check_pos < $last_row_closing_pos) ){
					return $content;
				}

				// BG SVG Decoration
				$check_pos = strpos( $ish_last_row_html, 'ish-row-svg-bg');
				if ( is_numeric( $check_pos ) && ($check_pos < $last_row_closing_pos) ){
					return $content;
				}
			}

			$separator =    '<div class="ish-sc_separator ish-separator-text ish-separator-double ish-separator-home">
							<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
						</div>';
			$pos = strrpos($content, '</div></div>');
			$content_before = substr( $content, 0, $pos );
			$content_after = substr( $content, $pos );

			$content = $content_before . $separator . $content_after;

		}

		return $content;

	}
}

$ish_content_opened = false;

if ( ! function_exists( 'ishfreelotheme_the_content_line_open' ) ) {
	function ishfreelotheme_the_content_line_open( $content ){

		// Wrap the non-visual-composer content into a row
		if ( ( ( is_singular() || is_home() ) && is_main_query() ) ) {

			if ( false === strpos( $content, 'wpb_row' ) && '' != $content ){
				// if [vc_row] shortcode has not been used
				$content = '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection"><div class="ish-vc_row_inner">' . $content . '</div></div>';
			}
		}

		// Prepare opening and closing tags for content entered by external plugins which will be closed later
		return '</div></div>' . $content . '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-maybe-empty"><div class="ish-vc_row_inner">';
	}
}

if ( ! function_exists( 'ishfreelotheme_the_content_line_close' ) ) {
	function ishfreelotheme_the_content_line_close( $content ){
		$detect_before = '</div></div>';
		$detect_after = '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-maybe-empty"><div class="ish-vc_row_inner">';
		$insert_before = str_replace( 'ish-maybe-empty', 'ish-maybe-empty ish-decor-padding-0 ', $detect_after );

		$length_before = strlen( $detect_before );
		$length_after = strlen( $detect_after );

		$content_start =  substr( $content, 0, strlen( $detect_before ) );
		$content_end =  substr( $content, -1 * ( strlen( $detect_after ) ) );

		if ( $detect_before == $content_start ) {
			$content = substr( $content, $length_before, strlen( $content ) );
		} else{
			$content = $insert_before . $content;
		}

		if ( $detect_after == $content_end ) {
			$content = substr( $content, 0, strlen( $content ) - $length_after );
		} else{
			$content = $content . $detect_before;
		}

		// Close the wrappers which were opened in the "ishfreelotheme_the_content_line_open" function
		return $content;
	}
}

if ( ! function_exists( 'ishfreelotheme_taglines_separator' ) ) {
	function ishfreelotheme_taglines_separator( $content ){

		global $ishfreelotheme_options, $ish_show_taglines_separator;

		// No Breadcrumbs
		if ( isset($ish_show_taglines_separator) && false == $ish_show_taglines_separator ){
			return $content;
		}

		// Taglines and Content different colors
		if ( $ishfreelotheme_options['tagline_colors']['bg'] != $ishfreelotheme_options['body_color'] ){
			return $content;
		}

		// Taglines Pattern set
		if ( 1 == $ishfreelotheme_options['use_lead_pattern'] && '' != $ishfreelotheme_options['lead_bg_pattern'] ){
			return $content;
		}

		// Taglines BG Image set
		if ( 0 == $ishfreelotheme_options['use_lead_pattern'] && '' != $ishfreelotheme_options['lead_bg_image'] ){
			return $content;
		}

		$first_row_closing_pos = strpos( $content, '>');

		if ( is_numeric( $first_row_closing_pos ) ){

			// Section
			$check_pos = strpos( $content, 'ish-row_section');
			if ( is_numeric( $check_pos ) && ($check_pos < $first_row_closing_pos) ){
				return $content;
			}

			// Background Color
			$check_pos = strpos( $content, 'ish-color');
			if ( is_numeric( $check_pos ) && ($check_pos < $first_row_closing_pos) ){
				return $content;
			}

			// Background Image
			$check_pos = strpos( $content, 'background-image:');
			if ( is_numeric( $check_pos ) && ($check_pos < $first_row_closing_pos) ){
				return $content;
			}

			// Manual Background Color
			$check_pos = strpos( $content, 'background-color:');
			if ( is_numeric( $check_pos ) && ($check_pos < $first_row_closing_pos) ){
				return $content;
			}

			// Video BG
			$check_pos = strpos( $content, 'ish-videobg');
			if ( is_numeric( $check_pos ) && ($check_pos < $first_row_closing_pos) ){
				return $content;
			}

			// Top SVG Decoration
			$check_pos = strpos( $content, 'ish-row-svg-top');
			if ( is_numeric( $check_pos ) && ($check_pos < $first_row_closing_pos) ){
				return $content;
			}

			// BG SVG Decoration
			$check_pos = strpos( $content, 'ish-row-svg-bg');
			if ( is_numeric( $check_pos ) && ($check_pos < $first_row_closing_pos) ){
				return $content;
			}


		}

		$separator = '<div class="wpb_row vc_row-fluid ish-row-notfull ish-resp-centered ish-row_section ish-taglines-separator-row" style=""><div class="ish-vc_row_inner">
	<div class="vc_col-sm-12 wpb_column column_container" style="">
		<div class="wpb_wrapper">
			<div class="ish-sc_separator ish-separator-text ish-separator-double ish-taglines-separator"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div>
		</div>
	</div>
</div></div>';

		$ish_show_taglines_separator = false;

		$content = $separator . $content;

		// Close the wrappers which were opened in the "ishfreelotheme_the_content_line_open" function
		return $content;
	}
}



if ( ! function_exists( 'ishfreelotheme_the_content_remove_decor_padding_classes' ) ) {
	function ishfreelotheme_the_content_remove_decor_padding_classes( $content ){

		global $ishfreelotheme_rows_replace;
		$content = str_replace( $ishfreelotheme_rows_replace , '', $content );

		return $content;
	}
}

if ( ! function_exists( 'ishfreelotheme_tag_cloud_buttonize' ) ) {
	function ishfreelotheme_tag_cloud_buttonize( $content, $args ){
		//xdebug_var_dump( $args );
		return $content;
	}
}

if ( ! function_exists( 'ishfreelotheme_mime_types' ) ) {
	function ishfreelotheme_mime_types( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}

if ( ! function_exists( 'ishfreelotheme_add_video_wmode_transparent' ) ) {
	function ishfreelotheme_add_video_wmode_transparent( $html, $url, $attr ) {
		if ( strpos( $html, "<embed src=" ) !== false ) {
			return str_replace( '</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html );
		}
		elseif ( strpos ( $html, 'feature=oembed' ) !== false ) {
			return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html );
		}
		else {
			return $html;
		}
	}
}

/**
 * Make Page for posts editable again (override the WordPress 4.2 "You are currently editing the page that shows your latest posts." notice )
 */

if ( ! function_exists( 'ishfreelotheme_allow_posts_page_editing') ) {
	function ishfreelotheme_allow_posts_page_editing() {
		global $post;

		if ( isset($post) && $post->ID == get_option( 'page_for_posts' ) ) {

			// Remove notice
			//remove_action( 'edit_form_after_title', '_wp_posts_page_notice' );

			// Enable page editing
			add_post_type_support( $post->post_type, 'editor' );
		}
	}
}
add_action( 'admin_head', 'ishfreelotheme_allow_posts_page_editing', 10);


/*
 * Comments Form HTML code
 * */

if ( ! function_exists( 'ishfreelotheme_comment_form_field') ) {
	function ishfreelotheme_comment_form_field( $field ) {
		return '<div class="ish-grid4">' . $field . '</div>';
	}
}
if ( ! function_exists( 'ishfreelotheme_comment_form_before_fields') ) {
	function ishfreelotheme_comment_form_before_fields() {
		echo '<div class="ish-row">';
	}
}
if ( ! function_exists( 'ishfreelotheme_comment_form_after_fields') ) {
	function ishfreelotheme_comment_form_after_fields() {
		echo '</div>';
	}
}
if ( ! function_exists( 'ishfreelotheme_comment_form_field_comment') ) {
	function ishfreelotheme_comment_form_field_comment( $field ) {
		return '<div class="ish-row"><div class="ish-grid12">' . $field . '</div></div>';
	}
}
if ( ! function_exists( 'ishfreelotheme_comment_form_submit_field') ) {
	function ishfreelotheme_comment_form_submit_field( $field ) {
		return '<div class="ish-row"><div class="ish-grid4">' . $field . '</div><div class="ish-grid4"></div></div>';
	}
}
if ( ! function_exists( 'ishfreelotheme_comment_form_defaults') ) {
	function ishfreelotheme_comment_form_defaults( $defaults ) {
		$defaults['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />%4$s</button>';
		$defaults['submit_field'] = '%1$s %2$s';
		return $defaults;
	}
}
add_filter( 'comment_form_field_author', 'ishfreelotheme_comment_form_field');
add_filter( 'comment_form_field_url', 'ishfreelotheme_comment_form_field');
add_filter( 'comment_form_field_email', 'ishfreelotheme_comment_form_field');
add_action( 'comment_form_before_fields', 'ishfreelotheme_comment_form_before_fields' );
add_action( 'comment_form_after_fields', 'ishfreelotheme_comment_form_after_fields' );
add_filter( 'comment_form_field_comment', 'ishfreelotheme_comment_form_field_comment' );
add_filter( 'comment_form_submit_field', 'ishfreelotheme_comment_form_submit_field' );
add_filter( 'comment_form_defaults', 'ishfreelotheme_comment_form_defaults' );
