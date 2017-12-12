<?php
/*
 * Custom Fields
 *
/* --------------------------------------------------------------------------

	A ThemeMaha Framework - Copyright (c) 2014
	Please be extremely cautions editing this file!

    - ThemeMaha - Mark 1.0.0

 ---------------------------------------------------------------------------*/

if(function_exists("register_field_group")){

	/* --------------------------------------------------------------------------
	 * Category Options - Additional settings for category
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_category-options',
		'title' => 'Category Options',
		'fields' => array (
			array (
				'key' => 'field_53077da0beea6',
				'label' => 'Category Color',
				'name' => 'category_color',
				'type' => 'color_picker',
				'instructions' => 'Choose the color Category color for label and menu color',
				'default_value' => '#222'
			),
			array (
				'key' => 'field_5321cd96f07b8',
				'label' => 'Display Latest Posts on Menu',
				'name' => 'menu_latest_posts',
				'type' => 'radio',
				'instructions' => 'Enable or Disable Category Latest Posts on Main Menu',
				'choices' => array (
					'latest_posts_on' => 'Enable',
					'latest_posts_off' => 'Disable',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'latest_posts_off',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_53083abfc29fb',
				'label' => 'Display Category Slider',
				'name' => 'category_slider',
				'type' => 'radio',
				'instructions' => 'Enable or Disable Category Slider to display featured posts on this category page',
				'choices' => array (
					'category_slider_on' => 'Enable',
					'category_slider_off' => 'Disable',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'category_slider_off',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_53083b5e26e06',
				'label' => 'Category Module',
				'name' => 'category_module',
				'type' => 'radio',
				'instructions' => 'Choose Category module layout for this category',
				'choices' => array (
					'module-1' => 'Module 1</br><img class="opt-image" title="Module 1" src="'.get_template_directory_uri().'/images/partial/module-1.png">',
					'module-2' => 'Module 2</br><img class="opt-image" title="Module 2" src="'.get_template_directory_uri().'/images/partial/module-2.png">',
					'module-3' => 'Module 3</br><img class="opt-image" title="Module 3" src="'.get_template_directory_uri().'/images/partial/module-3.png">',
					'module-4' => 'Module 4</br><img class="opt-image" title="Module 4" src="'.get_template_directory_uri().'/images/partial/module-4.png">'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'module-2',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	
	/* --------------------------------------------------------------------------
	 * Audio Post Format - Settings
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_format-audio',
		'title' => 'Format Audio',
		'fields' => array (
			array (
				'key' => 'field_5317559203629',
				'label' => 'Add SoundCloud Audio',
				'name' => 'audio_module',
				'type' => 'text',
				'instructions' => 'Paste page URL from SoundCloud',
				'default_value' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'audio',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	/* --------------------------------------------------------------------------
	 * Gallery Post Format - Setting
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_format-gallery',
		'title' => 'Format Gallery',
		'fields' => array (
			array (
				'key' => 'field_5316d2b4487c4',
				'label' => 'Upload Gallery Images',
				'name' => 'gallery_module',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_5316d673adb48',
						'label' => 'Image',
						'name' => 'gallery_item',
						'type' => 'image',
						'instructions' => 'Upload Image here',
						'column_width' => 25,
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Images',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'gallery',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	/* --------------------------------------------------------------------------
	 * Video Post Format - Setting
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_format-video',
		'title' => 'Format Video',
		'fields' => array (
			array (
				'key' => 'field_531755a654f7c',
				'label' => 'Add Video',
				'name' => 'video_module',
				'type' => 'text',
				'instructions' => 'Paste video page URL',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_5444c429ae898',
				'label' => 'Video Title',
				'name' => 'video_title',
				'type' => 'true_false',
				'message' => 'Turn on video title',
				'default_value' => 1,
			),
			array (
				'key' => 'field_5444c43c7467b',
				'label' => 'Playbar',
				'name' => 'video_playbar',
				'type' => 'true_false',
				'message' => 'Turn on playbar',
				'default_value' => 1,
			),
			array (
				'key' => 'field_5444c45c6659d',
				'label' => 'Related Video',
				'name' => 'video_related',
				'type' => 'true_false',
				'message' => 'Turn on related video',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	
	/* --------------------------------------------------------------------------
	 * Page Builder - Control Page Layout 
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_page-composer',
		'title' => 'Page Builder',
		'fields' => array (
			array (
				'key' => 'field_52faed53dc9d4',
				'label' => 'Page Builder',
				'name' => 'page_composer',
				'type' => 'flexible_content',
				'layouts' => array (
					array (
						'label' => 'Moz Slider',
						'name' => 'moz_slider',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_5300538e138ec',
								'label' => 'Element Area',
								'name' => 'el_area',
								'type' => 'text',
								'instructions' => '',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'none',
							),
							array (
								'key' => 'field_533cd2a08807a',
								'label' => 'Boxed Style',
								'name' => 'moz_boxed',
								'type' => 'true_false',
								'message' => 'Enable/disable boxed width (not overflow)',
								'default_value' => 0,
							),
							array (
								'key' => 'field_5358d1954e16b',
								'label' => 'Moz Slider on Page 2',
								'name' => 'moz_page_2',
								'type' => 'true_false',
								'message' => 'Enable/Disable moz slider on page 2',
								'default_value' => 1,
							),
							array (
								'key' => 'field_52faeb9db3957',
								'label' => 'Number of Posts',
								'name' => 'moz_of_slides',
								'type' => 'select',
								'instructions' => 'Select the maximum number of posts you want to show, minimun is 7',
								'column_width' => '',
								'choices' => array (
									7 => 7,
									8 => 8,
									9 => 9,
									10 => 10,
									11 => 11,
									12 => 12,
									13 => 13,
									14 => 14,
									15 => 15,
									16 => 16,
									17 => 17,
									18 => 18,
								),
							),
							array (
								'key' => 'field_5321a3f31fecb',
								'label' => 'Posts Filter by Category',
								'name' => 'moz_category',
								'type' => 'taxonomy',
								'instructions' => 'You can select more than 1 category',
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'checkbox',
								'allow_null' => 1,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 0,
							),
							array (
								'key' => 'field_5321a3fd740db',
								'label' => 'Posts Filter by Tags',
								'name' => 'moz_tags',
								'type' => 'taxonomy',
								'instructions' => 'You can select more than 1 tag',
								'taxonomy' => 'post_tag',
								'field_type' => 'checkbox',
								'allow_null' => 1,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 0,
							),
							array (
								'key' => 'field_5321a40232722',
								'label' => 'Posts Sort order ',
								'name' => 'moz_order',
								'type' => 'select',
								'choices' => array (
									'' => 'Latest',
									'featured' => 'Featured',
									'rand' => 'Random',
									'popular_alltime' => 'Popular All-time (by Post views)',
									'popular_past7' => 'Popular This Week (by Post views)',
								),
								'default_value' => '',
								'formatting' => 'none',
							),
						),
					),
					array (
						'label' => 'Regular Slider',
						'name' => 'regular_slider',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_53005da66fcc5',
								'label' => 'Element Area',
								'name' => 'el_area',
								'type' => 'text',
								'instructions' => '',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'none',
							),
							array (
								'key' => 'field_5359d69cbc526',
								'label' => 'Regular Slider on Page 2',
								'name' => 'regular_slider_page_2',
								'type' => 'true_false',
								'message' => 'Enable/Disable regular slider on page 2',
								'default_value' => 1,
							),
							array (
								'key' => 'field_532124fa64001',
								'label' => 'Posts Filter by Category',
								'name' => 'rslide_category',
								'type' => 'taxonomy',
								'instructions' => 'You can select more than 1 category',
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'checkbox',
								'allow_null' => 1,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 0,
							),
							array (
								'key' => 'field_53212500af0a1',
								'label' => 'Posts Filter by Tags',
								'name' => 'rslide_tags',
								'type' => 'taxonomy',
								'instructions' => 'You can select more than 1 tag',
								'taxonomy' => 'post_tag',
								'field_type' => 'checkbox',
								'allow_null' => 1,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 0,
							),
							array (
								'key' => 'field_53212505e937d',
								'label' => 'Posts Sort order ',
								'name' => 'rslide_order',
								'type' => 'select',
								'choices' => array (
									'' => 'Latest',
									'featured' => 'Featured',
									'rand' => 'Random',
									'popular_alltime' => 'Popular All-time (by Post views)',
									'popular_past7' => 'Popular This Week (by Post views)',
								),
								'default_value' => '',
								'formatting' => 'none',
							),
							array (
								'key' => 'field_5321250a608fa',
								'label' => 'Number of Posts',
								'name' => 'rslide_number_posts',
								'type' => 'number',
								'instructions' => 'Set the number of posts',
								'column_width' => '',
								'default_value' => 4,
								'min' => 2,
								'max' => '',
								'step' => 1,
							),
							array (
								'key' => 'field_534cdf07ac215',
								'label' => 'Offset',
								'name' => 'rslide_offset',
								'type' => 'number',
								'instructions' => 'Set the Offset of this loop',
								'column_width' => '',
								'default_value' => 0,
								'min' => 0,
								'max' => '',
								'step' => 1,
							),
						),
					),
					array (
						'label' => 'Blocked Posts',
						'name' => 'blocked_posts',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_53005db7acd4a',
								'label' => 'Element Area',
								'name' => 'el_area',
								'type' => 'text',
								'instructions' => '',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'none',
							),
							array (
								'key' => 'field_52faef30e113f',
								'label' => 'Title',
								'name' => 'block_title',
								'type' => 'text',
								'instructions' => 'Enter the section title, leave blank if dont want show the title',
								'column_width' => '',
								'default_value' => '',
								'formatting' => '',
							),
							array (
								'key' => 'field_51e24ee79fc05',
								'label' => 'Posts Layout',
								'name' => 'block_type',
								'type' => 'radio',
								'instructions' => 'Select this section posts layout',
								'column_width' => '',
								'choices' => array (
									'block-1' => 'Block 1</br><img class="opt-image" title="Block 1" src="'.get_template_directory_uri().'/images/partial/blocked-1.png">',
									'block-2' => 'Block 2</br><img class="opt-image" title="Block 2" src="'.get_template_directory_uri().'/images/partial/blocked-2.png">',
									'block-3' => 'Block 3</br><img class="opt-image" title="Block 3" src="'.get_template_directory_uri().'/images/partial/blocked-3.png">',
									'block-4' => 'Block 4</br><img class="opt-image" title="Block 4" src="'.get_template_directory_uri().'/images/partial/blocked-4.png">',
									'block-5' => 'Block 5</br><img class="opt-image" title="Block 5" src="'.get_template_directory_uri().'/images/partial/blocked-5.png">',
									'block-6' => 'Block 6</br><img class="opt-image" title="Block 6" src="'.get_template_directory_uri().'/images/partial/blocked-6.png">',
									'block-7' => 'Block 7</br><img class="opt-image" title="Block 7" src="'.get_template_directory_uri().'/images/partial/blocked-7.png">'
								),
								'other_choice' => 0,
								'save_other_choice' => 0,
								'default_value' => 'block-2',
								'layout' => 'horizontal',
							),
							array (
								'key' => 'field_534e02dbc8729',
								'label' => 'Post Summary',
								'name' => 'block_summary',
								'type' => 'true_false',
								'message' => 'If enabled, post summary will show',
								'default_value' => 1,
							),
							array (
								'key' => 'field_52faefd12cb2e',
								'label' => 'Posts Filter by Category',
								'name' => 'block_category',
								'type' => 'taxonomy',
								'instructions' => 'You can select more than 1 category',
								'column_width' => '',
								'taxonomy' => 'category',
								'field_type' => 'checkbox',
								'allow_null' => 1,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 0,
							),
							array (
								'key' => 'field_531ac52220081',
								'label' => 'Posts Filter by Tags',
								'name' => 'block_tags',
								'type' => 'taxonomy',
								'instructions' => 'You can select more than 1 tag',
								'taxonomy' => 'post_tag',
								'field_type' => 'checkbox',
								'allow_null' => 1,
								'load_save_terms' => 0,
								'return_format' => 'id',
								'multiple' => 0,
							),
							array (
								'key' => 'field_531ac53a9c65a',
								'label' => 'Posts Sort order ',
								'name' => 'block_order',
								'type' => 'select',
								'choices' => array (
									'' => 'Latest',
									'rand' => 'Random',
									'popular_alltime' => 'Popular All-time (by Post views)',
									'popular_past7' => 'Popular This Week (by Post views)',
								),
								'default_value' => '',
								'formatting' => 'none',
							),
							array (
								'key' => 'field_539fa88501162',
								'label' => 'Featured Posts Option ',
								'name' => 'featured_post_option',
								'type' => 'select',
								'choices' => array (
									'default' => 'Default',
									'without' => 'Without Featured Posts',
									'featured' => 'Featured Posts',
								),
								'default_value' => 'default',
								'formatting' => 'none',
							),
							array (
								'key' => 'field_531ac55dc23dd',
								'label' => 'Number of Posts',
								'name' => 'block_number_posts',
								'type' => 'number',
								'instructions' => 'Set the number of posts',
								'column_width' => '',
								'default_value' => 4,
								'min' => 2,
								'max' => '',
								'step' => 1,
							),
							array (
								'key' => 'field_534ce7c5d3af4',
								'label' => 'Offset',
								'name' => 'block_offset',
								'type' => 'number',
								'instructions' => 'Set the Offset of this loop',
								'column_width' => '',
								'default_value' => 0,
								'min' => 0,
								'max' => '',
								'step' => 1,
							),
							
						),
					),
					array (
						'label' => 'Static Content',
						'name' => 'static_area',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_531ac7c455a2c',
								'label' => 'Element Area',
								'name' => 'el_area',
								'type' => 'text',
								'instructions' => '',
								'column_width' => '',
								'default_value' => '',
								'formatting' => 'none',
							),
							array (
								'key' => 'field_531ac7f9bda72',
								'label' => 'Title',
								'name' => 'block_title',
								'type' => 'text',
								'instructions' => 'Enter the main title for this section, Just leave blank if dont wanna to show the title',
								'column_width' => '',
								'default_value' => '',
								'formatting' => '',
							),
							array (
								'key' => 'field_531ac806103dc',
								'label' => 'Content',
								'name' => 'content_area',
								'type' => 'wysiwyg',
								'default_value' => '',
								'toolbar' => 'full',
								'media_upload' => 'yes',
							),
							array (
								'key' => 'field_531a667555u89i',
								'label' => 'Custom HTML/JS',
								'name' => 'content_custom',
								'type' => 'textarea',
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'formatting' => 'html',
							),
						),
					),
				),
				'button_label' => 'Add Section',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-builder.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'featured_image',
			),
		),
		'menu_order' => 0,
	));


	/* --------------------------------------------------------------------------
	 * Homepage Option - Homepage Setting
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_homepage',
		'title' => 'Homepage',
		'fields' => array (
			array (
				'key' => 'field_531a77d8d6ea8',
				'label' => 'Use as Homepage',
				'name' => 'use_homepage',
				'type' => 'radio',
				'instructions' => 'Enable or Disable the posts on this section. This section will show with pagination in the end of posts loop.',
				'choices' => array (
					'disable' => 'Disable',
					'enable' => 'Enable',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'disable',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_531fc39ce5c98',
				'label' => 'Title',
				'name' => 'home_title',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Enter the section title, leave blank if don\'t want display the title.',
				'column_width' => '',
				'default_value' => '',
				'formatting' => '',
			),
			array (
				'key' => 'field_531a785fd6ea9',
				'label' => 'Posts Layout',
				'name' => 'home_block_type',
				'type' => 'radio',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Select posts layout for this section.',
				'column_width' => '',
				'choices' => array (
					'block-1' => 'Block 1</br><img class="opt-image" title="Block 1" src="'.get_template_directory_uri().'/images/partial/blocked-1.png">',
					'block-2' => 'Block 2</br><img class="opt-image" title="Block 2" src="'.get_template_directory_uri().'/images/partial/blocked-2.png">',
					'block-3' => 'Block 3</br><img class="opt-image" title="Block 3" src="'.get_template_directory_uri().'/images/partial/blocked-3.png">',
					'block-4' => 'Block 4</br><img class="opt-image" title="Block 4" src="'.get_template_directory_uri().'/images/partial/blocked-4.png">',
					'block-6' => 'Block 6</br><img class="opt-image" title="Block 6" src="'.get_template_directory_uri().'/images/partial/blocked-6.png">',
					'block-7' => 'Block 7</br><img class="opt-image" title="Block 7" src="'.get_template_directory_uri().'/images/partial/blocked-7.png">'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'block-2',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_534e093f10fbb',
				'label' => 'Post Summary',
				'name' => 'home_summary',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'If enabled, post summary will show',
				'default_value' => 1,
			),
			array (
				'key' => 'field_531a865a24d97',
				'label' => 'Posts Filter by Category',
				'name' => 'home_category',
				'type' => 'taxonomy',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'You can select more than 1 category, use \'Ctrl\' to select more than 1 category.',
				'column_width' => '',
				'taxonomy' => 'category',
				'field_type' => 'checkbox',
				'allow_null' => 1,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array (
				'key' => 'field_531ac07ed7f46',
				'label' => 'Posts Filter by Tags',
				'name' => 'home_tags',
				'type' => 'taxonomy',
				'instructions' => 'You can select more than 1 tag, use \'Ctrl\' to select more than 1 tag',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'taxonomy' => 'post_tag',
				'field_type' => 'checkbox',
				'allow_null' => 1,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array (
				'key' => 'field_531abe559f953',
				'label' => 'Posts Sort order ',
				'name' => 'home_order',
				'type' => 'select',
				'choices' => array (
					'' => 'Latest',
					'rand' => 'Random',
					'popular_alltime' => 'Popular All-time (by Post views)',
					'popular_past7' => 'Popular This Week (by Post views)',
					),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_531abf8059c78',
				'label' => 'Number of posts per page',
				'name' => 'home_number_posts',
				'type' => 'number',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Set the number of posts per page',
				'column_width' => '',
				'default_value' => 4,
				'min' => 1,
				'max' => '',
				'step' => 1,
			),
			array (
				'key' => 'field_534ceb511f3d0',
				'label' => 'Offset',
				'name' => 'home_offset',
				'type' => 'number',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Set the Offset of this loop',
				'column_width' => '',
				'default_value' => 0,
				'min' => 0,
				'max' => '',
				'step' => 1,
			),
			array (
				'key' => 'field_53733ab623b6b',
				'label' => 'Pagination Style',
				'name' => 'pagination_style',
				'type' => 'radio',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_531a77d8d6ea8',
							'operator' => '==',
							'value' => 'enable',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Choose the pagination style',
				'choices' => array (
					'regular_pagination' => 'Regular Pagination',
					'infinite_scroll' => 'Infinite Scroll',
					),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'regular_pagination',
				'layout' => 'horizontal',
				),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));


	/* --------------------------------------------------------------------------
	 * Page Option - Additional settings for Page
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_page-options',
		'title' => 'Page Options',
		'fields' => array (
			array (
				'key' => 'field_531fc0e9019e7',
				'label' => 'Page Title',
				'name' => 'page_title',
				'type' => 'radio',
				'instructions' => 'Enable or Disable title on this page.',
				'choices' => array (
					'page_title_off' => 'Disable',
					'page_title_on' => 'Enable',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'page_title_on',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_5302dc268e229',
				'label' => 'Page Sidebar',
				'name' => 'page_sidebar',
				'type' => 'radio',
				'instructions' => 'Enable or Disable sidebar on this page. Disable to use this page full width.',
				'choices' => array (
					'page_sidebar_off' => 'Disable',
					'page_sidebar_on' => 'Enable',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'page_sidebar_off',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_534fb1854e079',
				'label' => 'Sidebar',
				'name' => 'page_sidebar_source',
				'type' => 'sidebar_selector',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5302dc268e229',
							'operator' => '==',
							'value' => 'page_sidebar_on',
						),
					),
					'allorany' => 'all',
				),
				'allow_null' => 1,
				'default_value' => 'page-sidebar',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));


	/* --------------------------------------------------------------------------
	 * Post Options - Additonal settings for Post
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_post-options',
		'title' => 'Post Options',
		'fields' => array (
			array (
				'key' => 'field_5308b2e2c4993',
				'label' => 'Make Featured',
				'name' => 'featured_post',
				'type' => 'true_false',
				'message' => 'Make this post featured',
				'default_value' => 0,
			),
			array (
				'key' => 'field_530c558029757',
				'label' => 'Cover Style',
				'name' => 'cover_post',
				'type' => 'radio',
				'choices' => array (
					'regular' => 'Regular',
					'parallax' => 'Parallax <i class="label"><a>(feat. image)</a></i>',
					'title' => 'Title',
					'boxed' => 'Boxed <i class="label"><a>(feat. image)</a></i>',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'regular',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_534cc05821a21',
				'label' => 'Single Featured Image',
				'name' => 'single_featured_image',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_530c558029757',
							'operator' => '==',
							'value' => 'regular',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Enable/disable Featured image in this posts',
				'default_value' => 0,
			),
			array (
				'key' => 'field_530c642b88de3',
				'label' => 'Top Sticky posts',
				'name' => 'top_featured_post',
				'type' => 'true_false',
				'message' => 'Enable/disable Top Sticky posts',
				'default_value' => 0,
			),
			array (
				'key' => 'field_533e6675a8eea',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'textarea',
				'instructions' => 'Fill the Subtitle of this post',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_534fbe3852719',
				'label' => 'Sidebar',
				'name' => 'single_sidebar_source',
				'type' => 'sidebar_selector',
				'allow_null' => 1,
				'default_value' => 'blog-sidebar',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	/* --------------------------------------------------------------------------
	 * Post Options Review - Additional review score for post
	 ---------------------------------------------------------------------------*/
	
	register_field_group(array (
		'id' => 'acf_post-review',
		'title' => 'Post Review Score',
		'fields' => array (
			array (
				'key' => 'field_530c5945007d1',
				'label' => 'Enable Post Review Score',
				'name' => 'enable_review',
				'type' => 'true_false',
				'message' => 'Turn On the Review Score',
				'default_value' => 0,
			),
			array (
				'key' => 'field_530c5ab498d6b',
				'label' => 'Review Information',
				'name' => 'review_info',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_530c5945007d1',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_5315e617a13ba',
				'label' => 'Review Style',
				'name' => 'review_style',
				'type' => 'select',
				'choices' => array (
					'star' => 'Star',
					'circle' => 'Circle',
					),
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_530c5945007d1',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_530c5ac1ad877',
				'label' => 'Review Item',
				'name' => 'score_module',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_530c5945007d1',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_51adb7cbb0820',
						'label' => 'Score',
						'name' => 'review_number',
						'type' => 'number',
						'default_value' => '1',
						'placeholder' => 'Insert the score number',
						'prepend' => '',
						'append' => '',
						'min' => '1.00',
						'max' => '10.00',
						'step' => '0.1',
					),
					array (
						'key' => 'field_530c5adb7d0fc',
						'label' => 'Label',
						'name' => 'review_label',
						'type' => 'text',
						'column_width' => 75,
						'default_value' => '',
						'formatting' => 'none',
					),
				),
				'row_min' => 1,
				'row_limit' => 10,
				'layout' => 'table',
				'button_label' => 'Add Review Item',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	/* --------------------------------------------------------------------------
	 * Author - Social Network link
	 ---------------------------------------------------------------------------*/
	register_field_group(array (
		'id' => 'acf_social-profile',
		'title' => 'Social Profile',
		'fields' => array (
			array (
				'key' => 'field_533e56cd99371',
				'label' => 'Email',
				'name' => 'u_email',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e566d9936e',
				'label' => 'Website',
				'name' => 'u_website',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e554699369',
				'label' => 'Facebook',
				'name' => 'u_facebook',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e54ed99368',
				'label' => 'Twitter',
				'name' => 'u_twitter',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e564d9936d',
				'label' => 'Instagram',
				'name' => 'u_instagram',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e56459936c',
				'label' => 'Pinterest',
				'name' => 'u_pinterest',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e56f599373',
				'label' => 'Youtube',
				'name' => 'u_youtube',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e55529936a',
				'label' => 'Google+',
				'name' => 'u_google_plus',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e55659936b',
				'label' => 'Linkedin',
				'name' => 'u_linkedin',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5cb263f76',
				'label' => 'Flickr',
				'name' => 'u_flickr',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5cda63f77',
				'label' => 'Tumblr',
				'name' => 'u_tumblr',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e56fd99374',
				'label' => 'Vimeo',
				'name' => 'u_vimeo',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5cf063f78',
				'label' => 'Behance',
				'name' => 'u_behance',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e56ab9936f',
				'label' => 'Dribbble',
				'name' => 'u_dribbble',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e56b699370',
				'label' => 'Github',
				'name' => 'u_github',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5d1a63f79',
				'label' => 'Stumble Upon',
				'name' => 'u_stumble_upon',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5d3f63f7a',
				'label' => 'Vkontakte',
				'name' => 'u_vkontakte',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5d5463f7b',
				'label' => 'Soundcloud',
				'name' => 'u_soundcloud',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5d6263f7c',
				'label' => 'Skype',
				'name' => 'u_skype',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5d6b63f7d',
				'label' => 'Spotify',
				'name' => 'u_spotify',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_533e5d7863f7e',
				'label' => 'Lastfm',
				'name' => 'u_lastfm',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_user',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

}


/* --------------------------------------------------------------------------
 * Add-Ons - USING PREMIUN ADD-ONS OUTSIDE THIS THEME IS NOT ALLOWED!!!
 ---------------------------------------------------------------------------*/
function maha_register_fields(){
	include_once('add-ons/acf-repeater/repeater.php');
	include_once('add-ons/acf-flexible-content/flexible-content.php');
}
add_action('acf/register_fields', 'maha_register_fields'); 