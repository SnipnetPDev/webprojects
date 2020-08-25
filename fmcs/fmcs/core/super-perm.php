<?php
$sel_query="Select * from super_perm ORDER BY perm_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
$perm_transfer = $row["transfer"];
$perm_email = $row["email"];
$perm_sms = $row["sms"];
$perm_cards = $row["cards"];
$perm_help = $row["help"];
$perm_act = 1;
}

// include '../../core/super-perm.php';
// if($REQ-VAR == $perm_act) {
//	
// }else {
//
// <div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Service not available at this time, please try again later <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>
// }
if(!isset($_SESSION["usr_id"])) {
$session_user = 0;
}else{ 
$session_user = $_SESSION['usr_id'];
}
$sel_query="Select * from shared_perm where UserID = '$session_user' ORDER BY perm_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
$sh_perm_email = $row["email"];
$sh_perm_sms = $row["sms"];
$sh_perm_act = 1;
}
?>