<?php
include_once('../../../../wp-config.php');
global $wpdb;

$table_name = 'wp_task_data';	
$task_id=$_POST['f0'];
$text_data=$_POST['f1'];
$userid = get_current_user_id();
$textarea_data=$_POST['f2'];
$checkbox_text=$_POST['f3'];
$radio_data=$_POST['f4'];
$file_text_data=$_POST['f5'];



if($wpdb->insert( $table_name, array( 'task_id' => $task_id, 'user_id' =>$userid, 'text_data' =>$text_data, 'textarea_data' => $textarea_data,  'checkbox_text' =>$checkbox_text, 'radio_text' => $radio_data,'file_text' => $file_text_data, ) ))
{
echo "Task inserted successfully!";	
}
else
{echo"Cannot insert task";}
?>
