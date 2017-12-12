<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Moz Slider

 ---------------------------------------------------------------------------*/

$maha_el_key = maha_el_key();

?>

<div class="mh-el moz-slide">

	<?php
	// Start Container
	if (get_sub_field('el_area') == 1) { echo '<div class="container">'; }
	?>

		<?php
		// Init Element Options
		$number_of_posts = get_sub_field( 'moz_of_slides' );
		$moz_boxed = get_sub_field( 'moz_boxed' );
		$moz_boxed_class = ''; if ($moz_boxed == true) {$moz_boxed_class = 'moz-boxed'; }

		// Count All Pusblished Posts
		$all_posts = wp_count_posts()->publish;

		// Minimum Posts number
		if ( $all_posts > 6 ) {
			
			// Set Initial Number of posts
			if ( $all_posts < $number_of_posts ) { $number_of_posts = $all_posts; }

			// Generate Layout
			$moz_layout = maha_curated_moz_model( $number_of_posts );
			$moz_model = $moz_layout['slide_model'];
			$moz_style = $moz_layout['slide_style'];

			?>
			<div id="<?php echo $maha_el_key; ?>" class="wrap-moz-slide maha_royalSlider <?php echo $moz_boxed_class; ?> up-up">
				<?php
				
				// Loop by Model
				$offset = 0;
				foreach ($moz_model as $key_model => $v_model) {

					// Query Loop
					$loop_fields = array(
						'loop_categories' => get_sub_field('moz_category'),
						'loop_tags' => get_sub_field('moz_tags'),
						'loop_order' => get_sub_field('moz_order'),
						'loop_number_posts' => $v_model
					);
					$loop_offset = array('offset' => $offset);
					$loop_orderby = array('orderby' => 'post_date');

					$moz_args = maha_loop($loop_fields) + $loop_offset + $loop_orderby;
					$wp_query = new WP_Query( $moz_args );

					if ( $wp_query->have_posts() ) :
						// Start Loop
						$moz = 0;
						$moz_small = 0;
						while ( $wp_query->have_posts() ) : $wp_query->the_post();

							// Start slide
							if ( $moz == 0 ) { echo '<div class="i-slide rsContent"><div class="bContainer">'; }

								// Start Moz Item
								$moz_class = maha_curated_moz_item($v_model.$moz_style[$key_model],$moz);

								if ( $moz_class == 'small' && $moz_small == 0 ) {
									echo '<div class="small2">';
								}
								if ( $moz_class == 'small' && $moz_small <= 2 ) {
									$moz_small++;
								}

								echo '<div class="moz-item '.$moz_class.'" data-url="'.get_permalink().'">';

									?>
									<div class="wrap-moz-item zoom-zoom">
										<div class="moz-item-cover zoom-it three" style="background-image: url(<?php echo maha_featured_url( get_the_ID() , 'mh_xmedium'); ?>)">
											<div class="detail">
												<div class="meta-count">
													<?php if ( maha_meta_review( get_the_ID() ) != '' ) { ?>
													<span class="i-review"><i class="icon-star"></i> <?php echo maha_meta_review( get_the_ID() ); ?></span>
													<?php } ?>
													<span class="i-category"><?php echo maha_post_category( get_the_ID() ); ?></span>
												</div>
												<a class="moz-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<h2><?php the_title(); ?></h2>
												</a>
											</div>
										</div>
									</div>
									<?php

								echo '</div>';

								if ( $moz_class == 'small' && $moz_small == 2 ) {
									echo '</div>';
									$moz_small=0;
								}

								// echo $moz.' x '.$v_model;

							// End slide
							if ( $moz == ($v_model-1) ) { echo '</div></div>'; }

						$moz++;
						endwhile;
					endif;

					wp_reset_query();

					$offset = $v_model + $offset;
				}

				?>

			</div>

			<script type="text/javascript">
				jQuery(document).ready(function($){
				var mozSlide = jQuery("#<?php echo $maha_el_key; ?>").maha_royalSlider({
					loop: true,
					arrowsNav: true,
					imageScaleMode: 'fill',
					arrowsNavAutoHide: false,
					arrowsNavHideOnTouch: true,
					fadeinLoadedSlide: false,
					numImagesToPreload: 5,
					autoScaleSlider: false,
					navigateByClick: false,
					autoPlay: {
			    		enabled: true,
			    		pauseOnHover: true,
			    		delay: 5600
			    	},
    				transitionType:'move',
    				usePreloader: true
				}).show().animate({'opacity':1}, 500);

				jQuery("#<?php echo $maha_el_key; ?>").find('.moz-item-cover > img').remove();

	    	});
			</script>

			<?php
		    	
		} else {

			echo '<div class="com-sm-12 message">';
			_e( 'Minimum number of posts is 7 for Moz Slider! <a href="'.admin_url("post-new.php").'">Create new post now </a>', MAHA_TEXT_DOMAIN );
			echo '</div>';
		}
		?>

	<?php
	// End of container
	if (get_sub_field('el_area') == 1) { echo '</div>'; }
	?>

</div>