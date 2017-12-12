<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', MAHA_TEXT_DOMAIN ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', MAHA_TEXT_DOMAIN ) . '</a>';
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon" method="post" style="display:none">

<div class="woo-content-fields woo-edit-center">
	<p class="form-row">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', MAHA_TEXT_DOMAIN ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-nav">
		<input type="submit" class="button woo-button" name="apply_coupon" value="<?php _e( 'Apply Coupon', MAHA_TEXT_DOMAIN ); ?>" />
	</p>

	<div class="clear"></div>
</div>
</form>