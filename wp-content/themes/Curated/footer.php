		</div>
		<!-- END PAGE WRAPPER -->

		<?php $maha_options = get_option('curated'); ?>		
		<!-- START FOOTER -->
		<footer id="footer">

			<!-- start footer sidebar -->
			<div id="footer-sidebar">
				<div class="container">
					<div class="row">

						<div class="col-sm-4">
							<?php dynamic_sidebar( 'Footer 1' ); ?>
						</div>

						<div class="col-sm-4">
							<?php dynamic_sidebar( 'Footer 2' ); ?>
						</div>

						<div class="col-sm-4">
							<?php dynamic_sidebar( 'Footer 3' ); ?>
						</div>
						
					</div>
				</div>
			</div>
			<!-- end footer sidebar -->

			<!-- start f-copyright -->
			<div class="f-copyright">
				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<?php echo $maha_options['fc_copyright']; ?>
						</div>
						<div class="col-sm-4">
							<nav>
								<?php
								if ( isset($maha_options['fc_menu'])) {
									$fc_menus_items = wp_get_nav_menu_items($maha_options['fc_menu']);
						            if ( count($fc_menus_items) > 0 && $maha_options['fc_menu'] != '' ) {
						                echo '<ul>';
						                foreach ($fc_menus_items as $key => $v_nav) {
						                    echo '<li><a href="'.$v_nav->url.'">'.$v_nav->title.'</a></li>';
						                }
						                echo '</ul>';
						            }
								}
								?>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- end f-copyright -->

		</footer>
		<!-- END FOOTER -->

	</div>
	<!-- END OFF CANVAS BODY -->

	</div>
	<!-- END BODY BACKGROUND -->

	<div id="scrolltop">
		<a><i class="icon-up-open-big"></i></a>
	</div>
	
	</div>

<?php wp_footer(); ?>

<?php if (class_exists('LoginWithAjax')) { login_with_ajax(); } // Login With Ajax ?>
        
</body>
</html>