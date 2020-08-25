<?php
$dd = $_REQUEST['dd'];
if (empty($_REQUEST['em'])) {
	$source = $_REQUEST['ph'];
} else {
	$source = $_REQUEST['em'];
	
}
$sel_query="Select * from token WHERE code = '" . mysqli_escape_string($con,$dd) . "' AND source = '" . mysqli_escape_string($con,$source) . "';";
$result = mysqli_query($con,$sel_query);
if($row = mysqli_fetch_assoc($result)) {
?>
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
                    <img src="img/logo.png" alt="Logo">
                </a>
                <h1 class="c-login__title">Begin Registration.</h1>
            </header>
<?php
include_once 'accounts/db/index.php';
//set validation error flag as false

$error = false;
//check if form is submitted
if (isset($_POST['signup'])) {
	$loginid = mysqli_real_escape_string($con, $_POST['loginid']);
	$imgname = mysqli_real_escape_string($con, $_POST['imgname']);
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']);
	$role = mysqli_real_escape_string($con, "2");
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	$dd = mysqli_real_escape_string($con, $_POST['dd']);
	$autopass = md5($password);
    if($password != $cpassword) {
		$error = true;
		$cpassword_error = "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i>Error, Password does not match.<button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
	}
	if (!$error) {
		if(mysqli_query($con, "INSERT INTO users(loginid,imgname,name,email,phone,role,password) VALUES('" . $loginid . "','" . $imgname . "', '" . $name . "', '" . $email . "', '" . $phone . "', '" . $role . "', '" . md5($password) . "')")) {
		$succmsg = "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i>Please wait while you're being redirected....<button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>
		<meta http-equiv='refresh' content='2; url=?autologin=1&loginid=$loginid&password=$password' />
		";
		$query = "DELETE FROM token WHERE code= '" . $dd . "'"; 
        $result = mysqli_query($con,$query) or die ( mysqli_error($con));
		} else {
			$errormsg = "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i>Sorry, we cannot grant your request at this time. Please try again later.<button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
		}
	//live email not encoded where email will be delivered
	$emlive= $email;
	include_once('core/settings.php');
	$subject = "Welcome to $b_name";
	$message = file_get_contents('snipnetAPI/template/second-reg-email.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%client_name%", $name, $message); 
	$message = str_replace("%login_id%", $loginid, $message);
    $message = str_replace("%user_email%", $emlive, $message);
	$message = str_replace("%user_phone%", $phone, $message);

	//Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $emlive,
			'subject' => $subject,
			'message' => $message
        );
if($perm_email == $perm_act) {
include 'snipnetAPI/email-que.php';
$result = curl_exec($ch);
}else { }
	$SMS = file_get_contents('snipnetAPI/template/second-reg-sms.txt');
	
	//required from settings. do not edit/add more lines
	$SMS = str_replace("%b_url%", $b_url, $SMS); 
	
	//information needed per request
	$SMS = str_replace("%client_name%", $name, $SMS); 
	$SMS = str_replace("%login_id%", $loginid, $SMS);
	$SMS = str_replace("%user_phone%", $phone, $SMS);
	
	    // Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $phone,
			'message' => $SMS
        );
if($perm_sms == $perm_act) {
include 'snipnetAPI/snipnet-que.php';
	$result = curl_exec($ch);
}else { }
}
}

?>
		<?php 
		if (isset($succmsg)) { echo $succmsg; }
		if (isset($errormsg)) { echo $errormsg; } 
		if (isset($cpassword_error)) { echo $cpassword_error; } 
		?>
            <form class="c-login__content" name="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="imgname" value="default.png" />
		  <input type="hidden" name="v" value="verified" />
		  <input type="hidden" name="dd" value="<?php echo $_REQUEST['dd']; ?>" />
		  <input type="hidden" class="loginid" name="loginid" value"" ID="loginidx" MAXLENGTH=12 SIZE=12/>
                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="input2">Username</label> 
                    <input class="c-input" name="name" type="text" placeholder="Johny1280" required> 
                </div>
				<?php 
				if (isset($_REQUEST['em'])){
                   echo "<div class='c-field u-mb-small'>
				   <label class='c-field__label' for='input2'>Email</label> 
                    <input class='c-input' name='email' type='email' value='".base64_decode($_REQUEST['em'])."' readonly>
                    <input class='c-input' name='phone' type='hidden' value='N/A'>
					<input type='hidden' name='em' value='".$_REQUEST['em']."' />
					</div>";
				} else if(isset($_REQUEST['ph'])){
				echo "<div class='c-field u-mb-small'>
				<label class='c-field__label' for='input2'>Mobile Number</label> 
                    <input class='c-input' name='phone' type='text' value='".base64_decode($_REQUEST['ph'])."' readonly> 
					</div>
					<div class='c-field u-mb-small'>
					<label class='c-field__label' for='input2'>Email Address</label> 
					<input class='c-input' name='email' type='text' placeholder='someone@example.com'>
					<input type='hidden' name='ph' value='".$_REQUEST['ph']."' />
					</div>
					";
				} else { echo "<meta http-equiv='refresh' content='0; url=enroll.php' />"; }
				?>
                
                <div class="c-field u-mb-small">
                    <label class="c-field__label" for="input2">Password</label> 
                    <input class="c-input" name="password" type="password" id="input2" placeholder="********" required> 
                </div>
				<div class="c-field u-mb-small">
                    <label class="c-field__label" for="input2">Confirm Password</label> 
                    <input class="c-input" name="cpassword" type="password" id="input2" placeholder="********" required> 
                </div>

                <button class="c-btn c-btn--info c-btn--fullwidth" name="signup" type="submit">Continue</button>
            </form>

            <footer class="c-login__footer">
<a href="../" >Close</a>
            </footer>
        </div>

        <script src="js/main.min.js"></script>
    </body>
	<script>
function randomNumber(len) {
    var randomNumber;
    var n = '';

    for(var count = 0; count < len; count++) {
        randomNumber = Math.floor(Math.random() * 10);
        n += randomNumber.toString();
    }
    return n;
}

document.getElementById("loginidx").value = randomNumber(12);
</script>
</html>
<?php } else {
	?>
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
            <header class="c-login__head">
                <a class="c-login__brand" href="#!">
                    <img src="img/logo.png" alt="Dashboard's Logo">
                </a>
                <h1 class="c-login__title">Begin Registration.</h1>
            </header>
<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i>Error, this link is Invalid or expired.<button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>
            <footer class="c-login__footer">
<a href="../" >Close</a>
            </footer>
        </div>

        <script src="js/main.min.js"></script>
    </body>
</html>
<?php
}
?>