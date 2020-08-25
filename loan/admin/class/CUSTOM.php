<?php
namespace Classes;
use AfricasTalking\SDK\AfricasTalking;
//You can of course add your functions here as a custom class
class CUSTOM
{
    function helloWorld()
    {
        $text = 'Hello world';
        return $text;
    }

function sendSMS($recipients, $message, $KEY0, $KEY1, $KEY2){
// Initialize the SDK
$AT         = new AfricasTalking($KEY0, $KEY1);
$sms        = $AT->sms();
$from       = $KEY2;
try {
    // Thats it, hit send and we'll take care of the rest
    $result = $sms->send([
        'to'      => $recipients,
        'from'      => $from,
        'message' => $message
    ]);
    return 'sent';
} catch (Exception $e) {
    return "Error: ".$e->getMessage();
}
}

function replaceMnf($string, $url, $perm, $srtPerm){
    $manifest = json_decode(
         file_get_contents($url),
         true
     );
	 $manifest[$perm][$srtPerm] = $string;
     $json_object = json_encode($manifest);
     if(file_put_contents($url, $json_object)){
		 return 'ok';
	 }else{
		 return 'bad';
	 }
}

}
?>