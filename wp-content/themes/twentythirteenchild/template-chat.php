<?php
/**
 * Template Name: Chat 
 * The template for displaying WordPress pages, including HTML from BuddyPress templates.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */
get_header(); 
?>
<?php

  $current_user_id =  get_current_user_id();
	if($current_user_id != ''){
		global $wpdb;
		$myrows ="SELECT DISTINCT ID ,wp_users.user_nicename
					FROM wp_users
					INNER JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id
					WHERE wp_usermeta.meta_key = 'wp_capabilities' 
					AND wp_usermeta.meta_value LIKE '%group_leader%' AND wp_users.ID NOT IN ($current_user_id) OR wp_usermeta.meta_value LIKE '%administrator%'
					AND wp_users.ID NOT IN ($current_user_id)
					ORDER BY wp_users.user_nicename";
					
		echo '<div class="user_listing" id="use_list" >';
			$mentor_rows = $wpdb->get_results($myrows,OBJECT);
			?>
			<ul class='tabs clearfix' id="chat-tabs">
			  <li><a href='#tab1'>Individuals</a></li>
                <li><a href='#tab2'>Groups</a><a href="#"><span class="plus">+</span></a></li>
			</ul>
			<ul class='tabs single_group_tabs clearfix' id="user-tabs">
			  <li><a href='#tab3'>Newest</a></li>
                <li><a href='#tab4'>Active</a></li>
                <li><a href='#tab5'>Popular</a></li>
                <li><a href='#tab6'>Alphabetical</a></li>
			</ul>
			<div id='tab6'>
				<?php 
				echo '<ul class="user_list" >';
				foreach ( $mentor_rows as $me_row ) 
				{?>
					<li id ="<?php echo $me_row->ID;?>" onclick="getmessages(<?php echo $me_row->ID;?>)" class="user-de-tails">
                <?php echo get_avatar($me_row->ID); 
                 echo '<span class="u-name">';
                 echo $me_row->user_nicename ?>
                
					<?php
                     echo'</span></li>';
				}
				echo '</ul>';
				?>
			</div>
			<div id='tab2'>
			  <p>This Tab is For Group</p>
			</div>
			<div id='tab3'>
			 <h2><script>newest_messages();</script></h2>
			</div>
			<div id='tab4'>
			 <ul><?php display_logged_in_users();	?></ul>
			</div>
			<div id='tab5'>
			 <h2>This is Popular User Tab.</h2>
			</div>
			
		
	<?php
        echo '</div>';
	}
?>
	<div class="message_listing" id="chat_content" style="float:left;	width:auto;">
		<div id="loader6" style="display:none;"> <img src="http://wethriveplatform.com/wp-content/themes/boss/images/default.gif"></div>
			<table class="message">
				<thead>
					<tr>
						<td> </td>
						<h1 id="fireHeading" align="left"></h1>
					</tr>
				</thead>
					<tbody id="table_body">
					</tbody>
			</table>
	</div>	
	<script src="https://www.gstatic.com/firebasejs/4.2.0/firebase.js"></script>
	<script>
	  // Initialize Firebase
	  var config = {
		apiKey: "AIzaSyDjTRE3GWFHG6tXvPljEvpwp2jGc9T6ndc",
		authDomain: "this-is-final-chat.firebaseapp.com",
		databaseURL: "https://this-is-final-chat.firebaseio.com",
		projectId: "this-is-final-chat",
		storageBucket: "",
		messagingSenderId: "821399572092"
	  };
	  firebase.initializeApp(config);
	</script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	
	<script>
        function getmessages(id)
        {
			$('#loader6').show();
            $.post( "<?php echo get_stylesheet_directory_uri(); ?>/chat-messages.php", { userid:id })
			.done(function( data ) {				
				$("#chat_content").html(data);			
			}); 
        }
		$('ul.tabs').each(function(){
			  var $active, $content, $links = $(this).find('a');
			  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
			  $active.addClass('active');

			  $content = $($active[0].hash);
			  $links.not($active).each(function () {
				$(this.hash).hide();
			});
		$(this).on('click', 'a', function(e){
			$active.removeClass('active');
			$content.hide();

			$active = $(this);
			$content = $(this.hash);
			$active.addClass('active');
			$content.show();
			e.preventDefault();
		});
	});
	</script> 
	<script> 
		$(document).keypress(function(e) {
			if(e.which == 13){
				$('#submitBtn').click();
				$('#mainText').val('');
				  $("tr:last").focus();				  
		   }
		});
</script> 
<?php get_footer(); ?>
