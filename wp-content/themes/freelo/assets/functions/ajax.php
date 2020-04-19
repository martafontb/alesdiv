<?php

/**
 * Import the demo data from the demo-content.xml file
 */
if ( ! function_exists( 'ishfreelotheme_ajax_demo_import' ) ) {
	function ishfreelotheme_ajax_demo_import()
	{

		global $demo_data_file, $demo_imported;

		// Die if nonce is invalid
		check_ajax_referer( 'ishfreelotheme_demo_import_nonce' );

		// Necessary to get the file which should be imported
		if ( isset($_POST['demo_content']) && false !== strpos( $_POST['demo_content'], 'theme_') ){
			$demo_data_file = $_POST['demo_content'];
		};

		// Necessary to check waht acrtion to do
		$demo_imported = ( isset($_POST['import_done']) && 'true' === $_POST['import_done'] ) ? true : false;

		ob_start();
		require_once( get_template_directory() . '/assets/framework/wp/importer/config.php' );
		$output = ob_get_contents();
		ob_end_clean();

		$success = false;

		if ( !$demo_imported && false !== strpos( $output, 'All done.' ) ) {
			wp_send_json_success(
				array(
					'demo_data_imported' => true,
					'_ajax_nonce' => wp_create_nonce('ishfreelotheme_demo_import_nonce')
				)
			);
		}
		else{
			if ( $demo_imported ){
				wp_send_json_success(
					array(
						'demo_data_after_import_done' => true,
						'_ajax_nonce' => wp_create_nonce('ishfreelotheme_demo_import_nonce')
					)
				);
			}
			die( $output );
		}

	}

	add_action( 'wp_ajax_ishfreelotheme_ajax_demo_import', 'ishfreelotheme_ajax_demo_import' );
}
