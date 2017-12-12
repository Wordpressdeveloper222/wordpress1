<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014
	Please be extremely cautions editing this file!

    - Functions - Mark 1.0.0

 ---------------------------------------------------------------------------*/


/* --------------------------------------------------------------------------
 * [default theme contstans]
 ---------------------------------------------------------------------------*/
define('MAHA_PATH', get_template_directory());
define('MAHA_URL', get_template_directory_uri());
define('MAHA_TEXT_DOMAIN', 'curated');


/* --------------------------------------------------------------------------
 * [maha_content_width - Set Wordpress Max Content Width]
 ---------------------------------------------------------------------------*/
if( !function_exists( 'maha_content_width' ) ) {
    function maha_content_width() {
        if( is_page_template( 'template-full-width.php' ) || is_attachment() ) {
            global $content_width;
            $content_width = 940;
        }
    }
}
add_action( 'template_redirect', 'maha_content_width' );


/* --------------------------------------------------------------------------
 * [maha_theme_setup - Setup, important theme feature ]
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'maha_theme_setup' ) ) {
    function maha_theme_setup() {
        
        /* Load Theme Text Domain */
    	load_theme_textdomain( MAHA_TEXT_DOMAIN, get_template_directory() . '/language' );
        	
    	/* Register WP Menu */
        register_nav_menu( 'top-nav', __('Top Navigation', MAHA_TEXT_DOMAIN) );
        register_nav_menu( 'header-nav', __('Header Navigation', MAHA_TEXT_DOMAIN) );
 		// register_nav_menu( 'footer-nav', __('Footer Navigation', MAHA_TEXT_DOMAIN) );
   	
    	/* Setup WP Thumbnail */
    	add_theme_support( 'post-thumbnails' );
        add_image_size( 'mh_widget', 83, 63, true);   // Widget Image
        // add_image_size( 'mh_medium', 514, 276, true);   // Medium
        add_image_size( 'mh_xmedium', 670, 440, true);  // Extra Medium
        add_image_size( 'mh_slide_large', 850, 468, true);  // Slide Medium
        add_image_size( 'mh_gallery', 850, '', true);  // Gallery
        add_image_size( 'mh_large', 1080, 641, true);  // Large

        add_image_size( 'mh_medium', 360, 193, true );
        add_image_size( 'mh_small', 83, 83, true );
        add_image_size( 'mh_fbshare', 200, 200, true );
        add_image_size( 'mh_list', 258, 169, true );
        add_image_size( 'mh_medium_simple', 262, 141, true );
        add_image_size( 'mh_mega_menu', 257, 144, true );
    	
    	/* Setup Theme Post/Blog Formats */
        add_theme_support(
            'post-formats', 
	            array(
                    'gallery',
                    'video',
                    'audio'
	            ) 
        );

        /* Setup WP feed links */
        add_theme_support( 'automatic-feed-links' );       
    	
    }
}
add_action( 'after_setup_theme', 'maha_theme_setup' );

// Load Default options first
$maha_options = get_option('curated');


/* --------------------------------------------------------------------------
 * [maha_excerpt_length - Set WP excerpt length via excerpt_length filter]
 ---------------------------------------------------------------------------*/
if( !function_exists( 'maha_excerpt_length' ) ) {
	function maha_excerpt_length($length) {
	    return 24;
	}
}
add_filter('excerpt_length', 'maha_excerpt_length');


/* --------------------------------------------------------------------------
 * [maha_excerpt_more - Set article read more string via wp_trim_excerpt]
 ---------------------------------------------------------------------------*/
if( !function_exists( 'maha_excerpt_more' ) ) {
	function maha_excerpt_more($excerpt) {
	    return ' ... ';
	}
}
add_filter('excerpt_more', 'maha_excerpt_more');


/* -------------------------------------------------------------------------- 
 * [maha_sidebars_setup - Setup theme sidebars ]
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'maha_sidebars_setup' ) ) {
    function maha_sidebars_setup() {

        /* [Blog Sidebar, Page Sidebar] - Main Sidebars, Default sidebar for blog and page*/
        register_sidebar(array(
            'name' => __('Main Sidebar', MAHA_TEXT_DOMAIN),
            'description' => __('Widget area for blog pages.', MAHA_TEXT_DOMAIN),
            'id' => 'blog-sidebar',
            'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><div class="block-cap"><h3>',
            'after_title' => '</h3></div></div>',
        ));
        register_sidebar(array(
            'name' => __('Page Sidebar', MAHA_TEXT_DOMAIN),
            'description' => __('Widget area for regular page.', MAHA_TEXT_DOMAIN),
            'id' => 'page-sidebar',
            'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><div class="block-cap"><h3>',
            'after_title' => '</h3></div></div>',
        ));
        
        /* [Footer 1, Footer 2, Footer 3] - Main Footer Sidebars, Defined via Footer Options */
        for ($si=1; $si < 4; $si++) { 
            register_sidebar(array(
                'name' => __('Footer '.$si, MAHA_TEXT_DOMAIN),
                'description' => __('Widget area for footer '.$si.'.', MAHA_TEXT_DOMAIN),
                'id' => 'footer-'.$si,
                'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widget-title"><div class="block-cap"><h3>',
                'after_title' => '</h3></div></div>',
            ));
        }

        $maha_options = get_option('curated');
        $theme_sidebar = array();
        if (isset($maha_options['theme_sidebar'])) {
            $theme_sidebar = $maha_options['theme_sidebar'];
            
            if (is_array($theme_sidebar)) {
                foreach ($theme_sidebar as $key_ts => $value_ts) {
                    register_sidebar(array(
                        'name' => __($value_ts, MAHA_TEXT_DOMAIN),
                        'description' => __($value_ts.' widget.', MAHA_TEXT_DOMAIN),
                        'id' => $key_ts.'-curated-sidebar',
                        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<div class="widget-title"><div class="block-cap"><h3>',
                        'after_title' => '</h3></div></div>',
                    ));
                }
            }
        }


    }
    
}
add_action( 'widgets_init', 'maha_sidebars_setup' );
add_filter( 'widget_text', 'do_shortcode');


/* -------------------------------------------------------------------------- 
 * [maha_scripts_setup - Enqueue Javascript files ]
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'maha_scripts_setup' ) ) {
    function maha_scripts_setup() {

        // Google Maps
        $query_object = get_queried_object();
        if ( isset( $query_object ) && !empty( $query_object ) ) {
            if ( !empty($query_object->post_content) ) {
                if ( has_shortcode( $query_object->post_content, 'googlemaps' ) ) {
        wp_enqueue_script('maha-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array('jquery'));
                }
            }
        }

        wp_enqueue_script('jquery');    
        wp_enqueue_script('maha-main', get_template_directory_uri() . '/static/js/main.js', 'jquery', '1.0.0', true);
        wp_enqueue_script('maha-basix', get_template_directory_uri() . '/static/js/basix.js', 'jquery', '1.0.0', true);
        // wp_enqueue_script('add_to_cart', get_template_directory_uri() . '/static/js/add_to_cart.js', 'jquery', '1.0.0', true);
        wp_enqueue_script('comment-reply');
        wp_localize_script( 'maha-basix', 'MahaAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

    }
}
add_action('wp_enqueue_scripts', 'maha_scripts_setup');

/* -------------------------------------------------------------------------- 
 * [maha_scripts_backend_setup - Enqueue Javascripts files for the backend ]
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'maha_scripts_backend_setup' ) ) {
    function maha_scripts_backend_setup() {
        wp_enqueue_style('maha-admin-style', get_template_directory_uri() . '/static/css/basix-admin.css', '', '', 'all' );
    }
}
add_action( 'admin_enqueue_scripts', 'maha_scripts_backend_setup' );


/* -------------------------------------------------------------------------- 
 * [maha_style_setup - Enqueue Styesheet files]
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'maha_style_setup' ) ) {
    function maha_style_setup() {

        $maha_options = get_option('curated');

        if ( $maha_options['responsive_on'] == true ) {
            wp_enqueue_style('maha-bootstrap', get_template_directory_uri() . '/static/css/bootstrap-responsive.css', '', '1.0');
        } else {
            wp_enqueue_style('maha-bootstrap', get_template_directory_uri() . '/static/css/bootstrap.css', '', '1.0');            
        }
        
        wp_enqueue_style('maha-entypo', get_template_directory_uri() . '/static/css/entypo.css', '', '1.0');
        wp_enqueue_style('maha-basix', get_template_directory_uri() . '/static/css/basix.css', '', '1.0');
        
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            wp_enqueue_style('maha-woo', get_template_directory_uri() . '/static/css/maha-woo.css', '', '1.0');
        }

        if ( $maha_options['responsive_on'] == true ) {
            wp_enqueue_style('maha-basix-r', get_template_directory_uri() . '/static/css/basix-responsive.css', '', '1.0');
        } else {
            wp_enqueue_style('maha-basix-r', get_template_directory_uri() . '/static/css/basix-desktop.css', '', '1.0');
        }
        
    }
}
add_action( 'wp_enqueue_scripts', 'maha_style_setup' );


/* -------------------------------------------------------------------------
 * [maha_comment_pings - Comment Separated ping styling]
 --------------------------------------------------------------------------*/
add_filter('body_class', 'maha_browser_body_class');

if( !function_exists( 'maha_browser_body_class' ) ) {
    function maha_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

        if ($is_lynx) { $classes[] = 'lynx'; }
        elseif ($is_gecko) { $classes[] = 'gecko'; }
        elseif ($is_opera) { $classes[] = 'opera'; }
        elseif ($is_NS4) { $classes[] = 'ns4'; }
        elseif ($is_safari) { $classes[] = 'safari'; }
        elseif ($is_chrome) { $classes[] = 'chrome'; }
        elseif ($is_IE) { $classes[] = 'ie'; }
        else { $classes[] = 'unknown'; }

        if ($is_iphone) { $classes[] = 'iphone'; }
            
        $classes[] = 'mh-body';
            
        return $classes;
    }
}


/* -------------------------------------------------------------------------
 * [maha_comment_pings - Comment Separated ping styling]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_comment_pings' ) ) {
    function maha_comment_pings($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        echo '<li id="comment-'.comment_ID().'">'.comment_author_link(); 
    }
}


/* -------------------------------------------------------------------------
 * [maha_comment - Theme commenting style]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_comment' ) ) {
    function maha_comment($comment, $args, $depth) {
    
        $isByAuthor = false;

        if($comment->comment_author_email == get_the_author_meta('email')) {
            $isByAuthor = true;
        }

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                
                <?php echo get_avatar($comment,$size='60'); ?>
                
                <div>

                    <div class="comment-author vcard">
                        <cite class="fn"><?php echo get_comment_author_link(); ?></cite><?php if( $isByAuthor ) { ?><span class="author-tag"> <?php _e('(Author)', MAHA_TEXT_DOMAIN) ?></span><?php } ?>
                    </div>

                    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __('%1$s at %2$s', MAHA_TEXT_DOMAIN), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(__('Edit', MAHA_TEXT_DOMAIN), ' / ','') ?> / <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

                    <?php if ($comment->comment_approved == '0') : ?>
                        <em class="moderation"><?php _e('Your comment is awaiting moderation.', MAHA_TEXT_DOMAIN) ?></em><br />
                    <?php endif; ?>

                    <div class="comment-body">
                        <?php comment_text() ?>
                    </div>

                </div>

            </div>
    <?php
    }
}


/* -------------------------------------------------------------------------
 * Woocommerce Hook & Filter
 --------------------------------------------------------------------------*/

// Woocommerce Theme Support
add_theme_support( 'woocommerce' );

// Woocommerce Remove default style
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Woocommerce Default thumbnail size
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'woocommerce_theme_image', 1 );
if ( !function_exists( 'woocommerce_theme_image' ) ) {
    function woocommerce_theme_image() {
        $catalog = array(
            'width'     => '386',   // px
            'height'    => '410',   // px
            'crop'      => 1        // true
        );
     
        $single = array(
            'width'     => '600',   // px
            'height'    => '600',   // px
            'crop'      => 1        // true
        );
     
        $thumbnail = array(
            'width'     => '200',   // px
            'height'    => '200',   // px
            'crop'      => 0        // false
        );
     
        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}

// Woocommerce Cart and Fragments
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
if ( !function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {
    function woocommerce_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
        <span class="cart-count <?php if ($woocommerce->cart->cart_contents_count != 0){ echo "showed"; } ?>">
        <span class="open-cart-form" href="#"><i class="icon-basket"></i></span>
        <span class='shop-cart'>
        <span class='count-arrow'></span>
        <?php echo $woocommerce->cart->cart_contents_count; ?>
        </span>
        </span>
        <?php

        $fragments['span.cart-count'] = ob_get_clean();

        return $fragments;
    }
}

// Woocommerce number of products per page
$woo_number_products = 'return 8;';
if ($maha_options['woo_number_products'] != '') { $woo_number_products = 'return '.$maha_options['woo_number_products'].';'; }
add_filter( 'loop_shop_per_page', create_function( '$cols', $woo_number_products ), 20 );

// Woocomerce single - related products
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );
if ( !function_exists( 'woo_related_products_limit' ) ) {
    function woo_related_products_limit() {
        global $product;
        $related = $product->get_related( 4 );

        $args = array(
            'post_type'            => 'product',
            'ignore_sticky_posts'  => 1,
            'no_found_rows'        => 1,
            'posts_per_page'       => 4,
            'orderby'              => 'rand',
            'post__in'             => $related,
            'post__not_in'         => array( $product->id )
        );
        return $args;
    }
}

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

// Woocommerce Loop
// remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
// remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Woocommerce structure for thumbnail and add_to_cart button
// add_action('woocommerce_before_shop_loop_item_title', 'product_thumbnail_with_cart', 10 );
if ( !function_exists( 'product_thumbnail_with_cart' ) ) {
    function product_thumbnail_with_cart() { ?>
       <div class="maha-product-wrap">
            <?php 
            echo  woocommerce_get_product_thumbnail(); 
            woocommerce_get_template( 'loop/add-to-cart.php' ); ?>
        </div>
    <?php 
    }
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/* -------------------------------------------------------------------------
 * Bbpress
 --------------------------------------------------------------------------*/
if ( !function_exists( 'custom_bbp_list_forums' ) ) {
    function custom_bbp_list_forums( $args = '' ) {

        // Define used variables
        $output = $sub_forums = $freshness = $reply_count = $content = '';
        $i = 0;
        $count = array();

        // Parse arguments against default values
        $r = bbp_parse_args( $args, array(
            'before'            => '<ul class="bbp-forums-list">',
            'after'             => '</ul>',
            'link_before'       => '<li class="bbp-forum">',
            'link_after'        => '</li>',
            'forum_id'          => '',
            'show_topic_count'  => true,
            'show_reply_count'  => true,
        ), 'list_forums' );

        // Loop through forums and create a list
        $sub_forums = bbp_forum_get_subforums( $r['forum_id'] );
        if ( !empty( $sub_forums ) ) {

            // Total count (for separator)
            $total_subs = count( $sub_forums );
            foreach ( $sub_forums as $sub_forum ) {
                $i++; // Separator count

                // Get forum details
                $permalink = bbp_get_forum_permalink( $sub_forum->ID );
                $title     = bbp_get_forum_title( $sub_forum->ID );
                $forum_content = bbp_get_forum_content( $sub_forum->ID );
                $subscription = '';
                $link_subs = '';
                if ( !empty( $forum_content ) ) {
                    $content   = "<div class='bbp-forum-content'>".bbp_get_forum_content( $sub_forum->ID )."</div>";
                } else {
                    $content = '';
                }
                $freshness = "<div class='maha-freshness'>Freshness: ".bbp_get_forum_freshness_link( $sub_forum->ID )."<p class='bbp-topic-meta'>";
                $freshness .= "<span class='bbp-topic-freshness-author'>".bbp_get_author_link( array( 'post_id' => bbp_get_forum_last_active_id( $sub_forum->ID ), 'size' => 14 ) );
                $freshness .= "</span></p></div>";

                if ( bbp_is_user_home() && bbp_is_subscriptions() ) {

                $link_subs = bbp_get_forum_subscription_link( array( 'before' => '', 'subscribe' => 'subscribe', 'unsubscribe' => 'unsubscribe', 'forum_id' => $sub_forum->ID ) );
                $subscription = "<span class='bbp-row-actions'>".$link_subs."</span>";

                } else { $subscription = ''; }

                // Build this sub forums link
                $output .= $r['link_before'] . '<a href="' . esc_url( $permalink ) . '" class="bbp-forum-title maha-heading-font">' . $title . '</a>';
                $output .= $content . $freshness . $subscription . $r['link_after'];
            }

            // Output the list
            echo apply_filters( 'bbp_list_forums', $r['before'] . $output . $r['after'], $r );
        }
    }
}




/* -------------------------------------------------------------------------
 * BuddyPress
 --------------------------------------------------------------------------*/

if (class_exists('LoginWithAjax')) {


    if ( !function_exists( 'bp_custom_init' ) ) {
        function bp_custom_init(){
            //Load LWA options
            LoginWithAjax::$data = get_option('lwa_data');
            //Remember the current user, in case there is a logout
            LoginWithAjax::$current_user = wp_get_current_user();

            //Get Templates from theme and default by checking for folders - we assume a template works if a folder exists!
            //Note that duplicate template names are overwritten in this order of precedence (highest to lowest) - Child Theme > Parent Theme > Plugin Defaults
            //First are the defaults in the plugin directory
            LoginWithAjax::find_templates( path_join( WP_PLUGIN_DIR , basename( dirname( __FILE__ ) ). "/widget/") );
            //Now, the parent theme (if exists)
            if( get_stylesheet_directory() != get_template_directory() ){
                LoginWithAjax::find_templates( get_template_directory().'/plugins/login-with-ajax/' );
            }
            //Finally, the child theme
            LoginWithAjax::find_templates( get_stylesheet_directory().'/plugins/login-with-ajax/' );

            //Generate URLs for login, remember, and register
            LoginWithAjax::$url_login = LoginWithAjax::template_link(site_url('wp-login.php', 'login_post'));
            LoginWithAjax::$url_register = LoginWithAjax::template_link(maha_custom_getRegisterLink());
            LoginWithAjax::$url_remember = LoginWithAjax::template_link(site_url('wp-login.php?action=lostpassword', 'login_post'));

            //Make decision on what to display
            if ( !empty($_REQUEST["lwa"]) ) { //AJAX Request
                LoginWithAjax::ajax();
            }elseif ( isset($_REQUEST["login-with-ajax-widget"]) ) { //Widget Request via AJAX
                $instance = ( !empty($_REQUEST["template"]) ) ? array('template' => $_REQUEST["template"]) : array();
                $instance['profile_link'] = ( !empty($_REQUEST["lwa_profile_link"]) ) ? $_REQUEST['lwa_profile_link']:0;
                LoginWithAjax::widget( $instance );
                exit();
            }else{
                //Enqueue scripts - Only one script enqueued here.... theme JS takes priority, then default JS
                if( !is_admin() ) {
                    $js_url = defined('WP_DEBUG') && WP_DEBUG ? 'login-with-ajax.source.js':'login-with-ajax.js';
                    wp_enqueue_script( "login-with-ajax", LoginWithAjax::locate_template_url($js_url), array( 'jquery' ) );
                    wp_enqueue_style( "login-with-ajax", LoginWithAjax::locate_template_url('widget.css') );
                }

                //Add logout/in redirection
                add_action('wp_logout', 'LoginWithAjax::logoutRedirect');
                add_action('logout_url', 'LoginWithAjax::logoutUrl');
                add_action('login_redirect', 'LoginWithAjax::loginRedirect', 1, 3);
                add_shortcode('login-with-ajax', 'LoginWithAjax::shortcode');
                add_shortcode('lwa', 'LoginWithAjax::shortcode');
            }
        }
    }

    remove_action( 'init', 'LoginWithAjax::init' );
    add_action('init', 'bp_custom_init');

    if ( !function_exists( 'maha_custom_getRegisterLink' ) ) {
        function maha_custom_getRegisterLink(){
            $register_link = false;
            if ( function_exists('bp_get_signup_page') ) { //Buddypress
                $register_link = maha_custom_get_signup_page();
            }elseif ( is_multisite() ) { //MS
                $register_link = site_url('wp-signup.php', 'login');
            } else {
                $register_link = site_url('wp-login.php?action=register', 'login');
            }
            return $register_link;
        }
    }
    if ( !function_exists( 'maha_custom_get_signup_page' ) ) {
        function maha_custom_get_signup_page() {
            if ( maha_custom_has_custom_signup_page() ) {
                $page = trailingslashit( bp_get_root_domain() . '/' . bp_get_signup_slug() );
            } else {
                $page = bp_get_root_domain() . '/wp-signup.php';
            }

            return apply_filters( 'bp_get_signup_page', $page );
        }
    }
    if ( !function_exists( 'maha_custom_has_custom_signup_page' ) ) {
        function maha_custom_has_custom_signup_page() {
            static $has_page = false;

            if ( empty( $has_page ) )
                $has_page = bp_get_signup_slug() && maha_custom_locate_template( array( 'registration/register.php', 'members/register.php', 'register.php' ), false );

            return (bool) $has_page;
        }
    }
    if ( !function_exists( 'maha_custom_locate_template' ) ) {
        function maha_custom_locate_template( $template_names, $load = false, $require_once = true ) {

            // No file found yet
            $located            = false;
            $template_locations = maha_custom_get_template_stack();

            // Try to find a template file
            foreach ( (array) $template_names as $template_name ) {

                // Continue if template is empty
                if ( empty( $template_name ) )
                    continue;

                // Trim off any slashes from the template name
                $template_name  = ltrim( $template_name, '/' );

                // Loop through template stack
                foreach ( (array) $template_locations as $template_location ) {

                    // Continue if $template_location is empty
                    if ( empty( $template_location ) )
                        continue;

                    // Check child theme first
                    if ( file_exists( trailingslashit( $template_location ) . $template_name ) ) {
                        $located = trailingslashit( $template_location ) . $template_name;
                        break 2;
                    }
                }
            }

            /**
             * This action exists only to follow the standard BuddyPress coding convention,
             * and should not be used to short-circuit any part of the template locator.
             *
             * If you want to override a specific template part, please either filter
             * 'bp_get_template_part' or add a new location to the template stack.
             */
            do_action( 'bp_locate_template', $located, $template_name, $template_names, $template_locations, $load, $require_once );

            // Maybe load the template if one was located
            $use_themes = defined( 'WP_USE_THEMES' ) && WP_USE_THEMES;
            $doing_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;
            if ( ( $use_themes || $doing_ajax ) && ( true == $load ) && ! empty( $located ) ) {
                load_template( $located, $require_once );
            }

            return $located;
        }
    }
    if ( !function_exists( 'maha_custom_get_template_stack' ) ) {
        function maha_custom_get_template_stack() {
            global $wp_filter, $merged_filters, $wp_current_filter;

            // Setup some default variables
            $tag  = 'bp_template_stack';
            $args = $stack = array();

            // Add 'bp_template_stack' to the current filter array
            $wp_current_filter[] = $tag;

            // Sort
            if ( ! isset( $merged_filters[ $tag ] ) ) {
                ksort( $wp_filter[$tag] );
                $merged_filters[ $tag ] = true;
            }

            if ( empty($args) )
                $args = func_get_args();

            $value = '';

            foreach ( $wp_filter[$tag] as $filters )
                foreach( (array) $filters as $the_ )
                    if ( !is_null($the_['function']) ){
                        $args[1] = $value;
                        $value = call_user_func_array($the_['function'], array_slice($args, 1, (int) $the_['accepted_args']));
                    }


            // Remove 'bp_template_stack' from the current filter array
            array_pop( $wp_current_filter );

            // Remove empties and duplicates
            $stack = array_unique( array_filter( $stack ) );

            return (array) apply_filters( 'bp_get_template_stack', $stack ) ;
        }
    }

}


/* -------------------------------------------------------------------------
 * [maha_bbp_crumbs - Filter bbpress breadcrumb ... ]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_bbp_crumbs' ) ) {
    function maha_bbp_crumbs( $args = array() ) {
        $args['home_text'] = 'Home';
        $args['root_text'] = 'Forums';

        return $args;
    }
}
add_filter( 'bbp_after_get_breadcrumb_parse_args', 'maha_bbp_crumbs' );


/* -------------------------------------------------------------------------
 * [maha_bbp_search_form - Filter bbpress search results ... ]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_bbp_search_form' ) ) {
    function maha_bbp_search_form(){ ?>

        <div class="bbp-search-form">
            <?php bbp_get_template_part( 'form', 'search' ); ?>
        </div>
        
        <?php
    }
}
add_action( 'bbp_template_before_single_forum', 'maha_bbp_search_form' );


/* -------------------------------------------------------------------------
 * [maha_wp_admin_scripts - Initialize admin scripts ... ]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_wp_admin_scripts' ) ) {
    function maha_wp_admin_scripts() {
        wp_enqueue_style('admin_maha_css', get_template_directory_uri() .'/includes/options/curated/css/admin-maha.css','', '1.0.0');
        wp_enqueue_script('admin_maha_js', get_template_directory_uri() .'/includes/options/curated/js/admin-maha.js', array('jquery'), '1.0.0');
    }
}
add_action( 'admin_enqueue_scripts', 'maha_wp_admin_scripts' );

if ( !function_exists( 'maha_js_defer' ) ) {
    function maha_js_defer( $url ){
        if ( !is_admin() ) {
            if ( TRUE == strpos( $url, 'jquery.js' ) || FALSE == strpos( $url, '.js' ) || TRUE == strpos( $url, 'main.js' ) || TRUE == strpos( $url, 'render.js' ) || TRUE == strpos( $url, 'quicktags.min.js' ) )
            {
                return $url;
            } else{
                return "$url' defer='defer";
            }
        } else {
            return $url;
        }
    }
}
add_filter('clean_url', 'maha_js_defer', 11, 1);


/* -------------------------------------------------------------------------
 * [maha_wp_admin_scripts - Initialize admin scripts ... ]
 --------------------------------------------------------------------------*/
add_action('wp_ajax_nopriv_maha_ajax_search', 'maha_ajax_search'); // for not logged in users
add_action('wp_ajax_maha_ajax_search', 'maha_ajax_search');
if ( !function_exists( 'maha_ajax_search' ) ) {
    function maha_ajax_search(){
        get_template_part( 'searchresult' );    
        exit;
    }
}

/* -------------------------------------------------------------------------
 * [Remove hentry class from post_class]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_remove_hentry_class' ) ) {
    function maha_remove_hentry_class( $classes ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
        return $classes;
    }
}
add_filter( 'post_class', 'maha_remove_hentry_class' );

/* -------------------------------------------------------------------------
 * [facebook share]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_get_fb_image' ) ) {
    function maha_get_fb_image($post_ID) {
        $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'mh_fbshare');
            return $post_thumbnail_img[0];
        }
    }
}
 
// Get post excerpt
if ( !function_exists( 'maha_get_fb_description' ) ) {
    function maha_get_fb_description($post) {
        if ($post->post_excerpt) {
            return $post->post_excerpt;
        }
        else {
            // Post excerpt is not set, so we take first 55 words from post content
            $excerpt_length = 55;
            // Clean post content
            $text = str_replace("\r\n"," ", strip_tags(strip_shortcodes($post->post_content)));
            $words = explode(' ', $text, $excerpt_length + 1);
            if (count($words) > $excerpt_length) {
                array_pop($words);
                $excerpt = implode(' ', $words);
                return $excerpt;
            }
        }
    }
}

if ( !function_exists( 'maha_fb_header' ) ) {
    function maha_fb_header() {
        global $post;

        if ( isset( $post ) && !empty( $post ) ) {
            $post_description = maha_get_fb_description($post);
            $post_featured_image = maha_get_fb_image($post->ID);

            if ( (is_single()) AND (get_post_type() == 'post') AND ($post_featured_image) AND ($post_description) ) { ?>
              <!-- Start Facebook Share -->
              <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
              <meta property="og:title" content="<?php echo $post->post_title; ?>" />
              <meta property="og:description" content="<?php echo $post_description; ?>" />
              <meta property="og:image" content="<?php echo $post_featured_image; ?>" />
              <!-- End Facebook Share -->
        <?php
            }
        }
    }
}
add_action('wp_head', 'maha_fb_header');

// Filter video output
add_filter('oembed_result','lc_oembed_result', 10, 3);
if ( !function_exists( 'lc_oembed_result' ) ) {
    function lc_oembed_result($html, $url, $args) {
        $newargs = $args;
        array_pop( $newargs );
        $parameters = str_replace('&','&amp;', http_build_query( $newargs ));
        if (strpos($html,'?feature=oembed') !== false) {
            $html = str_replace( '?feature=oembed', '?feature=oembed'.'&amp;'.$parameters, $html );
        }else{
            preg_match( '#dailymotion\.com/embed/video/(.*?)\"#', $html, $matches );
            $html = str_replace( $matches[1], $matches[1].'?'.$parameters, $html );
        }
        return $html;
    }
}

/* -------------------------------------------------------------------------
 * [theme_init - Initialize theme Options, Meta-box, Widgets, etc... ]
 --------------------------------------------------------------------------*/
require_once (MAHA_PATH . '/includes/maha-init.php');
/* -------------------------------------------------------------------------
 * [theme_init - Initialize theme Update Notifiers ]
 --------------------------------------------------------------------------*/
require_once (MAHA_PATH . '/includes/update_notifier.php');

?>