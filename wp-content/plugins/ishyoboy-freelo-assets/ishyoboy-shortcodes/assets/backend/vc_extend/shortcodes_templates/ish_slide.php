<?php

// Default SC attributes
$defaults = array(
	'bg_image'        => '',
	'bg_image_repeat' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

$el_class = '';
if ( '' != $sc_atts['bg_image'] && ( wp_get_attachment_url( $sc_atts['bg_image'], 'large' ) !== false ) ){
	$el_class .= ' ish-bgimage';
}

$style = $this->buildStyle($sc_atts['bg_image'], '', $sc_atts['bg_image_repeat'], '', '', '');

if ( ! empty( $style )  ){
	$sc_atts['style'] = str_replace( 'style="', ' style="' . esc_attr( $sc_atts['style'] ) . ' ', $style );
} else{
	if ( ! empty( $sc_atts['style'] )  ) {
		$sc_atts['style'] = ' style="' . esc_attr( $sc_atts['style'] ) . '"';
	}
}


// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_slide ish-slide ish-slide-content';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $el_class ) ? (' ' . $el_class) : '';
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';


// STYLE
if ( '' != $sc_atts['style'] ){
	$return .= $sc_atts['style'];
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;
$return .= '>';

$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);