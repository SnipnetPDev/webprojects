<?PHP
session_start();
require_once "config.php";
require "http_security.php";
$dbObj = new DB();
if (isset($_POST['auth']) == 'yes') {
	if ( isset( $_SESSION['id'] ) && isset( $_SESSION["loggedin"] ) ) {
	if ( isset($_SESSION["loggedin"]) == true) {
	$decoded = base64_decode($_SESSION['id']);
	$decoded = base64_decode($decoded);
	$decoded = base64_decode($decoded);
	$logID = $_SESSION["logID"];
	$sql = "SELECT * FROM accounts a, logged_id l WHERE a.mobile = '$decoded' and a.session = 'active' and l.logNO = a.logNO and l.logNO = '$logID' and a.logNO = '$logID'";
			$data = $dbObj->query_execute($sql);
			$rc_ct = $dbObj->query_rowCount($data);
			if ($account = $data->fetch_assoc()) {
			if ($rc_ct > 0) {
				$_SESSION["usrID"] = $account["id"];
				if($account["pass"] == ''){
					session_regenerate_id();
					echo 3;
				}elseif($account["status"] == 'locked'){
					echo 'locked';
				}else{
					session_regenerate_id();
					echo true;
				}
			}else{
				echo 2;
			}
		}else{
				echo 2;
			}
}else {
	echo 2;
}
}else {
	echo 2;
}
}else {
	echo 2;
}
?>