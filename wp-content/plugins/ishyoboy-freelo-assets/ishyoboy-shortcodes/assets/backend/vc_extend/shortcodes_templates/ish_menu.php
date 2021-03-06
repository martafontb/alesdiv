<?php

// Default SC attributes
$defaults = array(
	'menu' => '',
	'depth' => '',
	'color' => '',
	'text_color' => '',
	'active_bg_color' => '',
	'active_text_color' => '',
	'menu_style' => '',
	'icons' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_menu';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['menu_style'] ) ? ' ish-style-' . esc_attr( $sc_atts['menu_style'] ) : ' ish-style-text' ;
$class .= ( 'no' == $sc_atts['icons'] ) ? ' ish-no-icons' : '' ;
$class .= ( '' != $sc_atts['active_bg_color'] ) ? ' ish-block-bg-' . esc_attr( $sc_atts['active_bg_color'] ) : ' ish-no-active-bg' ;
$class .= ( '' != $sc_atts['active_text_color'] ) ? ' ish-block-text-' . esc_attr( $sc_atts['active_text_color'] ) : ' ish-no-active-text' ;
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

$content = wp_nav_menu(
	array(
		'menu' => $sc_atts['menu'],
		'depth' => $sc_atts['depth'],
		'echo' => false
	)
);

// CONTENT
$return .= do_shortcode( $content );

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);