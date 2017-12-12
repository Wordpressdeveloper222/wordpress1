<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Default Page

 ---------------------------------------------------------------------------*/
global $post;
$maha_options = get_option('curated');
?>

<?php get_header(); ?>

<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-index">

	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-8">

				<div class="main-content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
					
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

					<header></header>
					
					<?php if ( have_posts() ) : ?>
						<?php
						$cat_module = 'el-block-3';
						if ( $maha_options['homepage_module'] != '' ) {
							$cat_module = 'el-'.$maha_options['homepage_module'];
						}
						?>

						<div class="row block-streams <?php echo $cat_module; ?>">
						<?php while ( have_posts() ) : the_post();

							// Module 1 Loop ++++++++++++++++++++++++++
								if( $maha_options['homepage_module'] == 'module-1' ){
									?>
									<div <?php post_class("col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'full-width' ); ?>
						        	</div>
						        	<?php
								}

								// Module 2 Loop ++++++++++++++++++++++++++
								if( $maha_options['homepage_module'] == 'module-2' ){
									
									//Post Summary
									$post->i_summary = $maha_options['author_summary_on'];
									
									?>
									<div <?php post_class("col-sm-6"); ?>>
										<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
						        	</div>
						        	<?php
								}

								// Module 3 Loop ++++++++++++++++++++++++++
								if( $maha_options['homepage_module'] == 'module-3' ){
									?>
									<div <?php post_class("col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'list' ); ?>
						        	</div>
						        	<?php
								}


								// Module 4 Loop ++++++++++++++++++++++++++
								if( $maha_options['homepage_module'] == 'module-4' ){
									?>
									<div <?php post_class("col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'full-content' ); ?>
						        	</div>
						        	<?php
								}

						 endwhile; ?>
						</div>

						<?php maha_pagination(); ?>
					<?php endif; ?>

				</div>

			</div>

			<?php
			echo '<div class="col-sm-4">'; get_sidebar(); echo '</div>';
			?>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>