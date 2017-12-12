<div class="post-box-small clearfix" itemscope itemtype="http://schema.org/Article">
	
	<?php if ( has_post_thumbnail() ) : // Set Featured Image ?>
		<div class="thumb-wrap zoom-zoom">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<img height="83" width="83" itemprop="image" class="entry-thumb zoom-it three" src="<?php echo maha_featured_url( get_the_ID() , 'mh_small'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
			</a>
		</div>
	<?php elseif( maha_first_post_image() ) : // Set the first image from the editor ?>
		<div class="thumb-wrap zoom-zoom">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<img height="83" width="83" itemprop="image" class="entry-thumb zoom-it three" src="'.maha_first_post_image().'" alt="'.get_the_title().'" title="'.get_the_title().'"/>
			</a>
		</div>
   	<?php endif; ?>

	<div class="box-small-wrap">
		<h3 itemprop="name" class="entry-title short-bottom">
			<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<meta itemprop="headline" content="<?php the_title(); ?>" />
		<div class="meta-info">
			<span itemprop="author" class="entry-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span><span class="coma">,</span> 
			<time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
				<?php the_time( get_option( 'date_format' ) ); ?>
			</time>
		</div>
	</div>
</div>