<?php

global $ishfreelotheme_fonts;

$wc_colors = get_option( 'woocommerce_colors' );
if ( ! $wc_colors ) {
	// Try previous field name which was used in WooCommerce 2.2.*
	$wc_colors = get_option( 'woocommerce_frontend_css_colors' );
}

if ( empty( $wc_colors ) ) {

	$wc_colors = Array();

	// original Woocommerce colors
	/*
	$wc_colors['primary'] = '#a46497';
	$wc_colors['secondary'] = '#ebe9eb';
	$wc_colors['highlight'] = '#77a464';
	$wc_colors['content_bg'] = '#ffffff';
	$wc_colors['subtext'] = '#777777';
	*/

	// Woocommerce colors
	$wc_colors['primary'] = $ish_newdata['color5']; //#eb7859
	$wc_colors['secondary'] = $ish_newdata['color6']; //#f1f3f3
	$wc_colors['highlight'] = '#77a464';
	$wc_colors['content_bg'] = '#ffffff';
	$wc_colors['subtext'] = $ish_newdata['color2']; //#bac2c4
}

// Strange Customizer Fix
if ( isset( $wc_colors['contentbg'] ) && ! isset( $wc_colors['content_bg'] ) ){
	$wc_colors['content_bg'] = $wc_colors['contentbg'];
}

$c_text = ( isset( $ish_newdata['text_color'] ) && '' != $ish_newdata['text_color'] ) ? $ish_newdata['text_color'] : ISHFREELOTHEME_TEXT_COLOR;

// Font & Uppercase
?>
.woocommerce-result-count,
.woocommerce ul.products li.product h3,
.woocommerce ul.products li.product h2,
.woocommerce ul.products li.product .woocommerce-loop-product__title
{
	font-family: '<?php echo '' . $ishfreelotheme_fonts['body_font']['css_string']; ?>', sans-serif !important;
}

.woocommerce.add_to_cart_inline .amount,
.woocommerce #reviews #reply-title
{
	font-family: '<?php echo '' . $ishfreelotheme_fonts['h3_font']['css_string']; ?>', sans-serif !important;
	font-size:    <?php echo '' . $ishfreelotheme_fonts['h3_font']['size']; ?>px !important;
	font-weight:  <?php echo '' . $ishfreelotheme_fonts['h3_font']['variant']; ?>;
	font-style:   <?php echo '' . $ishfreelotheme_fonts['h3_font']['font-style']; ?>;
}

.woocommerce.add_to_cart_inline del,
.woocommerce.add_to_cart_inline del .amount
{
	font-size:    <?php echo '' . $ishfreelotheme_fonts['h4_font']['size']; ?>px !important;
}


<?php

// Theme Text Color ----------------------------------------------------------------------------------------------------
echo "
.woocommerce ul.products li.product h3,
.woocommerce ul.products li.product h2,
.woocommerce ul.products li.product .woocommerce-loop-product__title
{
	color: " . $c_text . ";
}

\n";

/*

$wc_colors['primary'];
$wc_colors['secondary'];
$wc_colors['highlight'];
$wc_colors['content_bg'];
$wc_colors['subtext'];

ishfreelotheme_hex2rgb( $wc_colors['primary'] );

ishfreelotheme_adjust_brightness( $wc_colors['primary'], -25 )

*/

// Body color
echo "
.product-category a,
.product a,
.myaccount_user a,
.addresses a,
.product-category a mark,
.chosen-search input,
.shop_table.cart a,
.woocommerce-account a
{
	color: " . $c_text . ";
}\n";


// Info, mesage, error
?>

p.woocommerce-info, .woocommerce-info { background: #1e85be !important; }
/*.woocommerce-info:before { color: #49a9e8 !important; }*/
p.woocommerce-message, .woocommerce-message { background: #9ac54a !important; }
/*.woocommerce-message:before { color: #9ac54a !important; }*/
p.woocommerce-error, .woocommerce-error { background: #fa594a !important; }
/*.woocommerce-error:before { color: #fa594a !important; }*/

.woocommerce-error, .woocommerce-message, .woocommerce-info,
.woocommerce-error a, .woocommerce-message a, .woocommerce-info a {
	color: #fff !important;
}

.woocommerce .woocommerce-error .woocommerce_message_text,
.woocommerce-page .woocommerce-error .woocommerce_message_text
{
	background: #fa594a;
}

.woocommerce .woocommerce-message .woocommerce_message_text,
.woocommerce-page .woocommerce-message .woocommerce_message_text
{
	background: #9ac54a;
}

.woocommerce .woocommerce-info .woocommerce_message_text,
.woocommerce-page .woocommerce-info .woocommerce_message_text
{
	background: #1e85be;
}

.woocommerce-info:before,
.woocommerce-message:before,
.woocommerce-error:before
{
	color: #fff !important;
}
<?php

// Primary -------------------------------------------------------------------------------------------------------------
echo "
.woocommerce ins,
.woocommerce a.remove,
.woocommerce a.remove:hover,
.woocommerce div.product p.price, .woocommerce div.product span.price,
.woocommerce .widget_layered_nav ul li.chosen a:before, .woocommerce .widget_layered_nav_filters ul li a:before,
.woocommerce div.product form.cart .button,
.woocommerce ul.products li.product .price,
.woocommerce .cart .button.checkout-button, .woocommerce-page .cart .button.checkout-button,
.woocommerce .cart-collaterals .shipping_calculator .button, .woocommerce-page .cart-collaterals .shipping_calculator .button,
.woocommerce ul.products li.product .star-rating,
.woocommerce .product .star-rating:before,
.woocommerce .star-rating span:before,
.woocommerce div.product p.stock,
.woocommerce .product_meta a,
.woocommerce p.stars a,
.woocommerce #reviews h3, .woocommerce-page #reviews h3,
.woocommerce #reviews #reply-title, .woocommerce-page #reviews #reply-title,
.woocommerce-page #payment ul .payment_method_paypal .about_paypal,
.woocommerce-page table.shop_table tfoot td,
.woocommerce-page table.shop_table td.product-subtotal,
.woocommerce-page .cart_totals .amount,
.woocommerce.add_to_cart_inline a.button,
.woocommerce.add_to_cart_inline a.button:before,
.woocommerce.add_to_cart_inline a.added_to_cart,
.woocommerce .order_details li strong,
.woocommerce .product-type-grouped table.group_table td.price .amount
{
	color: " . $wc_colors['primary'] . " !important;
}\n";

echo "
.woocommerce.add_to_cart_inline a.button:hover,
.woocommerce.add_to_cart_inline a.added_to_cart:hover
{
	color: " . ishfreelotheme_adjust_brightness( $wc_colors['primary'], -25 ) . " !important;
}\n";

echo "
.woocommerce span.onsale,
.woocommerce span.onsale:after,
.product-category a h3,
.product-category a .woocommerce-loop-category__title
{
	border-color: " . $wc_colors['primary'] . ";
}
\n";

echo "
.woocommerce span.onsale,
.woocommerce span.onsale:after,
.woocommerce.add_to_cart_inline a.button,
.woocommerce.add_to_cart_inline a.added_to_cart
{
	border-color: " . $wc_colors['primary'] . ";
}
\n";

echo "
.woocommerce div.product form.cart .button,
.woocommerce .cart .button.checkout-button, .woocommerce-page .cart .button.checkout-button,
.woocommerce .shipping-calculator-button,
.woocommerce .cart-collaterals .shipping_calculator .button, .woocommerce-page .cart-collaterals .shipping_calculator .button,
.woocommerce #payment #place_order, .woocommerce-page #payment #place_order
{
	/*border-color: rgba(" . ishfreelotheme_hex2rgb($wc_colors['primary']) . ", 0.25) !important;*/
}\n";

echo "
.woocommerce div.product form.cart .button:hover,
.woocommerce ul.products li.product a.button:hover, .woocommerce-page ul.products li.product a.button:hover,
.woocommerce .cart .button.checkout-button:hover, .woocommerce-page .cart .button.checkout-button:hover,
.woocommerce .shipping-calculator-button:hover,
.woocommerce .cart-collaterals .shipping_calculator .button:hover, .woocommerce-page .cart-collaterals .shipping_calculator .button:hover,
.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover
{
	/*border-color: rgba(" . ishfreelotheme_hex2rgb($wc_colors['primary']) . ", 0.5) !important;*/
}\n";


echo "
.demo_store,
.place-order .button,
.add_to_cart_button.button,
.single_add_to_cart_button.button,
.woocommerce-page .button,
.woocommerce a.button,
.woocommerce-page input[type='submit'],
/*.woocommerce .products .button,
.woocommerce div.product form.cart .button,*/
.woocommerce-pagination span.page-numbers,
.woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input,
.woocommerce #review_form #respond .submit, .woocommerce-page #review_form #respond .submit,
.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
/*.woocommerce .return-to-shop .button,*/
.price_slider .ui-slider-range,
.price_slider .ui-slider-handle,
.wc-forward.checkout-button.button,
.widget_price_filter button.button,
.widget_shopping_cart a.button,
.shipping-calculator-button,
.wc-backward.button,
.onsale,
.woocommerce-tabs .tabs a:hover,
.woocommerce-tabs .tabs .active a,
.woocommerce .shop_table.cart .quantity input.qty,
.wc-forward.button,
.wc-backward.button,
.price_slider_amount .button,
.coupon .button,
.coupon + .button,
.shipping-calculator-form .button,
.button[name='save_address'],
.button[name='save_account_details'],
.button[name='login'],
.button[name='wc_reset_password'],
.checkout_coupon .button
{
	background: " . $wc_colors['primary'] . " !important;
}\n";


echo "
.product-category a h3,
.product-category a .woocommerce-loop-category__title
{
	background: " . $wc_colors['primary'] . " !important;
}\n";

echo "
.place-order .button:hover,
.single_add_to_cart_button.button:hover,
.wc-forward.checkout-button.button:hover,
.widget_price_filter button.button:hover,
.widget_shopping_cart a.button:hover,
.shipping-calculator-button:hover,
.wc-backward.button:hover,
.woocommerce a.button:hover,
.woocommerce-page .button:hover,
.woocommerce-page input[type='submit']:hover,
/*.woocommerce .products .button:hover,
.woocommerce div.product form.cart .button:hover,*/
/*.woocommerce .return-to-shop .button:hover*/
.woocommerce #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:hover,
.woocommerce #review_form #respond .submit:hover, .woocommerce-page #review_form #respond .submit:hover,
.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover,
.add_to_cart_button.button:hover,
.wc-forward.button:hover,
.wc-backward.button:hover,
.price_slider_amount .button:hover,
.coupon .button:hover,
.coupon + .button:hover,
.shipping-calculator-form .button:hover,
.button[name='save_address']:hover,
.button[name='save_account_details']:hover,
.button[name='login']:hover,
.button[name='wc_reset_password']:hover,
.quantity .minus:hover, .quantity .plus:hover,
.form-submit #submit:hover,
.checkout_coupon .button:hover
{
	background: " . ishfreelotheme_adjust_brightness( $wc_colors['primary'], -25 ) . " !important;
}\n";

echo "
.price_slider .ui-slider-handle
{
	border-color: " . ishfreelotheme_adjust_brightness( $wc_colors['primary'], -25 ) . " !important;
}\n";

echo "
.place-order .button,
.single_add_to_cart_button.button,
.woocommerce-pagination span.page-numbers,
.wc-forward.checkout-button.button,
.wc-backward.button,
.shipping-calculator-button
{
	/*box-shadow: 0 3px 0 " . ishfreelotheme_adjust_brightness( $wc_colors['primary'], -25 ) . " !important;*/
}\n";

echo "
.place-order .button:hover,
.single_add_to_cart_button.button:hover,
.wc-forward.checkout-button.button:hover,
.wc-backward.button:hover,
.shipping-calculator-button:hover
{
	/*box-shadow: 0 3px 0 " . ishfreelotheme_adjust_brightness( $wc_colors['primary'], -50 ) . " !important;*/
}\n";


// Secondary -----------------------------------------------------------------------------------------------------------
echo "
.product-category a h3, 
.product-category a .woocommerce-loop-category__title, 
.product-category a h3 mark,
.product-category a .woocommerce-loop-category__title mark
{
	color: " . $wc_colors['secondary'] . " !important;
}\n";

echo "
.s,
.woocommerce-pagination a.page-numbers,
.woocommerce .quantity input.qty,
.woocommerce #review_form #respond textarea, .woocommerce-page #review_form #respond textarea,
.woocommerce #review_form #respond input, .woocommerce-page #review_form #respond input,
.woocommerce-page textarea,
.woocommerce-page input,
.woocommerce-page select,
.woocommerce-page .select2-container .select2-choice
{
	background: " . $wc_colors['secondary'] . " !important;
}\n";

echo "
.woocommerce-pagination a.page-numbers:hover
{
	background: " . ishfreelotheme_adjust_brightness( $wc_colors['secondary'], -25 ) . " !important;
}\n";

echo "
.woocommerce .quantity input.qty {
	border-color: " . $wc_colors['subtext'] . " !important;
}\n";


// Highlight -----------------------------------------------------------------------------------------------------------



// Content -------------------------------------------------------------------------------------------------------------
echo "
.demo_store,
.wc-forward.button,
.price_slider_amount .button,
.coupon .button,
.coupon + .button,
.shipping-calculator-form .button,
.button[name='save_address'],
.button[name='save_account_details'],
.button[name='login'],
.button[name='wc_reset_password'],
/*.widget_product_tag_cloud a,*/
.wc-forward.checkout-button.button,
.widget_price_filter button.button,
.widget_shopping_cart a.button,
.shipping-calculator-button,
.quantity .minus, .quantity .plus,
.form-submit #submit,
.checkout_coupon .button,
.woocommerce-tabs .tabs a,
.chosen-single,
.place-order .button,
.single_add_to_cart_button.button,
.wc-backward.button,
.add_to_cart_button:before,
.woocommerce a.button,
.woocommerce input.button,
.woocommerce .button.view,
.woocommerce-error .wc-forward.button, .woocommerce-message .wc-forward.button, .woocommerce-info .wc-forward.button,
.woocommerce-page form.checkout_coupon .button, .woocommerce form.checkout_coupon .button,
.woocommerce .button[name='save_account_details'],
.woocommerce .button[name='save_address'],
.woocommerce .cart .button:not(.checkout-button), .woocommerce .cart input.button:not(.checkout-button), .woocommerce-page .cart .button:not(.checkout-button), .woocommerce-page .cart input.button:not(.checkout-button),
.woocommerce ul.products li.product a.button, .woocommerce-page ul.products li.product a.button,
.woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input,
.woocommerce #review_form #respond .submit, .woocommerce-page #review_form #respond .submit,
.woocommerce div.product form.cart .button,
.woocommerce-pagination .page-numbers .current,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
.woocommerce .return-to-shop .button,
.woocommerce .shop_table.cart .quantity input.qty
{
	color: " . $wc_colors['content_bg'] . " !important;
}\n";

echo "
.woocommerce-error .wc-forward.button, .woocommerce-message .wc-forward.button, .woocommerce-info .wc-forward.button
{
	background: " . $wc_colors['content_bg'] . " !important;
}\n";

echo "
.woocommerce ul.products li.product a.button, .woocommerce-page ul.products li.product a.button
{
	border-color: rgba(" . ishfreelotheme_hex2rgb($wc_colors['content_bg']) . ", 0.25) !important;
}\n";

echo "
.woocommerce-error .wc-forward.button:hover, .woocommerce-message .wc-forward.button:hover, .woocommerce-info .wc-forward.button:hover
{
	background: " . ishfreelotheme_adjust_brightness( $wc_colors['content_bg'], -25 ) . " !important;
}\n";

echo "
.woocommerce-error .wc-forward.button, .woocommerce-message .wc-forward.button, .woocommerce-info .wc-forward.button
{
	/*box-shadow: 0 3px 0 " . ishfreelotheme_adjust_brightness( $wc_colors['content_bg'], -25 ) . " !important;*/
}\n";

echo "
.woocommerce-error .wc-forward.button:hover, .woocommerce-message .wc-forward.button:hover, .woocommerce-info .wc-forward.button:hover
{
	/*box-shadow: 0 3px 0 " . ishfreelotheme_adjust_brightness( $wc_colors['content_bg'], -50 ) . " !important;*/
}\n";


// Subtext  ------------------------------------------------------------------------------------------------------------
echo "
.woocommerce-checkout .form-row .chosen-container-single .chosen-single,
.woocommerce .chosen-container .chosen-single,
.woocommerce-ordering .orderby, .widget_product_categories .dropdown_product_cat,
.woocommerce .shop_table a,
.woocommerce ul.products li.product .price del,
.woocommerce div.product p.price del,
.woocommerce div.product span.price del,
.woocommerce-result-count,
.payment_box,
.lost_password a,
.woocommerce.add_to_cart_inline del,
.woocommerce.add_to_cart_inline del .amount
{
	color: " . $wc_colors['subtext'] . " !important;
}\n";

echo "
.woocommerce-pagination .page-numbers,
.woocommerce-checkout #order_review #payment ul .payment_method_paypal .about_paypal:before
{
	color: " . ishfreelotheme_adjust_brightness( $wc_colors['subtext'], -25 ) . " !important;
}\n";

echo "
.woocommerce.add_to_cart_inline ins,
.woocommerce.add_to_cart_inline .amount,
.woocommerce table.shop_attributes th
{
	color: " . ishfreelotheme_adjust_brightness( $wc_colors['subtext'], -100 ) . " !important;
}\n";

echo "
.price_slider,
.quantity .minus, .quantity .plus,
.form-submit #submit,
.woocommerce-tabs .tabs a,
.chosen-single
{
	background: " . $wc_colors['subtext'] . " !important;
}\n";

echo "
.widget_product_tag_cloud a
{
	/*background: " . ishfreelotheme_adjust_brightness( $wc_colors['subtext'], -25 ) . " !important;*/
}\n";

echo "
.widget_product_tag_cloud a:hover
{
	/*background: " . ishfreelotheme_adjust_brightness( $wc_colors['subtext'], -50 ) . " !important;*/
}\n";

echo "
.wc-forward.button,
.wc-backward.button,
.add_to_cart_button.button,
.price_slider_amount .button,
.coupon .button,
.coupon + .button,
.shipping-calculator-form .button,
.button[name='save_address'],
.button[name='save_account_details'],
.button[name='login'],
.button[name='wc_reset_password'],
.woocommerce-pagination a.page-numbers,
.form-submit #submit,
.checkout_coupon .button,
.woocommerce-tabs .tabs a
{
	/*box-shadow: 0 3px 0 " . ishfreelotheme_adjust_brightness( $wc_colors['subtext'], -25 ) . " !important;*/
}\n";

echo "
.wc-forward:hover.button,
.wc-backward:hover.button,
.add_to_cart_button.button:hover,
.price_slider_amount .button:hover,
.coupon .button:hover,
.coupon + .button:hover,
.shipping-calculator-form .button:hover,
.button[name='save_address']:hover,
.button[name='save_account_details']:hover,
.button[name='login']:hover,
.button[name='wc_reset_password']:hover,
.woocommerce-pagination a.page-numbers:hover,
.form-submit #submit:hover,
.checkout_coupon .button:hover,
.woocommerce-tabs .tabs a:hover, .woocommerce-tabs .tabs .active a
{
	/*box-shadow: 0 3px 0 " . ishfreelotheme_adjust_brightness( $wc_colors['subtext'], -50 ) . " !important;*/
}\n";

echo "
.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
.woocommerce .quantity input.qty,
.woocommerce #review_form #respond textarea, .woocommerce-page #review_form #respond textarea,
.woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce-page #reviews #comments ol.commentlist li .comment-text,
.woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input,
.woocommerce #review_form #respond .submit, .woocommerce-page #review_form #respond .submit,
.woocommerce .cart .button:not(.checkout-button), .woocommerce .cart input.button:not(.checkout-button), .woocommerce-page .cart .button:not(.checkout-button), .woocommerce-page .cart input.button:not(.checkout-button),
.woocommerce-checkout .form-row .chosen-container-single .chosen-single,
.woocommerce-page form.checkout_coupon .button, .woocommerce form.checkout_coupon .button,
.woocommerce .button[name='save_account_details'],
.woocommerce .button[name='save_address'],
.woocommerce .chosen-container .chosen-single,
.widget_product_categories li,
.woocommerce-ordering .orderby, .widget_product_categories .dropdown_product_cat,
.woocommerce div.product .woocommerce-tabs .panel,
.woocommerce-checkout #order_review #payment ul li,
.woocommerce-page table tr th,
.woocommerce-page table tr td,
.woocommerce table.shop_attributes
{
	border-color: rgba(" . ishfreelotheme_hex2rgb($wc_colors['subtext']) . ", 0.2) !important;
}\n";

echo "
.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover,
.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
.woocommerce .quantity input.qty:hover,
.woocommerce #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:hover,
.woocommerce #review_form #respond .submit:hover, .woocommerce-page #review_form #respond .submit:hover,
.woocommerce .cart .button:not(.checkout-button):hover, .woocommerce .cart input.button:not(.checkout-button):hover, .woocommerce-page .cart .button:not(.checkout-button):hover, .woocommerce-page .cart input.button:not(.checkout-button):hover,
.woocommerce-page form.checkout_coupon .button:hover, .woocommerce form.checkout_coupon .button:hover,
.woocommerce .button[name='save_account_details']:hover,
.woocommerce .button[name='save_address']:hover,
.woocommerce-ordering .orderby:hover, .widget_product_categories .dropdown_product_cat:hover,
.woocommerce .woocommerce-message:after,
.woocommerce .woocommerce-error:after,
.woocommerce .woocommerce-info:after,
.woocommerce-checkout #order_review_heading:before,
.woocommerce .related.products:before,
/*.woocommerce-page table.shop_table.cart tr:nth-of-type(1) td,
.woocommerce-page table.shop_table.cart tr:nth-of-type(1) th,
.woocommerce-page table.shop_table.cart tr:last-of-type td,
.woocommerce-page table.shop_table.cart tr:last-of-type th,*/
.addresses-title-separator:before
{
	border-color: rgba(" . ishfreelotheme_hex2rgb($wc_colors['subtext']) . ", 0.5) !important;
}\n";


echo "
.woocommerce .quantity .plus, .woocommerce .quantity .minus
{
	background: rgba(" . ishfreelotheme_hex2rgb($wc_colors['subtext']) . ", 0.25) !important;
}\n";

echo "
.woocommerce .quantity .plus:hover, .woocommerce .quantity .minus:hover
{
	background: rgba(" . ishfreelotheme_hex2rgb($wc_colors['subtext']) . ", 0.5) !important;
}\n";

?>


<?php
// Exapndable area colors ----------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['exparea_colors'] ) || isset( $ish_newdata['exparea_colors'] ) ) {

	// Text
	if ( isset( $ish_newdata['exparea_colors']['text'] ) && '' != $ish_newdata['exparea_colors']['text'] ) {
		?>


.ish-part_expandable .widget_shopping_cart .total
{
	border-color: <?php echo "rgba(" . ishfreelotheme_hex2rgb($ish_newdata['exparea_colors']['text']) . ", 0.5) " ?> !important;
}
<?php
}

// Link 1
if ( isset( $ish_newdata['exparea_colors']['link1'] ) && '' != $ish_newdata['exparea_colors']['link1'] ) {
?>
.ish-part_expandable .widget_shopping_cart .total,
.ish-part_expandable .widget a
/*.ish-part_footer .widget a.remove,
.ish-part_footer .widget_layered_nav_filters ul li.chosen a:before*/
{
	color: <?php echo '' . $ish_newdata['exparea_colors']['link1']; ?>;
}

.ish-part_expandable .widget .star-rating span:before,
.ish-part_expandable .widget ins,
.ish-part_expandable .widget .star-rating span:before
{
	color: <?php echo '' . $ish_newdata['exparea_colors']['link1']; ?> !important;
}
<?php
}

// Block el bg
if ( isset( $ish_newdata['exparea_colors']['block_bg'] ) && '' != $ish_newdata['exparea_colors']['block_bg'] ) {
?>
.ish-part_expandable .widget input[type="text"],
.ish-part_expandable .widget input[type="submit"],
.ish-part_expandable .widget .button,
.ish-part_expandable .widget .price_slider .ui-slider-range,
.ish-part_expandable .widget .price_slider .ui-slider-handle,
.ish-part_expandable .widget .search-field
{
	background-color: <?php echo '' . $ish_newdata['exparea_colors']['block_bg']; ?> !important;
}

.ish-part_expandable .widget .price_slider .ui-slider-handle
{
	border-color: <?php echo '' . $ish_newdata['exparea_colors']['block_bg']; ?> !important;
}
<?php
}

// Block el bg active
if ( isset( $ish_newdata['exparea_colors']['block_bg'] ) && '' != $ish_newdata['exparea_colors']['block_bg'] ) {
?>
.ish-part_expandable .widget input[type="submit"]:hover,
.ish-part_expandable .widget .button:hover
{
	background-color: <?php echo ishfreelotheme_adjust_brightness( $ish_newdata['exparea_colors']['block_bg'], -25 ); ?> !important;
}
<?php
}

// Block el text
if ( isset( $ish_newdata['exparea_colors']['block_text'] ) && '' != $ish_newdata['exparea_colors']['block_text'] ) {
?>
.ish-part_expandable .widget input[type="text"],
.ish-part_expandable .widget input[type="submit"],
.ish-part_expandable .widget .button,
.ish-part_expandable .widget .search-field
{
	color: <?php echo '' . $ish_newdata['exparea_colors']['block_text']; ?> !important;
}

<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
$placeholders = Array( '.ish-part_expandable .widget input' );
foreach ( $placeholders as $placeholder ) {
	foreach ( $prefixes as $prefix ) {
		echo '' . $placeholder . $prefix . "{ color: rgba(" . ishfreelotheme_hex2rgb($ish_newdata['exparea_colors']['block_text']) . ", 0.7); }\n";
	}
}
}
}
?>


<?php
// Sidenav colors ----------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['sidenav_colors'] ) || isset( $ish_newdata['sidenav_colors'] ) ) {

	// Text
	if ( isset( $ish_newdata['sidenav_colors']['text'] ) && '' != $ish_newdata['sidenav_colors']['text'] ) {
		?>


.ish-sidenav .widget_shopping_cart .total
{
	border-color: <?php echo "rgba(" . ishfreelotheme_hex2rgb($ish_newdata['sidenav_colors']['text']) . ", 0.5) " ?> !important;
}
<?php
}

// Link 1
if ( isset( $ish_newdata['sidenav_colors']['link1'] ) && '' != $ish_newdata['sidenav_colors']['link1'] ) {
?>
.ish-sidenav .widget_shopping_cart .total,
.ish-sidenav .widget a
/*.ish-part_footer .widget a.remove,
.ish-part_footer .widget_layered_nav_filters ul li.chosen a:before*/
{
	color: <?php echo '' . $ish_newdata['sidenav_colors']['link1']; ?>;
}

.ish-sidenav .widget .star-rating span:before,
.ish-sidenav .widget ins,
.ish-sidenav .widget .star-rating span:before
{
	color: <?php echo '' . $ish_newdata['sidenav_colors']['link1']; ?> !important;
}
<?php
}

// Block el bg
if ( isset( $ish_newdata['sidenav_colors']['block_bg'] ) && '' != $ish_newdata['sidenav_colors']['block_bg'] ) {
?>
.ish-sidenav .widget input[type="text"],
.ish-sidenav .widget input[type="submit"],
.ish-sidenav .widget .button,
.ish-sidenav .widget .price_slider .ui-slider-range,
.ish-sidenav .widget .price_slider .ui-slider-handle,
.ish-sidenav .widget .search-field
{
	background-color: <?php echo '' . $ish_newdata['sidenav_colors']['block_bg']; ?> !important;
}

.ish-sidenav .widget .price_slider .ui-slider-handle
{
	border-color: <?php echo '' . $ish_newdata['sidenav_colors']['block_bg']; ?> !important;
}
<?php
}

// Block el bg active
if ( isset( $ish_newdata['sidenav_colors']['block_bg'] ) && '' != $ish_newdata['sidenav_colors']['block_bg'] ) {
?>
.ish-sidenav .widget input[type="submit"]:hover,
.ish-sidenav .widget .button:hover
{
	background-color: <?php echo ishfreelotheme_adjust_brightness( $ish_newdata['sidenav_colors']['block_bg'], -25 ); ?> !important;
}
<?php
}

// Block el text
if ( isset( $ish_newdata['sidenav_colors']['block_text'] ) && '' != $ish_newdata['sidenav_colors']['block_text'] ) {
?>
.ish-sidenav .widget input[type="text"],
.ish-sidenav .widget input[type="submit"],
.ish-sidenav .widget .button,
.ish-sidenav .widget .search-field
{
	color: <?php echo '' . $ish_newdata['sidenav_colors']['block_text']; ?> !important;
}

<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
$placeholders = Array( '.ish-sidenav .widget input' );
foreach ( $placeholders as $placeholder ) {
	foreach ( $prefixes as $prefix ) {
		echo '' . $placeholder . $prefix . "{ color: rgba(" . ishfreelotheme_hex2rgb($ish_newdata['sidenav_colors']['block_text']) . ", 0.7); }\n";
	}
}
}
}
?>


<?php
// Sidebar colors ------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['sidebar_colors'] ) || isset( $ish_newdata['sidebar_colors'] ) ) {

	// Text
	if ( isset( $ish_newdata['sidebar_colors']['text'] ) && '' != $ish_newdata['sidebar_colors']['text'] ) {
		?>
.ish-main-sidebar .widget_shopping_cart .total
{
	border-color: <?php echo "rgba(" . ishfreelotheme_hex2rgb($ish_newdata['sidebar_colors']['text']) . ", 0.5) " ?> !important;
}
<?php
}

// Link 1
if ( isset( $ish_newdata['sidebar_colors']['link1'] ) && '' != $ish_newdata['sidebar_colors']['link1'] ) {
?>
.ish-main-sidebar .widget_shopping_cart .total,
.ish-main-sidebar .widget a
/*.ish-part_footer .widget a.remove,
.ish-part_footer .widget_layered_nav_filters ul li.chosen a:before*/
{
	color: <?php echo '' . $ish_newdata['sidebar_colors']['link1']; ?>;
}

.ish-main-sidebar .widget .star-rating span:before,
.ish-main-sidebar .widget ins,
.ish-main-sidebar .widget .star-rating span:before
{
	color: <?php echo '' . $ish_newdata['sidebar_colors']['link1']; ?> !important;
}
<?php
}

// Block el bg
if ( isset( $ish_newdata['sidebar_colors']['block_bg'] ) && '' != $ish_newdata['sidebar_colors']['block_bg'] ) {
?>
.ish-main-sidebar .widget input[type="text"],
.ish-main-sidebar .widget input[type="submit"],
.ish-main-sidebar .widget .button,
.ish-main-sidebar .widget .price_slider .ui-slider-range,
.ish-main-sidebar .widget .price_slider .ui-slider-handle,
.ish-main-sidebar .widget .search-field
{
	background-color: <?php echo '' . $ish_newdata['sidebar_colors']['block_bg']; ?> !important;
}

.ish-main-sidebar .widget .price_slider .ui-slider-handle
{
	border-color: <?php echo '' . $ish_newdata['sidebar_colors']['block_bg']; ?> !important;
}
<?php
}

// Block el bg active
if ( isset( $ish_newdata['sidebar_colors']['block_bg'] ) && '' != $ish_newdata['sidebar_colors']['block_bg'] ) {
?>
.ish-main-sidebar .widget input[type="submit"]:hover,
.ish-main-sidebar .widget .button:hover
{
	background-color: <?php echo ishfreelotheme_adjust_brightness( $ish_newdata['sidebar_colors']['block_bg'], -25 ); ?> !important;
}
<?php
}

// Block el text
if ( isset( $ish_newdata['sidebar_colors']['block_text'] ) && '' != $ish_newdata['sidebar_colors']['block_text'] ) {
?>
.ish-main-sidebar .widget input[type="text"],
.ish-main-sidebar .widget input[type="submit"],
.ish-main-sidebar .widget .button,
.ish-main-sidebar .widget .search-field
{
	color: <?php echo '' . $ish_newdata['sidebar_colors']['block_text']; ?> !important;
}

<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
$placeholders = Array( '.ish-main-sidebar .widget input' );
foreach ( $placeholders as $placeholder ) {
	foreach ( $prefixes as $prefix ) {
		echo '' . $placeholder . $prefix . "{ color: rgba(" . ishfreelotheme_hex2rgb($ish_newdata['sidebar_colors']['block_text']) . ", 0.7); }\n";
	}
}
}
}
?>


<?php
// Footer colors -------------------------------------------------------------------------------------------------------
if ( isset( $ish_newdata['footer_colors'] ) || isset( $ish_newdata['footer_colors'] ) ) {

	// Text
	if ( isset( $ish_newdata['footer_colors']['text'] ) && '' != $ish_newdata['footer_colors']['text'] ) {
		?>

.ish-part_footer .widget_shopping_cart .total
{
	border-color: <?php echo "rgba(" . ishfreelotheme_hex2rgb($ish_newdata['footer_colors']['text']) . ", 0.5) " ?> !important;
}
<?php
}

// Link 1
if ( isset( $ish_newdata['footer_colors']['link1'] ) && '' != $ish_newdata['footer_colors']['link1'] ) {
?>
.ish-part_footer .widget_shopping_cart .total,
.ish-part_footer .widget a
/*.ish-part_footer .widget a.remove,
.ish-part_footer .widget_layered_nav_filters ul li.chosen a:before*/
{
	color: <?php echo '' . $ish_newdata['footer_colors']['link1']; ?>;
}

.ish-part_footer .widget .star-rating span:before,
.ish-part_footer .widget ins,
.ish-part_footer .widget .star-rating span:before
{
	color: <?php echo '' . $ish_newdata['footer_colors']['link1']; ?> !important;
}
<?php
}

// Block el bg
if ( isset( $ish_newdata['footer_colors']['block_bg'] ) && '' != $ish_newdata['footer_colors']['block_bg'] ) {
?>
.ish-part_footer .widget input[type="text"],
.ish-part_footer .widget input[type="submit"],
.ish-part_footer .widget .button,
.ish-part_footer .widget .price_slider .ui-slider-range,
.ish-part_footer .widget .price_slider .ui-slider-handle,
.ish-part_footer .widget .search-field
{
	background-color: <?php echo '' . $ish_newdata['footer_colors']['block_bg']; ?> !important;
}

.ish-part_footer .widget .price_slider .ui-slider-handle
{
	border-color: <?php echo '' . $ish_newdata['footer_colors']['block_bg']; ?> !important;
}
<?php
}

// Block el bg active
if ( isset( $ish_newdata['footer_colors']['block_bg'] ) && '' != $ish_newdata['footer_colors']['block_bg'] ) {
?>
.ish-part_footer .widget input[type="submit"]:hover,
.ish-part_footer .widget .button:hover
{
	background-color: <?php echo ishfreelotheme_adjust_brightness( $ish_newdata['footer_colors']['block_bg'], -25 ); ?> !important;
}
<?php
}

// Block el text
if ( isset( $ish_newdata['footer_colors']['block_text'] ) && '' != $ish_newdata['footer_colors']['block_text'] ) {
?>
.ish-part_footer .widget input[type="text"],
.ish-part_footer .widget input[type="submit"],
.ish-part_footer .widget .button,
.ish-part_footer .widget .search-field
{
	color: <?php echo '' . $ish_newdata['footer_colors']['block_text']; ?> !important;
}

<?php
$prefixes = array( ':-moz-placeholder', '::-webkit-input-placeholder', '.placeholder' );
$placeholders = Array( '.ish-part_footer .widget input' );
foreach ( $placeholders as $placeholder ) {
	foreach ( $prefixes as $prefix ) {
		echo '' . $placeholder . $prefix . "{ color: rgba(" . ishfreelotheme_hex2rgb($ish_newdata['footer_colors']['block_text']) . ", 0.7); }\n";
	}
}
}
}
?>
