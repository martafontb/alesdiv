<?php

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $atts, $atts );

$integrated_atts = '';
$icon_output = '';

if ( '' !== $sc_atts['add_icon'] ){
	// The text block has an icon or svg icon attached

	switch ( $sc_atts['add_icon'] ){
		case 'icon' :

			$integrated_tag = 'ish_icon';
			$integrated_atts = ishfreelotheme_filter_array( $sc_atts, 'i_' );
			global $shortcode_tags;
			$icon_output = call_user_func( $shortcode_tags[ $integrated_tag ], $integrated_atts, null, $integrated_tag );

			break;
		case 'svg' :

			$integrated_tag = 'ish_svg_icon';
			$integrated_atts = ishfreelotheme_filter_array( $sc_atts, 'svgi_' );
			global $shortcode_tags;
			$icon_output = call_user_func( $shortcode_tags[ $integrated_tag ], $integrated_atts, null, $integrated_tag );

			break;
	}
}
else{
	// No icon - simple text block
}

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_icon_text';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-text-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
$class .= ( '' != $sc_atts['vertical_align'] ) ? ' ish-valign-' . $sc_atts['vertical_align'] : '';
$class .= ( '' != $sc_atts['responsive_center'] ) ? ' ish-resp-keep' : ' ish-resp-move';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $icon_output ) ? ' ish-with-icon' : '';
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' != $sc_atts['style'] ){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= '"';
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

$return .= '>';

// CONTENT
$return .= '<div class="ish_wrapper">';

if ( '' != $icon_output ){
	if ( 'right' != $sc_atts['align'] ) {
		// left and center aligned
		$return .= '<div class="ish-it-icon">' . $icon_output . '</div>';
	}
	$return .= '<div class="ish-it-text">' . wpb_js_remove_wpautop( $content, true ) . '</div>';
	if ( 'right' == $sc_atts['align'] ) {
		// right aligned
		$return .= '<div class="ish-it-icon">' . $icon_output . '</div>';
	}
}
else{
	$return .= wpb_js_remove_wpautop( $content, true );
}

$return .= '</div>';

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);