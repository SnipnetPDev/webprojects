<?php 
require_once "../../core/temp_security.php";
use csrfhandler\csrf as csrf;
	if ( isset( $_SESSION['id'] ) && isset( $_SESSION["loggedin"] ) ) {
	if ( isset($_SESSION["loggedin"]) == true) {
	$decoded = base64_decode($_SESSION['id']);
	$decoded = base64_decode($decoded);
	$decoded = base64_decode($decoded);
	$logID = $_SESSION["logID"];
	$sql = "SELECT * FROM accounts a, logged_id l WHERE a.mobile = '$decoded' and a.session = 'active' and l.logNO = a.logNO and l.logNO = '$logID' and a.logNO = '$logID'";
			$data = $dbObj->query_execute($sql);
			$rc_ct = $dbObj->query_rowCount($data);
			if ($rc_ct > 0) { ?>
					<script>window.location = "index";</script>
<?php exit; }
}
}
 ?>
    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container">
        <!-- page content goes here -->
        <div class="banner-hero vh-100 scroll-y bg-white">
            <div class="container h-100">
                <div class="row h-100 h-sm-auto">
                    <div class="col-11 col-sm-8 col-md-6 mx-auto align-self-start">
                    </div>
                    <div class="w-100"></div>
                    <div class="col-11 col-sm-8 col-md-6 mx-auto align-self-center" id="formBody">
                        <h3 class=""><?php echo APP_NAME; ?></h3>
                        <h2 class="font-weight-bold mb-4">Reset Account Pin</h2>

                        <div class="form-group" id="mobileDiv">
                            <label for="inputEmail" class="sr-only">Mobile number</label>
							<input type="hidden" id="_token" value="<?php echo csrf::token()?>">
                            <input type="text" id="mobile" class="form-control" placeholder="+19000000000" required="" autofocus="">
                        </div>
						 <span id="otpDiv"></span>
						<div class="form-group" style="display:none;" id="nPinDiv">
                            <label for="npin" class="sr-only">New Pin</label>
                            <input type="password" id="npin" class="form-control" pattern="\d{4}" maxlength="4" placeholder="New Pin" required="" autofocus="">
                        </div>
                        <div class="form-group" style="display:none;" id="nPinDivC">
                            <label for="Cnpin" class="sr-only">Confirm </label>
                            <input type="password" id="Cnpin" onkeyup="checkPinMatch(this.value);" pattern="\d{4}" maxlength="4" class="form-control" placeholder="Confirm New Pin" required="">
                        </div>
						 <span id="pinChkDiv"></span>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-11 col-sm-8 col-md-6 mx-auto align-self-end">
                        <div class="mb-4" id="nextBtn">
                            <a href="#" onclick="sendOtp()" class=" btn btn-lg btn-default default-shadow btn-block">Next <span class="ml-2 icon arrow_right"></span></a>
                        </div>
						<div class="mb-4" style="display:none;" id="resetBtn">
                            <a href="#" onclick="resetPin()" class=" btn btn-lg btn-default default-shadow btn-block">Reset Pin <span class="ml-2 icon arrow_right"></span></a>
                        </div>
                        <div class="mb-4">
                            <p>Back to <a href="#" onclick="page('login')">login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End of page content -->