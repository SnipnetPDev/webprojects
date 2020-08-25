<?php
include 'templates/header.php';
?>        
            <!-- Left nav
            ================================================== -->
            <div class="row">
<br/>
              <div class="span9">
                
   <style>
.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}
</style>
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $_SESSION['usr_name']; ?> <a href="settings.php" class="btn btn-primary">Back to settings</a></h3>

            </div>
            <div class="panel-body">
              <div class="row">
			  <?php
 
require('../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from users where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

$imageU = $row['imgname'];
$image_src = "assets/img/DP/".$imageU;
?>
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $image_src;  ?>" class="img-circle img-responsive" width="140px" height="140px"> <br/><br/>
 
</div>
                
                <div class=" col-md-9 col-lg-9 "> 
<p style="font-size:20px;">Upload Profile Photo</p>                 
<?php
    include("../db/index.php");
     $status = "";
    if(isset($_POST['but_upload'])){
		$id=$_REQUEST['id'];
        $imgname = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            
            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Insert record
			$update="update users set imgname='".$imgname."' where id='".$id."'";
            mysqli_query($con, $update) or die(mysqli_error($con));
			$status = "<div class='alert alert-success'>
  <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span> 
  Photo upload successful. You are now being redirected... <meta http-equiv='refresh' content='5; url=settings.php' /></div>";
            
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'],'assets/img/DP/'.$imgname);

        }
    
    }
    ?>
<?php
{
?>
<?php echo $status; ?>
<form method="post" action="" enctype='multipart/form-data'> 
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />

<div class="form-group">
    <label for="formGroupExampleInput2">Select Image</label>
<input type='file' name='file' />
</div>

 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button name='but_upload' type="submit" class="btn btn-primary">Upload</button>
      </div>
    </div>
</form>
<?php } ?>

                  </div>
              </div>
            </div>
              
          </div>






</div>                   

        
              </div>
            </div>
        
    <?php include 'templates/footer.php'; ?>  
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
} 	
return output;
}
</script>  
  </body>
</html>

