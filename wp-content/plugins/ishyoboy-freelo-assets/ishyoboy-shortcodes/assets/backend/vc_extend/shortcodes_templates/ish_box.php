<?php

// Global variables


// Default SC attributes
$defaults = array(
	'color' => '',
	'text_color' => '',
	'border_color' => '',
	'border_width' => '',
	'bg_opacity' => '',
	'inner_padding' => '',
	'stretch_box' => '',
	'align' => '',
	'bg_image'        => '',
	'bg_image_repeat' => '',
	'same_height' => '',
	'vertical_align' => '',
);
// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Handle the opacity number
if ( '' != $sc_atts['bg_opacity'] ) {

	if ( is_numeric( $sc_atts['bg_opacity'] ) ){
		if ( $sc_atts['bg_opacity'] > 100 ) { $sc_atts['bg_opacity'] = 100; }
		else if ( $sc_atts['bg_opacity'] < 0 ) { $sc_atts['bg_opacity'] = 0; }
		else if ( $sc_atts['bg_opacity'] > 0 && $sc_atts['bg_opacity'] < 1  ) { $sc_atts['bg_opacity'] = $sc_atts['bg_opacity'] * 100; }
	}
	else {
		$sc_atts['bg_opacity'] = '';
	}
}

// Handle BG image Classes
$el_class = '';
if ( '' != $sc_atts['bg_image'] && ( wp_get_attachment_url( $sc_atts['bg_image'], 'large' ) !== false ) ){
	$el_class .= 'ish-bgimage';
}

// Handle BG image Style
$bg_img_styles = $this->buildStyle($sc_atts['bg_image'], '', $sc_atts['bg_image_repeat'], '', '', '');

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_box';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['border_color'] ) ? ' ish-border-' . esc_attr( $sc_atts['border_color'] ) : '' ;
$class .= ( '0' == $sc_atts['inner_padding'] ) ? ' ish-zero-padding' : '' ;
$class .= ( '' == $sc_atts['stretch_box'] ) ? (' ish-fullwidth' ) : '' ;
$class .= ( 'yes' == $sc_atts['same_height'] ) ? (' ish-same-height' ) : '' ;
$class .= ( 'yes' == $sc_atts['same_height'] && '' != $sc_atts['vertical_align'] ) ? ' ish-has-valign ish-valign-' . $sc_atts['vertical_align'] : '';
$class .= ( '' != $sc_atts['align'] && '' != $sc_atts['stretch_box'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $el_class ) ? (' ' . $el_class) : '';
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';



// STYLE
if ( '' != $sc_atts['style'] || '' != $sc_atts['bg_opacity'] || '' != $sc_atts['inner_padding'] || '' != $bg_img_styles || '' != $sc_atts['border_width']){

	$return .= ' style="';

	// Remove the default BG color if row opacity set
	if ( '' != $sc_atts['bg_opacity'] && '' != $sc_atts['color'] ){
		$return .= ' background-color: transparent;';
	}

	// Set the inner padding
	if ( '' != $sc_atts['inner_padding']) {
		$sc_atts['inner_padding'] = $this->get_css_fields( $sc_atts['inner_padding'] );
		if ( '' != $sc_atts['inner_padding'] ) {
			$return .= ' padding: ' . esc_attr( $sc_atts['inner_padding'] ) . ';';
		}
	}

	// Border width
	if ( '' != $sc_atts['border_width'] ){
		$return .= ' border-width: ' . esc_attr($sc_atts['border_width']) .'px;';
	}

	// Add BG image styles
	if ( '' != $bg_img_styles ){
		$bg_img_styles = str_replace('style="', '', $bg_img_styles );
		$bg_img_styles = str_replace('"', '', $bg_img_styles );
		$return .= esc_attr( ' ' . trim( $bg_img_styles ) );
	}

	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= '"';
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;
$return .= '>';

if ( ( '' != $sc_atts['bg_opacity'] ) && '' != $sc_atts['color'] ){
	$o_class =  ( '' != $sc_atts['color']) ? ( ' ish-' . $sc_atts['color'] ) : '';
	$return .= '<div class="ish-box-overlay' . $o_class . '" style="opacity: ' . ( $sc_atts['bg_opacity'] / 100 ) . ';"></div>';
}

$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= '<div class="ish-box-inner">' . do_shortcode( $content ) . '</div>';

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);