<?php

global $ishfreelotheme_options, $ishfreelotheme_sidebar_width, $ishfreelotheme_sidebar_area, $ishfreelotheme_woo_id, $ishfreelotheme_id_404;

?>
<!doctype html>

<!--[if IE 8]><html class="ie8 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]><html class="ie9 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 10]><html class="ie10 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>><!--<![endif]-->

	<head>
		<meta charset="<?php bloginfo('charset'); ?>">

		<?php if ( function_exists( 'ishfreelotheme_meta_head' ) ){ ishfreelotheme_meta_head(); } ?>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- HTML5 enabling script -->
		<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

		<?php
		/*
		 * Call wp head
		 */
		if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }
		wp_head();
		?>

	</head>



    <body <?php body_class( ishfreelotheme_get_boxed_layout_class() . ' ' . ishfreelotheme_get_page_width_class() . ' ' . ishfreelotheme_get_responsive_layout_class() . ' ' . ishfreelotheme_is_sticky_nav_on() . ' ' . ishfreelotheme_is_sticky_nav_responsive_on() . ' ' . ishfreelotheme_is_header_bar_on() ); ?>>


	    <?php if ( ishfreelotheme_use_site_preloader() ) { ?>
	        <script type="text/javascript">
			    // Output the preloader HTML
		        document.write('<div id="ish-site-preloader-holder" class="ish-site-preloader-holder">' +
			    '<div class="ish-site-preloader-content">' +
			    '<div class="ish-site-preloader"><div class="ish-loader"></div></div>' +
			    '<div class="ish-site-preloader-text"><?php esc_html_e( '', 'freelo' ); ?></div>' +
			    '</div>' +
			    '</div>');

			    // Manually remove preloader window after 5 seconds in case JS Error blocks the onload event to be carried out succesfully
		        setTimeout( function(){
			        document.getElementById("ish-site-preloader-holder").style.display = 'none';
		        } , 5000 );
	    </script>
	    <?php } ?>

        <?php
	    if ( ishfreelotheme_use_sidenav() ) {
	    ?>
        <!-- Floated menu -->
	    <div class="ish-sidenav <?php echo ishfreelotheme_get_sidenav_position_class(); ?>">
		    <a href="#close" class="ish-sidenav-close ish-icon-cancel-outline" title="<?php esc_html_e( 'Close Side Navigation (ESC)', 'freelo' ); ?>"></a>

			<div class="ish-row ish-row-notfull">
				<div class="ish-row_inner">
					<?php

					$ishfreelotheme_sidebar_width = 12; // Used when displaying widgets
					$ishfreelotheme_sidebar_area = 'menu-sidebar'; // Used when displaying widgets
					$sidebar = ishfreelotheme_get_sidenav_sidebar();
					if (function_exists( 'dynamic_sidebar') && dynamic_sidebar($sidebar)) : else : ?>

						<div class="pre-widget">
							<div class="space"></div>
							<p><strong>Widgetized Sidebar</strong></p>
							<p>This panel is active and ready for you to add some widgets via the WP Admin</p>
						</div>

					<?php endif;

					?>

				</div>
			</div>

	    </div>
	    <!-- Floated menu END -->
	    <?php
	    }
	    ?>



        <div class="ish-body">

		    <!-- Expandable part section -->
		    <?php if ( ishfreelotheme_use_expandable_header() ){?>
			    <section class="ish-part_expandable ish-a-expandable">

				    <!-- Must be one layer more because of min-height if content is less than height of browser -->
				    <div class="ish-pe-bg">

					    <a href="#close" class="ish-pe-close ish-icon-cancel-outline" title="<?php esc_html_e( 'Close Expandable (ESC)', 'freelo' ); ?>"></a>

					    <div class="ish-row ish-row-notfull">
						    <div class="ish-row_inner">
							    <?php $ishfreelotheme_sidebar_width = 12; ?>
							    <?php $ishfreelotheme_sidebar_area = 'expandable-sidebar'; // Used when displaying widgets ?>

							    <?php if (function_exists( 'dynamic_sidebar') && dynamic_sidebar(ishfreelotheme_get_expandable_header())) : else : ?>

								    <!-- NO WIDGETS -->

							    <?php endif; ?>
						    </div>
					    </div>

					</div>

			    </section>
		    <?php } ?>
		    <!-- Expandable part section END -->


		    <!-- Search bar -->
		    <section class="ish-part_searchbar ish-a-search">
			    <div>
				    <?php get_template_part( 'searchform-header' ); ?>
			    </div>
		    </section>
		    <!-- Search bar END -->


		    <!-- Wrap whole page -->
		    <div class="ish-wrapper-all">

			    <?php ;
			    if ( ishfreelotheme_use_header_bar() ){?>
				    <!-- Top Header Bar Section -->
				    <section class="ish-part_header_bar">
					    <div class="ish-row ish-row-notfull">
						    <div class="ish-row_inner">

							    <div class="<?php echo ( isset( $ishfreelotheme_options['header_bar_order'] ) && ( 'social-right' != $ishfreelotheme_options['header_bar_order']) )?  'ish-hb-left ish-hb-social' : 'ish-hb-right ish-hb-social'; ?>">
								    <?php if ( isset($ishfreelotheme_options['social_icons_bar']) && ('' != $ishfreelotheme_options['social_icons_bar']) ) {
									    if ( shortcode_exists( 'ish_icon' ) ) {
										    $hb_icons = do_shortcode($ishfreelotheme_options['social_icons_bar']);
										    $hb_icons = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $hb_icons );
										    echo apply_filters( 'ishfreelotheme_header_bar_icons_output', $hb_icons);
									    }
								    }?>
							    </div>

							    <div class="<?php echo ( isset( $ishfreelotheme_options['header_bar_order'] ) && ( 'social-right' != $ishfreelotheme_options['header_bar_order']) )?  'ish-hb-right  ish-hb-menu' : 'ish-hb-left ish-hb-menu'; ?>">


								    <!-- Header Bar navigation -->
								    <nav class="ish-top_nav_container">
									    <?php
									    if ( isset( $ishfreelotheme_options['header_bar_menu'] ) && ( '' != $ishfreelotheme_options['header_bar_menu'] ) ) {
										    if ( 'none' == $ishfreelotheme_options['header_bar_menu'] ){
											    // Do not output any menu in this case
										    } else {
										        wp_nav_menu( array( 'theme_location' => 'header-bar-menu', 'menu' => $ishfreelotheme_options['header_bar_menu'], 'container' => '', 'menu_id' => 'top_bar_nav', 'menu_class' => 'ish-top_nav', 'container_class' => 'ish-phb-center', 'fallback_cb' => 'ishfreelotheme_empty_header_bar_menu_fallback' ) );
										    }
									    }else{
										    wp_nav_menu( array( 'theme_location' => 'header-bar-menu', 'container' => '', 'menu_id' => 'top_bar_nav', 'menu_class' => 'ish-top_nav', 'container_class' => 'ish-phb-center', 'fallback_cb' => 'ishfreelotheme_empty_header_bar_menu_fallback' ) );
									    }
									    ?>

									    <?php if ( 'none' != $ishfreelotheme_options['header_bar_menu'] ){ ?>
										    <!-- Responsive Header Bar Navigation -->
										    <?php ishfreelotheme_create_header_bar_resp_nav(); ?>
									    <?php } ?>

								    </nav>

							    </div>

						    </div>
					    </div>
				    </section>
				    <!-- Top Header Bar Section END -->
			    <?php } ?>

		        <!-- Header part section -->
			    <?php $header_colors_class = ishfreelotheme_get_header_color_class(); ?>
			    <section class="ish-part_header<?php echo ' ' . $header_colors_class ?>">
				    <div class="ish-row ish-row-notfull">
					    <div class="ish-row_inner">



						    <!-- Logo image / text -->
							<?php if ( ishfreelotheme_use_logo() && ishfreelotheme_is_logo( $header_colors_class ) ){ ?>
							    <a class="ish-ph-logo <?php echo ( ishfreelotheme_use_logo() && ishfreelotheme_is_retina_logo( $header_colors_class ) ) ? 'ish-ph-logo_retina-yes' : 'ish-ph-logo_retina-no'; ?>" href="<?php echo esc_attr( apply_filters( 'ishfreelotheme_logo_url', home_url() ) ); ?>">
								    <span>
									    <img src="<?php echo ishfreelotheme_get_logo($header_colors_class); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" />
									</span>
							    </a>
						    <?php } else { ?>
							    <a class="ish-ph-logo" href="<?php echo esc_url( apply_filters( 'ishfreelotheme_logo_url', home_url( '/' ) ) ); ?>">
								    <span>
									    <?php echo esc_attr(get_bloginfo('name')); ?>
								    </span>
							    </a>
						    <?php } ?>

						    <!-- Default WordPress tagline -->
						    <?php

						    if ('' != get_bloginfo('description') ) {
							    ?><span class="ish-ph-wp_tagline"><span><?php echo get_bloginfo('description'); ?></span></span><?php
						    }
						    ?>

						    <!-- Main navigation -->
						    <nav class="ish-ph-main_nav">
							    <?php if ( ! ishfreelotheme_use_sidenav() ) {
							        $main_menu = ishfreelotheme_get_mainnav_menu();
								    $nav_type_class = ishfreelotheme_get_mainnav_type_class();
								    if ( '' != $main_menu ) {
									    wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu' => $main_menu, 'container' => '', 'menu_id' => 'mainnav', 'menu_class' => 'ish-ph-mn-main_nav' . ' ' . $nav_type_class, 'container_class' => 'ish-ph-mn-center', 'fallback_cb' => 'ishfreelotheme_empty_menu_fallback' ) );
								    }else{
									    wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'menu_id' => 'mainnav', 'menu_class' => 'ish-ph-mn-main_nav' . ' ' . $nav_type_class, 'container_class' => 'ish-ph-mn-center', 'fallback_cb' => 'ishfreelotheme_empty_menu_fallback' ) );
								    }

								} ?>

							    <!-- Responsive or sidenav navigation -->
							    <?php ishfreelotheme_create_resp_nav(); ?>

						    </nav>
						</div>
					</div>
				</section>
		        <!-- Header part section END -->
