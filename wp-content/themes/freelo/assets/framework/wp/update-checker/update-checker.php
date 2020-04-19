<?php


/**
 * Action to enable module's functionality
 */
function freelo_update_checker_setup() {

	// Only run it if in WordPress back-end.
	if ( is_admin() ) {
		require get_template_directory() . '/assets/framework/wp/update-checker/updater/theme-updater.php';
	}

}
add_action( 'after_setup_theme', 'freelo_update_checker_setup' );
