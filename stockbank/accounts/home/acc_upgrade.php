 <?php include("password_protect.php"); ?>
<?php
include 'templates/header.php';
?>

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
<h4><span >Account Upgrade</h4></span > 
      <div class="card-block"> 
<form method="post" action="data_Msent.php"> 

<div class="form-group">
    <label for="formGroupExampleInput2">Account</label><BR/>
<select class="form-control" name="acc_num">
<option value="<?php echo $row['account_no'];?>"><?php echo $row['account_no'];?></option>
</select>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Account Type</label><BR/>
<select class="form-control" name="acc_type">
<option value="<?php echo $row['account_type'];?>"><?php echo $row['account_type'];?> - Leave Default</option>
<option value="Savings">Savings</option>
<option value="Fixed Deposit">Fixed Deposit</option>
<option value="Current">Current</option>
<option value="Certificates of Deposit (CDs)">Certificates of Deposit (CDs)</option>
</select>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Mode of funding</label><BR/>
<select class="form-control" name="acc_fmode">
<option value="<?php echo $row['funding_mode'];?>"><?php echo $row['funding_mode'];?> - Leave Default</option>
<option selected value="">--Select new funding mode--</option>
<option value="Pension or retirement savings" >Pension or retirement savings</option><br/>
<option value="funds from another account" >funds from another account</option>
<option value="Sale of business or property" >Sale of business or property</option>
<option value="Credit Card" >Credit Card</option>
<option value="Gift" >Gift</option>
<option value="Insurance payout" >Insurance payout</option>
<option value="Inheritance" >Inheritance</option>
<option value="Home Equity Line of Credit/Reverse Mortgage" >Home Equity Line of Credit/Reverse Mortgage</option>
<option value="Gift" >Gift</option>
<option value="Other" >Other</option>
</select>
</div>


<div class="form-group">
    <label for="formGroupExampleInput2">Account Currency</label><BR/>
<select class="form-control" name="acc_cur">
<option value="<?php echo $row['account_cur'];?>"><?php echo $row['account_cur'];?> - Leave Default</option>
<option selected value="">--Select new currency for account--</option>
<?php
$sel_query="Select * from currency ORDER BY c_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<option value="<?php echo $row["c_sign"]; ?>"><?php echo $row["c_name"]; ?></option>
<?php } ?>
</select>
</div>

 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button name='submit' type="submit" class="btn btn-primary">Send Request</button>
      </div>
    </div>
</form>
<br/>
<a href="acc_request.php"><i class="fa fa-external-link"></i> Card/Check Book Request</a>
<br/>
<a href="close.php"><i class="fa fa-external-link"></i> Close Account</a>
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
