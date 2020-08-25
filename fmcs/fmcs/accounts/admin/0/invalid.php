<?php
require('../../db/index.php');
include('core/settings.php');
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
<div class="">
<br/><br/><br/><br/>
  <div class="login-logo">
    <a href="index.php"><img src="../../../img/logo.png" alt="<?php echo $site_title; ?>" width="200px" height=""/></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
<section class="content">

      <div class="error-page">
        <h2 class="headline text-red">E13</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-red"></i> UNAUTHORISED USE OF SOFTWARE.</h3>

          <p>
            Enter your license key to active this product or <a href="http://www.snipnetworks.com" TARGET="_Blank">purchase a new license</a> key now.
          </p>

          <form class="search-form" action="license/index.php">
		  <input type="hidden" name="l_agency" value="https://snipnetworks.com">
            <div class="input-group">
			<div class="col-xs-2">
                  <input type="text" class="form-control" name="1" maxlength="4">
             </div>
			<div class="col-xs-2">
                  <input type="text" class="form-control" name="2" maxlength="4">
             </div>
			 <div class="col-xs-2">
                  <input type="text" class="form-control" name="3" maxlength="4">
             </div>
			 <div class="col-xs-2">
                  <input type="text" class="form-control" name="4" maxlength="4">
              </div>
			  <div class="col-xs-2">
                  <input type="text" class="form-control" name="5" maxlength="4">
                </div>
				<div class="col-xs-2">
                  <input type="text" class="form-control" name="6" maxlength="4">
                </div>
              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-save"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
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
