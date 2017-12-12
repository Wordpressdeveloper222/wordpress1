<?php
/**
 * Provides a notification everytime the theme is updated
 * Original code courtesy of João Araújo of Unisphere Design - http://themeforest.net/user/unisphere
 */

function maha_is_connected()
{
    $connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}

function maha_update_notifier_menu() {  
	$connect=maha_is_connected();
	if($connect==true){
		$xml = maha_get_latest_theme_version(0);
		$theme_data = wp_get_theme();
		if(is_object($xml)){
			if(version_compare($theme_data['Version'], $xml->latest) == -1) {
				add_action('admin_notices', 'maha_my_admin_notice');
			}
		}
	}
}  

function maha_my_admin_notice(){
	$xml = maha_get_latest_theme_version(86400);
	$theme_data = wp_get_theme(); 
    echo "<div class='updated error'>
       <p><strong>There is a new version of the $theme_data[Name] theme available.</strong> You have version $theme_data[Version] installed. Update to version $xml->latest.</p>
    </div>";
    echo "<div class='updatesneed' data-root='$theme_data->stylesheet'></div>";
}

if(!is_child_theme()){
	add_action('admin_menu', 'maha_update_notifier_menu');
}

function maha_get_latest_theme_version($interval) {
	$notifier_file_url = 'http://www.thememaha.com/curated/changelog/log.xml';
	$db_cache_field = 'contempo-notifier-cache';
	$db_cache_field_last_updated = 'contempo-notifier-last-updated';
	$last = get_option( $db_cache_field_last_updated );
    $now = time();
    if ( !$last || (( $now - $last ) > $interval) ) {
		if( function_exists('curl_init') ) {
			$ch = curl_init($notifier_file_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$cache = curl_exec($ch);
			curl_close($ch);
			if ($cache) {			
				update_option( $db_cache_field, $cache );	
				update_option( $db_cache_field_last_updated, time() );
			}
		} else {
			$cache = new SimpleXMLElement($notifier_file_url, NULL, TRUE); 
			if ($cache->asXML()) {			
				update_option( $db_cache_field, $cache->asXML() );	
				update_option( $db_cache_field_last_updated, time() );
			}
		}
				
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		$notifier_data = get_option( $db_cache_field );
	}

	$xml = simplexml_load_string($notifier_data); 
	return $xml;
}

?>