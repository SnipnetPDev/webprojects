<?php
$sel_query="Select * from settings ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
$b_email = $row["email"];
$b_url = $row["b_url"];
$b_name = $row["title"];
$b_address = $row["address"];
$short_name = $row["short_name"];
$user_email = $row["snipnet_email"];
$api_key = $row["api_key"];
$b_phone = $row["phone"];
$site_title=$row["title"];
$base_url=$row["b_url"];
$manual_review=$row["man_review"];
$reg_protocol=$row["reg_sec"];
$acc_curency=$row["default_curency"];;
$t_cur=$row['default_curency'];
$api_key = $row["api_key"];
}
?>