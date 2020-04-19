<?php

$ishfreelotheme_id_404 = ( isset( $ishfreelotheme_options['use_page_for_404'] ) && ( '1' == $ishfreelotheme_options['use_page_for_404'] ) && isset( $ishfreelotheme_options['page_for_404'] ) ) ? $ishfreelotheme_options['page_for_404'] : '';

get_header();

if ( '' != $ishfreelotheme_id_404 && '-1' != $ishfreelotheme_id_404 ){
	// 404 Page set in the backend
	ishfreelotheme_get_part_tagline( $ishfreelotheme_id_404 );

	// Breadcrumbs display
	ishfreelotheme_show_breadcrumbs();
	?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ishfreelotheme_part_content_classes', 'ish-part_content' ); ?>">

		<?php

		if ( ishfreelotheme_has_sidebar( $ishfreelotheme_id_404 ) ){
			// Content with sidebar
			?>
			<div class="ish-row ish-row-notfull ish-with-sidebar">
				<div class="ish-row_inner">
					<div class="<?php echo ishfreelotheme_get_content_class( $ishfreelotheme_id_404 ); ?>">
						<?php

						$my_post = get_post($ishfreelotheme_id_404);
						$content = apply_filters( 'the_content', $my_post->post_content );
						echo apply_filters( 'ishfreelotheme_the_content', $content );

						?>
					</div>

					<?php
					// SIDEBAR
					get_sidebar('404');
					?>

				</div>
			</div>
		<?php
		} else {
			// Content with no sidebar
			$my_post = get_post($ishfreelotheme_id_404);
			$content = apply_filters( 'the_content', $my_post->post_content );
			echo apply_filters( 'ishfreelotheme_the_content', $content );
			?>
		<?php } ?>

	</section>
	<!-- Content part section END -->

<?php }
else{
	// USE DEFAULT 404 TEMPLATE
	?>

	<?php
	// Breadcrumbs display
	//ishfreelotheme_show_breadcrumbs();
	?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ishfreelotheme_part_content_classes', 'ish-part_content' ); ?>">
		<div class="wpb_row vc_row-fluid ish-row-notfull ish-resp-centered ish-text-color1 ish-row_section">
			<div class="ish-row-overlay"></div>

			<div class="ish-vc_row_inner">
				<div class="vc_col-sm-12 wpb_column column_container ish-center">
					<div class="wpb_wrapper">
						<h1 class="ish-sc-element ish-sc_headline ish-bottom-margin-none ish-color5" style="font-size: 72px !important; line-height: 100px;">
							<?php echo esc_html__( '404 / Ooops!', 'freelo' ); ?></h1>

						<h3 class="ish-sc-element ish-sc_headline ish-color1">
							<?php echo esc_html__( "Seems like there's no such page.", 'freelo' ); ?>
						</h3>

						<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double">
							<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
						</div>

						<p>
							<?php echo esc_html__( "We've searched more than 404 pages and none of them seems to be the one you we're looking for.", 'freelo' ); ?><br>
							<?php echo esc_html__( "Why don't you have a look around and try to find it?", 'freelo' ); ?>
						</p>

						<form role="search" method="get" id="searchform" action="<?php echo esc_url( apply_filters( 'ishfreelotheme_searchform_url', home_url( '/' ) ) ); ?>" class="ish-404-search-field">
							<div>

								<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'freelo' ); ?></label>
								<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php esc_html_e( 'Search...', 'freelo' ); ?>">
								<input type="submit" id="searchsubmit" value="9">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Content part section END -->

<?php
}
?>

	<!-- #content  END -->
<?php  get_footer(); ?>