<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

$maha_options = get_option('curated');

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', MAHA_TEXT_DOMAIN); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
  <!-- Block Cap -->
  <div class="row">
    <div class="col-sm-12">
      <div class="block-cap" id="comments">
        <h3 id="comment"><?php comments_number(__('No Comments',MAHA_TEXT_DOMAIN), __('One Comment', MAHA_TEXT_DOMAIN), __('% Comments', MAHA_TEXT_DOMAIN) );?></h3>
      </div>
    </div>
  </div>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ul class="comment-list">
		<?php wp_list_comments(array('avatar_size' => 100)); ?>
	</ul>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<!--<p class="nocomments">Comments are closed.</p>-->

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : 

$required_text = null;

$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => $maha_options['s_leave_reply'],
  'title_reply_to'    => $maha_options['s_leave_reply'] . __( ' to %s', MAHA_TEXT_DOMAIN ),
  'cancel_reply_link' => $maha_options['s_cancel_reply'],
  'label_submit'      => $maha_options['s_submit_reply'],

  'comment_field' =>  '<div class="row"><div class="col-sm-12"><textarea placeholder="' . __( 'Comment', MAHA_TEXT_DOMAIN ) .'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></div>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.', MAHA_TEXT_DOMAIN ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', MAHA_TEXT_DOMAIN ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '<p class="comment-notes">' .
    __( 'Your email address will not be published.', MAHA_TEXT_DOMAIN ) . ( $req ? $required_text : '' ) .
    '</p>',

  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="row"><div class="col-sm-12">'.
      '<input id="author" name="author" placeholder="' . __( 'Name (required)', MAHA_TEXT_DOMAIN ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30" /></div>',

    'email' =>
      '<div class="col-sm-12">'.
      '<input id="email" name="email" placeholder="' . __( 'Email (required)', MAHA_TEXT_DOMAIN ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30" /></div>',

    'url' =>
      '<div class="col-sm-12 col_last">'.
      '<input id="url" name="url" placeholder="' . __( 'Website', MAHA_TEXT_DOMAIN ) .'" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></div></div>'
    )
  ),
);

comment_form($args);





endif; // if you delete this the sky will fall on your head ?>