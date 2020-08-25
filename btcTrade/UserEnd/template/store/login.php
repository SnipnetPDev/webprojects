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
					<script>window.location = "console";</script>
<?php exit; }
}
}
 ?>
     <div class="subheader">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="subheader-wrapper">
                        <h3>Login to your account</h3>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sub-header -->
    <!-- product list part start-->
    <section class="about_us" style="padding:5%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="about_us_content">
						<div class="mt-10">
							 <div id="load">
                        <h3>Please enter your phone number to login or create a new account.</h3>
     
          <div class="vertical-input-group">
            <div class="input-group">
			<input type="hidden" id="_token" value="<?php echo csrf::token()?>">
              <input class="form-control" id="mobile" required placeholder="+19205410000" autocomplete="off">
            </div>
			<span id="report"></span>
          </div>
          <center><button onclick="login()" class="btn btn-outline-primary shadow-none mt-2" type="button">Next</button></center>

		 </div>
						</div>
						<center style="padding:30px;">
						<a href="javascript:void(0);" onclick="page('support')">Need help ?</a>
                    </center>
                 </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product list part end-->