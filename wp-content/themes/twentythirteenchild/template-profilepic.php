<?php
/**
* Template Name: User Page
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

get_header(); ?>

<div id='main-content'>

<?php echo do_shortcode('[basic-user-avatars]'); ?>
 
<form name='artist_basic_profile' id='artist_basic_profile' action='' method='post' enctype='multipart/form-data'>

<?php// if($current_user_id){ ?>
<!--input type='file' id='userProfileImage' name='userProfileImage' >
<input id='submit' type='submit' name='submit' value='Save' -->
<?php// } ?>
</form>
</div>
</div>
</div>

<?php


