<?php
require('../db/index.php');
include("../auth.php");
include 'core/acc_call.php';
include 'core/header.php';
?>
<style>
hr.style-two {
    border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
}
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}
.inputfile + label * {
	pointer-events: none;
}
</style>
 <div class="c-toolbar u-mb-medium">
 <nav class="c-toolbar__nav u-mr-auto">
                <a class="c-toolbar__nav-item is-active" href="#tab1">Settings</a>
            </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>
            <div class="container-fluid">
                <div class="row">
				<div class="col-xl-4">
<?php
if(isset($_FILES["file"])) {
        $usr_id = $usr_id;
        $imgname = $_FILES['file']['name'];
        $target_dir = "../../img/profile/";
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
			$update="update users set imgname='".$imgname."' where uss_id='".$usr_id."'";
		if(mysqli_query($con, $update) or die(mysqli_error($con))) {
  echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Profile photo updated<br/>changes will take effect on your next login. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
  $image_src2 = $_SESSION['imgname'];
  $old_img = "../../img/profile/$image_src2";
  chown($old_img, 666);
  if($image_src2 = "default.png") { }else {
	  unlink($old_img);
  }
}else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to update profile photo <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
            
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'],'../../img/profile/'.$imgname);

        }
}
?>
                        <div class="c-card u-p-medium u-mb-medium">

                            <div class="u-text-center">
                                <div class="c-avatar c-avatar--large u-mb-small u-inline-flex">
                                    <img class="c-avatar__img" src="../../<?php echo $image_src;  ?>" alt="Adam's Face">
                                </div>

                                <h3 class="u-h5"><?php echo $us_first; echo "&nbsp;"; echo $us_last; ?> <br/>(<?php echo $_SESSION['usr_loginid'];  ?>)</h3>
                                <span class="u-text-mute u-text-small"><?php echo $us_company;  ?></span>
                            </div>

                            <div class="u-flex u-mt-medium">
<form method="post" enctype='multipart/form-data'>
<input type="file" name="file" id="file" class="inputfile" onchange='if(this.value != 0) { this.form.submit(); }'/>
</form>
<label class="c-btn c-btn--info" style="width:330px; margin-right:20px;" for="file">Update Photo</label>
<a class="c-btn c-btn--secondary c-btn--fullwidth" href="#">Edit Name</a>
                            </div>
                        </div>

                        <div class="c-card u-p-medium u-mb-medium">
                            <h5 class="u-mb-medium">Account Options</h5>

                            <table class="c-table u-border-zero">
                                <thead class="c-table__head u-border-bottom">

                                </thead>
								<tbody class="u-pt-medium">
                                    <tr class="c-table__row u-border-zero">
                                        <td class="c-table__cell u-p-zero u-pb-xsmall u-pt-medium">Nationality</td>
                                        <td class="c-table__cell u-p-zero u-pb-xsmall u-pt-medium">
                                            <span class="u-text-mute"><?php echo $us_country;  ?></span>
                                        </td>
                                    </tr>
                                    <tr class="c-table__row u-border-zero">
                                        <td class="c-table__cell u-p-zero u-pb-xsmall">Funding Mode</td>
                                        <td class="c-table__cell u-p-zero u-pb-xsmall">
                                            <span class="u-text-mute"><?php echo $acc_fmode;  ?></span>
                                        </td>
                                    </tr>
									 <tr class="c-table__row u-border-zero">
                                        <td class="c-table__cell u-p-zero u-pb-xsmall"><A href="">Close your account</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-7">

                           <ul class="c-tabs__list nav nav-tabs" id="myTab" role="tablist">
                                <li><a class="c-tabs__link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ACCOUNT</a></li>

                                <li><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">SECURITY</a></li>

                                <li><a class="c-tabs__link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">NOTIFICATION</a></li>
                            </ul>

                            <div class="c-tabs__content tab-content u-mb-large" id="nav-tabContent">
<?php
if(isset($_POST["addADDR"])) {
	$usr_id = $usr_id;
	if($_POST["adr_type"] == '') { $adr_type="0"; }else { $adr_type=$_POST["adr_type"]; }
	$adr_state = $_POST["state"];
	$adr_zip = $_POST["zip"];
	$adr_city = $_POST["city"];
	$adr_address = $_POST["address"];
$check="SELECT * FROM address WHERE address = '$adr_address'";
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
		echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> You've added this address already <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
	if ($adr_type == 1) {
		$ins_query="insert into address (`userID`,`address`,`city`,`state`,`zip`) values ('$usr_id','$adr_address','$adr_city','$adr_state','$adr_zip')";
        mysqli_query($con,$ins_query) or die(mysqli_error($con));
		$update="update accounts set street_address='".$adr_address."', city='".$adr_city."', state='".$adr_state."', zip_code='".$adr_zip."' where usr_id='".$usr_id."'";
mysqli_query($con, $update) or die(mysqli_error());
	}else {
		$ins_query="insert into address (`userID`,`address`,`city`,`state`,`zip`) values ('$usr_id','$adr_address','$adr_city','$adr_state','$adr_zip')";
        mysqli_query($con,$ins_query) or die(mysqli_error($con));
	}
	echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Address successfully added <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if(isset($_POST["addEMAIL"])) {
	$usr_id = $usr_id;
	$em_email = $_POST["email"];
$check="SELECT * FROM email WHERE email_addr = '$em_email'";
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
		echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> You've added this email address already <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
		$ins_query="insert into email (`userID`,`email_addr`) values ('$usr_id','$em_email')";
        mysqli_query($con,$ins_query) or die(mysqli_error($con));
		$last_id = $con->insert_id;
	    echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Email address successfully added <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
	// Encoded
	$em_last_id = base64_encode($last_id);
	$em_email_enc = base64_encode($em_email);
	
	$subjecta = "Email Verification";
	$messagea = file_get_contents('../../snipnetAPI/template/email-verification.htm');
	
	//required from settings. do not edit/add more lines
	$messagea = str_replace("%b_url%", $b_url, $messagea); 
	$messagea = str_replace("%site_name%", $b_name, $messagea); 
	$messagea = str_replace("%site_address%", $b_address, $messagea);  
	
	//information needed per request
	$messagea = str_replace("%email_addr%", $em_email, $messagea); 
	$messagea = str_replace("%email_addr_enc%", $em_email_enc, $messagea); 
	$messagea = str_replace("%token%", $em_last_id, $messagea); 
    //Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $em_email,
			'subject' => $subjecta,
			'message' => $messagea
        );
if($perm_email == $perm_act) {
include '../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
}else { }
}
}
if ($_REQUEST["mode"] == "delete") {
$did = $_REQUEST["did"];
$query = "DELETE FROM address WHERE ad_id='$did'"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
if($result) {
   echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Address deleted <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
   echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Could not delete address <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if ($_REQUEST["mode"] == "deleteEMAIL") {
$edid = $_REQUEST["edid"];
$query = "DELETE FROM email WHERE em_id='$edid'"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
if($result) {
   echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Email address deleted <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
   echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Could not delete email address <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if ($_REQUEST["mode"] == "primary") {
	$usr_id = $usr_id;
	$a_ddress = base64_decode($_REQUEST["ad"]);
	$c_ity = base64_decode($_REQUEST["ct"]);
	$s_tate = base64_decode($_REQUEST["st"]);
	$z_ip = base64_decode($_REQUEST["zp"]);
	$update="update accounts set street_address='".$a_ddress."', city='".$c_ity."', state='".$s_tate."', zip_code='".$z_ip."' where usr_id='".$usr_id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
  echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Primary address updated <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to update primary address <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if ($_REQUEST["mode"] == "primaryEMAIL") {
	$usr_id = $usr_id;
	$adr = base64_decode($_REQUEST["adr"]);
	$update="update users set email='".$adr."' where uss_id='".$usr_id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
  echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Primary email address updated <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to update primary email address <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if(isset($_POST["addPHONE"])) {
	$usr_id = $usr_id;
	$ph_type = $_POST["ph_type"];
	$ph_phone = $_POST["phone"];
$check="SELECT * FROM phone WHERE phone_num = '$ph_phone'";
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
		echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Phone number found on file <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
		$ins_query="insert into phone (`userID`,`phone_num`) values ('$usr_id','$ph_phone')";
        mysqli_query($con,$ins_query) or die(mysqli_error($con));
        $phlast_id = $con->insert_id;
	echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Phone number successfully added <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
	
	// Encoded
	$ph_last_id = base64_encode($phlast_id);
	$phone_no_enc = base64_encode($ph_phone);
	
	//required from settings. do not edit/add more lines
	$smsmsg2 = file_get_contents('../../snipnetAPI/template/number-verification.txt');
	$smsmsg2 = str_replace("%b_url%", $b_url, $smsmsg2); 
	$smsmsg2 = str_replace("%site_name%", $b_name, $smsmsg2); 
	
	//information needed per request
	$smsmsg2 = str_replace("%phone_no%", $ph_phone, $smsmsg2); 
	$smsmsg2 = str_replace("%phone_no_enc%", $phone_no_enc, $smsmsg2); 
	$smsmsg2 = str_replace("%token%", $ph_last_id, $smsmsg2); 
	// Get SMS instance.
   $fields = array(
            'method' => "smsAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'phone' => $ph_phone,
			'message' => $smsmsg2
        );
if($perm_sms == $perm_act) {
include '../../snipnetAPI/snipnet-que.php';
	$result = curl_exec($ch);
}else { }
}
}
if ($_REQUEST["mode"] == "deletePHONE") {
$pdid = $_REQUEST["pdid"];
$query = "DELETE FROM phone WHERE ph_id='$pdid'"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
if($result) {
   echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Phone number deleted <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
   echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Could not delete phone number <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if ($_REQUEST["mode"] == "primaryPHONE") {
	$usr_id = $usr_id;
	$ph = base64_decode($_REQUEST["ph"]);
	$update="update users set phone='".$ph."' where uss_id='".$usr_id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
  echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Primary phone number updated <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to update primary phone number <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if(isset($_POST['changePWD'])) {
$usr_id = $usr_id;
$old_pass =$_REQUEST['old_pass'];
$new_pass =$_REQUEST['new_pass'];
$cnew_pass =$_REQUEST['cnew_pass'];
$sel_query="Select * from users where uss_id LIKE '$usr_id' ORDER BY uss_id;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
if(md5($old_pass) == $row["password"]) {
	if($new_pass == $cnew_pass) {
$update="update users set password='".md5($new_pass)."' where uss_id='".$usr_id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Password changed successfully. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
} else {
echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to change password, contact support. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";

}
} else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> New password does not match. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
} else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Current password is incorrect. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
}
if (isset($_POST["updatePERM"])) {
	$usr_id = $usr_id;
	if($_POST["sh_perm_email"] == '') { $sh_pe="0"; }else { $sh_pe=$_POST["sh_perm_email"]; }
	if($_POST["sh_perm_sms"] == '') { $sh_ps="0"; }else { $sh_ps=$_POST["sh_perm_sms"]; }
	$update="update shared_perm set email='".$sh_pe."', sms='".$sh_ps."' where UserID='".$usr_id."'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
  echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Notification settings updated <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to update notification settings <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if ($_REQUEST["mode"] == "resendVEmail") {
	// Encoded
	$em_last_id = $_REQUEST["emid"];
	$em_email_enc = $_REQUEST["adr"];
	$ememail= base64_decode($_REQUEST["adr"]);
	
	$subjecta = "Email Verification";
	$messagea = file_get_contents('../../snipnetAPI/template/email-verification.htm');
	
	//required from settings. do not edit/add more lines
	$messagea = str_replace("%b_url%", $b_url, $messagea); 
	$messagea = str_replace("%site_name%", $b_name, $messagea); 
	$messagea = str_replace("%site_address%", $b_address, $messagea);  
	
	//information needed per request
	$messagea = str_replace("%email_addr%", $ememail, $messagea); 
	$messagea = str_replace("%email_addr_enc%", $em_email_enc, $messagea); 
	$messagea = str_replace("%token%", $em_last_id, $messagea); 
    //Start email snipnet
$fields = array(
            'method' => "emailAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'sender_email' => $b_email,
			'receiver_email' => $ememail,
			'subject' => $subjecta,
			'message' => $messagea
        );
if($perm_email == $perm_act) {
include '../../snipnetAPI/email-que.php';
$result = curl_exec($ch);
}else { }
if($result) {
  echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> Verification link has been resent. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to send verification link <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
if ($_REQUEST["mode"] == "resendVSMS") {
	// Encoded
	$ph_last_id = $_REQUEST["phid"];
	$ph_phone_enc = $_REQUEST["ph"];
	$phphone= base64_decode($_REQUEST["ph"]);
	
	//required from settings. do not edit/add more lines
	$smsmsg2 = file_get_contents('../../snipnetAPI/template/number-verification.txt');
	$smsmsg2 = str_replace("%b_url%", $b_url, $smsmsg2); 
	$smsmsg2 = str_replace("%site_name%", $b_name, $smsmsg2); 
	
	//information needed per request
	$smsmsg2 = str_replace("%phone_no%", $phphone, $smsmsg2); 
	$smsmsg2 = str_replace("%phone_no_enc%", $ph_phone_enc, $smsmsg2); 
	$smsmsg2 = str_replace("%token%", $ph_last_id, $smsmsg2); 
	// Get SMS instance.
   $fields = array(
            'method' => "smsAPI",
            'user_email' => $user_email,
            'api_key' => $api_key,
			'phone' => $phphone,
			'message' => $smsmsg2
        );
if($perm_sms == $perm_act) {
include '../../snipnetAPI/snipnet-que.php';
	$result = curl_exec($ch);
}else { }
if($result) {
  echo "<div class='c-alert c-alert--success alert'><i class='c-alert__icon fa fa-times-circle'></i> SMS Verification link has been resent. <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}else {
	echo "<div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Failed to send SMS verification link <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>";
}
}
?>
                                <div class="c-tabs__pane active u-pb-medium" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
								<hr class="style-two">
								<h4>Address</h4>
								<hr class="style-two">
                             <div class="row u-m-small">
<?php
$acc_id = $usr_id;
$us_stradd = $us_stradd;
$sel_query="Select * from address where userID LIKE '$acc_id' ORDER BY ad_id;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
?>
                                    <div class="c-project-card__content" style="padding-left:10px;">
                                            <h4 class="c-project-card__title">
											<?php echo $row["address"]; ?><br/>
											<?php echo $row["city"]; ?> <?php echo $row["zip"]; ?><br/>
											<?php echo $row["state"]; ?></h4>
                                            <p class="c-project-card__info">
											<?php if($row["address"] == $us_stradd){
												  echo "Primary address"; 
											}else {
												$ad = base64_encode($row["address"]);
												$ct = base64_encode($row["city"]);
												$st = base64_encode($row["state"]);
												$zp = base64_encode($row["zip"]);
												  echo "<a href='settings.php?mode=primary&ad=$ad&ct=$ct&st=$st&zp=$zp'>Set as primary address</a>";
											} ?></p>
											 <?php if($row["address"] == $us_stradd){
												 
											}else {
												$adid = $row["ad_id"];
												echo "<a href='settings.php?mode=delete&did=$adid'><span class='c-badge c-badge--small c-badge--danger'>Remove</span></a>";
											} ?>
                                    </div>
<?php } ?>
									 <div class="c-project-card__content">
                                        <div style="padding-top:15px; padding-left:30px;">
                                           <a data-toggle="modal" data-target="#modal9"><img src="../../img/new.png" width="80px" height="80px"/></a>
                                        </div>
                                    </div>
									</div>
									<hr class="style-two">
									<h4>Email address</h4>
									<hr class="style-two">
                             <div class="row u-m-small">
<?php
$acc_id = $usr_id;
$us_email = $us_email;
$sel_query="Select * from email where userID LIKE '$acc_id' ORDER BY em_id;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
?>
                                    <div class="c-project-card__content" style="padding-left:10px;">
                                            <h4 class="c-project-card__title">
											<?php echo $row["email_addr"]; ?></h4>
                                            <p class="c-project-card__info">
											<?php if($row["email_addr"] == $us_email && $row["em_stat"] == 1){
												  echo "Primary email"; 
											}elseif($row["em_stat"] == 0) {
												$adr = base64_encode($row["email_addr"] );
												$emid = base64_encode($row["em_id"] );
												 echo "<a href='settings.php?mode=resendVEmail&adr=$adr&emid=$emid'>Resend verification</a>";
											}else {
												$adr = base64_encode($row["email_addr"] );
												  echo "<a href='settings.php?mode=primaryEMAIL&adr=$adr'>Set as primary email</a>";
											} ?></p>
											 <?php if($row["email_addr"] == $us_email){
												 
											}else {
												$edid = $row["em_id"];
												echo "<a href='settings.php?mode=deleteEMAIL&edid=$edid'><span class='c-badge c-badge--small c-badge--danger'>Remove</span></a>";
											} ?>
                                    </div>
<?php } ?>
									 <div class="c-project-card__content">
                                        <div style="padding-left:30px;">
                                           <a data-toggle="modal" data-target="#moda20"><img src="../../img/new.png" width="80px" height="80px"/></a>
                                        </div>
                                    </div>
									</div>
									<hr class="style-two">
									<h4>Phone</h4>
									<hr class="style-two">
                            <div class="row u-m-small">
<?php
$acc_id = $usr_id;
$us_phone = $us_phone;
$sel_query="Select * from phone where userID LIKE '$acc_id' ORDER BY ph_id;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
?>
                                    <div class="c-project-card__content" style="padding-left:10px;">
                                            <h4 class="c-project-card__title">
											<?php echo $row["phone_num"]; ?></h4>
                                            <p class="c-project-card__info">
											<?php if($row["phone_num"] == $us_phone){
												  echo "Primary phone"; 
											}elseif($row["ph_stat"] == 0) {
												$ph = base64_encode($row["phone_num"] );
												$phid = base64_encode($row["ph_id"] );
												 echo "<a href='settings.php?mode=resendVSMS&ph=$ph&phid=$phid'>Resend verification</a>";
											}else {
												$ph = base64_encode($row["phone_num"]);
												  echo "<a href='settings.php?mode=primaryPHONE&ph=$ph'>Set as primary phone</a>";
											} ?></p>
											 <?php if($row["phone_num"] == $us_phone){
												 
											}else {
												$pdid = $row["ph_id"];
												echo "<a href='settings.php?mode=deletePHONE&pdid=$pdid'><span class='c-badge c-badge--small c-badge--danger'>Remove</span></a>";
											} ?>
                                    </div>
<?php } ?>
									 <div class="c-project-card__content">
                                        <div style="padding-left:30px;">
                                           <a data-toggle="modal" data-target="#moda21"><img src="../../img/new.png" width="80px" height="80px"/></a>
                                        </div>
                                    </div>
									</div>
                                </div>

                                <div class="c-tabs__pane u-pb-medium" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
<form method="post" >
                            <table class="c-table">
                                <tbody>
                                    <tr class="c-table__row">
                                        <td class="c-table__cell"><span class="u-text-mute">Password<br/>Create or update your password.</span></td>
                                        <td class="c-table__cell"></td>
                                        <td class="c-table__cell">
                                            <span class="u-text-mute"></span>
                                        </td>
                                        <td class="c-table__cell">
                                            <span class="u-text-mute"></span>
                                        </td>
                                        <td class="c-table__cell">
                                            <span class="u-text-mute"></span>
                                        </td>
                                        <td class="c-table__cell">
                                           <a data-toggle="modal" data-target="#moda22">Edit</a>
                                        </td>
                                    </tr><!-- // .table__row -->
									</tbody>
									</table>
                                </div>

                                <div class="c-tabs__pane u-pb-medium" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                      <table class="c-table">
                                <tbody>
                                    <tr class="c-table__row">
                                        <td class="c-table__cell"><span class="u-text-mute">Email<br/>We'll let you know via email when you Make a payment, Receive a payment.</span></td>
                                        <td class="c-table__cell"></td>
                                        <td class="c-table__cell">
                                            <span class="u-text-mute"></span>
                                        </td>
                                        <td class="c-table__cell">
                                            <div class="u-block u-mb-xsmall" style="padding-top:20px;">
                        <div class="c-choice c-choice--checkbox">
                            <input class="c-choice__input" id="checkbox1" value="1" name="sh_perm_email" type="checkbox" <?php if ($sh_perm_email == $sh_perm_act) { echo"checked"; }else { } ?>>
                            <label class="c-choice__label" for="checkbox1"></label>
                        </div>
                    </div>
                                        </td>
                                    </tr><!-- // .table__row -->
									 <tr class="c-table__row">
                                        <td class="c-table__cell"><span class="u-text-mute">SMS<br/>We'll let you know via SMS when you Make a payment, Receive a payment, OTP.</span></td>
                                        <td class="c-table__cell"></td>
                                        <td class="c-table__cell">
                                            <span class="u-text-mute"></span>
                                        </td>
                                        <td class="c-table__cell">
                                            <div class="u-block u-mb-xsmall" style="padding-top:20px;">
											 <div class="c-choice c-choice--checkbox">
                            <input class="c-choice__input" id="checkbox2" value="1" name="sh_perm_sms" type="checkbox" <?php if ($sh_perm_sms == $sh_perm_act) { echo"checked"; }else { } ?>>
                            <label class="c-choice__label" for="checkbox2"></label>
                        </div>
                    </div>
                                        </td>
                                    </tr><!-- // .table__row -->
									</tbody>
									</table>
									<br/>
									<button name="updatePERM" style="float:right;" type="submit" class="c-btn c-btn--success" >Save Changes</button>
									<br/><br/>
									</form>
                                </div>
                            </div>

                    </div>
                </div>

            </div><!-- // .container-fluid -->
            

        
      
<?php
include("core/profile_add.php");
include 'core/footer.php';
?>