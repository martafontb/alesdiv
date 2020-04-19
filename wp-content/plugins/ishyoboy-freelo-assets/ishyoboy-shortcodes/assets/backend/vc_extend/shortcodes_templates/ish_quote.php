<?php

// Default SC attributes
$defaults = array(
	'author' => '',
	'color' => '',
	'align' => '',
	'size' => '',
	'url' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<blockquote class="';

// CLASSES
$class = 'ish-sc_quote';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['size'] ) ? ' ish-' . esc_attr( $sc_atts['size'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
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

// AUTHOR + URL
$url_data = vc_build_link( $sc_atts['url'] );


$author = '';
if ( '' != $sc_atts['author'] ) {


	if ( '' != $url_data['url'] ) {
		$author = '<cite class="ish-a">';
		$author .= '<a href="' . esc_attr( apply_filters( 'ishfreelotheme_sc_url', $url_data['url'] ) ) . '"';
		$author .= ( false !== strpos( $url_data['target'], '_blank') ) ? ' target="_blank"' : '';
		$author .= '>';
	}
	else{
		$author = '<cite>';
	}

	$author .= $sc_atts['author'];
	$author .= ( '' != $url_data['url'] ) ? '</a>' : '';
	$author .= '</cite>';
}

// CONTENT

// Fix paragraphs if present to generate valid html
if ( false !== strpos( $content, '<p>' ) ) {
	$content = 	wpautop( $content );
}

$return .= do_shortcode( $content );
$return .= $author;

// SHORTCODE END
$return .= '</blockquote>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);