
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
 <h4><span >
         Add new payee
                            </span></h4>
<?php
 
require('../db/index.php');

$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$payee_name =$_REQUEST['payee_name'];
$payee_bank = $_REQUEST['payee_bank'];
$payee_acc_no = $_REQUEST['payee_acc_no'];
$payee_sort = $_REQUEST['payee_sort'];
$user_bond = $_REQUEST['user_bond'];
$ins_query="insert into payee (`payee_name`,`payee_bank`,`payee_acc_no`,`payee_sort`,`user_bond`) values ('$payee_name','$payee_bank','$payee_acc_no','$payee_sort','$user_bond')";
mysqli_query($con,$ins_query) or die(mysql_error());
$status = "<div class='alert alert-success'> 
  <strong>Payee added Successfully. You are now being redirected... <meta http-equiv='refresh' content='10; url=list_payee.php' />
</strong></div>";
}
?>
<?php echo $status; ?>              

<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />

<input type="hidden" name="user_bond" value="<?php echo $_SESSION['usr_id'];?>">

   <div class="col-lg-3">
    <div class="card-block">
<div class="form-group">
    <label for="formGroupExampleInput2">Payee Name</label>
<input type="text" class="form-control" name="payee_name" placeholder="Name of Payee" required /> 
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Their bank/institution</label>
<input type="text" class="form-control" name="payee_bank" placeholder="Bank/Institution Name" required /> 
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Their bank/institution Address</label>
<input type="text" class="form-control" name="payee_bank" placeholder="Bank/Institution Address" required /> 
</div>
	</div>
</div>
   <div class="col-lg-3">
    <div class="card-block">
<div class="form-group">
    <label for="formGroupExampleInput2">Their account number</label>
<input type="text" class="form-control" name="payee_acc_no" placeholder="Account Number" required /> 
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Routing Number</label>
<input type="text" class="form-control" placeholder="Routing Number" /> 
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Sort Code</label>
<input type="text" name="payee_sort" class="form-control" placeholder="Sort Code" /> 
</div>
	</div>
</div>

   <div class="col-lg-3">
    <div class="card-block">
<div class="form-group">
    <label for="formGroupExampleInput2">BIC/SWIFT Code</label>
<input type="text" class="form-control" placeholder="BIC/SWIFT Code" /> 
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">IBAN Number</label>
<input type="text" class="form-control" placeholder="IBAN Number" /> 
</div>
    </div>
		</div>
    <div class="card-block">
 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button name='submit' type="submit" class="btn btn-primary">Add Payee</button>
      </div>
		</div>
</div>
	  <br/>
	  <a href="list_payee.php"><i class="fa fa-external-link"></i> View Added Payee</a>
</form>
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

       
  </body>
</html>

