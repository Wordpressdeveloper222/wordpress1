<?php
/* 
		Plugin Name:Music
		Version: 1.0
		Plugin URI: http://myownplugin.in
		Author: Webindia inc
		Author URI: http://myownplugin.in
		Description: Music Description
*/ 

 include_once 'music_function.php';

 register_activation_hook( __FILE__, 'createdatabase' );
    add_action('admin_menu','addmenu');
?>
