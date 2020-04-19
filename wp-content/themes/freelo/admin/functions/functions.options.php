<?php

if ( is_admin() ){
	add_action( 'init', 'of_options' );
}

if (! function_exists( 'of_options')) {

    function of_options() {

        global $ishfreelotheme_fonts, $of_pages, $of_sidebars, $of_menus, $of_categories, $ish_bg_images, $ish_alt_stylesheets, $ish_alt_stylesheets_imgs, $ish_googleFontsArray, $ish_regular_fonts, $ish_regular_variants;
	    $of_categories = array();
	    $of_pages = array();
	    $of_sidebars = array();
	    $of_menus = array();
	    $ish_bg_images = array();
	    $ish_alt_stylesheets = array();
	    $ish_alt_stylesheets_imgs = array();
	    $ish_googleFontsArray = array();
	    $ish_regular_fonts = array();
	    $ish_regular_fonts = array();
	    $ish_regular_variants = array();

	    $social_icons = null;
	    $social_icons_bar = null;


		//Access the WordPress Categories via an Array
		$of_categories = array();
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, 'Select a category:');

		//Access the WordPress Pages via an Array
		$of_pages = array();
        $of_pages_obj = get_pages();

        $of_pages['-1'] = esc_html__( 'Select a page', 'freelo' );
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_title;
        }

        //Sidebars
        $of_sidebars = array();
        foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar){
            $of_sidebars[ $sidebar['id'] ] =  $sidebar['name'];
        }

        //Menus
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false, 'taxonomy' => 'tax_nav_menu' ) );
        $of_menus = array(
            '' => esc_html__( 'Select a menu', 'freelo' ),
            'none' => esc_html__( 'No menu', 'freelo' ),
        );
        foreach ( $menus as $menu ) {
            $of_menus[$menu->slug] = $menu->name;
        }

        // Breadcrumbs Social icons
        $social_icons = '[ish_icon icon="ish-icon-email" icon_url="mailto:hi@freelo-theme.com" text_color="color2" active_text_color="color5" type="simple" global_atts="yes" tooltip="Write us: hi@freelo-theme.com" tooltip_color="color5" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-phone-1" icon_url="tel:+3312345678" text_color="color2" active_text_color="color5" type="simple" global_atts="yes" tooltip="Call us: +33 123 456 78" tooltip_color="color5" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-skype" icon_url="skype:freelo-theme" text_color="color2" active_text_color="color5" type="simple" global_atts="yes" tooltip="Skype us: freelo-theme" tooltip_color="color5" tooltip_text_color="color4"]';


	    // Header Bar Social Icons
	    $social_icons_bar = '[ish_icon icon="ish-icon-twitter" icon_url="//twitter.com/ishyoboydotcom" text_color="color2" active_text_color="color17" type="simple" global_atts="yes" tooltip="Twitter" tooltip_color="color17" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-facebook" icon_url="//www.facebook.com/ishyoboydotcom" text_color="color2" active_text_color="color13" type="simple" global_atts="yes" tooltip="Facebook" tooltip_color="color13" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-dribbble" icon_url="//dribbble.com/MattImling" text_color="color2" active_text_color="color14" type="simple" global_atts="yes" tooltip="Dribbble" tooltip_color="color14" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-behance" icon_url="//www.behance.net/MattImling" text_color="color2" active_text_color="color15" type="simple" global_atts="yes" tooltip="Behance" tooltip_color="color15" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-email" icon_url="//eepurl.com/C-X7v" text_color="color2" active_text_color="color5" type="simple" global_atts="yes" tooltip="Subscribe to our newsletter" tooltip_color="color5" tooltip_text_color="color4"]';

	    //
	    $footer_legals_area = '<div class="ish-grid12" style="text-align: center"><a href="//themes.ishyoboy.com/freelo" title="Freelo">Freelo</a> Theme <span class="ish-spacer">/</span> Proudly powered by <a href="//wordpress.org" title="WordPress">WordPress</a> <span class="ish-spacer">/</span> Created by <a href="//ishyoboy.com" title="IshYoBoy.com">IshYoBoy.com</a></div>';

	    // Social Share code
	    $social_share_icons = '[ish_icon icon="ish-icon-facebook" icon_url="https://www.facebook.com/sharer/sharer.php?u=##CURRENT_PAGE##" text_color="color2" active_text_color="color13" type="simple" global_atts="yes" tooltip="Share on Facebook" tooltip_color="color13" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-gplus" icon_url="https://plus.google.com/share?url=##CURRENT_PAGE##" text_color="color2" active_text_color="color16" type="simple" global_atts="yes" tooltip="Share on Google+" tooltip_color="color16" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-twitter" icon_url="https://twitter.com/home?status=This%20is%20worth%20reading:%20##CURRENT_PAGE##" text_color="color2" active_text_color="color17" type="simple" global_atts="yes" tooltip="Share on Twitter" tooltip_color="color17" tooltip_text_color="color4"]

[ish_icon icon="ish-icon-email" icon_url="mailto:?&subject=Check%20this%20link&body=This%20is%20worth%20reading:%20##CURRENT_PAGE##" text_color="color2" active_text_color="color1" type="simple" global_atts="yes" tooltip="Share via e-mail" tooltip_color="color1" tooltip_text_color="color4"]';

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> 'placebo', //REQUIRED!
				"block_one"		=> 'Block One',
				"block_two"		=> 'Block Two',
				"block_three"	=> 'Block Three',
			),
			"enabled" => array (
				'placebo' => 'placebo', //REQUIRED!
				'block_four'	=> 'Block Four',
			),
		);

        $googleFonts = json_decode(ishfreelotheme_get_google_fonts());
        $ish_googleFontsArray = array('none' => esc_html__( 'Select a font', 'freelo' ) );

        foreach ($googleFonts as $key => $details) {
            $ish_googleFontsArray[$key] = $key;
        }

        $ish_regular_fonts = array(
            'arial'     =>  'Arial',
            'verdana'   =>  'Verdana, Geneva',
            'trebuchet' =>  'Trebuchet',
            'georgia'   =>  'Georgia',
            'times'     =>  'Times New Roman',
            'tahoma'    =>  'Tahoma, Geneva',
            'palatino'  =>  'Palatino',
            'helvetica' =>  'Helvetica'
        );

        $ish_regular_variants = array(
            'normal'        =>  'Normal',
            'italic'        =>  'Italic',
            'bold'          =>  'Bold',
            'bold italic'   =>  'Bold Italic'
        );

	    // FONT SETTINGS
	    global $ishfreelotheme_options;
	    $ish_default_fonts = $ishfreelotheme_fonts;
	    ishfreelotheme_load_font_settings('body_font', $ishfreelotheme_options);
	    ishfreelotheme_load_font_settings('body_font_2', $ishfreelotheme_options);
	    ishfreelotheme_load_font_settings('header_font', $ishfreelotheme_options);
	    ishfreelotheme_load_font_settings('h1_font', $ishfreelotheme_options);
	    ishfreelotheme_load_font_settings('h2_font', $ishfreelotheme_options);
	    ishfreelotheme_load_font_settings('h3_font', $ishfreelotheme_options);
	    ishfreelotheme_load_font_settings('h4_font', $ishfreelotheme_options);
	    ishfreelotheme_load_font_settings('h5_font', $ishfreelotheme_options);
	    ishfreelotheme_load_font_settings('h6_font', $ishfreelotheme_options);
	    $ish_saved_fonts = $ishfreelotheme_fonts;
	    $ishfreelotheme_fonts = $ish_default_fonts;

        //Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$ish_alt_stylesheets = array();
        $ish_alt_stylesheets_imgs = array();


	    if ( is_dir($alt_stylesheet_path) )
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
		    {
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
		        {
		            if(stristr($alt_stylesheet_file, '.php') !== false)
		            {
		                $ish_alt_stylesheets[$alt_stylesheet_file] = ucfirst(substr($alt_stylesheet_file, 0, -4));
                        $ish_alt_stylesheets_imgs[$alt_stylesheet_file] = get_template_directory_uri() . '/admin/layouts/' . substr($alt_stylesheet_file, 0, -4).'.png';
		            }
		        }
		    }
		}

        asort($ish_alt_stylesheets);
        asort($ish_alt_stylesheets_imgs);

        $ish_bg_images_path = get_template_directory() . '/assets/frontend/images/bg-patterns'; // change this to where you store your bg images
        $ish_bg_images_url = get_template_directory_uri() . '/assets/frontend/images/bg-patterns'; // change this to where you store your bg images

	    $ish_bg_images = array();
	    $ish_bg_images_first = array( '' => get_template_directory_uri() . '/assets/frontend/images/none.png');

		if ( is_dir($ish_bg_images_path) ) {
		    if ($ish_bg_images_dir = opendir($ish_bg_images_path) ) {
		        while ( ($ish_bg_images_file = readdir($ish_bg_images_dir)) !== false ) {
		            if( (stristr($ish_bg_images_file, '.png') !== false || stristr($ish_bg_images_file, '.jpg') !== false || stristr($ish_bg_images_file, '.gif') !== false )) {
		                $ish_bg_images[$ish_bg_images_file] = $ish_bg_images_url . '/' . $ish_bg_images_file;
		            }
		        }
		    }
		}

        asort($ish_bg_images);
        $ish_bg_images = array_merge($ish_bg_images_first, $ish_bg_images);

        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

        // Set the Options Array
        global $of_options;
        $of_options = array();

	    do_action( 'ish_theme_options_before_general_options' );

		/* *************************************************************************************************************
         * 1. General Settings
         */
	    $of_options[] = array(  'name'  => esc_html__( 'General Options', 'freelo' ),
		                        'class' => 'generaloptions',
		                        'type'  => 'heading');

	        // BOXED / UNBOXED *****************************************************************************************
		    $url =  ADMIN_DIR . 'assets/images/';
		    $of_options[] = array(  'name'      => esc_html__( 'Boxed / Unboxed Layout', 'freelo' ),
                                    'desc'      => esc_html__( 'Default layout of the theme. Either boxed with a background image or unboxed (full-width).', 'freelo' ),
                                    'id'        => 'boxed_layout',
                                    'std'       => ISHFREELOTHEME_DEFAULT_BOXED_LAYOUT,
                                    'type'      => 'images',
                                    'options'   => Array(
                                        'boxed'     => $url . '3cm.png',
                                        'unboxed'   => $url . '1col.png'
                                    ));

	        // PAGE WIDTH **********************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Page Width', 'freelo' ),
                                    'desc'  => esc_html__( 'Choose one of the pre-defined widths or enter custom one.', 'freelo' ),
                                    'id'    => 'use_predefined_page_width',
                                    'std'   => 1,
                                    'on'    => esc_html__( 'Predefined', 'freelo' ),
                                    'off'   => esc_html__( 'Custom', 'freelo' ),
                                    'folds' => 0,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'      => '', //  esc_html__( 'Page Width', 'freelo' ),
                                    'desc'      => '', //  esc_html__( '', 'freelo' ),
                                    'id'        => 'predefined_page_width',
                                    'std'       => ISHFREELOTHEME_PAGE_WIDTH,
                                    'type'      => 'radio',
                                    'fold'      => 'use_predefined_page_width',
                                    'options'   => array(
	                                    ISHFREELOTHEME_PAGE_WIDTH  => esc_html__( 'Full Width', 'freelo' ) . ' (100%)',
	                                    '1240'  => esc_html__( 'Wide Screen', 'freelo' ) . ' (1240px)',
                                        '960'           => esc_html__( 'NoteBook', 'freelo' ) . ' (960px)',
                                    ));

            $of_options[] = array(  'name'  => '', //  esc_html__( '', 'freelo' ),
                                    'desc'  => 'px',
                                    'id'    => 'custom_page_width',
                                    'std'   => ISHFREELOTHEME_PAGE_WIDTH_PIXELS,
                                    'fold'  => 'off_' . 'use_predefined_page_width',
                                    'type'  => 'text');

	        // WEBSITE BORDER ******************************************************************************************
	        $of_options[] = array(  'name'  => esc_html__( 'Website Border', 'freelo' ),
                                    'desc'  => esc_html__( 'Add border around the whole website content.', 'freelo' ),
                                    'id'    => 'use_website_border',
							        'on'    => esc_html__( 'Yes', 'freelo' ),
							        'off'   => esc_html__( 'No', 'freelo' ),
                                    'std'   => 0,
                                    'type'  => 'switch');

            // RESPONSIVE LAYOUT ***************************************************************************************
	        $of_options[] = array(  'name'  => esc_html__( 'Responsive layout', 'freelo' ),
                                    'desc'  => esc_html__( 'Make the page width fit the screen of every device or set it to never resize.', 'freelo' ),
                                    'id'    => 'use_responsive_layout',
                                    'std'   => 1,
                                    'on'    => esc_html__( 'Responsive', 'freelo' ),
                                    'off'   => esc_html__( 'Fixed', 'freelo' ),
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'  => '', //  esc_html__( '', 'freelo' ),
                                    'desc'  => esc_html__( 'px - from this point the layout will change to a mobile version.', 'freelo' ),
                                    'id'    => 'responsive_layout_breakingpoint',
                                    'std'   => ISHFREELOTHEME_BREAKINGPOINT,
                                    'fold'  => 'use_responsive_layout',
                                    'type'  => 'text');

	        $of_options[] = array(  'name'  => '', //  esc_html__( '', 'freelo' ),
                                    'desc'  => esc_html__( 'Center the content in responsive layout', 'freelo' ),
                                    'id'    => 'responsive_content_centering',
							        'on'    => esc_html__( 'Yes', 'freelo' ),
							        'off'   => esc_html__( 'No', 'freelo' ),
		                            'fold'  => 'use_responsive_layout',
                                    'std'   => 1,
                                    'type'  => 'switch');

            // NICESCROLL **********************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'SmoothScroll', 'freelo' ),
                                    'desc'  => esc_html__( 'Enable smoothscroll functionality for smoother page scrolling effect (Google Chrome only).', 'freelo' ),
                                    'id'    => 'nicescroll_enabled',
                                    'std'   => 0,
                                    'type'  => 'switch');

	        // SITE PRELOADER ******************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Content Preloader', 'freelo' ),
                                    'desc'  => esc_html__( 'Enable preloader animation for smoother switching between pages', 'freelo' ),
                                    'id'    => 'preloader_enabled',
                                    'std'   => 0,
                                    'type'  => 'switch');

			// BREADCRUMBS **********************************************************************************************
	        $of_options[] = array(  'name'  => esc_html__( 'Breadcrumbs Bar', 'freelo' ),
                                    'desc'  => esc_html__( 'Display a breadcrumbs navigation in the content of each page.', 'freelo' ),
                                    'id'    => 'show_breadcrumbs',
									'std' => 'breadcrumbs-icons',
									'type' => 'select',
									'options' => Array(
										//'none'              => esc_html__( 'No', 'freelo' ),
										//'breadcrumbs'       => esc_html__( 'Yes', 'freelo' ),

										'none'              => esc_html__( 'None', 'freelo' ),
										'breadcrumbs'       => esc_html__( 'Breadcrumbs only', 'freelo' ),
										'icons'             => esc_html__( 'Social Icons only', 'freelo' ),
										'breadcrumbs-icons' => esc_html__( 'Breadcrumbs & Social Icons', 'freelo' ),
									),
			);

	        $of_options[] = array(  'name'  => esc_html__( 'Breadcrumbs Bar Icons', 'freelo' ),
	                                'class' => 'ish-sub-section',
                                    'desc'  => esc_html__( 'Social icons: Paste the social icons using the [ish_icon] shortcode', 'freelo' ),
                                    'id'    => 'social_icons',
                                    'std'   => $social_icons,
                                    'type'  => 'textarea');

	        // 404 PAGE ************************************************************************************************
            $of_options[] = array(  'name' => esc_html__( '404 Error page', 'freelo' ),
                                    'desc' => esc_html__( 'Select a page to be displayed instead of the standard 404 Not Found page.', 'freelo' ),
                                    'id' => 'use_page_for_404',
                                    'std' => '0',
                                    'folds' => '1',
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //  esc_html__( '', 'freelo' ),
                                    'desc' => esc_html__( 'The page which will be displayed instead of the standard 404 page.', 'freelo' ),
                                    'id' => 'page_for_404',
                                    'std' => '',
                                    'fold' => 'use_page_for_404',
                                    'type' => 'select',
                                    'options' => $of_pages );

            // REGULAR PAGES SIDEBAR ***********************************************************************************
            $of_options[] = array(  'name' => esc_html__( 'Regular Pages Sidebar', 'freelo' ),
                                    'desc' => esc_html__( "Display the sidebar on each page by default. This settings can be overridden in each page's settings.", 'freelo' ),
                                    'id' => 'show_page_sidebar',
                                    'std' => 0,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //  'name' => esc_html__( 'Regular Pages Sidebar position', 'freelo' ),
                                    'desc'  => esc_html__( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'freelo' ),
                                    'id'    => 'page_sidebar_position',
                                    'std'   => 'right',
                                    'fold'  => 'show_page_sidebar',
                                    'type'  => 'select',
                                    'options' => array('left' => 'Left', 'right' => 'Right') );

            $of_options[] = array(  'name' => '', //  'name' => esc_html__( 'Regular Pages Sidebar', 'freelo' ),
                                    'desc' => esc_html__( 'Select which sidebar will be displayed on each page by default.', 'freelo' ),
                                    'id' => 'page_sidebar',
                                    'std' => 'sidebar-main',
                                    'fold' => 'show_page_sidebar',
                                    'type' => 'select',
                                    'options' => $of_sidebars);

            // ADDTHIS SHARE *******************************************************************************************
	        /*
	        $of_options[] = array(  'name' => esc_html__( 'Social Sharing Code', 'freelo' ),
                                    'desc' => esc_html__( 'Paste your addthis sharing code from https://www.addthis.com/get/sharing', 'freelo' ),
                                    'id' => 'addthis_share',
                                    'std' => $social_share,
                                    'type' => 'textarea');
	        */

	        $of_options[] = array(  'name'  => esc_html__( 'Social Share Bar & Blog Detail Icons', 'freelo' ),
                                    'desc'  => esc_html__( 'Social icons: Paste the social icons using the [ish_icon] shortcode', 'freelo' ),
                                    'id'    => 'addthis_share',
                                    'std'   => $social_share_icons,
                                    'type'  => 'textarea');

            // CUSTOM CSS **********************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Custom CSS', 'freelo' ),
                                    'desc'  => esc_html__( 'Quickly add some CSS to your theme by adding it to this block.', 'freelo' ),
                                    'id'    => 'custom_css',
                                    'std'   => '',
                                    'type'  => 'textarea');

            // BACK TO TOP LINK
            $of_options[] = array(  'name' => esc_html__( 'Back-to-top link', 'freelo' ),
                                    'desc' => esc_html__( 'Display back to top link in the right bottom corner of each page.', 'freelo' ),
                                    'id' => 'show_back_to_top',
                                    'std' => 1,
                                    'type' => 'switch');

            // CUSTOM SCRIPTS ******************************************************************************************
            /*  $of_options[] = array(  'name' => esc_html__( 'Custom Scripts', 'freelo' ),
                                    'desc' => esc_html__( 'Quickly add some JavaScript includes to your theme by adding it to this block.', 'freelo' ),
                                    'id' => 'custom_scripts',
                                    'std' => '',
                                    'type' => 'textarea'); */

	    do_action( 'ish_theme_options_after_general_options' );
	    do_action( 'ish_theme_options_before_header_options' );

        /* *************************************************************************************************************
         * 2. Header Options
         */
        $of_options[] = array(  'name'  => esc_html__( 'Header Options', 'freelo' ),
                                'class' => 'headeroptions',
                                'type'  => 'heading');

	        // SITE LOGO ***********************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Site Logo', 'freelo' ),
                                    'desc'  => esc_html__( 'Use image logo instead of a simple Site Title and if not empty, Tagline.', 'freelo' ),
                                    'id'    => 'logo_as_image',
                                    'std'   => 0,
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'  => esc_html__( 'Logo', 'freelo' ), // Display just hr
                                    'class' => 'ish-sub-section',
                                    'desc'  => esc_html__( 'Select an image for the Site Logo.', 'freelo' ),
                                    'id'    => 'logo_image',
                                    'std'   => '',
                                    'fold'  => 'logo_as_image',
                                    'mod'   => 'min',
                                    'type'  => 'media');

            $of_options[] = array(  'name'  => esc_html__( 'Retina Logo', 'freelo' ), // Display just hr
                                    'class' => 'ish-sub-section',
                                    'desc'  => esc_html__( '2x bigger than the normal logo.', 'freelo' ) .'<br><br><span style="color: #FF0000;">' . '<strong>' . esc_html__( 'IMPORTANT:', 'freelo' ) . '</strong><br>' . esc_html__( 'The Site Logo must be set.', 'freelo' ) . '</span>',
                                    'id'    => 'logo_retina_image',
                                    'std'   => '',
                                    'fold'  => 'logo_as_image',
                                    'mod'   => 'min',
                                    'type'  => 'media');

	        $of_options[] = array(  'name'  => esc_html__( 'Alternative Header Style - Logo', 'freelo' ), // Display just hr
                                    'class' => 'ish-sub-section',
                                    'desc'  => esc_html__( 'Standard logo used, if not set.', 'freelo' ),
                                    'id'    => 'logo_image_alternative',
                                    'std'   => '',
                                    'fold'  => 'logo_as_image',
                                    'mod'   => 'min',
                                    'type'  => 'media');

            $of_options[] = array(  'name'  => esc_html__( 'Alternative Header Style - Retina Logo', 'freelo' ), // Display just hr
                                    'class' => 'ish-sub-section',
                                    'desc'  => esc_html__( 'Standard Retina logo used, if not set.', 'freelo' ),
                                    'id'    => 'logo_retina_image_alternative',
                                    'std'   => '',
                                    'fold'  => 'logo_as_image',
                                    'mod'   => 'min',
                                    'type'  => 'media');

	        // HEADER HEIGHT *******************************************************************************************
	        $of_options[] = array(  'name'  => esc_html__( 'Header Height', 'freelo' ),
                                    'desc'  => esc_html__( 'px - the height of the header area.', 'freelo' ),
                                    'id'    => 'header_height',
                                    'std'   => ISHFREELOTHEME_DEFAULT_HEADER_HEIGHT,
                                    'type'  => 'text');

            // RESPONSIVE LAYOUT MENU **********************************************************************************
	        $of_options[] = array(  'name'  => esc_html__( 'Header navigation responsive layout', 'freelo' ),
                                    'desc'  => esc_html__( 'px - from this point the main navigation will change to a mobile version. Works only if \'General Options -> Responsive layout\' is set to \'Responsive\'', 'freelo' ),
                                    'id'    => 'responsive_nav_breakingpoint',
                                    'std'   => ISHFREELOTHEME_NAV_BREAKINGPOINT,
                                    'type'  => 'text');


	        // SIDENAV *************************************************************************************************
            /*
            $of_options[] = array(  'name'  => esc_html__( 'Side Navigation', 'freelo' ),
                                    'desc'  => esc_html__( 'Transform main navigation to side navigation.', 'freelo' ),
                                    'id'    => 'use_sidenav',
                                    'std'   => '1',
                                    'type'  => 'switch');
            */

	        $of_options[] = array(  'name'      => esc_html__( 'Main Navigation', 'freelo' ),
                                    'desc'      => esc_html__( 'Position - Choose whether to display the Main Navigation on the top, left or right side of the page.', 'freelo' ),
                                    'id'        => 'mainnav_position',
                                    'std'       => '', // '', left, right
                                    'type'      => 'select',
                                    'options'   => array(
	                                    ''  => 'Center',
	                                    'left' => 'Left',
	                                    'right'  => 'Right',
                                    ));

	        $of_options[] = array(  'name'      => '',
                                    'desc'      => esc_html__( 'Sidebar - Select which sidebar to use in the Main Navigation Sidebar if position set to "Left" or "Right".', 'freelo' ),
                                    'id'        => 'mainnav_sidebar',
                                    'std'       => 'sidebar-sidenav',
                                    'type'      => 'select',
                                    'options'   => $of_sidebars);

	        $of_options[] = array(  'name'  => '',
                                    'desc'  => esc_html__( 'Type - Choose how the navigation should highlight the active pages/sections.', 'freelo' ),
                                    'id'    => 'mainnav_type',
                                    'std'   => '',
                                    'type'      => 'select',
                                    'options'   => array(
	                                    ''  => 'Multipage (Default)',
	                                    'onepage' => 'Onepage',
                                    ));

            // STICKY NAV **********************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Sticky Navigation', 'freelo' ),
                                    'desc'  => esc_html__( 'Choose whether the navigation remains sticked to the top of the page while scrolling down.', 'freelo' ),
                                    'id'    => 'sticky_nav',
                                    'std'   => 1,
                                    'folds' => 1,
                                    'type'  => 'switch');

		    $of_options[] = array(  'name'  => '', //  'name' => esc_html__( '', 'freelo' ),
								    'desc'  => esc_html__( 'Display Sticky Nav on tablets and mobile devices', 'freelo' ),
								    'id'    => 'sticky_nav_responsive',
								    'std'   => 1,
								    'fold'  => 'sticky_nav',
								    'type'  => 'switch');

	        $of_options[] = array(  'name'  => '', //  esc_html__( 'Sticky Navigation Height', 'freelo' ),
                                    'desc'  => esc_html__( 'Sticky Navigation Height in pixels. E.g.: "50".', 'freelo' ),
                                    'id'    => 'sticky_height',
                                    'std'   => ISHFREELOTHEME_DEFAULT_STICKY_HEIGHT,
		                            'fold'  => 'sticky_nav',
                                    'type'  => 'text');

            // Main Navigation Extras **********************************************************************************
            $extras_title = esc_html__( 'Main Navigation Extras', 'freelo' );

            if (ishfreelotheme_woocommerce_plugin_active()){
		        $of_options[] = array(  'name'  => $extras_title,
		                                'desc'  => esc_html__( 'Add Shopping Cart', 'freelo' ),
		                                'id'    => 'use_main_nav_cart',
		                                'std'   => 0,
		                                'type'  => 'switch');
                $extras_title = '';
		    }

            if ( ishfreelotheme_wpml_plugin_active() ){
                $of_options[] = array(  'name'  => $extras_title,
                                        'desc'  => esc_html__( 'Add Language Selector', 'freelo' ),
                                        'id'    => 'main_nav_languages',
                                        'std'   => 0,
                                        'type'  => 'switch');
                $extras_title = '';
            }

            $of_options[] = array(  'name'  => $extras_title,
                                    'desc'  => esc_html__( 'Add Search Form', 'freelo' ),
                                    'id'    => 'use_navigation_search',
                                    'std'   => '1',
                                    'type'  => 'switch');

	        $of_options[] = array(  'name'  => '', //  esc_html__( 'Expandable area', 'freelo' ),
		                            'desc'  => esc_html__( 'Add Expandable Area.', 'freelo' ),
		                            'id'    => 'expandable_header',
		                            'std'   => 1, //0,
		                            'folds' => 1,
		                            'type'  => 'switch');

		    $of_options[] = array(  'name'      => '', //  'name' => esc_html__( 'Expandable header sidebar', 'freelo' ),
		                            'desc'      => esc_html__( 'Select which sidebar will be displayed inside the expandable area by default.', 'freelo' ),
		                            'id'        => 'header_sidebar',
		                            'std'       => 'sidebar-header',
		                            'fold'      => 'expandable_header',
		                            'type'      => 'select',
		                            'options'   => $of_sidebars);

	        // HEADER BAR **********************************************************************************************
            $of_options[] = array(  'name' => esc_html__( 'Header Top Bar', 'freelo' ),
                                    'desc' => esc_html__( 'Show the header top bar used to display social icons and menu', 'freelo' ),
                                    'id' => 'use_header_bar',
                                    'std' => 1,
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array(  'name' => '', //  'name' => esc_html__( 'Expandable header sidebar', 'freelo' ),
                                    'desc' => esc_html__( 'Select which menu to display in top bar', 'freelo' ),
                                    'id' => 'header_bar_menu',
                                    'std' => 'header-bar-menu',
                                    'fold' => 'use_header_bar',
                                    'type' => 'select',
                                    'options' => $of_menus);

            $of_options[] = array(  'name' => '', //  'name' => esc_html__( 'Expandable header sidebar', 'freelo' ),
                                    'desc' => esc_html__( 'Positions', 'freelo' ),
                                    'id' => 'header_bar_order',
                                    'std' => 'social-left',
                                    'fold' => 'use_header_bar',
                                    'type' => 'select',
                                    'options' => array(
                                        'social-left' => esc_html__( 'Social on left / Menu on right', 'freelo' ),
                                        'social-right' => esc_html__( 'Menu on left / Social on right', 'freelo' ),
                                    ));

		    if (ishfreelotheme_woocommerce_plugin_active()){
		        $of_options[] = array(  'name'  => '', //  esc_html__( 'Shopping Cart', 'freelo' ),
		                                'desc'  => esc_html__( 'Add Shopping Cart', 'freelo' ),
		                                'id'    => 'use_header_bar_cart',
		                                'std'   => '0',
		                                'fold'  => 'use_header_bar',
		                                'type'  => 'switch');
		    }

	        if ( ishfreelotheme_wpml_plugin_active() ){
                $of_options[] = array(  'name'  => '', //  esc_html__( 'Language Selector', 'freelo' ),
                                        'desc'  => esc_html__( 'Add Language Selector', 'freelo' ),
                                        'id'    => 'header_bar_languages',
                                        'std'   => '0',
                                        'fold'  => 'use_header_bar',
                                        'type'  => 'switch');
            }

            $of_options[] = array(  'name'  => '', //  esc_html__( 'Header Bar navigation search form', 'freelo' ),
                                    'desc'  => esc_html__( 'Add Search Form', 'freelo' ),
                                    'id'    => 'use_header_bar_search',
                                    'std'   => 0,
	                                'fold' => 'use_header_bar',
                                    'type'  => 'switch');

            $of_options[] = array(  'name'  => esc_html__( 'Header Top Bar Icons', 'freelo' ),
                                    'class' => 'ish-sub-section',
                                    'desc'  => esc_html__( 'Social icons: Paste the social icons using the [ish_icon] shortcode', 'freelo' ),
                                    'id'    => 'social_icons_bar',
                                    'std'   => $social_icons_bar,
	                                'fold' => 'use_header_bar',
                                    'type'  => 'textarea');

            $of_options[] = array(  'name' => esc_html__( 'Title/Taglines Position', 'freelo' ),
                                    'desc' => esc_html__( 'How titles and custom taglines will be displayed.', 'freelo' ),
                                    'id' => 'title_area_style',
                                    'std' => 'left',
                                    'type' => 'select',
                                    'options' => array(
                                        'left' => esc_html__( 'Left aligned', 'freelo' ),
                                        'box' => esc_html__( 'Centered Box', 'freelo' ),
                                    ));



	    do_action( 'ish_theme_options_after_header_options' );
	    do_action( 'ish_theme_options_before_footer_options' );

        /* *************************************************************************************************************
         * 3. Footer Settings
         */
        $of_options[] = array(  'name'  => esc_html__( 'Footer Options', 'freelo' ),
                                'class' => 'footeroptions',
                                'type'  => 'heading');

            // FOOTER WIDGETS ******************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Footer widget area', 'freelo' ),
                                    'desc'  => esc_html__( 'Show the footer widget area.', 'freelo' ),
                                    'id'    => 'footer_widget_area',
                                    'std'   => 1,
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array( 'name'      =>  esc_html__( 'Widgetized Sidebar', 'freelo' ),
                                   'class'     => 'ish-sub-section',
                                   'desc'      => esc_html__( 'Select which sidebar will be displayed inside the footer widget area by default.', 'freelo' ),
                                   'id'        => 'footer_sidebar',
                                   'std'       => 'sidebar-footer',
                                   'fold'      => 'footer_widget_area',
                                   'type'      => 'select',
                                   'options'   => $of_sidebars);

            $of_options[] = array( 'name'      => esc_html__( 'Text Alignment', 'freelo' ),
                                   'class'     => 'ish-sub-section',
                                   'desc'      => esc_html__( 'Default footer widgets text alignment.', 'freelo' ),
                                   'id'        => 'footer_text_align',
                                   'std'       => 'center',
                                   'fold'      => 'footer_widget_area',
                                   'type'      => 'select',
                                   'options'   => Array(
                                        'left'      => esc_html__( 'Left', 'freelo' ),
                                        'center'    => esc_html__( 'Center', 'freelo' ),
                                        'right'     => esc_html__( 'Right', 'freelo' ),
                                   ),
            );

            // FOOTER LEGALS *******************************************************************************************
	        $of_options[] = array(  'name'  => esc_html__( 'Footer legals area', 'freelo' ),
                                    'desc'  => esc_html__( 'Show content in the footer legals area.', 'freelo' ),
                                    'id'    => 'footer_legals_area',
                                    'std'   => $footer_legals_area,
                                    'type'  => 'textarea');

	    do_action( 'ish_theme_options_after_footer_options' );

	    // PORTFOLIO SETTINGS COME HERE

	    do_action( 'ish_theme_options_before_blog_options' );


        /* *************************************************************************************************************
         * 5. Blog Settings
         */
        $of_options[] = array(  'name'  => esc_html__( 'Blog Options', 'freelo' ),
                                'class' => 'blogoptions',
                                'type'  => 'heading');

	        // BLOG STYLE **********************************************************************************************
	        $of_options[] = array(  'name'      => esc_html__( 'Blog Overview Style', 'freelo' ),
                                    'desc'      => esc_html__( 'Choose how the blog overview page will look like.', 'freelo' ),
                                    'id'        => 'blog_overview_style',
                                    'std'       => '2columns', //'classic',
                                    'type'      => 'select',
                                    'options'   => array(
	                                    'classic'       => esc_html__( 'Classic', 'freelo' ),
	                                    //'fullwidth'     => esc_html__( 'Full-width', 'freelo' ),
	                                    //'masonry'       => esc_html__( 'Masonry', 'freelo' ),
	                                    '2columns'       => esc_html__( '2 Columns', 'freelo' ),
                                    ));

            $of_options[] = array(  'name'      => esc_html__( 'Classic Blog Alignment', 'freelo' ),
                                    'class' => 'ish-sub-section',
                                    'desc'      => esc_html__( 'Chose where the texts will be aligned on Classic Blog Style. ', 'freelo' ),
                                    'id'        => 'blog_classic_align',
                                    'std'       => 'center', //'classic',
                                    'type'      => 'select',
                                    'options'   => array(
                                        'left'       => esc_html__( 'Left', 'freelo' ),
                                        'center'       => esc_html__( 'Center', 'freelo' ),
                                        'right'       => esc_html__( 'Right', 'freelo' ),
                                    ));

	        /*
	        $of_options[] = array(  'name' => esc_html__( 'Masonry Options', 'freelo' ),
								    'desc' => esc_html__( 'Masonry Layout Style - Regular Grid or Proportional Tiles.', 'freelo' ),
								    'id' => 'blog_masonry_layout_style',
								    'std' => 'grid-boxes',
								    'type' => 'select',
								    'options' => Array(
									    //'grid' => 'Grid - Same widths, auto heights, ',
									    'grid-boxes' => 'Grid Boxes - Same widths, auto heights',
									    //'tiles' => 'Tiles - Widths & heights as in post settings',
								    ),
		    );

		    $of_options[] = array(  'name' => '', //  esc_html__( '', 'freelo' ),
									'desc' => esc_html__( 'Number of columns to display in the Masonry Blog Grid.', 'freelo' ),
									'id' => 'blog_masonry_columns',
									'std' => '2',
									'type' => 'select',
									'options' => Array(
										'3' => '3',
										'2' => '2',
										'1' => '1',
									),
			);

		    $of_options[] = array(  'name' => '', //  esc_html__( '', 'freelo' ),
								    'desc' => esc_html__( 'Masonry Row Style - Keep the grid within content or expand to full width.', 'freelo' ),
								    'id' => 'blog_masonry_row_style',
								    'std' => 'full',
								    'type' => 'select',
								    'options' => Array(
									    'notfull' => 'Regular',
									    'full' => 'Full-width',
								    ),
		    );
	        */


	        // FEATURED POST *******************************************************************************************
	        $of_options[] = array(  'name'  => 'Featured Post', //  esc_html__( '', 'freelo' ),
                                    'desc'  => esc_html__( 'Display the featured post instead ot the header of the blog overview page.', 'freelo' ),
                                    'id'    => 'blog_featured_post',
                                    'std' => 'first-post',
								    'type' => 'select',
								    'options' => Array(
									    '' => esc_html__( 'Do not feature', 'freelo' ),
									    'first-post' => esc_html__( 'Feature first (latest) post', 'freelo' ),
									),
	        );

	        // BLOG CATEGORIES BAR *************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Display Categories Bar', 'freelo' ),
                                    'desc'  => esc_html__( 'Display a bar with all Blog categories on overview pages.', 'freelo' ),
                                    'id'    => 'show_blog_categories',
                                    'std'   => 0, //1,
                                    'type'  => 'switch');

	        // BLOG SIDEBAR ********************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Blog Sidebar', 'freelo' ),
                                    'desc'  => esc_html__( 'Display Sidebar on Blog overview and Blog detail pages.', 'freelo' ),
                                    'id'    => 'show_blog_sidebar',
                                    'std'   => 0, //1,
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array(  'name'      => '', //  'name' => esc_html__( 'Blog Sidebar position', 'freelo' ),
                                    'desc'      => esc_html__( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'freelo' ),
                                    'id'        => 'blog_sidebar_position',
                                    'std'       => 'right',
                                    'fold'      => 'show_blog_sidebar',
                                    'type'      => 'select',
                                    'options'   => array(
	                                    'left'  => 'Left',
	                                    'right' => 'Right'
                                    ));

            $of_options[] = array(  'name'      => '', //  'name' => esc_html__( 'Blog Sidebar', 'freelo' ),
                                    'desc'      => esc_html__( 'Select which sidebar will be displayed on Blog overview and Blog detail pages.', 'freelo' ),
                                    'id'        => 'blog_sidebar',
                                    'std'       => 'sidebar-main',
                                    'fold'      => 'show_blog_sidebar',
                                    'type'      => 'select',
                                    'options'   => $of_sidebars);

	        // PREV/NEXT & SOCIAL SHARING ******************************************************************************
            $of_options[] = array(  'name' => esc_html__( 'Post Detail Page - Prev/Next & Sharing', 'freelo' ),
                                    'desc' => esc_html__( 'Choose what to display at the bottom of the Post Detail page.', 'freelo' ),
                                    'id' => 'single_post_details',
                                    'std' => 'nav-social',
                                    'type' => 'select',
                                    'options' => Array(
                                        ''  => esc_html__( 'None', 'freelo'),
                                        'nav'  => esc_html__( 'Prev/Next Navigation', 'freelo'),
                                        'social'  => esc_html__( 'Sharing Icons', 'freelo'),
                                        'nav-social'  => esc_html__( 'Prev/Next Navigation & Sharing Icons', 'freelo'),
                                    ),
            );

	    do_action( 'ish_theme_options_after_blog_options' );
	    do_action( 'ish_theme_options_before_themes_skins' );

	    /* *************************************************************************************************************
         * Theme Skins
         */

        $of_options[] = array(  'name'  => esc_html__( 'Theme Skins', 'freelo' ),
                                'class' => 'themeskins',
                                'type'  => 'heading');

	        // THEME SKINS *********************************************************************************************
            $of_options[] = array(  'name'      => esc_html__( 'Theme Skins', 'freelo' ),
                                    'desc'      => esc_html__( 'Select one of the pre-defined skins.', 'freelo' ) . '<br><br><span style="color: red;">' . '<strong>' . esc_html__( 'IMPORTANT:', 'freelo' ) . '</strong><br>' . esc_html__( 'Changing the skin will reset all your currently defined Colors, Patterns, Fonts and Boxed Layout options.', 'freelo' ) . '</span>',
                                    'id'        => 'skin',
                                    'std'       => ISHFREELOTHEME_DEFAULT_SKIN,
                                    'type'      => 'images',
                                    //'fold'    => 'use_skin',
                                    'options'   => $ish_alt_stylesheets_imgs);


	    do_action( 'ish_theme_options_after_themes_skins' );
	    do_action( 'ish_theme_options_before_color_options' );

	    /* *************************************************************************************************************
         * Color Options
         */
        $of_options[] = array(  'name'  => esc_html__( 'Color Options', 'freelo' ),
                                'class' => 'coloroptions',
                                'type'  => 'heading');

		    // GLOBAL COLORS *******************************************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Global Colors', 'freelo' ),
                                    'desc'  => esc_html__( 'Text color', 'freelo' ),
                                    'id'    => 'text_color',
                                    'std'   => ISHFREELOTHEME_TEXT_COLOR,
                                    //'fold' => 'off_' . 'use_skin',
                                    'type'  => 'color');

            $of_options[] = array( 	'name'  => '', //  esc_html__( '', 'freelo' ),
                                    'desc'  => esc_html__( 'Body content color', 'freelo' ),
                                    'id'    => 'body_color',
                                    'std'   => ISHFREELOTHEME_BODY_COLOR,
                                    'type' 	=> 'color');

            $of_options[] = array( 	'name'  => '', //  esc_html__( '', 'freelo' ),
                                    'desc'  => esc_html__( 'Background color (when no pattern or image)', 'freelo' ),
                                    'id'    => 'background_color',
                                    'std'   => ISHFREELOTHEME_BACKGROUND_COLOR,
                                    'type' 	=> 'color');

	        // BASE COLORS *********************************************************************************************
	        /*
	        for ($i = 1; $i <= ISHFREELOTHEME_BASE_COLORS_COUNT; $i++){
		        $of_options[] = array(  'name'  => ( (1 == $i) ? esc_html__( 'Base colors', 'freelo' ) : '' ),
								        'desc'  => esc_html__( 'Color', 'freelo' ) . ' ' . $i,
								        'id'    => 'color' . $i,
								        'std'   => ( defined( 'ISHFREELOTHEME_COLOR_' . $i) ) ? constant('ISHFREELOTHEME_COLOR_' . $i) : '#ffffff',
								        'type'  => 'color');
		    }
	        */

	        // ADDITIONAL COLORS ***************************************************************************************
		    for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++){
			    $of_options[] = array(  'name'  => ( ( 1 == $i) ? esc_html__( 'Theme Colors', 'freelo' ) : '' ),
				                        'class' => 'ish-main-colors' . ' ish-item-' . $i,
			                            'desc'  => esc_html__( 'Color', 'freelo' ) . ' ' . $i,
				                        'id'    => 'color' . $i,
				                        'std'   => ( defined( 'ISHFREELOTHEME_COLOR_' . $i) ) ? constant('ISHFREELOTHEME_COLOR_' . $i) : '#ffffff',
				                        'type'  => 'color');
		    }

	        // HEADER BAR COLORS ***************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Header Top Bar Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'header_bar_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_4,
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');


	        // HEADER BAR NAVIGATION COLORS ****************************************************************************
            /*
            $of_options[] = array( 	'name'  => esc_html__( 'Header Bar Navigation Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'header_bar_nav_colors',
                                    'std'   => array(
	                                    'bg'            => '',
	                                    'bg_active'     => '',
                                        'text'          => ISHFREELOTHEME_COLOR_2,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');
            */

	        // HEADER BAR NAVIGATION SUBMENU COLORS ********************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Submenu Colors', 'freelo' ),
                                    'class' => 'ish-sub-section',
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'header_bar_nav_submenu_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_4,
	                                    //'bg_active'     => '',
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array(	'name'  => esc_html__( 'Background Opacity', 'freelo' ),
	                                'class' => 'ish-sub-section',
                                    'desc'  => esc_html__( 'Header Bar Background opacity in %.', 'freelo' ),
                                    'id'    => 'header_bar_colors_bg_opacity',
                                    'std'   => ISHFREELOTHEME_DEFAULT_HEADER_BAR_OPACITY,
                                    "min"   => '0',
                                    "step"  => '1',
                                    "max"   => '100',
                                    'type'  => 'sliderui' );

	        // HEADER COLORS *******************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Header Colors - Default Style', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'header_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_3,
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array( 	'name'  => esc_html__( 'Main Navigation Colors', 'freelo' ),
                                    'class' => 'ish-sub-section',
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'main_nav_colors',
                                    'std'   => array(
	                                    'bg'            => '',
	                                    'bg_active'     => ISHFREELOTHEME_COLOR_6,
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array( 	'name'  => esc_html__( 'Submenu Colors', 'freelo' ),
	                                'class' => 'ish-sub-section',
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'main_nav_submenu_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_6,
	                                    'bg_active'     => '',
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array(	'name'  => esc_html__( 'Background Opacity in %', 'freelo' ),
                                    'class' => 'ish-sub-section',
                                    'desc'  => '<span style="color: #FF0000;">' . '<strong>' . esc_html__( 'IMPORTANT:', 'freelo' ) . '</strong> ' . esc_html__( 'For pattern or background image set "0".', 'freelo' ) . ' ' . esc_html__( 'For solid color - "100".', 'freelo' ) . '</span>',
                                    'id'    => 'header_colors_bg_opacity',
                                    'std'   => ISHFREELOTHEME_DEFAULT_HEADER_OPACITY,
                                    "min"   => '0',
                                    "step"  => '1',
                                    "max"   => '100',
                                    'type'  => 'sliderui' );

	        // ALTERNATIVE - HEADER COLORS *******************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Header Colors - Alternative Style', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'header_colors_alternative',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_3,
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array( 	'name'  => esc_html__( 'Main Navigation Colors - Alternative Style', 'freelo' ),
	                                'class' => 'ish-sub-section',
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'main_nav_colors_alternative',
                                    'std'   => array(
	                                    'bg'            => '',
	                                    'bg_active'     => ISHFREELOTHEME_COLOR_6,
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array( 	'name'  => esc_html__( 'Submenu Colors - Alternative Style', 'freelo' ),
	                                'class' => 'ish-sub-section',
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'main_nav_submenu_colors_alternative',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_6,
	                                    'bg_active'     => '',
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        $of_options[] = array(	'name'  => esc_html__( 'Background Opacity in % - Alternative Style', 'freelo' ),
                                    'class' => 'ish-sub-section',
                                    'desc'  => '<span style="color: #FF0000;">' . '<strong>' . esc_html__( 'IMPORTANT:', 'freelo' ) . '</strong> ' . esc_html__( 'For pattern or background image set "0".', 'freelo' ) . ' ' . esc_html__( 'For solid color - "100".', 'freelo' ) . '</span>',
                                    'id'    => 'header_colors_alternative_bg_opacity',
                                    'std'   => ISHFREELOTHEME_DEFAULT_HEADER_OPACITY,
                                    "min"   => '0',
                                    "step"  => '1',
                                    "max"   => '100',
                                    'type'  => 'sliderui' );

	        // TAGLINE COLORS ******************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Tagline Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'tagline_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_3,
	                                    'headline_1'    => ISHFREELOTHEME_COLOR_5,
	                                    'headline_2'    => ISHFREELOTHEME_COLOR_1
                                    ),
	                                'type' 	=> 'color_set');

			// BREADCRUMBS BAR COLORS **********************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Breadcrumbs Bar Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'breadcrumbs_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_4,
                                        'text'          => ISHFREELOTHEME_COLOR_5,
                                        'link'          => ISHFREELOTHEME_COLOR_1,
                                        'link_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
	                                'type' 	=> 'color_set');

	        // SIDEBAR COLORS ******************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Sidebar Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'sidebar_colors',
                                    'std'   => array(
	                                    'title'         => ISHFREELOTHEME_COLOR_2,
	                                    'text'          => ISHFREELOTHEME_COLOR_1,
	                                    'link1'         => ISHFREELOTHEME_COLOR_1,
	                                    'link1_active'  => ISHFREELOTHEME_COLOR_5,
	                                    'link2'         => ISHFREELOTHEME_COLOR_5,
	                                    'link2_active'  => ISHFREELOTHEME_COLOR_1,
	                                    'block_bg'      => ISHFREELOTHEME_COLOR_6,
	                                    'block_text'    => ISHFREELOTHEME_COLOR_1
                                    ),
                                    'type' 	=> 'color_set');

            // FOOTER COLORS *******************************************************************************************
	        $of_options[] = array( 	'name'  => esc_html__( 'Footer Colors', 'freelo' ),
	                              'desc'  => '', //  esc_html__( '', 'freelo' ),
	                              'id'    => 'footer_colors',
	                              'std'   => array(
		                              'bg'            => ISHFREELOTHEME_COLOR_4,
		                              'title'         => ISHFREELOTHEME_COLOR_5,
		                              'text'          => ISHFREELOTHEME_COLOR_1,
		                              'link1'         => ISHFREELOTHEME_COLOR_5,
		                              'link1_active'  => ISHFREELOTHEME_COLOR_1,
		                              'link2'         => ISHFREELOTHEME_COLOR_5,
		                              'link2_active'  => ISHFREELOTHEME_COLOR_1,
		                              'block_bg'      => ISHFREELOTHEME_COLOR_6,
		                              'block_text'    => ISHFREELOTHEME_COLOR_1
	                              ),
	                              'type' 	=> 'color_set');

            // FOOTER LEGALS COLORS ************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Footer Legals Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'footer_legals_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_3,
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'link'          => ISHFREELOTHEME_COLOR_5,
                                    ),
                                    'type' 	=> 'color_set');

			// SIDENAV COLORS ******************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Side Navigation Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'sidenav_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_3,
                                        'title'         => ISHFREELOTHEME_COLOR_2,
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'link1'         => ISHFREELOTHEME_COLOR_1,
                                        'link1_active'  => ISHFREELOTHEME_COLOR_5,
                                        'link2'         => ISHFREELOTHEME_COLOR_5,
										'link2_active'  => ISHFREELOTHEME_COLOR_1,
	                                    'block_bg'      => ISHFREELOTHEME_COLOR_6,
	                                    'block_text'    => ISHFREELOTHEME_COLOR_1
                                    ),
                                    'type' 	=> 'color_set');

			// RESPNAV COLORS ******************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Responsive Navigation Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'respnav_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_7,
                                        'link'          => ISHFREELOTHEME_COLOR_1,
                                        'link_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        // SEARCH COLORS *******************************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Search Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'search_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_7,
                                        'text'          => ISHFREELOTHEME_COLOR_1,
                                        'text_active'   => ISHFREELOTHEME_COLOR_5
                                    ),
                                    'type' 	=> 'color_set');

	        // EXPANDABLE AREA COLORS **********************************************************************************
            $of_options[] = array( 	'name'  => esc_html__( 'Expandable Area Colors', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'exparea_colors',
                                    'std'   => array(
	                                    'bg'            => ISHFREELOTHEME_COLOR_7,
	                                    'title'         => ISHFREELOTHEME_COLOR_6,
	                                    'text'          => ISHFREELOTHEME_COLOR_6,
	                                    'link1'         => ISHFREELOTHEME_COLOR_3,
	                                    'link1_active'  => ISHFREELOTHEME_COLOR_5,
	                                    'link2'         => ISHFREELOTHEME_COLOR_5,
	                                    'link2_active'  => ISHFREELOTHEME_COLOR_3,
	                                    'block_bg'      => ISHFREELOTHEME_COLOR_1,
	                                    'block_text'    => ISHFREELOTHEME_COLOR_3
                                    ),
                                    'type' 	=> 'color_set');


	    do_action( 'ish_theme_options_after_color_options' );
	    do_action( 'ish_theme_options_before_pattern_options' );

	    /* *************************************************************************************************************
         * Pattern Options
         */
        $of_options[] = array(  'name'  => esc_html__( 'Pattern Options', 'freelo' ),
                                'class' => 'patternoptions',
                                'type'  => 'heading');

            // BACKGROUND PATTERN (BOXED LAYOUT ONLY) ******************************************************************
            $of_options[] = array(  'name'  => esc_html__( 'Background Pattern (Boxed layout only)', 'freelo' ),
                                    'desc'  => '', //  esc_html__( '', 'freelo' ),
                                    'id'    => 'use_background_pattern',
                                    'std'   => 0,
                                    'on'    => esc_html__( 'Predefined', 'freelo' ),
                                    'off'   => esc_html__( 'Custom', 'freelo' ),
                                    'folds' => 1,
                                    'type'  => 'switch');

            $of_options[] = array( 	'name' 		=> '', //  esc_html__( '', 'freelo' ),
                                    'desc' 		=>  esc_html__( 'Choose one of the pre-defined patterns.', 'freelo' ),
                                    'id' 		=> 'background_bg_pattern',
                                    'std' 		=> '',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_background_pattern',
                                    'options'   => $ish_bg_images);

            $of_options[] = array(  'name'  => '', //  esc_html__( '', 'freelo' ),
                                    'desc'  => esc_html__( 'Upload and select custom pattern.', 'freelo' ),
                                    'id'    => 'background_bg_image',
                                    'std'   => ISHFREELOTHEME_HTML_URI . '/images/bg-images/bg_01.jpg',
                                    'fold'  => 'off_' . 'use_background_pattern',
                                    'mod'   => 'min',
                                    'type'  => 'media');

            $of_options[] = array(  'name'      => '', //  esc_html__( '', 'freelo' ),
                                    'desc'      => esc_html__( 'Background position', 'freelo' ),
                                    'id'        => 'background_bg_image_cover',
                                    'std'       => 1,
                                    'fold'      => 'off_' . 'use_background_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => esc_html__( 'Repeat and scroll', 'freelo' ),
                                        '1'     => esc_html__( 'Fixed and cover', 'freelo' ),
                                    ));

            // HEADER PATTERN ******************************************************************************************
            $of_options[] = array(  'name' => esc_html__( 'Header pattern', 'freelo' ),
                                    'desc' => 'solid-light-cream-pixels.png', //  esc_html__( '', 'freelo' ),
                                    'id' => 'use_header_pattern',
                                    'std' => 1,
                                    'on' => esc_html__( 'Predefined', 'freelo' ),
                                    'off' => esc_html__( 'Custom', 'freelo' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  esc_html__( 'Choose one of the pre-defined patterns.', 'freelo' ) . '<br><br><span style="color: #FF0000;">' . '<strong>' . esc_html__( 'IMPORTANT:', 'freelo' ) . '</strong><br>' . esc_html__( 'The Header background color opacity must not be set to "100". See "Color Options" section.', 'freelo' ), // . ' ' . '<a href="#section-header_colors">' . esc_html__( 'See setting', 'freelo' ) . '</a>' .  '</span>',
                                    'id' 		=> 'header_bg_pattern',
                                    'std' 		=> '',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_header_pattern',
                                    'options' 	=> $ish_bg_images);

            $of_options[] = array(  'name' => '',
                                    'desc' => esc_html__( 'Upload and select custom pattern.', 'freelo' ) . '<br><br><span style="color: #FF0000;">' . '<strong>' . esc_html__( 'IMPORTANT:', 'freelo' ) . '</strong><br>' . esc_html__( 'The Header background color opacity must not be set to "100". See "Color Options" section.', 'freelo' ), // . ' ' . '<a href="#section-header_colors">' . esc_html__( 'See setting', 'freelo' ) . '</a>' .  '</span>',
                                    'id' => 'header_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_header_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

	        $of_options[] = array(  'name'      => '', //  esc_html__( '', 'freelo' ),
                                    'desc'      => esc_html__( 'Background position', 'freelo' ),
                                    'id'        => 'header_bg_image_cover',
                                    'std'       => 0,
                                    'fold'      => 'off_' . 'use_header_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => esc_html__( 'Repeat and scroll', 'freelo' ),
                                        '1'     => esc_html__( 'Cover', 'freelo' ),
                                    ));

	        // Expandable Pattern
            $of_options[] = array(  'name' => esc_html__( 'Expandable area pattern', 'freelo' ),
                                    'desc' => '', //  esc_html__( '', 'freelo' ),
                                    'id' => 'use_expandable_pattern',
                                    'std' => 1,
                                    'on' => esc_html__( 'Predefined', 'freelo' ),
                                    'off' => esc_html__( 'Custom', 'freelo' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  esc_html__( 'Choose one of the pre-defined patterns.', 'freelo' ),
                                    'id' 		=> 'expandable_bg_pattern',
                                    'std' 		=> '',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_expandable_pattern',
                                    'options' 	=> $ish_bg_images,
                                    );

            $of_options[] = array(  'name' => '',
                                    'desc' => esc_html__( 'Upload and select custom pattern.', 'freelo' ),
                                    'id' => 'expandable_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_expandable_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

	        $of_options[] = array(  'name'      => '', //  esc_html__( '', 'freelo' ),
                                    'desc'      => esc_html__( 'Background position', 'freelo' ),
                                    'id'        => 'expandable_bg_image_cover',
                                    'std'       => 1,
                                    'fold'      => 'off_' . 'use_expandable_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => esc_html__( 'Repeat and scroll', 'freelo' ),
                                        '1'     => esc_html__( 'Cover', 'freelo' ),
                                    ));

            // LEAD / TAGLINE PATTERN ********************************************************************************************
            $of_options[] = array(  'name' => esc_html__( 'Tagline pattern', 'freelo' ),
                                    'desc' => '', //  esc_html__( '', 'freelo' ),
                                    'id' => 'use_lead_pattern',
                                    'std' => 1,
                                    'on' => esc_html__( 'Predefined', 'freelo' ),
                                    'off' => esc_html__( 'Custom', 'freelo' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  esc_html__( 'Choose one of the pre-defined patterns.', 'freelo' ),
                                    'id' 		=> 'lead_bg_pattern',
                                    'std' 		=> '',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_lead_pattern',
                                    'options' 	=> $ish_bg_images);

            $of_options[] = array(  'name' => '',
                                    'desc' => esc_html__( 'Upload and select custom pattern.', 'freelo' ),
                                    'id' => 'lead_bg_image',
	                                'std'   => '', //ISHFREELOTHEME_HTML_URI . '/images/bg-images/taglines_bg.jpg',
                                    'fold' => 'off_' . 'use_lead_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

	        $of_options[] = array(  'name'      => '', //  esc_html__( '', 'freelo' ),
                                    'desc'      => esc_html__( 'Background position', 'freelo' ),
                                    'id'        => 'lead_bg_image_cover',
                                    'std'       => 1,
                                    'fold'      => 'off_' . 'use_lead_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => esc_html__( 'Repeat and scroll', 'freelo' ),
                                        '1'     => esc_html__( 'Cover', 'freelo' ),
                                    ));

	        $of_options[] = array(  'name'  => '', //  esc_html__( '', 'freelo' ),
                                    'desc'  => esc_html__( 'Number (0 - 100) representing the image opacity in %. 100 - visible, 0 - invisible.', 'freelo' ),
                                    'id'    => 'lead_bg_opacity',
                                    'std'   => 100,
                                    'type'  => 'text');


            // FOOTER PATTERN ******************************************************************************************
            $of_options[] = array(  'name' => esc_html__( 'Footer Widget area pattern', 'freelo' ),
                                    'desc' => '', //  esc_html__( '', 'freelo' ),
                                    'id' => 'use_footer_pattern',
                                    'std' => 1,
                                    'on' => esc_html__( 'Predefined', 'freelo' ),
                                    'off' => esc_html__( 'Custom', 'freelo' ),
                                    'folds' => 1,
                                    'type' => 'switch');

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=>  esc_html__( 'Choose one of the pre-defined patterns.', 'freelo' ),
                                    'id' 		=> 'footer_bg_pattern',
                                    'std' 		=> '',
                                    'type' 		=> 'tiles',
                                    'fold'      => 'use_footer_pattern',
                                    'options' 	=> $ish_bg_images);

            $of_options[] = array(  'name' => '',
                                    'desc' => esc_html__( 'Upload and select custom pattern.', 'freelo' ),
                                    'id' => 'footer_bg_image',
                                    'std' => '',
                                    'fold' => 'off_' . 'use_footer_pattern',
                                    'mod' => 'min',
                                    'type' => 'media');

	        $of_options[] = array(  'name'      => '', //  esc_html__( '', 'freelo' ),
                                    'desc'      => esc_html__( 'Background position', 'freelo' ),
                                    'id'        => 'footer_bg_image_cover',
                                    'std'       => 1,
                                    'fold'      => 'off_' . 'use_footer_pattern',
                                    'type'      => 'radio',
                                    'options'   => array(
	                                    '0'     => esc_html__( 'Repeat and scroll', 'freelo' ),
                                        '1'     => esc_html__( 'Cover', 'freelo' ),
                                    ));

	    do_action( 'ish_theme_options_after_pattern_options' );
	    do_action( 'ish_theme_options_before_font_options' );

	    /* *************************************************************************************************************
         * Font Options
         */
        $of_options[] = array(  'name'  => esc_html__( 'Font Options', 'freelo' ),
                                'class' => 'fontoptions',
                                'type'  => 'heading');

	        // GOOGLE FONT SUBSETS *************************************************************************************
            $of_options[] = array(  'name' => esc_html__( 'Google Fonts Subsets', 'freelo' ),
                                    'desc' => esc_html__( 'Choose which Font Subsets will be loaded if they are available. This will add language specific characters.', 'freelo' ) . '<br><br><span style="color: #FF0000;">' . '<strong>' . esc_html__( 'IMPORTANT:', 'freelo' ) . '</strong><br>' . esc_html__( 'Using many subsets can slow down your webpage. Only select the ones you need.', 'freelo' ) . '</span>',
                                    'id' => 'google_font_subsets',
                                    'std' => array('latin'),
                                    'disabled' => array('latin'),
                                    'type' => 'multicheck',
						            'options' 	=> array(
							            'latin' => esc_html__( 'Latin (Default)', 'freelo' ),
							            'latin-ext' => esc_html__( 'Latin Extended', 'freelo' ),
							            'cyrillic' => esc_html__( 'Cyrillic', 'freelo' ),
							            'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'freelo' ),
							            'devanagari' => esc_html__( 'Devanagari', 'freelo' ),
							            'greek' => esc_html__( 'Greek', 'freelo' ),
							            'greek-ext' => esc_html__( 'Greek Extended', 'freelo' ),
							            'khmer' => esc_html__( 'Khmer', 'freelo' ),
							            'vietnamese' => esc_html__( 'Vietnamese', 'freelo' ),
						            ),
            );


	        // BODY FONT ***********************************************************************************************
            $id = 'body_font'; // Important!

	        $of_options[] = array(  'name' => esc_html__( 'Body Font 1', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_2,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz', 'freelo' ), //this is the text from preview box
                                                    'size' => '16px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishfreelotheme_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_2 ) ) );


            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Font Size', 'freelo' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Line Height', 'freelo' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // BODY FONT ***********************************************************************************************
            $id = 'body_font_2'; // Important!

            $of_options[] = array(  'name' => esc_html__( 'Body Font 2', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz', 'freelo' ), //this is the text from preview box
                                                    'size' => '16px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            // HEADER FONT *********************************************************************************************
	        $id = 'header_font'; // Important!

            $of_options[] = array(  'name' => esc_html__( 'Header Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');
            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( 'Google font preview!', 'freelo' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['variant'] : '300',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishfreelotheme_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Font Size', 'freelo' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Line Height', 'freelo' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // H1 FONT *************************************************************************************************
            $id = 'h1_font'; // Important!

            $of_options[] = array(  'name' => esc_html__( 'H1', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( 'Google font preview!', 'freelo' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['variant'] : '300',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishfreelotheme_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Font Size', 'freelo' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Line Height', 'freelo' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // H2 FONT *************************************************************************************************
            $id = 'h2_font'; // Important!

            $of_options[] = array(  'name' => esc_html__( 'H2', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( 'Google font preview!', 'freelo' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['variant'] : '300',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishfreelotheme_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Font Size', 'freelo' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Line Height', 'freelo' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	         // H3 FONT ************************************************************************************************
            $id = 'h3_font'; // Important!

            $of_options[] = array(  'name' => esc_html__( 'H3', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( 'Google font preview!', 'freelo' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishfreelotheme_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Font Size', 'freelo' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Line Height', 'freelo' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            // H4 FONT *************************************************************************************************
	        $id = 'h4_font'; // Important!

            $of_options[] = array(  'name' => esc_html__( 'H4', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( 'Google font preview!', 'freelo' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishfreelotheme_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Font Size', 'freelo' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Line Height', 'freelo' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // H5 FONT *************************************************************************************************
            $id = 'h5_font'; // Important!

            $of_options[] = array(  'name' => esc_html__( 'H5', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( 'Google font preview!', 'freelo' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishfreelotheme_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Font Size', 'freelo' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Line Height', 'freelo' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	        // H6 FONT *************************************************************************************************
            $id = 'h6_font'; // Important!

            $of_options[] = array(  'name' => esc_html__( 'H6', 'freelo' ),
                                    'desc' => esc_html__( 'Font Type', 'freelo' ),
                                    'id' => $id . '_use_google_font',
                                    'std' => 1,
                                    'on' => 'Google',
                                    'off' => 'Regular',
                                    'folds' => 1,
                                    'type' => 'switch');

            // GOOGLE FONT
            $of_options[] = array( 	'name' => '', //  esc_html__( 'Theme Google Font', 'freelo' ),
                                    'desc' => esc_html__( 'Font Family', 'freelo' ),
                                    'id' =>  $id . '_google',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1,
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select_google_font',
                                    'preview' 	=> array(
                                                    'text' => esc_html__( 'Google font preview!', 'freelo' ), //this is the text from preview box
                                                    'size' => '30px' //this is the text size from preview box
                                    ),
                                    'options' 	=> $ish_googleFontsArray);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_google_variant',
                                    'std' => ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['variant'] : '400',
                                    'fold' => $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> ishfreelotheme_google_variants( ('google' == $ish_saved_fonts[$id]['type']) ? $ish_saved_fonts[$id]['name'] : ( ('google' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : ISHFREELOTHEME_FONT_1 ) ) );

            // REGULAR FONT
            $of_options[] = array(  'name' => '', //  esc_html__( 'Theme Regular Font', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Family', 'freelo' ),
                                    'id' => $id . '_regular',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'helvetica',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_fonts);

            $of_options[] = array(  'name' => '', //  esc_html__( 'Font Variant', 'freelo' ),
                                    'desc' =>  esc_html__( 'Font Variant', 'freelo' ),
                                    'id' => $id . '_regular_variant',
                                    'std' => ('regular' == $ishfreelotheme_fonts[$id]['type']) ? $ishfreelotheme_fonts[$id]['name'] : 'normal',
                                    'fold' => 'off_' . $id . '_use_google_font',
                                    'type' => 'select',
                                    'options' 	=> $ish_regular_variants);

            // OTHER SETTINGS
            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Font Size', 'freelo' ),
                                    'id' 		=> $id . '_size',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['size'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

            $of_options[] = array( 	'name' 		=> '',
                                    'desc' 		=> esc_html__( 'Line Height', 'freelo' ),
                                    'id' 		=> $id . '_line_height',
                                    'std' 		=> $ishfreelotheme_fonts[$id]['line_height'],
                                    "min" 		=> '0',
                                    "step"		=> '1',
                                    "max" 		=> '200',
                                    'type' 		=> 'sliderui' );

	    do_action( 'ish_theme_options_after_styling_options' );
	    do_action( 'ish_theme_options_before_woocommerce_options' );

        /* *************************************************************************************************************
         * 7. Woocommerce Settings
         */
        if (ishfreelotheme_woocommerce_plugin_active()){
            $of_options[] = array(  'name' => esc_html__( 'Woocommerce', 'freelo' ),
                                    'class' => 'woocommerce',
                                    'type' => 'heading');

	            // WOOCOMMERCE SIDEBAR *********************************************************************************
                $of_options[] = array(  'name' => esc_html__( 'Woocommerce Sidebar', 'freelo' ),
                                        'desc' => esc_html__( "Display the sidebar on each woocommerce page by default. This settings can be overridden in each page's settings.", 'freelo' ),
                                        'id' => 'show_woocommerce_sidebar',
                                        'std' => 0,
                                        'folds' => 1,
                                        'type' => 'switch');

                $of_options[] = array(  'name' => '', //'name' => esc_html__( 'Woocommerce Sidebar position', 'freelo' ),
                                        'desc'  => esc_html__( 'Choose whether to display the sidebar on the left or on the right side of woocommerce pages.', 'freelo' ),
                                        'id'    => 'woocommerce_sidebar_position',
                                        'std'   => 'right',
                                        'fold'  => 'show_woocommerce_sidebar',
                                        'type'  => 'select',
                                        'options' => array('left' => 'Left', 'right' => 'Right'));

                $of_options[] = array(  'name' => '', //'name' => esc_html__( 'Woocommerce Sidebar', 'freelo' ),
                                        'desc' => esc_html__( 'Select which sidebar will be displayed on each woocommerce page by default.', 'freelo' ),
                                        'id' => 'woocommerce_sidebar',
                                        'std' => 'sidebar-woocommerce',
                                        'fold' => 'show_woocommerce_sidebar',
                                        'type' => 'select',
                                        'options' => $of_sidebars);

	            // PRODUCTS PER PAGE ***********************************************************************************
                $of_options[] = array(  'name' => esc_html__( 'Products per Page', 'freelo' ),
                                        'desc' => esc_html__( 'Number of products displayed per page. To see all items set the value to "-1"', 'freelo' ),
                                        'id' => 'woocommerce_posts_per_page',
                                        'std' => '8',
                                        'type' => 'text');



                // PRODUCTS PER ROW ************************************************************************************
                $of_options[] = array(  'name' => esc_html__( 'Products per Row', 'freelo' ),
                                        'desc' => esc_html__( 'Number of products displayed per row (columns count).', 'freelo' ),
                                        'id' => 'woocommerce_posts_per_row',
                                        'std'   => '4',
                                        'type'  => 'select',
                                        'options' => array(
                                            '1' => '1',
                                            '2' => '2',
                                            '3' => '3',
                                            '4' => '4',
                                            '5' => '5',
                                            '6' => '6',
                                            ),
                                        );

                // PRODUCTS DETAIL PAGE ********************************************************************************
                $of_options[] = array(  'name' => esc_html__( 'Product Detail Page - Prev/Next & Sharing', 'freelo' ),
                                        'desc' => esc_html__( 'Choose what to display at the bottom of the Product Detail page.', 'freelo' ),
                                        'id' => 'woocommerce_single_product_details',
                                        'std' => 'nav-social',
                                        'type' => 'select',
                                        'options' => Array(
                                            ''  => esc_html__( 'None', 'freelo'),
                                            'nav'  => esc_html__( 'Prev/Next Navigation', 'freelo'),
                                            'social'  => esc_html__( 'Sharing Icons', 'freelo'),
                                            'nav-social'  => esc_html__( 'Prev/Next Navigation & Sharing Icons', 'freelo'),
                                        ),
                );
        }

	    do_action( 'ish_theme_options_after_woocommerce_options' );
	    do_action( 'ish_theme_options_before_plugins_options' );

        /* *************************************************************************************************************
         * 8. Plugins Options
         */
	    $section_options = Array();
	    $section_heading = Array(
		    array(  'name' => esc_html__( 'Plugins Options' , 'freelo' ),
                                'class' => 'pluginsoptions',
                                'type' => 'heading',
		    ),
	    );

	    // Allow plugins to create options
	    $section_options = apply_filters( 'ish_theme_options_section_content', $section_options, 'pluginsoptions' );

	    if ( count( $section_options ) >= 1 ){
		    $of_options = array_merge( $of_options, $section_heading, $section_options );
	    }

	    do_action( 'ish_theme_options_after_plugins_options' );
	    do_action( 'ish_theme_options_before_backup_options' );

        /* *************************************************************************************************************
         * 9. Backup Options
         */
        $of_options[] = array(  'name' => esc_html__( 'Backup Options' , 'freelo' ),
                                'class' => 'backupoptions',
                                'type' => 'heading');

	        // BACKUP & RESTORE ****************************************************************************************
            $of_options[] = array( 'name' => esc_html__( 'Backup and Restore Options', 'freelo' ),
                                'id' => 'of_backup',
                                'std' => '',
                                'type' => 'backup',
                                'desc' => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
                                );

	        // TRANSFER OPTIONS ****************************************************************************************
            $of_options[] = array( 'name' => esc_html__( 'Transfer Theme Options Data', 'freelo' ),
                                'id' => 'of_transfer',
                                'std' => '',
                                'type' => 'transfer',
                                'desc' => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
                                    ',
                                );

	    do_action( 'ish_theme_options_after_backup_options' );
	    do_action( 'ish_theme_options_before_themeupdate_options' );

        /* *************************************************************************************************************
         * 10. Theme Update
         */
        // This section was deprecated. Use Appearance > Theme License to get the latest updates.

		do_action( 'ish_theme_options_after_themeupdate_options' );
	    do_action( 'ish_theme_options_before_demo_import_options' );

        /* *************************************************************************************************************
         * 10. Demo Content
         */
        $of_options[] = array(  'name' => esc_html__( 'Demo Data Import', 'freelo' ),
                                'class' => 'demo_import',
                                'type' => 'heading');

	        // THEME UPDATE ********************************************************************************************
            $of_options[] = array(  'name' => esc_html__( 'Demo Data Import', 'freelo' ),
                                    'desc' => '',
                                    'id' => 'demo_import',
                                    'std' => '',
                                    'type' => 'demo_import');

	    do_action( 'ish_theme_options_after_demo_import_options' );

	}
}