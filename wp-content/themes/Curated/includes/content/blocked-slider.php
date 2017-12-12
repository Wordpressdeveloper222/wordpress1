<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Blocked Slider - for Category

 ---------------------------------------------------------------------------*/

$maha_el_key = maha_el_key();

?>

<?php
// Setup Query
$wp_query = new WP_Query(
	array(
		'post_type' => 'post',
		'category__and' => array(get_query_var('cat')),
		'meta_key' => 'featured_post',
		'meta_value' => 1,
		'posts_per_page' => 5,
    	'orderby' => 'rand'
	)
);
?>

<?php
// Setup Loop
if ( $wp_query->have_posts() ) :
	?>
		<!-- Start Curated Slider -->
		<div id="<?php echo $maha_el_key; ?>" class="el-blocked-slide royalSlider">

			<?php

			$post_start = 1;
	        while ( $wp_query->have_posts() ) : $wp_query->the_post();
	        
        		// Post Loop
	        	// get_template_part ( 'includes/content/item', 'slide' );
	        	?>
	        	<div <?php post_class("i-slide rsContent"); ?>>
					<div class="full bContainer zoom-zoom" >
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<img class="zoom-it three" typeof="foaf:Image" src="<?php echo maha_featured_url( get_the_ID() , 'mh_slide_large'); ?>" alt="<?php the_title(); ?>" />
						</a>
						<div class="detail">
							<div class="row">
								<div class="col-sm-8">
									<div class="meta-info">
										<span class="ava-auth">
											<img width="14" height="14" itemprop="image" class="entry-thumb" src="<?php echo maha_avatar_url(get_avatar( get_the_author_meta('user_email'), 48 )); ?>" alt="" title="<?php the_author(); ?>"/>
										</span>
										<span itemprop="author" class="entry-author"><?php the_author(); ?></span>, 
										<time itemprop="dateCreated" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
											<?php the_time( get_option( 'date_format' ) ); ?>
										</time>
									</div>
									<a class="a-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<h2><?php the_title(); ?></h2>
									</a>
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

	    </div>

	    <div class="line-divider"></div>

	    <script type="text/javascript">
	    	jQuery(document).ready(function($) {
		    	jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
				$("#<?php echo $maha_el_key; ?>").maha_royalSlider({
					arrowsNav: true,
					arrowsNavAutoHide: false,
					fadeinLoadedSlide: false,
					controlNavigationSpacing: 0,
					imageScaleMode: 'fill',
					imageAlignCenter:true,
					blockLoop: true,
					loop: true,
					numImagesToPreload: 5,
					transitionType: 'fade',
					keyboardNavEnabled: true,
					autoScaleSlider: true, 
					autoScaleSliderWidth: 750,
    				autoScaleSliderHeight: 410,
					transitionSpeed: 900,
					autoPlay: {
			    		enabled: true,
			    		pauseOnHover: true,
						delay: 4700
			    	},
					block: {
						delay: 2500
					}
				});
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
