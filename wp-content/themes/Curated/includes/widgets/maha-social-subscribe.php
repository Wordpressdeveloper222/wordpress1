<?php
/* --------------------------------------------------------------------------

    A ThemeMaha Framework - Copyright (c) 2014

    - Social Subscribe

 ---------------------------------------------------------------------------*/


if ( ! class_exists( 'maha_social_subscribe' ) ) { 
    class maha_social_subscribe extends WP_Widget {
        
        /*  Setup
          ================================================== */

        function __construct() {

            // Widget settings
            $widget_ops = array(
                'classname' => 'social_subscribe',
                'description' => __('Displays your Social Media with counter.', MAHA_TEXT_DOMAIN)
            );

            // Widget control settings
            $control_ops = array(
                'id_base' => 'maha_social_subscribe'
            );

            // Create the widget
            parent::__construct('maha_social_subscribe', wp_get_theme()->get('Name').__(' - Social Subscribe', MAHA_TEXT_DOMAIN), $widget_ops, $control_ops);
        }

        /*  Display
          ================================================== */

        function widget($args, $instance) {
            extract($args);

            // Our variables from the widget settings
            $title = apply_filters('widget_title', $instance['title']);
            $twitter_id = $instance['twitter_id'];
            $twitter_label = $instance['twitter_label'];
            $facebook = $instance['facebook'];
            $facebook_label = $instance['facebook_label'];
            $youtube = $instance['youtube'];
            $youtube_label = $instance['youtube_label'];
            $gplus = $instance['gplus'];
            $gplus_label = $instance['gplus_label'];
            $instagram_id = $instance['instagram_id'];
            $instagram_label = $instance['instagram_label'];
            $rss_url = $instance['rss_url'];
            $rss_title = $instance['rss_title'];
            $rss_label = $instance['rss_label'];
            $pinterest_id = $instance['pinterest_id'];
            $pinterest_label = $instance['pinterest_label'];
            $tumblr_blog = $instance['tumblr_blog'];
            $tumblr_label = $instance['tumblr_label'];

            // Before widget (defined by theme functions file)
            echo $before_widget;

            // Display the widget title if one was input
            if ($title) {
                echo $before_title . $title . $after_title;
    		}
            ?>

            <?php
            if ( $twitter_id ) { $twitter_count = maha_get_twitter_count( $twitter_id, $widget_id );
            ?>
    		<div class="social-network twitter">
                <a class="social-network-icon trans-it" target="_blank" href="<?php echo esc_attr( $twitter_count['page_url'] ); ?>" title="<?php _e('Follow our twitter', MAHA_TEXT_DOMAIN); ?>"><i class="icon-twitter trans-it"></i></a>
                <div class="social-network-counter">
                    <div class="social-network-count"><?php echo number_format( $twitter_count['followers_count'] ); ?></div>
                    <div class="social-network-unit"><?php _e($twitter_label, MAHA_TEXT_DOMAIN); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>

            <?php
            if ( $facebook ) { $facebook_count = maha_get_facebook_count( $facebook, $widget_id );
            ?>
            <div class="social-network facebook">
                <a class="social-network-icon trans-it" target="_blank" href="<?php echo esc_attr( $facebook_count['page_url'] ); ?>" title="<?php _e('Like our Facebook', MAHA_TEXT_DOMAIN); ?>"><i class="icon-facebook trans-it"></i></a>
                <div class="social-network-counter">
                    <div class="social-network-count"><?php echo number_format( $facebook_count['fans_count'] ); ?></div>
                    <div class="social-network-unit"><?php _e($facebook_label, MAHA_TEXT_DOMAIN); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>

            <?php
            if ( $youtube ) { $youtube_count = maha_get_youtube_count( $youtube, $widget_id );
            ?>
            <div class="social-network youtube">
                <a class="social-network-icon trans-it" target="_blank" href="<?php echo esc_attr( $youtube_count['page_url'] ); ?>" title="<?php _e('Subscribe our Youtube', MAHA_TEXT_DOMAIN); ?>"><i class="icon-play trans-it"></i></a>
                <div class="social-network-counter">
                    <div class="social-network-count"><?php echo number_format( $youtube_count['subscriber_count'] ); ?></div>
                    <div class="social-network-unit"><?php _e($youtube_label, MAHA_TEXT_DOMAIN); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>

            <?php
            if ( $gplus ) { $gplus_count = maha_gplus_count( $gplus, $widget_id );
            ?>
            <div class="social-network gplus">
                <a class="social-network-icon trans-it" target="_blank" href="<?php echo esc_attr( $gplus_count['page_url'] ); ?>" title="<?php _e('Follow our Google+', MAHA_TEXT_DOMAIN); ?>"><i class="icon-gplus trans-it"></i></a>
                <div class="social-network-counter">
                    <div class="social-network-count"><?php echo number_format( $gplus_count['people_count'] ); ?></div>
                    <div class="social-network-unit"><?php _e($gplus_label, MAHA_TEXT_DOMAIN); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>

            <?php
            if ( $instagram_id ) { $instagram_count = maha_instagram_count( $instagram_id, $widget_id );
            ?>
            <div class="social-network instagram">
                <a class="social-network-icon trans-it" target="_blank" href="<?php echo esc_attr( $instagram_count['page_url'] ); ?>" title="<?php _e('Follow our Instagram', MAHA_TEXT_DOMAIN); ?>"><i class="icon-instagrem trans-it"></i></a>
                <div class="social-network-counter">
                    <div class="social-network-count"><?php echo number_format( $instagram_count['follower'] ); ?></div>
                    <div class="social-network-unit"><?php _e($instagram_label, MAHA_TEXT_DOMAIN); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>

            <?php
            if ( $rss_url ) {
            ?>
            <div class="social-network rss">
                <a class="social-network-icon trans-it" target="_blank" href="<?php echo esc_attr( $rss_url ); ?>" title="<?php _e('RSS Feeds', MAHA_TEXT_DOMAIN); ?>"><i class="icon-rss trans-it"></i></a>
                <div class="social-network-counter">
                    <div class="social-network-count"><?php _e($rss_title, MAHA_TEXT_DOMAIN); ?></div>
                    <div class="social-network-unit"><?php _e($rss_label, MAHA_TEXT_DOMAIN); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>

            <?php
            if ( $pinterest_id ) { $pinterest_count = maha_pinterest_count( $pinterest_id, $widget_id );
            ?>
            <div class="social-network pinterest">
                <a class="social-network-icon trans-it" target="_blank" href="<?php echo esc_attr( $pinterest_count['page_url'] ); ?>" title="<?php _e('Pin it', MAHA_TEXT_DOMAIN); ?>"><i class="icon-pinterest trans-it"></i></a>
                <div class="social-network-counter">
                    <div class="social-network-count"><?php echo number_format( $pinterest_count['followers'] ); ?></div>
                    <div class="social-network-unit"><?php _e($pinterest_label, MAHA_TEXT_DOMAIN); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>

            <?php
            if ( $tumblr_blog ) { $tumblr_count = maha_get_tumblr_count( $tumblr_blog, $widget_id );
            ?>
            <div class="social-network tumblr">
                <a class="social-network-icon trans-it" target="_blank" href="<?php echo esc_attr( $tumblr_count['page_url'] ); ?>" title="<?php _e('Follow our blog', MAHA_TEXT_DOMAIN); ?>"><i class="icon-tumblr trans-it"></i></a>
                <div class="social-network-counter">
                    <div class="social-network-count"><?php echo number_format( $tumblr_count['followers'] ); ?></div>
                    <div class="social-network-unit"><?php _e($tumblr_label, MAHA_TEXT_DOMAIN); ?></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>
    		
            <?php
            // After widget (defined by theme functions file)
            echo $after_widget;
        }

        
        /*  Update
          ================================================== */

        function update($new_instance, $old_instance) {
            $instance = $old_instance;

            // Strip tags to remove HTML (important for text inputs)
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
            $instance['twitter_label'] = strip_tags($new_instance['twitter_label']);
            $instance['facebook'] = strip_tags($new_instance['facebook']);
            $instance['facebook_label'] = strip_tags($new_instance['facebook_label']);
            $instance['youtube'] = strip_tags($new_instance['youtube']);
            $instance['youtube_label'] = strip_tags($new_instance['youtube_label']);
            $instance['gplus'] = strip_tags($new_instance['gplus']);
            $instance['gplus_label'] = strip_tags($new_instance['gplus_label']);
            $instance['instagram_id'] = strip_tags($new_instance['instagram_id']);
            $instance['instagram_label'] = strip_tags($new_instance['instagram_label']);
            $instance['rss_url'] = strip_tags($new_instance['rss_url']);
            $instance['rss_title'] = strip_tags($new_instance['rss_title']);
            $instance['rss_label'] = strip_tags($new_instance['rss_label']);
            $instance['pinterest_id'] = strip_tags($new_instance['pinterest_id']);
            $instance['pinterest_label'] = strip_tags($new_instance['pinterest_label']);
            $instance['tumblr_blog'] = strip_tags($new_instance['tumblr_blog']);
            $instance['tumblr_label'] = strip_tags($new_instance['tumblr_label']);

            delete_transient( 'mh_tw_count_'.$this->id );
            delete_transient( 'mh_fb_count_'.$this->id );
            delete_transient( 'mh_yt_count_'.$this->id );
            delete_transient( 'mh_gp_count_'.$this->id );
            delete_transient( 'mh_ig_count_'.$this->id );
            delete_transient( 'mh_pt_count_'.$this->id );
            delete_transient( 'mh_tb_count_'.$this->id );

            return $instance;
        }

        
        /*  Settings
          ================================================== */

        function form($instance) {

            // Set up some default widget settings
            $defaults = array(
                'title' => 'Get Connected',
                'twitter_id' => '',
                'twitter_label' => 'Followers',
                'facebook' => '',
                'facebook_label' => 'Followers',
                'youtube' => '',
                'youtube_label' => 'Subscribe',
                'gplus' => '',
                'gplus_label' => 'Followers',
                'instagram_id' => '',
                'instagram_label' => 'Followers',
                'rss_url' => '',
                'rss_title' => 'RSS',
                'rss_label' => 'Feeds',
                'pinterest_id' => '',
                'pinterest_label' => 'Followers',
                'tumblr_blog' => '',
                'tumblr_label' => 'Followers',
            );

            $instance = wp_parse_args((array) $instance, $defaults);
            ?>

            <!-- Widget Input Fields -->
            <p><?php _e('If you have trouble showing social media numbers, please use your own token code in Curated Options > <a target="_blank" href="'.admin_url('admin.php?page=maha_options&tab=9').'">Social Options</a>. If you still having problem, please contact our support.', MAHA_TEXT_DOMAIN); ?></p>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
            </p>            
            <p>
                <label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" type="text" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('twitter_label'); ?>"><?php _e('Twitter Label ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('twitter_label'); ?>" type="text" name="<?php echo $this->get_field_name('twitter_label'); ?>" value="<?php echo $instance['twitter_label']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook ID ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" type="text" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $instance['facebook']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('facebook_label'); ?>"><?php _e('Facebook Label ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('facebook_label'); ?>" type="text" name="<?php echo $this->get_field_name('facebook_label'); ?>" value="<?php echo $instance['facebook_label']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube Username ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" type="text" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $instance['youtube']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('youtube_label'); ?>"><?php _e('Youtube Label ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('youtube_label'); ?>" type="text" name="<?php echo $this->get_field_name('youtube_label'); ?>" value="<?php echo $instance['youtube_label']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('gplus'); ?>"><?php _e('Google+ ID/Username ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('gplus'); ?>" type="text" name="<?php echo $this->get_field_name('gplus'); ?>" value="<?php echo $instance['gplus']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('gplus_label'); ?>"><?php _e('Google+ Label ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('gplus_label'); ?>" type="text" name="<?php echo $this->get_field_name('gplus_label'); ?>" value="<?php echo $instance['gplus_label']; ?>" />
            </p>        
            <p>
                <label for="<?php echo $this->get_field_id('instagram_id'); ?>"><?php _e('Instagram User ID ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('instagram_id'); ?>" type="text" name="<?php echo $this->get_field_name('instagram_id'); ?>" value="<?php echo $instance['instagram_id']; ?>" />
                <span><?php _e('Instagram Username is different with Instagram ID, you can get your Instagram ID by using your Instagram Username via <a target="_blank" href="http://jelled.com/instagram/lookup-user-id">http://jelled.com/instagram/lookup-user-id</a>', MAHA_TEXT_DOMAIN);?> </span>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('instagram_label'); ?>"><?php _e('Instagram Label ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('instagram_label'); ?>" type="text" name="<?php echo $this->get_field_name('instagram_label'); ?>" value="<?php echo $instance['instagram_label']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('rss_url'); ?>"><?php _e('RSS url ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('rss_url'); ?>" type="text" name="<?php echo $this->get_field_name('rss_url'); ?>" value="<?php echo $instance['rss_url']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('rss_title'); ?>"><?php _e('RSS Title ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('rss_title'); ?>" type="text" name="<?php echo $this->get_field_name('rss_title'); ?>" value="<?php echo $instance['rss_title']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('rss_label'); ?>"><?php _e('RSS Label ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('rss_label'); ?>" type="text" name="<?php echo $this->get_field_name('rss_label'); ?>" value="<?php echo $instance['rss_label']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('pinterest_id'); ?>"><?php _e('Pinterest ID', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('pinterest_id'); ?>" type="text" name="<?php echo $this->get_field_name('pinterest_id'); ?>" value="<?php echo $instance['pinterest_id']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('pinterest_label'); ?>"><?php _e('Pinterest Label ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('pinterest_label'); ?>" type="text" name="<?php echo $this->get_field_name('pinterest_label'); ?>" value="<?php echo $instance['pinterest_label']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tumblr_blog'); ?>"><?php _e('Tumblr Blog Name', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('tumblr_blog'); ?>" type="text" name="<?php echo $this->get_field_name('tumblr_blog'); ?>" value="<?php echo $instance['tumblr_blog']; ?>" />
                <span><?php _e('e.g. example.tumblr.com', MAHA_TEXT_DOMAIN);?> </span>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tumblr_label'); ?>"><?php _e('Thumblr Label ', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('tumblr_label'); ?>" type="text" name="<?php echo $this->get_field_name('tumblr_label'); ?>" value="<?php echo $instance['tumblr_label']; ?>" />
            </p>

            <?php
        }

    }
}


/*  Setup
================================================== */
register_widget('maha_social_subscribe');


/*  Get Twitter Followers
================================================== */
if ( ! function_exists( 'maha_get_twitter_count' ) ) {
    function maha_get_twitter_count( $twitter_id, $widget_id ) {
        $maha_options = get_option('curated');
        $twitter = get_transient('mh_tw_count_'.$widget_id);

        if ($twitter !== false && is_array($twitter)) { if ($twitter['followers_count'] != 0) { return $twitter; } }

        // some variables
        $consumer_key = $maha_options['social-twitter-key'];
        $consumer_secret = $maha_options['social-twitter-secret'];
        $token = get_option('maha_twitter_token');
        $twitter['page_url'] = "http://www.twitter.com/$twitter_id";
        $twitter['followers_count'] = 0;

        if($twitter_id && $consumer_key && $consumer_secret) {
            if(!$token) {
                // preparing credentials
                $credentials = $consumer_key . ':' . $consumer_secret;
                $toSend = base64_encode($credentials);

                // http post arguments
                $args = array(
                    'method' => 'POST',
                    'httpversion' => '1.1',
                    'blocking' => true,
                    'headers' => array(
                        'Authorization' => 'Basic ' . $toSend,
                        'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
                    ),
                    'body' => array( 'grant_type' => 'client_credentials' )
                );

                add_filter('https_ssl_verify', '__return_false');
                $response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

                $keys = json_decode(wp_remote_retrieve_body($response));

                if($keys) {
                    // saving token to wp_options table
                    update_option('maha_twitter_token', $keys->access_token);
                    $token = $keys->access_token;
                }
            }
            // we have bearer token wether we obtained it from API or from options
            $args = array(
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => "Bearer $token"
                )
            );

            add_filter('https_ssl_verify', '__return_false');
            $api_url = "https://api.twitter.com/1.1/users/show.json?screen_name=$twitter_id";
            $response = wp_remote_get($api_url, $args);

            if (!is_wp_error($response)) {
                $twitter_reply = json_decode(wp_remote_retrieve_body($response));
                if ( isset( $twitter_reply->followers_count ) ) {
                    $twitter['followers_count'] = $twitter_reply->followers_count;
                } else {
                    $twitter['followers_count'] = 0;
                }
            }
        } else {
            $twitter['followers_count'] = 0;
        }
        
        set_transient( 'mh_tw_count_'.$widget_id, $twitter, 60*60*24 ); // 1 Day chace
        return $twitter;
    }
}

/*  Get Facebook Subscribers
================================================== */
if ( ! function_exists( 'maha_get_facebook_count' ) ) {
    function maha_get_facebook_count( $page_id, $widget_id ) {
        $maha_options = get_option('curated');
        $facebook = get_transient('mh_fb_count_'.$widget_id);
        
        if ($facebook !== false && is_array($facebook)) { if ($facebook['fans_count'] != 0) { return $facebook; } }
        $url = "https://graph.facebook.com/".$page_id."/?fields=likes&access_token=".$maha_options['social-facebook'];
        $facebook['fans_count'] = '0';
        $facebook['page_url'] = 'http://www.facebook.com';

        $data = maha_get_subscriber_counter($url);
        $json = json_decode( $data );        

        if ( function_exists( 'json_last_error' ) && JSON_ERROR_NONE === json_last_error() && ! empty( $json ) && !isset($json->error) ) {
            $facebook['fans_count'] = $json->likes;
            $facebook['page_url'] = 'http://www.facebook.com/'.$page_id;
        }

        set_transient( 'mh_fb_count_'.$widget_id, $facebook, 60*60*24 ); // 1 Day cache
        return $facebook;
    }
}

/*  Get Youtube Subscribers
================================================== */
if ( ! function_exists( 'maha_get_youtube_count' ) ) {
    function maha_get_youtube_count( $username, $widget_id ) {
        $maha_options = get_option('curated');
        $youtube = get_transient('mh_yt_count_'.$widget_id);

        if ($youtube !== false && is_array($youtube)) { if ($youtube['subscriber_count'] != 0) { return $youtube; } }
        $api_url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername='.$username.'&key='.$maha_options['social-google'];
        $youtube['page_url'] = '#';
        $youtube['subscriber_count'] = 0;
        
        $data = maha_get_subscriber_counter($api_url); 
        $json = json_decode( $data );

        if ( function_exists( 'json_last_error' ) && JSON_ERROR_NONE === json_last_error() && ! empty( $json ) && !isset($json->error) ) {
            $youtube['page_url'] = "http://www.youtube.com/user/".$username;
            $youtube['subscriber_count'] = $json->items[0]->statistics->subscriberCount;
        }

        set_transient( 'mh_yt_count_'.$widget_id, $youtube, 60*60*24 ); // 1 Day cache
        return($youtube); 
    }
}

/*  Get Google+ Subscribers
================================================== */
if ( ! function_exists( 'maha_gplus_count' ) ) {
    function maha_gplus_count( $username, $widget_id ) {
        $maha_options = get_option('curated');
        $googleplus = get_transient('mh_gp_count_'.$widget_id);

        if ($googleplus !== false && is_array($googleplus)) { if ($googleplus['people_count'] != 0) { return $googleplus; } }
        $with_plus = '+';
        if ( is_numeric($username)) { $with_plus = ''; }
        $api_url = 'https://www.googleapis.com/plus/v1/people/'.$with_plus.$username.'?key='.$maha_options['social-google'];
        $googleplus['page_url'] = '#';
        $googleplus['people_count'] = 0;
        
        $data = maha_get_subscriber_counter($api_url); 
        $json = json_decode( $data );

        if ( function_exists( 'json_last_error' ) && JSON_ERROR_NONE === json_last_error() && ! empty( $json )  && !isset($json->error) ) {
            $googleplus['page_url'] = $json->url;
            $googleplus['people_count'] = $json->circledByCount;
        }

        set_transient( 'mh_gp_count_'.$widget_id, $googleplus, 60*60*24 ); // 1 Day cache
        return $googleplus;
    }
}

/*  Get Instagram Followers
================================================== */
if ( ! function_exists( 'maha_instagram_count' ) ) {
    function maha_instagram_count( $user_id, $widget_id ) {
        $maha_options = get_option('curated');
        $instagram = get_transient('mh_ig_count_'.$widget_id);

        if ($instagram !== false && is_array($instagram)) { if ($instagram['follower'] != '') { return $instagram; } }
        $api_url = 'https://api.instagram.com/v1/users/'.$user_id.'/?access_token='.$maha_options['social-instagram'];
        $instagram['page_url'] = 'http://instagram.com/';
        $instagram['user_id'] = '';
        $instagram['follower'] = 0;

        $data = maha_get_subscriber_counter($api_url); 
        $json = json_decode( $data );

        if ( function_exists( 'json_last_error' ) && JSON_ERROR_NONE === json_last_error() && ! empty( $json )  && !isset($json->meta->error_type) ) {
            $instagram['user_id'] = $json->data->id;
            $instagram['follower'] = $json->data->counts->followed_by;
            $instagram['page_url'] = 'http://instagram.com/'.$json->data->username;
        }

        set_transient( 'mh_ig_count_'.$widget_id, $instagram, 60*60*24 ); // 1 Day cache
        return $instagram;
    }
}

/*  Get Pinterest Followers
================================================== */
if ( ! function_exists( 'maha_pinterest_count' ) ) {
    function maha_pinterest_count( $username, $widget_id ) {
        $pinterest = get_transient('mh_pt_count_'.$widget_id);

        if ($pinterest !== false && is_array($pinterest)) { if ($pinterest['followers'] != 0) { return $pinterest; } }
        
        $maha_options = get_option('curated');
        $api_url = "https://api.pinterest.com/v1/users/". $username ."/?access_token=". $maha_options['social-pinterest'] ."&fields=counts";
        $pinterest['page_url'] = "https://www.pinterest.com/". $username ."/";
        $pinterest['followers'] = 0;

        $data = maha_get_subscriber_counter($api_url); 
        $json = json_decode( $data );

        if ( function_exists( 'json_last_error' ) && JSON_ERROR_NONE === json_last_error() && ! empty( $json )  && !isset($json->meta->error_type) ) {
            $pinterest['followers'] = $json->data->counts->followers;
        }

        set_transient( 'mh_pt_count_'.$widget_id, $pinterest, 60*60*24 ); // 1 Day cache
        return $pinterest;
    }
}

/*  Get Subscriber Counter
================================================== */
if ( ! function_exists( 'maha_get_subscriber_counter' ) ) {
    function maha_get_subscriber_counter( $api_url ) {
        $args = array(
            'httpversion' => '1.1',
            'blocking' => true,
        );

        $response = wp_remote_get($api_url, $args);
        if (!is_wp_error($response)) {
            return wp_remote_retrieve_body($response);
        }
    }
}

/*  Get Twitter Followers
================================================== */
if ( ! function_exists( 'maha_get_tumblr_count' ) ) {
	function maha_get_tumblr_count( $tumblr_blog, $widget_id ) {
		$maha_options = get_option('curated');
		$tumblr = get_transient('mh_tb_count_'.$widget_id);

		if ($tumblr !== false && is_array($tumblr)) { if ($tumblr['followers'] != 0) { return $tumblr; } }

		// Load the library
		require_once (MAHA_PATH . '/includes/functions/tumblroauth/tumblroauth.php');

		// Define the needed keys
		$consumer_key = "TzCwtememSHb1DlhMrGqgi1TbXsIJI5glw51qMLsDaU8I1mV5m";
		$consumer_secret = "7LKGtRpbxNDbR9vXSTOIdsOf8o4kEYldcNnTCGXBSrwPaBNLrD";
		$oauth_token = $maha_options['social-tumblr-key'];
		$oauth_token_secret = $maha_options['social-tumblr-secret'];
		$base_hostname = $tumblr_blog;

		$post_URI = 'http://api.tumblr.com/v2/blog/'.$base_hostname.'/followers';

		$tum_oauth = new TumblrOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);

		$post = $tum_oauth->post($post_URI);

		// Check for an error.
		if ('OK' == $post->meta->msg) {
			$tumblr['page_url'] = '//'.$base_hostname;
			$tumblr['followers'] = $post->response->total_users;
		} else {
			// die('error');
			$tumblr['page_url'] = '';
			$tumblr['followers'] = 0;
			echo "Blog name, token or token secret invalid.";
		}

		set_transient( 'mh_tb_count_'.$widget_id, $tumblr, 60*60*24 ); // 1 Day chace
		return $tumblr;
	}
}
?>