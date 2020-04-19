<?php

/**
 * Unlike style.css, the functions.php of a child theme does not override its counterpart from the parent.
 * Instead, it is loaded in addition to the parent's functions.php. (Specifically, it is loaded right before the parent's file.)
 *
 * Read more: http://codex.wordpress.org/Child_Themes
 */


/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
 /*
function freelo_child_theme_setup() {
	load_child_theme_textdomain( 'freelo-child', get_stylesheet_directory() . '/language' );
}
add_action( 'after_setup_theme', 'freelo_child_theme_setup' );
*/


/**
 * Register a new child-theme CSS
 *
 * Register a new child-theme stylesheet which will be loaded after the dynamically generated colors and Fonts CSS
 * from the parent theme (main-options.css). It will however be loaded before the CSS generated from the
 * Custom CSS field in the administration.
 *
 * The priority 11 of the filter makes it load after all CSS as they are loaded with the default priority of 10
 *
 */
function freelo_child_theme_enqueue_scripts(){
	wp_register_style( "child-theme-css", get_stylesheet_directory_uri() . "/child-theme.css");
	wp_enqueue_style(  "child-theme-css" );
	wp_register_style( "fontello-css", get_stylesheet_directory_uri() . "/plugins/css/fontello.css");
	wp_enqueue_style(  "fontello-css" );
	wp_register_style( "fontello-ie7", get_stylesheet_directory_uri() . "/plugins/css/fontello-ie7.css");
	wp_enqueue_style(  "fontello-ie7" );
	wp_register_style( "fontello-ie7-codes", get_stylesheet_directory_uri() . "/plugins/css/fontello-ie7-codes.css");
	wp_enqueue_style(  "fontello-ie7-codes" );
	wp_register_style( "fontello-ie7-embedded", get_stylesheet_directory_uri() . "/plugins/css/fontello-embedded.css");
	wp_enqueue_style(  "fontello-ie7-embedded" );
	wp_register_style( "fontello-codes", get_stylesheet_directory_uri() . "/plugins/css/fontello-codes.css");
	wp_enqueue_style(  "fontello-codes" );
	wp_register_style( "fontello-animation", get_stylesheet_directory_uri() . "/plugins/css/animation.css");
	wp_enqueue_style(  "fontello-animation" );
}
add_action( "wp_enqueue_scripts", "freelo_child_theme_enqueue_scripts", 11);


/* Add any custom code from here */
function al_body_class($classes) {
    $classes[] = 'al-sk';
    return $classes;
}

add_filter('body_class', 'al_body_class');
