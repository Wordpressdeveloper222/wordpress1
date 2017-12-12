<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Archive Page

 ---------------------------------------------------------------------------*/

global $paged, $wp_query;
$maha_options = get_option('curated');

if ($maha_options['search_option']=='all') { $val_post=array('post','page'); }
else { $val_post=array($maha_options['search_option']); }

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
if ( get_query_var('page') ) { $paged = get_query_var('page'); }

$args = array(
	'post_type' => $val_post,
	'post_status' => 'publish',
	's' => get_search_query(),
	'paged' => $paged
);

$wp_query = new WP_Query( $args ); ?>

<?php get_header(); ?>

<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-search">

	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-8">

				<!-- Module 1 -->
				<div class="main-content" role="main" itemprop="mainContentOfPage">
					
					<!-- Breadcrumbs -->
					<?php
					$maha_breadcrumbs = 1;
					if ( function_exists('yoast_breadcrumb') ) {
						$yoast_crumb = yoast_breadcrumb('<div class="maha-crumbs">','</div>', false);
						if ( isset( $yoast_crumb ) && !empty( $yoast_crumb ) ) {
							echo $yoast_crumb;
							$maha_breadcrumbs = 0;
						}
					}
					
					if (function_exists('maha_crumbs') && $maha_breadcrumbs === 1) { maha_crumbs(); } ?>
					
					<article>
						<header>
							<h1 itemprop="name" class="entry-title">
		                        <?php printf( __( 'Search results for : ', MAHA_TEXT_DOMAIN ) ); ?>" <?php echo get_search_query(); ?> "
							</h1>

							<div class="title-divider"></div>
						</header>
					</article>

					<div class="row block-streams el-module-search">

						<?php if (have_posts()) : ?>

							<?php
							if ($paged==0){$paged = 1;}
							$s_number = (($paged-1)*get_query_var('posts_per_page'))+1;
							while (have_posts()) : the_post();

								// Module Loop ++++++++++++++++++++++++++
								?>
								<div <?php post_class("col-sm-12"); ?>>
									<?php if ($maha_options['boxed_on'] == 0){?>
										<div class="s-number ln<?php echo strlen(sprintf("%02s", $s_number)); ?>"><?php echo sprintf("%02s", $s_number); ?></div>
									<?php }?>
									<?php get_template_part ( 'includes/content/item', 'search' ); ?>
					        	</div>
					        	<?php

					        	$s_number++;
							endwhile;
							?>

						<?php
						else:

				            echo '<div class="col-sm-12 message">';
							_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
							echo '</div>';
						endif;

						wp_reset_query(); ?>

					</div>

					<?php maha_pagination(); ?>
					
				</div>

			</div>

			<!-- Sidebar -->
			<div class="col-sm-4">

				<?php get_sidebar(); ?>

			</div>
		</div>
	</div>

</div>


<?php get_footer(); ?>