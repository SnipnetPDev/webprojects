<?PHP
ob_start();
session_start();
require_once "../config.php";
require "../http_security.php";
use csrfhandler\csrf as csrf;
$dbObj = new DB();
$CPreport = '';
$rcnt = 0;

// Create a new API wrapper instance
//$cps_api = new CoinpaymentsAPI(COINP_private_key, COINP_public_key, 'json');

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
		$productlist = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/htmlbutton.htm');
	    $productlist = str_replace("%icon%", $rawD['icon'], $productlist);
	    $productlist = str_replace("%title%", $rawD['title'], $productlist);
	    $productlist = str_replace("%function%", 'setProdCat', $productlist);
	    $productlist = str_replace("%funcValue%", $rawD['title'], $productlist);
		}
		echo $productlist;
        // Close while loop
		if($rcnt % count($sqlReport) == 0) exit;
	}
	exit;
}




if(isset($_POST['loanHistory'])){
	$sqlReport = "SELECT * FROM applications WHERE usrID = '".$usr[0]['id']."'";
			$sqlReport_data = $dbObj->query_execute($sqlReport);
			while($rawD = $sqlReport_data->fetch_assoc()) {
		$loanHist = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/loanHistory.htm');
		if($rawD['loanStatus'] == 'processing'){ $icon = 'announcement'; $color = 'warning'; $display = 'block'; }elseif($rawD['loanStatus'] == 'approved'){ $icon = 'check'; $color = 'primary'; $display = 'block'; }elseif($rawD['loanStatus'] == 'declined'){ $icon = 'cancel'; $color = 'danger'; $display = 'none'; }
	    $loanHist = str_replace("%icon%", $icon, $loanHist); 
	    $loanHist = str_replace("%color%", $color, $loanHist); 
	    $loanHist = str_replace("%loanProd%", $rawD['loanProd'], $loanHist); 
	    $loanHist = str_replace("%loanPurpose%", $rawD['loanPurpose'], $loanHist);
	    $loanHist = str_replace("%amount%", $rawD['amount'], $loanHist);
	    $loanHist = str_replace("%appId%", $rawD['appId'], $loanHist);
		echo $loanHist;

		$loanview = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/loanView.htm');
	    $loanview = str_replace("%amount%", $rawD['amount'], $loanview);
	    $loanview = str_replace("%loanStatus%", $rawD['loanStatus'], $loanview);
		$loanview = str_replace("%display%", $display, $loanview); 
		$loanview = str_replace("%color%", $color, $loanview); 
	    $loanview = str_replace("%appId%", $rawD['appId'], $loanview);
		echo $loanview;
	}
	exit;
}

if(isset($_POST['filesAppId'])){
if($app->checkParameter($_POST["filesAppId"], 'number') == 'pass'){
	$filesAppId = $_POST['filesAppId'];
}else{
	$CPreport = 'filesAppId '.$app->checkParameter($_POST["filesAppId"], 'number');
}
if($CPreport !== ''){
	echo "<font style='background:red;color:#fff;padding:10px;'>$CPreport</font>";
	exit;
}
$psh = "SELECT * FROM processhistory WHERE appId = '$filesAppId'";
			$psh_data = $dbObj->query_execute($psh);
				while($psHistory = $psh_data->fetch_assoc()) {
					$pshUserC = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/linklist.htm');
					$base64info = json_decode($app->mkBase64File($psHistory['respFile']), true);
					if($psHistory['respType'] == 'userUpload'){
					$pshUser .= str_replace(
					array("%title%","%file%","%mimeType%","%date%"),
					array(str_replace(' ', '', $psHistory['respTitle']), $base64info['data'], $base64info['mimeType'], $psHistory['respDate']),
					$pshUserC
					);
					}else{
					$pshAdm .= str_replace(
					array("%title%","%file%","%mimeType%","%date%"),
					array(str_replace(' ', '', $psHistory['respTitle']), $base64info['data'], $base64info['mimeType'], $psHistory['respDate']),
					$pshUserC
					);
					}
				}
				echo "<b>Documents for download</b><br/>$pshAdm<hr/><b>My uploads</b><br/>$pshUser";
		exit;		
}

if(isset($_POST['uploadFilesId'])){
if($app->checkParameter($_POST["uploadFilesId"], 'number') == 'pass'){
	$uploadFilesId = $_POST['uploadFilesId'];
}else{
	$CPreport = 'uploadFilesId '.$app->checkParameter($_POST["uploadFilesId"], 'number');
}
if($CPreport !== ''){
	echo "<font style='background:red;color:#fff;padding:10px;'>$CPreport</font>";
	exit;
}
$uploadData = json_decode($app->upload(['jpg', 'jpeg', 'png', 'doc', 'pdf', 'docx', 'xls'], 'core/images/custom/', 'uploadFiles', 'base64'), true);
if($uploadData['status'] == 'ok'){
if($mysqli->insertInto('processhistory',array('appId' => $uploadFilesId, 'respType' => 'userUpload', 'respFile' => $uploadData['message'], 'respTitle' => $uploadData['fileName'])) == 'done'){	
$processUpdate = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/sms/processUpdate.txt');
$processUpdate = str_replace("%siteName%", APP_NAME, $processUpdate);
if($custom->sendSMS($appConfig[8]['configValue'], $processUpdate, KEY0, KEY1, KEY2) == 'sent'){
echo 0;
exit;
}
}else{
echo "<font style='color:red;'>Failed to upload file</font>";
}
}else{
	echo "<font style='color:red;'>".$uploadData['message']."</font>";
}
exit;
}

if(isset($_POST['amount'])){
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
if($mysqli->insertInto('applications',array('usrID' => $usr[0]['id'], 'amount' => $amount, 'loanProd' => $loanProdSelect, 'loanTerm' => $loanTerm, 'loanPurpose' => $loanPurpose, 'Additionalnote' => $Additionalnote)) == 'done'){
									$ApplyAdmsmsMSG = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/sms/applyAdmin.txt');
								    $ApplyAdmsmsMSG = str_replace("%siteName%", APP_NAME, $ApplyAdmsmsMSG);
								      if($custom->sendSMS($appConfig[8]['configValue'], $ApplyAdmsmsMSG, KEY0, KEY1, KEY2) == 'sent'){
									echo 0;
								}
							echo 0;	
						}else{
							echo "<font style='background:red;color:#fff;padding:10px;'>Failed to submit application</font>";
							exit;
						}
exit;
}
?>