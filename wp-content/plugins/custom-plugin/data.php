<?php

function createdb()
	{
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$sql = "CREATE TABLE  IF NOT EXISTS wp_customdata (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`task_id` int(8) NOT NULL,
		`user_id` int(8) NOT NULL,
		`text_data` text NOT NULL,
		`textarea_data` text NOT NULL,
		`checkbox_text` text NOT NULL,
		`radio_text` text NOT NULL,
		`file_text` text NOT NULL
	 )ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";
	 dbDelta($sql);    
}
function add_menu()
			{
		//		 add_menu_page("Custom Plugin", "Custom Plugin", "delete_pages", "custom_plugin_list_slug","function_operations");	 
			 //add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
			//	 $role = get_role( 'administrator' );       //	Get Role
				// $role->add_cap('wp_music_cap');      	//	Page Capabilities Here
				
			/* 	add_menu_page('Page title', 'Top-level menu title', 'manage_options', 'my-top-level-handle', 'my_magic_function');
add_submenu_page( 'my-top-level-handle', 'Page title', 'Sub-menu title', 'manage_options', 'my-submenu-handle', 'my_magic_function'); */
add_menu_page('Page title', 'Custom Plugin', 'manage_options', 'my-top-level-handle', 'my_magic_function');
	//add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
			}
			
			
function my_magic_function() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
	if(isset($_POST['save'])){
		$getid=(isset($_POST['id']))? $_POST['id'] : 0;
		do_action('save_wp_hook',$getid);
	}
	 $getid=(isset($_GET['id']))? $_GET['id'] : 0;
	do_action('my_data_addhook',$getid);
}
	
	add_action('my_data_addhook','my_data_add');
	add_action("save_wp_hook","save_data");
	function my_data_add(){
		?>
		<form method="POST">
		<input type="text" id="text" name="textdata"/>
		<input type="submit" name="save" value="Save">
		</form>
		<?php
		if(isset($_POST['save1'])){
			echo 'hi';
		}
	}
	function save_data($getid){
		 global $wpdb;
		 $insert=array(
		 'text_data'=>$_POST['textdata'],
		 );
		 if($getid==0)
        {
            $wpdb->insert("wp_customdata",$insert);
			echo "record inserted successfully";
        } 
	}