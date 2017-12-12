<?php
	include("../../../wp-config.php");
	$user= $_POST['userid'];
	$userdata= get_userdata( $user );
	echo '<div class="user_info">';
		echo get_avatar($user);
		echo '<span class="user_name">';
			foreach($userdata as $u_data)
			{
				echo $u_data->user_login;
			}
		echo '</span>';
		 $user_id = $user;
		$key = 'pmpro_logins';
		$single = true;
		$user_last = get_user_meta( $user_id, $key, $single ); 
		// echo '<pre>';print_r ($user_last);
		if(!is_array($user_last)){
				echo '<span class="last_logtime">&nbsp;&nbsp; Never</span>';
		}
		$current_user_id = get_current_user_id();
		$logged_in_users = get_transient('online_status');
		if ( !empty( $logged_in_users ) ) {
			foreach ( $logged_in_users as $key => $value) {
				if($key != $current_user_id){
					$u_data = get_user_by( 'id', $key );
					
					// foreach ($user as $usr){
						if($u_data->ID == $user){
							echo '<span class="last_logtime">&nbsp;&nbsp; Online</span>';
							// break;
						}
						else{
							echo '<span class="last_logtime">'.$user_last[last].'</span>';							
						}
					// }
				}				
			}
		}
		
		
	echo '</div>';
?>
 
<script>
	<?php $current_user_id =  get_current_user_id();?>
	var receivermsg_id = <?php echo $user;?>;
		document.getElementById("receiver_id").setAttribute('value',receivermsg_id);
	var receiver_value = (document.getElementById("receiver_id").value);
	var receiver_name = jQuery(this).text();
	var sendermsg_id = "<?php echo $current_user_id ;?>";
		document.getElementById("sender_id").setAttribute('value',sendermsg_id);
	var sender_value = (document.getElementById("sender_id").value);
	var userRef = firebase.database().ref('Chat_table');
	
	
		userRef.on('child_added',snap=>{
			var Message_txt= snap.child("Message_body").val();
			var Sender_id= snap.child("Sender_id").val();
			var Receiver_id= snap.child("Receiver_id").val();
			var DateTime= snap.child("DateTime").val();
				if(Sender_id == sendermsg_id){
					if((Sender_id == sender_value && Receiver_id == receiver_value) || (sender_value == Receiver_id && Sender_id == receiver_value)){
						$('#table_body').append("<tr class='snder-msgs clearfix'><td class='msg_sender'><span class='abc'>" + Message_txt +'</span><?php
							echo get_avatar($current_user_id);?>' +"</td><td class='snder-side-date'>"+DateTime+"</td></tr>")
					}
				}
				else{
					if((Sender_id == sender_value && Receiver_id == receiver_value) || (sender_value == Receiver_id && Sender_id == receiver_value)){
						$('#table_body').append("<tr class='rcivr-msgs clearfix'><td class='msg_receiver'><span class='cba'>"+ Message_txt + '</span><?php
							echo get_avatar($user);?>' +"</td><td class='rcivr-side-date'>"+DateTime+"</td></tr>")				
					}
				}
		});
	$('#loader6').hide();
	function submitClick(){
		<?php 
		// date_default_timezone_set('Asia/Kolkata');
		$current_user_id =  get_current_user_id();
        ?>
		var receiver_name = jQuery(this).text();
		var Sender_id = "<?php echo $current_user_id ;?>";
		var receiver_id = <?php echo $user;?>;
		var currentTime = new Date()
            var hours = currentTime.getHours()
            var minutes = currentTime.getMinutes()

            if (minutes < 10)
                minutes = "0" + minutes;
            var suffix = "AM";
            if (hours >= 12) {
                suffix = "PM";
                hours = hours - 12;
            }
            if (hours == 0) {
                hours = 12;
            }
        var current_time = hours + ":" + minutes + " " + suffix;
            // var current_time = hours + ":" + minutes + " " + suffix;
		var DateTime = current_time;
		var Message_body =(document.getElementById("mainText").value);
		var submitBtn =document.getElementById("submitBtn");
		if( Message_body != ''){
			firebase.database().ref('Chat_table').push().set({
				Message_body: Message_body,
				Receiver_id : receiver_id,
				Sender_id	: Sender_id,
				DateTime	: current_time
				});
		}	
		 
		$('#mainText').val('');		
		$('tr:last').focus();
	}
	function newest_messages(){
		alert('hii');
		var ref = new Firebase('Chat_table');
		ref.orderByChild('timestamp').startAt(Date.now()).on('child_added', function(snapshot) {
		  console.log('new record', snap.key());
		});
	}
	

</script>


<div class="message_listing1" id="chat_content" style="float:left;	width:auto;">
	
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
	<div class="msg-box">
	<textarea id="mainText" placeholder="Type Something..."></textarea>
		 <input type='hidden' id='receiver_id'>
		 <input type='hidden' id='sender_id'>
		<button id="submitBtn" onclick="submitClick()"><i class="fa fa-arrow-right" aria-hidden="true">Submit</i></button>		
    </div>
	
	
</div>	
<script>
	$(document).ready(function(){
		$("#mainText").keypress(function(event){
			if(event.which == 13){
				  $('#submitBtn').click();
				  $("tr:last").focus();
		   }
		});
	});
</script>
