
<?php
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development
 * and https://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
/*
 * Set up the content width value based on the theme's design.
 *
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
 //require_once ( get_stylesheet_directory() . '/netttus-theme-panel.php');

if ( ! isset( $content_width ) )
	$content_width = 604;
/**
 * Add support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';
/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentythirteen
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen' );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentythirteen_fonts_url() ) );
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/*
	 * This theme supports all available post formats by default.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );
/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
 

function twentythirteen_fonts_url() {
	$fonts_url = '';
	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );
	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );
	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();
		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';
		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );
	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160717', true );
	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.03' );
	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );
/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Thirteen 2.1
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentythirteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentythirteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'twentythirteen_resource_hints', 10, 2 );
/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );
/**
 * Register two widget areas.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );
if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_paging_nav() {
	global $wp_query;
	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_post_nav() {
	global $post;
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'twentythirteen' ) . '</span>';
	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}
	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;
if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';
	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);
	if ( $echo )
		echo $date;
	return $date;
}
endif;
if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Twenty thirteen 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();
	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );
	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $idx => $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = $attachment_ids[ ( $idx + 1 ) % count( $attachment_ids ) ];
				break;
			}
		}
		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );
		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
	}
	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;
/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );
	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
if ( ! function_exists( 'twentythirteen_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since Twenty Thirteen 1.4
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 */
function twentythirteen_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentythirteen_excerpt_more' );
endif;
/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';
	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';
	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';
	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );
/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_content_width() {
	global $content_width;
	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );
/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title',
			'container_inclusive' => false,
			'render_callback' => 'twentythirteen_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'twentythirteen_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'twentythirteen_customize_register' );
/**
 * Render the site title for the selective refresh partial.
 *
 * @since Twenty Thirteen 1.9
 * @see twentythirteen_customize_register()
 *
 * @return void
 */
function twentythirteen_customize_partial_blogname() {
	bloginfo( 'name' );
}
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Thirteen 1.9
 * @see twentythirteen_customize_register()
 *
 * @return void
 */
function twentythirteen_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );

/*add_action( 'init', 'books' );
function books() {
  register_post_type( 'books',
    array(
      'labels' => array(
        'name' => __( 'Books' ),
        'singular_name' => __( 'Books' )
      ),
      'public' => true,
      'has_archive' => true,	    
    )
  );
}*/

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'music',
    array(
      'labels' => array(
        'name' => __( 'Music' ),
        'singular_name' => __( 'Music' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

add_action('woocommerce_before_customer_login_form','load_registration_form', 2);
function load_registration_form(){
if(isset($_GET['action'])=='register'){
woocommerce_get_template( 'myaccount/form-registration.php' );
}
}

add_action( 'init', 'create_posttype' );
function create_posttype() {
  register_post_type( 'faqs',
    array(
      'labels' => array(
        'name' => __( 'FAQs' ),
        'singular_name' => __( 'FAQs' )
      ),
	  'show_in_rest'       => true,
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'faqs'),
	  'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ,'headway-seo','custom-fields'),
    )
  );
}

			
function add_our_script() {
 
wp_register_script( 'ajax-js', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ), '', true );
wp_localize_script( 'ajax-js', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
//wp_register_script( 'ajax-js', get_template_directory_uri().'/js/cptapagination1.js',array('jquery'),'',true);
wp_enqueue_script( 'ajax-js' );
 
}
add_action( 'wp_enqueue_scripts', 'add_our_script' );

add_action( 'wp_ajax_cptapagination', 'cptapagination_callback1' );
add_action( 'wp_ajax_nopriv_cptapagination', 'cptapagination_callback1' );					

function cptapagination_callback1() {
	global $wpdb;
	$cptaNumber = absint($_POST['number']);
	$cptaLimit  = absint($_POST['limit']);
	$cptaType = 'faqs';
	if( $cptaNumber == "1" ){
		$cptaOffsetValue = "0";
		$args = array('posts_per_page' => $cptaLimit,'post_type' => $cptaType,'post_status' => 'publish');	
	}else{
		$cptaOffsetValue = ($cptaNumber-1)*$cptaLimit;
		$args = array('posts_per_page' => $cptaLimit,'post_type' => $cptaType,'offset' => $cptaOffsetValue,'post_status' => 'publish');
	}
	$cptaQuery = new WP_Query( $args );
		if( $cptaQuery->have_posts() ){
			while( $cptaQuery->have_posts() ){ $cptaQuery->the_post();
				 echo "<div class='cpta-Section'>
					<h1>".get_the_title()."</h1>
					<p>".get_the_content()."</p>
					
				</div>";
			} wp_reset_postdata();
		}
		$cpta_args = array('posts_per_page' => -1,'post_type' => $cptaType,'post_status' => 'publish');	
		$cpta_Query = new WP_Query( $cpta_args );
		$cpta_Count = count($cpta_Query->posts);
		$cpta_Paginationlist = $cpta_Count/$cptaLimit;
		$last = ceil( $cpta_Paginationlist );
		if( $cptaNumber>1 ){ $cptaprev = $cptaNumber-1;	}
		if( $cptaNumber < $last ){ $cptanext = $cptaNumber+1; }
		echo "<ul class='list-cptapagination'>";
		echo "<li class='pagitext'><a href='javascript:void(0);' onclick='javascript:cptaajaxPagination1($cptaprev,$cptaLimit)'>Prev</a></li>";
		for( $cpta=1; $cpta<=ceil($cpta_Paginationlist); $cpta++){
			if( $cptaNumber ==  $cpta ){ $active="active"; }else{ $active=""; }
			echo "<li><a href='javascript:void(0);' id='post' class='$active' data-posttype='$cptaType' onclick='cptaajaxPagination1($cpta,$cptaLimit);'>$cpta</a></li>";
		}
		echo "<li class='pagitext'><a href='javascript:void(0);' onclick='javascript:cptaajaxPagination1($cptanext,$cptaLimit)'>Next</a></li>";
		echo "</ul>";
	wp_die();
}


function faqsidebar($atts) {
	global $wpdb;
	$atts = shortcode_atts(	array('custom_post_type' => '',	'post_limit' => ''),$atts,'sidebar');
	
	
		$cptaType ="faqs";	
	
	if( $atts['post_limit'] !="" ){
		$cptaLimit= absint($atts['post_limit']);	
	}else{
		$cptaLimit=1;
	}
	
	$args = array('posts_per_page' => $cptaLimit,'post_type' => $cptaType,'post_status' => 'publish');
	$cptaQuery = new WP_Query( $args );
	echo "<div id='cptapagination-content'>";
		if( $cptaQuery->have_posts() ){
			while( $cptaQuery->have_posts() ){ $cptaQuery->the_post();
				 echo "<div class='cpta-Section'>
					<h1>".get_the_title()."</h1>
					<p>".get_the_excerpt()."</p>
					<a href=".get_the_permalink()." class='btn-cptapagi'>Read More</a>
				</div>";
			} wp_reset_postdata();
		}
		$cpta_args = array('posts_per_page' => -1,'post_type' => $cptaType,'post_status' => 'publish');	
		$cpta_Query = new WP_Query( $cpta_args );
		$cpta_Count = count($cpta_Query->posts);
		$cpta_Paginationlist = $cpta_Count/$cptaLimit;
		echo "<ul class='list-cptapagination'>";
		echo "<li class='pagitext'><a href='javascript:void(0);' onclick='javascript:cptaajaxPagination1(1,$cptaLimit)'>Prev</a></li>";
		for( $cpta=1; $cpta<=ceil($cpta_Paginationlist); $cpta++){ 
			if( $cpta ==  0 || $cpta ==  1 ){ $active="active"; }else{ $active=""; }
			echo "<li><a href='javascript:void(0);' id='post' class='$active' data-posttype='$cptaType' onclick='cptaajaxPagination1($cpta,$cptaLimit);'>$cpta</a></li>";
		}
		echo "<li class='pagitext'><a href='javascript:void(0);' onclick='javascript:cptaajaxPagination1(2,$cptaLimit)'>Next</a></li>";
		echo "</ul>";
	echo "</div>";

}


add_shortcode( 'sidebar', 'faqsidebar' );

require_once ( get_stylesheet_directory() . '/netttus-theme-panel.php');

function add_theme_menu_item()
{
	add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");

function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Theme Panel</h1>
	    <form method="post" action="options.php" enctype="multipart/form-data">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function display_twitter_element()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_fb_element()
{
	?>
		<textarea name="fb_url" id="fb_url" rows="5" cols="40"><?php echo get_option('fb_url');?></textarea>
    <?php
}

function logo_display()
{
	?>
        <input type="file" name="logo" /> 
        <?php echo get_option('logo'); ?>
   <?php
}

function handle_logo_upload()

{
global $option;
if($_FILES["logo"]["tmp_name"]){
    $tmp_name = $_FILES['logo']['tmp_name'];
    $item = $_FILES['logo'];
    $uploads = wp_upload_dir();
	$overrides = array('test_form' => false);
    $uploaded_file = wp_handle_upload($item, $overrides);
     $temp = $uploaded_file["url"];
	 $attachment = array(
        'post_mime_type' => $uploaded_file['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $uploaded_file['file'] ) ),
        'post_content' => '',
        'post_author' => '',
        'post_status' => 'inherit',
        'post_type' => 'attachment',
        'post_parent' => $new_reseller_id,
        'guid' => $uploaded_file['file']
    );
 $attachment_id = wp_insert_attachment( $attachment, $uploaded_file['file'] );
 $attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );

 wp_update_attachment_metadata( $attachment_id,  $attach_data );

	return $temp;     

}

return $option;

}

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
	add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
	add_settings_field("fb_url","textarea", "display_fb_element", "theme-options", "section");
    add_settings_field("logo", "Logo", "logo_display", "theme-options", "section");  

	 register_setting("section", "twitter_url");
	 register_setting("section", "fb_url");
    register_setting("section", "facebook_url");
    register_setting("section", "logo", "handle_logo_upload");
}

add_action("admin_init", "display_theme_panel_fields");
function sb_user_meta( $data, $field_name, $request ) {
	if( $data['id'] ){
		$user_meta = get_user_meta( $data['id'] );
	}
	if ( !$user_meta ) {
    return new WP_Error( 'No user meta found', 'No user meta found', array( 'status' => 404 ) );
  }
  foreach ($user_meta as $key => $value) {
		$data[$key] = $value;
	}
	return $data;
}
add_action( 'rest_api_init', function () {
    register_api_field( 'user',
        'meta',
        array(
            'get_callback'    => 'sb_user_meta',
            'update_callback' => null, // add callback here for POST/PUT requests to update user meta
            'schema'          => null,
        )
    );
	
	  register_rest_route( 'myplugin/v1', '/author/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'my_awesome_func',
  ) );
} );

function my_awesome_func( $data ) {
  $posts = get_posts( array(
    'author' => $data['id'],
  ) );
 
  if ( empty( $posts ) ) {
    return null;
  }
 
  return $posts[0]->post_title;
}


add_action( 'add_meta_boxes', 'cd_meta_box_add' );

function add_cafe_meta_boxes() {
	add_meta_box("lesson_list_meta", "Lesson List", "add_lesson_list_meta_box", "faqs", "normal", "high");
}
function add_lesson_list_meta_box()
{
	global $post;
	$custom = get_post_custom( $post->ID );
 
	?>
	<style>.width99 {width:99%;}</style>

<p>
		<label>Address:</label><br />
		<textarea rows="5" name="address" class="width99"><?= @$custom["address"][0] ?></textarea>
	</p>
<p>
<select class="width99" name="lessons" required>
<option value="">select</option>
<option value="red" selected="selected">red</option>
<option value="green" selected="selected">green</option>
<option value="blue" selected="selected">blue</option>
</select>
</p>
	<?php
}
/**
 * Save custom field data when creating/updating posts
 */
function save_cafe_custom_fields(){
  global $post;
 
  if ( $post )
  {
	  update_post_meta($post->ID, "address", @$_POST["address"]);
    update_post_meta($post->ID, "lessons", @$_POST["lessons"]);
  }
}
add_action( 'admin_init', 'add_cafe_meta_boxes' );
add_action( 'save_post', 'save_cafe_custom_fields' );