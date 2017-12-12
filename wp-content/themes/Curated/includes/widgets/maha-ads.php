<?php
/* --------------------------------------------------------------------------

    A ThemeMaha Framework - Copyright (c) 2014

    - Ads

 ---------------------------------------------------------------------------*/


if ( ! class_exists( 'maha_ads' ) ) { 
    class maha_ads extends WP_Widget {
        
        /*  Setup
          ================================================== */

        function __construct() {

            // Widget settings
            $widget_ops = array(
                'classname' => 'widget_ads',
                'description' => __('Displays Responsive Banner Ads.', MAHA_TEXT_DOMAIN)
            );

            // Widget control settings
            $control_ops = array(
                'id_base' => 'maha_ads'
            );

            // Create the widget
            parent::__construct('maha_ads', wp_get_theme()->get('Name').__(' - Responsive Ads', MAHA_TEXT_DOMAIN), $widget_ops, $control_ops);
        }

        /*  Display
          ================================================== */

        function widget($args, $instance) {
            extract($args);

            // Our variables from the widget settings
            $title = apply_filters('widget_title', $instance['title']);
            $subtitle = $instance['subtitle'];
            $image = $instance['image'];
            $button_text = $instance['button_text'];
            $button_url = $instance['button_url'];
            $box_style = $instance['box_style'];
            $text_align = $instance['text_align'];

            // Before widget (defined by theme functions file)
            echo $before_widget;

            // Display the widget title if one was input
      //       if ($title) {
      //           echo $before_title . $title . $after_title;
    		// }
            ?>

            <div class="ads_box <?php echo $text_align.' '.$box_style; ?>" style="background-image: url(<?php echo $image; ?>)">
                <div class="ads_inner">
                    <h5 class="ads_title"><?php echo $title; ?></h5>
                    <p class="ads_subtitle"><?php echo $subtitle; ?></p>
                    <a class="mh-button" href="<?php echo $button_url?>"><?php echo $button_text; ?></a>
                </div>
            </div>
    		
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
            $instance['subtitle'] = strip_tags($new_instance['subtitle']);
            $instance['image'] = strip_tags($new_instance['image']);
            $instance['button_text'] = strip_tags($new_instance['button_text']);
            $instance['button_url'] = strip_tags($new_instance['button_url']);
            $instance['box_style'] = strip_tags($new_instance['box_style']);
            $instance['text_align'] = strip_tags($new_instance['text_align']);

            return $instance;
        }

        
        /*  Settings
          ================================================== */

        function form($instance) {

            // Set up some default widget settings
            $defaults = array(
                'title' => 'Ads Widget',
                'subtitle' => '',
                'image' => '',
                'button_text' => '',
                'button_url' => '',
                'box_style' => '',
                'text_align' => ''
            );

            $instance = wp_parse_args((array) $instance, $defaults);
            ?>

            <!-- Widget Input Fields -->
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" type="text" name="<?php echo $this->get_field_name('subtitle'); ?>" value="<?php echo $instance['subtitle']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image URL', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" type="text" name="<?php echo $this->get_field_name('button_text'); ?>" value="<?php echo $instance['button_text']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button URL', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" type="text" name="<?php echo $this->get_field_name('button_url'); ?>" value="<?php echo $instance['button_url']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'box_style' ); ?>"><?php _e('Box Style:', MAHA_TEXT_DOMAIN); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'box_style' ); ?>" name="<?php echo $this->get_field_name( 'box_style' ); ?>">
                    <option value="square" <?php if ($instance['box_style'] == 'square') {echo 'selected="selected"'; } ?>><?php _e('Square', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="rectangle" <?php if ($instance['box_style'] == 'rectangle') {echo 'selected="selected"'; } ?>><?php _e('Rectangle', MAHA_TEXT_DOMAIN); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'Text Align' ); ?>"><?php _e('Text Align :', MAHA_TEXT_DOMAIN); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'text_align' ); ?>" name="<?php echo $this->get_field_name( 'text_align' ); ?>">
                    <option value="left" <?php if ($instance['text_align'] == 'left') {echo 'selected="selected"'; } ?>><?php _e('Left', MAHA_TEXT_DOMAIN); ?></option>
                    <option value="right" <?php if ($instance['text_align'] == 'right') {echo 'selected="selected"'; } ?>><?php _e('Right', MAHA_TEXT_DOMAIN); ?></option>
                </select>
            </p>

            <?php
        }

    }
}


/*  Setup
================================================== */
register_widget('maha_ads');

?>