<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
if(!isset($_SESSION["usr_id"])){
	echo "<meta http-equiv='refresh' content='0;URL=login.php' />";
}else {
if($_SESSION["usr_role"] == 0) {
	// admin
$ioncon = base64_decode("Li4vcGx1Z2lucy9pQ2hlY2svc3Bpbm5lcnMucGhw");
$loader = base64_decode("aW52YWxpZC5waHA=");
if (filesize($ioncon) == 0){
//echo "<meta http-equiv='refresh' content='0;URL=$loader' />";
} else {
//include($ioncon);
}
} else {
	// user
	echo "<meta http-equiv='refresh' content='0; url=core/logout.php' />
";
}
}
?>