<?php
include 'templates/header.php';
?>        
            <!-- Left nav
            ================================================== -->
            <div class="row">
<br/>
              <div class="span9">
                
   <style>
.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}
</style>
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $_SESSION['usr_name']; ?></h3>

            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="assets/img/user.ico" class="img-circle img-responsive"> <br/><br/>
 <a href="settings.php" class="btn btn-primary">Back to settings</a>
</div>
                
                <div class=" col-md-9 col-lg-9 "> 
<?php
 
require('../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from users where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<p style="font-size:20px;">Modify login password</p>                 
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$old_pass =$_REQUEST['old_pass'];
$new_pass =$_REQUEST['new_pass'];
if(md5($old_pass) == $row["password"]) {
$update="update users set password='".md5($new_pass)."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "<div class='alert alert-success'>
  <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
  <strong>Success!</strong> Password modified successfully.</div>";
echo $status;
} else echo "<div class='alert alert-danger'>
  <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
  <strong>Failed!</strong> Current password is incorrect.</div>";

}
?>
<?php
{
?>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />

<div class="form-group">
    <label for="formGroupExampleInput2">Old password</label>
<input type="text" class="form-control" name="old_pass" placeholder="Current password" required />
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">New password</label>
<input type="password" class="form-control" name="new_pass" placeholder="New password" required /> 
</div>

 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button name='submit' type="submit" class="btn btn-primary">Modify password</button>
      </div>
    </div>
</form>
<?php } ?>

                  </div>
              </div>
            </div>
              
          </div>






</div>                   

        
              </div>
            </div>
        
    <?php include 'templates/footer.php'; ?>  
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
} 	
return output;
}
</script>  
  </body>
</html>

