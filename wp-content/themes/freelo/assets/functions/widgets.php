<?php

/* *********************************************************************************************************************
 * Register widget areas
 */
if ( ! function_exists( 'ishfreelotheme_sidebars_init' ) ) {

	function ishfreelotheme_sidebars_init() {

		if (function_exists( 'register_sidebar')) {

			register_sidebar(array(
				'name' => esc_html__( 'Blog Sidebar', 'freelo' ),
				'id'   => 'sidebar-main',
				'description'   => esc_html__( 'This is the widgetized blog sidebar.', 'freelo' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				//'before_title'  => '<div class="widget-title ish-h5">',
				//'after_title'   => '</span></div>'
				'before_title'  => '<div class="widget-title ish-sc-element ish-sc_separator ish-separator-text ish-separator-solid ish-no-align ish-h5"><span class="ish-line ish-left"><span class="ish-line-border"></span></span>',
				'after_title'   => '</span><span class="ish-line ish-right"><span class="ish-line-border"></span></span></div>'
			));

			register_sidebar(array(
				'name' => esc_html__( 'Side Navigation Sidebar', 'freelo' ),
				'id'   => 'sidebar-sidenav',
				'description'   => esc_html__( 'This is the widgetized Side Navigation sidebar.', 'freelo' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title ish-sc-element ish-sc_separator ish-separator-text ish-separator-solid ish-no-align ish-h5"><span class="ish-line ish-left"><span class="ish-line-border"></span></span>',
				'after_title'   => '</span><span class="ish-line ish-right"><span class="ish-line-border"></span></span></div>'
			));

			if ( is_plugin_active('ishyoboy-freelo-assets/ishyoboy-freelo-assets.php') ){
				register_sidebar(array(
					'name' => esc_html__( 'Portfolio Sidebar', 'freelo' ),
					'id'   => 'sidebar-portfolio',
					'description'   => esc_html__( 'This is the widgetized Portfolio sidebar.', 'freelo' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title ish-sc-element ish-sc_separator ish-separator-text ish-separator-solid ish-no-align ish-h5"><span class="ish-line ish-left"><span class="ish-line-border"></span></span>',
					'after_title'   => '</span><span class="ish-line ish-right"><span class="ish-line-border"></span></span></div>'
				));
			}

			register_sidebar(array(
				'name' => esc_html__( 'Expandable', 'freelo' ),
				'id'   => 'sidebar-header',
				'description'   => esc_html__( 'This is the widgetized expandable area', 'freelo' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title ish-sc-element ish-sc_separator ish-separator-text ish-separator-solid ish-no-align ish-h5"><span class="ish-line ish-left"><span class="ish-line-border"></span></span>',
				'after_title'   => '</span><span class="ish-line ish-right"><span class="ish-line-border"></span></span></div>'
			));

			register_sidebar(array(
				'name' => esc_html__( 'Footer', 'freelo' ),
				'id'   => 'sidebar-footer',
				'description'   => esc_html__( 'This is the widgetized footer.', 'freelo' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title ish-sc-element ish-sc_separator ish-separator-text ish-separator-solid ish-no-align ish-h5"><span class="ish-line ish-left"><span class="ish-line-border"></span></span>',
				'after_title'   => '</span><span class="ish-line ish-right"><span class="ish-line-border"></span></span></div>'
			));

			/* register_sidebar(array(
				'name' => esc_html__( 'Footer Legals', 'freelo' ),
				'id'   => 'sidebar-footer-legals',
				'description'   => esc_html__( 'This is the widgetized footer legals.', 'freelo' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title ish-h5">',
				'after_title'   => '</span></div>'
			)); */

			if ( ishfreelotheme_woocommerce_plugin_active() ){
				register_sidebar(array(
					'name' => esc_html__( 'WooCommerce Sidebar', 'freelo' ),
					'id'   => 'sidebar-woocommerce',
					'description'   => esc_html__( 'This is the widgetized sidebar for Woocommerce pages if set in theme options.', 'freelo' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title ish-sc-element ish-sc_separator ish-separator-text ish-separator-solid ish-no-align ish-h5"><span class="ish-line ish-left"><span class="ish-line-border"></span></span>',
					'after_title'   => '</span><span class="ish-line ish-right"><span class="ish-line-border"></span></span></div>'
				));
			}

			// Also change the settings in "assets/framework/wp/includes/sidebar_generator.php"
		}
	}
}
global $wp_embed;
add_action( 'widgets_init', 'ishfreelotheme_sidebars_init' );
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );

$ishfreelotheme_sidebar_curwidth = 0;
$ishfreelotheme_last_sidebar = -1;


/* *********************************************************************************************************************
 * Widget first - last class
 * Add "first" and "last" CSS classes to dynamic sidebar widgets.
 * Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 */
if ( ! function_exists( 'widget_first_last_classes' ) ) {
	function widget_first_last_classes( $params ) {

		global $wp_registered_widgets, $ishfreelotheme_sidebar_width, $ishfreelotheme_sidebar_area, $ishfreelotheme_sidebar_curwidth, $ishfreelotheme_last_sidebar;
		global $ishfreelotheme_widget_num; // Global counter array

		$new_row_string = '</div></div><div class="ish-row ish-row-notfull"><div class="ish-row_inner">';

		// Get the id for the current sidebar we're processing
		$this_id = $params[0]['id'];
		if ( $ishfreelotheme_last_sidebar != $this_id ) {
			$ishfreelotheme_last_sidebar = $this_id;
			$ishfreelotheme_sidebar_curwidth = 0;
		}

		// Get an array of ALL registered widgets
		$arr_registered_widgets = wp_get_sidebars_widgets();

		// If the counter array doesn't exist, create it
		if( ! $ishfreelotheme_widget_num ) {
			$ishfreelotheme_widget_num = array();
		}

		// Check if the current sidebar has no widgets
		if( ! isset( $arr_registered_widgets[ $this_id ] ) || ! is_array( $arr_registered_widgets[ $this_id ] ) ) {
			return $params; // No widgets in this sidebar... bail early.
		}

		// See if the counter array has an entry for this sidebar
		if ( isset( $ishfreelotheme_widget_num[ $this_id ] ) ) {
			$ishfreelotheme_widget_num[ $this_id ]++;
		} else { // If not, create it starting with 1
			$ishfreelotheme_widget_num[ $this_id ] = 1;
		}

		// Add a widget number class for additional styling options
		$class = 'class="widget-' . $ishfreelotheme_widget_num[$this_id] . ' ';

		$divider_exists = false;
		if ( false !== strpos( $params[0]['after_widget'], $new_row_string ) ){
			$divider_exists = true;
		}

		if (  $ishfreelotheme_widget_num[ $this_id ] == count( $arr_registered_widgets[ $this_id ] ) &&  $divider_exists){
			$params[0]['after_widget'] = str_replace( $new_row_string, '', $params[0]['after_widget']);
		}

		// Insert our new classes into "before widget"
		$params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1);

		$widget_id	= $params[0]['widget_id'];
		$widget_obj	= $wp_registered_widgets[$widget_id];
		if ( 'icl_lang_sel_widget' == $widget_obj['id'] ){
			//WPML Widget
			$widget_obj['params'][0]['number'] = 0;
			$widget_num	= $widget_obj['params'][0]['number'];
		}
		else{
			$widget_opt	= get_option($widget_obj['callback'][0]->option_name);
			$widget_num	= $widget_obj['params'][0]['number'];
		}

		// Load the default ishyoboy widgets values if widget being added trough customizer
		if ( empty($widget_opt[$widget_num]) && isset($widget_obj['callback'][0]->defaults) ) {
			$widget_opt[$widget_num] = wp_parse_args( (array) $widget_opt[$widget_num], $widget_obj['callback'][0]->defaults);
		}

		if ( isset($widget_opt[$widget_num]['widget_width']) && !empty($widget_opt[$widget_num]['widget_width']) ){}
		else{
			$widget_opt[$widget_num]['widget_width'] = 3;
		}

		$ishfreelotheme_sidebar_curwidth += $widget_opt[$widget_num]['widget_width'];

		if (  $ishfreelotheme_sidebar_curwidth >= $ishfreelotheme_sidebar_width ){
			if (  $ishfreelotheme_widget_num[$this_id] != count($arr_registered_widgets[$this_id]) &&  !$divider_exists){
				$params[0]['after_widget'] .= $new_row_string;
			}
			$ishfreelotheme_sidebar_curwidth = 0;
		}

		// Add the grid class based on the additional widget width field
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"ish-grid{$widget_opt[$widget_num]['widget_width']} ", $params[0]['before_widget'], 1 );

			$before_title_immediately = '';
			$after_title_immediately = '';
			$no_title = ' ish-no-title';
			$no_icon = '';



			if ( isset( $widget_opt[$widget_num]['title'] ) && ( ' ' != $widget_opt[$widget_num]['title'] ) ) {

				// Add Text Class
				$params[0]['before_title'] = str_replace( 'ish-sc_separator', 'ish-sc_separator ish-text', $params[0]['before_title'] );

				$before_title_immediately = '<span class="ish-text">';
				$after_title_immediately = '</span>';
				$no_title = '';
			}

			if ( isset($widget_opt[$widget_num]['widget_icon']) && ( '' != $widget_opt[$widget_num]['widget_icon'] ) ) {

				// Add Icon Left Class
				$params[0]['before_title'] = str_replace( 'ish-sc_separator', 'ish-sc_separator ish-icon-left', $params[0]['before_title'] );

				$params[0]['before_title'] .= '<span class="ish-icon ish-left"><span class="' . $widget_opt[$widget_num]['widget_icon'] . '"></span></span>' . $before_title_immediately;
				$params[0]['after_title'] = $after_title_immediately . '<span class="ish-line ish-right' . $no_title . $no_icon . '"><span class="ish-line-border"></span></span></div>';

			}
			else{


				// Add No Icon Class
				$params[0]['before_title'] = str_replace( 'ish-sc_separator', 'ish-sc_separator ish-no-icon', $params[0]['before_title'] );

				$no_icon = ' ish-no-icon';
				$params[0]['before_title'] .= $before_title_immediately;
				$params[0]['after_title'] = $after_title_immediately . '<span class="ish-line ish-right' . $no_title . $no_icon . '"><span class="ish-line-border"></span></span></div>';

			}
		/*}
		else{
			// ALL OTHER SIDEBARS

			// Add the icon class based on the additional widget icon field
			if ( isset($widget_opt[$widget_num]['widget_icon']) && ( '' != $widget_opt[$widget_num]['widget_icon'] ) ){
				$params[0]['before_title'] = str_replace( 'widget-title', "widget-title {$widget_opt[$widget_num]['widget_icon']}", $params[0]['before_title'] );
			}

		}*/



		/*if (  $ishfreelotheme_widget_num[ $this_id ] == count( $arr_registered_widgets[ $this_id ] ) ){
			$ishfreelotheme_widget_num[ $this_id ] = 0;
			$ishfreelotheme_sidebar_curwidth = 0;
		}*/

		return $params;
	}
}
add_filter( 'dynamic_sidebar_params', 'widget_first_last_classes' );


/* *********************************************************************************************************************
 * Use footer sidebar
 */
if ( ! function_exists( 'ishfreelotheme_use_footer_sidebar' ) ) {
	function ishfreelotheme_use_footer_sidebar(){
		global $ishfreelotheme_options, $ishfreelotheme_woo_id, $ishfreelotheme_id_404;

		if ( is_404() ){
			$post_id = $ishfreelotheme_id_404;
		}
		else if ( isset($ishfreelotheme_woo_id) ) {
			$post_id = $ishfreelotheme_woo_id;
		}
		else{
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}
		$local = '';

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$local = isset( $meta['_ishmb_use_fw_area'] ) ? $meta['_ishmb_use_fw_area'][0] : '';
		}elseif(null != $post_id){
			$local = IshYoMetaBox::get('use_fw_area', true, $post_id );
		}else{
			if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
				$local = '';
			}else{
				$local = IshYoMetaBox::get('use_fw_area');
			}
		}

		if ('' != $local){
			if ( '1' == $local ){
				// Use expandable
				if (is_home()){
					$sidebar_set = ( isset($meta['_ishmb_footer_sidebar']) && is_active_sidebar($meta['_ishmb_footer_sidebar'][0]) ) ? true : false;
				}else{
					$sidebar = IshYoMetaBox::get('footer_sidebar', true, $post_id );
					$sidebar_set = is_active_sidebar($sidebar);
				}

				return $sidebar_set;

			} else {
				return false;
			}

		}
		else{
			// Default theme options
			return (isset($ishfreelotheme_options['footer_widget_area']) && '1' == $ishfreelotheme_options['footer_widget_area'] && isset($ishfreelotheme_options['footer_sidebar']) && is_active_sidebar($ishfreelotheme_options['footer_sidebar']) ) ? true : false;

		}
	}
}


/* *********************************************************************************************************************
 * Get footer sidebar
 */
if ( ! function_exists( 'ishfreelotheme_get_footer_sidebar' ) ) {
	function ishfreelotheme_get_footer_sidebar(){
		global $ishfreelotheme_options, $ishfreelotheme_woo_id, $ishfreelotheme_id_404;

		if ( is_404() ){
			$post_id = $ishfreelotheme_id_404;
		}
		elseif ( isset($ishfreelotheme_woo_id) ) {
			$post_id = $ishfreelotheme_woo_id;
		}
		else{
			$post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
		}

		$local = '';

		if (is_home()){
			$meta = get_post_meta( get_option( 'page_for_posts' ) );
			$local = isset( $meta['_ishmb_use_fw_area'] ) ? $meta['_ishmb_use_fw_area'][0] : '';
		}elseif(null != $post_id){
			$local = IshYoMetaBox::get('use_fw_area', true, $post_id );
		}else{
			if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
				$local = '';
			}else{
				$local = IshYoMetaBox::get('use_fw_area');
			}
		}

		if ('' != $local){
			if ( '1' == $local ){
				// Use expandable
				if (is_home()){
					$sidebar_set = ( isset($meta['_ishmb_footer_sidebar'])) ? $meta['_ishmb_footer_sidebar'][0] : '';
				}else{
					$sidebar_set = IshYoMetaBox::get('footer_sidebar', true, $post_id );
				}

				return $sidebar_set;

			} else {
				return '';
			}

		}
		else{
			// Default theme options
			return (isset($ishfreelotheme_options['footer_widget_area']) && '1' == $ishfreelotheme_options['footer_widget_area'] && isset($ishfreelotheme_options['footer_sidebar']) && is_active_sidebar($ishfreelotheme_options['footer_sidebar']) ) ? $ishfreelotheme_options['footer_sidebar'] : '';

		}
	}
}


/* *********************************************************************************************************************
 * Get legals sidebar
 */
if ( ! function_exists( 'ishfreelotheme_get_legals_sidebar' ) ) {
	function ishfreelotheme_get_legals_sidebar(){
		global $ishfreelotheme_options;

		// Default theme options
		return (isset($ishfreelotheme_options['footer_legals_area']) && '1' == $ishfreelotheme_options['footer_legals_area'] && isset($ishfreelotheme_options['footer_legals']) && is_active_sidebar($ishfreelotheme_options['footer_legals']) ) ? $ishfreelotheme_options['footer_legals'] : '';

	}
}


/* *********************************************************************************************************************
 * Use footer legals
 */
if ( ! function_exists( 'ishfreelotheme_use_footer_legals' ) ) {
	function ishfreelotheme_use_footer_legals(){
		global $ishfreelotheme_options;

		// Default theme options
		return (isset($ishfreelotheme_options['footer_legals_area']) && '' != $ishfreelotheme_options['footer_legals_area'] ) ? true : false;

	}
}

/**
 *  Echoes one more field to each widget
 *
 *  Echoes one more field to each widget's form on the backend to allow the users to specify widget width. Called in
 *  "widget_form_callback" hook
 *
 * @param array $instance
 * @param array $widget
 *
 * @return array $instance to let the filter work correctly
 */
if ( ! function_exists( 'ishfreelotheme_widget_form_extend' ) ) {
	function ishfreelotheme_widget_form_extend( $instance, $widget ) {
		if ( !isset($instance['widget_width']) )
			$instance['widget_width'] = '3';

		echo "<p>\n";
		echo "\t<label for='widget-{$widget->id_base}-{$widget->number}-widget_width'>" . esc_html__( 'Widget width:', 'freelo') . "</label>\n";
		echo "\t<select name='widget-{$widget->id_base}[{$widget->number}][widget_width]' id='widget-{$widget->id_base}-{$widget->number}-widget_width' class='widefat'>";
		echo "\t<option value='3' " . selected( $instance['widget_width'], '3', false) . ">One fourth</option>\n";
		echo "\t<option value='4' " . selected( $instance['widget_width'], '4', false) . ">One third</option>\n";
		echo "\t<option value='6' " . selected( $instance['widget_width'], '6', false) . ">One half</option>\n";
		echo "\t<option value='12' " . selected( $instance['widget_width'], '12', false) . ">One full</option>\n";
		echo "\t<option value='8' " . selected( $instance['widget_width'], '8', false) . ">Two thirds</option>\n";
		echo "\t<option value='9' " . selected( $instance['widget_width'], '9', false) . ">Three fourths</option>\n";
		echo "\t</select>\n";
		echo "</p>\n";

		return $instance;
	}
}

/**
 *  Adds widget_icon field to each widget
 *
 *  Echoes widget_icon field to each widget's form on the backend to allow the users to specify widget icon class. Called in
 *  "widget_form_callback" hook
 *
 * @param array $instance
 * @param array $widget
 *
 * @return array $instance to let the filter work correctly
 */
if ( ! function_exists( 'ishfreelotheme_widget_icon_field' ) ) {
	function ishfreelotheme_widget_icon_field( $instance, $widget ) {
		if ( ! isset($instance['widget_icon']) ){
			if ( isset( $widget->widget_options['widget_icon'] ) ) {
				$instance['widget_icon'] = $widget->widget_options['widget_icon'];
			}
			else{

				$instance['widget_icon'] = 'ish-icon-doc-text';

				if ( isset( $widget ) && is_object($widget) ) {

					switch ( $widget->id_base ) {

						case 'archives' :
							$instance['widget_icon'] = 'ish-icon-calendar';
							break;

						case 'meta' :
							$instance['widget_icon'] = 'ish-icon-sliders';
							break;

						case 'categories' :
							$instance['widget_icon'] = 'ish-icon-folder-open';
							break;

						case 'calendar' :
							$instance['widget_icon'] = 'ish-icon-calendar';
							break;

						case 'menu' :
							$instance['widget_icon'] = 'ish-icon-menu';
							break;

						case 'pages' :
							$instance['widget_icon'] = 'ish-icon-folder-open';
							break;

						case 'recent-comments' :
							$instance['widget_icon'] = 'ish-icon-chat';
							break;

						case 'recent-posts' :
							$instance['widget_icon'] = 'ish-icon-doc-text';
							break;

						case 'nav_menu' :
							$instance['widget_icon'] = 'ish-icon-menu';
							break;

						case 'rss' :
							$instance['widget_icon'] = 'ish-icon-rss';
							break;

						case 'search' :
							$instance['widget_icon'] = 'ish-icon-search';
							break;

						case 'tag_cloud' :
							$instance['widget_icon'] = 'ish-icon-th-large';
							break;

						case 'text' :
							$instance['widget_icon'] = 'ish-icon-doc-text';
							break;

						default :
							$instance['widget_icon'] = 'ish-icon-doc-text';
					}
				}
			}

		}

		echo "<p>\n";
		echo "\t<label for='widget-{$widget->id_base}-{$widget->number}-widget_icon'>" . esc_html__( 'Widget icon class:', 'freelo') . "</label>\n";
		echo "\t<input name='widget-{$widget->id_base}[{$widget->number}][widget_icon]' id='widget-{$widget->id_base}-{$widget->number}-widget_icon' class='widefat' type='text' value='". $instance['widget_icon'] ."'>\n";
		echo "</p>\n";

		return $instance;
	}
}

/**
 *  Allows the update of a new widget field
 *
 *  Allows the update of a new widget field (when widget form saved) generated by the "ishfreelotheme_widget_form_extend"
 *  which adds widget width field.
 *
 * @param array $instance
 * @param array $new_instance
 * @param array $old_instance
 *
 * @return array $instance The updated value
 */
if ( ! function_exists( 'ishfreelotheme_widget_update' ) ) {
	function ishfreelotheme_widget_update( $instance, $new_instance, $old_instance ) {

		if ( isset( $new_instance['widget_width'] ) ){
			$instance['widget_width'] = $new_instance['widget_width'];
		}

		if ( isset( $new_instance['widget_icon'] ) ){
			$instance['widget_icon'] = $new_instance['widget_icon'];
		}

		return $instance;
	}
}