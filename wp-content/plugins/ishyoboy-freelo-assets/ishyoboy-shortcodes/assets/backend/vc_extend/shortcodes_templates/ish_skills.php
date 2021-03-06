<?php

// Global variables
global $ish_skills_options;

// Default SC attributes
$defaults = array(
	'color' => '',
	'skill_color' => '',
	'text_color' => '',
	'outside' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Set upd Global variable for inner shortcodes
$ish_skills_options= Array(
	'outside' => $sc_atts['outside'],
	'color' => $sc_atts['color'],
	'skill_color' => $sc_atts['skill_color'],
	'text_color' => $sc_atts['text_color'],
);

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_skills';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
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

$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= $content;

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);