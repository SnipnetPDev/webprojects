<?php
include("../auth.php");
include 'core/header.php';
include 'core/acc_call.php';
if (empty($_REQUEST['source'])) {
?>
 <div class="c-toolbar u-mb-medium">
 <nav class="c-toolbar__nav u-mr-auto">
                <a class="c-toolbar__nav-item is-active" href="#tab1">Money Transfer</a>
            </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>
        <div class="container u-mb-medium">
            <div class="row">
<?php
$stat = "1";
$sel_query="Select * from transfer WHERE status LIKE '$stat' ORDER BY id desc;";
$result = $con->query($sel_query);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
                <div class="col-sm-6 col-lg-3">
                    <div class="c-project">
					<a style="text-decoration:none;" href="?source=<?php echo base64_encode($row["link"]); ?>&&loader=<?php echo base64_encode($row["name"]); ?>&&sec=<?php echo base64_encode($row["descrip"]); ?>" >
                        <div class="c-project__img">
                            <img src="transfer/img/<?php echo $row["icon"]; ?>" alt="<?php echo $row["name"]; ?>" width="410px" height="270px">
                        </div>

                        <h3 class="c-project__title"><?php echo $row["name"]; ?>
                            <span class="c-project__status"><?php echo $row["descrip"]; ?></span>
                        </h3>
						</a>
                    </div><!-- // .c-project -->
                </div>
<?php    }
} else {
    echo "<div class='c-alert c-alert--danger alert'>
                        <i class='c-alert__icon fa fa-times-circle'></i> Sorry, Money Transfers are not available at this time.

                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>";
}
?>
            </div>

        </div><!-- // .container -->

        <!-- Main javascsript -->
        <script src="../../js/main.min.js?v=2.0"></script>

<?php
} elseif(empty($_POST['amount'])) {
$link = base64_decode($_REQUEST["source"]);
$name = base64_decode($_REQUEST['loader']);
$sel_query="Select * from transfer WHERE link LIKE '$link' ORDER BY id desc;";
$result = $con->query($sel_query);
while($row = $result->fetch_assoc()) {
?>
<script type="text/javascript" src="../../js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#r_acc_no').keyup(function(){
        var r_acc_no = $(this).val(); // Get username textbox using $(this)
        var Result = $('#result'); // Get ID of the result DIV where we display the results
        if(r_acc_no.length > 9) { // if greater than 2 (minimum 3)
            Result.html("<center><img src='../../img/spinner.gif' width='220px' height=''/></center>"); // you can use loading animation here
            var dataPass = 'action=availability&r_acc_no='+r_acc_no;
            $.ajax({ // Send the username val to available.php
            type : 'POST',
            data : dataPass,
            url  : 'transfer/check/available.php',
            success: function(responseText){ // Get the result
                if(responseText == 0){
                    Result.html('<span style="color:red;">Account does not exist</span>');
                }
                else if(responseText > 0){
                    Result.html('<span style="color:green;">This account is valid</span>');
                }
                else{
                    alert('Problem with sql query');
                }
            }
            });
        }else{
            Result.html('<span style="color:orange;">Must be exactly or more than 10 digit</span>');
        }
        if(r_acc_no.length == 0) {
            Result.html('');
        }
    });
});
</script>
 <div class="c-toolbar u-justify-between u-mb-medium">
                <nav class="c-counter-nav">
                    <p class="c-counter-nav__title">Status:</p>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link" href="transfer.php">
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Money Transfer
                        </a>
                    </div>
                    <div class="c-counter-nav__item">
                        <a class="c-counter-nav__link is-active" href="#">
                            <span class="c-counter-nav__counter">2</span><?php echo $name; ?>
                        </a>
                    </div>
                    <div class="c-counter-nav__item">
                        <a class="c-counter-nav__link" >
                            <span class="c-counter-nav__counter">3</span>Summary
                        </a>
                    </div>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link" >
                            <span class="c-counter-nav__counter">4</span>Send
                        </a>
                    </div>
                </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>

		
<div class="container-fluid">

                <div class="row">
                    <div class="col-xl-8">
                        <article class="c-stage" id="stages">
                            <a class="c-stage__header u-flex u-justify-between" href="#stage-panel1" data-toggle="collapse" aria-expanded="false" aria-controls="stage-panel1">
                                <div class="o-media">
                                    <div class="c-stage__header-img o-media__img">
                                        <img src="transfer/img/<?php echo $row["icon"]; ?>" alt="About the image">
                                    </div>
                                    <div class="c-stage__header-title o-media__body">
                                        <h6 class="u-mb-zero"><?php echo $row["name"]; ?></h6>
                                        <p class="u-text-xsmall u-text-mute"><?php echo $row["descrip"]; ?></p>
                                    </div>
                                </div>
                                
                                <i class="fa fa-angle-down u-text-mute"></i>
                            </a>
 <div class="c-stage__panel c-stage__panel--mute collapse show" id="stage-panel1">
                                <div class="u-p-medium">
                                   <div class="c-tabs__content tab-content" id="nav-tabContent">
                                <div class="c-tabs__pane active" >
<form method="post" action="">
<input type="hidden" name="transfer_fee" value="<?php echo $row['trans_fee']; ?>" />
<input type="hidden" name="trans_user_id" value="<?php echo $_SESSION['usr_id']; ?>" />
<input type="hidden" name="usr_account_no" value="<?php echo $us_acc; ?>" />
<input type="hidden" name="trans_id" value="" ID="transaction_id" MAXLENGTH=7 SIZE=7 />
<input type="hidden" name="trans_type" value="<?php echo $row["name"]; ?>" />
<input type="hidden" name="trans_require" value="<?php echo $row["trans_require"]; ?>" />
<input type="hidden" name="tr_date" value="<?php echo date("F j, Y"); ?>" />
                                    <div class="row">
									<div class="col-lg-6">
<?php include "transfer/$link"; ?>
											</div>
                                       <div class="col-lg-6" id="transfers"> 

                                            <label class="c-field__label" for="socialProfile">Amount to send</label>

                                            <div class="c-field has-addon-left u-mb-small">
                                                <span class="c-field__addon u-bg-twitter" style="color:#fff; font-weight: bold;">
                                                   <?php echo $t_cur; ?>
                                                </span>
                                                <input class="c-input" type="text" name="amount" placeholder="0.00" required><button type='submit' name='t_summary' class='c-btn c-btn--info'>Continue...................</button>						
                                            </div>
                                            <div class="c-field has-addon-left">
								 <div id="demo"></div>
                                            </div>
                                        </div>	
                                        </div> 
</form>										
                                    </div>
                                </div>
                            </div><!-- // .c-stage__panel -->
							</div>
                        </article><!-- // .c-stage -->
						</div>
<?php include "core/faq.php"; ?>
						</div>
						</div>
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

document.getElementById("transaction_id").value = randomNumber(7);
</script>
<?php }
} elseif (isset($_POST['amount'])) {
$transfer_fee = $_POST['amount'] / 100 * $_POST['transfer_fee'];
$trans_user_id = $_POST['trans_user_id'];
$usr_account_no = $_POST['usr_account_no'];
$trans_id = $_POST['trans_id'];
$trans_type = $_POST['trans_type'];
$trans_require = $_POST['trans_require'];
$tr_date = $_POST['tr_date'];
$r_acc_no = $_POST['r_acc_no'];
$trans_desc = $_POST['trans_desc'][0].$_POST['trans_desc'][1].$_POST['trans_desc'][2].$_POST['trans_desc'][3].$_POST['trans_desc'][4].$_POST['trans_desc'][5].$_POST['trans_desc'][6].$_POST['trans_desc'][7].$_POST['trans_desc'][8].$_POST['trans_desc'][9].$_POST['trans_desc'][10].$_POST['trans_desc'][11];
$trans_desc_final = "$trans_desc<br/>$trans_type";
$amount = $_POST['amount'];
$tr_total = $amount + $transfer_fee;
$tr_bal = $us_ball - $tr_total;
if ($trans_require == 1) {
$tr_status = "Completed";
$tr_note = "Transaction Completed";
} else {
$tr_status = "On-Hold";
$tr_note = "Pending manual review";
}
?>
<form method="post" action="authorize.php">
<input type="hidden" name="transfer_fee" value="<?php echo $transfer_fee; ?>" />
<input type="hidden" name="trans_user_id" value="<?php echo $trans_user_id; ?>" />
<input type="hidden" name="usr_account_no" value="<?php echo $usr_account_no; ?>" />
<input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>" />
<input type="hidden" name="trans_type" value="<?php echo $trans_type; ?>" />
<input type="hidden" name="trans_require" value="<?php echo $trans_require; ?>" />
<input type="hidden" name="tr_date" value="<?php echo $tr_date; ?>" />
<input type="hidden" name="r_acc_no" value="<?php echo $r_acc_no; ?>" />
<input type="hidden" name="trans_desc_final" value="<?php echo $trans_desc_final; ?>" />
<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
<input type="hidden" name="tr_total" value="<?php echo $tr_total; ?>" />
<input type="hidden" name="tr_status" value="<?php echo $tr_status; ?>" />
<input type="hidden" name="tr_note" value="<?php echo $tr_note; ?>" />
 <div class="c-toolbar u-justify-between u-mb-medium">
                <nav class="c-counter-nav">
                    <p class="c-counter-nav__title">Status:</p>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link" href="transfer.php">
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Money Transfer
                        </a>
                    </div>
                    <div class="c-counter-nav__item">
                        <a class="c-counter-nav__link" href="#">
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span><?php echo $trans_type; ?>
                        </a>
                    </div>
                    <div class="c-counter-nav__item">
                        <a class="c-counter-nav__link is-active" >
                            <span class="c-counter-nav__counter">3</span>Summary
                        </a>
                    </div>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link" >
                            <span class="c-counter-nav__counter">4</span>Send
                        </a>
                    </div>
                </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>
                <div class="row u-mb-medium u-justify-center">
                    <div class="col-xl-9">
                        <div class="c-invoice">
 <div class="c-invoice__body">
                                <div class="c-invoice__desc">
                                    Transaction summary <br> 
                                    <span class="c-invoice__number"><strong>TRANSACTION ID#:</strong> TX<?php echo $trans_id; ?><br/><strong>DATE:</strong> <?php echo $tr_date; ?></span>
                                </div>
                                <div class="c-invoice__table">
                                    <table class="c-table">
                                        <thead class="c-table__head c-table__head--slim">
                                            <tr class="c-table__row">
                                                <th class="c-table__cell c-table__cell--head">Description#</th>
                                                <th class="c-table__cell c-table__cell--head">Amount (<?php echo $t_cur; ?>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="c-table__row">
                                                <td class="c-table__cell"><?php echo $trans_desc; ?></td>
                                                <td class="c-table__cell"><?php echo number_format($amount, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="c-table__cell"></td>
                                                <td class="c-table__cell"></td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
										<tr class="c-table__row">
                                                <td class="c-table__cell" colspan="1"><strong>Fees</strong></td>
                                                <td class="c-table__cell"><strong><?php echo number_format($transfer_fee, 2); ?></strong></td>
                                            </tr>
                                            <tr class="c-table__row">
                                                <td class="c-table__cell" colspan="1"><strong>Total</strong></td>
                                                <td class="c-table__cell"><strong><?php echo number_format($tr_total, 2); ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="c-invoice__terms">
                                       This action will bring your account balance to <strong style="color:green;"><?php echo number_format($tr_bal, 2); ?></strong>.
                                    </div>
									<br/>
                                <center>
								<?php 
$sel_query="Select * from accounts WHERE account_no = '$r_acc_no' ORDER BY id desc;";
$result = $con->query($sel_query);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	$r_acc_status=$row["account_status"];
	}
} else {
 echo"<font class='c-alert c-alert--danger alert'>There is no valid merchant for this payment gateway, proceed at your own risk.</font><br/>";
 $r_acc_status="Disabled";
}
?>
								<?php
								if($us_ball < $tr_total) {
								    echo "<font class='c-alert c-alert--danger alert'>Insufficient balance to perform this operation.</font>";
								} elseif (empty($_POST['r_acc_no'])) {
									echo "<font class='c-alert c-alert--info alert'>Invalid or Closed Gateway.</font>";
								}elseif ($acc_status == "Dormant") {
 echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Your account is currently Dormant and cannot allow transactions. <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
 }elseif ($acc_status == "On-Hold") {
 echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Your account is currently On-hold and cannot allow transactions.<button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>"; 
 }elseif ($acc_status == "Disabled") {
echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Your account has been disabled from using this service <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>"; 
 }elseif ($r_acc_status == "Dormant") {
 echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Receiver is currently unable to receive transactions. <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>";
 }elseif ($r_acc_status == "On-Hold") {
 echo "<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Receiver is currently unable to receive transactions. <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>"; 
 }elseif ($r_acc_status == "Disabled") {
echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Receiver's account has been disabled from using this service <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>"; 
 }elseif ($us_acc == $r_acc_no) {
echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> You cannot send money transfer to yourself <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
</div>"; 
 } else {
echo "<button type='submit' class='c-btn c-btn--success'><i class='fa fa-money u-mr-xsmall u-opacity-medium'></i> Send Money</button>";
								}
								?>
                                </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</form>
<?php
}
include 'core/footer.php';
?>