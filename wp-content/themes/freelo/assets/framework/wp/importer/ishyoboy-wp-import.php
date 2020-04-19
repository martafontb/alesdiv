<?php
class Ishyoboy_WP_Import extends WP_Import
{
	function set_menus()
	{

		global $ish_current_demo;

		$to_set = Array();
		$to_set['header-menu'] = 'main-navigation'; // Menu location slug => The default menu slug (for the importer) to be assigned to this location

		// Set the pages for each demo
		switch ( $ish_current_demo ){
			case 'theme_agency':
				$to_set['header-menu'] = 'main-navigation';
				break;
			case 'theme_freelance':
				$to_set['header-menu'] = 'main-navigation';
				break;
			case 'theme_eshop':
				$to_set['header-menu'] = 'main-navigation';
				break;
			case 'theme_minimal':
				$to_set['header-menu'] = 'main-navigation';
				break;
			case 'theme_vintage':
				$to_set['header-menu'] = 'main-navigation';
				break;
			default:
				$to_set['header-menu'] = 'main-navigation';
		}

		// get all registered menu locations
		$locations = get_theme_mod('nav_menu_locations');

		// get all registered menus
		$theme_menus  = wp_get_nav_menus();

		if ( ! empty( $theme_menus ) && ! empty( $to_set ) ) {

			foreach ( $theme_menus as $menu ) {

				// Check if the menu exists in the $ishfreelotheme_globals['nav_menus'] set in functions.php
				if ( is_object( $menu ) && in_array( $menu->slug, $to_set ) ) {

					$key = array_search( $menu->slug, $to_set );

					if ( $key ) {
						// Set the menu to the correct location
						$locations[ $key ] = $menu->term_id;
					}
				}
			}
		}

		//update the theme
		set_theme_mod( 'nav_menu_locations', $locations);

		echo 'ish_menus_set';
	}

	function set_pages()
	{

		global $ish_current_demo;

		$to_set = Array();
		$to_set['page_on_front'] = 'Home';
		$to_set['page_for_posts'] = 'Blog';

		// Set the pages for each demo
		switch ( $ish_current_demo ){
			case 'theme_agency':
				$to_set['page_on_front'] = 'Home Funky Creative 1';
				$to_set['page_for_posts'] = 'Blog';
				break;
			case 'theme_freelance':
				$to_set['page_on_front'] = 'Home Original';
				$to_set['page_for_posts'] = 'Blog';
				break;
			case 'theme_eshop':
				$to_set['page_on_front'] = 'Home';
				$to_set['page_for_posts'] = 'Blog';
				break;
			case 'theme_minimal':
				$to_set['page_on_front'] = 'Home';
				$to_set['page_for_posts'] = 'Blog';
				break;
			case 'theme_vintage':
				$to_set['page_on_front'] = 'Home';
				$to_set['page_for_posts'] = 'Blog';
				break;
			default:
				$to_set['page_on_front'] = 'Home';
				$to_set['page_for_posts'] = 'Blog';
		}

		// Use a static front page
		$about = get_page_by_title( $to_set['page_on_front'] );
		if ( ! empty( $about ) && is_object( $about ) ){
			update_option( 'page_on_front', $about->ID );
			update_option( 'show_on_front', 'page' );
		}

		// Set the blog page
		// $blog = get_page_by_title( 'Blog' );
		$blog = get_page_by_title( $to_set['page_for_posts'] );
		if ( ! empty( $blog ) && is_object( $blog ) ){
			update_option( 'page_for_posts', $blog->ID );
		}


		echo 'ish_pages_set';
	}

	function set_permalinks()
	{
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure('/%postname%/');
		flush_rewrite_rules();
		echo 'ish_permalinks_set';
	}

	function set_widgets()
	{
		global $ish_current_demo;

		if ( isset($ish_current_demo) && '' != $ish_current_demo){
			// NEW STYLE - with multiple skins and xml per skin
			$demo_widgets_file = get_template_directory() . '/assets/framework/wp/includes/' . $ish_current_demo . '_widgets.json';
		}
		else{
			$demo_widgets_file = get_template_directory() . '/assets/framework/wp/includes/demo-widgets.json';
		}

		if ( ! class_exists( 'Ishyoboy_Widget_Data' ) ) {
			$class_widgets_import = get_template_directory() . '/assets/framework/wp/importer/class-ishyoboy-widget-data.php';
			if ( file_exists( $class_widgets_import ) ) {
				require_once $class_widgets_import ;
			}
		}

		if ( ! is_file( $demo_widgets_file ) ) {
			echo 'The demo widgets JSON file could not be found in the theme directory. Please make sure to use the latest theme version.';
		}
		else
		{
			do_action( 'ishfreelotheme_before_demo_widgets_import' );

			$wp_widgets_import = new Ishyoboy_Widget_Data();
			$wp_widgets_import->ishfreelotheme_import_widget_data( $demo_widgets_file );

			do_action( 'ishfreelotheme_after_demo_widgets_import' );

			echo 'ish_widgets_set';

		}



	}
}