<?php
/*
Plugin Name: Posts From Frontend
Plugin URI: 
Description: Add shortcode  [post_from_frontend]
Author: Webindia Inc
Version: 1.0.0
Author URI: 
*/
?>
<?php
class posts_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct('posts_Widget', 'Posts From Frontend Widget', array('description' => __('Posts From Frontend Widget', 'text_domain')));
    }
	
	 public function form($instance) {
        if (isset($instance['title'])) {
             $title = $instance['title'];
        } else {
             $title = __('Widget Slideshow', 'text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }
    public function widget($args, $instance) {
        extract($args);
        //the title	
        $title = apply_filters('widget_title', $instance['title']);
        //echo $before_widget;
        if (!empty($title))
            echo $before_title . $title . $after_title;
        echo frontend_posts();
        echo $after_widget;
    }
}	
function posts_widgets_init() {
    register_widget('posts_Widget');
}
add_action('widgets_init', 'posts_widgets_init');


global $error_array;
$error_array = array();
add_shortcode( 'post_from_frontend', 'frontend_posts' ); 
function insert_frontend_posts() { 
	$postTitleError = '';
	$postContentError = '';
	$postimageerror = '';

	
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "frontnewPost") {
		
	if ( trim( $_POST['postTitle'] ) === '' ) {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	}
	
	if ( trim( $_POST['postContent'] ) === '' ) {
		$postContentError = 'Please enter the post content.';
		$hasError = true;
	}
		$email1 = $_POST["email"];
		$check = preg_match(
        '/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/', $email1
);
	if(!$check) {
		$postemailerror = 'Please enter valid Email.';
		$hasError = true; 
	}		
	if (isset ($_POST['postTitle'])) {
	     $postTitle =  $_POST['postTitle'];
	 }
		
	$image_count = count(array_filter($_FILES['image']['name']));
		if($image_count < 0)
			{
				$postimageerror = 'Please upload minimum 3 images.';	
				$hasError = true;
			}
	}	
?>
<div class="required">
<?php if ( $postTitleError != '' ) { ?>
		<span class="error"><?php echo $postTitleError; ?></span>
			 <div class="clearfix"></div>
				<?php  } ?>
			<?php if ( $postContentError != '' ) { ?>
				<span class="error"><?php echo $postContentError; ?></span>
				<div class="clearfix"></div>
			<?php  } ?>
			<?php if ( $postemailerror != '' ) { ?>
					<span class="error"><?php echo $postemailerror; ?></span>
					<div class="clearfix"></div>
			<?php  } ?>
			<?php if ( $postimageerror != '' ) { ?>
					<span class="error"><?php echo $postimageerror; ?></span>
					<div class="clearfix"></div>
<?php }  ?> </div> <?php

if ( isset($_POST['postTitle']) && isset($_POST['postContent']) && ( $hasError==false )) { 
	 if (isset ($_POST['postContent'])) {
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    $files = $_FILES["image"];
	
 foreach ($files['name'] as $key => $value) {
     if ($files['name'][$key]) {
         $file = array(
            'name' => $files['name'][$key],
            'type' => $files['type'][$key],
            'tmp_name' => $files['tmp_name'][$key],
            'error' => $files['error'][$key],
            'size' => $files['size'][$key]
         );
$_FILES = array("upload_file" => $file);  

$attachment_id = media_handle_upload("upload_file", 0);
 if (is_wp_error($attachment_id)) {
        print_r( $attachment_id->get_error_message());
    }
	else {
                $image_gallery[] =  wp_get_attachment_image($attachment_id, array(800, 600)) . "<br>"; //Display the uploaded image with a size you wish. In this case it is 800x600 
				 } 
		} 
	}

if(isset($_POST["traveltips"]) && is_array($_POST["traveltips"])){
		$count = count($_POST['traveltips']);
		$traveltips = implode("<br/>",  $_POST["traveltips"]); 
		echo $ima = implode(",",$image_gallery);
		echo $postContent = $_POST['postContent'] . ' <br/>' .  'Travel Tips' . '<br/>' . $traveltips . '<br/>' . $ima;  
}

$checkBox1 = $_POST['cat2']; 
		
	//	$postTags = trim($_POST['postTags']);
		global $wpdb;
		
		$new_post = array(
		'post_title'    =>   $postTitle,
		'post_content'  =>   $postContent,
		'post_category' => $checkBox1,
		'tags_input'    =>   array($postTags),
		'post_status'   =>   'pending',         
		'post_type' =>   'post'  
		);
		$post_id = wp_insert_post($new_post); 
		$email = $_POST['email'];
		add_post_meta($post_id, 'email', $email, true);
		//$post_id .=add_meta_box( 'linkToArcticle', 'Link to arcticle', 'linkToArcticle', 'arcticles', 'normal', 'default' );
		//wp_set_post_tags($post_id, $_POST['postTags']);
		wp_redirect( home_url() );
		return $post_id;
	} 			
}
}
?>
<?php function frontend_posts() { ?>
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>css/style.css">
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<div class="form-content container">

    			<!-- FORM -->
				<div class="wpcf7">
				<form id="new_post" name="new_post" method="post" action="" class="wpcf7-form form-horizontal" enctype="multipart/form-data" role="form">
					
					<br/>
					<!--email-->
					 <div class="control-group string email">
						<label for="Email" class="string control-label">Email</label>
						<div class="controls">
							<input type="text" name="email" id="email" class="string span6" value="">
						</div>
					</div>
					
					<!-- post name -->
					<div class="control-group string postTitle">
						<label for="postTitle" class="string control-label">Title</label>
						<div class="controls">
							<input type="text" name="postTitle" id="postTitle" class="string span6" value="<?php if ( isset( $_POST['postTitle'] ) ) echo $_POST['postTitle']; ?>">
						</div>
					</div>
					<br/>
					<!-- post Content -->
					<div class="control-group string postContent">
						<label for="postContent" class="string control-label">Contents</label>
						<div class="controls">
							<textarea id="postContent" tabindex="15" name="postContent" cols="80" rows="10"><?php if ( isset( $_POST['postContent'] ) ) { if ( function_exists( 'stripslashes' ) ) { echo stripslashes( $_POST['postContent'] );} else { echo $_POST['postContent'];}} ?></textarea>
						</div>
					</div>
					<br/>
					
					<!-- post Category  -->
					<div class="control-group string postCategory">
						<label for="postCategory" class="string control-label">Category</label>
						<div class="controls">
						<?php // wp_dropdown_categories(); ?>
						<?php /*$select_cats = wp_dropdown_categories( array( 'echo' => 0, 'taxonomy' => 'category', 'hide_empty' => 0 ) );
							  $select_cats = str_replace( "name='cat' id=", "name='cat[]' multiple='multiple' id=", $select_cats );
							  echo $select_cats; */?>
							  
						<?php 
						 $args = array(
							'orderby'=>'name',
							'hide_empty' => 0,
						);
							$categories = get_categories( $args ); //echo '<pre>'; print_r($categories);
							foreach ($categories as $category2) { ?>
								<input type="checkbox" id="cat2" class="postform" name="cat2[]" value="<?php echo $category2->cat_ID; ?>"/><?php echo $category2->cat_name;  ?></br>
							<?php } ?>
 						</div>
					</div>
					<br/>
					
					<!--travel tips-->
					<div class="control-group string Travel Tips">
						<label for="postTraveltips class="string control-label">Travel tips</label>
						<div class="controls">
						<?php for($i=1 ; $i<=10 ; $i++) { echo $i;
						echo "<input type='text' id='traveltips'". $i." class='traveltips' value='' name='traveltips[]'  /></br>"; }?>
							<!--input type="text" name="travel_tips" id="travel tips" class="string span6" value=""-->
						</div>
					</div>
					<!-- Choose File -->
					<div class="control-group string postTags">
						<label for="Image" class="string control-label">Images (3 min pics required, 2mb max each): </label>
						<div class="controls">
							<?php for($i=1 ; $i<=10 ; $i++) { echo 'image' .$i;
						echo "<input type='file' id='image'". $i." class='image' value='' name='image[]' /></br>"; }?>
						</div>
					</div>
					 
					<br/>
					<fieldset class="submit">
						<input type="submit" value="Post Review"  id="submit" name="submit"  />
					</fieldset>
			
					<input type="hidden" name="action" value="frontnewPost" />
				</form>
				</div> 
				<!-- END WPCF7 -->
    			<!-- END OF FORM -->
    		</div>
			</div><!-- #content -->
	</div><!-- #primary -->
<?php  
$post_id = insert_frontend_posts();
//$post_id .= validation();
return $post_id;
 }
	?>