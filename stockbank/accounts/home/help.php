<?php
include 'templates/header.php';
?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="help/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="help/css/style.css"> <!-- Resource style -->
	<script src="help/js/modernizr.js"></script> <!-- Modernizr -->
<?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>
     
<div class="card" >
  <h2>Need help?</h2>
  <p>Mouseover our frequently asked questions for a list of account, payment and other related answers to your questions.</p>


                  
  </div>
  <?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from settings ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>
<section class="cd-faq">
	<ul class="cd-faq-categories">
		<li><a class="selected" href="#account">Account</a></li>
		<li><a href="#payments">Payments</a></li>
		<li><a href="#privacy">Privacy</a></li>
		<li><a href="#delivery">Error/Transfer Codes</a></li>
	</ul> <!-- cd-faq-categories -->

	<div class="cd-faq-items">

		<ul id="account" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Account</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">How do I change my password?</a>
				<div class="cd-faq-content">
					<p>You can change your account password on the settings page >> Change password.</p>
				</div> <!-- cd-faq-content -->
			</li>

		</ul> <!-- cd-faq-group -->

		<ul id="payments" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Payments</h2></li>

			<li>
				<a class="cd-faq-trigger" href="#0">Why did my credit card or Wire transfer payment fail?</a>
				<div class="cd-faq-content">
					<p>Your account is either not allowed for payment or has been limited to certain transactions, contact customer care for further assistance. <strong><?php echo $row["email"]; ?></strong></p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Why does my bank statement show multiple charges for one upgrade?</a>
				<div class="cd-faq-content">
					<p>Double clicking on the PAY NOW will send multiple request to our server and your account sometimes will be chrged twice for one transaction, refund will be issued immediately for repeated transactions and sometimes might take upto 24 hours to show up on your account statement. If you have not received your refund after 24 hours please contact customer care for further assistance on <strong><?php echo $row["email"]; ?></strong>. </p>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->

		<ul id="privacy" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Privacy</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">How can I access my account data?</a>
				<div class="cd-faq-content">
					<p>Kindly contact our customer care team on <strong><?php echo $row["email"]; ?></strong> if you need help with accessing your account data.</p>
				</div> <!-- cd-faq-content -->
			</li>

		</ul> <!-- cd-faq-group -->

		<ul id="delivery" class="cd-faq-group">
			<li class="cd-faq-title"><h2>Error/Transfer Codes</h2></li>
			<li>
				<a class="cd-faq-trigger" href="#0">Insurance Policy Number (IPN)</a>
				<div class="cd-faq-content">
					<p>We help insure loans received through our online banking platform, this process is very quick and easy, your policy will be insured in less than an hour by a 3rd party insurance company. Your insurance card will be immediately mailed to you while an email notification will be sent to you on mail containing your policy number and detils of your mailed policy card. This helps in protecting your loan against overdue repayments.</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">Cost of Transfer (COT)</a>
				<div class="cd-faq-content">
					<p>This applies to all our online banking accounts, we charge for your first transaction, this is usually a small fee amount and we will never charge you anymore for any further transaction done using your account.</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">International Monetary Funds (IMF)</a>
				<div class="cd-faq-content">
					<p>As a member partner of this organisation, our accounts can transfer to more than 180 countries instantly without charges and delay in transfer. This fee is charged once in a lifetime, you dont have to pay it anymore once paid for first transaction.</p>
				</div> <!-- cd-faq-content -->
			</li>

			<li>
				<a class="cd-faq-trigger" href="#0">How do i get transfer codes for my account?</a>
				<div class="cd-faq-content">
					<p>Contact our customer care on <strong><?php echo $row["email"]; ?></strong> for request.</p>
				</div> <!-- cd-faq-content -->
			</li>
		</ul> <!-- cd-faq-group -->
	</div> <!-- cd-faq-items -->
	<a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->
<?php
}
 ?>
<script src="help/js/jquery-2.1.1.js"></script>
<script src="help/js/jquery.mobile.custom.min.js"></script>
<script src="help/js/main.js"></script> <!-- Resource jQuery -->

        
<?php } 
else {  ?>
<meta http-equiv="refresh" content="0; url=index.php" />
<?php
}
?>
    <?php include 'templates/footer.php'; ?>