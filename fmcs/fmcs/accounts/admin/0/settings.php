<?php
include('header.php');
include('sidebar.php');
$id="1";
$query = "SELECT * from settings where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

$status = "";
if(isset($_POST['updateBASIC']))
{
$biz_name =$_REQUEST['biz_name'];
$biz_short_name =$_REQUEST['biz_short_name'];
$biz_domain =$_REQUEST['biz_domain'];

$target_dir = "../../../img/";
$target_file = $target_dir . basename("logo.png");
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Allow certain file formats
if($imageFileType != "png" ) {
    $status = "Sorry, only png files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $status = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
   move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
}

$target_dir1 = "../../../img/";
$target_file1 = $target_dir1 . basename("body.jpg");
$uploadOk1 = 1;
$imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));

// Allow certain file formats
if($imageFileType1 != "jpg" ) {
    $status = "Sorry, only jpg files are allowed.";
    $uploadOk1 = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
    $status = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
   move_uploaded_file($_FILES["bg"]["tmp_name"], $target_file1);
}

$target_dir2 = "../../../img/";
$target_file2 = $target_dir2 . basename("body2.jpg");
$uploadOk2 = 1;
$imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

// Allow certain file formats
if($imageFileType2 != "jpg" ) {
    $status = "Sorry, only jpg files are allowed.";
    $uploadOk2 = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk2 == 0) {
    $status = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
   move_uploaded_file($_FILES["bg2"]["tmp_name"], $target_file2);
}

$target_dir3 = "../../../img/";
$target_file3 = $target_dir3 . basename("favicon.ico");
$uploadOk3 = 1;
$imageFileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));

// Allow certain file formats
if($imageFileType3 != "ico" ) {
    $status = "Sorry, only ico files are allowed.";
    $uploadOk3 = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk3 == 0) {
    $status = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
   move_uploaded_file($_FILES["favicon"]["tmp_name"], $target_file3);
}

$target_dir4 = "../../../img/";
$target_file4 = $target_dir4 . basename("apple-touch-icon.png");
$uploadOk4 = 1;
$imageFileType4 = strtolower(pathinfo($target_file4,PATHINFO_EXTENSION));

// Allow certain file formats
if($imageFileType4 != "png" ) {
    $status = "Sorry, only PNG files are allowed.";
    $uploadOk4 = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk4 == 0) {
    $status = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
   move_uploaded_file($_FILES["favicon2"]["tmp_name"], $target_file4);
}
$update="update settings set title='".$biz_name."', short_name='".$biz_short_name."', b_url='".$biz_domain."' where id='".$id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
$status = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				Basic settings updated.
                    </div>";
}else {
	$status = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Failed!</h4>
				Failed to update Basic settings.
                    </div>";
}
}
if(isset($_POST['updateCONTACT']))
{
$biz_address =$_REQUEST['biz_address'];
$biz_phone =$_REQUEST['biz_phone'];
$biz_email =$_REQUEST['biz_email'];
$update="update settings set address='".$biz_address."', phone='".$biz_phone."', email='".$biz_email."' where id='".$id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
$status = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				Contact settings updated.
                    </div>";
}else {
	$status = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Failed!</h4>
				Failed to update Contact settings.
                    </div>";
}
}
if(isset($_POST['updateSNIPNET']))
{
$snipnet_id =$_REQUEST['snipnet_id'];
$snipnet_API =$_REQUEST['snipnet_API'];
$update="update settings set snipnet_email='".$snipnet_id."', api_key='".$snipnet_API."' where id='".$id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
$status = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				API settings updated.
                    </div>";
}else {
	$status = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Failed!</h4>
				Failed to update API settings.
                    </div>";
}
}

if(isset($_POST['updateSMTP']))
{
$smtp_h =$_REQUEST['smtp_h'];
$smtp_u =$_REQUEST['smtp_u'];
$smtp_p =$_REQUEST['smtp_p'];
$update="update smtp set host='".$smtp_h."', username='".$smtp_u."', password='".$smtp_p."' where id='".$id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
$status = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
				SMTP settings updated.
                    </div>";
}else {
	$status = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Failed!</h4>
				Failed to update SMTP settings.
                    </div>";
}
}
?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuration
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Configuration</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
<div class="col-md-7">
<?php if(isset($status)) {
	echo $status;
} ?>
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#tab_1-1" data-toggle="tab">Basic</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Contact</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">SMS API</a></li>
			  <li><a href="#tab_4-2" data-toggle="tab">SMTP</a></li>
              <li class="pull-left header"><i class="fa fa-wrench"></i> Configuration Menu</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
 <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Basic Settings</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form"  method="post" enctype="multipart/form-data">
              <div class="box-body">
			   <div class="form-group">
                  <label for="exampleInputFile">Logo</label>
                  <input type="file" name="logo">
               <img src="../../../img/logo.png" />
                  <p class="help-block">Upload a PNG logo at 246x42</p>
                </div>
				<div class="form-group">
                  <label for="exampleInputFile">Background (Outer)</label>
                  <input type="file" name="bg">
               <a href="../../../img/body.jpg" target="_BLANK">View image</a>
                  <p class="help-block">Upload a Large JPG file</p>
                </div>
				<div class="form-group">
                  <label for="exampleInputFile">Background (Inner)</label>
                  <input type="file" name="bg2">
               <a href="../../../img/body2.jpg" target="_BLANK">View image</a>
                  <p class="help-block">Upload a Large JPG file</p>
                </div>
				<div class="form-group">
                  <label for="exampleInputFile">Favicon</label>
                  <input type="file" name="favicon">
               <a href="../../../img/favicon.ico" target="_BLANK">View image</a>
                  <p class="help-block">Upload .ico only</p>
                </div>
				<div class="form-group">
                  <label for="exampleInputFile">Favicon (Apple touch icon)</label>
                  <input type="file" name="favicon2">
               <a href="../../../img/apple-touch-icon.png" target="_BLANK">View image</a>
                  <p class="help-block">Upload PNG fies only</p>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input name="biz_name" type="text" class="form-control" value="<?php echo $row['title'];?>" placeholder="Enter website title">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Short Name</label>
                  <input name="biz_short_name" value="<?php echo $row['short_name'];?>" type="text" maxlength="11" class="form-control" placeholder="Short Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Domain Name (EX: http://example.com)</label>
                  <input name="biz_domain" type="text" value="<?php echo $row['b_url'];?>" class="form-control" placeholder="Domain Name">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="updateBASIC" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
               <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Contact Settings</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form"  method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Business Address</label>
                  <input name="biz_address" value="<?php echo $row['address'];?>" type="text" class="form-control" placeholder="Business Address">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Business Phone</label>
                  <input name="biz_phone" value="<?php echo $row['phone'];?>" type="text" maxlength="11" class="form-control" placeholder="Business Phone">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Business Email</label>
                  <input name="biz_email" value="<?php echo $row['email'];?>" type="text" class="form-control" placeholder="Business Email">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="updateCONTACT" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
               <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">SMS API Settings</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Report to Email</label>
                  <input name="snipnet_id" value="<?php echo $row['snipnet_email'];?>" type="text" class="form-control" placeholder="Email to receive status report messages">
                </div>
<?php
$sel_query="Select * from license ORDER BY soft_name desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { 
$data = $row["license_id"];
$dataf = base64_decode($data);
}
?>
                <div class="form-group">
                  <label for="exampleInputPassword1">API Key</label>
                  <input name="snipnet_API" value="<?php echo $dataf;?>" type="TEXT" class="form-control" readonly="">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="updateSNIPNET" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
              </div>
              <!-- /.tab-pane -->

			  <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_4-2">
               <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">SMTP Settings</h3>
            </div>
<?php
$sel_query="Select * from smtp where id = '1' ;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { 
$host = $row["host"];
$username = $row["username"];
$password = $row["password"];
}
?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">HOST</label>
                  <input name="smtp_h" value="<?php echo $host;?>" type="text" class="form-control" placeholder="SMTP Host">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Username</label>
                  <input name="smtp_u" value="<?php echo $username;?>" type="TEXT" class="form-control" >
                </div>
				<div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input name="smtp_p" value="<?php echo $password;?>" type="password" class="form-control" >
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="updateSMTP" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
 include('footer.php');
 ?>