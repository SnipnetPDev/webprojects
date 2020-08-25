<?php
include 'templates/header.php';
?>
            <!-- Left nav
            ================================================== -->
            <div class="row">
              <div class="span9">

 <div class="card" style="">               


<?php
require('../db/index.php');
$count=1;
$sel_query="Select * from settings ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
$count++; } 

$EmailFrom = $row["email"];
$EmailTo = $row["email"];
$acc_num = Trim(stripslashes($_POST['acc_num'])); 
$card_type = Trim(stripslashes($_POST['card_type'])); 
$check_book = Trim(stripslashes($_POST['check_book'])); 

// validation
$validationOK=true;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=failed.htm\">";
  exit;
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

require '../../Mailer/class.phpmailer.php';

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

	$to = "$b_email";

	$mail->AddAddress($to);

	$mail->Subject  = "Customer Request";

	$mail->AltBody    = "$b_name"; 
	$mail->WordWrap   = 80; 
	$body = "Customer Account Number: $acc_num<br/>
	--------------------------
	<br/>
	Card type requested: $card_type
	<br/>
	--------------------------
	<br/>
	$check_book
	<br/>
	<br/>
	--------Stock Project 2017---------";
	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}

}
?>

      <div class="card-block">
	  <div class='alert alert-success'>
<strong>Complete !<strong> Your request has been submitted.<br/> <a href="index.php"> Home >> </a></div>  
</div>
</div>                    
       </div>
        </div>
        
    <?php include 'templates/footer.php'; ?>

