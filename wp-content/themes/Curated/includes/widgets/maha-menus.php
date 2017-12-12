<?php
/* --------------------------------------------------------------------------

    A ThemeMaha Framework - Copyright (c) 2014

    - Ads

 ---------------------------------------------------------------------------*/


if ( ! class_exists( 'maha_menus' ) ) { 
    class maha_menus extends WP_Widget {
        
        /*  Setup
          ================================================== */

        function __construct() {

            // Widget settings
            $widget_ops = array(
                'classname' => 'widget_menus',
                'description' => __('Display Navigation.', MAHA_TEXT_DOMAIN)
            );

            // Widget control settings
            $control_ops = array(
                'id_base' => 'maha_menus'
            );

            // Create the widget
            parent::__construct('maha_menus', wp_get_theme()->get('Name').__(' - Custom Navigation', MAHA_TEXT_DOMAIN), $widget_ops, $control_ops);
        }

        /*  Display
          ================================================== */

        function widget($args, $instance) {

            extract($args);

            // Our variables from the widget settings
            $title = apply_filters('widget_title', $instance['title']);
            $nav = $instance['nav'];

            // Before widget (defined by theme functions file)
            echo $before_widget;

            // Display the widget title if one was input
            if ($title) {
                echo $before_title . $title . $after_title;
            }
            
            $nav_menus_items = wp_get_nav_menu_items($nav);
            // echo count($nav_menus_items);
            if ( count($nav_menus_items) > 0 ) {
                echo '<ul>';
                foreach ($nav_menus_items as $key => $v_nav) {
                    echo '<li><a href="'.$v_nav->url.'">'.$v_nav->title.'</a></li>';
                }
                echo '</ul>';
            }
    		
            // After widget (defined by theme functions file)
            echo $after_widget;
        }

        
        /*  Update
          ================================================== */

        function update($new_instance, $old_instance) {
            $instance = $old_instance;

            // Strip tags to remove HTML (important for text inputs)
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['nav'] = strip_tags($new_instance['nav']);

            return $instance;
        }

        
        /*  Settings
          ================================================== */

        function form($instance) {

            // Set up some default widget settings
            $defaults = array(
                'title' => 'Menus Widget',
                'nav' => ''
            );

            $instance = wp_parse_args((array) $instance, $defaults);
            ?>

            <!-- Widget Input Fields -->
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', MAHA_TEXT_DOMAIN) ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'nav' ); ?>"><?php _e('Nav:', MAHA_TEXT_DOMAIN); ?></label>
                <?php $menus = get_terms('nav_menu', array( 'hide_empty' => false ) ); ?>
                <select class="widefat" id="<?php echo $this->get_field_id( 'nav' ); ?>" name="<?php echo $this->get_field_name( 'nav' ); ?>">
                <?php
                foreach($menus as $menu){
                    ?><option value="<?php echo $menu->term_id; ?>" <?php if ($instance['nav'] == $menu->term_id ) {echo 'selected="selected"'; } ?>><?php echo $menu->name; ?></option><?php
                } 
                ?>
                </select>
            </p>

            <?php
        }

    }
}


/*  Setup
================================================== */
register_widget('maha_menus');

?>