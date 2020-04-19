<?php

global $ish_newdata;
global $options_machine;

// This is a list of 'keys' which will be removed from $ish_skin_data to keep user values
$keep_settings = Array(
	'social_icons', // Icons
	'use_page_for_404',
	'page_for_404',
	'addthis_share', // Icons
	'custom_css',
	'logo_as_image',
	'logo_image',
	'logo_retina_image',
	'logo_image_alternative',
	'logo_retina_image_alternative',
	'social_icons_bar', // Icons
	'footer_legals_area',
	'page_for_custom_post_type_portfolio-post',
	'slug_portfolio',
	'google_font_subsets',
	'twitter_widget_consumer_key',
	'twitter_widget_consumer_secret',
	'twitter_widget_access_token',
	'twitter_widget_access_token_secret',
	'dribbble_access_token',
	'plugin_sc_enable_vc_shortcodes',
	'header_bar_menu',

);

// The default values are loaded into $ish_skin_data
$ish_skin_data = Array();
$ish_skin_data = $options_machine->Defaults;

// Remove array fields based on $keep_settings array. This will keep their user set value.
foreach ( $keep_settings as $key ){
	if ( isset( $ish_skin_data[$key] ) ){
		unset( $ish_skin_data[$key] );
	};
}