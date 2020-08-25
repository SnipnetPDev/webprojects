<!-- /.col (left) -->
        <div class="col-md-6">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">PERMISSION</h3>
			  <p>Enable and disable service permission, when checked red the service will be unavailable to end-users. This may sometimes apply to administrators in most cases.</p>
            </div>
            <!-- /.box-header -->
<?php 
if (isset($_POST["updatePERM"])) {
	$pm_id = 1;
	if($_POST["transfer"] == '') { $pm_transfer="0"; }else { $pm_transfer=$_POST["transfer"]; }
	if($_POST["email"] == '') { $pm_email="0"; }else { $pm_email=$_POST["email"]; }
	if($_POST["sms"] == '') { $pm_sms="0"; }else { $pm_sms=$_POST["sms"]; }
	if($_POST["cards"] == '') { $pm_cards="0"; }else { $pm_cards=$_POST["cards"]; }
	if($_POST["help"] == '') { $pm_help="0"; }else { $pm_help=$_POST["help"]; }
	$update="update super_perm set transfer='".$pm_transfer."', email='".$pm_email."', sms='".$pm_sms."', cards='".$pm_cards."', help='".$pm_help."' where perm_id='".$pm_id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
  echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Alert!</h4>
				Permission Updated
                    </div>";
}else {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 Failed to update Permission.
                    </div>";
}
}
?>
			<form method="post" >
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <td>1.</td>
                  <td>Money Transfer</td>
                  <td><input type="radio" value="1" name="transfer" class="flat-red" <?php if ($perm_transfer == $perm_act) { echo"checked"; }else { } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="" name="transfer" class="minimal-red" <?php if ($perm_transfer == 0) { echo"checked"; }else { } ?>></td>
                </tr>
				<tr>
                  <td>2.</td>
                  <td>Email</td>
                  <td><input type="radio" value="1" name="email" class="flat-red" <?php if ($perm_email == $perm_act) { echo"checked"; }else { } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="" name="email" class="minimal-red" <?php if ($perm_email == 0) { echo"checked"; }else { } ?>></td>
                </tr>
				<tr>
                  <td>3.</td>
                  <td>SMS</td>
                  <td><input type="radio" value="1" name="sms" class="flat-red" <?php if ($perm_sms == $perm_act) { echo"checked"; }else { } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="" name="sms" class="minimal-red" <?php if ($perm_sms == 0) { echo"checked"; }else { } ?>></td>
                </tr>
				<tr>
                  <td>4.</td>
                  <td>Credit Cards</td>
                  <td><input type="radio" value="1" name="cards" class="flat-red" <?php if ($perm_cards == $perm_act) { echo"checked"; }else { } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="" name="cards" class="minimal-red" <?php if ($perm_cards == 0) { echo"checked"; }else { } ?>></td>
                </tr>
				<tr>
                  <td>5.</td>
                  <td>Help</td>
                  <td><input type="radio" value="1" name="help" class="flat-red" <?php if ($perm_help == $perm_act) { echo"checked"; }else { } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="" name="help" class="minimal-red" <?php if ($perm_help == 0) { echo"checked"; }else { } ?>></td>
                </tr>
              </table>
			  <button type="submit" name="updatePERM" class="btn bg-olive btn-flat margin">Update Permission</button>
            </div>
            <!-- /.box-body -->
			</form>
          </div>
          <!-- /.box -->
		         </div>