<?php

global $wpdb;
$popups  = defined('SG_APP_POPUP_FILES') ? (array)$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."sg_popup",OBJECT_K) : array();
$options = get_site_option('worldcountrieshtml5map_options');
$option_keys = is_array($options) ? array_keys($options) : array();
$map_id  = (isset($_REQUEST['map_id'])) ? intval($_REQUEST['map_id']) : array_shift($option_keys) ;

$states  = $options[$map_id]['map_data'];
$states  = json_decode($states, true);

$sId = isset($_GET['s_id']) ? $_GET['s_id'] : false;

if(isset($_POST['act_type']) && $_POST['act_type'] == 'worldcountries-html5-map-states-save') {

    if($sId)
    {
        $s_id = 'st'.$sId;
        $vals = $states[$s_id];
        if(isset($_POST['name'][$vals['id']]))
            $states[$s_id]['name'] = stripslashes($_POST['name'][$vals['id']]);

        if(isset($_POST['shortname'][$vals['id']])) {
            $states[$s_id]['shortname'] = stripslashes($_POST['shortname'][$vals['id']]);
        }

        if(isset($_POST['URL'][$vals['id']]))
            $states[$s_id]['link'] = esc_url(stripslashes($_POST['URL'][$vals['id']]), null, 'url');

        if ($states[$s_id]['link'])
            $states[$s_id]['isNewWindow'] = isset($_POST['isNewWindow'][$vals['id']]) ? 1 : 0;
        else
            unset($states[$s_id]['isNewWindow']);

        if(isset($_POST['info'][$vals['id']]))
            $states[$s_id]['comment'] = wp_kses_post(stripslashes($_POST['info'][$vals['id']]));

        if(isset($_POST['image'][$vals['id']]))
            $states[$s_id]['image'] = sanitize_text_field($_POST['image'][$vals['id']]);

        if(isset($_POST['color'][$vals['id']]))
            $states[$s_id]['color_map'] = sanitize_text_field($_POST['color'][$vals['id']][0] == '#' ? $_POST['color'][$vals['id']] : '#' . $_POST['color'][$vals['id']]);

        if(isset($_POST['color_'][$vals['id']]))
            $states[$s_id]['color_map_over'] = sanitize_text_field($_POST['color_'][$vals['id']][0] == '#' ? $_POST['color_'][$vals['id']] : '#' . $_POST['color_'][$vals['id']]);

        if(isset($_POST['descr'][$vals['id']]))
            $options[$map_id]['state_info'][$vals['id']] = wp_kses_post(stripslashes($_POST['descr'][$vals['id']]));
        if(isset($_POST['popup-id']))
            $states[$s_id]['popup-id'] = intval($_POST['popup-id']);
        if(isset($_POST['_hide_name'][$vals['id']]))
            $states[$s_id]['_hide_name'] = 1;
        else
            unset($states[$s_id]['_hide_name']);

        if(isset($_POST['colorSimpleCh'][$vals['id']])) {
        foreach($states as $k=>$v) {
            $states[$k]['color_map'] = sanitize_text_field($_POST['color'][$vals['id']][0] == '#' ? $_POST['color'][$vals['id']] : '#' . $_POST['color'][$vals['id']]);
        }
        }

        if(isset($_POST['colorOverCh'][$vals['id']])) {
        foreach($states as $k=>$v) {
            $states[$k]['color_map_over'] = sanitize_text_field($_POST['color_'][$vals['id']][0] == '#' ? $_POST['color_'][$vals['id']] : '#' . $_POST['color_'][$vals['id']]);
        }
        }

    }

    $options[$map_id]['map_data'] = json_encode($states);

    update_site_option('worldcountrieshtml5map_options', $options);
}



echo "<div class=\"wrap\"><h2>" . __('Configuration of Map Areas', 'worldcountries-html5-map') . "</h2>";
?>
<script>
    var imageFieldId = false;
    jQuery(function(){

        jQuery('select[name=map_id],select[name=state_select]').change(function() {

            if (jQuery(this).attr('name')=='map_id') {
                s_id = 0;
            } else {
                s_id = jQuery('select[name=state_select] option:selected').val();
            }
            location.href='admin.php?page=worldcountries-html5-map-states&map_id='+jQuery('select[name=map_id] option:selected').val()+'&s_id='+s_id;
        });

        jQuery('.tipsy-q').tipsy({gravity: 'w'}).css('cursor', 'default');

        jQuery('.color~.colorpicker').each(function(){
            var me = this;

            jQuery(this).farbtastic(function(color){

                var textColor = this.hsl[2] > 0.5 ? '#000' : '#fff';

                jQuery(me).prev().prev().css({
                    background: color,
                    color: textColor
                }).val(color);

                if(jQuery(me).next().find('input').attr('checked') == 'checked') {
                    return;
                    var dirClass = jQuery(me).prev().prev().hasClass('colorSimple') ? 'colorSimple' : 'colorOver';

                    jQuery('.'+dirClass).css({
                        background: color,
                        color: textColor
                    }).val(color);
                }

            });

            jQuery.farbtastic(this).setColor(jQuery(this).prev().prev().val());

            jQuery(jQuery(this).prev().prev()[0]).bind('change', function(){
                jQuery.farbtastic(me).setColor(this.value);
            });

            jQuery(this).hide();
            jQuery(this).prev().prev().bind('focus', function(){
                jQuery(this).next().next().fadeIn();
            });
            jQuery(this).prev().prev().bind('blur', function(){
                jQuery(this).next().next().fadeOut();
            });
        });

        jQuery('.stateinfo input:radio').click(function(){
            var el_id = jQuery(this).attr('id').substring(1);
            if(jQuery(this).attr('id').charAt(0)=='n'){
                jQuery("#URL"+el_id).val("");
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
                jQuery("#statePopup"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='u'){
                jQuery("#URL"+el_id).val("http://");
                //jQuery("#URL"+el_id).attr("readonly", false);
                jQuery("#stateURL"+el_id).fadeIn(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
                jQuery("#statePopup"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='m'){
                jQuery("#URL"+el_id).val("#info");
                //jQuery("#URL"+el_id).attr("readonly", false);
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#statePopup"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeIn(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='p'){
                jQuery("#URL"+el_id).val("#popup");
                jQuery("#stateURL"+el_id).fadeOut(0)
                jQuery("#stateDescr"+el_id).fadeOut(0);
                jQuery("#statePopup"+el_id).fadeIn(0);
            }
        });

        jQuery('.colorSimpleCh').bind('click', function(){
            if(this.checked) {
                jQuery('.colorSimpleCh').attr('checked', false);
                this.checked = true;
            }
        });

        jQuery('.colorOverCh').bind('click', function(){
            if(this.checked) {
                jQuery('.colorOverCh').attr('checked', false);
                this.checked = true;
            }
        });

        window.send_to_editorArea = window.send_to_editor;

        window.send_to_editor = function(html) {
            if(imageFieldId === false) {
                window.send_to_editorArea(html);
            }
            else {
                var imgurl = jQuery('img',html).attr('src');

                jQuery('#'+imageFieldId).val(imgurl);
                imageFieldId = false;

                tb_remove();
            }

        }
        if (typeof tinyMCE !== 'undefined') tinyMCE.execCommand('mceAddControl', true, 'descr'+this.value)
<?php if($sId) { ?>
        jQuery('input[type=submit]').attr('disabled',false);
<?php } ?>

    });

    function clearImage(f) {
        jQuery(f).prev().val('');
    }

    function adjustSubmit() {
        if(jQuery('.colorOverCh:checked').length > 0) {
            var ch = jQuery('.colorOverCh:checked')[0];
            var color = jQuery(ch).parent().prev().prev().prev().val();
            jQuery('.colorOver').val(color);
        }

        if(jQuery('.colorSimpleCh:checked').length > 0) {
            var ch = jQuery('.colorSimpleCh:checked')[0];
            var color = jQuery(ch).parent().prev().prev().prev().val();
            jQuery('.colorSimple').val(color);
        }
    }
</script>
<br />
<form method="POST" class="worldcountries-html5-map main" onsubmit="adjustSubmit()">
    <span class="title"><?php echo __('Select a map:', 'worldcountries-html5-map'); ?> </span>
    <select name="map_id" style="width: 185px;">
        <?php foreach($options as $id => $map_data) { ?>
            <option value="<?php echo $id; ?>" <?php echo ($id==$map_id)?'selected':'';?>><?php echo $map_data['name']; ?></option>
        <?php } ?>
    </select>
    <span class="tipsy-q" original-title="<?php esc_attr_e('The map', 'worldcountries-html5-map'); ?>">[?]</span>
    <a href="admin.php?page=worldcountries-html5-map-maps" class="page-title-action"><?php
    _e('Maps list', 'worldcountries-html5-map') ?></a>
    <br /><br />

    <?php worldcountries_html5map_plugin_nav_tabs('states', $map_id); ?>

    <p><?php echo __('This tab allows you to add the area-specific information and adjust colors of individual area on the map.', 'worldcountries-html5-map'); ?></p>
    <p class="help"><?php echo __('* The term "area" means one of the following: region, state, country, province, county or district, depending on the particular plugin.', 'worldcountries-html5-map'); ?></p>

    <select name="state_select">
        <option value=0><?php echo __('Select an area', 'worldcountries-html5-map'); ?></option>
        <?php

        foreach($states as $s_id=>$vals)
        {
            ?>
            <option value="<?php echo $vals['id']?>" <?php echo $sId == $vals['id'] ? ' selected' : ''?>><?php echo preg_replace('/^\s?<!--\s*?(.+?)\s*?-->\s?$/', '\1', $vals['name']); ?></option>
            <?php
        }
        ?>
    </select>


    <div style="clear: both; height: 30px;"></div>


    <?php

    if($sId) {
        $vals        = $states['st'.$sId];
        $rad_nill    = "";
        $rad_url     = "";
        $rad_more    = "";
        $rad_popup   = "";
        $style_input = "";
        $style_area  = "";
        $style_popup = "";

        $mce_options = array(
            //'media_buttons' => false,
            'editor_height'   => 150,
            'textarea_rows'   => 20,
            'textarea_name'   => "descr[{$vals['id']}]",
            'tinymce' => array(
                'add_unload_trigger' => false,
            )
        );

        $vals['shortname'] = str_replace("\n",'\n',$vals['shortname']);

        if(trim($vals['link']) == "") $rad_nill = "checked";
        elseif(stripos($vals['link'], "#popup") !== false ) $rad_popup = "checked";
        elseif(stripos($vals['link'], "javascript:worldcountrieshtml5map_set_state_text") !== false OR $vals['link'] == '#info') $rad_more = "checked";
        else $rad_url = "checked";

        if($rad_url != "checked") $style_input = "display: none;";
        if($rad_more != "checked") $style_area = "display: none;";
        if($rad_popup!="checked") $style_popup = "display: none;";

    ?>

    <fieldset>
        <legend><?php echo __('Map area', 'worldcountries-html5-map'); ?></legend>

        <div style="" id="stateinfo-<?php echo $vals['id']?>" class="stateinfo">
        <span class="title"><?php echo __('Name:', 'worldcountries-html5-map'); ?> </span><input class="" type="text" name="name[<?php echo $vals['id']?>]" value="<?php echo $vals['name']?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Name of Area', 'worldcountries-html5-map'); ?>">[?]</span>
        <label style="padding-left: 20px"><input type="checkbox" name="_hide_name[<?php echo $vals['id']?>]" <?php echo isset($vals['_hide_name']) ? 'checked="checked"' : '' ?>>
        <?php echo __('do not show popup name', 'worldcountries-html5-map'); ?>
        </label>
        <div class="clear"></div>

        <span class="title"><?php echo __('Shortname:', 'worldcountries-html5-map'); ?> </span><input class="" type="text" name="shortname[<?php echo $vals['id']?>]" value="<?php echo $vals['shortname']?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Shortname of Area', 'worldcountries-html5-map'); ?>">[?]</span>
        <div class="clear"></div>

        <span class="title"><?php echo __('What to do when the area is clicked:', 'worldcountries-html5-map'); ?></span>
        <label><input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="n<?php echo $vals['id']?>" value="nill" <?php echo $rad_nill?> autocomplete="off">&nbsp;<?php echo __('Nothing', 'worldcountries-html5-map'); ?></label> <span class="tipsy-q" original-title="<?php esc_attr_e('Do not react on mouse clicks', 'worldcountries-html5-map'); ?>">[?]</span>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="u<?php echo $vals['id']?>" value="url" <?php echo $rad_url?> autocomplete="off">&nbsp;<?php echo __('Open a URL', 'worldcountries-html5-map'); ?></label> <span class="tipsy-q" original-title="<?php esc_attr_e('A click on this area opens a specified URL', 'worldcountries-html5-map'); ?>">[?]</span>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="m<?php echo $vals['id']?>" value="more" <?php echo $rad_more?> autocomplete="off">&nbsp;<?php echo __('Show more info', 'worldcountries-html5-map'); ?></label> <span class="tipsy-q" original-title="<?php esc_attr_e('Displays a side-panel with additional information (contacts, addresses etc.)', 'worldcountries-html5-map'); ?>">[?]</span>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="p<?php echo $vals['id']?>" value="popup-builder" <?php echo $rad_popup?> autocomplete="off" <?php echo (!count($popups)) ? "disabled" : ""; ?>>&nbsp;<?php echo __('Show lightbox popup', 'worldcountries-html5-map'); ?></label> <span class="tipsy-q" original-title="<?php esc_attr_e('Show lightbox popup, that you are can create with the plugin "Popup Builder". To activate this option, install the "Popup Builder" plugin, then switch to it and create a new popup there. Then, you should open this tab again and specify the name of the created popup here.', 'worldcountries-html5-map'); ?>">[?]</span><br />
        <div style="<?php echo $style_input; ?>" id="stateURL<?php echo $vals['id']?>">
            <span class="title"><?php echo __('URL:', 'worldcountries-html5-map'); ?> </span><input style="width: 240px;" class="" type="text" name="URL[<?php echo $vals['id']?>]" id="URL<?php echo $vals['id']?>" value="<?php echo $vals['link']?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The landing page URL', 'worldcountries-html5-map'); ?>">[?]</span>&nbsp;&nbsp;&nbsp;
            <label><input type="checkbox" name="isNewWindow[<?php echo $vals['id']?>]" <?php if (!empty($vals['isNewWindow'])) echo 'checked="checked" '; ?>/> <?php echo __('Open url in a new window', 'worldcountries-html5-map'); ?></label></br>
        </div>

        <div style="<?php echo $style_area; ?>" id="stateDescr<?php echo $vals['id']?>"><br />
            <span class="title"><?php echo __('Description:', 'worldcountries-html5-map'); ?> <span class="tipsy-q" original-title="<?php esc_attr_e('The description is displayed to the right of the map and contains contacts or some other additional information', 'worldcountries-html5-map'); ?>">[?]</span> </span>
            <?php wp_editor($options[$map_id]['state_info'][$vals['id']], 'descr'.$vals['id'], $mce_options); ?>
            <!--textarea style="width: 100%" class="" rows="10" cols="45" id="descr<?php echo $vals['id']?>" name="descr[<?php echo $vals['id']?>]"><?php echo $options[$map_id]['state_info'][$vals['id']];  ?></textarea--></br>
        </div>

        <div style="<?php echo $style_popup; ?>" id="statePopup<?php echo $vals['id']?>"><br />
            <span class="title"><?php echo __('Select lightbox popup:', 'worldcountries-html5-map'); ?> </span>
            <select name="popup-id">
                <?php foreach($popups as $popup) { ?>
                <option value="<?php echo $popup->id; ?>" <?php echo ($vals['popup-id']==$popup->id) ? "selected" : ""; ?>><?php echo $popup->title; ?> - <?php echo $popup->type; ?></option>
                <?php } ?>
            </select>
        </div>
        <br />
        <span class="title"><?php echo __('Info for tooltip balloon:', 'worldcountries-html5-map'); ?> <span class="tipsy-q" original-title="<?php esc_attr_e('Info for tooltip balloon', 'worldcountries-html5-map'); ?>">[?]</span> </span><textarea style="width:100%; height: 150px;" class="" rows="10" cols="45" name="info[<?php echo $vals['id']?>]"><?php echo $vals['comment']?></textarea><br />
        <?php
        if(1) // just disable if((int)$tariff == 2)
        {
            ?>
            <span class="title"><?php echo __('Area color:', 'worldcountries-html5-map'); ?> </span><input class="color colorSimple" type="text" name="color[<?php echo $vals['id']?>]" value="<?php echo $vals['color_map']?>" style="background-color: #<?php echo $vals['color_map']?>"  />
            <span class="tipsy-q" original-title='<?php esc_attr_e('The color of an area.', 'worldcountries-html5-map'); ?>'>[?]</span><div class="colorpicker"></div>
            <label><input name="colorSimpleCh[<?php echo $vals['id']?>]" class="colorSimpleCh" type="checkbox" /> <?php echo __('Apply to all areas', 'worldcountries-html5-map'); ?></label>
            <br />
            <span class="title"><?php echo __('Area hover color:', 'worldcountries-html5-map'); ?> </span><input class="color colorOver" type="text" name="color_[<?php echo $vals['id']?>]" value="<?php echo $vals['color_map_over']?>" style="background-color: #<?php echo $vals['color_map_over']?>"  />
            <span class="tipsy-q" original-title='<?php echo __('The color of an area when the mouse cursor is over it.', 'worldcountries-html5-map'); ?>'>[?]</span><div class="colorpicker"></div>
            <label><input name="colorOverCh[<?php echo $vals['id']?>]" class="colorOverCh" type="checkbox" /> <?php echo __('Apply to all areas', 'worldcountries-html5-map'); ?></label>
            <br />
            <?php
        }

        ?>
        <!--<span class="title">Frame: </span><input class="" type="text" name="frame[<?php echo $vals['id']?>]" value="<?php echo $vals['frame']?>" /><br />-->
        <span class="title"><?php echo __('Image URL:', 'worldcountries-html5-map'); ?> </span>
            <input onclick="imageFieldId = this.id; tb_show('Image', 'media-upload.php?type=image&tab=library&TB_iframe=true');" class="" type="text" id="image-<?php echo $vals['id']?>" name="image[<?php echo $vals['id']?>]" value="<?php echo $vals['image']?>" />
            <span style="font-size: 10px; cursor: pointer;" onclick="clearImage(this)"><?php echo __('clear', 'worldcountries-html5-map'); ?></span>
        <span class="tipsy-q" original-title="<?php esc_attr_e('The path to file of the image to display in a popup', 'worldcountries-html5-map'); ?>">[?]</span><br />
        </div>

    </fieldset>
        <?php
    }
    ?>

    <input type="hidden" name="act_type" value="worldcountries-html5-map-states-save" />
    <p class="submit"><input type="submit" value="<?php esc_attr_e('Save Changes', 'worldcountries-html5-map'); ?>" class="button-primary" id="submit" name="submit" disabled="disabled"></p>
</form>
</div>
