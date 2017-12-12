<?php

/* --------------------------------------------------------------------------

	Maha Front End Function

    - Posts View - Mark 1.0.0

 ---------------------------------------------------------------------------*/


/* --------------------------------------------------------------------------
 * [maha_cover_format - Post Cover Format ]
 ---------------------------------------------------------------------------*/
function maha_next_post($format){
  $format = str_replace('href=', 'class="next" href=', $format);
  return $format;
}
add_filter('next_post_link', 'maha_next_post');
function maha_prev_post($format){
  $format = str_replace('href=', 'class="prev" href=', $format);
  return $format;
}
add_filter('previous_post_link', 'maha_prev_post');


/* -------------------------------------------------------------------------
 * [maha_get_viwr - Get Post Viewers ]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_get_viwr' ) ) {
    function maha_get_viwr($post_id){
        $count_key = 'post_views_count';
        $count = get_post_meta($post_id, $count_key, true);
        if($count==''){
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
            return __("0 View", MAHA_TEXT_DOMAIN);
        }
        return $count.' ';
    }
}


/* -------------------------------------------------------------------------
 * [maha_set_viwr - Set Post Viewers ]
 --------------------------------------------------------------------------*/
if ( !function_exists( 'maha_set_viwr' ) ) {
    function maha_set_viwr($post_id) {
        $count_key = 'post_views_count';
        $count = get_post_meta($post_id, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        }else{
            if(!isset($_COOKIE['visited'])){
            		$posts_visited = serialize(array(0,$post_id));
                setcookie ("visited", $posts_visited, time() + 60*60*24);
                $count++;
                update_post_meta($post_id, $count_key, $count);
            } else {
            		$old = unserialize( $_COOKIE['visited']);
            		if ( !in_array($post_id, $old) ) {
            			$old[] = $post_id;
                	setcookie ("visited", serialize($old), time() + 60*60*24);
                	$count++;
                	update_post_meta($post_id, $count_key, $count);
            		}
            }
        }
    }
}


/* --------------------------------------------------------------------------
 * [maha_curated_moz_model - Mozaic ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_curated_moz_model') ) {

	function maha_curated_moz_model($number_of_posts){

	    // Create Layout for Each Slide
		$slide_model = array(4,3);
		$slide_style = array(1,2);
		
		switch ($number_of_posts) {
			case '8':
				$slide_model = array(4,4);
				$slide_style = array(1,2);
				break;
			case '9':
				$slide_model = array(4,5);
				$slide_style = array(1,1);
				break;
			case '10':
				$slide_model = array(4,3,3);
				$slide_style = array(1,1,2);
				break;
			case '11':
				$slide_model = array(4,3,4);
				$slide_style = array(1,2,2);
				break;
			case '12':
				$slide_model = array(4,3,5);
				$slide_style = array(1,2,1);
				break;
			case '13':
				$slide_model = array(4,4,5);
				$slide_style = array(1,3,1);
				break;
			case '14':
				$slide_model = array(4,5,5);
				$slide_style = array(1,1,2);
				break;
			case '15':
				$slide_model = array(4,4,3,4);
				$slide_style = array(1,3,2,2);
				break;
			case '16':
				$slide_model = array(4,4,3,5);
				$slide_style = array(1,3,1,2);
				break;
			case '17':
				$slide_model = array(4,4,5,4);
				$slide_style = array(1,3,2,1);
				break;
			case '18':
				$slide_model = array(4,5,4,5);
				$slide_style = array(1,1,3,2);
				break;
			
			default:
				$slide_model = array(4,3);
				$slide_style = array(1,2);
				break;
		}

		return array(
			'slide_model' => $slide_model,
			'slide_style' => $slide_style
		);
	}
}


/* --------------------------------------------------------------------------
 * [maha_curated_moz_item - Mozaic Item Class ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_curated_moz_item') ) {

	function maha_curated_moz_item($model,$moz){

	    // Create Layout for Each Slide
		$class = array('big','medium','small','small');
		
		switch ($model) {
			case '41':
				$class = array('big','medium','small','small');
				break;
			case '42':
				$class = array('big','small','small','medium');
				break;
			case '43':
				$class = array('medium','big','small','small');
				break;
			case '51':
				$class = array('medium','small','small','medium','medium');
				break;
			case '52':
				$class = array('medium','medium','small','small','medium');
				break;
			case '31':
				$class = array('big','medium','medium');
				break;
			case '32':
				$class = array('medium','medium','big');
				break;
			default:
				$class = array('big','medium','small','small');
				break;
		}

		return $class[$moz];
	}
}


/* --------------------------------------------------------------------------
 * [maha_meta_review - Review Score ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_meta_review') ) {

	function maha_meta_review($post_id){

		$meta_review = '';
		if ( get_field('enable_review',$post_id) == '1' ) { 
			$get_score = get_field('score_module',$post_id);
			foreach ($get_score as $key => $v_score) {
				$i_score[$key] = $v_score['review_number'];
			}
			$meta_review = round( array_sum($i_score) / count($get_score) , 2 );
		}
		return $meta_review;
	}
}


/* --------------------------------------------------------------------------
 * [maha_parallax_feat - Is Parallax with featured posts  ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_parallax_feat') ) {

	function maha_parallax_feat($post_id){
		$ocg = '';
	  	if ( get_field( 'top_featured_post', $post_id ) == '1' ) {
			$ocg = 'with-fp';
		}
	  return $ocg;
	}
}


/* --------------------------------------------------------------------------
 * [maha_format_gallery - Format Gallery ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_format_gallery') ) {

	function maha_format_gallery($post_id){

		// Identify
		$post_format = get_post_format($post_id);
		$cover_type = get_field( 'cover_post', $post_id );
		$get_gallery = get_field( 'gallery_module', $post_id );

		// Default Output Format - Parallax & Boxed
		$ofg = '';
		$i_wrap_start = '<div class="cf-gallery">';
		$i_wrap_end = '</div>';
		$i_size = '';
		$i_start = '<div class="cf-item">';
		$i_end = '</div>';

		// Output Format - Regular
		if ( $cover_type == 'regular' ||  $cover_type == 'title') {
			$i_wrap_start = '<div class="mini-gallery el-blocked-slide maha_royalSlider">';
			$i_wrap_end = '</div>';
			$i_size = 'mh_gallery';
			$i_start = '<div class="i-slide rsContent"><div class="full bContainer">';
			$i_end = '</div></div>';
		}

		// Just for Gallery
		if ($post_format == 'gallery' ) {

			// Loop Output
			$ofg .= $i_wrap_start;
			foreach ($get_gallery as $key => $v_image) {
				$ofg .= $i_start;
				$ofg .= '<img class="cf-image" src="'.maha_attachment_url($v_image['gallery_item'], $i_size).'" alt="">';
				$ofg .= $i_end;
			}
			$ofg .= $i_wrap_end;

		}

		// Final Output
		echo $ofg;

	}
}

/* --------------------------------------------------------------------------
 * [maha_format_video - Format Video ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_format_video') ) {

	function maha_format_video($post_id){

		// Identify
		$post_format = get_post_format($post_id);
		$cover_type = get_field( 'cover_post', $post_id );
		$title_video = get_field('video_title', $post_id);
		$playbar_video = get_field('video_playbar', $post_id);
		$related_video = get_field('video_related', $post_id);
		if($playbar_video=='') $playbar_video=0;
		if($title_video=='') $title_video=0;
		if($related_video=='') $related_video=0;
		$get_video = get_field( 'video_module', $post_id );
		$maha_option = get_option('curated');

		if ( ( strpos($get_video, 'https://') === false ) && ( strpos($get_video, 'http://') === false ) ) {
			$get_video = 'https://'.$get_video;
		}

		// Default Output Format - Parallax & Boxed
		$ofg = '';

		// Generate Output 
		if ( $post_format == 'video' ) {

			if ( $cover_type == 'regular' ||  $cover_type == 'title') {

				$video_embed = wp_oembed_get( $get_video, array( 'showinfo' => $title_video,'info' => $title_video,'controls' => $playbar_video,'dummy' => 1, 'rel' => 0));
				$video_embed = str_replace('dummy=1', 'dummy=1&rel='.$related_video.'&related='.$related_video, $video_embed);
				$video_embed = str_replace('frameborder="0"', 'style="border:none"', $video_embed);
				$ofg = '<figure class="wrapper video-wrapper">' .$video_embed. '</figure>';

			} else {
				$play_text = '';
				if ( $maha_option['single_playr'] == true ) {
					$play_text = '<span class=play_button_text>'.$maha_option['play_button_text'].'</span>';
				}
				$ofg = '<div class="container play-media-wrap"><div class="play-the-media video" data-media="'.$get_video.'?showinfo='.$title_video.'&amp;info='.$title_video.'&amp;rel='.$related_video.'&amp;related='.$related_video.'&amp;controls='.$playbar_video.'"><i class="icon-play"></i>'.$play_text.'</div></div>';
			}

		}
		// Final Output		
		echo $ofg;
	}
}


/* --------------------------------------------------------------------------
 * [maha_format_audio - Format Audio ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_format_audio') ) {

	function maha_format_audio($post_id){

		// Identify
		$post_format = get_post_format($post_id);
		$cover_type = get_field( 'cover_post', $post_id );
		$get_audio = get_field( 'audio_module', $post_id );

		// Default Output Format - Parallax & Boxed
		$ofg = '';

		// Generate Output 
		if ( $post_format == 'audio' ) {

			if ( $cover_type == 'regular' ||  $cover_type == 'title') {

				$audio_embed = wp_oembed_get( $get_audio, array('rel' => 0));
				$audio_embed = str_replace('scrolling="no" frameborder="no"', 'style="border:none;overflow:hidden;"', $audio_embed);
				$ofg = '<figure class="wrapper video-wrapper">' .$audio_embed. '</figure>';

			} else {
				$ofg = '<div class="container play-media-wrap"><div class="play-the-media audio" data-media="'.$get_audio.'"><i class="icon-note-beamed"></i></div></div>';
			}

		}
		// Final Output
		echo $ofg;
	}
}


/* --------------------------------------------------------------------------
 * [maha_format_standard - Format Standard ]
 ---------------------------------------------------------------------------*/

if ( !function_exists('maha_format_standard') ) {

	function maha_format_standard($post_id){

		// Identify
		$post_format = get_post_format($post_id);
		$cover_type = get_field( 'cover_post', $post_id );

		// Default Output Format - Parallax & Boxed
		$ofg = '';

		// Generate Output 
		if ( $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' ) {

			if ( $cover_type == 'regular' ) {

				if ( has_post_thumbnail( $post_id ) ) {
					$ofg = '<div class="thumb-wrap"><img itemprop="image" class="entry-thumb" src="'.maha_featured_url( $post_id , 'mh_slide_large').'" alt="'.get_the_title($post_id).'" title="'.get_the_title($post_id).'"></div>';
				}

			}

		}
		// Final Output
		echo $ofg;
	}
}


/* --------------------------------------------------------------------------
 * [maha_setup_wp_gallery - Format Standard ]
 ---------------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'maha_setup_wp_gallery' );
function maha_setup_wp_gallery() {
	add_filter( 'post_gallery', 'maha_wp_gallery', 10, 2 );
}


/* -----------------------------------------------------------------------------
 * Render WP Gallery Shortcodes
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'maha_wp_gallery' ) ) {
	function maha_wp_gallery( $null, $attr = array() ) {
		global $post, $wp_locale;
		static $instance = 0;
		$maha_el_key = maha_el_key();
		$instance++;

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'figure',
			'captiontag' => 'figcaption',
			'columns'    => 3,
			'size'       => 'mh_xmedium',
			'include'    => '',
			'exclude'    => ''
		), $attr));


		$id = intval($id);
		if ( 'RAND' == $order )
		$orderby = 'none';
		
		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
		
		if ( empty($attachments) )
		return '';
		
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}
		
		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);

		$all_items = count($attachments);
		if ($all_items==1) {$gallery_layout='1';}
		if ($all_items==2) {$gallery_layout='2';}
		if ($all_items==3) {$gallery_layout='21';}
		if ($all_items==4) {$gallery_layout='31';}
		if ($all_items==5) {$gallery_layout='23';}
		if ($all_items==6) {$gallery_layout='312';}
		if ($all_items==7) {$gallery_layout='232';}
		if ($all_items==8) {$gallery_layout='314';}
		if ($all_items==9) {$gallery_layout='423';}
		if ($all_items==10) {$gallery_layout='3142';}
		if ($all_items==11) {$gallery_layout='2432';}
		if ($all_items==12) {$gallery_layout='3243';}
		
		$output = "<div id='gallery-".$maha_el_key."' class='maha-wp-gallery galleryid-{$id} clearfix' data-gallery-layout='{$gallery_layout}'>";
		
		$loop_layout = str_split($gallery_layout,1);

		if($itemtag != '' && $captiontag != '') {
			$i = 1;
			$loop_start = 0;
			$loop_i = 0;
			$loop_glayout = 0;
			foreach ( $attachments as $id => $attachment ) {

				if ($loop_i == 0) {
					$loop_glayout = current($loop_layout);
				}

				if ($loop_glayout == 1) {
					$size = 'mh_slide_large';
				} else {
					$size = 'mh_medium';
				}

				$output .= "<figure data-src='".wp_get_attachment_url($id)."' class='gallery-item g-size-".$loop_glayout."' data-title='".wptexturize($attachment->post_excerpt)."'>";

				// $output .= "<a href='".wp_get_attachment_url($id)."'>";
				$output .= "<a >";
					$output .= "<img class='gallery-thumb' src='".maha_attachment_url( $id , $size)."' alt='".wptexturize($attachment->post_excerpt)."' title='".wptexturize($attachment->post_excerpt)."'/>";
					if ( $captiontag && trim($attachment->post_excerpt) ) {
						$output .= "<div class='caption-wrap'><p class='wp-caption-text'>" . wptexturize($attachment->post_excerpt) . "</p></div>";
					}
				$output .= '</a>';

				$output .= "</figure>";
				$i++;

				$loop_start++;

				if ($loop_start == $loop_glayout) {
					$loop_i = 0;
					$loop_start = 0;
					next($loop_layout);
				}
			}
		}
		
		$output .= "</div>\n";

		$output .= "<script type='text/javascript'>
					jQuery(document).ready(function($){
					    $('#gallery-".$maha_el_key."').lightGallery({
					        loop:true,
					        caption: true,
					        speed:300,
					        useCSS : true,
					        escKey:true
					    }); 
					  });
					</script>";

		return $output;
	}
}
?>