<?php

/**
 * Search Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="post-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<div class="bbp-reply-author">

		<?php echo get_avatar( bbp_get_forum_author_id( bbp_get_forum_id() ), 60 ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">

		<div class="maha_bbp_author_name">
			<?php echo "Forum by "; bbp_user_profile_link( bbp_get_forum_author_id( bbp_get_forum_id() ) ); ?>
			<a href="<?php bbp_forum_permalink(); ?>" class="bbp-reply-permalink maha-heading-font">#<?php bbp_forum_id(); ?></a>
		</div>

		<div class="bbp-reply-title">
			<h3><?php _e( 'Forum: ', 'bbpress' ); ?><a href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a></h3>
		</div>

		<div class="bbp-reply-date-ip">
			<span class="bbp-reply-post-date"><?php printf( __( 'Last updated %s', 'bbpress' ), bbp_get_forum_last_active_time() ); ?></span>

			<?php if ( bbp_is_user_keymaster( bbp_get_forum_author_id( bbp_get_forum_id() ) ) ) : ?>

				<?php echo " / "; bbp_author_ip( bbp_get_forum_id() ); ?>

			<?php endif; ?>
		</div>

		<div class="wrap-bbp-reply-content">

			<?php do_action( 'bbp_theme_before_reply_content' ); ?>

			<?php bbp_forum_content(); ?>

			<?php do_action( 'bbp_theme_after_reply_content' ); ?>

		</div>

	</div><!-- .bbp-reply-content -->

</div><!-- .reply -->