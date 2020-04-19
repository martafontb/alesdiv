<?php

/**
 * Register all shortcodes into TinyMCE
 */
function ishfreelotheme_register_tinymce_buttons() {
	if ( current_user_can('edit_posts') || current_user_can('edit_pages') )
	{
		add_filter( 'mce_external_plugins', 'ishfreelotheme_add_plugin');
		add_filter( 'mce_buttons', 'ishfreelotheme_register_buttons');
	}
}
add_action( 'init', 'ishfreelotheme_register_tinymce_buttons');

function ishfreelotheme_add_plugin($plugin_array) {

	$plugin_array['ishyoboy_text_highlight'] = get_template_directory_uri() . '/assets/framework/js/tinymce.js';

	return $plugin_array;

}

function ishfreelotheme_register_buttons( $buttons ) {
	array_push( $buttons, "ishyoboy_color_palette" );
	return $buttons;
}


/*
 *  Adds a custom stylesheet to the tinymce editor.
 */
function ishfreelotheme_register_tinymce_editor_styles( $url ) {

	if ( !empty($url) )
		$url .= ',';

	$url .= get_template_directory_uri() . '/assets/framework/css/tinymce.css';

	return $url;

}
add_filter( 'mce_css', 'ishfreelotheme_register_tinymce_editor_styles' );

function ishfreelotheme_register_admin_tinymce_styles() {

	wp_register_style( 'ishfreelotheme-tinymce', get_template_directory_uri() . '/assets/framework/css/tinymce.css' );
	wp_enqueue_style( 'ishfreelotheme-tinymce' );

}
add_action( 'admin_init', 'ishfreelotheme_register_admin_tinymce_styles' );

if (! function_exists( 'ishfreelotheme_editor_colors_style') ) {
	function ishfreelotheme_editor_colors_style() {

		global $ishfreelotheme_options;

		echo '<style type="text/css">';

		for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ){

			if ( isset( $ishfreelotheme_options['color' . $i] ) ){
				// Necessary for the colored Drop Down Menu
				echo '.mce-ico.mce-i-ish-color_color' . $i . ':before { color: ' . $ishfreelotheme_options['color' . $i] . ";}\n";

				// Necessary for highlighting the text in Visual Composer elements
				echo '.ish-highlight.ish-text-color' . $i . '{ color: ' . $ishfreelotheme_options['color' . $i] . ";}\n";
				echo '.ish-highlight.ish-color' . $i . '{ background-color: ' . $ishfreelotheme_options['color' . $i] . ";}\n";
			}

		}

		echo '</style>' . "\n";

	}
}
add_action( 'admin_enqueue_scripts', 'ishfreelotheme_editor_colors_style');


if ( ! function_exists( 'ishfreelotheme_dynamic_editor_styles' ) ) {
	function ishfreelotheme_dynamic_editor_styles() {

		add_editor_style(
			array(
				add_query_arg( 'action', 'ishfreelotheme_editor_styles', admin_url( 'admin-ajax.php' ) ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'ishfreelotheme_dynamic_editor_styles' );


if ( ! function_exists( 'ishfreelotheme_editor_styles_callback' ) ) {
	function ishfreelotheme_editor_styles_callback() {

		global $ishfreelotheme_options;

		header("Content-type: text/css; charset: UTF-8");

		// Necessary for highlighting the text in the regular MCE Editor
		for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ){

			if ( isset( $ishfreelotheme_options['color' . $i] ) ){
				echo '.ish-highlight.ish-text-color' . $i . '{ color: ' . $ishfreelotheme_options['color' . $i] . ";}\n";
			}

		}

		for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ){

			if ( isset( $ishfreelotheme_options['color' . $i] ) ){
				echo '.ish-highlight.ish-color' . $i . '{ background-color: ' . $ishfreelotheme_options['color' . $i] . ";}\n";
			}

		}

		die();
	}
}

add_action( 'wp_ajax_ishfreelotheme_editor_styles', 'ishfreelotheme_editor_styles_callback' );
add_action( 'wp_ajax_nopriv_ishfreelotheme_editor_styles', 'ishfreelotheme_editor_styles_callback' ); //- Enable to be called in the front-end
