<?php
/* --------------------------------------------------------------------------

    A ThemeMaha Framework - Copyright (c) 2014

    - Post with filter

 ---------------------------------------------------------------------------*/

if ( ! class_exists( 'maha_posts' ) ) { 
    class maha_posts extends WP_Widget {
    
    	function __construct() {

            // Widget settings
    		$widget_ops = array('classname' => 'widget_review widget_post', 'description' =>  __("Show post with filters", MAHA_TEXT_DOMAIN) );
    		            
            // Widget control settings
            $this->alt_option_name = 'widget_post';
            
            // Create the widget
            parent::__construct('post', wp_get_theme()->get('Name').__(' - Posts', MAHA_TEXT_DOMAIN), $widget_ops);
    	}
    
    	function widget($args, $instance) {
    
    		extract($args);
    
    		$title = apply_filters('widget_title', empty($instance['title']) ? __('Post', MAHA_TEXT_DOMAIN) : $instance['title'], $instance, $this->id_base);
            $category = apply_filters('widget_category', empty($instance['category']) ? '' : $instance['category'], $instance, $this->id_base);
            $tag = apply_filters('widget_tag', empty($instance['tag']) ? '' : $instance['tag'], $instance, $this->id_base);
    		$layout = apply_filters('widget_layout', empty($instance['layout']) ? '' : $instance['layout'], $instance, $this->id_base);
            $filter = apply_filters('widget_filter', empty($instance['filter']) ? '' : $instance['filter'], $instance, $this->id_base);

    		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )  {$number = 5; }
            
            if ( $category != 'all' ) { 
                $cat_qry = $category; 
            } else {
                $cat_qry = NULL;
            }

            if ( $tag != 'all' ) { 
                $tag_qry = $tag;
            } else {
                $tag_qry = NULL;
            }

            $type_filter = 'enable_review';

    		if ( $filter == 'top_week' ) {

        		$week = date('W');
        		$year = date('Y');
        		$post_query = new WP_Query( 
                    apply_filters( 'widget_posts_args', 
                        array( 
                            'posts_per_page' => $number,
                            'category_name' => $cat_qry,
                            'tag' => $tag_qry,
                            'year' => $year,
                            'w' => $week ,
                            'no_found_rows' => true,
                            'post_status' => 'publish',
                            'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                    'key' => $type_filter,
                                    'value' => '1'
                                )
                            ),
                            'meta_key' => 'score_module',
                            'orderby' => 'meta_value_num', 
                            'order' => 'DESC',
                            'ignore_sticky_posts' => true ) 
                        ) 
                    );

        	} elseif ( $filter == 'top_alltime' ) {
    
    		  $post_query = new WP_Query( 
                apply_filters( 'widget_posts_args', 
                    array(
                        'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'tag' => $tag_qry,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => $type_filter,
                                'value' => '1'
                            )
                        ),
                        'meta_key' => 'score_module',
                        'orderby' => 'meta_value_num', 
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                        )
                    )
                );

    		} elseif ( $filter == 'top_month' ) {
    			
    		  $month = date('m');
    		  $year = date('Y');
    		  $post_query = new WP_Query(
                apply_filters( 'widget_posts_args',
                    array(
                        'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'tag' => $tag_qry,
                        'year' => $year,
                        'monthnum' => $month ,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => $type_filter,
                                'value' => '1'
                            )
                        ),
                        'meta_key' => 'score_module',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                        )
                    )
                );

    		} elseif ( $filter == 'random' ) {
                
              $post_query = new WP_Query(
                apply_filters( 'widget_posts_args',
                    array(
                        'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'tag' => $tag_qry,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'orderby' => 'rand',
                        'ignore_sticky_posts' => true
                        )
                    )
                );

            } elseif ( $filter == 'latest' ) {
    
              $post_query = new WP_Query( 
                apply_filters( 'widget_posts_args', 
                    array(
                        'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'tag' => $tag_qry,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                        )
                    )
                );

            } elseif ( $filter == 'featured' ) {
    
              $post_query = new WP_Query( 
                apply_filters( 'widget_posts_args', 
                    array(
                        'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'tag' => $tag_qry,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'meta_key' => 'featured_post',
                        'meta_value' => '1',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                        )
                    )
                );

            } elseif ( $filter == 'popular_alltime' ) {
                $post_query = new WP_Query(
                    apply_filters( 'widget_posts_args',
                        array(
                            'posts_per_page' => $number,
                            'category_name' => $cat_qry,
                            'tag' => $tag_qry,
                            'no_found_rows' => true,
                            'post_status' => 'publish',
                            'meta_key' => 'post_views_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                            'ignore_sticky_posts' => true
                            )
                        )
                );
            } elseif ( $filter == 'popular_week') {
                $week = date('W');
                $year = date('Y');
                $post_query = new WP_Query( 
                    apply_filters( 'widget_posts_args', 
                        array( 
                            'posts_per_page' => $number,
                            'category_name' => $cat_qry,
                            'tag' => $tag_qry,
                            'year' => $year,
                            'w' => $week ,
                            'no_found_rows' => true,
                            'post_status' => 'publish',
                            'meta_key' => 'post_views_count',
                            'orderby' => 'meta_value_num', 
                            'order' => 'DESC',
                            'ignore_sticky_posts' => true
                        ) 
                    ) 
                );
            } elseif ( $filter == 'popular_month' ) {
                $month = date('m');
                $year = date('Y');
                $post_query = new WP_Query(
                apply_filters( 'widget_posts_args',
                    array(
                        'posts_per_page' => $number,
                        'category_name' => $cat_qry,
                        'tag' => $tag_qry,
                        'year' => $year,
                        'monthnum' => $month ,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                        'ignore_sticky_posts' => true
                        )
                    )
                );
            }

            echo $before_widget;

            // Display the widget title if one was input
            if ($title) {
                echo $before_title . $title . $after_title;
            }

            $r_posts = array();
            if ( $post_query->have_posts() ) :
                while ( $post_query->have_posts() ) : $post_query->the_post();
                    if ( $filter == 'top_alltime' OR $filter == 'top_month' OR $filter == 'top_week' ) {
                        $r_posts[get_the_ID()] = maha_meta_review(get_the_ID());
                    } else {
                        $r_posts[get_the_ID()] = get_the_ID();
                    }
                endwhile;
            endif;
            wp_reset_postdata();
           
            if ( $filter == 'top_alltime' OR $filter == 'top_month' OR $filter == 'top_week' ) {
                arsort($r_posts);
            }
           
            if ($layout == 'top_review') {

                if ( count($r_posts > 0) ) {
                    foreach ($r_posts as $key => $v_review) {
                        ?>
                        <div class="popupar-item zoom-zoom" itemscope itemtype="http://schema.org/Article">
                            <img width="" height="" itemprop="image" class="entry-thumb" src="<?php echo maha_featured_url( $key , 'mh_medium'); ?>" alt="" title="<?php echo get_the_title($key); ?>"/>
                            <div class="popupar-item-cover zoom-it three" style="background-image: url(<?php echo maha_featured_url( $key , 'mh_medium'); ?>);"></div>
                            <div class="meta-count">
                                <?php
                                    if ( maha_meta_review($key) != '' ) {
                                ?>
                                <span class="td-page-meta" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
                                    <meta itemprop="worstRating" content="1">
                                    <meta itemprop="bestRating" content="10">
                                    <meta itemprop="ratingValue" content="<?php echo maha_meta_review($key); ?>">
                                </span>
                                <span class="i-review"><i class="icon-star"></i> <?php echo maha_meta_review($key);?></span> 
                                <?php
                                    }
                                ?>
                                <span class="i-category"><?php maha_post_category( $key ); ?></span>
                            </div>
                            <div class="detail">
                                <a itemprop="url" rel="bookmark" href="<?php echo get_permalink($key); ?>" title="<?php echo get_the_title($key); ?>">
                                    <h4 itemprop="name"><?php echo get_the_title($key); ?></h4>
                                </a>
                            </div>
                            <meta itemprop="headline" content="<?php echo get_the_title($key); ?>" />
                        </div>
                        <?php
                    }
                }

            } elseif ( $layout == 'list') {
                foreach ($r_posts as $key => $v_review) {
                    ?>
                    <div class="post-box-small recent-item clearfix" itemscope itemtype="http://schema.org/Article">
                        <?php if ( has_post_thumbnail($key) ) { ?>
                        <div class="thumb-wrap zoom-zoom three">
                            <a href="<?php echo get_the_permalink($key); ?>" rel="bookmark" title="<?php echo get_the_title($key); ?>">
                                <img width="83" height="63" itemprop="image" class="entry-thumb zoom-it three" src="<?php echo maha_featured_url( $key , 'mh_widget'); ?>" alt="<?php echo get_the_title($key); ?>" title="<?php echo get_the_title($key); ?>"/>
                            </a>
                        </div>
                        <?php } ?>
                        <div class="box-small-wrap">
                            <h3 itemprop="name" class="entry-title short-bottom">
                                <a itemprop="url" href="<?php echo get_the_permalink($key); ?>" rel="bookmark" title="<?php echo get_the_title($key); ?>">
                                    <?php echo get_the_title($key); ?>
                                </a>
                            </h3>
                            <meta itemprop="headline" content="<?php echo get_the_title($key); ?>" />
                            <div class="meta-info">
                                <span itemprop="author" class="entry-author"><?php $author_id = get_post_field( 'post_author', $key ); echo the_author_meta( 'display_name', $author_id ); ?></span>
                                <span class="coma">,</span>
                                <time itemprop="datePublished" class="entry-date" datetime="<?php the_time( 'c' ); ?>" >
                                    <?php echo get_the_time( get_option( 'date_format' ), $key ); ?>
                                </time>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }

            echo $after_widget;
    	}
    
    	function update( $new_instance, $old_instance ) {
    		$instance = $old_instance;
    		$instance['title'] = strip_tags($new_instance['title']);
            $instance['category'] = strip_tags($new_instance['category']);
            $instance['tag'] = strip_tags($new_instance['tag']);
    		$instance['layout'] = strip_tags($new_instance['layout']);
    		$instance['number'] = (int) $new_instance['number'];
            $instance['filter'] =  strip_tags($new_instance['filter']);
    
    		return $instance;
    	}
    
    	function form( $instance ) {
            $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Post';
    		$layout     = isset( $instance['layout'] ) ? esc_attr( $instance['layout'] ) : '';
            $category  = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
    		$tag      = isset( $instance['tag'] ) ? esc_attr( $instance['tag'] ) : '';
    		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
            $filter    = isset( $instance['filter'] ) ? esc_attr( $instance['filter'] ) : '';
            $cats = get_categories();
    		$tags = get_tags();
            
            ?>
    		<p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', MAHA_TEXT_DOMAIN ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
    
    		<p>
                <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category:', MAHA_TEXT_DOMAIN); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
                <option value="all" <?php if ($category == 'all') echo 'selected="selected"'; ?>><?php _e('All Categories', MAHA_TEXT_DOMAIN); ?></option> 
                <?php foreach ($cats as $cat) {
                        if ($category == $cat->slug) {$selected = 'selected="selected"'; } else { $selected = NULL;}
                        echo '<option value="'.$cat->slug.'" '.$selected.'>'.$cat->name.' ('.$cat->count.')</option>';
                        
                  } ?>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php _e('Tag:', MAHA_TEXT_DOMAIN); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'tag' ); ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>">
                <option value="all" <?php if ($tag == 'all') echo 'selected="selected"'; ?>><?php _e('All Tag', MAHA_TEXT_DOMAIN); ?></option> 
                <?php
                    foreach ($tags as $key => $value) {
                        if ($tag == $value->slug) {$selected = 'selected="selected"'; } else { $selected = NULL;}
                        echo '<option value="'.$value->slug.'" '.$selected.'>'.$value->name.' ('.$value->count.')</option>';
                    }
                ?>
                </select>
            </p>
    		
    		<p>
                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of reviews to show:', MAHA_TEXT_DOMAIN ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e('Layout:', MAHA_TEXT_DOMAIN); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>">
                    <option value="list" <?php if ( $layout == 'list' ) { echo 'selected="selected"'; } ?>><?php _e('List', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="top_review" <?php if ( $layout == 'top_review' ) { echo 'selected="selected"'; } ?>><?php _e('Top Review', MAHA_TEXT_DOMAIN); ?></option>
                </select>
            </p>
    		
    		<p>
                <label for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e('Filter:', MAHA_TEXT_DOMAIN); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>">
                    <option value="latest" <?php if ( $filter == 'latest' ) { echo 'selected="selected"'; } ?>><?php _e('Latest', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="featured" <?php if ( $filter == 'featured' ) { echo 'selected="selected"'; } ?>><?php _e('Featured', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="random" <?php if ( $filter == 'random' ) { echo 'selected="selected"'; } ?>><?php _e('Random', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="popular_alltime" <?php if ( $filter == 'popular_alltime' ) { echo 'selected="selected"'; } ?>><?php _e('Popular All-time', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="popular_week" <?php if ( $filter == 'popular_week' ) { echo 'selected="selected"'; } ?>><?php _e('Popular This Week', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="popular_month" <?php if ( $filter == 'popular_month' ) { echo 'selected="selected"'; } ?>><?php _e('Popular This Month', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="top_alltime" <?php if ( $filter == 'top_alltime' ) { echo 'selected="selected"'; } ?>><?php _e('Top All-time', MAHA_TEXT_DOMAIN); ?></option> 
                    <option value="top_month" <?php if ( $filter == 'top_month' ) { echo 'selected="selected"'; } ?>><?php _e('Top This Month', MAHA_TEXT_DOMAIN); ?></option> 
                    <option value="top_week" <?php if ( $filter == 'top_week' ) { echo 'selected="selected"'; } ?>><?php _e('Top This Week', MAHA_TEXT_DOMAIN); ?></option>
                </select>
            </p>
        <?php
    	}
    }
}

register_widget( 'maha_posts' );
?>