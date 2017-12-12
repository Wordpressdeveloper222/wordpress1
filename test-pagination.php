	<?php
	global $wpdb;
	echo $wpdb;
						$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
						$limit = 1;
						$offset = ( $pagenum - 1 ) * $limit;
						 $total = $wpdb->get_var( "SELECT COUNT(`ID`) FROM ".$wpdb->prefix."posts WHERE post_type = 'faqs' AND post_status = 'publish' ORDER BY menu_order ASC" );
						$num_of_pages = ceil( $total / $limit );
						 // "SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'faqs' AND post_status = 'publish' ORDER BY menu_order ASC LIMIT $offset, $limit";
						$entries = $wpdb->get_results(  "SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'faqs' AND post_status = 'publish' ORDER BY menu_order ASC LIMIT $offset, $limit");
						$page_links = paginate_links( array(
						'base' => add_query_arg( 'pagenum', '%#%' ),
						'format' => '',
						'prev_text' => __( '&laquo;', 'text-domain' ),
						'next_text' => __( '&raquo;', 'text-domain' ),
						'total' => $num_of_pages,
						'current' => $pagenum
					) );

							if ( $page_links ) {
								//echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
							echo '<a href="#"  id="pagination_test">'.$page_links.'</a>';
							} 
								$i = 2;
						foreach ($entries as $event) 
						{
							echo $title=$event->post_title;echo '</br>';
							echo  $content=$event->post_content;  
							echo '</br>';
							$i++;
						}