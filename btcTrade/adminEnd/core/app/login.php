<?PHP
session_start();
require_once "../config.php";
require "../http_security.php";
use csrfhandler\csrf as csrf;
$dbObj = new DB();
$CPreport = '';
if (isset($_POST['mobile'])) {
$isValid = csrf::post();
if($app->checkParameter($_POST["_token"], 'string') == 'pass'){
	$token = $_POST['_token'];
}else{
	$CPreport = '_token '.$app->checkParameter($_POST["_token"], 'string');
}
if($isValid){
	csrf::flushToken();
}else{
	$CPreport = 'Invalid Access token';
}
if($app->checkParameter($_POST["mobile"], 'number') == 'pass'){
	$mobile = $_POST['mobile'];
}else{
	$CPreport = 'Phone number '.$app->checkParameter($_POST["mobile"], 'number');
}

if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
	$sql = "SELECT * FROM accounts WHERE mobile = '$mobile'";
			$data = $dbObj->query_execute($sql);
			$Row_count = $dbObj->query_rowCount($data);
			$_SESSION['code'] = $app->get_rand_numbers(6);
			$smsMSG = APP_NAME.' verification code '.$_SESSION['code'];
			$guest_ip = $app->getWhois();
			if ($Row_count > 0) {
			$acc = "SELECT * FROM accounts a, logged_id l WHERE a.mobile = '$mobile' and a.logNO = l.logNO";
			$acc_data = $dbObj->query_execute($acc);
				if ($account = $acc_data->fetch_assoc()) {
					if($account["ip_addr"] == $guest_ip && $account["pass"] !== '') {
	echo '<br/><br/><h2 class="text-7 text-center">Verify '.$mobile.'</h2>
        <p class="text-3 text-center mb-25">Enter your account PIN</p> <br/>
        <div id="loginForm">
		<input type="hidden" class="form-control" id="phone" value="'.$mobile.'">
          <div class="vertical-input-group">
            <div class="input-group">
              <input type="number" class="form-control" id="pin" onkeyup="verifypin(this.value);" pattern="\d{4}" maxlength="4" autocomplete="off" required>
            </div>
			<span id="Vreport"></span>
          </div>
		  <br/>
		  <br/>
        </div>
		';
					}else{
if($custom->sendSMS($mobile, $smsMSG, KEY0, KEY1, APP_NAME) == 'sent'){
	if($mysqli->insertInto('safe_token',array('tres' => $mobile, 'tkey' => $_SESSION['code'], 'tip' => $guest_ip, 'ttime' => $app->get_date_time('dateTime'))) == 'done'){
						echo '<br/><br/><h2 class="text-7 text-center">Verify '.$mobile.'</h2>
        <p class="text-3 text-center mb-25">Enter the code you have received from '.APP_NAME.'</p> <br/>
        <form id="loginForm" method="post">
		<input type="hidden" class="form-control" id="resID" value="'.$mobile.'">
		<input type="hidden" class="form-control" id="mode" value="login">
          <div class="vertical-input-group">
            <div class="input-group">
              <input type="number" class="form-control" id="Vcode" name="Vcode" onkeyup="verify(this.value);" pattern="\d{6}" maxlength="6" required>
            </div>
			<span id="Vreport"></span>
          </div>
		  <br/>
		  <a class="btn-link" onclick="resendSMSL()" href="#">Resend SMS</a>
		  <br/>
        </form>
		';
	}else{
	echo '<center><font style="background:red;color:#fff;padding:5px;">Something went wrong, please try again</font></center>';
	 }
}else{
	echo '<center><font style="background:red;color:#fff;padding:5px;">Something went wrong, please try again</font></center>';
	 }
					}
				}
			}else{
if($custom->sendSMS($mobile, $smsMSG, KEY0, KEY1, APP_NAME) == 'sent'){
if($mysqli->insertInto('safe_token',array('tres' => $mobile, 'tkey' => $_SESSION['code'], 'tip' => $guest_ip, 'ttime' => $app->get_date_time('dateTime'))) == 'done'){
	echo '<br/><br/><h2 class="text-7 text-center">Verify '.$mobile.'</h2>
        <p class="text-3 text-center mb-25">Enter the code you have received from '.APP_NAME.'</p> <br/>
        <div id="loginForm">
		<input type="hidden" class="form-control" id="resID" value="'.$mobile.'">
		<input type="hidden" class="form-control" id="mode" value="reg">
          <div class="vertical-input-group">
            <div class="input-group">
              <input type="number" class="form-control" id="Vcode" name="Vcode" pattern="\d{6}" maxlength="6" onkeyup="verify(this.value);" required>
            </div>
			<span id="Vreport"></span>
          </div>
		  <br/>
		  <a class="btn-link" onclick="resendSMS()" href="#">Resend SMS</a>
		  <br/>
        </div> 
		';
}else{
	echo '<center><font style="background:red;color:#fff;padding:5px;">Something went wrong, please try again</font></center>';
	 }
				}else{
					echo '<center><font style="background:red;color:#fff;padding:5px;">Something went wrong, please try again</font></center>';
				}
			}
				
}
if (isset($_POST['resendV'])) {
if($app->checkParameter($_POST["resendV"], 'string') == 'pass'){
	$mobile = $_POST['resendV'];
}else{
	$CPreport = 'Phone number '.$app->checkParameter($_POST["resendV"], 'number');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
		    $_SESSION['code'] = $app->get_rand_numbers(6);
			$smsMSG = APP_NAME.' verification code '.$_SESSION['code'];
			$guest_ip = $app->getWhois();
if($custom->sendSMS($mobile, $smsMSG, KEY0, KEY1, APP_NAME) == 'sent'){
if($mysqli->insertInto('safe_token',array('tres' => $mobile, 'tkey' => $_SESSION['code'], 'tip' => $guest_ip, 'ttime' => $app->get_date_time('dateTime'))) == 'done'){
	echo '<br/><br/><h2 class="text-7 text-center">Verify '.$mobile.'</h2>
        <p class="text-3 text-center mb-25">Enter the code you have received from '.APP_NAME.'</p> <br/>
        <form id="loginForm">
		<input type="hidden" class="form-control" id="resID" value="'.$mobile.'">
		<input type="hidden" class="form-control" id="mode" value="reg">
          <div class="vertical-input-group">
            <div class="input-group">
              <input type="number" class="form-control" id="Vcode" name="Vcode" pattern="\d{6}" maxlength="6" onkeyup="verify(this.value);" required>
            </div>
			<span id="Vreport"></span>
          </div>
		  <br/>
		  <br/>
        </div>
		';
}else{
	echo '<center><font style="background:red;color:#fff;padding:5px;">Something went wrong, please try again</font></center>';
	 }
}else{
	echo '<center><font style="background:red;color:#fff;padding:5px;">Something went wrong, please try again</font></center>';
	 }
}
				
if (isset($_POST['resendVL'])) {
if($app->checkParameter($_POST["resendVL"], 'string') == 'pass'){
	$mobile = $_POST['resendVL'];
}else{
	$CPreport = 'Phone number '.$app->checkParameter($_POST["resendVL"], 'number');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
		    $_SESSION['code'] = $app->get_rand_numbers(6);
			$smsMSG = APP_NAME.' verification code '.$_SESSION['code'];
			$guest_ip = $app->getWhois();
if($custom->sendSMS($mobile, $smsMSG, KEY0, KEY1, APP_NAME) == 'sent'){
if($mysqli->insertInto('safe_token',array('tres' => $mobile, 'tkey' => $_SESSION['code'], 'tip' => $guest_ip, 'ttime' => $app->get_date_time('dateTime'))) == 'done'){
	echo '<br/><br/><h2 class="text-7 text-center">Verify '.$mobile.'</h2>
        <p class="text-3 text-center mb-25">Enter the code you have received from '.APP_NAME.'</p> <br/>
        <div id="loginForm">
		<input type="hidden" class="form-control" id="resID" value="'.$mobile.'">
		<input type="hidden" class="form-control" id="mode" value="login">
          <div class="vertical-input-group">
            <div class="input-group">
              <input type="number" class="form-control" id="Vcode" name="Vcode" pattern="\d{6}" maxlength="6" onkeyup="verify(this.value);" required>
            </div>
			<span id="Vreport"></span>
          </div>
		  <br/>
		  <br/>
        </div>
		';
}else{
	echo '<center><font style="background:red;color:#fff;padding:5px;">Something went wrong, please try again</font></center>';
	 }
}else{
	echo '<center><font style="background:red;color:#fff;padding:5px;">Something went wrong, please try again</font></center>';
	 }
}

if (isset($_POST['Vcode']) && isset($_POST['resID']) && isset($_POST['mode'])) {
if($app->checkParameter($_POST["Vcode"], 'number') == 'pass'){
	$vcode = $_POST['Vcode'];
}else{
	$CPreport = 'Verification code '.$app->checkParameter($_POST["Vcode"], 'number');
}
if($app->checkParameter($_POST["resID"], 'string') == 'pass'){
	$resID = $_POST['resID'];
}else{
	$CPreport = 'Phone number '.$app->checkParameter($_POST["resID"], 'number');
}
if($app->checkParameter($_POST["mode"], 'string') == 'pass'){
	$mode = $_POST['mode'];
}else{
	$CPreport = 'Mode '.$app->checkParameter($_POST["mode"], 'string');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
$resID = $resID;
	$guest_ip = $app->getWhois();
	$detect = 'NULL';
	$logID = $app->get_rand_numbers(12);
		    $sql = "SELECT * FROM safe_token WHERE tkey = '$vcode' AND tres = '$resID'";
			$data = $dbObj->query_execute($sql);
			$Row_count = $dbObj->query_rowCount($data);
			if($Row_count > 0) {
				if($mode == 'login'){
				if($mysqli->insertInto('logged_id',array('ip_addr' => $guest_ip, 'resource' => $resID, 'logtime' => $app->get_date_time('dateTime'), 'logNO' => $logID, 'lognote' => $detect)) == 'done'){
					$upd_sql = "UPDATE accounts SET logNO = '$logID', session = 'active' WHERE mobile = '$resID'";
			        if($dbObj->query_execute($upd_sql)) {
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $account = base64_encode($resID);
                            $account = base64_encode($account);
                            $_SESSION["id"] = base64_encode($account);
							$_SESSION["logID"] = $logID;
							$del_sql = "DELETE FROM safe_token WHERE tkey = '$vcode' AND tres = '$resID'";
			                $dbObj->query_execute($del_sql);
							echo 0;
				}else{
				echo 1;
			}
			}else{
				echo 1;
			}
				}elseif($mode == 'change_number'){
				$usrID = $_SESSION["usrID"];
				$upd_sql = "UPDATE accounts SET mobile = '$resID' WHERE id = '$usrID'";
			        if($dbObj->query_execute($upd_sql)) {
						echo 0;
					}else{
						echo 1;
					}
					$del_sql = "DELETE FROM safe_token WHERE tkey = '$vcode' AND tres = '$resID'";
			        $dbObj->query_execute($del_sql);
				}elseif($mode == 'verifyOTP'){
				    echo 0;
					$del_sql = "DELETE FROM safe_token WHERE tkey = '$vcode' AND tres = '$resID'";
			        $dbObj->query_execute($del_sql);
				}else{
				if($mysqli->insertInto('logged_id',array('ip_addr' => $guest_ip, 'resource' => $resID, 'logtime' => $app->get_date_time('dateTime'), 'logNO' => $logID, 'lognote' => $detect)) == 'done'){
					if($mysqli->insertInto('accounts',array('mobile' => $resID, 'session' => 'active', 'logNO' => $logID)) == 'done'){
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $account = base64_encode($resID);
                            $account = base64_encode($account);
                            $_SESSION["id"] = base64_encode($account);
							$_SESSION["logID"] = $logID;
							$del_sql = "DELETE FROM safe_token WHERE tkey = '$vcode' AND tres = '$resID'";
			                $dbObj->query_execute($del_sql);
							echo 0;
				}else{
				echo 1;
			}
			}else{
				echo 1;
			}
				}
}else{
				echo 1;
			}
}

if (isset($_POST['exit']) == 'quit') {
if($app->checkParameter($_POST["mode"], 'string') == 'pass'){
	$mode = $_POST['mode'];
}else{
	$CPreport = 'Mode '.$app->checkParameter($_POST["mode"], 'string');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
	
    $decoded = base64_decode($_SESSION['id']);
	$decoded = base64_decode($decoded);
	$decoded = base64_decode($decoded);
	if($mode == 'user_mode'){
$upd_sql = "UPDATE accounts SET session = 'inactive' WHERE mobile = '$decoded'";
$dbObj->query_execute($upd_sql);
	}
// Unset all of the session variables
$_SESSION = array();
// Destroy the session.
session_destroy();
// Redirect to index page
echo 0;
}
if (isset($_POST['pin']) && isset($_POST['phone'])) {
if($app->checkParameter($_POST["pin"], 'number') == 'pass'){
	$pin = $_POST['pin'];
}else{
	$CPreport = 'Pin '.$app->checkParameter($_POST["pin"], 'number');
}
if($app->checkParameter($_POST["phone"], 'string') == 'pass'){
	$phone = $_POST['phone'];
}else{
	$CPreport = 'Phone number '.$app->checkParameter($_POST["phone"], 'number');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
	$guest_ip = $app->getWhois();
	$detect = 'NULL';
	$logID = $app->get_rand_numbers(12);
		    $sql = "SELECT * FROM accounts WHERE pass = '$pin' AND mobile = '$phone'";
			$data = $dbObj->query_execute($sql);
			$Row_count = $dbObj->query_rowCount($data);
			if($Row_count > 0) {
				if($mysqli->insertInto('logged_id',array('ip_addr' => $guest_ip, 'resource' => $phone, 'logtime' => $app->get_date_time('dateTime'), 'logNO' => $logID, 'lognote' => $detect)) == 'done'){
					$upd_sql = "UPDATE accounts SET logNO = '$logID', session = 'active' WHERE mobile = '$phone'";
			        if($dbObj->query_execute($upd_sql)) {
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $account = base64_encode($phone);
                            $account = base64_encode($account);
                            $_SESSION["id"] = base64_encode($account);
                            $_SESSION["logID"] = $logID;
							echo 0;
				}else{
				echo 1;
			}
			}else{
				echo 1;
			}
}else{
				echo 1;
			}
}
if (isset($_POST['pinS']) && isset($_POST['pinSV'])) {
if($app->checkParameter($_POST["pinS"], 'number') == 'pass'){
	$pinS = $_POST['pinS'];
}else{
	$CPreport = 'Pin '.$app->checkParameter($_POST["pinS"], 'number');
}
if($app->checkParameter($_POST["pinSV"], 'number') == 'pass'){
	$pinSV = $_POST['pinSV'];
}else{
	$CPreport = 'Confirm pin '.$app->checkParameter($_POST["pinSV"], 'number');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
	$pinS = $_POST['pinS'];
	$pinSV = $_POST['pinSV'];
	$decoded = base64_decode($_SESSION['id']);
	$decoded = base64_decode($decoded);
	$decoded = base64_decode($decoded);
					$upd_sql = "UPDATE accounts SET pass = '$pinSV' WHERE mobile = '$decoded'";
			        if($dbObj->query_execute($upd_sql)) {
							echo 0;
				}else{
				echo 1;
			}	
}
if (isset($_POST['locked'])) {
if($app->checkParameter($_POST["locked"], 'string') == 'pass'){
}else{
	$CPreport = 'locked '.$app->checkParameter($_POST["locked"], 'string');
}
if($CPreport !== ''){
	echo "<center><font style='background:red;color:#fff;padding:5px;'>$CPreport</font></center>";
	exit;
}
	$pinS = $_POST['pinS'];
	$pinSV = $_POST['pinSV'];
	$usrID = $_SESSION["usrID"];
					$upd_sql = "UPDATE accounts SET status = 'locked' WHERE id = '$usrID'";
			        if($dbObj->query_execute($upd_sql)) {
							echo 0;
				}else{
				echo 1;
			}	
}
if (isset($_POST['pinC']) && isset($_POST['pinCN']) && isset($_POST['pinCNC'])) {
if($app->checkParameter($_POST["pinC"], 'number') == 'pass'){
	$pinC = $_POST['pinC'];
}else{
	$CPreport = 'Current pin '.$app->checkParameter($_POST["pinC"], 'number');
}
if($app->checkParameter($_POST["pinCN"], 'number') == 'pass'){
	$pinCN = $_POST['pinCN'];
}else{
	$CPreport = 'New pin '.$app->checkParameter($_POST["pinCN"], 'number');
}
if($app->checkParameter($_POST["pinCNC"], 'number') == 'pass'){
	$pinCNC = $_POST['pinCNC'];
}else{
	$CPreport = 'Confirm new pin '.$app->checkParameter($_POST["pinCNC"], 'number');
}
if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}

$sql = "SELECT * FROM accounts WHERE pass = '$pinC' AND id = ".$_SESSION["usrID"]."";
			$data = $dbObj->query_execute($sql);
			$Row_count = $dbObj->query_rowCount($data);
			if($Row_count > 0) {
				if($pinCN == $pinCNC) {
				$upd_sql = "UPDATE accounts SET pass = '$pinCNC' WHERE id = ".$_SESSION["usrID"]."";
			        if($dbObj->query_execute($upd_sql)) {
							echo 0;
				}else{
				echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Something went wrong, refresh page and try again</div>";
			}	
				}else{
				echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> New PIN does not match</div>";
				}
			}else{
				echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Current PIN is incorrect</div>";
			}
}
?>