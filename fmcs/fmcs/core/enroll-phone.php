<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Enroll | Accounts</title>
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
                <h1 class="c-login__title">Account Registration.</h1>
            </header>
<?php
include 'core/super-perm.php';
if (isset($_POST['cphone'])) {
	$live = $_POST['ph'];
$result = mysqli_query($con, "SELECT * FROM users WHERE phone = '$live'");
    if($result->num_rows == 0) {
	$result = mysqli_query($con, "SELECT * FROM phone WHERE phone_num = '$live' and ph_stat = '1'");
    if($result->num_rows == 0) {
	$dd = base64_encode($_POST['dd']);
	$ph= base64_encode($_POST['ph']);
	//live email not encoded where email will be delivered
	$phlive= base64_decode($ph);
	include_once('core/settings.php');
	//required from settings. do not edit/add more lines
	$smsmsg = file_get_contents('snipnetAPI/template/first-reg-sms.txt');
	$smsmsg = str_replace("%b_url%", $b_url, $smsmsg); 
	$smsmsg = str_replace("%site_name%", $b_name, $smsmsg);  
	
	//information needed per request
	$smsmsg = str_replace("%dd%", $dd, $smsmsg); 
	$smsmsg = str_replace("%ph%", $ph, $smsmsg);
	
    // Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $phlive,
			'message' => $smsmsg
        );
if($perm_sms == $perm_act) {
include 'snipnetAPI/snipnet-que.php';
//execute post
    if($result = curl_exec($ch)){
		echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> We sent an SMS to $phlive containing your account setup link.<button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
		mysqli_query($con, "INSERT INTO token(code,source) VALUES('" . base64_encode($dd) . "','" . base64_encode($ph) . "')");
} else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Error. Contact support for assistance <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}else { 
echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Error. SMS features are disabled <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}else {
	  echo "<div class='c-alert c-alert--danger alert'>
<i class='c-alert__icon fa fa-times-circle'></i> Error. Phone number already in use.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
	}
    } else {
   echo "<div class='c-alert c-alert--danger alert'>
<i class='c-alert__icon fa fa-times-circle'></i> Error. Phone number already in use.
<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
}
}
?>
            <form class="c-login__content" method="post" action="">
			 <input value="<?php echo mt_rand(); ?>" name="dd" type="hidden" > 
                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="input1">Enter your mobile number</label> 
                    <input class="c-input" name="ph" type="text" placeholder="Phone number (numbers with formating)" required> 
                </div>

                <button class="c-btn c-btn--info c-btn--fullwidth" name="cphone" type="submit">Continue</button>
<br/><br/>
                <a class="c-login__footer-link u-left" href="index.php">Have an account already?</a>
            </form>

            <footer class="c-login__footer">
<a href="index.php" >Close</a>
            </footer>
        </div>

        <script src="js/main.min.js"></script>
    </body>
</html>