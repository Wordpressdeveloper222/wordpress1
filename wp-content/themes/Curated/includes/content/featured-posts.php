<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Featured Posts

 ---------------------------------------------------------------------------*/

$maha_el_key = maha_el_key();
$maha_options = get_option('curated');

$tags = $maha_options['top_sticky_tag_filter'];
$cats = $maha_options['top_sticky_cat_filter'];
$filter = $maha_options['top_sticky_filter'];
$number_post = $maha_options['top_sticky_number_post'];
?>

<div class="container late-show featured-extra">

	<div class="row block-streams el-block-5 single-featured-posts">

		<?php

		$tag = '';
		$get_tag = array();
		if ( $tags != 0) {
			if (!isset($tags['alltags'])) {
				foreach ($tags as $key => $value) {
					$get_tag[] = $value;
				}
				$tag = $get_tag;
			}
		}

		$cat = '';
		$get_cat = array();
		if ( $cats != 0) {
			if (!isset($cats['allcats'])) {
				foreach ($cats as $key => $value) {
					$get_cat[] = $key;
				}
				$cat = $get_cat;
			}
		}


		if ( $filter == 'latest' ) {
			$wp_query = new WP_Query( 
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_key' => 'top_featured_post',
				'meta_value' => 1,
				'order' => 'DESC'
				)
			);
		} elseif ( $filter == 'featured' ) {
			$wp_query = new WP_Query( 
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'top_featured_post',
						'value' => 1
					)
				),
				'meta_key' => 'featured_post',
				'meta_value' => '1',
				'order' => 'DESC'
				)
			);
		} elseif ( $filter == 'random' ) {
			$wp_query = new WP_Query( 
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_key' => 'top_featured_post',
				'meta_value' => 1,
				'orderby' => 'rand'
				)
			);
		} elseif ( $filter == 'popular_all' ) {
			$wp_query = new WP_Query( 
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'top_featured_post',
						'value' => 1
					)
				),
				'meta_key' => 'post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
				)
			);
		} elseif ( $filter == 'popular_month' ) {
			$month = date('m', strtotime('-30 days'));
			$year = date('Y', strtotime('-30 days'));
			$wp_query = new WP_Query(
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'year' => $year,
                'monthnum' => $month,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'top_featured_post',
						'value' => 1
					)
				),
				'meta_key' => 'post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
				)
			);
		} elseif ( $filter == 'popular_week' ) {
			$week = date('W');
            $year = date('Y');
			$wp_query = new WP_Query(
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'year' => $year,
                'w' => $week,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'top_featured_post',
						'value' => 1
					)
				),
				'meta_key' => 'post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
				)
			);
		} elseif ( $filter == 'top_all' ) {
			$wp_query = new WP_Query( 
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'top_featured_post',
						'value' => 1
					),
					array(
						'key' => 'enable_review',
						'value' => 1
					)
				),
				'meta_key' => 'score_module',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
				)
			);
		} elseif ( $filter == 'top_month' ) {
			$month = date('m', strtotime('-30 days'));
    		$year = date('Y', strtotime('-30 days'));
			$wp_query = new WP_Query( 
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'year' => $year,
                'monthnum' => $month,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'top_featured_post',
						'value' => 1
					),
					array(
						'key' => 'enable_review',
						'value' => 1
					)
				),
				'meta_key' => 'score_module',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
				)
			);
		} elseif ( $filter == 'top_week' ) {
			$week = date('W');
        	$year = date('Y');
			$wp_query = new WP_Query( 
				array(
				'post_type' => 'post',
				'posts_per_page' => $number_post,
				'category__and' => $cat,
				'tag__and' => $tag,
				'year' => $year,
                'w' => $week,
				'no_found_rows' => true,
				'post_status' => 'publish',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'top_featured_post',
						'value' => 1
					),
					array(
						'key' => 'enable_review',
						'value' => 1
					)
				),
				'meta_key' => 'score_module',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
				)
			);
		}




		?>

		<?php
		// Setup Loop
		if ( $wp_query->have_posts() ) :
			?>
			<div class="blocked-carousel" id="<?php echo $maha_el_key; ?>">
				<div class="carousel-wrapper">

			        <?php
			        while ( $wp_query->have_posts() ) : $wp_query->the_post();
			        
			        	?>
						<div <?php post_class("col-sm-3"); ?>>
							<?php get_template_part ( 'includes/content/item', 'medium-simple' ); ?>
			        	</div>
			            <?php

			        endwhile;
			        ?>

			    </div>
		    	<div class="carousel-prev"><i class="icon-left-open-big"></i></div>
				<div class="carousel-next"><i class="icon-right-open-big"></i></div>
		    </div>

		    <script type="text/javascript">
		    	jQuery(document).ready(function($){
		    	$("#<?php echo $maha_el_key; ?>.blocked-carousel").each(function(){
				    	$("#<?php echo $maha_el_key; ?> .carousel-wrapper").carouFredSel({
							auto: 5400,
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
					            duration: 500,
					            pauseOnHover: true
						    },
							prev: "#<?php echo $maha_el_key; ?> .carousel-prev",
							next: "#<?php echo $maha_el_key; ?> .carousel-next",

						}).parents('.late-show').slideDown();
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

	</div>

</div>