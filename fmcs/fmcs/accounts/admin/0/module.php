<?php
include('header.php');
include('sidebar.php');
if ($_REQUEST["action"] == "open") {
$m_id=$_REQUEST['id'];
$sel_query="Select * from moudle WHERE id=$m_id ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if($row = mysqli_fetch_assoc($result)) { 
$page_inf=$row["m_link"];
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $row['m_name']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="module.php"></a>Module</li>
        <li class="active"><?php echo $row['m_name']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.col -->
<div class="row">
<?php 
$link = "module/$page_inf";
include $link; ?>
      </div>
      <!-- /.row -->
        <!-- /.col -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
} else {
	echo "<meta http-equiv='refresh' content='0; url=module.php' />";
}
}elseif ($_REQUEST["action"] == "MD") {
$md_id = $_REQUEST['id'];
$sel_query="Select * from moudle WHERE id LIKE '$md_id' ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
if($row = $result->fetch_assoc()) {

if (isset($_POST["updateMD"])) {
	$m_id=$row["id"];
	$m_name=$_POST["m_name"];
	$m_desc=$_POST["m_desc"];
	if($_POST["m_status"] == '') { $m_status="0"; }else { $m_status=$_POST["m_status"]; }
	
$update="update moudle set m_name='".$m_name."', m_desc='".$m_desc."', m_status='".$m_status."' where id='".$m_id."'";
$complete = mysqli_query($con, $update) or die(mysqli_error());
if($complete) {
   $status = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				Module updated.
                    </div>";
}else {
   $status = "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Failed to update module.</h4>
                    </div>";
}
}
if ($_REQUEST["mode"] == "delete") {
$did = $_REQUEST["did"];
$link = $row["m_link"];
$lpath="module/$link";
$query = "DELETE FROM moudle WHERE id='$did'"; 
unlink($lpath);
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
if($result) {
   echo "<meta http-equiv='refresh' content='0; url=module.php?action=TMdone' />";
}else {
   echo "<meta http-equiv='refresh' content='0; url=module.php?action=TMfail' />";
}
}
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        App Modules
        <small></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="module.php"><i class="fa fa-dashboard"></i> App Modules</a></li>
        <li class="active">SN<?php echo $row["id"]; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
 <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $row["m_name"]; ?></h3>
            </div>
			<?php if($status) { echo $status; } ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="m_name" class="form-control" value="<?php echo $row["m_name"]; ?>" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Desc.</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" name="m_desc" maxlength="70"><?php echo $row["m_desc"]; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                      <label>
                        <input class="flat-red" type="checkbox" name="m_status" value="1" <?php if ($row["m_status"] == "1") { echo"checked"; }else { } ?>> 
						Activate module
                      </label>
                  </div>
                </div>
				<div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
<script>
function YNconfirm() { 
 if (window.confirm('This action will remove this module and all its files..'))
 {
   window.location.href = 'module.php?action=MD&&mode=delete&&did=<?php echo $row["id"]; ?>&&id=<?php echo $row["id"]; ?>';
 }
}
</script>
                    <div class="checkbox">
                        <a onclick="YNconfirm(); return false;" href="#">Delete module</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="module.php" ><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" name="updateMD" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		  </div>
		  </div>
		  </section>
		  </div>
<?php
}else {
	echo "<meta http-equiv='refresh' content='0; url=module.php' />";
}
}elseif ($_REQUEST["action"] == "new") {

if(isset($_POST['newMD'])){
    $mdname=$_POST["mdname"];
	$mddesc=$_POST["mddesc"];
	$mdstatus=$_POST["mdstatus"];
	$ptemp = explode(".", $_FILES["pack"]["name"]);
    $newpackname = round(microtime(true)) . '.' . end($ptemp);
    move_uploaded_file($_FILES["pack"]["tmp_name"], "module/" . $newpackname);

    // Insert record
  $query = "insert into moudle (m_name,m_desc,m_link,m_status) values('".$mdname."','".$mddesc."','".$newpackname."','".$mdstatus."')";
  if(mysqli_query($con,$query)) {
	  echo "<meta http-equiv='refresh' content='0; url=module.php?action=MNEWsuccess' />";
  }else {
	  echo "<meta http-equiv='refresh' content='0; url=module.php?action=MNEWfail' />";
  }
 }
 
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       App Modules
        <small></small>
      </h1>
      <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="module.php"><i class="fa fa-dashboard"></i> App Modules</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
 <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add New</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" name="mdname" class="form-control" value="" placeholder="Name" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Desc.</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" name="mddesc" maxlength="70" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Package</label>

                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="pack">
                  </div>
                </div>
                <div class="form-group">
				  <label class="col-sm-2 control-label">Status</label>
				  
                     <div class="col-xs-3">
                        <select name="mdstatus" class="form-control">
						<option value="1">Activate</option>
						<option value="0">Deactivate</option>
                      </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="module.php" ><button type="button" class="btn btn-default">Cancel</button></a>
                <button type="submit" name="newMD" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		  </div>
		  </div>
		  </section>
		  </div>
<?php
}else {
	
?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Installed Modules
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Installed Modules</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
<div class="col-md-9">
<div class="box">
<?php if(isset($_REQUEST["action"])) {
if($_REQUEST["action"] == "TMdone") {
	echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				 module deleted
                    </div>";
}elseif($_REQUEST["action"] == "TMfail") {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Fail!</h4>
				 failed to delete module
                    </div>";
}
if($_REQUEST["action"] == "MNEWsuccess") {
	echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				 New module Installed
                    </div>";
}elseif($_REQUEST["action"] == "MNEWfail") {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Fail!</h4>
				 failed to install module
                    </div>";
}
} ?>
            <div class="box-header">
              <h3 class="box-title">Installed Modules</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="module.php?action=new"><button type="button" class="btn btn-block btn-success btn-sm">Add New</button></a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
					<th>Name</th>
                    <th>Description</th>
					<th><center>Package</center></th>
                    <th><center>Status</center></th>
                  </tr>
                  </thead>
<?php 
$sel_query="Select * from moudle ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 ?>
                  <tbody>
                  <tr>
                    <td><?php echo strtoupper("SN"); ?><?php echo $row["id"] ?></td>
					 <td><a href="module.php?action=MD&&id=<?php echo $row["id"] ?>"><?php echo strtoupper($row["m_name"]); ?> </a></td>
                    <td><small><?php echo strtoupper($row["m_desc"]); ?></small></td>
					 <td><div class="sparkbar" data-color="#00a65a" data-height="20">
					 <center><?php
$openid = $row["id"];
$m_linkr = $row["m_link"];
$track = "module/$m_linkr";
if(is_file($track)) {
echo "<a href='module.php?action=open&&id=$openid' target='_BLANK'><span class='label label-primary'><i class='fa fa-check-circle' style='color:white;'></i> Open</span></a>";                         
} else {
echo "<i class='fa fa-info-circle' style='color:red;'></i>";
}
?></center>
</div>
</td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
					  <center><?php
	$t_stat = $row["m_status"];
	if($t_stat == "1") {
		echo "<i class='fa fa-check-circle' style='color:green;'></i>";
		}elseif($t_stat == "0") {
		echo "<i class='fa fa-info-circle' style='color:red;'></i>";
} else {
	echo "<span class='label label-default'>Unknown</span>";
}
?></center>
</div>
					  
                    </td>
                  </tr>
                  </tbody>
<?php }
} else {
    echo "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 No module installed.
                    </div>";
} ?>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
}
 include('footer.php');
 ?>