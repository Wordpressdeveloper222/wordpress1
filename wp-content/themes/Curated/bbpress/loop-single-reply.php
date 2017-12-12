<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-author">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php echo get_avatar( bbp_get_reply_author_id( bbp_get_reply_id() ), 60 ); ?>

		<?php bbp_reply_author_link( array('show_role' => true, 'type' => 'role' ) ); ?>

		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">

		<div class="bbp_author_name">
			<span class="bbp-author-name"><?php bbp_user_profile_link ( bbp_get_reply_author_id( bbp_get_reply_id() ) ); ?></span>
			<a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink maha-heading-font">#<?php bbp_reply_id(); ?></a>
			<?php bbp_reply_admin_links(); ?>
		</div>

		<div class="bbp-reply-date-ip">
			<span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span>

			<?php if ( bbp_is_user_keymaster( bbp_get_reply_author_id( bbp_get_reply_id() ) ) ) : ?>

				<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

				<?php echo " / "; bbp_author_ip( bbp_get_reply_id() ); ?>

				<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

			<?php endif; ?>
		</div>

		<div class="wrap-bbp-reply-content">

			<?php do_action( 'bbp_theme_before_reply_content' ); ?>

			<?php bbp_reply_content(); ?>

			<?php do_action( 'bbp_theme_after_reply_content' ); ?>

		</div>

	</div><!-- .bbp-reply-content -->

</div><!-- .reply -->
