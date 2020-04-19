<?php

// Default SC attributes
$defaults = array(
	'form_id' => '',
	'title' => '',
	'color' => '',
	'text_color' => '',
	'bg_text_color' => '',
	'button_bg_color' => '',
	'button_text_color' => '',
	'border' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_cf7';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['bg_text_color'] ) ? ' ish-bg-text-' . esc_attr( $sc_atts['bg_text_color'] ) : '' ;
$class .= ( '' != $sc_atts['button_bg_color'] ) ? ' ish-button-bg-' . esc_attr( $sc_atts['button_bg_color'] ) : '' ;
$class .= ( '' != $sc_atts['button_text_color'] ) ? ' ish-button-text-' . esc_attr( $sc_atts['button_text_color'] ) : '' ;
$class .= ('yes' == $sc_atts['border'] ) ? ' ish-border' : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' != $sc_atts['style']){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= '"';
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

$return .= '>';

// CONTENT
global $wp_embed;
$return .= do_shortcode('[contact-form-7 id="' . $sc_atts['form_id'] . '" title="' . $sc_atts['title'] . '" ]');
// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);