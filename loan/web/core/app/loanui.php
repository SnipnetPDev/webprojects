<?PHP
session_start();
require_once "../config.php";
require "../http_security.php";
use csrfhandler\csrf as csrf;
$dbObj = new DB();
$CPreport = '';
$rcnt = 0;

if (isset($_POST['productPanel'])) {
if($app->checkParameter($_POST["productPanel"], 'string') == 'pass'){
	$productPanel = $_POST['productPanel'];
}else{
	$CPreport = 'productPanel '.$app->checkParameter($_POST["productPanel"], 'string');
}
if($app->checkParameter($_POST["viewMode"], 'string') == 'pass'){
	$viewMode = $_POST['viewMode'];
}else{
	$CPreport = 'viewMode '.$app->checkParameter($_POST["viewMode"], 'string');
}
if($CPreport !== ''){
	echo "<font style='background:red;color:#fff;padding:10px;'>$CPreport</font>";
	exit;
}
$sqlReport = $mysqli->singleSelect('products', '', 'fetch', array('ORDER BY' => 'RAND() DESC'));
	while($rawD = $sqlReport[$rcnt++]){
		if($viewMode == 'html'){
		$productlist = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/productlist.htm');
	    $productlist = str_replace("%col%", 'col-lg-4 col-md-4 col-sm-6 col-xs-12', $productlist); 
	    $productlist = str_replace("%img%", $rawD['display'], $productlist); 
	    $productlist = str_replace("%title%", $rawD['title'], $productlist);
	    $productlist = str_replace("%shortDesc%", $rawD['short_desc'], $productlist);
		}elseif($viewMode == 'select'){
		$productlist = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/htmlselect.htm');
	    $productlist = str_replace("%title%", $rawD['title'], $productlist);
		}
		echo $productlist;
        // Close while loop
		if($rcnt % count($sqlReport) == 0) exit;
	}
}


if (isset($_POST['fname'])) {
if($app->checkParameter($_POST["fname"], 'string') == 'pass'){
	$fname = $_POST['fname'];
}else{
	$CPreport = 'fname '.$app->checkParameter($_POST["fname"], 'string');
}
if($app->checkParameter($_POST["lname"], 'string') == 'pass'){
	$lname = $_POST['lname'];
}else{
	$CPreport = 'lname '.$app->checkParameter($_POST["lname"], 'string');
}
if($app->checkParameter($_POST["company"], 'string') == 'pass'){
	$company = $_POST['company'];
}else{
	$CPreport = 'company '.$app->checkParameter($_POST["company"], 'string');
}
if($app->checkParameter($_POST["number"], 'string') == 'pass'){
	$number = $_POST['number'];
}else{
	$CPreport = 'number '.$app->checkParameter($_POST["number"], 'string');
}
if(substr($number, 0, 1) === '+'){
	$number = $_POST['number'];
}else{
	$CPreport = 'Phone number must contain international format (ex: +19200000000)';
}
if($app->checkParameter($_POST["email"], 'string') == 'pass'){
	$email = $_POST['email'];
}else{
	$CPreport = 'email '.$app->checkParameter($_POST["email"], 'string');
}
if($app->checkParameter($_POST["address"], 'string') == 'pass'){
	$address = $_POST['address'];
}else{
	$CPreport = 'address '.$app->checkParameter($_POST["address"], 'string');
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
if($app->checkParameter($_POST["amount"], 'number') == 'pass'){
	$amount = $_POST['amount'];
}else{
	$CPreport = 'amount '.$app->checkParameter($_POST["amount"], 'number');
}
if($app->checkParameter($_POST["loanProdSelect"], 'string') == 'pass'){
	$loanProdSelect = $_POST['loanProdSelect'];
}else{
	$CPreport = 'loanProdSelect '.$app->checkParameter($_POST["loanProdSelect"], 'string');
}
if($app->checkParameter($_POST["loanTerm"], 'number') == 'pass'){
	$loanTerm = $_POST['loanTerm'];
}else{
	$CPreport = 'loanTerm '.$app->checkParameter($_POST["loanTerm"], 'number');
}
if($app->checkParameter($_POST["loanPurpose"], 'string') == 'pass'){
	$loanPurpose = $_POST['loanPurpose'];
}else{
	$CPreport = 'loanPurpose '.$app->checkParameter($_POST["loanPurpose"], 'string');
}
if($app->checkParameter($_POST["Additionalnote"], 'string') == 'pass'){
	$Additionalnote = $_POST['Additionalnote'];
}else{
	$CPreport = 'Additionalnote '.$app->checkParameter($_POST["Additionalnote"], 'string');
}
if($CPreport !== ''){
	echo "<font style='background:red;color:#fff;padding:10px;'>$CPreport</font>";
	exit;
}
$logID = $app->get_rand_numbers(12);
$dataCheck = $mysqli->singleSelect('accounts', array('mobile' => $number), 'count', ''); 
	if($dataCheck == 0){
		$dataCheck2 = $mysqli->singleSelect('userdata', array('email' => $email), 'count', ''); 
	if($dataCheck2 == 0){
		if($mysqli->insertInto('logged_id',array('ip_addr' => $app->getWhois(), 'resource' => $number, 'logtime' => $app->get_date_time('dateTime'), 'logNO' => $logID, 'lognote' => 'NULL')) == 'done'){
					if($mysqli->insertInto('accounts',array('mobile' => $number, 'session' => 'inactive', 'logNO' => $logID)) == 'done'){
						$sqlReport = $mysqli->singleSelect('accounts', array('mobile' => $number), 'fetch', array('ORDER BY' => 'id DESC'));
						if($mysqli->insertInto('address',array('userID' => $sqlReport[0]['id'], 'line1' => $address, 'city' => $city, 'state' => $state, 'country' => $country)) == 'done'){
							if($mysqli->insertInto('userdata',array('userID' => $sqlReport[0]['id'], 'company' => $company, 'firstName' => $fname, 'lastName' => $lname, 'email' => $email, 'phoneNumber' => $number)) == 'done'){
							if($mysqli->insertInto('applications',array('usrID' => $sqlReport[0]['id'], 'amount' => $amount, 'loanProd' => $loanProdSelect, 'loanTerm' => $loanTerm, 'loanPurpose' => $loanPurpose, 'Additionalnote' => $Additionalnote)) == 'done'){
								$ApplysmsMSG = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/sms/apply.txt');
								$ApplysmsMSG = str_replace("%userName%", $fname, $ApplysmsMSG);
								$ApplysmsMSG = str_replace("%siteName%", APP_NAME, $ApplysmsMSG);
								$ApplysmsMSG = str_replace("%appIosUrl%", $appConfig[13]['configValue'], $ApplysmsMSG);
								$ApplysmsMSG = str_replace("%appAndroidUrl%", $appConfig[12]['configValue'], $ApplysmsMSG);
								if($custom->sendSMS($number, $ApplysmsMSG, KEY0, KEY1, KEY2) == 'sent'){
									$ApplyAdmsmsMSG = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/sms/applyAdmin.txt');
								    $ApplyAdmsmsMSG = str_replace("%siteName%", APP_NAME, $ApplyAdmsmsMSG);
								      if($custom->sendSMS($appConfig[8]['configValue'], $ApplyAdmsmsMSG, KEY0, KEY1, KEY2) == 'sent'){
									echo 0;
								}
								}
						}
						}
						}
						
					}
					
		}
	}else{
	echo "<font style='background:red;color:#fff;padding:10px;'>Email address specified is associated with another customer</font>";
	exit;
	}
	}else{
	echo "<font style='background:red;color:#fff;padding:10px;'>Phone number specified is associated with another customer</font>";
	exit;
	}
}


if (isset($_POST['Cfname'])) {
if($app->checkParameter($_POST["Cfname"], 'string') == 'pass'){
	$Cfname = $_POST['Cfname'];
}else{
	$CPreport = 'Cfname '.$app->checkParameter($_POST["Cfname"], 'string');
}
if($app->checkParameter($_POST["Clname"], 'string') == 'pass'){
	$Clname = $_POST['Clname'];
}else{
	$CPreport = 'Clname '.$app->checkParameter($_POST["Clname"], 'string');
}
if($app->checkParameter($_POST["Cemail"], 'string') == 'pass'){
	$Cemail = $_POST['Cemail'];
}else{
	$CPreport = 'Cemail '.$app->checkParameter($_POST["Cemail"], 'string');
}
if($app->checkParameter($_POST["Cphone"], 'string') == 'pass'){
	$Cphone = $_POST['Cphone'];
}else{
	$CPreport = 'Cphone '.$app->checkParameter($_POST["Cphone"], 'string');
}
if($CPreport !== ''){
	echo "<font style='background:red;color:#fff;padding:10px;'>$CPreport</font>";
	exit;
}
$contactMSG = 'Contact Request: '.$Cfname.' '.$Clname.' / '.$Cemail.' / '.$Cphone;
if($custom->sendSMS($appConfig[8]['configValue'], $contactMSG, KEY0, KEY1, KEY2) == 'sent'){
echo 0;
}
}

exit;
?>