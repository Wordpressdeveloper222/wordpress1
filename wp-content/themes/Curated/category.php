<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Category Page

 ---------------------------------------------------------------------------*/

$maha_options = get_option('curated');
$page_column = "12"; if ($maha_options['category_sidebar_on'] == true) { $page_column = "8"; }
?>

<?php get_header(); ?>

<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-category">

	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-<?php echo $page_column; ?>">

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
					
					<?php $curcat = get_query_var('cat'); ?>

					<article id="<?php echo $curcat.'-'; single_cat_title(); ?>" class="clearfix">
						<header>
							<h1 class="entry-title">
		                        <?php single_cat_title(); ?>
							</h1>
							<div class="entry-subtitle">
								<?php echo category_description( $curcat ); ?>
							</div>
							<div class="title-divider"></div>
						</header>
					</article>

					<?php
					// If Module use Featured Slider ++++++++++++++++++++++++++
					if( get_field( 'category_slider', 'category_' . $curcat ) == 'category_slider_on' ){
						echo '<div class="el-featured-slide up-up">';
							get_template_part ( 'includes/content/blocked', 'slider' );
						echo '</div>';
					}
					?>

					<?php
					$cat_module = 'module-2';
					if ( get_field( 'category_module', 'category_' . $curcat ) != '' ) {
						$cat_module = get_field( 'category_module', 'category_' . $curcat );
					}
					?>
					<div class="row block-streams el-<?php echo $cat_module; ?>">

						<?php if (have_posts()) : ?>

							<?php
							while (have_posts()) : the_post();

								// Module 1 Loop ++++++++++++++++++++++++++
								if( $cat_module == 'module-1' ){
									?>
									<div <?php post_class("up-up-child col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'full-width' ); ?>
						        	</div>
						        	<?php
								}

								// Module 2 Loop ++++++++++++++++++++++++++
								if( $cat_module == 'module-2' ){

									//Post Summary
									$post->i_summary = $maha_options['category_summary_on'];
									
									?>
									<div <?php post_class("up-up-child col-sm-6"); ?>>
										<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
						        	</div>
						        	<?php
								}

								// Module 3 Loop ++++++++++++++++++++++++++
								if( $cat_module == 'module-3' ){
									?>
									<div <?php post_class("up-up-child col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'list' ); ?>
						        	</div>
						        	<?php
								}

								// Module 4 Loop ++++++++++++++++++++++++++
								if( $cat_module == 'module-4' ){
									?>
									<div <?php post_class("up-up-child col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'full-content' ); ?>
						        	</div>
						        	<?php
								}


							endwhile;
							?>

						<?php
						else:

	            			echo '<div class="col-sm-12 message">';
							_e( 'Sorry, no posts were found', MAHA_TEXT_DOMAIN );
							echo '</div>';
						endif;
						?>

					</div>
					
					<?php maha_pagination(); ?>

					<?php wp_reset_query(); ?>

				</div>

			</div>

			<?php
			// If This Page Use Sidebar
			if ($maha_options['category_sidebar_on'] == true) {
				if ($maha_options['category_sidebar_select']=='') $sidebar='blog-sidebar';
				else $sidebar=$maha_options['category_sidebar_select'];
			 echo '<div class="col-sm-4"><div class="sidebar">'; dynamic_sidebar($sidebar); 
			 echo '</div></div>'; }
			?>
		</div>
	</div>

</div>


<?php get_footer(); ?>