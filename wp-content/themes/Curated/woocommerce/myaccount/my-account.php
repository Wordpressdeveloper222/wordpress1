<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_print_notices(); ?>
<div class="wrapper woo-maha">
<p class="myaccount_user woo-element">
	<?php echo get_avatar( get_current_user_id(), 100 ); ?>
	<?php
	printf(
		__( '<span><strong>Hello %1$s,</strong> (not %1$s? <a href="%2$s">Sign out</a>)</span>', MAHA_TEXT_DOMAIN ) . ' ',
		$current_user->display_name,
		wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )
	);

	printf( __( 'From your account dashboard you can view your recent orders,<br> manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', MAHA_TEXT_DOMAIN ),
		wc_customer_edit_account_url()
	);
	?>
</p>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>

</div>
