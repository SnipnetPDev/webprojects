<?php
 
require('../../db/index.php');

$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$def_pam =1;
$usr_id =$_REQUEST['usr_id'];
$usr_phone =$_REQUEST['usr_phone'];
$usr_email =$_REQUEST['usr_email'];
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$other_name = $_REQUEST['other_name'];
$street_address = $_REQUEST['street_address'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$country = $_REQUEST['country'];
$zip_code = $_REQUEST['zip_code'];
$title = $_REQUEST['title'];
$dob = $_REQUEST['dob'];
$company = $_REQUEST['company'];
$ssn = $_REQUEST['ssn'];
$account_no = $_REQUEST['account_no'];
$account_status = $_REQUEST['account_status'];
$account_opening_date = $_REQUEST['account_opening_date'];
$account_balance = $_REQUEST['account_balance'];
$account_type = $_REQUEST['account_type'];
$funding_mode = $_REQUEST['funding_mode'];
$stat = 1;
$ins_query="insert into accounts (`usr_id`,`first_name`,`last_name`,`other_name`,`street_address`,`city`,`state`,`country`,`zip_code`,`title`,`dob`,`company`,`ssn`,`account_no`,`account_status`,`account_opening_date`,`account_balance`,`account_type`,`funding_mode`) values ('$usr_id','$first_name','$last_name','$other_name','$street_address','$city','$state','$country','$zip_code','$title','$dob','$company','$ssn','$account_no','$account_status','$account_opening_date','$account_balance','$account_type','$funding_mode')";
mysqli_query($con,$ins_query) or die(mysqli_error($con));

$ins_query2="insert into address (`userID`,`address`,`city`,`state`,`zip`) values ('$usr_id','$street_address','$city','$state','$zip_code')";
mysqli_query($con,$ins_query2) or die(mysqli_error($con));

$ins_query3="insert into email (`userID`,`email_addr`,`em_stat`) values ('$usr_id','$usr_email','$stat')";
mysqli_query($con,$ins_query3) or die(mysqli_error($con));

$ins_query4="insert into phone (`userID`,`phone_num`,`ph_stat`) values ('$usr_id','$usr_phone','$stat')";
mysqli_query($con,$ins_query4) or die(mysqli_error($con));

$ins_query5="insert into shared_perm (`UserID`,`email`,`sms`) values ('$usr_id','$def_pam','$def_pam')";
mysqli_query($con,$ins_query5) or die(mysqli_error($con));
}
?>
<meta http-equiv="refresh" content="0; url=../index.php" />