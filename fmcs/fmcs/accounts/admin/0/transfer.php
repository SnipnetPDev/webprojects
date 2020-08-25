<?php
include('header.php');
include('sidebar.php');
if ($_REQUEST["action"] == "view") {

$transaction_id = $_REQUEST['id'];
$sel_query="Select * from trans_history WHERE trans_id LIKE '$transaction_id' ORDER BY tr_id desc;";
$result = $con->query($sel_query) or die($con->error);
if($row = $result->fetch_assoc()) {
?>
<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        TX<?php echo $row['trans_id']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="transfer.php"></a>Transfer</li>
		<li><a href="transfer.php?action=list">Transactions</a></li>
        <li class="active">TX<?php echo $row['trans_id']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Receipt</a></li>
              <li><a href="#timeline" data-toggle="tab">Activity</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">

      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="../../../img/logo.png" width="100px" height="" alt="<?php echo $site_title; ?>" />
            <small class="pull-right">Date: <?php echo $row['trans_date']; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
<?php
$tr_user_id = $row['trans_user_id'];
$tr_rec_id = $row['receiver_acc_no'];
$trans_desc = $row['tr_desc'];
$subtotal = $row['tr_amount'];
$trans_fee = $row['trans_fee'];
$tr_total = $row['tr_total'];
$tr_date = $row['trans_date'];
$tr_type = $row['trans_type'];
$sel_query="Select * from accounts a, users u where a.usr_id LIKE '$tr_user_id' and a.usr_id = u.uss_id ORDER BY a.id;";
$result = $con->query($sel_query) or die($con->error);
if($row = $result->fetch_assoc()) {
?>
          <address>
            <strong><?php echo $row['title']; ?> <?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?> <?php echo $row['other_name']; ?></strong><br>
            <?php echo $row['street_address']; ?><br>
            <?php echo $row['city']; ?>, <?php echo $row['state']; ?> <?php echo $row['zip_code']; ?><br>
            Phone: <?php echo $row['phone']; ?><br>
            Email: <?php echo $row['email']; ?><br>
<?php
if($row) {
?>
<a href="clients.php?action=<?php echo $row['loginid']; ?>" >View Profile</a>
<?php }else { echo "No valid link"; } ?>
          </address>
<?php }else{ echo "<address><strong>User not found.</strong></address>"; } ?>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
<?php
$sel_query="Select * from accounts a, users u where a.account_no LIKE '$tr_rec_id' and a.usr_id = u.uss_id ORDER BY a.id;";
$result = $con->query($sel_query) or die($con->error);
if($row = $result->fetch_assoc()) {
?>
          <address>
            <strong><?php echo $row['title']; ?> <?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?> <?php echo $row['other_name']; ?></strong><br>
            <?php echo $row['street_address']; ?><br>
            <?php echo $row['city']; ?>, <?php echo $row['state']; ?> <?php echo $row['zip_code']; ?><br>
            Phone: <?php echo $row['phone']; ?><br>
            Email: <?php echo $row['email']; ?><br>
<?php
if($row) {
?>
			<a href="clients.php?action=<?php echo $row['loginid']; ?>" >View Profile</a>
<?php }else { echo "No valid link"; } ?>
			</address>
<?php }else{ echo "<address><strong>User not found.</strong></address>"; } ?>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Transaction ID #TX007612</b><br>
          <b>Date:</b> <?php echo $tr_date; ?><br>
          <b>Transfer Type</b> <?php echo $tr_type; ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Payment Description:</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <?php echo $trans_desc; ?>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo $acc_curency; ?><?php echo $subtotal; ?></td>
              </tr>
              <tr>
                <th>Fee (<a href="" >?</a>)</th>
                <td><?php echo $acc_curency; ?><?php echo $trans_fee; ?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo $acc_curency; ?><?php echo $tr_total; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
		<input name="b_print" type="button" class="btn btn-success" onClick="printdiv('activity');" value=" Print ">
          <a href="#timeline" data-toggle="tab"><button type="button" class="btn btn-info pull-right"><i class="fa fa-refresh"></i> Update Transfer
          </button></a>
        </div>
      </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>DATE</th>
			  <th>DESCRIPTION</th>
              <th>STATUS</th>
            </tr>
            </thead>
            <tbody>
<?php
$transaction_id = $_REQUEST['id'];
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
													echo "<span class='label label-success'>Completed</span>";
												} elseif ($row['tr_status'] == "On-Hold") {
													echo "<span class='label label-warning'>On Hold</span>";
												} elseif ($row['tr_status'] == "Declined") {
													echo "<span class='label label-danger'>Declined</span>";
												}
												?>
												</td>
                                            </tr>

<?php } 
if ($_POST["status"] == "Completed") {
$query = $con->query("Select * from trans_record tr, accounts ac, trans_history th, users u where  th.trans_id = tr.trans_his_id and th.trans_id='$transaction_id' and ac.account_no = th.receiver_acc_no and ac.usr_id = u.uss_id ORDER BY tr.id DESC");
        $query->num_rows > 0;
        if($row = $query->fetch_assoc()){
if ($row['tr_status'] == "Completed") {
	echo "<div class='alert alert-info alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-info'></i> Info!</h4>
               Transaction has already been completed.
              </div>";
	
}else {
	$trdate = date("F j, Y");
	$trid = $row['trans_his_id'];
	$trstatus = "Completed";
	$note = "Transaction Completed";
	$escrow = "0.00";
	$balance = $row['account_balance'] + $row['tr_amount'];
	$accountno = $row['account_no'];
	$tramount = $row['tr_amount'];
	
	//required for email/sms only
	$r_ph = $row['phone'];
	$r_em = $row['email'];
	$r_name = $row['first_name'];
$r_id = $row['uss_id'];
$sel_query="Select * from shared_perm where UserID = '$r_id' ORDER BY perm_id;";
$result = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($result);
$rc_perm_email = $row["email"];
$rc_perm_sms = $row["sms"];
$rc_perm_act = 1;
	$query = $con->query("Select * from accounts ac, trans_history th, users u where th.trans_id='$transaction_id' and ac.account_no = th.usr_account_no and ac.usr_id = u.uss_id ORDER BY th.tr_id DESC");
	$row = $query->fetch_assoc();
	$s_ph = $row['phone'];
	$s_em = $row['email'];
	$s_name = $row['first_name'];
	$s_id = $row['uss_id'];
$sel_query="Select * from shared_perm where UserID = '$s_id' ORDER BY perm_id;";
$result = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($result);
$s_perm_email = $row["email"];
$s_perm_sms = $row["sms"];
$s_perm_act = 1;
	
	$update="update accounts set account_balance='".$balance."' where account_no='".$accountno."'";
     mysqli_query($con, $update) or die(mysqli_error());
	$update2="update trans_history set escrow='".$escrow."' where trans_id='".$trid."'";
     mysqli_query($con, $update2) or die(mysqli_error());
	$sql = "INSERT INTO trans_record (trans_his_id, tr_date, tr_status, note) VALUES ('".$trid."', '".$trdate."', '".$trstatus."', '".$note."');";
	 mysqli_query($con, $sql) or die(mysqli_error());
	 echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
                Transaction approved.
              </div>";
	//1
	$sender_em= $s_em;
	$subjecta = "Transaction Completed";
	$messagea = file_get_contents('../../../snipnetAPI/template/sender-transfer-email.htm');
	
	//required from settings. do not edit/add more lines
	$messagea = str_replace("%b_url%", $b_url, $messagea); 
	$messagea = str_replace("%site_name%", $b_name, $messagea); 
	$messagea = str_replace("%site_address%", $b_address, $messagea);  
	
	//information needed per request
	$messagea = str_replace("%receiver_name%", $r_name, $messagea); 
	$messagea = str_replace("%sender_name%", $s_name, $messagea); 
	$messagea = str_replace("%transaction_id%", $trid, $messagea);
    $messagea = str_replace("%currency%", $acc_curency, $messagea);
	$messagea = str_replace("%amount_sent%", $tramount, $messagea);
	$messagea = str_replace("%transaction_status%", $trstatus, $messagea);
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
	if($s_perm_email == $s_perm_act) {
include '../../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

	//2
	$rec_em= $r_em;
	$subject = "Transaction Completed";
	$message = file_get_contents('../../../snipnetAPI/template/receiver-transfer-email.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%receiver_name%", $r_name, $message); 
	$message = str_replace("%sender_name%", $s_name, $message); 
	$message = str_replace("%transaction_id%", $trid, $message);
    $message = str_replace("%currency%", $acc_curency, $message);
	$message = str_replace("%amount_sent%", $tramount, $message);
	$message = str_replace("%transaction_status%", $trstatus, $message);
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
include '../../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

    //1
    $sender_ph= $s_ph;
	//required from settings. do not edit/add more lines
	$smsmsg2 = file_get_contents('../../../snipnetAPI/template/sender-transfer-sms.txt');
	$smsmsg2 = str_replace("%b_url%", $b_url, $smsmsg2); 
	
	//information needed per request
	$smsmsg2 = str_replace("%receiver_name%", $r_name, $smsmsg2); 
	$smsmsg2 = str_replace("%sender_name%", $s_name, $smsmsg2); 
	$smsmsg2 = str_replace("%transaction_id%", $trid, $smsmsg2);
    $smsmsg2 = str_replace("%currency%", $acc_curency, $smsmsg2);
	$smsmsg2 = str_replace("%amount_sent%", $tramount, $smsmsg2);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $sender_ph,
			'message' => $smsmsg2
        );
if($perm_sms == $perm_act) {
	if($s_perm_sms == $s_perm_act) {
include '../../../snipnetAPI/snipnet-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

    //2
    $receiver_ph= $r_ph;
	//required from settings. do not edit/add more lines
	$smsmsg = file_get_contents('../../../snipnetAPI/template/receiver-transfer-sms.txt');
	$smsmsg = str_replace("%b_url%", $b_url, $smsmsg); 
	
	//information needed per request
	$smsmsg = str_replace("%receiver_name%", $r_name, $smsmsg); 
	$smsmsg = str_replace("%sender_name%", $s_name, $smsmsg); 
	$smsmsg = str_replace("%transaction_id%", $trid, $smsmsg);
    $smsmsg = str_replace("%currency%", $acc_curency, $smsmsg);
	$smsmsg = str_replace("%amount_sent%", $tramount, $smsmsg);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $receiver_ph,
			'message' => $smsmsg
        );
if($perm_sms == $perm_act) {
	if($rc_perm_sms == $rc_perm_act) {
include '../../../snipnetAPI/snipnet-que.php';
$result = curl_exec($ch);
    }else { }
}else { }
//END HERE
}
}else {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Error!</h4>
                Transaction not found.
              </div>";
}
}

if ($_POST["status"] == "On-Hold") {
$query = $con->query("Select * from trans_record tr, accounts ac, trans_history th, users u where  th.trans_id = tr.trans_his_id and th.trans_id='$transaction_id' and ac.account_no = th.receiver_acc_no and ac.usr_id = u.uss_id ORDER BY tr.id DESC");
        $query->num_rows > 0;
        if($row = $query->fetch_assoc()){
if ($row['tr_status'] == "On-Hold") {
	echo "<div class='alert alert-info alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-info'></i> Info!</h4>
               Transaction has already been placed on hold.
              </div>";
	
}else {
	$trdate = date("F j, Y");
	$trid = $row['trans_his_id'];
	$trstatus = "On-Hold";
	$note = "Pending manual review";
	$escrow = $row['tr_amount'];
	$balance = $row['account_balance'] - $row['tr_amount'];
	$accountno = $row['account_no'];
	$tramount = $row['tr_amount'];
	
	//required for email/sms only
	$r_ph = $row['phone'];
	$r_em = $row['email'];
	$r_name = $row['first_name'];
$r_id = $row['uss_id'];
$sel_query="Select * from shared_perm where UserID = '$r_id' ORDER BY perm_id;";
$result = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($result);
$rc_perm_email = $row["email"];
$rc_perm_sms = $row["sms"];
$rc_perm_act = 1;
	$query = $con->query("Select * from accounts ac, trans_history th, users u where th.trans_id='$transaction_id' and ac.account_no = th.usr_account_no and ac.usr_id = u.uss_id ORDER BY th.tr_id DESC");
	$row = $query->fetch_assoc();
	$s_ph = $row['phone'];
	$s_em = $row['email'];
	$s_name = $row['first_name'];
	$s_id = $row['uss_id'];
$sel_query="Select * from shared_perm where UserID = '$s_id' ORDER BY perm_id;";
$result = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($result);
$s_perm_email = $row["email"];
$s_perm_sms = $row["sms"];
$s_perm_act = 1;
	
	$update="update accounts set account_balance='".$balance."' where account_no='".$accountno."'";
     mysqli_query($con, $update) or die(mysqli_error());
	$update2="update trans_history set escrow='".$escrow."' where trans_id='".$trid."'";
     mysqli_query($con, $update2) or die(mysqli_error());
	$sql = "INSERT INTO trans_record (trans_his_id, tr_date, tr_status, note) VALUES ('".$trid."', '".$trdate."', '".$trstatus."', '".$note."');";
	 mysqli_query($con, $sql) or die(mysqli_error());
	 echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
                Transaction has been placed on hold.
              </div>";
		//1
	$sender_em= $s_em;
	$subjecta = "Transaction On-Hold";
	$messagea = file_get_contents('../../../snipnetAPI/template/sender-transfer-on-hold-email.htm');
	
	//required from settings. do not edit/add more lines
	$messagea = str_replace("%b_url%", $b_url, $messagea); 
	$messagea = str_replace("%site_name%", $b_name, $messagea); 
	$messagea = str_replace("%site_address%", $b_address, $messagea);  
	
	//information needed per request
	$messagea = str_replace("%receiver_name%", $r_name, $messagea); 
	$messagea = str_replace("%sender_name%", $s_name, $messagea); 
	$messagea = str_replace("%transaction_id%", $trid, $messagea);
    $messagea = str_replace("%currency%", $acc_curency, $messagea);
	$messagea = str_replace("%amount_sent%", $tramount, $messagea);
	$messagea = str_replace("%transaction_status%", $trstatus, $messagea);
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
	if($s_perm_email == $s_perm_act) {
include '../../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

	//2
	$rec_em= $r_em;
	$subject = "Transaction On-Hold";
	$message = file_get_contents('../../../snipnetAPI/template/receiver-transfer-on-hold-email.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%receiver_name%", $r_name, $message); 
	$message = str_replace("%sender_name%", $s_name, $message); 
	$message = str_replace("%transaction_id%", $trid, $message);
    $message = str_replace("%currency%", $acc_curency, $message);
	$message = str_replace("%amount_sent%", $tramount, $message);
	$message = str_replace("%transaction_status%", $trstatus, $message);
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
include '../../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

    //1
    $sender_ph= $s_ph;
	//required from settings. do not edit/add more lines
	$smsmsg2 = file_get_contents('../../../snipnetAPI/template/sender-transfer-on-hold-sms.txt');
	$smsmsg2 = str_replace("%b_url%", $b_url, $smsmsg2); 
	
	//information needed per request
	$smsmsg2 = str_replace("%receiver_name%", $r_name, $smsmsg2); 
	$smsmsg2 = str_replace("%sender_name%", $s_name, $smsmsg2); 
	$smsmsg2 = str_replace("%transaction_id%", $trid, $smsmsg2);
    $smsmsg2 = str_replace("%currency%", $acc_curency, $smsmsg2);
	$smsmsg2 = str_replace("%amount_sent%", $tramount, $smsmsg2);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $sender_ph,
			'message' => $smsmsg2
        );
if($perm_sms == $perm_act) {
	if($s_perm_sms == $s_perm_act) {
include '../../../snipnetAPI/snipnet-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

    //2
    $receiver_ph= $r_ph;
	//required from settings. do not edit/add more lines
	$smsmsg = file_get_contents('../../../snipnetAPI/template/receiver-transfer-on-hold-sms.txt');
	$smsmsg = str_replace("%b_url%", $b_url, $smsmsg); 
	
	//information needed per request
	$smsmsg = str_replace("%receiver_name%", $r_name, $smsmsg); 
	$smsmsg = str_replace("%sender_name%", $s_name, $smsmsg); 
	$smsmsg = str_replace("%transaction_id%", $trid, $smsmsg);
    $smsmsg = str_replace("%currency%", $acc_curency, $smsmsg);
	$smsmsg = str_replace("%amount_sent%", $tramount, $smsmsg);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $receiver_ph,
			'message' => $smsmsg
        );
if($perm_sms == $perm_act) {
	if($rc_perm_sms == $rc_perm_act) {
include '../../../snipnetAPI/snipnet-que.php';
$result = curl_exec($ch);
    }else { }
}else { }
//END HERE
}
}else {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Error!</h4>
                Transaction not found.
              </div>";
}
}

if ($_POST["status"] == "Declined") {
$query = $con->query("Select * from trans_record tr, accounts ac, trans_history th, users u where  th.trans_id = tr.trans_his_id and th.trans_id='$transaction_id' and ac.account_no = th.receiver_acc_no and ac.usr_id = u.uss_id ORDER BY tr.id DESC");
        $query->num_rows > 0;
        if($row = $query->fetch_assoc()){
if ($row['tr_status'] == "Declined") {
	echo "<div class='alert alert-info alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-info'></i> Info!</h4>
               Transaction has already been declined.
              </div>";
	
}else {
	if($row['tr_status'] == "Completed") {
		echo "<div class='alert alert-info alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-info'></i> Info!</h4>
               Transaction must be placed on hold before you can decline.
              </div>";
    }else {
	$trdate = date("F j, Y");
	$trid = $row['trans_his_id'];
	$trstatus = "Declined";
	$note = "Declined and money refunded";
	$escrow = "0.00";
	$balance = $row['account_balance'] + $row['tr_total'];
	$accountno = $row['account_no'];
	$tramount = $row['tr_amount'];
	
	//required for email/sms only
	$r_ph = $row['phone'];
	$r_em = $row['email'];
	$r_name = $row['first_name'];
$r_id = $row['uss_id'];
$sel_query="Select * from shared_perm where UserID = '$r_id' ORDER BY perm_id;";
$result = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($result);
$rc_perm_email = $row["email"];
$rc_perm_sms = $row["sms"];
$rc_perm_act = 1;
	$query = $con->query("Select * from accounts ac, trans_history th, users u where th.trans_id='$transaction_id' and ac.account_no = th.usr_account_no and ac.usr_id = u.uss_id ORDER BY th.tr_id DESC");
	$row = $query->fetch_assoc();
	$s_ph = $row['phone'];
	$s_em = $row['email'];
	$s_name = $row['first_name'];
	$s_id = $row['uss_id'];
$sel_query="Select * from shared_perm where UserID = '$s_id' ORDER BY perm_id;";
$result = mysqli_query($con,$sel_query);
$row = mysqli_fetch_assoc($result);
$s_perm_email = $row["email"];
$s_perm_sms = $row["sms"];
$s_perm_act = 1;
	
	$update="update accounts set account_balance='".$balance."' where account_no='".$accountno."'";
     mysqli_query($con, $update) or die(mysqli_error());
	$update2="update trans_history set escrow='".$escrow."' where trans_id='".$trid."'";
     mysqli_query($con, $update2) or die(mysqli_error());
	$sql = "INSERT INTO trans_record (trans_his_id, tr_date, tr_status, note) VALUES ('".$trid."', '".$trdate."', '".$trstatus."', '".$note."');";
	 mysqli_query($con, $sql) or die(mysqli_error());
	 echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
                Transaction has been declined.
              </div>";
	
	//1
	$sender_em= $s_em;
	$subjecta = "Transaction Declined";
	$messagea = file_get_contents('../../../snipnetAPI/template/sender-transfer-declined-email.htm');
	
	//required from settings. do not edit/add more lines
	$messagea = str_replace("%b_url%", $b_url, $messagea); 
	$messagea = str_replace("%site_name%", $b_name, $messagea); 
	$messagea = str_replace("%site_address%", $b_address, $messagea);  
	
	//information needed per request
	$messagea = str_replace("%receiver_name%", $r_name, $messagea); 
	$messagea = str_replace("%sender_name%", $s_name, $messagea); 
	$messagea = str_replace("%transaction_id%", $trid, $messagea);
    $messagea = str_replace("%currency%", $acc_curency, $messagea);
	$messagea = str_replace("%amount_sent%", $tramount, $messagea);
	$messagea = str_replace("%transaction_status%", $trstatus, $messagea);
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
	if($s_perm_email == $s_perm_act) {
include '../../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

	//2
	$rec_em= $r_em;
	$subject = "Transaction Declined";
	$message = file_get_contents('../../../snipnetAPI/template/receiver-transfer-declined-email.htm');
	
	//required from settings. do not edit/add more lines
	$message = str_replace("%b_url%", $b_url, $message); 
	$message = str_replace("%site_name%", $b_name, $message); 
	$message = str_replace("%site_address%", $b_address, $message);  
	
	//information needed per request
	$message = str_replace("%receiver_name%", $r_name, $message); 
	$message = str_replace("%sender_name%", $s_name, $message); 
	$message = str_replace("%transaction_id%", $trid, $message);
    $message = str_replace("%currency%", $acc_curency, $message);
	$message = str_replace("%amount_sent%", $tramount, $message);
	$message = str_replace("%transaction_status%", $trstatus, $message);
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
include '../../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

    //1
    $sender_ph= $s_ph;
	//required from settings. do not edit/add more lines
	$smsmsg2 = file_get_contents('../../../snipnetAPI/template/sender-transfer-declined-sms.txt');
	$smsmsg2 = str_replace("%b_url%", $b_url, $smsmsg2); 
	
	//information needed per request
	$smsmsg2 = str_replace("%receiver_name%", $r_name, $smsmsg2); 
	$smsmsg2 = str_replace("%sender_name%", $s_name, $smsmsg2); 
	$smsmsg2 = str_replace("%transaction_id%", $trid, $smsmsg2);
    $smsmsg2 = str_replace("%currency%", $acc_curency, $smsmsg2);
	$smsmsg2 = str_replace("%amount_sent%", $tramount, $smsmsg2);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $sender_ph,
			'message' => $smsmsg2
        );
if($perm_sms == $perm_act) {
	if($s_perm_sms == $s_perm_act) {
include '../../../snipnetAPI/snipnet-que.php';
$result = curl_exec($ch);
    }else { }
}else { }

    //2
    $receiver_ph= $r_ph;
	//required from settings. do not edit/add more lines
	$smsmsg = file_get_contents('../../../snipnetAPI/template/receiver-transfer-declined-sms.txt');
	$smsmsg = str_replace("%b_url%", $b_url, $smsmsg); 
	
	//information needed per request
	$smsmsg = str_replace("%receiver_name%", $r_name, $smsmsg); 
	$smsmsg = str_replace("%sender_name%", $s_name, $smsmsg); 
	$smsmsg = str_replace("%transaction_id%", $trid, $smsmsg);
    $smsmsg = str_replace("%currency%", $acc_curency, $smsmsg);
	$smsmsg = str_replace("%amount_sent%", $tramount, $smsmsg);
	// Get SMS instance.
   $fields = array(
            'method' => $_SERVER['SERVER_NAME'],
            'user_email' => $user_email,
            'api_key' => $api_key,
			'senderid' => $short_name,
			'phone' => $receiver_ph,
			'message' => $smsmsg
        );
if($perm_sms == $perm_act) {
	if($rc_perm_sms == $rc_perm_act) {
include '../../../snipnetAPI/snipnet-que.php';
$result = curl_exec($ch);
    }else { }
}else { }
//END HERE
	}
}
}else {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Error!</h4>
                Transaction not found.
              </div>";
}
}
?>
            </tbody>
          </table>
		  <form method="post" action="" >
		<div class="input-group margin">
                <select class="form-control" name="status">
				<option value="0" >--Select an option--</option>
				<option value="Completed" >Approve</option>
				<option value="On-Hold" >Put On-Hold</option>
				<option value="Declined" >Decline</option>
				</select>
<?php
$sel_query="Select * from trans_record WHERE trans_his_id LIKE '$transaction_id' ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
if($row = $result->fetch_assoc()) {
	?>
                    <span class="input-group-btn">
<?php 
												if ($row['tr_status'] == "Completed") {
													echo "<button type='submit' class='btn btn-info btn-flat'>Update transfer!</button>";
												} elseif ($row['tr_status'] == "On-Hold") {
													echo "<button type='submit' class='btn btn-info btn-flat'>Update transfer!</button>";
												} elseif ($row['tr_status'] == "Declined") {
													echo "<div style='height:10px;' class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i></h4></div>";
												}
?>
                    </span>
<?php
}
?>
              </div>
			  </form>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
} else {
	echo "<meta http-equiv='refresh' content='0; url=transfer.php?action=list' />";
}
} elseif ($_REQUEST["action"] == "list") {
	?>


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transactions
        <small></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="transfer.php"><i class="fa fa-dashboard"></i> Transfer</a></li>
        <li class="active">Transactions</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
<div class="col-md-9">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Transactions</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Transaction ID</th>
					<th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
					<th>Fee</th>
                    <th>Status</th>
                  </tr>
                  </thead>
<?php 
$sel_query="Select * from trans_history ORDER BY tr_id desc;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 ?>
                  <tbody>
                  <tr>
                    <td><a href="transfer.php?action=view&&id=<?php echo $row["trans_id"] ?>"><?php echo strtoupper("TX"); ?><?php echo $row["trans_id"] ?></a></td>
					 <td><?php echo strtoupper($row["trans_date"]); ?> </td>
                    <td><small><?php echo strtoupper($row["tr_desc"]); ?></small></td>
                    <td><?php echo $acc_curency; ?><?php echo number_format($row["tr_amount"], 2); ?></td>
					 <td><?php echo $acc_curency; ?><?php echo number_format($row["trans_fee"], 2); ?></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
					  <?php 
$ts_id = $row["trans_id"];
$sel_query2="Select * from trans_record WHERE trans_his_id LIKE '$ts_id' ORDER BY id desc;";
$result2 = $con->query($sel_query2) or die($con->error);
if($row = $result2->fetch_assoc()) {
	$t_stat = $row["tr_status"];
	if($t_stat == "On-Hold") {
		echo "<span class='label label-warning'>$t_stat</span>";
	} elseif($t_stat == "Completed") {
		echo "<span class='label label-success'>$t_stat</span>";
		}elseif($t_stat == "Declined") {
		echo "<span class='label label-danger'>$t_stat</span>";
		}
} else {
	echo "<span class='label label-default'>Unknown</span>";
}
?>
</div>
					  
                    </td>
                  </tr>
                  </tbody>
<?php } 
} else {
    echo "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 No transaction record found.
                    </div>";
} 
?>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
}elseif ($_REQUEST["action"] == "TM") {
$method_id = $_REQUEST['id'];
$sel_query="Select * from transfer WHERE id LIKE '$method_id' ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
if($row = $result->fetch_assoc()) {

if (isset($_POST["updateTM"])) {
	$tr_id=$row["id"];
	$tr_name=$_POST["tr_name"];
	$tr_desc=$_POST["tr_desc"];
	$tr_fee=$_POST["tr_fee"];
	if($_POST["tr_status"] == '') { $tr_status="0"; }else { $tr_status=$_POST["tr_status"]; }
	if($_POST["tr_require"] == '') { $tr_require="1"; }else { $tr_require=$_POST["tr_require"]; }
	
$update="update transfer set name='".$tr_name."', descrip='".$tr_desc."', trans_fee='".$tr_fee."', trans_require='".$tr_require."', status='".$tr_status."' where id='".$tr_id."'";
$complete = mysqli_query($con, $update) or die(mysqli_error());
if($complete) {
   $status = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				Transfer method updated.
                    </div>";
}else {
   $status = "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Failed to update transfer method.</h4>
                    </div>";
}
}
if ($_REQUEST["mode"] == "delete") {
$did = $_REQUEST["did"];
$link = $row["link"];
$imglink = $row["icon"];
$lpath="../../home/transfer/$link";
$imgpath="../../home/transfer/img/$imglink";
$query = "DELETE FROM transfer WHERE id='$did'"; 
unlink($lpath);
unlink($imgpath);
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
if($result) {
   echo "<meta http-equiv='refresh' content='0; url=transfer.php?action=TMdone' />";
}else {
   echo "<meta http-equiv='refresh' content='0; url=transfer.php?action=TMfail' />";
}
}
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transfer Method
        <small></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="transfer.php"><i class="fa fa-dashboard"></i> Transfer</a></li>
        <li class="active">SN<?php echo $row["id"]; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
 <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $row["name"]; ?></h3>
            </div>
			<?php if($status) { echo $status; } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="tr_name" class="form-control" value="<?php echo $row["name"]; ?>" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Desc.</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" name="tr_desc" maxlength="70"><?php echo $row["descrip"]; ?></textarea>
                  </div>
                </div>
				<div class="form-group" style="padding-left:60px;">
                  <label for="inputPassword3" class="col-sm-2 control-label">Fee</label>

                  <div class="input-group col-xs-3">
                  <input type="text" name="tr_fee" class="form-control" value="<?php echo $row["trans_fee"]; ?>" placeholder="0.00">
				   <span class="input-group-addon">%</span>
                </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="tr_status" value="1" <?php if ($row["status"] == "1") { echo"checked"; }else { } ?>> Activate module
                      </label>
                    </div>
                  </div>
                </div>
				<div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="tr_require" value="0" <?php if ($row["trans_require"] == "0") { echo"checked"; }else { } ?>> Require manual review
                      </label>
                    </div>
                  </div>
                </div>
				<div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
<script>
function YNconfirm() { 
 if (window.confirm('This action will remove this transfer method and all its files leaving only transaction history.'))
 {
   window.location.href = 'transfer.php?action=TM&&mode=delete&&did=<?php echo $row["id"]; ?>&&id=<?php echo $row["id"]; ?>';
 }
}
</script>
                    <div class="checkbox">
                        <a onclick="YNconfirm(); return false;" href="#">Delete transfer method</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="transfer.php" ><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" name="updateTM" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		  </div>
		  </div>
		  </section>
		  </div>
<?php
}else {
	echo "<meta http-equiv='refresh' content='0; url=transfer.php' />";
}
}elseif ($_REQUEST["action"] == "TMnew") {

if(isset($_POST['newTM'])){
    $trname=$_POST["trname"];
	$trdesc=$_POST["trdesc"];
	$trfee=$_POST["trfee"];
	$trstatus=$_POST["trstatus"];
	$trrequire=$_POST["trrequire"];
	$ptemp = explode(".", $_FILES["pack"]["name"]);
    $newpackname = round(microtime(true)) . '.' . end($ptemp);
    move_uploaded_file($_FILES["pack"]["tmp_name"], "../../home/transfer/" . $newpackname);
	
	$prtemp = explode(".", $_FILES["preview"]["name"]);
    $newprvname = round(microtime(true)) . '.' . end($prtemp);
    move_uploaded_file($_FILES["preview"]["tmp_name"], "../../home/transfer/img/" . $newprvname);

    // Insert record
  $query = "insert into transfer (name,icon,link,descrip,trans_fee,trans_require,status) values('".$trname."','".$newprvname."','".$newpackname."','".$trdesc."','".$trfee."','".$trrequire."','".$trstatus."')";
  if(mysqli_query($con,$query)) {
	  echo "<meta http-equiv='refresh' content='0; url=transfer.php?action=TNEWsuccess' />";
  }else {
	  echo "<meta http-equiv='refresh' content='0; url=transfer.php?action=TNEWfail' />";
  }
 }
 
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transfer Method
        <small></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="transfer.php"><i class="fa fa-dashboard"></i> Transfer</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
 <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add New</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="trname" class="form-control" value="" placeholder="Name" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Desc.</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" name="trdesc" maxlength="70" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Package</label>

                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="pack" required>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Preview 410/270</label>

                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="preview" required>
                  </div>
                </div>
			
				<div class="form-group" style="padding-left:60px;">
                  <label class="col-sm-2 control-label">Fee</label>

                  <div class="input-group col-xs-3">
                  <input type="text" name="trfee" class="form-control" value="" placeholder="0.00" required>
				   <span class="input-group-addon">%</span>
                </div>
                </div>
                <div class="form-group">
				  <label class="col-sm-2 control-label">Status</label>
				  
                     <div class="col-xs-3">
                        <select name="trstatus" class="form-control">
						<option value="1">Activate</option>
						<option value="0">Deactivate</option>
                      </select>
                  </div>
                </div>
				<div class="form-group">
				  <label class="col-sm-2 control-label">Manual Review</label>
				  
                     <div class="col-xs-3">
                        <select name="trrequire" class="form-control">
						<option value="0">Yes</option>
						<option value="1">No</option>
                      </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="transfer.php" ><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" name="newTM" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		  </div>
		  </div>
		  </section>
		  </div>
<?php
}else {
	
?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transfer Methods 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transfer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
<div class="col-md-9">
<div class="box">
<?php if(isset($_REQUEST["action"])) {
if($_REQUEST["action"] == "TMdone") {
	echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				 Transfer method deleted
                    </div>";
}elseif($_REQUEST["action"] == "TMfail") {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Fail!</h4>
				 failed to delete
                    </div>";
}
if($_REQUEST["action"] == "TNEWsuccess") {
	echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				 New transfer method Installed
                    </div>";
}elseif($_REQUEST["action"] == "TNEWfail") {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Fail!</h4>
				 failed to install transfer method
                    </div>";
}
} ?>
            <div class="box-header">
              <h3 class="box-title">Transfer Methods</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="transfer.php?action=TMnew"><button type="button" class="btn btn-block btn-success btn-sm">Add New</button></a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
					<th>Name</th>
                    <th>Description</th>
					<th>Fee</th>
                    <th>Status</th>
                  </tr>
                  </thead>
<?php 
$sel_query="Select * from transfer ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 ?>
                  <tbody>
                  <tr>
                    <td><?php echo strtoupper("SN"); ?><?php echo $row["id"] ?></td>
					 <td><a href="transfer.php?action=TM&&id=<?php echo $row["id"] ?>"><?php echo strtoupper($row["name"]); ?> </a></td>
                    <td><small><?php echo strtoupper($row["descrip"]); ?></small></td>
					 <td><span class='label label-primary'>%<?php echo $row["trans_fee"]; ?></span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
					  <center><?php
	$t_stat = $row["status"];
	if($t_stat == "1") {
		echo "<i class='fa fa-check-circle' style='color:green;'></i>";
		}elseif($t_stat == "0") {
		echo "<i class='fa fa-info-circle' style='color:red;'></i>";
} else {
	echo "<span class='label label-default'>Unknown</span>";
}
?></center>
</div>
					  
                    </td>
                  </tr>
                  </tbody>
<?php }
} else {
    echo "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 No transfer methods installed.
                    </div>";
} ?>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
}
 include('footer.php');
 ?>