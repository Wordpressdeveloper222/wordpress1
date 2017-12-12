<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<ul id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<div class="maha-wrap-avatar">
		<div class="maha-topic-avatar">
			<?php echo get_avatar( bbp_get_topic_author_id( bbp_get_topic_id() ), 60 ); ?>
			<?php echo get_avatar( bbp_get_topic_author_id( bbp_get_topic_last_active_id() ), 25 ); ?>
		</div>
	</div>

	<li class="bbp-topic-title">

		<?php do_action( 'bbp_theme_before_topic_title' ); ?>

		<a class="bbp-topic-permalink maha-heading-font" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>

		<?php do_action( 'bbp_theme_after_topic_title' ); ?>

		<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

		<p class="bbp-topic-meta">

			<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>

			<span class="bbp-topic-started-by"><?php printf( __( 'Started by: %1$s', 'bbpress' ), bbp_get_user_profile_link( bbp_get_topic_author_id() ) ); ?></span>

			<?php do_action( 'bbp_theme_after_topic_started_by' ); ?>

			<?php if ( !bbp_is_single_forum() || ( bbp_get_topic_forum_id() !== bbp_get_forum_id() ) ) : ?>

				<?php do_action( 'bbp_theme_before_topic_started_in' ); ?>

				<span class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span>

				<?php do_action( 'bbp_theme_after_topic_started_in' ); ?>

			<?php endif; ?>

		</p>

		<?php do_action( 'bbp_theme_after_topic_meta' ); ?>

		<div class="maha-freshness">

			<p class="bbp-topic-meta">

				<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>

				<span class="bbp-topic-freshness-author">Last reply by <?php bbp_user_profile_link( bbp_get_topic_author_id( bbp_get_topic_last_active_id() ) ); ?></span>

				<?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>

			</p>

			<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>

			<?php bbp_topic_freshness_link(); ?>

			<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>

		</div>

		<?php bbp_topic_pagination(); ?>

		<?php if ( bbp_is_user_home() ) : ?>

			<?php if ( bbp_is_favorites() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

					<?php bbp_topic_favorite_link( array( 'before' => '', 'favorite' => 'favorite', 'favorited' => 'favorited' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

				</span>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

					<?php bbp_topic_subscription_link( array( 'before' => '', 'subscribe' => 'subscribe', 'unsubscribe' => 'unsubscribe' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

				</span>

			<?php endif; ?>

		<?php endif; ?>

		<?php bbp_topic_row_actions(); ?>

	</li>

	<li class="bbp-topic-post"><?php bbp_topic_post_count(); ?></li>

	

</ul><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
