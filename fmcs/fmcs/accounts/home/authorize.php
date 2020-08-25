<?php
include("../auth.php");
include 'core/header.php';
include 'core/acc_call.php';
if (isset($_POST['amount'])) {
	$trans_user_id = $_POST['trans_user_id'];
	$usr_account_no = $_POST['usr_account_no'];
	$r_acc_no = $_POST['r_acc_no'];
	$trans_id = $_POST['trans_id'];
	$trans_type = $_POST['trans_type'];
    $transfer_fee = $_POST['transfer_fee'];
	$tr_date = $_POST['tr_date'];
	$trans_desc_final = $_POST['trans_desc_final'];
	$amount = $_POST['amount'];
	$escrow = $_POST['amount'];
	$tr_total = $_POST['tr_total'];
	$tr_bal = $us_ball - $tr_total;
	$tr_status = $_POST['tr_status'];
	$tr_note = $_POST['tr_note'];
    $trans_require = $_POST['trans_require'];
if($perm_transfer == $perm_act) {
    $r_acc_no=$r_acc_no;
$sel_query="Select * from accounts a, users u where a.account_no LIKE '$r_acc_no' and a.usr_id = u.uss_id ORDER BY a.id;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {
	$r_acc_bal = $row['account_balance'];
	$r_us_id = $row['usr_id'];
	$r_acc_email = $row['email'];
	$rc_bal = $amount + $r_acc_bal;
	$r_acc_name = $row['first_name'];
	$r_acc_phone = $row['phone'];
}
$sel_query="Select * from shared_perm where UserID = '$r_us_id' ORDER BY perm_id;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {
$rc_perm_email = $row["email"];
$rc_perm_sms = $row["sms"];
$rc_perm_act = 1;
}
if($trans_require == "1") {
	//Update receiver's account
    $update="update accounts set account_balance='".$rc_bal."' where account_no='".$r_acc_no."'";
    mysqli_query($con, $update) or die(mysqli_error());
    //insert transaction history
    $ins_query="insert into trans_history (`trans_date`,`trans_user_id`,`usr_account_no`,`receiver_acc_no`,`trans_id`,`trans_type`,`tr_desc`,`tr_amount`,`tr_total`,`trans_fee`) values ('$tr_date','$trans_user_id','$usr_account_no','$r_acc_no','$trans_id','$trans_type','$trans_desc_final','$amount','$tr_total','$transfer_fee')";
    mysqli_query($con,$ins_query) or die(mysqli_error($con));
	//update sender account
    $update2="update accounts set account_balance='".$tr_bal."' where account_no='".$usr_account_no."'";
    mysqli_query($con, $update2) or die(mysqli_error());
	
	//live email not encoded where email will be delivered
	$sender_em= $us_email;
	$subjecta = "You sent a payment";
	$messagea = file_get_contents('../../snipnetAPI/template/sender-transfer-email.htm');
	
	//required from settings. do not edit/add more lines
	$messagea = str_replace("%b_url%", $b_url, $messagea); 
	$messagea = str_replace("%site_name%", $b_name, $messagea); 
	$messagea = str_replace("%site_address%", $b_address, $messagea);  
	
	//information needed per request
	$messagea = str_replace("%receiver_name%", $r_acc_name, $messagea); 
	$messagea = str_replace("%sender_name%", $us_first, $messagea); 
	$messagea = str_replace("%transaction_id%", $trans_id, $messagea);
    $messagea = str_replace("%currency%", $acc_curency, $messagea);
	$messagea = str_replace("%amount_sent%", $amount, $messagea);
	$messagea = str_replace("%transaction_status%", $tr_status, $messagea);
    //Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $sender_em,
			'subject' => $subjecta,
			'message' => $messagea
        );
if($perm_email == $perm_act) {
	if($sh_perm_email == $sh_perm_act) {
include '../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }


//live email not encoded where email will be delivered
	$rec_em= $r_acc_email;
	$subject = "You received a payment";
	$message = file_get_contents('../../snipnetAPI/template/receiver-transfer-email.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%receiver_name%", $r_acc_name, $message); 
	$message = str_replace("%sender_name%", $us_first, $message); 
	$message = str_replace("%transaction_id%", $trans_id, $message);
    $message = str_replace("%currency%", $acc_curency, $message);
	$message = str_replace("%amount_sent%", $amount, $message);
	$message = str_replace("%transaction_status%", $tr_status, $message);
    //Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $rec_em,
			'subject' => $subject,
			'message' => $message
        );
if($perm_email == $perm_act) {
	if($rc_perm_email == $rc_perm_act) {
include '../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

//SEND SMS
	$sender_phone= $us_phone;
	//required from settings. do not edit/add more lines
	$smsmsg = file_get_contents('../../snipnetAPI/template/sender-transfer-sms.txt');
	$smsmsg = str_replace("%b_url%", $b_url, $smsmsg); 
	
	//information needed per request
	$smsmsg = str_replace("%receiver_name%", $r_acc_name, $smsmsg); 
	$smsmsg = str_replace("%sender_name%", $us_first, $smsmsg); 
	$smsmsg = str_replace("%transaction_id%", $trans_id, $smsmsg);
    $smsmsg = str_replace("%currency%", $acc_curency, $smsmsg);
	$smsmsg = str_replace("%amount_sent%", $amount, $smsmsg);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $sender_phone,
			'message' => $smsmsg
        );
if($perm_sms == $perm_act) {
	if($sh_perm_sms == $sh_perm_act) {
include '../../snipnetAPI/snipnet-que.php';
	$result = curl_exec($ch);
	}else { }
}else { }

		$sender_phone2= $r_acc_phone;
	//required from settings. do not edit/add more lines
	$smsmsg2 = file_get_contents('../../snipnetAPI/template/receiver-transfer-sms.txt');
	$smsmsg2 = str_replace("%b_url%", $b_url, $smsmsg2); 
	
	//information needed per request
	$smsmsg2 = str_replace("%receiver_name%", $r_acc_name, $smsmsg2); 
	$smsmsg2 = str_replace("%sender_name%", $us_first, $smsmsg2); 
	$smsmsg2 = str_replace("%transaction_id%", $trans_id, $smsmsg2);
    $smsmsg2 = str_replace("%currency%", $acc_curency, $smsmsg2);
	$smsmsg2 = str_replace("%amount_sent%", $amount, $smsmsg2);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $sender_phone2,
			'message' => $smsmsg2
        );
if($perm_sms == $perm_act) {
	if($rc_perm_sms == $rc_perm_act) {
include '../../snipnetAPI/snipnet-que.php';
	$result = curl_exec($ch);
	}else { }
}else { }
	//END HERE
} else {
	//insert transaction history with escrow
    $ins_query="insert into trans_history (`trans_date`,`trans_user_id`,`usr_account_no`,`receiver_acc_no`,`trans_id`,`trans_type`,`tr_desc`,`tr_amount`,`escrow`,`tr_total`,`trans_fee`) values ('$tr_date','$trans_user_id','$usr_account_no','$r_acc_no','$trans_id','$trans_type','$trans_desc_final','$amount','$escrow','$tr_total','$transfer_fee')";
	mysqli_query($con,$ins_query) or die(mysqli_error($con));
	//update sender account
	$update="update accounts set account_balance='".$tr_bal."' where account_no='".$usr_account_no."'";
    mysqli_query($con, $update) or die(mysqli_error());
	
		//live email not encoded where email will be delivered
	$sender_em= $us_email;
	$subjecta = "You sent a payment";
	$messagea = file_get_contents('../../snipnetAPI/template/sender-transfer-on-hold-email.htm');
	
	//required from settings. do not edit/add more lines
	$messagea = str_replace("%b_url%", $b_url, $messagea); 
	$messagea = str_replace("%site_name%", $b_name, $messagea); 
	$messagea = str_replace("%site_address%", $b_address, $messagea);  
	
	//information needed per request
	$messagea = str_replace("%receiver_name%", $r_acc_name, $messagea); 
	$messagea = str_replace("%sender_name%", $us_first, $messagea); 
	$messagea = str_replace("%transaction_id%", $trans_id, $messagea);
    $messagea = str_replace("%currency%", $acc_curency, $messagea);
	$messagea = str_replace("%amount_sent%", $amount, $messagea);
	$messagea = str_replace("%transaction_status%", $tr_status, $messagea);
    //Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $sender_em,
			'subject' => $subjecta,
			'message' => $messagea
        );
if($perm_email == $perm_act) {
	if($sh_perm_email == $sh_perm_act) {
include '../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }


//live email not encoded where email will be delivered
	$rec_em= $r_acc_email;
	$subject = "You received a payment";
	$message = file_get_contents('../../snipnetAPI/template/receiver-transfer-on-hold-email.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%receiver_name%", $r_acc_name, $message); 
	$message = str_replace("%sender_name%", $us_first, $message); 
	$message = str_replace("%transaction_id%", $trans_id, $message);
    $message = str_replace("%currency%", $acc_curency, $message);
	$message = str_replace("%amount_sent%", $amount, $message);
	$message = str_replace("%transaction_status%", $tr_status, $message);
    //Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $rec_em,
			'subject' => $subject,
			'message' => $message
        );
if($perm_email == $perm_act) {
	if($rc_perm_email == $rc_perm_act) {
include '../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

//SEND SMS
	$sender_phone= $us_phone;
	//required from settings. do not edit/add more lines
	$smsmsg = file_get_contents('../../snipnetAPI/template/sender-transfer-on-hold-sms.txt');
	$smsmsg = str_replace("%b_url%", $b_url, $smsmsg); 
	
	//information needed per request
	$smsmsg = str_replace("%receiver_name%", $r_acc_name, $smsmsg); 
	$smsmsg = str_replace("%sender_name%", $us_first, $smsmsg); 
	$smsmsg = str_replace("%transaction_id%", $trans_id, $smsmsg);
    $smsmsg = str_replace("%currency%", $acc_curency, $smsmsg);
	$smsmsg = str_replace("%amount_sent%", $amount, $smsmsg);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $sender_phone,
			'message' => $smsmsg
        );
if($perm_sms == $perm_act) {
	if($sh_perm_sms == $sh_perm_act) {
include '../../snipnetAPI/snipnet-que.php';
	$result = curl_exec($ch);
	}else { }
}else { }

		$sender_phone2= $r_acc_phone;
	//required from settings. do not edit/add more lines
	$smsmsg2 = file_get_contents('../../snipnetAPI/template/receiver-transfer-on-hold-sms.txt');
	$smsmsg2 = str_replace("%b_url%", $b_url, $smsmsg2); 
	
	//information needed per request
	$smsmsg2 = str_replace("%receiver_name%", $r_acc_name, $smsmsg2); 
	$smsmsg2 = str_replace("%sender_name%", $us_first, $smsmsg2); 
	$smsmsg2 = str_replace("%transaction_id%", $trans_id, $smsmsg2);
    $smsmsg2 = str_replace("%currency%", $acc_curency, $smsmsg2);
	$smsmsg2 = str_replace("%amount_sent%", $amount, $smsmsg2);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $sender_phone2,
			'message' => $smsmsg2
        );
if($perm_sms == $perm_act) {
	if($rc_perm_sms == $rc_perm_act) {
include '../../snipnetAPI/snipnet-que.php';
	$result = curl_exec($ch);
	}else { }
}else { }
	//END HERE
}
//insert into transaction record
$ins2_query="insert into trans_record (`trans_his_id`,`tr_date`,`tr_status`,`note`) values ('$trans_id','$tr_date','$tr_status','$tr_note')";
mysqli_query($con,$ins2_query) or die(mysqli_error($con));


?>
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
                        <a class="c-counter-nav__link" >
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Summary
                        </a>
                    </div>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link is-active" >
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Send
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
                                      <div class="c-stage__label">
                                <i class="c-stage__label-icon fa fa-check-circle"></i>
                                <p class="c-stage__label-title">Transaction complete</p>
                            </div>
                                    </div>
                               
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
<?php
	}else {
?>
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
                        <a class="c-counter-nav__link" >
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Summary
                        </a>
                    </div>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link is-active" >
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Send
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
						  <div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Service not available at this time, please try again later <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
<?php
	}
} elseif (isset($_REQUEST['transaction_id'])) {
$transaction_id = $_REQUEST['transaction_id'];
$sel_query="Select * from trans_history WHERE trans_id LIKE '$transaction_id' AND receiver_acc_no LIKE '$us_acc' OR trans_user_id LIKE '$u_id' ORDER BY tr_id desc;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
?>
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
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span><?php echo $row['trans_type']; ?>
                        </a>
                    </div>
                    <div class="c-counter-nav__item">
                        <a class="c-counter-nav__link" >
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Summary
                        </a>
                    </div>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link is-active" >
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Send
                        </a>
                    </div>
                </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>
                <div class="row u-mb-medium u-justify-center">
                    <div class="col-xl-8">
					<div class="c-invoice__terms">
                                      <div class="c-stage__label">
                                <i class="c-stage__label-icon fa fa-check-circle"></i>
                                <p class="c-stage__label-title">Transaction Receipt</p>
                            </div>
                                    </div>
                        <div class="">
 <div class="">
                                <div class="c-invoice__desc">
									<article class="c-stage" id="stages">
                            <a class="c-stage__header u-flex u-justify-between" href="#stage-panel1" data-toggle="collapse" aria-expanded="false" aria-controls="stage-panel1">
                                <div class="o-media">
                                    <div class="c-stage__header-title o-media__body">
                                        <h6 class="u-mb-zero"><strong>TRANSACTION ID#:</strong> TX<?php echo $row['trans_id']; ?></h6>
                                        <p class="u-text-xsmall u-text-mute"><strong>DATE:</strong> <?php echo $row['trans_date']; ?></p>
                                    </div>
                                </div>
                                
                                <i class="fa fa-angle-down u-text-mute"></i>
                            </a>
 <div class="c-stage__panel c-stage__panel--mute collapse show" id="stage-panel1">
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
                                                <td class="c-table__cell"><?php echo $row['tr_desc']; ?></td>
                                                <td class="c-table__cell"><?php echo number_format($row['tr_amount'], 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="c-table__cell"></td>
                                                <td class="c-table__cell"></td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
										<?php if($u_id == $row['trans_user_id']) {
										?>
										<tr class="c-table__row">
                                                <td class="c-table__cell" colspan="1"><strong>Fees</strong></td>
                                                <td class="c-table__cell"><strong><?php echo number_format($row['trans_fee'], 2); ?></strong></td>
                                            </tr>
										<?php } else { } ?>
										<?php if($u_id == $row['trans_user_id']) {
										?>
                                            <tr class="c-table__row">
                                                <td class="c-table__cell" colspan="1"><strong>Total</strong></td>
                                                <td class="c-table__cell"><strong><?php echo number_format($row['tr_total'], 2); ?></strong></td>
                                            </tr>
										<?php } else { 
										?>
										 <tr class="c-table__row">
                                                <td class="c-table__cell" colspan="1"><strong>Total</strong></td>
                                                <td class="c-table__cell"><strong><?php echo number_format($row['tr_amount'], 2); ?></strong></td>
                                            </tr>
										<?php } ?>
                                        </tfoot>
                                    </table>
                               
                                </div>
					</div>
                        </article><!-- // .c-stage -->
                                </div>
<article class="c-stage" id="stages">
                            <a class="c-stage__header u-flex u-justify-between" href="#stage-panel2" data-toggle="collapse" aria-expanded="false" aria-controls="stage-panel2">
                                <div class="o-media">
                                    <div class="c-stage__header-title o-media__body">
                                        <h6 class="u-mb-zero">Transaction Record</h6>
                                        <p class="u-text-xsmall u-text-mute"><?php echo $row['trans_type']; ?></p>
                                    </div>
                                </div>
                                
                                <i class="fa fa-angle-down u-text-mute"></i>
                            </a>
 <div class="c-stage__panel c-stage__panel--mute collapse show" id="stage-panel2">
                                <div class="c-invoice__table">
                                    <table class="c-table">
                                        <thead class="c-table__head c-table__head--slim">
                                            <tr class="c-table__row">
                                                <th class="c-table__cell c-table__cell--head">Date</th>
												<th class="c-table__cell c-table__cell--head">Description</th>
                                                <th class="c-table__cell c-table__cell--head">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$transaction_id = $_REQUEST['transaction_id'];
$sel_query="Select * from trans_record WHERE trans_his_id LIKE '$transaction_id' ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
while($row = $result->fetch_assoc()) {
	?>
                                            <tr class="c-table__row">
                                                <td class="c-table__cell"><?php echo $row['tr_date']; ?></td>
												<td class="c-table__cell"><?php echo $row['note']; ?></td>
                                                <td class="c-table__cell">
												<?php 
												if ($row['tr_status'] == "Completed") {
													echo "<span class='c-badge c-badge--success'>Completed</span>";
												} elseif ($row['tr_status'] == "On-Hold") {
													echo "<span class='c-badge c-badge--warning'>On Hold</span>";
												} elseif ($row['tr_status'] == "Declined") {
													echo "<span class='c-badge c-badge--danger'>Refunded</span>";
												}
												?>
												</td>
                                            </tr>
<?php } ?>
                                            <tr>
                                                <td class="c-table__cell"></td>
                                                <td class="c-table__cell"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                               
                                </div>
					</div>
                        </article><!-- // .c-stage -->
						</div>			
								
								
								
                            </div>
                           
                        </div>
                    </div>
                </div>
<?php
}
} else {
 echo "<meta http-equiv='refresh' content='0;URL=transfer.php' />";
}
} else {
 echo "<meta http-equiv='refresh' content='0;URL=transfer.php' />";
}
include 'core/footer.php';
?>