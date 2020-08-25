<?php
error_reporting(0);
ini_set('display_errors', 0);
include('../../core/settings.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts a, users u where a.usr_id LIKE '$u_id' and u.uss_id LIKE '$u_id' ORDER BY u.uss_id;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {
// identifier
$usr_id = $row["usr_id"];
$l_id=$row['id'];

// account info
$us_type=$row['account_type'];
$us_acc=$row['account_no'];
$us_ball=$row["account_balance"];
$acc_status=$row["account_status"];
$acc_date=$row['account_opening_date'];
$acc_fmode=$row['funding_mode'];

// basic info
$us_title=$row["title"];
$us_first=$row['first_name'];
$us_last=$row['last_name'];
$us_other=$row["other_name"];
$us_email=$row["email"];
$us_phone=$row['phone'];
$us_stradd=$row['street_address'];
$us_city=$row['city'];
$us_state=$row['state'];
$us_country=$row['country'];
$us_zip=$row['zip_code'];
$us_dob=$row['dob'];
$us_company=$row['company'];
$us_ssn=$row['ssn'];




$ac_bal = number_format($us_ball, 2);
} else {
	$usr_id = "NULL-E3000";
}

 ?>