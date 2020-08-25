<?php
namespace Classes;
use Jenssegers\Agent\Agent;
class APP
{

//1.

function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return ' ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

//2.
function get_time_left($date,$date_time)
{
$date1 = $date_time;
$date2 = $date;
if($date2 > $date1){
$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	if($years > 1){
$ytxt = 'years';
		}else{
$ytxt = 'year';	
		}
	if($months > 1){
$mtxt = 'months';
		}else{
$mtxt = 'month';
		}
	if($days > 1){
$dtxt = 'days';
		}else{
$dtxt = 'day';
		}
if($years == 0){
	$yfinal = '';
}else{
	$yfinal = "$years $ytxt";
}
	
if($months == 0){
	$mfinal = '';
}else{
	$mfinal = "$months $mtxt";
}

if($days == 0){
	$dfinal = '';
}else{
	$dfinal = "$days $dtxt";
}
if($years == 0 && $months == 0 && $days == 0){
$extra = 'Closing today';
}else{
$extra = 'Closes in';
}
return '<span class="badge text-danger" style="border:1px solid red; background:#fff;">'.$extra.''.$yfinal.' '.$mfinal.' '.$dfinal.'</span>';
}else{
$diff = abs(strtotime($date1) - strtotime($date2));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	if($years > 1){
$ytxt = 'years';
		}else{
$ytxt = 'year';	
		}
	if($months > 1){
$mtxt = 'months';
		}else{
$mtxt = 'month';
		}
	if($days > 1){
$dtxt = 'days';
		}else{
$dtxt = 'day';
		}
if($years == 0){
	$yfinal = '';
}else{
	$yfinal = "$years $ytxt";
}
	
if($months == 0){
	$mfinal = '';
}else{
	$mfinal = "$months $mtxt";
}

if($days == 0){
	$dfinal = '';
}else{
	$dfinal = "$days $dtxt";
}

return '<span class="badge" style="color:#fff; border:1px solid red; background:red;">Closed '.$yfinal.' '.$mfinal.' '.$dfinal.' ago</span>';

}
}

//3.
function get_time_finish($date,$date_time)
{
$date1 = $date_time;
$date2 = $date;
$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	if($years > 1){
$ytxt = 'years';
		}else{
$ytxt = 'year';	
		}
	if($months > 1){
$mtxt = 'months';
		}else{
$mtxt = 'month';
		}
	if($days > 1){
$dtxt = 'days';
		}else{
$dtxt = 'day';
		}
if($years == 0){
	$yfinal = '';
}else{
	$yfinal = "$years $ytxt";
}
	
if($months == 0){
	$mfinal = '';
}else{
	$mfinal = "$months $mtxt";
}

if($days == 0){
	$dfinal = '';
}else{
	$dfinal = "$days $dtxt";
}

echo ''.$yfinal.' '.$mfinal.' '.$dfinal;

}

//4
function get_date_time($date_time) {
date_default_timezone_set("Africa/Lagos");
if($date_time == 'date'){
	return date("Y-m-d");
}elseif($date_time == 'time'){
	return date("H:i:s");
}elseif($date_time == 'dateTime'){
	return date("Y-m-d H:i:s");
}
}

//5
function checkParameter($value, $type) {
if(empty($value)) {
	return 'parameter is empty.';
}else{
if(htmlspecialchars($value, ENT_QUOTES, 'UTF-8') === $value) {
	if($type == 'number'){
		if (is_numeric($value)) {
			return 'pass';
		}else{
			return 'parameter is not numeric.';
		}
	}elseif($type == 'string'){
		if (is_string($value)) {
			return 'pass';
		}else{
			return 'parameter is not string.';
		}
	}elseif($type == 'boolean'){
		if ($value == 'true' or $value == 'false') {
			return 'pass';
		}else{
			return 'parameter is not bolean.';
		}
	}
}else{
	return 'parameter may contain harmful contents.';
}
}
}

//6
// Gwt domain path
function getDomain($url){
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
        return $regs['domain'];
    }
    return FALSE;
}

//7.
function my_encrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
}

function my_decrypt($data, $key) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}


//8.
   function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
	
	
//9.
private function assign_rand_value($num) {

    // accepts 1 - 36
    switch($num) {
        case "1"  : $rand_value = "a"; break;
        case "2"  : $rand_value = "b"; break;
        case "3"  : $rand_value = "c"; break;
        case "4"  : $rand_value = "d"; break;
        case "5"  : $rand_value = "e"; break;
        case "6"  : $rand_value = "f"; break;
        case "7"  : $rand_value = "g"; break;
        case "8"  : $rand_value = "h"; break;
        case "9"  : $rand_value = "i"; break;
        case "10" : $rand_value = "j"; break;
        case "11" : $rand_value = "k"; break;
        case "12" : $rand_value = "l"; break;
        case "13" : $rand_value = "m"; break;
        case "14" : $rand_value = "n"; break;
        case "15" : $rand_value = "o"; break;
        case "16" : $rand_value = "p"; break;
        case "17" : $rand_value = "q"; break;
        case "18" : $rand_value = "r"; break;
        case "19" : $rand_value = "s"; break;
        case "20" : $rand_value = "t"; break;
        case "21" : $rand_value = "u"; break;
        case "22" : $rand_value = "v"; break;
        case "23" : $rand_value = "w"; break;
        case "24" : $rand_value = "x"; break;
        case "25" : $rand_value = "y"; break;
        case "26" : $rand_value = "z"; break;
        case "27" : $rand_value = "0"; break;
        case "28" : $rand_value = "1"; break;
        case "29" : $rand_value = "2"; break;
        case "30" : $rand_value = "3"; break;
        case "31" : $rand_value = "4"; break;
        case "32" : $rand_value = "5"; break;
        case "33" : $rand_value = "6"; break;
        case "34" : $rand_value = "7"; break;
        case "35" : $rand_value = "8"; break;
        case "36" : $rand_value = "9"; break;
    }
    return $rand_value;
}

function get_rand_alphanumeric($length) {
    if ($length>0) {
        $rand_id="";
        for ($i=1; $i<=$length; $i++) {
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,36);
            $rand_id .= $this->assign_rand_value($num);
        }
    }
    return $rand_id;
}

function get_rand_numbers($length) {
    if ($length>0) {
        $rand_id="";
        for($i=1; $i<=$length; $i++) {
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(27,36);
            $rand_id .= $this->assign_rand_value($num);
        }
    }
    return $rand_id;
}

function get_rand_letters($length) {
    if ($length>0) {
        $rand_id="";
        for($i=1; $i<=$length; $i++) {
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,26);
            $rand_id .= $this->assign_rand_value($num);
        }
    }
    return $rand_id;
}


//10.
function random_password( $paslength = 10 ) {
    $Paschars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $RNDpassword = substr( str_shuffle( $Paschars ), 0, $paslength );
    return $RNDpassword;
}


//11.
function slug($text){ 

  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // add special identifier
  $text = $this->get_rand_alphanumeric(5).'-'.$text;

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}


//12.
function upload($extensions, $dir, $perimeter, $CompMode){ 
 if ( 0 < $_FILES["$perimeter"]['error'] ) {
	  return json_encode([
                "status" => 'bad',
                "message" => 'Error: ' . $_FILES["$perimeter"]['error']
            ]);
    }
    else {
		$errors = '';
		$uploadDir = '../'.$dir;
		$raw_file_name = $_FILES["$perimeter"]['name'];
		$file_ext = pathinfo($uploadDir . $raw_file_name, PATHINFO_EXTENSION);
		$file_name = $this->get_rand_numbers(10).'.'.$file_ext;
		$file_tmp = $_FILES["$perimeter"]['tmp_name'];
		$file_type = $_FILES["$perimeter"]['type'];
		$file_size = $_FILES["$perimeter"]['size'];
		if (!in_array($file_ext, $extensions)) {
			$errors = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
		}
		if ($file_size > 5097152) {
			$errors = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
		}
		if (empty($errors)) {
			if($CompMode == 'base64'){
            $data = file_get_contents($file_tmp);
            $base64 = 'data:image/' . $file_ext . ';base64,' . base64_encode($data);
			return json_encode([
                "status" => 'ok',
                "message" => $base64
            ]);
			}else{
			if(move_uploaded_file($_FILES["$perimeter"]['tmp_name'], $uploadDir . $file_name)){
				return json_encode([
                "status" => 'ok',
                "message" => $file_name
            ]);
			}else{
				return json_encode([
                "status" => 'bad',
                "message" => 'Something went wrong, please try again'
            ]);
	            }
			}
    }else{
	 return json_encode([
                "status" => 'bad',
                "message" => $errors
            ]);
	}
    }
}

//13.
function GetPDF($html, $folder, $name){
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output($folder.'/'.$name.'.pdf', \Mpdf\Output\Destination::FILE);
	return $folder.'/'.$name.'.pdf';
}

function getWhois(){
$agent = new Agent();
$browser = $agent->browser();
$platform = $agent->platform();
if($agent->robot()){
	return 'f';
}else{
	return $browser.'/'.$agent->version($browser).'/'.$platform.'/'.$agent->version($platform).'/'.$agent->device();
}
}
}
?>