<?php
if(isset($_POST["verify"])) {
$email = $_POST["email"];
$stat = 1;
	$result = mysqli_query($con, "SELECT * FROM users u, accounts ac WHERE u.email = '$email' and ac.usr_id = u.uss_id");
    if($result->num_rows == 0) {
	//check table email
    $result = mysqli_query($con, "SELECT * FROM email e, accounts ac WHERE e.email_addr = '$email' and e.em_stat = '$stat' and e.userID = ac.usr_id");
    if($result->num_rows == 0) {
	 $errormsg = "<div class='c-alert c-alert--danger alert'>
<i class='c-alert__icon fa fa-times-circle'></i> Error. No account match the email address provided.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
    } else {
    $row = mysqli_fetch_array($result);
	$ac_em = $row["email_addr"];
	$ac_name = $row["first_name"];
	$v_code = mt_rand();
	$ac_id = base64_encode($row["usr_id"]);
	
		$subject = "Password Recovery";
	$message = file_get_contents('snipnetAPI/template/password-recovery.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%v_code%", base64_encode($v_code), $message); 
	$message = str_replace("%ac_em%", base64_encode($ac_em), $message);
    $message = str_replace("%user_name%", $ac_name, $message); 	
	$message = str_replace("%user_id%", $ac_id, $message);
	$message = str_replace("%user_email%", $ac_em, $message);
	
//Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $ac_em,
			'subject' => $subject,
			'message' => $message
        );
if($perm_email == $perm_act) {
include 'snipnetAPI/email-que.php';
        if($result = curl_exec($ch)){
   mysqli_query($con, "INSERT INTO token(code,source) VALUES('" . base64_encode($v_code) . "','" . base64_encode($ac_em) . "')");
  $successmsg = "<div class='c-alert c-alert--success alert'>
<i class='c-alert__icon fa fa-times-circle'></i> A password reset link has been sent to $ac_em.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
} else {
  $errormsg = "<div class='c-alert c-alert--danger alert'>
<i class='c-alert__icon fa fa-times-circle'></i> Password reset link could not be sent.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
}
}else { 
  $errormsg = "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Error. Email features are disabled <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
	
    }
    } else {
    $row = mysqli_fetch_array($result);
	$ac_em = $row["email"];
	$ac_name = $row["first_name"];
	$v_code = mt_rand();
	$ac_id = base64_encode($row["usr_id"]);
	
	$subject = "Password Recovery";
	$message = file_get_contents('snipnetAPI/template/password-recovery.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%v_code%", base64_encode($v_code), $message); 
	$message = str_replace("%ac_em%", base64_encode($ac_em), $message);
    $message = str_replace("%user_name%", $ac_name, $message); 	
	$message = str_replace("%user_id%", $ac_id, $message); 	
	$message = str_replace("%user_email%", $ac_em, $message);
	
//Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $ac_em,
			'subject' => $subject,
			'message' => $message
        );
if($perm_email == $perm_act) {
include 'snipnetAPI/email-que.php';
        if($result = curl_exec($ch)){
   mysqli_query($con, "INSERT INTO token(code,source) VALUES('" . base64_encode($v_code) . "','" . base64_encode($ac_em) . "')");
  $successmsg = "<div class='c-alert c-alert--success alert'>
<i class='c-alert__icon fa fa-times-circle'></i> A password reset link has been sent to $ac_em.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
} else {
  $errormsg = "<div class='c-alert c-alert--danger alert'>
<i class='c-alert__icon fa fa-times-circle'></i> Password reset link could not be sent.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
}
}else { 
 $errormsg = "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Error. Email features are disabled <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
    }
}
?>
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
                <h1 class="c-login__title">Need help with your password?</h1>
            </header>
            <?php if (isset($errormsg)) { echo $errormsg; } ?>
			<?php if (isset($successmsg)) { echo $successmsg; } ?>
            <form class="c-login__content" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="input1"><b>Enter an email associated with your account, and we’ll help you create a new password.</b></label> 
                    <input class="c-input" name="email" type="email" placeholder="Email" autocomplete="off" required> 
                </div>

                <button class="c-btn c-btn--info c-btn--fullwidth" name="verify" type="submit">Next</button>
<br/><br/>
                <a class="c-login__footer-link u-left" href="index.php">Return to login</a>
            </form>

            <footer class="c-login__footer">
<a href="index.php" >Close</a>
            </footer>
        </div>

        <script src="js/main.min.js?"></script>
    </body>
</html>