<?php
require('../db/index.php');
$sel_query="Select * from license ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
$ser_li=$row["upgrade_link"];
$li_id=base64_decode($row["license_id"]);
$request = $_SERVER['SERVER_NAME'];
$prodID = "8012182522";
$stat = "Active";
$url = "$ser_li/gateway/RESTAPI/license/read.php?license=$li_id";
$data = file_get_contents($url);
if (empty($li_id)) {
echo "<meta http-equiv='refresh' content='0;URL=../../invalid.php' />";
}
if (strpos($data, "$li_id") !== false && strpos($data, "$request") !== false && strpos($data, "$stat") !== false && strpos($data, "$prodID") !== false) {
    $stcode = 'true';
}else {
	echo "<meta http-equiv='refresh' content='0;URL=../../invalid.php' />";
}

}
?>