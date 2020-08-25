 <?php include("password_protect.php"); ?>
<?php
include 'templates/header.php';
?>
        
            <!-- Left nav
            ================================================== -->
            <div class="row">
              <div class="span5">
 <div class="card">
      <div class="card-block">
 
<?php
 
require('../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from accounts where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<h3 class='alert'>Modify PIN for account with account number: <font style="color:blue;"><?php echo $row['account_no'];?></font></h3>               
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$account_pin =$_REQUEST['account_pin'];
$confirm_pin =$_REQUEST['confirm_pin'];
if($_REQUEST["confirm_pin"] == $_REQUEST["account_pin"]) {
$update="update accounts set account_pin='".$account_pin."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "<div class='alert alert-success'>
  <strong>Account PIN modified successfully.</strong></div>";
echo $status;
} else echo "<div class='alert alert-danger'>
  <strong>PIN do not match.</strong></div>";

}
?>
<?php
{
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />

<div class="form-group">
    <label for="formGroupExampleInput2">New PIN</label>
<input type="password" class="form-control" name="account_pin" placeholder="New PIN" required />
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Confirm new PIN</label>
<input type="password" class="form-control" name="confirm_pin" placeholder="Confirm new PIN" required /> 
</div>

 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button name='submit' type="submit" class="btn btn-primary">Modify PIN</button>
      </div>
    </div>
</form>
<br/>
<a href="acc_upgrade.php"><i class="fa fa-external-link"></i> Upgrade Account</a>
<br/>
<a href="acc_request.php"><i class="fa fa-external-link"></i> Card/Check Book Request</a>
<br/>
<a href="close.php"><i class="fa fa-external-link"></i> Close Account</a>
<?php } ?>

  </div>
</div>                    
       </div>
        </div>
        </div>

        
    <?php include 'templates/footer.php'; ?>

