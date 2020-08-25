<?php if($_REQUEST["loader"] == "editorLITE") {
	$content = $_REQUEST["source"];
	if(isset($_POST["save"])) {
$t_content = $_POST["content"];
$myfile = fopen("$content", "w") or die("Unable to open file!");
fwrite($myfile, $t_content);
if(fclose($myfile)) {
	echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				Template updated successfully.
                    </div>";
}else {
	echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Error!</h4>
				Failed to updated Template.
                    </div>";
}
}
?>
        <div class="col-md-8">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">EditorLITE
                <small><?php echo $content; ?></small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form method="post" action="">
                    <textarea name="content" rows="10" cols="80"><?php include "$content"; ?></textarea>
					<br/>
					 <button type="submit" name="save" class="btn bg-olive btn-flat margin">Save Changes</button>
              </form>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-->

<?php }elseif($_REQUEST["loader"] == "editor") {
	$content = $_REQUEST["source"];
if(isset($_POST["save"])) {
$t_content = $_POST["content"];
$myfile = fopen("$content", "w") or die("Unable to open file!");
fwrite($myfile, $t_content);
if(fclose($myfile)) {
	echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				Template updated successfully.
                    </div>";
}else {
	echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Error!</h4>
				Failed to updated Template.
                    </div>";
}
}
?>
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Editor
                <small><?php echo $content; ?></small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form method="post" action="">
                    <textarea id="editor1" name="content" rows="10" cols="80"><?php include "$content"; ?></textarea>
					 <button type="submit" name="save" class="btn bg-olive btn-flat margin">Save Changes</button>
              </form>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-->
<?php
}else { ?>
<!-- /.col (left) -->
        <div class="col-md-6">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">EMAIL TEMPLATES</h3>
			  <p>Editing email templates require HTML language skills.</p>
            </div>
            <!-- /.box-header -->
			<form method="post" >
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <td>1.</td>
                  <td>Additional email verification</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/email-verification.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>2.</td>
                  <td>Registration verification</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/first-reg-email.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>3.</td>
                  <td>Welcome Message</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/second-reg-email.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>4.</td>
                  <td>Password recovery</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/password-recovery.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>5.</td>
                  <td>Password recovery complete</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/password-recovery-complete.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>6.</td>
                  <td>Transaction complete (Receiver)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/receiver-transfer-email.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>7.</td>
                  <td>Transaction complete (Sender)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/sender-transfer-email.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>8.</td>
                  <td>Transaction On-hold (Receiver)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/receiver-transfer-on-hold-email.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>9.</td>
                  <td>Transaction On-hold (Sender)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/sender-transfer-on-hold-email.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>10.</td>
                  <td>Transaction declined (Receiver)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/receiver-transfer-declined-email.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>11.</td>
                  <td>Transaction declined (Sender)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editor&source=../../../snipnetAPI/template/sender-transfer-declined-email.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
			</form>
          </div>
          <!-- /.box -->
		         </div>

 <div class="col-md-6">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">SMS TEMPLATES</h3>
			  <p>Editing cannot be undone.</p>
            </div>
            <!-- /.box-header -->
			<form method="post" >
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <td>1.</td>
                  <td>Additional number verification</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/number-verification.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>2.</td>
                  <td>Registration verification</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/first-reg-sms.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>3.</td>
                  <td>Welcome message</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/second-reg-sms.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>4.</td>
                  <td>Transaction complete (Receiver)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/receiver-transfer-sms.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>5.</td>
                  <td>Transaction complete (Sender)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/sender-transfer-sms.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>6.</td>
                  <td>Transaction On-hold (Receiver)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/receiver-transfer-on-hold-sms.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>7.</td>
                  <td>Transaction On-hold (Sender)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/sender-transfer-on-hold-sms.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>8.</td>
                  <td>Transaction declined (Receiver)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/receiver-transfer-declined-sms.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>9.</td>
                  <td>Transaction declined (Sender)</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../snipnetAPI/template/sender-transfer-declined-sms.txt" TARGET="_BLANK">Edit</a></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
			</form>
          </div>
          <!-- /.box -->
		         </div>
<?php } ?>