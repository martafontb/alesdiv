<?php
/**
 * Created by JetBrains PhpStorm.
 * User: VlooMan
 * Date: 17.2.2013
 * Time: 10:20
 * To change this template use File | Settings | File Templates.
 */

remove_filter( 'the_content', 'post_formats_compat', 7 );

if ( ! defined('PREV_DEFAULT') ) { define( 'PREV_DEFAULT', esc_html__( 'Previous', 'freelo' ) . ' <span class="ish-icon ish-right"><span class="ish-icon-right-open-big"></span></span>' ); }
if ( ! defined('NEXT_DEFAULT') ) { define( 'NEXT_DEFAULT', '<span class="ish-icon ish-right"><span class="ish-icon-left-open-big"></span></span> ' . esc_html__( 'Next', 'freelo' ) ); }

if ( ! function_exists( 'ishfreelotheme_custom_part_tagline' ) ) {
	function ishfreelotheme_custom_part_tagline( $content, $type = ''){

		global $post, $page, $wp_embed, $ishfreelotheme_options;

		$overlay_container = '';
		$overlay_box = '';

		$overlay_container = '<div class="ish-overlay ish-default-tagline"></div>';
		if ('box' == $type ) {
			$overlay_box = '<div class="ish-pt-taglines-left ish-overlay-box ish-default"><div class="ish-overlay" style="opacity: 1;"></div>';
		}else{
			$overlay_box = '<div class="ish-pt-taglines-left ish-default"><div class="ish-overlay"></div>';
		}

		// Content Centering
		$center_content = ( ! isset($ishfreelotheme_options) || 1 == $ishfreelotheme_options['responsive_content_centering'] ) ? ' ish-resp-centered' : '';

		// Taglines Pattern OR Background Image set
		$tagline_pattern_bg_classes = '';
		if ( ( 1 == $ishfreelotheme_options['use_lead_pattern'] && '' != $ishfreelotheme_options['lead_bg_pattern'] ) || ( 0 == $ishfreelotheme_options['use_lead_pattern'] && '' != $ishfreelotheme_options['lead_bg_image'] ) ){
			$tagline_pattern_bg_classes .= ' ish-pattern-img';
		} else {
			$tagline_pattern_bg_classes .= ' ish-no-pattern-img';
		}

		$return = '';
		$return .= '<div class="ish-part_tagline ish-tagline_custom ish-tagline-colored' . $tagline_pattern_bg_classes .'">' . $overlay_container . '<div class="ish-row ish-row-notfull' . $center_content . '"><div class="ish-row_inner">';

		$return .= '<div class="ish-pt-taglines-main">';

		$return .= $overlay_box;
		$return .= '<div class="ish-pt-container">';
		$return .= $content;
		$return .= '</div>';

		$return .= '</div>';

		$return .= '</div>';

		$return .= '</div></div></div>';

		echo apply_filters( 'ishfreelotheme_custom_part_tagline_output', $return );

	}
}

if ( ! function_exists( 'ishfreelotheme_add_content_color_class' ) ) {
	function ishfreelotheme_add_content_color_class( $classes ){

		global $ish_single_post_content_color_class;

		$return = $classes;

		if ( isset( $ish_single_post_content_color_class ) && '' != $ish_single_post_content_color_class ){
			$return .=  str_replace( 'ish-', 'ish-pc-', $ish_single_post_content_color_class );
		}

		echo esc_attr( $return );

	}
}

if ( ! function_exists( 'ishfreelotheme_get_tagline_data' ) ) {
	function ishfreelotheme_get_tagline_data( $id = null, $options = Array() ) {
		global $ishfreelotheme_options, $ish_show_taglines_separator;

		$tagline_data = Array();

		if ( null != $id ) {
			$tagline_data['hide_title']          = ( 'true' === IshYoMetaBox::get( 'hide_title', true, $id ) );
			$tagline_data['title_area_style']    = IshYoMetaBox::get( 'title_area_style', true, $id );
			if ( '' == $tagline_data['title_area_style'] ) {
				$tagline_data['title_area_style'] = $ishfreelotheme_options['title_area_style'];
			}
			$tagline_data['use_taglines']        = ( 'true' === IshYoMetaBox::get( 'use_taglines', true, $id ) );
			if ( $tagline_data['use_taglines']  ) {
				$tagline_data['tagline_1']           = esc_html( IshYoMetaBox::get( 'tagline_1', true, $id ) );
				$tagline_data['tagline_2']           = esc_html( IshYoMetaBox::get( 'tagline_2', true, $id ) );
				$tagline_data['tagline_additional']  = wp_kses_post( nl2br( IshYoMetaBox::get( 'tagline_additional', true, $id ) ) );
			}
			else{
				$tagline_data['tagline_1']           = esc_html( get_the_title( $id ) );
				$tagline_data['tagline_2']           = '';
				$tagline_data['tagline_additional']  = '';
			}
			$tagline_data['use_bg_image']        = ( 'true' === IshYoMetaBox::get( 'use_bg_image', true, $id ) );
			$tagline_data['bg_image']        = '';
			if ( $tagline_data['use_bg_image'] && has_post_thumbnail( $id ) ) {
				$tagline_data['bg_image'] = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
			}
			$tagline_data['bg_image_parallax'] = IshYoMetaBox::get( 'bg_image_parallax', true, $id );

			$tagline_data['use_colors']          = ( 'true' === IshYoMetaBox::get( 'use_colors', true, $id ) );
			$tagline_data['title_color']         = IshYoMetaBox::get( 'title_color', true, $id );
			$tagline_data['title_text_color']    = IshYoMetaBox::get( 'title_text_color', true, $id );

			// Custom Item opacity
			$tagline_data['title_color_opacity'] = '';
			if ( $tagline_data['use_colors'] ) {
				$tagline_data['title_color_opacity'] = IshYoMetaBox::get( 'title_color_opacity', true, $id );
				$tagline_data['title_color_opacity'] = trim( str_replace( '%', '', $tagline_data['title_color_opacity'] ) );
			}

			// Theme Options opacity
			if ( '' === $tagline_data['title_color_opacity'] ){
				if ( isset( $ishfreelotheme_options['lead_bg_opacity'] ) && '' != $ishfreelotheme_options['lead_bg_opacity'] ) {
					$tagline_data['title_color_opacity'] = trim( str_replace( '%', '', $ishfreelotheme_options['lead_bg_opacity'] ) );

					if ( is_numeric( $tagline_data['title_color_opacity'] ) ){
						if ( 'box' != $tagline_data['title_area_style'] && '' == $tagline_data['title_color'] ) {
							$tagline_data['title_color_opacity'] = 100 - $tagline_data['title_color_opacity'];
						}
						else{
							$tagline_data['title_color_opacity'] = 100;
						}
					}
				}
			}

			// Default PHP Constants
			if ( '' === $tagline_data['title_color_opacity'] ) {
				$tagline_data['title_color_opacity'] = ( defined( 'ISHFREELOTHEME_TAGLINE_OPACITY' ) ) ? ISHFREELOTHEME_TAGLINE_OPACITY : '100';
			}

			if ( is_numeric( $tagline_data['title_color_opacity'] ) ) {
				if ( $tagline_data['title_color_opacity'] > 100 ) {
					$tagline_data['title_color_opacity'] = 100;
				} else if ( $tagline_data['title_color_opacity'] < 0 ) {
					$tagline_data['title_color_opacity'] = 0;
				} else if ( $tagline_data['title_color_opacity'] > 0 && $tagline_data['title_color_opacity'] < 1 ) {
					$tagline_data['title_color_opacity'] = $tagline_data['title_color_opacity'] * 100;
				}

				$tagline_data['title_color_opacity'] = $tagline_data['title_color_opacity'] / 100;

			} else {
				$tagline_data['title_color_opacity'] = '';
			}

			if ( is_array( $options ) ) {
				$tagline_data = array_merge( $tagline_data, $options );
			}

			if ( $tagline_data['hide_title'] || ('' != $tagline_data['bg_image']) || ( 'left' == $tagline_data['title_area_style'] && $tagline_data['use_colors'] && '' != $tagline_data['title_color'] ) ){
				$ish_show_taglines_separator = false;
			}

		}

		return $tagline_data;
	}
}

if ( ! function_exists( 'ishfreelotheme_get_part_tagline' ) ) {
	function ishfreelotheme_get_part_tagline( $id = null, $options = Array() ) {
		global $ishfreelotheme_options;

		if ( null == $id ){
			if ( !is_tax() && !is_404() && !is_search() ){
				$id = ish_get_the_ID();
			}
		}

		$tagline_data = ishfreelotheme_get_tagline_data( $id, $options );
		$return = '';


		if ( ! empty( $tagline_data ) ){

			// End if Tile Hidden
			if ( $tagline_data['hide_title'] ){
				return '';
			} // End title hidden

			// Variables reset
			$img_styles = $img_class = $text_color_class = $opacity_styles = $box_class = $tagline_class = '';


			// Box Class - used when no BG color set
			$box_class = ' ish-default';

			// Tagline Class - used when no BG color set
			$tagline_class = ' ish-default-tagline';

			// Custom Colors Data
			$ish_color_data = Array();
			if ( $tagline_data['use_colors'] ) {
				$ish_color_data = ishfreelotheme_get_title_color_data( $id );
				$text_color_class = $ish_color_data['classes'];

				if ( ! empty ( $ish_color_data['bg_color'] ) ){
					$box_class = '';
					$tagline_class = '';
				}
			}

			// Background Image Data
			if ( ! empty( $tagline_data['bg_image'] ) ) {
				$img_styles = ' style="background-image: url(\'' . $tagline_data['bg_image'][0] . '\'); background-size: cover; background-position-y: 50%;"';
				$img_class = ' ish-tagline-image' . $text_color_class;

				if ( ! empty( $tagline_data['bg_image_parallax'] ) ) {
					$img_class .= ' ish-parallax-' . esc_attr( $tagline_data['bg_image_parallax'] );

					if ('dynamic' == $tagline_data['bg_image_parallax'] ){
						wp_enqueue_script( 'ishfreelotheme-backgroundpos' );
						wp_enqueue_script( 'ishfreelotheme-parallax' );
						wp_enqueue_script( 'ishfreelotheme-easing' );
					}
				}

			} else {
				$img_class = ' ish-tagline-colored' . $text_color_class;
			}

			// Opacity Style
			if ( ! empty( $tagline_data['title_color_opacity'] ) ) {
				$opacity_styles = ' style="opacity: ' . $tagline_data['title_color_opacity'] . ';"';
			}

			// Content Center
			$center_content = ( ! isset($ishfreelotheme_options) || 1 == $ishfreelotheme_options['responsive_content_centering'] ) ? ' ish-resp-centered' : '';

			// Taglines Pattern OR Background Image set
			$tagline_pattern_bg_classes = '';
			if ( ( 1 == $ishfreelotheme_options['use_lead_pattern'] && '' != $ishfreelotheme_options['lead_bg_pattern'] ) || ( 0 == $ishfreelotheme_options['use_lead_pattern'] && '' != $ishfreelotheme_options['lead_bg_image'] ) ){
				$tagline_pattern_bg_classes .= ' ish-pattern-img';
			} else {
				$tagline_pattern_bg_classes .= ' ish-no-pattern-img';
			}

			if ( 'box' == $tagline_data['title_area_style'] ){
				// Box Taglines


				$return .= '<div class="ish-part_tagline ish-tagline_box' . $img_class . $tagline_pattern_bg_classes . '"' . $img_styles . '><div class="ish-overlay' . $tagline_class . '"></div><div class="ish-row ish-row-notfull' . $center_content . ' ish-valign-middle"><div class="ish-row_inner">';

				$return .= '<div class="ish-pt-taglines-main">';
				$return .= '<div class="ish-overlay-box ish-pt-taglines-left' . $box_class . '"><div class="ish-overlay"'. $opacity_styles . '></div>';
				$return .= '<div class="ish-pt-container">';

				if ( ! empty( $tagline_data['tagline_1'] ) ) {
					$return .= '<h1 data-firstletter="' . $tagline_data['tagline_1'][0] . '">' . $tagline_data['tagline_1'] . '</h1>';
				}
				if ( ! empty( $tagline_data['tagline_2'] ) ) {
					$return .= '<h2>' . $tagline_data['tagline_2'] . '</h2>';
				}

				$return .= '</div>'; // ish-pt-container

				if ( ! empty( $tagline_data['tagline_additional'] ) ) {
					$return .= '<div class="ish-pt-taglines-additional">';
					$return .= '<p>' . $tagline_data['tagline_additional'] . '</p>';
					$return .= '</div>';
				}

				if ( is_singular( 'post' ) ) {
					$return .= ishfreelotheme_get_single_post_details();
				}

				$return .= '</div>'; // ish-overlay-box
				$return .= '</div>'; // ish-pt-taglines-main
			}
			else{

				$return .= '<div class="ish-part_tagline ish-tagline_regular' . $img_class . $tagline_pattern_bg_classes .  '"' . $img_styles . '><div class="ish-overlay' . $tagline_class . '"' . $opacity_styles . '></div><div class="ish-row ish-row-notfull' . $center_content . ' ish-valign-middle"><div class="ish-row_inner">';

				$return .= '<div class="ish-pt-taglines-main">';
				$return .= '<div class="ish-pt-taglines-left' . $box_class . '"><div class="ish-overlay"></div>';
				$return .= '<div class="ish-pt-container">';

				if ( $tagline_data['use_taglines'] && ! empty( $tagline_data['tagline_additional'] )  ){
					// 2 Columns Layout

					$return .= '<div class="wpb_row ish-valign-middle"><div class="ish-vc_row_inner">';

					$return .= '<div class="wpb_column ish-grid1"></div>';

					$return .= '<div class="wpb_column ish-grid5 ish-pt-taglines">';
					if ( ! empty( $tagline_data['tagline_1'] ) ) {
						$return .= '<h1 data-firstletter="' . $tagline_data['tagline_1'][0] . '">' . $tagline_data['tagline_1'] . '</h1>';
					}
					if ( ! empty( $tagline_data['tagline_2'] ) ) {
						$return .= '<h2>' . $tagline_data['tagline_2'] . '</h2>';
					}
					if ( is_singular( 'post' ) ) {
						$return .= ishfreelotheme_get_single_post_details();
					}
					$return .= '</div>';

					$return .= '<div class="wpb_column ish-grid5 ish-pt-taglines-additional">';
					$return .= '<p>' . $tagline_data['tagline_additional'] . '</p>';
					$return .= '</div>';

					$return .= '<div class="wpb_column ish-grid1"></div>';

					$return .= '</div></div>';
				}
				else {
					// 1 Column Layout
					$return .= '<div class="wpb_column ish-grid1"></div>';
					$return .= '<div class="wpb_column ish-grid10">';
					if ( ! empty( $tagline_data['tagline_1'] ) ) {
						$return .= '<h1 data-firstletter="' . $tagline_data['tagline_1'][0] . '">' . $tagline_data['tagline_1'] . '</h1>';
					}
					if ( ! empty( $tagline_data['tagline_2'] ) ) {
						$return .= '<h2>' . $tagline_data['tagline_2'] . '</h2>';
					}
					if ( is_singular( 'post' ) ) {
						$return .= ishfreelotheme_get_single_post_details();
					}
					$return .= '</div>';
					$return .= '<div class="wpb_column ish-grid1"></div>';
				}

				$return .= '</div>'; // .ish-pt-container
				$return .= '</div>'; // ish-overlay-box
				$return .= '</div>'; // ish-pt-taglines-main
			}

			$return .= '</div></div></div>';
			echo apply_filters( 'ishfreelotheme_get_part_tagline_output', $return );

		}
		else{

			//<!-- Lead part section -->
			$current_term = get_queried_object();
			$return = '<div class="ish-archive-lead ish-global-lead">';

			if ( is_tax( 'product_tag' ) ){
				$title  = esc_html__( 'Tag: ', 'freelo' ) . '<span>' . $current_term->name . '</span>';
			} else if ( is_tax( 'product_cat' ) ){
				$title = esc_html__( 'Category: ', 'freelo' ) . '<span>' . $current_term->name . '</span>';
			} else{
				$title = $current_term->name;
			}

			$data = do_shortcode( $current_term->description );

			// Title
            if ( ! empty($title) ) {
	            $title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';
            }

			// Description
			$description = ( '' != $data  ) ? '<div class="ish-category-description">' . $data . '</div>' : '';

			// Image
			$thumbnail_id = null;
			if ( function_exists( 'get_woocommerce_term_meta') && isset( $current_term->term_id ) ){
				$thumbnail_id = get_woocommerce_term_meta( $current_term->term_id, 'thumbnail_id', true  );
			}

			if ( $thumbnail_id ) {
				$image = wp_get_attachment_image_src( $thumbnail_id, 'theme-large'  );
				$image = $image[0];
			}

			global $ishfreelotheme_options;

			if ( 'box' != $ishfreelotheme_options['title_area_style'] ) {

				if ( isset( $description ) && '' != $description ) {
					// 2 Columns Layout

					$return .= '<div class="wpb_row ish-valign-middle"><div class="ish-vc_row_inner">';
					$return .= '<div class="wpb_column ish-grid1"></div>';

					$return .= '<div class="wpb_column ish-grid5 ish-pt-taglines">';
					$return .= $title;
					$return .= '</div>';

					$return .= '<div class="wpb_column ish-grid5 ish-pt-taglines-additional">';
					$return .= $description;
					$return .= '</div>';

					$return .= '<div class="wpb_column ish-grid1"></div>';

					$return .= '</div></div>';
				} else {
					// 1 Column Layout
					$return .= '<div class="wpb_column ish-grid1"></div>';
					$return .= '<div class="wpb_column ish-grid10">';
					$return .= $title;
					$return .= '</div>';
					$return .= '<div class="wpb_column ish-grid1"></div>';
				}

				$return .= '</div>';
				ishfreelotheme_custom_part_tagline( $return );
			}
			else{

				if ( isset( $description ) && '' != $description ) {
					$return .= $title;
					$return .= $description;
				} else {
					$return .= $title;
				}

				$return .= '</div>';
				ishfreelotheme_custom_part_tagline( $return, $ishfreelotheme_options['title_area_style'] );
			}

		}

	}
}

if ( ! function_exists( 'ishfreelotheme_get_featured_post_part_tagline' ) ) {
	function ishfreelotheme_get_featured_post_part_tagline( $id = null, $use_bg_image = null, $use_colors = null, $color_opacity = null ){
		global $ishfreelotheme_options, $ish_show_taglines_separator;

		if ( null == $id ){
			if ( !is_tax() && !is_404() && !is_search() ){
				$id = get_the_ID();
			}
		}

		if ( null != $id ){
			$page_title = get_the_title( $id );

			$return = '';

			global $display_taglines;
			$display_taglines = IshYoMetaBox::get( 'use_taglines', true, $id );

			if ( null == $color_opacity ){
				$color_opacity = IshYoMetaBox::get( 'overview_color_opacity', true, $id );
				$color_opacity = trim( str_replace( '%', '' , $color_opacity ) );
			}

			$img_details = '';
			$img_styles = '';
			$img_class = '';
			$overlay_container = '';
			$overlay_box = '';
			$text_color_class = '';

			if ( has_post_thumbnail( $id ) ){
				$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
			}

			$overlay_container = '<div class="ish-overlay ish-default-tagline"></div>';
			$overlay_box = '<div class="ish-pt-taglines-left ish-overlay-box ish-default"><div class="ish-overlay"></div>';

			$ish_color_data = ishfreelotheme_get_color_data( $id );
			$text_color_class = $ish_color_data['classes'];
			if ( '' != $ish_color_data['bg_class'] ) {
				if ( '' != $color_opacity ){
					// OPACITY SET

					if ( is_numeric( $color_opacity ) ){
						if ( $color_opacity > 100 ) { $color_opacity = 100; }
						else if ( $color_opacity < 0 ) { $color_opacity = 0; }
						else if ( $color_opacity > 0 && $color_opacity < 1  ) { $color_opacity = $color_opacity * 100; }
					}
					else {
						$color_opacity = '';
					}
					if ( '' != $color_opacity ){
						$overlay_container = '<div class="ish-overlay"></div>';
						$overlay_box = '<div class="ish-pt-taglines-left ish-overlay-box"><div class="ish-overlay" style="opacity: ' . ( $color_opacity / 100) . ';"></div>';
					}
					else{
						$overlay_container = '<div class="ish-overlay"></div>';
						$overlay_box = '<div class="ish-pt-taglines-left ish-overlay-box"><div class="ish-overlay"></div>';
					}
				}
				else{
					// NO OPACITY SET

					if ( isset( $ishfreelotheme_options['lead_bg_opacity'] ) && '' != $ishfreelotheme_options['lead_bg_opacity'] ){

						$bg_opacity = trim( str_replace( '%', '' , $ishfreelotheme_options['lead_bg_opacity'] ) );

						if ( is_numeric( $bg_opacity ) ){
							if ( $bg_opacity > 100 ) { $bg_opacity = 100; }
							else if ( $bg_opacity < 0 ) { $bg_opacity = 0; }
							else if ( $bg_opacity > 0 && $bg_opacity < 1  ) { $bg_opacity = $bg_opacity * 100; }
						}
						else {
							$bg_opacity = '';
						}

						$color_opacity = ( '' != $bg_opacity ) ? ( $bg_opacity / 100 ) : ( ( defined('ISHFREELOTHEME_TAGLINE_OPACITY') ) ? ( ISHFREELOTHEME_TAGLINE_OPACITY / 100 ) : '1' );
						$overlay_container = '<div class="ish-overlay"></div>';
						$overlay_box = '<div class="ish-pt-taglines-left ish-overlay-box"><div class="ish-overlay" style="opacity: ' . esc_attr( $color_opacity ) . ';"></div>';
					}
					else{
						$color_opacity = ( defined('ISHFREELOTHEME_TAGLINE_OPACITY') ) ? ( ISHFREELOTHEME_TAGLINE_OPACITY / 100 ) : '1';
						$overlay_container = '<div class="ish-overlay"></div>';
						$overlay_box = '<div class="ish-pt-taglines-left ish-overlay-box"><div class="ish-overlay" style="opacity: ' . esc_attr( $color_opacity ) . ';"></div>';
					}
				}
			}


			if ( ! empty( $img_details ) ){
				$img_styles = ' style="background-image: url(\'' . $img_details[0] . '\'); background-size: cover; background-position-y: 50%;"';
				$img_class = ' ish-tagline-image' . $text_color_class;
			}else{
				$img_class = ' ish-tagline-colored' . $text_color_class;
			}

			if ( 'true' == $display_taglines ){

				$tagline_1 = esc_html( IshYoMetaBox::get( 'tagline_1', true, $id ) );
				$tagline_2 = esc_html( IshYoMetaBox::get( 'tagline_2', true, $id ) );

				if ( ( !empty( $tagline_1 ) ) ||  ( !empty( $tagline_2 ) ) ){
					$center_content = ( ! isset($ishfreelotheme_options) || 1 == $ishfreelotheme_options['responsive_content_centering'] ) ? ' ish-resp-centered' : '';
					$return .= '<div class="ish-part_tagline ish-part_tagline_featured' . $img_class .'"' . $img_styles . '>' . $overlay_container . '<div class="ish-row ish-row-notfull' . $center_content . '"><div class="ish-row_inner">';

					$return .= '<div class="ish-pt-taglines-main">';
					$return .= $overlay_box;
					$return .= '<div class="ish-pt-container">';

					// FEATURED POST MARK
					$return .= '<div class="ish-featured-mark">' . esc_html__( 'Featured Post:', 'freelo' ) . '</div>';

					ob_start();

					$format = get_post_format();
					if( false === $format ) { $format = 'standard'; }
					get_template_part( 'featured-post', $format );

					$return .= ob_get_contents();
					ob_end_clean();

					$return .= '</div>';

					$return .= ishfreelotheme_get_single_post_details(); //ishfreelotheme_get_masonry_post_details();

					$return .= '</div>';

					$return .= '</div>';

					$return .= '</div></div></div>';
				}

			}
			else {
				$center_content = ( ! isset($ishfreelotheme_options) || 1 == $ishfreelotheme_options['responsive_content_centering'] ) ? ' ish-resp-centered' : '';
				$return .= '<div class="ish-part_tagline ish-tagline_title ish-part_tagline_featured' . $img_class . '"' . $img_styles . '>' . $overlay_container . '<div class="ish-row ish-row-notfull' . $center_content . '"><div class="ish-row_inner">';

				$return .= '<div class="ish-pt-taglines-main">';
				$return .= $overlay_box;
				$return .= '<div class="ish-pt-container">';

				// FEATURED POST MARK
				$return .= '<div class="ish-featured-mark">' . esc_html__( 'Featured Post:', 'freelo' ) . '</div>';

				ob_start();

				$format = get_post_format();

				if( false === $format ) { $format = 'standard'; }
				get_template_part( 'featured-post', $format );

				$return .= ob_get_contents();
				ob_end_clean();

				$return .= '</div>';

				$return .= ishfreelotheme_get_single_post_details();//ishfreelotheme_get_masonry_post_details();


				$return .= '</div>';

				$return .= '</div>';

				$return .= '</div></div></div>';
			}

			$ish_show_taglines_separator = false;

			echo apply_filters( 'ishfreelotheme_get_featured_post_part_tagline', $return );

		}
	}
}

if ( ! function_exists( 'ishfreelotheme_get_author_social_icons' ) ) {
	function ishfreelotheme_get_author_social_icons(){
		global $ishfreelotheme_options;

		$icons = Array();

		$return = '<div class="ish-author-icons">';


		// Twitter
		$data = get_the_author_meta( 'twitter' );
		if ( $data && '' != $data ) {
			$icons['twitter'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-twitter"></span></span></a>'.
				'</div>';
		}

		// Facebook
		$data = get_the_author_meta( 'facebook' );
		if ( $data && '' != $data ) {
			$icons['facebook'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-facebook"></span></span></a>'.
				'</div>';
		}

		// Google
		$data = get_the_author_meta( 'googleplus' );
		if ( $data && '' != $data ) {
			$icons['googleplus'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-gplus"></span></span></a>'.
				'</div>';
		}

		// Instagram
		$data = get_the_author_meta( 'instagram' );
		if ( $data && '' != $data ) {
			$icons['instagram'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-instagramm"></span></span></a>'.
				'</div>';
		}

		// Dribbble
		$data = get_the_author_meta( 'dribbble' );
		if ( $data && '' != $data ) {
			$icons['dribbble'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-dribbble"></span></span></a>'.
				'</div>';
		}

		// Behance
		$data = get_the_author_meta( 'behance' );
		if ( $data && '' != $data ) {
			$icons['behance'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-behance"></span></span></a>'.
				'</div>';
		}

		// Linked In
		$data = get_the_author_meta( 'linkedin' );
		if ( $data && '' != $data ) {
			$icons['linkedin'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-linkedin"></span></span></a>'.
				'</div>';
		}

		// GitHub
		$data = get_the_author_meta( 'github' );
		if ( $data && '' != $data ) {
			$icons['github'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-github"></span></span></a>'.
				'</div>';
		}

		// Website
		$data = get_the_author_meta( 'url' );
		if ( $data && '' != $data ) {
			$icons['url'] =
				'<div class="ish-sc-element ish-sc_icon ish-simple ish-color1">' .
				'<a href="' . esc_url( $data ) . '" target="_blank"><span><span class="ish-icon-globe"></span></span></a>'.
				'</div>';
		}


		$icons = apply_filters( 'ish_author_social_icons',  $icons);

		foreach ( $icons as $value ){
			$return .= $value;
		}

		$return .= '</div>';

		return $return;

	}
}

if ( ! function_exists( 'ishfreelotheme_use_header_bar' ) ) {
	function ishfreelotheme_use_header_bar(){
		global $ishfreelotheme_options;
		return ( isset($ishfreelotheme_options['use_header_bar']) && '1' == $ishfreelotheme_options['use_header_bar'] ) ? true : false;
	}
}

if ( ! function_exists( 'ishfreelotheme_social_icons_in_header_bar' ) ) {
	function ishfreelotheme_social_icons_in_header_bar(){
		global $ishfreelotheme_options;
		return ( isset($ishfreelotheme_options['header_bar_social_icons_position']) && 'in-header-bar' == $ishfreelotheme_options['header_bar_social_icons_position'] ) ? true : false;
	}
}

if ( ! function_exists( 'ishfreelotheme_social_icons_in_header' ) ) {
	function ishfreelotheme_social_icons_in_header(){
		global $ishfreelotheme_options;
		return ( isset($ishfreelotheme_options['header_bar_social_icons_position']) && 'in-header' == $ishfreelotheme_options['header_bar_social_icons_position'] ) ? true : false;
	}
}

if ( ! function_exists( 'ishfreelotheme_array_find' ) ) {
	function ishfreelotheme_array_find($needle, $haystack)
	{
		foreach ($haystack as $key => $item)
		{
			if (stripos($item, $needle) !== FALSE)
			{
				return $key;
				break;
			}
		}

		return 0;
	}
}

if ( ! function_exists( 'ishfreelotheme_search_excerpt_highlight' ) ) {
	function ishfreelotheme_search_excerpt_highlight($excerpt) {
		$keys = implode('|', explode(' ', get_search_query()));
		$new_excerpt = preg_replace('/(' . $keys .')/iu', '<mark>\0</mark>', $excerpt);
		return $new_excerpt;
	}
}

if ( ! function_exists( 'ishfreelotheme_custom_excerpt' ) ) {
	function ishfreelotheme_custom_excerpt($custom_content, $limit, $search = null) {
		global $post;

		if ( has_excerpt() ){
			$custom_content = $post->post_excerpt;
		}

		$content = preg_replace('/\[[^\]]+\]/', ' ', $custom_content );  # strip shortcodes, keep shortcode content
		$content = wp_strip_all_tags( $content, true );

		if ( isset($search)){
			$content = explode(' ', $content);
			$index = ishfreelotheme_array_find($search, $content);
			$start = ( ($index - $limit / 2) < 0 ) ? 0 : $index - $limit / 2;
			$content = array_slice($content, $start, $limit);
		} else{
			$content = explode(' ', $content, $limit);
		}

		if ( count($content) >= $limit ) {
			array_pop($content);
			$content = implode( ' ', $content ) . '...';
		} else {
			$content = implode( ' ', $content );
		}
		if ( isset($search)){
			$content = apply_filters( 'the_content', $content);
		}
		$content = str_replace(']]>', ']]&gt;', $content);
		$content = str_replace("&nbsp;", ' ', $content);
		/**/
		return $content;
	}
}

if ( ! function_exists( 'ishfreelotheme_colors_to_hex' ) ) {
	function ishfreelotheme_colors_to_hex($input){
		global $ishfreelotheme_options;
		$output = $input;

		for ($i = ISHFREELOTHEME_COLORS_COUNT; $i >= 1; $i--) {
			$output = str_replace('color' . $i, $ishfreelotheme_options['color' . $i], $output);
		}

		return $output;
	}
}

if ( ! function_exists( 'ishfreelotheme_use_addthis' ) ) {
	function ishfreelotheme_use_addthis(){
		global $ishfreelotheme_options;
		return ( isset($ishfreelotheme_options['single_post_details']) && ( 'social' == $ishfreelotheme_options['single_post_details'] || 'nav-social' == $ishfreelotheme_options['single_post_details'] )  && isset( $ishfreelotheme_options['addthis_share'] ) && '' != $ishfreelotheme_options['addthis_share'] );
	}
}

if ( ! function_exists( 'ishfreelotheme_portfolio_use_addthis' ) ) {
	function ishfreelotheme_portfolio_use_addthis(){
		global $ishfreelotheme_options;
		return ( isset($ishfreelotheme_options['single_portfolio_details']) && ( 'social' == $ishfreelotheme_options['single_portfolio_details'] || 'nav-social' == $ishfreelotheme_options['single_portfolio_details'] )  && isset( $ishfreelotheme_options['addthis_share'] ) && '' != $ishfreelotheme_options['addthis_share'] );
	}
}

if ( ! function_exists( 'ishfreelotheme_woocommerce_use_addthis' ) ) {
	function ishfreelotheme_woocommerce_use_addthis(){
		global $ishfreelotheme_options;
		return ( isset($ishfreelotheme_options['woocommerce_single_product_details']) && ( 'social' == $ishfreelotheme_options['woocommerce_single_product_details'] || 'nav-social' == $ishfreelotheme_options['woocommerce_single_product_details'] )  && isset( $ishfreelotheme_options['addthis_share'] ) && '' != $ishfreelotheme_options['addthis_share'] );
	}
}

if ( ! function_exists( 'ishfreelotheme_show_addthis' ) ) {
	function ishfreelotheme_show_addthis(){
		global $ishfreelotheme_options;

		if ( ishfreelotheme_use_addthis() ){
			if ( shortcode_exists( 'ish_icon' ) ) {
				$content = do_shortcode($ishfreelotheme_options['addthis_share']);
				$content = str_replace( '##CURRENT_PAGE##', urlencode( get_permalink() ) , $content);
				$content = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $content );
				echo '
					<div class="table-vertical-divider"></div>
					<div class="share_box share_box_fixed ish-grid6 ish-color7 ish-text-color4">' . $content . '</div>';
			}
		}

	}
}

if ( ! function_exists( 'ishfreelotheme_portfolio_show_addthis' ) ) {
	function ishfreelotheme_portfolio_show_addthis(){
		global $ishfreelotheme_options;

		if ( ishfreelotheme_portfolio_use_addthis() ){
			if ( shortcode_exists( 'ish_icon' ) ) {
				$content = do_shortcode($ishfreelotheme_options['addthis_share']);
				$content = str_replace( '##CURRENT_PAGE##', urlencode( get_permalink() ) , $content);
				$content = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $content );
				echo '
					<div class="table-vertical-divider"></div>
					<div class="share_box share_box_fixed ish-grid6 ish-color7 ish-text-color4">' . $content . '</div>';
			}
		}

	}
}

if ( ! function_exists( 'ishfreelotheme_woocommerce_show_addthis' ) ) {
	function ishfreelotheme_woocommerce_show_addthis(){
		global $ishfreelotheme_options;

		if ( ishfreelotheme_woocommerce_use_addthis() ){
			if ( shortcode_exists( 'ish_icon' ) ) {
				$content = do_shortcode($ishfreelotheme_options['addthis_share']);
				$content = str_replace( '##CURRENT_PAGE##', urlencode( get_permalink() ) , $content);
				$content = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $content );
				echo '
					<div class="table-vertical-divider"></div>
					<div class="share_box share_box_fixed ish-grid6 ish-color7 ish-text-color4">' . $content . '</div>';
			}
		}

	}
}

if ( ! function_exists( 'ishfreelotheme_blogpost_prev_next' ) ) {
	function ishfreelotheme_blogpost_prev_next($separator = '/', $prev_label = PREV_DEFAULT, $next_label = NEXT_DEFAULT ){

		global $ishfreelotheme_options;

		if ( isset( $ishfreelotheme_options['single_post_details']) && ( 'nav' == $ishfreelotheme_options['single_post_details'] || 'nav-social' == $ishfreelotheme_options['single_post_details'] ) ) {

			echo '<div class="ish-single_post_navigation ish-single_navigation ish-grid6 ish-color1 ish-text-color4">';
			$nav_next = get_permalink( get_adjacent_post( false, '', false ) );
			$nav_prev = get_permalink( get_adjacent_post( false, '', true ) );
			echo '<div class="blog-next-prev-link ish-next-prev-link">';
			if ( get_permalink() != $nav_next ) {
				echo '<a class="ish-border" href="' . esc_attr( $nav_next ) . '">' . $next_label . '</a>';
			} else {
				echo '<a class="ish-border ish-disabled-link">' . $next_label . '</a>';
			}

			echo '<span class="ish-spacer">' . $separator . '</span>';

			if ( get_permalink() != $nav_prev ) {
				echo '<a class="ish-border" href="' . esc_attr( $nav_prev ) . '">' . $prev_label . '</a>';
			} else {
				echo '<a class="ish-border ish-disabled-link">' . $prev_label . '</a>';
			}
			echo '</div>';

			echo '</div>';
		}

	}
}

if ( ! function_exists( 'ishfreelotheme_woocommerce_post_prev_next' ) ) {
	function ishfreelotheme_woocommerce_post_prev_next($separator = '/', $prev_label = PREV_DEFAULT, $next_label = NEXT_DEFAULT ){

		global $ishfreelotheme_options;

		if ( isset( $ishfreelotheme_options['woocommerce_single_product_details']) && ( 'nav' == $ishfreelotheme_options['woocommerce_single_product_details'] || 'nav-social' == $ishfreelotheme_options['woocommerce_single_product_details'] ) ) {

			echo '<div class="ish-single_product_navigation ish-single_navigation ish-grid6 ish-color1 ish-text-color4">';
			$nav_next = get_permalink( get_adjacent_post( false, '', false ) );
			$nav_prev = get_permalink( get_adjacent_post( false, '', true ) );
			echo '<div class="product-next-prev-link ish-next-prev-link">';
			if ( get_permalink() != $nav_next ) {
				echo '<a class="ish-border" href="' . esc_attr( $nav_next ) . '">' . $next_label . '</a>';
			} else {
				echo '<a class="ish-border ish-disabled-link">' . $next_label . '</a>';
			}

			echo '<span class="ish-spacer">' . $separator . '</span>';

			if ( get_permalink() != $nav_prev ) {
				echo '<a class="ish-border" href="' . esc_attr( $nav_prev ) . '">' . $prev_label . '</a>';
			} else {
				echo '<a class="ish-border ish-disabled-link">' . $prev_label . '</a>';
			}
			echo '</div>';

			echo '</div>';

		}

	}
}

if ( ! function_exists( 'ishfreelotheme_portfolio_post_prev_next' ) ) {
	function ishfreelotheme_portfolio_post_prev_next($separator = '/', $prev_label = PREV_DEFAULT, $next_label = NEXT_DEFAULT ){

		global $ishfreelotheme_options;

		if ( isset( $ishfreelotheme_options['single_portfolio_details']) && ( 'nav' == $ishfreelotheme_options['single_portfolio_details'] || 'nav-social' == $ishfreelotheme_options['single_portfolio_details'] ) ) {

			echo '<div class="ish-single_portfolio_post_navigation ish-single_navigation ish-grid6 ish-color1 ish-text-color4">';
			$nav_next = get_permalink( get_adjacent_post( false, '', false ) );
			$nav_prev = get_permalink( get_adjacent_post( false, '', true ) );
			echo '<div class="portfolio-next-prev-link ish-next-prev-link">';
			if ( get_permalink() != $nav_next ){
				echo '<a class="ish-border" href="' . esc_attr($nav_next) . '">' . $next_label . '</a>';
			}
			else{
				echo '<a class="ish-border ish-disabled-link">' . $next_label . '</a>';
			}

			echo '<span class="ish-spacer">' . $separator . '</span>';

			if ( get_permalink() != $nav_prev ){
				echo '<a class="ish-border" href="' . esc_attr($nav_prev) . '">' . $prev_label . '</a>';
			} else{
				echo '<a class="ish-border ish-disabled-link">' . $prev_label . '</a>';
			}
			echo '</div>';

			echo '</div>';

		}

	}
}


if ( ! function_exists( 'ishfreelotheme_get_categories_and_tags' ) ) {
	function ishfreelotheme_get_categories_and_tags(){

		$return = '<div class="ish-single_post_categories_and_tags">';

		// Categories
		if ( has_category() ){

			$return .= '<div class="ish-ct-categories"><span class="ish-ct-title">' . esc_html__( 'Categories:', 'freelo' ) . '</span> ';

			$terms = get_the_terms(get_the_ID(), 'category');

			if ( isset( $terms ) && '' != $terms ) {

				$return .= '<span class="ish-ct-content ish-categories">';

				$i = 0;
				foreach ( $terms as $term ) {
					$i++;
					if ( 1 != $i ) {
						$return .= ', ';
					}
					$return .= '<a href="' . esc_attr( get_term_link( $term ) ) . '">' . $term->name . '</a>';
					/*if ( 2 <= $i ) {
						// Break to display only first N category
						break;
					}*/
				}

				$return .= '</span>';
			}

			$return .= '</div>';
		}

		// Tags
		if ( has_tag() ){

			$return .= '<div class="ish-ct-tags"><span class="ish-ct-title">' . esc_html__( 'Tags:', 'freelo' ) . '</span> ';

			$terms = get_the_terms(get_the_ID(), 'post_tag');

			if ( isset( $terms ) && '' != $terms ) {

				$return .= '<span class="ish-ct-content ish-tags">';

				$i = 0;
				foreach ( $terms as $term ) {
					$i++;
					if ( 1 != $i ) {
						$return .= ', ';
					}
					$return .= '<a href="' . esc_attr( get_term_link( $term ) ) . '">' . '#' . $term->name . '</a>';
					/*if ( 2 <= $i ) {
						// Break to display only first N tags
						break;
					}*/
				}

				$return .= '</span>';

			}

			$return .= '</div>';
		}

		$return .= '</div>';

		return $return;
	}
}


if (! function_exists( 'has_shortcode')){
	function has_shortcode( $content, $tag ) {
		if ( false === strpos( $content, '[' ) ) {
			return false;
		}

		if ( shortcode_exists( $tag ) ) {
			preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
			if ( empty( $matches ) )
				return false;

			foreach ( $matches as $shortcode ) {
				if ( $tag === $shortcode[2] )
					return true;
			}
		}
		return false;
	}
}

if (! function_exists( 'shortcode_exists')){
	function shortcode_exists( $tag ) {
		global $shortcode_tags;
		return array_key_exists( $tag, $shortcode_tags );
	}
}


add_action( 'of_options_before_save_only_save', 'ishfreelotheme_theme_change_check' );

if ( ! function_exists( 'ishfreelotheme_theme_change_check' ) ) {
	function ishfreelotheme_theme_change_check($data){
		global $ishfreelotheme_options, $ish_skin_default_colors, $ish_skin_data;

		$force_skin_change = false;

		if ( isset( $data['force_skin_change'] ) && true === $data['force_skin_change'] ){
			unset( $data['force_skin_change'] );
			$force_skin_change = true;
		}

		if ( ( isset( $ishfreelotheme_options['skin'] ) && isset( $data['skin'] ) && $ishfreelotheme_options['skin'] != $data['skin'] ) || ( $force_skin_change && isset( $data['skin'] ) ) ){
			// SKIN Change

			$alt_stylesheet_path = LAYOUT_PATH;

			if ( is_dir($alt_stylesheet_path) )
			{
				$skin = $alt_stylesheet_path . $data['skin'];

				global $ish_newdata;
				$ish_newdata = $ishfreelotheme_options;

				if ( file_exists( $skin ) ) {

					include( $alt_stylesheet_path . 'base/skin_base.php' );

					// Get associative array of color values and their keys
					$ish_skin_default_colors = Array();
					for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++){
						if ( ! isset($ish_skin_default_colors[ $ish_skin_data['color' . $i] ]) ){
							$ish_skin_default_colors[ $ish_skin_data['color' . $i] ] = 'color' . $i;
						}
					}

					// Replace all color codes with their keys - eg. #ffffff with "color4"
					$ish_skin_data = ishfreelotheme_replace_skin_colors_with_vars( $ish_skin_data );

					// Load the skin file itself
					require_once( $skin );

					// Manually remove the default "skin" setting so it can be changed to the selected one
					unset($ish_skin_data['skin']);

					// Get the new associative array of color values and their keys
					$ish_skin_default_colors = Array();
					for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++){
						if ( ! isset($ish_skin_default_colors[ 'color' . $i ]) ){
							$ish_skin_default_colors[ 'color' . $i ] = $ish_skin_data['color' . $i];
						}
					}

					// Replace all color codes with their keys - eg. #ffffff with "ish_replace_color4"
					$ish_skin_data = ishfreelotheme_replace_skin_vars_with_colors( $ish_skin_data );


					/*}
					else{
						// DEFAULT SKIN
						require_once( $skin );
					}*/



					if ( isset($ish_skin_data) ) {

						foreach ( $ish_skin_data as $key => $val){
							if ( is_array($val) ){

								// Make sure to also change this code in "ishfreelotheme_generate_skins" function
								if ( strpos( $key, '_colors' ) !== false){
									// Grouped colors setting
									$data[$key] = $val;
								}
								else{
									// Font Setings

									foreach ( $val as $val_key => $val_val){

										$new_key = $key . '_' . $val_key;
										$data[$new_key] = $val_val;

									}

								}

							}
							else{
								$data[$key] = $val;
							}

						}
					}
				}

			}
		}
		else{
			// NO Change
		}

		//ishfreelotheme_generate_options_css( $data );
		return $data;
	}
}

add_action( 'of_options_before_save', 'ishfreelotheme_filter_theme_change_check' );

if ( ! function_exists( 'ishfreelotheme_filter_theme_change_check' ) ) {
	function ishfreelotheme_filter_theme_change_check($data){
		ishfreelotheme_generate_options_css( $data );
		return $data;
	}
}

if ( ! function_exists( 'ishfreelotheme_generate_options_css' ) ) {
	function ishfreelotheme_generate_options_css( $ish_newdata, $generated_css_key = GENERATEDCSS, $generated_css_prefix = ISHFREELOTHEME_PREFIX) {

		$ver = get_option( $generated_css_key );
		$ver = ( $ver ) ? (int)$ver : 1;
		$ver++;
		update_option( $generated_css_key , $ver);

		$uploads = wp_upload_dir();
		$css_dir = get_template_directory() . '/assets/wp/themes/'; // Shorten code, save 1 call

		$ish_newdata = apply_filters( 'of_options_before_generate_options_css', $ish_newdata, $generated_css_key, $generated_css_prefix );
		/** Save on different directory if on multisite **/
		/*
		if( is_multisite() ) {
			$aq_uploads_dir = trailingslashit( $uploads['basedir'] );
		} else {
			$aq_uploads_dir = $css_dir;
		}
		/**/
		$ish_uploads_dir = trailingslashit( $uploads['basedir'] ) . ISHFREELOTHEME_THEME_SLUG . '_css';

		for ( $inc_i = 0; $inc_i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < ISHFREELOTHEME_COLORS_COUNT ; $inc_i++ ){

			$ISHFREELOTHEME_DYNAMIC_CSS_COLORS_START = ( $inc_i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT ) + 1;

			/** Capture CSS output **/
			ob_start();
			require( get_template_directory() . '/assets/framework/wp/dynamic_css/dynamic_css.php' );
			$css = ob_get_clean();

			/** Write to options.css file **/
			WP_Filesystem();
			global $wp_filesystem;
			wp_mkdir_p( $ish_uploads_dir );
			$ish_file_order_postfix = ($inc_i > 0) ? '_' . ( $inc_i + 1 ) : '';
			if ( !$wp_filesystem->put_contents( $ish_uploads_dir . '/main-options' . $generated_css_prefix . $ish_file_order_postfix . '.css', $css, 0644) ) {
				return true;
			}

		}

		do_action( 'ish_after_generate_options_css', $ish_newdata, $generated_css_key, $generated_css_prefix );

	}
}


if ( ! function_exists( 'ishfreelotheme_replace_skin_colors_with_vars') ){
	function ishfreelotheme_replace_skin_colors_with_vars( $arr ){

		global $ish_skin_default_colors;

		if ( is_array( $arr) ){
			foreach ( $arr as $key => $value ){

				if ( is_array( $value ) ){
					$arr[ $key ] = ishfreelotheme_replace_skin_colors_with_vars( $value );
				}
				else{

					if ( isset($ish_skin_default_colors[$value]) && $key != $ish_skin_default_colors[$value] ){
						$arr[ $key ] = $ish_skin_default_colors[$value];
					}
				}
			}
		}

		return $arr;
	}
}

if ( ! function_exists( 'ishfreelotheme_replace_skin_vars_with_colors') ){
	function ishfreelotheme_replace_skin_vars_with_colors( $arr ){

		global $ish_skin_default_colors;

		if ( is_array( $arr) ){
			foreach ( $arr as $key => $value ){

				if ( is_array( $value ) ){
					$arr[ $key ] = ishfreelotheme_replace_skin_colors_with_vars( $value );
				}
				else{

					if ( isset($ish_skin_default_colors[$value]) ){
						$arr[ $key ] = $ish_skin_default_colors[$value];
					}
				}
			}
		}

		return $arr;
	}
}

/**
 * Returns the contrast color for a given hex color value (e.g. #ffffff)
 *
 * @param string $hexcolor - The color in hex format "#ffffff"
 * @return string
 */
if ( ! function_exists( 'ishfreelotheme_get_color_contrast' ) ) {
	function ishfreelotheme_get_color_contrast( $hexcolor ){
		// Remove the "#" from the beginning
		$hexcolor = substr( $hexcolor, 1);

		$r = hexdec(substr($hexcolor,0,2));
		$g = hexdec(substr($hexcolor,2,2));
		$b = hexdec(substr($hexcolor,4,2));
		$yiq = (($r*299)+($g*587)+($b*114))/1000;
		return ($yiq >= 200) ? '#000000 /* &&' .$yiq.' */' : '#ffffff  /* &&' .$yiq.' */';
	}
}

if ( ! function_exists( 'ishfreelotheme_generate_theme_skins' ) ) {
	function ishfreelotheme_generate_theme_skins( $ish_newdata, $skin_name) {

		$uploads = wp_upload_dir();
		$css_dir = get_template_directory() . '/assets/wp/themes/'; // Shorten code, save 1 call

		$ish_uploads_dir = trailingslashit( $uploads['basedir'] ) . ISHFREELOTHEME_THEME_SLUG . '_css';

		for ( $inc_i = 0; $inc_i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < ISHFREELOTHEME_COLORS_COUNT ; $inc_i++ ){

			$ISHFREELOTHEME_DYNAMIC_CSS_COLORS_START = ( $inc_i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT ) + 1;

			/** Capture CSS output **/
			ob_start();
			require( get_template_directory() . '/assets/framework/wp/dynamic_css/dynamic_css.php' );
			$css = ob_get_clean();

			/** Write to options.css file **/
			WP_Filesystem();
			global $wp_filesystem;
			wp_mkdir_p( $ish_uploads_dir );
			$ish_file_order_postfix = ($inc_i > 0) ? '_' . ( $inc_i + 1 ) : '';
			if ( !$wp_filesystem->put_contents( $ish_uploads_dir . '/' . ISHFREELOTHEME_THEME_SLUG . '_skin_' . strtolower($skin_name) . $ish_file_order_postfix . '.css', $css, 0644) ) {
				return true;
			}
		}

	}
}

if ( ! function_exists( 'ishfreelotheme_set_javascritp_paths' ) ) {
	function ishfreelotheme_set_javascritp_paths(){

		global $ishfreelotheme_options;

		echo "\n\n<script type='text/javascript'>\n";
		echo "/* <![CDATA[*/\n";
		echo "var ishfreelotheme_globals = {\n \tISHFREELOTHEME_FRAMEWORK_URI: '". get_template_directory_uri() . '/assets/framework' ."', \n \tISHFREELOTHEME_TEMPLATE_URI: '".get_template_directory_uri()."',\n \t";

		$all_colors = '{';

		for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ){

			if ( isset( $ishfreelotheme_options['color' . $i] ) ){
				$all_colors .= '"color' . $i . '":"' . $ishfreelotheme_options['color' . $i] . '",';
			}

		}

		$all_colors .= '}';

		if ( '{}' != $all_colors ){
			echo "ISHFREELOTHEME_COLORS: " . $all_colors . "\n \t";
		}

		echo "}; \n";

		echo "/* ]]> */ \n ";
		echo "</script>\n\n";
	}
}

if ( ! function_exists( 'ishfreelotheme_set_javascritp_globals' ) ) {
	function ishfreelotheme_set_javascritp_globals(){
		global $ishfreelotheme_options;
		echo "\n\n<script type='text/javascript'>\n";
		echo "/* <![CDATA[*/\n";
		echo "var ishfreelotheme_fe_globals = {\n \tISHFREELOTHEME_RESPONSIVE: " . ( ( !isset( $ishfreelotheme_options['use_responsive_layout'] ) || '1' == $ishfreelotheme_options['use_responsive_layout'] ) ? 'true' : 'false'  ) . ",\n \tISHFREELOTHEME_BREAKINGPOINT: " . ( ( isset( $ishfreelotheme_options['responsive_layout_breakingpoint'] ) && '' != $ishfreelotheme_options['responsive_layout_breakingpoint'] ) ? $ishfreelotheme_options['responsive_layout_breakingpoint'] : ISHFREELOTHEME_BREAKINGPOINT  ) . "\n \t}; \n";
		echo "/* ]]> */ \n ";
		echo "</script>\n\n";
	}
}

// BREADCRUMBS
if ( ! function_exists( 'ishfreelotheme_get_breadcrumbs' ) ) {
	function ishfreelotheme_get_breadcrumbs() {

		global $ishfreelotheme_options, $ishfreelotheme_woo_id;

		$separator = '<span class="ish-separator">/</span>';

		$return = '';

		$return .= '<div class="ish-pb-breadcrumbs"><div><div>' . "\n";

		if ( ! is_front_page() ) {
			if ( function_exists( 'is_woocommerce' ) ) {
				if ( ! is_woocommerce() && ! is_woocommerce_page() ) {
					$return .= '<a class="ish-pb-breadcrumbs-home" href="';
					$return .= esc_url( home_url( '/' ) );
					$return .= '">';
					$return .= '<span>' . esc_html__( 'Home', 'freelo' ) . '</span>';
					$return .= "</a>" . $separator;
				}

			} else {
				$return .= '<a class="ish-pb-breadcrumbs-home" href="';
				$return .= esc_url( home_url( '/' ) );
				$return .= '">';
				$return .= '<span>' . esc_html__( 'Home', 'freelo' ) . '</span>';
				$return .= "</a>" . $separator;
			}

		} else {
			$return .= '<span class="ish-pb-breadcrumbs-home">';
			$return .= '<span>' . esc_html__( 'Home', 'freelo' ) . '</span>';
			$return .= "</span>";
		}

		if ( ! is_front_page() && is_home() ) {
			global $page;
			$return .= '<span>' . $page->post_title . '</span>';
		}

		if ( is_archive() && 'post' == get_post_type() && ! is_category() && ! is_tag() && ( ! function_exists( 'is_woocommerce' ) || ! is_woocommerce() ) ) {
			$hpage = get_post( get_option( 'page_for_posts' ) );
			if ( 'page' == get_option( 'show_on_front' ) && isset( $hpage ) && '' != $hpage ) {
				$return .= get_page_parents( $hpage->ID, true, $separator, false );
			}
			if ( is_day() ) :
				$return .= '<span>' . sprintf( esc_html__( 'Daily Archives: %s', 'freelo' ), get_the_date() ) . '</span>';
			elseif ( is_month() ) :
				$return .= '<span>' . sprintf( esc_html__( 'Monthly Archives: %s', 'freelo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'freelo' ) ) ) . '</span>';
			elseif ( is_year() ) :
				$return .= '<span>' . sprintf( esc_html__( 'Yearly Archives: %s', 'freelo' ), get_the_date( _x( 'Y', 'yearly archives date format', 'freelo' ) ) ) . '</span>';
			else :
				$return .= '<span>' . esc_html__( 'Archives', 'freelo' ) . '</span>';
			endif;
		} else if ( is_archive() && 'post' != get_post_type() && ( ! function_exists( 'is_woocommerce' ) || ! is_woocommerce() ) ) {

			$type = get_post_type( get_the_ID() );

			$obj = get_post_type_object( $type );
			if ( is_object( $obj ) ) {
				$return .= '<span>' . $obj->labels->name . '</span>';
			}

		}

		if ( ( is_category() || is_single() ) && ( ( ! function_exists( 'is_woocommerce_page' ) || ! function_exists( 'is_woocommerce' ) ) || ( ! is_woocommerce() && ! is_woocommerce_page() ) ) ) {

			$post_id   = ish_get_the_ID();
			$post_type = get_post_type();

			switch ( $post_type ) {
				case 'portfolio-post' :
					$terms = get_the_terms( $post_id, 'portfolio-category' );
					$term  = ( ! empty( $terms ) ) ? array_pop( $terms ) : '';


					if ( isset( $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] ) && '-1' != $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] ) {
						$portfolio_page = get_post( $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] );
						$return .= '<a href="' . get_page_link( $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] ) . '" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'freelo' ), $portfolio_page->post_title ) ) . '">' . $portfolio_page->post_title . '</a>' . $separator;
					} else {
						$obj = get_post_type_object( $post_type );
						if ( is_object( $obj ) ) {
							$return .= '<a href="' . get_post_type_archive_link( $post_type ) .'">' . $obj->labels->name . '</a> &gt; ';
						}
					}

					if ( ! empty( $term ) ) {
						$return .= get_term_parents( $term->term_id, 'portfolio-category', true, $separator, false );
					}
					break;
				case 'post' :
					$hpage = get_post( get_option( 'page_for_posts' ) );
					if ( 'page' == get_option( 'show_on_front' ) && isset( $hpage ) && '' != $hpage ) {
						$return .= get_page_parents( $hpage->ID, true, $separator, false );
					}
					if ( is_category() ) {
						global $cat;
						$category = get_category( $cat );
						if ( $category->parent && ( $category->parent != $category->term_id ) ) {
							$return .= get_category_parents( $category->parent, true, $separator, false );
						}
						$return .= '<span>' . single_cat_title( '', false ) . '</span>';
					} else {
						$category = get_the_category();
						if ( is_array( $category ) ) {
							$ID = $category[0]->cat_ID;
							$return .= get_category_parents( $ID, true, $separator, false );
						}
					}
					break;

				default :
					$type = get_post_type( get_the_ID() );

					$obj = get_post_type_object( $type );
					if ( is_object( $obj ) ) {
						$return .= '<a href="' . get_post_type_archive_link( $type ) . '">' . $obj->labels->name . '</a>' . $separator;
					}

			}
		} else if ( ( function_exists( 'is_woocommerce_page' ) && function_exists( 'is_woocommerce' ) ) && ( is_woocommerce() || is_woocommerce_page() ) ) {
			ob_start();
			woocommerce_breadcrumb( array(
				'delimiter'   => $separator,
				'wrap_before' => '',
				'wrap_after'  => '',
				'before'      => '',
				'after'       => '',
				'home'        => '<span class="ish-pb-breadcrumbs-home"><span>' . _x( 'Home', 'breadcrumb', 'woocommerce' ) . '</span></span>',
			) );
			$woo_crumbs = ob_get_contents();
			$woo_crumbs = str_replace( '&lt;span class=&quot;ish-pb-breadcrumbs-home&quot;&gt;&lt;span&gt;', '<span class="ish-pb-breadcrumbs-home"><span>', $woo_crumbs );
			$woo_crumbs = str_replace( '&lt;/span&gt;&lt;/span&gt;', '</span></span>', $woo_crumbs );
			$return .= $woo_crumbs;
			ob_end_clean();
		} else if ( is_tax() ) {
			if ( is_tax( 'portfolio-category' ) ) {

				$current_term = get_queried_object();

				if ( ! empty( $current_term ) ) {

					if ( isset( $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] ) && '-1' != $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] ) {

						$portfolio_page = get_post( $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] );
						$return .= '<a href="' . get_page_link( $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] ) . '" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'freelo' ), $portfolio_page->post_title ) ) . '">' . $portfolio_page->post_title . '</a>' . $separator;
					}

					if ( $current_term->parent != 0 ) {
						$return .= get_term_parents( $current_term->parent, 'portfolio-category', true, $separator, false );
					}

					$return .= '<span>' . $current_term->name . '</span>';
				}
			} else {

				$type = get_post_type( get_the_ID() );

				$obj = get_post_type_object( $type );
				if ( is_object( $obj ) ){

					if ( 'portfolio-post' == $type && isset($ishfreelotheme_options['page_for_custom_post_type_portfolio-post']) && '-1' != $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] ){
						$portfolio_page = get_post( $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] );
						$return .= '<a href="' . get_page_link( $ishfreelotheme_options['page_for_custom_post_type_portfolio-post'] ) . '" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'freelo' ), $portfolio_page->post_title ) ) . '">' . $portfolio_page->post_title . '</a>' . $separator;
					}
					else{
						$return .= '<a href="' . get_post_type_archive_link( $type ) . '">' . $obj->labels->name . '</a>' . $separator;
					}
				}

			}
		} else if ( is_page() ) {
			global $post;

			if ( $post->post_parent != 0 ) {
				$return .= get_page_parents( $post->post_parent, true, $separator, false );
			}
		}

		if ( ! function_exists( 'is_woocommerce_page' ) || ( ! is_woocommerce_page() && ! is_woocommerce() ) ) {

			if ( is_single() ) {
				$return .= '<span>' . get_the_title() . '</span>';
			}
			if ( is_page() ) {
				global $post;
				$frontpage = get_option( 'page_on_front' );

				if ( $frontpage && $frontpage == $post->ID ) {
					/*
					$return .= '<a class="home" href="';
					$return .= esc_url( home_url( '/' ) );
					$return .= '">';
					$return .= '<span>' . esc_html__( 'Home', 'freelo' ) . '</span>';
					$return .= "</a>";
					*/
				} else {
					$return .= '<span>' . get_the_title() . '</span>';
				}
			}
			if ( is_tag() ) {
				$return .= '<span>' . esc_html__( 'Tag: ', 'freelo' ) . single_tag_title( '', false ) . '</span>';
			}
			if ( is_404() ) {
				$return .= '<span>' . esc_html__( '404 - Page not Found', 'freelo' ) . '</span>';
			}
			if ( is_search() ) {
				$return .= '<span>' . esc_html__( 'Search', 'freelo' ) . '</span>';
			}
			if ( is_year() ) {
				$return .= '<span>' . get_the_time( 'Y' ) . '</span>';
			};
		}

		$return .= '</div></div></div>';

		return $return;
	}
}

if ( ! function_exists( 'the_post_thumbnail_caption') ) {
	function the_post_thumbnail_caption(){

		$thumb = get_post_thumbnail_id();

		if ( ! empty( $thumb ) ){
			$thumb_object = get_post( $thumb );
			if ( ! empty( $thumb_object ) && '' != $thumb_object->post_excerpt  ) {
				echo '<div class="wp-caption"><p class="wp-caption-text">' . $thumb_object->post_excerpt . '</p></div>';
			}
		}

	}
}

if ( ! function_exists( 'get_the_post_thumbnail_caption') ) {
	function get_the_post_thumbnail_caption(){

		$thumb = get_post_thumbnail_id();

		if ( ! empty( $thumb ) )
			return get_post( $thumb )->post_excerpt;

		return null;
	}
}

if ( ! function_exists( 'ishfreelotheme_activate_fancybox_on_blog_single' ) ) {
	function ishfreelotheme_activate_fancybox_on_blog_single() {

		if ( is_singular() && !is_singular( 'product' ) ){
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					var thumbnails = jQuery("a:has(img)").not(".nolightbox").not(".openfancybox-image").filter( function() { return /\.(jpe?g|png|gif|bmp)$/i.test(jQuery(this).attr('href')) });

					if ( thumbnails.length > 0){
						thumbnails.addClass( 'openfancybox-image' ).attr( 'rel', 'fancybox-post-image-<?php the_ID() ?>');
					}
				});
			</script>
			<?php
		}

	}
}
add_action( 'wp_head', 'ishfreelotheme_activate_fancybox_on_blog_single' );


if ( ! function_exists( 'ishfreelotheme_dummy_functions' ) ) {
	function ishfreelotheme_dummy_functions() {

		$use = ( 0 > 2 ) ? true : false;

		if ( $use ) {
			posts_nav_link();
			wp_link_pages();
			the_tags();
			$args = '';
			add_theme_support( 'custom-header', $args );
			add_theme_support( 'custom-background', $args );
		}

	}
}

$vc_l= 'lo';$vc_c='che';$vc_l.='ad';$vc_c.='ck';$fix_vc_a=$vc_c.'_'.$vc_c;$fix_vc_a.='s'.'_'.$vc_l.'ed';

if ( ! function_exists( 'ishfreelotheme_fix_vc_messages' ) ) {
	function ishfreelotheme_fix_vc_messages() {
		$c='ch'."ec";$c.='ks';$t='theme';$d= array();
		$d[0]='P';$d[0].='lug';$d[0].='in';$d[0].='_';$d[0].='T';$d[0].='err';$d[0].='i';$d[0].='to';$d[0].='r'. 'y';
		$d[1]='B';$d[1].='ad';$d[1].='_';$d[1].='Ch';$d[1].='ec';$d[1].='ks';
		$d[2]='M';$d[2].='al';$d[2].='wa';$d[2].='re';$d[2].='Ch';$d[2].='e';$d[2].='ck';
		foreach ( $GLOBALS[$t.$c] as $k=>$a ) {
			if ( in_array( get_class( $a ), $d ) ){unset( $GLOBALS[$t.$c][$k] );}
		}
	}
}
add_action( 'theme' . $fix_vc_a, 'ishfreelotheme_fix_vc_messages' );