<?php

get_header();

//<!-- Lead part section -->

$return = '<div class="ish-archive-lead ish-search-lead">';
$title = sprintf( esc_html__( 'Search Results for: %s', 'freelo' ) ,  '<span>"' . get_search_query() . '"</span>' );
$data = '';
$post_count = '';

// Title
$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

// POSTS COUNT
$data = $GLOBALS['wp_query']->found_posts;
if ($data && '' != $data) {
	$post_count .= '<div class="ish-posts-count">' . sprintf(_n('1 Result Here', '%s Results Here', $data, 'freelo' ), $data) . '</div>';
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

//<!-- Lead part section -->

?>

<?php
	// Breadcrumbs display
	ishfreelotheme_show_breadcrumbs();
?>

	<!-- Content part section -->
	<section class="<?php echo apply_filters( 'ishfreelotheme_part_content_classes', 'ish-part_content' ); ?>">

		<?php if (have_posts()) :

			$results_count = 0;

			while (have_posts()) : the_post(); ?>

				<?php $results_count++; ?>

				<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-search-result">
					<div class="ish-vc_row_inner">
						<?php

						// THUMBNAIL
						if ( has_post_thumbnail() ) {

							echo '<div class="ish-sc-element ish-search-result-image ish-sc_image">';
							echo '<a href="' . get_permalink() . '">';
							the_post_thumbnail( 'thumbnail' );
							echo '</a>';
							echo '</div>';

						}
						else {

							// No thumbnail
							if ( is_plugin_active('ishyoboy-freelo-assets/ishyoboy-freelo-assets.php') ){
								echo '<div class="ish-sc-element ish-search-result-image ish-sc_svg_icon ish-square ish-color2">';
								echo '<a href="' . get_permalink() . '">';
								echo '<span><span class="ish-icon-doc-text-inv" style="width:70px;height:70px;"></span></span>';
								echo '</a></div>';
							}
							else{
								echo '<div class="ish-sc-element ish-search-result-image ish-sc_icon ish-square ish-color3 ish-text-color1" style="font-size:70px;width:70px;height:70px;">';
								echo '<a href="' . get_permalink() . '">';
								echo '<span style="width:70px;height:70px;"><span class="ish-icon-align-right" style="width:70px;height:70px;font-size:33.333333333333px;line-height:70px;"></span></span>';
								echo '</a></div>';
							}

						}
						?>

						<div class="search-details">

							<?php
							// TITLE
							$title = get_the_title();
							$title = ( ! empty( $title ) ) ? $title : esc_html__( 'No title', 'freelo' );
							?>
							<h5 class="ish-sc-element ish-sc_headline"><a href="<?php the_permalink(); ?>"><?php echo esc_html($title); ?></a></h5>

							<?php echo ishfreelotheme_custom_excerpt(get_the_content(), 40, get_search_query()); ?>
						</div>
					</div>
				</div>
			<?php endwhile;

			global $wp_query;
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

			?>


		<?php else : ?>

			<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
				<div class="ish-vc_row_inner">
					<h2 class="entry-title"><?php esc_html_e( 'No results found.', 'freelo' ) ?></h2>
					<div class="entry-content">
						<p><?php esc_html_e("Sorry, the content you are looking for could not be found.", 'freelo' ) ?></p>
					</div>
				</div>
			</div>

		<?php endif; ?>

	</section>
	<!-- Content part section END -->

    <!-- #content  END -->
<?php  get_footer(); ?>
