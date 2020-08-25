<?php
include('header.php');
include('sidebar.php');
if (isset($_REQUEST["action"])) {
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="clients.php">Clients</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
<?php 
$log_id = $_REQUEST["action"];
$sel_query="Select * from users WHERE loginid LIKE $log_id ORDER BY uss_id desc;";
$result = $con->query($sel_query) or die($con->error);
while($row = $result->fetch_assoc()) {
	$img_src = "img/profile/".$row["imgname"];
    $log_id = $row["loginid"];
?>
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../../<?php echo $img_src;?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $row["name"]; ?></h3>

              <p class="text-muted text-center"><?php if ($row["role"] == 0) { echo "<font style='color:red;' >Administrator</font>"; }elseif ($row["role"] == 1) { echo "<font style='color:blue;' >Merchant</font>"; }elseif($row["role"] == 2) { echo "User"; } ?></p>

              <ul class="list-group list-group-unbordered">
			  <?php 
$usrr_id = $row["uss_id"];
$sel_query2="Select * from accounts WHERE usr_id LIKE '$usrr_id' ORDER BY id desc;";
$result2 = $con->query($sel_query2) or die($con->error);
$row = $result2->fetch_assoc();
if($row) {
	$acc_bal = number_format($row["account_balance"]);
    echo "<li class='list-group-item'><b>Balance</b> <span class='label label-info pull-right'>$acc_curency$acc_bal</span></li>";
} else {
	echo "<li class='list-group-item'><b>Balance</b> <span class='label label-default pull-right'>Unknown</span></li>";
}
$rec_acc = $row["account_no"];
if($row) {
$acc_status = $row["account_status"];
if($acc_status == "Active") {
echo "<li class='list-group-item'><b>Status</b> <span class='label label-success pull-right'>$acc_status</span></li>";
 } elseif ($acc_status == "Dormant") { 
 echo "<li class='list-group-item'><b>Status</b> <span class='label label-warning pull-right'>$acc_status</span></li>";
 }elseif ($acc_status == "On-Hold") { 
 echo "<li class='list-group-item'><b>Status</b><span class='label label-warning pull-right'>$acc_status</span></li>";
 }elseif ($acc_status == "Disabled") { 
 echo "<li class='list-group-item'><b>Status</b><span class='label label-danger pull-right'>$acc_status</span></li>";
 }
} else {
	echo "<li class='list-group-item'><b>Status</b> <span class='label label-default pull-right'>Unknown</span></li>";
}
?>
<li class='list-group-item'><b>Type</b><span class='label label-default pull-right'><?php echo $row["account_type"]; ?> </span></li>
              </ul>
<form method="post">
    <select class="btn btn-default btn-block" name='status' onchange='if(this.value != 0) { this.form.submit(); }'>
         <option value='0'>Change Account Status</option>
         <option value='Active'>Active</option>
         <option value='Dormant'>Dormant</option>
         <option value='On-Hold'>On-Hold</option>
		 <option value='Disabled'>Disabled</option>
    </select>
</form>
<?php 
if(isset($_POST["status"])) {
$ac_status =$_POST['status'];
$update="update accounts set account_status='$ac_status' where usr_id='$usrr_id'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='icon fa fa-check'></i>
               Status updated
              </div>";
} else {
	echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Alert!</h4>
               Unknown error while updating status
              </div>";

}
}
?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#timeline" data-toggle="tab">Information</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
			  <div class="box-header">
              <h3 class="box-title"><?php echo strtoupper("<b>Transactions</b>") ?></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
<div class="box-body table-responsive no-padding">
<table class="table table-hover">
                  <thead>
                  <tr>
                    <th>Transaction ID</th>
					<th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
					<th>Fee</th>
                    <th>Status</th>
                  </tr>
                  </thead>
<?php 
$sel_query="Select * from trans_history WHERE trans_user_id LIKE '$usrr_id' OR receiver_acc_no LIKE '$rec_acc' ORDER BY tr_id desc;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 ?>
                  <tbody>
                  <tr>
                    <td><a href="transfer.php?action=view&&id=<?php echo $row["trans_id"] ?>"><?php echo strtoupper("TX"); ?><?php echo $row["trans_id"] ?></a></td>
					 <td><?php echo strtoupper($row["trans_date"]); ?> </td>
                    <td><small><?php echo strtoupper($row["tr_desc"]); ?></small></td>
                     <td><?php echo $acc_curency; ?><?php echo number_format($row["tr_amount"], 2); ?></td>
					 <td><?php echo $acc_curency; ?><?php echo number_format($row["trans_fee"], 2); ?></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
					  <?php 
$ts_id = $row["trans_id"];
$sel_query2="Select * from trans_record WHERE trans_his_id LIKE '$ts_id' ORDER BY id desc;";
$result2 = $con->query($sel_query2) or die($con->error);
if($row = $result2->fetch_assoc()) {
	$t_stat = $row["tr_status"];
	if($t_stat == "On-Hold") {
		echo "<span class='label label-warning'>$t_stat</span>";
	} elseif($t_stat == "Completed") {
		echo "<span class='label label-success'>$t_stat</span>";
		}elseif($t_stat == "Declined") {
		echo "<span class='label label-danger'>$t_stat</span>";
		}
} else {
	echo "<span class='label label-default'>Unknown</span>";
}
?>
					  
                    </td>
                  </tr>
                  </tbody>
<?php 
}
} else {
    echo "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 No transaction record.
                    </div>";
}
?>
                </table>
				</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
<ul class="list-group list-group-unbordered">
<?php 
$sel_query2="Select * from accounts a, users u WHERE a.usr_id LIKE '$usrr_id' and a.usr_id LIKE u.uss_id ORDER BY id desc;";
$result2 = $con->query($sel_query2) or die($con->error);
$row = $result2->fetch_assoc();
if($row) {
echo "
<h4>Account</h4>
			  <li class='list-group-item'>
			  <b>Full Name</b> <span class='pull-right'>".$row["title"]." ".$row["first_name"]." ".$row["last_name"]." ".$row["other_name"]."</span><br/> 
			  <b>Company/Business Name</b> <span class='pull-right'>".$row["company"]."</span><br/> 
			  <b>Login ID</b> <span class='pull-right'>$log_id</span><br/> 
			  <b>Account Number</b> <span class='pull-right'>".$row["account_no"]."</span><br/>  
			  <b>Registration Date</b> <span class='pull-right'>".$row["account_opening_date"]."</span><br/> 
			  <b>Funding Mode</b> <span class='pull-right'>".$row["funding_mode"]."</span>
			  </li>
			  <br/>
<h4>Address</h4>
			  <li class='list-group-item'>
			  <b>Home Address</b> <span class='pull-right'>".$row["street_address"]."</span><br/> 
			  <b>City</b> <span class='pull-right'>".$row["city"]."</span><br/> 
			  <b>State</b> <span class='pull-right'>".$row["state"]."</span><br/> 
			  <b>Country</b> <span class='pull-right'>".$row["country"]."</span><br/> 
			  <b>ZIP Code</b> <span class='pull-right'>".$row["zip_code"]."</span>
			  </li>
<br/>
<h4>Email & Phone</h4>
<li class='list-group-item'>
			  <b>Primary Email</b> <span class='pull-right'>".$row["email"]."</span>
			  </li>	
			  <li class='list-group-item'>
			  <b>Primary Phone</b> <span class='pull-right'>".$row["phone"]."</span>
			  </li>				  ";
} ?>
</ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
<?php 
if(isset($_POST["funding_mode"])) {
$funding_mode =$_POST['funding_mode'];
$update="update accounts set funding_mode='$funding_mode' where usr_id='$usrr_id'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
    $callout = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='icon fa fa-check'></i>
               Command successful
              </div>";
} else {
	$callout = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Alert!</h4>
               Unknown error while running command
              </div>";

}
}
if(isset($_POST["password"])) {
$password =md5($_POST['password']);
$update="update users set password='$password' where uss_id='$usrr_id'";
if(mysqli_query($con, $update) or die(mysqli_error())) {
    $callout = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='icon fa fa-check'></i>
               Command successful
              </div>";
} else {
	$callout = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-ban'></i> Alert!</h4>
               Unknown error while running command
              </div>";

}
}
?>
<?php if(!empty($callout)) { echo $callout; }else { echo "<div class='callout callout-info'>Account settings</div>";} ?>
                <form class="form-horizontal" method="post">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-5">
                      <input type="password" name="password" class="form-control" placeholder="*************">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                  </div>
                </form>
				
				<form class="form-horizontal" method="post">
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Funding Mode</label>

                    <div class="col-sm-5">
                      <select type="fmode" name="funding_mode" class="form-control" onchange='if(this.value != 0) { this.form.submit(); }'>
					  <option value="0" >--New funding mode--</option>
					  <?php include('../../../core/html-option/funding-mode-option.htm'); ?>
					  </select>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<?php } ?>
 </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php } else {
	?>


 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clients
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Clients</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
<div class="col-md-9">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Registered Clients</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Login ID</th>
                  <th>Name</th>
				  <th>Role</th>
                  <th>Balance</th>
                  <th>Status</th>
                </tr>
<?php 
$sel_query="Select * from users ORDER BY uss_id desc;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
	$img_src = "img/profile/".$row["imgname"];
	
 ?>
                <tr>
                  <td><a href="clients.php?action=<?php echo $row["loginid"] ?>" class="product-title">
					 <?php echo $row["loginid"]; ?></a></td>
                  <td><?php echo $row["name"]; ?></td>
                  <td><?php if ($row["role"] == 0) { echo "<font style='color:red;' >Administrator</font>"; }elseif ($row["role"] == 1) { echo "<font style='color:blue;' >Merchant</font>"; }elseif($row["role"] == 2) { echo "User"; } ?></td>
                  <?php 
$usrr_id = $row["uss_id"];
$sel_query2="Select * from accounts WHERE usr_id LIKE '$usrr_id' ORDER BY id desc;";
$result2 = $con->query($sel_query2) or die($con->error);
$row = $result2->fetch_assoc();
if($row) {
	$acc_bal = number_format($row["account_balance"]);
    echo "<td><span class='label label-info'>$acc_curency$acc_bal</span></td>";
} else {
	echo "<td><span class='label label-default'>Unknown</span></td>";
}
if($row) {
$acc_status = $row["account_status"];
if($acc_status == "Active") {
echo "<td><span class='label label-success'>$acc_status</span></td>";
 } elseif ($acc_status == "Dormant") { 
 echo "<td><span class='label label-warning'>$acc_status</span></td>";
 }elseif ($acc_status == "On-Hold") { 
 echo "<td><span class='label label-warning'>$acc_status</span></td>";
 }elseif ($acc_status == "Disabled") { 
 echo "<td><span class='label label-danger'>$acc_status</span></td>";
 }
} else {
	echo "<td><span class='label label-default'>Unknown</span></td>";
}
?>
                </tr>
<?php } 
} else {
    echo "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 No user found.
                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>";
} 
?>
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