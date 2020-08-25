<?php
$email = strip_tags($_REQUEST['receiver_email']);
$sender_email = $_REQUEST['sender_email'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];
include "../../accounts/db/index.php";
include '../../core/settings.php';
$result = mysqli_query($con, "SELECT * FROM smtp WHERE id = '1' "); 
if($row = mysqli_fetch_assoc($result)){ 
$host = $row["host"];
$username = $row["username"];
$password = $row["password"];
}else{
$host = NULL;
$username = NULL;
$password = NULL;
}

		// include phpmailer class
		require_once 'class.phpmailer.php';
		// creates object
		$mail = new PHPMailer(true);

			try
			{
				$mail->IsSMTP(); 
				$mail->isHTML(true);
				$mail->SMTPDebug  = 0;                     
				$mail->SMTPAuth   = true;                  
				$mail->SMTPSecure = "ssl";                 
				$mail->Host       = "$host";      
				$mail->Port       = 465;             
				$mail->AddAddress($email);
				$mail->Username   ="$username";  
				$mail->Password   ="$password";            
				$mail->SetFrom("$sender_email","$short_name");
				$mail->AddReplyTo("$sender_email", "$short_name");
				$mail->Subject    = $subject;
				$mail->Body 	  = $message;
				$mail->AltBody    = $message;
					
				if($mail->Send())
				{
					
					$msg = "<div class='alert alert-success'>
							 successfully sent to ".$email." go and check, cheers :)
							</div>";
					
				}
			}
			catch(phpmailerException $ex)
			{
				$msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
			}
?>