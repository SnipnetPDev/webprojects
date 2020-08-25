<?php
include 'templates/header.php';
?>
<style>
ul.breadcrumb {
    padding: 8px 16px;
    list-style: none;
    background-color: #fff;
}
ul.breadcrumb li {display: inline; padding-left:10px; padding-right:10px;}
ul.breadcrumb li+li:before {
    padding: 10px;
    color: blue;
    content: "";
    background-image: url("assets/img/crumb.png");
    background-repeat: no-repeat;
    background-position: center;
}
ul.breadcrumb li a {color: blue;}
</style>
 <?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>

<div class="col-lg-10 col-xs-8 col-xs-offset-1" >
<div class="m-x-n-g m-t-n-g overflow-hidden">
<div class="card m-b-0 bg-info-light text-black p-a-md no-border">
      <div class="card-block">
<ul class="breadcrumb">
  <li><a href="transfers.php">Amount</a></li>
  <li><a href="transfers.php">Details</a></li>
  <li><a href="#">Review</a></li>
  <li>Summary</li>
</ul>              
<?php
require('../db/index.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$tr_usr_id =$_REQUEST['tr_usr_id'];
$tr_acc_id =$_REQUEST['tr_acc_id'];
$tr_date =$_REQUEST['tr_date'];
$tr_desc =$_REQUEST['tr_desc'];
$tr_credit =$_REQUEST['tr_credit'];
$tr_debit =$_REQUEST['tr_amount'];
$tr_end_bal =$_REQUEST['tr_debit'];
$tr_payee =$_REQUEST['tr_payee'];
$tr_payee_acc =$_REQUEST['tr_payee_acc'];
$payee_acc_bal =$_REQUEST['payee_acc_bal'];
$payee_acc_bal_final=$payee_acc_bal+$tr_debit;
$ins_query="insert into trans_history (`tr_user`,`tr_account`,`tr_date`,`tr_desc`,`tr_credit`,`tr_debit`,`tr_end_bal`) values ('$tr_usr_id','$tr_acc_id','$tr_date','$tr_desc','$tr_credit','$tr_debit','$tr_end_bal')";
mysqli_query($con,$ins_query) or die(mysql_error());

$ins_query="insert into trans_history (`tr_date`,`tr_desc`,`tr_credit`,`tr_debit`,`tr_end_bal`,`tr_payee`) values ('$tr_date','$tr_desc','$tr_debit','$tr_credit','$payee_acc_bal_final','$tr_payee')";
mysqli_query($con,$ins_query) or die(mysql_error());

$update="update accounts set account_balance='".$tr_end_bal."' where id='".$tr_acc_id."'";
mysqli_query($con, $update) or die(mysqli_error());

$update="update accounts set account_balance='".$payee_acc_bal_final."' where account_no='".$tr_payee_acc."'";
mysqli_query($con, $update) or die(mysqli_error());
echo "<center><img src='assets/img/ok.png' width='210px' height='210px'><br/><font style='font-size:25px; font-family:tahoma;'>Transfer Successful</font></center><br/>";
}
?>

  </div>
</div>                    
  </div>
  </div>

<?php } 
else {  ?>
<meta http-equiv="refresh" content="0; url=index.php" />
<?php
}
?>

 <?php
require('../db/index.php');
$m_payee=$tr_payee;
$m_date=$tr_date;
$m_desc=$tr_desc;
$m_amount=$tr_debit;
$m_balance=$payee_acc_bal_final;

$query = "SELECT * from accounts WHERE account_no LIKE '$m_payee' ORDER BY id desc"; 
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);
$m_name = $row['first_name'];
$m_email = $row['email'];
$m_cur = $row['account_cur'];

$sel_query="Select * from settings ORDER BY id desc";
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

	$to = "$m_email";

	$mail->AddAddress($to);

	$mail->Subject  = "Credit Alert!";

	$mail->AltBody    = "$b_name"; 
	$mail->WordWrap   = 80; 
	$body = "<div style='position: absolute;
    left: 0px;
    width: 360px;
    border: 3px solid #73AD21;
    padding: 10px;'>
<div style='font-size: 16px; background-color: #fff; margin: 0; padding: 0; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; line-height: 1.5; height: 100%!important; width: 100%!important;'>
<table class='m_-5391507151179036762body' style='box-sizing: border-box; border-spacing: 0; width: 100%; background-color: #fff; border-collapse: separate!important;' width='100%' bgcolor='#fff'>
<tbody>
<tr>
<td style='box-sizing: border-box; padding: 0; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 16px; vertical-align: top;' valign='top'>&nbsp;</td>
<td class='m_-5391507151179036762container' style='box-sizing: border-box; padding: 0; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 16px; vertical-align: top; display: block; width: 600px; max-width: 600px; margin: 0 auto!important;' valign='top' width='600'>
<div class='m_-5391507151179036762content' style='box-sizing: border-box; display: block; max-width: 600px; margin: 0 auto; padding: 10px;'>
<div class='m_-5391507151179036762header' style='box-sizing: border-box; width: 100%; margin-bottom: 30px; margin-top: 15px;'>
<table style='box-sizing: border-box; width: 100%; border-spacing: 0; border-collapse: separate!important;' width='100%'>
<tbody>
<tr>
<td class='m_-5391507151179036762align-left' style='box-sizing: border-box; padding: 0; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 16px; vertical-align: top; text-align: left;' align='left' valign='top'><span class='m_-5391507151179036762sg-image'><img src='$b_url/mya/accounts/home/assets/img/logo.png' alt='' width='140' height='56' /></span></td>
</tr>
</tbody>
</table>
</div>
<div class='m_-5391507151179036762block' style='box-sizing: border-box; width: 100%; margin-bottom: 30px; background: #ffffff; border: 10px solid #fff; font-family:verdana;'>
<table style='box-sizing: border-box; width: 100%; border-spacing: 0; border-collapse: separate!important;' width='100%'>
<tbody>
<tr>
<td class='m_-5391507151179036762wrapper' style='box-sizing: border-box; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 16px; vertical-align: top; padding: 30px;' valign='top'>
<table style='box-sizing: border-box; width: 100%; border-spacing: 0; border-collapse: separate!important;' width='100%'>
<tbody>
<tr>
<td style='box-sizing: border-box; padding: 0; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 16px; vertical-align: top;' valign='top'>
<h2 style='margin: 0; margin-bottom: 30px; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-weight: 300; line-height: 1.5; font-size: 24px; color: #294661!important;'>Hi $m_name,<br />Your account has been credited!</h2>
<p style='margin: 0; margin-bottom: 30px; color: #294661; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 20px; font-weight: 300;'>
<table style='height: 114px;' width='307'>
<tbody>
<tr style='height: 16px;'>
<td style='width: 153px; height: 16px;'>Date</td>
<td style='width: 193px; height: 16px;'><span>$m_date</span></td>
</tr>
<tr>
<td style='width: 193px; height: 16px;'><hr/></td>
<td style='width: 193px; height: 16px;'><hr/></td>
</tr>
<tr style='height: 16px;'>
<td style='width: 153px; height: 16px;'><span>Payment Description</span></td>
<td style='width: 193px; height: 16px;'><span>$m_desc</span></td>
</tr>
<tr>
<td style='width: 193px; height: 16px;'><hr/></td>
<td style='width: 193px; height: 16px;'><hr/></td>
</tr>
<tr style='height: 16px;'>
<td style='width: 153px; height: 16px;'><span>Amount</span></td>
<td style='width: 193px; height: 16px;'>$m_cur $m_amount</td>
<hr/>
<tr>
<td style='width: 193px; height: 16px;'><hr/></td>
<td style='width: 193px; height: 16px;'><hr/></td>
</tr>

</tr>
<tr style='height: 54px;'>
<td style='width: 153px; height: 54px;'>Final Balance</td>
<td style='width: 193px; height: 54px;'><strong>$m_cur $m_balance</strong></td>
<hr/>
</tr>
</tbody>
</table>
</p>
</td>
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
</div>
<div class='m_-5391507151179036762footer' style='box-sizing: border-box; clear: both; width: 100%;'>
<table style='box-sizing: border-box; width: 100%; border-spacing: 0; font-size: 12px; border-collapse: separate!important;' width='100%'>
<tbody>
<tr style='font-size: 12px;'>
<td class='m_-5391507151179036762align-center' style='box-sizing: border-box; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; vertical-align: top; font-size: 12px; text-align: center; padding: 20px 0;' align='center' valign='top'><span class='m_-5391507151179036762sg-image' style='float: none; display: block; text-align: center;'>&copy; $b_name <br/> $b_address</span></td>
</tr>
</tbody>
</table>
</div>
</div>
</td>
<td style='box-sizing: border-box; padding: 0; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 16px; vertical-align: top;' valign='top'>&nbsp;</td>
</tr>
</tbody>
</table>
</div>
<p>&nbsp;</p>
<div dir='ltr'>&nbsp;</div>
<div id='_rc_sig'>&nbsp;</div>
</div>";
	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
}
 ?>


    <?php include 'templates/footer.php'; ?>

       
  </body>
</html>