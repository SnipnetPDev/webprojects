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

$id=$_REQUEST['id'];
$admin_msg=$_REQUEST['admin_msg'];
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

	$mail->Subject  = "$short_name Message";

	$mail->AltBody    = "$b_name"; 
	$mail->WordWrap   = 120; 
	$body = "<div style='position: absolute;
    left: 0px;
    width: 500px;
    border: 0px solid #73AD21;
    padding: 10px;'>
<img src='$b_url/mya/accounts/home/assets/img/logo.png' alt='' width='140' height='56' />
<br/><br/>
$admin_msg
<br/><br/><br/>
<br/>
$b_name
<br/>
$b_address
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