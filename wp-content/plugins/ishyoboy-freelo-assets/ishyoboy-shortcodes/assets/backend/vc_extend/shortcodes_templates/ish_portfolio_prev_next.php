<?php

// Default SC attributes
$defaults = array(
	'color' => '',
	'text_color' => '',
	'align' => '',
	'prev_text' => '',
	'next_text' => '',
	'border' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_portfolio_prev_next';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
//$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
//$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
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


// CONTENT
$nav_next = get_permalink( get_adjacent_post( false, '', false ) );
$nav_prev = get_permalink( get_adjacent_post( false, '', true ) );

// PREV
$return .= '<div class="ish-portfolio-next-link"><a class="ish-sc_button ish-small' .
	(( get_permalink() == $nav_next ) ? ' ish-disabled-link' : '') .
	(('' != $sc_atts['color']) ? ' ish-' . esc_attr($sc_atts['color']) : '') .
	(('' != $sc_atts['text_color']) ? ' ish-text-' . esc_attr($sc_atts['text_color']) : '') .
	(('no' != $sc_atts['border'] ) ? ' ish-border' : '') .
	'" href="' . esc_attr($nav_next) . '">' . ( ('' != $sc_atts['next_text']) ? $sc_atts['next_text'] : ( '<span class="ish-icon ish-left"><span class="ish-icon-angle-double-left"></span></span>' . esc_html__( 'Next', 'ishyoboy_assets' ) ) ) . '</a></div>';

// NEXT
$return .= '<div class="ish-portfolio-prev-link"><a class="ish-sc_button ish-small' .
	(( get_permalink() == $nav_prev ) ? ' ish-disabled-link' : '') .
	(('' != $sc_atts['color']) ? ' ish-' . esc_attr($sc_atts['color']) : '') .
	(('' != $sc_atts['text_color']) ? ' ish-text-' . esc_attr($sc_atts['text_color']) : '') .
	(('no' != $sc_atts['border'] ) ? ' ish-border' : '') .
	'" href="' . esc_attr($nav_prev) . '">' . (('' != $sc_atts['prev_text']) ? $sc_atts['prev_text'] : ( esc_html__( 'Previous', 'ishyoboy_assets' ) . '<span class="ish-icon ish-right"><span class="ish-icon-angle-double-right"></span></span>' ) ) . '</a></div>';


// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);