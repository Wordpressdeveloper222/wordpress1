<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - 404

 ---------------------------------------------------------------------------*/

$maha_options = get_option('curated');
?>

<?php get_header(); ?>

<div class="mh-el page-sidebar page-404">

	<!-- start container -->
	<div class="container main-content">

		<div class="row cover-mask"></div>

		<div class="row block-streams el-module-404">

			<!-- Page -->
			<div class="col-sm-12">
				<div class="nf404-title"><?php echo $maha_options['nf404_title']; ?></div>
				<div class="nf404-desc"><p><?php echo $maha_options['nf404_desc']; ?></p></div>
				<div class="nf404-button"><a class="mh-button" href="<?php echo home_url(); ?>"><?php echo $maha_options['nf404_button']; ?></a></div>
			</div>

		</div>
	</div>

</div>


<?php get_footer(); ?>