<?php
get_header();
?>	

		<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
	<?php if(have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php the_content(); the_time('d-m-y');	 ?></p>	
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
<?php the_post_thumbnail( 'thumbnail' );    
?>
	<?php endwhile; endif; ?>
	 <?php //the_time('F'); ?> 
<?php // echo date('m');
 $a = get_the_time('d');
 $b = get_the_time('y');
 $c = date('m');
 echo $a . '-' .$c .'-' .$b;

?>




				</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</article>