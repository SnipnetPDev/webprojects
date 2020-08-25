<?php

require('../../db/index.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM accounts WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error());
header("Location: home.php"); 
?>