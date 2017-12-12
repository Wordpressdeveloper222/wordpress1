<?php
/*
Plugin Name: Custom Plugin
Description: My Custom Plugin
Version: 1.0
Author: -
Author URI: 
Plugin URI: 
*/
 include_once 'data.php';
register_activation_hook( __FILE__, 'createdb' );
    add_action('admin_menu','add_menu');
?>