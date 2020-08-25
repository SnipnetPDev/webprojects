<?php
require('../../db/index.php');
$sel_query="Select * from license ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if($row = mysqli_fetch_assoc($result)) {
$ser_li=$row["upgrade_link"];
$li_id=base64_decode($row["license_id"]);
$request = $_SERVER['SERVER_NAME'];
$prodID = "8012182522";
$stat = "Active";
//-----------------------------//
//extract data from the post
extract($_POST);

$fields = array(
            'client' => $request,
            'license' => $li_id,
			'report' => 'false'
        );
//set POST variables
$url = "$ser_li/gateway/RESTAPI/license/write.php";

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
$result = curl_exec($ch);
//--------------//

$url = "$ser_li/gateway/RESTAPI/license/read.php?license=$li_id";
$data = file_get_contents($url);
if (empty($li_id)) {
echo "<meta http-equiv='refresh' content='0;URL=invalid.php' />";
}
if (strpos($data, "$li_id") !== false && strpos($data, "$request") !== false && strpos($data, "$stat") !== false && strpos($data, "$prodID") !== false) {
    $stcode = 'true';
}else {
	echo "<meta http-equiv='refresh' content='0;URL=invalid.php' />";
}

}
?>