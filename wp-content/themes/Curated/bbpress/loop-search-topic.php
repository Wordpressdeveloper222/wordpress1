<?php

/**
 * Search Loop - Single Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="post-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<div class="bbp-reply-author">

		<?php echo get_avatar( bbp_get_topic_author_id( bbp_get_topic_id() ), 60 ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="bbp-reply-content">

		<div class="maha_bbp_author_name">
			<?php echo "Topic by "; bbp_user_profile_link( bbp_get_topic_author_id( bbp_get_topic_id() ) ); ?>
			<a href="<?php bbp_topic_permalink(); ?>" class="bbp-reply-permalink maha-heading-font">#<?php bbp_topic_id(); ?></a>
		</div>

		<div class="bbp-reply-title">
			<h3><?php _e( 'Topic: ', 'bbpress' ); ?>
			<a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>


			<?php if ( function_exists( 'bbp_is_forum_group_forum' ) && bbp_is_forum_group_forum( bbp_get_topic_forum_id() ) ) : ?>

				<?php _e( 'in group forum ', 'bbpress' ); ?>

			<?php else : ?>

				<?php _e( 'in forum ', 'bbpress' ); ?>

			<?php endif; ?>

			<a href="<?php bbp_forum_permalink( bbp_get_topic_forum_id() ); ?>"><?php bbp_forum_title( bbp_get_topic_forum_id() ); ?></a>

		</h3>
		</div>

		<div class="bbp-reply-date-ip">
			<span class="bbp-reply-post-date"><?php bbp_topic_post_date( bbp_get_topic_id() ); ?></span>

			<?php if ( bbp_is_user_keymaster() ) : ?>

				<?php echo " / "; bbp_author_ip( bbp_get_topic_id() ); ?>

			<?php endif; ?>
		</div>

		<div class="wrap-bbp-reply-content">

			<?php do_action( 'bbp_theme_before_reply_content' ); ?>

			<?php bbp_topic_content(); ?>

			<?php do_action( 'bbp_theme_after_reply_content' ); ?>

		</div>

	</div><!-- .bbp-reply-content -->

</div><!-- .reply -->