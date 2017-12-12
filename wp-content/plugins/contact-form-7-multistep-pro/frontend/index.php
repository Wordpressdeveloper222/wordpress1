<?php
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
class cf7_multistep_frontend {
    function __construct(){
        add_filter('get_post_metadata', array($this,'getqtlangcustomfieldvalue'), 10, 4);
        add_action("wp_enqueue_scripts",array($this,"add_lib"),1000);
        //add_filter("wpcf7_additional_mail",array($this,"block_send_email"),10,2);
        //add_filter("wpcf7_validate",array($this,"wpcf7_validate"));
    }
    /*
    * Block send email
    */
    function block_send_email($email,$contact_form){
        if( isset( $_POST["_wpcf7_check_tab"] )) {
            $tabs = count ( cf7_multistep_get_setttings($contact_form->id) -1 );
            if( $tabs != $_POST["_wpcf7_check_tab"] ) {
                return true;
            }
        }
    }
    function wpcf7_validate($result){
        $result->invalidate("step","ok");
        return $result;
    }
    /*
    * Add js and css
    */
    function add_lib(){
        wp_enqueue_script("jquery");
        wp_deregister_script("contact-form-7");
        wp_register_script("contact-form-7-custom",CT_7_MULTISTEP_PLUGIN_URL."/frontend/js/cf7.js",array('jquery', 'jquery-form'),WPCF7_VERSION,true);
        wp_enqueue_script("cf7_multistep",CT_7_MULTISTEP_PLUGIN_URL."/frontend/js/cf7-multistep.js");
        wp_enqueue_style("cf7_multistep",CT_7_MULTISTEP_PLUGIN_URL."/frontend/css/cf7-multistep.css");

        $_wpcf7 = array(
    		'recaptcha' => array(
    			'messages' => array(
    				'empty' =>
    					__( 'Please verify that you are not a robot.', 'contact-form-7' ),
    			),
    		),
    	);

    	if ( defined( 'WP_CACHE' ) && WP_CACHE ) {
    		$_wpcf7['cached'] = 1;
    	}

    	if ( wpcf7_support_html5_fallback() ) {
    		$_wpcf7['jqueryUi'] = 1;
    	}

        wp_localize_script( 'contact-form-7-custom', '_wpcf7', $_wpcf7 );
        wp_enqueue_script('contact-form-7-custom');
    }
    /*
    * Custom steps
    */
    function getqtlangcustomfieldvalue($value, $post_id, $meta_key, $single) {
        if( !is_admin() ):
            if( $meta_key == "_form" ){
                $type = get_post_meta( $post_id,"_cf7_multistep_type",true);
                if( $type != 0 && $type){
                    $tabs = cf7_multistep_get_setttings($post_id,true);
                    $last_form = $tabs["check"];
                    unset($tabs["check"]);
                    $count_tab = count($tabs);
                    $settings =  cf7_multistep_get_setttings_stype($post_id);
                    ob_start();
                    ?>
                    <div class="hidden multistep-check">
                    <?php echo $last_form; ?>
                    </div>
                    <input name="_wpcf7_check_tab" value="1" id="wpcf7_check_tab" type="hidden" />
                    <input id="multistep_total" value="<?php echo $count_tab  ?>" type="hidden" />
                    <div class="container-cf7-steps container-cf7-steps-<?php echo $type ?>">
                        <div class="container-multistep-header <?php  if( $type == 6 ) {echo "hidden";}?>">
                            <ul class="cf7-display-steps-container cf7-display-steps-container-<?php echo $type ?>">
                                    <?php
                                    $i=1;
                                    foreach( $tabs as $key=>$value):?>
                                	<li class="<?php if( $i== 1){echo "active"; $key_active = $key; } ?> cf7-steps-<?php echo $i ?>" data-i="<?php echo $i ?>" data-tab=".cf7-tab-<?php echo $i ?>">
                                		<?php _e($key,"woocommerece"); ?>
                                	</li>
                                    <?php
                                    $i++;
                                     endforeach; ?>
                            </ul>
                        </div>
                        <div class="container-body-tab">
                            <?php
                            $i=1;
                            foreach( $tabs as $key=>$value):?>
                            <div class="cf7-tab <?php if( $i!= 1){ echo "hidden";} ?>" id="cf7-tab-<?php echo $i ?>">
                                <div class="cf7-content-tab">
                                    <?php echo preg_replace("#rn#","\n",$value)  ?>
                                </div>
                                <div class="multistep-nav">
                                    <div class="multistep-nav-left">
                                        <?php  if( $i!=1): ?>
                                        <a href="#" class="multistep-cf7-prev"><?php _e($settings["multistep_cf7_steps_prev"],"woocommerce");  ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="multistep-nav-right">
                                        <?php if( $count_tab != $i ): ?>

                                        <a href="#" class="multistep-cf7-next"><?php _e($settings["multistep_cf7_steps_next"],"woocommerce");  ?> <span class="ajax-loader hidden"></span></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                    <style type="text/css">
                     .cf7-display-steps-container li {
                            background: <?php echo $settings["multistep_cf7_steps_background"] ?>;
                            color: <?php echo $settings["multistep_cf7_steps_color"] ?>;
                        }
                        .multistep_cf7_steps_color li.active{
                            background: <?php echo $settings["multistep_cf7_steps_inactive_background"] ?>;
                            color: <?php echo $settings["multistep_cf7t_steps_inactive"] ?>;
                        }
                        .cf7-display-steps-container li.enabled {
                            background: <?php echo $settings["multistep_cf7t_steps_completed_backgound"] ?>;
                            color: <?php echo $settings["multistep_cf7_steps_completed"] ?>;
                        }
                        .multistep-nav a{
                            background: <?php echo $settings["multistep_cf7_steps_background"] ?>;
                            color: <?php echo $settings["multistep_cf7_steps_color"] ?>;
                            padding: 5px 15px;
                            text-decoration: none;
                        }
                        .multistep-nav {
                                display: flex;
                                margin: 30px 0;
                        }
                        .multistep-nav div {
                            width: 100%;
                        }
                        .multistep-nav-right {
                            text-align: right;
                        }
                    </style>
                    <?php
                    $value = ob_get_clean();
                }
            }
         endif;
             return $value;
    }

}
new cf7_multistep_frontend;