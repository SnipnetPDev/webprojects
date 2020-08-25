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
  <li><a href="#">Details</a></li>
  <li>Review</li>
  <li>Summary</li>
</ul>              
 <p style="font-size:15px;">Select payee for this transaction</p>  
<?php
 
require('../db/index.php');

$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$tr_acc_num =$_REQUEST['tr_acc_num'];
$tr_amount = $_REQUEST['tr_amount'];
}
?>
<form name="form" method="post" action="transfers_new_ipn_check.php"> 
<input type="hidden" name="new" value="1" />
<input type="hidden" name="tr_acc_num" value="<?php echo $tr_acc_num;?>">
<input type="hidden" name="tr_amount" value="<?php echo $tr_amount;?>">
<div class="form-group">
    <label for="formGroupExampleInput2">Payee</label><br/>
<select name="tr_payee" class="form-control">
<option>--Select Payee--</option> 
<?php
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from payee WHERE user_bond LIKE '$u_id' ORDER BY payee_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<option value="<?php echo $row["payee_id"]; ?>"><?php echo $row["payee_name"]; ?> - <?php echo $row["payee_acc_no"]; ?></option>
<?php } ?>
</select>
</div>
<div class='alert'>Only payee added to your account will be displayed above, if you have not added any payee, you should do so before you can continue with this transaction. You can add new payee by clicking on "Add New Payee" at the bottom of this page.</div>
<br/>

 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button name='submit' type="submit" class="btn btn-primary">Proceed</button>
      </div>
    </div>
</form>
<br/>
<a href="new_payee.php"><i class="fa fa-external-link"></i> Add New Payee</a>
<br/>
<a href="list_payee.php"><i class="fa fa-external-link"></i> View Added Payee</a>
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

