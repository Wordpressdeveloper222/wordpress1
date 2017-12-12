<?php 
include('wp-config.php');
$id= $_POST['id'];
$title = $_POST['title'];
$name = $_POST['name'];
 global $wpdb;
  $sel = "SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'faqs' AND post_status = 'publish' ORDER BY menu_order ASC";
$rw2 = $wpdb->get_results($sel,OBJECT);
 foreach($rw2 as $rws) {
	 $ids = $rws->ID;
	  $name = $rws->post_name;
  ?>
  <input type="button" name="faqs" id="title" value="<?php echo $rws->post_title;  ?>" onclick="return faqs(<?php echo $ids ;?>,'<?php echo  $name; ?>') ">
 
  <span id="content"></span>
  <div class="loader" id="loader" style="display:none;"><img src="http://www.wpenlight.com/wp-content/uploads/2017/03/loader.gif"></div> 
<?php 

 }
   $sel = "SELECT * FROM wp_posts WHERE post_type = 'faqs' AND  ID = '" .$id."' ";
$rw2 = $wpdb->get_results($sel,OBJECT);
 foreach($rw2 as $rws) {
	
 
   echo $rws->post_title;  
   echo "<br/>";
	echo $rws->post_content;  

 } 
 


?>