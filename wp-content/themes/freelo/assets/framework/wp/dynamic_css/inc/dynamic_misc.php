<?php

/* *********************************************************************************************************************
 * Misc
 */

// Header Bar height ---------------------------------------------------------------------------------------------------
$header_bar_height = ISHFREELOTHEME_DEFAULT_HEADER_BAR_HEIGHT;
$header_bar_contents_height = ISHFREELOTHEME_DEFAULT_HEADER_BAR_HEIGHT;

if ( isset( $ish_newdata['use_website_border'] ) && '0' != $ish_newdata['use_website_border'] ){
	$header_bar_height = (int)$header_bar_height + (int)ISHFREELOTHEME_WEBSITE_BORDER_WIDTH;
}

?>
	.ish-part_header_bar{
		min-height: <?php echo '' . $header_bar_height . 'px'; ?>;
	}

	.ish-part_header_bar{
		height: <?php echo '' . $header_bar_height . 'px'; ?>;
	}

	.ish-part_header_bar .ish-sc_icon,
	.ish-part_header_bar .ish-sc_icon > span,
	.ish-part_header_bar .ish-sc_icon > a span {
		height: <?php echo '' . $header_bar_contents_height . 'px'; ?>;
	}

	.ish-part_header_bar .ish-sc_icon,
	.ish-part_header_bar .ish-top_nav_container,
	.ish-part_header_bar .ish-top_nav_container > ul > li > a {
		line-height: <?php echo '' . $header_bar_contents_height . 'px'; ?>;
	}

<?php

// Header height -------------------------------------------------------------------------------------------------------
$header_height = ( isset( $ish_newdata['header_height'] ) ) ? trim( $ish_newdata['header_height'] ) : '';

if ( '' != $header_height ) {
	$header_height = str_replace('px;', '', $header_height);
	$header_height = str_replace('px', '', $header_height);
	$header_height = str_replace('%', '', $header_height);

	if ( is_numeric( $header_height ) ) {

		$maxwidth = $header_height - 50;
		if ( $maxwidth < 0 ){ $maxwidth = $header_height - 10; }
		if ( $maxwidth < 0 ){ $maxwidth = $header_height; }

		?>

		body.ish-sticky-on .ish-body { padding-top: <?php echo '' . $header_height . 'px'; ?>; }
		.ish-sticky-on .ish-part_header + *:before { top: -<?php echo '' . $header_height . 'px'; ?>; height: <?php echo '' . $header_height . 'px'; ?>; }
		.ish-sticky-on .ish-part_header + *:before { top: 0; height: 0; }
		.ish-part_header .ish-row_inner { height: <?php echo '' . $header_height . 'px'; ?>; }
		.ish-ph-logo img { max-height: <?php echo '' . $maxwidth . 'px'; ?>; }

		<?php
	}
}

// Sticky height -------------------------------------------------------------------------------------------------------
$sticky_height = ( isset( $ish_newdata['sticky_height'] ) ) ? trim( $ish_newdata['sticky_height'] ) : '';

if ( '' != $sticky_height ) {
	$sticky_height = str_replace('px;', '', $sticky_height);
	$sticky_height = str_replace('px', '', $sticky_height);
	$sticky_height = str_replace('%', '', $sticky_height);

	if ( is_numeric( $sticky_height ) ) {

		$maxwidth = $sticky_height - 10;
		if ( $maxwidth < 0 ){ $maxwidth = $sticky_height; }
		
		?>

		.ish-sticky-scrolling .ish-ph-logo img { max-height: <?php echo '' . $maxwidth . 'px'; ?>; }

	<?php
	}
}


// Retina logo ---------------------------------------------------------------------------------------------------------
 if ( isset($ish_newdata['logo_as_image']) && '1' == $ish_newdata['logo_as_image'] ) {

	// Retina logo
	if ( ( isset( $ish_newdata['logo_retina_image'] ) && '' != $ish_newdata['logo_retina_image'] ) && ( isset( $ish_newdata['logo_image'] ) && '' != $ish_newdata['logo_image'] ) ) { ?>
		/* Retina logo */
		@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {

			.ish-ph-logo.ish-ph-logo_retina-yes img {
				visibility: hidden;
			}

			.ish-ph-logo.ish-ph-logo_retina-yes {
			<?php $retina_logo = is_ssl() ? str_replace( 'http:', 'https:', $ish_newdata['logo_retina_image'] ) : $ish_newdata['logo_retina_image']; ?>
				background: url('<?php echo '' . $retina_logo; ?>') center center no-repeat;
				background-size: 100% auto;
			}

		}
		/* Retina logo END */
	<?php }

	// Retina logo - Alternative Style
	if ( ( isset( $ish_newdata['logo_retina_image_alternative'] ) && '' != $ish_newdata['logo_retina_image_alternative'] ) && ( isset( $ish_newdata['logo_image_alternative'] ) && '' != $ish_newdata['logo_image_alternative'] ) ) { ?>
		/* Retina logo */
		@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {

			.ish-alt-style .ish-ph-logo.ish-ph-logo_retina-yes img {
				visibility: hidden;
			}

			.ish-alt-style .ish-ph-logo.ish-ph-logo_retina-yes {
			<?php $retina_logo = is_ssl() ? str_replace( 'http:', 'https:', $ish_newdata['logo_retina_image_alternative'] ) : $ish_newdata['logo_retina_image_alternative']; ?>
				background: url('<?php echo '' . $retina_logo; ?>') center center no-repeat;
				background-size: 100% auto;
			}

		}
		/* Retina logo END */
	<?php }
	else if ( isset( $ish_newdata['logo_image_alternative'] ) && '' != $ish_newdata['logo_image_alternative'] ) { ?>

		/* Retina logo */
		@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {

			.ish-alt-style .ish-ph-logo.ish-ph-logo_retina-yes img {
				visibility: hidden;
			}

			.ish-alt-style .ish-ph-logo.ish-ph-logo_retina-yes {
			<?php $retina_logo = is_ssl() ? str_replace( 'http:', 'https:', $ish_newdata['logo_image_alternative'] ) : $ish_newdata['logo_image_alternative']; ?>
				background: url('<?php echo '' . $retina_logo; ?>') center center no-repeat;
				background-size: 100% auto;
			}

		}
	<?php
	}

}

?>
.ish-sidenav {
	width : <?php echo ISHFREELOTHEME_SIDENAV_WIDTH; ?>;
}
<?php

$sidenav_breaking_point = 560;

if ( false === strpos( ISHFREELOTHEME_SIDENAV_WIDTH, '%') ){
	$new_point = str_replace( 'px', '', ISHFREELOTHEME_SIDENAV_WIDTH );
	$sidenav_breaking_point = ( $sidenav_breaking_point > $new_point ) ? $sidenav_breaking_point : (int)$new_point;
}

?>
@media all and ( max-width: <?php echo '' . $sidenav_breaking_point; ?>px ) {
	.ish-sidenav-opened .ish-sidenav {
		width: 100% !important;
		z-index: 99999 !important;
	}

	.ish-sidenav-opened {
		overflow: hidden;
	}
}

<?php

// Breaking point
$responsive_layout_breakingpoint = ISHFREELOTHEME_BREAKINGPOINT;

if ( isset( $ish_newdata['responsive_layout_breakingpoint'] ) && '' != $ish_newdata['responsive_layout_breakingpoint'] ){
	$responsive_layout_breakingpoint = $ish_newdata['responsive_layout_breakingpoint'];
}

if ( false === strpos( ISHFREELOTHEME_SIDENAV_WIDTH, '%') ){
	// Pixels ( Percents are set in dynamic_responsive as they do need media queries )
	$new_point = str_replace( 'px', '', ISHFREELOTHEME_SIDENAV_WIDTH );

	if ( $responsive_layout_breakingpoint > $new_point ){

		?>
		/* Grid ----------------------------------------------------------------------------------------------------- */

		/* Ish */
		.ish-sidenav [class^="ish-grid"], .ish-sidenav [class*=" ish-grid"] {
			float: none;
			width: 100%;
			margin-left: 0;
		}
		/* VC */
		.ish-sidenav .vc_row-fluid [class^="wpb_column"],
		.ish-sidenav .vc_row-fluid [class*=" wpb_column"] {
			float: none !important;
			width: 100% !important;
			margin-left: 0 !important;
		}
		<?php

	}
}

// Website Border ------------------------------------------------------------------------------------------------------

if ( isset( $ish_newdata['use_website_border'] ) && '0' != $ish_newdata['use_website_border'] ){

?>

.ish-wrapper-all > [class^="ish-part_"]{
	border-left: <?php echo ISHFREELOTHEME_WEBSITE_BORDER_WIDTH; ?>px solid;
	border-right: <?php echo ISHFREELOTHEME_WEBSITE_BORDER_WIDTH; ?>px solid;
}

.ish-wrapper-all > [class^="ish-part_"]:first-child{
	border-top: <?php echo ISHFREELOTHEME_WEBSITE_BORDER_WIDTH; ?>px solid;
}

.ish-wrapper-all > [class^="ish-part_"]:last-child{
	border-bottom: <?php echo ISHFREELOTHEME_WEBSITE_BORDER_WIDTH; ?>px solid;
}

.ish-wrapper-all > [class^="ish-part_"]{
	border-color: <?php echo ISHFREELOTHEME_WEBSITE_BORDER_COLOR; ?> !important;
}

.ish-unboxed .ish-wrapper-all:after {
	content: '';
	position: fixed;
	bottom: 0;
	left: 0;
	width: 100%;
	height: <?php echo ISHFREELOTHEME_WEBSITE_BORDER_WIDTH; ?>px;
	background: <?php echo ISHFREELOTHEME_WEBSITE_BORDER_COLOR; ?>;
}

<?php
}
