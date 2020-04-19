<?php

// Default SC attributes
$defaults = array(
	'align' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';

global $ishfreelotheme_options;

if ( isset( $ishfreelotheme_options['addthis_share'] ) && '' != $ishfreelotheme_options['addthis_share'] ){

	$return .= '<div class="';

	// CLASSES
	$class = 'ish-sc_social_share ish-sc_global_iconic_box';
	$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
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
	$content = str_replace( '##CURRENT_PAGE##', urlencode( get_permalink() ) , $ishfreelotheme_options['addthis_share']);
	$return .= str_replace(array("\r\n", "\n", "\r", "<br />", "<br>"), '', $content);

	// SHORTCODE END
	$return .= '</div>';
}

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);