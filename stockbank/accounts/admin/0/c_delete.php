<?php

require('../../db/index.php');
$c_id=$_REQUEST['id'];
$query = "DELETE FROM currency WHERE c_id=$c_id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
header("Location: currency.php"); 
?>