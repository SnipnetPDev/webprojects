 <?php include("password_protect.php"); ?>
<?php
include 'templates/header.php';
?>
            <div class="row">
              <div class="span9">
 <div class="card">
      <div class="card-block">
 
<?php
 
require('../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from accounts where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<p style="font-size:20px;">Modify security questions/Answers for account with account number: <font style="color:blue;"><?php echo $row['account_no'];?></font></p>                 
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$account_sqa1 =$_REQUEST['account_sqa1'];
$account_sqa1a =$_REQUEST['account_sqa1a'];
$account_sqa2 =$_REQUEST['account_sqa2'];
$account_sqa2a =$_REQUEST['account_sqa2a'];
$update="update accounts set account_sqa1='".$account_sqa1."', account_sqa1a='".$account_sqa1a."', account_sqa2='".$account_sqa2."', account_sqa2a='".$account_sqa2a."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "<div class='alert alert-success'>
  <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
  <strong>Changes saved successfully</strong></div>";
echo $status;
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
<label for="formGroupExampleInput2">Security Question <font style="font-size:9px;">1</font></label><br/>
<select class="form-control" name="account_sqa1" > 
<option value="-- <?php echo $row['account_sqa1'];?>"><?php echo $row['account_sqa1'];?> - Leave Default --</option>
<option value="What is the name of your favorite uncle?" >What is the name of your favorite uncle?</option><br/>
<option value="How old is your dog?" >How old is your dog?</option>
<option value="What is your favorite drink?" >What is your favorite drink?</option>
<option value="What is the name of your favorite neice?" >What is the name of your favorite neice?</option>
</select>
</div>

<div class="form-group">
<label for="formGroupExampleInput2">Answer</label><br/>
<input type="" class="form-control" name="account_sqa1a" />
</div>

<div class="form-group">
<label for="formGroupExampleInput2">Security Question <font style="font-size:9px;">2</font></label><br/>
<select class="form-control" name="account_sqa2" > 
<option value="-- <?php echo $row['account_sqa2'];?>"><?php echo $row['account_sqa2'];?> - Leave Default --</option>
<option value="What is the name of your favorite pet?" >What is the name of your favorite pet?</option><br/>
<option value="What is your favorite song?" >What is your favorite song?</option>
<option value="How long is your hair?" >How long is your hair?</option>
<option value="What is the name of your favorite neice?" >What is the name of your favorite neice?</option>
</select>
</div>

<div class="form-group">
<label for="formGroupExampleInput2">Answer</label><br/>
<input type="" class="form-control" name="account_sqa2a" /> 
</div>
 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button name='submit' type="submit" class="btn btn-primary">Save Changes</button>
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
        
    <?php include 'templates/footer.php'; ?>

       
  </body>
</html>

