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

<div class="col-lg-10 col-xs-8 col-xs-offset-1" >
<div class="m-x-n-g m-t-n-g overflow-hidden">
<div class="card m-b-0 bg-info-light text-black p-a-md no-border">
 <h4><span >Request to close an account</h4></span > 
      <div class="card-block">                 
<form method="post" action="data_Msent_close.php"> 

<div class="form-group">
    <label for="formGroupExampleInput2">Account</label><br/>
<select class="form-control" name="acc_num">
<option value="<?php echo $row['account_no'];?>"><?php echo $row['account_no'];?></option>
</select>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Reasons for closing account</label><br/>
<textarea class="form-control" name="close_note"></textarea>
</div>


 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button name='submit' type="submit" class="btn btn-primary">Send Request</button>
      </div>
    </div>
</form>
<br/>
<a href="acc_upgrade.php"><i class="fa fa-external-link"></i> Upgrade Account</a>
<br/>
<a href="acc_request.php"><i class="fa fa-external-link"></i> Card/Check Book Request</a>
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

       
  </body>
</html>

