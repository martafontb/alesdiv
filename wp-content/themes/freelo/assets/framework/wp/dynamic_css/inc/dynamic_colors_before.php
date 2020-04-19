<?php

$n_colors = Array();

for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ) {
	if ( isset( $ish_newdata['color' . $i] ) && '' != $ish_newdata['color' . $i] ) {
		$n_colors['ish-color' . $i]['hex'] = $ish_newdata['color' . $i];
		$n_colors['ish-color' . $i]['rgb'] = ishfreelotheme_hex2rgb( $ish_newdata['color' . $i] );
	} else {
		$n_colors['ish-color' . $i]['hex'] = ( defined( 'ISHFREELOTHEME_COLOR_' . $i ) ) ? constant( 'ISHFREELOTHEME_COLOR_' . $i ) : '#FFFFFF';
		$n_colors['ish-color' . $i]['rgb'] = ( defined( 'ISHFREELOTHEME_COLOR_' . $i ) ) ? ishfreelotheme_hex2rgb( constant( 'ISHFREELOTHEME_COLOR_' . $i ) ) : ishfreelotheme_hex2rgb( '#FFFFFF' );
	};
}

$c_text = ( isset( $ish_newdata['text_color'] ) && '' != $ish_newdata['text_color'] ) ? $ish_newdata['text_color'] : ISHFREELOTHEME_TEXT_COLOR;
$c_body = ( isset( $ish_newdata['body_color'] ) && '' != $ish_newdata['body_color'] ) ? $ish_newdata['body_color'] : ISHFREELOTHEME_BODY_COLOR;
$c_background = ( isset( $ish_newdata['background_color'] ) && '' != $ish_newdata['background_color'] ) ? $ish_newdata['background_color'] : ISHFREELOTHEME_BACKGROUND_COLOR;

$c_body_rgb = ishfreelotheme_hex2rgb($c_body);
$c_text_rgb = ishfreelotheme_hex2rgb($c_text);

$dyn_col_opacity = 0.6;

?>


/* Body text -------------------------------------------------------------------------------------------------------- */
body,
.ish-blog-post-details a, .ish-blog-post-links a,
.ish-blog.ish-blog-classic .ish-blog-responsive-post-details a,
.ish-blog.ish-blog-classic .ish-post-content p a,
.ish-blog.ish-blog-classic .ish-blog-responsive-post-details span,

.ish-section-filter li a,
.ish-section-filter .ish-p-filter li a,

.ish-section-filter li a:hover,
.ish-section-filter li.current-cat a,
.ish-section-filter li.current-cat a:hover,
.ish-section-filter .ish-p-filter li a:hover,
.ish-section-filter .ish-p-filter li a.ish-active,

.ish-part_content .ish-sc-element a,
.ish-part_content .wpb_text_column a,
.ish-part_content .ish-sc_icon_text a,
.comment-awaiting-moderation,
.ish-blog.ish-blog-classic .wpb_row .ish-blog-post-details span,
.ish-comments p a, .ish-comments table a, .ish-comments dl a,
.ish-archive-body a,
.ish-sc_separator,
.wp-caption p.wp-caption-text,
.fancybox-title-over-wrap
{
	color: <?php echo '' . $c_text ?>;
}

.ish-sc_headline.ish-no-underline:not([class*=\"ish-color\"]) a:hover
{
	color: <?php echo ishfreelotheme_adjust_brightness( $c_text, -25 );  ?>;
}



.ish-blog.ish-blog-classic .wpb_row .ish-blog-post-details a,
.ish-blog.ish-blog-classic .wpb_row .ish-blog-post-details a span,
.ish-blog.ish-blog-classic .wpb_row .ish-blog-post-links a
{
	color: rgba(<?php echo ishfreelotheme_hex2rgb($c_text) . ", " . '0.65' ?>);
}

.ish-blog.ish-blog-classic .wpb_row .ish-blog-post-details a:hover,
.ish-blog.ish-blog-classic .wpb_row .ish-blog-post-details a:hover span,
.ish-blog.ish-blog-classic .wpb_row .ish-blog-post-links a:hover,
.comment-tools,
.ish-single_post_categories_and_tags a
{
	color: <?php echo '' . $c_text ?>;
}

.woocommerce .product-type-grouped table.group_table td.price del .amount,
.woocommerce .product-type-grouped table.group_table td.price p
{
	color: <?php echo '' . $c_text ?> !important;
}


.comment-author
{
	color: <?php echo ishfreelotheme_adjust_brightness( $c_text, -55 ) ?>;
}




.single-post .ish-blog-post-links,
.single-post .ish-blog-post-links a,
.single-post .ish-blog-post-links span,
.ish-blog-prevnext-container .ish-sc_separator.ish-separator-text {
	color:  rgba(<?php echo ishfreelotheme_hex2rgb($c_text) . ", " . '0.5' ?>);
}

.single-post .ish-blog-post-links a:hover,
.ish-blog-post-details a:hover
{
color:  rgba(<?php echo ishfreelotheme_hex2rgb($c_text) . ", " . '0.4' ?>);
}

.ish-blog.ish-blog-classic .wpb_row .ish-blog-responsive-post-details a:hover
{
	color:  rgba(<?php echo ishfreelotheme_hex2rgb($c_text) . ", " . '0.6' ?>);
}

/*.ish-section-filter li a,
.ish-section-filter .ish-p-filter li a
{
	color: rgba(<?php /*echo ishfreelotheme_hex2rgb($c_text) . ", " . $dyn_col_opacity */?>);
}*/

.ish-blog-classic .ish-post-content:after,
.ish-blog-2columns .ish-post-content:after,
.ish-comments-form input[type="submit"]:after,
.ish-comments-form button[type="submit"]:after{
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb( $c_text ); ?>, 0.2 );
}

.ish-comments-form input[type="submit"]:hover:after,
.ish-comments-form button[type="submit"]:hover:after{
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb( $c_text ); ?>, 0.50 );
}

.ish-blog-classic .post.sticky .ish-post-content
{
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb($c_text); ?>, 0.07);
}

.ish-comments li.comment,
.ish-comments li.comment div,
.ish-comments + .ish-pagination
{
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($c_text); ?>, 0.2) !important;
}


/* Body background -------------------------------------------------------------------------------------------------- */
body
{
	background-color: <?php echo '' . $c_background ?>;
	/*color: */<?php /*echo '' . $c_text */?>;
}


/* Body background color -------------------------------------------------------------------------------------------- */
[class^="ish-part_"] > .ish-row, [class*=" ish-part_"] > .ish-row,
[class^="ish-part_"] > .wpb_row, [class*=" ish-part_"] > .wpb_row,
.ish-blog-classic > .wpb_row[class*="ish-color"]
{
	background-color: <?php echo '' . $c_body ?>;
}

.ish-row_section .ish-row-decor-top polyline.ish-color,
.ish-row_section .ish-row-decor-bottom polyline.ish-color,
.ish-row_section .ish-row-decor-top path.ish-color,
.ish-row_section .ish-row-decor-bottom path.ish-color,
.ish-row_section .ish-row-decor-top polygon.ish-color,
.ish-row_section .ish-row-decor-bottom polygon.ish-color,
.ish-row_section .ish-row-decor-top rect.ish-color,
.ish-row_section .ish-row-decor-bottom rect.ish-color
{
	fill: <?php echo '' . $c_body ?>;
}

