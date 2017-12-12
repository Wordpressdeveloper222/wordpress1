<?php
/**
 * Template Name: Front End Post Template
**/
get_header(); ?>
<?php
	$postTitleError = '';
	$postContentError = '';
	
	if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "frontnewPost") {
		
		if ( trim( $_POST['postTitle'] ) === '' ) {
			$postTitleError = 'Please enter a title.';
			$hasError = true;
		}
		if ( trim( $_POST['postContent'] ) === '' ) {
			$postContentError = 'Please enter the post content.';
			$hasError = true;
		}
		
		if (isset ($_POST['postTitle'])) {
	        $postTitle =  $_POST['postTitle'];
	    }
		
	    if (isset ($_POST['postContent'])) {
	        $postContent = $_POST['postContent'];
	    }
 echo $checkBox = implode(',', $_POST['cat2']); 
 echo $checkBox1 = $_POST['cat2']; 
echo $dp1 = $_POST['cat']; print_r($dp1);
 //exit;
 // echo $dropdown = implode(',', $_POST['cat']); exit;
		if ( isset($_POST['postTitle']) && isset($_POST['postContent']) && ( $hasError==false )) {
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
			
 	    	$post_id = wp_insert_post($new_post);
  
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
					</div>		
					<br/>
					
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
						<?php $select_cats = wp_dropdown_categories( array( 'echo' => 0, 'taxonomy' => 'category', 'hide_empty' => 0 ) );
							  $select_cats = str_replace( "name='cat' id=", "name='cat[]' multiple='multiple' id=", $select_cats );
							  echo $select_cats; ?>
							  
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
					
					<!-- post tags -->
					<div class="control-group string postTags">
						<label for="postTags" class="string control-label">Tags (comma separated)</label>
						<div class="controls">
							<input type="text" name="postTags" id="postTags" class="string span6">
						</div>
					</div>
					
					<br/>
					<fieldset class="submit">
						<input type="submit" value="Post Review" tabindex="40" id="submit" name="submit" class="btn-sm" />
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