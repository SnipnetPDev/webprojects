<?php
@ob_start();
session_start();
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Online Registration - Instant Online Banking</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <!-- build:css({.tmp,app}) styles/app.min.css -->
  <link rel="stylesheet" href="styles/webfont.css">
  <link rel="stylesheet" href="styles/climacons-font.css">
  <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="styles/font-awesome.css">
  <link rel="stylesheet" href="styles/card.css">
  <link rel="stylesheet" href="styles/sli.css">
  <link rel="stylesheet" href="styles/animate.css">
  <link rel="stylesheet" href="styles/app.css">
  <link rel="stylesheet" href="styles/app.skins.css">
  <!-- endbuild -->
</head>

<body class="page-loading">
  <!-- page loading spinner -->
  <div class="pageload">
    <div class="pageload-inner">
      <div class="sk-rotating-plane"></div>
    </div>
  </div>
  <!-- /page loading spinner -->
  <div class="app signup v2 usersession">
    <div class="session-wrapper">
      <div class="session-carousel slide" data-ride="carousel" data-interval="3000">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active" style="background-image:url(images/enroll/1.jpg);background-size:cover;background-repeat: no-repeat;background-position: 0% 0%;">
<div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div><script type='text/javascript'>setTimeout(function(){{var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=False&ui=true&settings=undefined&from=en';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); }},0);</script>
		  </div>
        </div>
      </div>
      <div class="card bg-white no-border">
	  <br/>
	  <center><img src="accounts/home/assets/img/logo.png" width="190px" height="63px" /></center>
	  <br/>
        <div class="">
		<?php

if(isset($_SESSION['usr_id'])) {
	header("Location: complete.php");
}

include_once 'accounts/db/index.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	$loginid = mysqli_real_escape_string($con, $_POST['loginid']);
	$imgname = mysqli_real_escape_string($con, $_POST['imgname']);
	$id_front = mysqli_real_escape_string($con, $_POST['id_front']);
	$id_back = mysqli_real_escape_string($con, $_POST['id_back']);
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['password']);
	$country = mysqli_real_escape_string($con, $_POST['country']);
	
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$name_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		if(mysqli_query($con, "INSERT INTO users(loginid,imgname,id_front,id_back,name,email,phone,password,country) VALUES('" . $loginid . "','" . $imgname . "','" . $id_front . "','" . $id_back . "', '" . $name . "', '" . $email . "', '" . $phone . "', '" . md5($password) . "', '" . $country . "')")) {
			$successmsg = "<div class='alert alert-success'><b><center>Registration Complete, kindly check your email for account login information.</b></center></div>";
		} else {
			$errormsg = "<div class='alert alert-danger'><b><center>Sorry, we cannot grant your request at this time. Please try again later.</b></center></div>";
		}
	}
	
$sel_query="Select * from settings ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

$b_email = $row["email"];
$b_url = $row["b_url"];
$b_name = $row["title"];
$b_address = $row["address"];
$short_name = $row["short_name"];
$mailer_host = $row["mailer_host"];
$mailer_port = $row["mailer_port"];
$mailer_id = $row["mailer_id"];
$mailer_pass = $row["mailer_pass"];
$b_phone = $row["phone"];

require 'Mailer/class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = $mailer_port;                    // set the SMTP server port
	$mail->Host       = "$mailer_host"; // SMTP server
	$mail->Username   = "$mailer_id";     // SMTP server username
	$mail->Password   = "$mailer_pass";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("$b_email","$short_name");

	$mail->From       = "$b_email";
	$mail->FromName   = "$short_name";

	$to = "$email";

	$mail->AddAddress($to);

	$mail->Subject  = "Welcome to $b_name";

	$mail->AltBody    = "$b_name"; 
	$mail->WordWrap   = 80; 
	$body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  </head>
  <body style='position: absolute;
    left: 0px;
    width: 620px;
    border: 3px solid #73AD21;
    padding: 10px;' paddingwidth='0' paddingheight='0' style='padding-top: 0 !important; padding-bottom: 0 !important; width: 100% !important; -webkit-text-size-adjust: 100% !important; -ms-text-size-adjust: 100% !important; -webkit-font-smoothing: antialiased !important; background-repeat: repeat; margin: 0;' offset='0' toppadding='0' leftpadding='0'>
    <table bgcolor='#ffffff' width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent' align='center' style='font-family: Helvetica, Arial,serif;'>
  <tbody>
    <tr>
      <td><table width='600' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#ffffff' class='MainContainer'>
  <tbody>
    <tr>
      <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tbody>
    <tr>
      <td valign='top' width='40'>&nbsp;</td>
      <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tbody>
     
    <tr>
    	<td height='75' class='spechide'></td>
        
        
    </tr>
    <tr>
      <td class='movableContentContainer ' valign='top'>
	          <div class='movableContent' style='padding-top: 0px; position: relative; margin: 0; border: 0px;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
                          <tr>
                            <td valign='top' align='center'>
                              <div class='contentEditableContainer contentImageEditable' style='margin: 0;'>
                                <div class='contentEditable' style='margin: 0;'>
                                  <img src='$b_url/mya/accounts/home/assets/img/logo.png' width='200' height='70' alt='' data-default='placeholder' data-max-width='560' style='display: block !important; outline: none !important; border: 0;' />
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
        </div>
      	<div class='movableContent' style='padding-top: 0px; position: relative; margin: 0; border: 0px;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tbody>
    <tr>
      <td height='35'></td>
    </tr>
    <tr>
      <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tbody>
    <tr>
      <td valign='top' align='center' class='specbundle'><div class='contentEditableContainer contentTextEditable' style='margin: 0;'>
                                <div class='contentEditable' style='margin: 0;'>
                                  <p style='text-align: left; font-family: Georgia,Time,sans-serif; font-size: 40px; color: #222222; font-weight: normal; line-height: 19px; margin: 0;' align='center'><span class='specbundle2'><span class='font1' style='font-size: 18px !important; line-height: 22px !important;'>Welcome to&nbsp;</span> <span class='font' style='font-size: 18px !important; line-height: 22px !important;'>$b_name</span></span></p>
                                </div>
                              </div></td>

    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
        </div>
        <div class='movableContent' style='padding-top: 0px; position: relative; margin: 0; border: 0px;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
                          <tr><td height='5'></td></tr>
                          <tr>
                            <td align='left'>
                              <div class='contentEditableContainer contentTextEditable' style='margin: 0;'>
                                <div class='contentEditable' align='center' style='margin: 0;'>
                                  <h2 style='text-align: left; color: #222222; font-size: 19px; font-weight: normal;' align='left'>Let's complete your account setup.</h2>
                                </div>
                              </div>
                            </td>
                          </tr>

                          <tr><td height='15'> </td></tr>

                          <tr>
                            <td align='left'>
                              <div class='contentEditableContainer contentTextEditable' style='margin: 0;'>
                                <div class='contentEditable' align='center' style='margin: 0;'>
                                  <p style='color: #999999; text-align: left; font-size: 14px; font-weight: normal; line-height: 19px; margin: 0;' align='left'>    
                                    Login using your login ID and password to complete your account registration.
                                    <br>
                                    <br>
                                    Login ID: $loginid
									<br>
                                    PASSWORD: ************
                                    <br>
                                    <br>
                                    Regards,
                                    <br>
                                    <span style='color: #222222;'>Account Support Team</span>
                                  </p>
                                </div>
                              </div>
                            </td>
                          </tr>

                          <tr><td height='55'></td></tr>

                          <tr>
                            <td align='center'>
                              <table>
                                <tr>
                                  <td align='center' bgcolor='#1A54BA' style='background-color: #DC2828; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; padding: 15px 18px;'>
                                    <div class='contentEditableContainer contentTextEditable' style='margin: 0;'>
                                      <div class='contentEditable' align='center' style='margin: 0;'>
                                        <a target='_blank' href='$b_url/mya/' class='link2' style='color: #ffffff; font-size: 16px; text-decoration: none;'>Login to your Account</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr><td height='20'></td></tr>
                        </table>
        </div>
        <div class='movableContent' style='padding-top: 0px; position: relative; margin: 0; border: 0px;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tbody>
    <tr>
      <td height='65'>
    </tr>
    <tr>
      <td style='border-bottom-width: 1px; border-bottom-color: #DDDDDD; border-bottom-style: solid;'></td>
    </tr>
    <tr><td height='25'></td></tr>
    <tr>
      <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tbody>
    <tr>
      <td valign='top' class='specbundle'><div class='contentEditableContainer contentTextEditable' style='margin: 0;'>
                                      <div class='contentEditable' align='center' style='margin: 0;'>
                                        <p style='text-align: left; color: #CCCCCC; font-size: 12px; font-weight: normal; line-height: 20px; margin: 0;' align='left'>
                                          <span style='font-weight: bold;'>$b_name</span>
                                          <br>
                                          $b_address
										  </p>
                                      </div>
                                    </div></td>
      <td valign='top' width='30' class='specbundle'>&nbsp;</td>
      <td valign='top' class='specbundle'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tbody>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
    <tr><td height='88'></td></tr>
  </tbody>
</table>

        </div>
        
        
      
      </td>
    </tr>
  </tbody>
</table>
</td>
      <td valign='top' width='40'>&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>

      
<style type='text/css'>
body { padding-top: 0 !important; padding-bottom: 0 !important; margin: 0 !important; width: 100% !important; -webkit-text-size-adjust: 100% !important; -ms-text-size-adjust: 100% !important; -webkit-font-smoothing: antialiased !important; }
</style>
</body>
      </html>";
	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}

}
}

?>
		<?php if (isset($errormsg)) { echo $errormsg; } ?>
		<?php if (isset($successmsg)) { echo $successmsg; } ?>
          <form role="form" class="form-layout" method="POST" enctype="multipart/form-data">
		  <input type="hidden" name="imgname" value="default.png" />
		  <input type="hidden" name="id_front" value="id_front.png" />
		  <input type="hidden" name="id_back" value="id_back.png" />
		  <input type="hidden" class="loginid" name="loginid" value"" ID="loginidx" MAXLENGTH=12 SIZE=12/>
<input type="hidden" name="country" value="N/A" />
            <div class="text-center m-b">
              <h4 class="text-uppercase">Enroll Now</h4>
              <p>Instant online banking accounts.</p>
            </div>
            <div class="form-inputs">
                <label class="text-uppercase">Name</label>
                <input name="name" type="text" class="form-control input-lg" placeholder="JOHN DOE" required>
       
              <label class="text-uppercase">Your email address</label>
              <input name="email" type="email" class="form-control input-lg" placeholder="someone@example.com" required>
			  <label class="text-uppercase">Your phone number <small>Without + before country code Ex: 18002000000</small></label>
              <input name="phone" type="text" class="form-control input-lg" placeholder="18002000000" required>
              <label class="text-uppercase">Create a password</label>
              <input name="password" type="password" class="form-control input-lg" placeholder="************" required>
            </div>
            <button name="signup" class="btn btn-danger btn-block btn-lg m-b" type="submit">Open Account</button>
			<div class="divider">
              <span>OR</span>
            </div>
            <a class="btn btn-block no-bg btn-lg m-b" href="index.php">Login to account</a>
            <p class="text-center"><small><em>By clicking Open account you agree to our <a href="#">terms and conditions</a></em></small>
            </p>
          </form>
        </div>
      </div>
      <div class="push"></div>
    </div>
  </div>
  <!-- build:js({.tmp,app}) scripts/app.min.js -->
  <script src="scripts/helpers/modernizr.js"></script>
  <script src="vendor/jquery/dist/jquery.js"></script>
  <script src="vendor/bootstrap/dist/js/bootstrap.js"></script>
  <script src="vendor/fastclick/lib/fastclick.js"></script>
  <script src="vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
  <script src="scripts/helpers/smartresize.js"></script>
  <script src="scripts/constants.js"></script>
  <script src="scripts/main.js"></script>
  <!-- endbuild -->
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
</body>

</html>