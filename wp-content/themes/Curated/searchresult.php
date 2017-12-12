<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Archive Page

 ---------------------------------------------------------------------------*/


$maha_options = get_option('curated');
	global $wp_query;
	$search = $_POST['search_string'];
	if($maha_options['search_option']=='all') $val_post=array('post','page');
    else $val_post=array($maha_options['search_option']);
	$args = array(
		's' => $search,
		'posts_per_page'=>$maha_options['ajax_search_number_post'],
		'post_type'=>$val_post,
		'post_status'=>'publish',
		'paged' => 1
		);
	$wp_query = new WP_Query( $args );
?>
<div class="row">
	<div class="col-sm-8 block-streams el-module-search">
		<div class="row">
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); 	
				// Module Loop ++++++++++++++++++++++++++
			?>
			<div <?php post_class("col-sm-12"); ?>>		
				<?php get_template_part ( 'includes/content/item', 'search' ); ?>
			</div>
		<?php endwhile;?>
		<?php
		else:
			echo '<div class="col-sm-12 meossage search-message">';
		_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
		echo '</div>';
		endif;
		?>
		</div>
	</div>
	<?php if($wp_query->found_posts > 0){?>
	<div class="col-sm-4">
		<div class="search-result-right">
			<?php _e('Total search results : '.$wp_query->found_posts.' post.', MAHA_TEXT_DOMAIN ); ?><br><br>
			<input type="submit" class="mh-button" value="VIEW ALL RESULTS">
		</div>
	</div>
	<?php }?>
</div>
<?php wp_reset_query(); ?>