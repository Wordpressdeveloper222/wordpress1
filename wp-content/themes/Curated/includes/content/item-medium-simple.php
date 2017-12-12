<div class="post-box-normal" itemscope itemtype="http://schema.org/Article">
	<div class="meta-info">
		<span class="ava-auth">
			<img width="14" height="14" class="entry-thumb" src="<?php echo maha_avatar_url(get_avatar( get_the_author_meta('user_email'), 48 )); ?>" alt="" title="<?php the_author(); ?>"/>
		</span>
		<span itemprop="author" class="entry-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span><span class="coma">,</span> 
		<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
			<?php the_time( get_option( 'date_format' ) ); ?>
		</time>
	</div>

	<?php if ( has_post_thumbnail() ) : // Set Featured Image ?>
		<div class="thumb-wrap zoom-zoom">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<img height="141" width="262" itemprop="image" class="zoom-it three entry-thumb" src="<?php echo maha_featured_url( get_the_ID() , 'mh_medium_simple'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
			</a>
		</div>
    <?php elseif( maha_first_post_image() ) : // Set the first image from the editor ?>
		<div class="thumb-wrap short-bottom zoom-zoom">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<img height="141" width="262" itemprop="image" class="entry-thumb zoom-it three" src="<?php echo maha_first_post_image(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
			</a>
		</div>
   	<?php endif; ?>

	<h3 itemprop="name" class="entry-title">
		<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
			<?php the_title(); ?>
		</a>
	</h3>
	<meta itemprop="headline" content="<?php the_title(); ?>" />
	<!-- <div class="meta-count">
		<span class="td-page-meta" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
			<meta itemprop="worstRating" content="1">
			<meta itemprop="bestRating" content="5">
			<meta itemprop="ratingValue" content="4.23">
		</span>
		<span class="i-review"><i class="icon-star"></i> 4.23</span>
		<span class="i-category"><?php the_category(' '); ?></span>
	</div> -->
</div>