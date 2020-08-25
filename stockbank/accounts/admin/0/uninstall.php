<?php

require('../../db/index.php');
$id=$_REQUEST['PLUGIN'];
$file = $_REQUEST['LINK'];
if (!unlink($file))
  {
	  ?>
  <script>
		alert('Error while Un-installing plugin');
        window.location.href='plugin.php?fail_u';
        </script>
<?php
  }
else
  {
$query = "DELETE FROM plugins WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
?>
<script>
		alert('Successfully Uninstalled plugin');
        window.location.href='plugin.php?success_u';
</script> 
<?php
 }
?>