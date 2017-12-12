<?php


$maha_options = get_option('curated');

$tags = $maha_options['running_text_tag_filter'];
$cats = $maha_options['running_text_cat_filter'];
$filter = $maha_options['running_text_filter'];
$number_post = $maha_options['running_text_number_post'];

$tag = '';
$get_tag = array();
if ($tags != 0) {
    if (!isset($tags['alltags'])) {
        foreach ($tags as $key => $value) {
            $get_tag[] = $value;
        }
        $tag = $get_tag;
    }
}



$cat = '';
$get_cat = array();
if ($cats != 0) {
    if (!isset($cats['allcats'])) {
        foreach ($cats as $key => $value) {
            $get_cat[] = $key;
        }
        $cat = $get_cat;
    }
}



if ($filter == 'latest') {
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__in' => $cat,
        'tag__and' => $tag,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'order' => 'DESC'
            )
    );
    // print_r($cat);
} elseif ($filter == 'featured') {
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__and' => $cat,
        'tag__and' => $tag,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'top_featured_post',
                'value' => 1
            )
        ),
        'meta_key' => 'featured_post',
        'meta_value' => '1',
        'order' => 'DESC'
            )
    );
} elseif ($filter == 'random') {
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__and' => $cat,
        'tag__and' => $tag,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'orderby' => 'rand'
            )
    );
} elseif ($filter == 'popular_all') {
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__and' => $cat,
        'tag__and' => $tag,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
            )
    );
} elseif ($filter == 'popular_month') {
    $month = date('m');
    $year = date('Y');
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__and' => $cat,
        'tag__and' => $tag,
        'year' => $year,
        'monthnum' => $month,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
            )
    );
} elseif ($filter == 'popular_week') {
    $week = date('W');
    $year = date('Y');
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__and' => $cat,
        'tag__and' => $tag,
        'year' => $year,
        'w' => $week,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
            )
    );
} elseif ($filter == 'top_all') {
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__and' => $cat,
        'tag__and' => $tag,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'enable_review',
                'value' => 1
            )
        ),
        'meta_key' => 'score_module',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
            )
    );
} elseif ($filter == 'top_month') {
    $month = date('m');
    $year = date('Y');
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__and' => $cat,
        'tag__and' => $tag,
        'year' => $year,
        'monthnum' => $month,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'enable_review',
                'value' => 1
            )
        ),
        'meta_key' => 'score_module',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
            )
    );
} elseif ($filter == 'top_week') {
    $week = date('W');
    $year = date('Y');
    $wp_query = new WP_Query(
            array(
        'post_type' => 'post',
        'posts_per_page' => $number_post,
        'category__and' => $cat,
        'tag__and' => $tag,
        'year' => $year,
        'w' => $week,
        'no_found_rows' => true,
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'enable_review',
                'value' => 1
            )
        ),
        'meta_key' => 'score_module',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
            )
    );
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 myrun">
            <div class="cur-runtext" id="runtext">
                <?php if ($wp_query->have_posts()) : ?>
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                        
                            <div class="thumb-runtext">
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                                <?php if (has_post_thumbnail()) {?><img width="45" height="35" src="<?php echo maha_featured_url(get_the_ID(), 'mh_widget'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><?php }?>
                                <?php the_title(); ?>
                                </a>
                            </div>                                                  

                    <?php endwhile; ?>
                <?php endif; ?>                
            </div>
        </div>
    </div>
</div>
<?php wp_reset_query(); ?>
