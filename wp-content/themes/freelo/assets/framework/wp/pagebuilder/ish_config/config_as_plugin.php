<?php

global $vc_manager;
$ish_supported_vc_version = '5.6';

// Load the admin notices functionality functions
require_once( get_template_directory() . '/assets/framework/wp/pagebuilder/ish_config/admin_notices.php' );

/**
 * Load VC from Theme or Plugin
 */
if ( isset( $vc_manager ) && is_object( $vc_manager ) ){
	// Add notices
	if ( ( version_compare( WPB_VC_VERSION, $ish_supported_vc_version) === -1 ) ) {
		add_action( 'admin_notices', 'ishfreelotheme_old_vc_version_notice' );
	}
	else if ( ( version_compare( WPB_VC_VERSION, $ish_supported_vc_version) === 1 ) ) {
		add_action( 'admin_notices', 'ishfreelotheme_new_vc_version_notice' );
	}
}


/**
 * Activate VC from Theme callback
 */
if ( ! function_exists( 'ishfreelotheme_activate_vc_from_theme' ) ){
	function ishfreelotheme_activate_vc_from_theme() {
		define( 'ISHFREELOTHEME_PAGEBUILDER', true);
	}
}
add_action( 'after_setup_theme', 'ishfreelotheme_activate_vc_from_theme', 9 );

/**
 * Update Visual Composer settings once loaded.
 */
if ( ! function_exists( 'ishfreelotheme_vc_set_shortcodes_templates_dir' ) ){
	function ishfreelotheme_vc_set_shortcodes_templates_dir() {

		// Set Default Post Types
		vc_set_default_editor_post_types( array(
				'page',
				'post',
				'portfolio-post',
				'templatera' )
		);

		// Force Visual Composer to initialize as "built into the theme".
		vc_set_as_theme( true ); // add "true" to disable the automatic updater

		//Disable Frontend Editor
		vc_disable_frontend();


		// Remove the default Layout Templates List
		if ( ! function_exists( 'ishfreelotheme_vc_load_default_templates' ) ){
			function ishfreelotheme_vc_load_default_templates( $data ) {
				return array(); // This will remove all default templates
			}
		}
		add_filter( '', 'ishfreelotheme_vc_load_default_templates' );

	}
}
add_action( 'vc_before_init', 'ishfreelotheme_vc_set_shortcodes_templates_dir' );

if ( ! function_exists( 'ishyoboy_disable_vc_g' ) ) {
	function ishyoboy_disable_vc_g() {
		if ( ! get_option( '_ish_gutenberg_disabled_onetime', false ) ) {
			update_option( 'wpb_js_gutenberg_disable', true );
			update_option( '_ish_gutenberg_disabled_onetime', true );
		}
	}
}
add_action( 'vc_activation_hook', 'ishyoboy_disable_vc_g' );

// Disable redirect on activation.
remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
remove_action( 'admin_init', 'vc_page_welcome_redirect' );
