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


$start_color = $ISHFREELOTHEME_DYNAMIC_CSS_COLORS_START;
$end_color = $ISHFREELOTHEME_DYNAMIC_CSS_COLORS_START + ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT - 1;
$end_color = ( $end_color > ISHFREELOTHEME_COLORS_COUNT ) ? ISHFREELOTHEME_COLORS_COUNT  : $end_color ;

?>

/* color<?php echo '' . $start_color; ?> - color<?php echo '' . $end_color; ?> ---------------------------------------------------------------------------------------- */
<?php
for ( $i = $start_color; $i <= $end_color; $i++ ) {

	// Current color name E.g.: "ish-color1" ---------------------------------------------------------------------------
	$cc = 'ish-color' . $i;
	$tc = 'ish-text-color' . $i;
	$ttc = 'ish-title-color' . $i;
	$ic = 'ish-icon-color' . $i;
	$sc = 'ish-skill-color' . $i;
	$nc = 'ish-nav-color' . $i;
	$pnc = 'ish-prevnext-color' . $i;

	$lc1 = 'ish-link1-color' . $i;
	$lc1a = 'ish-link1-active-color' . $i;
	$lc2 = 'ish-link2-color' . $i;
	$lc2a = 'ish-link2-active-color' . $i;
	$bbgc = 'ish-block-bg-color' . $i;
	$btc = 'ish-block-text-color' . $i;
	$bg_cc = 'ish-bg-text-color' . $i;
	$tt_bg = 'ish-tooltip-color' . $i;
	$tt_tc = 'ish-tooltip-text-color' . $i;

	$btn_cc = 'ish-button-bg-color' . $i;
	$btn_tc = 'ish-button-text-color' . $i;

	$hbg = 'ish-header-bg-color' . $i;
	$htc = 'ish-header-text-color' . $i;

	$borderc = 'ish-border-color' . $i;

	$active_bg_c = 'ish-active-color' . $i;
	$active_text_c = 'ish-active-text-color' . $i;

	$pcbg = 'ish-pc-color' . $i;


	// color* ----------------------------------------------------------------------------------------------------------
	echo "
	.wpb_row.$tc,
	.wpb_row.$tc a,
	.ish-sc-element.$tc a, .wpb_text_column.$tc a,
	.ish-sc_headline.$cc,
	.ish-sc_headline.$cc a,
	.ish-part_content.$pcbg .ish-sc_headline:not([class*=\"ish-color\"]),
	.wpb_row .ish-sc-element.$tc .ish-sc_headline:not([class*=\"ish-color\"]) a,
	.ish-sc_separator.ish-separator-text.$tc,
	.ish-sc_separator.ish-separator-text.$tc a,
	.ish-sc_list.$cc li:before,
	.ish-sc_list.$cc.ish-noicon li:before,
	.ish-sc_list.$tc,
	.ish-sc_quote.$cc,
	.ish-sc_quote.$cc a,
	.ish-p-overlay.$tc,
	.ish-blog .wpb_row .$cc h2 a,
	.ish-blog .wpb_row.$cc h2 a,
	.ish-blog .wpb_row.$cc h3,
	.ish-blog .wpb_row.$cc h3 a,
	.ish-blog .wpb_row.$cc blockquote a,
	.ish-blog .wpb_row.$cc cite,
	.ish-blog .wpb_row.$cc cite a,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc h2 a,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc h3,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc h3 a,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc blockquote a,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc cite,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc cite a,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc .ish-blog-post-links a,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc .ish-blog-responsive-post-details span,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc .ish-blog-responsive-post-details a,
	.ish-blog.ish-blog-masonry .$tc,
	.ish-blog.ish-blog-masonry .$tc a,
	.ish-blog.ish-blog-masonry .$tc cite:before,
	.ish-blog.ish-blog-masonry .$tc .ish-blog-post-details a,
	.ish-blog.ish-blog-masonry .$tc .ish-blog-post-details a:hover,
	.ish-blog.ish-blog-masonry .$tc .ish-blog-post-details span,
	.ish-blog.ish-blog-masonry .$tc .ish-link-content a,
	.ish-blog.ish-blog-2columns .ish-post-media.$tc .ish-blog-quote-content,
	.ish-blog.ish-blog-2columns .ish-post-media.$tc .ish-format-link-url,
	.ish-blog.ish-blog-2columns .ish-post-media.$tc a,
	.ish-tagline-image.$tc h1,
	.ish-tagline-image.$tc h1 a,
	.ish-tagline-image.$tc h2,
	.ish-tagline-image.$tc h2 a,
	.ish-tagline-image.$tc .ish-pt-taglines-additional,
	.ish-tagline-image.$tc .ish-blog-post-details a,
	.ish-tagline-image.$tc .ish-blog-post-details a span,
	.ish-tagline-colored.$tc h1,
	.ish-tagline-colored.$tc h1 a,
	.ish-tagline-colored[class*=\"ish-color\"].$tc h2,
	.ish-tagline-colored[class*=\"ish-color\"].$tc h2 a,
	.ish-tagline-colored[class*=\"ish-color\"].$tc .ish-pt-taglines-additional,
	.ish-tagline-colored.$tc .ish-blog-post-details a,
	.ish-tagline-colored.$tc .ish-blog-post-details a span,
	.$tc .ish-section-filter li a:hover,
	.$tc .ish-section-filter li a.ish-active,
	.$tc .ish-section-filter li.current-cat a:hover,
	.$tc .ish-section-filter + .ish-sc_separator,

	.ish-section-filter.$tc .ish-p-filter li a:hover,
	.ish-section-filter.$tc .ish-p-filter li a.ish-active,
	.ish-section-filter.$tc .ish-p-filter li.current-cat a:hover,

	.ish-recent_posts_post.$cc .ish-post-title a,
	.ish-sc-element.ish-sc_icon.$tc,
	.ish-sc-element.ish-sc_icon.$tc a, .ish-sc-element.ish-sc_icon.$tc a:hover,
	.ish-sc_skills .ish-sc_skill.$tc .ish-bar-bg .ish-bar,
	.ish-sc_skills .ish-sc_skill.$tc.ish-outside > span,
	.ish-gmap_box.$tc, .ish-gmap_box.$tc a, .ish-gmap_box.$tc a:hover,
	div.ish-recent_posts_post.$tc, div.ish-recent_posts_post.$tc a, div.ish-recent_posts_post.$cc .ish-post-title a,
	.ish-sc-element.$pnc .owl-buttons div span,
	.ish-tgg-acc-title.$tc, .ish-tgg-acc-content.$tc,
	.ish-sc_tab.$tc, .ish-tabs-navigation li.$tc a,

	.ish-sc_sidebar.$tc .widget,
	.ish-sc_sidebar.$ttc .widget-title,

	.ish-sc_sidebar.$lc1 .widget a,
	.ish-sc_sidebar.$lc1a .widget a:hover,

	.ish-sc_sidebar.$lc2 .widget_calendar #wp-calendar tfoot a,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-recent-portfolio-widget a.ish-button-small,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-dribbble-widget a.ish-button-small,
	.ish-sc_sidebar.$lc2 .widget.null-instagram-feed p.clear a,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-flickr-widget a.ish-button-small,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-twitter-widget a.ish-button-small,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-recent-portfolio-widget .ish-text-items li:before,
	.ish-sc_sidebar.$lc2 .widget_ishyoboy-main-navigation-widget li:before,
	.ish-sc_sidebar.$lc2 .widget_archive li:before,
	.ish-sc_sidebar.$lc2 .widget_categories li:before,
	.ish-sc_sidebar.$lc2 .widget_meta li:before,
	.ish-sc_sidebar.$lc2 .widget_pages li:before,
	.ish-sc_sidebar.$lc2 .widget_recent_comments li:before,
	.ish-sc_sidebar.$lc2 .widget_recent_entries li:before,

	.ish-sc_sidebar.$lc2a .widget_calendar #wp-calendar tfoot a:hover,
	.ish-sc_sidebar.$lc2a .widget_ishyoboy-recent-portfolio-widget a.ish-button-small:hover,
	.ish-sc_sidebar.$lc2a .widget_ishyoboy-dribbble-widget a.ish-button-small:hover,
	.ish-sc_sidebar.$lc2a .widget.null-instagram-feed p.clear a:hover,
	.ish-sc_sidebar.$lc2a .widget_ishyoboy-flickr-widget a.ish-button-small:hover,
	.ish-sc_sidebar.$lc2a .widget_ishyoboy-twitter-widget a.ish-button-small:hover,

	.ish-sc_sidebar.$btc .widget.widget select,
	.ish-sc_sidebar.$btc .widget.widget option,
	.ish-sc_sidebar.$btc .widget.widget_search input[type='text'],
	.ish-sc_sidebar.$btc .widget.widget_search input[type='submit'],
	.ish-sc_sidebar.$lc1 .widget.widget_tag_cloud a,
	.ish-sc_sidebar.$lc1a .widget.widget_tag_cloud a:hover,

	.ish-sc_sidebar.$lc1a .current_page_item > a,

	.ish-sc_cf7.$bg_cc input,
	.ish-sc_cf7.$bg_cc textarea,
	.ish-sc_cf7.$bg_cc select,
	.ish-sc_cf7.$btn_tc input[type='submit'],

	.ish-sc_cf7.$tc,

	.post-password-form.$bg_cc input,
	.post-password-form.$btn_tc input[type='submit'],
	.post-password-form.$tc,

	.ish-sc_menu.$tc li a,
	.ish-sc_menu.$btc li a:hover,
	.ish-sc_menu.$btc li.current_page_item a,
	.wpb_text_column.$tc,
	.ish-sc_icon_text.$tc,
	.tooltipster-default.$tt_tc,

	.ish-sc_table.$tc,
	.ish-sc_table.$htc th,
	.ish-sc_table th.$tc,
	.ish-sc_table td.$tc,

	.ish-sc_pricing_table.$tc,

	.ish-sc_box.$tc,
	.ish-sc_chart.$tc,
	.ish-highlight.$tc,
	.ish-highlight.$tc a,

	.ish-sc_counter.$tc,
	.ish-sc_counter.$ic .ish-icon,
	.ish-sc_counter.$ic .ish-additional-text,
	.ish-sc_recent_posts.ish-rp-fullwidth .wpb_row.$cc .ish-post-icon i,

	.ish-single_post_categories_and_tags.$tc,
	.ish-single_post_categories_and_tags.$tc a,
	.ish-single_navigation.$tc,
	.ish-single_navigation.$tc a,
	.share_box_fixed.$tc,
	.share_box_fixed.$tc a,

	.ish-sc_button.$tc, a.ish-sc_button.$tc
	{
		color: " . $n_colors[$cc]['hex'] . ";
	}\n";


	echo "
	.ish-sc_box.$tc .ish-sc-element.ish-sc_icon,
	.ish-sc_box.$tc .ish-sc-element.ish-sc_icon a,
	.ish-sc_button.$tc, a.ish-sc_button.$tc:hover,
	.ish-sc_portfolio_categories.$tc .ish-cat, .ish-sc_portfolio_categories.$tc a,
	.ish-sc_portfolio_categories .ish-categories-title.$tc, .ish-sc_portfolio_categories .ish-categories-title.$tc a,
	a .ish-highlight.$tc,
	.ish-tgg-acc-title.ish-active.$active_text_c
	{
		color: " . $n_colors[$cc]['hex'] . " !important;
	}\n";

	echo "
	.ish-sc-element.ish-sc_icon.ish-simple.$tc a:hover,
	.ish-recent_posts_post.$cc .ish-post-title a:hover,
	.ish-recent_posts_post.$cc .main-post-image.ish-empty a,
	.ish-recent_posts_post.$cc .ish-main-post-image.ish-empty a,
	.ish-blog .wpb_row.$cc h2 a:hover,
	.ish-blog .wpb_row .$cc h2 a:hover,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc h2 a:hover,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc .ish-blog-post-links a:hover,
	.ish-blog.ish-blog-fullwidth .wpb_row.$tc .ish-blog-responsive-post-details a:hover,
	.ish-blog.ish-blog-2columns .ish-post-content.$cc .ish-blog-post-details a:hover,
	.ish-blog.ish-blog-2columns .ish-post-content.$cc .ish-blog-post-links a:hover,
	.ish-sc_menu.ish-style-text.ish-no-active-text.$tc li a:hover,
	.ish-sc_menu.ish-style-text.ish-no-active-text.$tc li.current_page_item a,
	.ish-sc_headline.ish-no-underline.$cc a:hover,
	.ish-part_content.$pcbg .ish-sc_headline.ish-no-underline:not([class*=\"ish-color\"]) a:hover,
	.wpb_row.$tc .ish-sc_headline.ish-no-underline:not([class*=\"ish-color\"]) a:hover,
	.wpb_row .ish-sc-element.$tc .ish-sc_headline.ish-no-underline:not([class*=\"ish-color\"]) a:hover
	{
		color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
	}\n";

	echo "
	.ish-sc-element.ish-sc_icon.ish-simple.$active_text_c a:hover,
	.ish-part_footer .ish-sc-element.ish-sc_icon.$active_text_c a:hover
	{
		color: " . $n_colors[$cc]['hex'] . " !important;
	}\n";



	echo "
	.ish-sc-element.$pnc .owl-buttons div span:hover
	{
		color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -50 ) . ";
	}\n";

	/*echo "
	.ish-single_post_categories_and_tags.$cc a:hover
	{
		color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], +50 ) . ";
	}\n";*/


	// color* ----------------------------------------------------------------------------------------------------------
	echo "
	.ish-tagline-image.$tc,
	.ish-tagline-image.$tc a,
	.ish-tagline-colored.$tc,
	.ish-tagline-colored.$tc a,
	.ish-tagline-image.$tc .ish-overlay-box h2,
	.ish-tagline-colored.$tc .ish-overlay-box h2,
	.ish-tagline-colored.$tc .ish-overlay-box .ish-pt-taglines-additional,
	.ish-tagline-image.$tc .ish-overlay-box .ish-pt-taglines-additional,
	.ish-tagline-image.$tc .ish-part_breadcrumbs a,
	.ish-tagline-colored.$tc .ish-part_breadcrumbs a
	{
		color: " . $n_colors[$cc]['hex'] . ";
	}\n";


	echo "
	.ish-tagline-image.$tc .ish-part_breadcrumbs div,
	.ish-tagline-colored.$tc .ish-part_breadcrumbs div
	{
		/*color: rgba(" . $n_colors[$cc]['rgb'] . ", 0.7);*/
	}\n";

	echo "
	.ish-tagline-image.$tc .ish-part_breadcrumbs a:hover,
	.ish-tagline-colored.$tc .ish-part_breadcrumbs a:hover
	{
		color: rgba(" . $n_colors[$cc]['rgb'] . ", 0.7);
	}\n";

	echo "
	.ish-tagline-image.$tc .ish-part_breadcrumbs,
	.ish-tagline-colored.$tc .ish-part_breadcrumbs
	{
		border-color: rgba(" . $n_colors[$cc]['rgb'] . ", 0.5) !important;
	}\n";

	$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
	foreach ( $prefixes as $prefix ) {
		echo '.ish-sc_cf7.'. $bg_cc . ' ' . $prefix . "{ color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }\n";
		echo '.post-password-form.'. $bg_cc . ' ' . $prefix . "{ color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }\n";
	}

	// color* ----------------------------------------------------------------------------------------------------------
	echo "

	.ish-tagline-image.$tc .ish-blog-post-details,
	.ish-tagline-image.$tc .ish-blog-post-details > span,
	.ish-tagline-image.$tc .ish-blog-post-details a:hover,
	.ish-tagline-image.$tc .ish-blog-post-details a:hover span,
	.ish-tagline-colored.$tc .ish-blog-post-details,
	.ish-tagline-colored.$tc .ish-blog-post-details > span,
	.ish-tagline-colored.$tc .ish-blog-post-details a:hover,
	.ish-tagline-colored.$tc .ish-blog-post-details a:hover span,
	.$tc .ish-section-filter li a
	{
		color: " . $n_colors[$cc]['hex'] . ";
	}\n";

	echo "
	.ish-sc_sidebar.$btc .widget_search input[type='text']:-moz-placeholder           { color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }
	.ish-sc_sidebar.$btc .widget_search input[type='text']::-webkit-input-placeholder { color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }
	.ish-sc_sidebar.$btc .widget_search input[type='text'].placeholder                { color: rgba(" . $n_colors[$cc]['rgb'] . ", " . $dyn_col_opacity . "); }
	\n";


	// background-color* -----------------------------------------------------------------------------------------------
	echo "
	.wpb_row.$cc,
	.ish-row-overlay.$cc,
	.ish-box-overlay.$cc,
	.ish-sc_svg_icon.ish-square.$cc,
	.ish-sc_svg_icon.ish-circle.$cc,
	.ish-gmap_box.$cc,
	.ish-blog.ish-blog-2columns .ish-post-media.$cc .ish-blog-quote-content,
	.ish-blog.ish-blog-2columns .ish-post-media.$cc .ish-format-link-url,
	.ish-blog-masonry-layout-grid .ish-blog-post-masonry.$cc,
	.ish-blog-masonry-layout-grid .ish-blog-post-masonry.$cc.ish-image-cover .ish-blog-post-media + div,
	.ish-blog-masonry-layout-grid .ish-blog-post-masonry.$tc.ish-image-cover .ish-blog-post-media + div:before,
	.ish-blog-masonry-layout-grid-boxes .ish-blog-post-masonry.$cc,
	.ish-blog-masonry-layout-grid-boxes .ish-blog-post-masonry.$cc .ish-overlay,
	.ish-tagline-colored.$cc .ish-overlay,
	.ish-sc_icon.$cc.ish-square span span,
	.ish-sc_icon.$cc.ish-circle span span,
	.ish-sc_skills .ish-sc_skill.$sc .ish-bar-bg .ish-bar,
	.ish-sc_skills .ish-sc_skill.$cc .ish-bar-bg,
	.ish-tgg-acc-title.$cc, .ish-tgg-acc-content.$cc,
	.ish-sc_tab.$cc, .ish-tabs-navigation li.$cc a,

	.ish-tagline-image.$tc .ish-blog-post-details:before,
	.ish-tagline-image.$tc .ish-posts-count:before,
	.ish-tagline-colored.$tc .ish-blog-post-details:before,
	.ish-tagline-colored.$tc .ish-posts-count:before,

	.ish-sc_sidebar.$bbgc .widget select,
	.ish-sc_sidebar.$bbgc .widget option,
	.ish-sc_sidebar.$bbgc .widget_search input[type='text'],
	.ish-sc_sidebar.$bbgc .widget_tag_cloud a,

	.ish-sc_cf7.$cc input,
	.ish-sc_cf7.$cc textarea,
	.ish-sc_cf7.$cc select,

	.post-password-form.$cc input,
	.post-password-form.$cc textarea,
	.post-password-form.$cc select,

	.tooltipster-default.$tt_bg,
	.ish-sc-element.$nc .owl-pagination div span:hover, .ish-sc-element.$nc .owl-pagination div.active span,

	.ish-sc_table.$cc td,
	.ish-sc_table.$cc th,
	.ish-sc_table.$hbg table th,
	.ish-sc_table table th.$cc,
	.ish-sc_table table td.$cc,

	.ish-sc_pricing_table.$cc table,

	.ish-sc_box.$cc,

	.ish-sc_button.$cc,
	.ish-highlight.$cc,
	.ish-recent_posts_post.$cc .main-post-image.ish-empty .ish-main-post-image-content,
	.ish-recent_posts_post.$cc .ish-main-post-image.ish-empty .ish-main-post-image-content,
	.ish-recent_posts_post.$cc .ish-blog-audio-content,

	.ish-single_post_categories_and_tags.$cc,
	.ish-single_navigation.$cc,
	.share_box_fixed.$cc,

	.ish-post-media .ish-blog-post-media.$cc,

	.ish-sc_separator.ish-separator-text.$tc .ish-line:before,

	.ish-section-filter.$cc .ish-p-filter li a:hover,
	.ish-section-filter.$cc .ish-p-filter li a.ish-active,
	.ish-section-filter.$cc .ish-p-filter li.current-cat a:hover
	{
		background-color: " . $n_colors[$cc]['hex'] . ";
	}\n";

	echo "
	.ish-tgg-acc-title.ish-active.$active_bg_c
	{
		background-color: " . $n_colors[$cc]['hex'] . " !important;
	}\n";

	echo "
	.ish-sc_icon.$cc.ish-square a:hover span span,
	.ish-sc_icon.$cc.ish-circle a:hover span span,
	.ish-sc_svg_icon.ish-square.$cc a:hover,
	.ish-sc_svg_icon.ish-circle.$cc a:hover,
	.ish-tgg-acc-title.$cc:hover, .ish-tgg-acc-title.$cc.ish-active,
	.ish-tgg-acc-title.ish-active.$active_bg_c:hover,
	.ish-sc_sidebar.$bbgc .widget_search input[type='submit']:hover,
	.ish-blog-masonry-layout-grid .ish-blog-post-masonry.$cc:hover > div,
	.ish-blog-masonry-layout-grid .ish-blog-post-masonry.$cc.ish-image-cover:hover .ish-blog-post-media + div,

	$cc code, $cc pre,
	.wpb_row.$cc code, .wpb_row.$cc pre,
	.wpb_row .ish-sc_box.$cc code, .wpb_row .ish-sc_box.$cc pre,
	.wpb_row .ish-sc_tab.$cc code, .wpb_row .ish-sc_tab.$cc pre,
	.wpb_row .ish-tgg-acc-content.$cc code, .wpb_row .ish-tgg-acc-content.$cc pre,

	a.ish-sc_button.$cc:hover
	{
		background-color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
	}\n";

	echo "
	.ish-blog.ish-blog-2columns .ish-post-media.$cc .ish-blog-post-media,
	.ish-blog.ish-blog-2columns .ish-post-media .ish-blog-audio-content.$cc
	{
		background-color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], +25 ) . ";
	}\n";

	echo "
	.ish-sc_table.ish-striped.$cc table tr:nth-child(even) td,
	.ish-sc_pricing_table.ish-striped.$cc tr:nth-child(even) td
	{
		background-color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -10 ) . ";
	}\n";

	echo "
	.ish-sc_table.ish-striped table tr:nth-child(even) td.$cc
	{
		background-color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -10 ) . " !important;
	}\n";


	echo "
	.ish-tgg-acc-title.$cc,
	.ish-tgg-acc-title.ish-active.$active_bg_c,
	.ish-tabs-navigation li.$cc a,
	.ish-sc_cf7.$btn_cc input[type='submit'],
	.post-password-form.$btn_cc input[type='submit'],
	.ish-sc_menu.$cc li a,
	.ish-sc_menu.$bbgc li a:hover,
	.ish-sc_menu.$bbgc li.current_page_item a
	{
		background-color: " . $n_colors[$cc]['hex'] . ";
		/*box-shadow: 0 3px 0 " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";*/
	}\n";


	echo "
	.ish-tgg-acc-title.$cc:hover, .ish-tgg-acc-title.$cc.ish-active,
	.ish-tgg-acc-title.ish-active.$active_bg_c:hover,
	.ish-tabs-navigation li.$cc a:hover, .ish-tabs-navigation li.$cc.ish-active a,
	.ish-sc_cf7.$btn_cc input[type=\"submit\"]:hover,
	.post-password-form.$btn_cc input[type=\"submit\"]:hover,
	.ish-sc_menu.ish-no-active-bg.$cc li a:hover,
	.ish-sc_menu.ish-no-active-bg.$cc li.current_page_item a,
	.ish-sc_menu.$bbgc li.current_page_item a:hover
	{
		background-color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
		/*box-shadow: 0 3px 0 " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -50 ) . ";*/
	}\n";


	// bloc text colors
	echo "
	.c
	{
		border-color: " . $n_colors[$cc]['hex'] . " !important;
	}\n";


	// fill* -----------------------------------------------------------------------------------------------------------
	echo "
	.ish-sc_icon.ish-hexagon.$cc svg polygon,
	.ish-sc_icon.ish-hexagon_rounded.$cc svg path,
	.ish-sc_svg_icon.ish-hexagon.$cc svg polygon,
	.ish-sc_svg_icon.ish-hexagon_rounded.$cc svg path,
	.ish-row_section.$cc .ish-row-decor-top polyline.ish-color,
	.ish-row_section.$cc .ish-row-decor-bottom polyline.ish-color,
	.ish-row_section.$cc .ish-row-decor-top path.ish-color,
	.ish-row_section.$cc .ish-row-decor-bottom path.ish-color,
	.ish-row_section.$cc .ish-row-decor-top polygon.ish-color,
	.ish-row_section.$cc .ish-row-decor-bottom polygon.ish-color,
	.ish-row_section.$cc .ish-row-decor-top rect.ish-color,
	.ish-row_section.$cc .ish-row-decor-bottom rect.ish-color
	{
		fill: " . $n_colors[$cc]['hex'] . ";
	}\n";

	echo "
	.ish-sc_icon.ish-hexagon.$cc a:hover svg polygon,
	.ish-sc_icon.ish-hexagon_rounded.$cc a:hover svg path,
	.ish-sc_svg_icon.ish-hexagon.$cc a:hover svg polygon,
	.ish-sc_svg_icon.ish-hexagon_rounded.$cc a:hover svg path
	{
		fill: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], -25 ) . ";
	}\n";


	// background-color* -----------------------------------------------------------------------------------------------
	echo "
	.ish-p-overlay.$cc .ish-p-box
	{
		/*background-color: rgba(" . $n_colors[$cc]['rgb'] . ", 0.3);*/
	}\n";

	// background-color* -----------------------------------------------------------------------------------------------
	echo "
	.ish-p-overlay.$cc .ish-p-box,
	.ish-blog-fullwidth .wpb_row.$cc > .ish-overlay,
	.ish-sc_recent_posts.ish-rp-fullwidth .wpb_row.$cc > .ish-overlay,
	.ish-sc_recent_posts.ish-rp-fullwidth .wpb_row.$tc .ish-post-icon i,
	.ish-tagline-image.$cc .ish-overlay
	{
		background-color: " . $n_colors[$cc]['hex'] . ";
	}\n";


	// border-color* ---------------------------------------------------------------------------------------------------
	echo "
	.ish-gmap_box.$cc:before,
	.ish-sc_box.$borderc,
	.ish-sc_separator.ish-separator-simple.$cc,
	.$cc .recent_posts_post_content .post-quote-content,
	.ish-sc-element.$nc .owl-pagination div span,
	.ish-sc_table.$borderc th, .ish-sc_table.$borderc tr, .ish-sc_table.$borderc td,
	.ish-sc_pricing_table.$borderc th, .ish-sc_pricing_table.$borderc tr, .ish-sc_pricing_table.$borderc td,
	.ish-tgg-acc-title.$borderc,
	.ish-tgg-acc-content.$borderc
	{
		border-color: " . $n_colors[$cc]['hex'] . ";
	}\n";

	echo "
	.ish-tagline-colored.$tc .ish-pt-container:before,
	.ish-tagline-colored.$tc .ish-pt-container:before,
	.ish-sc-element.ish-sc_quote.$cc, .ish-sc-element.ish-sc_quote.$cc:before
	{
		border-color: rgba(" . $n_colors[$cc]['rgb'] . ", " . '0.4' . ") !important;
	}\n";

	echo "
	.ish-tagline-image.$tc .ish-blog-post-details,
	.ish-tagline-colored.$tc .ish-blog-post-details,
	.ish-tagline-colored.$tc .ish-pt-container > :last-child,
	.ish-tagline-colored.$tc .ish-part_breadcrumbs
	{
		border-color: rgba(" . $n_colors[$cc]['rgb'] . ", " . '0.25' . ") !important;

	}\n";

	echo "
	.ish-sc_button.ish-border.$tc,
	.post-password-form.ish-border.$btn_tc input[type='submit'],
	.ish-sc_menu.ish-style-border.$tc li a,
	.ish-tabs-navigation li.$borderc a
	{
		border-color: rgba(" . $n_colors[$cc]['rgb'] . ", " . '0.25' . ");
	}

	.ish-sc_button.ish-border.$tc:after
	{
		background-color: rgba(" . $n_colors[$cc]['rgb'] . ", " . '0.25' . ");
	}\n";

	echo "
	.ish-sc_button.ish-border.$tc:hover,
	.ish-sc_cf7.ish-border.$btn_tc input[type='submit']:hover,
	.post-password-form.ish-border.$btn_tc input[type='submit']:hover,
	.ish-sc_menu.ish-style-border.ish-no-active-text.$tc li a:hover,
	.ish-sc_menu.ish-style-border.ish-no-active-text.$tc li.current_page_item a,
	.ish-sc_menu.ish-style-border.$btc li a:hover,
	.ish-sc_menu.ish-style-border.$btc li.current_page_item a,
	.ish-tabs-navigation li.$borderc a:hover,
	.ish-tabs-navigation li.ish-active.$borderc a,
	.ish-sc_tab.$borderc
	{
		border-color: rgba(" . $n_colors[$cc]['rgb'] . ", " . '0.5' . ");
	}

	.ish-sc_button.ish-border.$tc:hover:after
	{
		background-color: rgba(" . $n_colors[$cc]['rgb'] . ", " . '0.5' . ");
	}\n";

	echo "
	.ish-sc_cf7.ish-border.$bg_cc input,
	.ish-sc_cf7.ish-border.$bg_cc textarea,
	.ish-sc_cf7.ish-border.$bg_cc select
	{
		border-color: " . ishfreelotheme_adjust_brightness( $n_colors[$cc]['hex'], +50 ) . ";
	}\n";


	// box-shadow* -----------------------------------------------------------------------------------------------------
	echo "
	.$tt_bg .tooltipster-arrow-top span,
	.$tt_bg .tooltipster-arrow-bottom span{
		border-top-color: " . $n_colors[$cc]['hex'] . " !important;
		border-bottom-color: " . $n_colors[$cc]['hex'] . " !important;
	}

	.$tt_bg .tooltipster-arrow-left span,
	.$tt_bg .tooltipster-arrow-right span{
		border-left-color: " . $n_colors[$cc]['hex'] . " !important;
		border-right-color: " . $n_colors[$cc]['hex'] . " !important;
	}
	\n";

}

?>