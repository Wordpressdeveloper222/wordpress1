<div class="sidebar">
<?php
	$the_sidebar = 'Main Sidebar';

	if ( is_single() ) {
		if (get_field( 'single_sidebar_source' ) != '' ){
			$the_sidebar = get_field( 'single_sidebar_source' );
		}
	} elseif ( is_page() ) {
		if (get_field( 'page_sidebar_source' ) != '' ){
			$the_sidebar = get_field( 'page_sidebar_source' );
		}
	} else {
		$the_sidebar = 'Main Sidebar';
	}
	dynamic_sidebar( $the_sidebar );
	// print_r($the_sidebar);
?>
</div>