<?php
include 'header.php';
?>
<?php
 
require('../../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from currency where c_id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);
?>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$c_name =$_REQUEST['c_name'];
$c_abbv =$_REQUEST['c_abbv'];
$c_sign =$_REQUEST['c_sign'];
$update="update currency set c_name='".$c_name."', c_abbv='".$c_abbv."', c_sign='".$c_sign."' where c_id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "<div class='alert alert-success'>Currency Updated!</div>";
}
?>

        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">Edit - <?php echo $row['c_name'];?></h3>
							<?php echo $status; ?>
<form name="form" method="post" action="">
<div class="form-group">
    <label for="formGroupExampleInput2">Name</label><br/>
<input type="hidden" name="new" value="1" />
<input name="c_id" type="hidden" value="<?php echo $row['c_id'];?>" />
<input type="text" class="form-control" name="c_name" value="<?php echo $row['c_name'];?>" required>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Short name</label><br/>
<input type="text" class="form-control" name="c_abbv" value="<?php echo $row['c_abbv'];?>" required>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">HTML code</label><br/>
<input type="text" class="form-control" name="c_sign" value="<?php echo $row['c_sign'];?>" required>
</div>


<div class="form-group">
<input class="btn btn-success" name="submit" type="submit" value="Update Currency" />
</div>
</form>
</div>
                    </div>
                </div>
            </div>
<?php
include 'footer.php';
?>