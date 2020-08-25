<?php
include 'header.php';
?>
<?php
 
require('../../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from accounts where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
						<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id =$_REQUEST['id'];
$account_no =$_REQUEST['account_no'];
$account_type =$_REQUEST['account_type'];
$funding_mode =$_REQUEST['funding_mode'];
$account_cur =$_REQUEST['account_cur'];
$update="update accounts set account_no='".$account_no."', account_type='".$account_type."', funding_mode='".$funding_mode."', account_cur='".$account_cur."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error($con));
$status = "<div class='alert alert-success'>Account upgrade successfull</div>";
echo $status;
}
?>
                            <h3 class="box-title">Account Upgrade: <strong><?php echo $row['account_no'];?></strong></h3>
							<form name="form" method="post" action=""> 
<div class="form-group">
    <label for="formGroupExampleInput2">Account Number</label><br/>
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />

<input type="text" class="form-control" name="account_no" required value="<?php echo $row['account_no'];?>" />
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Account Type</label><br/>
<select class="form-control" name="account_type">
<option value="<?php echo $row['account_type'];?>"><?php echo $row['account_type'];?> - Leave Default</option>
<option value="Savings">Savings</option>
<option value="Fixed Deposit">Fixed Deposit</option>
<option value="Current">Current</option>
<option value="Certificates of Deposit (CDs)">Certificates of Deposit (CDs)</option>
</select>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Mode of funding</label><br/>
<select class="form-control" name="funding_mode">
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
    <label for="formGroupExampleInput2">Account Currency</label><br/>
<select class="form-control" name="account_cur">
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
<div class="form-group">
<input class="btn btn-danger" name="submit" type="submit" value="Upgrade" />
</div>
</form>
</div>
                    </div>
                </div>
            </div>

<?php
include 'footer.php';
?>