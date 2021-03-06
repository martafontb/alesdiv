<?php

global $ish_rows_count, $ishfreelotheme_rows_replace, $ishfreelotheme_options, $ish_last_row_html;

$output = $output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';

$sc_atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts = shortcode_atts( $sc_atts, $atts);

// Default SC attributes
$defaults = array(
	'el_class'        => '',
	'section'         => '',
	'color'           => '',
	'text_color'      => '',
	'full_width'      => '',
	'padding_bottom'  => '',
	'bg_svg'          => '',
	'top_svg'         => '',
	'bottom_svg'      => '',

	'bg_image'        => '',
	'parallax'        => '',
	'bg_image_repeat' => '',
	'bg_color'        => '',
	'bg_opacity'      => '',
	'vertical_align'  => '',
	'font_color'      => '',
	'padding'         => '',
	'margin_bottom'   => '',

	'remove_column_margins'   => '',
	'center_content'   => '',

	'css'   => '',

	'bg_video_webm'   => '',
	'bg_video_mp4'   => '',
	'bg_video_image'   => '',

	'responsive_point'   => '',
);

// Merge defaults with the global attributes
$defaults = ishfreelotheme_extract_sc_attributes($defaults, $atts);

// Extract all attributes
extract( $defaults );

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
$el_data_attributes = '';

if ( '' != $bg_image && ( wp_get_attachment_url( $bg_image, 'large' ) !== false ) ){

	if ( 'static' == $parallax ){

		// STATIC PARALLAX
		$el_class .= ' ish-parallax-static';

	}elseif ( 'dynamic' == $parallax ){

		// DYNAMIC PARALLAX
		$el_class .= ' ish-parallax-dynamic';

		wp_enqueue_script( 'ishfreelotheme-backgroundpos' );
		wp_enqueue_script( 'ishfreelotheme-parallax' );
		wp_enqueue_script( 'ishfreelotheme-easing' );
	}
	else{
		$el_class .= ' ish-noparallax';
	}
}

$full_width_class = ( 'yes' == $section && '' != $full_width && 'full-height' != $full_width) ? 'ish-row-full' : 'ish-row-notfull';
$full_width_class .= ( 'yes' == $section && 'padding' == $full_width ) ? ' ish-row-full-padding' : ' ish-row-full-nopadding';
$full_width_class .= ( 'yes' == $section && ( 'full-height' == $full_width || 'full-full-height' == $full_width ) ) ? ' vh100 ish-row-full-height' : '';
$full_width_class .= ( 'yes' == $section && 'padding-full-height' == $full_width ) ? ' ish-row-full-padding vh100 ish-row-full-height' : '';

$output = '';

if ( 'vc_row_inner' == $this->shortcode ){

	if ( ! empty( $style ) ){
		$style = ' style="' . $style . '"';
	}

	$ish_css_classes = ( '' != $css_class ) ? ( ' ' . esc_attr( $css_class ) ) : '' ;
	$ish_css_classes .= ( '' != $tooltip && '' != $tooltip_color ) ? ( ' ish-tooltip-' . esc_attr( $tooltip_color ) ) : '';
	$ish_css_classes .= ( '' != $tooltip && '' != $tooltip_text_color ) ? ' ish-tooltip-text-' . esc_attr( $tooltip_text_color ) : '';
	$ish_css_classes .= ( '' != $bottom_margin ) ? ' ish-bottom-margin-' . esc_attr( $bottom_margin ) : '';
	$ish_css_classes .= ( '' != $vertical_align ) ? ' ish-valign-' . $vertical_align : '';
	$ish_css_classes .= ( false !== strpos( $content, '[ish_portfolio') ) ? ' ish-has-portfolio' : '';
	$ish_css_classes .= ( false !== strpos( $content, 'show_as_first="yes"') ) ? ' ish-resp-reorder' : '';
	$ish_css_classes .= ( 'yes' == $remove_column_margins ) ? ' ish-no-margins' : '';
	$ish_css_classes .= ( '' != $responsive_point ) ? ' ish-resp-point-' . esc_attr( $responsive_point ) : '';

	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' . get_row_css_class() . $el_class . $ish_css_classes , $this->settings['base']);
	$output .= '<div class="'.$css_class.'"' . $style;
	$output .= ( '' != $tooltip ) ? ' data-type="tooltip" title="' . esc_attr( $tooltip ) . '"' : '';

	// ID
	$output .= ( '' != $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

	$output .= '>';
	$output .= wpb_js_remove_wpautop( do_shortcode($content) );
	$output .= '</div>'.$this->endBlockComment('row');
}
else{

	// Do not remove! Necessary for row decorations paddings of previous sections. The last space is very IMPORTANT. Make sure not to remove it!
	$ish_rows_count++;
	$row_decor_padding_class = ' ish-decor-padding-' . $ish_rows_count . ' ';

	// COLORS
	if ( 'advanced' != $color ){
		$bg_color = '';
	}
	if ( 'advanced' != $text_color ){
		$font_color = '';
	}

	// Handle the opacity number
	if ( '' != $bg_opacity ) {

		if ( is_numeric( $bg_opacity ) ){
			if ( $bg_opacity > 100 ) { $bg_opacity = 100; }
			else if ( $bg_opacity < 0 ) { $bg_opacity = 0; }
			else if ( $bg_opacity > 0 && $bg_opacity < 1  ) { $bg_opacity = $bg_opacity * 100; }
		}
		else {
			$bg_opacity = '';
		}
	}


	$ish_style = $style;

	//Remove the default BG color if row opacity set
	if ( '' != $bg_opacity ){
		$ish_style .= ' background-color: transparent;';
	}

	$style = ishfreelotheme_vc_build_style($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

	if ( !empty( $style ) ){
		$style = str_replace( 'style="', 'style="' . $ish_style . ' ', $style );
	} else{
		$style = ' style="' . $ish_style . '"';
	}

	$ish_css_classes = '';

	$ish_css_classes .= ( false != strpos($style, 'background-image')) ? ' ish-has-bgimage' : ' ish-has-nobgimage';

	$c =  ( '' != $color) ? ( ' ish-' . $color ) : '';
	// Remove BG color if opacity set
	$c =  ( '' == $bg_opacity ) ? $c : '';
	$c =  ( 'advanced' == $color) ? ( ' ish-color-advanced' ) : $c;
	$tc = ( '' != $text_color) ? ' ish-text-' . $text_color : '';
	$tc = ( 'advanced' == $text_color) ? ' ish-text-color-advanced' : $tc;
	$portfolio_flickering_fix = ( false !== strpos( $content, '[ish_portfolio') ) ? ' ish-has-portfolio' : '';
	$padding_class = ( ( '' == $full_width && '' != $padding_bottom ) || ( 'padding' == $full_width && '' != $padding_bottom ) ) ? ' ish-no-padding-bottom' : '';
	$section_class = ( 'yes' == $section ) ? ' ish-row_section' : ' ish-row_notsection';
	$valign_class = ( '' != $vertical_align ) ? ' ish-valign-' . $vertical_align : '';
	$bg_svg_class = ( 'yes' == $section && '' != $bg_svg ) ? ' ish-row-svg-bg-' . $bg_svg : '';
	$top_svg_class = ( 'yes' == $section && '' != $top_svg ) ? ' ish-row-svg-top-' . $top_svg : '';
	$bottom_svg_class = ( 'yes' == $section && '' != $bottom_svg ) ? ' ish-row-svg-bottom-' . $bottom_svg : '';
	$ish_css_classes .= ( '' != $css_class ) ? ( ' ' . esc_attr( $css_class ) ) : '' ;
	$ish_css_classes .= ( '' != $tooltip && '' != $tooltip_color ) ? ( ' ish-tooltip-' . esc_attr( $tooltip_color ) ) : '';
	$ish_css_classes .= ( '' != $tooltip && '' != $tooltip_text_color ) ? ' ish-tooltip-text-' . esc_attr( $tooltip_text_color ) : '';
	$ish_css_classes .= ( '' != $bottom_margin ) ? ' ish-bottom-margin-' . esc_attr( $bottom_margin ) : '';
	$ish_css_classes .= ( ( '' != $center_content && 'no' != $center_content ) || ( '' == $center_content && isset($ishfreelotheme_options) && 1 == $ishfreelotheme_options['responsive_content_centering'] ) || ( '' == $center_content && !isset($ishfreelotheme_options) ) ) ? ' ish-resp-centered' : '';
	$ish_css_classes .= ( false !== strpos( $content, 'show_as_first="yes"') ) ? ' ish-resp-reorder' : '';
	$ish_css_classes .= ( '' != $responsive_point ) ? ' ish-resp-point-' . esc_attr( $responsive_point ) : '';
	$video_bg_class = ( ( 'yes' == $section ) && ( ('' != $bg_video_webm) || ('' != $bg_video_mp4) ) ) ? ' ish-videobg' : '';
	$remove_column_margins = ( 'yes' == $remove_column_margins ) ? ' ish-no-margins' : '';
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row vc_row-fluid ' . $full_width_class . $el_class . $ish_css_classes . $c . $tc . $padding_class . $section_class . $bg_svg_class . $top_svg_class . $bottom_svg_class . $row_decor_padding_class . $portfolio_flickering_fix . $valign_class . $video_bg_class . $remove_column_margins, $this->settings['base']);
	$output .= '<div class="'.$css_class.'"' . $el_data_attributes . $style;
	$output .= ( '' != $tooltip ) ? ' data-type="tooltip" title="' . esc_attr( $tooltip ) . '"' : '';

	// ID
	$output .= ( '' != $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

	$output .= '>';

	// BACKGROUND VIDEO
	if ( ( 'yes' == $section ) && ( ('' != $bg_video_webm) || ('' != $bg_video_mp4) ) ) {


		// IMAGE FALLBACK
		$img_fallback = '';
		if ( ('' != $bg_video_image) ) {
			$img_fallback = wp_get_attachment_url( $bg_video_image, 'full' );
			if ( false !== $img_fallback ) $img_fallback = ' style="background-image:url(\'' . $img_fallback . '\');"';
		}

		$output .= '<div class="ish-videobg-layer" ' . $img_fallback . '><video autoplay loop muted>';

		// WEBM VIDEO FILE
		if ( ('' != $bg_video_webm) ) {
			// E.g.: http://demosthenes.info/assets/videos/polina.webm
			$output .= '<source src="' . $bg_video_webm . '" type="video/webm">';
		}

		// MP4 VIDEO FILE
		if ( ('' != $bg_video_mp4) ) {
			// E.g.: http://demosthenes.info/assets/videos/polina.mp4
			$output .= '<source src="' . $bg_video_mp4 . '" type="video/mp4">';
		}

		$output .= '</video></div>';

	}

	if ( ( '' != $bg_opacity ) && is_numeric( $bg_opacity ) ){
		$o_class =  ( '' != $color) ? ( ' ish-' . $color ) : '';
		$output .= '<div class="ish-row-overlay' . $o_class . '" style="opacity: ' . ( $bg_opacity / 100 ) . ';"></div>';
	}

	if ( ! empty( $top_svg_class ) ){
		// If current section has a top decoration the previous one should keep its "$row_decor_padding_class" class and thus we should remove it from the array of classes to be removed.
		if ( ! empty( $ishfreelotheme_rows_replace ) ) {
			array_pop( $ishfreelotheme_rows_replace );
		}
	}

	// Set current row class for removal
	$ishfreelotheme_rows_replace[] = $row_decor_padding_class;

	if  ( 'yes' == $section ) {
		// Add row decorations, only if the row is set as section.

		// All top svg decorations
		$all_top_svgs = array(
			'arrow-outside'         => array( '100',  '50', '<polygon class="ish-color" points="100,50 0,50 50,0 50,0"/>' ),
			'arrow-inside'          => array( '3000', '50', '<polygon class="ish-color" points="3000,0 3000,50 1553.5,50 1500.125,50 1550.125,0 1553.5,0"/><polygon class="ish-color" points="1450.125,0 1500.125,50 1445.5,50 0,50 0,0 1445.5,0"/>' ),
			'clouds-outside'        => array( '3000', '50', '<path class="ish-color" d="M2991.537,20.939c-18.545-8.15-39.04-12.684-60.597-12.684c-39.798,0-75.988,15.428-102.934,40.62 c-12.01-5.07-25.211-7.875-39.066-7.875c-4.183,0-8.304,0.26-12.353,0.756C2742.648,15.58,2700.117,0,2653.94,0 c-47.003,0-90.235,16.136-124.468,43.165c-9.64-1.419-19.498-2.165-29.532-2.165c-18.148,0-35.729,2.419-52.453,6.928 C2422.578,29.742,2391.89,19,2358.687,19c-27.763,0-53.767,7.512-76.106,20.603c-13.822-3.005-28.171-4.603-42.894-4.603 c-19.019,0-37.42,2.644-54.858,7.579C2166.629,16.821,2136.623,0,2102.687,0c-23.124,0-44.421,7.814-61.404,20.939 c-18.545-8.15-39.039-12.684-60.596-12.684c-39.799,0-75.988,15.428-102.934,40.62c-12.01-5.07-25.211-7.875-39.066-7.875 c-4.183,0-8.304,0.26-12.353,0.756C1792.394,15.58,1749.862,0,1703.687,0c-47.003,0-90.235,16.136-124.468,43.165 c-9.64-1.42-19.498-2.165-29.532-2.165c-12.961,0-25.63,1.241-37.908,3.585c-19.375-6.216-40.024-9.585-61.464-9.585 c-19.019,0-37.42,2.644-54.858,7.579C1377.257,16.821,1347.251,0,1313.314,0c-23.125,0-44.421,7.814-61.404,20.939 c-18.545-8.15-39.04-12.684-60.597-12.684c-39.798,0-75.988,15.428-102.934,40.62c-12.01-5.07-25.21-7.875-39.066-7.875 c-4.183,0-8.304,0.26-12.352,0.756C1003.021,15.58,960.49,0,914.314,0c-47.003,0-90.235,16.136-124.468,43.165 C780.207,41.746,770.348,41,760.314,41c-18.148,0-35.729,2.419-52.454,6.928C682.952,29.742,652.262,19,619.059,19 c-27.762,0-53.767,7.512-76.106,20.603C529.13,36.598,514.782,35,500.059,35c-19.019,0-37.42,2.644-54.858,7.579 C427.002,16.821,396.996,0,363.059,0c-23.125,0-44.42,7.814-61.404,20.939c-18.545-8.15-39.04-12.684-60.596-12.684 c-39.798,0-75.988,15.428-102.934,40.62C126.116,43.805,112.915,41,99.059,41c-4.182,0-8.304,0.26-12.352,0.756 C61.784,22.535,32.231,9.026,0,3.208V50h57.436h39.281h40.207h3.759h135.467h69.045h78.569h26.205h77.518h48.868h124.308h9.969 h71.024h38.309h187.726h39.281h40.206h3.759h135.468h69.046h78.569h26.205h89.811h36.575h44.419h38.31h187.725h39.281h40.207h3.759 h135.467h69.046h78.568h26.205h77.519h48.867h124.308h9.97h71.023h38.31h187.726h39.28h40.207h3.759h135.468H3000V24.972v-9.907 C2997.075,16.881,2994.252,18.842,2991.537,20.939z"/>' ),
			'clouds-inside'         => array( '3000', '50', '<path class="ish-color" d="M1980.687,41.745c-39.799,0-75.988-15.429-102.934-40.62C1865.743,6.195,1852.542,9,1838.687,9 c-4.183,0-8.304-0.26-12.353-0.756C1792.394,34.42,1749.862,50,1703.687,50h399c-23.124,0-44.421-7.814-61.404-20.939 C2022.737,37.211,2002.243,41.745,1980.687,41.745z"/><path class="ish-color" fill="#668CB2" d="M2991.537,29.061c-18.545,8.15-39.04,12.685-60.597,12.685c-39.798,0-75.988-15.429-102.934-40.62 C2815.997,6.195,2802.796,9,2788.94,9c-4.183,0-8.304-0.26-12.353-0.756C2742.648,34.42,2700.117,50,2653.94,50H3000V34.936 C2997.075,33.119,2994.252,31.158,2991.537,29.061z"/><path class="ish-color" fill="#668CB2" d="M1191.313,41.745c-39.798,0-75.988-15.429-102.934-40.62C1076.37,6.195,1063.169,9,1049.313,9 c-4.183,0-8.304-0.26-12.352-0.756C1003.021,34.42,960.49,50,914.314,50h399c-23.125,0-44.421-7.814-61.404-20.939 C1233.365,37.211,1212.87,41.745,1191.313,41.745z"/><path class="ish-color" fill="#668CB2" d="M2499.94,9c-18.148,0-35.729-2.419-52.453-6.928C2422.578,20.258,2391.89,31,2358.687,31 c-27.763,0-53.767-7.512-76.106-20.603c-13.822,3.005-28.171,4.603-42.894,4.603c-19.019,0-37.42-2.644-54.858-7.579 C2166.629,33.179,2136.623,50,2102.687,50h551.254c-47.003,0-90.235-16.136-124.468-43.165C2519.833,8.254,2509.975,9,2499.94,9z"/><path class="ish-color" fill="#668CB2" d="M1549.687,9c-12.961,0-25.63-1.241-37.908-3.585c-19.375,6.216-40.024,9.585-61.464,9.585 c-19.019,0-37.42-2.644-54.858-7.579C1377.257,33.179,1347.251,50,1313.314,50h390.372c-47.003,0-90.235-16.136-124.468-43.165 C1569.579,8.255,1559.721,9,1549.687,9z"/><path class="ish-color" fill="#668CB2" d="M760.314,9c-18.148,0-35.729-2.419-52.454-6.928C682.952,20.258,652.262,31,619.059,31 c-27.762,0-53.767-7.512-76.106-20.603C529.13,13.402,514.782,15,500.059,15c-19.019,0-37.42-2.644-54.858-7.579 C427.002,33.179,396.996,50,363.059,50h551.255c-47.003,0-90.235-16.136-124.468-43.165C780.207,8.254,770.348,9,760.314,9z"/><path class="ish-color" fill="#668CB2" d="M241.059,41.745c-39.798,0-75.988-15.429-102.934-40.62C126.116,6.195,112.915,9,99.059,9 c-4.182,0-8.304-0.26-12.352-0.756C61.784,27.465,32.231,40.975,0,46.792V50h363.059c-23.125,0-44.42-7.814-61.404-20.939 C283.11,37.211,262.615,41.745,241.059,41.745z"/>' ),
			'curtain-outside'       => array( '3000', '50', '<path class="ish-color" d="M2224.398,14.032C2212.785,35.453,2190.104,50,2164.023,50h120.75 C2258.695,50,2236.014,35.453,2224.398,14.032z"/><path class="ish-color" d="M2465.914,14.032C2454.299,35.453,2431.617,50,2405.539,50h120.75 C2500.209,50,2477.527,35.453,2465.914,14.032z"/><path class="ish-color" d="M2103.566,13.875C2091.979,35.383,2069.251,50,2043.108,50h120.915 C2137.881,50,2115.154,35.383,2103.566,13.875z"/><path class="ish-color" d="M2586.566,14.207C2574.924,35.533,2552.297,50,2526.289,50h120.556 C2620.838,50,2598.209,35.533,2586.566,14.207z"/><path class="ish-color" d="M2345.156,14.019C2333.545,35.447,2310.859,50,2284.773,50h120.766 C2379.453,50,2356.768,35.447,2345.156,14.019z"/><path class="ish-color" d="M1620.566,14.207C1608.924,35.533,1586.296,50,1560.288,50h120.557 C1654.837,50,1632.209,35.533,1620.566,14.207z"/><path class="ish-color" d="M1741.22,14.031C1729.605,35.453,1706.924,50,1680.845,50h120.75 C1775.515,50,1752.833,35.453,1741.22,14.031z"/><path class="ish-color" d="M1861.977,14.019C1850.364,35.447,1827.68,50,1801.595,50h120.764 C1896.273,50,1873.588,35.447,1861.977,14.019z"/><path class="ish-color" d="M1982.733,14.031C1971.12,35.453,1948.438,50,1922.358,50h120.75 C2017.029,50,1994.348,35.453,1982.733,14.031z"/><path class="ish-color" d="M2827.977,14.019C2816.365,35.447,2793.68,50,2767.595,50h120.763 C2862.273,50,2839.589,35.447,2827.977,14.019z"/><path class="ish-color" d="M2707.22,14.031C2695.605,35.453,2672.924,50,2646.845,50h120.75 C2741.515,50,2718.833,35.453,2707.22,14.031z"/><path class="ish-color" d="M3000,50h9.107c-3.088,0-6.127-0.211-9.107-0.606V50z"/><path class="ish-color" d="M2948.732,14.031C2937.119,35.453,2914.438,50,2888.357,50H3000v-0.606 C2977.814,46.451,2958.973,32.916,2948.732,14.031z"/><path class="ish-color" d="M51.267,14.032C41.029,32.916,22.187,46.451,0,49.394V50h111.642C85.563,50,62.881,35.453,51.267,14.032z"/><path class="ish-color" d="M-9.108,50H0v-0.606C-2.98,49.789-6.02,50-9.108,50z"/><path class="ish-color" d="M292.781,14.032C281.166,35.453,258.484,50,232.406,50h120.75C327.076,50,304.395,35.453,292.781,14.032z"/><path class="ish-color" d="M413.434,14.208C401.791,35.533,379.164,50,353.156,50h120.556C447.705,50,425.076,35.533,413.434,14.208z"/><path class="ish-color" d="M172.023,14.019C160.412,35.447,137.727,50,111.642,50h120.765C206.32,50,183.636,35.447,172.023,14.019z"/><path class="ish-color" d="M896.434,13.875C884.846,35.383,862.118,50,835.975,50h120.916C930.749,50,908.021,35.383,896.434,13.875z"/><path class="ish-color" d="M1379.434,14.208C1367.791,35.533,1345.164,50,1319.156,50h120.557 C1413.703,50,1391.076,35.533,1379.434,14.208z"/><path class="ish-color" d="M1258.781,14.032C1247.166,35.453,1224.484,50,1198.405,50h120.751 C1293.076,50,1270.395,35.453,1258.781,14.032z"/><path class="ish-color" d="M1538.434,46.379c-16.486-5.585-30.166-17.256-38.346-32.347c-0.028,0.052-0.06,0.103-0.088,0.155 c-0.028-0.052-0.059-0.103-0.087-0.155c-8.182,15.091-21.86,26.762-38.347,32.347v0.059c-6.865,2.305-14.212,3.563-21.854,3.563 h21.854h76.867h21.854c-7.643,0-14.989-1.258-21.854-3.563V46.379z"/><path class="ish-color" d="M1138.023,14.019C1126.411,35.447,1103.727,50,1077.641,50h120.765 C1172.32,50,1149.635,35.447,1138.023,14.019z"/><path class="ish-color" d="M654.844,14.019C643.232,35.447,620.547,50,594.462,50h120.763C689.141,50,666.456,35.447,654.844,14.019z"/><path class="ish-color" d="M534.087,14.032C522.473,35.453,499.791,50,473.712,50h120.75C568.382,50,545.7,35.453,534.087,14.032z"/><path class="ish-color" d="M775.6,14.032C763.986,35.453,741.305,50,715.225,50h120.75C809.896,50,787.215,35.453,775.6,14.032z"/><path class="ish-color" d="M1017.266,14.032C1005.652,35.453,982.971,50,956.891,50h120.75 C1051.563,50,1028.881,35.453,1017.266,14.032z"/>' ),
			'curtain-inside'        => array( '3000', '50', '<path class="ish-color" d="M2948.732,35.969c10.24-18.885,29.082-32.42,51.268-35.362V50H0V0.606 c22.187,2.942,41.029,16.478,51.267,35.361C62.881,14.547,85.563,0,111.642,0c26.085,0,48.771,14.553,60.382,35.98 C183.636,14.553,206.32,0,232.406,0c26.078,0,48.76,14.547,60.375,35.968C304.395,14.547,327.076,0,353.156,0 c26.008,0,48.635,14.467,60.277,35.793C425.076,14.467,447.705,0,473.712,0c26.079,0,48.761,14.547,60.375,35.969 C545.7,14.547,568.382,0,594.462,0c26.085,0,48.771,14.553,60.382,35.98C666.456,14.553,689.141,0,715.225,0 c26.08,0,48.762,14.547,60.375,35.969C787.215,14.547,809.896,0,835.975,0c26.144,0,48.871,14.617,60.459,36.125 C908.021,14.617,930.749,0,956.891,0c26.08,0,48.762,14.547,60.375,35.968C1028.881,14.547,1051.563,0,1077.641,0 c26.086,0,48.771,14.553,60.383,35.98C1149.635,14.553,1172.32,0,1198.405,0c26.079,0,48.761,14.547,60.376,35.968 C1270.395,14.547,1293.076,0,1319.156,0c26.008,0,48.635,14.467,60.277,35.793C1391.076,14.467,1413.703,0,1439.713,0 c7.642,0,14.988,1.258,21.854,3.563v0.059c16.486,5.585,30.165,17.256,38.347,32.347c0.028-0.052,0.059-0.103,0.087-0.155 c0.028,0.053,0.06,0.104,0.088,0.156c8.18-15.092,21.859-26.763,38.346-32.348V3.563C1545.299,1.258,1552.646,0,1560.288,0 c26.008,0,48.636,14.467,60.278,35.793C1632.209,14.467,1654.837,0,1680.845,0c26.079,0,48.761,14.547,60.375,35.969 C1752.833,14.547,1775.515,0,1801.595,0c26.085,0,48.77,14.553,60.382,35.981C1873.588,14.553,1896.273,0,1922.358,0 c26.08,0,48.762,14.547,60.375,35.969C1994.348,14.547,2017.029,0,2043.108,0c26.143,0,48.87,14.617,60.458,36.125 C2115.154,14.617,2137.881,0,2164.023,0c26.08,0,48.762,14.547,60.375,35.968C2236.014,14.547,2258.695,0,2284.773,0 c26.086,0,48.771,14.553,60.383,35.981C2356.768,14.553,2379.453,0,2405.539,0c26.078,0,48.76,14.547,60.375,35.968 C2477.527,14.547,2500.209,0,2526.289,0c26.008,0,48.635,14.467,60.277,35.793C2598.209,14.467,2620.838,0,2646.845,0 c26.079,0,48.761,14.547,60.375,35.969C2718.833,14.547,2741.515,0,2767.595,0c26.085,0,48.771,14.553,60.382,35.981 C2839.589,14.553,2862.273,0,2888.357,0C2914.438,0,2937.119,14.547,2948.732,35.969z"/>' ),
			'rounded-outside'       => array( '100%',   '100%', '<path class="ish-color" d="M0,100h100C100,73,77.613,0,50,0C22.386,0,0,73,0,100z"/>' ),
			'rounded-inside'        => array( '100%',   '100%', '<path class="ish-color" d="M50,100h50V0C100,27,77.613,100,50,100z"/><path class="ish-color" d="M0,0v100h50C22.386,100,0,27,0,0z"/>' ),
			'slope-left'            => array( '100%',   '100%', '<polyline class="ish-color" points="100,100 100,0 0,100"/>' ),
			'slope-left-shadow'     => array( '100%',   '100%', '<polyline class="ish-color" points="100,100 100,0 0,100"/><polyline fill="rgba(0, 0, 0, 0.05)" points="100,50 100,0 0,100"/>' ),
			'slope-right'           => array( '100%',   '100%', '<polyline class="ish-color" points="0,100 0,0 100,100"/>' ),
			'slope-right-shadow'    => array( '100%',   '100%', '<polyline class="ish-color" points="0,100 0,0 100,100"/><polyline fill="rgba(0, 0, 0, 0.05)" points="0,50 0,0 100,100"/>' ),
			'triangle-outside'      => array( '100%',   '100%', '<polyline class="ish-color" points="50,0 0,100 100,100"/>' ),
			'triangle-inside'       => array( '100%',   '100%', '<polygon class="ish-color" points="0,0 50,100 0,100"/><polygon class="ish-color" points="50,100 100,0 100,100"/>' ),
			'zigzag'                => array( '3000', '50', '<polygon class="ish-color" points="750,0 800,50 700,50"/><polygon class="ish-color" points="850,0 900,50 800,50"/><polygon class="ish-color" points="950,0 1000,50 900,50"/><polygon class="ish-color" points="1050,0 1100,50 1000,50"/><polygon class="ish-color" points="1150,0 1200,50 1100,50"/><polygon class="ish-color" points="1250,0 1300,50 1200,50"/><polygon class="ish-color" points="1350,0 1400,50 1300,50"/><polygon class="ish-color" points="1450,0 1500,50 1400,50"/><polygon class="ish-color" points="50,0 100,50 0,50"/><polygon class="ish-color" points="150,0 200,50 100,50"/><polygon class="ish-color" points="250,0 300,50 200,50"/><polygon class="ish-color" points="350,0 400,50 300,50"/><polygon class="ish-color" points="450,0 500,50 400,50"/><polygon class="ish-color" points="550,0 600,50 500,50"/><polygon class="ish-color" points="650,0 700,50 600,50"/><polygon class="ish-color" points="2350,0 2400,50 2300,50"/><polygon class="ish-color" points="2450,0 2500,50 2400,50"/><polygon class="ish-color" points="2550,0 2600,50 2500,50"/><polygon class="ish-color" points="2650,0 2700,50 2600,50"/><polygon class="ish-color" points="2750,0 2800,50 2700,50"/><polygon class="ish-color" points="2850,0 2900,50 2800,50"/><polygon class="ish-color" points="2900,50 2950,0 3000,50"/><polygon class="ish-color" points="1550,0 1600,50 1500,50"/><polygon class="ish-color" points="1650,0 1700,50 1600,50"/><polygon class="ish-color" points="1750,0 1800,50 1700,50"/><polygon class="ish-color" points="1850,0 1900,50 1800,50"/><polygon class="ish-color" points="1950,0 2000,50 1900,50"/><polygon class="ish-color" points="2050,0 2100,50 2000,50"/><polygon class="ish-color" points="2150,0 2200,50 2100,50"/><polygon class="ish-color" points="2250,0 2300,50 2200,50"/>' ),
		);

		if ( ! empty( $top_svg ) ) {
			$output .= '
				<div class="ish-row-decor-top">
					<svg
						width="' . $all_top_svgs[$top_svg][0] . '"
						height="' . $all_top_svgs[$top_svg][1] . '"
						version="1.1"
						viewBox="0 0 ' . str_replace("%", "", $all_top_svgs[$top_svg][0]) . ' ' . str_replace("%", "", $all_top_svgs[$top_svg][1]) . '"
						xmlns="http://www.w3.org/2000/svg"
						preserveAspectRatio="none">
						' . $all_top_svgs[$top_svg][2] . '
					</svg>
				</div>
			';
		}

		// All bottom svg decorations
		$all_bottom_svgs = array(
			'arrow-outside'         => array( '100',  '50', '<polygon class="ish-color" points="50,50 50,50 0,0 100,0"/>' ),
			'arrow-inside'          => array( '3000', '50', '<polygon class="ish-color" points="1553.5,50 1550.125,50 1500.125,0 1553.5,0 3000,0 3000,50 "/><polygon class="ish-color" points="1445.5,50 0,50 0,0 1445.5,0 1500.125,0 1450.125,50 "/>' ),
			'clouds-outside'        => array( '3000', '50', '<path class="ish-color" d="M3000,34.936v-9.908V0h-33.965h-135.468h-3.759h-40.207h-39.28h-187.726h-38.311h-71.023h-9.97h-124.308h-48.867h-77.52 h-26.205h-78.567h-69.046h-135.467h-3.76h-40.207h-39.281H1609.34h-38.31h-44.419h-36.575h-89.812h-26.205h-78.568h-69.046h-135.468 h-3.76h-40.206h-39.28H819.965h-38.309h-71.024h-9.969H576.355h-48.868h-77.519h-26.205h-78.568H276.15H140.684h-3.76H96.717H57.436 H0v46.792c32.231-5.817,61.784-19.327,86.707-38.548C90.755,8.74,94.877,9,99.059,9c13.856,0,27.058-2.805,39.066-7.875 c26.945,25.191,63.136,40.62,102.934,40.62c21.557,0,42.051-4.534,60.596-12.685C318.639,42.186,339.934,50,363.059,50 c33.938,0,63.943-16.82,82.143-42.579C462.639,12.355,481.04,15,500.059,15c14.724,0,29.071-1.598,42.895-4.604 C565.292,23.488,591.297,31,619.059,31c33.203,0,63.894-10.742,88.802-28.928C724.585,6.581,742.166,9,760.314,9 c10.033,0,19.893-0.746,29.531-2.165C824.079,33.864,867.311,50,914.314,50c46.176,0,88.707-15.58,122.646-41.756 C1041.009,8.74,1045.13,9,1049.313,9c13.856,0,27.057-2.805,39.066-7.875c26.946,25.191,63.136,40.62,102.934,40.62 c21.558,0,42.053-4.534,60.598-12.685C1268.893,42.186,1290.189,50,1313.314,50c33.937,0,63.942-16.82,82.143-42.579 c17.438,4.935,35.839,7.579,54.858,7.579c21.439,0,42.089-3.369,61.464-9.585C1524.057,7.759,1536.726,9,1549.688,9 c10.033,0,19.892-0.745,29.531-2.165C1613.452,33.864,1656.684,50,1703.688,50c46.175,0,88.707-15.58,122.646-41.756 c4.049,0.496,8.17,0.756,12.354,0.756c13.854,0,27.056-2.805,39.065-7.875c26.946,25.191,63.135,40.62,102.935,40.62 c21.557,0,42.051-4.534,60.596-12.685C2058.266,42.186,2079.563,50,2102.688,50c33.936,0,63.941-16.82,82.142-42.579 c17.438,4.935,35.839,7.579,54.858,7.579c14.723,0,29.071-1.598,42.894-4.604C2304.92,23.488,2330.924,31,2358.688,31 c33.202,0,63.891-10.742,88.8-28.928C2464.211,6.581,2481.792,9,2499.939,9c10.034,0,19.893-0.746,29.532-2.165 C2563.705,33.864,2606.938,50,2653.939,50c46.178,0,88.709-15.58,122.647-41.756c4.05,0.496,8.17,0.756,12.354,0.756 c13.854,0,27.056-2.805,39.065-7.875c26.946,25.191,63.137,40.62,102.935,40.62c21.557,0,42.052-4.534,60.597-12.685 C2994.252,31.158,2997.075,33.119,3000,34.936z"/>' ),
			'clouds-inside'         => array( '3000', '50', '<path class="ish-color" d="M1980.688,8.255c-39.8,0-75.988,15.429-102.935,40.62c-12.01-5.07-25.211-7.875-39.065-7.875 c-4.184,0-8.305,0.26-12.354,0.756C1792.395,15.58,1749.862,0,1703.688,0h399c-23.125,0-44.422,7.814-61.404,20.939 C2022.737,12.789,2002.243,8.255,1980.688,8.255z"/><path class="ish-color" d="M2991.537,20.939c-18.545-8.15-39.04-12.686-60.597-12.686c-39.798,0-75.988,15.43-102.935,40.62 c-12.009-5.069-25.21-7.874-39.066-7.874c-4.183,0-8.304,0.26-12.353,0.756C2742.648,15.58,2700.118,0,2653.94,0 c-47.004,0-90.234,16.136-124.468,43.165c-9.64-1.419-19.498-2.165-29.533-2.165c-18.147,0-35.729,2.419-52.452,6.928 C2422.578,29.742,2391.89,19,2358.688,19c-27.764,0-53.768,7.512-76.106,20.604C2268.759,36.598,2254.41,35,2239.688,35 c-19.02,0-37.42,2.645-54.858,7.579C2166.629,16.82,2136.623,0,2102.688,0h551.252h0.002H3000v15.064 C2997.075,16.881,2994.252,18.842,2991.537,20.939z"/><path class="ish-color" d="M1191.313,8.255c-39.798,0-75.987,15.429-102.934,40.62c-12.009-5.07-25.21-7.875-39.066-7.875 c-4.183,0-8.304,0.26-12.352,0.756C1003.021,15.58,960.49,0,914.314,0h399c-23.125,0-44.422,7.814-61.404,20.939 C1233.365,12.789,1212.87,8.255,1191.313,8.255z"/><path class="ish-color" d="M1549.688,41c-12.962,0-25.631,1.241-37.908,3.585c-19.375-6.216-40.024-9.585-61.464-9.585 c-19.02,0-37.421,2.645-54.858,7.579C1377.257,16.82,1347.251,0,1313.314,0h390.371c-47.003,0-90.234,16.136-124.468,43.165 C1569.579,41.745,1559.721,41,1549.688,41z"/><path class="ish-color" d="M760.314,41c-18.148,0-35.729,2.419-52.454,6.928C682.952,29.742,652.262,19,619.059,19c-27.762,0-53.767,7.512-76.105,20.604C529.13,36.598,514.782,35,500.059,35c-19.019,0-37.42,2.645-54.857,7.579 C427.002,16.82,396.996,0,363.059,0h551.256c-47.004,0-90.235,16.136-124.469,43.165C780.207,41.746,770.348,41,760.314,41z"/><path class="ish-color" d="M241.059,8.255c-39.797,0-75.988,15.429-102.934,40.62C126.116,43.805,112.915,41,99.059,41 c-4.182,0-8.304,0.26-12.352,0.756C61.784,22.535,32.231,9.025,0,3.208V0h363.059c-23.125,0-44.42,7.814-61.404,20.939 C283.109,12.789,262.615,8.255,241.059,8.255z"/>' ),
			'curtain-outside'       => array( '3000', '50', '<path class="ish-color" d="M2284.773,0.001h-120.75c26.08,0,48.762,14.547,60.375,35.968C2236.014,14.548,2258.695,0.001,2284.773,0.001z"/><path class="ish-color" d="M2526.289,0.001h-120.75c26.078,0,48.76,14.547,60.375,35.968C2477.527,14.548,2500.209,0.001,2526.289,0.001z"/><path class="ish-color" d="M2164.023,0.001h-120.915c26.143,0,48.87,14.617,60.458,36.125C2115.154,14.618,2137.881,0.001,2164.023,0.001z"/><path class="ish-color" d="M2646.845,0.001h-120.556c26.008,0,48.635,14.467,60.277,35.793C2598.209,14.468,2620.838,0.001,2646.845,0.001z"/><path class="ish-color" d="M2405.539,0.001h-120.766c26.086,0,48.771,14.553,60.383,35.98C2356.768,14.554,2379.453,0.001,2405.539,0.001z"/><path class="ish-color" d="M1680.845,0.001h-120.557c26.008,0,48.636,14.467,60.278,35.793C1632.209,14.468,1654.837,0.001,1680.845,0.001z"/><path class="ish-color" d="M1801.595,0.001h-120.75c26.079,0,48.761,14.547,60.375,35.969C1752.833,14.548,1775.515,0.001,1801.595,0.001z"/><path class="ish-color" d="M1922.359,0.001h-120.765c26.085,0,48.77,14.553,60.382,35.98C1873.588,14.554,1896.273,0.001,1922.359,0.001z"/><path class="ish-color" d="M2043.108,0.001h-120.75c26.079,0,48.762,14.547,60.375,35.969C1994.348,14.548,2017.029,0.001,2043.108,0.001z"/><path class="ish-color" d="M2888.357,0.001h-120.763c26.085,0,48.771,14.553,60.382,35.98C2839.589,14.554,2862.273,0.001,2888.357,0.001z"/><path class="ish-color" d="M2767.595,0.001h-120.75c26.079,0,48.761,14.547,60.375,35.969C2718.833,14.548,2741.515,0.001,2767.595,0.001z"/><path class="ish-color" d="M3000,0.606c2.98-0.395,6.02-0.605,9.107-0.605H3000V0.606z"/><path class="ish-color" d="M3000,0.606V0.001h-111.643c26.08,0,48.762,14.547,60.375,35.969C2958.973,17.085,2977.814,3.55,3000,0.606z"/><path class="ish-color" d="M111.643,0.001H0v0.605C22.187,3.55,41.029,17.085,51.268,35.969C62.881,14.548,85.563,0.001,111.643,0.001z"/><path class="ish-color" d="M0,0.606V0.001h-9.108C-6.02,0.001-2.98,0.212,0,0.606z"/><path class="ish-color" d="M353.156,0.001h-120.75c26.078,0,48.76,14.547,60.375,35.968C304.395,14.548,327.076,0.001,353.156,0.001z"/><path class="ish-color" d="M473.712,0.001H353.156c26.008,0,48.635,14.467,60.277,35.792C425.076,14.468,447.705,0.001,473.712,0.001z"/><path class="ish-color" d="M232.407,0.001H111.643c26.084,0,48.77,14.553,60.381,35.98C183.637,14.554,206.32,0.001,232.407,0.001z"/><path class="ish-color" d="M956.891,0.001H835.975c26.144,0,48.871,14.617,60.459,36.125C908.021,14.618,930.749,0.001,956.891,0.001z"/><path class="ish-color" d="M1439.713,0.001h-120.557c26.008,0,48.635,14.467,60.277,35.792C1391.076,14.468,1413.703,0.001,1439.713,0.001z"/><path class="ish-color" d="M1319.156,0.001h-120.751c26.079,0,48.761,14.547,60.376,35.968C1270.395,14.548,1293.076,0.001,1319.156,0.001z"/><path class="ish-color" d="M1538.433,3.622V3.563C1545.298,1.258,1552.644,0,1560.287,0h-21.854h-76.866h-21.854c7.642,0,14.989,1.258,21.854,3.563 v0.059c16.486,5.585,30.164,17.256,38.347,32.347c0.028-0.052,0.059-0.103,0.087-0.155c0.028,0.053,0.061,0.104,0.088,0.155 C1508.268,20.878,1521.948,9.207,1538.433,3.622L1538.433,3.622z"/><path class="ish-color" d="M1198.406,0.001h-120.766c26.086,0,48.771,14.553,60.383,35.98C1149.635,14.554,1172.32,0.001,1198.406,0.001z"/><path class="ish-color" d="M715.225,0.001H594.462c26.085,0,48.771,14.553,60.382,35.98C666.456,14.554,689.141,0.001,715.225,0.001z"/><path class="ish-color" d="M594.462,0.001h-120.75c26.079,0,48.761,14.547,60.375,35.968C545.7,14.548,568.382,0.001,594.462,0.001z"/><path class="ish-color" d="M835.975,0.001h-120.75c26.08,0,48.762,14.547,60.375,35.968C787.215,14.548,809.896,0.001,835.975,0.001z"/><path class="ish-color" d="M1077.641,0.001h-120.75c26.08,0,48.762,14.547,60.375,35.968C1028.881,14.548,1051.563,0.001,1077.641,0.001z"/>' ),
			'curtain-inside'        => array( '3000', '50', '<path class="ish-color" d="M2888.357,50c-26.084,0-48.769-14.553-60.381-35.98C2816.366,35.447,2793.68,50,2767.595,50 c-26.08,0-48.762-14.547-60.375-35.969C2695.605,35.453,2672.924,50,2646.845,50c-26.007,0-48.636-14.467-60.278-35.793 C2574.924,35.533,2552.297,50,2526.289,50c-26.08,0-48.762-14.547-60.375-35.968C2454.299,35.453,2431.617,50,2405.539,50 c-26.086,0-48.771-14.553-60.383-35.98C2333.544,35.447,2310.859,50,2284.773,50c-26.078,0-48.76-14.547-60.375-35.968 C2212.785,35.453,2190.104,50,2164.023,50c-26.143,0-48.869-14.617-60.457-36.125C2091.979,35.383,2069.251,50,2043.108,50 c-26.079,0-48.761-14.547-60.375-35.969C1971.12,35.453,1948.438,50,1922.358,50c-26.085,0-48.771-14.553-60.382-35.98 C1850.365,35.447,1827.68,50,1801.595,50c-26.08,0-48.762-14.547-60.375-35.969C1729.605,35.453,1706.924,50,1680.845,50 c-26.008,0-48.636-14.467-60.278-35.793C1608.924,35.533,1586.296,50,1560.288,50c-7.642,0-14.989-1.258-21.853-3.563v-0.06 c-16.487-5.585-30.166-17.256-38.347-32.349c-0.027,0.053-0.06,0.104-0.088,0.156c-0.028-0.052-0.059-0.103-0.087-0.154 c-8.182,15.091-21.861,26.762-38.347,32.347v0.06c-6.866,2.305-14.212,3.563-21.854,3.563c-26.01,0-48.637-14.467-60.28-35.793 C1367.791,35.533,1345.164,50,1319.156,50c-26.08,0-48.762-14.547-60.375-35.968C1247.166,35.453,1224.484,50,1198.405,50 c-26.085,0-48.771-14.553-60.381-35.98C1126.412,35.447,1103.727,50,1077.641,50c-26.078,0-48.76-14.547-60.375-35.968 C1005.653,35.453,982.971,50,956.891,50c-26.142,0-48.869-14.617-60.457-36.125C884.846,35.383,862.119,50,835.975,50 c-26.078,0-48.76-14.547-60.375-35.969C763.987,35.453,741.305,50,715.225,50c-26.084,0-48.769-14.553-60.381-35.98 C643.233,35.447,620.547,50,594.462,50c-26.08,0-48.762-14.547-60.375-35.969C522.473,35.453,499.791,50,473.712,50 c-26.007,0-48.636-14.467-60.279-35.793C401.791,35.533,379.164,50,353.156,50c-26.08,0-48.762-14.547-60.375-35.968 C281.166,35.453,258.484,50,232.406,50c-26.086,0-48.77-14.553-60.383-35.98C160.413,35.447,137.727,50,111.643,50 c-26.08,0-48.762-14.547-60.375-35.967C41.029,32.916,22.187,46.452,0,49.395V0h3000v49.393 c-22.186-2.941-41.028-16.477-51.268-35.361C2937.119,35.453,2914.438,50,2888.357,50z"/>' ),
			'rounded-outside'       => array( '100%',   '100%', '<path class="ish-color" d="M50,100c27.613,0,50-73,50-100H0C0,27,22.386,100,50,100z"/>' ),
			'rounded-inside'        => array( '100%',   '100%', '<path class="ish-color" d="M50,0h50v100C100,73,77.613,0,50,0z"/><path class="ish-color" d="M0,100V0h50C22.386,0,0,73,0,100z"/>' ),
			'slope-left'            => array( '100%',   '100%', '<polyline class="ish-color" points="100,0 0,100 0,0"/>' ),
			'slope-left-shadow'     => array( '100%',   '100%', '<polyline class="ish-color" points="100,0 0,100 0,0"/><polyline fill="rgba(0, 0, 0, 0.05)" points="0,50 0,100 100,0"/>' ),
			'slope-right'           => array( '100%',   '100%', '<polyline class="ish-color" points="0,0 100,100 100,0"/>' ),
			'slope-right-shadow'    => array( '100%',   '100%', '<polyline class="ish-color" points="0,0 100,100 100,0"/><polyline fill="rgba(0, 0, 0, 0.05)" points="100,50 100,100 0,0"/>' ),
			'triangle-outside'      => array( '100%',   '100%', '<polyline class="ish-color" points="100,0 0,0 50,100"/>' ),
			'triangle-inside'       => array( '100%',   '100%', '<polygon class="ish-color" points="0,100 50,0 0,0"/><polygon class="ish-color" points="50,0 100,100 100,0"/>' ),
			'zigzag'                => array( '3000', '50', '<polygon class="ish-color" points="750,50 800,0 700,0"/><polygon class="ish-color" points="850,50 900,0 800,0"/><polygon class="ish-color" points="950,50 1000,0 900,0"/><polygon class="ish-color" points="1050,50 1100,0 1000,0"/><polygon class="ish-color" points="1150,50 1200,0 1100,0"/><polygon class="ish-color" points="1250,50 1300,0 1200,0"/><polygon class="ish-color" points="1350,50 1400,0 1300,0"/><polygon class="ish-color" points="1450,50 1500,0 1400,0"/><polygon class="ish-color" points="50,50 100,0 0,0 	"/><polygon class="ish-color" points="150,50 200,0 100,0"/><polygon class="ish-color" points="250,50 300,0 200,0"/><polygon class="ish-color" points="350,50 400,0 300,0"/><polygon class="ish-color" points="450,50 500,0 400,0"/><polygon class="ish-color" points="550,50 600,0 500,0"/><polygon class="ish-color" points="650,50 700,0 600,0"/><polygon class="ish-color" points="2350,50 2400,0 2300,0"/><polygon class="ish-color" points="2450,50 2500,0 2400,0"/><polygon class="ish-color" points="2550,50 2600,0 2500,0"/><polygon class="ish-color" points="2650,50 2700,0 2600,0"/><polygon class="ish-color" points="2750,50 2800,0 2700,0"/><polygon class="ish-color" points="2850,50 2900,0 2800,0"/><polygon class="ish-color" points="2900,0 2950,50 3000,0"/><polygon class="ish-color" points="1550,50 1600,0 1500,0"/><polygon class="ish-color" points="1650,50 1700,0 1600,0"/><polygon class="ish-color" points="1750,50 1800,0 1700,0"/><polygon class="ish-color" points="1850,50 1900,0 1800,0"/><polygon class="ish-color" points="1950,50 2000,0 1900,0"/><polygon class="ish-color" points="2050,50 2100,0 2000,0"/><polygon class="ish-color" points="2150,50 2200,0 2100,0"/><polygon class="ish-color" points="2250,50 2300,0 2200,0"/>' ),
		);

		if ( ! empty( $bottom_svg )  ) {
			$output .= '
				<div class="ish-row-decor-bottom">
					<svg
						width="' . $all_bottom_svgs[$bottom_svg][0] . '"
						height="' . $all_bottom_svgs[$bottom_svg][1] . '"
						version="1.1"
						viewBox="0 0 ' . str_replace("%", "", $all_bottom_svgs[$bottom_svg][0]) . ' ' . str_replace("%", "", $all_bottom_svgs[$bottom_svg][1]) . '"
						xmlns="http://www.w3.org/2000/svg"
						preserveAspectRatio="none">
						' . $all_bottom_svgs[$bottom_svg][2] . '
					</svg>
				</div>
			';
		}
	}

	$output .= '<div class="ish-vc_row_inner">';
	$output .= wpb_js_remove_wpautop( do_shortcode($content) );
	$output .= '</div>';
	$output .= '</div>'.$this->endBlockComment('row');

	$ish_last_row_html = $output;

}

echo apply_filters( 'ishfreelotheme_vc_template_output', $output);