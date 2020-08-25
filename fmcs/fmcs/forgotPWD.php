<?php
@ob_start();
session_start();
if(isset($_SESSION['usr_id'])!="") {
	 echo "<meta http-equiv='refresh' content='0;URL=accounts/home/index.php' />";
}
include_once 'accounts/db/index.php';
include_once('core/settings.php');
include 'core/super-perm.php';
include("core/forgot.php");
// Do not include more lines underneath this section.
?>