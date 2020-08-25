<?php
include 'templates/header.php';
?>
<style>
ul.breadcrumb {
    padding: 8px 16px;
    list-style: none;
    background-color: #fff;
}
ul.breadcrumb li {display: inline; padding-left:10px; padding-right:10px;}
ul.breadcrumb li+li:before {
    padding: 10px;
    color: blue;
    content: "";
    background-image: url("assets/img/crumb.png");
    background-repeat: no-repeat;
    background-position: center;
}
ul.breadcrumb li a {color: blue;}
</style>
 <?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>

            <!-- Left nav
            ================================================== -->
<div class="col-lg-10 col-xs-8 col-xs-offset-1" >
<div class="m-x-n-g m-t-n-g overflow-hidden">
<div class="card m-b-0 bg-info-light text-black p-a-md no-border">
      <div class="card-block"> 
<ul class="breadcrumb">
  <li><a href="transfers.php">Amount</a></li>
  <li><a href="transfers.php">Details</a></li>
  <li><a href="#">Review</a></li>
  <li>Summary</li>
</ul>               
<?php
 
require('../db/index.php');
$tr_usr_id=$_SESSION['usr_id'];
$tr_acc_id=$row['id'];
$tr_acc_balsub=$row['account_balance'];
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$tr_acc_num =$_REQUEST['tr_acc_num'];
$tr_amount = $_REQUEST['tr_amount'];
$tr_payee = $_REQUEST['tr_payee'];
$tr_debit=$tr_acc_balsub-$tr_amount;
}
?>
<form name="form" method="post" action="transfers_new_EN_summary.php"> 
<input type="hidden" name="new" value="1" />
<input type="hidden" name="tr_acc_id" value="<?php echo $tr_acc_id;?>">
<input type="hidden" name="tr_usr_id" value="<?php echo $tr_usr_id;?>">
<input type="hidden" name="tr_amount" value="<?php echo $tr_amount;?>">
<input type="hidden" name="tr_date" value="<?php echo date("Y/m/d"); ?>">
<input type="hidden" name="tr_credit" value="0.00">
<input type="hidden" name="tr_debit" value="<?php echo $tr_debit;?>">
<div class="form-group">

<?php
$u_id=$_SESSION['usr_id'];
$tr_cur=$row['account_cur'];
$tr_acc_bal=$row['account_balance'];
$sel_query="Select * from payee WHERE payee_id LIKE '$tr_payee' ORDER BY payee_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<div class='alert alert-success' style='font-family:courier;'>
<label for="formGroupExampleInput2">TRANSACTION DETAILS</label><br/>
AMOUNT: &nbsp;<?php echo $tr_cur;?><?php echo $tr_amount; ?> <br/>
ACCOUNT: <?php echo $tr_acc_num; ?> <br/>
DATE: &nbsp;&nbsp;&nbsp;<?php echo date("Y/m/d"); ?>
<br/><br/>
<label for="formGroupExampleInput2">PAYEE DETAILS</label><br/>
<?php echo $row["payee_bank"]; ?> <br/>
<?php echo $row["payee_name"]; ?> <br/>
<?php echo $row["payee_acc_no"]; ?>
</div>
<input type="hidden" name="tr_payee_acc" value="<?php echo $row["payee_acc_no"]; ?>">
<input type="hidden" name="tr_payee" value="<?php echo $row["payee_acc_no"]; ?>">
<?php
$tr_payee_accz=$row["payee_acc_no"];
$sel_query="Select * from accounts WHERE account_no LIKE '$tr_payee_accz' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<input type="hidden" name="payee_acc_bal" value="<?php echo $row["account_balance"]; ?>">
<?php } ?>
<?php } ?>
<h4><span >TRANSFER DESCRIPTION</h4></span >
<textarea class="form-control" name="tr_desc">WFT - </textarea>
</div>
<br/>

 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
		<?PHP

$tr_acc_bal1 = $tr_acc_bal;
$tr_amount1 = $tr_amount;

if ($tr_acc_bal1 > $tr_amount1) {
print("<button name='submit' type='submit' class='btn btn-primary'>Transfer</button>");
}
else if($tr_acc_bal1 < $tr_amount1) {
print("<div class='alert alert-danger' style='font-family:courier;'>Insufficient funds in account. <a href='topup.php'>Topup account</a></div>");
}

?>
      </div>
    </div>
</form>

  </div>
</div>                    
  </div>
  </div>

<?php } 
else {  ?>
<meta http-equiv="refresh" content="0; url=index.php" />
<?php
}
?>

    <?php include 'templates/footer.php'; ?>