<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Homepage Loop

 ---------------------------------------------------------------------------*/

global $post;
$pagination_style = get_field('pagination_style',$post->ID); 
if ( get_field('use_homepage',$post->ID) == 'enable' ) {
$block_type = get_field('home_block_type', $post->ID);
$col_sm = 6;$item_range = 2;
$col_sm2 = 4;		
if (get_field('page_sidebar', $post->ID) == 'page_sidebar_off') { $col_sm = 4;$col_sm2=3;$item_range = 3;}

wp_reset_query();
?>
<div class="mh-el" id="cur-page">

	<?php if ( get_field('home_title',$post->ID) ) { ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="block-cap">
				<h3><?php echo do_shortcode(get_field('home_title',$post->ID)); ?></h3>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php

	$paged = 1;
	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	if ( get_query_var('page') ) $paged = get_query_var('page');
	$pagination = array('paged' => $paged);

	$number_of_posts_config = get_field('home_number_posts',$post->ID);
	$offset_config = 0;
	if ( get_field('home_offset',$post->ID) != 0 ) {
		$offset_config = (($paged - 1) * $number_of_posts_config) + get_field('home_offset',$post->ID);
	}

	$loop_fields = array(
		'loop_categories' => get_field('home_category',$post->ID),
		'loop_tags' => get_field('home_tags',$post->ID),
		'loop_order' => get_field('home_order',$post->ID),
		'loop_number_posts' => $number_of_posts_config,
		'loop_offset' => $offset_config
	);
	$home_summary = get_field('home_summary', $post->ID);

	$home_args = maha_loop($loop_fields) + $pagination;
	$wp_query = new WP_Query( $home_args );
	// print_r($wp_query);

	if ( $wp_query->have_posts() ) :
	echo '<div class="cur-page-item row block-streams el-'.get_field('home_block_type', $post->ID).'">';
	$post_start = 1;
	while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post->i_summary = $home_summary;

		// Blocked 1 ++++++++++++++++++++
		if ( $block_type == 'block-1' ) {

			if ( $post_start <= $item_range ) {
	        		// Latest Post
		        	?>
					<div <?php post_class("up-up-child col-sm-".$col_sm); ?>>
						<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
		        	</div>
		            <?php
		            
	        	} else {
					// Posts Small Loop
					?>
					<div <?php post_class("up-up-child col-sm-".$col_sm); ?>>
						<?php get_template_part ( 'includes/content/item', 'small' ); ?>
		        	</div>
					<?php
	        	}
		}


		// Blocked 2 ++++++++++++++++++++
		if ( $block_type == 'block-2' ) {
			?>
			<div <?php post_class("up-up-child col-sm-".$col_sm); ?>>
				<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
			</div>
            <?php
		}


		// Blocked 3 ++++++++++++++++++++
		if ( $block_type == 'block-3' ) {
			?>
			<div <?php post_class("up-up-child col-sm-12"); ?>>
				<?php get_template_part ( 'includes/content/item', 'list' ); ?>
        	</div>
            <?php
		}


		// Blocked 4 ++++++++++++++++++++
		if ( $block_type == 'block-4' ) {		

			if ( $post_start == 1 ) {

	        		// Latest Post
		        	?>
					<div <?php post_class("up-up-child col-sm-".$col_sm); ?>>
						<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
		        	</div>
		            <?php
		            
	        	} else {
	        		echo '<div class="up-up-child col-sm-'.$col_sm.'">';	        		
					get_template_part ( 'includes/content/item', 'small' );
	        		echo '</div>';
	        	}
		}

		// Blocked 6 ++++++++++++++++++++
		if ( $block_type == 'block-6' ) {
			?>
			<div <?php post_class("up-up-child col-sm-".$col_sm2); ?>>
				<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
			</div>
            <?php
		}

		// Blocked 7 ++++++++++++++++++++
		if ( $block_type == 'block-7' ) {
			?>
			<div <?php post_class("up-up-child col-sm-".$col_sm); ?>>
				<?php get_template_part ( 'includes/content/item', 'small' ); ?>
			</div>
            <?php
		}
		
	$post_start++;
	endwhile;
	echo '</div>';
	endif;
	?>

	<?php if ($pagination_style == 'infinite_scroll') {?>
		<div class="a-nav">
			<div class="a-next"><?php next_posts_link( ' ' ); ?></div>
			<div class="a-prev"><?php previous_posts_link( ' ' ); ?></div>
		</div>
	<?php }else{ ?>
	<?php maha_pagination(); } ?>
	<?php wp_reset_query(); ?>

</div>
<?php } ?>