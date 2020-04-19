<?php

// Global variables
global $ish_tabs_navigation, $tabs__items_count, $ish_tabs_options, $ish_tabs_active_exists;

// Initialize value
if ( ! isset( $tabs__items_count ) ) {
	$tabs__items_count = 0;
}

$tabs__items_count++;

// Default SC attributes
$defaults = array(
	'tab_title' => '',
	'icon' => '',
	'icon_align' => '',
	'active' => '',

	'color' => '',
	'text_color' => '',
	'border_color' => '',
	'contents_color' => '',
	'contents_text_color' => '',
	'contents_border_color' => '',
);
// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Override Item settings with Parent ones if necessary
if ( '' == $sc_atts['color'] ) { $sc_atts['color'] = $ish_tabs_options['color']; }
if ( '' == $sc_atts['text_color'] ) { $sc_atts['text_color'] = $ish_tabs_options['text_color']; }
if ( '' == $sc_atts['border_color'] ) { $sc_atts['border_color'] = $ish_tabs_options['border_color']; }
if ( '' == $sc_atts['contents_color'] ) { $sc_atts['contents_color'] = $ish_tabs_options['contents_color']; }
if ( '' == $sc_atts['contents_text_color'] ) { $sc_atts['contents_text_color'] = $ish_tabs_options['contents_text_color']; }
if ( '' == $sc_atts['contents_border_color'] ) { $sc_atts['contents_border_color'] = $ish_tabs_options['contents_border_color']; }

// NO ACTIVE ITEM HANDLING
if ( 'yes' == $sc_atts['active'] ) { $ish_tabs_active_exists = true; }

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_tab';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( 'yes' == $sc_atts['active'] ) ? ' ish-active' : '';
$class .= ( '' == $ish_tabs_navigation ) ? ' ##ISH_ACTIVE##' : '';
$class .= ( '' != $sc_atts['contents_color'] ) ? ' ish-' . esc_attr( $sc_atts['contents_color'] ) : '' ;
$class .= ( '' != $sc_atts['contents_text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['contents_text_color'] ) : '' ;
$class .= ( '' != $sc_atts['contents_border_color'] ) ? ' ish-border-' . esc_attr( $sc_atts['contents_border_color'] ) : '' ;
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// TAB DEEPLINKING
if ( '' == $sc_atts['id'] ) {
	$sc_atts['id'] = '##ISH_TABS##' . 'tab-' . $tabs__items_count; // If you change this code also change tab navigation id code
}

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';


// STYLE
if ( '' != $sc_atts['style'] ){
	$return .= ' style="';

	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';

	$return .= '"';

}
$return .= '>';



$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );



// ICON
$before = '';
$after = '';
if ( '' != $sc_atts['icon'] ){

	if ( 'left' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $sc_atts['tab_title'] ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$before .= $icon;
	}
	elseif ( 'right' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $sc_atts['tab_title'] ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$after .= $icon;
	}
}

// ACTIVE Class
$class = ( 'yes' == $sc_atts['active'] ) ? ' ish-active' : '';
$class .= ( '' == $ish_tabs_navigation ) ? ' ##ISH_ACTIVE##' : '';
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['border_color'] ) ? ' ish-border-' . esc_attr( $sc_atts['border_color'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$ish_tabs_navigation .= '<li class="' . $class . '"';

// TOOLTIP
$ish_tabs_navigation .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;
$ish_tabs_navigation .= '>';

// TAB DEEPLINKING
$tab_deeplink = ( '' != $sc_atts['id'] ) ? '#' . esc_attr( $sc_atts['id'] ) : '#' . '##ISH_TABS##' . 'tab-' . $tabs__items_count; // If you change this code also change tab content id code

$ish_tabs_navigation .= '<a href="' . $tab_deeplink . '">' . $before . $sc_atts['tab_title'] . $after . '</a></li>';


// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);