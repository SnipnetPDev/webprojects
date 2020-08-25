<?php
error_reporting(0);
ini_set('display_errors', 0);
include('core/settings.php');
$imageU = $_SESSION['imgname'];
$image_src = "img/profile/".$imageU;
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {
$usr_id = $row["usr_id"];
$l_id=$row['id'];
$us_type=$row['account_type'];
$us_title=$row["title"];
$us_email=$row["email"];
$us_first=$row['first_name'];
$us_last=$row['last_name'];
$us_other=$row["other_name"];
$us_phone=$row['phone'];
$us_acc=$row['account_no'];
$us_ball=$row["account_balance"];
$acc_status=$row["account_status"];

$ac_bal = number_format($us_ball, 2);
} else {
	$usr_id = "NULL-E3000";
}

 ?>