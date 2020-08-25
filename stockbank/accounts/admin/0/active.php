<?php
include 'header.php';
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
				<br/><br/>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
<?php
require('../../db/index.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id =$_REQUEST['id'];
$alock =$_REQUEST['alock'];
$update="update users set alock='".$alock."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error($con));
$status = "<div class='alert alert-success'>Command Successfull. Please reload page..</div>";
echo $status;
}
$id=$_REQUEST['id'];
$query = "SELECT * from accounts where usr_id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);
$c_name = $row['first_name'];
$c_email = $row['email'];
$account_no = $row['account_no'];
$account_type = $row['account_type'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];

$id =$_REQUEST['id'];
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
$routing_no = $row["routing_no"];
$b_phone = $row["phone"];

require '../../../Mailer/class.phpmailer.php';

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

	$to = "$c_email";

	$mail->AddAddress($to);

	$mail->Subject  = "Account Activated";

	$mail->AltBody    = "$b_name"; 
	$mail->WordWrap   = 80; 
	$body = "<div style='position: absolute;
    left: 0px;
    width: 360px;
    border: 3px solid #73AD21;
    padding: 10px;'><div style='font-size: 16px; background-color: #fff; margin: 0; padding: 0; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; line-height: 1.5; height: 100%!important; width: 100%!important; align:left;'>
<table class='m_-5391507151179036762body' style='align:left; box-sizing: border-box; border-spacing: 0; width: 100%; background-color: #fff; border-collapse: separate!important;' width='100%' bgcolor='#fff'>
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
<h2 style='margin: 0; margin-bottom: 30px; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-weight: 300; line-height: 1.5; font-size: 24px; color: #294661!important;'>HI $c_name !<br /> Your account is ready for use.</h2>
<p style='margin: 0; margin-bottom: 30px; color: #294661; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 20px; font-weight: 300;'>
Below is your new $b_name account innformation:<br/><br/>
Routing (ABA): $routing_no
<br/>
Account Number: $account_no
<br/>
Account Type: $account_type
<br/>
Beneficiary Name: $first_name $last_name
<br/><br/>
<div>Please Note!</div>
<ul>
<li>Only ACH local bank transfers can be accepted</li>
<li>Transfers must be made from a company account</li>
<li>Transfers from individuals will be automatically rejected</li>
</ul>
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
<td class='m_-5391507151179036762align-center' style='box-sizing: border-box; font-family: 'Open Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; vertical-align: top; font-size: 12px; text-align: center; padding: 20px 0;' align='center' valign='top'><span class='m_-5391507151179036762sg-image' style='float: none; display: block; text-align: center;'>&copy; $b_name <br/> $b_address </span></td>
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
<?php
 
require('../../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from users where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);

$imageU = $row['imgname'];
$image_src = "../../home/assets/img/DP/".$imageU;
?>
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $image_src;  ?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo $image_src;  ?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $row['name'];?></h4>
                                        <h5 class="text-white"><?php echo $row['email'];?></h5>
                                         <h3 class="text-white"><?php echo $row['alock'];?></h3>										</div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-12 col-sm-4 text-center">
								
							<a href="access.php?id=<?php echo $row['id'];?>"><button name="submit" type="submit" class="btn btn-danger">Back</button></a>
								
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material">
                                <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $row['name'];?>" class="form-control form-control-line" disabled> </div>
                                </div>
								<div class="form-group">
                                    <label for="example-email" class="col-md-12">Login ID</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $row['loginid'];?>" class="form-control form-control-line" id="example-email" disabled> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="<?php echo $row['email'];?>" class="form-control form-control-line" id="example-email" disabled> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php echo $row['password'];?>" class="form-control form-control-line" disabled> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $row['phone'];?>" class="form-control form-control-line" disabled> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Country</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $row['country'];?>" class="form-control form-control-line" disabled> </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php
include 'footer.php';
?>