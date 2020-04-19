<?php

get_header();

//<!-- Lead part section -->
$current_term = get_queried_object();
$return = '<div class="ish-portfolio-archive-lead ish-portfolio-category-lead">';

$title = esc_html__( 'Category: ', 'freelo' ) . '<span>' . $current_term->name . '</span>';
$data = do_shortcode( $current_term->description );
$post_count = '';

// Title
$title = '<h1 class="color1" data-firstletter="' . $title[0] . '">' . $title . '</h1>';

// Description
$description = ( '' != $data  ) ? '<div class="ish-category-description">' . $data . '</div>' : '';

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
						<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
							<div class="ish-vc_row_inner">
								<div class="vc_col-sm-12 wpb_column column_container">
									<div class="wpb_wrapper">

										<?php
										// Get all global portfolio settings
										$atts = Array();
										foreach ( $ishfreelotheme_options as $key => $value ) {
											if ( 0 === strpos( $key, 'portfolio_' ) ){
												$atts[ str_replace('portfolio_', '', $key )] = $value;
											}
										}

										// Generate the shortcode
										$sc = '[ish_portfolio category="' . esc_attr( $current_term->slug ) . '" pagination="yes"';
										foreach ( $atts as $key => $value ){
											$sc .= ' ' . $key . '="' . $value . '"';
										}
										$sc .= ']';

										// Content with no sidebar
										$current_term = get_queried_object();

										if ( ! empty( $current_term ) ){
											echo apply_filters( 'the_content', $sc );
											comments_template( '', true );
										}
										?>

									</div>
								</div>
							</div>
						</div>
					</div>

					<?php
					// SIDEBAR
					get_sidebar();
					?>

				</div>
			</div>
		<?php
		} else {
			?>

			<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection">
				<div class="ish-vc_row_inner">
					<div class="vc_col-sm-12 wpb_column column_container">
						<div class="wpb_wrapper">
							<?php

							// Get all global portfolio settings
							$atts = Array();
							foreach ( $ishfreelotheme_options as $key => $value ) {
								if ( 0 === strpos( $key, 'portfolio_' ) ){
									$atts[ str_replace('portfolio_', '', $key )] = $value;
								}
							}

							// Generate the shortcode
							$sc = '[ish_portfolio category="' . esc_attr( $current_term->slug ) . '" pagination="yes"';
							foreach ( $atts as $key => $value ){
								$sc .= ' ' . $key . '="' . $value . '"';
							}
							$sc .= ']';

							// Content with no sidebar
							$current_term = get_queried_object();

							if ( ! empty( $current_term ) ){
								echo apply_filters( 'the_content', $sc );
								comments_template( '', true );
							}
							?>
						</div>
					</div>
				</div>
			</div>


		<?php } ?>

	</section>
	<!-- Content part section END -->

	<!-- #content  END -->
<?php  get_footer(); ?>
