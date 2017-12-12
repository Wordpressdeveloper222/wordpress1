jQuery(document).ready(function($){	

	if($('#toplevel_page_maha_options').length > 0) {
	     	var preloadSrc = $('#toplevel_page_maha_options > a .wp-menu-image img').attr('src');
     	preloadSrc = preloadSrc.replace('.svg','-hover.svg');
     	var preloadHoverImage = new Image()
		preloadHoverImage.src = preloadSrc;
	}
	
	$('#toplevel_page_maha_options:not(.wp-has-current-submenu)').hover(function(){
 		$hoverSrc = $(this).find('> a .wp-menu-image img').attr('src');
 		$hoverSrc = $hoverSrc.replace('.svg','-hover.svg');
 		$(this).find('>a .wp-menu-image img').attr('src',$hoverSrc);
 	},function(){
 		$hoverSrc = $(this).find('>a .wp-menu-image img').attr('src');
 		$hoverSrc = $hoverSrc.replace('-hover.svg','.svg');
 		$(this).find('> a .wp-menu-image img').attr('src',$hoverSrc);
 	});

 	if($('.updatesneed')[0]){
 		$(window).load(function () {
 			var root=$('.updatesneed').data('root');
 			$(".theme[aria-describedby='"+root+"-action "+root+"-name']").append('<div class="theme-update">Update Available</div>');
 		});
	}

});