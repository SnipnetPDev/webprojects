<?php
include 'header.php';
?>
<?php
 
require('../../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from admin where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
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
                           <h3 class="">Change admin password</h3>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$old_pass =$_REQUEST['old_pass'];
$new_pass =$_REQUEST['new_pass'];
if(md5($old_pass) == $row["password"]) {
$update="update admin set password='".md5($new_pass)."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "<div class='alert alert-success'>Password changed successfully.</div>";
echo $status;
} else echo "<div class='alert alert-danger'>Current password is incorrect.</div>";

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
<?php
include 'footer.php';
?>