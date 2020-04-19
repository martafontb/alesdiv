<?php

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Ishyoboy_CPT' ) ) :

	//require_once( 'assets/backend/classes/class-ish-plugin-base.php' );

	class Ishyoboy_CPT extends Ish_Plugin_Base {

		function __construct() {

			// Necessary to set all global plugin variables
			parent::__construct( __FILE__ );

			define( 'IYB_CPT_PLUGIN_URI', $this->PLUGIN_PLUGIN_URI );

			add_action( 'init', array(&$this, 'action_init') );
			add_action( 'after_setup_theme', array(&$this, 'action_after_setup_theme') );
			add_action( 'admin_enqueue_scripts', array(&$this, 'action_admin_scripts_init') );
			add_action( 'wp_enqueue_scripts', array(&$this, 'action_frontend_scripts') );
			add_action( 'ish_theme_options_after_footer_options', array(&$this, 'add_theme_options_portfolio_options') );
			add_action( 'ish_after_generate_options_css', 'flush_rewrite_rules' );

		}

		/**
		 * Registers and Endues Frontend Scripts
		 *
		 * @return	void
		 */
		function action_frontend_scripts() {



		}

		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return	void
		 */

		function action_admin_scripts_init() {

			wp_register_style( 'ishfreelotheme-cpt-admin', IYB_CPT_PLUGIN_URI .'/assets/backend/css/cpt_admin.css' );
			wp_enqueue_style('ishfreelotheme-cpt-admin');

			wp_register_script( 'ishfreelotheme-cpt-admin', IYB_CPT_PLUGIN_URI .'/assets/backend/js/cpt_admin.js', array('jquery'), false,true );
			wp_enqueue_script('ishfreelotheme-cpt-admin');



		}

		/**
		 * Action called in 'init' hook
		 *
		 * Initiates the plugin
		 *
		 * @return void
		 */
		function action_init() {



		}


		/**
		 * Action called in 'after_setup_theme' hook
		 *
		 * Registers all widgets
		 *
		 * @return void
		 */
		function action_after_setup_theme() {

			require_once( $this->locate_template_in_plugin( 'assets/backend/cpt/portfolio-post.php' ) );
			require_once( $this->locate_template_in_plugin( 'assets/backend/includes/ishyo-meta-box.php' ) );

			if ( is_admin() ){
				require_once( $this->locate_template_in_plugin( 'assets/backend/includes/custom-meta-boxes.php' ) );
			}

		}


		/**
		 * Adds Theme Options page
		 *
		 * Adds Theme Options page to themes by IshYoBoy using the  "ish_theme_options_after_footer_options" hook
		 *
		 * @return void
		 */
		function add_theme_options_portfolio_options(){

			global $of_options, $of_pages, $of_sidebars;

			do_action( 'ish_theme_options_before_portfolio_options' );

			/* *********************************************************************************************************
			 * 4. Portfolio Settings
			 */
			$of_options[] = array(  'name' => esc_html__( 'Portfolio Options', 'ishyoboy_assets' ),
				'class' => 'portfoliooptions',
				'type' => 'heading');

			$url =  ADMIN_DIR . 'assets/images/portfolio-styles/';

			// InfoBox *************************************************************************************************
			$of_options[] = array(  'name' => esc_html__( 'Portfolio page', 'ishyoboy_assets' ),
				'desc' => '',
				'id' => 'introduction',
				'std' => esc_html__( 'The options below are for dynamic pages which do not have physical WordPress page
				representation and their settings cannot be edited via the back-end. Such pages are Categorie, Tags, Author
				detail, etc.. To display the portfolio on any page use the "Portfolio" page element which has its
				own options so it can look differently on every page.', 'ishyoboy_assets' ),
				'type' => 'info',
				'icon' => true,
			);

			// PORTFOLIO PAGE ******************************************************************************************
			$of_options[] = array(  'name' => esc_html__( 'Portfolio page', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'The page which will serve as Portfolio homepage.', 'ishyoboy_assets' ),
				'id' => 'page_for_custom_post_type_portfolio-post',
				'std' => '',
				'type' => 'select',
				'options' => $of_pages );

			// PORTFOLIO SIDEBAR ***************************************************************************************
			$of_options[] = array(  'name' => esc_html__( 'Portfolio Sidebar', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Display Sidebar on Portfolio overview and detail pages.', 'ishyoboy_assets'), //. '<br><br><span style="color: #FF0000;">' . esc_html__( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy_assets' ) . '</span>',
				'id' => 'show_portfolio_sidebar',
				'std' => 0,
				'folds' => 1,
				'type' => 'switch');

			$of_options[] = array(  'name' => '', //'name' => esc_html__( 'Portfolio Sidebar position', 'ishyoboy_assets' ),
				'desc'  => esc_html__( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'ishyoboy_assets' ),
				'id'    => 'portfolio_sidebar_position',
				'std'   => 'right',
				'fold'  => 'show_portfolio_sidebar',
				'type'  => 'select',
				'options' => array('left' => 'Left', 'right' => 'Right') );

			$of_options[] = array(  'name' => '', //'name' => esc_html__( 'Portfolio Sidebar', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Select which sidebar will be displayed on Portfolio overview and Portfolio detail pages.', 'ishyoboy_assets' ),
				'id' => 'portfolio_sidebar',
				'std' => 'sidebar-portfolio',
				'fold' => 'show_portfolio_sidebar',
				'type' => 'select',
				'options' => $of_sidebars);

			$of_options[] = array(  'name' => esc_html__( 'Portfolio Layout', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Display items with different heights and widths.', 'ishyoboy_assets' ),
				'id' => 'portfolio_layout',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''  => esc_html__( 'Regular - 4:3 rectangles', 'ishyoboy_assets'),
					'rectangle16'  => esc_html__( 'Regular - 16:9 rectangles', 'ishyoboy_assets'),
					'square'  => esc_html__( 'Regular - 1:1 squares', 'ishyoboy_assets'),
					'masonry-regular'  => esc_html__( 'Masonry Regular - Various heights based on image size', 'ishyoboy_assets'),
					'masonry-tiles'  => esc_html__( 'Masonry Tiles - As set in Item detail - 1x1, 1x2, 2x1, 2x2', 'ishyoboy_assets'),
					'masonry-grid'  => esc_html__( 'Masonry Grid - 1x1 squares, first item 2x2', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name' => esc_html__( 'Open on click', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Define what to open after a user clicks on a portfolio item.', 'ishyoboy_assets' ),
				'id' => 'portfolio_open_type',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''              => esc_html__( 'Detail Page', 'ishyoboy_assets'),
					'image' => esc_html__( 'Pop-up window with image', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name' => esc_html__( 'Animation', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Animation style on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_animation',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''              => esc_html__( 'Zoom In', 'ishyoboy_assets'),
					'zoomin-rotate' => esc_html__( 'Zoom In & Rotate', 'ishyoboy_assets'),
					'flip'          => esc_html__( '3D Flip', 'ishyoboy_assets'),
					'3dcube'        => esc_html__( '3D Cube', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name' => '', //__( 'Text Animation', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Text animation on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_text_animation',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''              => esc_html__( 'Vertical', 'ishyoboy_assets'), // none - Default is zoomin
					'horizontal'    => esc_html__( 'Horizontal', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name' => '', //__( 'Text Animation', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Text animation on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_direction',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''          => esc_html__( 'Left', 'ishyoboy_assets'), // left - default is left
					'right'     => esc_html__( 'Right', 'ishyoboy_assets'),
					'top'       => esc_html__( 'Top', 'ishyoboy_assets'),
					'bottom'    => esc_html__( 'Bottom', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name' => '', //__( 'Text Animation', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Direction of the animation on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_inverse',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''          => esc_html__( 'Title & Category', 'ishyoboy_assets'),
					'inverse'   => esc_html__( 'Image', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name' => esc_html__( 'Display Filter', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Categories buttons for users to filter the items.', 'ishyoboy_assets' ),
				'id' => 'portfolio_filter',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''          => esc_html__( 'No filter', 'ishyoboy_assets'),
					'fade'      => esc_html__( 'Fade', 'ishyoboy_assets'),
					'organize'  => esc_html__( 'Fade & Reorganize', 'ishyoboy_assets'),
					'link'      => esc_html__( 'Link to category page', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name'  => '', //__( '', 'ishyoboy_assets' ),
				'desc'  => esc_html__( 'The title displayed above the filters.', 'ishyoboy_assets' ),
				'id'    => 'portfolio_filter_title',
				'std'   => esc_html__( 'Categories', 'ishyoboy_assets' ),
				'type'  => 'text');

			$of_options[] = array(  'name'  => '', //__( '', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Filter Alignment.', 'ishyoboy_assets' ),
				'id' => 'portfolio_filter_align',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''          => esc_html__( 'No Alignment', 'ishyoboy_assets'),
					'left'      => esc_html__( 'Left', 'ishyoboy_assets'),
					'center'    => esc_html__( 'Center', 'ishyoboy_assets'),
					'right'     => esc_html__( 'Right', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name' => esc_html__( 'Items Order', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Which Portfolio items to display first.', 'ishyoboy_assets' ),
				'id' => 'portfolio_order',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''      => esc_html__( 'Latest First'),
					'ASC'   => esc_html__( 'Oldest First'),
				),
			);

			// Pagination must be set to 'pagination' => always display

			$of_options[] = array(  'name' => esc_html__( 'Items per page', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Number of items to display per page. Set "-1" to see all.', 'ishyoboy_assets' ),
				'id' => 'portfolio_per_page',
				'std' => '9',
				'type' => 'text');

			$of_options[] = array(  'name' => esc_html__( 'Columns Count', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Number of columns to display in the Portfolio Grid', 'ishyoboy_assets' ),
				'id' => 'portfolio_columns',
				'std' => '4',
				'type' => 'select',
				'options' => Array(
					'8' => '8',
					'7' => '7',
					'6' => '6',
					'5' => '5',
					'4' => '4',
					'3' => '3',
					'2' => '2',
				),
			);

			$of_options[] = array(  'name' => esc_html__( 'Show Categories', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Display item category on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_show_categories',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''      => esc_html__( 'No', 'ishyoboy_assets'),
					'yes'   => esc_html__( 'Yes', 'ishyoboy_assets'),
				),
			);

			$of_options[] = array(  'name' => esc_html__( 'Border Width', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Width in pixels to add a transparent border to each portfolio item. Set "0" to remove it completely.', 'ishyoboy_assets' ),
				'id' => 'portfolio_border_width',
				'std' => '5', // if changed then change and portfolio shortcode inline otput as well
				'type' => 'text');

			$of_options[] = array(  'name' => esc_html__( 'Portfolio Detail Page - Prev/Next & Sharing', 'ishyoboy_assets' ),
				'desc' => esc_html__( 'Choose what to display at the bottom of the Portfolio Detail page.', 'ishyoboy_assets' ),
				'id' => 'single_portfolio_details',
				'std' => 'nav-social',
				'type' => 'select',
				'options' => Array(
					''  => esc_html__( 'None', 'ishyoboy_assets'),
					'nav'  => esc_html__( 'Prev/Next Navigation', 'ishyoboy_assets'),
					'social'  => esc_html__( 'Sharing Icons', 'ishyoboy_assets'),
					'nav-social'  => esc_html__( 'Prev/Next Navigation & Sharing Icons', 'ishyoboy_assets'),
				),
			);

			// PORTFOLIO SLUG ******************************************************************************************
			if ( defined('ISH_LNG') && '' == ISH_LNG ) {
				$of_options[] = array('name' => esc_html__('Portfolio Slug', 'ishyoboy_assets'),
					'desc' => esc_html__('The URL slug of portfolio items and archives.', 'ishyoboy_assets'),
					'id' => 'slug_portfolio',
					'std' => esc_html__('portfolio', 'ishyoboy_assets'),
					'type' => 'text');
			}

			do_action( 'ish_theme_options_after_portfolio_options' );
		}

	}
	$ish_plugins_cpt = new Ishyoboy_CPT;

endif;

?>