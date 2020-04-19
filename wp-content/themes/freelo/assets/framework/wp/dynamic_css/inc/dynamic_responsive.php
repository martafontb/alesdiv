<?php

/* *********************************************************************************************************************
 * Page width dependencies & media queries & responsive rules
 */

$page_width = trim(ISHFREELOTHEME_PAGE_WIDTH);
$page_width_units = 'px';

if ( isset( $ish_newdata['use_predefined_page_width'] ) && '1' == $ish_newdata['use_predefined_page_width'] ){
    if ( isset( $ish_newdata['predefined_page_width'] ) && '' != $ish_newdata['predefined_page_width'] ){
        $page_width = $ish_newdata['predefined_page_width'];
    }
}else{
    if ( isset( $ish_newdata['custom_page_width'] ) && '' != $ish_newdata['custom_page_width'] ){
        $page_width = $ish_newdata['custom_page_width'];
    }
}


// Ensure percents are supported
if ( false !== strpos($page_width, '%') ){
	$page_width = str_replace( '%', '', $page_width );
	$page_width_units = '%';
}else {
	$page_width = str_replace( 'px', '', $page_width );
}


// Breaking point
$responsive_layout_breakingpoint = ISHFREELOTHEME_BREAKINGPOINT;

if ( isset( $ish_newdata['responsive_layout_breakingpoint'] ) && '' != $ish_newdata['responsive_layout_breakingpoint'] ){
    $responsive_layout_breakingpoint = $ish_newdata['responsive_layout_breakingpoint'];
}


// Menu breaking point
$responsive_nav_breakingpoint = ISHFREELOTHEME_NAV_BREAKINGPOINT;

if ( isset( $ish_newdata['responsive_nav_breakingpoint'] ) && '' != $ish_newdata['responsive_nav_breakingpoint'] ){
    $responsive_nav_breakingpoint = $ish_newdata['responsive_nav_breakingpoint'];
}

?>



/* *********************************************************************************************************************
 * Content width
 */
.ish-unboxed [class^="ish-part_"] .ish-row-notfull .ish-row_inner,
.ish-unboxed [class^="ish-part_"] > .ish-row-notfull > .ish-row_inner,
.ish-unboxed [class*=" ish-part_"] > .ish-row-notfull > .ish-row_inner,
.ish-unboxed [class^="ish-part_"] > .ish-row-notfull > .ish-vc_row_inner,
.ish-unboxed [class*=" ish-part_"] > .ish-row-notfull > .ish-vc_row_inner,
.ish-boxed [class^="ish-part_"],
.ish-boxed [class*=" ish-part_"],
.ish-boxed .ish-wrapper-all,
.ish-part_searchbar div,
.ish-part_searchbar input[type="text"],
.ish-part_expandable .ish-pe-bg .ish-row_inner,
.ish-unboxed [class^="ish-part_"] .vc_col-sm-12 .ish-sc_recent_posts.ish-rp-fullwidth.ish-rp-boxed .post > .ish-vc_row_inner,
.ish-unboxed [class*=" ish-part_"] .vc_col-sm-12 .ish-sc_recent_posts.ish-rp-fullwidth.ish-rp-boxed .post > .ish-vc_row_inner,
.ish-unboxed [class^="ish-part_"] > .ish-row-notfull .vc_col-sm-12 .ish-sc_recent_posts.ish-rp-fullwidth.ish-rp-unboxed .post > .ish-vc_row_inner,
.ish-unboxed [class*=" ish-part_"] > .ish-row-notfull .vc_col-sm-12 .ish-sc_recent_posts.ish-rp-fullwidth.ish-rp-unboxed .post > .ish-vc_row_inner {
	<?php if ( isset( $ish_newdata['use_responsive_layout'] ) && '0' == $ish_newdata['use_responsive_layout'] ) { ?>
		width: <?php echo '' . $page_width . $page_width_units; ?>;
		max-width: none;
	<?php
	// In case width set to 100% and fixed layout should be used
	if ('%' == $page_width_units ){ ?>
		min-width: 1240px !important;
	<?php } ?>

	<?php } else { ?>
		max-width: <?php echo '' . $page_width . $page_width_units; ?>;
	<?php } ?>
}


<?php if ('%' == $page_width_units ){ ?>
	.ish-unboxed [class*="ish-part_content"] > .ish-row-notfull > .ish-row_inner,
	.ish-unboxed [class*="ish-part_content"] > .ish-row-notfull > .ish-vc_row_inner,
	.ish-boxed [class*="ish-part_content"] > .ish-row-notfull > .ish-row_inner,
	.ish-boxed [class*="ish-part_content"] > .ish-row-notfull > .ish-vc_row_inner,

	.ish-unboxed [class*="ish-part_tagline"] > .ish-row-notfull > .ish-row_inner,
	.ish-unboxed [class*="ish-part_tagline"] > .ish-row-notfull > .ish-vc_row_inner,
	.ish-boxed [class*="ish-part_tagline"] > .ish-row-notfull > .ish-row_inner,
	.ish-boxed [class*="ish-part_tagline"] > .ish-row-notfull > .ish-vc_row_inner,

	.ish-unboxed [class*="ish-part_breadcrumbs"] > .ish-row-notfull > .ish-row_inner,
	.ish-boxed [class*="ish-part_breadcrumbs"] > .ish-row-notfull > .ish-row_inner {
		max-width: 1240px !important; /* Custom content width when 100% is set */
		margin: 0 auto;
	}

	<?php if ( isset( $ish_newdata['use_responsive_layout'] ) && '0' == $ish_newdata['use_responsive_layout'] ) { ?>
		[class^="ish-part_"] .ish-row-full .ish-vc_row_inner,
		[class*=" ish-part_"] .ish-row-full .ish-vc_row_inner
		{
			min-width: 1240px !important;
		}
	<?php	} ?>

	<?php if ( isset( $ish_newdata['use_responsive_layout'] ) && '0' == $ish_newdata['use_responsive_layout'] ) { ?>
		.ish-body
		{
			min-width: calc(1240px + 2 * 60px) !important;
		}
	<?php	} ?>

<?php } ?>


<?php if ( isset( $ish_newdata['use_responsive_layout'] ) && '0' == $ish_newdata['use_responsive_layout'] && 'px' == $page_width_units ) { ?>
	.ish-body
	{
		min-width: <?php echo '' . $page_width . $page_width_units; ?>;
	}
<?php	} ?>


.ish-unboxed .ish-wrapper-all, .ish-unboxed .ish-part_header {
	<?php if ( isset( $ish_newdata['use_responsive_layout'] ) && '0' == $ish_newdata['use_responsive_layout'] ) { ?>
		min-width: <?php echo '' . $page_width . $page_width_units; ?>;
	<?php } ?>
}

/*VC*/
.ish-boxed .ish-vc_row_inner {
      <?php if ( isset( $ish_newdata['use_responsive_layout'] ) && '0' == $ish_newdata['use_responsive_layout'] ) { ?>
	      width: <?php echo '' . $page_width . $page_width_units; ?> !important;
      <?php } else { ?>
	      max-width: <?php echo '' . $page_width . $page_width_units; ?> !important;
      <?php } ?>
}


/* !!!!! Width fix for full-height div -> because of display: table-cell -> because of table-layout: fixed */
/* Need to take website border into consideration */
<?php
$website_border_width = 0;
if ( isset( $ish_newdata['use_website_border'] ) && '0' != $ish_newdata['use_website_border'] ){
	$website_border_width = ISHFREELOTHEME_WEBSITE_BORDER_WIDTH;
} ?>
/* The actual fix */
.ish-row_section.ish-row-notfull.ish-row-full-height .ish-vc_row_inner {
	width: <?php echo ($page_width - ( 2 * $website_border_width ) ) . $page_width_units; ?>;
}
<?php if ('%' == $page_width_units ){ ?>
	.ish-row_section.ish-row-notfull.ish-row-full-height .ish-vc_row_inner {
		width: 1240px; /* Custom content width when 100% is set */
	}

	<?php if ( ! isset( $ish_newdata['use_responsive_layout'] ) || '0' != $ish_newdata['use_responsive_layout'] ) { ?>
		@media all and ( max-width: <?php echo (1240 + (60 * 2) + 20); ?>px ) { /* Custom content width when 100% is set */
			.ish-row_section.ish-row-notfull.ish-row-full-height .ish-vc_row_inner {
				width: 100%;
			}
		}
	<?php } ?>

<?php } ?>
<?php if ('px' == $page_width_units ){ ?>
	@media all and ( max-width: <?php echo '' . $page_width + 20; ?>px ) {
		.ish-row_section.ish-row-notfull.ish-row-full-height .ish-vc_row_inner {
			width: 100%;
		}
	}
<?php } ?>
/* !!!!! */

/* MegaMenu */
/* Need to take website border into consideration */
<?php
$website_border_width = 0;
if ( isset( $ish_newdata['use_website_border'] ) && '0' != $ish_newdata['use_website_border'] ){
	$website_border_width = ISHFREELOTHEME_WEBSITE_BORDER_WIDTH;
} ?>
.ish-ph-main_nav > ul > li .ish-megamenu-container .ish-megamenu-inner,
.ish-part_header_bar .ish-top_nav_container > ul > li .ish-megamenu-container .ish-megamenu-inner {
<?php if ('%' == $page_width_units ){ ?>
	width: 1240px;
<?php } else { ?>
	width: <?php echo '' . $page_width . $page_width_units; ?>;
<?php } ?>
}

.ish-boxed .ish-ph-main_nav > ul > li .ish-megamenu-container .ish-megamenu-inner,
.ish-boxed .ish-part_header_bar .ish-top_nav_container > ul > li .ish-megamenu-container .ish-megamenu-inner {
<?php if ('%' == $page_width_units ){ ?>
	width: 1240px;
<?php } else { ?>
	width: <?php echo ($page_width - 2 * $website_border_width) . $page_width_units; ?>;
<?php } ?>
}


/* Check if responsive layout is turned on */
<?php if ( !isset( $ish_newdata['use_responsive_layout'] ) || '1' == $ish_newdata['use_responsive_layout'] ) { ?>

	/* Breaking point ONLY for main menu & Heade Bar-> transform to button and use responsive menu *******************************/
	@media all and ( max-width: <?php echo '' . $responsive_nav_breakingpoint; ?>px ) {

		/* Hide main wp nav */
		.ish-ph-main_nav .ish-ph-mn-main_nav {
			display: none !important;
		}

		/* Show responsive 2 buttons navigation */
		.ish-ph-main_nav .ish-ph-mn-resp_nav.ish-ph-mn-hidden {
			max-width: 100%;
			position: relative;
			display: table-cell !important;
			vertical-align: middle;
		}

		/* Hide main wp nav */
		.ish-hb-menu .ish-top_nav {
			display: none !important;
		}

		/* Show responsive 2 buttons navigation */
		.ish-hb-menu .ish-phb-resp_nav.ish-phb-hidden {
			display: block !important;
		}

	}

	/* Blog details only
	/* 1300px *********************************************************************************************************/
	@media all and ( min-width: 1300px ) {
		.single-post .ish-part_tagline.ish-tagline-image,
		.single-portfolio-post .ish-part_tagline.ish-tagline-image,
		.ish-part_tagline_featured {
			height: 800px;
		}
	}


	/* Row SC custom responsive breakingpoints - 960px and 1280px  ****************************************************/
	<?php
		$resp_sizes = Array( '1280', '960'); // Based on "responsive_point" option in Row and Inner Row options

		foreach ($resp_sizes as $size ){

			if ( $size > $responsive_layout_breakingpoint + 1 ) {
				// Output the CSS Only if custom point is bigger than Global point

	?>

@media all and ( min-width: <?php echo '' . $responsive_layout_breakingpoint + 1; ?>px ) and ( max-width: <?php echo '' . $size; ?>px ) {

	<?php

	$padding = 30;
	$margin = 30;

	?>

	/* WITHOUT SIDEBAR */
	/* Last shortcode bottom margin */
	.ish-part_content.ish-without-sidebar > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element:last-child,
		/* Last shortcodes bottom margin - nested */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column .ish-sc-element:last-child,
		/* Last shortcodes bottom margin - nested in content elements */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column .wpb_wrapper > .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column .wpb_wrapper > .ish-sc-element:last-child {
		margin-bottom: 30px !important;
	}

	/* Removing from last element in last column */
	.ish-part_content.ish-without-sidebar > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column:last-child > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column:last-child > .wpb_wrapper > .ish-sc-element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column:last-child .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column:last-child .ish-sc-element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column:last-child .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column:last-child .ish-sc-element:last-child {
		margin-bottom: 0 !important;
	}

	/* NEW FIX - Divider only one in the row - change the bottom margin to half */
	.ish-part_content.ish-without-sidebar > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element.ish-sc_divider:first-child:last-child {
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* WITH SIDEBAR */
	/* Last shortcode bottom margin */
	.ish-pc-content > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element:last-child,
		/* Last shortcodes bottom margin - nested */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column .ish-sc-element:last-child,
		/* Last shortcodes bottom margin - nested in content elements */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column .wpb_wrapper > .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column .wpb_wrapper > .ish-sc-element:last-child {
		margin-bottom: 30px !important;
	}

	/* Last shortcode bottom margin */
	.ish-pc-content > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column:last-child > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column:last-child > .wpb_wrapper > .ish-sc-element:last-child,
		/* Last shortcodes bottom margin - nested */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column:last-child .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column:last-child .ish-sc-element:last-child,
		/* Last shortcodes bottom margin - nested in content elements */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column:last-child .wpb_wrapper > .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row.ish-resp-point-<?php echo '' . $size; ?>:last-child > .wpb_column:last-child .wpb_wrapper > .ish-sc-element:last-child {
		margin-bottom: 0 !important;
	}

	/* NEW FIX - Divider only one in the row - change the bottom margin to half */
	.ish-pc-content > .wpb_row.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element.ish-sc_divider:first-child:last-child {
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Ish */
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row > .ish-vc_row_inner > [class*="ish-grid"],
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row > [class*="ish-grid"],
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row > .ish-vc_row_inner > .wpb_column,
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row > .wpb_column {
		float: none;
		width: 100%;
		margin-left: 0;
	}

	/* VC */
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row > .ish-vc_row_inner > .wpb_column,
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row > .wpb_column {
		float: none !important;
		width: 100% !important;
		margin-left: 0 !important;
	}

	/* Rows with no margins */
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row.ish-no-margins > .ish-vc_row_inner > .wpb_column,
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row.ish-no-margins > .wpb_column {
		float: none !important;
		width: 100% !important;
		margin-left: 0 !important;
		margin-bottom: 0 !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row.ish-no-margins > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > *:last-child,
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row.ish-no-margins > .wpb_column > .wpb_wrapper > *:last-child {
		margin-bottom: 0 !important;
	}

	/* Rows - margin bottom none and half */
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row.ish-row_notsection.ish-bottom-margin-none {
		margin-bottom: <?php echo -1 * $margin; ?>px !important;
	}
	.ish-resp-point-<?php echo '' . $size; ?>.wpb_row.ish-row_notsection.ish-bottom-margin-half {
		margin-bottom: 0 !important;
	}

	/* Switching Column Positions */
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-reorder,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-reorder > .ish-vc_row_inner {
		display: table !important;
		width: 100%;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-reorder > .wpb_column.ish-show-as-first,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-reorder > .ish-vc_row_inner > .wpb_column.ish-show-as-first {
		display: table-header-group !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-reorder > .wpb_column:first-child > .wpb_wrapper > *:last-child,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-reorder > .ish-vc_row_inner > .wpb_column:first-child > .wpb_wrapper > *:last-child{
		margin-bottom: 0 !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-reorder > .wpb_column.ish-show-as-first:last-child > .wpb_wrapper > *:last-child,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-reorder > .ish-vc_row_inner > .wpb_column.ish-show-as-first:last-child > *:last-child {
		margin-bottom: 30px;
	}

	/* Content centering----------------------------------------------------------------------------------------- */
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered [class^="ish-grid"],
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered [class*=" ish-grid"],
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered.vc_row-fluid [class^="wpb_column"],
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered.vc_row-fluid [class*=" wpb_column"],
	.ish-part_content .ish-resp-centered .ish-resp-point-<?php echo '' . $size; ?> .wpb_column,
	.ish-part_content .ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .wpb_column > .wpb_wrapper,
	.ish-part_footer .ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered [class^="ish-grid"],
	.ish-part_footer .ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered [class*=" ish-grid"] {
		text-align: center;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc-element.ish-left,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc-element.ish-right,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .wpb_content_element.ish-left,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .wpb_content_element.ish-right {
		text-align: center;
		float: none;
	}

    /* Shortcodes */
	.ish-resp-point-<?php echo '' . $size; ?> .ish-sc-element,
	.ish-resp-point-<?php echo '' . $size; ?> .wpb_content_element {
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* Divider */
	.ish-resp-point-<?php echo '' . $size; ?> .ish-sc_divider.ish-hide-in-mobile
	{
		display: none;
	}

	/* Quote */
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_quote cite
	{
		text-align: center;
	}

	/* Box */
	.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc_box,
	.ish-resp-point-<?php echo '' . $size; ?> > .wpb_column > .wpb_wrapper > .ish-sc_box
	{
		padding: 30px !important;
	}
	.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc_box.ish-zero-padding,
	.ish-resp-point-<?php echo '' . $size; ?> > .wpb_column > .wpb_wrapper > .ish-sc_box.ish-zero-padding
	{
		padding: 0 !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?> > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc_box:not(.ish-bgimage):not([class*="ish-color"]):not([class*="ish-border-color"]),
	.ish-resp-point-<?php echo '' . $size; ?> > .wpb_column > .wpb_wrapper > .ish-sc_box:not(.ish-bgimage):not([class*="ish-color"]):not([class*="ish-border-color"])
	{
		padding: 0 !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-row-full:not(.ish-row-full-padding) > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc_box:not(.ish-bgimage):not([class*="ish-color"]):not([class*="ish-border-color"]),
	.ish-resp-point-<?php echo '' . $size; ?>.ish-row-full:not(.ish-row-full-padding) > .wpb_column > .wpb_wrapper > .ish-sc_box:not(.ish-bgimage):not([class*="ish-color"]):not([class*="ish-border-color"])
	{
		padding: 0 60px !important;
	}

	/* Icon Text */
	.ish-resp-point-<?php echo '' . $size; ?> .ish-sc_icon_text.ish-resp-move [class*="ish-it-"]{
		display: block;
	}

	.ish-resp-point-<?php echo '' . $size; ?> .ish-sc_icon_text.ish-resp-move .ish-it-icon .ish-sc-element{
		margin-bottom: 30px !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?> .ish-sc_icon_text.ish-resp-move.ish-right .ish-it-icon {
		display: table-header-group;
	}

	.ish-resp-point-<?php echo '' . $size; ?> .ish-sc_icon_text.ish-resp-move.ish-right .ish-it-text {
		display: table-footer-group;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_icon_text.ish-resp-keep.ish-right{
		text-align: right;
	}
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_icon_text.ish-resp-keep.ish-left{
		text-align: left;
	}

    /* Separator */
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator
	{
		margin-left: auto !important;
		margin-right: auto !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-line
	{
		width: 50% !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text.ish-no-align .ish-text,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text.ish-no-icon.ish-no-align .ish-text
	{
		padding-left: 10px !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-line,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-icon + .ish-line,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-text + .ish-line
	{
		/*width: 50% !important;*/
		display: table-cell;
		padding: 0 !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-line.ish-left,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-line.ish-right
	{
		padding: 1px !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-icon,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text.ish-left:not(.ish-text) .ish-icon.ish-left,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text.ish-left:not(.ish-text) .ish-icon.ish-right,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-text
	{
		padding-left: 10px !important;
		padding-right: 10px !important;
	}

	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-icon + .ish-text,
	.ish-resp-point-<?php echo '' . $size; ?>.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-text + .ish-icon
	{
		padding-left: 0 !important;
	}

}

	<?php
			} // End of if
		} // End of Row SC custom breaking points loop
	 ?>

	/* 1024px *********************************************************************************************************/
	<?php if ('px' == $page_width_units ) { ?>
		@media all and ( max-width: <?php echo '' . $page_width + 18; ?>px ) {
			.ish-boxed.ish-pixel-width .ish-body {
				padding-top: 0 !important;
				padding-bottom: 0 !important;
			}
		}
	<?php } else { ?>
		@media all and ( max-width: <?php echo '' . $responsive_layout_breakingpoint; ?>px ) {
			.ish-boxed.ish-percent-width .ish-body {
				padding: 0 !important;
			}


		   .ish-boxed.ish-percent-width.ish-sticky-on .ish-part_header{
			   width: 100%;
		   }

			.ish-boxed.ish-percent-width .ish-part_header{
				width: 100%;
			}
		}
	<?php } ?>


/* Screen (1200px) & less *********************************************************************/
@media all and ( max-width: 1200px )
{

<?php
// Vars --------------------------------------------------------------------------------------------------------
$padding = 30;
$margin = 30;

	$columns_count = Array( '6', '5');
	foreach ($columns_count as $column ){

?>


	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Layout --------------------------------------------------------------------------------------------------- */
	/* Content -------------------------------------------------------------------------------------------------- */
	/* Shortcodes ----------------------------------------------------------------------------------------------- */
	/* Blog ----------------------------------------------------------------------------------------------------- */
	/* Portfolio ------------------------------------------------------------------------------------------------ */
	/* Widgets -------------------------------------------------------------------------------------------------- */
	/* Plugins -------------------------------------------------------------------------------------------------- */
	/* Woocommerce */

	.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product,
	.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product
	{
		width: 22.05%;
		clear: none;
		margin-right: 3.8%;
	}

	.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(4n+4),
	.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(4n+4)
	{
		margin-right: 0;
	}

	.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(4n+5),
	.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(4n+5)
	{
		clear: both;
	}

<?php
	};
?>
}


/* 1024px *********************************************************************************************************/
<?php
if ( ($page_width < 1024) && ('px' == $page_width_units) ) {
	$cur_pwidth = $page_width;
} else {
	$cur_pwidth = 1024;
}
?>
@media all and ( max-width: <?php echo '' . $cur_pwidth; ?>px )
{

<?php
// Vars --------------------------------------------------------------------------------------------------------
$padding = 30;
$margin = 30;
?>



	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Layout --------------------------------------------------------------------------------------------------- */
	/* Content -------------------------------------------------------------------------------------------------- */
	/* Shortcodes ----------------------------------------------------------------------------------------------- */
	/* Blog ----------------------------------------------------------------------------------------------------- */
	/* Portfolio ------------------------------------------------------------------------------------------------ */
	/* Widgets -------------------------------------------------------------------------------------------------- */
	.widget_ishyoboy-dribbble-widget .dribbble-widget a img,
	.widget_ishyoboy-flickr-widget #flickr_badge_wrapper div,
	.widget_ishyoboy-recent-portfolio-widget .recent-projects-widget li,
	.widget.null-instagram-feed .instagram-pics li
	{
		width: 50% !important;
	}

	.ish-sidenav .widget_ishyoboy-dribbble-widget .dribbble-widget a img,
	.ish-sidenav .widget_ishyoboy-flickr-widget #flickr_badge_wrapper div,
	.ish-sidenav .widget_ishyoboy-recent-portfolio-widget .recent-projects-widget li,
	.ish-sidenav .widget.null-instagram-feed .instagram-pics li
	{
		width: 33.3% !important;
	}

	/* Plugins -------------------------------------------------------------------------------------------------- */
	/* Woocommerce */

	<?php
		$columns_count = Array( '6', '5', '4');
		foreach ($columns_count as $column ){
	?>

		.woocommerce .ish-with-sidebar .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n),
		.ish-with-sidebar .woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n)
		{
			width: 30.75%;
			clear: none;
			margin-right: 3.8%;
		}

		.woocommerce .ish-with-sidebar .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(3n+3),
		.ish-with-sidebar .woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(3n+3)
		{
			margin-right: 0;
		}

		.woocommerce .ish-with-sidebar .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(3n+4),
		.ish-with-sidebar .woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(3n+4)
		{
			clear: both;
		}

	<?php
		};
	?>


}


/* Screen (960px) & less *********************************************************************/
@media all and ( max-width: 960px )
{

<?php
// Vars --------------------------------------------------------------------------------------------------------
$padding = 30;
$margin = 30;
?>


	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Layout --------------------------------------------------------------------------------------------------- */
	/* Content -------------------------------------------------------------------------------------------------- */
	/* Shortcodes ----------------------------------------------------------------------------------------------- */
	/* Blog ----------------------------------------------------------------------------------------------------- */
	.ish-part_content.ish-with-sidebar .ish-pc-content .ish-vc_row_inner .ish-single_navigation,
	.ish-part_content.ish-with-sidebar .ish-pc-content .ish-vc_row_inner .share_box_fixed
	{
		width: 100%;
		display: block;
		float: left;
		margin-left: 0;
	}

	.ish-part_content.ish-with-sidebar .ish-pc-content .ish-vc_row_inner .ish-single_navigation
	{
		margin-top: 0 !important;
	}

	.ish-blog-2columns .ish-format-link-url,
	.ish-blog-2columns .format-quote blockquote
	{
		padding: <?php echo '' . $padding; ?>px;
	}

	.ish-blog-2columns .ish-post-media .ish-link-media
	{
		padding: <?php echo '' . $padding; ?>px;
	}

	.ish-blog-2columns .ish-blog-post-content
	{
		padding: 0 <?php echo '' . $padding; ?>px;
	}



/* 2columns blog overview */
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-content,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-media
	{
		display: table-header-group;
	}

	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-media,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-content,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-blog-post-content
	{
		padding: 0 !important;
	}

	.ish-part_content.ish-with-sidebar.ish-blog-2columns .wpb_row.ish-content-align-right,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns h2,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-blog-post-details,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-blog-video-content,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-blog-audio-content,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-blog-post-media,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-blog-post-links,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-blog-post-excerpt
	{
		text-align: left;
	}

	.ish-part_content.ish-with-sidebar.ish-blog-2columns h2
	{
		margin-top: <?php echo '' . $margin; ?>px !important;
	}

	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-content
	{
		display: table-footer-group;
	}

	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-content,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-media,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-media a img
	{
		width: 100%;
	}

	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-post-content:after
	{
		content: '';
		display: block;
		width: 100%;
		height: 1px;
		margin-top: <?php echo '' . $margin * 2; ?>px;
	}

	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-pc-content>.wpb_row>.ish-vc_row_inner
	{
		/*padding-bottom: <?php /*echo '' . $padding; */?>px !important;*/
	}

	/* set margin for home pagination separator */
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-sc_separator.ish-separator-home-pagination
	{
		margin-top: -<?php echo '' . $margin * 2; ?>px !important;
	}

/* end 2columns blog overview */


	/*.ish-blog-classic .ish-blog-post-details,
	.ish-blog-classic .ish-blog-post-media,
	.ish-blog-classic .ish-blog-post-excerpt,
	.ish-blog-classic .ish-format-link-url,
	.ish-blog-classic .ish-blog-video-content,
	.ish-blog-classic .ish-blog-audio-content,
	.ish-blog-classic .ish-blog-quote-content
	{
		margin-bottom: <?php /*echo '' . $margin; */?>px !important;
	}*/

	/* Portfolio ------------------------------------------------------------------------------------------------ */
	/* Widgets -------------------------------------------------------------------------------------------------- */
	/* Plugins -------------------------------------------------------------------------------------------------- */
	/* Woocommerce */

	<?php
		$columns_count = Array( '6', '5', '4');
		foreach ($columns_count as $column ){
	?>
		.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n),
		.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n)
		{
			width: 30.75%;
			clear: none;
			margin-right: 3.8%;
		}

		.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(3n+3),
		.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(3n+3)
		{
			margin-right: 0;
		}

		.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(3n+4),
		.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(3n+4)
		{
			clear: both;
		}

		.woocommerce .ish-with-sidebar .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n),
		.ish-with-sidebar .woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n)
		{
			width: 48%;
			clear: none;
			margin-right: 3.8%;
		}

		.woocommerce .ish-with-sidebar .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(2n),
		.ish-with-sidebar .woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(2n)
		{
			margin-right: 0;
		}

		.woocommerce .ish-with-sidebar .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(2n+1),
		.ish-with-sidebar .woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(2n+1)
		{
			clear: both;
		}


<?php
	};
?>

}



/* User defined breaking point (768px) & more *********************************************************************/
@media all and ( min-width: <?php echo '' . $responsive_layout_breakingpoint + 1; ?>px )
{

<?php
// Vars --------------------------------------------------------------------------------------------------------
$padding = 30;
$margin = 30;
?>



	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Layout -------------------------------------------------------------------------------------------------- */
	/* WITHOUT SIDEBAR */

	/* Last shortcode bottom margin */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element:last-child,

	.ish-part_content.ish-with-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-part_content.ish-with-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element:last-child,

	/* Last shortcodes bottom margin - nested */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .ish-sc-element:last-child,

	/* Last shortcodes bottom margin - nested in content elements */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column .wpb_wrapper > .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column .wpb_wrapper > .ish-sc-element:last-child
	{
		margin-bottom: 0 !important;
	}

	/* NEW FIX - Divider only one in the row - don't remove bottom margin */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element.ish-sc_divider:first-child:last-child {
		margin-bottom: <?php echo '' . $margin * 2; ?>px !important;
	}

	/* Iconic box */
	/* Add bottom margin to last element in it */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child{
		margin-bottom: <?php echo '' . $padding * 2; ?>px !important;
	}
	/* Remove bottom margin from all boxes in all columns  */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box {
		margin-bottom: 0px !important;
	}
	/* Remove bottom margin from all last boxes in all columns  */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .ish-sc_global_iconic_box:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box:last-child{
		margin-bottom: -<?php echo '' . $padding * 2; ?>px !important;
	}
	/* Remove bottom margin - margin half  */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-half,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box.ish-bottom-margin-half,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-half{
		margin-bottom: -<?php echo '' . $padding * 1; ?>px !important;
	}
	/* Remove bottom margin - margin none  */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-none,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box.ish-bottom-margin-none,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-none{
		margin-bottom: -<?php echo '' . $padding * 2; ?>px !important;
	}


	/* Move -30px up if section goes after section */
	/*.ish-part_content.ish-without-sidebar > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection
	{
		margin-top: -<?php /*echo '' . $margin; */?>px;
	}*/

	/* set margin for home pagination separator */
	.ish-part_content.ish-without-sidebar .ish-sc_separator.ish-separator-home-pagination
	{
		margin-bottom: <?php echo '' . $margin * 2; ?>px !important;
	}

	/* Row Overrides */
	.ish-part_content .ish-blog-prevnext-container,
	.ish-part_content .ish-blog-comments-container
	{
		margin-top: 0 !important;
	}

	.ish-part_content.ish-without-sidebar .ish-sc_separator.ish-separator-home,
	.ish-part_content.ish-with-sidebar .ish-sc_separator.ish-separator-home
	{
		padding-top: <?php echo '' . $padding * 2; ?>px;
	}

	/* WITH SIDEBAR */
	/* Last shortcode bottom margin */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element:last-child,

	/* Last shortcodes bottom margin - nested */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .ish-sc-element:last-child,

	/* Last shortcodes bottom margin - nested in content elements */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column .wpb_wrapper > .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column .wpb_wrapper > .ish-sc-element:last-child
	{
		margin-bottom: 0 !important;
	}

	/* Iconic box */
	/* Add bottom margin to last element in it */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child{
		margin-bottom: <?php echo '' . $padding * 2; ?>px !important;
	}
	/* Remove bottom margin from all boxes in all columns  */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box {
		margin-bottom: 0px !important;
	}
	/* Remove bottom margin from all last boxes in all columns  */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .ish-sc_global_iconic_box:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box:last-child{
		margin-bottom: -<?php echo '' . $padding * 2; ?>px !important;
	}
	/* Remove bottom margin - margin half  */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-half,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box.ish-bottom-margin-half,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-half{
		margin-bottom: -<?php echo '' . $padding * 1; ?>px !important;
	}
	/* Remove bottom margin - margin none  */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-none,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box.ish-bottom-margin-none,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-none{
		margin-bottom: -<?php echo '' . $padding * 2; ?>px !important;
	}

	/* Move -30px up if section goes after section */
	/*.ish-pc-content > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection
	{
		margin-top: -<?php /*echo '' . $margin; */?>px;
	}*/

	/* Clear top padding for next not-section row */
	.ish-pc-content > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection > .ish-vc_row_inner
	{
		padding-top: 0 !important;
	}

	/* set padding for home content separator */
	.ish-sc_separator.ish-separator-home
	{
		padding-top: <?php echo '' . $padding; ?>px;
	}

	/* set padding for home categories separator */
	.ish-sc_separator.ish-separator-home-categories,
	.ish-sc_separator.ish-separator-portfolio-pagination
	{
		margin-top: <?php echo '' . $margin * 2; ?>px !important;
	}

	/* set margin for home pagination separator */
	.ish-blog-classic .ish-sc_separator.ish-separator-home-pagination
	{
		margin-top: -<?php echo '' . $margin * 2; ?>px !important;
	}


	/* Content -------------------------------------------------------------------------------------------------- */
	/* Shortcodes ----------------------------------------------------------------------------------------------- */
	/* Blog ----------------------------------------------------------------------------------------------------- */
	/* Portfolio ------------------------------------------------------------------------------------------------ */
	/* Widgets -------------------------------------------------------------------------------------------------- */
	/* Plugins -------------------------------------------------------------------------------------------------- */

}


/* User defined breaking point (768px) & less *********************************************************************/
@media all and ( max-width: <?php echo '' . $responsive_layout_breakingpoint; ?>px )
{

<?php
// Vars --------------------------------------------------------------------------------------------------------
$padding = 30;
$margin = 30;
?>



	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Ish */
	[class^="ish-grid"], [class*=" ish-grid"]
	{
		float: none;
		width: 100%;
		margin-left: 0;
	}

	/* VC */
	.vc_row-fluid [class^="wpb_column"], .vc_row-fluid [class*=" wpb_column"]
	{
		float: none !important;
		width: 100% !important;
		margin-left: 0 !important;
	}


	/* Rows with no margins */
	.wpb_row.ish-no-margins > .ish-vc_row_inner > .wpb_column,
	.wpb_row.ish-no-margins > .wpb_column{
		float: none !important;
		width: 100% !important;
		margin-left: 0 !important;
		margin-bottom: 0 !important;
	}

	.wpb_row.ish-no-margins > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > *:last-child,
	.wpb_row.ish-no-margins > .wpb_column > .wpb_wrapper > *:last-child{
		margin-bottom: 0 !important;
	}

	/* Rows - margin bottom none and half */
	.wpb_row.ish-row_notsection.ish-bottom-margin-none {
		margin-bottom: <?php echo -1 * $margin; ?>px !important;
	}
	.wpb_row.ish-row_notsection.ish-bottom-margin-half {
		margin-bottom: 0 !important;
	}


	/* Switching Column Positions */
	.ish-resp-reorder,
	.ish-resp-reorder > .ish-vc_row_inner {
		display: table !important;
		width: 100%;
	}

	.ish-resp-reorder > .wpb_column.ish-show-as-first,
	.ish-resp-reorder > .ish-vc_row_inner > .wpb_column.ish-show-as-first {
		display: table-header-group !important;
	}

	.ish-resp-reorder > .wpb_column:first-child > .wpb_wrapper > *:last-child,
	.ish-resp-reorder > .ish-vc_row_inner > .wpb_column:first-child > .wpb_wrapper > *:last-child{
		margin-bottom: 0 !important;
	}

	.ish-resp-reorder > .wpb_column.ish-show-as-first:last-child > .wpb_wrapper > *:last-child,
	.ish-resp-reorder > .ish-vc_row_inner > .wpb_column.ish-show-as-first:last-child > *:last-child{
		margin-bottom: 30px;
	}

	/* Content centering----------------------------------------------------------------------------------------- */
	.ish-resp-centered [class^="ish-grid"],
	.ish-resp-centered [class*=" ish-grid"],
	.ish-resp-centered.vc_row-fluid [class^="wpb_column"],
	.ish-resp-centered.vc_row-fluid [class*=" wpb_column"],
	.ish-part_content .ish-resp-centered .wpb_column > .wpb_wrapper,
	.ish-part_footer .ish-resp-centered [class^="ish-grid"],
	.ish-part_footer .ish-resp-centered [class*=" ish-grid"]
	{
		text-align: center;
	}

	.ish-resp-centered .ish-sc-element.ish-left,
	.ish-resp-centered .ish-sc-element.ish-right,
	.ish-resp-centered .wpb_content_element.ish-left,
	.ish-resp-centered .wpb_content_element.ish-right
	{
		text-align: center;
		float: none;
	}

	/* Layout --------------------------------------------------------------------------------------------------- */
	/* Add left and right padding to all inner rows */
	.ish-row_inner, .ish-vc_row_inner
	{
		padding-left: <?php echo '' . $padding; ?>px;
		padding-right: <?php echo '' . $padding; ?>px;
	}

	/* Fix 100vh on iOS 7 - http://support.ishyoboy.com/forums/topic/responsive-mobile-page-isnt-readable/ */
	.ish-row_section.ish-row-full-height
	{
		min-height: 0 !important;
	}

	/* Tagline */
	.ish-part_tagline
	{
		padding-top: <?php echo '' . $padding; ?>px;
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	.ish-pt-taglines-additional
	{
		padding-top: <?php echo '' . $padding; ?>px;
	}

	.ish-part_tagline .ish-bc-details-spacer
	{
		display: none;
	}

	.ish-part_tagline .ish-part_breadcrumbs,
	.ish-part_tagline .ish-blog-post-details
	{
		display: block;
	}

	.ish-part_tagline .ish-resp-centered .ish-pt-taglines-left:not(.ish-overlay-box) .ish-blog-post-details:before,
	.ish-part_tagline .ish-resp-centered .ish-pt-taglines-left:not(.ish-overlay-box) .ish-posts-count:before {
		 margin-left: auto;
		 margin-right: auto;
	}


	/* WITHOUT SIDEBAR */
	/* Add top and bottom padding to all inner rows */
	.ish-part_content.ish-without-sidebar > .ish-row > .ish-row_inner,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner
	{
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner,
	.ish-part_content.ish-with-sidebar > .wpb_row > .ish-vc_row_inner
	{
		padding-top: <?php echo '' . $padding; ?>px;
	}

	/* Last shortcode bottom margin */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .ish-sc-element:last-child,

	/* Last shortcode bottom margin - nested */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .ish-sc-element:last-child,

	/* Last shortcodes bottom margin - nested in content elements */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column:last-child .wpb_wrapper > .wpb_content_element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column:last-child .wpb_wrapper > .ish-sc-element:last-child
	{
		margin-bottom: 0 !important;
	}

	/* Iconic box - Add bottom margin to last element in it */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child {
		margin-bottom: <?php echo '' . $padding; ?>px !important;
	}
	/* Iconic box - Remove bottom margin from all last boxes in all columns  */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box:last-child {
		margin-bottom: 0px !important;
	}
	/* Iconic box - Remove bottom margin from the box in the last column  */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column:last-child > .wpb_wrapper > .ish-sc_global_iconic_box:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .ish-sc_global_iconic_box:last-child,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column:last-child .wpb_wrapper > .ish-sc_global_iconic_box:last-child {
		margin-bottom: -<?php echo '' . $padding; ?>px !important;
	}

	/* Remove bottom margin - margin half  */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-half,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box.ish-bottom-margin-half,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-half{
		margin-bottom: 0px !important;
	}
	/* Remove bottom margin - margin none  */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-none,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box.ish-bottom-margin-none,
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-none{
		margin-bottom: -<?php echo '' . $padding; ?>px !important;
	}

	/* set margin for home pagination separator */
	.ish-part_content.ish-without-sidebar .ish-sc_separator.ish-separator-home-pagination
	{
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* NEW FIX - Divider only one in the row - change the bottom margin to half */
	.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element.ish-sc_divider:first-child:last-child {
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* WITH SIDEBAR */
	.ish-part_content.ish-with-sidebar .ish-pc-content > .wpb_row.ish-row-notfull > .ish-vc_row_inner
	/*.ish-part_content.ish-with-sidebar > .wpb_row.ish-row-notfull > .ish-vc_row_inner*/
	{
		padding-top: <?php echo '' . $padding; ?>px !important;
		padding-bottom: <?php echo '' . $padding; ?>px !important;
	}

	.ish-part_content.ish-with-sidebar>.wpb_row>.ish-vc_row_inner
	{
		/*padding-top: <?php /*echo '' . $padding; */?>px !important;*/
	}

	.ish-part_content.ish-with-sidebar .ish-pc-content .ish-vc_row_inner .ish-single_navigation {
		/*margin-top: <?php /*echo '' . $margin; */?>px !important;*/
	}

	.ish-part_content.ish-with-sidebar .ish-pc-content .ish-vc_row_inner .share_box_fixed
	{
		margin-top: <?php echo '' . $margin; ?>px !important;
	}

	.ish-part_content .ish-display-social .share_box_fixed,
	.ish-part_content.ish-with-sidebar .ish-pc-content .ish-display-social .ish-vc_row_inner .share_box_fixed
	{
		margin-top: 0px !important;
	}

	.ish-part_content > .wpb_row.ish-blog-prevnext-container > .ish-vc_row_inner,
	.ish-part_content > .wpb_row.ish-blog-categories-container > .ish-vc_row_inner,
	.ish-part_content.ish-with-sidebar .ish-pc-content > .wpb_row.ish-blog-prevnext-container > .ish-vc_row_inner,
	.ish-part_content.ish-with-sidebar .ish-pc-content > .wpb_row.ish-blog-categories-container > .ish-vc_row_inner
	{
		padding-top: 0 !important;
	}

	/*.ish-part_content > .wpb_row.ish-blog-prevnext-container > .ish-vc_row_inner,*/
	/*.ish-part_content.ish-with-sidebar .ish-pc-content > .wpb_row.ish-blog-prevnext-container > .ish-vc_row_inner,*/
	/*.ish-part_content > .wpb_row.ish-blog-related-posts-container > .ish-vc_row_inner
	{
		padding-bottom: 0 !important;
	}*/

	.ish-part_content.ish-with-sidebar .ish-pc-content.ish-grid8.ish-with-sidebar
	{
		width: 100%;
	}

	.ish-part_content .ish-blog-prevnext-container .ish-vc_row_inner
	{
		padding-bottom: <?php echo '' . $padding; ?>px;
	}


	/* Last shortcode bottom margin */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .ish-sc-element:last-child,

	/* Last shortcode bottom margin - nested */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column:last-child > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .ish-sc-element:last-child,

	/* Last shortcodes bottom margin - nested in content elements */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column:last-child .wpb_wrapper > .wpb_content_element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column:last-child .wpb_wrapper > .ish-sc-element:last-child
	{
		margin-bottom: 0 !important;
	}

	/* NEW FIX - Divider only one in the row - change the bottom margin to half */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element.ish-sc_divider:first-child:last-child {
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* Iconic box - Add bottom margin to last element in it */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box .ish-sc-element:last-child{
		margin-bottom: <?php echo '' . $padding; ?>px !important;
	}
	/* Iconic box - Remove bottom margin from all last boxes in all columns  */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box:last-child {
		margin-bottom: 0px !important;
	}
	/* Iconic box - Remove bottom margin from the box in the last column  */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column:last-child > .wpb_wrapper > .ish-sc_global_iconic_box:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row:last-child > .wpb_column:last-child .ish-sc_global_iconic_box:last-child,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row:last-child > .wpb_column:last-child .wpb_wrapper > .ish-sc_global_iconic_box:last-child {
		margin-bottom: -<?php echo '' . $padding; ?>px !important;
	}

	/* Remove bottom margin - margin half  */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-half,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box.ish-bottom-margin-half,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-half{
		margin-bottom: 0px !important;
	}
	/* Remove bottom margin - margin none  */
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-none,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .wpb_row > .wpb_column .ish-sc_global_iconic_box.ish-bottom-margin-none,
	.ish-pc-content > .wpb_row > .ish-vc_row_inner:last-child > .wpb_column > .wpb_wrapper > .ish-sc-element .wpb_row > .wpb_column .wpb_wrapper > .ish-sc_global_iconic_box.ish-bottom-margin-none{
		margin-bottom: -<?php echo '' . $padding; ?>px !important;
	}

	/* Move -30px up if section goes after section */
	/*.ish-pc-content > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection
	{
		margin-top: -<?php /*echo '' . $margin; */?>px;
	}*/

	/* Clear top padding for next not-section row */
	.ish-pc-content > .wpb_row.ish-row_notsection + .wpb_row.ish-row_notsection > .ish-vc_row_inner
	{
		padding-top: 0 !important;
	}

	/* Make last section margin half 50 -> 25 */
	.ish-part_content.ish-with-sidebar .ish-pc-content > .ish-row_section:last-child
	{
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* 'Unboxed' layout */
	.ish-part_content > .ish-row > .ish-row_inner
	{
		padding-left: 0 !important;
		padding-right: 0 !important;
	}

	/* Padding left & right for not section & sidebar */
	.ish-pc-content > .wpb_row.ish-row_notsection,
	.ish-main-sidebar
	{
		padding-left: <?php echo '' . $padding; ?>px !important;
		padding-right: <?php echo '' . $padding; ?>px !important;
	}

	/* Sidebar */
	.ish-main-sidebar
	{
		padding-top: 0 !important;
		padding-bottom: <?php echo '' . $padding; ?>px !important;

		width: 100% !important;
		margin-left: 0 !important;
	}

	.ish-main-sidebar:before
	{
		display: none !important;
		content: '';
	}

	.ish-main-sidebar > .ish-row:first-child {
		padding-top: 35px;
	}
	.ish-main-sidebar > .ish-row:first-child:before {
		border-top: 1px solid;
		border-bottom: 1px solid;
		height: 4px;
		display: block;
		position: absolute;
		top: 0;
		width: 100%;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}

	/* Sidebar widgets */
	.ish-main-sidebar .widget
	{
		padding-top: <?php echo '' . $padding; ?>px !important;
	}

	/* Search position & paddings */
	.ish-part_searchbar div input[type="text"]
	{
		padding-left: <?php echo '' . $padding; ?>px;
		padding-right: <?php echo '' . $padding; ?>px;
	}

	/* Expandable center + paddings - make top padding smaller */
	.ish-part_expandable .ish-pe-bg
	{
		padding-top: <?php echo '' . $padding; ?>px;
	}

	/* Clear rows padding */
	.ish-part_expandable .ish-pe-bg > .ish-row
	{
		padding-bottom: 0;
	}

	/* Set bottom padding to each grid */
	.ish-part_expandable [class^="ish-grid"], .ish-part_expandable [class*=" ish-grid"]
	{
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	/* Footer paddings */
	.ish-part_footer .ish-row .ish-row_inner
	{
		padding-top: 0 !important;
		padding-bottom: 0 !important;
	}

	.ish-part_footer .ish-row:first-child
	{
		padding-top: <?php echo '' . $padding; ?>px;
	}

	/* Set bottom padding to each grid */
	.ish-part_footer .ish-row .ish-row_inner [class^="ish-grid"], .ish-part_footer .ish-row .ish-row_inner [class*=" ish-grid"]
	{
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	/* Legals part padding fix */
	.ish-part_footer .ish-row-notfull + .ish-row.ish-footer-legals > .ish-row_inner > .ish-grid12
	{
		padding-top: <?php echo '' . $padding; ?>px;
	}

	/* Content -------------------------------------------------------------------------------------------------- */
	/* Sticky position on native android browser - shadow bug */
	.ish-part_header.ish-sticky-scrolling
	{
		left: 0;
	}

	/* Hide tagline */
	.ish-ph-wp_tagline
	{
		display: none;
	}

	/* Make searchbar font smaller */
	.ish-part_searchbar div input[type="text"]
	{
		font-size: 31px;
	}

	/* Make margin between nav buttons smaller */
	.ish-ph-mn-resp_nav li
	{
		margin-left: 0 !important;
		margin-right: 0 !important;
	}

	/* Hide sticky on responsive layout */
	body.ish-sticky_resp-off
	{
		padding-top: 0;
	}

	.ish-sticky_resp-off .ish-part_header
	{
		position: absolute !important;
	}

	/* Non float for breadcrumbs */
	.ish-breadcrumbs, .ish-socials
	{
		float: none;
	}

	/* Full width categories */
	.ish-row-full .ish-section-filter
	{
		padding-top: <?php echo '' . $padding; ?>px !important;
	}


	.ish-part_tagline .ish-pt-taglines .ish-posts-count{
		display: none;
	}
	.ish-part_tagline .ish-pt-taglines-additional .ish-posts-count{
		display: block;
	}

    .ish-resp-centered .ish-author-icons{
	    text-align: center !important;
    }

	.ish-resp-centered .ish-author-icons .ish-sc_icon:first-child{
		width: 2.5em !important;
    }


    /* Change Vertically aligned columns back to block */
	.ish-part_tagline .wpb_row.ish-valign-middle > .ish-vc_row_inner > .wpb_column,
	.ish-part_tagline .wpb_row.ish-valign-middle > .wpb_column,
	.ish-part_tagline .wpb_row.ish-valign-bottom > .ish-vc_row_inner > .wpb_column,
	.ish-part_tagline .wpb_row.ish-valign-bottom > .wpb_column,
	.ish-part_tagline .wpb_row.ish-valign-top > .ish-vc_row_inner > .wpb_column,
	.ish-part_tagline .wpb_row.ish-valign-top > .wpb_column
	{
		display: block !important;
	}

	.single-post .ish-blog-related-posts-container .ish-sc_recent_posts {
		margin-bottom: -30px !important;
	}

	/* Shortcodes ----------------------------------------------------------------------------------------------- */
	.ish-sc-element,
	.wpb_content_element {
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* Sidebar shortcode*/
	.ish-sc_sidebar .ish-row .ish-row_inner
	{
		padding-top: 0 !important;
		padding-bottom: 0 !important;
	}

	.ish-sc_sidebar .ish-row .ish-row_inner [class^="ish-grid"], .ish-sc_sidebar .ish-row .ish-row_inner [class*=" ish-grid"]
	{
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	.ish-sc_sidebar .ish-row:last-child .ish-row_inner [class^="ish-grid"]:last-child, .ish-sc_sidebar .ish-row:last-child .ish-row_inner [class*=" ish-grid"]:last-child
	{
		padding-bottom: 0;
	}

	/* Recent posts */
	.ish-sc_recent_posts .ish-row .ish-recent_posts_post
	{
		padding-bottom: <?php echo '' . $padding; ?>px !important;
	}

	.ish-sc_recent_posts .ish-row:last-child .ish-recent_posts_post:last-child
	{
		padding-bottom: 0 !important;
	}

	.ish-unboxed [class^="ish-part_"] > .ish-row-full .vc_col-sm-12 .ish-sc_recent_posts.ish-rp-fullwidth.ish-rp-boxed .post > .ish-vc_row_inner,
	.ish-boxed [class^="ish-part_"] > .ish-row-full .vc_col-sm-12 .ish-sc_recent_posts.ish-rp-fullwidth .post > .ish-vc_row_inner
	{
		padding-left: <?php echo '' . $padding; ?>px !important;
		padding-right: <?php echo '' . $padding; ?>px !important;
	}

	.ish-unboxed [class^="ish-part_"] > .ish-row-full .vc_col-sm-12 .ish-sc_recent_posts.ish-rp-fullwidth.ish-rp-boxed .post:hover > .ish-vc_row_inner,
	.ish-boxed [class^="ish-part_"] > .ish-row-full .vc_col-sm-12 .ish-sc_recent_posts.ish-rp-fullwidth .post:hover > .ish-vc_row_inner
	{
		padding-left: <?php echo '' . $padding; ?>px !important;
		padding-right: <?php echo '' . $padding; ?>px !important;
	}

	.ish-sc_recent_posts.ish-rp-fullwidth .ish-post-icon,
	.ish-sc_recent_posts.ish-rp-fullwidth .ish-post-title,
	.ish-sc_recent_posts.ish-rp-fullwidth .rc-post-details
	{
		display: block !important;
		text-align: center;
		width: auto !important;
		padding: 0;
		margin: 0;
	}

	.ish-sc_recent_posts.ish-rp-fullwidth .ish-post-content
	{
		padding: 0px;
	}

	.ish-sc_recent_posts.ish-rp-fullwidth .ish-post-icon,
	.ish-sc_recent_posts.ish-rp-fullwidth .ish-post-title
	{
		margin-bottom: 10px !important;
	}

	/* left / right tabs switch to inline */
	.ish-tabs-navigation.ish-tabs-left ul li, .ish-tabs-navigation.ish-tabs-right ul li
	{
		display: inline-block;
		float: left;
		margin-left: 1px !important;
	}

	.ish-tabs-navigation.ish-tabs-left ul li:first-child, .ish-tabs-navigation.ish-tabs-right ul li:first-child
	{
		margin-left: 0 !important;
	}


	/* Separator */
	.ish-sc_separator{
		width: 100% !important;
	}


	/* Slidable */
	.ish-slidable .ish-slide.ish-bgimage {
		padding: 30px;
	}

	/* Divider */
	.ish-sc_divider.ish-hide-in-mobile {
		display: none;
	}


	/* Map */
	.ish-sc_map.ish-ignore-height {
		height: 400px !important;
	}


	/* .ish-resp-centered */
	.ish-resp-centered .ish-sc_quote cite
	{
		text-align: center;
	}

	.ish-resp-centered .ish-sc_skill
	{
		text-align: left;
	}

	.ish-resp-centered .ish-sc_social_share
	{
		margin-left: auto !important;
		margin-right: auto !important;
	}

	.ish-resp-centered .ish-sc_social_share .addthis_toolbox
	{
		display: inline-block;
	}

	.ish-resp-centered .ish-sc_chart
	{
		margin-left: auto !important;
		margin-right: auto !important;
	}

	.ish-resp-centered .ish-sc_portfolio_gallery .ish-portfolio-image img
	{
		margin-left: auto !important;
		margin-right: auto !important;
	}

	.ish-sc_portfolio .ish-p-col a .ish-p-overlay div .ish-p-title .ish-p-box
	{
		padding: <?php echo '' . $padding; ?>px !important;
	}

	.ish-resp-centered .ish-sc_separator
	{
		margin-left: auto !important;
		margin-right: auto !important;
	}

	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-line
	{
		width: 50% !important;
	}

	.ish-resp-centered .ish-sc_separator.ish-separator-text.ish-no-align .ish-text,
	.ish-resp-centered .ish-sc_separator.ish-separator-text.ish-no-icon.ish-no-align .ish-text
	{
		padding-left: 10px !important;
	}

	/* To discuss */
	.ish-resp-centered .ish-sc_separator.ish-separator-thin-bold:before
	{
		left: 50%;
		margin-left: -35px;
	}

	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-line,
	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-icon + .ish-line,
	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-text + .ish-line
	{
		/*width: 50% !important;*/
		display: table-cell;
		padding: 0 !important;
	}

	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-line.ish-left,
	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-line.ish-right
	{
		padding: 1px !important;
	}

	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-icon,
	.ish-resp-centered .ish-sc_separator.ish-separator-text.ish-left:not(.ish-text) .ish-icon.ish-left,
	.ish-resp-centered .ish-sc_separator.ish-separator-text.ish-left:not(.ish-text) .ish-icon.ish-right,
	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-text
	{
		padding-left: 10px !important;
		padding-right: 10px !important;
	}

	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-icon + .ish-text,
	.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-text + .ish-icon
	{
		padding-left: 0 !important;
	}

	/*.ish-resp-centered .ish-sc_separator.ish-separator-text .ish-text
	{
		display: block;
	}*/

	/* set padding for home categories separator */
	.ish-sc_separator.ish-separator-home-categories,
	.ish-sc_separator.ish-separator-portfolio-pagination,
	.ish-sc_portfolio .ish-pagination
	{
		margin-top: <?php echo '' . $margin; ?>px !important;
	}

	.ish-resp-centered .ish-sc_table th,
	.ish-resp-centered .ish-sc_table tr,
	.ish-resp-centered .ish-sc_table td
	{
		text-align: center;
	}

	.ish-resp-centered .ish-sc_pricing_table th,
	.ish-resp-centered .ish-sc_pricing_table tr,
	.ish-resp-centered .ish-sc_pricing_table td
	{
		text-align: center;
	}

	.ish-resp-centered .ish-sc_map
	{
		text-align: initial;
	}

	.ish-resp-centered .ish-slidable .owl-pagination
	{
		text-align: center;
		width: 100%;
	}

	.ish-resp-centered .ish-slidable li
	{
		display: inline-block;
	}

	.ish-resp-centered .ish-sc_menu ul
	{
		text-align: left;
	}

    .ish-resp-centered .widget ul ul,
    .ish-resp-centered .widget li ul
    {
	    padding-left: 0;
    }

	/* Gallery */
	.ish-sc_gallery > .ish-row [class^="ish-grid"]:not(.ish-grid2):not(.ish-grid1),
	.ish-sc_gallery > .ish-row [class*=" ish-grid"]:not(.ish-grid2):not(.ish-grid1)
	{
		width: 33.33332%;
	}

	.ish-sc_gallery > .ish-row [class^="ish-grid"],
	.ish-sc_gallery > .ish-row [class*=" ish-grid"]
	{
		float: left;
	}

	.ish-sc_gallery.ish-sc-element:last-child {
		 margin-bottom: 30px !important;
	}

	/* Video BG */
	.wpb_row.ish-videobg video
	{
		display: none;
	}

	/* Box */
	.ish-sc_box {
		padding: 30px !important;
	}
	.ish-sc_box.ish-zero-padding {
		padding: 0 !important;
	}
	.ish-sc_box:not(.ish-bgimage):not([class*="ish-color"]):not([class*="ish-border-color"]){
		padding: 0 !important;
	}

	.ish-row-full:not(.ish-row-full-padding) .ish-sc_box:not(.ish-bgimage):not([class*="ish-color"]):not([class*="ish-border-color"]){
		padding: 0 30px !important;
	}


    /* Icon Text */
	.ish-sc_icon_text.ish-resp-move [class*="ish-it-"]{
		display: block;
		padding: 0 !important;
	}

	.ish-sc_icon_text.ish-resp-move .ish-it-icon .ish-sc-element{
		margin-bottom: 30px !important;
	}

	.ish-sc_icon_text.ish-resp-move.ish-right .ish-it-icon {
		display: table-header-group;
	}

	.ish-sc_icon_text.ish-resp-move.ish-right .ish-it-text {
		display: table-footer-group;
	}

	.ish-resp-centered .ish-sc_icon_text.ish-resp-keep.ish-right{
		text-align: right;
	}
	.ish-resp-centered .ish-sc_icon_text.ish-resp-keep.ish-left{
		text-align: left;
	}

	/* 404 padding fix ---------------------------------------------------------------------------------------------- */
	.error404 .ish-part_content .ish-vc_row_inner {
		padding-bottom: <?php echo '' . $padding; ?>px !important;
	}

	/* Blog ----------------------------------------------------------------------------------------------------- */
	/* Add comment form */
	.ish-comments-form input,
	.ish-comments-form textarea
	{
		margin-top: 10px;
	}

	.ish-comments-form .ish-grid4:first-child input
	{
		margin-top: 0px;
	}

	.ish-comments-form
	{
		padding-top: 0;
	}

	.ish-comments-form .ish-sc_separator.ish-separator-text
	{
		margin-top: <?php echo '' . $margin; ?>px !important;
	}

	/*.ish-row.ish-with-sidebar .ish-blog-comments-container
	{
		padding-top: <?php /*echo '' . $padding; */?>px;
	}*/

	/*.ish-row.ish-with-sidebar .ish-blog-related-posts-container + .ish-blog-comments-container {*/
	.wpb_row.ish-blog-related-posts-container + .ish-blog-comments-container,
	.ish-row .ish-blog-related-posts-container + .ish-blog-comments-container {
		padding-top: <?php echo '' . $padding; ?>px !important;
	}

	.ish-row.ish-with-sidebar .ish-blog-related-posts-container + .ish-blog-comments-container > .ish-vc_row_inner > .ish-comments-form > .ish-separator-double,
	.wpb_row.ish-blog-related-posts-container + .ish-blog-comments-container > .ish-vc_row_inner > .ish-comments-form > .ish-separator-double {
		margin-top: 0 !important;
	}

	/* Masonry layout fix */
	.ish-without-sidebar .ish-masonry-container + .wpb_row
	{
		padding-top: <?php echo '' . $padding; ?>px !important;
	}

	.ish-with-sidebar .ish-masonry-container + .wpb_row
	{
		padding-top: 0 !important;
	}

	.ish-part_content.ish-with-sidebar .wpb_row.ish-masonry-container.ish-row-notfull .ish-vc_row_inner
	{
		padding-top: 0 !important;
		padding-bottom: 0 !important;
	}

	/* No categories - without sidebar */
	.ish-part_breadcrumbs + .ish-part_content.ish-without-sidebar > .ish-masonry-container.ish-row-notfull > .ish-vc_row_inner
	{
		padding-top: <?php echo '' . $padding; ?>px !important;
	}

	.ish-part_content.ish-without-sidebar > .ish-section-filter + .ish-masonry-container.ish-row-notfull > .ish-vc_row_inner
	{
		padding-top: 0 !important;
	}

	/* No categories - with sidebar */
	.ish-part_breadcrumbs + .ish-part_content.ish-with-sidebar > .ish-row > .ish-row_inner > .ish-grid9 > .ish-masonry-container.ish-row-notfull > .ish-vc_row_inner
	{
		padding-top: <?php echo '' . $padding; ?>px !important;
	}

	.ish-part_content.ish-with-sidebar > .ish-row > .ish-row_inner > .ish-grid9 > .ish-section-filter + .ish-masonry-container.ish-row-notfull > .ish-vc_row_inner
	{
		padding-top: 0 !important;
	}

	/* No pagination */
	.ish-masonry-container.ish-row-notfull
	{
		padding-bottom: <?php echo '' . $padding; ?>px !important;
	}

	.ish-with-sidebar .ish-masonry-container.ish-row-full
	{
		padding-bottom: <?php echo '' . $padding; ?>px !important;
	}

	/* With pagination */
	.ish-part_content .wpb_row.ish-masonry-container.ish-row-notfull + .wpb_row .ish-vc_row_inner
	{
		padding-top: 0 !important;
	}

	/* 2columns blog overview */
	.ish-blog-2columns .ish-post-content,
	.ish-blog-2columns .ish-post-media
	{
		/*margin: 0 !important;*/
		display: table-header-group;
	}

	.ish-blog-2columns .ish-post-media,
	.ish-blog-2columns .ish-post-content,
	.ish-blog-2columns .ish-blog-post-content
	{
		padding: 0 !important;
	}

	.ish-blog-2columns .wpb_row.ish-content-align-right,
	.ish-blog-2columns h2,
	.ish-blog-2columns .ish-blog-post-details,
	.ish-blog-2columns .ish-blog-video-content,
	.ish-blog-2columns .ish-blog-audio-content,
	.ish-blog-2columns .ish-blog-post-media,
	.ish-blog-2columns .ish-blog-post-links,
	.ish-blog-2columns .ish-blog-post-excerpt
	{
		text-align: left;
	}

	.ish-blog-2columns h2
	{
		margin-top: <?php echo '' . $margin; ?>px !important;
	}

	.ish-blog-2columns .ish-post-content
	{
		display: table-footer-group;
	}

	.ish-blog-2columns .ish-post-content,
	.ish-blog-2columns .ish-post-media,
	.ish-blog-2columns .ish-post-media a img
	{
		width: 100%;
	}

	.ish-blog-2columns .ish-format-link-url,
	.ish-blog-2columns .format-quote blockquote
	{
		padding: 60px;
	}

	.ish-blog-2columns .ish-post-media .ish-link-media
	{
		padding: 60px;
	}

	.ish-blog-2columns .ish-post-content:after
	{
		content: '';
		display: block;
		width: 100%;
		height: 1px;
		margin-top: <?php echo '' . $margin; ?>px !important;
	}

	/* Add top and bottom padding to all inner rows */
	.ish-blog-classic.ish-part_content.ish-without-sidebar > .ish-row > .ish-row_inner,
	.ish-blog-classic.ish-part_content.ish-without-sidebar > .wpb_row > .ish-vc_row_inner
	{
		/*padding-top: 0px !important;*/
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	/* Add top padding for first child of inner rows */
	.ish-blog-classic.ish-part_content.ish-without-sidebar > .ish-row:first-child > .ish-row_inner,
	.ish-blog-classic.ish-part_content.ish-without-sidebar > .wpb_row:first-child > .ish-vc_row_inner
	{
		/*padding-top: <?php /*echo '' . $padding; */?>px !important;*/
	}

	/* Responsive layout of overview page */
	.ish-blog-fullwidth .ish-post-content,
	.ish-blog-classic .ish-post-content
	{
		margin-left: 0;
		padding-left: 0;
	}

	.ish-blog-classic .ish-blog-post-details span, .ish-blog-classic .ish-blog-post-details a
	{
		line-height: 20px !important;
		display: inline-block;
		padding: 0 4px;
	}

	.ish-blog-classic .ish-blog-post-details .ish-spacer
	{
		/*display: none !important;*/
	}

	.ish-blog-classic .ish-post-content:after
	{
		margin-top: <?php echo '' . $margin; ?>px;
	}

	/**/
	.ish-blog-fullwidth .ish-blog-responsive-post-details,
	.ish-blog-classic .ish-blog-responsive-post-details
	{
		display: block;
	}

	/* set margin for home pagination separator */
	.ish-sc_separator.ish-separator-home-pagination,
	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-sc_separator.ish-separator-home-pagination
	{
		margin-top: -<?php echo '' . $margin; ?>px !important;
	}

	.ish-part_content.ish-with-sidebar.ish-blog-2columns .ish-sc_separator.ish-separator-home-pagination
	{
		padding-right: 30px;
		padding-left: 30px;
	}


	/* prev next post navigation + social icons */
	.ish-single_navigation,
	.share_box_fixed
	{
		display: inline-block;
		margin-bottom: 0px;
	}

	.share_box_fixed
	{
		margin-top: <?php echo '' . $margin; ?>px;
	}

	.ish-display-social .share_box_fixed
	{
		margin-top: 0;
	}

	.ish-part_content .wpb_row .share_box_fixed,
	.ish-part_content .wpb_row .ish-single_navigation,
	.ish-part_content .wpb_row .ish-single_post_categories_and_tags
	{
		padding-top: <?php echo '' . $padding; ?>px !important;
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	.share_box_fixed
	{
		margin-bottom: 0;
	}

	/*.ish-single_navigation,*/
	.single-post .ish-single_post_categories_and_tags,
	.single-post .ish-single_post_categories_and_tags > div:last-child
	{
		margin-top: 0px;
	}

	.single-post .ish-single_post_categories_and_tags > div
	{
		text-align: center !important;
	}

	.ish-comments-headline
	{
		padding-top: <?php echo '' . $padding; ?>px;
	}

	.single-post .ish-related-headline
	{
		padding: <?php echo '' . $padding; ?>px 0;
	}

	.ish-comments li.comment > div, .ish-comments li.comment .comment-avatar
	{
		padding: <?php echo '' . $padding; ?>px 0;
	}

	.ish-comments li.comment > div
	{
		padding-left: 90px;
	}

	.ish-comments + .ish-pagination
	{
		padding-top: <?php echo '' . $padding; ?>px;
		margin-bottom: <?php echo '' . $margin; ?>px;
	}

	.ish-comments-form .ish-comments-headline
	{
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	.ish-comments-form form .ish-row:first-child
	{
		padding-bottom: 0 !important;
	}

	.ish-comments-form form .ish-row p
	{
		padding-bottom: 0px;
	}

	.ish-comments-form form .ish-row > div:last-child p
	{
		padding-bottom: 0 !important;
	}

	.ish-ct-tags
	{
		margin-top: 0 !important;
	}

	/* NEW ------------------------------------------------------------------------------------------------------ */
	.ish-blog-masonry.ish-blog-masonry-layout-grid-boxes .ish-blog-post-masonry > .ish-blog-post-content > div
	{
		padding: 75px !important;
	}

	/* Portfolio ------------------------------------------------------------------------------------------------ */
	.ish-sc_portfolio .ish-section-filter
	{
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/* Widgets -------------------------------------------------------------------------------------------------- */
	.ish-main-sidebar .widget .widget-title,
	.ish-sc_sidebar .widget .widget-title,
	.ish-part_expandable .widget .widget-title,
	.ish-part_footer .widget .widget-title
	{
		/*padding-bottom: <?php /*echo '' . $padding; */?>px !important;*/
		padding-bottom: 0 !important;
	}

	.widget_ishyoboy-dribbble-widget .dribbble-widget a img,
	.widget_ishyoboy-flickr-widget #flickr_badge_wrapper div,
	.widget_ishyoboy-recent-portfolio-widget .recent-projects-widget li,
	.widget.null-instagram-feed .instagram-pics li
	{
		width: 16.65% !important;
	}

	.ish-sidenav .widget_ishyoboy-dribbble-widget .dribbble-widget a img,
	.ish-sidenav .widget_ishyoboy-flickr-widget #flickr_badge_wrapper div,
	.ish-sidenav .widget_ishyoboy-recent-portfolio-widget .recent-projects-widget li,
	.ish-sidenav .widget.null-instagram-feed .instagram-pics li
	{
		width: 33.3% !important;
	}

	.ish-sidenav .widget {
		padding-top: <?php echo '' . $padding; ?>px;
	}

	.ish-sidenav .widget .widget-title {
		padding-bottom: 0 !important;
	}

    /* SEARCH RESULTS ----------------------------------------------------------------------------------------------- */
	.ish-search-result + .wpb_row > .ish-vc_row_inner > .ish-separator-home-pagination {
		margin-top: 0 !important;
	}

	/* Plugins ------------------------------------------------------------------------------------------------------ */
	/* Woocommerce */

	.woocommerce .ish-resp-centered ul.products li.product
	{
		text-align: center;
	}

	.ish-resp-centered .woocommerce .star-rating
	{
		margin-left: auto;
		margin-right: auto;
	}

	.woocommerce .woocommerce-shipping-fields
	{
		margin-top: <?php echo '' . $margin; ?>px !important;
	}

	.calculated_shipping table th,
	.calculated_shipping table td,
	.woocommerce .cart-collaterals .cart_totals table th,
	.woocommerce .cart-collaterals .cart_totals table td,
	.woocommerce-page .cart-collaterals .cart_totals table th,
	.woocommerce-page .cart-collaterals .cart_totals table td
	{
		width: auto !important;
	}

	.woocommerce table.shop_table .coupon .input-text,
	.woocommerce-page table.shop_table .coupon .input-text
	{
		width: 48% !important;
	}

	.calculated_shipping .wc-proceed-to-checkout,
	.woocommerce .cart-collaterals .cart_totals .wc-proceed-to-checkout,
	.woocommerce-page .cart-collaterals .cart_totals .wc-proceed-to-checkout,
	.woocommerce .button[name="update_cart"]
	{
		width: 100% !important;
	}

	/*.woocommerce .cart_totals table th,
	.woocommerce .cart_totals table td,
	.woocommerce table.shop_table th,
	.woocommerce table.shop_table td
	{
		text-align: left;
	}*/

	.woocommerce .products .star-rating
	{
		display: inline-block;
	}

	.woocommerce form.login .form-row,
	.woocommerce-page form.login .form-row
	{
		width: 100%;
		margin-right: 0 !important;
	}

	.woocommerce-account .addresses .title h3
	{
		float: none;
	}

	.woocommerce .order_details li
	{
		width: 100%;
	}

	.woocommerce .woocommerce-product-rating
	{
		float: left;
		width: 100%;
	}

	.woocommerce table.cart td.actions .button[name="apply_coupon"]
	{
		width: 100%;
		margin: 4px 0 0 0 !important;
	}

	.woocommerce-cart table.cart td.actions .coupon .input-text
	{
		width: 100% !important;
		margin-top: 30px !important;
		margin-bottom: 6px !important;

	}

	.woocommerce .order_details
	{
		padding-left: 0;
	}

	.calculated_shipping,
	.woocommerce .cart-collaterals .cart_totals,
	.woocommerce-page .cart-collaterals .cart_totals
	{
		padding-top: 0;
	}

	/* woocommerce - product page */
	.woocommerce div.product div.summary,
	.woocommerce-page div.product div.summary,
	.woocommerce-checkout #order_review_heading:before
	{
		margin-top: 0;
	}

	.ish-product-prevnext-container .ish-vc_row_inner .ish-display-table
	{
		padding-top: 0;
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	.woocommerce div.product .woocommerce-tabs .panel
	{
		padding-top: <?php echo '' . $padding; ?>px;
	}

	.woocommerce-checkout #customer_details h3,
	.woocommerce .related.products h2,
	#cart_heading
	{
		padding-bottom: <?php echo '' . $padding; ?>px;
	}

	.woocommerce-checkout #order_review_heading,
	.woocommerce-checkout #payment_heading
	{
		padding-top: 0;
		padding-bottom: 0;
	}

	.woocommerce #reviews #comments h2,
	.woocommerce-page #reviews #comments h2,
	.calculated_shipping h2,
	.woocommerce .cart-collaterals .cart_totals h2,
	.woocommerce-page .cart-collaterals .cart_totals h2,
	.woocommerce-page select,
	.woocommerce .products .star-rating,
	.woocommerce div.product span.price
	{
		margin-bottom: 0 !important;
	}

	.woocommerce .product-type-grouped table.group_table .quantity
	{
		margin-right: <?php echo '' . $margin; ?>px !important;
	}

    .woocommerce #reviews h3,
    .woocommerce-page #reviews h3,
    .woocommerce #reviews #reply-title,
	.woocommerce-page #reviews #reply-title
	{
		margin-top: 0 !important;
		margin-bottom: 0 !important;
	}

	.woocommerce ul.woocommerce-error:after,
	.woocommerce div.woocommerce-message:after,
	.woocommerce div.woocommerce-info:after,
	.woocommerce-page ul.woocommerce-error:after,
	.woocommerce-page div.woocommerce-message:after,
	.woocommerce-page div.woocommerce-info:after
	{
		margin-top: <?php echo '' . $margin; ?>px;
		margin-bottom: <?php echo '' . $margin; ?>px;
	}

	.woocommerce .ish-woocommerce-order-details-separator
	{
		margin-top: <?php echo '' . $margin; ?>px !important;
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	.woocommerce ul.woocommerce-error,
	.woocommerce div.woocommerce-message,
	.woocommerce div.woocommerce-info,
	.woocommerce-page ul.woocommerce-error,
	.woocommerce-page div.woocommerce-message,
	.woocommerce-page div.woocommerce-info,
	.woocommerce #reviews #comments ol.commentlist,
	.woocommerce .related.products:before,
	.woocommerce #reviews #comments .woocommerce-noreviews,
	.woocommerce #reviews #comments .woocommerce-pagination,
	.woocommerce .ish-woocommerce-shop-separator,
	/*.woocommerce ul.products li.product,
	.woocommerce-page ul.products li.product,*/
	.woocommerce div.product p.price,
	.woocommerce-checkout #order_review_heading:before,
	.woocommerce-account .addresses-title-separator:before,
	.woocommerce.add_to_cart_inline .product-price,
	.woocommerce .myaccount_user,
	.woocommerce-checkout #customer_details,
	.woocommerce ul.products li.product,
	.woocommerce-page ul.products li.product,
	.woocommerce div.product .woocommerce-tabs .panel,
	.woocommerce .product-type-grouped table.group_table .quantity
	{
		margin-bottom: <?php echo '' . $margin; ?>px !important;
	}

	/*.woocommerce ul.products li.product a:not(.button)
	{
		display: inline;
	}*/


	<?php
		$columns_count = Array( '6', '5', '4', '3' );
		foreach ($columns_count as $column ){
	?>
		.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n),
		.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n)
		{
			width: 48%;
			clear: none;
			margin-right: 3.8%;
		}

		.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(2n),
		.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(2n)
		{
			margin-right: 0;
		}

		.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(2n+1),
		.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(2n+1)
		{
			clear: both;
		}

	<?php
		};
	?>



}

/* User defined breaking point (768px - 1 ) & less ****************************************************************/
@media all and ( max-width: <?php echo ($responsive_layout_breakingpoint - 1); ?>px )
{
	.ish-ph-mn-resp_nav > li > a > span
	{
		display: none;
	}
}

<?php
// SideNav Breakingpoint in case its width being set in %
if ( false !== strpos( ISHFREELOTHEME_SIDENAV_WIDTH, '%') ){
	// Percents ( Pixels are set in dynamic_misc as they do not need media queries )
	$new_point = str_replace( '%', '', ISHFREELOTHEME_SIDENAV_WIDTH );
	$sidenav_breaking_point = (int)($responsive_layout_breakingpoint / ( $new_point / 100));

	?>

/* SideNav change on user defined breaking point (768px) & less ***********************************************/
@media all and ( max-width: <?php echo '' . $sidenav_breaking_point; ?>px )
{

	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Ish */
	.ish-sidenav [class^="ish-grid"], .ish-sidenav [class*=" ish-grid"]
	{
		float: none;
		width: 100%;
		margin-left: 0;
	}

	/* VC */
	.ish-sidenav .vc_row-fluid [class^="wpb_column"],
	.ish-sidenav .vc_row-fluid [class*=" wpb_column"]
	{
		float: none !important;
		width: 100% !important;
		margin-left: 0 !important;
	}

}

<?php
}

?>


/* 480px **********************************************************************************************************/
@media all and ( max-width: 480px )
{

<?php
// Vars --------------------------------------------------------------------------------------------------------
$padding = 30;
$margin = 30;
?>



	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Layout --------------------------------------------------------------------------------------------------- */
	/* Content -------------------------------------------------------------------------------------------------- */
	/* Resp nav non-float */
	.ish-sidenav
	{
		padding-left: <?php echo '' . $padding; ?>px;
		padding-right: <?php echo '' . $padding; ?>px;
	}

	.ish-ph-main_nav, .ish-ph-logo
	{
		float: none;
		margin: 0 auto;
	}

	.ish-part_header.ish-sticky-scrolling .ish-ph-logo
	{
		display: none;
	}

	.ish-part_header:not(.ish-sticky-scrolling) .ish-ph-logo,
	.ish-part_header:not(.ish-sticky-scrolling) .ish-ph-main_nav
	{
		height: 50% !important;
	}

	.ish-part_header:not(.ish-sticky-scrolling) .ish-row_inner:before
	{
		left: 50%;
		margin-left: -35px;
	}

	/*.ish-part_header:not(.ish-sticky-scrolling) .ish-ph-main_nav > ul > li > a {
		padding: 0 10px !important;
	}*/

	.ish-ph-logo img
	{
		max-height: 35px !important;
		margin-top: 15px;
	}

	/* Resp breadcrumb bar */
	.ish-pb-breadcrumbs, .ish-pb-socials
	{
		float: none;
		width: 100%;
		display: table;
	}

	.ish-pb-breadcrumbs > div
	{
		margin: 0 auto;
		text-align: center;
	}

	.ish-pb-socials
	{
		text-align: center;
	}

	.ish-pb-socials > div
	{
		display: inline-block;
		float: none !important;
	}

	.ish-pb-breadcrumbs + .ish-pb-socials,
	.ish-pb-socials + .ish-pb-breadcrumbs
	{
		padding-top: 5px;
	}

	/* Hide socials / center top bar */
	.ish-part_header_bar .ish-hb-social
	{
		display: none;
	}

	/* Center Resp TopBar Menu */
	.ish-part_header_bar .ish-top_nav_container .ish-phb-resp_nav
	{
		display: block !important;
	}

	.ish-part_header_bar .ish-top_nav_container > ul > li
	{
		float: none;
	}

	.ish-part_header_bar .ish-hb-menu
	{
		float: none;
		text-align: center;
	}

	.ish-part_tagline h1
	{
		/*font-size: 200% !important;*/
		/*line-height: 120%;*/
	}

	.ish-blog-2columns .ish-format-link-url,
	.ish-blog-2columns .format-quote blockquote
	{
		padding: <?php echo '' . $padding; ?>px;
	}

	.ish-blog-2columns .ish-post-media .ish-link-media
	{
		padding: <?php echo '' . $padding; ?>px;
	}

	.ish-comments ul.children
	{
		padding-left: <?php echo '' . $padding; ?>px;
	}

	.ish-comments li.comment .comment-avatar img
	{
		width: 50px;
		height: 50px;
	}

	.ish-comments li.comment > div
	{
		padding-left: 70px;
	}


	/* Website Border */
	<?php if ( isset( $ish_newdata['use_website_border'] ) && '0' != $ish_newdata['use_website_border'] ){ ?>

	.ish-wrapper-all > [class^="ish-part_"]{
		border-left: none !important;
		border-right: none !important;
	}

	.ish-wrapper-all > [class^="ish-part_"]:first-child{
		border-top: none !important;
	}

	.ish-wrapper-all > [class^="ish-part_"]:last-child{
		border-bottom: none !important;
	}

	.ish-unboxed .ish-wrapper-all:after {
		content: '' !important;
		width: 0 !important;
		height: 0 !important;
	}

	.ish-part_header_bar {
		height: 40px !important;
		min-height: 40px !important;
	}

	<?php } ?>

	/* Shortcodes ----------------------------------------------------------------------------------------------- */
	/* Gallery */
	.ish-sc_gallery > .ish-row [class^="ish-grid"]:not(.ish-grid1),
	.ish-sc_gallery > .ish-row [class*=" ish-grid"]:not(.ish-grid1)
	{
		width: 49.99999%;
	}

	/* Blog ----------------------------------------------------------------------------------------------------- */
	/* NEW ------------------------------------------------------------------------------------------------------ */
	.ish-blog-masonry.ish-blog-masonry-layout-grid-boxes .ish-blog-post-masonry > .ish-blog-post-content > div
	{
		padding: <?php echo '' . $padding; ?>px !important;
	}

	/* Portfolio ------------------------------------------------------------------------------------------------ */
	/* Widgets -------------------------------------------------------------------------------------------------- */
	.widget_ishyoboy-dribbble-widget .dribbble-widget a img,
	.widget_ishyoboy-flickr-widget #flickr_badge_wrapper div,
	.widget_ishyoboy-recent-portfolio-widget .recent-projects-widget li,
	.widget.null-instagram-feed .instagram-pics li
	{
		width: 33.3% !important;
	}

	/* Plugins -------------------------------------------------------------------------------------------------- */
	/* WooCommerce */
	.woocommerce table.shop_table th,
	.woocommerce table.shop_table tr,
	.woocommerce table.shop_table td
	{
		word-wrap: break-word !important;
		padding: 3px !important;
		min-width: 0 !important;
	}

	.woocommerce table.cart td.actions .coupon,
	.woocommerce table.cart td.actions input,
	.woocommerce button,
	.woocommerce input,
	.woocommerce textarea,
	.woocommerce select,
	.woocommerce form .form-row-first,
	.woocommerce form .form-row-last,
	.woocommerce-page form .form-row-first,
	.woocommerce-page form .form-row-last
	{
		width: 100% !important;

	}

	.woocommerce input[type="checkbox"],
	.woocommerce input[type="radio"],
	.woocommerce input[value="Search"],
	.woocommerce #searchsubmit,
	.woocommerce form input[type="submit"]
	{
		width: auto !important;
	}

	.woocommerce table.cart td.actions .input-text
	{
		margin: 0 0 3px 0 !important;
	}

	.woocommerce table.cart td.actions input
	{
		margin: 0 0 6px 0 !important;
	}

	.woocommerce table.cart td.actions .coupon
	{
		padding-bottom: 0 !important;
	}

}

/* 400px **********************************************************************************************************/
@media all and ( max-width: 400px )
{

<?php
// Vars --------------------------------------------------------------------------------------------------------
$padding = 30;
$margin = 30;
?>

	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Layout --------------------------------------------------------------------------------------------------- */
	/* Content -------------------------------------------------------------------------------------------------- */
	/* Shortcodes ----------------------------------------------------------------------------------------------- */
	/* Blog ----------------------------------------------------------------------------------------------------- */
	/* Portfolio ------------------------------------------------------------------------------------------------ */
	/* Widgets -------------------------------------------------------------------------------------------------- */
	/* Plugins -------------------------------------------------------------------------------------------------- */
	/* Woocommerce */

	<?php
		$columns_count = Array( '6', '5', '4', '3', '2' );
		foreach ($columns_count as $column ){
	?>
		.woocommerce .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n),
		.woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n),
		.woocommerce .ish-with-sidebar .ish-product-columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n),
		.ish-with-sidebar .woocommerce.columns-<?php echo '' . $column; ?> ul.products li.product:nth-child(n)
		{
			width: 100%;
			clear: none;
			margin-right: 0;
		}

	<?php
		};
	?>

}


/* 320px **********************************************************************************************************/
@media all and ( max-width: 320px )
{

<?php
// Vars --------------------------------------------------------------------------------------------------------
$padding = 30;
$margin = 30;
?>



	/* Grid ----------------------------------------------------------------------------------------------------- */
	/* Layout --------------------------------------------------------------------------------------------------- */
	/* Content -------------------------------------------------------------------------------------------------- */
	/* Shortcodes ----------------------------------------------------------------------------------------------- */
	/* Gallery */
	.ish-sc_gallery > .ish-row [class^="ish-grid"],
	.ish-sc_gallery > .ish-row [class*=" ish-grid"]
	{
		width: 100% !important;
		/*background-clip: border-box;
		border: transparent;
		margin-bottom: <?php /*echo '' . $margin; */?>px;*/
	}

	/* Blog ----------------------------------------------------------------------------------------------------- */
	/* Portfolio ------------------------------------------------------------------------------------------------ */
	/* Widgets -------------------------------------------------------------------------------------------------- */
	/* Plugins -------------------------------------------------------------------------------------------------- */

}




	/* Portfolio Custom breaking points********************************************************************************/
	<?php
	/*
	 * Array of all breaking points for the amount of items ina row
	 *
	 * $pflo[ items_in_a_row_count ] = Array of breaking points where ($index) = amount of items to be left in a line after the breaking point
	 */
	$pflo = Array();
	$pflo[0] = null;
	$pflo[1] = null;
	$pflo[2] = Array( 1 => 700 );
	$pflo[3] = Array( 2 => 1024, 1 => 600 );
	$pflo[4] = Array( 3 => 1150, 2 => 960, 1 => 610 );
	$pflo[5] = Array( 4 => 1240, 3 => 1016, 2 => 768, 1 => 500 );
	$pflo[6] = Array( 5 => 1240, 4 => 1054, 3 => 868, 2 => 630, 1 => 440 );
	$pflo[7] = Array( 6 => 1240, 5 => 1080, 4 => 920, 3 => 768, 2 => 600, 1 => 390 );
	$pflo[8] = Array( 7 => 1240, 6 => 1110, 5 => 980, 4 => 830, 3 => 625, 2 => 480, 1 => 350 );

	if ( ! empty( $pflo ) ) {

		$pflo_width = 100; // 100% of the container
		$pflo_ffie_fix = 0.00001;

		foreach ( $pflo as $items_per_line => $breaks ){
			if ( ! empty( $breaks ) ){
				foreach ( $breaks as $items_count => $point ){
					if ( isset($point) ){
						$double = ( $items_count > 1 ) ? 2 : 1 ;
						echo '@media all and ( max-width: '.$point.'px ){ .ish-sc_portfolio[data-count="'.$items_per_line.'"] .ish-p-col{ width: ' . ( ( $pflo_width / $items_count ) - $pflo_ffie_fix ) . '% !important;} .ish-p-packery.ish-sc_portfolio[data-count="'.$items_per_line.'"] .ish-p-col-w2{ width: ' . ( ( ( $pflo_width / $items_count ) * $double ) - $pflo_ffie_fix ) . '% !important;}}'."\n";
					}
				}
			}
		}

	}

	?>


	/* Blog masonry custom breaking points ****************************************************************************/
	<?php
	/*
	 * Array of all breaking points for the amount of items ina row
	 *
	 * $blgmas[ items_in_a_row_count ] = Array of breaking points where ($index) = amount of items to be left in a line after the breaking point
	 */
	$blgmas = Array();
	$blgmas[0] = null;
	$blgmas[1] = null;
	$blgmas[2] = Array( 1 => 1200 );
	$blgmas[3] = Array( 2 => 1500, 1 => 1200 );
	/*  $blgmas[4] = Array( 3 => 1150, 2 => 960, 1 => 610 );
	$blgmas[5] = Array( 4 => 1240, 3 => 1016, 2 => 768, 1 => 500 );
	$blgmas[6] = Array( 5 => 1240, 4 => 1054, 3 => 868, 2 => 630, 1 => 440 );
	$blgmas[7] = Array( 6 => 1240, 5 => 1080, 4 => 920, 3 => 768, 2 => 600, 1 => 390 );
	$blgmas[8] = Array( 7 => 1240, 6 => 1110, 5 => 980, 4 => 830, 3 => 625, 2 => 480, 1 => 350 );*/

	if ( ! empty( $blgmas ) ) {

		$blgmas_width = 100; // 100% of the container
		$blgmas_ffie_fix = 0.00001;

		foreach ( $blgmas as $items_per_line => $breaks ){
			if ( ! empty( $breaks ) ){
				foreach ( $breaks as $items_count => $point ){
					if ( isset($point) ){
						$double = ( $items_count > 1 ) ? 2 : 1 ;
						echo '@media all and ( max-width: '.$point.'px ){ .ish-blog-masonry[data-count="'.$items_per_line.'"] .ish-blog-post-masonry{ width: ' . ( ( $blgmas_width / $items_count ) - $blgmas_ffie_fix ) . '% !important;} .ish-blog-masonry[data-count="'.$items_per_line.'"] .ish-bpm-w2{ width: ' . ( ( ( $blgmas_width / $items_count ) * $double ) - $blgmas_ffie_fix ) . '% !important;}}'."\n";
					}
				}
			}
		}

	}

	?>
	@media all and ( max-width: 500px ) {
		[class*="ish-bpm"].ish-blog-post-masonry {
			/*border: 1px solid red !important;*/

			/*&:before {
				padding-top: 200% !important;
			}*/
		}

		.ish-blog-post-masonry:before {
			padding-top: 200%;
		}
	}
	<?php
}