<?php
if(isset($_post["field_5"]["type"]))
{

$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ( ($_FILES["file"]["size"] < 100000000))//Approx. 100kb files can be uploaded.

{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
	}
	else
	{
		if (file_exists("upload/" . $_FILES["file"]["name"])) 
		{
		echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
		}
		else
		{
				$upload_dir = "upload";
				$plugin_dir = WP_PLUGIN_DIR . '/' . advanced-task-manager;
				$plugin_url = WP_PLUGIN_URL . '/' . advanced-task-manager;
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath =  $plugin_dir . "/" . $upload_dir; // Target path where file is to be stored
				echo'$targetPath';
				
				
		}
	}
}
else
{
	echo "<span id='invalid'>***Invalid file Size***<span>";
}
}
else{echo 'Failed';}
	
		
		
		
	


	
	?>