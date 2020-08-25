<?php
include_once '../../db/index.php';
if(isset($_POST['btn-upload']))
{    
     
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$plg_name = $_REQUEST['plg_name'];
	$plg_date = $_REQUEST['plg_date'];
	$plg_by = $_REQUEST['plg_by'];
	$folder="";
	
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$ins_query="INSERT INTO plugins(`p_link`,`p_name`,`p_ins_date`,`publishedby`) VALUES('$final_file','$plg_name','$plg_date','$plg_by')";
		mysqli_query($con,$ins_query) or die(mysql_error());
		?>
		<script>
		alert('Successfully installed plugin');
        window.location.href='plugin.php?success';
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('Error while installing plugin');
        window.location.href='plugin.php?fail';
        </script>
		<?php
	}
}
?>