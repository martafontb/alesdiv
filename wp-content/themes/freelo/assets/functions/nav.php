<?php

/* *********************************************************************************************************************
 * Dynamic menu support
 */
add_theme_support( 'nav-menus' );
add_action( 'init', 'ishfreelotheme_register_menus' );

if ( ! function_exists( 'ishfreelotheme_register_menus' ) ) {
	function ishfreelotheme_register_menus() {
		register_nav_menus(
			array(
				'header-menu' => esc_html__( 'Main menu', 'freelo' )
			)
		);
	}
}

/* *********************************************************************************************************************
 * Add Shopping Cart to header bar
 */
if ( ! function_exists( 'ishfreelotheme_add_header_bar_shopping_cart' ) ) {
	function ishfreelotheme_add_header_bar_shopping_cart($items = null, $args = null){
		global $ishfreelotheme_options, $woocommerce;

		if ( isset( $items ) && isset( $args ) ){
			// Running as a filter
			if ( $woocommerce && isset($args->theme_location) && ('header-bar-menu' == $args->theme_location ) && isset($ishfreelotheme_options['use_header_bar_cart']) && ('1' == $ishfreelotheme_options['use_header_bar_cart']) ){

				$searchboxItem = '';
				$searchboxItem .= '<li class="ish-phb-shopping-cart ish-shopping-cart"><a href="#" class="ish-cart-item ish-icon-basket-2"><span>' . esc_html__( 'Cart', 'freelo' ) . '</span> <span class="ish-count">(' . count($woocommerce->cart->cart_contents) . ')</span></a><ul class="sub-menu ish-cart-content">';

				if (  is_array( $woocommerce->cart->cart_contents ) ){

					foreach ( $woocommerce->cart->cart_contents as $product ){
						$product_obj = new WC_Product( $product['product_id'] );
						$searchboxItem .= '<li><a class="ish-cart-product" href="' . apply_filters( 'ishfreelotheme_nav_item_url', $product_obj->get_permalink() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
						$searchboxItem .= $product_obj->get_image( 'thumbnail' );
						$searchboxItem .= '<span class="ish-cart-product-title">' . $product_obj->get_title() . '</span>';
						$searchboxItem .= $product['quantity'] . ' x ' . wc_price( $product_obj->get_price() ) . $product_obj->get_price_suffix();
						$searchboxItem .= '</a></li>';
					}

				}

				$searchboxItem .= '<li class="ish-cart-subtotal-li">';
				$searchboxItem .= esc_html__( 'Subtotal:', 'freelo' );
				$searchboxItem .= ' ';
				$searchboxItem .= '<span class="ish-cart-subtotal">' . $woocommerce->cart->get_cart_total() . '</span>';
				$searchboxItem .= '</li>';

				$searchboxItem .= '<li class="ish-cart-links">';
				$searchboxItem .= '<a class="ish-icon-basket-2" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_cart_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
				$searchboxItem .= '<span>' . esc_html__( 'View Cart', 'freelo' ) . '</span>';
				$searchboxItem .= '</a>';
				$searchboxItem .= '<a class="ish-icon-credit-card" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_checkout_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
				$searchboxItem .= '<span>' . esc_html__( 'Checkout', 'freelo' ) . '</span>';
				$searchboxItem .= '</a>';
				$searchboxItem .= '</li>';


				$searchboxItem .= '</ul></li>';

				$items = $items . $searchboxItem;

			}

		} else {
			// Running as stand-alone function

			$items = '';

			if ( $woocommerce && isset($ishfreelotheme_options['use_header_bar_cart']) && ('1' == $ishfreelotheme_options['use_header_bar_cart']) ){

				$searchboxItem = '';
				$searchboxItem .= '<li class="ish-shopping-cart"><a href="#" class="ish-cart-item ish-icon-basket-2"><span>' . esc_html__( 'Cart', 'freelo' ) . '</span> <span class="ish-count">(' . count($woocommerce->cart->cart_contents) . ')</span></a><ul class="sub-menu ish-cart-content">';

				if (  is_array( $woocommerce->cart->cart_contents ) ){

					foreach ( $woocommerce->cart->cart_contents as $product ){
						$product_obj = new WC_Product( $product['product_id'] );
						$searchboxItem .= '<li><a class="ish-cart-product" href="' . apply_filters( 'ishfreelotheme_nav_item_url', $product_obj->get_permalink() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
						$searchboxItem .= $product_obj->get_image( 'thumbnail' );
						$searchboxItem .= '<span class="ish-cart-product-title">' . $product_obj->get_title() . '</span>';
						$searchboxItem .= $product['quantity'] . ' x ' . wc_price( $product_obj->get_price() ) . $product_obj->get_price_suffix();
						$searchboxItem .= '</a></li>';
					}

				}

				$searchboxItem .= '<li class="ish-cart-subtotal-li">';
				$searchboxItem .= esc_html__( 'Subtotal:', 'freelo' );
				$searchboxItem .= ' ';
				$searchboxItem .= '<span class="ish-cart-subtotal">' . $woocommerce->cart->get_cart_total() . '</span>';
				$searchboxItem .= '</li>';

				$searchboxItem .= '<li class="ish-cart-links">';
				$searchboxItem .= '<a class="ish-icon-basket-2" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_cart_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
				$searchboxItem .= '<span>' . esc_html__( 'View Cart', 'freelo' ) . '</span>';
				$searchboxItem .= '</a>';
				$searchboxItem .= '<a class="ish-icon-credit-card" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_checkout_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
				$searchboxItem .= '<span>' . esc_html__( 'Checkout', 'freelo' ) . '</span>';
				$searchboxItem .= '</a>';
				$searchboxItem .= '</li>';


				$searchboxItem .= '</ul></li>';

				$items = $items . $searchboxItem;

			}
		}

		return $items;
	}
}

if ( ! function_exists( 'ishfreelotheme_shopping_cart_update' ) ) {
	function ishfreelotheme_shopping_cart_update( $fragments ) {
		global $woocommerce;

		$searchboxItem = '';
		$searchboxItem .= '<ul class="sub-menu ish-cart-content">';

		if (  is_array( $woocommerce->cart->cart_contents ) ){

			foreach ( $woocommerce->cart->cart_contents as $product ){
				$product_obj = new WC_Product( $product['product_id'] );
				$searchboxItem .= '<li><a class="ish-cart-product" href="' . apply_filters( 'ishfreelotheme_nav_item_url', $product_obj->get_permalink() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
				$searchboxItem .= $product_obj->get_image( 'thumbnail' );
				$searchboxItem .= '<span class="ish-cart-product-title">' . $product_obj->get_title() . '</span>';
				$searchboxItem .= $product['quantity'] . ' x ' . wc_price( $product_obj->get_price() ) . $product_obj->get_price_suffix();
				$searchboxItem .= '</a></li>';
			}

		}

		$searchboxItem .= '<li class="ish-cart-subtotal-li">';
		$searchboxItem .= esc_html__( 'Subtotal:', 'freelo' );
		$searchboxItem .= ' ';
		$searchboxItem .= '<span class="ish-cart-subtotal">' . $woocommerce->cart->get_cart_total() . '</span>';
		$searchboxItem .= '</li>';

		$searchboxItem .= '<li class="ish-cart-links">';
		$searchboxItem .= '<a class="ish-icon-basket-2" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_cart_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
		$searchboxItem .= '<span>' . esc_html__( 'View Cart', 'freelo' ) . '</span>';
		$searchboxItem .= '</a>';
		$searchboxItem .= '<a class="ish-icon-credit-card" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_checkout_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
		$searchboxItem .= '<span>' . esc_html__( 'Checkout', 'freelo' ) . '</span>';
		$searchboxItem .= '</a>';
		$searchboxItem .= '</li>';


		$searchboxItem .= '</ul>';

		$fragments['.ish-shopping-cart .ish-cart-content'] = $searchboxItem;

		$searchboxItem = '';
		$searchboxItem .= '<span class="ish-count">(' . count($woocommerce->cart->cart_contents) . ')</span>';
		$fragments['.ish-shopping-cart .ish-cart-item .ish-count'] = $searchboxItem;

		return $fragments;

	}
}

/* *********************************************************************************************************************
 * Add Shopping Cart to main menu
 */
if ( ! function_exists( 'ishfreelotheme_add_main_menu_shopping_cart' ) ) {
	function ishfreelotheme_add_main_menu_shopping_cart($items = null, $args = null){
		global $ishfreelotheme_options, $woocommerce;

		if ( !(isset($args->menu_class) && (false !== strpos( $args->menu_class, 'ish-widget-main_nav' ) ) && isset($args->theme_location) && ('header-menu' == $args->theme_location ) ) ) {
			if ( isset( $items ) && isset( $args ) ) {
				// Running as a filter
				if ( $woocommerce && isset( $args->theme_location ) && ( 'header-menu' == $args->theme_location ) && isset( $ishfreelotheme_options['use_main_nav_cart'] ) && ( '1' == $ishfreelotheme_options['use_main_nav_cart'] ) ) {

					$searchboxItem = '';
					$searchboxItem .= '<li class="ish-ph-mn-shopping-cart ish-shopping-cart"><a href="#" class="ish-cart-item ish-icon-basket-2"><span>' . esc_html__( 'Cart', 'freelo' ) . '</span> <span class="ish-count">(' . count( $woocommerce->cart->cart_contents ) . ')</span></a><ul class="sub-menu ish-cart-content">';

					if ( is_array( $woocommerce->cart->cart_contents ) ) {

						foreach ( $woocommerce->cart->cart_contents as $product ) {
							$product_obj = new WC_Product( $product['product_id'] );
							$searchboxItem .= '<li><a class="ish-cart-product" href="' . apply_filters( 'ishfreelotheme_nav_item_url', $product_obj->get_permalink() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
							$searchboxItem .= $product_obj->get_image( 'thumbnail' );
							$searchboxItem .= '<span class="ish-cart-product-title">' . $product_obj->get_title() . '</span>';
							$searchboxItem .= $product['quantity'] . ' x ' . wc_price( $product_obj->get_price() ) . $product_obj->get_price_suffix();
							$searchboxItem .= '</a></li>';
						}

					}

					$searchboxItem .= '<li class="ish-cart-subtotal-li">';
					$searchboxItem .= esc_html__( 'Subtotal:', 'freelo' );
					$searchboxItem .= ' ';
					$searchboxItem .= '<span class="ish-cart-subtotal">' . $woocommerce->cart->get_cart_total() . '</span>';
					$searchboxItem .= '</li>';

					$searchboxItem .= '<li class="ish-cart-links">';
					$searchboxItem .= '<a class="ish-icon-basket-2" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_cart_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
					$searchboxItem .= '<span>' . esc_html__( 'View Cart', 'freelo' ) . '</span>';
					$searchboxItem .= '</a>';
					$searchboxItem .= '<a class="ish-icon-credit-card" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_checkout_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
					$searchboxItem .= '<span>' . esc_html__( 'Checkout', 'freelo' ) . '</span>';
					$searchboxItem .= '</a>';
					$searchboxItem .= '</li>';


					$searchboxItem .= '</ul></li>';

					$items = $items . $searchboxItem;

				}

			} else {
				// Running as stand-alone function

				$items = '';

				if ( $woocommerce && isset( $ishfreelotheme_options['use_main_nav_cart'] ) && ( '1' == $ishfreelotheme_options['use_main_nav_cart'] ) ) {

					$searchboxItem = '';
					$searchboxItem .= '<li class="ish-ph-mn-shopping-cart ish-shopping-cart"><a href="#" class="ish-cart-item ish-icon-basket-2"><span>' . esc_html__( 'Cart', 'freelo' ) . '</span> <span class="ish-count">(' . count( $woocommerce->cart->cart_contents ) . ')</span></a><ul class="sub-menu ish-cart-content">';

					if ( is_array( $woocommerce->cart->cart_contents ) ) {

						foreach ( $woocommerce->cart->cart_contents as $product ) {
							$product_obj = new WC_Product( $product['product_id'] );
							$searchboxItem .= '<li><a class="ish-cart-product" href="' . apply_filters( 'ishfreelotheme_nav_item_url', $product_obj->get_permalink() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
							$searchboxItem .= $product_obj->get_image( 'thumbnail' );
							$searchboxItem .= '<span class="ish-cart-product-title">' . $product_obj->get_title() . '</span>';
							$searchboxItem .= $product['quantity'] . ' x ' . wc_price( $product_obj->get_price() ) . $product_obj->get_price_suffix();
							$searchboxItem .= '</a></li>';
						}

					}

					$searchboxItem .= '<li class="ish-cart-subtotal-li">';
					$searchboxItem .= esc_html__( 'Subtotal:', 'freelo' );
					$searchboxItem .= ' ';
					$searchboxItem .= '<span class="ish-cart-subtotal">' . $woocommerce->cart->get_cart_total() . '</span>';
					$searchboxItem .= '</li>';

					$searchboxItem .= '<li class="ish-cart-links">';
					$searchboxItem .= '<a class="ish-icon-basket-2" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_cart_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
					$searchboxItem .= '<span>' . esc_html__( 'View Cart', 'freelo' ) . '</span>';
					$searchboxItem .= '</a>';
					$searchboxItem .= '<a class="ish-icon-credit-card" href="' . apply_filters( 'ishfreelotheme_nav_item_url', wc_get_checkout_url() ) . '" title="' . esc_html__( 'View your shopping cart', 'freelo' ) . '">';
					$searchboxItem .= '<span>' . esc_html__( 'Checkout', 'freelo' ) . '</span>';
					$searchboxItem .= '</a>';
					$searchboxItem .= '</li>';


					$searchboxItem .= '</ul></li>';

					$items = $items . $searchboxItem;

				}
			}
		}

		return $items;
	}
}

/* *********************************************************************************************************************
 * Add search form to main menu
 */
if ( ! function_exists( 'ishfreelotheme_add_search_form' ) ) {
	function ishfreelotheme_add_search_form($items, $args) {

		global $ishfreelotheme_options;

		if ( isset($args->menu_class) && (false === strpos( $args->menu_class, 'ish-widget-main_nav' ) ) && isset($args->theme_location) && ('header-menu' == $args->theme_location ) ) {

			if ( isset($args->theme_location) && ('header-menu' == $args->theme_location ) && isset($ishfreelotheme_options['use_navigation_search']) && ('1' == $ishfreelotheme_options['use_navigation_search']) ){
				$searchboxItem =
					'<li class="ish-ph-mn-search">' .
					$args->before .
					'<a href="#search" class="ish-icon-search-outline"><span>' . esc_html__( 'Search', 'freelo' ) . '</span></a>' . $args->after . '</li>';
				$items = $items . $searchboxItem;
			}

			if ( isset($args->theme_location) && ('header-menu' == $args->theme_location ) && ishfreelotheme_use_expandable_header() ){
				$expandableItem =
					'<li class="ish-ph-expandable_btn">' .
					$args->before .
					'<a href="#expandable" class="ish-icon-plus-outline"><span>' . esc_html__( 'Expandable', 'freelo' ) . '</span></a>' . $args->after . '</li>';
				$items = $items . $expandableItem;
			}

		}

		return $items;
	}
}


/* *********************************************************************************************************************
 * Add search form to Header Bar
 */
if ( ! function_exists( 'ishfreelotheme_add_header_bar_search_form' ) ) {
	function ishfreelotheme_add_header_bar_search_form($items, $args) {
		?>
		<?php
		global $ishfreelotheme_options;

		if ( isset($args->theme_location) && ('header-bar-menu' == $args->theme_location ) && isset($ishfreelotheme_options['use_header_bar_search']) && ('1' == $ishfreelotheme_options['use_header_bar_search']) ){
			$searchboxItem =
				'<li class="ish-phb-search">' .
				$args->before .
				'<a href="#search" class="ish-icon-search-outline"><span>' . esc_html__( 'Search', 'freelo' ) . '</span></a>' . $args->after . '</li>';
			$items = $items . $searchboxItem;
		}

		return $items;
	}
}

/* *********************************************************************************************************************
 * Create menu and search button second ul for responsive version
 */
if ( ! function_exists( 'ishfreelotheme_create_resp_nav' ) ) {
	function ishfreelotheme_create_resp_nav() {
		global $ishfreelotheme_options;

		$visibility_class = ( ishfreelotheme_use_sidenav() ) ? 'ish-ph-mn-visible' : 'ish-ph-mn-hidden';

		?>
		<ul class="ish-ph-mn-resp_nav <?php echo esc_attr( $visibility_class ); ?>">
			<!-- Resp menu button -->
			<?php if ( ! ishfreelotheme_use_sidenav() ){ ?>
				<li class="ish-ph-mn-resp_menu"><a href="#respnav" class="ish-icon-waves-outline"></a></li>
			<?php } else { ?>
				<li class="ish-ph-mn-resp_menu"><a href="#sidenav" class="ish-icon-waves-outline"></a></li>
			<?php } ?>

			<!-- Search button if enabled -->
			<?php if ( isset($ishfreelotheme_options['use_navigation_search']) && ('1' == $ishfreelotheme_options['use_navigation_search']) ) { ?>
				<li class="ish-ph-mn-search"><a href="#search" class="ish-icon-search-outline"></a></li>
			<?php } ?>

			<!-- Expandable button if enabled -->
			<?php if ( ishfreelotheme_use_expandable_header() ) { ?>
				<li class="ish-ph-expandable_btn"><a href="#expandable" class="ish-icon-plus-outline"></a></li>
			<?php } ?>

			<!-- Cart button if enabled -->
			<?php echo ishfreelotheme_add_main_menu_shopping_cart(); ?>

			<!-- Language Selector button if enabled -->
			<?php echo ishfreelotheme_add_language_selector(); ?>


		</ul>
		<?php
	}
}


/* *********************************************************************************************************************
 * Create menu and search button second ul for responsive version of Header Bar
 */
if ( ! function_exists( 'ishfreelotheme_create_header_bar_resp_nav' ) ) {
	function ishfreelotheme_create_header_bar_resp_nav() {
		global $ishfreelotheme_options;

		$visibility_class = ( ishfreelotheme_use_sidenav() ) ? 'ish-phb-visible' : 'ish-phb-hidden';

		?>
		<ul class="ish-phb-resp_nav ish-phb-hidden">
			<!-- Resp menu button -->
			<li class="ish-phb-resp_menu"><a href="#phb-respnav" class="ish-icon-waves-outline"></a></li>


			<!-- Cart button if enabled -->
			<?php echo ishfreelotheme_add_header_bar_shopping_cart(); ?>

			<!-- Language Selector button if enabled -->
			<?php echo ishfreelotheme_add_header_bar_language_selector(); ?>

			<!-- Expandable button if enabled -->
			<?php /* if ( ishfreelotheme_use_expandable_header() ) { ?>
				<li class="ish-phb-expandable_btn"><a href="#expandable" class="ish-icon-plus-outline"></a></li>
			<?php } */ ?>

			<!-- Search button if enabled -->
			<?php if ( isset($ishfreelotheme_options['use_header_bar_search']) && ('1' == $ishfreelotheme_options['use_header_bar_search']) ) { ?>
				<li class="ish-phb-search"><a href="#search" class="ish-icon-search-outline"></a></li>
			<?php } ?>

		</ul>
	<?php
	}
}


/* *********************************************************************************************************************
 * Make wp_nav_menu recognize custom post type page and highlight its ancestor
 */
add_filter( 'nav_menu_css_class', 'ishfreelotheme_current_type_nav_class', 10, 2);

if ( ! function_exists( 'ishfreelotheme_current_type_nav_class' ) ) {
	function ishfreelotheme_current_type_nav_class($css_class, $cur_page){
		global $ishfreelotheme_options, $ishfreelotheme_woo_id;

		$post_type = get_post_type();
		if($post_type != "page" && $post_type != 'post' ){
			$parent_page = (isset($ishfreelotheme_options['page_for_custom_post_type_' . $post_type])) ? $ishfreelotheme_options['page_for_custom_post_type_' . $post_type] : '-1';
			if($cur_page->object_id == $parent_page){
				$css_class[] = 'current_page_parent';
			}
			else{
				if(($key = array_search('current_page_parent', $css_class)) !== false) {
					unset($css_class[$key]);
				}
			}
		}
		elseif ( function_exists( 'is_shop') && is_shop() ){

			if ( null == $ishfreelotheme_woo_id ) {
				$ishfreelotheme_woo_id = wc_get_page_id( 'shop' );
			}
			$ish_shop_id = wc_get_page_id( 'shop' );

			// Un-highlight Original Shop Page
			if( $ish_shop_id != $ishfreelotheme_woo_id && $cur_page->object_id == $ish_shop_id) {
				if ( in_array( 'current-menu-item', $css_class ) ) {
					unset( $css_class[ array_search( 'current-menu-item', $css_class ) ] );
				}
				if ( in_array( 'current_page_item', $css_class ) ) {
					unset( $css_class[ array_search( 'current_page_item', $css_class ) ] );
				}
			}

			// HighLight Current Shop Page
			if( $cur_page->object_id == $ishfreelotheme_woo_id){
				$css_class[] = 'current-menu-item';
				$css_class[] = 'current_page_item';
			}
		}
		return $css_class;
	}
}


/* *********************************************************************************************************************
 * Add language selector
 */
if ( ! function_exists( 'ishfreelotheme_add_language_selector' ) ) {
	function ishfreelotheme_add_language_selector($items = null, $args = null){
		global $ishfreelotheme_options;

		if ( isset( $items ) && isset( $args ) ){

			// Running as a filter
			if ( isset($args->container_class) && (false !== strpos( $args->container_class, 'ish-ph-mn-center' )) && isset($ishfreelotheme_options['main_nav_languages']) && ('1' == $ishfreelotheme_options['main_nav_languages']) ){

				$cc = ( defined('ICL_LANGUAGE_CODE') && '' != ICL_LANGUAGE_CODE ) ? ' <span class="ish-language-code">(' . ICL_LANGUAGE_CODE . ')</span>' : '';

				$searchboxItem =
					'<li class="ish-ph-lng-selector">' .
					$args->before .
					'<a href="#"  class="ish-icon-globe-outline"><span>' . esc_html__( 'Language', 'freelo' ) . '</span>' . $cc . '</a>';

					$searchboxItem .= ishfreelotheme_language_selector() .

					$args->after .
					'</li>';

				$items = $items . $searchboxItem;

			}

		} else {
			// Running as stand-alone function

			$items = '';

			if ( ishfreelotheme_wpml_plugin_active() && isset($ishfreelotheme_options['main_nav_languages']) && ('1' == $ishfreelotheme_options['main_nav_languages']) ){

				$cc = ( defined('ICL_LANGUAGE_CODE') && '' != ICL_LANGUAGE_CODE ) ? ' <span class="ish-language-code">(' . ICL_LANGUAGE_CODE . ')</span>' : '';

				$searchboxItem =
					'<li class="ish-ph-lng-selector">' .
					'<a href="#"  class="ish-icon-globe-outline"><span>' . esc_html__( 'Language', 'freelo' ) . '</span>' . $cc . '</a>';

				$searchboxItem .= ishfreelotheme_language_selector() .
					'</li>';

				$items = $items . $searchboxItem;

			}
		}

		return $items;
	}
}


/* *********************************************************************************************************************
 * Add language selector
 */
if ( ! function_exists( 'ishfreelotheme_add_header_bar_language_selector' ) ) {
	function ishfreelotheme_add_header_bar_language_selector($items = null, $args = null){
		global $ishfreelotheme_options;

		if ( isset( $items ) && isset( $args ) ){
			// Running as a filter
			if ( isset($args->theme_location) && ( 'header-bar-menu' == $args->theme_location ) && isset($ishfreelotheme_options['header_bar_languages']) && ('1' == $ishfreelotheme_options['header_bar_languages']) ){

				$cc = ( defined('ICL_LANGUAGE_CODE') && '' != ICL_LANGUAGE_CODE ) ? ' <span class="ish-language-code">(' . ICL_LANGUAGE_CODE . ')</span>' : '';

				$searchboxItem =
					'<li class="ish-phb-lng-selector">' .
					$args->before .
					'<a href="#"  class="ish-icon-globe-outline"><span>' . esc_html__( 'Language', 'freelo' ) . '</span>' . $cc . '</a>';

				$searchboxItem .= ishfreelotheme_language_selector();

				$searchboxItem .= $args->after;

				$searchboxItem .= '</li>';

				$items = $items . $searchboxItem;

			}

		} else {
			// Running as stand-alone function

			$items = '';

			if ( ishfreelotheme_wpml_plugin_active() && isset($ishfreelotheme_options['header_bar_languages']) && ('1' == $ishfreelotheme_options['header_bar_languages']) ){

				$cc = ( defined('ICL_LANGUAGE_CODE') && '' != ICL_LANGUAGE_CODE ) ? ' <span class="ish-language-code">(' . ICL_LANGUAGE_CODE . ')</span>' : '';

				$searchboxItem =
					'<li class="ish-phb-lng-selector">' .
					'<a href="#"  class="ish-icon-globe-outline"><span>' . esc_html__( 'Language', 'freelo' ) . '</span>' . $cc . '</a>';

				$searchboxItem .= ishfreelotheme_language_selector();

				$searchboxItem .=	'</li>';

				$items = $items . $searchboxItem;

			}
		}

		return $items;
	}
}


/* *********************************************************************************************************************
 * Do not highlight Blog page in main menu when on search results page.
 */
if ( ! function_exists( 'ishfreelotheme_noCurrentNavInSearch' ) ) {
	function ishfreelotheme_noCurrentNavInSearch( $content ) {
		if ( is_search() || is_404() ) $content = preg_replace( '/ current_page[_a-z]*([\" ])/', '\1', $content );
		return $content;
	}
}
add_filter( 'wp_nav_menu', 'ishfreelotheme_noCurrentNavInSearch' );


/* *********************************************************************************************************************
 * Sticky nav on
 */
if ( ! function_exists( 'ishfreelotheme_is_sticky_nav_on') ) {
	function ishfreelotheme_is_sticky_nav_on(){

		global $ishfreelotheme_options;

		if ( isset( $ishfreelotheme_options['sticky_nav'] ) && '1' == $ishfreelotheme_options['sticky_nav'] ) {
			return 'ish-sticky-on';
		}
		else {
			return '';
		}

	}
}


/* *********************************************************************************************************************
 * Sticky resp nav on
 */
if ( ! function_exists( 'ishfreelotheme_is_sticky_nav_responsive_on') ) {
	function ishfreelotheme_is_sticky_nav_responsive_on(){

		global $ishfreelotheme_options;

		if ( isset( $ishfreelotheme_options['sticky_nav_responsive'] ) && '1' == $ishfreelotheme_options['sticky_nav_responsive'] ) {
			return '';
		}
		else {
			return 'ish-sticky_resp-off';
		}

	}
}

/* *********************************************************************************************************************
 * Sticky nav on
 */
if ( ! function_exists( 'ishfreelotheme_is_header_bar_on') ) {
	function ishfreelotheme_is_header_bar_on(){

		global $ishfreelotheme_options;

		if ( ishfreelotheme_use_header_bar() ) {
			return 'ish-header_bar-on';
		}
		else {
			return 'ish-header_bar-off';
		}

	}
}




/* *********************************************************************************************************************
 * Retina logo
 */
if ( ! function_exists( 'ishfreelotheme_is_retina_logo') ) {
	function ishfreelotheme_is_retina_logo( $header_class ){

		global $ishfreelotheme_options;

		if ( 'ish-alt-style' == $header_class ){
			return ( isset( $ishfreelotheme_options['logo_retina_image_alternative'] ) && '' != $ishfreelotheme_options['logo_retina_image_alternative'] ) || ( isset( $ishfreelotheme_options['logo_retina_image'] ) && '' != $ishfreelotheme_options['logo_retina_image'] );
		}

		return ( isset( $ishfreelotheme_options['logo_retina_image'] ) && '' != $ishfreelotheme_options['logo_retina_image'] );

	}
}


/* *********************************************************************************************************************
 * Logo
 */
if ( ! function_exists( 'ishfreelotheme_is_logo') ) {
	function ishfreelotheme_is_logo( $header_class ){

		global $ishfreelotheme_options;

		if ( 'ish-alt-style' == $header_class ){
			return ( isset( $ishfreelotheme_options['logo_image_alternative'] ) && '' != $ishfreelotheme_options['logo_image_alternative'] ) || ( isset( $ishfreelotheme_options['logo_image'] ) && '' != $ishfreelotheme_options['logo_image'] );
		}
		else {
			return ( isset( $ishfreelotheme_options['logo_image'] ) && '' != $ishfreelotheme_options['logo_image'] );
		}



	}
}

/* *********************************************************************************************************************
 * Get Logo
 */
if ( ! function_exists( 'ishfreelotheme_get_logo') ) {
	function ishfreelotheme_get_logo( $header_class ){

		global $ishfreelotheme_options;

		if ( 'ish-alt-style' == $header_class ){
			if ( isset( $ishfreelotheme_options['logo_image_alternative'] ) && '' != $ishfreelotheme_options['logo_image_alternative'] ){
				return $ishfreelotheme_options['logo_image_alternative'];
			} else if ( isset( $ishfreelotheme_options['logo_image'] ) && '' != $ishfreelotheme_options['logo_image'] ){
				return $ishfreelotheme_options['logo_image'];
			}
		}
		else {
			if  ( isset( $ishfreelotheme_options['logo_image'] ) && '' != $ishfreelotheme_options['logo_image'] ){
				return $ishfreelotheme_options['logo_image'];
			}
		}

		return '';

	}
}


/* *********************************************************************************************************************
 * Use image logo
 */
if ( ! function_exists( 'ishfreelotheme_use_logo') ) {
	function ishfreelotheme_use_logo(){

		global $ishfreelotheme_options;
		return ( isset($ishfreelotheme_options['logo_as_image']) && '1' == $ishfreelotheme_options['logo_as_image']);

	}
}

if ( ! function_exists( 'ishfreelotheme_empty_menu_fallback') ) {
	function ishfreelotheme_empty_menu_fallback(){

		echo '<ul id="mainnav" class="ish-ph-mn-main_nav"><li class="ish-no-menu">';
		if ( is_user_logged_in() ){
			echo '<a href="' . site_url() . '/wp-admin/nav-menus.php">' . esc_html__( 'No menu set under "Appearance -> Menus"' , 'freelo' ) . '</a>';
		}
		else{
			echo '<a href="#">' . esc_html__( 'No menu set under "Appearance -> Menus"' , 'freelo' ) . '</a>';
		}
		echo '</li></ul>';

	}
}

if ( ! function_exists( 'ishfreelotheme_empty_header_bar_menu_fallback') ) {
	function ishfreelotheme_empty_header_bar_menu_fallback(){

		echo '<ul id="top_bar_nav" class="ish-top_nav"><li class="ish-no-menu">';
		if ( is_user_logged_in() ){
			echo '<a href="' . site_url() . '/wp-admin/themes.php?page=optionsframework">' . esc_html__( 'No menu set under "Theme Options -> Header Options -> Header Top Bar"' , 'freelo' ) . '</a>';
		}
		else{
			echo '<a href="#">' . esc_html__( 'No menu set under "Theme Options -> Header Options -> Header Top Bar"' , 'freelo' ) . '</a>';
		}
		echo '</li></ul>';

	}
}


