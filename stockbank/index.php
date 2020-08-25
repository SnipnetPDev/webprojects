<?php
@ob_start();
session_start();
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Account Login</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="loginAssets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/css/util.css">
	<link rel="stylesheet" type="text/css" href="loginAssets/css/main.css">
</head>
<?php

if(isset($_SESSION['usr_id'])!="") {
	header("Location: security.php");
}

include_once 'accounts/db/index.php';

//check if form is submitted
if (isset($_POST['login'])) {

	$loginid = mysqli_real_escape_string($con, $_POST['loginid']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM users WHERE loginid = '" . $loginid. "' and password = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $row['name'];
		$_SESSION['usr_email'] = $row['email'];
		$_SESSION['usr_phone'] = $row['phone'];
		$_SESSION['usr_loginid'] = $row['loginid'];
		$_SESSION['usr_country'] = $row['country'];
		$_SESSION['usr_lock'] = $row['alock'];
		$_SESSION['imgname'] = $row['imgname'];
		$_SESSION['id_front'] = $row['id_front'];
		$_SESSION['id_back'] = $row['id_back'];
		header("Location: security.php");
	} else {
		$errormsg = "<div class='alert alert-danger'><b><center>Incorrect Login ID or Password combination!</b></center></div>";
	}
}
?>
<body>
  	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				
          <form role="form" name="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="login100-form validate-form">
		  
					<span class="login100-form-title p-b-34">
					<!-- GTranslate: https://gtranslate.io/ -->
<style type="text/css">
<!--
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
.goog-te-gadget-icon {background-image:url(//gtranslate.net/flags/gt_logo_19x19.gif) !important;background-position:0 0 !important;}
body {top:0 !important;}
-->
</style>
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay: false, includedLanguages: ''}, 'google_translate_element');}
</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

					<br/>
					<br/>
					 <center><img src="accounts/home/assets/img/logo.png" width="190px" height="63px" /></center>
					 <br/>
						Account Login
						<br/>
						<br/>
						<small><?php if (isset($errormsg)) { echo $errormsg; } ?></small>
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="loginid" placeholder="Login ID">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button name="login" type="submit" class="login100-form-btn">
							Sign in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="forgotPWD.php" class="txt2">
							User name / password?
						</a>
						<br/>
						<br/>
						<br/>
						<a href="enroll.php" class="txt3">
							Sign Up
						</a>
					</div>

				</form>

				<div class="login100-more" style="background-image: url('images/login/2.jpg');"></div>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
	<script src="loginAssets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="loginAssets/vendor/animsition/js/animsition.min.js"></script>
	<script src="loginAssets/vendor/bootstrap/js/popper.js"></script>
	<script src="loginAssets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="loginAssets/vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
	<script src="loginAssets/vendor/daterangepicker/moment.min.js"></script>
	<script src="loginAssets/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="loginAssets/vendor/countdowntime/countdowntime.js"></script>
	<script src="loginAssets/js/main.js"></script>
</body>

</html>