<?PHP
session_start();
require_once "../config.php";
require "../http_security.php";
use csrfhandler\csrf as csrf;
$dbObj = new DB();
$CPreport = '';
$rcnt = 0;
if ( isset( $_SESSION['id'] ) && isset( $_SESSION["loggedin"] ) ) {
	if ( isset($_SESSION["loggedin"]) == true) {
$usrMobile = base64_decode(base64_decode(base64_decode($_SESSION["id"])));
$usr = $mysqli->singleSelect('accounts', array('mobile' => $usrMobile), 'fetch', ''); 
	}
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
	    $firstName = str_replace("%type%", 'text', $firstName); 
	    $firstName = str_replace("%id%", 'firstName', $firstName); 
	    $firstName = str_replace("%placeholder%", 'First Name', $firstName); 
	    $firstName = str_replace("%value%", $sqlReport[0]['firstName'], $firstName); 
		
	$lastName = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $lastName = str_replace("%type%", 'text', $lastName); 
	    $lastName = str_replace("%id%", 'lastName', $lastName); 
	    $lastName = str_replace("%placeholder%", 'Last Name', $lastName); 
	    $lastName = str_replace("%value%", $sqlReport[0]['lastName'], $lastName); 
		
	$email = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $email = str_replace("%type%", 'email', $email); 
	    $email = str_replace("%id%", 'email', $email); 
	    $email = str_replace("%placeholder%", 'Email Address', $email); 
	    $email = str_replace("%value%", $sqlReport[0]['email'], $email); 
		echo $firstName.$lastName.$email;
	}else{
		echo 1;
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
	    $line1 = str_replace("%type%", 'text', $line1); 
	    $line1 = str_replace("%id%", 'line1', $line1); 
	    $line1 = str_replace("%placeholder%", 'Address Line 1', $line1); 
	    $line1 = str_replace("%value%", $sqlReport[0]['line1'], $line1); 
		
	$line2 = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $line2 = str_replace("%type%", 'text', $line2); 
	    $line2 = str_replace("%id%", 'line2', $line2); 
	    $line2 = str_replace("%placeholder%", 'Address Line 2', $line2); 
	    $line2 = str_replace("%value%", $sqlReport[0]['line2'], $line2); 
		
	$city = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $city = str_replace("%type%", 'text', $city); 
	    $city = str_replace("%id%", 'city', $city); 
	    $city = str_replace("%placeholder%", 'City', $city); 
	    $city = str_replace("%value%", $sqlReport[0]['city'], $city); 
		
	$state = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $state = str_replace("%type%", 'text', $state); 
	    $state = str_replace("%id%", 'state', $state); 
	    $state = str_replace("%placeholder%", 'State', $state); 
	    $state = str_replace("%value%", $sqlReport[0]['state'], $state); 
		
	$country = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/inputform.htm'); 
	    $country = str_replace("%type%", 'text', $country); 
	    $country = str_replace("%id%", 'country', $country); 
	    $country = str_replace("%placeholder%", 'Country', $country); 
	    $country = str_replace("%value%", $sqlReport[0]['country'], $country); 
		
		echo $line1.$line2.$city.$state.$country;
	}else{
		echo 1;
	}
}

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
if($sqlReport[0]['firstName'] == ''){
	echo 'My account ($'.$sqlReport[0]['wallet'].')';
}else{
	echo $sqlReport[0]['firstName'].' ($'.$sqlReport[0]['wallet'].')';
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
if($app->checkParameter($_POST["email"], 'string') == 'pass'){
	$email = $_POST['email'];
}else{
	$CPreport = 'email '.$app->checkParameter($_POST["email"], 'string');
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
	$mysqli->custom("UPDATE userdata SET firstName = '$firstName', lastName = '$lastName', email = '$email' WHERE userID = '".$usr[0]['id']."'", 'update');
	$mysqli->custom("UPDATE address SET line1 = '$line1', line2 = '$line2', city = '$city', state = '$state', country = '$country' WHERE userID = '".$usr[0]['id']."'", 'update');

}
?>