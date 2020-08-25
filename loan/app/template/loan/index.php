<?php
ob_start();
session_start();
require_once "../../core/config.php";
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
?>
    <!-- Begin page content -->
    <main class="flex-shrink-0 pb-0">
                <div class="container mt-4">
				<br/>
				 <h5 class="page-subtitle"><span id="greeting"></span><br>
                        <span class="text-mute small mt-2"><?php echo $usrdata[0]['lastName']; ?></span>
                    </h5>
                    <div class="card border-0 bg-light-primary text-black" style="color:#000;">
                        <div class="card-body">
                            <p class="mb-2">You can borrow up-to <small class="text-mute">(Today)</small></p>
                            <div class="row mb-2">
                                <div class="col">
                                    <h1>$ <span id="Borrowlimit"></span></h1>
                                </div>
                                <div class="col-auto align-self-center position-relative">
                                    <div class="sparkline" id="sparklines1"></div>
                                </div>
                            </div>
                            <div class="progress bg-light-primary h-5 mb-2">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
                            </div>
                            <p><span class="text-mute">Verification level </span> <span class="float-right">80% Complete</span></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <h6 class="page-subtitle">Loan History</h6>
                    <div class="card shadow-sm border-0 mb-4" id="loanHistory">
<?php
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
?>
                    </div>
                </div>
                <br/><br/>

        <div class="toast bottom-center position-fixed mb-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-header">
                <div class="avatar avatar-20 mr-2">
                    <div class="background">
                        <img src="assets/img/team3.jpg" class="rounded mr-2" alt="...">
                    </div>
                </div>
                <strong class="mr-auto"><?php echo APP_NAME; ?></strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Welcome to <?php echo APP_NAME; ?>, having issues ? kindly use the help section on our website
            </div>
        </div>
    </main>
    <!-- End of page content -->
<script>
  var greeting;
  var time = new Date().getHours();
  if (time < 10) {
    greeting = "Good morning!";
  } else if (time < 20) {
    greeting = "Good day!";
  } else {
    greeting = "Good evening!";
  }
  document.getElementById("greeting").innerHTML = greeting;
 </script>