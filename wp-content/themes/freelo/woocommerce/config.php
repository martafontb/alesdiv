<?php

global $wp_query;

if ( ishfreelotheme_woocommerce_plugin_active() ) {

	// Sidebar
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

	// Main Content Structure
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	//Products & Tax content wrapper
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

	// Demo Store
	remove_action( 'wp_footer', 'woocommerce_demo_store' );
	add_action( 'wp_footer', 'ishfreelotheme_woocommerce_demo_store' );

	// Breadcrumbs:
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

	remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
	remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

	//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); // remove result count above products
	//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); // remove woocommerce ordering dropdown
	//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating
	//remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); //remove woo pagination


	// Main Content Structure
	add_action( 'woocommerce_before_main_content', 'ishfreelotheme_woo_taglines', 10);
	add_action( 'woocommerce_before_main_content', 'ishfreelotheme_woo_breadcrumbs_bar', 10);
	add_action( 'woocommerce_before_main_content', 'ishfreelotheme_woo_wrapper_start', 10);
	add_action( 'woocommerce_after_main_content', 'ishfreelotheme_woo_wrapper_end', 10);


	// Shop wrapper
	add_action( 'woocommerce_before_shop_loop', 'ishfreelotheme_woo_before_shop_loop', 10);
	add_action( 'woocommerce_after_shop_loop', 'ishfreelotheme_woo_after_shop_loop', 10);

	// Single Product wrapper
	add_action( 'woocommerce_before_single_product', 'ishfreelotheme_woo_before_shop_loop', 10);
	add_action( 'woocommerce_after_single_product', 'ishfreelotheme_woo_after_shop_loop', 10);



	// Templates:
	// no-products-found
	add_action( 'woocommerce_before_template_part', 'ishfreelotheme_woo_before_template_part', 10, 4);
	add_action( 'woocommerce_after_template_part', 'ishfreelotheme_woo_before_template_part', 10, 4);



	//Products content wrapper
	add_action( 'woocommerce_archive_description', 'ishfreelotheme_woo_product_archive_description', 10 );

	// Title removal:
	add_filter( 'woocommerce_show_page_title', 'ishfreelotheme_woo_hide_title' );

	add_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
	add_action( 'woocommerce_before_shop_loop', 'ishfreelotheme_woocommerce_shop_separator', 40 );
	add_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
	add_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

	add_action( 'woocommerce_after_shop_loop', 'ishfreelotheme_woocommerce_pagination_separator', 9 );

	// Generate Dynamic CSS files
	add_filter( 'woocommerce_update_options', 'ishfreelotheme_dynamic_css_woocommerce', 10);
	add_action( 'customize_save_after', 'ishfreelotheme_woocommerce_customize_after_save', 11);

	// Add to cart button
	//add_filter( 'woocommerce_loop_add_to_cart_link', 'ishfreelotheme_woocommerce_loop_add_to_cart_link', 10);

	// Sale ribbon HTML Change
	// add_filter( 'woocommerce_sale_flash', 'ishfreelotheme_woocommerce_sale_flash', 10, 3);

	// Separator before comment form
	add_action( 'comment_form_before', 'ishfreelotheme_comment_form_before', 10 );

	// Separator before related products
	//add_action( 'woocommerce_after_single_product_summary', 'ishfreelotheme_separator_before_related_products', 19 );

	// Single Products navigation and social icons
	add_action( 'woocommerce_after_single_product_summary', 'ishfreelotheme_woocommerce_prev_next_and_socials', 13 );

	// Cart
	add_action( 'woocommerce_before_cart', 'ishfreelotheme_woocommerce_before_cart_title', 10 );
	add_action( 'woocommerce_cart_collaterals', 'ishfreelotheme_woocommerce_checkout_customer_details_separator', 9 );

	// Checkout
	add_action( 'woocommerce_review_order_before_payment', 'ishfreelotheme_woocommerce_checkout_payment_details_separator', 40 );
	add_filter( 'woocommerce_add_success', 'ishfreelotheme_woocommerce_add_message', 10, 1 );
	add_filter( 'woocommerce_add_error', 'ishfreelotheme_woocommerce_add_message', 10, 1 );
	add_filter( 'woocommerce_add_notice', 'ishfreelotheme_woocommerce_add_message', 10, 1 );

	// Order details
	//add_action( 'woocommerce_view_order', 'woocommerce_order_details_table', 10 );
	//add_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
	add_action( 'woocommerce_view_order', 'ishfreelotheme_woocommerce_order_details_separator', 9 );
	add_action( 'woocommerce_thankyou', 'ishfreelotheme_woocommerce_order_details_separator', 9 );
	add_action( 'woocommerce_before_my_account', 'ishfreelotheme_woocommerce_account_orders_exist', 40 );
	add_action( 'woocommerce_after_available_downloads', 'ishfreelotheme_woocommerce_order_details_separator', 40 );
	add_action( 'woocommerce_order_details_after_order_table', 'ishfreelotheme_woocommerce_order_details_separator', 40 );
	add_action( 'woocommerce_thankyou_bacs', 'ishfreelotheme_woocommerce_order_details_separator', 10 );

	// My Account
	add_filter( 'woocommerce_my_account_my_address_title', 'ishfreelotheme_woocommerce_my_account_my_address_title', 40, 1 );

	// Shortcode Add To Cart
	add_action( 'init', 'ishfreelotheme_remove_shortcode_addtocart', 20);
	add_action( 'init', 'ishfreelotheme_add_shortcode_addtocart', 30);

	// Widget Search
	add_filter( 'get_product_search_form', 'ishfreelotheme_get_product_search_form', 10, 1 );

	// Change number or products per row - as set in Theme Options
	add_filter( 'loop_shop_columns', 'ishfreelotheme_loop_shop_columns');

	// Loop products
	add_action( 'woocommerce_before_shop_loop', 'ishfreelotheme_woocommerce_before_shop_loop', 40 );
	add_action( 'woocommerce_after_shop_loop', 'ishfreelotheme_woocommerce_after_shop_loop', 40 );

	// Loop related products
	add_action( 'woocommerce_after_single_product_summary', 'ishfreelotheme_woocommerce_before_shop_loop', 19 );
	add_action( 'woocommerce_after_single_product_summary', 'ishfreelotheme_woocommerce_after_shop_loop', 21 );
	add_filter( 'woocommerce_output_related_products_args', 'ishfreelotheme_woocommerce_output_related_products_args', 10, 1 );

	// WooCommerce 3.0 - Single Product Gallery Thumbnail override
	add_action( 'woocommerce_product_thumbnails', 'ishfreelotheme_register_thumbnails_filter', 5 );
	add_filter( 'woocommerce_product_thumbnails_columns', 'ishfreelotheme_woocommerce_product_thumbnails_columns' );




// =======================================================================================================================================================================================

    if ( ! function_exists( 'ishfreelotheme_register_thumbnails_filter' ) ) {
	    function ishfreelotheme_register_thumbnails_filter() {
		    add_filter( 'woocommerce_single_product_image_thumbnail_html', 'ishfreelotheme_woocommerce_single_product_image_thumbnail_html', 10, 2 );
	    }
    }

    if ( ! function_exists( 'ishfreelotheme_woocommerce_product_thumbnails_columns' ) ) {
	    function ishfreelotheme_woocommerce_product_thumbnails_columns( $columns_count ) {
	        return 3;
	    }
    }

    if ( ! function_exists( 'ishfreelotheme_woocommerce_single_product_image_thumbnail_html' ) ) {
	    function ishfreelotheme_woocommerce_single_product_image_thumbnail_html( $html_old, $attachment_id ) {

	        // The following code overrides the template in "woocommerce/templates/single-product/product-thumbnails.php"
            $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
            $thumbnail       = wp_get_attachment_image_src( $attachment_id, 'woocommerce_thumbnail' );
            $image_title     = get_post_field( 'post_excerpt', $attachment_id );

            $attributes = array(
                'title'                   => $image_title,
                'data-src'                => $full_size_image[0],
                'data-large_image'        => $full_size_image[0],
                'data-large_image_width'  => $full_size_image[1],
                'data-large_image_height' => $full_size_image[2],
            );

		    $html_new = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
		    $html_new .= wp_get_attachment_image( $attachment_id, 'woocommerce_thumbnail', false, $attributes );
		    $html_new .= '</a></div>';

            return apply_filters( 'ishfreelotheme_woocommerce_single_product_image_thumbnail_html', $html_new, $html_old, $attachment_id );
	    }
    }


    if ( ! function_exists( 'ishfreelotheme_woocommerce_prev_next_and_socials' ) ) {
		function ishfreelotheme_woocommerce_prev_next_and_socials() {

			global $ishfreelotheme_options;

			if ( isset( $ishfreelotheme_options['woocommerce_single_product_details'] ) && '' != $ishfreelotheme_options['woocommerce_single_product_details'] ) {

				$class = ' ish-display-' . $ishfreelotheme_options['woocommerce_single_product_details'];

				echo '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-product-prevnext-container' . $class  .'"><div class="ish-vc_row_inner">';

				echo '<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div>';
				echo '<div class="ish-display-table">';
				ishfreelotheme_woocommerce_post_prev_next();
				ishfreelotheme_woocommerce_show_addthis();

				echo '</div></div></div>';
			}
		}
	}

	if ( ! function_exists( 'ishfreelotheme_loop_shop_columns') ) {
		function ishfreelotheme_loop_shop_columns( $count ) {

			global $ishfreelotheme_options;

			if ( isset($ishfreelotheme_options['woocommerce_posts_per_row']) && is_numeric($ishfreelotheme_options['woocommerce_posts_per_row']) ){
				$count = (int)$ishfreelotheme_options['woocommerce_posts_per_row'];
			}

			return $count;
		}
	}

	if ( ! function_exists( 'ishfreelotheme_woocommerce_shop_separator' ) ) {
		function ishfreelotheme_woocommerce_shop_separator() {
			echo '<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double ish-woocommerce-shop-separator"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div>';

		}
	}

	if ( ! function_exists( 'ishfreelotheme_woocommerce_pagination_separator' ) ) {
		function ishfreelotheme_woocommerce_pagination_separator() {
			global $wp_query;
			if ( $wp_query->max_num_pages <= 1 ) {
				return;
			}
			echo '<div class="ish-sc_separator ish-separator-text ish-separator-double ish-woocommerce-shop-separator"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div>';

		}
	}

	if ( ! function_exists( 'ishfreelotheme_woo_add_to_cart' ) ) {
		function ishfreelotheme_woo_add_to_cart( $message) {
			return '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection"><div class="ish-vc_row_inner">' . $message . '</div></div>';

		}
	}

	if ( ! function_exists( 'ishfreelotheme_woo_before_template_part' ) ) {
		function ishfreelotheme_woo_before_template_part( $template_name, $template_path, $located, $args) {

			if ( 'loop/no-products-found.php' == $template_name ){
				echo '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection"><div class="ish-vc_row_inner">';
			}

		}
	}

	if ( ! function_exists( 'woocommerce_after_template_part' ) ) {
		function woocommerce_after_template_part( $template_name, $template_path, $located, $args) {

			if ( 'loop/no-products-found.php' == $template_name ){
				echo '</div></div>';
			}

		}
	}

	if ( ! function_exists( 'ishfreelotheme_woo_before_shop_loop' ) ) {
		function ishfreelotheme_woo_before_shop_loop() {

			global $ishfreelotheme_options;

			$ish_columns_count = ( ! isset($ishfreelotheme_options) && is_numeric($ishfreelotheme_options['woocommerce_posts_per_row']) ) ? $ishfreelotheme_options['woocommerce_posts_per_row'] : 4;
			$center_content = ( ! isset($ishfreelotheme_options) || 1 == $ishfreelotheme_options['responsive_content_centering'] ) ? ' ish-resp-centered' : '';

			$column_count = apply_filters( 'loop_shop_columns', $ish_columns_count );
			$shop_row_classes = '';
			$shop_row_classes .= is_numeric($column_count) ? ' ish-shop-cols-' . $column_count : '';

			echo '<div id="ish-woocommerce-shop" class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection' . $shop_row_classes . $center_content . '"><div class="ish-vc_row_inner">';

		}
	}

	if ( ! function_exists( 'ishfreelotheme_woo_after_shop_loop' ) ) {
		function ishfreelotheme_woo_after_shop_loop() {

			echo '</div></div>';

		}
	}

	function ishfreelotheme_woo_product_archive_description() {
		global $ishfreelotheme_woo_id;
		if ( is_post_type_archive( 'product' ) && get_query_var( 'paged' ) == 0 ) {
			if ( null == $ishfreelotheme_woo_id ) {
				$ishfreelotheme_woo_id = wc_get_page_id( 'shop' );
			}
			$shop_page = get_post( $ishfreelotheme_woo_id );
			if ( $shop_page ) {
				$description = apply_filters( 'the_content', $shop_page->post_content );
				if ( $description ) {
					echo apply_filters( 'ishfreelotheme_woo_product_archive_description_output', $description);
				}
			}
		}
	}

	if ( ! function_exists( 'ishfreelotheme_woo_taglines' ) ) {
		function ishfreelotheme_woo_taglines() {
			global $ishfreelotheme_woo_id;

			if ( is_shop() ){
				if ( null == $ishfreelotheme_woo_id ) {
					$ishfreelotheme_woo_id = wc_get_page_id( 'shop' );
				}
			}
			else{
				$ishfreelotheme_woo_id = null;
			}

			ishfreelotheme_get_part_tagline( $ishfreelotheme_woo_id );
		}
	}


	if ( ! function_exists( 'ishfreelotheme_woo_breadcrumbs_bar' ) ) {
		function ishfreelotheme_woo_breadcrumbs_bar() {
			ishfreelotheme_show_breadcrumbs();
		}
	}

	if ( ! function_exists( 'ishfreelotheme_woo_hide_title' ) ) {
		function ishfreelotheme_woo_hide_title( $show ) {
			return false;
		}
	}

	if ( ! function_exists( 'ishfreelotheme_woocommerce_demo_store' ) ) {
		function ishfreelotheme_woocommerce_demo_store() {
			if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_woocommerce_page() ) ){
				woocommerce_demo_store();
			}
		}
	}

	if ( ! function_exists( 'ishfreelotheme_woo_wrapper_start' ) ) {
		function ishfreelotheme_woo_wrapper_start() {
			global $ishfreelotheme_woo_id;

			if ( is_shop() ){
				if ( null == $ishfreelotheme_woo_id ) {
					$ishfreelotheme_woo_id = wc_get_page_id( 'shop' );
				}
				$page_title   = get_the_title( $ishfreelotheme_woo_id );
			}
			else{
				$ishfreelotheme_woo_id = get_the_ID();
			}

			echo '<section class="' . apply_filters( 'ishfreelotheme_part_content_classes', 'ish-part_content', $ishfreelotheme_woo_id ) . '">';

			// Necessary for displaying the taglines separator
			echo apply_filters( 'ishfreelotheme_the_taglines_separator', '' );

			if ( ishfreelotheme_has_sidebar( $ishfreelotheme_woo_id ) ){
				// Content with sidebar
				echo '<div class="ish-row ish-row-notfull ish-with-sidebar"><div class="ish-row_inner"><div class="' . ishfreelotheme_get_content_class( $ishfreelotheme_woo_id ) . '">';
			}else{
				// No Sidebar
			}

		}
	}

	if ( ! function_exists( 'ishfreelotheme_woo_wrapper_end' ) ) {
		function ishfreelotheme_woo_wrapper_end() {
			global $ishfreelotheme_woo_id;

			if ( is_shop() ){
				if ( null == $ishfreelotheme_woo_id ) {
					$ishfreelotheme_woo_id = wc_get_page_id( 'shop' );
				}
			}
			else{
				$ishfreelotheme_woo_id = get_the_ID();
			}

			if ( ishfreelotheme_has_sidebar( $ishfreelotheme_woo_id ) ){
				// Content with sidebar
				echo '</div>';
				// SIDEBAR
				get_sidebar('woocommerce');
				echo '</div></div>';
			}else{
				// No Sidebar
			}

			echo '</section>';

		}
	}
	/**
	 * is_woocommerce - Returns true if on a page which uses WooCommerce templates (cart and checkout are standard pages with shortcodes and thus are not included)
	 *
	 * @access public
	 * @return bool
	 */
	if ( ! function_exists( 'is_woocommerce_page' ) ) {
		function is_woocommerce_page() {

			if ( ! function_exists( 'is_woocommerce' ) ) {
				return false;
			}

			return ( is_cart() || is_checkout() || is_account_page() || is_order_received_page() || is_product_category() || is_product_tag() || is_product() ) ? true : false;
		}
	}

	// Separator before comment form
	if ( ! function_exists( 'ishfreelotheme_comment_form_before' ) ) {

		function ishfreelotheme_comment_form_before() {
			if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_woocommerce_page() ) ){
				echo '<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double ish-woocommerce-comment-separator"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div>';
			}
		}
	};

	// Change message HTML structure
	if ( ! function_exists( 'ishfreelotheme_woocommerce_add_message' ) ) {
		function ishfreelotheme_woocommerce_add_message( $message ) {

			$message = '<div class="woocommerce_message_text">' . $message;
			$message = $message . '</div>';

			return $message;

		}
	}

	// Checkout
	if ( ! function_exists( 'ishfreelotheme_woocommerce_checkout_customer_details_separator' ) ) {
		function ishfreelotheme_woocommerce_checkout_customer_details_separator() {
			echo '<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div>';
		}
	}

	if ( ! function_exists( 'ishfreelotheme_woocommerce_checkout_payment_details_separator' ) ) {
		function ishfreelotheme_woocommerce_checkout_payment_details_separator() {
			echo '<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div>';
			echo '<h3 id="payment_heading">' . esc_html__( 'Payment Details', 'woocommerce' ) . '</h3>';
		}
	}

	// Cart
	if ( ! function_exists( 'ishfreelotheme_woocommerce_before_cart_title' ) ) {
		function ishfreelotheme_woocommerce_before_cart_title() {
			echo '<h2 id="cart_heading">' . esc_html__( 'Cart', 'woocommerce' ) . '</h2>';
		}
	}

	// Order details
	if ( ! function_exists( 'ishfreelotheme_woocommerce_account_orders_exist' ) ) {
		function ishfreelotheme_woocommerce_account_orders_exist() {

			$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
				'numberposts' => 1,
				'meta_key'    => '_customer_user',
				'meta_value'  => get_current_user_id(),
				'post_type'   => wc_get_order_types( 'view-orders' ),
				'post_status' => array_keys( wc_get_order_statuses() )
			) ) );

			if ( $customer_orders ) {
				ishfreelotheme_woocommerce_order_details_separator();
			};
		}
	}

	if ( ! function_exists( 'ishfreelotheme_woocommerce_order_details_separator' ) ) {
		function ishfreelotheme_woocommerce_order_details_separator() {
			echo '<div class="ish-sc-element ish-sc_separator ish-separator-text ish-separator-double ish-woocommerce-order-details-separator"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div>';

		}
	}

	// My Account
	// Add span for adding separator into address title
	if ( ! function_exists( 'ishfreelotheme_woocommerce_my_account_my_address_title' ) ) {
		function ishfreelotheme_woocommerce_my_account_my_address_title( $page_title ) {

			$page_title = '<span class="addresses-title-separator">' . $page_title;
			$page_title = $page_title . '</span>';

			return $page_title;

		}
	}

	// Shortcode Add To Cart
	if ( ! function_exists( 'ishfreelotheme_remove_shortcode_addtocart' ) ) {
		function ishfreelotheme_remove_shortcode_addtocart() {
			remove_shortcode( 'add_to_cart' );
		}
	}

	if ( ! function_exists( 'ishfreelotheme_add_shortcode_addtocart' ) ) {
		function ishfreelotheme_add_shortcode_addtocart() {
			add_shortcode( 'add_to_cart', 'ishfreelotheme_product_add_to_cart' );
		}
	}

	if ( ! function_exists( 'ishfreelotheme_product_add_to_cart' ) ) {
		function ishfreelotheme_product_add_to_cart( $atts ) {
			global $wpdb, $post;
			//global $product;

			if ( empty( $atts ) ) {
				return '';
			}

			$atts = shortcode_atts( array(
				'id'         => '',
				'class'      => '',
				'quantity'   => '1',
				'sku'        => '',
				'style'      => 'border:4px solid #ccc; padding: 12px;',
				'show_price' => 'true'
			), $atts );

			if ( ! empty( $atts['id'] ) ) {
				$product_data = get_post( $atts['id'] );
			} elseif ( ! empty( $atts['sku'] ) ) {
				$product_id   = wc_get_product_id_by_sku( $atts['sku'] );
				$product_data = get_post( $product_id );
			} else {
				return '';
			}

			$product = wc_setup_product_data( $product_data );

			if ( ! $product ) {
				return '';
			}

			ob_start();
			?>
		<p class="ish-sc-element product woocommerce add_to_cart_inline <?php echo esc_attr( $atts['class'] ); ?>"
		   style="<?php echo esc_attr( $atts['style'] ); ?>">

			<?php if ( 'true' == $atts['show_price'] ) :
				echo '<span class="product-price">' . $product->get_price_html() . '</span>';
			endif; ?>

			<?php
			$link = $product->get_permalink();
			echo do_shortcode( '<a href="' . esc_url( $link ) . '" class="button view-product">' . esc_html__( 'View Product', 'woocommerce' ) . '</a>' );
			?>

			<?php woocommerce_template_loop_add_to_cart( array( 'quantity' => $atts['quantity'] ) ); ?>

			</p><?php

			// Restore Product global in case this is shown inside a product post
			wc_setup_product_data( $post );

			return ob_get_clean();
		}
	}

	// Widget Search
	if ( ! function_exists( 'ishfreelotheme_get_product_search_form' ) ) {
		function ishfreelotheme_get_product_search_form( $search_form ) {

			$search_form = str_replace('value="Search"', 'value="9"', $search_form);
			return $search_form;

		}
	}

	// Loop products
	if ( ! function_exists( 'ishfreelotheme_woocommerce_before_shop_loop' ) ) {
		function ishfreelotheme_woocommerce_before_shop_loop() {
			global $ishfreelotheme_options;

			if ( isset($ishfreelotheme_options['woocommerce_posts_per_row']) && is_numeric($ishfreelotheme_options['woocommerce_posts_per_row']) ){
				echo '<div class="ish-product-columns-' . $ishfreelotheme_options['woocommerce_posts_per_row'] . '">';
			} else {
				echo '<div>';
			}
		}
	};

	if ( ! function_exists( 'ishfreelotheme_woocommerce_after_shop_loop' ) ) {
		function ishfreelotheme_woocommerce_after_shop_loop() {
			echo '</div>';
		}
	};

	// Loop related products
	if ( ! function_exists( 'ishfreelotheme_woocommerce_output_related_products_args') ) {
		function ishfreelotheme_woocommerce_output_related_products_args( $args ) {

			global $ishfreelotheme_options;

			$args['posts_per_page'] = $ishfreelotheme_options['woocommerce_posts_per_row'];
			$args['columns'] = $ishfreelotheme_options['woocommerce_posts_per_row'];

			return $args;
		}
	}


}


/* *********************************************************************************************************************
 * Woocommerce support
 */
if ( ! function_exists( 'woocommerce_support' ) ) {
	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
	}
}
add_action( 'after_setup_theme', 'woocommerce_support' );