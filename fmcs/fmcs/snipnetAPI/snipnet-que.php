<?php
//extract data from the post
extract($_POST);

//set POST variables
$url = 'https://snipnetworks.com/gateway/RESTAPI/sms/write.php';

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
?>