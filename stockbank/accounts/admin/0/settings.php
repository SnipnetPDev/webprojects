<?php
include 'header.php';
?>
<?php
 
require('../../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from settings where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
				<br/><br/>
                <div class="row">
            
<?php
require('../../db/index.php');
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$title =$_REQUEST['title'];
$short_name =$_REQUEST['short_name'];
$b_url =$_REQUEST['b_url'];
$address =$_REQUEST['address'];
$routing_no =$_REQUEST['routing_no'];
$phone =$_REQUEST['phone'];
$email =$_REQUEST['email'];
$copyright =$_REQUEST['copyright'];
$mailer_host =$_REQUEST['mailer_host'];
$mailer_port =$_REQUEST['mailer_port'];
$mailer_id =$_REQUEST['mailer_id'];
$mailer_pass =$_REQUEST['mailer_pass'];
$update="update settings set title='".$title."', short_name='".$short_name."', b_url='".$b_url."', address='".$address."', routing_no='".$routing_no."', phone='".$phone."', email='".$email."', copyright='".$copyright."', mailer_host='".$mailer_host."', mailer_port='".$mailer_port."', mailer_id='".$mailer_id."', mailer_pass='".$mailer_pass."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());
$status = "<div class='alert alert-success'><strong>Success!</strong> Website Settings Updated.</div>";
echo $status;
}
?>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
						<h3 class="box-title">Update Bank Settings</h3>
							<form name="form" method="post" action="" class="form-horizontal form-material"> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                                <div class="form-group">
                                    <label class="col-md-12">Bank Name</label>
                                    <div class="col-md-12">
                                        <input name="title" type="text" value="<?php echo $row['title'];?>" class="form-control form-control-line"> </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">Bank Short Name</label>
                                    <div class="col-md-12">
                                        <input name="short_name" type="text" value="<?php echo $row['short_name'];?>" class="form-control form-control-line"> </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">Bank Url [link without ending slashes /]</label>
                                    <div class="col-md-12">
                                        <input name="b_url" type="text" value="<?php echo $row['b_url'];?>" class="form-control form-control-line"> </div>
                                </div>
								<div class="form-group">
                                    <label for="example-email" class="col-md-12">Bank Address</label>
                                    <div class="col-md-12">
                                        <input name="address" type="text" value="<?php echo $row['address'];?>" class="form-control form-control-line" id="example-email"> </div>
                                </div>
								<div class="form-group">
                                    <label for="example-email" class="col-md-12">Routing (ABA)</label>
                                    <div class="col-md-12">
                                        <input name="routing_no" type="text" value="<?php echo $row['routing_no'];?>" class="form-control form-control-line" id="example-email"> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Phone Number</label>
                                    <div class="col-md-12">
                                        <input name="phone" type="text" value="<?php echo $row['phone'];?>" class="form-control form-control-line" id="example-email" > </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Bank Email</label>
                                    <div class="col-md-12">
                                        <input name="email" type="text" value="<?php echo $row['email'];?>" class="form-control form-control-line"> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Copyright text</label>
                                    <div class="col-md-12">
                                        <input name="copyright" type="text" value="<?php echo $row['copyright'];?>" class="form-control form-control-line" > </div>
                                </div>
								<br/><br/>
								<h4>Email SMTP Config</h4>
								<hr/>
								<div class="form-group">
                                    <label class="col-md-12">SMTP Host</label>
                                    <div class="col-md-12">
                                        <input name="mailer_host" type="text" value="<?php echo $row['mailer_host'];?>" class="form-control form-control-line" > </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">SMTP Port</label>
                                    <div class="col-md-12">
                                        <input name="mailer_port" type="text" value="<?php echo $row['mailer_port'];?>" class="form-control form-control-line" > </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">SMTP Username</label>
                                    <div class="col-md-12">
                                        <input name="mailer_id" type="text" value="<?php echo $row['mailer_id'];?>" class="form-control form-control-line" > </div>
                                </div>
								<div class="form-group">
                                    <label class="col-md-12">SMTP Password</label>
                                    <div class="col-md-12">
                                        <input name="mailer_pass" type="password" value="<?php echo $row['mailer_pass'];?>" class="form-control form-control-line" > </div>
                                </div>
								<div class="form-group">
                                    <div class="col-md-12">
                                        <button name="submit" type="submit" class="btn btn-success">Update Configuration</button>
										</div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php
include 'footer.php';
?>