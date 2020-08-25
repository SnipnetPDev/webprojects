<?php
include 'header.php';
?>
<?php
 
require('../../db/index.php');

$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$c_name =$_REQUEST['c_name'];
$c_abbv = $_REQUEST['c_abbv'];
$c_sign = $_REQUEST['c_sign'];
$ins_query="insert into currency (`c_name`,`c_abbv`,`c_sign`) values ('$c_name','$c_abbv','$c_sign')";
mysqli_query($con,$ins_query) or die(mysql_error());
$status = "<div class='alert alert-success'>Currency added Successfully.</div>";
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
                            <h3 class="box-title">Add new currency</h3>
							<?php echo $status; ?>
<form name="form" method="post" action="">
<div class="form-group">
    <label for="formGroupExampleInput2">Name</label><br/>
<input type="hidden" name="new" value="1" />
<input type="text" class="form-control" name="c_name" placeholder="Currency name" required>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">Short name</label><br/>
<input type="text" class="form-control" name="c_abbv" placeholder="Short name" required>
</div>

<div class="form-group">
    <label for="formGroupExampleInput2">HTML code</label><br/>
<input type="text" class="form-control" name="c_sign" placeholder="HTML code" required>
</div>


<div class="form-group">
<input class="btn btn-success" name="submit" type="submit" value="Add Currency" />
</div>
</form>
</div>
                    </div>
                </div>
            </div>
<?php
include 'footer.php';
?>