s<?php
/**
 * Edit address form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $current_user;

$page_title = ( $load_address === 'billing' ) ? __( 'Billing Address', MAHA_TEXT_DOMAIN ) : __( 'Shipping Address', MAHA_TEXT_DOMAIN );

get_currentuserinfo();
?>

<?php wc_print_notices(); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>
	<div class="woo-maha">
		<form method="post">
				<div class="woo-content-fields woo-edit-center">
					<h3 class="woo-center"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>

					<?php foreach ( $address as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

				<?php endforeach; ?>

				<p>
					<input type="submit" class="button woo-button" name="save_address" value="<?php _e( 'Save Address', MAHA_TEXT_DOMAIN ); ?>" />
					<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
					<input type="hidden" name="action" value="edit_address" />
				</p>
			</div>
		</form>
	</div>
<?php endif; ?>