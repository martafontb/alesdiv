<?php

if ( ! is_single() ) { ?>

	<?php
	global $ish_blog_style, $wp_query, $ishfreelotheme_blog_post_order, $ish_post_per_page, $ish_post_current;

	$ishfreelotheme_blog_post_order++;
	$ish_color_data = ishfreelotheme_get_color_data();
	$ish_last_post_in_page = '';


	if ( ( $ish_post_current + 1 ) == $ish_post_per_page ) {
		$ish_last_post_in_page = 'ish-last-post';
	}

	$display_taglines = IshYoMetaBox::get( 'use_taglines', true, get_the_ID() );
	$tagline_1 = $tagline_2 = '';
	if ( 'true' == $display_taglines ) {
		$tagline_1 = esc_html( IshYoMetaBox::get( 'tagline_1', true, get_the_ID() ) );
		$tagline_2 = esc_html( IshYoMetaBox::get( 'tagline_2', true, get_the_ID() ) );
	}

	// FULL_WIDTH
	if ( 'fullwidth' == $ish_blog_style ){

	}

	// 2 Columns
	elseif ( '2columns' == $ish_blog_style ){

		// set colors for media from tagline
		$ish_tagline_text_color = ( '' != $ish_color_data['text_class'] ) ? $ish_color_data['text_class'] : ' ish-text-color4';
		$ish_tagline_bg_color = ( '' != $ish_color_data['bg_class'] ) ? $ish_color_data['bg_class'] : ' ish-color5';

		// alignment of post
		$ish_content_align = ( $ishfreelotheme_blog_post_order % 2 ) ? 'ish-content-align-right' : 'ish-content-align-left';

		$post_image = ishfreelotheme_get_2columns_post_thumbnail();

		?>
		<div
			id="post-<?php the_ID(); ?>" <?php post_class('wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ' . $ish_content_align . ' ' . $ish_last_post_in_page); ?>>
			<div class="ish-vc_row_inner">
				<div class="ish-display-table">

					<?php
					// content of post
					$ish_post_content = '';
					$ish_post_content .= '<div class="ish-post-content' . $ish_tagline_bg_color . $ish_tagline_text_color . ' ish-grid6">';
					$ish_post_content .= '<div class="ish-blog-post-content">';

					if ('true' == $display_taglines && ('' != $tagline_1 || '' != $tagline_2)) {
						if ('' != $tagline_1) {
							$ish_post_content .= '<h2 class="ish-h4"><a href="' . get_the_permalink() . '">' . $tagline_1 . '</a></h2>';
						}
						/* if ( '' != $tagline_2 ){ echo '<h3 class="ish-h5">' . $tagline_2 . '</h3>'; } */
					} else {
						$ish_post_content .= '<h2 class="ish-h4"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>';
					}

					$ish_post_content .= ishfreelotheme_get_post_details();

					$ish_post_content .= ishfreelotheme_get_blog_excerpt(15);

					$ish_post_content .= '<span class="ish-blog-post-links">';
					$ish_post_content .= '<a class="ish-read-more" href="' . get_the_permalink() . '">' . esc_html__( 'Read more >', 'freelo' ) . '</a>';
					$ish_post_content .= '</span>';

					$ish_post_content .= '</div>';
					$ish_post_content .= '</div>';

					// media of post
					$ish_post_media = '';
					$ish_post_media .= '<div class="ish-post-media ish-grid6' . $ish_tagline_text_color . $ish_tagline_bg_color . '">';

					if ( '' != esc_attr(ishfreelotheme_get_post_format_url_text()) ) {

						if ( has_post_thumbnail() ) {
							$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'theme-large' );
							$ish_post_media .= '<div class="ish-blog-post-media" style="background-image: url(' . $img_details[0] . ');">';
						}
						else {
							$ish_post_media .= '<div class="ish-blog-post-media">';
						}

						$ish_post_media .= '<a href="' . esc_attr( ishfreelotheme_get_post_format_url() ) . '" target="_blank" class="ish-link-media">';
						$ish_post_media .= '<h3 class="ish-format-link-url ish-h4 ish-post-title ish-blog-link-content">';
						$ish_post_media .= ishfreelotheme_get_post_format_url_text();
						$ish_post_media .= '</h3>';
						$ish_post_media .= '</a>';
					}
					else {
						if ( has_post_thumbnail() ) {
							$ish_post_media .= '<div class="ish-blog-post-media">';
							$ish_post_media .= $post_image;
						}
						else {
							$ish_post_media .= '<div class="ish-blog-post-media">';
								$ish_post_media .= '<a href="' . get_permalink() . '" class="ish-link-media">';
									$ish_post_media .= '<h3 class="ish-format-link-url ish-h4 ish-link-read-more">';
										$ish_post_media .= esc_html__( 'Read More', 'freelo' );
									$ish_post_media .= '</h3>';
								$ish_post_media .= '</a>';
						}
					}


					$ish_post_media .= '</div>';
					$ish_post_media .= '</div>';


					if ( $ishfreelotheme_blog_post_order % 2 ) {
						echo apply_filters( 'ishfreelotheme_post_content_output', $ish_post_content );
						echo apply_filters( 'ishfreelotheme_post_media_output', $ish_post_media );
					} else {
						echo apply_filters( 'ishfreelotheme_post_media_output', $ish_post_media );
						echo apply_filters( 'ishfreelotheme_post_content_output', $ish_post_content );
					}
					?>

				</div>
			</div>
		</div>

	<?php

	}


	// CLASSIC
	else {
		?>
		<div
			id="post-<?php the_ID(); ?>" <?php post_class('wpb_row vc_row-fluid ish-row-notfull ish-row_notsection '. $ish_last_post_in_page); ?>>
			<div class="ish-vc_row_inner">

				<div class="ish-post-content">

					<?php
					if ('true' == $display_taglines && ('' != $tagline_1 || '' != $tagline_2)) {
						if ('' != $tagline_1) {
							echo '<h2 class="ish-h3"><a href="' . get_the_permalink() . '">' . $tagline_1 . '</a></h2>';
						}
						/* if ( '' != $tagline_2 ){ echo '<h3 class="ish-h5">' . $tagline_2 . '</h3>'; } */
					} else {
						?>
						<h2 class="ish-h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php
					}
					?>

					<?php echo ishfreelotheme_get_post_details() ?>

					<h3 class="ish-h3 ish-format-link-url">
						<a href="<?php echo esc_attr(ishfreelotheme_get_post_format_url()); ?>" target="_blank">
							<?php echo ishfreelotheme_get_post_format_url_text(); ?>
						</a>
					</h3>

					<?php echo ishfreelotheme_get_blog_excerpt(50); ?>

					<span class="ish-blog-post-links">
						<a class="ish-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'freelo' ); ?></a>
					</span>

				</div>

			</div>
		</div>

	<?php
	}
} else {
	// BLOG SINGLE VIEW - BLOG DETAIL
	ishfreelotheme_the_content();
}