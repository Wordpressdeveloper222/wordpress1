<?php

/* --------------------------------------------------------------------------

  Maha Posts Filter Function

    - Posts Filter - Mark 1.0.0

 ---------------------------------------------------------------------------*/


/* --------------------------------------------------------------------------
 * [maha_cover_format - Post Cover Format ]
 ---------------------------------------------------------------------------*/
function maha_loop($fields = array()){
  // Available Vars
  $loop_categories = array(); if ( !empty($fields['loop_categories']) ) { $loop_categories = $fields['loop_categories']; }
  $loop_tags = array(); if ( !empty($fields['loop_tags']) ) { $loop_tags = $fields['loop_tags']; }
  $loop_order = array(); if ( !empty($fields['loop_order']) ) { $loop_order = $fields['loop_order']; }
  $loop_number_posts = array(); if ( !empty($fields['loop_number_posts']) ) { $loop_number_posts = $fields['loop_number_posts']; }
  $loop_offset = 0; if ( !empty($fields['loop_offset']) ) { $loop_offset = $fields['loop_offset']; }
  $loop_featured = array(); if ( !empty($fields['loop_featured']) ) { $loop_featured = $fields['loop_featured']; }

  $add_meta = array();
  $add_category = array();
  $add_offset = array();
  $add_order = array('order' => 'DESC');

  // Popular All Time ++
  if ( $loop_order == 'popular_alltime') {
    $add_meta = array(
      'meta_key' => 'post_views_count',
      'orderby' => 'meta_value_num'
      );
  }

  // Popular last 7 days ++
  if ( $loop_order == 'popular_past7') {
    $add_meta = array(
      'year' => date('Y'),
      'w' => date('W'),
      'meta_key' => 'post_views_count',
      'orderby' => 'meta_value_num'
      );
  }

  // Featured
  if ( $loop_order == 'featured') {
    $add_meta = array(
      'meta_key' => 'featured_post',
      'meta_value' => 1
    );
  }

  // Sorting
  if ( $loop_order == 'rand') {
    $add_order = array(
      'orderby' => 'rand'
    );
  }

  // Offset
  if ( $loop_offset != 0 ) {
    $add_offset = array(
      'offset' => $loop_offset
    );
  }

  if ( $loop_order != 'featured') {
    $val = '';
    if($loop_featured == 'without') {
      $add_meta = array(
          'meta_key' => 'featured_post',
          'meta_value' => 0
      );
    } else if($loop_featured == 'featured') {
      $add_meta = array(
          'meta_key' => 'featured_post',
          'meta_value' => 1
      );
    }
  }

  $query_args = array(
    'post_type' => 'post',
    'posts_per_page' => $loop_number_posts,
    'category__in' => $loop_categories,
    'tag__and' => $loop_tags,
    'post_status' => 'publish',
    'ignore_sticky_posts' => true
  );

  return $query_args + $add_meta + $add_order + $add_offset;

}



?>