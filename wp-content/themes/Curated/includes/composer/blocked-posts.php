<?php
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014

    - Blocked Posts

 ---------------------------------------------------------------------------*/
?>

<?php
	// Blocked 1 ++++++++++++++++++++++++++
	if( get_sub_field( 'block_type' ) == 'block-1' ){
		get_template_part ( 'includes/composer/blocked', '1' );
	}

	// Blocked 2 ++++++++++++++++++++++++++
	if( get_sub_field( 'block_type' ) == 'block-2' ){
		get_template_part ( 'includes/composer/blocked', '2' );
	}

	// Blocked 3 ++++++++++++++++++++++++++
	if( get_sub_field( 'block_type' ) == 'block-3' ){
		get_template_part ( 'includes/composer/blocked', '3' );
	}

	// Blocked 4 ++++++++++++++++++++++++++
	if( get_sub_field( 'block_type' ) == 'block-4' ){
		get_template_part ( 'includes/composer/blocked', '4' );
	}

	// Blocked 5 ++++++++++++++++++++++++++
	if( get_sub_field( 'block_type' ) == 'block-5' ){
		get_template_part ( 'includes/composer/blocked', '5' );
	}
	
	// Blocked 6 ++++++++++++++++++++++++++
	if( get_sub_field( 'block_type' ) == 'block-6' ){
		get_template_part ( 'includes/composer/blocked', '6' );
	}
	
	// Blocked 7 ++++++++++++++++++++++++++
	if( get_sub_field( 'block_type' ) == 'block-7' ){
		get_template_part ( 'includes/composer/blocked', '7' );
	}
?>
