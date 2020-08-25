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
<?php
}else { ?>
 <div class="col-md-6">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">INPUT OPTIONS TEMPLATES</h3>
			  <p>Editing cannot be undone.</p>
            </div>
            <!-- /.box-header -->
			<form method="post" >
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <td>1.</td>
                  <td>Types of account</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../core/html-option/account-type-option.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>2.</td>
                  <td>Country list</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../core/html-option/country-option.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>3.</td>
                  <td>Employment</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../core/html-option/employment-option.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>4.</td>
                  <td>Funding mode</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../core/html-option/funding-mode-option.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>5.</td>
                  <td>Passport / ID's</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../core/html-option/id-option.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
				<tr>
                  <td>6.</td>
                  <td>Client title</td>
                  <td><a href="module.php?action=open&&id=<?php echo $m_id; ?>&loader=editorLITE&source=../../../core/html-option/title-option.htm" TARGET="_BLANK">Edit</a></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
			</form>
          </div>
          <!-- /.box -->
		         </div>
<?php } ?>