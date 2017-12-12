<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) 
	return;
?>
<form method="post" class="login woo-login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>	

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<center class="woo-section"><?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?></center>
	<div class="woo-content-fields woo-edit-center">
		<p class="form-row form-row-first validate-required">
			<label for="username"><?php _e( 'Username or email', MAHA_TEXT_DOMAIN ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="username" id="username" />
		</p>
		<p class="form-row form-row-last validate-required">
			<label for="password"><?php _e( 'Password', MAHA_TEXT_DOMAIN ); ?> <span class="required">*</span></label>
			<input class="input-text" type="password" name="password" id="password" />
		</p>
		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<p class="form-row form-nav woo-section">
			<?php wp_nonce_field( 'woocommerce-login' ); ?>			
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
			<span class="woo-remember">
				<label for="rememberme" class="inline woo-remember-lost">			
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', MAHA_TEXT_DOMAIN ); ?>			
				</label>
			</span>
			<input type="submit" id="submit-woo-login" class="button woo-button" name="login" value="<?php _e( 'Login', MAHA_TEXT_DOMAIN ); ?>" />
		</p>
		<p class="lost_password woo-remember-lost">
			<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', MAHA_TEXT_DOMAIN ); ?></a>
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form_end' ); ?>
	</div>
</form>