<?php

/* *********************************************************************************************************************
 * Fonts
 */

global $ishfreelotheme_fonts;


// FONT SETTINGS
ishfreelotheme_load_font_settings('body_font', $ish_newdata);
ishfreelotheme_load_font_settings('body_font_2', $ish_newdata);
ishfreelotheme_load_font_settings('header_font', $ish_newdata);
ishfreelotheme_load_font_settings('h1_font', $ish_newdata);
ishfreelotheme_load_font_settings('h2_font', $ish_newdata);
ishfreelotheme_load_font_settings('h3_font', $ish_newdata);
ishfreelotheme_load_font_settings('h4_font', $ish_newdata);
ishfreelotheme_load_font_settings('h5_font', $ish_newdata);
ishfreelotheme_load_font_settings('h6_font', $ish_newdata);


foreach ( $ishfreelotheme_fonts as $key => $val){

    switch ( $val['variant'] ){
        case '100' :
            $ishfreelotheme_fonts[$key]['variant'] = '100';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '100italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '100';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '200' :
            $ishfreelotheme_fonts[$key]['variant'] = '200';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '200italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '200';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '300' :
            $ishfreelotheme_fonts[$key]['variant'] = '300';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '300italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '300';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case 'regular' :
            $ishfreelotheme_fonts[$key]['variant'] = '400';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case 'italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '400';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '500' :
            $ishfreelotheme_fonts[$key]['variant'] = '500';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '500italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '500';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '600' :
            $ishfreelotheme_fonts[$key]['variant'] = '600';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '600italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '600';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '700' :
            $ishfreelotheme_fonts[$key]['variant'] = '700';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '700italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '700';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '800' :
            $ishfreelotheme_fonts[$key]['variant'] = '800';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '800italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '800';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '900' :
            $ishfreelotheme_fonts[$key]['variant'] = '900';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '900italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '900';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
    }

	if ( ! isset($ishfreelotheme_fonts[$key]['font-style']) ) {
		$ishfreelotheme_fonts[$key]['font-style'] = 'normal';
	}
}
?>


/* Body font 1 ------------------------------------------------------------------------------------------------------ */
body,
.ish-gmap_box,
.ish-sc_menu.ish-style-text li a,
.ish-shopping-cart ul,
.ish-shopping-cart ul a
{
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['body_font']['css_string']; ?>', sans-serif !important;
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['body_font']['variant']; ?>;
}


/*.ish-ph-mn-resp_nav .sub-menu a, */
p, ul, ol, div, .ish-gmap_box {
	font-size:      <?php echo '' . $ishfreelotheme_fonts['body_font']['size']; ?>px;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['body_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['body_font']['line_height']; ?>px;
}

.wpb_row.ish-valign-middle > .ish-vc_row_inner > .wpb_column.ish-pt-taglines-additional {
	font-size:      <?php echo '' . $ishfreelotheme_fonts['body_font']['size']; ?>px !important;
}


/* Body font 2 - Changed to bodyfont -------------------------------------------------------------------------------- */
.ish-ph-wp_tagline,
.ish-sc_recent_posts .recent_posts_post_content .post-quote-content cite,
.ish-sc_menu li > a,
.ish-sc_menu li > span,
.widget .menu-item > a,
.widget .menu-item > span {
	font-family: '<?php echo '' . $ishfreelotheme_fonts['body_font']['css_string']; ?>', sans-serif !important;
	font-weight: <?php echo '' . $ishfreelotheme_fonts['body_font']['variant']; ?>;
}


/* New bodyfont2 ---------------------------------------------------------------------------------------------------- */
.widget .widget-title.ish-h5,
.ish-sc_recent_posts .recent_posts_post_content a.pt-link,
.ish-sc_recent_posts .recent_posts_post_content .post-quote-content,
.ish-megamenu:not(.ish-ph-mn-be_resp):not(.ish-phb-be_resp) .ish-megamenu-column > a,
.ish-megamenu:not(.ish-ph-mn-be_resp):not(.ish-phb-be_resp) .ish-megamenu-column > span,
.ish-sc_recent_posts .ish-post-title a
{
	font-family: '<?php echo '' . $ishfreelotheme_fonts['body_font_2']['css_string']; ?>', sans-serif !important;
	font-weight: <?php echo '' . $ishfreelotheme_fonts['body_font_2']['variant']; ?> !important;
	/*font-size: <?php /*echo '' . $ishfreelotheme_fonts['body_font_2']['size']; */?>px !important;*/
	font-style: italic;
}





/* Header font ------------------------------------------------------------------------------------------------------ */
.ish-part_header div,
.ish-part_header_bar div,
.ish-ph-main_nav a,
.ish-ph-mn-be_resp a,
.ish-phb-be_resp a,
.ish-sc_quote cite
{
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['header_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo '' . $ishfreelotheme_fonts['header_font']['size']; ?>px;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['header_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['header_font']['line_height']; ?>px;
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['header_font']['variant']; ?> !important;

}


/* Headlines -------------------------------------------------------------------------------------------------------- */
h1, .ish-h1, .ish-sc_quote .ish-h1, .widget .ish-h1, .ish-h1 > p,
.ish-part_searchbar input[type="text"] {
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['h1_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h1_font']['size']; ?>px !important;  /* !important because of VC */
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['h1_font']['variant']; ?>;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['h1_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h1_font']['line_height']; ?>px;
}

.ish-sc_quote.ish-h1 cite {
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h3_font']['size']; ?>px;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h3_font']['line_height']; ?>px;
}


h2, .ish-h2, .ish-sc_quote .ish-h2, .widget .ish-h2, .ish-h2 > p {
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['h2_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h2_font']['size']; ?>px;
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['h2_font']['variant']; ?>;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['h2_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h2_font']['line_height']; ?>px;
}

.ish-sc_quote.ish-h2 cite {
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h4_font']['size']; ?>px;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h4_font']['line_height']; ?>px;
}


h3, .ish-h3, .ish-sc_quote .ish-h3, .widget .ish-h3, .ish-h3 > p {
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['h3_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h3_font']['size']; ?>px;
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['h3_font']['variant']; ?>;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['h3_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h3_font']['line_height']; ?>px;
}

.ish-sc_quote.ish-h3 cite {
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h5_font']['size']; ?>px;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h5_font']['line_height']; ?>px;
}

h4, .ish-h4, .ish-sc_quote .ish-h4, .widget .ish-h4, .ish-h4 > p, .ish-p-headline {
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['h4_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h4_font']['size']; ?>px;
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['h4_font']['variant']; ?>;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['h4_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h4_font']['line_height']; ?>px;
}

.ish-sc_quote.ish-h4 cite {
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h6_font']['size']; ?>px;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h6_font']['line_height']; ?>px;
}

h5, .ish-h5, .ish-sc_quote .ish-h5, .widget .ish-h5, .ish-h5 > p {
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['h5_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h5_font']['size']; ?>px;
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['h5_font']['variant']; ?>;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['h5_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h5_font']['line_height']; ?>px;
}

.ish-sc_quote.ish-h5 cite {
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h6_font']['size']; ?>px;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h6_font']['line_height']; ?>px;
}

h6, .ish-h6, .ish-sc_quote .ish-h6, .widget .ish-h6, .ish-h6 > p {
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['h6_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h6_font']['size']; ?>px;
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['h6_font']['variant']; ?>;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['h6_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h6_font']['line_height']; ?>px;
}

.ish-sc_quote.ish-h6 cite {
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h6_font']['size']; ?>px;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h6_font']['line_height']; ?>px;
}

.ish-part_tagline h1, .ish-part_tagline h1 > p,
.ish-part_tagline .ish-overlay-box .ish-archive-lead h1, .ish-part_tagline .ish-overlay-box .ish-archive-lead > h1 {
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['h1_font']['css_string']; ?>', sans-serif !important;
	font-size:      <?php echo '' . $ishfreelotheme_fonts['h1_font']['size']; ?>px !important;
	font-weight:    <?php echo '' . $ishfreelotheme_fonts['h1_font']['variant']; ?>;
	font-style:     <?php echo '' . $ishfreelotheme_fonts['h1_font']['font-style']; ?>;
	line-height:    <?php echo '' . $ishfreelotheme_fonts['h1_font']['line_height']; ?>px;
}

/*.ish-part_tagline .ish-pt-taglines-left.ish-default h2,
.ish-part_tagline .ish-pt-taglines-left.ish-default h2 > p{*/
.ish-part_tagline h2, .ish-part_tagline h2 > p,
.ish-part_tagline .ish-archive-lead h1, .ish-part_tagline .ish-archive-lead h1 > p {
	font-family:    '<?php echo '' . $ishfreelotheme_fonts['h3_font']['css_string']; ?>', sans-serif !important;
	font-size:       <?php echo '' . $ishfreelotheme_fonts['h3_font']['size']; ?>px !important;
	font-weight:     <?php echo '' . $ishfreelotheme_fonts['h3_font']['variant']; ?>;
	font-style:      <?php echo '' . $ishfreelotheme_fonts['h3_font']['font-style']; ?>;
	line-height:     <?php echo '' . $ishfreelotheme_fonts['h3_font']['line_height']; ?>px;
}





/* Uppercase */
.widget_ishyoboy-recent-portfolio-widget .ish-button-small,
.widget_ishyoboy-dribbble-widget .ish-button-small,
.widget_ishyoboy-flickr-widget .ish-button-small,
.widget_ishyoboy-twitter-widget .ish-button-small,
.widget .ish-button-small,
.widget_calendar #wp-calendar caption,
.widget_calendar #wp-calendar tfoot a,

.widget_ishyoboy-main-navigation-widget ul,
.widget_nav_menu ul,
.widget_categories ul,
.widget_archive ul,
.widget_meta ul,
.widget_pages ul,
.widget_tag_cloud a,
.ish-blog-classic .ish-read-more,
.ish-part_breadcrumbs,
.ish-bc-details-spacer,
.ish-posts-count,
.ish-ct-title, .ish-ct-content,
.ish-p-cat,
.ish-rp-fullwidth .rc-post-details,
.ish-sc_portfolio_prev_next a,
.ish-ph-mn-be_resp li > a,
.ish-phb-be_resp li > a,
.ish-ph-mn-be_resp li > span,
.ish-phb-be_resp li > span,
.post-password-form input[type='submit'],
.ish-sc_pricing_row .ish-sc_button,
.ish-sc_skill span
{
    text-transform: uppercase;
}

.ish-part_tagline h1:before,
.ish-part_tagline h2:before
{
	text-transform: lowercase;
}