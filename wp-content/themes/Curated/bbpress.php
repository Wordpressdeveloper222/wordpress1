<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - bbPress Page

 ---------------------------------------------------------------------------*/
global $post;
$maha_options = get_option('curated');
$page_column = "12"; if ($maha_options['bbpress_sidebar_on'] == true) { $page_column = "8"; }
?>
<?php get_header(); ?>
<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-default">
        
	<!-- start container -->
	<div class="container">

		<div class="row">
			<!-- Page -->
			<div class="col-sm-<?php echo $page_column; ?>">

				<div class="main-content" role="main" itemprop="mainContentOfPage">
					
					<!-- Breadcrumbs -->
					<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div class="maha-crumbs">','</div>'); }
					elseif (function_exists('bbp_breadcrumb')) bbp_breadcrumb(); ?>
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article id="post-2729" class="main-content single-post-box">
							<header>
							<?php
							$page_title_on = true;
							if (get_field('page_title', $post->ID) != 'page_title_on') { $page_title_on = false; }
							if ( $page_title_on == true) {
								?>
								<h1 class="entry-title"><?php the_title(); ?></h1>
								<div class="title-divider"></div>
							<?php } ?>
							</header>

							<div class="text-content">
								<?php the_content(); ?>
							</div>

						</article>

					<?php endwhile; endif; ?>

				</div>

				<?php
				if (get_field('use_homepage', $post->ID) == 'enable'){ get_template_part ( 'includes/composer/homepage'); }
				?>

			</div>

			<?php
			// If This Page Use Sidebar
			if ( $maha_options['bbpress_sidebar_on'] == true ) { echo '<div class="col-sm-4"><div class="sidebar">'; dynamic_sidebar( $maha_options['bbpress_sidebar_select'] ); echo '</div></div>'; }
			?>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>