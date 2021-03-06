<?php

// Default SC attributes
$defaults = array(
	'behavior' => '',
	'align' => '',
	'links' => '',
	'color' => '',
	'border' => '',
	'text_color' => '',
	'text_size' => '',
	'el_text' => '',
	'title_color' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );
$sc_atts['separator'] = ', ';

$terms = get_the_terms(  get_the_ID(), 'portfolio-category' );

if (isset($terms) && '' != $terms ) {

	// SHORTCODE BEGIN
	$return = '';
	$return .= '<div class="';

	// CLASSES
	$class = 'ish-sc_portfolio_categories';
	$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
	$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
	$class .= ( '' != $sc_atts['text_size'] ) ? ' ish-' . $sc_atts['text_size'] : '';
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

	// CATEGORIES TITLE:
	if ( '' != $sc_atts['el_text'] ){
		$return .=  '<span class="ish-categories-title';
		$return .= ( '' != $sc_atts['title_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['title_color'] ) : '' ;
		$return .=  '">';
		$return .=  esc_attr( $sc_atts['el_text'] );
		$return .=  '</span>';
	}




	// CONTENT
	$sc_atts['before'] = ''; //html_entity_decode( $sc_atts['before'] );
	$sc_atts['after'] = ''; //html_entity_decode( $sc_atts['after'] );

	$links_classes = '';

	if ( 'no' != $sc_atts['links'] && 'buttons' == $sc_atts['behavior'] ){
		$sc_atts['separator'] = '';
		$links_classes = 'ish-sc_button ish-small';
		$links_classes .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
		$links_classes .= ('no' != $sc_atts['border'] ) ? ' ish-border' : '' ;
		$links_classes .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
	}

	$i = 0;
	$count = count($terms);
	foreach ($terms as $term) {
		$i++;
		if ( 'no' != $sc_atts['links'] ){
			$return .= $sc_atts['before'] . '<a href="' . esc_attr(get_term_link($term)) . '" class="' . $links_classes . '">' . $term->name . '</a>' . $sc_atts['after'];
		}
		else{
			$return .= '<span class="ish-cat">' . $sc_atts['before'] . $term->name . $sc_atts['after'] . '</span>';
		}

		if( $i != $count ) {
			$return .= $sc_atts['separator'];
		}

	}

	// SHORTCODE END
	$return .= '</div>';

	echo apply_filters( 'ishfreelotheme_sc_template_output', $return);

}