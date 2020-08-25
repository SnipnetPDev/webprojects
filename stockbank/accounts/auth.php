<?php
session_start();
include_once '../db/index.php';
if(!isset($_SESSION["usr_name"])){
header("Location: ../index.php");
exit(); }
$result = mysqli_query($con, "SELECT * FROM accounts WHERE usr_id = '" . $_SESSION['usr_id'] . "' and account_status = 'Active'");
 $rowcount=mysqli_num_rows($result);
	if ($rowcount < 1) {
		header("Location: ../../info.php");
	}
?>
