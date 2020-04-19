<?php

get_header();

?>

<?php ishfreelotheme_get_part_tagline( ish_get_the_ID() ); ?>

<?php ishfreelotheme_show_breadcrumbs(); ?>

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
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php ishfreelotheme_the_content(); ?>

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
				<?php ishfreelotheme_the_content(); ?>

				<?php comments_template('', true); ?>

			<?php endwhile; else: ?>
				<p><?php esc_html_e( 'Sorry, no pages matched your criteria.', 'freelo' ); ?></p>
			<?php endif; ?>
		<?php } ?>

	</section>
	<!-- Content part section END -->

<!-- #content  END -->
<?php  get_footer(); ?>