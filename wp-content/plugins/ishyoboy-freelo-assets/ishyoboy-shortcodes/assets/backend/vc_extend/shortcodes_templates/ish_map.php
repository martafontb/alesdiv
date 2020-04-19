<?php

// Global variables
global $map_count, $ishfreelotheme_options;
$map_count++;

// Default SC attributes
$defaults = array(
	'color' => '',
	'zoom' => '15',
	'map_effect' => '',
	'height' => '',
	'ignore_height' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Add ID if empty as it is necessary for Google Maps to work
if ( empty( $sc_atts['id'] ) ){
	$sc_atts['id'] = 'ish-gmap-' . $map_count;
}

// Make sure to include the scripts for Google Maps and the Generation of the marker infoboxes on click
wp_enqueue_script( 'ishfreelotheme-gmaps' );

// Convert color class to color value
if ( isset( $ishfreelotheme_options[ $sc_atts['color'] ] ) ){
	$sc_atts['color'] = $ishfreelotheme_options[ $sc_atts['color'] ];
}

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="' . apply_filters( 'ish_sc_classes', 'ish-sc_map_container', $tag ) . '"><div class="';

// CLASSES
$class = 'ish-sc_map';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( 'no' != $sc_atts['ignore_height'] ) ? ' ish-ignore-height' : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
//$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= $class;
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' != $sc_atts['style'] || '' != $sc_atts['height']  ){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['height'] ) ? ' height: ' . esc_attr( $sc_atts['height'] ) . 'px;' : '';
	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= '"';

}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

$return .= ( '' != $sc_atts['zoom'] ) ? ' data-zoom="' . esc_attr( $sc_atts['zoom'] ) . '"' : ''  ;
$return .= ( 'inverted' == $sc_atts['map_effect'] ) ? ' data-invert="' . esc_attr( $sc_atts['map_effect'] ) . '"' : ''  ;
$return .= ( 'grayscale' == $sc_atts['map_effect'] ) ? ' data-grayscale="' . esc_attr( $sc_atts['map_effect'] ) . '"' : ''  ;
$return .= ( '' != $sc_atts['color'] ) ? ' data-color="' . esc_attr( $sc_atts['color'] ) . '"' : '' ;
$return .= '>';

$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );

// SHORTCODE END
$return .= '</div></div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);