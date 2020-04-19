<?php

// Global variables
global $slidable_count, $ishfreelotheme_options;
$slidable_count++;

// Default SC attributes
$defaults = array(
	'autoslide' => '',
	'animation' => '',
	'interval' => '',
	'navigation' => '',
	'prevnext' => '',
	'nav_color' => '',
	'prevnext_color' => '',
	'nav_align' => '',
	'nav_position' => '',
	'max_height' => '',
	'items_count' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

wp_enqueue_script( 'ishfreelotheme-flexslider' );
wp_enqueue_script( 'ishfreelotheme-owl-slider' );

// Add ID if empty
if ( empty( $sc_atts['id'] ) ){
	$sc_atts['id'] = 'ish-slidablesc-' . $slidable_count;
}

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_slidable ish-slidable ';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['nav_color'] ) ? ' ish-nav-' . esc_attr( $sc_atts['nav_color'] ) : '' ;
$class .= ( 'no' != $sc_atts['navigation'] ) ? ' ish-with-nav' : '' ;
$class .= ( '' != $sc_atts['prevnext_color'] ) ? ' ish-prevnext-' . esc_attr( $sc_atts['prevnext_color'] ) : '' ;
$class .= ( '' != $sc_atts['nav_align'] ) ? (' ish-nav-' . $sc_atts['nav_align'] ) : '' ;
$class .= ( 'no' != $sc_atts['navigation'] && '' != $sc_atts['nav_position'] ) ? (' ish-nav-pos-' . $sc_atts['nav_position'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $sc_atts['max_height'] && is_numeric( $sc_atts['max_height'] ) ) ? ' ish-max-height' : '';
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;

$class = apply_filters( 'ish_sc_classes', $class, $tag );
$return .= $class;
$return .= '"' ;

// MAX HEIGHT
$return .= ( '' != $sc_atts['max_height'] && is_numeric( $sc_atts['max_height'] ) ) ? ' data-maxheight="' . $sc_atts['max_height'] . '"' : '';

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' != $sc_atts['style'] ){
	$return .= ' style="';

	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';

	$return .= '"';

}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : '';
$return .= ( 'no' != $sc_atts['autoslide'] ) ? ' data-autoslide="yes"' : '';
$return .= ( 'fade' == $sc_atts['animation'] ) ? ' data-animation="fade"' : '';
$return .= ( '' != $sc_atts['interval'] ) ? ' data-interval="' . esc_attr( $sc_atts['interval'] ) . '"' : '';
$return .= ( 'no' == $sc_atts['navigation'] ) ? ' data-navigation="no"' : '';
$return .= ( 'no' == $sc_atts['prevnext'] ) ? ' data-prevnext="no"' : '';
$return .= ( '' != $sc_atts['items_count'] ) ? ' data-itemscount="' . $sc_atts['items_count'] . '"' : '';
$return .= '>';

$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);