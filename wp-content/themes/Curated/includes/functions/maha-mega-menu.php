<?php

/* --------------------------------------------------------------------------

	Maha Mega Menu Function

    - Mega Menu - Mark 1.0.0

 ---------------------------------------------------------------------------*/

/* --------------------------------------------------------------------------
 * [Maha_Mega_Menu ]
 ---------------------------------------------------------------------------*/
 class maha_navmobile_walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
		$output .= '<li class="' . $class_names . '">';	
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';		
		$item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class Maha_Mega_Menu extends Walker_Nav_Menu {
		
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"nav-sub-menus\"><ul>\n";
    }
	
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
	
    function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		
        global $wp_query;
		$cat = $item->object_id;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$children = get_posts(array(
			'post_type' => 'nav_menu_item',
			'nopaging' => true,
			'numberposts' => 1,
			'meta_key' => '_menu_item_menu_item_parent',
			'meta_value' => $item->ID
		));
		// echo $depth.' x ';
		if ( ! empty( $children ) || ! get_field( 'menu_latest_posts', 'category_' . $cat ) || get_field( 'menu_latest_posts', 'category_' . $cat ) == 'latest_posts_on' ) {
			// if ( $depth == 0 && $item->object == 'category' || $item->object == 'page' ) {
			if ( $depth == 0 && $item->object == 'category' || $item->object == 'page' || $item->object == 'custom' ) {
				$item_output  .= '<div class="nav-sub-wrap container"><div class="nsw row">';
			}
		}
        $item_output .= $args->after;
		
		
		/* --------------------------------------------------------------------------
		 * Only for category & category parrent
		 ---------------------------------------------------------------------------*/
		if ( $depth == 0 && $item->object == 'category' ) { 
			
			$cat = $item->object_id;
			
			if ( ! get_field( 'menu_latest_posts', 'category_' . $cat ) || get_field( 'menu_latest_posts', 'category_' . $cat ) == 'latest_posts_on' ){ // Add Posts to menu if 'latest_posts' field is set to 'Add'
				
				$item_output .= '<div class="nav-sub-posts"><div class="row">';
					
					//$item_output .= '<li class="first"><h3 class="entry-title">' . __( 'Latest Additions', MAHA_TEXT_DOMAIN ) . '</h3></li>';
				
					global $post;
					$post_args = array( 'numberposts' => 4, 'offset'=> 0, 'category' => $cat );
					$menuposts = get_posts( $post_args );
					
					foreach( $menuposts as $post ) : setup_postdata( $post );
					
						$post_title = get_the_title();
						$post_link = get_permalink();
						$post_image = maha_featured_url( $post->ID , 'mh_medium');
						
						if ( $post_image ){
							$menu_post_image = '<img class="zoom-it three" src="' . $post_image. '" alt="' . $post_title . '" />';
						} elseif( maha_first_post_image() ) {
							$menu_post_image = '<img class="zoom-it three" src="' . maha_first_post_image() . '" class="wp-post-image" alt="' . $post_title . '" />';
						} else {
							$menu_post_image = __( 'No image',MAHA_TEXT_DOMAIN);
						}
						
						$item_output .= '
							<div class="col-sm-3">
								<div class="meta-info">
									<span class="ava-auth">
										<img width="14" height="14" itemprop="image" class="entry-thumb" src="'.maha_avatar_url(get_avatar( get_the_author_meta('user_email', $post->post_author), 48 )).'" alt="" title="'.get_the_author_meta('display_name', $post->post_author).'"/>
									</span>
									<span itemprop="author" class="entry-author"><a href="'. get_author_posts_url( get_the_author_meta( 'ID',$post->post_author ) ).'">'.get_the_author_meta('display_name', $post->post_author).'</a></span>
									<span class="coma">,</span>
									<time itemprop="dateCreated" class="entry-date" datetime="'.get_the_time( 'c', $post->ID ).'" >
										'.get_the_time( get_option( 'date_format' ), $post->ID ).'
									</time>
								</div>';

						if ( $post_image ) {
							$item_output .= '<figure class="thumb-wrap zoom-zoom">
									<a itemprop="url" href="'  .$post_link . '" rel="bookmark" title="' . $post_title . '">' . $menu_post_image . '</a>
								</figure>';
						}
						
						$item_output .= '<a class="entry-title" href="' . $post_link . '">' . $post_title . '</a>
							</div>';
						
					endforeach;
					wp_reset_query();
					
				$item_output .= '</div></div>';
				
			}
			
		}
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
	
	
    function end_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$cat = $item->object_id;
		$children = get_posts(array(
			'post_type' => 'nav_menu_item',
			'nopaging' => true,
			'numberposts' => 1,
			'meta_key' => '_menu_item_menu_item_parent',
			'meta_value' => $item->ID
		));
		if ( ! empty( $children ) || ! get_field( 'menu_latest_posts', 'category_' . $cat ) || get_field( 'menu_latest_posts', 'category_' . $cat ) == 'latest_posts_on' ) {
			if ( $depth == 0 && $item->object == 'category' || $item->object == 'page' || $item->object == 'custom' ) {
				$output .= "</div></div>\n";
			}
		}
		$output .= "</li>\n";
    }
	
}