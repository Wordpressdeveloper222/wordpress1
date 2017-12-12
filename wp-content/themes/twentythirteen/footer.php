
		<script>
    jQuery(document).ready(function($){
        $('.quantity').on('click', '.plus', function(e) {
            $input = $(this).prev('input.qty');
            var val = parseInt($input.val());
            $input.val( val+1 ).change();
        });
 
        $('.quantity').on('click', '.minus', 
            function(e) {
            $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            if (val > 0) {
                $input.val( val-1 ).change();
            } 
        });
    });
	
	
    </script>



<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


?>
		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>
<?php// if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
        <?php //endif; ?>	
		<div class="site-info">
				<?php do_action( 'twentythirteen_credits' ); ?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentythirteen' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentythirteen' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentythirteen' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
			
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
	
<script>

function faqs(id,name){

	//window.stop();
	var title =jQuery('#title').val();
	jQuery.post( "../title.php", {id : id, title : title, name : name }      
	)
//	obj = {name : name};

		.done(function( data ) { 
		history.pushState({}, null, name);
			jQuery("#content").html(data);  
		//	var hashLink = $(this).attr("name") + "=" + $(this).val();
}); 
 //window.location.href = "https://wordpress.org/"; 
//alert(url); return false;

}

function cptaajaxPagination1(pnumber,plimit){  
	var nth  = pnumber;
	var lmt  = plimit;
	var ajax_url = ajax_params.ajax_url;
	var cpta = jQuery("#post").attr('data-posttype');
	jQuery.ajax({
		url		:ajax_url,
		type	:'post',
		data	:{ 'action':'sidebar','number':nth,'limit':lmt,'cptapost':cpta },
		beforeSend	: function(){
			jQuery("#cptapagination-content").html("<p style='text-align:center;'>Loading please wait...!</p>");
		},
		success :function(pvalue){alert(pvalue);
			jQuery("#cptapagination-content").html(pvalue);
		}
	});
}

</script>

</body>
</html>