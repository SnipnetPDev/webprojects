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
              <h3 class="panel-title"><?php echo $_SESSION['usr_name']; ?></h3>

            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="assets/img/user.ico" class="img-circle img-responsive"> <br/><br/>
 <a href="settings.php" class="btn btn-primary">Back to settings</a>
</div>
                
                <div class=" col-md-9 col-lg-9 "> 
<?php
if(isset($_POST['new']) && $_POST['new']==1)
{
$id = $_POST['id'];
$uploadedfile = $_FILES['userphoto']['userphoto'];
$src = imagecreatefromjpeg($uploadedfile);
list($width,$height)=getimagesize($uploadedfile);
$newwidth=300;
$newheight=($height/$width)*300;
$tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filenamearray = explode(".", $_FILES['userphoto']['userphoto']);
$extension = $filenamearray[count($filenamearray)-1];
$filename = $newid . "." . $extension;
$filename = "assets/img/DP/". $filename;
imagejpeg($tmp,$filename,100);


require('../db/index.php');


// For good measure we should delete the old image
// You can remove this section if you want to leave the old images

$query = "SELECT * from users where id='".$id."'";
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
$old_Imgfile = $row['photo'];

unlink($old_Imgfile);

// End of delete old image section



// The next line updates the database with the new image details - and description.

mysql_query ("UPDATE users SET photo='$filename' WHERE `id`='$id'") or die (mysql_error);

imagedestroy($src);
imagedestroy($tmp);

$insertGoTo = "settings.php";
if (isset($_SERVER['QUERY_STRING'])) {
$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
$insertGoTo .= $_SERVER['QUERY_STRING'];
}
header(sprintf("Location: %s", $insertGoTo));
}
?>

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

