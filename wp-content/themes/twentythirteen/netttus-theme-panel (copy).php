<?php

$themename = "Nettuts";
$shortname = "nt";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array(); 
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 
$a= $_POST["nt_footer_text'"];
$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 
array( "name" => "import ",
	"desc" => "",
	"id" => $shortname."_import",
	"type" => "import",
	"std" => ""),			
	
array( "name" => "export ",
	"desc" => "",
	"id" => $shortname."_export",
	"type" => "export",
	"std" => ""),		

array( "name" => "General",
	"type" => "section"),
array( "type" => "open"),
 
 array( "name" => "Colour Scheme",
	"desc" => "Select the colour scheme for the theme",
	"id" => $shortname."_color_scheme",
	"type" => "select",
	"options" => array("blue", "red", "green"),
	"std" => $_REQUEST[($shortname."_color_scheme")]),
	
array( "name" => "Logo URL",
	"desc" => "Enter the link to your logo image",
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => ""),
	
	
array( "name" => "Custom CSS",
	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" =>  $_REQUEST[($shortname."_custom_css")]),
	
array( "name" => "Logo ",
	"desc" => "Upload logo image",
	"id" => $shortname."_site_logo",
	"type" => "upload",
	"std" =>  $_REQUEST[($shortname."_site_logo")]),	
	
array( "name" => "Logo  Preview",
	"desc" => " logo image",
	"id" => $shortname."_preview_logo",
	"type" => "preview",
	"std" => ""),			
	
array( "name" => "Delete logo ",
	"desc" => "Delete logo",
	"id" =>  $shortname."_delete_logo",
	"type" => "delete"),	

	array( "name" => "Flip Switch",
	"desc" => "On/Off Switch",
	"id" =>  $shortname."_switch",
	"type" => "checkbox",	
	"std" =>  $_REQUEST[($shortname."_switch")]),			
	
array( "name" => "Radio button",
	"desc" => "radio button",
	"id" =>  $shortname."_radio",
	"type" => "radio",	
	"std" => $_REQUEST[($shortname."_radio")]),

	
array( "type" => "close"),
array( "name" => "Homepage",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Homepage header image",
	"desc" => "Enter the link to an image used for the homepage header.",
	"id" => $shortname."_header_img",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Homepage featured category",
	"desc" => "Choose a category from which featured posts are drawn",
	"id" => $shortname."_feat_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" =>   $_REQUEST[($shortname."_feat_cat")]),	
	

array( "type" => "close"),
array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => $shortname."_footer_text",
	"type" => "text",
	"std" =>  $_REQUEST[($shortname."_footer_text")]),
	
array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => $_REQUEST[($shortname."_ga_code")]),
	
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => get_bloginfo('url') ."/favicon.ico"),	
	
array( "name" => "Feedburner URL",
	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),

 
array( "type" => "close")
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {

  if(isset($_POST["nt_delete_logo"]))
 {
	//  echo '<pre>'; print_r($options);exit;
	$image = get_option('nt_site_logo');
	$url = esc_url($image);
	delete_image1($image);
	header("Location: admin.php?page=netttus-theme-panel.php&delete=true");
	die;
 } 
 
 if(isset($_POST["export"]))
 { 
//echo $a= get_settings["nt_footer_text'"]; 
  /*$content = "<!*!* START export Code !*!*>\n".(serialize($options))."\n<!*!* END export Code !*!*>";
    $file_name = 'theme_export.txt';
    header('HTTP/1.1 200 OK');


    if ( !current_user_can('edit_themes') ) {
        wp_die('<p>'.__('You do not have sufficient permissions to edit templates for this site.').'</p>');
    }
    if ($content === null || $file_name === null){
        wp_die('<p>'.__('Error Downloading file.').'</p>');     
    }
    $fsize = strlen($content);
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Description: File Transfer');
    header("Content-Disposition: attachment; filename=" . $file_name);
    header("Content-Length: ".$fsize);
    header("Expires: 0");
    header("Pragma: public");
    echo $content;
exit();*/
	
	$filename = 'theme_export.csv';
	$delimiter=";";
	header('Content-Type: application/csv; charset=utf-8' );
	header('Content-Disposition: attachment; filename="'.$filename.'";');

    // open the "output" stream
    // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
	$f = fopen('php://output', 'w');
	 foreach ($options as $line) {
	        fputcsv($f, $line);
	 } exit;
	 header('Location:admin.php?page=netttus-theme-panel.php&export=true');
 }
 
 


	if ( 'save' == $_REQUEST['action'] ) { 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=netttus-theme-panel.php&saved=true");
die;
 
} 

else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=netttus-theme-panel.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}



function delete_image1($image_url)
{
	global $wpdb;
	
	// We need to get the image's meta ID..
	echo $query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";   
	$results = $wpdb -> get_results($query);

	// And delete them (if more than one attachment is in the Library
	foreach ( $results as $row ) {
		wp_delete_attachment( $row -> ID );
	}	
}
function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');

wp_register_script( 'wptuts-upload', get_template_directory_uri() .'/js/upload-media.js', array('jquery','media-upload','thickbox') );	
wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('wptuts-upload');
		
wp_enqueue_style("functions", $file_dir."/theme-options/functions.css", false, "1.0", "all");
//wp_enqueue_script("rm_script", $file_dir."/theme-options/rm_script.js", false, "1.0");
wp_enqueue_script("test", $file_dir."/theme-options/test.js", false, "1.0");


}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
if ( $_REQUEST['import'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings .</strong></p></div>';
 if ( $_REQUEST['delete'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' Logo deleted.</strong></p></div>';
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post" enctype="multipart/form-data">
	<input name="import_file" type="file" value="Import file" id="import"/>
	<input name="import" type="submit" value="Import" id="import"/>
</form>
<form method="post" >
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;


 case "export":
?>
<input name="export" type="submit" value="Export" id="export"/>

<?php break;
 
 /*case "import":
 ?>
 <input name="import_file" type="file" value="Import file" id="import"/>
<input name="import" type="submit" value="Import" id="import"/>
 <?php break;*/
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">

<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" >
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php

break;
 
 case 'upload': 
?>

<div class="rm_upload">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input type="hidden" id="logo_url" name="<?php echo $value['id'] ?>" value="<?php echo get_option('nt_site_logo')?>" />
		<input id="upload_logo_button" type="button" class="button" value= "Upload Logo " />
		<?php if ( '' != $value['id'] ): ?>
			<!--input id="delete_logo_button" name="delete_logo" type="submit" class="button" value= "Delete Logo" /-->
		<?php endif; ?>	
		<br/>
		<!--abel> Logo Preview</label-->
		<!--img src=<?php //echo get_option('nt_site_logo')?> /-->
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div> 
 
<?php 
break;

case 'preview':
?>
<div class="rm_upload"> 
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<div id="upload_logo_preview" style="min-height: 100px;">
	<?php $image = get_option('nt_site_logo');
	$url = esc_url($image); ?>
	<img src=<?php echo $url;?> />
</div>	
</div>
<?php
break;

 case 'delete': 
?>

<div class="rm_delete">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
		<p class="submit">	<input id="delete_logo_button" name="<?php echo $value['id'] ?>" type="submit"  value= "Delete Logo" />
			   <input type="hidden" name="action" value="nt_delete_logo" /></p>
			   <!--input type="text" name="text" id="text1"/-->
 </div> 
 
<?php 
break;

case "checkbox":
?>

<div class="rm_switch">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){
	$checked = "checked=\"checked\"";
	$values = "yes"; 
	}
	else{ $checked = "";$values = "no";} 

	?>
<input type="checkbox" name="<?php echo $value['id']; ?>" class="onoffswitch-checkbox" id="myonoffswitch" value="<?php echo $values; ?>" <?php echo $checked; ?> />

	<?php ?>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 

case "radio":
?>
<div class="rm_switch">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php
$skins =array("Volvo","BMW","Toyota");
$count = sizeof($skins);
$myplug_options = get_option($value['id']);
for($x=0; $x<$count; $x++ ) {
?>  
<?php echo $skins[$x]; ?><input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $skins[$x]; ?>" <?php checked($skins[$x], $myplug_options); ?> />
<?php  } ?>  
<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 

case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.gif" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes"   id="submit_options_form"/>

</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" id="reset"/>
<input type="hidden" name="action" value="reset" />
</p>
</form>

<div style="font-size:9px; margin-bottom:10px;">Icons: <a href="http://www.woothemes.com/2009/09/woofunction/">WooFunction</a></div>
 </div> 
 

<?php
} 
 
?>
<?php
if(isset($_POST["import"]))
{
// print_r($options);
//$imported_settings = unserialize($_REQUEST['import_file']);
//$imported_settings1 = $_REQUEST['import_file'];
//$fp = fopen($imported_settings1, 'r');
//$var = file_get_contents($imported_settings1, true);
$filename=$_FILES["import_file"]["tmp_name"];
if($_FILES["import_file"]["size"] > 0)
 {
 $file = fopen($filename, "r"); 
 //$csv = array_map('str_getcsv', file($filename)); echo '<pre>'; print_r($csv);
 while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
         {

        //   echo '<pre>';print_r($emapData);	    //echo $emapData[4]; 
		   //	  print_r($options);
		 	  foreach ($options as $value) {
				  print_r($value); 
			// echo '<pre>';print_r($value['std']);   print_r($emapData[4]);
	//		update_option($value['std'], $emapData[2]);
				update_option($value['nt_footer_text'] , 'hey'); //echo $value['nt_footer_text']; 
		  }
         }

         fclose($file);
         echo "CSV File has been successfully Imported";
		 
 }
 else{
 echo "Invalid File:Please Upload CSV File";
 }



?>
	<script>
	//	alert('<?php print_r($filename); ?>');
	//	alert('<?php print_r($file); ?>');
		</script>	<?php 
// exit;
//  header('Location:admin.php?page=netttus-theme-panel.php&import=true');
 } ?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>