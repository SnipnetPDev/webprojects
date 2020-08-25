<?php include("password_protect.php"); ?>
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
 <h4><span >
         Setup new payment
                            </span></h4>
<ul class="breadcrumb">
  <li><a href="transfers.php">Amount</a></li>
  <li>Details</li>
  <li>Review</li>
  <li>Summary</li>
</ul>              
<div class='alert'>You need to add a payee to your account before you can make payments to them, if you have not added any payee, you should do so before continuing with this transaction. You can add new payee by clicking on "Add New Payee" at the left sidebar of this page.</div>
<form name="form" method="post" action="transfers_new_EN_details.php"> 
<input type="hidden" name="new" value="1" />
<div class="form-group">
    <label for="formGroupExampleInput2">Account</label>
<input type="hidden" name="tr_acc_num" value="<?php echo $row['account_no'];?>">

<input type="text" class="form-control" value="Bank Account - <?php echo $row['account_no'];?>" disabled>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Amount</label><br/>
<?php echo $row['account_cur'];?> <input style="width:40%;" type="text" name="tr_amount" placeholder="0.00" required /> 
</div>

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

