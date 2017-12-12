<html>
<head>
</head>
<form method="post" id="taskform" enctype="multipart/form-data">
    <p><label for="body">Select a file</label><input type="file" name="file" id="myFile">
	   <input type="submit" value="Submit Info" name="commit" id="message_submit" /> 
</form>
<body>
<?php
if(isset($_POST["commit"]))
{
 $a = $_FILES["file"];
 print_r($a);
}
?>
</body>
</html>