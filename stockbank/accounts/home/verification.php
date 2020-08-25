
<?php include 'templates/header.php'; ?>
<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

.btn-submit {
    position: relative;
    overflow: hidden;
}
.btn-submit input[type=submit] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
        <div class="m-t-n m-b">
          <div class="card m-b-0 bg-primary-dark p-a-md no-border m-b m-x-n-g">
            <div class="card-block" style="height: 450px;">
			<br/><br/><br/><br/><br/><br/>
						 <div class="row post-header text-white">
            <div class="col p-b-lg col-xs-8 col-xs-offset-2">
              <h1>HI, <?php echo $_SESSION['usr_name']; ?></h1>
              <h4>Your online account registration is complete, upload your  Passport or ID Card for verification purposes as required by our regulator.</h4>
            </div>
          </div>

  <?php
 
require('../db/index.php');
$id=$_SESSION['usr_id'];
$query = "SELECT * from users where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

$imageU = $row['id_front'];
$imageX = $row['id_back'];
$ids_front = "assets/img/ids/".$imageU;
$ids_back = "assets/img/ids/".$imageU;
?>

<?php
    include("../db/index.php");
     $status = "";
    if(isset($_POST['but_upload'])){
		$id=$_REQUEST['id'];
        $idfront = $_FILES['id_front']['name'];
		$idback = $_FILES['id_back']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["id_front"]["name"]);
		$target_file = $target_dir . basename($_FILES["id_back"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            
            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents($_FILES['id_front']['tmp_name']) );
			$image_base64 = base64_encode(file_get_contents($_FILES['id_back']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Insert record
			$update="update users set id_front='".$idfront."', id_back='".$idback."' where id='".$id."'";
            mysqli_query($con, $update) or die(mysqli_error($con));
			$status = "<meta http-equiv='refresh' content='0; url=complete.php' />";
            
            // Upload file
            move_uploaded_file($_FILES['id_front']['tmp_name'],'assets/img/ids/'.$idfront);
			move_uploaded_file($_FILES['id_back']['tmp_name'],'assets/img/ids/'.$idback);

        }
    
    }
    ?>
	<?php
{
?>
<centeer><?php echo $status; ?></centeer>
<form method="post" action="" enctype='multipart/form-data'>
<input name="id" type="hidden" value="<?php echo $_SESSION['usr_id'];?>" />
		  		  			<div class="col-lg-4">
    <div class="card-block">
<center><img src="assets/img/1.png" width="72" height="72" />
<img src="<?php echo $ids_front; ?>" width="207px" height="130px" Alt="" / >
</center>
<br/>
	<div class="form-group" style="margin-left:90px;">
    <label for="formGroupExampleInput2" style="font-size:15px; font-family:Century Gothic; color:#fff;"><strong>Passport or ID Card<font style="font-size:10px; color:gold;">[Front Scan]</font></strong></label>
<br/>
	<span class="btn btn-danger btn-file">
	Browse file<input name="id_front" type="file" />
</span>
</div>

    </div>
</div>

   <div class="col-lg-4">
    <div class="card-block">
	<center><img src="assets/img/2.png" width="72" height="72" />
<img src="<?php echo $ids_back; ?>" width="207px" height="130px" Alt="" / >
</center>
<br/>
	<div class="form-group" style="margin-left:90px;">
    <label for="formGroupExampleInput2" style="font-size:15px; font-family:Century Gothic; color:#fff;"><strong>Passport or ID Card<font style="font-size:10px; color:gold;">[Back Scan]</font></strong></label>
<br/>
	<span class="btn btn-danger btn-file">
	Browse file<input name="id_back" type="file" />
</span>
</div>

    </div>
</div>


  <div class="col-lg-4">
    <div class="card-block">
<p><span style="color: #ffffff;"><strong><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt;">What do i need to check ?</span></strong></span></p>
<ul>
<li><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt; color: #ffffff;">Upload colored copies only</span></li>
<li><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt; color: #ffffff;">Minimal resolution must be 300dpi</span></li>
<li><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt; color: #ffffff;">File format must be PNG or JPG</span></li>
<li><span style="font-family: 'trebuchet ms', geneva, sans-serif; font-size: 12pt; color: #ffffff;">Refer to the examples above</span></li>
</ul>
<p>&nbsp;</p>
<span class="btn btn-success btn-submit">
	Upload ID<input name='but_upload' type="submit" />
</span>
    </div>
</div>
</form>
<?php } ?>        
		</div>
		  
          </div>
 

</div>
<?php include 'templates/footer.php'; ?>