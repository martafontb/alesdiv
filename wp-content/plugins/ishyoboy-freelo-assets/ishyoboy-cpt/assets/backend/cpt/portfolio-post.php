<?php

/*******************************************************************************************************************
 * Create and register Portfolio post type
 */
if ( ! function_exists( 'ishfreelotheme_portfolio_post_type') ){
	function ishfreelotheme_portfolio_post_type()
	{
		$labels = array(
			'name'              => esc_html__( 'Portfolio', 'ishyoboy_assets' ),
			'singular_name'     => esc_html__( 'Portfolio Item', 'ishyoboy_assets' ),
			'add_new'           => _x( 'Add New Item', 'portfolio-post', 'ishyoboy_assets' ),
			'add_new_item'      => esc_html__( 'Add New Item', 'ishyoboy_assets' ),
			'edit_item'         => esc_html__( 'Edit Portfolio Item', 'ishyoboy_assets' ),
			'new_item'          => esc_html__( 'New Portfolio Item', 'ishyoboy_assets' ),
			'view_item'         => esc_html__( 'View Portfolio Item', 'ishyoboy_assets' ),
			'search_items'      => esc_html__( 'Search Portfolio Items', 'ishyoboy_assets' ),
			'not_found'         => esc_html__( 'No Portfolio Items Found', 'ishyoboy_assets' ),
			'not_found_in_trash'=> esc_html__( 'No Portfolio Items Found In Trash', 'ishyoboy_assets' ),
			'parent_item_colon' => esc_html__( 'Parent Portfolio Item', 'ishyoboy_assets' ),
			'menu_name'         => esc_html__( 'Portfolio', 'ishyoboy_assets' ),
			'all_items'         => esc_html__( 'All Portfolio Items', 'ishyoboy_assets' ),
		);
		$taxonomies = array();
		$supports = apply_filters( 'ish_cpt_plugin_portfolio_post_type_supports', array('title', 'editor', 'thumbnail', 'comments' ) );

		global $ishfreelotheme_options, $sitepress;

		if ( is_object( $sitepress ) && defined('ISH_LNG') && '' != ISH_LNG ){

			// WPML Plugin is active & not default language
			$default_options = of_get_options( OPTIONS_BASE );

			// Get the portfolio slug from the default language
			if ( isset( $default_options['slug_portfolio'] ) && '' != $default_options['slug_portfolio'] ){
				$slug = trim( $default_options['slug_portfolio'] );
			} else {
				$slug = _x( 'portfolio', 'URL slug', 'ishyoboy_assets'); // "URL slug" is necessary for WPML to be able to translate the slug
			}

		} else {

			// WPML not Active or viewing default language
			if ( isset( $ishfreelotheme_options['slug_portfolio'] ) && '' != $ishfreelotheme_options['slug_portfolio'] ){
				$slug = trim( $ishfreelotheme_options['slug_portfolio'] );
			} else {
				$slug = _x( 'portfolio', 'URL slug', 'ishyoboy_assets'); // "URL slug" is necessary for WPML to be able to translate the slug
			}

		}

		$post_type_args = array(
			'labels'                => $labels,
			'singular_label'        => esc_html__( 'Portfolio' , 'ishyoboy_assets' ),
			'public'                => true,
			'publicly_queryable'    => true,
			'exclude_from_search'   => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'query_var'             => true,
			'capability_type'       => 'post',
			'has_archive'           => false,
			'hierarchical'          => false,
			'rewrite'               => array(
				'slug'              => $slug,
				'with_front'        => true,
				'feed'              => true,
				'pages'             => false
			),
			'supports'              => $supports,
			'menu_position'         => null,
			'menu_icon'             => null, //get_template_directory_uri() . '/inc/slider/images/icon.png',
			'taxonomies'            => $taxonomies
		);

		register_post_type( 'portfolio-post', $post_type_args );

	}
}


/*******************************************************************************************************************
 * Set Portfolio post type's messages
 */
if ( ! function_exists( 'ishfreelotheme_portfolio_messages') ){
	function ishfreelotheme_portfolio_messages($messages)
	{
		global $post, $post_ID;

		$messages['portfolio-post'] =
			array(
				0 => '',
				1 => sprintf(('Portfolio Updated. <a href="%s">View portfolio</a>'), esc_url(get_permalink($post_ID))),
				2 => esc_html__('Custom Field Updated.', 'ishyoboy_assets'),
				3 => esc_html__('Custom Field Deleted.', 'ishyoboy_assets'),
				4 => esc_html__('Portfolio Updated.', 'ishyoboy_assets'),
				5 => isset($_GET['revision']) ? sprintf( esc_html__('Portfolio Restored To Revision From %s', 'ishyoboy_assets'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
				6 => sprintf(__('Portfolio Published. <a href="%s">View Portfolio</a>', 'ishyoboy_assets'), esc_url(get_permalink($post_ID))),
				7 => esc_html__('Portfolio Saved.', 'ishyoboy_assets'),
				8 => sprintf(__('Portfolio Submitted. <a target="_blank" href="%s">Preview Portfolio</a>', 'ishyoboy_assets'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
				9 => sprintf(__('Portfolio Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>', 'ishyoboy_assets'), date_i18n( __( 'M j, Y @ G:i', 'ishyoboy_assets' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
				10 => sprintf(__('Portfolio Draft Updated. <a target="_blank" href="%s">Preview Portfolio</a>', 'ishyoboy_assets'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
			);
		return $messages;
	}
}
add_filter( 'post_updated_messages', 'ishfreelotheme_portfolio_messages' );


/*******************************************************************************************************************
 * Create Category for Portfolio post type
 */
if ( ! function_exists( 'ishfreelotheme_portfolio_category') ){
	function ishfreelotheme_portfolio_category()
	{

		$labels = array(
			'name'                          => esc_html__( 'Portfolio Categories', 'ishyoboy_assets' ),
			'singular_name'                 => esc_html__( 'Portfolio Category', 'ishyoboy_assets' ),
			'search_items'                  => esc_html__( 'Search Portfolio Categories', 'ishyoboy_assets' ),
			'popular_items'                 => esc_html__( 'Popular Portfolio Categories', 'ishyoboy_assets' ),
			'all_items'                     => esc_html__( 'All Portfolio Categories', 'ishyoboy_assets' ),
			'parent_item'                   => esc_html__( 'Parent Portfolio Category', 'ishyoboy_assets' ),
			'edit_item'                     => esc_html__( 'Edit Portfolio Category', 'ishyoboy_assets' ),
			'update_item'                   => esc_html__( 'Update Portfolio Category', 'ishyoboy_assets' ),
			'add_new_item'                  => esc_html__( 'Add New Portfolio Category', 'ishyoboy_assets' ),
			'new_item_name'                 => esc_html__( 'New Portfolio Category', 'ishyoboy_assets' ),
			'separate_items_with_commas'    => esc_html__( 'Separate Portfolio Categories with commas', 'ishyoboy_assets' ),
			'add_or_remove_items'           => esc_html__( 'Add or remove Portfolio Category', 'ishyoboy_assets' ),
			'choose_from_most_used'         => esc_html__( 'Choose from most used Portfolio Categories', 'ishyoboy_assets' )
		);

		global $ishfreelotheme_options;
		if ( isset( $ishfreelotheme_options['slug_portfolio'] ) && '' != $ishfreelotheme_options['slug_portfolio'] ){
			$slug = trim( $ishfreelotheme_options['slug_portfolio'] ) . '-category';
		} else {
			$slug = _x('portfolio-category', 'URL slug', 'ishyoboy_assets'); // "URL slug" is necessary for WPML to be able to translate the slug
		}

		$args = array(
			'labels'                        => $labels,
			'public'                        => true,
			'hierarchical'                  => true,
			'show_ui'                       => true,
			'show_in_nav_menus'             => true,
			'query_var'                     => true,
			"rewrite"                       => array(
				'slug'          => $slug,
				'hierarchical'  => true
			)
		);

		register_taxonomy( 'portfolio-category', 'portfolio-post', $args );
	}
}

if ( is_admin() ){

	/*******************************************************************************************************************
	 * Backend columns
	 */
	if ( ! function_exists( 'ishfreelotheme_portfolio_edit_columns') ){
		function ishfreelotheme_portfolio_edit_columns( $columns ){

			if ( isset($columns['comments']) ) { unset($columns['comments']); }
			if ( isset($columns['date']) ) { unset($columns['date']); }

			$columns['title'] = esc_html__( 'Title', 'ishyoboy_assets' );
			$columns['category'] = esc_html__( 'Categories', 'ishyoboy_assets' );
			$columns['thumbnail'] = esc_html__( 'Image', 'ishyoboy_assets' );
			$columns['author'] = esc_html__( 'Author', 'ishyoboy_assets' );
			$columns['date'] = esc_html__( 'Date', 'ishyoboy_assets' );

			return $columns;
		}
	}
	add_filter( 'manage_edit-portfolio-post_columns', 'ishfreelotheme_portfolio_edit_columns' );


	if ( ! function_exists( 'ishfreelotheme_portfolio_custom_columns') ){
		function ishfreelotheme_portfolio_custom_columns($column){
			global $post;

			switch ($column)
			{
				case "thumbnail":
					the_post_thumbnail('thumbnail');
					break;
				case "category":
					echo get_the_term_list($post->ID, 'portfolio-category', '', ', ','');
					break;
			}
		}
	}
	add_action( 'manage_portfolio-post_posts_custom_column' , 'ishfreelotheme_portfolio_custom_columns', 10, 2 );

	/**
	 * Add dropdown filter for sliders
	 */

	if ( ! function_exists( 'ishfreelotheme_restrict_portfolio_by_category') ){
		function ishfreelotheme_restrict_portfolio_by_category() {
			global $typenow, $wp_query;

			if ( isset($typenow) && 'portfolio-post' == $typenow ) {

				$taxonomy = 'portfolio-category';

				$term = isset( $wp_query->query[$taxonomy]) ? $wp_query->query[$taxonomy] : '';

				$portfolio_taxonomy = get_taxonomy($taxonomy);
				wp_dropdown_categories(array(
					'show_option_all' =>  esc_html__("Show all", 'ishyoboy_assets') . ' ' . $portfolio_taxonomy->label,
					'taxonomy'        =>  $taxonomy,
					'name'            =>  $taxonomy,
					'orderby'         =>  'name',
					'selected'        =>  $term,
					'hierarchical'    =>  true,
					'depth'           =>  0,
					'show_count'      =>  true, // Show # listings in parens
					'hide_empty'      =>  true, // Don't show businesses w/o listings
				));
			}
		}
	}
	add_action( 'restrict_manage_posts', 'ishfreelotheme_restrict_portfolio_by_category' );

	if ( ! function_exists( 'ishfreelotheme_taxonomy_filter_portfolio_request') ){
		function ishfreelotheme_taxonomy_filter_portfolio_request( $query ) {
			global $pagenow, $typenow;

			if ( isset($pagenow) && 'edit.php' == $pagenow ) {

				$filters = get_object_taxonomies( $typenow );
				if ( isset($filters) && '' != $filters){
					foreach ( $filters as $tax_slug ) {
						$var = &$query->query_vars[$tax_slug];
						if ( isset($var) && '' != $var ) {
							$term = get_term_by( 'id', $var, $tax_slug );
							if ( isset($term) && '' !=  $term ) {
								$var = $term->slug;
							}
						}
					}
				}
			}
		}
	}
	add_filter( 'parse_query', 'ishfreelotheme_taxonomy_filter_portfolio_request' );


	if ( ! function_exists( 'ishfreelotheme_portfolio_post_thumbnails') ){
		function ishfreelotheme_portfolio_post_thumbnails() {

			$supported_types = get_theme_support( 'post-thumbnails' );

			if ( $supported_types === false ) {
				add_theme_support( 'post-thumbnails', array( 'portfolio-post' ) );
			}
			elseif( true === $supported_types){

			}
			elseif( is_array( $supported_types[0] ) ){
				$supported_types[0][] = 'portfolio-post';
				add_theme_support( 'post-thumbnails', $supported_types[0] );
			}

		}
	}


	/**
	 * Change the default setting for comments on Portfolio posts. Make them closed by default.
	 */
	if ( ! function_exists( 'ishfreelotheme_default_content_portfolio' ) ) {
		function ishfreelotheme_default_content_portfolio( $post_content, $post ) {
			if( $post->post_type )
				switch( $post->post_type ) {
					case 'portfolio-post':
						$post->comment_status = 'closed';
						break;
				}
			return $post_content;
		}
	}
	add_filter( 'default_content', 'ishfreelotheme_default_content_portfolio', 10, 2 );

}

/*******************************************************************************************************************
 * Initialize Portfolio post type
 */
add_action( 'init', 'ishfreelotheme_portfolio_post_type' );
add_action( 'init', 'ishfreelotheme_portfolio_category', 0 );
//add_action( 'after_theme_setup', 'ishfreelotheme_portfolio_post_thumbnails' );