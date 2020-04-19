<?php

/*
 * Get header.php
 */
get_header();

if ( ishfreelotheme_first_post_featured() && have_posts() && !is_paged() ){
	the_post();

	$title = get_the_title();
	$lead = '<h1 data-firstletter="' . $title[0] . '">' . $title . '</h1>';

	ishfreelotheme_get_featured_post_part_tagline( get_the_ID(), true, true );

}
else{
	// No featured post to be displayed

	$page = get_post( get_option( 'page_for_posts' ) );

	if ( 'page' == get_option('show_on_front') ){
		ishfreelotheme_get_part_tagline( $page->ID );
	}
	else{
		$blog_name = get_bloginfo('name');
		$lead = '<h1 data-firstletter="' . $blog_name[0] . '">' . $blog_name . '</h1>';
		ishfreelotheme_custom_part_tagline( $lead );
	}
}

$page = get_post( get_option( 'page_for_posts' ) );


// Breadcrumbs display
ishfreelotheme_show_breadcrumbs();
?>
	<?php
		$ish_blog_style = ( isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options['blog_overview_style'] ) ) ? $ishfreelotheme_options['blog_overview_style']  : 'classic';
		$blog_cols = ( isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options['blog_masonry_columns'] ) && 'masonry' == $ish_blog_style ) ? $ishfreelotheme_options['blog_masonry_columns']  : '';
		$masonry_layout = ( 'masonry' == $ish_blog_style && isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options['blog_masonry_layout_style'] ) ) ? ( ' ish-blog-masonry-layout-' . $ishfreelotheme_options['blog_masonry_layout_style'] )  : '';
		$blog_align = ( 'classic' == $ish_blog_style && isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options['blog_classic_align'] ) ) ? ' ish-blog-align-' . $ishfreelotheme_options['blog_classic_align'] : '';
	?>
	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ishfreelotheme_part_content_classes', 'ish-part_content ish-blog ish-blog-' . $ish_blog_style . $masonry_layout . $blog_align ); ?>"<?php echo ( '' != $blog_cols) ? ' data-count="' . esc_attr( $blog_cols ) . '"' : '' ; ?>>



		<?php if ( 'page' == get_option('show_on_front') && isset($page) && '' != $page && '' != $page->post_content) {?>
			<?php
				$content = apply_filters( 'the_content', $page->post_content );
				echo apply_filters( 'ishfreelotheme_the_content', $content );
			?>
		<?php } else {?>

			<?php
			// Necessary for displaying the taglines separator
			echo apply_filters( 'ishfreelotheme_the_taglines_separator', '' );
			?>
		<?php } ?>

		<?php
		if ( ishfreelotheme_has_sidebar() ){
			// Content with sidebar
			?>
			<div class="ish-row ish-row-notfull ish-with-sidebar">
				<div class="ish-row_inner">
					<div class="<?php echo ishfreelotheme_get_content_class(); ?>">
						<?php if (have_posts()) {


							/*if ( 'masonry' == $ish_blog_style ){
								echo '<span class="ish-preloader"></span>';
							}*/

							echo ishfreelotheme_blog_categories();

							/*if ( 'masonry' == $ish_blog_style ){
								$mass_row_style = ( isset( $ishfreelotheme_options['blog_masonry_row_style'] ) && 'full' == $ishfreelotheme_options['blog_masonry_row_style'] ) ? ' ish-row-full' : ' ish-row-notfull';
								echo '<div class="wpb_row vc_row-fluid ' . $mass_row_style . ' ish-row_notsection ish-masonry-container"><div class="ish-vc_row_inner"><div class="ish-packery">';
							}*/

							while (have_posts()) {

								the_post();

								$ish_post_per_page = $wp_query->post_count;
								$ish_post_current = $wp_query->current_post;
								$format = get_post_format();
								if( false === $format ) { $format = 'standard'; }
								get_template_part( 'content-post', $format );

							}

							/*if ('masonry' == $ish_blog_style ){
								echo '</div></div></div>';
							}*/

							if(empty($paged) || 0 == $paged) $paged = 1;

							$pg = ishfreelotheme_get_pagination('', 3, $wp_query->max_num_pages, $paged);
							if ('' != $pg){
							?>
								<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
									<div class="ish-vc_row_inner">
										<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double ish-separator-home-pagination">
											<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
										</div>
										<?php
										echo apply_filters( 'ishfreelotheme_pagination_output', $pg );
										?>
									</div>
								</div>
							<?php
							}
						} else {  ?>

							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
								<div class="ish-vc_row_inner">
									<?php esc_html_e( 'Sorry, there is nothing to be displayed in here.', 'freelo' ); ?>
								</div>
							</div>

						<?php }?>
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
			if (have_posts()) {

				/*if ( 'masonry' == $ish_blog_style ){
					echo '<span class="ish-preloader"></span>';
				}*/

				echo ishfreelotheme_blog_categories();

				/*if ( 'masonry' == $ish_blog_style ){
					$mass_row_style = ( isset( $ishfreelotheme_options['blog_masonry_row_style'] ) && 'full' == $ishfreelotheme_options['blog_masonry_row_style'] ) ? ' ish-row-full' : ' ish-row-notfull';
					echo '<div class="wpb_row vc_row-fluid ' . $mass_row_style . ' ish-row_notsection ish-masonry-container"><div class="ish-vc_row_inner"><div class="ish-packery">';
				}*/

				while (have_posts()) {

					the_post();

					$ish_post_per_page = $wp_query->post_count;
					$ish_post_current = $wp_query->current_post;
					$format = get_post_format();
					if( false === $format ) { $format = 'standard'; }
					get_template_part( 'content-post', $format );

				}

				/*if ('masonry' == $ish_blog_style ){
					echo '</div></div></div>';
				}*/

				if(empty($paged) || 0 == $paged) $paged = 1;

				$pg = ishfreelotheme_get_pagination('', 3, $wp_query->max_num_pages, $paged);
				if ('' != $pg){
				?>
					<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
						<div class="ish-vc_row_inner">
							<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double ish-separator-home-pagination">
								<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
							</div>
							<?php
							echo apply_filters( 'ishfreelotheme_pagination_output', $pg );
							?>
						</div>
					</div>
				<?php
				}
			} else {  ?>

				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
					<div class="ish-vc_row_inner">
						<?php esc_html_e( 'Sorry, there is nothing to be displayed in here.', 'freelo' ); ?>
					</div>
				</div>

			<?php }
		} ?>
	</section>
	<!-- Content part section END -->

<?php

/*
 * Get footer.php
 */
get_footer();

?>