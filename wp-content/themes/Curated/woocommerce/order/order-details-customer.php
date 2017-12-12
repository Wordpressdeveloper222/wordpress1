<?php
/**
 * Order Customer Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="row woo-customer-detail">
	
	<div class="col-sm-4 woo-respon-element">
		<header>
			<h2 class="woo-center"><?php _e( 'Customer details', MAHA_TEXT_DOMAIN ); ?></h2>
		</header>
		<dl class="customer_details">
		<?php
			if ( $order->billing_email ) echo '<dt>' . __( 'Email:', MAHA_TEXT_DOMAIN ) . '</dt><dd>' . $order->billing_email . '</dd>';
			if ( $order->billing_phone ) echo '<dt>' . __( 'Telephone:', MAHA_TEXT_DOMAIN ) . '</dt><dd>' . $order->billing_phone . '</dd>';

			// Additional customer details hook
			do_action( 'woocommerce_order_details_after_customer_details', $order );
		?>
		</dl>
	</div>

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

	<div class="col-sm-4 woo-respon-element">

	<?php endif; ?>

		<header class="title">
			<h3 class="woo-center"><?php _e( 'Billing Address', MAHA_TEXT_DOMAIN ); ?></h3>
		</header>
		<address>
		<p>
			<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'MAHA_TEXT_DOMAIN' ); ?>
		</p>
		</address>

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

	</div><!-- /.col-1 -->

	<div class="col-sm-4">

		<header class="title">
			<h3 class="woo-center"><?php _e( 'Shipping Address', MAHA_TEXT_DOMAIN ); ?></h3>
		</header>
		<address>
		<p>
			<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'MAHA_TEXT_DOMAIN' ); ?>
		</p>
		</address>

	</div>

	<?php endif; ?>

</div>