<?php

/*
 * Get header.php
 */
get_header();

// Get Framework settings & Sidebar width options, do not remove!
global $ishfreelotheme_options, $ishfreelotheme_sidebar_width, $ishfreelotheme_sidebar_area;


?>

<?php ishfreelotheme_get_part_tagline( ish_get_the_ID() ); ?>

<?php
// Breadcrumbs display
ishfreelotheme_show_breadcrumbs();
?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ishfreelotheme_part_content_classes', 'ish-part_content' ); ?>">

		<?php

		if ( ishfreelotheme_has_sidebar() ){
			// Content with sidebar

			// Necessary for displaying the taglines separator
			echo apply_filters( 'ishfreelotheme_the_taglines_separator', '' );

			?>
			<div class="ish-row ish-row-notfull ish-with-sidebar">
				<div class="ish-row_inner">
					<div class="<?php echo ishfreelotheme_get_content_class(); ?>">
						<?php if (have_posts()) {

							while (have_posts()) {

								the_post();

								$ish_post_per_page = $wp_query->post_count;
								$ish_post_current = $wp_query->current_post;
								$format = get_post_format();
								if( false === $format ) { $format = 'standard'; }
								get_template_part( 'content-post', $format );

							}
							?>

							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-blog-categories-container">
								<div class="ish-vc_row_inner">
									<?php
									echo ishfreelotheme_get_all_post_details( ish_get_the_ID() );//ishfreelotheme_get_categories_and_tags( ish_get_the_ID() );
									?>
								</div>
							</div>

							<?php if ( isset( $ishfreelotheme_options['single_post_details'] ) && '' != $ishfreelotheme_options['single_post_details'] ){

							$class = ' ish-display-' . $ishfreelotheme_options['single_post_details'];
							?>

								<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-blog-prevnext-container<?php echo esc_attr( $class ); ?>">
									<div class="ish-vc_row_inner">
										<div class="ish-display-table">
											<?php
											ishfreelotheme_blogpost_prev_next();
											ishfreelotheme_show_addthis();
											?>
										</div>

									</div>
								</div>

							<?php
							}
							?>

							<?php
							$related = '';

							$mycat = get_the_category();
							$mycat = ( is_array( $mycat ) && is_object($mycat[0]) ) ? $mycat[0]->slug : '';
							$related = do_shortcode('[ish_recent_posts visual_style="fullwidth" boxed_content="boxed" columns="1" count="3" color="none" text_color="none" contents_color="none" tooltip_color="color1" tooltip_text_color="color3" show_comments="no" show_likes="no" show_categories="no" show_reading_time="no" category="' . $mycat . '" post_ids_exclude="' . get_the_ID() . '"]');
							if ( '' != $related ) {
								?>
								<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-blog-related-posts-container">
									<div class="ish-vc_row_inner">
										<div class="ish-sc_separator ish-separator-text ish-separator-double ish-h6">
											<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
										</div>
										<h4 class="ish-related-headline ish-h4"><?php echo esc_html__( 'Related posts', 'freelo' ); ?></h4>
										<?php
										echo apply_filters( 'ishfreelotheme_single_post_related_posts_output', $related );
										?>
									</div>
								</div>
							<?php } ?>

							<?php comments_template('', true); ?>

						<?php

						} else {  ?>

							<div id="post-0" <?php post_class(); ?>>

								<h2 class="entry-title"><?php esc_html_e( 'Error 404 - Page Not Found', 'freelo' ) ?></h2>

								<div class="entry-content">
									<p><?php esc_html_e("Sorry, the content you are looking for could not be found.", 'freelo' ) ?></p>
								</div>

							</div>

						<?php } ?>
					</div>

					<?php
					// SIDEBAR
					get_sidebar();
					?>

				</div>
			</div>
		<?php
		} else {
			// Content with no sidebar
			?>
			<?php if (have_posts()) {

				while (have_posts()) {

					the_post();

					$ish_post_per_page = $wp_query->post_count;
					$ish_post_current = $wp_query->current_post;
					$format = get_post_format();
					if( false === $format ) { $format = 'standard'; }
					get_template_part( 'content-post', $format );

				}

				?>
				<?php if ( has_category() || has_tag() ) { ?>
					<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-blog-categories-container">
						<div class="ish-vc_row_inner">
							<?php
							echo ishfreelotheme_get_all_post_details( ish_get_the_ID() ); //ishfreelotheme_get_categories_and_tags( ish_get_the_ID() );
							?>
						</div>
					</div>
				<?php } ?>
				<?php if ( isset( $ishfreelotheme_options['single_post_details'] ) && '' != $ishfreelotheme_options['single_post_details'] ){

					$class = ' ish-display-' . $ishfreelotheme_options['single_post_details'];
					?>

					<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-blog-prevnext-container<?php echo esc_attr( $class ); ?>">
						<div class="ish-vc_row_inner">
							<div class="ish-display-table">
								<?php
								ishfreelotheme_blogpost_prev_next();
								ishfreelotheme_show_addthis();
								?>
							</div>

						</div>
					</div>

					<?php
				}
				?>

				<?php
				$related = '';

				$mycat = get_the_category();
				$mycat = ( is_array( $mycat ) && is_object($mycat[0]) ) ? $mycat[0]->slug : '';
				$related = do_shortcode('[ish_recent_posts visual_style="fullwidth" boxed_content="boxed" columns="1" count="3" color="none" text_color="none" contents_color="none" tooltip_color="color1" tooltip_text_color="color3" show_comments="no" show_likes="no" show_categories="no" show_reading_time="no" category="' . $mycat . '" post_ids_exclude="' . get_the_ID() . '"]');
				if ( '' != $related && shortcode_exists( 'ish_recent_posts' ) ) {
				?>
				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-blog-related-posts-container">
					<div class="ish-vc_row_inner">
						<div class="ish-sc_separator ish-separator-text ish-separator-double ish-h6">
							<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
						</div>
						<h4 class="ish-related-headline ish-h4"><?php echo esc_html__( 'Related posts', 'freelo' ); ?></h4>
						<?php
							echo apply_filters( 'ishfreelotheme_single_post_related_posts_output', $related );
						?>
					</div>
				</div>
				<?php } ?>

				<?php comments_template('', true); ?>

				<?php

			} else {  ?>

				<div id="post-0" <?php post_class(); ?>>

					<h2 class="entry-title"><?php esc_html_e( 'Error 404 - Page Not Found', 'freelo' ) ?></h2>

					<div class="entry-content">
						<p><?php esc_html_e("Sorry, the content you are looking for could not be found.", 'freelo' ) ?></p>
					</div>

				</div>

			<?php } ?>
		<?php } ?>

	</section>
	<!-- Content part section END -->

<?php

/*
 * Get footer.php
 */
get_footer();

?>