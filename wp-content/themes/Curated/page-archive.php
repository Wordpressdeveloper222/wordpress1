<?php
/*
 * Template Name: Page Archive
*/
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Archive Page

 ---------------------------------------------------------------------------*/
global $post;
$maha_options = get_option('curated');
$page_column = "8"; if (get_field('page_sidebar', $post->ID) == 'page_sidebar_off') { $page_column = "12"; }
?>
<?php get_header(); ?>
<?php if ($maha_options['running_text_on'] == true) { get_template_part('includes/content/item', 'running-text'); } ?>
<div class="mh-el page-sidebar page-template-archive">

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
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article id="post-2729" class="main-content single-post-box" itemscope="" itemtype="http://schema.org/Article">
							<header>
							<?php
							$page_title_on = true;
							if (get_field('page_title', $post->ID) != 'page_title_on') { $page_title_on = false; }
							if ( $page_title_on == true) {
								?>
								<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
								<div class="title-divider"></div>
							<?php } ?>
							</header>

							<div class="text-content">
								<?php the_content(); ?>
							</div>

							<div class="row the-archives">

								<div class="col-sm-4 archives-by-taxs widget">
									<h3 class="archive-head"><?php _e('Archives by Categories', MAHA_TEXT_DOMAIN); ?></h3>
									<ul>
										<?php wp_list_categories( 'title_li=' ); ?>
									</ul>

									<h3 class="archive_head"><?php _e('Archives by Tags', MAHA_TEXT_DOMAIN); ?></h3>
									<ul>
										<?php
										$tags = get_tags( array('name_like' => "a", 'order' => 'ASC') );
										foreach ( (array) $tags as $tag ) {
										echo '<li><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . ' </a></li>';
										}
										?>
									</ul>
								</div>

								<div class="col-sm-8 archives-timeline">
									<h3 class="archive-head"><?php _e('Posts Timeline', MAHA_TEXT_DOMAIN); ?></h3>
									<?php
										$where = apply_filters( 'getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'" );
										$join = apply_filters( 'getarchives_join', '' );
										$query = "SELECT YEAR(post_date) AS 'year', count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date DESC";
										$key = md5($query);
										$cache = wp_cache_get( 'wp_get_archives' , 'general');
										if ( !isset( $cache[ $key ] ) ) {
											$arcresults = $wpdb->get_results($query);
											$cache[ $key ] = $arcresults;
											wp_cache_set( 'wp_get_archives', $cache, 'general' );
										} else {
											$arcresults = $cache[ $key ];
										}
										if ($arcresults) {
											foreach ( (array) $arcresults as $arcresult) { ?>

												<h4 class="timeline-cap"><?php echo $arcresult->year ?></h4>					
												<?php 
												$year = (int) $arcresult->year;
												$query = new WP_Query( 'year='.$year.'&posts_per_page=100' ); ?>
												<ul class="timeline-list">
													<?php $dnow = "0"; $dcnow = "0";?>
													<?php while ( $query->have_posts() ) : $query->the_post() ?>
														<li>
															<span class="tl-month"><?php the_time('M, j') ?></span><a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'tie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo the_title(); ?></a>
														</li>
													<?php endwhile; ?>
												</ul>
											<?php
											}
										}
										wp_reset_query();
									?>
								</div>

								
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
			if (get_field('page_sidebar', $post->ID) == 'page_sidebar_on') { echo '<div class="col-sm-4">'; get_sidebar(); echo '</div>'; }
			?>
			
		</div>
	</div>

</div>


<?php get_footer(); ?>