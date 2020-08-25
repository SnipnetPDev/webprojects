<?php
include("../auth.php");
require('../db/index.php');
include 'core/acc_call.php';
include 'core/header.php';
?>
 <div class="c-toolbar u-mb-medium">
 <nav class="c-toolbar__nav u-mr-auto">
                <a class="c-toolbar__nav-item is-active" href="#tab1">Cards</a>
            </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>
<div class='container'>
<?php if($perm_cards == $perm_act) { ?>
<div class='row u-mb-large'>
<div class='col-xl-4'><div class="c-graph-card" data-mh="secondary-graphs">
 
<?php
if (isset($_REQUEST['remove_id'])) {
$remove_id= $_REQUEST['remove_id'];
$query = "DELETE FROM cards WHERE number='$remove_id'"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
 echo "<script>
		alert('Card removed successfully');
        window.location.href='cards.php?success';
        </script>";
} else {
header("Location: cards.php?fail");
}
if(isset($_GET['success']))
	{
		?>
		<div class="c-stage__panel c-stage__panel--mute collapse show" id="stage-panel1">
<div class='c-alert c-alert--success alert'>
                        <i class='c-alert__icon fa fa-times-circle'></i> Card removed successfully

                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>
							</div>
        <?php
	}
	else if(isset($_GET['fail']))
	{
		?>
      <div class="c-stage__panel c-stage__panel--mute collapse show" id="stage-panel1">
<div class='c-alert c-alert--danger alert'>
                        <i class='c-alert__icon fa fa-times-circle'></i> Could not remove card, contact support

                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>
							</div>
        <?php
	}
if (empty($_REQUEST['auth'])) {
	echo "<h3 class='u-flex u-justify-between u-align-items-center u-ph-medium u-pb-small'>
		<br/><br/><br/>
	<img src='../../img/payment.png' width='200px' height=' /></h3>
         <h4 class='c-menu__title'></h4><strong style='padding-left:27px;'>CARDS</strong><br/><br/>";
   include("core/cards.php"); 
} else {
 include("core/card-details.php"); 
}
	?> 
					  <a class="c-menu__link" href="setup.php" data-toggle="modal" data-target="#modal9">
                           <img src="../../img/sidebar-icon6.png" class="u-mr-xsmall" style="width: 14px;" alt="Add icon"><strong>ADD NEW CARD</strong> </a>
                            <div class="c-graph-card__chart">
						  <canvas id="js-chart-earnings" width="300" height="74"></canvas>							
                            </div>
                        </div>
</div>
<div class="col-xl-8">
<?php
if (isset($_POST["linkcc"])) {
	$c_number = base64_encode($_POST["cnumber"]);
	$c_exp = $_POST["cexp"];
	$mm = substr($c_exp, 0, 2);
	$yyyy = substr($c_exp, -4);
	$c_cvc = base64_encode($_POST["ccvc"]);
	$c_type = $_POST["ctype"];
	$sql = "INSERT INTO cards (u_login_id, number, c_type, mm, yyyy, cvc)
VALUES ('$u_id', '$c_number', '$c_type', '".base64_encode($mm)."', '".base64_encode($yyyy)."', '$c_cvc')";
?>
<?php
if ($con->query($sql) === TRUE) {
	?>
<div class='c-alert c-alert--success alert'>
Your card was added successfully. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>
<?php
} else {
	?>
<div class='c-alert c-alert--danger alert'>
An unknown error occurred while adding card to your account, Contact support for assistance. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>
<?php
}
}
?>
                        <article class="c-stage" id="stages">
                            <a class="c-stage__header u-flex u-justify-between" href="#stage-panel1" data-toggle="collapse" aria-expanded="false" aria-controls="stage-panel1">
                                <div class="o-media">
                                    <div class="c-stage__header-title o-media__body">
                                        <h6 class="u-mb-zero">TRANSFER FROM CARD TO ACCOUNT</h6>
                                        <p class="u-text-xsmall u-text-mute">ADD FUNDS TO YOUR ACCOUNT BALANCE DIRECTLY FROM YOUR CREDIT/DEBIT CARD</p>
                                    </div>
                                </div>
                                
                                <i class="fa fa-angle-down u-text-mute"></i>
                            </a>
 <div class="c-stage__panel c-stage__panel--mute collapse show" id="stage-panel1">
<div class='c-alert c-alert--danger alert'>
                        <i class='c-alert__icon fa fa-times-circle'></i> This service is currently not available.

                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>
							</div>
                        </article><!-- // .c-stage -->
 </div> </div>
 <?php }else{ ?>
<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Service not available at this time, please try again later <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>
<?php } ?>
<?php
include("core/add-card.php");
include 'core/footer.php';
?>