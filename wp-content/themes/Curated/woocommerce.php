<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - woocomerce Page

 ---------------------------------------------------------------------------*/
global $post;
$maha_options = get_option('curated');
$page_column = "12"; if (get_field('page_sidebar', woocommerce_get_page_id('shop')) == 'page_sidebar_on') { $page_column = "8"; }
?>
<?php get_header(); ?>
<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-default">
        
	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-<?php echo $page_column; ?>">

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
					
					<?php if ( have_posts()	 ) : ?>
						<div class="wrapper woo-maha">
							<?php woocommerce_content(); ?>
						</div>
					<?php endif; ?>

				</div>

			</div>

			<?php
			// If This Page Use Sidebar
			if (get_field('page_sidebar', woocommerce_get_page_id('shop')) == 'page_sidebar_on') { echo '<div class="col-sm-4"><div class="sidebar">'; dynamic_sidebar( get_field('page_sidebar_source', woocommerce_get_page_id('shop')) ); echo '</div></div>'; }
			?>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>