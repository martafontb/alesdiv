<?php

get_header();

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

						<?php
						if ( isset( $ishfreelotheme_options['single_portfolio_details'] ) && '' != $ishfreelotheme_options['single_portfolio_details'] ){
							?>

							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-portfolio-prevnext-container">
								<div class="ish-vc_row_inner">
									<!--<div class="ish-sc_separator ish-separator-text ish-separator-double ish-separator-prev-next-social">
										<span class="ish-line ish-left">
											<span class="ish-line-border">
											</span>
										</span>
									</div>-->
									<div class="ish-display-table">
										<?php
										ishfreelotheme_portfolio_post_prev_next();
										ishfreelotheme_portfolio_show_addthis();
										?>
									</div>
								</div>
							</div>

						<?php
						}
						?>

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php ishfreelotheme_the_content(); ?>
						<?php endwhile; else: ?>
							<p><?php esc_html_e( 'Sorry, no pages matched your criteria.', 'freelo' ); ?></p>
						<?php endif; ?>

						<?php comments_template('', true); ?>

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

			<?php
			if ( isset( $ishfreelotheme_options['single_portfolio_details'] ) && '' != $ishfreelotheme_options['single_portfolio_details'] ){

				$class = ' ish-display-' . $ishfreelotheme_options['single_portfolio_details'];
				?>

				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-portfolio-prevnext-container<?php echo esc_attr( $class ); ?>">
					<div class="ish-vc_row_inner">
						<!--<div class="ish-sc_separator ish-separator-text ish-separator-double ish-separator-prev-next-social">
							<span class="ish-line ish-left">
								<span class="ish-line-border">
								</span>
							</span>
						</div>-->
						<div class="ish-display-table">
							<?php
							ishfreelotheme_portfolio_post_prev_next();
							ishfreelotheme_portfolio_show_addthis();
							?>
						</div>
					</div>
				</div>

			<?php
			}
			?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php ishfreelotheme_the_content(); ?>
			<?php endwhile; else: ?>
				<p><?php esc_html_e( 'Sorry, no pages matched your criteria.', 'freelo' ); ?></p>
			<?php endif; ?>

			<?php comments_template('', true); ?>

		<?php } ?>

	</section>
	<!-- Content part section END -->

<?php  get_footer();
