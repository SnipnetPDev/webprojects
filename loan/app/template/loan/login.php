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
                    <div class="col-11 col-sm-8 col-md-6 mx-auto align-self-center">
                        <h3 class="">Welcome to</h3>
                        <h2 class="font-weight-bold mb-4"><?php echo APP_NAME; ?></h2>
                        <p class="mb-4">login to your account using the phone number associated with your loan application.</p>

                        <div class="form-group">
                            <label for="inputEmail" class="sr-only">Mobile number</label>
							<input type="hidden" id="_token" value="<?php echo csrf::token()?>">
                            <input type="text" id="mobile" class="form-control" placeholder="+19000000000" required="" autofocus="">
                        </div>
                        <div class="form-group">
                           <span id="report"></span>
                        </div>
                        <div class="my-3 row">
                            <div class="col-6 col-md py-1 text-left">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                                    <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 col-md py-1 text-right text-md-right">
                                <a href="#" onclick="page('resetPin')">Pin Reset</a>
                            </div>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-11 col-sm-8 col-md-6 mx-auto align-self-end" id="load">
                        <div class="mb-4">
                            <button onclick="login()" type="button" class=" btn btn-lg btn-default default-shadow btn-block">Sign In <span class="ml-2 icon arrow_right"></span></button>
                        </div>
                        <div class="mb-4">
                            <p>Need a quick loan?<br>Start your application <a  href="../web/application" target="_BLANK">Here</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End of page content -->