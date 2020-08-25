<?php
include 'header.php';
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
				<br/><br/>
                <div class="row">
                    <div class="col-md-4 col-xs-12">

<?php
 
require('../../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from users where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);

$imageU = $row['imgname'];
$image_src = "../../home/assets/img/DP/".$imageU;
?>
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $image_src;  ?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo $image_src;  ?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $row['name'];?></h4>
                                        <h5 class="text-white"><?php echo $row['email'];?></h5>
                                         <h3 class="text-white"><?php echo $row['alock'];?></h3>										</div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-12 col-sm-4 text-center">
								<form name="form" method="post" action="active.php?id=<?php echo $row['id'];?>">
<input type="hidden" name="new" value="1" />								
								<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
								<input name="alock" type="hidden" value="<?php echo $row['id'];?>" />
								
							<button name="submit" type="submit" class="btn btn-success">Activate user login</button>
								<br/><br/>
								<p style="text-align:left; color:red;">Note: Modify account number before activating user login using: <br/><strong>Accounts</strong> >> <strong>Upgrade</strong>.
								<br/><br/>
								Clicking the button above will send an email with account information to user, make sure the account number matches the original account number from the bank.</p>
                                 </form>
								</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
							<form class="form-horizontal form-material" name="form" method="post" action="send_msg.php?id=<?php echo $row['id'];?>">
                                <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $row['name'];?>" class="form-control form-control-line" disabled> </div>
                                </div>
								<div class="form-group">
                                    <label for="example-email" class="col-md-12">Login ID</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $row['loginid'];?>" class="form-control form-control-line" id="example-email" disabled> </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="<?php echo $row['email'];?>" class="form-control form-control-line" id="example-email" disabled> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php echo $row['password'];?>" class="form-control form-control-line" disabled> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="<?php echo $row['phone'];?>" class="form-control form-control-line" disabled> </div>
                                </div>
								
								 <div class="form-group">
                                    <label class="col-md-12">Send Message</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control form-control-line" name="admin_msg">HI ,
										</textarea>
										</div>
                                </div>
                                
								<div class="form-group">
                                    <div class="col-md-12">
                                     <button name="submit" type="submit" class="btn btn-success">Send Message</button>
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