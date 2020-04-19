<?php

if ( ! function_exists( 'ishfreelotheme_framework_init' ) ) {
	function ishfreelotheme_framework_init() {

		global $pagenow;

		if ( is_admin() && isset($_GET['activated'] ) && "themes.php" == $pagenow ){
			flush_rewrite_rules();
			// header( 'Location: ' . esc_url( home_url( '/' ) ) . '/wp-admin/themes.php?page=optionsframework' );
		}

	}
}
add_action( 'init', 'ishfreelotheme_framework_init', 2 );

if ( ! function_exists( 'ishfreelotheme_options_enqueue_scripts' ) ) {
	function ishfreelotheme_options_enqueue_scripts() {

		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
		wp_enqueue_script('media-upload');

		wp_enqueue_style( 'wp-color-picker' );

		wp_register_style( 'ishfreelotheme_fontello', get_template_directory_uri() . '/assets/frontend/css/ish-fontello.css');
		wp_enqueue_style('ishfreelotheme_fontello');

		wp_register_style( 'ishfreelotheme_framework_styles', get_template_directory_uri() . '/assets/framework/css/framework-styles.css' );
		wp_enqueue_style('ishfreelotheme_framework_styles');

		wp_register_script( 'ishfreelotheme_upload', get_template_directory_uri() . '/assets/framework/js/upload.js', array('jquery','media-upload','thickbox') );
		wp_enqueue_script('ishfreelotheme_upload');

		if ( isset($_GET['page']) && isset($_GET['view']) && 'revslider' == $_GET['page'] && 'slide' == $_GET['view']) {
			include( get_template_directory() . '/assets/framework/css/revolution-styles.php' );
		}

		ishfreelotheme_output_theme_colors_css();

	}
}
add_action( 'admin_enqueue_scripts', 'ishfreelotheme_options_enqueue_scripts');



if ( ! function_exists( 'ishfreelotheme_enqueue_vc_scripts' ) ) {
	function ishfreelotheme_enqueue_vc_scripts() {

		wp_register_script( 'ishfreelotheme_vc', get_template_directory_uri() . '/assets/framework/js/vc.js', array('vc-backend-min-js'), false, true );
		wp_enqueue_script('ishfreelotheme_vc');

	}
}
add_action( 'admin_print_scripts', 'ishfreelotheme_enqueue_vc_scripts');


if( is_admin() )
{
	add_action( 'admin_print_scripts', 'ishfreelotheme_set_javascritp_paths');
}

/**
 * Hooks
 */
if ( ! function_exists( 'ishfreelotheme_meta_head' ) ) {
	function ishfreelotheme_meta_head() {
		do_action( 'ishfreelotheme_meta_head' );
	}
}

if ( ! function_exists( 'ishfreelotheme_register_after_title_area' ) ) {
	function ishfreelotheme_register_after_title_area() {
		global $post;

		echo '<div id="postbox-container-3" class="postbox-container ishyoboy-postbox-container">';
		echo '<div id="normal-sortables" class="meta-box-sortables ui-sortable">';

		do_meta_boxes( null, 'after_title', $post );

		echo '</div>';
		echo '</div>';

	}
}
add_action( 'edit_form_after_title', 'ishfreelotheme_register_after_title_area');