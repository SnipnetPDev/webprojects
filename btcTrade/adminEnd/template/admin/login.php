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
        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">

            <div class="container-fluid">
                <div class="row">
               
                    <div class="col-xl-6 pa-0">
                        <div class="auth-form-wrap py-xl-0 py-50">
                            <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                                <div id="load">
                                    <h1 class="display-4 mb-10">BUILD PHP ADMIN</h1>
                                    <p class="mb-30">Please enter your phone number to login.</p>
                                    <div class="form-group">
                                        <div class="input-group">
										<input type="hidden" id="_token" value="<?php echo csrf::token()?>">
                                            <input class="form-control" id="mobile" required placeholder="+234804000000" autocomplete="off">
                                        </div>
										<span id="report"></span>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-25">
                                        <input class="custom-control-input" id="same-address" type="checkbox" checked>
                                        <label class="custom-control-label font-14" for="same-address">Keep me logged in</label>
                                    </div>
                                    <button onclick="login()" class="btn btn-primary btn-block" type="submit">Login</button>
                                    
                                </div>
								<hr/>
									<center><a href="https://snipnetworks.com" target="_BLANK">Need help ?</a></center>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-6 pa-30" style="background:#fff;">
					 <img class="brand-img d-inline-block align-top" src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/dist/img/logo-light.png" alt="BuildPHP Admin" width="" height="" />
					<h1 class="display-4 mb-10">Credits</h1>
                                    <p class="mb-30">
									Build PHP: (v1.0) / Source: <a href="Https://snipnetworks.com/projects/buildphp" target="">https://snipnetworks.com/projects/buildphp</a>
									<hr/>
									Find third party technology used <a href="Https://snipnetworks.com/projects/buildphp" target="">here</a>
									<br/><br/>
                            Follow us: 
                            <a target="_BLANK" href="https://facebook.com/snipnetworks" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                            <a target="_BLANK" href="https://twitter.com/snipnetworks" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                            <a target="_BLANK" href="https://instagram.com/snipnetworks" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-instagram"></i></span></a>
									</p>
					</div>
                </div>
            </div>
        </div>
        <!-- /Main Content -->
    <!-- Owl JavaScript -->
    <script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
    <script src="dist/js/login-data.js"></script>