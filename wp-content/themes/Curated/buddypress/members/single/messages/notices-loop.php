<?php do_action( 'bp_before_notices_loop' ); ?>

<?php if ( bp_has_message_threads() ) : ?>

	<div class="pagination no-ajax" id="user-pag">

		<h2 class="notif-count">
			<?php global $messages_template; echo bp_core_number_format( $messages_template->total_thread_count ).' messages'; ?>
		</h2>

		<div class="pagination-links" id="messages-dir-pag">
			<?php bp_messages_pagination(); ?>
		</div>

	</div><!-- .pagination -->

	<?php do_action( 'bp_after_notices_pagination' ); ?>
	<?php do_action( 'bp_before_notices' ); ?>

	<table id="message-threads" class="messages-notices">
		<?php while ( bp_message_threads() ) : bp_message_thread(); ?>
			<tr id="notice-<?php bp_message_notice_id(); ?>" class="<?php bp_message_css_class(); ?>">
				<td width="1%"></td>
				<td width="38%">
					<strong><?php bp_message_notice_subject(); ?></strong>
					<?php bp_message_notice_text(); ?>
				</td>
				<td width="21%" align="right">

					<?php if ( bp_messages_is_active_notice() ) : ?>

						<strong><?php bp_messages_is_active_notice(); ?></strong>

					<?php endif; ?>

					<span class="activity"><?php _e( '', 'buddypress' ); ?> <?php bp_message_notice_post_date(); ?></span>
				</td>

				<?php do_action( 'bp_notices_list_item' ); ?>

				<td width="20%" align="right">
					<a class="button deactive" href="<?php bp_message_activate_deactivate_link(); ?>" class="confirm"><?php bp_message_activate_deactivate_text(); ?></a>
					<a class="button delete" href="<?php bp_message_notice_delete_link(); ?>" class="confirm" title="<?php esc_attr_e( "Delete Message", "buddypress" ); ?>">delete</a>
				</td>
			</tr>
		<?php endwhile; ?>
	</table><!-- #message-threads -->

	<?php do_action( 'bp_after_notices' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, no notices were found.', 'buddypress' ); ?></p>
	</div>

<?php endif;?>

<?php do_action( 'bp_after_notices_loop' ); ?>