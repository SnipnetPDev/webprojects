<!-- /.col (left) -->
        <div class="col-md-6">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Transaction Date Changer</h3>
			  <p>Manage transaction dates. quick and easy. Works on all versions of FMCS.</p>
            </div>
            <!-- /.box-header -->
<?php
if($_REQUEST["edit"] == "Y"){
if (isset($_POST["updateDATE"])) {
	$tr_id=$_REQUEST['tid'];
	$new_date=$_POST["Ndate"];
	$update="update trans_history set trans_date='".$new_date."' where trans_id='".$tr_id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
	$update2="update trans_record set tr_date='".$new_date."' where trans_his_id='".$tr_id."'";
if(mysqli_query($con, $update2) or die(mysqli_error())) {
  echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Alert!</h4>
				Transaction Updated
                    </div>";
}else {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 Failed to update Transaction.
                    </div>";
}
}}
$tr_id=$_REQUEST['tid'];
$sel_query="Select * from trans_history WHERE trans_id LIKE '$tr_id' ORDER BY tr_id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {
?>
			<form method="post" >
            <div class="box-body no-padding">
			<div class="form-group">
             <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="Ndate" value="<?php echo $row["trans_date"]; ?>">
                </div>
				</div>
			  <button type="submit" name="updateDATE" class="btn bg-olive btn-flat margin">Update Transaction</button>
            </div>
            <!-- /.box-body -->
			</form>
<?php } }else{ 
$sel_query="Select * from trans_history ORDER BY tr_id desc;";
$result = mysqli_query($con,$sel_query);
while ($row = mysqli_fetch_assoc($result)) { ?>
<form method="post" >
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <td><?php echo $row["trans_date"]; ?></td>
                  <td><?php echo $row["tr_desc"]; ?> - <?php echo $t_cur; ?><?php echo $row["tr_amount"]; ?></td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&edit=Y&tid=<?php echo $row["trans_id"]; ?>" TARGET="_BLANK">Edit</a></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
			</form>

<?php }} ?>
          </div>
          <!-- /.box -->
		         </div>