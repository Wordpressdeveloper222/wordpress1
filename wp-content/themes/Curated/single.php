<?php global $post; $maha_options = get_option('curated'); maha_set_viwr($post->ID); get_header(); ?>
<?php $cover_post = 'regular'; if ( get_field( 'cover_post', $post->ID ) != '' ) { $cover_post = get_field( 'cover_post', $post->ID ); } ?>

<!-- Running Text -->
<?php if ($maha_options['running_text_on'] == true) {?>
    <div class="<?php if (get_field('top_featured_post', $post->ID) == '1') echo "cur-run";elseif ( $cover_post == 'parallax' ) echo 'cur-par'; else echo "cur-no"; ?>">
    <?php get_template_part('includes/content/running', 'text'); ?>
    </div>
<?php } ?>

<div class="mh-el page-sidebar single-<?php echo $cover_post; ?>">                           
	<?php
	// Featured Posts +++++++++++++++++       
        
	if ( get_field( 'top_featured_post', $post->ID ) == '1' ) {
		get_template_part ( 'includes/content/featured', 'posts' );
	}
	// Parallax Cover +++++++++++++++++
	if ( $cover_post == 'parallax' ) {
		get_template_part ( 'includes/content/item', 'cover-parallax' );
	}
	// Title Cover +++++++++++++++++
	if ( $cover_post == 'title' ) {
		get_template_part ( 'includes/content/item', 'cover-title' );
	}
	?>

	<!-- start container -->
	<div class="container">

		<?php
		// Boxed Cover +++++++++++++++++
		if ( $cover_post == 'boxed' ) {
			get_template_part ( 'includes/content/item', 'cover-boxed' );
		}
		?>

		<div class="row">
			<!-- Page -->
			<div class="col-sm-8">

				<div class="main-content">
					
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

							<?php
							// Regular Cover +++++++++++++++++
							if ( $cover_post == 'regular' ) {
								get_template_part ( 'includes/content/item', 'cover-regular' );
							}
							?>

							<?php
							if ( $cover_post == 'title' ) {
								maha_format_gallery( $post->ID ); 
								maha_format_video( $post->ID ); 
								maha_format_audio( $post->ID ); 
							}					
							?>

							<div class="text-content">

								<?php
								// Post Rating - Defined by post author in admin post edit page
			   				if ( get_field('enable_review') == '1' ) { 
									$get_score = get_field('score_module');
									$avg_score = maha_meta_review( get_the_ID() );
			   					?>

									<div class="meta-review clearfix" >
										<h3 class="review-title"><?php echo $maha_options['s_editor_review']; ?></h3>
										<div class="review-summary" ><?php echo get_field('review_info'); ?></div>

										<?php if ( get_field('review_style') == 'star' ) { ?>
											<div class="review-visual star">
												<div class="visual-value"><?php echo $avg_score; ?></div>
												<i class="icon-star"></i>
											</div>
										<?php } else { ?>
											<div class="review-visual circle">
												<div class="visual-value"><?php echo $avg_score; ?></div>
												<input type="text" value="<?php echo $avg_score; ?>" class="dial" data-readonly="true" data-width="80" data-height="80" data-thickness="0.3" data-min="0" data-max="10" data-displayprevious="true" data-fgcolor="#3facd6" readonly="readonly" style="">
											</div>
										<?php } ?>

										<?php
										foreach ($get_score as $key => $value) {
											?>
											<div class="maha-progress-bar">
												<span class="r-value"><?php echo $value['review_number']; ?></span>
												<span class="r-caption"><?php echo $value['review_label']; ?></span>
												<div class="bar-wrap">
													<span class="bar accent-color" data-width="<?php echo ($value['review_number']*10); ?>">
													</span>
												</div>
											</div>
											<?php
										}
										?>
									</div>
								<?php } ?>

								<?php the_content(); ?>

								<?php
									$args = array(
										'before'           => '<div class="content-pagination clearfix both"> '. __('Pages : ', MAHA_TEXT_DOMAIN),
										'after'            => '</div>',
										'link_before'      => '<span>',
										'link_after'       => '</span>',
										'next_or_number'   => 'number',
										'pagelink'         => '%'
									);
									wp_link_pages( $args ); 
								?>
							</div>

							<footer class="clearfix both">
								<div class="meta-tags clearfix">
									<?php the_tags(); ?>
								</div>

								<div class="one-divider"></div>

								<?php maha_crtd_share( $post->ID, 'bottom' ); ?>

								<?php if ( $maha_options['related_place'] == 'tags' ) { maha_related_posts_place($post->ID); } /* Related below tags */ ?>

								<div class="one-divider"></div>
								
								<div class="next-prev">
									<?php
									$prev_post = get_previous_post();
									$next_post = get_next_post();
									?>
					
									<?php if ( !empty( $next_post ) ){ ?>
									<?php next_post_link ( '%link', '<i class="icon-right-open-big"></i><div class="np-caption">' . $maha_options['s_next_article'] . '</div><div class="np-title">%title</div>' ); ?>
									<?php } ?>

									<?php if ( !empty( $prev_post ) ){ ?>
									<?php previous_post_link ( '%link', '<i class="icon-left-open-big"></i><div class="np-caption">' . $maha_options['s_prev_article'] . '</div><div class="np-title">%title</div>' ); ?>
									<?php } ?>
                  
								</div>

								<div class="meta-author">
									<div class="author-thumb">
										<a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
											<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta( 'email' ), '200' ); } ?>
										</a>
									</div>

									<div class="author-info">
										<div class="np-caption"><?php echo $maha_options['s_about_author']; ?></div>
										<div class="author-name">
											<a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
										</div>
										<div class="author-desc">
											<span class="fn"><?php the_author_meta( 'description' ); ?></span>
										</div>
										<ul class="author-links">
											<?php maha_user_social_network( get_user_by( 'email', get_the_author_meta( 'email' ) ) ); ?>
										</ul>
									</div>
								</div>

								<?php if ( $maha_options['related_place'] == 'author' or $maha_options['related_place'] == '' ) { maha_related_posts_place($post->ID); } /* Related below author */ ?>

							</footer>
						</article> <!-- /.post -->
						<?php
						endwhile;
					endif;
					?>

					<!-- Comment -->
					<?php comments_template(); ?>

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