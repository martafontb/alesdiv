<?php
/*
 * Get header.php
 */
get_header();


if ( is_category() || is_tag() || is_archive() ) {
	if ( is_category() ){
		$current_term = get_queried_object();
		$return = '<div class="ish-archive-lead ish-category-lead">';

		$title = esc_html__( 'Category: ', 'freelo' ) . '<span>' . $current_term->name . '</span>';
		$data = do_shortcode( $current_term->description );
		$post_count = '';

		// Title
		$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

		// Description
		$description = ( '' != $data  ) ? '<div class="ish-category-description">' . $data . '</div>' : '';

		// POSTS COUNT
		$data = $current_term->count;
		if ( $data && '' != $data ) {
			$post_count .= '<div class="ish-posts-count">' . sprintf( _n( '1 Post Here', '%s Posts Here', $data, 'freelo' ), $data ) . '</div>';
		}
	}
	elseif (is_tag()){
		$current_term = get_queried_object();
		$return = '<div class="ish-archive-lead ish-tag-lead">';

		$title = esc_html__( 'Tag: ', 'freelo' )  . '<span>' . $current_term->name . '</span>';
		$data = do_shortcode( $current_term->description );
		$post_count = '';

		// Title
		$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

		// Description
		$description = ( '' != $data  ) ? '<div class="ish-tag-description">' . $data . '</div>' : '';

		// POSTS COUNT
		$data = $current_term->count;
		if ( $data && '' != $data ) {
			$post_count .= '<div class="ish-posts-count">' . sprintf( _n( '1 Post Here', '%s Posts Here', $data, 'freelo' ), $data ) . '</div>';
		}
	}
	elseif (is_archive()) {

		if ( is_day() ) {
			$return = '<div class="ish-archive-lead ish-day-lead">';
			$title = sprintf( esc_html__( 'Daily Archives: %s', 'freelo' ), '<span>' . get_the_date() . '</span>');
			$data = '';
			$post_count = '';

			// Title
			$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

			// POSTS COUNT
			$data = $GLOBALS['wp_query']->found_posts;
			if ($data && '' != $data) {
				$post_count .= '<div class="ish-posts-count">' . sprintf(_n('1 Post Here', '%s Posts Here', $data, 'freelo' ), $data) . '</div>';
			}
		}
		elseif (is_month()) {
			$return = '<div class="ish-archive-lead ish-month-lead">';
			$title = sprintf( esc_html__( 'Monthly Archives: %s', 'freelo' ), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'freelo' )) . '</span>');
			$data = '';
			$post_count = '';

			// Title
			$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

			// POSTS COUNT
			$data = $GLOBALS['wp_query']->found_posts;
			if ($data && '' != $data) {
				$post_count .= '<div class="ish-posts-count">' . sprintf(_n('1 Post Here', '%s Posts Here', $data, 'freelo' ), $data) . '</div>';
			}

		}
		elseif (is_year()) {
			$return = '<div class="ish-archive-lead ish-year-lead">';
			$title = sprintf( esc_html__( 'Yearly Archives: %s', 'freelo' ), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'freelo' )) . '</span>');
			$data = '';
			$post_count = '';

			// Title
			$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

			// POSTS COUNT
			$data = $GLOBALS['wp_query']->found_posts;
			if ($data && '' != $data) {
				$post_count .= '<div class="ish-posts-count">' . sprintf(_n('1 Post Here', '%s Posts Here', $data, 'freelo' ), $data) . '</div>';
			}
		}
		elseif (is_author()) {
			$return = '<div class="ish-archive-lead ish-author-lead">';
			global $post, $authordata;
			if (!is_object($authordata)) {
				if (isset($post->post_author)) {
					$authordata = get_userdata($post->post_author);
				}
			}
			$post_count = '';


			// AUTHOR NAME
			$title = sprintf( esc_html__( 'Author: %s', 'freelo' ), '<span>' . get_the_author_meta('display_name') . '</span>');
			$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

			// AUTHOR AVATAR
			if ( 'box' == $ishfreelotheme_options['title_area_style'] ) {
				$avatar = '<div class="ish-author-avatar">' . get_avatar( $authordata->ID, 70 ) . '</div>';
				$title  = $avatar . $title;
			}

			// AUTHOR BIO
			$data = get_the_author_meta('description');
			$description = ( '' != $data  ) ? '<div class="ish-author-description">' . $data . '</div>' : '';

			// AUTHOR SOCIAL ICONS
			if ( 'box' == $ishfreelotheme_options['title_area_style'] ) {
				$description = ishfreelotheme_get_author_social_icons() . $description;
			}
			else{
				$description .= ishfreelotheme_get_author_social_icons();
			}


			// AUTHOR POSTS COUNT
			$data = count_user_posts($authordata->ID);
			if ($data && '' != $data) {
				$post_count .= '<div class="ish-posts-count">' . sprintf(_n('1 Post Here', '%s Posts Here', $data, 'freelo' ), $data) . '</div>';
			}
		}
		else {
			$return = '<div class="ish-archive-lead ish-day-lead">';
			$title = esc_html__( 'Archives', 'freelo' );
			$data = '';
			$post_count = '';

			// Title
			$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

			// POSTS COUNT
			$data = $GLOBALS['wp_query']->found_posts;
			if ($data && '' != $data) {
				$post_count .= '<div class="ish-posts-count">' . sprintf(_n('1 Post Here', '%s Posts Here', $data, 'freelo' ), $data) . '</div>';
			}
		}
	}

	global $ishfreelotheme_options;

	if ( 'box' != $ishfreelotheme_options['title_area_style'] ) {

		if ( isset( $description ) && '' != $description ) {
			// 2 Columns Layout

			$return .= '<div class="wpb_row ish-valign-middle"><div class="ish-vc_row_inner">';
			$return .= '<div class="wpb_column ish-grid1"></div>';

			$return .= '<div class="wpb_column ish-grid5 ish-pt-taglines">';
			$return .= $title;
			$return .= $post_count;
			$return .= '</div>';

			$return .= '<div class="wpb_column ish-grid5 ish-pt-taglines-additional">';
			$return .= $description;
			$return .= $post_count;
			$return .= '</div>';

			$return .= '<div class="wpb_column ish-grid1"></div>';

			$return .= '</div></div>';
		} else {
			// 1 Column Layout
			$return .= '<div class="wpb_column ish-grid1"></div>';
			$return .= '<div class="wpb_column ish-grid10">';
			$return .= $title;
			$return .= $post_count;
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
			$return .= $post_count;
		} else {
			$return .= $title;
			$return .= $post_count;
		}

		$return .= '</div>';
		ishfreelotheme_custom_part_tagline( $return, $ishfreelotheme_options['title_area_style'] );
	}



}
else{
	ishfreelotheme_get_part_tagline(get_the_ID());
}

?>

<?php
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
						<?php if (have_posts()) {

							if ( 'masonry' == $ish_blog_style ){
								echo '<span class="ish-preloader"></span>';
							}

							if ( is_category() ){
								echo ishfreelotheme_blog_categories();
							}

							if ('masonry' == $ish_blog_style ){
								$mass_row_style = ( isset( $ishfreelotheme_options['blog_masonry_row_style'] ) && 'full' == $ishfreelotheme_options['blog_masonry_row_style'] ) ? ' ish-row-full' : ' ish-row-notfull';
								echo '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-masonry-container"><div class="ish-vc_row_inner"><div class="ish-packery">';
							}

							while (have_posts()) {

								the_post();

								$ish_post_per_page = $wp_query->post_count;
								$ish_post_current = $wp_query->current_post;
								$format = get_post_format();
								if( false === $format ) { $format = 'standard'; }
								get_template_part( 'content-post', $format );

							}

							if ('masonry' == $ish_blog_style ){
								echo '</div></div></div>';
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

							<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
								<div class="ish-vc_row_inner">
									<?php esc_html_e( 'Sorry, there is nothing to be displayed in here.', 'freelo' ); ?>
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

			if (have_posts()) {

				if ( 'masonry' == $ish_blog_style ){
					echo '<span class="ish-preloader"></span>';
				}

				if ( is_category() ){
					echo ishfreelotheme_blog_categories();
				}

				if ('masonry' == $ish_blog_style ){
					$mass_row_style = ( isset( $ishfreelotheme_options['blog_masonry_row_style'] ) && 'full' == $ishfreelotheme_options['blog_masonry_row_style'] ) ? ' ish-row-full' : ' ish-row-notfull';
					echo '<div class="wpb_row vc_row-fluid ' . $mass_row_style . ' ish-row_notsection ish-masonry-container"><div class="ish-vc_row_inner"><div class="ish-packery">';
				}

				while (have_posts()) {

					the_post();

					$ish_post_per_page = $wp_query->post_count;
					$ish_post_current = $wp_query->current_post;
					$format = get_post_format();
					if( false === $format ) { $format = 'standard'; }
					get_template_part( 'content-post', $format );

				}

				if ('masonry' == $ish_blog_style ){
					echo '</div></div></div>';
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

				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
					<div class="ish-vc_row_inner">
						<?php esc_html_e( 'Sorry, there is nothing to be displayed in here.', 'freelo' ); ?>
					</div>
				</div>

			<?php }

		}?>



	</section>
	<!-- Content part section END -->

<?php

/*
 * Get footer.php
 */
get_footer();

?>
