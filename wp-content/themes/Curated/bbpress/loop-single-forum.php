<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<li class="bbp-forum-info">

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<a class="bbp-forum-title maha-heading-font" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

		<?php
		$forum_content = bbp_get_forum_content( bbp_get_forum_id() );
		if ( !empty( $forum_content )) { ?>
			<?php do_action( 'bbp_theme_before_forum_description' ); ?>
			<div class="bbp-forum-content"><?php echo bbp_get_forum_content( bbp_get_forum_id() ); ?></div>
			<?php do_action( 'bbp_theme_after_forum_description' );
		} ?>
		

		<!-- Freshness -->
		<div class="maha-freshness">

			<?php _e( 'Freshness', 'bbpress' ); echo " : "; ?>

			<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>

			<?php bbp_forum_freshness_link(); ?>

			<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>

			<p class="bbp-topic-meta">

				<?php do_action( 'bbp_theme_before_topic_author' ); ?>

				<span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'size' => 14 ) ); ?></span>

				<?php do_action( 'bbp_theme_after_topic_author' ); ?>

			</p>
		</div>

		<?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

			<span class="bbp-row-actions">

				<?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>

				<?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => 'subscribe', 'unsubscribe' => 'unsubscribe' ) ); ?>

				<?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>
		
		<!-- End -->

		<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>

		<?php custom_bbp_list_forums(); ?>

		<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

		<?php bbp_forum_row_actions(); ?>

	</li>

	<li class="bbp-forum-topic-reply">
		<?php bbp_forum_topic_count(); echo " "; _e( 'Topics', 'bbpress' ); ?><br>
		<?php bbp_forum_reply_count(); echo " "; _e( 'Replies', 'bbpress' ); ?>
	</li>

</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->
