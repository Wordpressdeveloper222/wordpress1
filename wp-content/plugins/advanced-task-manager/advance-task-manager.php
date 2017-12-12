<?php /**
 * @package Task Manager
 */
/*
Plugin Name: Advance Task Manager
Plugin URI: www.webindiainc.com
Description: Coming Soon
Version: 3.2
Author: Pratik Bhatt

*/
register_activation_hook( __FILE__, 'my_plugin_create_db' );
function my_plugin_create_db() {

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'task_data';
$table_name1 = $wpdb->prefix . 'save_status';
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		`task_id` int(8) NOT NULL,
		`user_id` int(8) NOT NULL,
		`text_data` text NOT NULL,
		`textarea_data` text NOT NULL,
		`checkbox_text` text NOT NULL,
		`radio_text` text NOT NULL,
		`file_text` text NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	$sql2 = "CREATE TABLE $table_name1 (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		`task_id` int(8) NOT NULL,
		`user_id` int(8) NOT NULL,
		`task_status` char(1) default 0,
		UNIQUE KEY id (id)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	dbDelta( $sql2 );
}
include_once('front.php');
function wporg_custom_post_type()
{
    register_post_type('task',
                       [
                           'labels'      => [
                               'name'          => __('Tasks'),
                               'singular_name' => __('Task'),
                           ],
                           'public'      => true,
                           'has_archive' => true,
						   'show_in_menu'        => true,
							'show_in_nav_menus'   => true,
							'show_in_admin_bar'   => true,
                       ]
    );
	add_action( 'add_meta_boxes', 'add_task_metaboxes' );
	// Add the Events Meta Boxes

function add_task_metaboxes() {
	add_meta_box('task_file_type', 'Choose Input Type', 'task_input','task','normal', 'high');
	add_meta_box('frontend_data', 'Data filled for this task', 'task_data', 'task', 'normal');
	
}
function task_data(){
 
    
        global $wpdb;
		//$task_id=$_POST['id'];
         
        $result = $wpdb->get_results ( "SELECT * FROM wp_task_data WHERE task_id = '". get_the_ID()."'");

		
		?>
		
		<table border="1">
		<tr>
		<th>Id</th>
		<th>user name</th>
		<th>task data</th>
		<th>Description</th>
		<th>checkbox text</th>
		<th>radio text</th>
		<th>file text</th>
		</tr>	<?php
        foreach ( $result as $display )   {
		$userid= $display->id;
		$sel ="SELECT guid FROM wp_posts WHERE ID = '".$userid."'";
				$rw = $wpdb->get_row($sel,OBJECT);
				$guid = $rw->guid;
				$current_user = wp_get_current_user();
            ?>
			<tr>
			<td><?php echo $userid;?></td>
			<td><?php echo $current_user->display_name;?></td>
			<td><?php echo $display->text_data;?></td>
			<td><?php echo $display->textarea_data;?></td>
			<td><?php echo $display->checkbox_text;?></td>
			<td><?php echo $display->radio_text;?></td>
			<td> <a href="<?php  echo $display->file_text; ?>" target="_blank"><?php $GetImage= $display->file_text; $Expolde=explode('01/',$GetImage);echo $Expolde[1];?></a></td>
</tr>			<?php
            }
     ?>
	 </table>
	 <?php



}
	function task_input()
	{	global $post;
	
	?>
	
	<?php
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="typemeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	
	$textbox = get_post_meta($post->ID, '_text', true);
	$upload = get_post_meta($post->ID, '_upload', true);
	$textarea = get_post_meta($post->ID, '_ta', true);
	$checkbox = get_post_meta($post->ID, '_checkbox', true);
	$radio = get_post_meta($post->ID, '_radio', true);
	// Echo out the field
	if($textbox=="Yes")
	{
		echo '<input type="checkbox" name="_textbox" Value="Yes" checked> Text Box<br>';
	}
	else
	{
		echo '<input type="checkbox" name="_textbox" Value="Yes" > Text Box <br>';
	}
	if($upload=="Yes")
	{
		echo '<input type="checkbox" name="_upload" Value="Yes" checked> File Upload <br>';
	}
	else
	{
		echo '<input type="checkbox" name="_upload" Value="Yes" >  File Upload <br>';
	}
	if($textarea=="Yes")
	{
		echo '<input type="checkbox" name="_ta" Value="Yes" checked> Text Area <br>';
	}
	else
	{
		echo '<input type="checkbox" name="_ta" Value="Yes" >  Text Area <br>';
	}
	if($checkbox=="Yes")
	{
		echo '<input type="checkbox" name="_checkbox" Value="Yes" checked> Check Boxes <br>';
		?>Name :<input type="text" name="AddText" Value="<?php echo $post->_UpcheckboxText;?>" > <br><?php
		?>Value :<input type="text" name="AddTextVal" Value="<?php echo $post->_Upcheckbox;?>" > <br><?php 
	}
	else
	{
		echo '<input type="checkbox" name="_checkbox" Value="Yes" >  Check Boxes <br>';
		echo 'Name :<input type="text" name="AddText" Value="" > <br>';
		echo 'Value :<input type="text" name="AddTextVal" Value="" > <br>';
	}
	if($radio=="Yes")
	{
		echo '<input type="checkbox" name="_radio" Value="Yes" checked> Radio Button <br>';
		?> Name :<input type="text" name="AddRad" Value="<?php echo $post->_UpradioText;?>" > <br><?php
		?>Value :<input type="text" name="AddRadVal" Value="<?php echo $post->_Upradio;?>" > <br><?php
	}
	else
	{
		echo '<input type="checkbox" name="_radio" Value="Yes" >  Radio Button <br>';
		echo 'Name :<input type="text" name="AddRad" Value="" > <br>';
		echo 'Value :<input type="text" name="AddRadVal" Value="" > <br>';
	}
	
	//
	 
	}
}
add_action('init', 'wporg_custom_post_type');

// function to save meta
// Save the Metabox Data

function wpt_save_type_meta($post_id, $post) {
	
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['typemeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	
	$task_meta['_text'] = $_POST['_textbox'];
	$task_meta['_upload'] = $_POST['_upload'];
	$task_meta['_ta'] = $_POST['_ta'];
	$task_meta['_checkbox'] = $_POST['_checkbox'];
	$task_meta['_UpcheckboxText'] = $_POST['AddText'];
	$task_meta['_Upcheckbox'] = $_POST['AddTextVal'];
	$task_meta['_radio'] = $_POST['_radio'];
	$task_meta['_UpradioText'] = $_POST['AddRad'];
	$task_meta['_Upradio'] = $_POST['AddRadVal'];
	if($textbox=="Yes")
	{
		echo '<input type="checkbox" name="_textbox" value="Yes" checked/> Text Box';
	}
	else
	{
	echo '<input type="checkbox" name="_textbox" value="Yes"/> Text Box';
	}
	
	//
	if($textbox=="Yes")
	{
		echo '<input type="checkbox" name="_textbox" value="Yes" checked/> Text Box';
	}
	else
	{
		echo '<input type="checkbox" name="_textbox" value="Yes"/> Text Box';
	}
	
	// Add values of $events_meta as custom fields
	
	foreach ($task_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}
	

}

add_action('save_post', 'wpt_save_type_meta', 1, 2); // save the custom fields

// function ends here

function my_scripts() {
wp_enqueue_script( 'jquery' );
wp_register_style( 'prefix-style', plugins_url('css/style.css', __FILE__) );
wp_enqueue_style( 'prefix-style' );
wp_enqueue_script('newscript',plugins_url( 'js/script.js' , __FILE__ ),array( 'jquery' )); //replace myscript.js with your script file name

}
add_action('wp_enqueue_scripts','my_scripts');
//code to upload file throu
?>	