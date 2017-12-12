<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Regular Slider

 ---------------------------------------------------------------------------*/

$maha_el_key = maha_el_key();

?>

<div class="mh-el static-area">

	<?php
	// Start Container
	if (get_sub_field('el_area') == 1) { echo '<div class="container">'; }
	?>

	<?php if ( get_sub_field('block_title') ) { ?>
	<!-- Block Cap -->
	<div class="row">
		<div class="col-sm-12">
			<div class="block-cap">
				<h3><?php echo do_shortcode(get_sub_field('block_title')); ?></h3>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="static-area-content text-content">
		<?php echo do_shortcode(get_sub_field('content_area')); ?>
		<?php echo do_shortcode(get_sub_field('content_custom')); ?>
	</div>

	<?php
	// End of container
	if (get_sub_field('el_area') == 1) { echo '</div>'; }
	?>
	
</div>