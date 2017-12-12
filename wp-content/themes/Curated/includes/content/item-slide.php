<div <?php post_class("i-slide rsContent"); ?>>
	<div class="full bContainer" >
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<img typeof="foaf:Image" src="<?php echo maha_featured_url( get_the_ID() , 'mh_large'); ?>" alt="<?php the_title(); ?>" />
		</a>
		<div class="detail">
			<div class="row">
				<div class="col-sm-8">
					<a class="a-url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<h2><?php the_title(); ?></h2>
					</a>
					<div class="meta-count">
						<?php if ( maha_meta_review( get_the_ID() ) != '' ) { ?>
							<span class="i-review"><i class="icon-star"></i> <?php echo maha_meta_review( get_the_ID() ); ?></span>
						<?php } ?>
						<span class="i-category"><?php maha_post_category( get_the_ID() ); ?></span>
					</div>
				</div>
				<div class="col-sm-4">
					<!-- Hello -->
				</div>
			</div>
		</div>
	</div>
</div>