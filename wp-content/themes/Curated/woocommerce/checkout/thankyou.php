<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?><div class="woo-maha"><?php

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', MAHA_TEXT_DOMAIN ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', MAHA_TEXT_DOMAIN );
			else
				_e( 'Please attempt your purchase again.', MAHA_TEXT_DOMAIN );
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', MAHA_TEXT_DOMAIN ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', MAHA_TEXT_DOMAIN ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<p><?php _e( 'Thank you. Your order has been received.', MAHA_TEXT_DOMAIN ); ?></p>

		<ul class="order_details woo-element">
			<li class="order">
				<?php _e( 'Order:', MAHA_TEXT_DOMAIN ); ?>
				<strong><?php echo $order->get_order_number(); ?></strong>
			</li>
			<li class="date">
				<?php _e( 'Date:', MAHA_TEXT_DOMAIN ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="total">
				<?php _e( 'Total:', MAHA_TEXT_DOMAIN ); ?>
				<strong><?php echo $order->get_formatted_order_total(); ?></strong>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<?php _e( 'Payment method:', MAHA_TEXT_DOMAIN ); ?>
				<strong><?php echo $order->payment_method_title; ?></strong>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clear"></div>

	<?php endif; ?>

	<div class="payment-method woo-element">
		<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	</div>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p><?php _e( 'Thank you. Your order has been received.', MAHA_TEXT_DOMAIN ); ?></p>

<?php endif; ?>
</div>