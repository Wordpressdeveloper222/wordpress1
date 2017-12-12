<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Regular Slider

 ---------------------------------------------------------------------------*/

$maha_el_key = maha_el_key();

?>

<div class="mh-el blocked-slide">

	<?php
	// Start Container
	$thumb_size = "mh_large";
	if (get_sub_field('el_area') == 1) { echo '<div class="container">'; }
	if (get_sub_field('el_area') == 2) { $thumb_size = "mh_slide_large"; }
	?>

		<?php
		// Setup Query
		$loop_fields = array(
			'loop_categories' => get_sub_field('rslide_category'),
			'loop_tags' => get_sub_field('rslide_tags'),
			'loop_order' => get_sub_field('rslide_order'),
			'loop_number_posts' => get_sub_field('rslide_number_posts'),
			'loop_offset' => get_sub_field('rslide_offset')
		);

		$blocked_args = maha_loop($loop_fields);
		$wp_query = new WP_Query( $blocked_args );
		?>

		<?php
		// Setup Loop
		if ( $wp_query->have_posts() ) :
			?>
			<!-- Start Curated Slider -->
			<div id="<?php echo $maha_el_key; ?>" class="el-blocked-slide maha_royalSlider">
				<!-- <ul class="slides"> -->
					<?php

					$post_start = 1;
			        while ( $wp_query->have_posts() ) : $wp_query->the_post();
			        
			        	// Post Loop
        				// get_template_part ( 'includes/content/item', 'slide' );
        				?>
        				<div <?php post_class("i-slide rsContent"); ?>>
							<div class="full bContainer zoom-zoom" itemscope itemtype="http://schema.org/Article">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<img class="zoom-it three" itemprop="image" src="<?php echo maha_featured_url( get_the_ID() , $thumb_size); ?>" alt="<?php the_title(); ?>" />
								</a>
								<div class="detail">
									<div class="row">
										<div class="col-sm-8">
											<div class="meta-info">
												<span class="ava-auth">
													<img width="14" height="14" class="entry-thumb" src="<?php echo maha_avatar_url(get_avatar( get_the_author_meta('user_email'), 48 )); ?>" alt="" title="<?php the_author(); ?>"/>
												</span>
												<span itemprop="author" class="entry-author"><?php the_author(); ?></span>, 
												<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
													<?php the_time( get_option( 'date_format' ) ); ?>
												</time>
											</div>
											<a class="a-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<h2 itemprop="name"><?php the_title(); ?></h2>
											</a>
											<meta itemprop="headline" content="<?php the_title(); ?>" />
											<div class="meta-count">
												<?php if ( maha_meta_review( get_the_ID() ) != '' ) { ?>
													<span class="i-review"><i class="icon-star"></i> <?php echo maha_meta_review( get_the_ID() ); ?></span>
												<?php } ?>
												<span class="i-category"><?php maha_post_category( get_the_ID() ); ?></span>
											</div>
										</div>
										<div class="col-sm-4">
											<!-- Hello -->
										</div>
									</div>
								</div>
							</div>
						</div>
        				<?php

			           	$post_start++;
			        endwhile;
			        ?>

			    <!-- </ul> -->
		    </div>

		    <script type="text/javascript">
		    	jQuery(document).ready(function($) {
					jQuery("#<?php echo $maha_el_key; ?>").maha_royalSlider({
						arrowsNav: true,
						arrowsNavAutoHide: false,
						fadeinLoadedSlide: false,
						controlNavigationSpacing: 0,
						imageScaleMode: 'fill',
						imageAlignCenter:false,
						blockLoop: true,
						loop: true,
						numImagesToPreload: 5,
						transitionType: 'fade',
						autoScaleSlider: true, 
						autoScaleSliderWidth: 750,
	    				autoScaleSliderHeight: 410,
						keyboardNavEnabled: true,
						transitionSpeed: 900,
						autoPlay: {
				    		enabled: true,
				    		pauseOnHover: true,
							delay: 4700
				    	},
						block: {
							delay: 2500
						}
					}).addClass('up-up');
				});
		    </script>

		    <?php
		    
        else:

            echo '<div class="com-sm-12 message">';
			_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
			echo '</div>';
		endif;
		?>

		<?php wp_reset_query(); ?>

	<?php
	// End of container
	if (get_sub_field('el_area') == 1) { echo '</div>'; }
	?>
	
</div>