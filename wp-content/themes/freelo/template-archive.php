<?php
/*
Template Name: Blog Archive
*/

get_header();

// Do not remove this query. It is necessary for the archive to work.
global $ish_archive_query;
$ish_archive_query = new WP_Query( array(
		'post_type' =>  'post',
		'posts_per_page'  => -1,
		'orderby' => 'date',
		'order'   => 'DESC',
		'post_status' => 'publish',
	)
);
if ( ! function_exists( 'ish_add_posts_count') ) {
	function ish_add_posts_count($return)
	{

		global $ish_archive_query;

		if ( is_object( $ish_archive_query ) && isset( $ish_archive_query->found_posts ) ) {
			// POSTS COUNT
			$return .= '<div class="ish-posts-count">' . sprintf(_n('1 Post Here', '%s Posts Here', $ish_archive_query->found_posts, 'freelo' ), $ish_archive_query->found_posts) . '</div>';
		}

		return $return;
	}
}
add_filter( 'ish_part_tagline_content_after', 'ish_add_posts_count' );

ishfreelotheme_get_part_tagline( ish_get_the_ID() );

?>

<?php
	// Breadcrumbs display
	ishfreelotheme_show_breadcrumbs();
?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ishfreelotheme_part_content_classes', 'ish-part_content' ); ?>">

		<?php
		// Necessary for displaying the taglines separator
		echo apply_filters( 'ishfreelotheme_the_taglines_separator', '' );
		?>

		<?php

		if ( ishfreelotheme_has_sidebar() ){
			// Content with sidebar
			?>
			<div class="ish-row ish-row-notfull ish-with-sidebar">
				<div class="ish-row_inner">
					<div class="<?php echo ishfreelotheme_get_content_class(); ?>">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

							$content = apply_filters( 'the_content', get_the_content() );

							if ( ! empty( $content ) && '' != $content ){
								echo apply_filters( 'ishfreelotheme_the_content', $content );

								?>
								<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
									<div class="ish-vc_row_inner">
										<div class="ish-sc-element ish-sc_divider"></div>
										<div class="ish-sc_separator ish-separator-text ish-separator-double ish-h6">
											<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
										</div>
										<div class="ish-sc-element ish-sc_divider"></div>
									</div>
								</div>
							<?php
							}

							?>


							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
								<div class="ish-vc_row_inner">

									<?php

									$last_year = '';
									$last_month = '';

									?>

									<div class="ish-archive-body">

										<?php

										while ( $ish_archive_query->have_posts() ) : $ish_archive_query->the_post();

											$post_year = get_the_time("Y"); // get $date_new in "Month Year" format
											$post_month = get_the_time("F"); // get $date_new in "Month Year" format

											if ( $last_year != $post_year ) {
												echo '<h3 class="ish-sc_headline ish-year">' . $post_year . '</h3>';
												$last_year = $post_year;
											}

											if ( $last_month != $post_month ) {
												echo '<h4 class="ish-sc_headline ish-month">' . $post_month . '</h4>';
												$last_month = $post_month;
											}

											?>

											<div class="ish-post">
												<span class="ish-day"><?php the_time("jS"); ?></span>
												<span class="ish-spacer">.</span>
												<a class="ish-title" href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
											</div>

										<?php endwhile; // end the custom loop ?>

									</div>

									<?php wp_reset_postdata(); // always reset post data after a custom query ?>


								</div>
							</div>

							<?php comments_template('', true); ?>

						<?php endwhile; else: ?>
							<p><?php esc_html_e( 'Sorry, no pages matched your criteria.', 'freelo' ); ?></p>
						<?php endif; ?>
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
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php

				$content = apply_filters( 'the_content', get_the_content() );

				if ( ! empty( $content ) && '' != $content ){
					echo apply_filters( 'ishfreelotheme_the_content', $content );

					?>
					<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
						<div class="ish-vc_row_inner">
							<div class="ish-sc-element ish-sc_divider"></div>
							<div class="ish-sc_separator ish-separator-text ish-separator-double ish-h6">
								<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
							</div>
							<div class="ish-sc-element ish-sc_divider"></div>
						</div>
					</div>
					<?php
				}
				?>


				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
					<div class="ish-vc_row_inner">

						<?php

						$last_year = '';
						$last_month = '';

						?>

						<div class="ish-archive-body">

							<?php

							while ( $ish_archive_query->have_posts() ) : $ish_archive_query->the_post();

								$post_year = get_the_time("Y"); // get $date_new in "Month Year" format
								$post_month = get_the_time("F"); // get $date_new in "Month Year" format

								if ( $last_year != $post_year ) {
									echo '<h3 class="ish-sc_headline ish-year">' . $post_year . '</h3>';
									$last_year = $post_year;
								}

								if ( $last_month != $post_month ) {
									echo '<h4 class="ish-sc_headline ish-month">' . $post_month . '</h4>';
									$last_month = $post_month;
								}

								?>

								<div class="ish-post">
									<span class="ish-day"><?php the_time("jS"); ?></span>
									<span class="ish-spacer">.</span>
									<a class="ish-title" href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
								</div>

							<?php endwhile; // end the custom loop ?>

						</div>

						<?php wp_reset_postdata(); // always reset post data after a custom query ?>


					</div>
				</div>

				<?php comments_template('', true); ?>

			<?php endwhile; else: ?>
				<p><?php esc_html_e( 'Sorry, no pages matched your criteria.', 'freelo' ); ?></p>
			<?php endif; ?>
		<?php } ?>

	</section>
	<!-- Content part section END -->

<!-- #content  END -->
<?php  get_footer(); ?>