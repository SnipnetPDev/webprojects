<?PHP
session_start();
require_once "../config.php";
require "../http_security.php";
use csrfhandler\csrf as csrf;
$dbObj = new DB();
$CPreport = '';
$rcnt = 0;
$rcnt2 = 0;
$count = 1;
// Create a new API wrapper instance
$cps_api = new CoinpaymentsAPI(COINP_private_key, COINP_public_key, 'json');

if ( isset( $_SESSION['id'] ) && isset( $_SESSION["loggedin"] ) ) {
	if ( isset($_SESSION["loggedin"]) == true) {
$usrMobile = base64_decode(base64_decode(base64_decode($_SESSION["id"])));
$usr = $mysqli->singleSelect('accounts', array('mobile' => $usrMobile), 'fetch', ''); 

$dataCheck = $mysqli->singleSelect('userdata', array('userID' => $usr[0]['id']), 'count', ''); 
	if($dataCheck == 0){
	$mysqli->insertInto('userdata',array('userID' => $usr[0]['id'], 'phoneNumber' => $usrMobile));
	}	
$usrdata = $mysqli->singleSelect('userdata', array('userID' => $usr[0]['id']), 'fetch', ''); 
	}
}

if (isset($_POST['USDAmt'])) {
if($app->checkParameter($_POST["USDAmt"], 'number') == 'pass'){
	$USDAmt = $_POST['USDAmt'];
}else{
	$CPreport = 0;
}
if($CPreport !== ''){
	echo $CPreport;
	exit;
}
$url = "https://blockchain.info/stats?format=json";
$stats = json_decode(file_get_contents($url), true);
$btcValue = $stats['market_price_usd'];
$usdCost = $USDAmt;

$convertedCost = $usdCost / $btcValue;

echo number_format($convertedCost, 8);
}

if (isset($_POST['fundAmtUSD']) && isset($_POST['fundAmtBTC']) && isset($_POST['transId'])) {
if($app->checkParameter($_POST["fundAmtUSD"], 'number') == 'pass'){
	$fundAmtUSD = $_POST['fundAmtUSD'];
}else{
	$CPreport = 'fundAmtUSD '.$app->checkParameter($_POST["fundAmtUSD"], 'number');
}
if($app->checkParameter($_POST["fundAmtBTC"], 'string') == 'pass'){
	$fundAmtBTC = $_POST['fundAmtBTC'];
}else{
	$CPreport = 'fundAmtBTC '.$app->checkParameter($_POST["fundAmtBTC"], 'string');
}
if($app->checkParameter($_POST["transId"], 'number') == 'pass'){
	$transId = $_POST['transId'];
}else{
	$CPreport = 'transId '.$app->checkParameter($_POST["transId"], 'number');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
// Enter amount for the transaction
$amount = $fundAmtBTC;

// Litecoin Testnet is a no value currency for testing
$currency = 'BTC';

// Enter buyer email below
$buyer_email = 'toolslabinc@gmail.com';

// Make call to API to create the transaction
try {
    $transaction_response = $cps_api->CreateSimpleTransaction($amount, $currency, $buyer_email);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

if($mysqli->insertInto('topup_history',array('TId' => $transaction_response['result']['txn_id'],'BTCamt' => $transaction_response['result']['amount'], 'USDamt' => $fundAmtUSD, 'userID' => $usr[0]['id'], 'transDate' => $app->get_date_time('date'), 'USDtotal' => $usrdata[0]['wallet'] + $fundAmtUSD, 'transId' => $transId)) == 'done'){
	if ($transaction_response['error'] == 'ok') {
    // Success!
    $output = '<center>Scan the QR Code below to complete payment <br>';
    $output .= '<img src="'. $transaction_response['result']['qrcode_url'] .'" /><br>';
    $output .= '<br/>Alternatively<br/>You can send exactly <b>' . $transaction_response['result']['amount'] . ' BTC</b> to: <b>' . $transaction_response['result']['address'] . '</b></center><br>';

} else {
    // Something went wrong!
    $output = 'Error: ' . $transaction_response['error'];
}

// Output the response of the API call
echo $output;
}
exit;

}


if (isset($_POST['transIdCheck'])) {
if($app->checkParameter($_POST["transIdCheck"], 'number') == 'pass'){
	$transIdCheck = $_POST['transIdCheck'];
}else{
	$CPreport = 'transIdCheck '.$app->checkParameter($_POST["transIdCheck"], 'number');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
	$sqlReport = $mysqli->singleSelect('topup_history', array('transId' => $transIdCheck), 'fetch', ''); 
	if($sqlReport[0]['status'] == 'complete'){
		if($sqlReport[0]['credited'] == 'no'){
			if($mysqli->custom("UPDATE userdata SET wallet = wallet + ".$sqlReport[0]['USDamt']." WHERE userID = '".$usr[0]['id']."'", 'update') == 'ok'){
			if($mysqli->custom("UPDATE topup_history SET credited = 'yes' WHERE transId = '".$transIdCheck."'", 'update') == 'ok'){
			echo 0;
			}else{
		echo 1;
	}
			}else{
		echo 1;
	}
		}else{
			echo 0;
		}
	}else{
		echo 1;
	}
	exit;
}



if (isset($_POST['tradeCap']) && isset($_POST['tradeAmtUSD']) && isset($_POST['profitUSD'])) {
if($app->checkParameter($_POST["tradeCap"], 'string') == 'pass'){
	$tradeCap = $_POST['tradeCap'];
}else{
	$CPreport = 'tradeCap '.$app->checkParameter($_POST["tradeCap"], 'string');
}
if($app->checkParameter($_POST["tradeAmtUSD"], 'number') == 'pass'){
	$tradeAmtUSD = $_POST['tradeAmtUSD'];
}else{
	$CPreport = 'Trade Amount '.$app->checkParameter($_POST["tradeAmtUSD"], 'number');
}
if($app->checkParameter($_POST["profitUSD"], 'string') == 'pass'){
	$profitUSD = $_POST['profitUSD'];
}else{
	$CPreport = 'profitUSD '.$app->checkParameter($_POST["profitUSD"], 'string');
}
if($app->checkParameter($_POST["trDuration"], 'string') == 'pass'){
	$trDuration = $_POST['trDuration'];
}else{
	$CPreport = 'trDuration '.$app->checkParameter($_POST["trDuration"], 'string');
}
if($CPreport !== ''){
	echo "<font style='color:red;font-weight:bold;'>$CPreport</font>";
	exit;
}
	if($tradeAmtUSD > $usrdata[0]['wallet']){
		echo "<font style='color:red;font-weight:bold;'>Insufficient funds in account</font>";
		exit;
	}
	if($mysqli->insertInto('trade_history',array('userID' => $usr[0]['id'], 'trAmount' => $tradeAmtUSD, 'trProfit' => $profitUSD, 'trType' => $tradeCap, 'trDate' => $app->get_date_time('date'), 'trDuration' => $trDuration)) == 'done'){
		if($mysqli->custom("UPDATE userdata SET wallet = wallet - ".$tradeAmtUSD." WHERE userID = '".$usr[0]['id']."'", 'update') == 'ok'){
			echo 0;
		}
	}
	exit;
}



if (isset($_POST['Infosection'])) {
if($app->checkParameter($_POST["Infosection"], 'string') == 'pass'){
	$Infosection = $_POST['Infosection'];
}else{
	$CPreport = 'Infosection '.$app->checkParameter($_POST["Infosection"], 'string');
}
if($CPreport !== ''){
	echo "<font style='color:red;'>$CPreport</font>";
	exit;
}
if($Infosection == 'lDeposit'){
$sqlReport = $mysqli->singleSelect('topup_history', array('userID' => $usr[0]['id']), 'fetch', array('ORDER BY' => 'transDate DESC' , 'LIMIT' => '1'));
	echo $sqlReport[0]['USDamt'].' USD';
}
if($Infosection == 'CBalance'){
$sqlReport = $mysqli->singleSelect('userdata', array('userID' => $usr[0]['id']), 'fetch', '');
	echo $sqlReport[0]['wallet'].' USD';
}
if($Infosection == 'lTrAmt'){
$sqlReport = $mysqli->singleSelect('trade_history', array('userID' => $usr[0]['id']), 'fetch', array('ORDER BY' => 'trDate DESC' , 'LIMIT' => '1'));
	echo $sqlReport[0]['trAmount'].' USD';
}
if($Infosection == 'lTrProfit'){
$sqlReport = $mysqli->singleSelect('trade_history', array('userID' => $usr[0]['id']), 'fetch', array('ORDER BY' => 'trDate DESC' , 'LIMIT' => '1'));
	echo $sqlReport[0]['trProfit'].' USD';
}
if($Infosection == 'lTrDuration'){
$sqlReport = $mysqli->singleSelect('trade_history', array('userID' => $usr[0]['id']), 'fetch', array('ORDER BY' => 'trDate DESC' , 'LIMIT' => '1'));
$date = date('Y-m-d', strtotime($sqlReport[0]['trDate']. ' + '.$sqlReport[0]['trDuration'].' days'));
if($sqlReport[0]['status'] == 'suspended'){
			echo '<span class="badge text-white" style="border:1px solid red; background:red;">Suspended</span>';
		}else{
			echo $app->get_time_left($date,$app->get_date_time('date'));
		}
}
exit;
}

if(isset($_POST['TradeHistory'])){
	$sqlReport = $mysqli->singleSelect('trade_history', array('userID' => $usr[0]['id']), 'fetch', array('ORDER BY' => 'trId DESC'));
	while($rawD = $sqlReport[$rcnt++]){
		$date = date('Y-m-d', strtotime($rawD['trDate']. ' + '.$rawD['trDuration'].' days'));
		if($rawD['status'] == 'suspended'){
			$status = '<span class="badge text-white" style="border:1px solid red; background:red;">Suspended</span>';
		}else{
			$status = $app->get_time_left($date,$app->get_date_time('date'));
		}
		$itemsTmp = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/tradehistory.htm');
	    $itemsTmp = str_replace("%trDate%", $rawD['trDate'], $itemsTmp); 
	    $itemsTmp = str_replace("%trAmount%", $rawD['trAmount'], $itemsTmp); 
	    $itemsTmp = str_replace("%trProfit%", $rawD['trProfit'], $itemsTmp);
	    $itemsTmp = str_replace("%trType%", $rawD['trType'], $itemsTmp);
	    $itemsTmp = str_replace("%trDuration%", $status, $itemsTmp);
		echo $itemsTmp;
        // Close while loop
		if($rcnt % count($sqlReport) == 0) exit;
	}
}

if(isset($_POST['DepositHistory'])){
	$sqlReport = $mysqli->singleSelect('topup_history', array('userID' => $usr[0]['id']), 'fetch', array('ORDER BY' => 'transDate DESC'));
	while($rawD = $sqlReport[$rcnt++]){
		$itemsTmp = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/deposithistory.htm');
	    $itemsTmp = str_replace("%trDate%", $rawD['transDate'], $itemsTmp); 
	    $itemsTmp = str_replace("%USDamt%", $rawD['USDamt'], $itemsTmp); 
	    $itemsTmp = str_replace("%BTCamt%", $rawD['BTCamt'], $itemsTmp);
	    $itemsTmp = str_replace("%status%", $rawD['status'], $itemsTmp);
		echo $itemsTmp;
        // Close while loop
		if($rcnt % count($sqlReport) == 0) exit;
	}
}
exit;
?>