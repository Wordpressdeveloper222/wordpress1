<?php
/**
 * My Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Addresses', MAHA_TEXT_DOMAIN ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing Address', MAHA_TEXT_DOMAIN ),
		'shipping' => __( 'Shipping Address', MAHA_TEXT_DOMAIN )
	), $customer_id );
} else {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', MAHA_TEXT_DOMAIN ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  __( 'Billing Address', MAHA_TEXT_DOMAIN )
	), $customer_id );
}

$col = 1;
?>
<div id="woo-my-address">
<div class="woo-element">
	<h2 class="woo-center"><?php echo $page_title; ?></h2>
	<p class="myaccount_address woo-center">
		<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', MAHA_TEXT_DOMAIN ) ); ?>
	</p>
</div>

<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) echo '<div class="col2-set addresses row">'; ?>

<?php foreach ( $get_addresses as $name => $title ) : ?>

	<div class="col-<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2;  echo ( $col < 1 ) ? ' woo-respon-element' : ''; ?> address col-sm-6">
		<header class="title woo-center">
			<h3 class="woo-center"><?php echo $title; ?></h3>
			<a href="<?php echo wc_get_endpoint_url( 'edit-address', $name ); ?>" class="edit"><?php _e( 'Edit', MAHA_TEXT_DOMAIN ); ?></a>
		</header>
		<address>
			<?php
				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
					'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
					'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
					'company'     => get_user_meta( $customer_id, $name . '_company', true ),
					'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
					'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
					'city'        => get_user_meta( $customer_id, $name . '_city', true ),
					'state'       => get_user_meta( $customer_id, $name . '_state', true ),
					'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
					'country'     => get_user_meta( $customer_id, $name . '_country', true )
				), $customer_id, $name );

				$formatted_address = WC()->countries->get_formatted_address( $address );

				if ( ! $formatted_address )
					_e( 'You have not set up this type of address yet.', MAHA_TEXT_DOMAIN );
				else
					echo $formatted_address;
			?>
		</address>
	</div>

<?php endforeach; ?>
</div>
<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) echo '</div>'; ?>
