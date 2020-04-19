<?php

// Default SC attributes
$defaults = array(
	'color' => '',
	'back_color' => '',
	'text_color' => '',
	'text_size' => '',

	'percent' => '0',
	'align' => '',
	'icon' => '',
	'icon_align' => '',
	'line_width' => '',
	'rounded' => 'no',
	'size' => '',
	'animation_time' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

wp_enqueue_script( 'ishfreelotheme-easy_pie_chart' );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

$sc_atts['bar_color'] = ishfreelotheme_colors_to_hex($sc_atts['color']);
$sc_atts['track_color'] = ishfreelotheme_colors_to_hex($sc_atts['back_color']);

// CLASSES
$class = 'ish-sc_chart';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['align'] ) ? ( ' ish-' . $sc_atts['align'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// CHART DATA
$return .= ( '' != $sc_atts['percent'] ) ? ' data-percent="' . esc_attr( $sc_atts['percent'] ) . '"' : '';
$return .= ( '' != $sc_atts['line_width'] ) ? ' data-linewidth="' . esc_attr( $sc_atts['line_width'] ) . '"' : '';
$return .= ( 'yes' == $sc_atts['rounded'] ) ? ' data-linecap="round"' : '';
$return .= ( '' != $sc_atts['size'] ) ? ' data-size="' . esc_attr( $sc_atts['size'] ) . '"' : '';
$return .= ( '' != $sc_atts['bar_color'] ) ? ' data-barcolor="' . esc_attr( $sc_atts['bar_color'] ) . '"' : '';
$return .= ( '' != $sc_atts['track_color'] ) ? ' data-trackcolor="' . esc_attr( $sc_atts['track_color'] ) . '"' : '';
$return .= ( '' != $sc_atts['animation_time'] ) ? ' data-animate="' . esc_attr( (float)( $sc_atts['animation_time'] ) * 1000) . '"' : '';

// ID
$sc_atts['text_size'] = str_replace('px', '', $sc_atts['text_size']);

// STYLE
if ( '' != $sc_atts['style'] || '' != $sc_atts['text_size']){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= ( '' != $sc_atts['text_size'] ) ? ' font-size:' . esc_attr( $sc_atts['text_size'] ) . 'px;' : '';
	$return .= '"';
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : '';

$return .= '>';

$before = '';
$after = '';

// ICON
if ( '' != $sc_atts['icon'] ){

	if ( 'left' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $content ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$before .= $icon;
	}
	elseif ( 'right' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $content ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$after .= $icon;
	}
}

// CONTENT
$return .= '<div class="ish-chart-inner"';
if ( '' != $sc_atts['text_size']){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['text_size'] ) ? ' font-size:' . esc_attr( $sc_atts['text_size'] ) . 'px;' : '';
	$return .= ( '' != $sc_atts['line_width'] ) ? ' padding: 0 ' . esc_attr( $sc_atts['line_width'] ) . 'px 0 ' . esc_attr( $sc_atts['line_width'] ) . 'px;' : '';
	$return .= '"';
}
$return .= '>';

$return .= $before . $content . $after;
$return .= '</div>';

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);