<?php

/* *********************************************************************************************************************
 *
 * TABLE OF CONTENTS:
 *
 * 1. Global Variables, Constants and Necessary theme files inclusion
 * 2. Theme Setup, Filters and Global Functions
 * 3. IshYoBoy Framework Activation
 *
 * ********************************************************************************************************************/









/* *********************************************************************************************************************
 *
 * 1. Global Variables, Constants and Necessary theme files inclusion
 *
 * ********************************************************************************************************************/

require_once( get_template_directory() . '/assets/functions/general.php' );
require_once( get_template_directory() . '/assets/functions/layout.php' );
require_once( get_template_directory() . '/assets/functions/nav.php' );
require_once( get_template_directory() . '/assets/functions/widgets.php' );
require_once( get_template_directory() . '/assets/functions/filters.php' );
require_once( get_template_directory() . '/assets/functions/blog.php' );
require_once( get_template_directory() . '/assets/functions/ajax.php' );
require_once( get_template_directory() . '/assets/functions/theme-plugin-functions.php' );

/*
 * Page width / content width
 */
define( 'ISHFREELOTHEME_PAGE_WIDTH', '100%' );
define( 'ISHFREELOTHEME_PAGE_WIDTH_PIXELS', '1240' );
define( 'ISHFREELOTHEME_BREAKINGPOINT', 768);
define( 'ISHFREELOTHEME_NAV_BREAKINGPOINT', 1060);

if ( ! defined( 'ISHFREELOTHEME_GAP_BIG' ) ){	define( 'ISHFREELOTHEME_GAP_BIG' , 60 ); }
if ( ! defined( 'ISHFREELOTHEME_GAP_SMALL' ) ){ define( 'ISHFREELOTHEME_GAP_SMALL' , 60 ); }

if ( ! isset( $content_width ) ) $content_width = 1120;


/*
 * URI & DIR
 */
if ( get_stylesheet_directory() == get_template_directory() ) {
	define( 'ISHFREELOTHEME_STYLESHEET_URI', get_template_directory_uri() );
	define( 'ISHFREELOTHEME_STYLESHEET_DIR', get_template_directory() );
} else {
	define( 'ISHFREELOTHEME_STYLESHEET_URI', get_stylesheet_directory_uri() );
	define( 'ISHFREELOTHEME_STYLESHEET_DIR', get_stylesheet_directory() );
}

define( 'ISHFREELOTHEME_HTML_URI', get_template_directory_uri() . '/assets/frontend' );

define( 'ISHFREELOTHEME_THEME_SLUG', 'freelo' );
define( 'ISHFREELOTHEME_PATH_ISHYOBOY_URL', 'http://themes.ishyoboy.com' );

if( is_child_theme() ) {
	$temp_obj = wp_get_theme();
	$theme_obj = wp_get_theme( $temp_obj->get('Template') );
} else {
	$theme_obj = wp_get_theme();
}

define( 'ISHFREELOTHEME_PARENT_THEME_NAME', $theme_obj->get('Name') );

// Generate dynamic.css on every Theme Options Save. If false the css will be output in the body of every page
if ( ! defined( 'ISHFREELOTHEME_GENERATE_DYNAMIC_CSS' ) ){
	define( 'ISHFREELOTHEME_GENERATE_DYNAMIC_CSS' , true );
}

// Due to IE9 MAX 4095 CSS Selectors per file error, we need to split the mani-options css file or fallback into more files
if ( ! defined( 'ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT' ) ){
	define( 'ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT' , 10 );
}

// Default Tagline Opacity
if ( ! defined( 'ISHFREELOTHEME_TAGLINE_OPACITY' ) ){
	define( 'ISHFREELOTHEME_TAGLINE_OPACITY' , 100 ); // Integer - Representing percents between 0 - 100
}

// Default Blog Opacity
if ( ! defined( 'ISHFREELOTHEME_BLOG_OPACITY' ) ){
	define( 'ISHFREELOTHEME_BLOG_OPACITY' , 50 ); // Integer - Representing percents between 0 - 100
}

// Default Portfolio Opacity
if ( ! defined( 'ISHFREELOTHEME_PORTFOLIO_OPACITY' ) ){
	define( 'ISHFREELOTHEME_PORTFOLIO_OPACITY' , 100 ); // Integer - Representing percents between 0 - 100
}

// Default Portfolio Opacity
if ( ! defined( 'ISHFREELOTHEME_WOOCOMMERCE_ENABLED' ) ){
	define( 'ISHFREELOTHEME_WOOCOMMERCE_ENABLED' , false ); // Disable Woocommerce demo import
}


/*
 * Default Color Values for Theme Options
 *
 * These are the default color used by the theme. They can later be changed via the admin
 *
 */

define( 'ISHFREELOTHEME_COLOR_1', '#717879');
define( 'ISHFREELOTHEME_COLOR_2', '#bac2c4');
define( 'ISHFREELOTHEME_COLOR_3', '#f9f9f9');
define( 'ISHFREELOTHEME_COLOR_4', '#ffffff');
define( 'ISHFREELOTHEME_TEXT_COLOR', '#717879');
define( 'ISHFREELOTHEME_BODY_COLOR', '#f9f9f9');
define( 'ISHFREELOTHEME_BACKGROUND_COLOR', '#b3aba6');  // Depends on the BG pattern
if ( ! defined( 'ISHFREELOTHEME_COLORS_COUNT' ) ){
	define( 'ISHFREELOTHEME_COLORS_COUNT', 25);  // Number of colors
}
define( 'ISHFREELOTHEME_BASE_COLORS_COUNT', 5);  // Number of base colors

define( 'ISHFREELOTHEME_COLOR_5',  '#7bc5a6'); // Main Theme Color - Blue
define( 'ISHFREELOTHEME_COLOR_6',  '#f1f3f3'); // Grayish
define( 'ISHFREELOTHEME_COLOR_7',  '#434949'); // Dark Gray
define( 'ISHFREELOTHEME_COLOR_8',  '#11c4f7');
define( 'ISHFREELOTHEME_COLOR_9',  '#fbba00');
define( 'ISHFREELOTHEME_COLOR_10', '#472025');
define( 'ISHFREELOTHEME_COLOR_11', '#ee295e');
define( 'ISHFREELOTHEME_COLOR_12', '#71bac9');

// SOCIAL
define( 'ISHFREELOTHEME_COLOR_13', '#3b5998'); // Facebook
define( 'ISHFREELOTHEME_COLOR_14', '#ea4c89'); // Dribbble
define( 'ISHFREELOTHEME_COLOR_15', '#1769ff'); // Behance
define( 'ISHFREELOTHEME_COLOR_16', '#d14836'); // Google+
define( 'ISHFREELOTHEME_COLOR_17', '#55acee'); // Twitter
define( 'ISHFREELOTHEME_COLOR_18', '#cb2027'); // Pinterest


define( 'ISHFREELOTHEME_COLOR_19', '#efb4b6');
define( 'ISHFREELOTHEME_COLOR_20', '#9e9bba');
define( 'ISHFREELOTHEME_COLOR_21', '#a8e7de');
define( 'ISHFREELOTHEME_COLOR_22', '#ede9aa');
define( 'ISHFREELOTHEME_COLOR_23', '#e99555');
define( 'ISHFREELOTHEME_COLOR_24', '#000000');
define( 'ISHFREELOTHEME_COLOR_25', '#ffffff');

/*
 * Fonts
 */
define( 'ISHFREELOTHEME_FONT_1', 'Playfair Display');
define( 'ISHFREELOTHEME_FONT_2', 'Dosis');
//define( 'ISHFREELOTHEME_FONT_3', 'Montserrat');

// Will be used to store all fonts settings
$ishfreelotheme_fonts = array(
	// Main Page Content
	'body_font' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_2,
		'variant' => 'regular',
		'size' => '18',
		'line_height' => '30'
	),
	// Additionale elements like buttons, filter, widget links, etc..
	'body_font_2' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_1,
		'variant' => '700italic', // Unused
		'size' => '18', // Unused
		'line_height' => '' // Unused
	),
	'header_font' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_2,
		'variant' => 'regular',
		'size' => '14',
		'line_height' => '18'
	),
	'h1_font' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_1,
		'variant' => '700italic',
		'size' => '52',
		'line_height' => '60'
	),
	'h2_font' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_1,
		'variant' => '700italic',
		'size' => '42',
		'line_height' => '55'
	),
	'h3_font' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_1,
		'variant' => '700italic',
		'size' => '34',
		'line_height' => '44'
	),
	'h4_font' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_1,
		'variant' => '700italic',
		'size' => '24',
		'line_height' => '40'
	),
	'h5_font' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_2,
		'variant' => 'regular',
		'size' => '17',
		'line_height' => '30'
	),
	'h6_font' => array(
		'type' => 'google',
		'name' => ISHFREELOTHEME_FONT_2,
		'variant' => 'regular',
		'size' => '14',
		'line_height' => '24'
	)
);

/*
 * Sidenav
 */
if ( ! defined( 'ISHFREELOTHEME_SIDENAV_WIDTH' ) ) {
	define( 'ISHFREELOTHEME_SIDENAV_WIDTH', '400px' );  // Width in "%" or "px"
}

/*
 * Filters
 */

add_filter( 'ishfreelotheme_part_content_classes', 'ishfreelotheme_part_content_classes', 10, 2);
add_filter( 'ishfreelotheme_the_content', 'ishfreelotheme_the_content_line_open', 10, 1);
add_filter( 'ishfreelotheme_the_content', 'ishfreelotheme_the_content_line_close', 20, 1);
add_filter( 'ishfreelotheme_the_content', 'ishfreelotheme_the_content_remove_decor_padding_classes', 30, 1);
add_filter( 'ishfreelotheme_the_content', 'ishfreelotheme_taglines_separator', 40, 1);
add_filter( 'ishfreelotheme_the_taglines_separator', 'ishfreelotheme_taglines_separator', 10, 1);

add_filter( 'ishfreelotheme_the_content', 'ishfreelotheme_the_content_home_separator', 20, 1 );

// Allow SVG files in Media Library
add_filter( 'upload_mimes', 'ishfreelotheme_mime_types' );

// Fix youtube video embeds floating over the sticky navigation in IE11
add_filter( 'embed_oembed_html', 'ishfreelotheme_add_video_wmode_transparent', 10, 3 );


/*
 * Misc
 */

if ( ! defined( 'ISHFREELOTHEME_DEFAULT_BOXED_LAYOUT' ) ) { define ( 'ISHFREELOTHEME_DEFAULT_BOXED_LAYOUT', 'unboxed'); };
if ( ! defined( 'ISHFREELOTHEME_DEFAULT_HEADER_HEIGHT' ) ) { define ( 'ISHFREELOTHEME_DEFAULT_HEADER_HEIGHT', '150' ); };
if ( ! defined( 'ISHFREELOTHEME_DEFAULT_STICKY_HEIGHT' ) ) { define ( 'ISHFREELOTHEME_DEFAULT_STICKY_HEIGHT', '80' ); };
if ( ! defined( 'ISHFREELOTHEME_DEFAULT_HEADER_OPACITY' ) ) { define ( 'ISHFREELOTHEME_DEFAULT_HEADER_OPACITY', '100' ); };
if ( ! defined( 'ISHFREELOTHEME_DEFAULT_HEADER_BAR_OPACITY' ) ) { define ( 'ISHFREELOTHEME_DEFAULT_HEADER_BAR_OPACITY', '100' ); };
if ( ! defined( 'ISHFREELOTHEME_DEFAULT_HEADER_BAR_HEIGHT' ) ) { define ( 'ISHFREELOTHEME_DEFAULT_HEADER_BAR_HEIGHT', '40' ); };
if ( ! defined( 'ISHFREELOTHEME_DEFAULT_SKIN' ) ) { define ( 'ISHFREELOTHEME_DEFAULT_SKIN', 'theme_freelance.php' ); };
if ( ! defined( 'ISHFREELOTHEME_WEBSITE_BORDER_WIDTH' ) ){ define( 'ISHFREELOTHEME_WEBSITE_BORDER_WIDTH' , '20' ); }
if ( ! defined( 'ISHFREELOTHEME_WEBSITE_BORDER_COLOR' ) ){ define( 'ISHFREELOTHEME_WEBSITE_BORDER_COLOR' , '#ffffff' ); }










/* *********************************************************************************************************************
 *
 * 2. Theme Setup, Filters and Global Functions
 *
 * ********************************************************************************************************************/


if ( ! function_exists( 'ishfreelotheme_theme_setup' ) ) {
	function ishfreelotheme_theme_setup() {

		// Adding support for post-formats WP 3.1+
		add_theme_support( 'post-formats', array( 'image', 'audio', 'video', 'link', 'quote') );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		aside - Typically styled without a title. Similar to a Facebook note update.
		gallery - A gallery of images. Post will likely contain a gallery shortcode and will have image attachments.
		link - A link to another site. Themes may wish to use the first <a href=””> tag in the post content as the external link for that post. An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it.                                                                                                                                                                                                                                                                                                               image - A single image. The first <img /> tag in the post could be considered the image. Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image.
		quote - A quotation. Probably will contain a blockquote holding the quote content. Alternatively, the quote may be just the content, with the source/author being the title.
		status - A short status update, similar to a Twitter status update.
		video - A single video. The first <video /> tag or object/embed in the post content could be considered the video. Alternatively, if the post consists only of a URL, that will be the video URL. May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin).
		audio - An audio file. Could be used for Podcasting.
		chat - A chat transcript
		/**/
	}
}
add_action( 'after_setup_theme', 'ishfreelotheme_theme_setup' );


/*
 * Extend Widgets
 */
if ( ! function_exists( 'ishfreelotheme_extend_widgets' ) ) {
	function ishfreelotheme_extend_widgets() {

		// Add the new fields and let them update on widget update
		if ( is_admin() ){
			add_filter( 'widget_form_callback', 'ishfreelotheme_widget_form_extend', 10, 2);
			add_filter( 'widget_form_callback', 'ishfreelotheme_widget_icon_field', 10, 2);
			add_filter( 'widget_update_callback', 'ishfreelotheme_widget_update', 10, 3 );
		}

	}
}
add_action( 'after_setup_theme', 'ishfreelotheme_extend_widgets' );


/*
 * Load other local js files
 */
if ( ! function_exists( 'ishfreelotheme_load_my_scripts' ) ) {
	function ishfreelotheme_load_my_scripts() {

		// Vendor ------------------------------------------------------------------------------------------------------
		global $smof_wpml_prefix, $ishfreelotheme_options;

		$uploads = wp_upload_dir();
		$uploads_dir = trailingslashit( $uploads['basedir'] ) . ISHFREELOTHEME_THEME_SLUG . '_css';
		$uploads_url = trailingslashit( $uploads['baseurl'] ) . ISHFREELOTHEME_THEME_SLUG . '_css';

		// HTTPS or SSL fix
		if ( is_ssl() ) {
			$uploads_url = str_replace( 'http://', 'https://', $uploads_url );
		}

		wp_register_style( 'ishfreelotheme-fontello', get_template_directory_uri() . '/assets/frontend/css/ish-fontello.css');
		wp_enqueue_style( 'ishfreelotheme-fontello' );

		wp_register_style( 'ishfreelotheme-styles', ISHFREELOTHEME_STYLESHEET_URI . '/style.css');
		wp_enqueue_style( 'ishfreelotheme-styles' );

		wp_register_style('ishfreelotheme-tooltipster', get_template_directory_uri() . '/assets/frontend/css/plugins/tooltipster.css');
		wp_enqueue_style( 'ishfreelotheme-tooltipster' );


		// Include the generated dynamic.css into head links
		if ( ( ! defined( 'ISHFREELOTHEME_GENERATE_DYNAMIC_CSS' ) ) || ISHFREELOTHEME_GENERATE_DYNAMIC_CSS ){
			if ( file_exists( $uploads_dir . '/main-options' . $smof_wpml_prefix . '.css' ) ){
				$ver = get_option( 'ishfreelotheme_generated_css_version' . $smof_wpml_prefix );
				wp_register_style( 'ishfreelotheme-main-options', $uploads_url . '/main-options' . $smof_wpml_prefix . '.css', null, $ver );
				wp_enqueue_style( 'ishfreelotheme-main-options' );


				// Load all main-options files
				for ( $i = 1; $i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < ISHFREELOTHEME_COLORS_COUNT ;$i++){
					if  ( file_exists( $uploads_dir . '/main-options' . $smof_wpml_prefix . '_' . ($i +1) . '.css' ) ){
						$ver = get_option( 'ishfreelotheme_generated_css_version' . $smof_wpml_prefix );
						wp_register_style( 'ishfreelotheme-main-options-' . ($i +1), $uploads_url . '/main-options' . $smof_wpml_prefix . '_' . ($i +1) . '.css', null, $ver );
						wp_enqueue_style( 'ishfreelotheme-main-options-' . ($i +1) );
					}
				}

			}
		}

		do_action( 'ishfreelotheme_enque_skin_css' );

		// Load only if smoothscroll is enabled in TO
		if ( ishfreelotheme_body_smoothscroll() ) {
			wp_register_script( 'ishfreelotheme-smoothscroll', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.smoothscroll.min.js', array('jquery'), null, true );
			wp_enqueue_script( 'ishfreelotheme-smoothscroll' );
		}

		wp_register_script( 'ishfreelotheme-flexslider', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.flexslider-min.js', array('jquery'), null, true );

		wp_register_script( 'ishfreelotheme-owl-slider', get_template_directory_uri() . '/assets/frontend/js/vendor/owl.carousel.min.js', array('jquery'), null, true );

		wp_register_script( 'ishfreelotheme-packery', get_template_directory_uri() . '/assets/frontend/js/vendor/packery.pkgd.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'ishfreelotheme-packery' );

		wp_register_script( 'ishfreelotheme-imagesloaded', get_template_directory_uri() . '/assets/frontend/js/vendor/imagesloaded.pkgd.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'ishfreelotheme-imagesloaded' );

		wp_register_script( 'ishfreelotheme-scrollTo-js', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.scrollTo.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'ishfreelotheme-scrollTo-js' );

		wp_register_script( 'ishfreelotheme-fancybox', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.fancybox.pack.js', array('jquery'), null, true );
		wp_enqueue_script( 'ishfreelotheme-fancybox' );

		wp_register_style( 'ishfreelotheme-fancybox', get_template_directory_uri() . '/assets/frontend/css/plugins/jquery.fancybox.css' );
		wp_enqueue_style( 'ishfreelotheme-fancybox' );

		/* Using a modified version. Check comment in file. */
		wp_register_script( 'ishfreelotheme-tooltipster', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.tooltipster.min.js', array('jquery'), null, true );
		wp_enqueue_script( 'ishfreelotheme-tooltipster' );

		wp_register_script( 'ishfreelotheme-easy_pie_chart', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.easy-pie-chart.js', array('jquery'), null, true );

		wp_register_script( 'ishfreelotheme-backgroundpos', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.backgroundpos.min.js', array('jquery'), null, true );

		wp_register_script( 'ishfreelotheme-parallax', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.parallax-1.1.3.js', array('jquery'), null, true );

		wp_register_script( 'ishfreelotheme-easing', get_template_directory_uri() . '/assets/frontend/js/vendor/jquery.easing-1.3.pack.js', array('jquery'), null, true );
		wp_enqueue_script( 'ishfreelotheme-easing' );

		// Custom ------------------------------------------------------------------------------------------------------
		do_action( 'ishfreelotheme_before_mainjs' );

		wp_register_script( 'ishfreelotheme-main', get_template_directory_uri() . '/assets/frontend/js/main.js', array('jquery'), null, true );
		wp_enqueue_script( 'ishfreelotheme-main' );

		$page_width = trim(ISHFREELOTHEME_PAGE_WIDTH);
		$page_width_units = 'px';

		if ( isset( $ishfreelotheme_options ) ) {
			if ( isset( $ishfreelotheme_options['use_predefined_page_width'] ) && '1' == $ishfreelotheme_options['use_predefined_page_width'] ) {
				if ( isset( $ishfreelotheme_options['predefined_page_width'] ) && '' != $ishfreelotheme_options['predefined_page_width'] ) {
					$page_width = $ishfreelotheme_options['predefined_page_width'];
				}
			} else {
				if ( isset( $ishfreelotheme_options['custom_page_width'] ) && '' != $ishfreelotheme_options['custom_page_width'] ) {
					$page_width = $ishfreelotheme_options['custom_page_width'];
				}
			}

			// Ensure percents are supported
			if ( false !== strpos($page_width, '%') ){
				$page_width = str_replace( '%', '', $page_width );
				$page_width_units = '%';
			}else {
				$page_width = str_replace( 'px', '', $page_width );
			}
		}

		/** Localize Scripts */
		$php_array = array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) ,
			'js_uri' => get_template_directory_uri() . '/assets/frontend/js' ,
			'header_height' => ( isset( $ishfreelotheme_options ) && isset($ishfreelotheme_options['header_height'])) ? $ishfreelotheme_options['header_height'] : ISHFREELOTHEME_DEFAULT_HEADER_HEIGHT,
			'sticky_height' => ( isset( $ishfreelotheme_options ) && isset($ishfreelotheme_options['sticky_height'])) ? $ishfreelotheme_options['sticky_height'] : ISHFREELOTHEME_DEFAULT_STICKY_HEIGHT,
			'colors' => Array(),
			'sidenav_width' => ISHFREELOTHEME_SIDENAV_WIDTH,
			'page_width' => ISHFREELOTHEME_PAGE_WIDTH,
			'website_border_width' => ( isset( $ishfreelotheme_options ) && isset($ishfreelotheme_options['use_website_border']) && 1 == $ishfreelotheme_options['use_website_border']) ? ISHFREELOTHEME_WEBSITE_BORDER_WIDTH  : 0,
			'user_page_width' => $page_width,
			'user_page_width_units' =>$page_width_units,
		);

		if ( isset($ishfreelotheme_options) ) {

			for ($i = 1; $i <= 50; $i++){
				if ( isset( $ishfreelotheme_options['color' . $i] ) ){
					$php_array['colors']['color' . $i] = $ishfreelotheme_options['color' . $i];
				}
			}

		}

		wp_localize_script( 'ishfreelotheme-main', 'iyb_globals', $php_array );

		do_action( 'ishfreelotheme_after_mainjs' );

		do_action( 'ishfreelotheme_enque_skinme_scripts' );

		wp_enqueue_style( 'wp-mediaelement' );

	}
}
add_action( 'wp_enqueue_scripts', 'ishfreelotheme_load_my_scripts' );
add_action( 'wp_enqueue_scripts', 'ishfreelotheme_set_javascritp_globals');


/*
 * Enable thumbnail support
 */
if ( function_exists( 'add_theme_support' ) ) {

	add_theme_support( 'post-thumbnails', array(
		'post', 'page'
	));

	if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
		update_option('thumbnail_size_w',70);
		update_option('thumbnail_size_h',70);
		update_option('thumbnail_crop', 1);
	}

	add_image_size( 'theme-large', 1170, 9999, false );
	add_image_size( 'theme-half', 571, 9999, false );
	add_image_size( 'theme-third', 371, 9999, false );
	add_image_size( 'theme-fourth', 271, 9999, false );
	add_image_size( 'theme-thumbnail', 200, 200, true );
}

if ( ! function_exists( 'ishfreelotheme_image_sizes_choose' ) ) {
	function ishfreelotheme_image_sizes_choose( $sizes ) {
		$custom_sizes = array(
			'theme-large' => 'Theme Full',
			'theme-half' => 'Theme Half',
			'theme-third' => 'Theme Third',
			'theme-fourth' => 'Theme Fourth',
			'theme-thumbnail' => 'Theme Thumbnail'
		);
		return array_merge( $sizes, $custom_sizes );
	}
}
add_filter( 'image_size_names_choose', 'ishfreelotheme_image_sizes_choose' );


/*
 * Comments display function
 */
$comment_index = 0;

if ( ! function_exists( 'ishfreelotheme_comments' ) ) {
	function ishfreelotheme_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		global $allowedposttags, $allowedtags, $comment_index, $post;

		?>

		<?php
		// Comments counter
		$comment_index++;
		?>

		<!--display comment header-->
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<span class="comment-avatar"><?php echo get_avatar($comment, $size = '70') ?></span>
			<div class="blog-post-details">
				<div class="comment-tools">
					<span class="comment-author">
						<?php
						if ( ! empty( $post ) ) {
							if ( $comment->user_id === $post->post_author )
								echo '(' . esc_html__( 'Author', 'freelo' ) . ')';
						}
						?>

						<?php echo get_comment_author(); ?>
					</span>

					<span class="ish-spacer"> / </span>

					<span><?php echo get_comment_date(); ?></span>

					<span class="ish-spacer"> / </span>


					<?php echo get_comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

					<?php $edit =  get_edit_comment_link(); ?>
					<?php if ( $edit ) { ?>
						<span class="ish-spacer">/</span>
						<a class="comment-edit-link" href="<?php echo esc_url( $edit ); ?>"><?php echo esc_html__( 'Edit', 'freelo' ) ?></a>
		            <?php } ?>
				</div>

				<?php if ($comment->comment_approved == '0') : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'freelo' ) ?></em>
					<br />
				<?php endif; ?>

				<?php comment_text(); ?>
			</div>
		<?php //</li> Removed due to https://codex.wordpress.org/Function_Reference/wp_list_comments - "callback" parameter ?>
	<?php
	}
}


/**
 * Change the default setting for comments on Pages. Make them closed by default.
 */
if ( ! function_exists( 'ishfreelotheme_default_content_page' ) ) {
	function ishfreelotheme_default_content_page( $post_content, $post ) {
		if( $post->post_type )
			switch( $post->post_type ) {
				case 'page':
					$post->comment_status = 'closed';
					break;
			}
		return $post_content;
	}
}
add_filter( 'default_content', 'ishfreelotheme_default_content_page', 10, 2 );


/*
 * Slideshow/Image print
 */
if ( ! function_exists( 'ishfreelotheme_slideshow' ) ) {
	function ishfreelotheme_slideshow($postid, $imagesize, $type = '', $fancybox = false) {
		$loader = 'ajax-loader.gif';
		$thumbid = 0;

		// get the featured image for the post
		if( has_post_thumbnail($postid) ) {
			$thumbid = get_post_thumbnail_id($postid);
		}

		// get all of the attachments for the post
		$args = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'attachment',
			'post_parent' => $postid,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);

		$attachments = get_posts($args);

		if ( 'slideshow' != $type ){
			// IMAGE ONLY
			if( !empty($attachments) ) {
				$i = 0;
				$count = count($attachments);
				foreach( $attachments as $attachment ) {

					$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;
					$description = $attachment->post_content;
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

					echo "<div>";

					if ($fancybox){
						$img_details = wp_get_attachment_image_src( $attachment->ID, 'full' );
						echo '<a href="' . esc_attr($img_details[0]) . '" data-fancybox-group="portfolio-box-' . $postid . '" class="openfancybox-image">';
					}

					echo "<img height='$details[2]' width='$details[1]' src='$details[0]' alt='" . esc_attr(strip_tags($alt)) . "' title='" . esc_attr(strip_tags($caption)) . "' class='mask'/>";

					if ($fancybox){
						echo '</a>';
					}

					echo "</div>\n";
					if ( $count > 1 ){
						echo "<div class='divider'></div>\n";
					}

					$i++;
				}
			}
			else{
				echo '<div>';

				if ($fancybox){
					$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($postid), 'full' );
					echo '<a href="' . esc_attr($img_details[0]) . '" class="openfancybox-image">';
				}

				the_post_thumbnail( 'theme-large' , array(  'class' => 'mask') );

				if ($fancybox){
					echo '</a>';
				}

				echo "</div>\n";
			}
		}
		else {
			// SLIDESHOW
			echo "<div class='slides'><div class='slides_container'>\n";

			if( !empty($attachments) ) {
				$i = 0;
				foreach( $attachments as $attachment ) {

					$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

					echo "<div>";

					if ($fancybox){
						$img_details = wp_get_attachment_image_src( $attachment->ID, 'full' );
						echo '<a href="' . esc_attr($img_details[0]) . '" data-fancybox-group="portfolio-box-' . $postid . '" class="openfancybox-image">';
					}

					echo "<img height='$details[2]' width='$details[1]' src='$details[0]' alt='" . esc_attr(strip_tags($alt)) . "' title='" . esc_attr(strip_tags($caption)) . "' />";
					if ($caption) { echo "<h3 class='caption'>$caption</h3>"; }

					if ($fancybox){
						echo '</a>';
					}

					echo "</div>\n";

					$i++;
				}
			}
			else{
				echo '<div>';
				the_post_thumbnail( 'theme-large' , array(  'class' => 'mask') );
				echo "</div>\n";

			}

			echo "</div></div>\n";

		}
	}
}


/*
 * Get slideshow
 */
if ( ! function_exists( 'ishfreelotheme_get_slideshow' ) ) {
	function ishfreelotheme_get_slideshow($postid, $imagesize, $type = '', $fancybox = false) {
		$loader = 'ajax-loader.gif';
		$thumbid = 0;

		$return = '';

		// get the featured image for the post
		if( has_post_thumbnail($postid) ) {
			$thumbid = get_post_thumbnail_id($postid);
		}

		// get all of the attachments for the post
		$args = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'attachment',
			'post_parent' => $postid,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);

		$attachments = get_posts($args);

		if ( 'slideshow' != $type ){
			// IMAGE ONLY
			if( !empty($attachments) ) {
				$i = 0;
				$count = count($attachments);
				foreach( $attachments as $attachment ) {

					$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;
					$description = $attachment->post_content;
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

					$return .= "<div><img height='$details[2]' width='$details[1]' src='$details[0]' alt='" . esc_attr(strip_tags($alt)) . "' title='" . esc_attr(strip_tags($caption)) . "' class='mask'/></div>\n";
					if ( $count > 1 ){
						$return .= "<div class='divider'></div>\n";
					}

					$i++;
				}
			}
			else{
				$return .= '<div>';
				$return .= get_the_post_thumbnail( 'theme-large' , array(  'class' => 'mask') );
				$return .= "</div>\n";
			}

		}
		else {
			// SLIDESHOW
			$return .= "<div class='slides'><div class='slides_container'>\n";

			if( !empty($attachments) ) {
				$i = 0;
				foreach( $attachments as $attachment ) {

					$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
					$caption = $attachment->post_excerpt;
					$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

					$return .= "<div><img height='$details[2]' width='$details[1]' src='$details[0]' alt='" . esc_attr(strip_tags($alt)) . "' title='" . esc_attr(strip_tags($caption)) . "' />";
					if ($caption) { $return .= "<h3 class='caption'>$caption</h3>"; }
					$return .= "</div>\n";

					$i++;
				}
			}
			else{
				$return .= '<div>';
				$return .= get_the_post_thumbnail( 'theme-large' , array(  'class' => 'mask') );
				$return .= "</div>\n";

			}
			$return .= "</div></div>\n";
		}

		return $return;
	}
}


/*
 * Portfolio overview attachment images print
 */
if ( ! function_exists( 'ishfreelotheme_portfolio_post_fancybox_images' ) ) {
	function ishfreelotheme_portfolio_post_fancybox_images($postid, $imagesize) {
		$thumbid = 0;

		// get the featured image for the post
		if( has_post_thumbnail($postid) ) {
			$thumbid = get_post_thumbnail_id($postid);
		}

		// get all of the attachments for the post
		$args = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'attachment',
			'post_parent' => $postid,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);

		$attachments = get_posts($args);

		if( !empty($attachments) ) {
			foreach( $attachments as $attachment ) {

				// SKIP OUT THE FAETURED IMAGE
				if( $attachment->ID == $thumbid ) continue;

				$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
				echo "<a href='" . esc_attr($details[0]) . "' data-fancybox-group='portfolio-box-" . $postid . "' class='openfancybox-image'></a>\n";
			}
		}

	}
}


/*
 * Portfolio fancybox images
 */
if ( ! function_exists( 'ishfreelotheme_get_portfolio_post_fancybox_images' ) ) {
	function ishfreelotheme_get_portfolio_post_fancybox_images($postid, $imagesize) {
		$thumbid = 0;

		$return = '';

		// get the featured image for the post
		if( has_post_thumbnail($postid) ) {
			$thumbid = get_post_thumbnail_id($postid);
		}

		// get all of the attachments for the post
		$args = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'attachment',
			'post_parent' => $postid,
			'post_mime_type' => 'image',
			'post_status' => null,
			'numberposts' => -1
		);

		$attachments = get_posts($args);

		if( !empty($attachments) ) {
			foreach( $attachments as $attachment ) {

				// SKIP OUT THE FAETURED IMAGE
				if( $attachment->ID == $thumbid ) continue;

				$details = wp_get_attachment_image_src( $attachment->ID, $imagesize );
				$return .= "<a href='" . esc_attr($details[0]) . "' data-fancybox-group='portfolio-box-" . $postid . "' class='openfancybox-image'></a>\n";
			}
		}

		return $return;
	}
}


/*
 * Posts icons
 */
if ( ! function_exists( 'ishfreelotheme_post_icon' ) ) {
	function ishfreelotheme_post_icon($type){
		switch ($type){
			case 'audio' :
				return 'icon-music';
				break;
			case 'video' :
				return 'icon-video';
				break;
			case 'gallery' :
				return 'icon-th-large';
				break;
			case 'filter' :
				return 'icon-th-large';
				break;
			case 'image' :
				return 'icon-picture';
				break;
			case 'aside' :
				return 'icon-align-right';
				break;
			case 'link' :
				return 'icon-link';
				break;
			case 'quote' :
				return 'icon-comment-alt';
				break;
			case 'status' :
				return 'icon-edit';
				break;
			case 'chat' :
				return 'icon-comments-alt';
				break;
			default :
				return 'icon-align-left';
		}
	}
}


/*
 * Pagination function
 */
if ( ! function_exists( 'ishfreelotheme_pagination' ) ) {
	function ishfreelotheme_pagination($pages = '', $range = 2) {

		$showitems = ($range * 2)+1;

		global $paged;
		if(empty($paged)) $paged = 1;

		if( '' == $pages ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;

			if ( !$pages ) {
				$pages = 1;
			}
		}

		if( 1 != $pages ) {
			echo "<div class='ish-pagination'>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				}
			}

			if ($paged < $pages && $showitems < $pages) echo "<a  href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
			echo "</div>\n";
		}

	}
}


/*
 * Get pagination
 */
if ( ! function_exists( 'ishfreelotheme_get_pagination' ) ) {
	function ishfreelotheme_get_pagination($pages = '', $range = 2, $maxpages = 0, $paged = 1) {

		$showitems = ($range * 2)+1;

		if( '' == $pages ) {
			$pages = $maxpages;

			if ( !$pages ) {
				$pages = 1;
			}
		}

		$return = '';

		if( 1 != $pages ) {
			$return .= "<div class='ish-pagination'>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) $return .= "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
			if($paged > 1 && $showitems < $pages) $return .= "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					$return .= ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				}
			}

			if ($paged < $pages && $showitems < $pages) $return .= "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $return .= "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
			$return .= "</div>\n";
		}

		return $return;
	}
}


/*
 * Load font setting
 */
if ( ! function_exists( 'ishfreelotheme_load_font_settings' ) ) {
	function ishfreelotheme_load_font_settings($position, $data){
		global $ishfreelotheme_fonts;

		// SET FONT TYPE
		if ( isset( $data[$position . '_use_google_font']) ){
			if ( '1' == $data[$position . '_use_google_font'] ){
				// GOOGLE
				$ishfreelotheme_fonts[$position]['type'] = 'google';
			}
			else{
				// REGULAR
				$ishfreelotheme_fonts[$position]['type'] = 'regular';
			}
		}

		// SET FONT NAME
		if ( isset( $data[$position . '_' . $ishfreelotheme_fonts[$position]['type']]) ){
			$ishfreelotheme_fonts[$position]['name'] = $data[$position . '_' . $ishfreelotheme_fonts[$position]['type']];
		}

		// SET FONT CSS OUTPUT STRING
		$ishfreelotheme_fonts[$position]['css_string'] = $ishfreelotheme_fonts[$position]['name'];
		if ( 'palatino' == $ishfreelotheme_fonts[$position]['name'] ){
			$ishfreelotheme_fonts[$position]['css_string'] = "Palatino Linotype', 'Book Antiqua', 'Palatino";
		}

		// SET FONT VARIANT
		if ( isset( $data[$position . '_' . $ishfreelotheme_fonts[$position]['type'] . '_variant']) ){
			$ishfreelotheme_fonts[$position]['variant'] = $data[$position . '_' . $ishfreelotheme_fonts[$position]['type'] . '_variant'];
		}

		// SET FONT SIZE
		if ( isset( $data[$position . '_size']) ){
			$ishfreelotheme_fonts[$position]['size'] = $data[$position . '_size'];
		}

		// SET FONT SIZE
		if ( isset( $data[$position . '_line_height']) ){
			$ishfreelotheme_fonts[$position]['line_height'] = $data[$position . '_line_height'];
		}
	}
}


/*
 * Google font settings
 */
if ( ! function_exists( 'ishfreelotheme_google_fonts_setup' ) ) {
	function ishfreelotheme_google_fonts_setup() {
		global $ishfreelotheme_fonts, $ishfreelotheme_options;

		// FONT SETTINGS
		ishfreelotheme_load_font_settings('body_font', $ishfreelotheme_options);
		ishfreelotheme_load_font_settings('body_font_2', $ishfreelotheme_options);
		ishfreelotheme_load_font_settings('header_font', $ishfreelotheme_options);
		ishfreelotheme_load_font_settings('h1_font', $ishfreelotheme_options);
		ishfreelotheme_load_font_settings('h2_font', $ishfreelotheme_options);
		ishfreelotheme_load_font_settings('h3_font', $ishfreelotheme_options);
		ishfreelotheme_load_font_settings('h4_font', $ishfreelotheme_options);
		ishfreelotheme_load_font_settings('h5_font', $ishfreelotheme_options);
		ishfreelotheme_load_font_settings('h6_font', $ishfreelotheme_options);

		// CREATE A LIST OF GOOGLE FONTS TO LOAD
		$load = array();
		foreach ($ishfreelotheme_fonts as $position => $details){
			if ( 'google' == $details['type'] ){
				if ( !isset( $load[$details['name']] ) ) { $load[$details['name']] = '300,300italic,400,400italic,regular,italic,600,600italic,700,700italic,'; }
				$load[$details['name']] .= $details['variant'] . ',';
			}
		}

		// CREATE A LIST OF SUBSETS TO LOAD
		$subsets = 'subset=latin';
		if ( isset( $ishfreelotheme_options['google_font_subsets'] ) ){
			foreach ($ishfreelotheme_options['google_font_subsets'] as $key => $val ){
				if ( 'latin' != $key ) {
					$subsets .= ',' . $key;
				}
			}
		}
		$subsets = '&' . rawurlencode( $subsets );

		// PREPARE THE CORRECT PROTOCOL
		$protocol = is_ssl() ? 'https' : 'http';

		// LOAD THE FONTS
		$i = 0;
		foreach ($load as $font => $variants){
			$i++;

			$font_url = '';
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Google font: on or off', 'freelo' ) ) {
				$font_url = add_query_arg( 'family', rawurlencode( $font ) . ':' . rawurlencode( $variants ) . $subsets, "//fonts.googleapis.com/css" );
			}
			wp_enqueue_style( 'ishfreelotheme-google-font-' . $i, $font_url);

		}
	}
}
add_action( 'wp_enqueue_scripts', 'ishfreelotheme_google_fonts_setup');
add_action( 'admin_enqueue_scripts', 'ishfreelotheme_google_fonts_setup');


/*
 * Google fonts variants
 */
if ( ! function_exists( 'ishfreelotheme_google_variants' ) ) {
	function ishfreelotheme_google_variants( $family ){
		$googleFonts = json_decode(ishfreelotheme_get_google_fonts());

		foreach ($googleFonts as $key => $details) {
			if ( $family == $details->family){
				$googleVariantsArray = array();
				foreach ($details->variants as $variant) {
					$googleVariantsArray[$variant] = $variant;
				}
				return $googleVariantsArray;
			}
		}

		return array();
	}
}


if ( ! function_exists( 'ishfreelotheme_reduce_padding_below_header' ) ) {
	function ishfreelotheme_reduce_padding_below_header( $header_height, $reduce_by = 60, $class_name = '' ){

		if ( '' != $class_name ){
			$class_name = '.' . $class_name;
		}

		global $ishfreelotheme_options;

		// Reduce the top padding if the Header and next row are visually similar as if they were one element
		if ( isset( $ishfreelotheme_options['header_colors_bg_opacity'] ) &&  '0' != $ishfreelotheme_options['header_colors_bg_opacity'] ){

			$continue = true;


			// Header Pattern set
			if ( $continue && 1 == $ishfreelotheme_options['use_header_pattern'] && '' != $ishfreelotheme_options['header_bg_pattern'] ){
				$continue = false;
			}

			// Header BG Image set
			if ( $continue && 0 == $ishfreelotheme_options['use_header_pattern'] && '' != $ishfreelotheme_options['header_bg_image'] ){
				$continue = false;
			}

			// Get an array of all colors which are the same as header BG color
			$header_colors = Array();
			if ( $continue ) {
				for ( $i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i ++ ) {
					if ( $ishfreelotheme_options['header_colors']['bg'] == $ishfreelotheme_options[ 'color' . $i ] ) {
						$header_colors[] = $i;
					}
				}
			}

			// Taglines - custom colored
			if ( $continue ) {
				foreach ( $header_colors as $val ) {
					echo '.ish-sticky-on .ish-wrapper-all .ish-part_header' . $class_name . ' + .ish-part_tagline.ish-no-pattern-img.ish-color' . $val . ' > .ish-row,';
				}
			}

			// Tagline - Default
			if ( $continue && $ishfreelotheme_options['tagline_colors']['bg'] == $ishfreelotheme_options['header_colors']['bg'] ){
				if (
					// Taglines Pattern set
					( 1 == $ishfreelotheme_options['use_lead_pattern'] && '' != $ishfreelotheme_options['lead_bg_pattern'] ) ||

					// Taglines BG Image set
					( 0 == $ishfreelotheme_options['use_lead_pattern'] && '' != $ishfreelotheme_options['lead_bg_image'] ) )
				{
					// do nothing
				}
				else{
					echo '.ish-sticky-on .ish-wrapper-all .ish-part_header' . $class_name . ' + .ish-part_tagline:not([class*="ish-color"]):not([class*="ish-tagline-image"]) > .ish-row,';
				}
			}

			// Content first row - no color / no image
			if ( $continue && $ishfreelotheme_options['body_color'] == $ishfreelotheme_options['header_colors']['bg'] ){
				echo '.ish-sticky-on .ish-wrapper-all .ish-part_header' . $class_name . ' + .ish-part_content > .wpb_row.ish-row-notfull.ish-has-nobgimage:not([class*="ish-color"]):first-of-type,';
				echo '.ish-sticky-on .ish-wrapper-all .ish-part_header' . $class_name . ' + .ish-part_content > .ish-row.ish-row-notfull.ish-has-nobgimage:not([class*="ish-color"]):first-of-type,';
				echo '.ish-sticky-on .ish-wrapper-all .ish-part_header' . $class_name . ' + .ish-part_content > .wpb_row.ish-row-full.ish-row-full-padding.ish-has-nobgimage:not([class*="ish-color"]):first-of-type,';
				echo '.ish-sticky-on .ish-wrapper-all .ish-part_header' . $class_name . ' + .ish-part_content > .ish-row.ish-row-full.ish-row-full-padding.ish-has-nobgimage:not([class*="ish-color"]):first-of-type,';
			}


			// Content first row - custom colored
			if ( $continue ) {
				foreach ( $header_colors as $val ) {
					echo '.ish-sticky-on .ish-wrapper-all .ish-part_header' . $class_name . ' + .ish-part_content > .wpb_row.ish-has-nobgimage.ish-color' . $val . ':first-of-type,';
					echo '.ish-sticky-on .ish-wrapper-all .ish-part_header' . $class_name . ' + .ish-part_content > .ish-row.ish-has-nobgimage.ish-color' . $val . ':first-of-type,';
				}
			}


			echo '
				.ish-dummy-class {
						padding-top: ' . ( $header_height - $reduce_by )  . 'px !important;
				}';

		}
	}
}

/*
 * Custom styles
 */
if ( ! function_exists( 'ishfreelotheme_custom_styles') ) {
	function ishfreelotheme_custom_styles() {

		global $ishfreelotheme_options, $ishfreelotheme_fonts, $smof_wpml_prefix, $ish_newdata;

		echo '<style type="text/css">';

		$uploads = wp_upload_dir();
		$uploads_dir = trailingslashit( $uploads['basedir'] ) . ISHFREELOTHEME_THEME_SLUG . '_css';

		// Output the dynamic.css into the body if not generated or if it should be ignored
		if ( defined( 'ISHFREELOTHEME_GENERATE_DYNAMIC_CSS' ) && false == ISHFREELOTHEME_GENERATE_DYNAMIC_CSS ){
			$ish_newdata = $ishfreelotheme_options;

			for ( $inc_i = 0; $inc_i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < ISHFREELOTHEME_COLORS_COUNT ; $inc_i++ ){
				$ISHFREELOTHEME_DYNAMIC_CSS_COLORS_START = ( $inc_i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT ) + 1;
				include( get_template_directory() . '/assets/framework/wp/dynamic_css/dynamic_css.php' );
				echo '</style><style type="text/css">';
			}

		}
		else{
			if ( ! file_exists( $uploads_dir . '/main-options' . $smof_wpml_prefix . '.css' ) ){
				// FILE DOES NOT EXIST
				$ish_newdata = $ishfreelotheme_options;
				// FALLBACK IF MAIN OPTIONS DO NOT EXIST
				for ( $inc_i = 0; $inc_i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT < ISHFREELOTHEME_COLORS_COUNT ; $inc_i++ ){
					$ISHFREELOTHEME_DYNAMIC_CSS_COLORS_START = ( $inc_i * ISHFREELOTHEME_DYNAMIC_CSS_COLORS_PER_FILE_COUNT ) + 1;
					include( get_template_directory() . '/assets/framework/wp/dynamic_css/dynamic_css.php' );
					echo '</style><style type="text/css">';
				}
			}
		}


		$header_offset = 0;

		$header_height = ( isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options['header_height'] ) ) ? $ishfreelotheme_options['header_height'] : ISHFREELOTHEME_DEFAULT_HEADER_HEIGHT;

		// Add Website Border width to header height - if top bar not on
		$header_height += ( isset( $ishfreelotheme_options ) && isset( $ishfreelotheme_options['use_website_border'] ) && ( 1 == $ishfreelotheme_options['use_website_border'] )
		                    && isset( $ishfreelotheme_options['use_header_bar'] ) && ( 1 != $ishfreelotheme_options['use_header_bar'] ) ) ? ISHFREELOTHEME_WEBSITE_BORDER_WIDTH : 0;

		// Add header bar height to the Header offset if visible
		$header_offset += ( isset($ishfreelotheme_options['use_header_bar']) && '1' == $ishfreelotheme_options['use_header_bar'] ) ? ISHFREELOTHEME_DEFAULT_HEADER_BAR_HEIGHT : 0;



		// Sticky nav position if admin bar is visible
		if ( is_admin_bar_showing() ) {
			echo "\n";
			echo '.ish-sidenav { top: 32px; padding-bottom: 60px; }';
			echo "\n";

			?>

			/* WP Admin bar fix ***********************************************************************************************/
			@media all and ( max-width: 782px ) {
				/*.ish-sticky-on .ish-part_header { top: <?php echo ( $header_offset + 46 ); ?>px !important; }*/
				.ish-sticky-on.admin-bar .ish-part_header.ish-sticky-scrolling { top: 46px !important; }
				.ish-sidenav { top: 46px; }
			}
			@media all and ( max-width: 600px ) {
				/*.ish-sticky-on .ish-part_header { top: <?php echo ( $header_offset + 46 ); ?>px !important; }*/
				/*.ish-sticky-on .ish-body { padding-top: <?php echo ($header_height - 46); ?>px !important; }*/
				.ish-sticky-on.admin-bar .ish-part_header.ish-sticky-scrolling { top: 0 !important; }
				.ish-sticky-on.ish-header_bar-off .ish-part_header{ position: absolute; }
				.ish-sticky-on.ish-header_bar-off:not(.ish-boxed) .ish-part_header:not(.ish-sticky-scrolling){ position: absolute; }
			    .ish-sidenav { top: 46px; }
			}

			<?php
		}
		else{
			if ( $header_offset > 0 ) {
				echo "\n";
				echo '.ish-sidenav { padding-bottom: 22px; }';
				echo "\n";
			}
		}

		// bring content closer if header has no background
		$header_negative_padding = ( isset( $ishfreelotheme_options['header_colors_bg_opacity'] ) &&  '0' == $ishfreelotheme_options['header_colors_bg_opacity'] ) ? ISHFREELOTHEME_GAP_BIG : 0;

		// Fix ish-body padding
		echo '
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_tagline > .ish-row,
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_breadcrumbs > .ish-row,
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .wpb_row:first-of-type,
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .ish-row:first-of-type {
					padding-top: ' . ( $header_height - $header_negative_padding )  . 'px !important;
			}

			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .wpb_row.ish-row-full.ish-row-full-nopadding:first-of-type,
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .ish-row.ish-row-full.ish-row-full-nopadding:first-of-type {
					padding-top: ' . $header_height  . 'px !important;
			}';

		// Breaking point
		$responsive_layout_breakingpoint = ISHFREELOTHEME_BREAKINGPOINT;
		if ( isset( $ish_newdata['responsive_layout_breakingpoint'] ) && '' != $ish_newdata['responsive_layout_breakingpoint'] ){
			$responsive_layout_breakingpoint = $ish_newdata['responsive_layout_breakingpoint'];
		}

		if ( ( !isset( $ishfreelotheme_options['use_responsive_layout'] ) || '1' == $ishfreelotheme_options['use_responsive_layout']) && $header_negative_padding > 0 ) {

			echo '
				@media all and ( max-width: '. ( $responsive_layout_breakingpoint) . 'px )
				{
					.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_tagline > .ish-row,
					.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_breadcrumbs > .ish-row,
					.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .wpb_row:first-of-type,
					.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .ish-row:first-of-type {
							padding-top: ' . ( $header_height - $header_negative_padding / 2 ) . 'px !important;
					}
				}';
		}


		// Fix Background images not to be under header if header is full color
		if ( isset( $ishfreelotheme_options['header_colors_bg_opacity'] ) &&  '100' == $ishfreelotheme_options['header_colors_bg_opacity'] ){
			echo '
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_tagline:not(.ish-parallax-dynamic),
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .wpb_row.ish-noparallax:first-of-type,
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .ish-row.ish-noparallax:first-of-type {
					background-position-y: calc(50% + ' . ($header_height / 2) .'px) !important;
			}';
		}


		// Breaking point
		$responsive_layout_breakingpoint = ISHFREELOTHEME_BREAKINGPOINT;
		if ( isset( $ish_newdata['responsive_layout_breakingpoint'] ) && '' != $ish_newdata['responsive_layout_breakingpoint'] ){
			$responsive_layout_breakingpoint = $ish_newdata['responsive_layout_breakingpoint'];
		}

		if ( !isset( $ishfreelotheme_options['use_responsive_layout'] ) || '1' == $ishfreelotheme_options['use_responsive_layout'] ) {
			// 769 - MAX
			echo '@media all and ( min-width: '. ( $responsive_layout_breakingpoint + 1) . 'px ) {';
			ishfreelotheme_reduce_padding_below_header( $header_height, ISHFREELOTHEME_GAP_BIG);
			echo '}';

			// 481 - 768
			echo '@media all and ( min-width: 481px ) and (max-width: ' . $responsive_layout_breakingpoint . 'px) {';
			ishfreelotheme_reduce_padding_below_header( $header_height, ISHFREELOTHEME_GAP_BIG / 2 );
			echo '}';
		}
		else{
			ishfreelotheme_reduce_padding_below_header( $header_height, ISHFREELOTHEME_GAP_BIG);
		}

		// bring content closer if Alternative header has no background
		$header_negative_padding = ( isset( $ishfreelotheme_options['header_colors_alternative_bg_opacity'] ) &&  '0' == $ishfreelotheme_options['header_colors_alternative_bg_opacity'] ) ? ISHFREELOTHEME_GAP_BIG : 0;

		// Fix ish-body padding
		echo '
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_tagline > .ish-row,
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_breadcrumbs > .ish-row,
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .wpb_row:first-of-type,
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .ish-row:first-of-type {
					padding-top: ' . ( $header_height - $header_negative_padding )  . 'px !important;
			}

			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .wpb_row.ish-row-full.ish-row-full-nopadding:first-of-type,
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .ish-row.ish-row-full.ish-row-full-nopadding:first-of-type {
					padding-top: ' . ( $header_height - $header_negative_padding )  . 'px !important;
			}';

		// Breaking point
		$responsive_layout_breakingpoint = ISHFREELOTHEME_BREAKINGPOINT;
		if ( isset( $ish_newdata['responsive_layout_breakingpoint'] ) && '' != $ish_newdata['responsive_layout_breakingpoint'] ){
			$responsive_layout_breakingpoint = $ish_newdata['responsive_layout_breakingpoint'];
		}

		if ( ( !isset( $ishfreelotheme_options['use_responsive_layout'] ) || '1' == $ishfreelotheme_options['use_responsive_layout']) && $header_negative_padding > 0 ) {

			echo '
				@media all and ( max-width: '. ( $responsive_layout_breakingpoint) . 'px )
				{
					.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_tagline > .ish-row,
					.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_breadcrumbs > .ish-row,
					.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .wpb_row:first-of-type,
					.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .ish-row:first-of-type {
							padding-top: ' . ( $header_height - $header_negative_padding / 2 ) . 'px !important;
					}
				}';
		}

		// Fix Background images not to be under header if header is full color
		if ( isset( $ishfreelotheme_options['header_colors_bg_opacity'] ) &&  '100' == $ishfreelotheme_options['header_colors_bg_opacity'] ){
			echo '
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_tagline:not(.ish-parallax-dynamic),
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .wpb_row.ish-noparallax:first-of-type,
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .ish-row.ish-noparallax:first-of-type {
					background-position-y: calc(50% + ' . ($header_height / 2) .'px) !important;
			}';
		}

		if ( !isset( $ishfreelotheme_options['use_responsive_layout'] ) || '1' == $ishfreelotheme_options['use_responsive_layout'] ) {

			// 769 - MAX
			echo '@media all and ( min-width: '. ( $responsive_layout_breakingpoint + 1) . 'px ) {';
			ishfreelotheme_reduce_padding_below_header( $header_height, ISHFREELOTHEME_GAP_BIG, 'ish-alt-style');
			echo '}';

			// 481 - 768
			echo '@media all and ( min-width: 481px ) and (max-width: ' . $responsive_layout_breakingpoint . 'px) {';
			ishfreelotheme_reduce_padding_below_header( $header_height, ISHFREELOTHEME_GAP_BIG / 2 , 'ish-alt-style');
			echo '}';
		} else {
			ishfreelotheme_reduce_padding_below_header( $header_height, ISHFREELOTHEME_GAP_BIG, 'ish-alt-style');
		}

		// put slidable under the header
		echo '
			.ish-sticky-on .ish-wrapper-all .ish-part_header + .ish-part_content > .wpb_row.ish-row-full:first-child .vc_col-sm-12:first-child > .wpb_wrapper > .ish-sc_slidable:first-child,
			.ish-sticky-on .ish-wrapper-all .ish-part_header.ish-alt-style + .ish-part_content > .wpb_row.ish-row-full:first-child .vc_col-sm-12:first-child > .wpb_wrapper > .ish-sc_slidable:first-child {
					margin-top: ' . ( -1 * $header_height )  . 'px !important;
			}';

		// Add custom user CSS
		$css = ( isset( $ishfreelotheme_options['custom_css'] ) ) ? trim( $ishfreelotheme_options['custom_css'] ) : '';
		$css = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $css );
		if ( '' != $css ){
			echo "\n" . $css . "\n";
		}

		echo '</style>' . "\n";

	}
}
add_action( 'wp_head', 'ishfreelotheme_custom_styles');


/*
 * Custom scripts
 */
if ( ! function_exists( 'ishfreelotheme_custom_scripts') ) {
	function ishfreelotheme_custom_scripts() {

		global $ishfreelotheme_options;

		if ( isset( $ishfreelotheme_options['custom_scripts'] ) ) {
			echo trim( $ishfreelotheme_options['custom_scripts'] );
		}

	}
}
add_action( 'wp_footer', 'ishfreelotheme_custom_scripts');


/*
 * Register required plugins
 */
if ( is_admin() ) {

	if ( ! function_exists( 'ishfreelotheme_register_required_plugins' ) ) {
		function ishfreelotheme_register_required_plugins() {

			/**
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(

				// REQUIRED PLUGINS

				array(
					'name'              => 'WPBakery Visual Composer', // The plugin name
					'slug'              => 'js_composer', // The plugin slug (typically the folder name)
					'source'            => get_template_directory() . '/assets/framework/wp/pagebuilder/js_composer.zip', // The plugin source
					'required'          => true, // If false, the plugin is only 'recommended' instead of required
					'version'           => '5.6',
					'force_activation'  => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation'=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url'      => '', // If set, overrides default API URL and points to an external URL
				),

				array(
					'name'     => 'Contact Form 7',
					'slug'     => 'contact-form-7',
					'required' => true,
					'force_activation' => false,
					'force_deactivation' => false,
				),

				array(
					'name'               => 'IshYoBoy Freelo Assets', // The plugin name.
					'slug'               => 'ishyoboy-freelo-assets', // The plugin slug (typically the folder name).
					'source'             => get_template_directory() . '/assets/framework/wp/includes/ishyoboy-freelo-assets.zip', // The plugin source.
					'required'           => true, // If false, the plugin is only 'recommended' instead of required.
					'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
					'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
					'external_url'       => 'http://ishyoboy.com/', // If set, overrides default API URL and points to an external URL.
				),

			);


			/**
			 * Array of configuration settings. Amend each line as needed.
			 * If you want the default strings to be available under your own theme domain,
			 * leave the strings uncommented.
			 * Some of the strings are added into a sprintf, so see the comments at the
			 * end of each line for what each argument will be.
			 */
			$config = array(
				'default_path' => '',                      // Default absolute path to pre-packaged plugins.
				'menu'         => 'tgmpa-install-plugins', // Menu slug.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => true,                   // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.
				'strings'      => array(
					'page_title'                      => esc_html__( 'Install Required Plugins', 'tgmpa' ),
					'menu_title'                      => esc_html__( 'Install Plugins', 'tgmpa' ),
					'installing'                      => esc_html__( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
					'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'tgmpa' ),
					'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
					'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
					'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
					'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
					'return'                          => esc_html__( 'Return to Required Plugins Installer', 'tgmpa' ),
					'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'tgmpa' ),
					'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
					'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
				)
			);
			tgmpa( $plugins, $config );
		}
	}
	add_action( 'tgmpa_register', 'ishfreelotheme_register_required_plugins');
}


if ( ! function_exists( 'ishfreelotheme_the_content' ) ) {
	function ishfreelotheme_the_content(){

		$content = apply_filters( 'the_content', get_the_content() );
		echo apply_filters( 'ishfreelotheme_the_content', $content );

	}
}

/*
 *
 */
if ( ! function_exists( 'remove_page_from_query_string' ) ) {
	function remove_page_from_query_string($query_string)
	{
		global $wp_rewrite;

		if ( isset( $query_string['page'] ) && isset( $query_string['name'] ) && $wp_rewrite->pagination_base == $query_string['name']) {

			// Get post type object and page index
			$post_type = get_post_type_object( $query_string['post_type'] );
			//list($delim, $page_index) = explode('/', $query_string['page']);

			$page_index = $query_string['page'][0];

			// Reset query string
			$query_string = array();

			// Set page and page index
			$query_string['pagename'] = $post_type->rewrite['slug'];
			$query_string['paged'] = $page_index;

		}

		return $query_string;

	}
}
add_filter( 'request', 'remove_page_from_query_string');


/*
 * Change post-type
 */
function ishfreelotheme_change_posttype() {
	global $wp_query;
	if( is_archive() && is_paged() && !is_admin() && ( ! function_exists( 'is_woocommerce') || !is_woocommerce() ) ) {
		set_query_var( 'post_type', array( 'post', 'portfolio-post' ) );
	}
	return;
}
add_action( 'parse_query', 'ishfreelotheme_change_posttype' );

$option_posts_per_page = get_option( 'posts_per_page' );

add_action( 'init', 'ishfreelotheme_modify_posts_per_page', 0);
function ishfreelotheme_modify_posts_per_page() {
	add_filter( 'option_posts_per_page', 'ishfreelotheme_option_posts_per_page' );
}


/*
 * Posts per page
 */
function ishfreelotheme_option_posts_per_page( $value ) {
	global $option_posts_per_page, $ishfreelotheme_options, $wp_query;

	if ( is_tax( 'portfolio-category') ) {

		if ( isset($ishfreelotheme_options['portfolio_per_page']) && !empty($ishfreelotheme_options['portfolio_per_page']) ){
			return $ishfreelotheme_options['portfolio_per_page'];
		}
		else{
			return $option_posts_per_page;
		}

	}
	elseif ( is_search() ){
		return 10;
	}
	elseif (function_exists( 'is_shop') && ( ( is_page() && get_query_var('page_id') == wc_get_page_id( 'shop' ) ) || ( get_query_var('post_type') == 'product' ) || ( is_tax('product_cat') ) || ( is_tax('product_tag') ) ) ) {

		if ( isset($ishfreelotheme_options['woocommerce_posts_per_page']) && !empty($ishfreelotheme_options['woocommerce_posts_per_page']) ){
			return $ishfreelotheme_options['woocommerce_posts_per_page'];
		}
		else{
			return $option_posts_per_page;
		}
	}
	else {
		return $option_posts_per_page;
	}
}


/*
 * Pages Excerpt
 */
add_action( 'init' , 'ishfreelotheme_add_page_excerpt' );
if ( ! function_exists( 'ishfreelotheme_add_page_excerpt' ) ) {
	function ishfreelotheme_add_page_excerpt() {
		add_post_type_support( 'page', 'excerpt' );
	}
}


/*
 * ishYoBoy hex2rgb
 */
if ( ! function_exists( 'ishfreelotheme_hex2rgb' ) ) {
	function ishfreelotheme_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(", ", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}


/*
 * Get term parents
 */
if ( ! function_exists( 'get_term_parents' ) ) {
	function get_term_parents( $id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
		$chain = '';

		$parent = get_term( $id, $taxonomy );
		if ( is_wp_error( $parent ) )
			return $parent;

		if ( $nicename )
			$name = $parent->slug;
		else
			$name = $parent->name;

		if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
			$visited[] = $parent->parent;
			$chain .= get_term_parents( $parent->parent, $taxonomy, $link, $separator, $nicename, $visited );
		}

		if ( $link )
			$chain .= '<a href="' . get_term_link( $parent->slug, $taxonomy ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'freelo' ), $parent->name ) ) . '">'.$name.'</a>' . $separator;
		else
			$chain .= '<span>' . $name . '</span>' . $separator;

		return $chain;
	}
}


/*
 * Get page parent
 */
if ( ! function_exists( 'get_page_parents' ) ) {
	function get_page_parents( $id, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
		$chain = '';

		$parent = get_post($id);

		if ( is_wp_error( $parent ) )
			return $parent;

		if ( $nicename )
			$name = $parent->post_name;
		else
			$name = $parent->post_title;

		if ( $parent->post_parent && !in_array( $parent->post_parent, $visited ) ) {
			$visited[] = $parent->post_parent;
			$chain .= get_page_parents( $parent->post_parent, $link, $separator, $nicename, $visited );
		}

		if ( $link )
			$chain .= '<a href="' . get_page_link( $parent->ID ) . '" title="' . esc_attr( sprintf( esc_html__( 'View %s page', 'freelo' ), $parent->post_title ) ) . '">'.$name.'</a>' . $separator;
		else
			$chain .= '<span>' . $name . '</span>' . $separator;

		return $chain;
	}
}


/*
 * Get google fonts
 */
if ( ! function_exists( 'ishfreelotheme_get_google_fonts' ) ) {
	function ishfreelotheme_get_google_fonts(){
		return '{"ABeeZee":{"family":"ABeeZee","variants":["regular","italic"]},"Abel":{"family":"Abel","variants":["regular"]},"Abhaya Libre":{"family":"Abhaya Libre","variants":["regular","500","600","700","800"]},"Abril Fatface":{"family":"Abril Fatface","variants":["regular"]},"Aclonica":{"family":"Aclonica","variants":["regular"]},"Acme":{"family":"Acme","variants":["regular"]},"Actor":{"family":"Actor","variants":["regular"]},"Adamina":{"family":"Adamina","variants":["regular"]},"Advent Pro":{"family":"Advent Pro","variants":["100","200","300","regular","500","600","700"]},"Aguafina Script":{"family":"Aguafina Script","variants":["regular"]},"Akronim":{"family":"Akronim","variants":["regular"]},"Aladin":{"family":"Aladin","variants":["regular"]},"Aldrich":{"family":"Aldrich","variants":["regular"]},"Alef":{"family":"Alef","variants":["regular","700"]},"Alegreya":{"family":"Alegreya","variants":["regular","italic","700","700italic","900","900italic"]},"Alegreya SC":{"family":"Alegreya SC","variants":["regular","italic","700","700italic","900","900italic"]},"Alegreya Sans":{"family":"Alegreya Sans","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","800","800italic","900","900italic"]},"Alegreya Sans SC":{"family":"Alegreya Sans SC","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","800","800italic","900","900italic"]},"Alex Brush":{"family":"Alex Brush","variants":["regular"]},"Alfa Slab One":{"family":"Alfa Slab One","variants":["regular"]},"Alice":{"family":"Alice","variants":["regular"]},"Alike":{"family":"Alike","variants":["regular"]},"Alike Angular":{"family":"Alike Angular","variants":["regular"]},"Allan":{"family":"Allan","variants":["regular","700"]},"Allerta":{"family":"Allerta","variants":["regular"]},"Allerta Stencil":{"family":"Allerta Stencil","variants":["regular"]},"Allura":{"family":"Allura","variants":["regular"]},"Almendra":{"family":"Almendra","variants":["regular","italic","700","700italic"]},"Almendra Display":{"family":"Almendra Display","variants":["regular"]},"Almendra SC":{"family":"Almendra SC","variants":["regular"]},"Amarante":{"family":"Amarante","variants":["regular"]},"Amaranth":{"family":"Amaranth","variants":["regular","italic","700","700italic"]},"Amatic SC":{"family":"Amatic SC","variants":["regular","700"]},"Amatica SC":{"family":"Amatica SC","variants":["regular","700"]},"Amethysta":{"family":"Amethysta","variants":["regular"]},"Amiko":{"family":"Amiko","variants":["regular","600","700"]},"Amiri":{"family":"Amiri","variants":["regular","italic","700","700italic"]},"Amita":{"family":"Amita","variants":["regular","700"]},"Anaheim":{"family":"Anaheim","variants":["regular"]},"Andada":{"family":"Andada","variants":["regular"]},"Andika":{"family":"Andika","variants":["regular"]},"Angkor":{"family":"Angkor","variants":["regular"]},"Annie Use Your Telescope":{"family":"Annie Use Your Telescope","variants":["regular"]},"Anonymous Pro":{"family":"Anonymous Pro","variants":["regular","italic","700","700italic"]},"Antic":{"family":"Antic","variants":["regular"]},"Antic Didone":{"family":"Antic Didone","variants":["regular"]},"Antic Slab":{"family":"Antic Slab","variants":["regular"]},"Anton":{"family":"Anton","variants":["regular"]},"Arapey":{"family":"Arapey","variants":["regular","italic"]},"Arbutus":{"family":"Arbutus","variants":["regular"]},"Arbutus Slab":{"family":"Arbutus Slab","variants":["regular"]},"Architects Daughter":{"family":"Architects Daughter","variants":["regular"]},"Archivo Black":{"family":"Archivo Black","variants":["regular"]},"Archivo Narrow":{"family":"Archivo Narrow","variants":["regular","italic","700","700italic"]},"Aref Ruqaa":{"family":"Aref Ruqaa","variants":["regular","700"]},"Arima Madurai":{"family":"Arima Madurai","variants":["100","200","300","regular","500","700","800","900"]},"Arimo":{"family":"Arimo","variants":["regular","italic","700","700italic"]},"Arizonia":{"family":"Arizonia","variants":["regular"]},"Armata":{"family":"Armata","variants":["regular"]},"Arsenal":{"family":"Arsenal","variants":["regular","italic","700","700italic"]},"Artifika":{"family":"Artifika","variants":["regular"]},"Arvo":{"family":"Arvo","variants":["regular","italic","700","700italic"]},"Arya":{"family":"Arya","variants":["regular","700"]},"Asap":{"family":"Asap","variants":["regular","italic","500","500italic","700","700italic"]},"Asar":{"family":"Asar","variants":["regular"]},"Asset":{"family":"Asset","variants":["regular"]},"Assistant":{"family":"Assistant","variants":["200","300","regular","600","700","800"]},"Astloch":{"family":"Astloch","variants":["regular","700"]},"Asul":{"family":"Asul","variants":["regular","700"]},"Athiti":{"family":"Athiti","variants":["200","300","regular","500","600","700"]},"Atma":{"family":"Atma","variants":["300","regular","500","600","700"]},"Atomic Age":{"family":"Atomic Age","variants":["regular"]},"Aubrey":{"family":"Aubrey","variants":["regular"]},"Audiowide":{"family":"Audiowide","variants":["regular"]},"Autour One":{"family":"Autour One","variants":["regular"]},"Average":{"family":"Average","variants":["regular"]},"Average Sans":{"family":"Average Sans","variants":["regular"]},"Averia Gruesa Libre":{"family":"Averia Gruesa Libre","variants":["regular"]},"Averia Libre":{"family":"Averia Libre","variants":["300","300italic","regular","italic","700","700italic"]},"Averia Sans Libre":{"family":"Averia Sans Libre","variants":["300","300italic","regular","italic","700","700italic"]},"Averia Serif Libre":{"family":"Averia Serif Libre","variants":["300","300italic","regular","italic","700","700italic"]},"Bad Script":{"family":"Bad Script","variants":["regular"]},"Bahiana":{"family":"Bahiana","variants":["regular"]},"Baloo":{"family":"Baloo","variants":["regular"]},"Baloo Bhai":{"family":"Baloo Bhai","variants":["regular"]},"Baloo Bhaina":{"family":"Baloo Bhaina","variants":["regular"]},"Baloo Chettan":{"family":"Baloo Chettan","variants":["regular"]},"Baloo Da":{"family":"Baloo Da","variants":["regular"]},"Baloo Paaji":{"family":"Baloo Paaji","variants":["regular"]},"Baloo Tamma":{"family":"Baloo Tamma","variants":["regular"]},"Baloo Thambi":{"family":"Baloo Thambi","variants":["regular"]},"Balthazar":{"family":"Balthazar","variants":["regular"]},"Bangers":{"family":"Bangers","variants":["regular"]},"Barrio":{"family":"Barrio","variants":["regular"]},"Basic":{"family":"Basic","variants":["regular"]},"Battambang":{"family":"Battambang","variants":["regular","700"]},"Baumans":{"family":"Baumans","variants":["regular"]},"Bayon":{"family":"Bayon","variants":["regular"]},"Belgrano":{"family":"Belgrano","variants":["regular"]},"Belleza":{"family":"Belleza","variants":["regular"]},"BenchNine":{"family":"BenchNine","variants":["300","regular","700"]},"Bentham":{"family":"Bentham","variants":["regular"]},"Berkshire Swash":{"family":"Berkshire Swash","variants":["regular"]},"Bevan":{"family":"Bevan","variants":["regular"]},"Bigelow Rules":{"family":"Bigelow Rules","variants":["regular"]},"Bigshot One":{"family":"Bigshot One","variants":["regular"]},"Bilbo":{"family":"Bilbo","variants":["regular"]},"Bilbo Swash Caps":{"family":"Bilbo Swash Caps","variants":["regular"]},"BioRhyme":{"family":"BioRhyme","variants":["200","300","regular","700","800"]},"BioRhyme Expanded":{"family":"BioRhyme Expanded","variants":["200","300","regular","700","800"]},"Biryani":{"family":"Biryani","variants":["200","300","regular","600","700","800","900"]},"Bitter":{"family":"Bitter","variants":["regular","italic","700"]},"Black Ops One":{"family":"Black Ops One","variants":["regular"]},"Bokor":{"family":"Bokor","variants":["regular"]},"Bonbon":{"family":"Bonbon","variants":["regular"]},"Boogaloo":{"family":"Boogaloo","variants":["regular"]},"Bowlby One":{"family":"Bowlby One","variants":["regular"]},"Bowlby One SC":{"family":"Bowlby One SC","variants":["regular"]},"Brawler":{"family":"Brawler","variants":["regular"]},"Bree Serif":{"family":"Bree Serif","variants":["regular"]},"Bubblegum Sans":{"family":"Bubblegum Sans","variants":["regular"]},"Bubbler One":{"family":"Bubbler One","variants":["regular"]},"Buda":{"family":"Buda","variants":["300"]},"Buenard":{"family":"Buenard","variants":["regular","700"]},"Bungee":{"family":"Bungee","variants":["regular"]},"Bungee Hairline":{"family":"Bungee Hairline","variants":["regular"]},"Bungee Inline":{"family":"Bungee Inline","variants":["regular"]},"Bungee Outline":{"family":"Bungee Outline","variants":["regular"]},"Bungee Shade":{"family":"Bungee Shade","variants":["regular"]},"Butcherman":{"family":"Butcherman","variants":["regular"]},"Butterfly Kids":{"family":"Butterfly Kids","variants":["regular"]},"Cabin":{"family":"Cabin","variants":["regular","italic","500","500italic","600","600italic","700","700italic"]},"Cabin Condensed":{"family":"Cabin Condensed","variants":["regular","500","600","700"]},"Cabin Sketch":{"family":"Cabin Sketch","variants":["regular","700"]},"Caesar Dressing":{"family":"Caesar Dressing","variants":["regular"]},"Cagliostro":{"family":"Cagliostro","variants":["regular"]},"Cairo":{"family":"Cairo","variants":["200","300","regular","600","700","900"]},"Calligraffitti":{"family":"Calligraffitti","variants":["regular"]},"Cambay":{"family":"Cambay","variants":["regular","italic","700","700italic"]},"Cambo":{"family":"Cambo","variants":["regular"]},"Candal":{"family":"Candal","variants":["regular"]},"Cantarell":{"family":"Cantarell","variants":["regular","italic","700","700italic"]},"Cantata One":{"family":"Cantata One","variants":["regular"]},"Cantora One":{"family":"Cantora One","variants":["regular"]},"Capriola":{"family":"Capriola","variants":["regular"]},"Cardo":{"family":"Cardo","variants":["regular","italic","700"]},"Carme":{"family":"Carme","variants":["regular"]},"Carrois Gothic":{"family":"Carrois Gothic","variants":["regular"]},"Carrois Gothic SC":{"family":"Carrois Gothic SC","variants":["regular"]},"Carter One":{"family":"Carter One","variants":["regular"]},"Catamaran":{"family":"Catamaran","variants":["100","200","300","regular","500","600","700","800","900"]},"Caudex":{"family":"Caudex","variants":["regular","italic","700","700italic"]},"Caveat":{"family":"Caveat","variants":["regular","700"]},"Caveat Brush":{"family":"Caveat Brush","variants":["regular"]},"Cedarville Cursive":{"family":"Cedarville Cursive","variants":["regular"]},"Ceviche One":{"family":"Ceviche One","variants":["regular"]},"Changa":{"family":"Changa","variants":["200","300","regular","500","600","700","800"]},"Changa One":{"family":"Changa One","variants":["regular","italic"]},"Chango":{"family":"Chango","variants":["regular"]},"Chathura":{"family":"Chathura","variants":["100","300","regular","700","800"]},"Chau Philomene One":{"family":"Chau Philomene One","variants":["regular","italic"]},"Chela One":{"family":"Chela One","variants":["regular"]},"Chelsea Market":{"family":"Chelsea Market","variants":["regular"]},"Chenla":{"family":"Chenla","variants":["regular"]},"Cherry Cream Soda":{"family":"Cherry Cream Soda","variants":["regular"]},"Cherry Swash":{"family":"Cherry Swash","variants":["regular","700"]},"Chewy":{"family":"Chewy","variants":["regular"]},"Chicle":{"family":"Chicle","variants":["regular"]},"Chivo":{"family":"Chivo","variants":["300","300italic","regular","italic","700","700italic","900","900italic"]},"Chonburi":{"family":"Chonburi","variants":["regular"]},"Cinzel":{"family":"Cinzel","variants":["regular","700","900"]},"Cinzel Decorative":{"family":"Cinzel Decorative","variants":["regular","700","900"]},"Clicker Script":{"family":"Clicker Script","variants":["regular"]},"Coda":{"family":"Coda","variants":["regular","800"]},"Coda Caption":{"family":"Coda Caption","variants":["800"]},"Codystar":{"family":"Codystar","variants":["300","regular"]},"Coiny":{"family":"Coiny","variants":["regular"]},"Combo":{"family":"Combo","variants":["regular"]},"Comfortaa":{"family":"Comfortaa","variants":["300","regular","700"]},"Coming Soon":{"family":"Coming Soon","variants":["regular"]},"Concert One":{"family":"Concert One","variants":["regular"]},"Condiment":{"family":"Condiment","variants":["regular"]},"Content":{"family":"Content","variants":["regular","700"]},"Contrail One":{"family":"Contrail One","variants":["regular"]},"Convergence":{"family":"Convergence","variants":["regular"]},"Cookie":{"family":"Cookie","variants":["regular"]},"Copse":{"family":"Copse","variants":["regular"]},"Corben":{"family":"Corben","variants":["regular","700"]},"Cormorant":{"family":"Cormorant","variants":["300","300italic","regular","italic","500","500italic","600","600italic","700","700italic"]},"Cormorant Garamond":{"family":"Cormorant Garamond","variants":["300","300italic","regular","italic","500","500italic","600","600italic","700","700italic"]},"Cormorant Infant":{"family":"Cormorant Infant","variants":["300","300italic","regular","italic","500","500italic","600","600italic","700","700italic"]},"Cormorant SC":{"family":"Cormorant SC","variants":["300","regular","500","600","700"]},"Cormorant Unicase":{"family":"Cormorant Unicase","variants":["300","regular","500","600","700"]},"Cormorant Upright":{"family":"Cormorant Upright","variants":["300","regular","500","600","700"]},"Courgette":{"family":"Courgette","variants":["regular"]},"Cousine":{"family":"Cousine","variants":["regular","italic","700","700italic"]},"Coustard":{"family":"Coustard","variants":["regular","900"]},"Covered By Your Grace":{"family":"Covered By Your Grace","variants":["regular"]},"Crafty Girls":{"family":"Crafty Girls","variants":["regular"]},"Creepster":{"family":"Creepster","variants":["regular"]},"Crete Round":{"family":"Crete Round","variants":["regular","italic"]},"Crimson Text":{"family":"Crimson Text","variants":["regular","italic","600","600italic","700","700italic"]},"Croissant One":{"family":"Croissant One","variants":["regular"]},"Crushed":{"family":"Crushed","variants":["regular"]},"Cuprum":{"family":"Cuprum","variants":["regular","italic","700","700italic"]},"Cutive":{"family":"Cutive","variants":["regular"]},"Cutive Mono":{"family":"Cutive Mono","variants":["regular"]},"Damion":{"family":"Damion","variants":["regular"]},"Dancing Script":{"family":"Dancing Script","variants":["regular","700"]},"Dangrek":{"family":"Dangrek","variants":["regular"]},"David Libre":{"family":"David Libre","variants":["regular","500","700"]},"Dawning of a New Day":{"family":"Dawning of a New Day","variants":["regular"]},"Days One":{"family":"Days One","variants":["regular"]},"Dekko":{"family":"Dekko","variants":["regular"]},"Delius":{"family":"Delius","variants":["regular"]},"Delius Swash Caps":{"family":"Delius Swash Caps","variants":["regular"]},"Delius Unicase":{"family":"Delius Unicase","variants":["regular","700"]},"Della Respira":{"family":"Della Respira","variants":["regular"]},"Denk One":{"family":"Denk One","variants":["regular"]},"Devonshire":{"family":"Devonshire","variants":["regular"]},"Dhurjati":{"family":"Dhurjati","variants":["regular"]},"Didact Gothic":{"family":"Didact Gothic","variants":["regular"]},"Diplomata":{"family":"Diplomata","variants":["regular"]},"Diplomata SC":{"family":"Diplomata SC","variants":["regular"]},"Domine":{"family":"Domine","variants":["regular","700"]},"Donegal One":{"family":"Donegal One","variants":["regular"]},"Doppio One":{"family":"Doppio One","variants":["regular"]},"Dorsa":{"family":"Dorsa","variants":["regular"]},"Dosis":{"family":"Dosis","variants":["200","300","regular","500","600","700","800"]},"Dr Sugiyama":{"family":"Dr Sugiyama","variants":["regular"]},"Droid Sans":{"family":"Droid Sans","variants":["regular","700"]},"Droid Sans Mono":{"family":"Droid Sans Mono","variants":["regular"]},"Droid Serif":{"family":"Droid Serif","variants":["regular","italic","700","700italic"]},"Duru Sans":{"family":"Duru Sans","variants":["regular"]},"Dynalight":{"family":"Dynalight","variants":["regular"]},"EB Garamond":{"family":"EB Garamond","variants":["regular"]},"Eagle Lake":{"family":"Eagle Lake","variants":["regular"]},"Eater":{"family":"Eater","variants":["regular"]},"Economica":{"family":"Economica","variants":["regular","italic","700","700italic"]},"Eczar":{"family":"Eczar","variants":["regular","500","600","700","800"]},"Ek Mukta":{"family":"Ek Mukta","variants":["200","300","regular","500","600","700","800"]},"El Messiri":{"family":"El Messiri","variants":["regular","500","600","700"]},"Electrolize":{"family":"Electrolize","variants":["regular"]},"Elsie":{"family":"Elsie","variants":["regular","900"]},"Elsie Swash Caps":{"family":"Elsie Swash Caps","variants":["regular","900"]},"Emblema One":{"family":"Emblema One","variants":["regular"]},"Emilys Candy":{"family":"Emilys Candy","variants":["regular"]},"Engagement":{"family":"Engagement","variants":["regular"]},"Englebert":{"family":"Englebert","variants":["regular"]},"Enriqueta":{"family":"Enriqueta","variants":["regular","700"]},"Erica One":{"family":"Erica One","variants":["regular"]},"Esteban":{"family":"Esteban","variants":["regular"]},"Euphoria Script":{"family":"Euphoria Script","variants":["regular"]},"Ewert":{"family":"Ewert","variants":["regular"]},"Exo":{"family":"Exo","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Exo 2":{"family":"Exo 2","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Expletus Sans":{"family":"Expletus Sans","variants":["regular","italic","500","500italic","600","600italic","700","700italic"]},"Fanwood Text":{"family":"Fanwood Text","variants":["regular","italic"]},"Farsan":{"family":"Farsan","variants":["regular"]},"Fascinate":{"family":"Fascinate","variants":["regular"]},"Fascinate Inline":{"family":"Fascinate Inline","variants":["regular"]},"Faster One":{"family":"Faster One","variants":["regular"]},"Fasthand":{"family":"Fasthand","variants":["regular"]},"Fauna One":{"family":"Fauna One","variants":["regular"]},"Federant":{"family":"Federant","variants":["regular"]},"Federo":{"family":"Federo","variants":["regular"]},"Felipa":{"family":"Felipa","variants":["regular"]},"Fenix":{"family":"Fenix","variants":["regular"]},"Finger Paint":{"family":"Finger Paint","variants":["regular"]},"Fira Mono":{"family":"Fira Mono","variants":["regular","500","700"]},"Fira Sans":{"family":"Fira Sans","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Fira Sans Condensed":{"family":"Fira Sans Condensed","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Fira Sans Extra Condensed":{"family":"Fira Sans Extra Condensed","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Fjalla One":{"family":"Fjalla One","variants":["regular"]},"Fjord One":{"family":"Fjord One","variants":["regular"]},"Flamenco":{"family":"Flamenco","variants":["300","regular"]},"Flavors":{"family":"Flavors","variants":["regular"]},"Fondamento":{"family":"Fondamento","variants":["regular","italic"]},"Fontdiner Swanky":{"family":"Fontdiner Swanky","variants":["regular"]},"Forum":{"family":"Forum","variants":["regular"]},"Francois One":{"family":"Francois One","variants":["regular"]},"Frank Ruhl Libre":{"family":"Frank Ruhl Libre","variants":["300","regular","500","700","900"]},"Freckle Face":{"family":"Freckle Face","variants":["regular"]},"Fredericka the Great":{"family":"Fredericka the Great","variants":["regular"]},"Fredoka One":{"family":"Fredoka One","variants":["regular"]},"Freehand":{"family":"Freehand","variants":["regular"]},"Fresca":{"family":"Fresca","variants":["regular"]},"Frijole":{"family":"Frijole","variants":["regular"]},"Fruktur":{"family":"Fruktur","variants":["regular"]},"Fugaz One":{"family":"Fugaz One","variants":["regular"]},"GFS Didot":{"family":"GFS Didot","variants":["regular"]},"GFS Neohellenic":{"family":"GFS Neohellenic","variants":["regular","italic","700","700italic"]},"Gabriela":{"family":"Gabriela","variants":["regular"]},"Gafata":{"family":"Gafata","variants":["regular"]},"Galada":{"family":"Galada","variants":["regular"]},"Galdeano":{"family":"Galdeano","variants":["regular"]},"Galindo":{"family":"Galindo","variants":["regular"]},"Gentium Basic":{"family":"Gentium Basic","variants":["regular","italic","700","700italic"]},"Gentium Book Basic":{"family":"Gentium Book Basic","variants":["regular","italic","700","700italic"]},"Geo":{"family":"Geo","variants":["regular","italic"]},"Geostar":{"family":"Geostar","variants":["regular"]},"Geostar Fill":{"family":"Geostar Fill","variants":["regular"]},"Germania One":{"family":"Germania One","variants":["regular"]},"Gidugu":{"family":"Gidugu","variants":["regular"]},"Gilda Display":{"family":"Gilda Display","variants":["regular"]},"Give You Glory":{"family":"Give You Glory","variants":["regular"]},"Glass Antiqua":{"family":"Glass Antiqua","variants":["regular"]},"Glegoo":{"family":"Glegoo","variants":["regular","700"]},"Gloria Hallelujah":{"family":"Gloria Hallelujah","variants":["regular"]},"Goblin One":{"family":"Goblin One","variants":["regular"]},"Gochi Hand":{"family":"Gochi Hand","variants":["regular"]},"Gorditas":{"family":"Gorditas","variants":["regular","700"]},"Goudy Bookletter 1911":{"family":"Goudy Bookletter 1911","variants":["regular"]},"Graduate":{"family":"Graduate","variants":["regular"]},"Grand Hotel":{"family":"Grand Hotel","variants":["regular"]},"Gravitas One":{"family":"Gravitas One","variants":["regular"]},"Great Vibes":{"family":"Great Vibes","variants":["regular"]},"Griffy":{"family":"Griffy","variants":["regular"]},"Gruppo":{"family":"Gruppo","variants":["regular"]},"Gudea":{"family":"Gudea","variants":["regular","italic","700"]},"Gurajada":{"family":"Gurajada","variants":["regular"]},"Habibi":{"family":"Habibi","variants":["regular"]},"Halant":{"family":"Halant","variants":["300","regular","500","600","700"]},"Hammersmith One":{"family":"Hammersmith One","variants":["regular"]},"Hanalei":{"family":"Hanalei","variants":["regular"]},"Hanalei Fill":{"family":"Hanalei Fill","variants":["regular"]},"Handlee":{"family":"Handlee","variants":["regular"]},"Hanuman":{"family":"Hanuman","variants":["regular","700"]},"Happy Monkey":{"family":"Happy Monkey","variants":["regular"]},"Harmattan":{"family":"Harmattan","variants":["regular"]},"Headland One":{"family":"Headland One","variants":["regular"]},"Heebo":{"family":"Heebo","variants":["100","300","regular","500","700","800","900"]},"Henny Penny":{"family":"Henny Penny","variants":["regular"]},"Herr Von Muellerhoff":{"family":"Herr Von Muellerhoff","variants":["regular"]},"Hind":{"family":"Hind","variants":["300","regular","500","600","700"]},"Hind Guntur":{"family":"Hind Guntur","variants":["300","regular","500","600","700"]},"Hind Madurai":{"family":"Hind Madurai","variants":["300","regular","500","600","700"]},"Hind Siliguri":{"family":"Hind Siliguri","variants":["300","regular","500","600","700"]},"Hind Vadodara":{"family":"Hind Vadodara","variants":["300","regular","500","600","700"]},"Holtwood One SC":{"family":"Holtwood One SC","variants":["regular"]},"Homemade Apple":{"family":"Homemade Apple","variants":["regular"]},"Homenaje":{"family":"Homenaje","variants":["regular"]},"IM Fell DW Pica":{"family":"IM Fell DW Pica","variants":["regular","italic"]},"IM Fell DW Pica SC":{"family":"IM Fell DW Pica SC","variants":["regular"]},"IM Fell Double Pica":{"family":"IM Fell Double Pica","variants":["regular","italic"]},"IM Fell Double Pica SC":{"family":"IM Fell Double Pica SC","variants":["regular"]},"IM Fell English":{"family":"IM Fell English","variants":["regular","italic"]},"IM Fell English SC":{"family":"IM Fell English SC","variants":["regular"]},"IM Fell French Canon":{"family":"IM Fell French Canon","variants":["regular","italic"]},"IM Fell French Canon SC":{"family":"IM Fell French Canon SC","variants":["regular"]},"IM Fell Great Primer":{"family":"IM Fell Great Primer","variants":["regular","italic"]},"IM Fell Great Primer SC":{"family":"IM Fell Great Primer SC","variants":["regular"]},"Iceberg":{"family":"Iceberg","variants":["regular"]},"Iceland":{"family":"Iceland","variants":["regular"]},"Imprima":{"family":"Imprima","variants":["regular"]},"Inconsolata":{"family":"Inconsolata","variants":["regular","700"]},"Inder":{"family":"Inder","variants":["regular"]},"Indie Flower":{"family":"Indie Flower","variants":["regular"]},"Inika":{"family":"Inika","variants":["regular","700"]},"Inknut Antiqua":{"family":"Inknut Antiqua","variants":["300","regular","500","600","700","800","900"]},"Irish Grover":{"family":"Irish Grover","variants":["regular"]},"Istok Web":{"family":"Istok Web","variants":["regular","italic","700","700italic"]},"Italiana":{"family":"Italiana","variants":["regular"]},"Italianno":{"family":"Italianno","variants":["regular"]},"Itim":{"family":"Itim","variants":["regular"]},"Jacques Francois":{"family":"Jacques Francois","variants":["regular"]},"Jacques Francois Shadow":{"family":"Jacques Francois Shadow","variants":["regular"]},"Jaldi":{"family":"Jaldi","variants":["regular","700"]},"Jim Nightshade":{"family":"Jim Nightshade","variants":["regular"]},"Jockey One":{"family":"Jockey One","variants":["regular"]},"Jolly Lodger":{"family":"Jolly Lodger","variants":["regular"]},"Jomhuria":{"family":"Jomhuria","variants":["regular"]},"Josefin Sans":{"family":"Josefin Sans","variants":["100","100italic","300","300italic","regular","italic","600","600italic","700","700italic"]},"Josefin Slab":{"family":"Josefin Slab","variants":["100","100italic","300","300italic","regular","italic","600","600italic","700","700italic"]},"Joti One":{"family":"Joti One","variants":["regular"]},"Judson":{"family":"Judson","variants":["regular","italic","700"]},"Julee":{"family":"Julee","variants":["regular"]},"Julius Sans One":{"family":"Julius Sans One","variants":["regular"]},"Junge":{"family":"Junge","variants":["regular"]},"Jura":{"family":"Jura","variants":["300","regular","500","600"]},"Just Another Hand":{"family":"Just Another Hand","variants":["regular"]},"Just Me Again Down Here":{"family":"Just Me Again Down Here","variants":["regular"]},"Kadwa":{"family":"Kadwa","variants":["regular","700"]},"Kalam":{"family":"Kalam","variants":["300","regular","700"]},"Kameron":{"family":"Kameron","variants":["regular","700"]},"Kanit":{"family":"Kanit","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Kantumruy":{"family":"Kantumruy","variants":["300","regular","700"]},"Karla":{"family":"Karla","variants":["regular","italic","700","700italic"]},"Karma":{"family":"Karma","variants":["300","regular","500","600","700"]},"Katibeh":{"family":"Katibeh","variants":["regular"]},"Kaushan Script":{"family":"Kaushan Script","variants":["regular"]},"Kavivanar":{"family":"Kavivanar","variants":["regular"]},"Kavoon":{"family":"Kavoon","variants":["regular"]},"Kdam Thmor":{"family":"Kdam Thmor","variants":["regular"]},"Keania One":{"family":"Keania One","variants":["regular"]},"Kelly Slab":{"family":"Kelly Slab","variants":["regular"]},"Kenia":{"family":"Kenia","variants":["regular"]},"Khand":{"family":"Khand","variants":["300","regular","500","600","700"]},"Khmer":{"family":"Khmer","variants":["regular"]},"Khula":{"family":"Khula","variants":["300","regular","600","700","800"]},"Kite One":{"family":"Kite One","variants":["regular"]},"Knewave":{"family":"Knewave","variants":["regular"]},"Kotta One":{"family":"Kotta One","variants":["regular"]},"Koulen":{"family":"Koulen","variants":["regular"]},"Kranky":{"family":"Kranky","variants":["regular"]},"Kreon":{"family":"Kreon","variants":["300","regular","700"]},"Kristi":{"family":"Kristi","variants":["regular"]},"Krona One":{"family":"Krona One","variants":["regular"]},"Kumar One":{"family":"Kumar One","variants":["regular"]},"Kumar One Outline":{"family":"Kumar One Outline","variants":["regular"]},"Kurale":{"family":"Kurale","variants":["regular"]},"La Belle Aurore":{"family":"La Belle Aurore","variants":["regular"]},"Laila":{"family":"Laila","variants":["300","regular","500","600","700"]},"Lakki Reddy":{"family":"Lakki Reddy","variants":["regular"]},"Lalezar":{"family":"Lalezar","variants":["regular"]},"Lancelot":{"family":"Lancelot","variants":["regular"]},"Lateef":{"family":"Lateef","variants":["regular"]},"Lato":{"family":"Lato","variants":["100","100italic","300","300italic","regular","italic","700","700italic","900","900italic"]},"League Script":{"family":"League Script","variants":["regular"]},"Leckerli One":{"family":"Leckerli One","variants":["regular"]},"Ledger":{"family":"Ledger","variants":["regular"]},"Lekton":{"family":"Lekton","variants":["regular","italic","700"]},"Lemon":{"family":"Lemon","variants":["regular"]},"Lemonada":{"family":"Lemonada","variants":["300","regular","600","700"]},"Libre Baskerville":{"family":"Libre Baskerville","variants":["regular","italic","700"]},"Libre Franklin":{"family":"Libre Franklin","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Life Savers":{"family":"Life Savers","variants":["regular","700"]},"Lilita One":{"family":"Lilita One","variants":["regular"]},"Lily Script One":{"family":"Lily Script One","variants":["regular"]},"Limelight":{"family":"Limelight","variants":["regular"]},"Linden Hill":{"family":"Linden Hill","variants":["regular","italic"]},"Lobster":{"family":"Lobster","variants":["regular"]},"Lobster Two":{"family":"Lobster Two","variants":["regular","italic","700","700italic"]},"Londrina Outline":{"family":"Londrina Outline","variants":["regular"]},"Londrina Shadow":{"family":"Londrina Shadow","variants":["regular"]},"Londrina Sketch":{"family":"Londrina Sketch","variants":["regular"]},"Londrina Solid":{"family":"Londrina Solid","variants":["regular"]},"Lora":{"family":"Lora","variants":["regular","italic","700","700italic"]},"Love Ya Like A Sister":{"family":"Love Ya Like A Sister","variants":["regular"]},"Loved by the King":{"family":"Loved by the King","variants":["regular"]},"Lovers Quarrel":{"family":"Lovers Quarrel","variants":["regular"]},"Luckiest Guy":{"family":"Luckiest Guy","variants":["regular"]},"Lusitana":{"family":"Lusitana","variants":["regular","700"]},"Lustria":{"family":"Lustria","variants":["regular"]},"Macondo":{"family":"Macondo","variants":["regular"]},"Macondo Swash Caps":{"family":"Macondo Swash Caps","variants":["regular"]},"Mada":{"family":"Mada","variants":["300","regular","500","900"]},"Magra":{"family":"Magra","variants":["regular","700"]},"Maiden Orange":{"family":"Maiden Orange","variants":["regular"]},"Maitree":{"family":"Maitree","variants":["200","300","regular","500","600","700"]},"Mako":{"family":"Mako","variants":["regular"]},"Mallanna":{"family":"Mallanna","variants":["regular"]},"Mandali":{"family":"Mandali","variants":["regular"]},"Marcellus":{"family":"Marcellus","variants":["regular"]},"Marcellus SC":{"family":"Marcellus SC","variants":["regular"]},"Marck Script":{"family":"Marck Script","variants":["regular"]},"Margarine":{"family":"Margarine","variants":["regular"]},"Marko One":{"family":"Marko One","variants":["regular"]},"Marmelad":{"family":"Marmelad","variants":["regular"]},"Martel":{"family":"Martel","variants":["200","300","regular","600","700","800","900"]},"Martel Sans":{"family":"Martel Sans","variants":["200","300","regular","600","700","800","900"]},"Marvel":{"family":"Marvel","variants":["regular","italic","700","700italic"]},"Mate":{"family":"Mate","variants":["regular","italic"]},"Mate SC":{"family":"Mate SC","variants":["regular"]},"Maven Pro":{"family":"Maven Pro","variants":["regular","500","700","900"]},"McLaren":{"family":"McLaren","variants":["regular"]},"Meddon":{"family":"Meddon","variants":["regular"]},"MedievalSharp":{"family":"MedievalSharp","variants":["regular"]},"Medula One":{"family":"Medula One","variants":["regular"]},"Meera Inimai":{"family":"Meera Inimai","variants":["regular"]},"Megrim":{"family":"Megrim","variants":["regular"]},"Meie Script":{"family":"Meie Script","variants":["regular"]},"Merienda":{"family":"Merienda","variants":["regular","700"]},"Merienda One":{"family":"Merienda One","variants":["regular"]},"Merriweather":{"family":"Merriweather","variants":["300","300italic","regular","italic","700","700italic","900","900italic"]},"Merriweather Sans":{"family":"Merriweather Sans","variants":["300","300italic","regular","italic","700","700italic","800","800italic"]},"Metal":{"family":"Metal","variants":["regular"]},"Metal Mania":{"family":"Metal Mania","variants":["regular"]},"Metamorphous":{"family":"Metamorphous","variants":["regular"]},"Metrophobic":{"family":"Metrophobic","variants":["regular"]},"Michroma":{"family":"Michroma","variants":["regular"]},"Milonga":{"family":"Milonga","variants":["regular"]},"Miltonian":{"family":"Miltonian","variants":["regular"]},"Miltonian Tattoo":{"family":"Miltonian Tattoo","variants":["regular"]},"Miniver":{"family":"Miniver","variants":["regular"]},"Miriam Libre":{"family":"Miriam Libre","variants":["regular","700"]},"Mirza":{"family":"Mirza","variants":["regular","500","600","700"]},"Miss Fajardose":{"family":"Miss Fajardose","variants":["regular"]},"Mitr":{"family":"Mitr","variants":["200","300","regular","500","600","700"]},"Modak":{"family":"Modak","variants":["regular"]},"Modern Antiqua":{"family":"Modern Antiqua","variants":["regular"]},"Mogra":{"family":"Mogra","variants":["regular"]},"Molengo":{"family":"Molengo","variants":["regular"]},"Molle":{"family":"Molle","variants":["italic"]},"Monda":{"family":"Monda","variants":["regular","700"]},"Monofett":{"family":"Monofett","variants":["regular"]},"Monoton":{"family":"Monoton","variants":["regular"]},"Monsieur La Doulaise":{"family":"Monsieur La Doulaise","variants":["regular"]},"Montaga":{"family":"Montaga","variants":["regular"]},"Montez":{"family":"Montez","variants":["regular"]},"Montserrat":{"family":"Montserrat","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Montserrat Alternates":{"family":"Montserrat Alternates","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Montserrat Subrayada":{"family":"Montserrat Subrayada","variants":["regular","700"]},"Moul":{"family":"Moul","variants":["regular"]},"Moulpali":{"family":"Moulpali","variants":["regular"]},"Mountains of Christmas":{"family":"Mountains of Christmas","variants":["regular","700"]},"Mouse Memoirs":{"family":"Mouse Memoirs","variants":["regular"]},"Mr Bedfort":{"family":"Mr Bedfort","variants":["regular"]},"Mr Dafoe":{"family":"Mr Dafoe","variants":["regular"]},"Mr De Haviland":{"family":"Mr De Haviland","variants":["regular"]},"Mrs Saint Delafield":{"family":"Mrs Saint Delafield","variants":["regular"]},"Mrs Sheppards":{"family":"Mrs Sheppards","variants":["regular"]},"Mukta Vaani":{"family":"Mukta Vaani","variants":["200","300","regular","500","600","700","800"]},"Muli":{"family":"Muli","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Mystery Quest":{"family":"Mystery Quest","variants":["regular"]},"NTR":{"family":"NTR","variants":["regular"]},"Neucha":{"family":"Neucha","variants":["regular"]},"Neuton":{"family":"Neuton","variants":["200","300","regular","italic","700","800"]},"New Rocker":{"family":"New Rocker","variants":["regular"]},"News Cycle":{"family":"News Cycle","variants":["regular","700"]},"Niconne":{"family":"Niconne","variants":["regular"]},"Nixie One":{"family":"Nixie One","variants":["regular"]},"Nobile":{"family":"Nobile","variants":["regular","italic","700","700italic"]},"Nokora":{"family":"Nokora","variants":["regular","700"]},"Norican":{"family":"Norican","variants":["regular"]},"Nosifer":{"family":"Nosifer","variants":["regular"]},"Nothing You Could Do":{"family":"Nothing You Could Do","variants":["regular"]},"Noticia Text":{"family":"Noticia Text","variants":["regular","italic","700","700italic"]},"Noto Sans":{"family":"Noto Sans","variants":["regular","italic","700","700italic"]},"Noto Serif":{"family":"Noto Serif","variants":["regular","italic","700","700italic"]},"Nova Cut":{"family":"Nova Cut","variants":["regular"]},"Nova Flat":{"family":"Nova Flat","variants":["regular"]},"Nova Mono":{"family":"Nova Mono","variants":["regular"]},"Nova Oval":{"family":"Nova Oval","variants":["regular"]},"Nova Round":{"family":"Nova Round","variants":["regular"]},"Nova Script":{"family":"Nova Script","variants":["regular"]},"Nova Slim":{"family":"Nova Slim","variants":["regular"]},"Nova Square":{"family":"Nova Square","variants":["regular"]},"Numans":{"family":"Numans","variants":["regular"]},"Nunito":{"family":"Nunito","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Nunito Sans":{"family":"Nunito Sans","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Odor Mean Chey":{"family":"Odor Mean Chey","variants":["regular"]},"Offside":{"family":"Offside","variants":["regular"]},"Old Standard TT":{"family":"Old Standard TT","variants":["regular","italic","700"]},"Oldenburg":{"family":"Oldenburg","variants":["regular"]},"Oleo Script":{"family":"Oleo Script","variants":["regular","700"]},"Oleo Script Swash Caps":{"family":"Oleo Script Swash Caps","variants":["regular","700"]},"Open Sans":{"family":"Open Sans","variants":["300","300italic","regular","italic","600","600italic","700","700italic","800","800italic"]},"Open Sans Condensed":{"family":"Open Sans Condensed","variants":["300","300italic","700"]},"Oranienbaum":{"family":"Oranienbaum","variants":["regular"]},"Orbitron":{"family":"Orbitron","variants":["regular","500","700","900"]},"Oregano":{"family":"Oregano","variants":["regular","italic"]},"Orienta":{"family":"Orienta","variants":["regular"]},"Original Surfer":{"family":"Original Surfer","variants":["regular"]},"Oswald":{"family":"Oswald","variants":["200","300","regular","500","600","700"]},"Over the Rainbow":{"family":"Over the Rainbow","variants":["regular"]},"Overlock":{"family":"Overlock","variants":["regular","italic","700","700italic","900","900italic"]},"Overlock SC":{"family":"Overlock SC","variants":["regular"]},"Overpass":{"family":"Overpass","variants":["100","100italic","200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Overpass Mono":{"family":"Overpass Mono","variants":["300","regular","600","700"]},"Ovo":{"family":"Ovo","variants":["regular"]},"Oxygen":{"family":"Oxygen","variants":["300","regular","700"]},"Oxygen Mono":{"family":"Oxygen Mono","variants":["regular"]},"PT Mono":{"family":"PT Mono","variants":["regular"]},"PT Sans":{"family":"PT Sans","variants":["regular","italic","700","700italic"]},"PT Sans Caption":{"family":"PT Sans Caption","variants":["regular","700"]},"PT Sans Narrow":{"family":"PT Sans Narrow","variants":["regular","700"]},"PT Serif":{"family":"PT Serif","variants":["regular","italic","700","700italic"]},"PT Serif Caption":{"family":"PT Serif Caption","variants":["regular","italic"]},"Pacifico":{"family":"Pacifico","variants":["regular"]},"Padauk":{"family":"Padauk","variants":["regular","700"]},"Palanquin":{"family":"Palanquin","variants":["100","200","300","regular","500","600","700"]},"Palanquin Dark":{"family":"Palanquin Dark","variants":["regular","500","600","700"]},"Pangolin":{"family":"Pangolin","variants":["regular"]},"Paprika":{"family":"Paprika","variants":["regular"]},"Parisienne":{"family":"Parisienne","variants":["regular"]},"Passero One":{"family":"Passero One","variants":["regular"]},"Passion One":{"family":"Passion One","variants":["regular","700","900"]},"Pathway Gothic One":{"family":"Pathway Gothic One","variants":["regular"]},"Patrick Hand":{"family":"Patrick Hand","variants":["regular"]},"Patrick Hand SC":{"family":"Patrick Hand SC","variants":["regular"]},"Pattaya":{"family":"Pattaya","variants":["regular"]},"Patua One":{"family":"Patua One","variants":["regular"]},"Pavanam":{"family":"Pavanam","variants":["regular"]},"Paytone One":{"family":"Paytone One","variants":["regular"]},"Peddana":{"family":"Peddana","variants":["regular"]},"Peralta":{"family":"Peralta","variants":["regular"]},"Permanent Marker":{"family":"Permanent Marker","variants":["regular"]},"Petit Formal Script":{"family":"Petit Formal Script","variants":["regular"]},"Petrona":{"family":"Petrona","variants":["regular"]},"Philosopher":{"family":"Philosopher","variants":["regular","italic","700","700italic"]},"Piedra":{"family":"Piedra","variants":["regular"]},"Pinyon Script":{"family":"Pinyon Script","variants":["regular"]},"Pirata One":{"family":"Pirata One","variants":["regular"]},"Plaster":{"family":"Plaster","variants":["regular"]},"Play":{"family":"Play","variants":["regular","700"]},"Playball":{"family":"Playball","variants":["regular"]},"Playfair Display":{"family":"Playfair Display","variants":["regular","italic","700","700italic","900","900italic"]},"Playfair Display SC":{"family":"Playfair Display SC","variants":["regular","italic","700","700italic","900","900italic"]},"Podkova":{"family":"Podkova","variants":["regular","500","600","700","800"]},"Poiret One":{"family":"Poiret One","variants":["regular"]},"Poller One":{"family":"Poller One","variants":["regular"]},"Poly":{"family":"Poly","variants":["regular","italic"]},"Pompiere":{"family":"Pompiere","variants":["regular"]},"Pontano Sans":{"family":"Pontano Sans","variants":["regular"]},"Poppins":{"family":"Poppins","variants":["300","regular","500","600","700"]},"Port Lligat Sans":{"family":"Port Lligat Sans","variants":["regular"]},"Port Lligat Slab":{"family":"Port Lligat Slab","variants":["regular"]},"Pragati Narrow":{"family":"Pragati Narrow","variants":["regular","700"]},"Prata":{"family":"Prata","variants":["regular"]},"Preahvihear":{"family":"Preahvihear","variants":["regular"]},"Press Start 2P":{"family":"Press Start 2P","variants":["regular"]},"Pridi":{"family":"Pridi","variants":["200","300","regular","500","600","700"]},"Princess Sofia":{"family":"Princess Sofia","variants":["regular"]},"Prociono":{"family":"Prociono","variants":["regular"]},"Prompt":{"family":"Prompt","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Prosto One":{"family":"Prosto One","variants":["regular"]},"Proza Libre":{"family":"Proza Libre","variants":["regular","italic","500","500italic","600","600italic","700","700italic","800","800italic"]},"Puritan":{"family":"Puritan","variants":["regular","italic","700","700italic"]},"Purple Purse":{"family":"Purple Purse","variants":["regular"]},"Quando":{"family":"Quando","variants":["regular"]},"Quantico":{"family":"Quantico","variants":["regular","italic","700","700italic"]},"Quattrocento":{"family":"Quattrocento","variants":["regular","700"]},"Quattrocento Sans":{"family":"Quattrocento Sans","variants":["regular","italic","700","700italic"]},"Questrial":{"family":"Questrial","variants":["regular"]},"Quicksand":{"family":"Quicksand","variants":["300","regular","500","700"]},"Quintessential":{"family":"Quintessential","variants":["regular"]},"Qwigley":{"family":"Qwigley","variants":["regular"]},"Racing Sans One":{"family":"Racing Sans One","variants":["regular"]},"Radley":{"family":"Radley","variants":["regular","italic"]},"Rajdhani":{"family":"Rajdhani","variants":["300","regular","500","600","700"]},"Rakkas":{"family":"Rakkas","variants":["regular"]},"Raleway":{"family":"Raleway","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Raleway Dots":{"family":"Raleway Dots","variants":["regular"]},"Ramabhadra":{"family":"Ramabhadra","variants":["regular"]},"Ramaraja":{"family":"Ramaraja","variants":["regular"]},"Rambla":{"family":"Rambla","variants":["regular","italic","700","700italic"]},"Rammetto One":{"family":"Rammetto One","variants":["regular"]},"Ranchers":{"family":"Ranchers","variants":["regular"]},"Rancho":{"family":"Rancho","variants":["regular"]},"Ranga":{"family":"Ranga","variants":["regular","700"]},"Rasa":{"family":"Rasa","variants":["300","regular","500","600","700"]},"Rationale":{"family":"Rationale","variants":["regular"]},"Ravi Prakash":{"family":"Ravi Prakash","variants":["regular"]},"Redressed":{"family":"Redressed","variants":["regular"]},"Reem Kufi":{"family":"Reem Kufi","variants":["regular"]},"Reenie Beanie":{"family":"Reenie Beanie","variants":["regular"]},"Revalia":{"family":"Revalia","variants":["regular"]},"Rhodium Libre":{"family":"Rhodium Libre","variants":["regular"]},"Ribeye":{"family":"Ribeye","variants":["regular"]},"Ribeye Marrow":{"family":"Ribeye Marrow","variants":["regular"]},"Righteous":{"family":"Righteous","variants":["regular"]},"Risque":{"family":"Risque","variants":["regular"]},"Roboto":{"family":"Roboto","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic","900","900italic"]},"Roboto Condensed":{"family":"Roboto Condensed","variants":["300","300italic","regular","italic","700","700italic"]},"Roboto Mono":{"family":"Roboto Mono","variants":["100","100italic","300","300italic","regular","italic","500","500italic","700","700italic"]},"Roboto Slab":{"family":"Roboto Slab","variants":["100","300","regular","700"]},"Rochester":{"family":"Rochester","variants":["regular"]},"Rock Salt":{"family":"Rock Salt","variants":["regular"]},"Rokkitt":{"family":"Rokkitt","variants":["100","200","300","regular","500","600","700","800","900"]},"Romanesco":{"family":"Romanesco","variants":["regular"]},"Ropa Sans":{"family":"Ropa Sans","variants":["regular","italic"]},"Rosario":{"family":"Rosario","variants":["regular","italic","700","700italic"]},"Rosarivo":{"family":"Rosarivo","variants":["regular","italic"]},"Rouge Script":{"family":"Rouge Script","variants":["regular"]},"Rozha One":{"family":"Rozha One","variants":["regular"]},"Rubik":{"family":"Rubik","variants":["300","300italic","regular","italic","500","500italic","700","700italic","900","900italic"]},"Rubik Mono One":{"family":"Rubik Mono One","variants":["regular"]},"Ruda":{"family":"Ruda","variants":["regular","700","900"]},"Rufina":{"family":"Rufina","variants":["regular","700"]},"Ruge Boogie":{"family":"Ruge Boogie","variants":["regular"]},"Ruluko":{"family":"Ruluko","variants":["regular"]},"Rum Raisin":{"family":"Rum Raisin","variants":["regular"]},"Ruslan Display":{"family":"Ruslan Display","variants":["regular"]},"Russo One":{"family":"Russo One","variants":["regular"]},"Ruthie":{"family":"Ruthie","variants":["regular"]},"Rye":{"family":"Rye","variants":["regular"]},"Sacramento":{"family":"Sacramento","variants":["regular"]},"Sahitya":{"family":"Sahitya","variants":["regular","700"]},"Sail":{"family":"Sail","variants":["regular"]},"Salsa":{"family":"Salsa","variants":["regular"]},"Sanchez":{"family":"Sanchez","variants":["regular","italic"]},"Sancreek":{"family":"Sancreek","variants":["regular"]},"Sansita":{"family":"Sansita","variants":["regular","italic","700","700italic","800","800italic","900","900italic"]},"Sarala":{"family":"Sarala","variants":["regular","700"]},"Sarina":{"family":"Sarina","variants":["regular"]},"Sarpanch":{"family":"Sarpanch","variants":["regular","500","600","700","800","900"]},"Satisfy":{"family":"Satisfy","variants":["regular"]},"Scada":{"family":"Scada","variants":["regular","italic","700","700italic"]},"Scheherazade":{"family":"Scheherazade","variants":["regular","700"]},"Schoolbell":{"family":"Schoolbell","variants":["regular"]},"Scope One":{"family":"Scope One","variants":["regular"]},"Seaweed Script":{"family":"Seaweed Script","variants":["regular"]},"Secular One":{"family":"Secular One","variants":["regular"]},"Sevillana":{"family":"Sevillana","variants":["regular"]},"Seymour One":{"family":"Seymour One","variants":["regular"]},"Shadows Into Light":{"family":"Shadows Into Light","variants":["regular"]},"Shadows Into Light Two":{"family":"Shadows Into Light Two","variants":["regular"]},"Shanti":{"family":"Shanti","variants":["regular"]},"Share":{"family":"Share","variants":["regular","italic","700","700italic"]},"Share Tech":{"family":"Share Tech","variants":["regular"]},"Share Tech Mono":{"family":"Share Tech Mono","variants":["regular"]},"Shojumaru":{"family":"Shojumaru","variants":["regular"]},"Short Stack":{"family":"Short Stack","variants":["regular"]},"Shrikhand":{"family":"Shrikhand","variants":["regular"]},"Siemreap":{"family":"Siemreap","variants":["regular"]},"Sigmar One":{"family":"Sigmar One","variants":["regular"]},"Signika":{"family":"Signika","variants":["300","regular","600","700"]},"Signika Negative":{"family":"Signika Negative","variants":["300","regular","600","700"]},"Simonetta":{"family":"Simonetta","variants":["regular","italic","900","900italic"]},"Sintony":{"family":"Sintony","variants":["regular","700"]},"Sirin Stencil":{"family":"Sirin Stencil","variants":["regular"]},"Six Caps":{"family":"Six Caps","variants":["regular"]},"Skranji":{"family":"Skranji","variants":["regular","700"]},"Slabo 13px":{"family":"Slabo 13px","variants":["regular"]},"Slabo 27px":{"family":"Slabo 27px","variants":["regular"]},"Slackey":{"family":"Slackey","variants":["regular"]},"Smokum":{"family":"Smokum","variants":["regular"]},"Smythe":{"family":"Smythe","variants":["regular"]},"Sniglet":{"family":"Sniglet","variants":["regular","800"]},"Snippet":{"family":"Snippet","variants":["regular"]},"Snowburst One":{"family":"Snowburst One","variants":["regular"]},"Sofadi One":{"family":"Sofadi One","variants":["regular"]},"Sofia":{"family":"Sofia","variants":["regular"]},"Sonsie One":{"family":"Sonsie One","variants":["regular"]},"Sorts Mill Goudy":{"family":"Sorts Mill Goudy","variants":["regular","italic"]},"Source Code Pro":{"family":"Source Code Pro","variants":["200","300","regular","500","600","700","900"]},"Source Sans Pro":{"family":"Source Sans Pro","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","900","900italic"]},"Source Serif Pro":{"family":"Source Serif Pro","variants":["regular","600","700"]},"Space Mono":{"family":"Space Mono","variants":["regular","italic","700","700italic"]},"Special Elite":{"family":"Special Elite","variants":["regular"]},"Spicy Rice":{"family":"Spicy Rice","variants":["regular"]},"Spinnaker":{"family":"Spinnaker","variants":["regular"]},"Spirax":{"family":"Spirax","variants":["regular"]},"Squada One":{"family":"Squada One","variants":["regular"]},"Sree Krushnadevaraya":{"family":"Sree Krushnadevaraya","variants":["regular"]},"Sriracha":{"family":"Sriracha","variants":["regular"]},"Stalemate":{"family":"Stalemate","variants":["regular"]},"Stalinist One":{"family":"Stalinist One","variants":["regular"]},"Stardos Stencil":{"family":"Stardos Stencil","variants":["regular","700"]},"Stint Ultra Condensed":{"family":"Stint Ultra Condensed","variants":["regular"]},"Stint Ultra Expanded":{"family":"Stint Ultra Expanded","variants":["regular"]},"Stoke":{"family":"Stoke","variants":["300","regular"]},"Strait":{"family":"Strait","variants":["regular"]},"Sue Ellen Francisco":{"family":"Sue Ellen Francisco","variants":["regular"]},"Suez One":{"family":"Suez One","variants":["regular"]},"Sumana":{"family":"Sumana","variants":["regular","700"]},"Sunshiney":{"family":"Sunshiney","variants":["regular"]},"Supermercado One":{"family":"Supermercado One","variants":["regular"]},"Sura":{"family":"Sura","variants":["regular","700"]},"Suranna":{"family":"Suranna","variants":["regular"]},"Suravaram":{"family":"Suravaram","variants":["regular"]},"Suwannaphum":{"family":"Suwannaphum","variants":["regular"]},"Swanky and Moo Moo":{"family":"Swanky and Moo Moo","variants":["regular"]},"Syncopate":{"family":"Syncopate","variants":["regular","700"]},"Tangerine":{"family":"Tangerine","variants":["regular","700"]},"Taprom":{"family":"Taprom","variants":["regular"]},"Tauri":{"family":"Tauri","variants":["regular"]},"Taviraj":{"family":"Taviraj","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Teko":{"family":"Teko","variants":["300","regular","500","600","700"]},"Telex":{"family":"Telex","variants":["regular"]},"Tenali Ramakrishna":{"family":"Tenali Ramakrishna","variants":["regular"]},"Tenor Sans":{"family":"Tenor Sans","variants":["regular"]},"Text Me One":{"family":"Text Me One","variants":["regular"]},"The Girl Next Door":{"family":"The Girl Next Door","variants":["regular"]},"Tienne":{"family":"Tienne","variants":["regular","700","900"]},"Tillana":{"family":"Tillana","variants":["regular","500","600","700","800"]},"Timmana":{"family":"Timmana","variants":["regular"]},"Tinos":{"family":"Tinos","variants":["regular","italic","700","700italic"]},"Titan One":{"family":"Titan One","variants":["regular"]},"Titillium Web":{"family":"Titillium Web","variants":["200","200italic","300","300italic","regular","italic","600","600italic","700","700italic","900"]},"Trade Winds":{"family":"Trade Winds","variants":["regular"]},"Trirong":{"family":"Trirong","variants":["100","100italic","200","200italic","300","300italic","regular","italic","500","500italic","600","600italic","700","700italic","800","800italic","900","900italic"]},"Trocchi":{"family":"Trocchi","variants":["regular"]},"Trochut":{"family":"Trochut","variants":["regular","italic","700"]},"Trykker":{"family":"Trykker","variants":["regular"]},"Tulpen One":{"family":"Tulpen One","variants":["regular"]},"Ubuntu":{"family":"Ubuntu","variants":["300","300italic","regular","italic","500","500italic","700","700italic"]},"Ubuntu Condensed":{"family":"Ubuntu Condensed","variants":["regular"]},"Ubuntu Mono":{"family":"Ubuntu Mono","variants":["regular","italic","700","700italic"]},"Ultra":{"family":"Ultra","variants":["regular"]},"Uncial Antiqua":{"family":"Uncial Antiqua","variants":["regular"]},"Underdog":{"family":"Underdog","variants":["regular"]},"Unica One":{"family":"Unica One","variants":["regular"]},"UnifrakturCook":{"family":"UnifrakturCook","variants":["700"]},"UnifrakturMaguntia":{"family":"UnifrakturMaguntia","variants":["regular"]},"Unkempt":{"family":"Unkempt","variants":["regular","700"]},"Unlock":{"family":"Unlock","variants":["regular"]},"Unna":{"family":"Unna","variants":["regular","italic","700","700italic"]},"VT323":{"family":"VT323","variants":["regular"]},"Vampiro One":{"family":"Vampiro One","variants":["regular"]},"Varela":{"family":"Varela","variants":["regular"]},"Varela Round":{"family":"Varela Round","variants":["regular"]},"Vast Shadow":{"family":"Vast Shadow","variants":["regular"]},"Vesper Libre":{"family":"Vesper Libre","variants":["regular","500","700","900"]},"Vibur":{"family":"Vibur","variants":["regular"]},"Vidaloka":{"family":"Vidaloka","variants":["regular"]},"Viga":{"family":"Viga","variants":["regular"]},"Voces":{"family":"Voces","variants":["regular"]},"Volkhov":{"family":"Volkhov","variants":["regular","italic","700","700italic"]},"Vollkorn":{"family":"Vollkorn","variants":["regular","italic","700","700italic"]},"Voltaire":{"family":"Voltaire","variants":["regular"]},"Waiting for the Sunrise":{"family":"Waiting for the Sunrise","variants":["regular"]},"Wallpoet":{"family":"Wallpoet","variants":["regular"]},"Walter Turncoat":{"family":"Walter Turncoat","variants":["regular"]},"Warnes":{"family":"Warnes","variants":["regular"]},"Wellfleet":{"family":"Wellfleet","variants":["regular"]},"Wendy One":{"family":"Wendy One","variants":["regular"]},"Wire One":{"family":"Wire One","variants":["regular"]},"Work Sans":{"family":"Work Sans","variants":["100","200","300","regular","500","600","700","800","900"]},"Yanone Kaffeesatz":{"family":"Yanone Kaffeesatz","variants":["200","300","regular","700"]},"Yantramanav":{"family":"Yantramanav","variants":["100","300","regular","500","700","900"]},"Yatra One":{"family":"Yatra One","variants":["regular"]},"Yellowtail":{"family":"Yellowtail","variants":["regular"]},"Yeseva One":{"family":"Yeseva One","variants":["regular"]},"Yesteryear":{"family":"Yesteryear","variants":["regular"]},"Yrsa":{"family":"Yrsa","variants":["300","regular","500","600","700"]},"Zeyada":{"family":"Zeyada","variants":["regular"]}}';
	}
}


/*
 * Get regular fonts
 */
if ( ! function_exists( 'ishfreelotheme_get_regular_fonts' ) ) {
	function ishfreelotheme_get_regular_fonts(){
		return array('arial'=>'Arial',
			'verdana'=>'Verdana, Geneva',
			'trebuchet'=>'Trebuchet',
			'georgia' =>'Georgia',
			'times'=>'Times New Roman',
			'tahoma'=>'Tahoma, Geneva',
			'palatino'=>'Palatino',
			'helvetica'=>'Helvetica' );
	}
}


/*
 * Get regular fonts list
 */
if ( ! function_exists( 'ishfreelotheme_get_regular_fonts_list' ) ) {
	function ishfreelotheme_get_regular_fonts_list(){
		return '<option value="arial">Arial</option><option value="verdana">Verdana, Geneva</option><option value="trebuchet">Trebuchet</option><option value="georgia">Georgia</option><option value="times">Times New Roman</option><option value="tahoma">Tahoma, Geneva</option><option value="palatino">Palatino</option><option value="helvetica">Helvetica</option>';
	}
}


/*
 * Get google fonts js
 */
if ( ! function_exists( 'ishfreelotheme_get_google_fonts_js' ) ) {
	function ishfreelotheme_get_google_fonts_js(){

		return "\n\n<script type='text/javascript'>\n/* <![CDATA[*/\n var ish_google_fonts = '" . ishfreelotheme_get_google_fonts() . "';\n var ish_regular_fonts = '" . ishfreelotheme_get_regular_fonts_list() . "';\n/* ]]> */ \n </script>\n\n";
	}
}

/*
 * Extend Author information
 */
if ( ! function_exists( 'ishfreelotheme_author_social_urls' ) ) {
	function ishfreelotheme_author_social_urls( $contactmethods ) {

		$contactmethods['twitter'] = esc_html__( 'Twitter Profile URL', 'freelo' );
		$contactmethods['facebook'] = esc_html__( 'Facebook Profile URL', 'freelo' );
		$contactmethods['googleplus'] = esc_html__( 'Google+ Profile URL', 'freelo' );

		$contactmethods['instagram'] = esc_html__( 'Instagram Profile URL', 'freelo' );
		$contactmethods['dribbble'] = esc_html__( 'Dribbble Profile URL', 'freelo' );
		$contactmethods['behance'] = esc_html__( 'Behance Profile URL', 'freelo' );

		$contactmethods['linkedin'] = esc_html__( 'Linkedin Profile URL', 'freelo' );
		$contactmethods['github'] = esc_html__( 'GitHub Profile URL', 'freelo' );

		return $contactmethods;
	}
}
add_filter( 'user_contactmethods', 'ishfreelotheme_author_social_urls', 10, 1);


/*
 * Detects active WooCommerce plugin
 */
if ( ! function_exists( 'ishfreelotheme_woocommerce_plugin_active' ) ) {
	function ishfreelotheme_woocommerce_plugin_active()
	{
		include_once( ABSPATH .'wp-admin/includes/plugin.php' );
		if( is_plugin_active( 'woocommerce/woocommerce.php' ) ) return true;
		return false;
	}
}


/*
 * Detects active WPML plugin
 */
if ( ! function_exists( 'ishfreelotheme_wpml_plugin_active' ) ) {
	function ishfreelotheme_wpml_plugin_active()
	{
		include_once( ABSPATH .'wp-admin/includes/plugin.php' );
		if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) return true;
		return false;
	}
}


/*
 * Woocommerce integration
 */
require_once( get_template_directory() . '/woocommerce/config.php' );


/*
 * Filter Search results
 */
if ( ! function_exists( 'ishfreelotheme_filter_where' ) ) {
	function ishfreelotheme_filter_where($where = '') {
		global $ishfreelotheme_options;

		// Exclude error 404 page
		$ishfreelotheme_id_404 = ( isset( $ishfreelotheme_options['use_page_for_404'] ) && ( '1' == $ishfreelotheme_options['use_page_for_404'] ) && isset( $ishfreelotheme_options['page_for_404'] ) ) ? $ishfreelotheme_options['page_for_404'] : '';

		if ($ishfreelotheme_id_404) {
			if ( is_search() ) {
				$exclude = array($ishfreelotheme_id_404);

				for( $x=0; $x<count($exclude); $x++){
					$where .= " AND ID != " . $exclude[$x];
				}
			}
		}
		return $where;
	}
}
add_filter( 'posts_where', 'ishfreelotheme_filter_where');


/*
 * IshYoBoy language selector
 */
if ( ! function_exists( 'ishfreelotheme_language_selector' ) ) {
	function ishfreelotheme_language_selector(){
		$languages = icl_get_languages('skip_missing=0&orderby=code');
		$return = '';
		if(!empty($languages)){
			$return .= '<ul class="sub-menu">';
			foreach($languages as $l){
				$return .= '<li>';
				$return .= ($l['active']) ? ('<a href="#">') : ('<a href="'.$l['url'].'">');
				// Uncomment to show flags images:
				// $return .=  '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" class="ish-lng-img" /> ';
				$return .=  $l['native_name'];
				// Uncomment to show translated name:
				// $return .=  $l['translated_name'];
				$return .=  '</a>';
				$return .= '</li>';
			}
			$return .= '</ul>';
		}
		return $return;
	}
}


/*
 * Detects active SEO plugins
 */
if ( ! function_exists( 'ishfreelotheme_seo_plugin_active' ) ) {
	function ishfreelotheme_seo_plugin_active()
	{
		include_once( ABSPATH .'wp-admin/includes/plugin.php' );
		if( is_plugin_active( 'all-in-one-seo-pack/all_in_one_seo_pack.php' ) ) return true;
		if( is_plugin_active( 'headspace2/headspace.php' ) ) return true;
		if( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) return true;
		return false;
	}
}

/*
 * Load Language
 */
function ishfreelotheme_load_theme_textdomain(){
	load_theme_textdomain( 'freelo', get_template_directory() .'/language' );
}
add_action( 'after_setup_theme', 'ishfreelotheme_load_theme_textdomain');

// Shopping cart updater
if ( ishfreelotheme_woocommerce_plugin_active() ){
	add_filter( 'add_to_cart_fragments', 'ishfreelotheme_shopping_cart_update', 10, 1);
}

// Main Menu
add_filter( 'wp_nav_menu_items', 'ishfreelotheme_add_search_form', 10, 2 );
if ( ishfreelotheme_woocommerce_plugin_active() ){
	add_filter( 'wp_nav_menu_items', 'ishfreelotheme_add_main_menu_shopping_cart', 10, 2 ) ;
}
if ( ishfreelotheme_wpml_plugin_active() ){
	add_filter( 'wp_nav_menu_items', 'ishfreelotheme_add_language_selector', 10, 4 );
}


// Header Bar
if ( ishfreelotheme_woocommerce_plugin_active() ){
	add_filter( 'wp_nav_menu_items', 'ishfreelotheme_add_header_bar_shopping_cart', 10, 2 ) ;
}
if ( ishfreelotheme_wpml_plugin_active() ){
	add_filter( 'wp_nav_menu_items', 'ishfreelotheme_add_header_bar_language_selector', 10, 2 );
}
add_filter( 'wp_nav_menu_items', 'ishfreelotheme_add_header_bar_search_form', 10, 2 );










/* *********************************************************************************************************************
 *
 * 3. IshYoBoy Framework Activation
 *
 * ********************************************************************************************************************/

$tempdir = get_template_directory();

require_once( get_template_directory() . '/assets/framework/wp/includes/sidebar_generator.php' );
require_once( get_template_directory() . '/assets/framework/wp/includes/ish_like_it.php' );
require_once( get_template_directory() . '/assets/framework/wp/includes/fontello_icons_menu.php' );
require_once( get_template_directory() . '/admin/index.php' );
require_once( get_template_directory() . '/assets/framework/wp/options/init.php' );
require_once( get_template_directory() . '/assets/framework/wp/includes/class-tgm-plugin-activation.php' );
require_once( get_template_directory() . '/assets/framework/wp/pagebuilder/ish_config/config_as_plugin.php' );
require_once( get_template_directory() . '/assets/framework/wp/includes/ish_megamenu.php' );

/**
 * Module to enable checking of new theme updates
 */
require get_template_directory() . '/assets/framework/wp/update-checker/update-checker.php';
