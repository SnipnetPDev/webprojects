<?php
@ob_start();
session_start();
if(isset($_SESSION['usr_id'])!="") {
	echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
}

include_once '../../db/index.php';
include('core/settings.php');
//check if form is submitted
if (isset($_POST['login'])) {
if ($_POST['loginid'] == "N/A") {
	$loginid = "wrong credentials";
}
else {
	$loginid = mysqli_real_escape_string($con, $_POST['loginid']);
}
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT * FROM users WHERE ( loginid='$loginid' OR email = '$loginid' OR phone = '$loginid' OR name = '$loginid') and password = '" . md5($password) . "'" );

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['uss_id'];
		$_SESSION['usr_name'] = $row['name'];
		$_SESSION['usr_email'] = $row['email'];
		$_SESSION['usr_phone'] = $row['phone'];
		$_SESSION['usr_loginid'] = $row['loginid'];
		$_SESSION['imgname'] = $row['imgname'];
		$_SESSION['usr_role'] = $row['role'];
		$_SESSION['ioncon'] = "Li4vYWRtaW4vcGx1Z2lucy9pQ2hlY2svc3Bpbm5lcm1vYmlsZS5waHA=";
		$_SESSION['loader'] = "Li4vLi4vaW52YWxpZC5waHA=";
		echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
	} else {
		$errormsg = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Error!</h4>
                Incorrect login credentials.
              </div>
";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $site_title; ?> | Administrative Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><?php echo $site_title; ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
<?php if (isset($errormsg)) { echo $errormsg; } ?>
    <form name="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="loginid" placeholder="Login ID, Username, Email or Phone number">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-danger btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="https://snipnetworks.com" target="_BLANK" class="text-center">Register a new license</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
