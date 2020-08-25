<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Log in | Accounts</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="css/main.min.css">
    </head>
<?php

if(isset($_SESSION['usr_id'])!="") {
	 echo "<meta http-equiv='refresh' content='0;URL=accounts/home/index.php' />";
}

include_once 'accounts/db/index.php';

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
		header("Location: accounts/home/index.php");
	} else {
		$errormsg = "<div class='c-alert c-alert--danger alert'>
                        <i class='c-alert__icon fa fa-times-circle'></i> Error. Incorrect login credentials.

                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>";
	}
}
?>
    <body class="c-login-wrapper">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
<div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div><script type='text/javascript'>setTimeout(function(){{var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=False&ui=true&settings=undefined&from=en';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); }},0);</script>
        <div class="c-login">
            <header class="c-login__head">
                <a class="c-login__brand" href="#!">
                    <img src="img/logo.png" alt="Dashboard's Logo">
                </a>
                <h1 class="c-login__title">Welcome back! Please login.</h1>
            </header>
            <?php if (isset($errormsg)) { echo $errormsg; } ?>
            <form class="c-login__content" name="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="input1"><b>Login ID</b>, <b>Username</b>, <b>Email</b> or <b>Phone number</b></label> 
                    <input class="c-input" name="loginid" type="text" id="input1" placeholder="Login ID, Username, Email or Phone number" autocomplete="off" required> 
                </div>

                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="input2">Password</label> 
                    <input class="c-input" name="password" type="password" id="input2" placeholder="********" required> 
                </div>

                <button class="c-btn c-btn--info c-btn--fullwidth" name="login" type="submit">Secure Sign In</button>
<br/><br/>
                <a class="c-login__footer-link u-left" href="enroll.php">Don’t have an account yet?</a>
				<br/>
                <a class="c-login__footer-link u-right" href="forgotPWD.php">Forgot Password?</a>
            </form>

            <footer class="c-login__footer">
<a href="index.php" >Close</a>
            </footer>
        </div>

        <script src="js/main.min.js?"></script>
    </body>
</html>