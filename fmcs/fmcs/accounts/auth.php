<?php
session_start();
require('db/index.php');
if(!isset($_SESSION["usr_id"])){
?>
<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Log in | Accounts</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="../../apple-touch-icon.png">
        <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="../../css/main.min.css">
    </head>
<?php
include '../../core/login-indoor.php';
?>
        <script src="../../js/main.min.js?"></script>
    </body>
</html>
<?php
exit(); 
}else {
$basename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
$ioncon = base64_decode($_SESSION['ioncon']);
$loader = base64_decode($_SESSION['loader']);
if (filesize($ioncon) == 0){
//echo "<meta http-equiv='refresh' content='0;URL=$loader' />";
} else {
//include($ioncon);
}
include 'core/acc_call.php';
if($acc_status) {
if($acc_status == "Active") {
echo "";
 } elseif ($acc_status == "Dormant") {
 echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Your account is currently Dormant and cannot allow transactions. Contact support for assistance <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
 }elseif ($acc_status == "On-Hold") {
 echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Your account is currently On-hold and cannot allow transactions. Contact support for assistance<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>"; 
 }elseif ($acc_status == "Disabled") { 
 echo "<meta http-equiv='refresh' content='0; url=../../security.php' />";
 }
} else {
	if ($basename == "index") {
	echo "<div class='c-alert c-alert--info alert'><i class='c-alert__icon fa fa-times-circle'></i> Your account is not completely setup <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
	} else {
		echo "<meta http-equiv='refresh' content='0; url=index.php' />";
	}
}
}
?>