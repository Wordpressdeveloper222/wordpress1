<?php
include_once('../../../../wp-config.php');
global $wpdb;
//$userid = get_current_user_id();
$table_name = $wpdb->prefix . 'save_status'; 

$user_id=$_POST['f0'];
$task_id=$_POST['f1'];
$task_status=$_POST['f2'];
$wpdb->insert( $table_name, array( 'user_id' => $user_id, 'task_id' => $task_id, 'task_status' =>$task_status, ) );
echo "Task inserted successfully!";	

	
		
		
		
	

	
	?>