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
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="css/main.min.css">
    </head>

    <body class="c-login-wrapper">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
<div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div><script type='text/javascript'>setTimeout(function(){{var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=False&ui=true&settings=undefined&from=en';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); }},0);</script>
        <div class="c-login">
<?php
error_reporting(0);
ini_set('display_errors', 0);
include_once 'accounts/db/index.php';
include_once('core/settings.php');
include 'core/super-perm.php';
if($_REQUEST["v"] == "email") {
	$v_code = base64_decode($_REQUEST["token"]);
	$email = base64_decode($_REQUEST["id"]);
	$stat = 1;
	$stato = 0;
?>
<header class="c-login__head">
                <a class="c-login__brand" href="#!">
                    <img src="img/logo.png" alt="Dashboard's Logo">
                </a>
                <h1 class="c-login__title">Email Verification</h1>
            </header>
<?php
	$result = mysqli_query($con, "SELECT * FROM email WHERE em_id = '$v_code' and email_Addr = '$email' and em_stat = '$stato'");
    if($result->num_rows == 0) {
	$errormsg = "<div class='c-alert c-alert--danger alert'>
<i class='c-alert__icon fa fa-times-circle'></i> Error. This link is dead.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
	}else {
		$update="update email set em_stat='".$stat."' where em_id='".$v_code."'";
        if(mysqli_query($con, $update) or die(mysqli_error())) {
		echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> $email has been verified successfully. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
		}else {
		echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> $email could not be verified at this time. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
		}
	}
?>
 <?php if (isset($errormsg)) { echo $errormsg; } else { } ?>

<?php
}elseif($_REQUEST["v"] == "phone") {
	$v_code = base64_decode($_REQUEST["token"]);
	$phone = base64_decode($_REQUEST["id"]);
	$stat = 1;
	$stato = 0;
?>
<header class="c-login__head">
                <a class="c-login__brand" href="#!">
                    <img src="img/logo.png" alt="Dashboard's Logo">
                </a>
                <h1 class="c-login__title">Mobile Number Verification</h1>
            </header>
<?php
	$result = mysqli_query($con, "SELECT * FROM phone WHERE ph_id = '$v_code' and phone_num = '$phone' and ph_stat = '$stato'");
    if($result->num_rows == 0) {
	$errormsg = "<div class='c-alert c-alert--danger alert'>
<i class='c-alert__icon fa fa-times-circle'></i> Error. This link is dead.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
	}else {
		$update="update phone set ph_stat='".$stat."' where ph_id='".$v_code."'";
        if(mysqli_query($con, $update) or die(mysqli_error())) {
		echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> $phone has been verified successfully. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
		}else {
		echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> $phone could not be verified at this time. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
		}
	}
?>
<?php if (isset($errormsg)) { echo $errormsg; } else { } ?>
<?php
}elseif($_REQUEST["v"] == "resetpass") {
	$v_code = $_REQUEST["v_code"];
	$email = $_REQUEST["em"];
	$email_dec = base64_decode($_REQUEST["em"]);
	$user_id = base64_decode($_REQUEST["id"]);
	$result = mysqli_query($con, "SELECT * FROM users u, token tk WHERE tk.code = '$v_code' and tk.source = '$email' and u.uss_id = '$user_id'");
    if($result->num_rows == 0) {
	$errormsg = "<div class='c-alert c-alert--danger alert'>
<i class='c-alert__icon fa fa-times-circle'></i> Error. This link is dead.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
	}else {
		
	}

if(isset($_POST['verify'])) {
$usr_id = $user_id;
$new_pass =$_REQUEST['password'];
$cnew_pass =$_REQUEST['c_password'];
?>
<header class="c-login__head">
                <a class="c-login__brand" href="#!">
                    <img src="img/logo.png" alt="Dashboard's Logo">
                </a>
                <h1 class="c-login__title">Password Recovery</h1>
            </header>
<?php
	if($new_pass == $cnew_pass) {
$update="update users set password='".md5($new_pass)."' where uss_id='".$usr_id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
	$query = "DELETE FROM token WHERE code= '" . $v_code . "'"; 
     $result = mysqli_query($con,$query) or die ( mysqli_error($con));
echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Password changed successfully. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";

    $subject = "Password Changed";
	$message = file_get_contents('snipnetAPI/template/password-recovery-complete.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%user_email%", $email_dec, $message);
	
//Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $email_dec,
			'subject' => $subject,
			'message' => $message
        );
if($perm_email == $perm_act) {
include 'snipnetAPI/snipnet-que.php';
}else { }
} else {
echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to change password, contact support. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";

}
} else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> New password does not match. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}

}
?>
            <?php if (isset($errormsg)) { echo $errormsg; } else { ?>
            <form class="c-login__content" method="post" action="">
                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="input1"><b>New Password.</b></label> 
                    <input class="c-input" name="password" type="password" id="input1" placeholder="New Password" autocomplete="off" required> 
                </div>
				<div class="c-field u-mb-small">
                    <label class="c-field__label" for="input1"><b>Confirm New Password.</b></label> 
                    <input class="c-input" name="c_password" type="password" id="input1" placeholder="Confirm New Password" autocomplete="off" required> 
                </div>

                <button class="c-btn c-btn--info c-btn--fullwidth" name="verify" type="submit">Next</button>
<br/><br/>
                <a class="c-login__footer-link u-left" href="index.php">Return to login</a>
            </form>
			<?php } ?>
<?php }else {
  echo "<meta http-equiv='refresh' content='0;URL=index.php' />";
}
	?>

            <footer class="c-login__footer">
<a href="index.php" >Close</a>
            </footer>
        </div>

        <script src="js/main.min.js?"></script>
    </body>
</html>