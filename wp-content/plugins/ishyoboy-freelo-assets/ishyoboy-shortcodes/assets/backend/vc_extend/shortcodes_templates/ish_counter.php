<?php

// Default SC attributes
$defaults = array(
	'el_text' => '',
	'tag_size' => '',
	'align' => '',
	'text_color' => '',
	'icon_color' => '',
	'duration' => '',
	'icon' => '',
	'additional_text' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_counter';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
//$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['icon_color'] ) ? ' ish-icon-' . esc_attr( $sc_atts['icon_color'] ) : '' ;
$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $sc_atts['tag_size'] ) ? ' ish-' . $sc_atts['tag_size'] : '';
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

$return .= ( '' != $sc_atts['duration'] ) ? ' data-duration="' . esc_attr( $sc_atts['duration'] )  . '"' : '';

$return .= '>';


$before = '';
$after = '';

// ICON
if ( '' != $sc_atts['icon'] ){
	$icon = '<span class="ish-icon"><span class="' . $sc_atts['icon'] . '"></span></span>';
	$before .= $icon;

}

// TEXT
if ( '' != $sc_atts['additional_text'] ){
	$text = '<span class="ish-additional-text">' . esc_attr( $sc_atts['additional_text'] ) . '</span>';
	$after .= $text;

}

// CONTENT
$return .= $before . '<span class="ish-counter">' . $sc_atts['el_text'] . '</span>' . $after;

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);