<?PHP
session_start();
require_once "../config.php";
require "../http_security.php";
use csrfhandler\csrf as csrf;
$dbObj = new DB();
$CPreport = '';
if ( isset( $_SESSION['id'] ) && isset( $_SESSION["loggedin"] ) ) {
	if ( isset($_SESSION["loggedin"]) == true) {
$usrMobile = base64_decode(base64_decode(base64_decode($_SESSION["id"])));
$usr = $mysqli->singleSelect('accounts', array('mobile' => $usrMobile), 'fetch', ''); 

$dataCheck = $mysqli->singleSelect('userdata', array('userID' => $usr[0]['id']), 'count', ''); 
	if($dataCheck == 0){
	$mysqli->insertInto('userdata',array('userID' => $usr[0]['id'], 'phoneNumber' => $usrMobile));
	}
$usrdata = $mysqli->singleSelect('userdata', array('userID' => $usr[0]['id']), 'fetch', ''); 
	}else{
	exit;
	}
}else{
	exit;
	}
if (isset($_POST['accountfunction'])) {
if($app->checkParameter($_POST["accountfunction"], 'string') == 'pass'){
	$accountfunction = $_POST['accountfunction'];
}else{
	$CPreport = 'accountfunction '.$app->checkParameter($_POST["accountfunction"], 'string');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
if($accountfunction == 'personalTab'){
	$dataCheck = $mysqli->singleSelect('userdata', array('userID' => $usr[0]['id']), 'count', ''); 
	if($dataCheck == 0){
		if($mysqli->insertInto('userdata',array('userID' => $usr[0]['id'], 'phoneNumber' => $usrMobile)) == 'done'){
			$usrCheck = 'complete';
		}else{
			$usrCheck = 'failed';
		}
	}else{
		$usrCheck = 'complete';
	}
	if($usrCheck == 'complete'){
		$sqlReport = $mysqli->singleSelect('userdata', array('userID' => $usr[0]['id']), 'fetch', ''); 
	$firstName = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $firstName = str_replace("%col%", '6', $firstName); 
	    $firstName = str_replace("%type%", 'text', $firstName); 
	    $firstName = str_replace("%id%", 'firstName', $firstName); 
	    $firstName = str_replace("%placeholder%", 'First Name', $firstName); 
	    $firstName = str_replace("%value%", $sqlReport[0]['firstName'], $firstName); 
	    $firstName = str_replace("%add%", '', $firstName); 
		
	$lastName = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $lastName = str_replace("%col%", '6', $lastName); 
	    $lastName = str_replace("%type%", 'text', $lastName); 
	    $lastName = str_replace("%id%", 'lastName', $lastName); 
	    $lastName = str_replace("%placeholder%", 'Last Name', $lastName); 
	    $lastName = str_replace("%value%", $sqlReport[0]['lastName'], $lastName); 
	    $lastName = str_replace("%add%", '', $lastName); 
		
	$company = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $company = str_replace("%col%", '6', $company); 
	    $company = str_replace("%type%", 'text', $company); 
	    $company = str_replace("%id%", 'company', $company); 
	    $company = str_replace("%placeholder%", 'Company', $company); 
	    $company = str_replace("%value%", $sqlReport[0]['company'], $company);
	    $company = str_replace("%add%", '', $company); 
		
	$email = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $email = str_replace("%col%", '6', $email); 
	    $email = str_replace("%type%", 'text', $email); 
	    $email = str_replace("%id%", 'email', $email); 
	    $email = str_replace("%placeholder%", 'Email Address', $email); 
	    $email = str_replace("%value%", $sqlReport[0]['email'], $email); 
	    $email = str_replace("%add%", 'readonly=""', $email); 
		echo $firstName.$lastName.$company.$email;
		exit;
	}else{
		echo 1;
		exit;
	}
}
if($accountfunction == 'addressTab'){
	$dataCheck = $mysqli->singleSelect('address', array('userID' => $usr[0]['id']), 'count', ''); 
		if($dataCheck == 0){
		if($mysqli->insertInto('address',array('userID' => $usr[0]['id'])) == 'done'){
			$usrCheck = 'complete';
		}else{
			$usrCheck = 'failed';
		}
	}else{
		$usrCheck = 'complete';
	}
	if($usrCheck == 'complete'){
		$sqlReport = $mysqli->singleSelect('address', array('userID' => $usr[0]['id']), 'fetch', ''); 
	$line1 = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $line1 = str_replace("%col%", '6', $line1); 
	    $line1 = str_replace("%type%", 'text', $line1); 
	    $line1 = str_replace("%id%", 'line1', $line1); 
	    $line1 = str_replace("%placeholder%", 'Address Line 1', $line1); 
	    $line1 = str_replace("%value%", $sqlReport[0]['line1'], $line1); 
	    $line1 = str_replace("%add%", '', $line1); 
		
	$line2 = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $line2 = str_replace("%col%", '6', $line2); 
	    $line2 = str_replace("%type%", 'text', $line2); 
	    $line2 = str_replace("%id%", 'line2', $line2); 
	    $line2 = str_replace("%placeholder%", 'Address Line 2', $line2); 
	    $line2 = str_replace("%value%", $sqlReport[0]['line2'], $line2); 
	    $line2 = str_replace("%add%", '', $line2); 
		
	$city = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $city = str_replace("%col%", '6', $city); 
	    $city = str_replace("%type%", 'text', $city); 
	    $city = str_replace("%id%", 'city', $city); 
	    $city = str_replace("%placeholder%", 'City', $city); 
	    $city = str_replace("%value%", $sqlReport[0]['city'], $city); 
	    $city = str_replace("%add%", '', $city); 
		
	$state = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $state = str_replace("%col%", '6', $state); 
	    $state = str_replace("%type%", 'text', $state); 
	    $state = str_replace("%id%", 'state', $state); 
	    $state = str_replace("%placeholder%", 'State', $state); 
	    $state = str_replace("%value%", $sqlReport[0]['state'], $state); 
	    $state = str_replace("%add%", '', $state); 
		
	$country = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/selectform.htm'); 
	    $country = str_replace("%col%", '6', $country); 
	    $country = str_replace("%name%", 'country', $country); 
	    $country = str_replace("%id%", 'country', $country); 
	    $country = str_replace("%value%", $sqlReport[0]['country'], $country); 
	    $country = str_replace("%add%", '', $country); 
		
		echo $line1.$line2.$city.$state.$country;
		exit;
	}else{
		echo 1;
		exit;
	}
}
exit;
}

if (isset($_POST['accountInfo'])) {
if($app->checkParameter($_POST["accountInfo"], 'string') == 'pass'){
	$accountInfo = $_POST['accountInfo'];
}else{
	$CPreport = 'accountInfo '.$app->checkParameter($_POST["accountInfo"], 'string');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
$sqlReport = $mysqli->singleSelect('userdata', array('userID' => $usr[0]['id']), 'fetch', '');
if($sqlReport[0]["$accountInfo"] == ''){
	echo 'NULL';
	exit;
}else{
	echo $sqlReport[0]["$accountInfo"];
	exit;
}
}

if (isset($_POST['firstName'])) {
if($app->checkParameter($_POST["firstName"], 'string') == 'pass'){
	$firstName = $_POST['firstName'];
}else{
	$CPreport = 'firstName '.$app->checkParameter($_POST["firstName"], 'string');
}
if($app->checkParameter($_POST["lastName"], 'string') == 'pass'){
	$lastName = $_POST['lastName'];
}else{
	$CPreport = 'lastName '.$app->checkParameter($_POST["lastName"], 'string');
}
if($app->checkParameter($_POST["company"], 'string') == 'pass'){
	$company = $_POST['company'];
}else{
	$CPreport = 'company '.$app->checkParameter($_POST["company"], 'string');
}
if($app->checkParameter($_POST["line1"], 'string') == 'pass'){
	$line1 = $_POST['line1'];
}else{
	$CPreport = 'line1 '.$app->checkParameter($_POST["line1"], 'string');
}
if($app->checkParameter($_POST["line2"], 'string') == 'pass'){
	$line2 = $_POST['line2'];
}else{
	$CPreport = 'line2 '.$app->checkParameter($_POST["line2"], 'string');
}
if($app->checkParameter($_POST["city"], 'string') == 'pass'){
	$city = $_POST['city'];
}else{
	$CPreport = 'city '.$app->checkParameter($_POST["city"], 'string');
}
if($app->checkParameter($_POST["state"], 'string') == 'pass'){
	$state = $_POST['state'];
}else{
	$CPreport = 'state '.$app->checkParameter($_POST["state"], 'string');
}
if($app->checkParameter($_POST["country"], 'string') == 'pass'){
	$country = $_POST['country'];
}else{
	$CPreport = 'country '.$app->checkParameter($_POST["country"], 'string');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
	$mysqli->custom("UPDATE userdata SET firstName = '$firstName', lastName = '$lastName', company = '$company' WHERE userID = '".$usr[0]['id']."'", 'update');
	$mysqli->custom("UPDATE address SET line1 = '$line1', line2 = '$line2', city = '$city', state = '$state', country = '$country' WHERE userID = '".$usr[0]['id']."'", 'update');
	echo 0;
	exit;

}

if (isset($_POST['base64Img'])) {
if($app->checkParameter($_POST["base64Img"], 'string') == 'pass'){
	$base64Img = $_POST['base64Img'];
}else{
	$CPreport = 'base64Img '.$app->checkParameter($_POST["base64Img"], 'string');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
	echo $mysqli->custom("UPDATE userdata SET avatar = '$base64Img' WHERE userID = '".$usr[0]['id']."'", 'update');
exit;
}
exit;
?>