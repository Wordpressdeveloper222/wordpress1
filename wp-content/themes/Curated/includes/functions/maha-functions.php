<?php

/* --------------------------------------------------------------------------

	Maha Front End Function

    - General Functions - Mark 1.0.1

 ---------------------------------------------------------------------------*/

/* --------------------------------------------------------------------------
 * [maha_render_custom_css - Init Theme Head ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_render_custom_css') ) {

	// Add items to the header!
	function maha_render_custom_css() {

		$maha_options = get_option('curated');	

		// echo "<link rel='stylesheet' id='maha-dynamic-css'  href='".get_template_directory_uri()."/includes/functions/dynamic-style.php' type='text/css' media='all' />";

		echo '<style type="text/css">';	
		// -- Custom CSS
		// ----------------------------------------------------------------------
		echo $maha_options['custom_css'];

		// ----------------------------------------------------------------------
		echo '</style>';

		// -- Custom JS
		// ----------------------------------------------------------------------
		echo $maha_options['custom_js'];
	}
}

function maha_external_css(){
		$maha_options = get_option('curated');		

		// Font Family Heading
		// ----------------------------------------------------------------------		
		$fwv_weights = '';
		$font_1_family = $maha_options['font_1']['font-family'];
		if ( isset($maha_options['font_1']['google']) == true) { $font_1_family = "'".$font_1_family."'"; }
		if ( isset($maha_options['font_1']['font-options']) && ( $maha_options['google_fonts_on'] == true ) ) {
			$fw_options = json_decode($maha_options['font_1']['font-options']);
			if ( isset($fw_options->variants) ) {
				$fw_variants = $fw_options->variants;
				if (is_array($fw_variants)) {
					foreach ( $fw_variants as $fwv_key => $fwv_value) { $fwv_arr[] = $fwv_value->id; }
					$fwv_weights = ':'.implode(',', $fwv_arr);
					$subsets='&subsets=latin,'.$maha_options['font_1']['subsets'];
					// echo '<link href="http://fonts.googleapis.com/css?family='.str_replace(' ', '+', $maha_options['font_1']['font-family']).$fwv_weights.'" rel="stylesheet" type="text/css">';
					wp_enqueue_style( 'maha_heading_font', '//fonts.googleapis.com/css?family='.str_replace(' ', '+', $maha_options['font_1']['font-family']).$fwv_weights.$subsets );
				}
			}
		}

		// Font Family Main Menu
		// ----------------------------------------------------------------------
		$fwv_weights_3 = '';
		$font_3_family = $maha_options['font_3']['font-family'];
		if ( isset($maha_options['font_3']['google']) == true) { $font_3_family = "'".$font_3_family."'"; }
		if ( isset($maha_options['font_3']['font-options']) && ( $maha_options['google_fonts_on'] == true ) ) {
			$fw_options_3 = json_decode($maha_options['font_3']['font-options']);
			if ( isset($fw_options_3->variants) ) {
				$fw_variants_3 = $fw_options_3->variants;
				if (is_array($fw_variants_3)) {
					foreach ( $fw_variants_3 as $fwv3_key => $fwv3_value) { $fwv3_arr[] = $fwv3_value->id; }
					$fwv_weights_3 = ':'.implode(',', $fwv3_arr);
					$subsets3='&subsets=latin,'.$maha_options['font_3']['subsets'];
					// echo '<link href="http://fonts.googleapis.com/css?family='.str_replace(' ', '+', $maha_options['font_3']['font-family']).$fwv_weights_3.'" rel="stylesheet" type="text/css">';
					wp_enqueue_style( 'maha_main_font','//fonts.googleapis.com/css?family='.str_replace(' ', '+', $maha_options['font_3']['font-family']).$fwv_weights_3.$subsets3 );
				}
			}
		}

		// Font Family Content
		// ----------------------------------------------------------------------
		$fwv_weights_2 = '';
		$font_2_family = $maha_options['font_2']['font-family'];
		if ( isset($maha_options['font_2']['google']) == true) { $font_2_family = "'".$font_2_family."'"; }
		if ( isset($maha_options['font_2']['font-options']) && ( $maha_options['google_fonts_on'] == true ) ) {
			$fw_options_2 = json_decode($maha_options['font_2']['font-options']);
			if ( isset($fw_options_2->variants) ) {
				$fw_variants_2 = $fw_options_2->variants;
				if (is_array($fw_variants_2)) {
					foreach ( $fw_variants_2 as $fwv2_key => $fwv2_value) { $fwv2_arr[] = $fwv2_value->id; }
					$fwv_weights_2 = ':'.implode(',', $fwv2_arr);
					$subsets2='&subsets=latin,'.$maha_options['font_2']['subsets'];
					// echo '<link href="http://fonts.googleapis.com/css?family='.str_replace(' ', '+', $maha_options['font_2']['font-family']).$fwv_weights_2.'" rel="stylesheet" type="text/css">';				
					wp_enqueue_style( 'maha_content_font','//fonts.googleapis.com/css?family='.str_replace(' ', '+', $maha_options['font_2']['font-family']).$fwv_weights_2.$subsets2 );
				}
			}
		}

		// echo "<link rel='stylesheet' id='maha-dynamic-css'  href='".get_template_directory_uri()."/includes/functions/dynamic-style.php' type='text/css' media='all' />";
		// wp_enqueue_style( 'maha_dynamic_style', get_template_directory_uri().'/includes/functions/dynamic-style.php', '', '', 'all' );

}

function maha_dynamic_style(){
	    // include_once("../../../../../wp-load.php");

    $maha_options = get_option('curated');
    $font_1_family = $maha_options['font_1']['font-family'];
    $font_2_family = $maha_options['font_2']['font-family'];
    $font_3_family = $maha_options['font_3']['font-family'];

    echo "<style>";
    // -- Respponsive Off
        // ----------------------------------------------------------------------
    if ( $maha_options['responsive_on'] == false ){
        echo '#body-maha{overflow-x: inherit;}';
    }
        // -- Top Bar
        // ----------------------------------------------------------------------
    echo '@media (min-width: 769px) {';
    if ( $maha_options['top_bar_on'] == true ){
        echo '#top-bar-sticky {display: inherit;}';
    } else {
        echo '#top-bar-sticky {display: none;}';
    }
    echo '}';
    ?>
    <?php if(($font_1_family != 'Oswald') || ($maha_options['font_1']['font-weight'] != 400)) {?>
		    /*Font Family Heading*/
		    h1, h2, h3, h4, h5, h6, .mobile-bar ul li, .main-ul-nav ul li a, .i-slide .full .detail h2, .meta-info, .meta-info .entry-author a,.s-number, .meta-share, .meta-tags, .next-prev, .np-caption, .meta-author .author-name, .meta-review .review-visual .visual-value,.nf404-title, .social_subscribe .social-network .social-network-count, .wpcf7-submit, .i-button, .i-divider span, .i-message-box .i-mb-title,.pagination, .content-pagination, .comment-list .reply, .comment-list .comment-author, .comment-list .comment-meta, #respond #submit,.widget_popular_post .nav-popular-post li a,.lwa-form h2, .thumb-runtext a, .woo-maha #reviews #comments ol.commentlist li .comment-text .meta,.woo-maha .myaccount_user > span strong, .woo-maha .shop_table thead tr, .woocommerce .widget_price_filter .price_slider_amount .button,.maha-heading-font, .bbp-login-form .bbp-submit-wrapper, .bbp-reply-content .bbp_author_name > .bbp-author-name, .bbp-section-caption, li.bbp-topic-title > .bbp-topic-permalink, .bbp-reply-content .bbp_author_name > a:first-child, li.bbp-forum-info .bbp-forum-title{
		    <?php if ( isset($maha_options['font_1']['font-options']) ) {
				$fw_options = json_decode($maha_options['font_1']['font-options']);
				if ( isset($fw_options->variants) ) { ?>
					font-family:'<?php echo $font_1_family;?>', Arial, sans-serif;
				<?php } else { ?>
					font-family:<?php echo $font_1_family;?>;
				<?php } ?>
			<?php } ?>
	   		font-weight:<?php echo $maha_options['font_1']['font-weight'];?>;
	   	}
   	<?php }?>
   	<?php if(($font_2_family != 'Lato') || ($maha_options['font_2']['font-weight'] != 400)) {?>
	    /*Font Family Content*/
	    #buddypress div.generic-button .friendship-button,#buddypress .bbp-the-content-wrapper .wp-editor-container .quicktags-toolbar input, #buddypress div.generic-button .friendship-button a,
	    #buddypress .maha_bp_group_button div.generic-button a, .woo-maha ul.order_details.bacs_details h3, .widget.widget_icl_lang_sel_widget #lang_sel, #lang_sel_footer, body{;
	    	<?php if ( isset($maha_options['font_2']['font-options']) ) {
				$fw_options_2 = json_decode($maha_options['font_2']['font-options']);
				if ( isset($fw_options_2->variants) ) { ?>
					font-family:'<?php echo $font_2_family;?>', Arial, sans-serif;
				<?php } else { ?>
					font-family:<?php echo $font_2_family;?>;
				<?php } ?>
			<?php } ?>
	    	font-weight:<?php echo $maha_options['font_2']['font-weight'];?>;
	    	font-size:<?php echo $maha_options['font_2']['font-size'];?>;
	    }
	    #buddypress div#item-header #item-buttons div.generic-button#post-mention a,#buddypress div#item-header #item-buttons div.generic-button#send-private-message a,#buddypress .maha-bp-content-font {
			<?php if ( isset($maha_options['font_2']['font-options']) ) {
				$fw_options_2 = json_decode($maha_options['font_2']['font-options']);
				if ( isset($fw_options_2->variants) ) { ?>
					font-family:'<?php echo $font_2_family;?>', Arial, sans-serif !important;
				<?php } else { ?>
					font-family:<?php echo $font_2_family;?> !important;
				<?php } ?>
			<?php } ?>
	    }
    <?php }?>
    <?php if(($font_3_family != 'Oswald') || ($maha_options['font_3']['font-weight'] != 400) ) {?>
	    .mobile-bar ul li, .main-ul-nav ul li a{
	    	<?php if ( isset($maha_options['font_3']['font-options']) ) {
				$fw_options_3 = json_decode($maha_options['font_3']['font-options']);
				if ( isset($fw_options_3->variants) ) { ?>
					font-family:'<?php echo $font_3_family;?>', Arial, sans-serif;
				<?php } else { ?>
					font-family:<?php echo $font_3_family;?>;
				<?php } ?>
				font-weight:<?php echo $maha_options['font_3']['font-weight'];?>;
				font-style:<?php echo $maha_options['font_3']['font-style'];?>;				
			<?php } ?>
		}
	<?php }?>
	<?php if($maha_options['accent_1'] != '#db2e1c') {?>
	    /*Primary Color / Accent 1*/
	    /*box shadow bottom -3px*/
	    .ul-nav ul li.current-menu-ancestor a, .ul-nav ul li.current-menu-parent a, .ul-nav ul li.current_page_parent a, .ul-nav ul li.current-menu-item a, .ul-nav ul li:hover a{
	    	-webkit-box-shadow: 0 -3px 0 <?php echo $maha_options['accent_1'];?> inset; -moz-box-shadow: 0 -3px 0 <?php echo $maha_options['accent_1'];?> inset; box-shadow: 0 -3px 0 <?php echo $maha_options['accent_1'];?> inset;
	    }
	    /*box shadow bottom -4px*/
	    .main-ul-nav ul li.current_page_ancestor a, .main-ul-nav ul li.current_page_parent a, .main-ul-nav ul li.current-menu-parent a, .main-ul-nav ul li.current-menu-ancestor a, .main-ul-nav ul li.current-menu-item a, .main-ul-nav ul li:hover a{
	    	-webkit-box-shadow: 0 -4px 0 <?php echo $maha_options['accent_1'];?> inset; -moz-box-shadow: 0 -4px 0 <?php echo $maha_options['accent_1'];?> inset; box-shadow: 0 -4px 0 <?php echo $maha_options['accent_1'];?> inset;
	    }
	    /*color*/
	    .mobile-bar #close-mobile-bar:hover, .ul-nav ul li ul li a:hover, .ul-nav ul li ul li.current-menu-item a{
	    	color: <?php echo $maha_options['accent_1'];?>;
	    }
    <?php }?>
    <?php if($maha_options['accent_2'] != '#4dace6') {?>
	    /*Primary Color / Accent 2*/
	    /*background color*/
	    .pagination a.current, .bbp-pagination .pagination span.current, .content-pagination > span, .woocommerce-pagination ul li .page-numbers.current, .woocommerce .shop_table .actions .button, .woocommerce .shipping-calculator-form .button, #place_order,.maha-woo .button, .woocommerce #review_form_wrapper .form-submit #submit,.woo-button, .woo-maha ul.products li.product a.button:hover, .woo-maha div.product form.cart .button,.woo-maha .track_order input.button, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,#buddypress div.pagination .pagination-links span.current, .cart-count .shop-cart, .woocommerce .widget_price_filter .price_slider_amount .button{
			background-color: <?php echo $maha_options['accent_2'];?>;
		}
	    /*color*/
	    .pagination a.inactive:hover,.pagination a.boundary:hover, .woocommerce-pagination ul li a.page-numbers:hover, .shop_table.order_details .order_item .product-name a, .order-number a, .order-actions a,.woo-maha label .required, .woo-maha .star-rating, .woo-maha ul.products li.product .price, .woo-maha p.stars a.star-1:after, .woo-maha p.stars a.star-2:after, .woo-maha p.stars a.star-3:after, .woo-maha p.stars a.star-4:after, .woo-maha p.stars a.star-5:after,.woo-maha div.product div.summary .product_meta .posted_in a, .woocommerce .product_list_widget li .star-rating,#buddypress div.pagination .pagination-links a:hover,
	    .woo-maha .star-rating span:before, .woocommerce .product_list_widget .star-rating span:before, .bbp-pagination .pagination a:hover, .bbp-pagination .pagination a.prev:hover, .bbp-pagination .pagination a.next:hover {
			color: <?php echo $maha_options['accent_2'];?>;
		}
		/*woocommerce cart count*/
		.cart-count .count-arrow{border-right: 5px solid <?php echo $maha_options['accent_2'];?>;}

		.rtl .cart-count .count-arrow { border-left: 5px solid <?php echo $maha_options['accent_2'];?>; }
	<?php }?>
	<?php if($maha_options['th_bg_color'] != '#212121') {?>
		/*Top Header*/
		/*background color*/
	    #top-bar-sticky, #body-maha, .ul-nav ul li ul{
	    	background-color: <?php echo $maha_options['th_bg_color'];?>;
		}
	    /*box shadow*/
	    .ul-nav ul li a{
	    	-webkit-box-shadow: 0 -3px 0 <?php echo $maha_options['th_bg_color'];?> inset; -moz-box-shadow: 0 -3px 0 <?php echo $maha_options['th_bg_color'];?> inset; box-shadow: 0 -3px 0 <?php echo $maha_options['th_bg_color'];?> inset;
		}
	<?php }?>
    <?php if(($maha_options['th_divider_alt_1'] != '#111111') || ($maha_options['th_divider_alt_2'] != '#323232')) {?>
	    /*border-left & shadow*/
	    .ul-nav ul li{
	    	border-left: 1px solid <?php echo $maha_options['th_divider_alt_1'];?>;
	    	-webkit-box-shadow: 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?> inset; -moz-box-shadow: 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?> inset; box-shadow: 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?> inset;
		}    
	    /*border-left & shadow : last*/
	    .ul-nav > ul > li:last-child{
	    	border-right: 1px solid <?php echo $maha_options['th_divider_alt_1'];?>;
	    	-webkit-box-shadow: 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?> inset, 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?>; -moz-box-shadow: 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?> inset, 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?>; box-shadow: 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?> inset, 1px 0 0 <?php echo $maha_options['th_divider_alt_2'];?>;
		}    
	    /*Sub Menu border*/
	    .ul-nav ul li ul li a{
	    	border-top: 1px solid <?php echo $maha_options['th_divider_alt_1'];?>; -webkit-box-shadow: 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> inset, 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> !important;
	    	-moz-box-shadow: 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> inset, 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> !important; box-shadow: 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> inset, 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> !important;
		}    
	    /*Mobile Sub Menu border*/
	    .mobile-bar ul li a{
	    	border-bottom: 1px solid <?php echo $maha_options['th_divider_alt_1'];?>; -webkit-box-shadow: 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> inset, 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> !important;
	    	-moz-box-shadow: 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> inset, 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> !important; box-shadow: 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> inset, 0px 1px 0px <?php echo $maha_options['th_divider_alt_2'];?> !important;
		}    
	    /*Mobile Sub Menu border*/
	    .mobile-bar #close-mobile-bar{
	    	border-bottom: 1px solid <?php echo $maha_options['th_divider_alt_1'];?>;
		}
	<?php }?>
    <?php if($maha_options['th_bg_mob_color'] != '#181818') {?>
	    /*Mobile Active Bg Color*/
	    .mobile-bar ul li a:hover, .mobile-bar ul li.current_page_ancestor > a, .mobile-bar ul li.current-menu-parent > a, .mobile-bar ul li.current-menu-item > a, .mobile-bar ul li.current_page_item > a{
	    	background-color: <?php echo $maha_options['th_bg_mob_color'];?>;
		}
	<?php }?>
	<?php if($maha_options['th_txt_color'] != '#EAEAEA') {?>
		/*color*/
	    .ul-nav ul li a, #top-mobile-wrapper a, .mobile-bar #close-mobile-bar, .mobile-bar ul li a, .mobile-bar ul li .navmob-sub-menu:hover, .mobile-bar ul li .navmob-sub-menu .icon-up-open-mini, .mobile-bar ul li .navmob-sub-menu{
	    	color: <?php echo $maha_options['th_txt_color'];?>;
		}
	<?php }?>
    <?php
    if ($maha_options['boxed_on'] == true) {?>
    	/*Background Body*/
        #body-maha {
        	background-color: <?php echo $maha_options['body_background']['background-color'];?>; background-image:url("<?php echo $maha_options['body_background']['background-image'];?>"); background-repeat: <?php echo $maha_options['body_background']['background-repeat'];?>;
        	background-position: <?php echo $maha_options['body_background']['background-position'];?>; background-size: <?php echo $maha_options['body_background']['background-size'];?>; background-attachment: <?php echo $maha_options['body_background']['background-attachment'];?>; 
    	}        
        #body-background { margin: 0 auto;}
        @media (min-width: 1200px){#body-background, #main-nav-bar.on-stuck { width: 1200px; }}
        @media (max-width: 1199px) and (min-width: 992px) {#body-background, #main-nav-bar.on-stuck { width: 997px; }}
        @media (max-width: 991px) and (min-width: 768px) {#body-background, #main-nav-bar.on-stuck { width: 773px; }}
   	<?php }?>
    <?php if($maha_options['mh_home_color'] != '#DADADA') {?>
	    /*Main Header Category*/
	    /*Home Button*/
	    .main-ul-nav ul li.menu-item-home a{
	    	-webkit-box-shadow: 0 -4px 0 <?php echo $maha_options['mh_home_color'];?> inset; -moz-box-shadow: 0 -4px 0 <?php echo $maha_options['mh_home_color'];?> inset; box-shadow: 0 -4px 0 <?php echo $maha_options['mh_home_color'];?> inset;
	    }
    <?php }?>
    <?php if($maha_options['mh_txt_color'] != '#333333') {?>
	    /*Primary Menu Color*/
	    .main-ul-nav ul li a, #cart-nav .cart-count i, #search-nav .open-search-form i, #logout-nav .open-login-form i, #login-nav .open-login-form i{color: <?php echo $maha_options['mh_txt_color'];?>;}
    <?php }?>
    <?php if($maha_options['accent_3'] != '#ffffff') {?>
	    /*background color*/
	    #main-nav-bar{background-color: <?php echo $maha_options['accent_3'];?>;}
	    .main-nav-bar ul li a{-webkit-box-shadow: 0 -4px 0 <?php echo $maha_options['accent_3'];?> inset; -moz-box-shadow: 0 -4px 0 <?php echo $maha_options['accent_3'];?> inset; box-shadow: 0 -4px 0 <?php echo $maha_options['accent_3'];?> inset;}
    <?php }?>
	<?php
    // -- Each Category
    foreach (get_categories() as $key_cat) {
        $cat_color = '';
        $cat_color = get_field( 'category_color', 'category_' . $key_cat->cat_ID );  
        if($cat_color != ''){      
        ?>
		.main-ul-nav ul li.mh-navcat-<?php echo $key_cat->cat_ID;?>:hover > a,.main-ul-nav ul li.mh-navcat-<?php echo $key_cat->cat_ID;?>.current-menu-item > a,.main-ul-nav ul li.mh-navcat-<?php echo $key_cat->cat_ID;?>.current-post-parent > a{
		-webkit-box-shadow: 0 -4px 0 <?php echo $cat_color;?> inset; -moz-box-shadow: 0 -4px 0 <?php echo $cat_color;?> inset; box-shadow: 0 -4px 0 <?php echo $cat_color;?> inset; }
         /*Custom Category*/
        .i-category a.mh-elcat-<?php echo $key_cat->cat_ID;?>{background:<?php echo $cat_color;?>;}
    <?php }}?>
    <?php if($maha_options['mh_sub_bg_color'] != '#ffffff') {?>
	    /*Sub Menu Background Color*/
	    .main-ul-nav ul li .nav-sub-wrap{background-color: <?php echo $maha_options['mh_sub_bg_color'];?>;}
    <?php }?>
    <?php if($maha_options['mh_sub_txt_color'] != '#333333') {?>
	    /*Sub Menu Text Color*/
	    .main-ul-nav ul li .nav-sub-wrap ul li a, .nav-sub-posts a.entry-title, .nav-sub-posts .meta-info a,
	    .nav-sub-wrap .meta-info .entry-author a{color: <?php echo $maha_options['mh_sub_txt_color'];?>;}
    <?php }?>
    <?php if($maha_options['mh_sub_txt_color_vague'] != '#333333') {?>
	    /*Sub Menu Text Vague Color*/
	    .nav-sub-posts .entry-date{color: <?php echo $maha_options['mh_sub_txt_color_vague'];?>;}
    <?php }?>
    <?php if($maha_options['mh_sub_bg_hover_color'] != '#ebebeb') {?>
	    /*Sub Menu Background Hover Color*/
	    .main-ul-nav .nav-sub-wrap .nav-sub-menus ul li a:hover,.main-ul-nav .nav-sub-wrap .nav-sub-menus.col-sm-3 ul li a:hover{background-color: <?php echo $maha_options['mh_sub_bg_hover_color'];?>;}
    <?php }?>
    <?php if($maha_options['mh_sub_txt_hover_color'] != '#333333') {?>
	    /*Sub Menu Hover Text Color*/
	    .main-ul-nav ul li .nav-sub-wrap ul li a:hover{color: <?php echo $maha_options['mh_sub_txt_hover_color'];?>;}
    <?php }?>
    <?php if($maha_options['mh_sub_divider_color'] != '#DADADA') {?>
	    /*Sub Menu Divider*/
	    .main-ul-nav .nav-sub-wrap .nav-sub-menus ul li a{-webkit-box-shadow: 0 1px 0 <?php echo $maha_options['mh_sub_divider_color'];?> !important; -moz-box-shadow: 0 1px 0 <?php echo $maha_options['mh_sub_divider_color'];?> !important; box-shadow: 0 1px 0 <?php echo $maha_options['mh_sub_divider_color'];?> !important;}
    <?php }?>
    <?php if(($maha_options['mh_search_background_color'] != '#ffffff') || ($maha_options['mh_search_text_color'] != '#DADADA')) {?>
	    /*Search Background & Text Color*/
	    #main-search-form, #con-search{background-color: <?php echo $maha_options['mh_search_background_color'];?>;}
	    #main-search-form .search-field{background-color: <?php echo $maha_options['mh_search_background_color'];?>; color: <?php echo $maha_options['mh_search_text_color'];?>;}
	    #main-search-form .search-field::-webkit-input-placeholder{color: <?php echo $maha_options['mh_search_text_color'];?>;}
	    #main-search-form .search-field:-moz-placeholder{color: <?php echo $maha_options['mh_search_text_color'];?>;}
	    #main-search-form .search-field::-moz-placeholder{color: <?php echo $maha_options['mh_search_text_color'];?>;}
	    #main-search-form .search-field:-ms-input-placeholder{color: <?php echo $maha_options['mh_search_text_color'];?>;}
	    .close-search-form .icon-cancel{color: <?php echo $maha_options['mh_search_text_color'];?>;}
    <?php }?>
    <?php if($maha_options['co_txt_color_2'] != '#595858') {?>
	    /*Content Options*/
	    /*URL Content Default Color*/
	    a{color: <?php echo $maha_options['co_txt_color_2'];?>}
	    /*Content Color*/
	    body, .widget_calendar tbody td,input[type="text"], input[type="password"], input[type="email"], textarea, select, #con-search, #buddypress #profile-edit-form ul.button-nav a, #buddypress form#whats-new-form textarea, #buddypress .standard-form select,
	    #buddypress div.item-list-tabs#subnav ul li.feed a, #buddypress ul.item-list li div.item-title span, #buddypress ul#groups-list li .item-desc p, .bp-site-wide-message div#message p a, #sitewide-notice a, #buddypress table tr td.thread-info p.thread-excerpt,
	    #buddypress div.activity-comments form textarea
	    {color: <?php echo $maha_options['co_txt_color_2'];?>}


	    #bbpress-forums .bbp-body li.bbp-forum-topic-reply, li.bbp-topic-post, .bbp-pagination-count, #bbpress-forums div.bbp-reply-content .maha_bbp_author_name
	    {color: <?php echo $maha_options['co_txt_color_2'];?>}

	    .woo-maha .form-row .chosen-container-single .chosen-single, .woo-maha .quantity.buttons_added > input, .woo-maha .myaccount_user, .woo-maha .myaccount_user a, .woo-maha .myaccount_user span
	    {color: <?php echo $maha_options['co_txt_color_2'];?>}



	    #con-search .search-field, ::-webkit-input-placeholder
	    {color: <?php echo $maha_options['co_txt_color_2'];?> !important}
    <?php }?>
    <?php if($maha_options['co_txt_color_1'] != '#333333') {?>
	    /*Heading*/
	    h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	    .block-cap h3, .meta-info .entry-author, .meta-info .entry-author a, .next-prev .prev i, .next-prev .next i, .next-prev .np-title,
	    .meta-author .author-name a, .nf404-title, strong, .dropcap.normal, .i-divider span, .i-message-box .i-mb-title,
	    .i-toggle.active, .i-toggle .toggle-nav, .i-tabs .tab-nav, .i-tabs .tab-nav li a,
	    .pagination a, .content-pagination > a > span, .widget_recents .recent-item a, .widget_popular_post .nav-popular-post li a, .thumb-runtext a,
	    .woocommerce .shop_table thead tr th, .woocommerce .cart_totals th, .bbp-author-name a, .bbp-section-caption, #buddypress div.item-list-tabs ul li a, #buddypress div.item-list-tabs ul li span,
	    #buddypress .activity-list .new_blog_post .activity-header p a:first-child, #buddypress .activity-list .activity_update .activity-header p a:first-child,
	    #buddypress .activity-header p a:first-child, #buddypress .acomment-content p a:first-child, #buddypress ul#groups-list li .item-title a, #buddypress .activity-list li.load-newest a,
	    .bp-site-wide-message div#message p strong, #sitewide-notice strong, #buddypress div#message-thread #send-reply div.message-box .avatar-box strong, #buddypress div#message-thread strong a, .widget.buddypress div.item-options,
	    .widget.buddypress div.item-options a, .widget.buddypress .bp-login-widget-user-links > div.bp-login-widget-user-link a, .pagination a.prev, .pagination a.next
	    {color: <?php echo $maha_options['co_txt_color_1'];?>}

	    li.bbp-forum-info .bbp-forum-title, #bbpress-forums li.bbp-header ul.forum-titles li, li.bbp-topic-title > .bbp-topic-permalink, #bbpress-forums #bbp-single-user-details #bbp-user-navigation a
	    {color: <?php echo $maha_options['co_txt_color_1'];?>}

	    /*Background*/
	    .maha-progress-bar .bar, .dropcap.square, .dropcap.circle
	    {background-color: <?php echo $maha_options['co_txt_color_1'];?>}
    <?php }?>
    <?php if($maha_options['co_txt_color_vague'] != '#9a9a9a') {?>
	    /*Content Vague Color*/
	    .single .cover .single-subtitle,.maha-crumbs, .maha-crumbs a, .meta-info .entry-date, .meta-info-divider, .meta-info-comments, .meta-info-comments a, .meta-info-viewer, .meta-share > a,
	    .comment-list .reply a, .comment-list .comment-meta a, .np-caption, .meta-share, .meta-share > a, .bbp-breadcrumb, .bbp-breadcrumb a, #buddypress span.activity, #buddypress .standard-form .pass-title,
	    #buddypress .field-visibility-settings, #buddypress .field-visibility-settings-toggle, #buddypress .field-visibility-settings-notoggle, #buddypress div#item-header .mentionname,
	    #buddypress a.activity-time-since, #buddypress .activity-list .activity_update .activity-header p, #buddypress .activity-list .activity_update .activity-header p a,
	    #buddypress .activity-list .activity-content .activity-header, #buddypress .mini .activity-header p a.activity-time-since, #buddypress div.activity-meta .button, #buddypress .acomment-options a,
	    #buddypress div#item-header div#item-meta a, #buddypress .mini .activity-header p a:first-child, #buddypress .mini .activity-header p a, #buddypress .activity-header p a,
	    #buddypress a.bp-primary-action span, #buddypress #reply-title small a span, #buddypress form .editfield .clear-value, #buddypress form .editfield .visibility-toggle-link, #buddypress form .editfield .field-visibility-settings-close,
	    #buddypress span.highlight, #buddypress ul#groups-list li .item-meta span, #buddypress ul.item-list li div.meta, #buddypress #message-recipients span.highlight a, #buddypress .standard-form p.description, .widget.buddypress span.activity
	    {color: <?php echo $maha_options['co_txt_color_vague'];?>}

	    li .maha-freshness, li .maha-freshness a, #bbpress-forums .maha-bbp-tag a, li.bbp-topic-title .bbp-topic-meta, li.bbp-topic-title .bbp-topic-meta a, #bbpress-forums .maha-bbp-tag, #bbpress-forums div.bbp-reply-author .bbp-author-role,
	    span.bbp-author-ip, .bbp-reply-post-date, .bbp-reply-date-ip, #bbpress-forums .bbp-reply-content ul.bbp-topic-revision-log, span.bbp-admin-links, span.bbp-admin-links a, #bbpress-forums div.bbp-reply-content .bbp-reply-permalink,
	    #bbpress-forums .bbp-reply-content ul.bbp-reply-revision-log li, #bbpress-forums .bbp-reply-content ul.bbp-topic-revision-log li a, #bbpress-forums .bbp-reply-content ul.bbp-reply-revision-log li a, .widget_display_replies ul li div,
	    .widget_display_topics ul li div
	    {color: <?php echo $maha_options['co_txt_color_vague'];?>}

	    .woo-maha #reviews #comments ol.commentlist li .comment-text p.meta time, .woo-maha .product .price del, .woo-maha #payment ul.payment_methods li .payment_box, .woo-maha #payment ul.payment_methods .payment_method_paypal a,
	    .woocommerce > .product_list_widget li .reviewer, .woocommerce > .product_list_widget li .amount
	    {color: <?php echo $maha_options['co_txt_color_vague'];?>}
    <?php }?>
    <?php if($maha_options['coa_txt_color_1'] != '#ffffff') {?>
	    /*Alt/Reverse Heading*/
	    .i-slide .detail h2, .single .cover .detail h1, .ads_box .ads_title, .widget_review .popupar-item .detail h4, .play-the-media, .ads_title, #footer h5.ads_title, .content-pagination > span
	    {color: <?php echo $maha_options['coa_txt_color_1'];?>}
    <?php }?>
    <?php if($maha_options['coa_txt_color_2'] != '#eeeeee') {?>
	    /*Alt/Reverse Content*/
	    .i-slide .meta-info .entry-author, .i-slide .meta-info .entry-date, .cover .meta-share, .cover .meta-share a, .cover .single-subtitle,
	    .single .cover .meta-info .entry-author a, .single .cover .meta-info-divider, .single .cover .meta-info-comments,
	    .single .cover .meta-info-viewer, .single .cover .meta-info .entry-date, .single .cover .meta-info-comments a, .ads_box .ads_subtitle
	    {color: <?php echo $maha_options['coa_txt_color_2'];?>}
    <?php }?>



    <?php if ($maha_options['coe_button_bg_color'] != '#333333') { ?>
    	#buddypress input[type=submit], #buddypress input[type=button], #buddypress input[type=reset], .widget.buddypress #bp-login-widget-form #bp-login-widget-submit,
    	#buddypress .activity-list li.load-more a, #buddypress .activity-list li.load-newest a, #buddypress div.generic-button a, .buddy-header a.group-create,
    	#buddypress .button.mh-button
    	{background-color: <?php echo $maha_options['coe_button_bg_color']; ?>}

    	#respond #submit, .mh-button, .bbp_widget_login .bbp-login-form .bbp-submit-wrapper button
    	{background-color: <?php echo $maha_options['coe_button_bg_color']; ?>}
    <?php } ?>
    <?php if ($maha_options['coe_button_text_color'] != '#ffffff') { ?>
    	#buddypress input[type=submit], #buddypress input[type=button], #buddypress input[type=reset], .widget.buddypress #bp-login-widget-form #bp-login-widget-submit,
    	#buddypress .activity-list li.load-more a, #buddypress .activity-list li.load-newest a, #buddypress div.generic-button a, .buddy-header a.group-create,
    	#buddypress .button.mh-button
    	{color: <?php echo $maha_options['coe_button_text_color']; ?>}

    	#respond #submit, .mh-button, .mh-button:hover, .bbp_widget_login .bbp-login-form .bbp-submit-wrapper button
    	{color: <?php echo $maha_options['coe_button_text_color']; ?>}
    <?php } ?>



    <?php if($maha_options['coe_bold_divider_color'] != '#333333') {?>
	    /*Bold Divider*/
	    .main-content .title-divider, .i-divider span, .i-divider.bold, .block-cap h3, .text-content a, #buddypress div.item-list-tabs ul li.selected a, #buddypress div.item-list-tabs ul li.current a
	    {border-color: <?php echo $maha_options['coe_bold_divider_color'];?>}

	    .widget_popular_post .nav-popular-post li a:hover, .widget_popular_post .nav-popular-post li a.popular-active {
	    	-webkit-box-shadow: 0 -4px 0 <?php echo $maha_options['coe_bold_divider_color'];?> inset;
    		-moz-box-shadow: 0 -4px 0 <?php echo $maha_options['coe_bold_divider_color'];?> inset;
    		box-shadow: 0 -4px 0 <?php echo $maha_options['coe_bold_divider_color'];?> inset;
    	}
    <?php }?>
    <?php if($maha_options['coe_one_divider_color'] != '#cacaca') {?>
	    /*One Divider*/
	    .block-cap, .one-divider, .i-divider, .timeline-list, .widget_popular_post .nav-popular-post li, .el-featured-slide .line-divider, #buddypress .activity-list li.mini, #buddypress .activity-list li.new_blog_post .activity-content, #buddypress .activity-list li.activity_update .activity-content, #buddypress .activity-list li.activity_comment .activity-content,
	    #buddypress div.activity-comments div.acomment-content, #buddypress div.item-list-tabs#subnav, #buddypress div.item-list-tabs, #buddypress ul#groups-list li, #buddypress ul#group-list li, #buddypress table#message-threads tr, #buddypress table.notification-settings tr, #buddypress table.profile-settings tr,
	    #buddypress #admins-list li, #buddypress #mods-list li, #buddypress #groups-list li, #buddypress #members-list li, #buddypress div.item-list-tabs#group-create-tabs, #buddypress #create-group-form #group-create-body .radio label, #buddypress #group-settings-form .radio label,
	    #buddypress #create-group-form #group-create-body .maha_bp_group_invite .radio, #buddypress #group-settings-form .maha_bp_group_invite .radio, #buddypress #members-group-list #member-list li, #buddypress .activity-list li.load-more, #buddypress .activity-list li.load-newest,
	    .bp-site-wide-message div#message p, #buddypress div#message p, #sitewide-notice p, #buddypress div#message-thread div.message-box, #buddypress div#invite-list, #buddypress form.standard-form .main-column ul#friend-list > li, #buddypress div.item-list-tabs ul li a span
	    {border-color: <?php echo $maha_options['coe_one_divider_color'];?>}


	    #bbpress-forums ul.bbp-forums, #bbpress-forums li.bbp-body ul.forum, #bbpress-forums ul.bbp-topics .bbp-header, #bbpress-forums li.bbp-body ul.topic, #bbpress-forums div.bbp-reply-content, #bbpress-forums .bbp-reply-content ul.bbp-topic-revision-log
	    {border-color: <?php echo $maha_options['coe_one_divider_color'];?>}

	    .woo-maha table, .woo-maha th, .woo-maha td, .woo-maha #reviews #comments ol.commentlist li, .woo-maha div.product .woocommerce-tabs ul.tabs li, .woo-maha #payment ul.payment_methods, .woo-maha #payment ul.payment_methods li, .woo-maha .order_details, .woo-maha .order_details li,
	    .woo-maha #woo-my-address .addresses.row address, .woo-maha .woo-customer-detail .customer_details, .woo-maha .woo-customer-detail address, .woocommerce > .product_list_widget li, .widget_shopping_cart_content, .widget_shopping_cart_content .cart_list > li, .widget_shopping_cart_content .total,
	    .widget_shopping_cart_content .buttons a:first-child
	    {border-color: <?php echo $maha_options['coe_one_divider_color'];?>}


	    .next-prev .prev:last-child{-webkit-box-shadow: -1px 0px 0 <?php echo $maha_options['coe_one_divider_color'];?> inset; -moz-box-shadow: -1px 0px 0 <?php echo $maha_options['coe_one_divider_color'];?> inset; box-shadow: -1px 0px 0 <?php echo $maha_options['coe_one_divider_color'];?> inset}
	    @media (max-width: 767px) {
	    	.next-prev a{-webkit-box-shadow: 0px -1px 0 <?php echo $maha_options['coe_one_divider_color'];?> inset; -moz-box-shadow: 0px -1px 0 <?php echo $maha_options['coe_one_divider_color'];?> inset; box-shadow: 0px -1px 0 <?php echo $maha_options['coe_one_divider_color'];?> inset;}
	    }
    <?php }?>
    <?php if($maha_options['coe_input_border_color'] != '#dadada') {?>
	    /*Input Border color*/
	    input[type="text"], input[type="password"], input[type="email"], textarea, select, #buddypress div.activity-comments form .ac-textarea, #buddypress .friend-tab
	    {border-color: <?php echo $maha_options['coe_input_border_color'];?>}


	    .bbp-forum-form div.wp-editor-container, #bbp-search-form div, #bbpress-forums div.wp-editor-container, .bbp-reply-form div.wp-editor-container, #bbpress-forums #bbp-your-profile fieldset input, #bbpress-forums #bbp-your-profile fieldset textarea
	    {border-color: <?php echo $maha_options['coe_input_border_color'];?>}

	    .woo-maha .quantity .minus, .woo-maha .quantity .plus, .woo-maha .quantity input.qty, .woo-maha p.stars span > a, .woo-maha .form-row .chosen-container-single .chosen-single, .widget_product_search form div
	    {border-color: <?php echo $maha_options['coe_input_border_color'];?>}
    <?php }?>
    <?php
        // -- A Hover
    if ( $maha_options['coe_link_color'] != 'default' ) {
        echo '.sidebar .widget li a:hover, .tagcloud a:hover';
        if ( $maha_options['coe_link_color'] == 'accent-1' ) {
            echo '{color: '.$maha_options['accent_1'].'}';
        } else if ( $maha_options['coe_link_color'] == 'accent-2' ) {
            echo '{color: '.$maha_options['accent_2'].'}';
        }
    }?>
    <?php if($maha_options['coe_bg_color_vague'] != '#F5F5F5') {?>
	    /*Vague Background*/
	    .widget_calendar tbody td, .woo-maha .shop_table thead tr, .woo-maha tr:nth-child(2n), .woo-maha #woo-my-address .addresses.row address, .woo-maha .woo-customer-detail .customer_details, .woo-maha .woo-customer-detail address, .woo-maha ul.order_details,
	    #bbpress-forums li.bbp-header
	    {background-color: <?php echo $maha_options['coe_bg_color_vague'];?>}
    <?php }?>
    <?php if($maha_options['fwa_bg_color'] != '#151515') {?>
	    /*Footer*/        
	    /*Widget Background*/
	    #footer-sidebar{background-color: <?php echo $maha_options['fwa_bg_color'];?>;}
	    /*Widget border shameless*/
	    #footer-sidebar .widget_calendar tbody td{border-color: <?php echo $maha_options['fwa_bg_color'];?>;}
    <?php }?>
    <?php if($maha_options['fwa_bg_color_vague'] != '#272727') {?>
	    /*Widget Background Vague*/
	    #footer-sidebar .widget_calendar tbody td{background-color: <?php echo $maha_options['fwa_bg_color_vague'];?>;}
    <?php }?>
    <?php if($maha_options['fwa_txt_color_1'] != '#dcdcdc') {?>
	    /*Widget bordert color*/
	    #footer-sidebar .block-cap h3{border-color: <?php echo $maha_options['fwa_txt_color_1'];?>;}    
	    /*Widget 1st text color*/
	    #footer .block-cap h3, #footer h2, #footer h2 a, #footer h3, #footer h3 a, #footer h4, #footer h4 a, #footer h5, #footer h5 a, #footer h6,
	    #footer h6 a, #footer strong, #footer-sidebar .social_subscribe .social-network .social-network-count{color: <?php echo $maha_options['fwa_txt_color_1'];?>;}
    <?php }?>
    <?php if($maha_options['fwa_txt_color_2'] != '#7d7d7d') {?>
	    /*Widget 2nd text color*/
	    #footer-sidebar, #footer-sidebar ul li a, #footer .meta-info .entry-author, #footer .widget_calendar tbody td, #footer .wp-calendar a,
	    input[type="text"], input[type="password"], input[type="email"], textarea, select{color: <?php echo $maha_options['fwa_txt_color_2'];?>;}
    <?php }?>
    <?php if($maha_options['fwa_txt_color_vague'] != '#4f4f4f') {?>
	    /*Widget 3nd text color Vague*/
	    #footer .meta-info .entry-date{color: <?php echo $maha_options['fwa_txt_color_vague'];?>;}
    <?php }?>
    <?php if($maha_options['fwa_divider_color'] != '#2c2c2c') {?>
	    /*Widget border color*/
	    #footer .widget{border-color: <?php echo $maha_options['fwa_divider_color'];?>;}
    <?php }?>
    <?php 
        // -- A Hover
    if ( $maha_options['fwa_link_color'] != 'default' ) {
        echo '#footer-sidebar .widget li a:hover, #footer .tagcloud a:hover';
        if ( $maha_options['fwa_link_color'] == 'accent-1' ) {
            echo '{color: '.$maha_options['accent_1'].'}';
        } else if ( $maha_options['fwa_link_color'] == 'accent-2' ) {
            echo '{color: '.$maha_options['accent_2'].'}';
        }
    }
    ?>
    <?php if(($maha_options['fc_divider_color'] != '#2c2c2c') || ($maha_options['fc_bg_color'] != '#000000') || ($maha_options['fc_txt_color_1'] != '#595858')) {?>
    	/*Footer Copyright Divider*/
    	.f-copyright{border-color: <?php echo $maha_options['fc_divider_color'];?>; background: <?php echo $maha_options['fc_bg_color'];?>; color: <?php echo $maha_options['fc_txt_color_1'];?>;}
    <?php }?>
    <?php if($maha_options['fc_txt_color_1'] != '#595858') {?>
    	/*Color*/
    	.f-copyright, .f-copyright a{color: <?php echo $maha_options['fc_txt_color_1'];?>;}
    <?php }?>
    <?php
        // -- A Hover
    if ( $maha_options['fc_link_color'] != 'default' ) {
        echo '.f-copyright a:hover';
        if ( $maha_options['fc_link_color'] == 'accent-1' ) {
            echo '{color: '.$maha_options['accent_1'].'}';
        } else if ( $maha_options['fc_link_color'] == 'accent-2' ) {
            echo '{color: '.$maha_options['accent_2'].'}';
        }
    }

        // -- User Photo
    if ( $maha_options['photo_style'] == 'circle' ) {
        echo '.meta-author .author-thumb img, .meta-info .ava-auth img, .comment-list li.comment > div img.avatar{';
        echo '-webkit-border-radius: 80px; -moz-border-radius: 80px; -ms-border-radius: 80px; -o-border-radius: 80px; border-radius: 80px; }';
    }

        // -- User Profile
    if ( $maha_options['profile_style'] == 'center' ) {
        echo '.meta-author{text-align: center;}.meta-author .author-info{margin-left:0px;}.meta-author .author-thumb{margin: 0 auto;}.meta-author .author-thumb img{float:none;margin-bottom: 15px;}';
    }

    echo "</style>";
}

add_action( 'after_setup_theme', 'maha_custom_css' );
function maha_custom_css() {
    add_action( 'wp_head', 'maha_render_custom_css', 99 );
    add_action( 'wp_enqueue_scripts', 'maha_external_css' );
    add_action( 'wp_footer', 'maha_dynamic_style', 99 );
    // wp_enqueue_style('maha-dynamic', get_template_directory_uri() . '/includes/functions/dynamic-style.php', 'style', '1.0');  
    
}


/* -------------------------------------------------------------------------- 
 * [maha_opt_social_network - Social Network Options ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_opt_social_network') ) {

	function maha_opt_social_network( $social_network_opt ) {

		$maha_options = get_option('curated');
		$social_network = $maha_options[$social_network_opt];
		if ( $social_network['facebook_f'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['facebook_f'].'"><i class="icon-facebook"></i></a></li>'; }
		if ( $social_network['facebook_sign'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['facebook_sign'].'"><i class="icon-facebook-squared"></i></a></li>'; }
		if ( $social_network['twitter'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['twitter'].'"><i class="icon-twitter"></i></a></li>'; }
		if ( $social_network['instagram'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['instagram'].'"><i class="icon-instagrem"></i></a></li>'; }
		if ( $social_network['pinterest'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['pinterest'].'"><i class="icon-pinterest"></i></a></li>'; }
		if ( $social_network['youtube'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['youtube'].'"><i class="icon-play"></i></a></li>'; }
		if ( $social_network['gplus'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['gplus'].'"><i class="icon-gplus"></i></a></li>'; }
		if ( $social_network['linkedin'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['linkedin'].'"><i class="icon-linkedin"></i></a></li>'; }
		if ( $social_network['flickr'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['flickr'].'"><i class="icon-flickr"></i></a></li>'; }
		if ( $social_network['tumblr'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['tumblr'].'"><i class="icon-tumblr"></i></a></li>'; }
		if ( $social_network['vimeo'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['vimeo'].'"><i class="icon-vimeo"></i></a></li>'; }
		if ( $social_network['behance'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['behance'].'"><i class="icon-behance"></i></a></li>'; }
		if ( $social_network['dribbble'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['dribbble'].'"><i class="icon-dribbble"></i></a></li>'; }
		if ( $social_network['github'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['github'].'"><i class="icon-github"></i></a></li>'; }
		if ( $social_network['stumble'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['stumble'].'"><i class="icon-stumbleupon"></i></a></li>'; }
		if ( $social_network['vkontakte'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['vkontakte'].'"><i class="icon-vkontakte"></i></a></li>'; }
		if ( $social_network['scloud'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['scloud'].'"><i class="icon-soundcloud"></i></a></li>'; }
		if ( $social_network['skype'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['skype'].'"><i class="icon-skype"></i></a></li>'; }
		if ( $social_network['spotify'] != '' ) { echo '<li><a href="'.$social_network['spotify'].'"><i class="icon-spotify"></i></a></li>'; }
		if ( $social_network['lastfm'] != '' ) { echo '<li><a target="_blank" href="'.$social_network['lastfm'].'"><i class="icon-lastfm"></i></a></li>'; }
	}
}


/* -------------------------------------------------------------------------- 
 * [maha_user_social_network - User Social Network Link ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_user_social_network') ) {

	function maha_user_social_network( $user ) {

		if ( $user->u_email != '' ) { echo '<li><a target="_blank" href="mailto:'.$user->u_email.'"><i class="icon-mail"></i></a></li>'; }
		if ( $user->u_website != '' ) { echo '<li><a target="_blank" href="'.$user->u_website.'"><i class="icon-globe"></i></a></li>'; }
		if ( $user->u_facebook != '' ) { echo '<li><a target="_blank" href="'.$user->u_facebook.'"><i class="icon-facebook"></i></a></li>'; }
		if ( $user->u_twitter != '' ) { echo '<li><a target="_blank" href="'.$user->u_twitter.'"><i class="icon-twitter"></i></a></li>'; }
		if ( $user->u_instagram != '' ) { echo '<li><a target="_blank" href="'.$user->u_instagram.'"><i class="icon-instagrem"></i></a></li>'; }
		if ( $user->u_pinterest != '' ) { echo '<li><a target="_blank" href="'.$user->u_pinterest.'"><i class="icon-pinterest"></i></a></li>'; }
		if ( $user->u_youtube != '' ) { echo '<li><a target="_blank" href="'.$user->u_youtube.'"><i class="icon-play"></i></a></li>'; }
		if ( $user->u_google_plus != '' ) { echo '<li><a target="_blank" href="'.$user->u_google_plus.'"><i class="icon-gplus"></i></a></li>'; }
		if ( $user->u_linkedin != '' ) { echo '<li><a target="_blank" href="'.$user->u_linkedin.'"><i class="icon-linkedin"></i></a></li>'; }
		if ( $user->u_flickr != '' ) { echo '<li><a target="_blank" href="'.$user->u_flickr.'"><i class="icon-flickr"></i></a></li>'; }
		if ( $user->u_tumblr != '' ) { echo '<li><a target="_blank" href="'.$user->u_tumblr.'"><i class="icon-tumblr"></i></a></li>'; }
		if ( $user->u_vimeo != '' ) { echo '<li><a target="_blank" href="'.$user->u_vimeo.'"><i class="icon-vimeo"></i></a></li>'; }
		if ( $user->u_behance != '' ) { echo '<li><a target="_blank" href="'.$user->u_behance.'"><i class="icon-behance"></i></a></li>'; }
		if ( $user->u_dribbble != '' ) { echo '<li><a target="_blank" href="'.$user->u_dribbble.'"><i class="icon-dribbble"></i></a></li>'; }
		if ( $user->u_github != '' ) { echo '<li><a target="_blank" href="'.$user->u_github.'"><i class="icon-github"></i></a></li>'; }
		if ( $user->u_stumble_upon != '' ) { echo '<li><a target="_blank" href="'.$user->u_stumble_upon.'"><i class="icon-stumbleupon"></i></a></li>'; }
		if ( $user->u_vkontakte != '' ) { echo '<li><a target="_blank" href="'.$user->u_vkontakte.'"><i class="icon-vkontakte"></i></a></li>'; }
		if ( $user->u_soundcloud != '' ) { echo '<li><a target="_blank" href="'.$user->u_soundcloud.'"><i class="icon-soundcloud"></i></a></li>'; }
		if ( $user->u_skype != '' ) { echo '<li><a target="_blank" href="'.$user->u_skype.'"><i class="icon-skype"></i></a></li>'; }
		if ( $user->u_spotify != '' ) { echo '<li><a href="'.$user->u_spotify.'"><i class="icon-spotify"></i></a></li>'; }
		if ( $user->u_lastfm != '' ) { echo '<li><a target="_blank" href="'.$user->u_lastfm.'"><i class="icon-lastfm"></i></a></li>'; }
	}
}

/* -------------------------------------------------------------------------- 
 * [maha_wpcaption_width - Remove 10px on WP-Caption shortcodes ]
 ---------------------------------------------------------------------------*/
add_filter( 'img_caption_shortcode_width', 'maha_wpcaption_width');

if ( !function_exists('maha_wpcaption_width') ) {

	function maha_wpcaption_width( $html ) {
	   return $html - 10;
	}
}


/* --------------------------------------------------------------------------
 * [maha_category_class - Init Category Colorized ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_category_class') ) {

	add_filter('nav_menu_css_class' , 'maha_category_class' , 10 , 2);
	function maha_category_class($classes, $item){

		$classes[] = 'mh-navcat-'.get_cat_ID( $item->title );

		return $classes;
	}
}


/* --------------------------------------------------------------------------
 * [maha_navigation - Init Theme Navigation]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_navigation') ) {

	function maha_navigation($nav_position, $opt = '') {

		if(has_nav_menu($nav_position)) {
			// Only Header Nav / Main Navigation
			if ($nav_position == 'header-nav' && $opt == 'mega-menu') {
				wp_nav_menu(array(
					'theme_location' => $nav_position,
					'container' => '',
					'before' => '',
					'fallback_cb' => '',
					'walker' => new Maha_Mega_Menu()
				));
			}else if($nav_position == 'header-nav' && $opt == 'mobile-menu') {
				// Mobile Navigation
				wp_nav_menu(array(
					'theme_location' => $nav_position,
					'container' => '',
					'before' => '<span></span>',
					'fallback_cb' => '',
					'walker' => new maha_navmobile_walker
				));				
			}else {
				// Others Navigation
				wp_nav_menu(array(
					'theme_location' => $nav_position,
					'container' => '',
					'before' => '<span></span>',
					'fallback_cb' => ''
				));
			}
		} else {
			echo "<ul class='no-menu'><li>". __('No menu assigned!', MAHA_TEXT_DOMAIN) ."</li></ul>";
		}
	}
}


/* --------------------------------------------------------------------------
 * [maha_post_category - Init Custom Category ]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_post_category') ) {

	function maha_post_category( $post_id, $model = "" ) {

		$post_categories = wp_get_post_categories( $post_id );

		foreach($post_categories as $c){
			$cat = get_category( $c );

			if ( $model != "" ) {
				echo '<span class="mh-elcat-'.$cat->cat_ID.'" href="'.get_category_link( $cat->cat_ID ).'" title="'.$cat->name.'" rel="category">'.$cat->name.'</span> ';
			} else {
				echo '<a class="mh-elcat-'.$cat->cat_ID.'" href="'.get_category_link( $cat->cat_ID ).'" title="'.$cat->name.'" rel="category">'.$cat->name.'</a> ';
			}
		}
	}
}


/* --------------------------------------------------------------------------
 * [maha_logo - Init Theme Logo]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_logo') ) {

	function maha_logo() {

		$maha_options = get_option('curated');

		if ( $maha_options['thelogo']['url'] != "" and is_array($maha_options['thelogo']) ) {
			$logo_url = $maha_options['thelogo']['url'];
		} else {
			$logo_url = get_template_directory_uri().'/images/logo.png';
		}		
		if ( $maha_options['thelogoretina']['url'] != "" and is_array($maha_options['thelogoretina']) ) {
			$logo_retina_url = $maha_options['thelogoretina']['url'];
		} else {
			$logo_retina_url = $logo_url;
		}	
		?>
		<div id="thelogo" class="logo <?php if ($maha_options['header_alignment'] == 'center') echo 'the-logo-center';?>">
			<a href="<?php echo home_url(); ?>">
				<img alt="<?php bloginfo('name'); echo ' - '; bloginfo('description'); ?>" src="<?php echo $logo_url; ?>" data-retina="<?php echo $logo_retina_url; ?>" data-first="<?php echo $logo_url; ?>"/>
			</a>
		</div>
		<?php
		if ( is_home() ) {
			echo "<h1 class='site-outline'>".get_bloginfo ( 'description' )."</h1>";
		} else if ( is_front_page() ) {
			echo "<h1 class='site-outline'>".get_bloginfo ( 'description' )."</h1>";
		} else {
			echo "<h2 class='site-outline'>".get_bloginfo ( 'description' )."</h2>";
		}
	}
}
if ( !function_exists('maha_logo_small') ) {
	function maha_logo_small() {

		$maha_options = get_option('curated');

		if ( $maha_options['logomainnav']['url'] != "" and is_array($maha_options['logomainnav']) ) {
			$logo_url_small = $maha_options['logomainnav']['url'];
		} else {
			$logo_url_small =  get_template_directory_uri().'/images/small-logo.png';
		}
		if ( $maha_options['logomainnavretina']['url'] != "" and is_array($maha_options['logomainnavretina']) ) {
			$logo_retina_url_small = $maha_options['logomainnavretina']['url'];
		} else {
			$logo_retina_url_small =  $logo_url_small;
		}
		?>
		<div id="thelogosmall" class="logo">
			<a href="<?php echo home_url(); ?>">
				<img alt="<?php bloginfo('name'); echo ' - '; bloginfo('description'); ?>" src="<?php echo $logo_url_small; ?>" data-retina="<?php echo $logo_retina_url_small; ?>" data-first="<?php echo $logo_url_small; ?>"/>
			</a>
		</div>
		<?php
	}
}
	

/* --------------------------------------------------------------------------
 * [maha_featured_url - Featured Image URL]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_featured_url') ) {

	function maha_featured_url( $post_id, $size ) {
		
		if (has_post_thumbnail( $post_id ) ):
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
			return $image[0];
		endif;
	}
}


/* --------------------------------------------------------------------------
 * [maha_attachment_url - Attachment URL]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_attachment_url') ) {

	function maha_attachment_url( $attc_id, $size ) {
		
		$image = wp_get_attachment_image_src( $attc_id, $size );
		return $image[0];
	}
}


/* --------------------------------------------------------------------------
 * [maha_first_post_image - First Post Image]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_first_post_image') ) {

	function maha_first_post_image() {
		
		global $post, $posts;
		
		$first_img = '';
		ob_start();
		ob_end_clean();

		if( preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches ) ){

			// print_r($matches);
			$first_img = $matches[1][0];
			return $first_img;
		} else {
			return false;
		}
	}
}


/* --------------------------------------------------------------------------
 * [maha_el_key - Generate Unique ID each elemement]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_el_key') ) {

	function maha_el_key(){

	    $key = 'mh_el' . uniqid();
	    return $key;
	}
}


/* --------------------------------------------------------------------------
 * [maha_avatar_url - Avatar]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_avatar_url') ) {

	function maha_avatar_url($get_avatar){

	    preg_match('/src=[\'"]?([^\'" >]+)[\'" >]/', $get_avatar, $matches);
	    // print_r($matches);
	    return $matches[1];
	    // return $get_avatar;
	}
}


/* --------------------------------------------------------------------------
 * [maha_related_posts_place - Single posts - Related Posts position]
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_related_posts_place') ) {

	function maha_related_posts_place($post_id){

		$maha_options = get_option('curated');
		?>
		<div class="related-article">

			<!-- Block Cap -->
			<div class="row">
				<div class="col-sm-12">
					<div class="block-cap">
						<h3><?php echo $maha_options['s_related']; ?></h3>
					</div>
				</div>
			</div>

			<?php
			// Setup Query
			$related_query = new WP_Query(
				array(
					'post_type' => 'post',
					'posts_per_page' => 3,
					'category__in' => wp_get_post_categories($post_id),
					'post__not_in' => array($post_id),
					'orderby' => 'rand'
				)
			);
			?>

			<?php if ( $related_query->have_posts() ) : ?>

			<div class="row block-streams el-block-5">

				<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>

					<!-- Stream Item -->
					<div class="col-sm-4">
						<?php get_template_part ( 'includes/content/item', 'medium-simple' ); ?>
					</div>

				<?php endwhile; ?>

			</div>

			<?php endif; ?> 

			<?php wp_reset_query(); ?>

		</div>
		<?php
	}
}

if ( !function_exists('maha_related_running_text') ) {

	function maha_related_running_text($post_id){

		?>
		<div class="cur-runtext">

			<?php
			// Setup Query
			$related_query = new WP_Query(
				array(
					'post_type' => 'post',
					'posts_per_page' => 3,
					'category__in' => wp_get_post_categories($post_id),
					'post__not_in' => array($post_id),
					'orderby' => 'rand'
				)
			);
			?>

			<?php if ( $related_query->have_posts() ) : ?>

			<div class="row block-streams el-block-5">

				<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>

					<!-- Stream Item -->
					<div class="col-sm-4">
						<?php get_template_part ( 'includes/content/item', 'medium-simple' ); ?>
					</div>

				<?php endwhile; ?>

			</div>

			<?php endif; ?> 

			<?php wp_reset_query(); ?>

		</div>
		<?php
	}
}



/* --------------------------------------------------------------------------
 * [maha_required_plugins - Init Theme Required Plugins] by Thomas Griffin - https://github.com/thomasgriffin/TGM-Plugin-Activation
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_required_plugins') ) {

	add_action( 'tgmpa_register', 'maha_required_plugins' );
	function maha_required_plugins() {

		$plugins = array(

			array(
				'name' 		=> 'MahaCodes',
				'slug' 		=> 'mahacodes',
				'source'   				=> get_stylesheet_directory() . '/includes/plugins/mahacodes.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> true,
				'external_url' 			=> '',
			),
			array(
				'name' 		=> 'Envato Wordpress Toolkit',
				'slug' 		=> 'envato-wordpress-toolkit',
				'source'   				=> get_stylesheet_directory() . '/includes/plugins/envato-wordpress-toolkit.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> true,
				'external_url' 			=> '',
			),
			// disable Boost Maha
			// array(
			// 	'name' 		=> 'Boost Maha',
			// 	'slug' 		=> 'boost-maha',
			// 	'source'   				=> get_stylesheet_directory() . '/includes/plugins/boost-maha.zip',
			// 	'required' 				=> false,
			// 	'version' 				=> '',
			// 	'force_activation' 		=> false,
			// 	'force_deactivation' 	=> true,
			// 	'external_url' 			=> '',
			// ),

			array(
				'name' 		=> 'Regenerate Thumbnail',
				'slug' 		=> 'force-regenerate-thumbnails',
				'required' 	=> false,
			),

			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'required' 	=> false,
			),

			array(
				'name' 		=> 'WP Retina 2x',
				'slug' 		=> 'wp-retina-2x',
				'required' 	=> false,
			),

			array(
				'name' 		=> 'Login LightBox',
				'slug' 		=> 'login-with-ajax',
				'required' 	=> false,
			),

			array(
				'name' 		=> 'Woocommerce',
				'slug' 		=> 'woocommerce',
				'required' 	=> false,
			)
		);

		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = MAHA_TEXT_DOMAIN;

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                       			=> __( 'Required Plugins', $theme_text_domain ),
				'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa( $plugins, $config );

	}
}


/* --------------------------------------------------------------------------
 * [maha_crumbs - Init Theme Breadcrumb] by Dimox - http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 ---------------------------------------------------------------------------*/
if ( !function_exists('maha_crumbs') ) {

	function maha_crumbs() {

		/* === OPTIONS === */
		$text['home']     = __('Home',MAHA_TEXT_DOMAIN); // text for the 'Home' link
		$text['category'] = __('Archive by Category "%s"',MAHA_TEXT_DOMAIN); // text for a category page
		$text['search']   = __('Search Results for "%s" Query',MAHA_TEXT_DOMAIN); // text for a search results page
		$text['tag']      = __('Posts Tagged "%s"',MAHA_TEXT_DOMAIN); // text for a tag page
		$text['author']   = __('Articles Posted by %s',MAHA_TEXT_DOMAIN); // text for an author page
		$text['404']      = __('Error 404',MAHA_TEXT_DOMAIN); // text for the 404 page

		$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
		$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
		$show_title     = 1; // 1 - show the title for the links, 0 - don't show
		$delimiter      = ' <i class="icon-right-open-mini"></i> '; // delimiter between crumbs
		$before         = '<span typeof="v:Breadcrumb" ><span class="breadcrumb_last" property="v:title">'; // tag before the current crumb
		$after          = '</span></span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;
		$home_link    = home_url('/');
		$link_before  = '<span typeof="v:Breadcrumb">';
		$link_after   = '</span>';
		$link_attr    = ' rel="v:url" property="v:title"';
		$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
		$parent_id    = '';
		if ( $post->post_parent ) { $parent_id = $parent_id_2 = $post->post_parent; }
		$frontpage_id = get_option('page_on_front');

		if (is_home() || is_front_page()) {

			if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

		} else {

			$maha_options = get_option('curated');
			$use_breadcrumb = '';
			if ($maha_options['breadcrumb'] != true) {
				$use_breadcrumb = 'hidden';
			}

			echo '<div class="maha-crumbs" '.$use_breadcrumb.' prefix="v: http://rdf.data-vocabulary.org/#">';
			if ($show_home_link == 1) {
				echo $link_before.'<a href="' . $home_link . '" '.$link_attr.'>' . $text['home'] . '</a>'.$link_after;
				if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
			}

			if ( is_category() ) {
				$this_cat = get_category(get_query_var('cat'), false);
				if ($this_cat->parent != 0) {
					$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
					if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
				}
				if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {
				echo $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
					if ($show_current == 1) echo $link_before .'<a '.$link_attr.' href="'.get_permalink().'">'. get_the_title().'</a>' . $link_after;
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_title = $post->post_title;
				echo $before . $post_title . $after;

			} elseif ( is_attachment() ) {
				$parent = get_post($parent_id);
				$cat = get_the_category($parent->post_parent); $cat = $cat[0];
				if ($cat) {
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
					$cats = str_replace('</a>', '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
				}
				printf($link, get_permalink($parent), $parent->post_title);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && !$parent_id ) {
				if ($show_current == 1) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $parent_id ) {
				if ($parent_id != $frontpage_id) {
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != $frontpage_id) {
							$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo $breadcrumbs[$i];
						if ($i != count($breadcrumbs)-1) echo $delimiter;
					}
				}
				if ($show_current == 1) {
					if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
					echo $before . get_the_title() . $after;
				}

			} elseif ( is_tag() ) {
				echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {
		 		global $author;
				$userdata = get_userdata($author);
				echo $before . sprintf($text['author'], $userdata->display_name) . $after;

			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;

			} elseif ( has_post_format() && !is_singular() ) {
				echo get_post_format_string( get_post_format() );
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page', MAHA_TEXT_DOMAIN) . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}

			echo '</div><!-- .breadcrumbs -->';

		}
	}
}


/* --------------------------------------------------------------------------
 * [maha_mask_paginate - Init Wordpress Pagination]
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'maha_mask_paginate' ) ) {
	
	function maha_mask_paginate() {
		paginate_links();
	}
}

/* --------------------------------------------------------------------------
 * [another plugin - Plugin Clash]
 ---------------------------------------------------------------------------*/
if ( function_exists('dsq_output_loop_comment_js') ) {
	add_action('wp_head', 'dsq_output_loop_comment_js');
}

/* --------------------------------------------------------------------------
 * [maha_pagination - Init Blog Post Pagination]
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'maha_pagination' ) ) {
	
	function maha_pagination( $pages = '', $range = 2 ) {

		$pagination = array(
			"prev_text" => "<i class='icon-left-open'></i>".__('Prev', MAHA_TEXT_DOMAIN),
			"next_text" => __('Next',MAHA_TEXT_DOMAIN)."<i class='icon-right-open'></i>",
			"dot_text" => "..."
			);

		$showitems = ($range * 2)+1;

		global $paged, $wp_query;
		//extra pagination
		if ($paged == 0 && $wp_query->query_vars['paged'] == 0) { $paged = 1; }
		if ($paged == 0 && $wp_query->query_vars['paged'] == 1) { $paged = 1; }
		if( empty($paged) ) { $paged = $wp_query->query_vars['paged']; }

		if($pages == ''){
			
			$pages = $wp_query->max_num_pages;
			
			if(!$pages){
				$pages = 1;
			}
		}

		if(1 != $pages){			
			// echo "paged-".$paged.", range-".($range).", items-".$showitems.", pages-".$pages." --- ";
			echo "<div class='pagination'>";
			echo "<span class='page-indicator'>"; _e(' Page',MAHA_TEXT_DOMAIN); echo " ". $paged ." "; _e(' of',MAHA_TEXT_DOMAIN); echo " ".$pages; echo "</span>";

			// Previous
			// if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
			if($paged > 1 && $showitems < $pages) echo "<a class='prev' href='".get_pagenum_link($paged - 1)."'>".$pagination['prev_text']."</a>";

			// First
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) { echo "<a class='boundary' href='".get_pagenum_link(1)."'>1</a>"; echo "<a class='dot'>".$pagination['dot_text']."</a>"; };

			// Page's
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? "<a class='current'>".$i."</a>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				}
			}

			// Last
			// if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
			if ($paged < $pages-1 &&  $pages-$paged-$range > 0 && $showitems < $pages) {  echo "<a class='dot'>".$pagination['dot_text']."</a>"; echo "<a class='boundary' href='".get_pagenum_link($pages)."'>".$pages."</a>"; };
			
			// Next
			if ($paged < $pages && $showitems < $pages) echo "<a class='next' href='".get_pagenum_link($paged + 1)."'>".$pagination['next_text']."</a>";

			echo "</div>\n";
		}
	
	}
}



/* --------------------------------------------------------------------------
 * [maha_crtd_share - Share Button]
 ---------------------------------------------------------------------------*/
 if ( !function_exists( 'maha_crtd_share' ) ) {
 	function maha_crtd_share( $id, $position = false ) { ?>
 		<div class="meta-share <?php echo $position; ?>">
			<?php if ( $position != 'bottom' ) : ?><span class="header-font"><?php _e('SHARE', MAHA_TEXT_DOMAIN); ?> </span><?php endif; ?>
			<a class="social-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink($id); ?>&amp;t=<?php echo str_replace(' ','%20',get_the_title($id)); ?>" title="<?php _e('Share on Facebook',MAHA_TEXT_DOMAIN); ?>" target="_blank"><i class="icon-facebook"></i></a>
			<a class="social-twitter" href="https://twitter.com/home?status=<?php echo str_replace(' ','%20',get_the_title($id)); ?>+<?php echo get_permalink($id); ?>" title="<?php _e('Share on Twitter',MAHA_TEXT_DOMAIN); ?>" target="_blank"><i class="icon-twitter"></i></a>
			<a class="social-googleplus" href="https://plus.google.com/share?url=<?php echo get_permalink($id); ?>" title="<?php _e('Share on Google+',MAHA_TEXT_DOMAIN); ?>" target="_blank"><i class="icon-gplus"></i></a>
			<a class="social-pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($id); ?>&amp;media=<?php echo maha_featured_url( $id, ''); ?>&amp;description=<?php echo str_replace(' ','%20',get_the_title($id)); ?>" title="<?php _e('Share on Pinterest',MAHA_TEXT_DOMAIN); ?>" target="_blank"><i class="icon-pinterest"></i></a>
			<a class="social-tumblr" href="https://www.tumblr.com/widgets/share/tool?shareSource=legacy&canonicalUrl=&url=<?php echo urlencode(get_permalink($id)); ?>&posttype=link&title=<?php echo urlencode(get_the_title($id)); ?>&content=<?php urlencode(get_permalink($id)); ?>" title="<?php _e('Share on Tumblr',MAHA_TEXT_DOMAIN); ?>" target="_blank"><i class="icon-tumblr"></i></a>
		</div>
 	<?php }
 }
?>