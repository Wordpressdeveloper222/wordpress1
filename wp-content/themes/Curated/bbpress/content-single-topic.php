<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">

	<?php do_action( 'bbp_template_before_single_topic' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		<header>
			<h1 itemprop="name" class="entry-title"><?php bbp_topic_title(); ?></h1>
			<div class="title-divider"></div>
			<?php maha_crtd_share( $post->ID ); ?>
			<div class="maha-bbp-tag maha-heading-font">
			<?php
				bbp_topic_favorite_link();

				$topic_tag = bbp_get_topic_tag_list();
				$args = array( 'before' => ' / ' );
				if ( !empty( $topic_tag )) {
					$args['after'] = ' / ';
				}

				bbp_topic_subscription_link( $args );

				echo $topic_tag;
			?>
			</div>
		</header>

		<?php if ( bbp_show_lead_topic() ) : ?>

			<?php bbp_get_template_part( 'content', 'single-topic-lead' ); ?>

		<?php endif; ?>

		<?php if ( bbp_has_replies() ) : ?>

			<?php bbp_get_template_part( 'loop',       'replies' ); ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

		<?php endif; ?>

		<?php bbp_get_template_part( 'form', 'reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_topic' ); ?>

</div>
