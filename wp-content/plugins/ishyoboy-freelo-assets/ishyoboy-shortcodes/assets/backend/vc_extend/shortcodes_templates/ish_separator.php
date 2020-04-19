<?php

// Default SC attributes
$defaults = array(
	'type' => '',
	'separator_style' => '',
	'height' => '',
	'color' => '',
	'opacity_percent' => '',
	'width_percent' => '',
	// TEXT SEPARATOR
	'content' => '',
	'tag_size' => '',
	'align' => '',
	'icon' => '',
	'icon_align' => '',
	'tag' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Empty the unnecessary values based on the separator_type
switch ($sc_atts['type']){
	case 'text':

		foreach ( $sc_atts as $key => $val ){
			//if ( !in_array( $key, array( 'separator_style', 'color', 'opacity_percent', 'width_percent', 'content', 'tag_size', 'align', 'icon', 'icon_align', 'tag' ) ) )
			//	$sc_atts[$key] = '';
		}

		break;

	default :
		foreach ( $sc_atts as $key => $val ){
			//if ( ! in_array( $key, array( 'separator_style', 'color', 'opacity_percent', 'width_percent', 'content' ) ) )
			//	$sc_atts[$key] = '';
		}
}

// SHORTCODE BEGIN
$el_tag = ( 'h' == $sc_atts['tag'] ) ? $sc_atts['tag_size'] : $sc_atts['tag'];
$return = '';
$return .= '<' . $el_tag;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : '';

// STYLE for line for both types of separator ( simple and text )
$border_style = '';
if ( ( '' != $sc_atts['width_percent'] ) || ( '' != $sc_atts['opacity_percent'] ) || ( '' != $sc_atts['height'] ) ) {
	$border_style .= ( '' != $sc_atts['separator_style'] ) ? ' border-top-style: ' . esc_attr( $sc_atts['separator_style'] . '; ' ) : '';
	$border_style .= ( '' != $sc_atts['height'] ) ? ' border-top-width: ' . esc_attr( $sc_atts['height'] . 'px; border-bottom: none; height: auto;' ) : '';
	$border_style .= ( '' != $sc_atts['opacity_percent'] ) ? ' opacity: ' . esc_attr( $sc_atts['opacity_percent'] / 100 ) . '; ' : '';
}


if ( 'simple' == $sc_atts['type'] ) {
// SIMPLE SEPARATOR
	// CLASSES
	$class = 'ish-sc_separator';
	$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '';
	$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '';
	$class .= ( '' != $sc_atts['type'] ) ? ( ' ish-separator-' . $sc_atts['type'] ) : ' ish-separator-simple';
	$class .= ( '' != $sc_atts['separator_style'] ) ? ( ' ish-separator-' . $sc_atts['separator_style'] ) : ' ish-separator-solid';
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
	$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
	$return .= ' class="';
	$return .= apply_filters( 'ish_sc_classes', $class, $tag );
	$return .= '"';

	// STYLE
	if ( '' != $sc_atts['style'] || '' != $border_style  ) {
		$return .= ' style="';
		$return .= $border_style;
		$return .= ( '' != $sc_atts['width_percent'] ) ? ' width: ' . esc_attr( $sc_atts['width_percent'] ) . '%; ' : '';
		$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
		$return .= '"';
	}
	$return .= '>';
}
else {
// TEXT SEPARATOR
	// CLASSES
	$class = 'ish-sc_separator';
	$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '';
	$class .= ( '' != $sc_atts['color'] ) ? ' ish-text-' . esc_attr( $sc_atts['color'] ) : '';
	$class .= ( '' != $sc_atts['type'] ) ? ( ' ish-separator-' . $sc_atts['type'] ) : ' ish-separator-text';
	$class .= ( '' != $sc_atts['separator_style'] ) ? ( ' ish-separator-' . $sc_atts['separator_style'] ) : ' ish-separator-solid';
	$class .= ( '' != $sc_atts['align'] ) ? ( ' ish-' . $sc_atts['align'] ) : ' ish-no-align';
	$class .= ( '' != $sc_atts['icon_align'] && '' != $sc_atts['icon'] ) ? ( ' ish-icon-' . $sc_atts['icon_align'] ) : ' ish-no-icon';
	$class .= ( '' != $content ) ? ( ' ish-text' ) : '';
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
	$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
	$class .= ( 'div' == $sc_atts['tag'] ) ? ' ish-' . $sc_atts['tag_size'] : '';
	$return .= ' class="';
	$return .= apply_filters( 'ish_sc_classes', $class, $tag );
	$return .= '"';

	// STYLE
	if ( ( '' != $sc_atts['style'] ) || ( '' != $sc_atts['width_percent'] ) ) {
		$return .= ' style="';
		$return .= ( '' != $sc_atts['width_percent'] ) ? ' width: ' . esc_attr( $sc_atts['width_percent'] ) . '%; ' : '';
		$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
		$return .= '"';
	}

	$return .= '>';

	$before = '';
	$after  = '';

	// ICON
	if ( '' != $sc_atts['icon'] ) {
		$icon = '<span class="ish-icon' . ( ( '' != $sc_atts['icon_align'] ) ? ' ish-' . $sc_atts['icon_align'] : '' ) . '"><span class="' . $sc_atts['icon'] . '"></span></span>';

		if ( 'left' == $sc_atts['icon_align'] ) {
			$before .= $icon;
		} elseif ( 'right' == $sc_atts['icon_align'] ) {
			$after .= $icon;
		}
	}

	// STYLE for ish-line-border
	if ( '' != $border_style ) {
		$border_style = ' style="' . $border_style;
		$border_style .= '"';
	}

	// LINE LEFT
	$line_left = '<span class="ish-line ish-left"><span class="ish-line-border"' . $border_style . '></span></span>';


	// LINE RIGHT
	$line_right = '<span class="ish-line ish-right"><span class="ish-line-border"' . $border_style . '></span></span>';


	// CONTENT
	// $return .= $before . $sc_atts['el_text'] . $after;
	if ( '' != $content ) {
		$content = '<span class="ish-text">' . $content . '</span>';
	}
	$return .= $line_left . $before . $content . $after . $line_right;
}

// SHORTCODE END
$return .= '</' . $el_tag . '>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);