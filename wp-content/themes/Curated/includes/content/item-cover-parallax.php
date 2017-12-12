<?php global $post; $maha_options = get_option('curated');// echo $post->ID; // print_r($post); ?>
<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
<div class="cover-wrap">

	<div class="player-wrap"><div class="container"><div class="row">		
		<div class="col-sm-12">
			<div class="back-nav">
				<i class="icon-cancel"></i>
			</div>
		</div></div></div></div>

	<div class="cover i-parallax <?php echo maha_parallax_feat($post->ID); ?>" style="background-image: url(<?php echo maha_featured_url( $post->ID , ''); ?>);">
		
		
		<?php maha_format_gallery( $post->ID ); ?>

		<div class="detail">
			<div class="container">

				<div class="row">

					<?php
					if ( get_field('enable_review', $post->ID ) == '1' ) { 
						$itemscope =' itemscope itemtype="http://schema.org/Review"';
					} else {
						$itemscope =' itemscope itemtype="http://schema.org/Blog"';
					}
					?>

					<div class="col-sm-8" <?php echo $itemscope; ?>>

						<?php if ( get_field('enable_review', $post->ID ) == '1' ) { ?>
						<meta itemprop="itemreviewed" content="<?php echo get_the_title($post->ID); ?>">
						<?php } ?>

						<!-- <meta itemprop="author" content="<?php echo get_the_author_meta('display_name', $post->post_author); ?>"> -->
						<meta itemprop="datecreated" content="<?php echo get_the_time( 'c', $post->ID ); ?>">
						<meta itemprop="image" content="<?php echo maha_featured_url( $post->ID , 'mh_large'); ?>">
						<meta itemprop="about" content="<?php echo get_field('review_info'); ?>">

						<?php $user = get_user_by( 'email', get_the_author_meta( 'email' ) );
						if ( isset( $user->u_google_plus ) && !empty( $user->u_google_plus ) ) { ?>
							<a href="<?php echo $user->u_google_plus."?rel=author"; ?>" style="display:none;"></a>
						<?php } ?>

						<div class="meta-info">
							<span class="ava-auth">
								<img width="14" height="14" class="entry-thumb" src="<?php echo maha_avatar_url(get_avatar( get_the_author_meta('user_email', $post->post_author), 48 )); ?>" alt="" title="<?php echo get_the_author_meta('display_name', $post->post_author); ?>"/>
							</span>
							<span itemprop="author" itemscope itemtype="http://schema.org/Person" class="entry-author">
								<a href="<?php echo get_author_posts_url( $post->post_author ); ?>">
									<span><?php echo get_the_author_meta('display_name', $post->post_author); ?></span>
								</a>
							</span>,
							<time itemprop="datePublished" class="entry-date" datetime="<?php echo get_the_time( 'c', $post->ID ); ?>" >
								<?php echo get_the_time( get_option( 'date_format' ), $post->ID ); ?>
							</time>
							<?php if ( $maha_options['single_viewer'] == true or $maha_options['single_commentr'] == true ) { ?>
							<span class="meta-info-divider">/</span>
							<?php } ?>
							<?php if ( $maha_options['single_viewer'] == true ) { ?>
								<span class="meta-info-viewer"><i class="icon-eye"></i><?php echo maha_get_viwr( $post->ID ); ?></span>
							<?php } ?>
							<?php if ( $maha_options['single_commentr'] == true ) {
								$commnumber = wp_count_comments($post->ID);
								if ( $commnumber->approved == 0){
									$comm = '#respond';
								}else{
									$comm = '#comments';
								}
							?>
							<span class="meta-info-comments"><i class="icon-comment"></i><a href="<?php the_permalink(); ?><?php echo $comm;?>"><?php comments_number('0 ', '1 ', '% '); ?></a></span>
							<?php } ?>
						</div>

						<h1 itemprop="name"><?php echo get_the_title($post->ID); ?></h1>
						<?php
						if ( get_field('subtitle', $post->ID) != '' ){
							echo '<div class="entry-subtitle single-subtitle">'.get_field('subtitle', $post->ID).'</div>';
						}
						?>

						<div class="hidden" itemscope itemtype="http://schema.org/Thing">
							<span itemprop="name"><?php echo get_the_title($post->ID); ?></span>
						</div>

						<div class="meta-count">
							<?php if ( maha_meta_review( $post->ID ) != '' ) { ?>
							<span class="td-page-meta" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
								<meta itemprop="worstRating" content="1">
								<meta itemprop="bestRating" content="10">
								<meta itemprop="ratingValue" content="<?php echo maha_meta_review( $post->ID ); ?>">
							</span>
							<span class="i-review"><i class="icon-star"></i> <?php echo maha_meta_review( $post->ID ); ?></span>
							<?php } ?>
							<span class="i-category"><?php maha_post_category( $post->ID ); ?></span>
						</div>

					</div>

					<div class="col-sm-4"></div>

					<?php maha_crtd_share( $post->ID ); ?>
					
				</div>

			</div>
		</div>

	</div>

	<?php maha_format_video( $post->ID ); ?>
	<?php maha_format_audio( $post->ID ); ?>

</div>


<?php } ?>