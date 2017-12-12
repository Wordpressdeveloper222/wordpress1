<?php 
/*
 * Template Name: Page Builder
*/
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014
	Please be extremely cautions editing this file!

    - Page Builder

 ---------------------------------------------------------------------------*/
global $post;
?>
<?php get_header(); ?>	

<?php
$maha_options = get_option('curated');
$all_fields_value = get_field( "page_composer" );

$is_content = false;
$a = 1;
$area_2 = 0;
$is_2 = false;

if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); }
while( has_sub_field( "page_composer" ) ):

	// Sidebar Options
	if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
		$page_type = 'page-sidebar';
	else :
		$page_type = 'page-full';
	endif;

	if ( get_sub_field('el_area') == 2 && $is_content == false ) {

		// Disable Collumn Layout
		$is_content = true;

		// Start Collumn
		echo '<div class="mh-el '.$page_type.'">
				<!-- start container -->
				<div class="container">
				<div class="row">
				<!-- Page -->';

				if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' ){
					echo '<div class="col-sm-8">';
				} else {
					echo '<div class="col-sm-12">';
				}

		$area_2++;

	}


	// Moz Slider ++++++++++++++++++++++++++
	if ( get_row_layout() == 'moz_slider' ) {
		if (get_field('use_homepage', $post->ID) == 'enable'){
			// Disable moz slider on page 2 (homepage)
			if (get_sub_field( 'moz_page_2' ) == 0) {
				if ($page < 2) {
					get_template_part ( 'includes/composer/moz', 'slider' );
				}
			} else {
				get_template_part ( 'includes/composer/moz', 'slider' );
			}
		} else {
			get_template_part ( 'includes/composer/moz', 'slider' );
		}
	}

	// Regular Slider ++++++++++++++++++++++++++
	if ( get_row_layout() == 'regular_slider' ) {
		if (get_field('use_homepage', $post->ID) == 'enable'){
			// Disable regular on page 2 (homepage)
			if (get_sub_field( 'regular_slider_page_2' ) == 0) {
				if ($page < 2) {
					get_template_part ( 'includes/composer/regular', 'slider' );
				}
			} else {
				get_template_part ( 'includes/composer/regular', 'slider' );
			}
		} else {
			get_template_part ( 'includes/composer/regular', 'slider' );
		}
	}

	// Blocked Posts ++++++++++++++++++++++++++
	if ( get_row_layout() == 'blocked_posts' ) {
		get_template_part ( 'includes/composer/blocked', 'posts' );
	}

	// Static Area ++++++++++++++++++++++++++
	if ( get_row_layout() == 'static_area' ) {
		get_template_part ( 'includes/composer/static', 'area' );
	}


	if ( count($all_fields_value) == $a ) {

		if ( $area_2 < 1 && $is_content == false ) {

			// Start Collumn
			echo '<div class="mh-el '.$page_type.'">
				<!-- start container -->
				<div class="container">
				<div class="row">
				<!-- Page -->';

				if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' ){
					echo '<div class="col-sm-8">';
				} else {
					echo '<div class="col-sm-12">';
				}

		}

		if (get_field('use_homepage', $post->ID) == 'enable'){ get_template_part ( 'includes/composer/homepage'); }

		wp_reset_query();
		echo '</div>';

		// Sidebar Collumn
		if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' ){
			echo '<!-- Sidebar -->
				<div class="col-sm-4">';
				get_sidebar();
			echo '</div>';
		}

		// End of Collumn
		echo '</div>
			</div>
			</div>';
	}


$a++;
endwhile;
?>
    
<?php get_footer(); ?>