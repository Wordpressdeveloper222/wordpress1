<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Single Author

 ---------------------------------------------------------------------------*/

$maha_options = get_option('curated');

?>

<?php get_header(); ?>

<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/running', 'text'); } ?>
<div class="mh-el page-sidebar page-author">

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
					

					<?php $curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) ); ?>

					<article class="clearfix">
						<header>
							<h1 itemprop="name" class="entry-title">
		                        <?php _e( 'Posts by : ', MAHA_TEXT_DOMAIN ); ?><?php echo $curauth->display_name; ?>
							</h1>
							<div class="title-divider"></div>
						</header>
					</article>

					<div class="meta-author">
						<div class="author-thumb">
							<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta( 'user_email' ), '200' ); } ?>
						</div>

						<div class="author-info">
							<div class="np-caption"><?php echo $maha_options['s_about_author']; ?> / <?php echo count_user_posts( $curauth->ID ); ?> Posts</div>	
							<div class="author-name">
								<a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $curauth->display_name; ?></a>
							</div>
							<div class="author-desc">
								<span class="fn"><?php echo $curauth->user_description; ?></span>
							</div>
							<ul class="author-links">
								<?php maha_user_social_network($curauth); ?>
							</ul>
						</div>
					</div>

					<div class="row block-streams el-<?php echo $maha_options['author_module']; ?>">

						<?php if (have_posts()) : ?>

							<?php
							while (have_posts()) : the_post();

								// Module 1 Loop ++++++++++++++++++++++++++
								if( $maha_options['author_module'] == 'module-1' ){
									?>
									<div <?php post_class("col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'full-width' ); ?>
						        	</div>
						        	<?php
								}

								// Module 2 Loop ++++++++++++++++++++++++++
								if( $maha_options['author_module'] == 'module-2' ){
									
									//Post Summary
									$post->i_summary = $maha_options['author_summary_on'];
									
									?>
									<div <?php post_class("col-sm-6"); ?>>
										<?php get_template_part ( 'includes/content/item', 'medium' ); ?>
						        	</div>
						        	<?php
								}

								// Module 3 Loop ++++++++++++++++++++++++++
								if( $maha_options['author_module'] == 'module-3' ){
									?>
									<div <?php post_class("col-sm-12"); ?>>
										<?php get_template_part ( 'includes/content/item', 'list' ); ?>
						        	</div>
						        	<?php
								}


								// Module 4 Loop ++++++++++++++++++++++++++
								if( $maha_options['author_module'] == 'module-4' ){
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