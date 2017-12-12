<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Attachment Page

 ---------------------------------------------------------------------------*/
global $post;
?>

<?php get_header(); ?>

<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-default">
        
	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-12">

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
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article id="post-2729" class="main-content" itemscope="" itemtype="http://schema.org/Article">
							<header>
								<h1 itemprop="name" class="entry-title"><?php echo get_the_title($post->ID); ?></h1>
								<div class="title-divider"></div>
							</header>

							<?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
							
						</article>

					<?php endwhile; endif; ?>

				</div>

			</div>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>