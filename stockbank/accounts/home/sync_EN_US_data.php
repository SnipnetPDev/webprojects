<?php
 
require('../db/index.php');

$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$usr_id =$_REQUEST['usr_id'];
$a_status_color =$_REQUEST['a_status_color'];
$first_name = $_REQUEST['first_name'];
$last_name = $_REQUEST['last_name'];
$other_name = $_REQUEST['other_name'];
$street_address = $_REQUEST['street_address'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$country = $_REQUEST['country'];
$zip_code = $_REQUEST['zip_code'];
$title = $_REQUEST['title'];
$marital_status = $_REQUEST['marital_status'];
$dob = $_REQUEST['dob'];
$employment_status = $_REQUEST['employment_status'];
$occupation = $_REQUEST['occupation'];
$job_title = $_REQUEST['job_title'];
$employer = $_REQUEST['employer'];
$employer_years = $_REQUEST['employer_years'];
$employer_business_address = $_REQUEST['employer_business_address'];
$employer_apt_suite = $_REQUEST['employer_apt_suite'];
$employer_city = $_REQUEST['employer_city'];
$employer_state = $_REQUEST['employer_state'];
$employer_zip_code = $_REQUEST['employer_zip_code'];
$employer_country = $_REQUEST['employer_country'];
$next_of_kin = $_REQUEST['next_of_kin'];
$next_of_address = $_REQUEST['next_of_address'];
$next_of_phone = $_REQUEST['next_of_phone'];
$next_of_email = $_REQUEST['next_of_email'];
$next_of_date_of_birth = $_REQUEST['next_of_date_of_birth'];
$next_of_relationship_status = $_REQUEST['next_of_relationship_status'];
$citizenship = $_REQUEST['citizenship'];
$us_id_type = $_REQUEST['us_id_type'];
$us_id_no = $_REQUEST['us_id_no'];
$country_tax_res = $_REQUEST['country_tax_res'];
$ssn = $_REQUEST['ssn'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$account_no = $_REQUEST['account_no'];
$account_status = $_REQUEST['account_status'];
$account_opening_date = $_REQUEST['account_opening_date'];
$account_balance = $_REQUEST['account_balance'];
$account_type = $_REQUEST['account_type'];
$account_signature = $_REQUEST['account_signature'];
$account_pin = $_REQUEST['account_pin'];
$funding_mode = $_REQUEST['funding_mode'];
$account_sqa1 = $_REQUEST['account_sqa1'];
$account_sqa1a = $_REQUEST['account_sqa1a'];
$account_sqa2 = $_REQUEST['account_sqa2'];
$account_sqa2a = $_REQUEST['account_sqa2a'];
$account_cur = $_REQUEST['account_cur'];
$ipn = $_REQUEST['ipn'];
$cot = $_REQUEST['cot'];
$imf = $_REQUEST['imf'];
$ins_query="insert into accounts (`usr_id`,`a_status_color`,`first_name`,`last_name`,`other_name`,`street_address`,`city`,`state`,`country`,`zip_code`,`title`,`marital_status`,`dob`,`employment_status`,`occupation`,`job_title`,`employer`,`employer_years`,`employer_business_address`,`employer_apt_suite`,`employer_city`,`employer_state`,`employer_zip_code`,`employer_country`,`next_of_kin`,`next_of_address`,`next_of_phone`,`next_of_email`,`next_of_date_of_birth`,`next_of_relationship_status`,`citizenship`,`us_id_type`,`us_id_no`,`country_tax_res`,`ssn`,`phone`,`email`,`account_no`,`account_status`,`account_opening_date`,`account_balance`,`account_type`,`account_signature`,`account_pin`,`funding_mode`,`account_sqa1`,`account_sqa1a`,`account_sqa2`,`account_sqa2a`,`account_cur`,`ipn`,`cot`,`imf`) values ('$usr_id','$a_status_color','$first_name','$last_name','$other_name','$street_address','$city','$state','$country','$zip_code','$title','$marital_status','$dob','$employment_status','$occupation','$job_title','$employer','$employer_years','$employer_business_address','$employer_apt_suite','$employer_city','$employer_state','$employer_zip_code','$employer_country','$next_of_kin','$next_of_address','$next_of_phone','$next_of_email','$next_of_date_of_birth','$next_of_relationship_status','$citizenship','$us_id_type','$us_id_no','$country_tax_res','$ssn','$phone','$email','$account_no','$account_status','$account_opening_date','$account_balance','$account_type','$account_signature','$account_pin','$funding_mode','$account_sqa1','$account_sqa1a','$account_sqa2','$account_sqa2a','$account_cur','$ipn','$cot','$imf')";
mysqli_query($con,$ins_query) or die(mysqli_error($con));

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

	$to = "$email";

	$mail->AddAddress($to);

	$mail->Subject  = "Account set-up complete";

	$mail->AltBody    = "$b_name"; 
	$mail->WordWrap   = 80; 
	$body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta name='viewport' content='width=device-width, initial-scale=1.0' />

</head>
<body style='width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; margin: 0; padding: 0;'><style type='text/css'>
h1 a:active { color: red !important; }
h2 a:active { color: red !important; }
h3 a:active { color: red !important; }
h4 a:active { color: red !important; }
h5 a:active { color: red !important; }
h6 a:active { color: red !important; }
h1 a:visited { color: purple !important; }
h2 a:visited { color: purple !important; }
h3 a:visited { color: purple !important; }
h4 a:visited { color: purple !important; }
h5 a:visited { color: purple !important; }
h6 a:visited { color: purple !important; }
&gt;</style>
	
	<table cellpadding='0' width='100%' cellspacing='0' border='0' id='backgroundTable' class='bgBody' style='width: 100% !important; line-height: 100% !important; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; margin: 0; padding: 0;' bgcolor='#ffffff'>
		<tr>
			<td style='border-collapse: collapse;'>

				

				<table cellpadding='0' cellspacing='0' border='0' align='center' width='100%' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
					<tr>
						<td class='movableContentContainer' style='border-collapse: collapse;'>
							
							<div class='movableContent'>
								<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
									<tr height='40'>
										<td width='200' style='border-collapse: collapse;'> </td>
										<td width='200' style='border-collapse: collapse;'> </td>
										<td width='200' style='border-collapse: collapse;'> </td>
									</tr>
									<tr>
										<td width='200' valign='top' style='border-collapse: collapse;'> </td>
										<td width='200' valign='top' align='center' style='border-collapse: collapse;'>
											<div class='contentEditableContainer contentTextEditable'>
												<div class='contentEditable'>
													<img src='$b_url/mya/accounts/home/assets/img/logo.png' width='200' height='70' alt='Logo' data-default='placeholder' style='outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;' />
												</div>
											</div>
										</td>
										<td width='200' valign='top' style='border-collapse: collapse;'> </td>
									</tr>
									<tr height='25'>
										<td width='200' style='border-collapse: collapse;'> </td>
										<td width='200' style='border-collapse: collapse;'> </td>
										<td width='200' style='border-collapse: collapse;'> </td>
									</tr>
								</table>
							</div>

							<div class='movableContent'>
								<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
									<tr>
										<td width='100%' colspan='3' align='center' style='padding-bottom: 10px; padding-top: 25px; border-collapse: collapse;'>
											<div class='contentEditableContainer contentTextEditable'>
												<div class='contentEditable'>
													<h2 style='color: black !important; font-family: Helvetica, Arial, sans-serif; font-size: 22px; font-weight: normal;'>Welcome aboard $first_name !</h2>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td width='100' style='border-collapse: collapse;'> </td>
										<td width='1200' align='center' style='padding-bottom: 5px; border-collapse: collapse;'>
											<div class='contentEditableContainer contentTextEditable'>
												<div class='contentEditable'>
													<p style='text-align:justify; color: #555; font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 160%; margin: 0;'>Thank you for signing up to our online banking accounts - you're all set and your account will be active upon receiving a scanned copy of your government issued ID you have used for account setup. <br/><br/>Login to your account to submit the above document for verification. <br/>If you have done this before, kindly wait while your account is reviewed by our customert account team.</p>
												</div>
											</div>
										</td>
										<td width='100' style='border-collapse: collapse;'> </td>
									</tr>
								</table>
							</div>

							<div class='movableContent'>
								<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
									<tr>
										<td width='100' style='border-collapse: collapse;'> </td>
										<td width='400' align='center' style='padding-top: 25px; padding-bottom: 115px; border-collapse: collapse;'>
											<table cellpadding='0' cellspacing='0' border='0' align='center' width='200' height='50' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
												<tr>
													<td bgcolor='red' align='center' style='border-radius: 4px; border-collapse: collapse;' width='200' height='50'>
														<div class='contentEditableContainer contentTextEditable'>
															<div class='contentEditable'>
																<a target='_blank' href='$b_url/mya' class='link2' style='color: #fff; text-decoration: none; font-family: Helvetica, Arial, sans-serif; font-size: 16px; border-radius: 4px;'>Login to account</a>
															</div>
														</div>

													</td>
												</tr>
											</table>
										</td>
										<td width='100' style='border-collapse: collapse;'> </td>
									</tr>
								</table>
							</div>


							<div class='movableContent'>
								<table cellpadding='0' cellspacing='0' border='0' align='center' width='100%' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
									<tr>
										<td style='color: #fff; border-collapse: collapse; background-color: red;' class='bgItem' bgcolor='red'>
											<table cellpadding='0' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;' cellspacing='0' border='0' align='center' width='600'>
												<tr>
													<td width='200' style='vertical-align: bottom; border-collapse: collapse;' valign='bottom'>
														<div class='contentEditableContainer contentImageEditable'>
															<div class='contentEditable'>
																<div style='padding-top: 20px; text-align: center;' align='center'>
																	<img src='https://mir-s3-cdn-cf.behance.net/project_modules/disp/cd0efd20434285.562eb377d0325.png' width='148' data-default='placeholder' data-max-width='200' style='margin-bottom: -3px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;' /><br /><br />
																</div>
															</div>
														</div>
														
													</td>
													<td width='400' valign='top' style='padding-top: 40px; padding-bottom: 20px; border-collapse: collapse;'>
														<br />
														<div class='contentEditableContainer contentTextEditable'>
															<div class='contentEditable'>
																<div style='font-size: 23px; font-family: Heveltica, Arial, sans-serif; color: #fff;'>Need help ?</div>
															</div>
														</div>
														
														<div class='contentEditableContainer contentTextEditable'>
															<div class='contentEditable' style='font-family: Helvetica, Arial, sans-serif; font-size: 15px; line-height: 150%; margin: 0; padding: 20px 10px 0 0;'>
																<p style='color: #FFEECE; font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 160%; margin: 0;'>Kindly use the default reply button to leave your message on our customer care desk or call $b_phone for account support issues only</p>
															</div>
														</div>

													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</div>

							<div class='movableContent'>
								<table cellpadding='0' cellspacing='0' border='0' align='center' width='600' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
									<tr>
										<td width='100%' colspan='2' style='padding-top: 65px; border-collapse: collapse;'>
											<hr style='height: 1px; color: #333; background-color: #ddd; border: none;' />
										</td>
									</tr>
									<tr>
										<td width='60%' height='70' valign='middle' style='padding-bottom: 20px; border-collapse: collapse;'>
											<div class='contentEditableContainer contentTextEditable'>
												<div class='contentEditable'>
													<span style='font-size: 11px; color: #555; font-family: Helvetica, Arial, sans-serif; line-height: 200%;'>$b_name | $b_address</span>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>

						</td>
					</tr>
				</table>


			</td>
		</tr>
	</table>
	
</body>
</html>";
	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}

}
$status = "<div class='alert'>
  <strong>Please Wait...</strong> Submiting Application</div>";
}
?>
<?php include 'templates/header.php'; ?>
<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

.btn-submit {
    position: relative;
    overflow: hidden;
}
.btn-submit input[type=submit] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
        <div class="m-t-n m-b">
          <div class="card m-b-0 bg-primary-dark p-a-md no-border m-b m-x-n-g">
            <div class="card-block" style="height: 450px;">
			<br/><br/><br/><br/><br/><br/>
						 <div class="row post-header text-white">
            <div class="col p-b-lg col-xs-8 col-xs-offset-2">
              <h1>HI, <?php echo $_SESSION['usr_name']; ?></h1>
              <h4>Your online account registration is complete, upload your <?php echo $us_id_type; ?> with ID number <b><?php echo $us_id_no; ?></b> for verification purposes as required by our regulator.</h4>
            </div>
          </div>

  <?php
 
require('../db/index.php');
$id=$_SESSION['usr_id'];
$query = "SELECT * from users where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

$imageU = $row['id_front'];
$imageX = $row['id_back'];
$ids_front = "assets/img/ids/".$imageU;
$ids_back = "assets/img/ids/".$imageU;
?>

<?php
    include("../db/index.php");
     $status = "";
    if(isset($_POST['but_upload'])){
		$id=$_REQUEST['id'];
        $idfront = $_FILES['id_front']['name'];
		$idback = $_FILES['id_back']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["id_front"]["name"]);
		$target_file = $target_dir . basename($_FILES["id_back"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            
            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents($_FILES['id_front']['tmp_name']) );
			$image_base64 = base64_encode(file_get_contents($_FILES['id_back']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Insert record
			$update="update users set id_front='".$idfront."', id_back='".$idback."' where id='".$id."'";
            mysqli_query($con, $update) or die(mysqli_error($con));
			$status = "<meta http-equiv='refresh' content='0; url=complete.php' />";
            
            // Upload file
            move_uploaded_file($_FILES['id_front']['tmp_name'],'assets/img/ids/'.$idfront);
			move_uploaded_file($_FILES['id_back']['tmp_name'],'assets/img/ids/'.$idback);

        }
    
    }
    ?>
	<?php
{
?>
<centeer><?php echo $status; ?></centeer>
<form method="post" action="" enctype='multipart/form-data'>
<input name="id" type="hidden" value="<?php echo $_SESSION['usr_id'];?>" />
		  		  			<div class="col-lg-4">
    <div class="card-block">
<center><img src="assets/img/1.png" width="72" height="72" />
<img src="<?php echo $ids_front; ?>" width="207px" height="130px" Alt="" / >
</center>
<br/>
	<div class="form-group" style="margin-left:90px;">
    <label for="formGroupExampleInput2" style="font-size:15px; font-family:Century Gothic; color:#fff;"><strong>Passport or ID Card<font style="font-size:10px; color:gold;">[Front Scan]</font></strong></label>
<br/>
	<span class="btn btn-danger btn-file">
	Browse file<input name="id_front" type="file" />
</span>
</div>

    </div>
</div>

   <div class="col-lg-4">
    <div class="card-block">
	<center><img src="assets/img/2.png" width="72" height="72" />
<img src="<?php echo $ids_back; ?>" width="207px" height="130px" Alt="" / >
</center>
<br/>
	<div class="form-group" style="margin-left:90px;">
    <label for="formGroupExampleInput2" style="font-size:15px; font-family:Century Gothic; color:#fff;"><strong>Passport or ID Card<font style="font-size:10px; color:gold;">[Back Scan]</font></strong></label>
<br/>
	<span class="btn btn-danger btn-file">
	Browse file<input name="id_back" type="file" />
</span>
</div>

    </div>
</div>


  <div class="col-lg-4">
    <div class="card-block">
<p><span style="color: #ffffff;"><strong><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt;">What do i need to check ?</span></strong></span></p>
<ul>
<li><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt; color: #ffffff;">Upload colored copies only</span></li>
<li><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt; color: #ffffff;">Minimal resolution must be 300dpi</span></li>
<li><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt; color: #ffffff;">File format must be PNG or JPG</span></li>
<li><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt; color: #ffffff;">Refer to the examples above</span></li>
</ul>
<p>&nbsp;</p>
<span class="btn btn-success btn-submit">
	Upload ID<input name='but_upload' type="submit" />
</span>
    </div>
</div>
</form>
<?php } ?>        
		</div>
		  
          </div>
 

</div>
<?php include 'templates/footer.php'; ?>