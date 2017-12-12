<?php

/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

	@init - Options
	@init - Functions
	@init - Widgets
	@init - Plugins

	- Meta Init - Mark 1.0.0

 ---------------------------------------------------------------------------*/


/* --------------------------------------------------------------------------
 * [@init - Options]
 ---------------------------------------------------------------------------*/
if ( !class_exists( 'ReduxFramework' ) && file_exists( MAHA_PATH . '/includes/options/ReduxCore/framework.php' ) ) {
	require_once( MAHA_PATH . '/includes/options/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( MAHA_PATH . '/includes/options/curated/config.php' ) ) {
	require_once( MAHA_PATH . '/includes/options/curated/config.php' );
}


/* --------------------------------------------------------------------------
 * [@init - Plugins Required]
 ---------------------------------------------------------------------------*/
require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';


/* --------------------------------------------------------------------------
 * [@init - Widgets]
 ---------------------------------------------------------------------------*/
require_once (MAHA_PATH . '/includes/widgets/maha-posts.php');					// Post
require_once (MAHA_PATH . '/includes/widgets/maha-popular-post.php');			// Popular Post
require_once (MAHA_PATH . '/includes/widgets/maha-social-subscribe.php');		// Social Subsribe with Counter
require_once (MAHA_PATH . '/includes/widgets/maha-top-reviews.php');			// Top Reviews
require_once (MAHA_PATH . '/includes/widgets/maha-recent-posts.php');			// Recent Posts with thumbnail
require_once (MAHA_PATH . '/includes/widgets/maha-ads.php');							// Ads Widget
require_once (MAHA_PATH . '/includes/widgets/maha-menus.php');							// Ads Widget


/* -------------------------------------------------------------------------
 * [Theme Function]
 --------------------------------------------------------------------------*/
require_once (MAHA_PATH . '/includes/functions/maha-mega-menu.php');
require_once (MAHA_PATH . '/includes/functions/maha-functions.php');
require_once (MAHA_PATH . '/includes/functions/maha-posts-filter.php');
require_once (MAHA_PATH . '/includes/functions/maha-posts-view.php');


/* -------------------------------------------------------------------------
 * [Custom Fields]
 --------------------------------------------------------------------------*/
if (!class_exists('Acf')) {
    require_once (MAHA_PATH . '/includes/acf/acf.php');
}else{
	// Include Field Type For ACF5
	function include_field_types_sidebar_selector( $version ) {
		include_once('acf/core/fields/sidebar_selector-v5.php');
	}
	add_action('acf/include_field_types', 'include_field_types_sidebar_selector');

	// Include Field Type For ACF4
	function register_fields_sidebar_selector() {
		include_once('acf/core/fields/sidebar_selector-v4.php');
	}
	add_action('acf/register_fields', 'register_fields_sidebar_selector');

	// Include Field Type For ACF3
	if(function_exists('register_field')){
		register_field('acf_field_sidebar_selector', dirname(__File__) . 'acf/core/fields/sidebar_selector-v3.php');
	}
}

require_once (MAHA_PATH . '/includes/acf/acf-fields.php');

?>