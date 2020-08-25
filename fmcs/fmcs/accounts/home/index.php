<?php
//STOCK BANK PROJECT --- BY SNIPNET TECHNOLOGIES WWW.SNIPNETWORKS.COM
require('../db/index.php');
include("../auth.php");
include 'core/acc_call.php';
if ($u_id == $usr_id) {
include("core/header.php");
echo "<div class='container'>";
include("core/intro.php");
echo "<div class='row u-mb-large'><div class='col-xl-4'>";					
include("core/balance.php");
echo "</div>";
include("core/activity.php");	
include("core/add-card.php");
echo "</div></div>";
include("core/footer.php");
} else {  
include 'a_setup.php';
}
?>