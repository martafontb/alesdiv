<?php

/*
 * Get header.php
 */
get_header();

?>

<?php

if (is_category()){
    $current_term = get_queried_object();
    $lead = '<div class="category-lead post-category-lead">';
    $lead .= '<h1 class="color1" data-firstletter="' . $current_term->nam[0] . '">' . $current_term->name . '</h1>';
    $lead .= ('' != do_shortcode($current_term->description)) ? do_shortcode($current_term->description) : '';
    $lead .= '</div>';
    ishfreelotheme_custom_part_tagline($lead);
}
elseif (is_tag()){
    $current_term = get_queried_object();
    $lead = '<div class="tag-lead post-tag-lead">';
    $lead .= '<h1 class="color1" data-firstletter="' . $current_term->nam[0] . '">' . $current_term->name . '</h1>';
    $lead .= ('' != do_shortcode($current_term->description)) ? do_shortcode($current_term->description) : '';
    $lead .= '</div>';
    ishfreelotheme_custom_part_tagline($lead);
}
elseif (is_archive()){
    $lead = '<div class="archive-lead post-archive-lead"><h1 class="color1"';
    if ( is_day() ) :
	    $lead .= ' data-firstletter="D">';
        $lead .= sprintf( esc_html__( 'Daily Archives: %s', 'freelo' ), '<span>' . get_the_date() . '</span>' );
    elseif ( is_month() ) :
	    $lead .= ' data-firstletter="M">';
        $lead .= sprintf( esc_html__( 'Monthly Archives: %s', 'freelo' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'freelo' ) ) . '</span>' );
    elseif ( is_year() ) :
	    $lead .= ' data-firstletter="Y">';
        $lead .= sprintf( esc_html__( 'Yearly Archives: %s', 'freelo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'freelo' ) ) . '</span>' );
    else :
	    $lead .= ' data-firstletter="A">';
        $lead .= esc_html__( 'Archives', 'freelo' );
    endif;
    $lead .= '</h1>';
    ishfreelotheme_custom_part_tagline($lead);
}
else{
	ishfreelotheme_get_part_tagline( ish_get_the_ID() );
}
?>

<?php
	// Breadcrumbs display
	ishfreelotheme_show_breadcrumbs();
?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ishfreelotheme_part_content_classes', 'ish-part_content' ); ?>">

		<?php

		if ( ishfreelotheme_has_sidebar() ){
			// Content with sidebar
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