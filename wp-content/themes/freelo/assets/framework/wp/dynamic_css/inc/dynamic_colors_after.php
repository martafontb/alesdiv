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

/* Color1 ----------------------------------------------------------------------------------------------------------- */
input,
textarea,
select,
.ish-blog.ish-blog-fullwidth .wpb_row .ish-blog-post-links a,
.ish-blog.ish-blog-fullwidth .wpb_row .ish-blog-responsive-post-details a,
.ish-blog.ish-blog-masonry h3 a,
.ish-blog.ish-blog-masonry .ish-link-content a,
.ish-blog-fullwidth .ish-blog-post-details > div > div > span,
.ish-comments-headline,
.comment-reply-link:hover,
.comment-edit-link:hover,
.ish-pagination a,
#cancel-comment-reply-link:hover,
.ish-comments-form a,
.ish-comments-form input[type="submit"],
.ish-comments-form button[type="submit"],
.widget select,
.widget_search input[type="text"],
.widget .widget-title .ish-line-border,
.ish-404-search-field input
{
	color: <?php echo '' . $n_colors['ish-color1']['hex']; ?>;
}

/*
.ish-blog .wpb_row blockquote a:hover,
.ish-blog .ish-format-link-url a:hover,
.ish-blog .wpb_row .ish-blog-post-links a:hover,
.ish-blog .wpb_row .ish-blog-responsive-post-details a:hover
{
	color: <?php echo ishfreelotheme_adjust_brightness( $n_colors['ish-color1']['hex'], -25 ); ?>;
}*/

.ish-blog-post-masonry.ish-image-cover .ish-blog-post-media + div:before
{
	background-color: <?php echo '' . $n_colors['ish-color1']['hex']; ?>;
}

.ish-blog .wpb_row .ish-vc_row_inner:after
{
	background-color: <?php echo "rgba(" . $n_colors['ish-color1']['rgb'] . ", 0.1);" ?>;
}

.ish-blog-fullwidth .ish-blog-post-details > div > div > span
{
	background-color: <?php echo "rgba(" . $n_colors['ish-color1']['rgb'] . ", 0.5);" ?>;
}

.ish-sc_recent_posts.ish-rp-fullwidth .ish-post-icon i
{
	background-color: <?php echo '' . $n_colors['ish-color1']['hex']; ?>;
}

.ish-site-preloader-text{
	color: <?php echo '' . $n_colors['ish-color1']['hex']; ?>;
	opacity: 0.7;
}

.ish-site-preloader .ish-loader {
	border-color: <?php echo '' . $n_colors['ish-color1']['hex']; ?>;
}



<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
foreach ( $prefixes as $prefix ) {
	echo '' . $prefix . "{ color: rgba(" . $n_colors['ish-color1']['rgb'] . ", " . $dyn_col_opacity . "); }\n";
}
?>

<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
foreach ( $prefixes as $prefix ) {
	echo '.ish-comments-form ' . $prefix . "{ color: rgba(" . $n_colors['ish-color1']['rgb'] . ", " . '0.5' . "); }\n";
}
?>

/* Color2 ----------------------------------------------------------------------------------------------------------- */

.ish-blog .wpb_row blockquote,
.ish-blog .wpb_row blockquote a,
.ish-blog .ish-format-link-url,
.ish-blog .ish-format-link-url a,
.ish-blog-2columns .ish-blog-post-details,
.ish-blog-2columns .ish-blog-post-details a,
.ish-blog-2columns .ish-blog-post-links,
.ish-blog-2columns .ish-blog-post-links a,
.ish-single_navigation a,
.comment-author-admin .comment-author,
.comment-tools, .comment-author
{
	color: <?php echo '' . $n_colors['ish-color2']['hex']; ?>;
}

.widget select,
	/*.widget_search form div,*/
.ish-sc_separator.ish-separator-text .ish-line:before
{
	background-color: <?php echo '' . $n_colors['ish-color2']['hex']; ?>;
}

.mejs-controls .mejs-time-rail .mejs-time-loaded
{
	background-color: <?php echo '' . $n_colors['ish-color2']['hex']; ?> !important;
}

.ish-part_footer .ish-row.ish-footer-legals > .ish-row_inner > .ish-grid12
{
	border-color: rgba(<?php echo '' . $n_colors['ish-color2']['rgb'] ?>, 0.25) !important;
}


/* Color3 ----------------------------------------------------------------------------------------------------------- */
.ish-p-overlay
{
	color: <?php echo '' . $n_colors['ish-color3']['hex']; ?>;
}

.ish-back_to_top,
.ish-pagination span
{
	color: <?php echo '' . $n_colors['ish-color3']['hex']; ?> !important;
}

.ish-back_to_top
{
	border-color: <?php echo '' . $n_colors['ish-color3']['hex']; ?>;
}

input, textarea, select
{
	/*border-color: */<?php /*echo '' . $n_colors['ish-color3']['hex']; */?>;
}

.ish-recent_posts_post .main-post-image.ish-empty a{
	color: <?php echo ishfreelotheme_adjust_brightness( $n_colors['ish-color3']['hex'], -25 ); ?>;
}



/* Color4 ----------------------------------------------------------------------------------------------------------- */
.ish-search-result-image a span span,
.ish-blog.ish-blog-fullwidth .wpb_row .ish-blog-post-details a,
.ish-blog.ish-blog-fullwidth .wpb_row .ish-blog-post-details span,
.ish-blog-masonry-layout-grid-boxes .ish-blog-post-masonry,
.ish-blog-masonry-layout-grid-boxes .ish-blog-post-masonry a,
.ish-blog.ish-blog-masonry-layout-grid-boxes h3 a,
.ish-comments-form button[type="submit"],
.ish-rp-fullwidth,
.ish-section-filter nav:not(.ish-p-filter) li a:hover,
.ish-section-filter li.current-cat a,
.ish-section-filter li.current-cat a:hover
{
	color: <?php echo '' . $n_colors['ish-color4']['hex']; ?>;
}

.wp-caption p.wp-caption-text,
.fancybox-title-over-wrap {
	background-color: <?php echo '' . $n_colors['ish-color4']['hex']; ?>;
}


/* Color5 ----------------------------------------------------------------------------------------------------------- */

/*.ish-single_navigation a:hover,*/
/*.share_box .ish-sc_icon span span:hover,
.ish-part_footer .ish-sc_icon span span:hover,*/
/*.ish-add-comment-headline,*/
.ish-blog .wpb_row h2 a,
.comment-reply-link, .comment-edit-link,
.ish-pagination span,
.ish-pagination a:hover,
#cancel-comment-reply-link,
.ish-search-result h5 a:hover,
.ish-archive-body a:hover,
.ish-comments-headline,
.ish-related-headline,
.single-post .ish-single_post_categories_and_tags > div a:hover
{
	color: <?php echo '' . $n_colors['ish-color5']['hex']; ?>;
}

.ish-blog .wpb_row h2 a:hover
{
	color: <?php echo ishfreelotheme_adjust_brightness( $n_colors['ish-color5']['hex'], -25 ); ?>;
}

.ish-back_to_top,
.ish-blog-masonry-layout-grid-boxes .ish-blog-post-masonry,
.ish-pagination span,
.ish-comments-form button[type="submit"],
.ish-search-result a:hover span,
.ish-section-filter nav:not(.ish-p-filter) li a:hover,
.ish-section-filter li.current-cat a
{
	background-color: <?php echo '' . $n_colors['ish-color5']['hex']; ?>;
}

.mejs-controls .mejs-time-rail .mejs-time-current
{
	background-color: <?php echo '' . $n_colors['ish-color5']['hex']; ?> !important;
}

.ish-part_header .ish-row_inner:before
{
	/*border-color: <?php echo '' . $n_colors['ish-color5']['hex']; ?>;*/
}

.ish-back_to_top:hover,
.ish-comments-form button[type="submit"]:hover
{
	background: <?php echo ishfreelotheme_adjust_brightness( $n_colors['ish-color5']['hex'], -25 ); ?>;
}

.ish-sc_recent_posts.ish-rp-fullwidth .post
{
	background-color: <?php echo '' . $n_colors['ish-color5']['hex']; ?>;
}

.ish-sc_recent_posts.ish-rp-fullwidth .post:hover {
	background-color: <?php echo ishfreelotheme_adjust_brightness( $n_colors['ish-color5']['hex'], -10 ); ?>;
}

.ish-sc_recent_posts.ish-rp-fullwidth .ish-post-icon i
{
	color: <?php echo '' . $n_colors['ish-color5']['hex']; ?>;
}


/* Color6 ----------------------------------------------------------------------------------------------------------- */
.ish-pagination a:hover
{
	/*background-color: */<?php /*echo '' . $n_colors['ish-color6']['hex']; */?>;
}

.ish-recent_posts_post .main-post-image.ish-empty .ish-main-post-image-content,
.ish-pagination a,
.ish-comments-form input,
.ish-comments-form button,
.ish-comments-form textarea,
.ish-404-search-field input[type="text"]
{
	background-color: <?php echo '' . $n_colors['ish-color6']['hex']; ?>;
}

<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
foreach ( $prefixes as $prefix ) {
	echo '.ish-404-search-field input[type="text"]' . $prefix . "{ color: rgba(" . $n_colors['ish-color1']['rgb'] . ", " . '1' . ") !important; }\n";
};
?>


/* Color7 ----------------------------------------------------------------------------------------------------------- */

.ish-blog-masonry-layout-grid-boxes .ish-blog-post-masonry .ish-overlay
{
	background-color: <?php echo '' . $n_colors['ish-color7']['hex']; ?>;
}

/* Color8 ----------------------------------------------------------------------------------------------------------- */
.mejs-container, .mejs-embed, .mejs-embed body, .mejs-container .mejs-controls{
	/*background: <?php /*echo '' . $n_colors['ish-color8']['hex']; */?> !important;*/
}



/* Extra colors - error, success ------------------------------------------------------------------------------------ */
.wpcf7-validation-errors, .wpcf7-mail-sent-ok, .ish-alert-notice, .wpcf7-mail-sent-ng { color: #fff; }
.wpcf7-validation-errors, .wpcf7-mail-sent-ng { background-color: #fa594a; } /* Error */
.wpcf7-mail-sent-ok { background-color: #9ac54a; }      /* Success */
.ish-alert-notice { background-color: #49a9e8; }      /* Notice */


<?php
// Header colors -------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['header_colors'] ) ) {

	// Bg
	if ( isset( $ish_newdata['header_colors']['bg'] ) && '' != $ish_newdata['header_colors']['bg'] ) {
		?>
.ish-part_header:not(.ish-sticky-scrolling) .ish-row {
	background-color: <?php echo '' . $ish_newdata['header_colors']['bg']; ?>;

<?php if ( isset( $ish_newdata['header_colors_bg_opacity'] ) && '' != $ish_newdata['header_colors_bg_opacity'] ) { ?>
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['header_colors']['bg']); ?>, <?php echo ( (int)$ish_newdata['header_colors_bg_opacity'] / 100 ); ?>);
<?php } ?>
}

.ish-part_header.ish-sticky-scrolling .ish-row {
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['header_colors']['bg']); ?>, 0.8 );
}
<?php
}

// Text
if ( isset( $ish_newdata['header_colors']['text'] ) && '' != $ish_newdata['header_colors']['text'] ) {
?>
.ish-part_header,
.ish-part_header a {
	color: <?php echo '' . $ish_newdata['header_colors']['text']; ?>;
}
<?php
}

// Text active
if ( isset( $ish_newdata['header_colors']['text_active'] ) && '' != $ish_newdata['header_colors']['text_active'] ) {
?>
.ish-part_header a:hover {
	color: <?php echo '' . $ish_newdata['header_colors']['text_active']; ?>;
}
<?php
}
}
?>

<?php
// Header colors - Alternative Style -------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['header_colors_alternative'] ) ) {

	// Bg
	if ( isset( $ish_newdata['header_colors_alternative']['bg'] ) && '' != $ish_newdata['header_colors_alternative']['bg'] ) {
		?>
.ish-alt-style.ish-part_header:not(.ish-sticky-scrolling) .ish-row {
	background-color: <?php echo '' . $ish_newdata['header_colors_alternative']['bg']; ?>;

<?php if ( isset( $ish_newdata['header_colors_alternative_bg_opacity'] ) && '' != $ish_newdata['header_colors_alternative_bg_opacity'] ) { ?>
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['header_colors_alternative']['bg']); ?>, <?php echo ( (int)$ish_newdata['header_colors_alternative_bg_opacity'] / 100 ); ?>);
<?php } ?>
}

.ish-alt-style.ish-part_header.ish-sticky-scrolling .ish-row {
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['header_colors_alternative']['bg']); ?>, 0.8 );
}
<?php
}

// Text
if ( isset( $ish_newdata['header_colors_alternative']['text'] ) && '' != $ish_newdata['header_colors_alternative']['text'] ) {
?>
.ish-alt-style.ish-part_header,
.ish-alt-style.ish-part_header a {
	color: <?php echo '' . $ish_newdata['header_colors_alternative']['text']; ?>;
}
<?php
}

// Text active
if ( isset( $ish_newdata['header_colors_alternative']['text_active'] ) && '' != $ish_newdata['header_colors_alternative']['text_active'] ) {
?>
.ish-alt-style.ish-part_header a:hover {
	color: <?php echo '' . $ish_newdata['header_colors_alternative']['text_active']; ?>;
}
<?php
}
}
?>


<?php
// Main navigation colors - Default Style ------------------------------------------------------------------------------
if ( isset( $ish_newdata['main_nav_colors'] ) ) {

	// BG
	if ( isset( $ish_newdata['main_nav_colors']['bg'] ) && '' != $ish_newdata['main_nav_colors']['bg'] ){
		?>
.ish-ph-main_nav > ul > li > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
	background-color: <?php echo '' . $ish_newdata['main_nav_colors']['bg']; ?>;
}
<?php
}else{
	?>
.ish-ph-main_nav > ul > li > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
	background-color: transparent;
}
<?php
}

// Text
if ( isset( $ish_newdata['main_nav_colors']['text'] ) && '' != $ish_newdata['main_nav_colors']['text'] ){
	?>
.ish-ph-main_nav > ul > li > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
	color: <?php echo '' . $ish_newdata['main_nav_colors']['text']; ?>;
}
<?php
}


// Active bg
if ( isset( $ish_newdata['main_nav_colors']['bg_active'] ) && '' != $ish_newdata['main_nav_colors']['bg_active'] ){
	?>
.ish-ph-main_nav > ul > li > a:hover, .ish-ph-main_nav > ul > li:hover > a,
.ish-ph-main_nav > ul.ish-nt-regular > .current-menu-item > a,
.ish-ph-mn-resp_menu a.ish-active,
.ish-ph-main_nav > ul.ish-nt-regular > .current_page_ancestor > a,
.ish-ph-main_nav > ul.ish-nt-regular > .current_page_item > a,
.ish-ph-main_nav > ul.ish-nt-regular > .current_page_parent > a,
.ish-ph-main_nav > ul > li.ish-op-active > a,
.ish-ph-mn-resp_menu > ul > li.ish-op-active > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item.ish-op-active > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item:hover > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a:hover,
.ish-ph-main_nav > ul.ish-nt-onepage > .current-menu-item > a,
.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_item > a,
.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_parent > a,
.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_ancestor > a
{
	background-color: <?php echo '' . $ish_newdata['main_nav_colors']['bg_active']; ?>;
}
<?php
}

// Active text
if ( isset( $ish_newdata['main_nav_colors']['text_active'] ) && '' != $ish_newdata['main_nav_colors']['text_active'] ){
?>
.ish-ph-main_nav > ul > li > a:hover, .ish-ph-main_nav > ul > li:hover > a,
.ish-ph-main_nav > ul.ish-nt-regular > .current-menu-item > a,
.ish-ph-mn-resp_menu a.ish-active,
.ish-ph-main_nav > ul.ish-nt-regular > .current_page_ancestor > a,
.ish-ph-main_nav > ul.ish-nt-regular > .current_page_item > a,
.ish-ph-main_nav > ul.ish-nt-regular > .current_page_parent > a,
.ish-ph-main_nav > ul > li.ish-op-active > a,
.ish-ph-mn-resp_menu > ul > li.ish-op-active > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item.ish-op-active > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item:hover > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a:hover,
.ish-ph-main_nav > ul.ish-nt-onepage > .current-menu-item > a,
.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_item > a,
.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_parent > a,
.ish-ph-main_nav > ul.ish-nt-onepage > .current_page_ancestor > a
{
	color: <?php echo '' . $ish_newdata['main_nav_colors']['text_active']; ?>;
}
<?php
}
}
?>

<?php
// Main navigation submenu colors - Default Style ----------------------------------------------------------------------
if ( isset( $ish_newdata['main_nav_submenu_colors'] ) ) {

	// BG
	if ( isset( $ish_newdata['main_nav_submenu_colors']['bg'] ) && '' != $ish_newdata['main_nav_submenu_colors']['bg'] ){
		?>
.ish-ph-main_nav > ul > li ul li,
.ish-ph-main_nav .ish-megamenu-inner {
	background-color: <?php echo '' . $ish_newdata['main_nav_submenu_colors']['bg']; ?>;
}
<?php
}

// Text
if ( isset( $ish_newdata['main_nav_submenu_colors']['text'] ) && '' != $ish_newdata['main_nav_submenu_colors']['text'] ){
?>
.ish-ph-main_nav > ul > li > ul li,
.ish-ph-main_nav > ul > li > ul li a,
.ish-ph-main_nav > ul > li > ul li.ish-cart-links:hover > a,
.ish-ph-main_nav .ish-megamenu-inner > ul > li,
.ish-ph-main_nav .ish-megamenu-inner > ul > li a
{
	color: <?php echo '' . $ish_newdata['main_nav_submenu_colors']['text']; ?>;
}

.ish-ph-main_nav .ish-megamenu-inner > ul > li {
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['main_nav_submenu_colors']['text']); ?>, 0.1 ) !important;
}

<?php
}

// Active text
if ( isset( $ish_newdata['main_nav_submenu_colors']['text_active'] ) && '' != $ish_newdata['main_nav_submenu_colors']['text_active'] ){
?>
.ish-ph-main_nav > ul > li > ul li a:hover,
.ish-ph-main_nav > ul > li > ul li:hover > a,
.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_ancestor > a,
.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_item > a,
.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_parent > a,
.ish-ph-main_nav > ul > li > ul li.ish-op-active > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_item > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_parent > a,
.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_ancestor > a,
.ish-ph-main_nav > ul > li > ul li.ish-cart-links:hover > a:hover,
.ish-ph-main_nav .ish-megamenu-inner > ul > li a:hover,
.ish-ph-main_nav .ish-megamenu-inner > ul li.current-menu-item a
{
	color: <?php echo '' . $ish_newdata['main_nav_submenu_colors']['text_active']; ?>;
}
<?php
}

// Active Background
if ( isset( $ish_newdata['main_nav_submenu_colors']['bg_active'] ) && '' != $ish_newdata['main_nav_submenu_colors']['bg_active'] ){
?>
.ish-ph-main_nav > ul > li > ul li:hover,
.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_ancestor,
.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_item,
.ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_parent,
.ish-ph-main_nav > ul > li > ul li.ish-op-active,
.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_item,
.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_parent,
.ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_ancestor {
	background-color: <?php echo '' . $ish_newdata['main_nav_submenu_colors']['bg_active']; ?>;
}
<?php
}
}
?>


<?php
// Main navigation colors - Alternative Style ------------------------------------------------------------------------------
if ( isset( $ish_newdata['main_nav_colors_alternative'] ) ) {

	// BG
	if ( isset( $ish_newdata['main_nav_colors_alternative']['bg'] ) && '' != $ish_newdata['main_nav_colors_alternative']['bg'] ){
		?>
.ish-alt-style .ish-ph-main_nav > ul > li > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
	background-color: <?php echo '' . $ish_newdata['main_nav_colors_alternative']['bg']; ?>;
}
<?php
}else{
	?>
.ish-alt-style .ish-ph-main_nav > ul > li > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
	background-color: transparent;
}
<?php
}

// Text
if ( isset( $ish_newdata['main_nav_colors_alternative']['text'] ) && '' != $ish_newdata['main_nav_colors_alternative']['text'] ){
	?>
.ish-alt-style .ish-ph-main_nav > ul > li > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a
{
	color: <?php echo '' . $ish_newdata['main_nav_colors_alternative']['text']; ?>;
}
<?php
}


// Active bg
if ( isset( $ish_newdata['main_nav_colors_alternative']['bg_active'] ) && '' != $ish_newdata['main_nav_colors_alternative']['bg_active'] ){
	?>
.ish-alt-style .ish-ph-main_nav > ul > li > a:hover,
.ish-alt-style .ish-ph-main_nav > ul > li:hover > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > .current-menu-item > a,
.ish-alt-style .ish-ph-mn-resp_menu a.ish-active,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > .current_page_ancestor > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > .current_page_item > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > .current_page_parent > a,
.ish-alt-style .ish-ph-main_nav > ul > li.ish-op-active > a,
.ish-alt-style .ish-ph-mn-resp_menu > ul > li.ish-op-active > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item.ish-op-active > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item:hover > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a:hover,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > .current-menu-item > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > .current_page_item > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > .current_page_parent > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > .current_page_ancestor > a
{
	background-color: <?php echo '' . $ish_newdata['main_nav_colors_alternative']['bg_active']; ?>;
}
<?php
}

// Active text
if ( isset( $ish_newdata['main_nav_colors_alternative']['text_active'] ) && '' != $ish_newdata['main_nav_colors_alternative']['text_active'] ){
?>
.ish-alt-style .ish-ph-main_nav > ul > li > a:hover,
.ish-alt-style .ish-ph-main_nav > ul > li:hover > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > .current-menu-item > a,
.ish-alt-style .ish-ph-mn-resp_menu a.ish-active,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > .current_page_ancestor > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > .current_page_item > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > .current_page_parent > a,
.ish-alt-style .ish-ph-main_nav > ul > li.ish-op-active > a,
.ish-alt-style .ish-ph-mn-resp_menu > ul > li.ish-op-active > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item.ish-op-active > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item:hover > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a:hover,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > .current-menu-item > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > .current_page_item > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > .current_page_parent > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > .current_page_ancestor > a
{
	color: <?php echo '' . $ish_newdata['main_nav_colors_alternative']['text_active']; ?>;
}
<?php
}
}
?>

<?php
// Main navigation submenu colors - Alternative Style ----------------------------------------------------------------------
if ( isset( $ish_newdata['main_nav_submenu_colors_alternative'] ) ) {

	// BG
	if ( isset( $ish_newdata['main_nav_submenu_colors_alternative']['bg'] ) && '' != $ish_newdata['main_nav_submenu_colors_alternative']['bg'] ){
		?>
.ish-alt-style .ish-ph-main_nav > ul > li ul li,
.ish-alt-style .ish-ph-main_nav .ish-megamenu-inner {
	background-color: <?php echo '' . $ish_newdata['main_nav_submenu_colors_alternative']['bg']; ?>;
}
<?php
}

// Text
if ( isset( $ish_newdata['main_nav_submenu_colors_alternative']['text'] ) && '' != $ish_newdata['main_nav_submenu_colors_alternative']['text'] ){
?>
.ish-alt-style .ish-ph-main_nav > ul > li > ul li,
.ish-alt-style .ish-ph-main_nav > ul > li > ul li a,
.ish-alt-style .ish-ph-main_nav > ul > li > ul li.ish-cart-links:hover > a,
.ish-alt-style .ish-ph-main_nav .ish-megamenu-inner > ul > li,
.ish-alt-style .ish-ph-main_nav .ish-megamenu-inner > ul > li a
{
	color: <?php echo '' . $ish_newdata['main_nav_submenu_colors_alternative']['text']; ?>;
}

.ish-alt-style .ish-ph-main_nav .ish-megamenu-inner > ul > li {
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['main_nav_submenu_colors_alternative']['text']); ?>, 0.1) !important;
}

<?php
}

// Active text
if ( isset( $ish_newdata['main_nav_submenu_colors_alternative']['text_active'] ) && '' != $ish_newdata['main_nav_submenu_colors_alternative']['text_active'] ){
?>
.ish-alt-style .ish-ph-main_nav > ul > li > ul li a:hover,
.ish-alt-style .ish-ph-main_nav > ul > li > ul li:hover > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_ancestor > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_item > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_parent > a,
.ish-alt-style .ish-ph-main_nav > ul > li > ul li.ish-op-active > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_item > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_parent > a,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_ancestor > a,
.ish-alt-style .ish-ph-main_nav > ul > li > ul li.ish-cart-links:hover > a:hover,
.ish-alt-style .ish-ph-main_nav .ish-megamenu-inner > ul > li a:hover,
.ish-alt-style .ish-ph-main_nav .ish-megamenu-inner > ul li.current-menu-item a
{
	color: <?php echo '' . $ish_newdata['main_nav_submenu_colors_alternative']['text_active']; ?>;
}
<?php
}

// Active Background
if ( isset( $ish_newdata['main_nav_submenu_colors_alternative']['bg_active'] ) && '' != $ish_newdata['main_nav_submenu_colors_alternative']['bg_active'] ){
?>
.ish-alt-style .ish-ph-main_nav > ul > li > ul li:hover,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_ancestor,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_item,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-regular > li > ul .current_page_parent,
.ish-alt-style .ish-ph-main_nav > ul > li > ul li.ish-op-active,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_item,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_parent,
.ish-alt-style .ish-ph-main_nav > ul.ish-nt-onepage > li > ul .current_page_ancestor {
	background-color: <?php echo '' . $ish_newdata['main_nav_submenu_colors_alternative']['bg_active']; ?>;
}
<?php
}
}
?>


<?php
// Header Bar colors ---------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['header_bar_colors'] ) ) {

	// Bg
	if ( isset( $ish_newdata['header_bar_colors']['bg'] ) && '' != $ish_newdata['header_bar_colors']['bg'] ) {
		?>
.ish-part_header_bar {
	background-color: <?php echo '' . $ish_newdata['header_bar_colors']['bg']; ?>;

<?php if ( isset( $ish_newdata['header_bar_colors_bg_opacity'] ) && '' != $ish_newdata['header_bar_colors_bg_opacity'] ) { ?>
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['header_bar_colors']['bg']); ?>, <?php echo ( (int)$ish_newdata['header_bar_colors_bg_opacity'] / 100 ); ?>);
<?php } ?>
}
<?php
}

// Text
if ( isset( $ish_newdata['header_bar_colors']['text'] ) && '' != $ish_newdata['header_bar_colors']['text'] ) {
	?>
.ish-part_header_bar, .ish-part_header_bar a {
	color: <?php echo '' . $ish_newdata['header_bar_colors']['text']; ?>;
}

.ish-part_header_bar .ish-top_nav .ish-shopping-cart,
.ish-part_header_bar .ish-top_nav .ish-phb-search,
.ish-part_header_bar .ish-top_nav .ish-phb-lng-selector,
.ish-part_header_bar .ish-top_nav .ish-border {
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['header_bar_colors']['text']); ?>, 0.25);
}
<?php
}

// Text active
if ( isset( $ish_newdata['header_bar_colors']['text_active'] ) && '' != $ish_newdata['header_bar_colors']['text_active'] ) {
	?>
.ish-part_header_bar a:hover {
	color: <?php echo '' . $ish_newdata['header_bar_colors']['text_active']; ?>;
}
<?php
}
}
?>

<?php
// Header Bar navigation colors ----------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['header_bar_colors'] ) ) {

	// BG
	/*
	if ( isset( $ish_newdata['header_bar_nav_colors']['bg'] ) && '' != $ish_newdata['header_bar_nav_colors']['bg'] ){
		?>
		.ish-top_nav_container > ul > li > a,
		.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
		background-color: <?php echo '' . $ish_newdata['header_bar_nav_colors']['bg']; ?>;
		}
	<?php
	}else{
		?>
		.ish-top_nav_container > ul > li > a,
		.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
		background-color: transparent;
		}
	<?php
	}*/

	// Text
	if ( isset( $ish_newdata['header_bar_colors']['text'] ) && '' != $ish_newdata['header_bar_colors']['text'] ){
		?>
.ish-top_nav_container > ul > li,
.ish-top_nav_container > ul > li > a,
.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a {
	color: <?php echo '' . $ish_newdata['header_bar_colors']['text']; ?>;
}

.ish-shopping-cart,
.ish-phb-search,
.ish-ph-lng-selector,
.ish-border {
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['header_bar_colors']['text']); ?>, 0.2);
}
<?php
}


// Active bg
/*
if ( isset( $ish_newdata['header_bar_nav_colors']['bg_active'] ) && '' != $ish_newdata['header_bar_nav_colors']['bg_active'] ){
	?>
	.ish-top_nav_container > ul > li > a:hover, .ish-top_nav_container > ul > li:hover > a,
	.ish-top_nav_container > ul.ish-nt-regular > .current-menu-item > a,
	.ish-ph-mn-resp_menu a.ish-active,
	.ish-top_nav_container > ul.ish-nt-regular > .current_page_ancestor > a,
	.ish-top_nav_container > ul.ish-nt-regular > .current_page_item > a,
	.ish-top_nav_container > ul.ish-nt-regular > .current_page_parent > a,
	.ish-top_nav_container > ul > li.ish-op-active > a,
	.ish-ph-mn-resp_menu > ul > li.ish-op-active > a,
	.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item.ish-op-active > a,
	.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item:hover > a,
	.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a:hover,
	.ish-top_nav_container > ul.ish-nt-onepage > .current-menu-item > a,
	.ish-top_nav_container > ul.ish-nt-onepage > .current_page_item > a,
	.ish-top_nav_container > ul.ish-nt-onepage > .current_page_parent > a,
	.ish-top_nav_container > ul.ish-nt-onepage > .current_page_ancestor > a
	{
		background-color: <?php echo '' . $ish_newdata['header_bar_nav_colors']['bg_active']; ?>;
	}
	<?php
}*/

// Active text
if ( isset( $ish_newdata['header_bar_colors']['text_active'] ) && '' != $ish_newdata['header_bar_colors']['text_active'] ){
	?>
.ish-top_nav_container > ul > li > a:hover, .ish-top_nav_container > ul > li:hover > a,
.ish-top_nav_container > ul.ish-nt-regular > .current-menu-item > a,
.ish-ph-mn-resp_menu a.ish-active,
.ish-top_nav_container > ul.ish-nt-regular > .current_page_ancestor > a,
.ish-top_nav_container > ul.ish-nt-regular > .current_page_item > a,
.ish-top_nav_container > ul.ish-nt-regular > .current_page_parent > a,
.ish-top_nav_container > ul > li.ish-op-active > a,
.ish-ph-mn-resp_menu > ul > li.ish-op-active > a,
.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item.ish-op-active > a,
.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item:hover > a,
.ish-top_nav_container > ul.ish-nt-onepage > li.menu-item-type-custom.current-menu-item > a:hover,
.ish-top_nav_container > ul.ish-nt-onepage > .current-menu-item > a,
.ish-top_nav_container > ul.ish-nt-onepage > .current_page_item > a,
.ish-top_nav_container > ul.ish-nt-onepage > .current_page_parent > a,
.ish-top_nav_container > ul.ish-nt-onepage > .current_page_ancestor > a
{
	color: <?php echo '' . $ish_newdata['header_bar_colors']['text_active']; ?>;
}
<?php
}
}
?>

<?php
// Header Bar navigation submenu colors --------------------------------------------------------------------------------------
if ( isset( $ish_newdata['header_bar_nav_submenu_colors'] ) ) {

	// BG
	if ( isset( $ish_newdata['header_bar_nav_submenu_colors']['bg'] ) && '' != $ish_newdata['header_bar_nav_submenu_colors']['bg'] ){
		?>
.ish-top_nav_container > ul > li ul li,
.ish-top_nav_container .ish-megamenu-inner {
	background-color: <?php echo '' . $ish_newdata['header_bar_nav_submenu_colors']['bg']; ?>;
}
<?php
}

// Text
if ( isset( $ish_newdata['header_bar_nav_submenu_colors']['text'] ) && '' != $ish_newdata['header_bar_nav_submenu_colors']['text'] ){
?>
.ish-top_nav_container > ul > li > ul li a,
.ish-top_nav_container > ul > li > ul li.ish-cart-links:hover > a,
.ish-top_nav_container .ish-megamenu-inner > ul > li,
.ish-top_nav_container .ish-megamenu-inner > ul > li a
{
	color: <?php echo '' . $ish_newdata['header_bar_nav_submenu_colors']['text']; ?>;
}

.ish-top_nav_container .ish-megamenu-inner > ul > li {
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['header_bar_nav_submenu_colors']['text']); ?>, 0.1) !important;
}

<?php
}

// Active text
if ( isset( $ish_newdata['header_bar_nav_submenu_colors']['text_active'] ) && '' != $ish_newdata['header_bar_nav_submenu_colors']['text_active'] ){
?>
.ish-top_nav_container > ul > li > ul li a:hover,
/*.ish-top_nav_container > ul > li > ul li:hover a,*/
.ish-top_nav_container > ul > li > ul .current_page_ancestor > a,
.ish-top_nav_container > ul > li > ul .current_page_item > a,
.ish-top_nav_container > ul > li > ul .current_page_parent > a,
.ish-top_nav_container > ul > li > ul li.ish-op-active > a,
.ish-top_nav_container > ul > li > ul li.ish-cart-links:hover > a:hover,
.ish-top_nav_container .ish-megamenu-inner > ul > li a:hover,
.ish-top_nav_container .ish-megamenu-inner > ul li.current-menu-item a
{
	color: <?php echo '' . $ish_newdata['header_bar_nav_submenu_colors']['text_active']; ?>;
}
<?php
}

// Active Background
/*if ( isset( $ish_newdata['header_bar_nav_submenu_colors']['bg_active'] ) && '' != $ish_newdata['header_bar_nav_submenu_colors']['bg_active'] ){
?>
.ish-top_nav_container > ul > li > ul li:hover,
.ish-top_nav_container > ul.ish-nt-regular > li > ul .current_page_ancestor,
.ish-top_nav_container > ul.ish-nt-regular > li > ul .current_page_item,
.ish-top_nav_container > ul.ish-nt-regular > li > ul .current_page_parent,
.ish-top_nav_container > ul > li > ul li.ish-op-active,
.ish-top_nav_container > ul.ish-nt-onepage > li > ul .current_page_item,
.ish-top_nav_container > ul.ish-nt-onepage > li > ul .current_page_parent,
.ish-top_nav_container > ul.ish-nt-onepage > li > ul .current_page_ancestor {
	background-color: <?php echo '' . $ish_newdata['header_bar_nav_submenu_colors']['bg_active']; ?>;
}
<?php
}*/
}
?>

<?php
// Tagline colors ------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['tagline_colors'] ) ) {

	// Bg
	if ( isset( $ish_newdata['tagline_colors']['bg'] ) && '' != $ish_newdata['tagline_colors']['bg'] ) {
	?>
.ish-part_tagline, .ish-part_tagline:before {
	background-color: <?php echo '' . $ish_newdata['tagline_colors']['bg']; ?>;
}
.ish-part_tagline > .ish-row {
	background-color: transparent;
}
.ish-part_tagline .ish-overlay.ish-default-tagline,
.ish-part_tagline .ish-overlay-box.ish-default .ish-overlay{
	background-color: <?php echo '' . $ish_newdata['tagline_colors']['bg']; ?>;
}
<?php
}

// Overlay the opacity number
$bg_opacity = '';
if ( isset( $ish_newdata['lead_bg_opacity'] ) ) {

$bg_opacity = $ish_newdata['lead_bg_opacity'];

if ( is_numeric( $bg_opacity ) ){
	if ( $bg_opacity > 100 ) { $bg_opacity = 100; }
	else if ( $bg_opacity < 0 ) { $bg_opacity = 0; }
	else if ( $bg_opacity > 0 && $bg_opacity < 1  ) { $bg_opacity = $bg_opacity * 100; }
}
else {
	$bg_opacity = '';
}
}

// Overlay opacity
if ( '' != $bg_opacity ) {
?>
.ish-part_tagline .ish-overlay.ish-default-tagline{
	opacity: <?php echo ( 1 - ( $bg_opacity / 100 ) ); ?>;
}
<?php
}


// Text in general
if ( isset( $ish_newdata['tagline_colors']['headline_1'] ) && '' != $ish_newdata['tagline_colors']['headline_1'] ) {
	?>
	.ish-part_tagline,
	.ish-part_tagline .ish-author-icons a,
	.ish-part_tagline .ish-pt-taglines-additional{
		color: <?php echo '' . $ish_newdata['tagline_colors']['headline_2']; ?>;
	}
<?php
}

// Tagline1
if ( isset( $ish_newdata['tagline_colors']['headline_1'] ) && '' != $ish_newdata['tagline_colors']['headline_1'] ) {
	?>
.ish-part_tagline h1,
.ish-part_tagline a,
.ish-part_tagline .ish-blog-post-details a,
.ish-part_tagline:not([class*="ish-text-color"]) .ish-blog-post-details a,
.ish-part_tagline:not([class*="ish-text-color"]) .ish-blog-post-details a span {
	color: <?php echo '' . $ish_newdata['tagline_colors']['headline_1']; ?>;
}

.ish-part_tagline .ish-blog-post-details:before,
.ish-part_tagline .ish-posts-count:before {
	background-color: <?php echo '' . $ish_newdata['tagline_colors']['headline_1']; ?>;
}

.ish-taglines-filter li a:hover,
.ish-taglines-filter li.current-cat a,
.ish-taglines-filter li.current-cat a:hover,
.ish-taglines-filter .ish-p-filter li a:hover,
.ish-taglines-filter .ish-p-filter li a.ish-active
{
	color: <?php echo '' . $ish_newdata['tagline_colors']['headline_1']; ?>;
}

.ish-taglines-filter li a,
.ish-taglines-filter .ish-p-filter li a
{
	color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['tagline_colors']['headline_1']); ?>, <?php echo '' . $dyn_col_opacity; ?>);
}

.ish-part_tagline:not([class*="ish-text-color"]) a:hover,
.ish-single_navigation a:hover,
.ish-single_post_categories_and_tags a:hover
{
	opacity: <?php echo '' . $dyn_col_opacity; ?>;
}

<?php
}

// Tagline2
if ( isset( $ish_newdata['tagline_colors']['headline_2'] ) && '' != $ish_newdata['tagline_colors']['headline_2'] ) {
?>
.ish-part_tagline h2 {
	color: <?php echo '' . $ish_newdata['tagline_colors']['headline_2']; ?>;
}
<?php
}
}
?>


<?php
// Breadcrumbs colors --------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['breadcrumbs_colors'] ) ) {

	// Bg
	if ( isset( $ish_newdata['breadcrumbs_colors']['bg'] ) && '' != $ish_newdata['breadcrumbs_colors']['bg'] ) {
		?>
.ish-part_breadcrumbs .ish-row,
.ish-part_breadcrumbs:before,
.ish-pb-socials .ish-sc_icon a > span
{
	background-color: <?php echo '' . $ish_newdata['breadcrumbs_colors']['bg']; ?>;
}
<?php
}

// Text
if ( isset( $ish_newdata['breadcrumbs_colors']['text'] ) && '' != $ish_newdata['breadcrumbs_colors']['text'] ) {
?>
.ish-part_breadcrumbs div
{
	color: <?php echo '' . $ish_newdata['breadcrumbs_colors']['text']; ?>;
}

.ish-part_breadcrumbs
{
	border-color: <?php echo '' . $ish_newdata['breadcrumbs_colors']['text']; ?>;
}
<?php
}

// Link
if ( isset( $ish_newdata['breadcrumbs_colors']['link'] ) && '' != $ish_newdata['breadcrumbs_colors']['link'] ) {
?>
.ish-part_breadcrumbs a
{
	color: <?php echo '' . $ish_newdata['breadcrumbs_colors']['link']; ?>;
}
<?php
}

// Link active
if ( isset( $ish_newdata['breadcrumbs_colors']['link_active'] ) && '' != $ish_newdata['breadcrumbs_colors']['link_active'] ) {
?>
.ish-part_breadcrumbs a:hover
{
	color: <?php echo '' . $ish_newdata['breadcrumbs_colors']['link_active']; ?>;
}
<?php
}
}
?>


<?php
// Search colors -------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['search_colors'] ) ) {

	// Bg
	if ( isset( $ish_newdata['search_colors']['bg'] ) && '' != $ish_newdata['search_colors']['bg'] ) {
		?>
.ish-part_searchbar {
	background-color: <?php echo '' . $ish_newdata['search_colors']['bg']; ?>;
}
<?php
}

// Text
if ( isset( $ish_newdata['search_colors']['text'] ) && '' != $ish_newdata['search_colors']['text'] ) {
?>
.ish-part_searchbar input[type="text"], .ish-ps-searchform_close {
	color: <?php echo '' . $ish_newdata['search_colors']['text']; ?>;
}

<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
$placeholders = Array( '.ish-part_searchbar input[type="text"]' );
foreach ( $placeholders as $placeholder ) {
	foreach ( $prefixes as $prefix ) {
		echo '' . $placeholder . $prefix . "{ color: rgba(" . ishfreelotheme_hex2rgb($ish_newdata['search_colors']['text']) . ", " . $dyn_col_opacity . "); }\n";
	}
}
}

// Text active
if ( isset( $ish_newdata['search_colors']['text'] ) && '' != $ish_newdata['search_colors']['text'] ) {
?>
.ish-part_searchbar a:hover {
	color: <?php echo '' . $ish_newdata['search_colors']['text_active']; ?>;
}
<?php
}
}
?>


<?php
// Background ----------------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_bg' ) ) {
	function ish_echo_colors_bg( $ish_which_area )
	{
		echo '' . $ish_which_area . " ";
	}
}
if ( ! function_exists( 'ish_echo_colors_bg_option' ) ) {
	function ish_echo_colors_bg_option( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget option ";
	}
}

// Title ---------------------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_title' ) ) {
	function ish_echo_colors_title( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget-title, "
		. $ish_which_area . " .widget-title .ish-line-border ";
	}
}

// Text ----------------------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_text' ) ) {
	function ish_echo_colors_text( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget ";
	}
}

// Link1 ---------------------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_link1' ) ) {
	function ish_echo_colors_link1( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget a ";
	}
}
// Link1 Active --------------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_link1_active' ) ) {
	function ish_echo_colors_link1_active( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget a:hover, "
			. $ish_which_area . " li.ish-op-active > a, "
			. $ish_which_area . " .ish-nt-regular .current_page_ancestor > a, "
			. $ish_which_area . " .ish-nt-regular .current_page_item > a, "
			. $ish_which_area . " .ish-nt-regular .current_page_parent > a, "
			. $ish_which_area . " .widget .current_page_ancestor > a, "
			. $ish_which_area . " .widget .current_page_item > a, "
			. $ish_which_area . " .widget .current_page_parent > a, "
			. $ish_which_area . " .ish-nt-onepage .current_page_ancestor > a, "
			. $ish_which_area . " .ish-nt-onepage .current_page_item > a, "
			. $ish_which_area . " .ish-nt-onepage .current_page_parent > a, "
			. $ish_which_area . " .current_page_ancestor > a, "
			. $ish_which_area . " .current_page_item > a, "
			. $ish_which_area . " .current_page_parent > a ";
	}
}

// Link2 ---------------------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_link2' ) ) {
	function ish_echo_colors_link2( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget_search input[type='submit']:hover, "
			. $ish_which_area . " .widget_calendar #wp-calendar tfoot a, "
			. $ish_which_area . " .widget_ishyoboy-recent-portfolio-widget a.ish-button-small, "
			. $ish_which_area . " .widget_ishyoboy-dribbble-widget a.ish-button-small, "
			. $ish_which_area . " .widget.null-instagram-feed p.clear a, "
			. $ish_which_area . " .widget_ishyoboy-flickr-widget a.ish-button-small, "
			. $ish_which_area . " .widget_ishyoboy-twitter-widget a.ish-button-small ";
	}
}

// Link2 Active --------------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_link2_active' ) ) {
	function ish_echo_colors_link2_active( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget_calendar #wp-calendar tfoot a:hover, "
			. $ish_which_area . " .widget_ishyoboy-recent-portfolio-widget a.ish-button-small:hover, "
			. $ish_which_area . " .widget_ishyoboy-dribbble-widget a.ish-button-small:hover, "
			. $ish_which_area . " .widget.null-instagram-feed p.clear a:hover, "
			. $ish_which_area . " .widget_ishyoboy-flickr-widget a.ish-button-small:hover, "
			. $ish_which_area . " .widget_ishyoboy-twitter-widget a.ish-button-small:hover ";
	}
}

// Block elements bg ---------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_be_bg' ) ) {
	function ish_echo_colors_be_bg( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget select, "
			. $ish_which_area . " .widget_search input[type='text'], "
			. $ish_which_area . " .widget input[type='email'], "
			. $ish_which_area . " .widget input[type='submit'] ";
	}
}
// Block elements text -------------------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_be_text' ) ) {
	function ish_echo_colors_be_text( $ish_which_area )
	{
		echo '' . $ish_which_area . " .widget select, "
			. $ish_which_area . " .widget option, "
			. $ish_which_area . " .widget_search input[type='text'], "
			. $ish_which_area . " .widget_search input[type='submit'], "
			. $ish_which_area . " .widget input[type='email'], "
			. $ish_which_area . " .widget input[type='submit'] ";
	}
}

// Block elements text placeholders ------------------------------------------------------------------------------------
if ( ! function_exists( 'ish_echo_colors_be_text_placeholder' ) ) {
	function ish_echo_colors_be_text_placeholder( $ish_which_area, $color, $opacity )
	{
		$prefixes = array(':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder');
		$placeholders = Array($ish_which_area . ' .widget_search input[type="text"]');
		foreach ($placeholders as $placeholder) {
			foreach ($prefixes as $prefix) {
				echo '' . $placeholder . $prefix . "{ color: rgba(" . ishfreelotheme_hex2rgb($color) . ", " . $opacity . "); }\n";
			}
		}
	}
}

?>

<?php
// Sidenav colors ------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['sidenav_colors'] ) ) {

	// Background ------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidenav_colors']['bg'] ) && '' != $ish_newdata['sidenav_colors']['bg'] ) {
		ish_echo_colors_bg('.ish-sidenav'); ?> {
	background-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['sidenav_colors']['bg']); ?>, 0.95);
} <?php
		ish_echo_colors_bg_option('.ish-sidenav'); ?> {
	background-color: <?php echo '' . $ish_newdata['sidenav_colors']['bg']; ?>;
} <?php
	}

	// Title -----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidenav_colors']['title'] ) && '' != $ish_newdata['sidenav_colors']['title'] ) {
	    ish_echo_colors_title('.ish-sidenav'); ?> {
	color: <?php echo '' . $ish_newdata['sidenav_colors']['title']; ?>;
} <?php
	}

	// Text ------------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidenav_colors']['text'] ) && '' != $ish_newdata['sidenav_colors']['text'] ) {
		ish_echo_colors_text('.ish-sidenav'); ?>,
.ish-sidenav-close {
	color: <?php echo '' . $ish_newdata['sidenav_colors']['text']; ?>;
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['sidenav_colors']['text']); ?>, 0.15) !important;
} <?php
	}

	// Link 1 ----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidenav_colors']['link1'] ) && '' != $ish_newdata['sidenav_colors']['link1'] ) {
		ish_echo_colors_link1('.ish-sidenav'); ?> {
	color: <?php echo '' . $ish_newdata['sidenav_colors']['link1']; ?>
} <?php
	}
	// Link 1 Active
	if ( isset( $ish_newdata['sidenav_colors']['link1_active'] ) && '' != $ish_newdata['sidenav_colors']['link1_active'] ) {
		ish_echo_colors_link1_active('.ish-sidenav'); ?>,
.ish-sidenav-close:hover {
	color: <?php echo '' . $ish_newdata['sidenav_colors']['link1_active']; ?>;
} <?php
	}

	// Link 2 ----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidenav_colors']['link2'] ) && '' != $ish_newdata['sidenav_colors']['link2'] ) {
	    ish_echo_colors_link2('.ish-sidenav'); ?> {
	color: <?php echo '' . $ish_newdata['sidenav_colors']['link2']; ?>;
} <?php
	}
	// Link 2 hover
	if ( isset( $ish_newdata['sidenav_colors']['link2_active'] ) && '' != $ish_newdata['sidenav_colors']['link2_active'] ) {
		ish_echo_colors_link2_active('.ish-sidenav'); ?> {
	color: <?php echo '' . $ish_newdata['sidenav_colors']['link2_active']; ?>;
} <?php
	}

	// Block el bg -----------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidenav_colors']['block_bg'] ) && '' != $ish_newdata['sidenav_colors']['block_bg'] ) {
		ish_echo_colors_be_bg('.ish-sidenav'); ?> {
	background: <?php echo '' . $ish_newdata['sidenav_colors']['block_bg']; ?> !important;
} <?php
	}

	// Block el text ---------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidenav_colors']['block_text'] ) && '' != $ish_newdata['sidenav_colors']['block_text'] ) {
		ish_echo_colors_be_text('.ish-sidenav'); ?> {
	color: <?php echo '' . $ish_newdata['sidenav_colors']['block_text']; ?>;
} <?php
		ish_echo_colors_be_text_placeholder('.ish-sidenav', $ish_newdata['sidenav_colors']['block_text'], $dyn_col_opacity);
	}
}
?>


<?php
// Responsive navigation colors ----------------------------------------------------------------------------------------
if ( isset( $ish_newdata['respnav_colors'] ) ) {

	// Bg
	if ( isset( $ish_newdata['respnav_colors']['bg'] ) && '' != $ish_newdata['respnav_colors']['bg'] ) {
		?>
.ish-ph-mn-be_resp {
	background-color: <?php echo '' . $ish_newdata['respnav_colors']['bg']; ?>;
}
<?php
}

// Link
if ( isset( $ish_newdata['respnav_colors']['link'] ) && '' != $ish_newdata['respnav_colors']['link'] ) {
?>
.ish-ph-mn-be_resp a, .ish-ph-mn-be_resp span, .ish-ph-mn-be_resp .ish-menu-item-description  {
	color: <?php echo '' . $ish_newdata['respnav_colors']['link']; ?>;
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['respnav_colors']['link']) . ", " . 0.1; ?>) !important;
}
<?php
}

// Link active
if ( isset( $ish_newdata['respnav_colors']['link_active'] ) && '' != $ish_newdata['respnav_colors']['link_active'] ) {
?>
.ish-ph-mn-be_resp a:hover,
.ish-ph-mn-be_resp a.ish-active,
.ish-ph-mn-be_resp .current_page_ancestor > a,
.ish-ph-mn-be_resp .current_page_item > a,
.ish-ph-mn-be_resp .current_page_parent > a,
.ish-ph-mn-be_resp .ish-op-active > a
{
	color: <?php echo '' . $ish_newdata['respnav_colors']['link_active']; ?>;
}
<?php
}
}
?>


<?php
// Responsive navigation colors ----------------------------------------------------------------------------------------
if ( isset( $ish_newdata['respnav_colors'] ) ) {

	// Bg
	if ( isset( $ish_newdata['respnav_colors']['bg'] ) && '' != $ish_newdata['respnav_colors']['bg'] ) {
		?>
.ish-phb-be_resp {
	background-color: <?php echo '' . $ish_newdata['respnav_colors']['bg']; ?>;
}
<?php
}

// Link
if ( isset( $ish_newdata['respnav_colors']['link'] ) && '' != $ish_newdata['respnav_colors']['link'] ) {
	?>
.ish-phb-be_resp a, .ish-phb-be_resp span, .ish-phb-be_resp .ish-menu-item-description  {
	color: <?php echo '' . $ish_newdata['respnav_colors']['link']; ?>;
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['respnav_colors']['link']) . ", " . 0.1; ?>) !important;
}
<?php
}

// Link active
if ( isset( $ish_newdata['respnav_colors']['link_active'] ) && '' != $ish_newdata['respnav_colors']['link_active'] ) {
	?>
.ish-phb-be_resp a:hover,
.ish-phb-be_resp a.ish-active,
.ish-phb-be_resp .current_page_ancestor > a,
.ish-phb-be_resp .current_page_item > a,
.ish-phb-be_resp .current_page_parent > a,
.ish-phb-be_resp .ish-op-active > a
{
	color: <?php echo '' . $ish_newdata['respnav_colors']['link_active']; ?>;
}
<?php
}
}
?>


<?php
// Expandable area colors ----------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['exparea_colors'] ) || isset( $ish_newdata['exparea_block_colors'] ) ) {

	// Background ------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['exparea_colors']['bg'] ) && '' != $ish_newdata['exparea_colors']['bg'] ) {
		ish_echo_colors_bg('.ish-part_expandable, ');
		ish_echo_colors_bg_option('.ish-part_expandable'); ?> {
	background-color: <?php echo '' . $ish_newdata['exparea_colors']['bg']; ?> !important;
} <?php
	}

	// Title -----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['exparea_colors']['title'] ) && '' != $ish_newdata['exparea_colors']['title'] ) {
	    ish_echo_colors_title('.ish-part_expandable'); ?> {
	color: <?php echo '' . $ish_newdata['exparea_colors']['title']; ?>;
} <?php
	}

	// Text ------------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['exparea_colors']['text'] ) && '' != $ish_newdata['exparea_colors']['text'] ) {
		ish_echo_colors_text('.ish-part_expandable'); ?>,
.ish-pe-close {
	color: <?php echo '' . $ish_newdata['exparea_colors']['text']; ?>;
} <?php
	}

	// Link 1 ----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['exparea_colors']['link1'] ) && '' != $ish_newdata['exparea_colors']['link1'] ) {
		ish_echo_colors_link1('.ish-part_expandable'); ?> {
	color: <?php echo '' . $ish_newdata['exparea_colors']['link1']; ?>;
} <?php
	}
	// Link 1 hover
	if ( isset( $ish_newdata['exparea_colors']['link1_active'] ) && '' != $ish_newdata['exparea_colors']['link1_active'] ) {
		ish_echo_colors_link1_active('.ish-part_expandable'); ?>,
		.ish-pe-close:hover {
			color: <?php echo '' . $ish_newdata['exparea_colors']['link1_active']; ?>;
		} <?php
	}

	// Link 2 ----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['exparea_colors']['link2'] ) && '' != $ish_newdata['exparea_colors']['link2'] ) {
		ish_echo_colors_link2('.ish-part_expandable'); ?> {
	color: <?php echo '' . $ish_newdata['exparea_colors']['link2']; ?>;
} <?php
	}
	// Link 2
	if ( isset( $ish_newdata['exparea_colors']['link2_active'] ) && '' != $ish_newdata['exparea_colors']['link2_active'] ) {
		ish_echo_colors_link2_active('.ish-part_expandable'); ?> {
			color: <?php echo '' . $ish_newdata['exparea_colors']['link2_active']; ?>;
		} <?php
	}

	// Block el bg -----------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['exparea_colors']['block_bg'] ) && '' != $ish_newdata['exparea_colors']['block_bg'] ) {
		ish_echo_colors_be_bg('.ish-part_expandable'); ?> {
	background-color: <?php echo '' . $ish_newdata['exparea_colors']['block_bg']; ?> !important;
} <?php
	}

	// Block el text ---------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['exparea_colors']['block_text'] ) && '' != $ish_newdata['exparea_colors']['block_text'] ) {
		ish_echo_colors_be_text('.ish-part_expandable'); ?> {
	color: <?php echo '' . $ish_newdata['exparea_colors']['block_text']; ?>;
} <?php
		ish_echo_colors_be_text_placeholder('.ish-part_expandable', $ish_newdata['exparea_colors']['block_text'], $dyn_col_opacity);
	}
}
?>


<?php
// Sidebar colors ------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['sidebar_colors'] ) || isset( $ish_newdata['sidebar_block_colors'] ) ) {

	// Title -----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidebar_colors']['title'] ) && '' != $ish_newdata['sidebar_colors']['title'] ) {
		ish_echo_colors_title('.ish-main-sidebar'); ?> {
	color: <?php echo '' . $ish_newdata['sidebar_colors']['title']; ?> !important;
} <?php
	}

	// Text ------------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidebar_colors']['text'] ) && '' != $ish_newdata['sidebar_colors']['text'] ) {
		ish_echo_colors_text('.ish-main-sidebar'); ?>,
.ish-main-sidebar:before,
.ish-main-sidebar > .ish-row:first-child:before{
	color: <?php echo '' . $ish_newdata['sidebar_colors']['text']; ?>;
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['sidebar_colors']['text']) . ", " . 0.2; ?>) !important;
} <?php
	}

	// Link 1 ----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidebar_colors']['link1'] ) && '' != $ish_newdata['sidebar_colors']['link1'] ) {
		ish_echo_colors_link1('.ish-main-sidebar'); ?> {
	color: <?php echo '' . $ish_newdata['sidebar_colors']['link1']; ?>;
} <?php
	}
	// Link 1 Active
	if ( isset( $ish_newdata['sidebar_colors']['link1_active'] ) && '' != $ish_newdata['sidebar_colors']['link1_active'] ) {
		 ish_echo_colors_link1_active('.ish-main-sidebar'); ?> {
	color: <?php echo '' . $ish_newdata['sidebar_colors']['link1_active']; ?>;
} <?php
	}

	// Link 2 ----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidebar_colors']['link2'] ) && '' != $ish_newdata['sidebar_colors']['link2'] ) {
		ish_echo_colors_link2('.ish-main-sidebar'); ?> {
	color: <?php echo '' . $ish_newdata['sidebar_colors']['link2']; ?>;
} <?php
	}
	// Link 2 hover
	if ( isset( $ish_newdata['sidebar_colors']['link2_active'] ) && '' != $ish_newdata['sidebar_colors']['link2_active'] ) {
		ish_echo_colors_link2_active('.ish-main-sidebar'); ?> {
	color: <?php echo '' . $ish_newdata['sidebar_colors']['link2_active']; ?> !important;
} <?php
	}

	// Block el bg -----------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidebar_colors']['block_bg'] ) && '' != $ish_newdata['sidebar_colors']['block_bg'] ) {
		ish_echo_colors_be_bg('.ish-main-sidebar'); ?> {
	background: <?php echo '' . $ish_newdata['sidebar_colors']['block_bg']; ?> !important;
} <?php
	}

	// Block el text ---------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['sidebar_colors']['block_text'] ) && '' != $ish_newdata['sidebar_colors']['block_text'] ) {
		ish_echo_colors_be_text('.ish-main-sidebar'); ?> {
	color: <?php echo '' . $ish_newdata['sidebar_colors']['block_text']; ?>;
} <?php
		ish_echo_colors_be_text_placeholder('.ish-main-sidebar', $ish_newdata['sidebar_colors']['block_text'], $dyn_col_opacity);
	}
}
?>


<?php
// Footer colors -------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['footer_colors'] ) || isset( $ish_newdata['footer_block_colors'] ) ) {

	// Bg --------------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['footer_colors']['bg'] ) && '' != $ish_newdata['footer_colors']['bg'] ) {
		ish_echo_colors_bg('.ish-part_footer, ');
		ish_echo_colors_bg_option('.ish-part_footer'); ?> {
	background-color: <?php echo '' . $ish_newdata['footer_colors']['bg']; ?>;
} <?php
	}

	// Title -----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['footer_colors']['title'] ) && '' != $ish_newdata['footer_colors']['title'] ) {
		ish_echo_colors_title('.ish-part_footer'); ?> {
	color: <?php echo '' . $ish_newdata['footer_colors']['title']; ?> !important;
} <?php
	}

	// Text ------------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['footer_colors']['text'] ) && '' != $ish_newdata['footer_colors']['text'] ) {
		ish_echo_colors_text('.ish-part_footer'); ?> {
	color: <?php echo '' . $ish_newdata['footer_colors']['text']; ?>;
	border-color: rgba(<?php echo ishfreelotheme_hex2rgb($ish_newdata['footer_colors']['text']) . ", " . 0.35; ?>) !important;
} <?php
	}

	// Link 1 ----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['footer_colors']['link1'] ) && '' != $ish_newdata['footer_colors']['link1'] ) {
		ish_echo_colors_link1('.ish-part_footer'); ?> {
	color: <?php echo '' . $ish_newdata['footer_colors']['link1']; ?>
} <?php
	}
	// Link 1 Active
	if ( isset( $ish_newdata['footer_colors']['link1_active'] ) && '' != $ish_newdata['footer_colors']['link1_active'] ) {
		ish_echo_colors_link1_active('.ish-part_footer'); ?> {
	color: <?php echo '' . $ish_newdata['footer_colors']['link1_active']; ?>;
} <?php
	}

	// Link 2 ----------------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['footer_colors']['link2'] ) && '' != $ish_newdata['footer_colors']['link2'] ) {
		ish_echo_colors_link2('.ish-part_footer'); ?> {
	color: <?php echo '' . $ish_newdata['footer_colors']['link2']; ?>;
} <?php
	}
	// Link 2 hover
	if ( isset( $ish_newdata['footer_colors']['link2_active'] ) && '' != $ish_newdata['footer_colors']['link2_active'] ) {
		ish_echo_colors_link2_active('.ish-part_footer'); ?> {
	color: <?php echo '' . $ish_newdata['footer_colors']['link2_active']; ?>;
} <?php
	}

	// Block el bg -----------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['footer_colors']['block_bg'] ) && '' != $ish_newdata['footer_colors']['block_bg'] ) {
		ish_echo_colors_be_bg('.ish-part_footer'); ?> {
	background-color: <?php echo '' . $ish_newdata['footer_colors']['block_bg']; ?> !important;
} <?php
	}

	// Block el text ---------------------------------------------------------------------------------------------------
	if ( isset( $ish_newdata['footer_colors']['block_text'] ) && '' != $ish_newdata['footer_colors']['block_text'] ) {
		ish_echo_colors_be_text('.ish-part_footer'); ?> {
	color: <?php echo '' . $ish_newdata['footer_colors']['block_text']; ?>;
} <?php
		ish_echo_colors_be_text_placeholder('.ish-part_footer', $ish_newdata['footer_colors']['block_text'], $dyn_col_opacity);
	}
}
?>


<?php
// Footer legals colors ------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['footer_legals_colors'] ) ) {

	// Bg
	if ( isset( $ish_newdata['footer_legals_colors']['bg'] ) && '' != $ish_newdata['footer_legals_colors']['bg'] ) {
		?>
.ish-part_legals .ish-row
{
	background-color: <?php echo '' . $ish_newdata['footer_legals_colors']['bg']; ?>;
}
<?php
}

// Text
if ( isset( $ish_newdata['footer_legals_colors']['text'] ) && '' != $ish_newdata['footer_legals_colors']['text'] ) {
?>
.ish-part_legals
{
	color: <?php echo '' . $ish_newdata['footer_legals_colors']['text']; ?>;
}
<?php
}

// Link
if ( isset( $ish_newdata['footer_legals_colors']['link'] ) && '' != $ish_newdata['footer_legals_colors']['link'] ) {
?>
.ish-part_legals a
{
	color: <?php echo '' . $ish_newdata['footer_legals_colors']['link']; ?>;
}
<?php
}

// Link active
if ( isset( $ish_newdata['footer_legals_colors']['link'] ) && '' != $ish_newdata['footer_legals_colors']['link'] ) {
?>
.ish-part_legals a:hover
{
	color: <?php echo ishfreelotheme_adjust_brightness( $ish_newdata['footer_legals_colors']['link'], -25 ); ?>;
}
<?php
}
}

