<?php
include 'header.php';
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
<h3 class="box-title">Update transaction information</h3>

 <?php
include_once '../../db/index.php';
if(isset($_POST['savemul']))
{
$id = $_POST['id'];
$dt = $_POST['dt'];
$de = $_POST['de'];
$chk = $_POST['chk'];
$chkcount = count($id);
for($i=0; $i<$chkcount; $i++)
{
	$con->query("UPDATE trans_history SET tr_date='$dt[$i]', tr_desc='$de[$i]' WHERE tr_id=".$id[$i]);
}
echo "<div class='alert alert-success'><strong>Success!</strong> Transactions Updated.</div>";

}
?>

<?php
require('../../db/index.php');
if(isset($_REQUEST['deid']))
{
$deid=$_REQUEST['deid'];
$query = "DELETE FROM trans_history WHERE tr_id=$deid"; 
$result = mysqli_query($con,$query) or die ( mysqli_error());
header("Location: "); 
}
?>

<form method="post" action="">
<div class='table-responsive'>
<table class=''>
<tr>
<th>Transaction Date</th>
<th>Description</th>
<th>Credit</th>
<th>Debit</th>
<th>Action</th>
</tr>

<?php 
$res=$con->query("SELECT * FROM trans_history ORDER BY tr_id desc");
while($row=$res->fetch_array())
{

?>
		<tr>
		<td>
    	<input type="hidden" name="id[]" value="<?php echo $row['tr_id'];?>" />
		<input type="text" name="dt[]" value="<?php echo $row['tr_date'];?>" class="form-control" />
        </td>
        <td>
		<input type="text" name="de[]" value="<?php echo $row['tr_desc'];?>" class="form-control" />
		</td>
		 <td>
		<input type="text" value="<?php echo $row['tr_credit'];?>" class="form-control" disabled>
		</td>
		<td>
		<input type="text" value="<?php echo $row['tr_debit'];?>" class="form-control" disabled>
		</td>
		<td>
		<a href="?deid=<?php echo $row["tr_id"]; ?>">  Delete</a>
		</td>
		</tr>

<?php }		?>
<tr>
<td colspan="2">
<br/><br/>
<button type="submit" name="savemul" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> &nbsp; Update Transactions</button>&nbsp;
<a href="plugin.php" class="btn btn-large btn-danger"> <i class="glyphicon glyphicon-fast-backward"></i> &nbsp; cancel</a>
</td>
</tr>
</table>
</div>
</form>
							
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- chat-listing & recent comments -->
                <!-- ============================================================== -->
            </div>
			</div>
<?php
include 'footer.php';
?>