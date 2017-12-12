<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Blocked 5

 ---------------------------------------------------------------------------*/
global $post;
$maha_el_key = maha_el_key();

?>

<div class="mh-el">

	<?php
	// Start Container
	if (get_sub_field('el_area') == 1) { echo '<div class="container">'; }
	?>

	<?php if ( get_sub_field('block_title') ) { ?>
	<!-- Block Cap -->
	<div class="row">
		<div class="col-sm-12">
			<div class="block-cap">
				<h3><?php echo do_shortcode(get_sub_field('block_title')); ?></h3>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="row block-streams el-block-5 up-up">

		<?php
		// Setup Query
		$loop_fields = array(
			'loop_categories' => get_sub_field('block_category'),
			'loop_tags' => get_sub_field('block_tags'),
			'loop_order' => get_sub_field('block_order'),
			'loop_number_posts' => get_sub_field('block_number_posts'),
			'loop_offset' => get_sub_field('block_offset'),
			'loop_featured' => get_sub_field('featured_post_option')
		);

		$blocked_args = maha_loop($loop_fields);
		$wp_query = new WP_Query( $blocked_args );
		?>

		<?php
		// Setup Loop
		if ( $wp_query->have_posts() ) :
			?>
			<div class="late-show">
			<div class="blocked-carousel" id="<?php echo $maha_el_key; ?>">
				<div class="carousel-wrapper">

			        <?php
			        while ( $wp_query->have_posts() ) : $wp_query->the_post();
			        
			        	?>
						<div <?php post_class("col-sm-3 swiper-slide"); ?>>
							<?php get_template_part ( 'includes/content/item', 'medium-simple' ); ?>
			        	</div>
			            <?php

			        endwhile;
			        ?>

			    </div>
		    	<div class="carousel-prev"><i class="icon-left-open-big"></i></div>
				<div class="carousel-next"><i class="icon-right-open-big"></i></div>
		    </div>
		    </div>

		    <script type="text/javascript">
		    	jQuery(document).ready(function($){
		    		$("#<?php echo $maha_el_key; ?>").each(function(){
				    	$("#<?php echo $maha_el_key; ?> .carousel-wrapper").carouFredSel({
							auto: 5400,
							infinite: true,
							circular: true,
							responsive: true,
					        items: {
								width : 280,
						        visible: {
						            min: 1,
						            max: 4
						        }
						    },
							swipe: {
								onMouse: true,
								onTouch: true
							},
							scroll: {
						    	items: 1,
						    	easing: 'easeInOutCubic',
					            duration: 500
						    },
							prev: "#<?php echo $maha_el_key; ?> .carousel-prev",
							next: "#<?php echo $maha_el_key; ?> .carousel-next"

						}).parents('.late-show').slideDown();
		    	});
	    	});
		    </script>

	        <?php
        else:

            echo '<div class="col-sm-12 message">';
			_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
			echo '</div>';
		endif;
		?>

		<?php wp_reset_query(); ?>

	</div>

	<?php
	// End of container
	if (get_sub_field('el_area') == 1) { echo '</div>'; }
	?>

</div>