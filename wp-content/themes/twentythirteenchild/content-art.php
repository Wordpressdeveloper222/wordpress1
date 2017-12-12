<?php
/**
 * Template for displaying art custom post type entries
 */
?>	

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
			<p>Price: $<?php the_field('price'); ?></p>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->
	
	<div class="entry-content">
	
	<p><img src="<?php the_field('image'); ?>" alt="Example image of <?php the_title(); ?>"></p>
		<p><?php the_field('description'); ?></p>
 <?php the_time('F'); ?> 
	</div><!-- .entry-content -->	

</article><!-- #post -->


			