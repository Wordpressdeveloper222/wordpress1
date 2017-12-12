<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;
?>
<div class="woo-maha">
<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

	<div class="tracking-message">
		<p><?php _e( 'To track your order please enter your Order ID in the box below and press return.', MAHA_TEXT_DOMAIN ); ?></p>
		<p><?php _e( 'This was given to you on your receipt and in the confirmation email you should have received.', MAHA_TEXT_DOMAIN ); ?></p>
	</div>

	<div class="woo-edit-center">
	<p class="form-row form-row-first"><label for="orderid"><?php _e( 'Order ID', MAHA_TEXT_DOMAIN ); ?><abbr class="required" title="required"> *</abbr></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your order confirmation email.', MAHA_TEXT_DOMAIN ); ?>" /></p>
	<p class="form-row form-row-last"><label for="order_email"><?php _e( 'Billing Email', MAHA_TEXT_DOMAIN ); ?><abbr class="required" title="required"> *</abbr></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during checkout.', MAHA_TEXT_DOMAIN ); ?>" /></p>
	<div class="clear"></div>

	<p class="form-row"><input type="submit" class="button" name="track" value="<?php _e( 'Track', MAHA_TEXT_DOMAIN ); ?>" /></p>
	</div>
	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

</form>
</div>