<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Archive Page

 ---------------------------------------------------------------------------*/

$maha_options = get_option('curated');

?>

<?php get_header(); ?>

<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-archive">

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

					<?php $curtaxmeta = ''; ?>
					
					<article>
						<header>
							<h1 itemprop="name" class="entry-title">

		                        <?php if(is_tag()) { ?>
		                        <?php single_tag_title(); $curtaxmeta = get_query_var('tag_id'); ?>
		                
		                        <?php } elseif (is_day()) { ?>
		                        <?php the_time('F jS, Y'); ?>
		                
		                        <?php } elseif (is_month()) { ?>
		                        <?php the_time('F, Y'); ?>
		                
		                        <?php } elseif (is_year()) { ?>
		                        <?php the_time('Y'); ?>
		                        
		                        <?php } elseif ( get_post_format() ) { ?>
		                        <?php echo get_post_format(); ?>
		        
		                        <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		                        <?php } ?>
							</h1>

							<?php if( $curtaxmeta!= "" ) { ?>
								<div class="entry-subtitle">
									<?php echo tag_description( $curtaxmeta ); ?>
								</div>
							<?php } ?>

							<div class="title-divider"></div>
						</header>
					</article>

					<div class="row block-streams el-<?php echo $maha_options['archive_module']; ?>">

						<?php if (have_posts()) : ?>

							<?php
							while (have_posts()) : the_post();

								// Module 1 Loop ++++++++++++++++++++++++++
								if( $maha_options['archive_module'] == 'module-1' ){
									?>
									<div <?php post_class("col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'full-width' ); ?>
						        	</div>
						        	<?php
								}

								// Module 2 Loop ++++++++++++++++++++++++++
								if( $maha_options['archive_module'] == 'module-2' ){
									
									//Post Summary
									$post->i_summary = $maha_options['archive_summary_on'];

									?>
									<div <?php post_class("col-sm-6"); ?>>
										<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
						        	</div>
						        	<?php
								}

								// Module 3 Loop ++++++++++++++++++++++++++
								if( $maha_options['archive_module'] == 'module-3' ){
									?>
									<div <?php post_class("col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'list' ); ?>
						        	</div>
						        	<?php
								}


								// Module 4 Loop ++++++++++++++++++++++++++
								if( $maha_options['archive_module'] == 'module-4' ){
									?>
									<div <?php post_class("col-sm-12"); ?>>
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