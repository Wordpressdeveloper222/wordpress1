<?php

/**
 * Search Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-author">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php echo get_avatar( bbp_get_reply_author_id( bbp_get_reply_id() ), 60 ); ?>

		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">

		<div class="maha_bbp_author_name">
			<?php echo "Reply by "; bbp_user_profile_link ( bbp_get_reply_author_id( bbp_get_reply_id() ) ); ?>
			<a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink maha-heading-font">#<?php bbp_reply_id(); ?></a>
		</div>

		<div class="bbp-reply-title">
			<h3><?php _e( 'In reply to: ', 'bbpress' ); ?>
			<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a></h3>
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
