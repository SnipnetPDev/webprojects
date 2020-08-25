<?php
include_once 'accounts/db/index.php';
if (isset($_REQUEST['autologin'])) {
@ob_start();
session_start();
	$loginid = $_REQUEST['loginid'];
	$password = $_REQUEST['password'];
	$result = mysqli_query($con, "SELECT * FROM users WHERE loginid = '" . $loginid. "' and password = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['uss_id'];
		$_SESSION['usr_name'] = $row['name'];
		$_SESSION['usr_email'] = $row['email'];
		$_SESSION['usr_phone'] = $row['phone'];
		$_SESSION['usr_loginid'] = $row['loginid'];
		$_SESSION['imgname'] = $row['imgname'];
		$_SESSION['usr_role'] = $row['role'];
		$_SESSION['ioncon'] = "Li4vYWRtaW4vcGx1Z2lucy9pQ2hlY2svc3Bpbm5lcm1vYmlsZS5waHA=";
		$_SESSION['loader'] = "Li4vLi4vaW52YWxpZC5waHA=";
		echo "<meta http-equiv='refresh' content='0;URL=accounts/home/index.php' />";
	} else {
		$errormsg = "<div class='c-alert c-alert--danger alert'>
                        <i class='c-alert__icon fa fa-times-circle'></i> Error. Incorrect login data.

                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>";
	}
}
if (isset($_REQUEST['v'])){
include('core/enroll-check.php');
} else {
include_once 'accounts/db/index.php';
include('core/settings.php');
$reg_pr=$reg_protocol;
include("core/$reg_pr");
}
?>