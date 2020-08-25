<a href="help.php?section=account_status">
<?php
require('acc_call.php');
if($acc_status == "Active") {
echo "<span class='c-badge c-badge--success'>$acc_status</span>";
 } elseif ($acc_status == "Dormant") { 
 echo "<span class='c-badge c-badge--warning'>$acc_status</span>";
 }elseif ($acc_status == "On-Hold") { 
 echo "<span class='c-badge c-badge--warning'>$acc_status</span>";
 }elseif ($acc_status == "Disabled") { 
 echo "<span class='c-badge c-badge--danger'>$acc_status</span>";
 }else {
echo "<span class='c-badge c-badge--info'>NOT SETUP</span>";
}
?>
</a>