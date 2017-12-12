<?php
/**
 * Template Name: Front End Post Template
**/
get_header(); //error_reporting(E_ALL);?>
<?php
	$postTitleError = '';
	$postContentError = '';
	$postimageerror = '';
	
	if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "frontnewPost") {
		/*if ( trim( $_POST['email'] ) === '' ) {
			$postTitleError = 'Please enter a email.';
			$hasError = true;
		}*/
		
		if ( trim( $_POST['postTitle'] ) === '' ) {
			$postTitleError = 'Please enter a title.';
			$hasError = true;
		}
		if ( trim( $_POST['postContent'] ) === '' ) {
			$postContentError = 'Please enter the post content.';
			$hasError = true;
		}
		/*if (isset ($_POST['email'])) {
	        $email =  $_POST['email'];
	    }*/
		
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
     //   echo  'The image was uploaded successfully!';
                $image_gallery[] =  wp_get_attachment_image($attachment_id, array(800, 600)) . "<br>"; //Display the uploaded image with a size you wish. In this case it is 800x600
				 } 
	 } 
	}		
	if(isset($_POST["traveltips"]) && is_array($_POST["traveltips"])){
					$count = count($_POST['traveltips']);
					$traveltips = implode("<br/>", $_POST["traveltips"]);
					 $ima = implode("<br/>",$image_gallery);
					  $postContent = $_POST['postContent'] . ' <br/>' .  'Travel Tips' . '<br/>' . $traveltips . '<br/>' . $ima;  
		 }

	$checkBox1 = $_POST['cat2']; 
		
			$postTags = trim($_POST['postTags']);
			global $wpdb;
			
	    	$new_post = array(
		    'post_title'    =>   $postTitle,
		    'post_content'  =>   $postContent,
	    //	'post_category' =>   array($_POST['cat']),//array($_POST['cat']), // if specific category, then set it's id like: array(4),  
			'post_category' => $checkBox1,
		    'tags_input'    =>   array($postTags),
	    	'post_status'   =>   'pending',         
		    'post_type' =>   'post'  
		    );
			
 	    	$post_id = wp_insert_post($new_post); $email = 'hey';
			add_post_meta($post_id, 'cust_key', $email, true);
 	    	wp_set_post_tags($post_id, $_POST['postTags']);
			
 	    	//$link = get_permalink( $post_id );
			//echo "<meta http-equiv='refresh' content='0;url=$link' />"; exit;
			wp_redirect( home_url() );
		}
 		
			
		}

?>
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<div class="form-content container">

    			<!-- FORM -->
				<div class="wpcf7">
				<form id="new_post" name="new_post" method="post" action="" class="wpcf7-form form-horizontal" enctype="multipart/form-data" role="form">
					
					<div class="required">
						<?php if ( $postTitleError != '' ) { ?>
								<span class="error"><?php echo $postTitleError; ?></span>
								<div class="clearfix"></div>
						<?php } ?>
						<?php if ( $postContentError != '' ) { ?>
								<span class="error"><?php echo $postContentError; ?></span>
								<div class="clearfix"></div>
						<?php } ?>
						<?php if ( $postimageerror != '' ) { ?>
								<span class="error"><?php echo $postimageerror; ?></span>
								<div class="clearfix"></div>
						<?php } ?>
					</div>		
					<br/>
					<!--email-->
					<!--div class="control-group string postTitle">
						<label for="postEmail" class="string control-label">Email</label>
						<div class="controls">
							<input type="text" name="email" id="email" class="string span6" value="<?php if ( isset( $_POST['email'] ) ) echo $_POST['email']; ?>" >
						</div>
					</div-->
					
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
					<div class="control-group string postTitle">
						<label for="postTraveltips class="string control-label">Travel tips</label>
						<div class="controls">
						<?php for($i=1 ; $i<=3 ; $i++) { echo $i;
						echo "<input type='text' id='traveltips'". $i." class='traveltips' value='' name='traveltips[]' required/></br>"; }?>
							<!--input type="text" name="travel_tips" id="travel tips" class="string span6" value=""-->
						</div>
					</div>
					<!-- Choose File -->
					<div class="control-group string postTags">
						<label for="Image" class="string control-label">Images (3 min pics required, 2mb max each): </label>
						<div class="controls">
							<?php for($i=1 ; $i<=3 ; $i++) { echo 'image' .$i;
						echo "<input type='file' id='image'". $i." class='image' value='' name='image[]' /></br>"; }?>
						</div>
					</div>
					
					<br/>
					<fieldset class="submit">
						<input type="submit" value="Post Review" tabindex="40" id="submit" name="submit" class="btn-sm"  />
					</fieldset>
			
					<input type="hidden" name="action" value="frontnewPost" />
				</form>
				</div> 
				<!-- END WPCF7 -->

    			<!-- END OF FORM -->
    		</div>
				


		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>