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
$account_status =$_REQUEST['account_status'];
$a_status_color =$_REQUEST['a_status_color'];
$update="update accounts set account_no='".$account_no."', account_status='".$account_status."', a_status_color='".$a_status_color."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error($con));
$status = "<div class='alert alert-success'>Account status update successfull</div>";
echo $status;
}
?>
                            <h3 class="box-title">Update account status: <strong><?php echo $row['account_no'];?></strong><br/> Current status: <strong><?php echo $row['account_status'];?></strong></h3>
<form name="form" method="post" action=""> 
<div class="form-group">
    <label for="formGroupExampleInput2">Account Number</label><br/>
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
<input name="account_no" type="hidden" value="<?php echo $row['account_no'];?>" />

<input type="text" class="form-control" name="account_no" required value="<?php echo $row['account_no'];?>" disabled>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">New account status</label><br/>
<select class="form-control" name="account_status">
<option value="<?php echo $row['account_status'];?>"><?php echo $row['account_status'];?> - Leave Default</option>
<option value="Active">Active</option>
<option value="Dormant">Dormant</option>
</select>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Confirm new account status</label><br/>
<select class="form-control" name="a_status_color">
<option value="<?php echo $row['a_status_color'];?>"><?php echo $row['account_status'];?> - Leave Default</option>
<option value="success">Active</option>
<option value="danger">Dormant</option>
</select>
</div>

<div class="form-group">
<input class="btn btn-danger" name="submit" type="submit" value="Update" />
</div>
</form>
</div>
                    </div>
                </div>
            </div>

<?php
include 'footer.php';
?>