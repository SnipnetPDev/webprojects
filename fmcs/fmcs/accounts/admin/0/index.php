<?php
include('header.php');
include('sidebar.php');
?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Transactions</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
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
$sel_query="Select * from trans_history ORDER BY tr_id desc LIMIT 5;";
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
</div>
					  
                    </td>
                  </tr>
                  </tbody>
<?php } 
} else {
    echo "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 No transaction record found.
                    </div>";
} 
?>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="transfer.php?action=list" class="btn btn-sm btn-default btn-flat pull-right">View All Transactions</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Registered Clients</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <!-- /.item -->
<?php 
$sel_query="Select * from users ORDER BY uss_id desc LIMIT 5;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
	$img_src = "img/profile/".$row["imgname"];
	
 ?>
                <li class="item">
                  <div class="product-img">
                    <img src="../../../<?php echo $img_src;  ?>" alt="Product Image">
                  </div>
                  <div class="product-info">
				  <span class="product-description">
                         <?php echo $row["name"]; ?>
                        </span>
                    <a href="clients.php?action=<?php echo $row["loginid"] ?>" class="product-title">
					 <?php echo $row["loginid"]; ?>
<?php 
$usrr_id = $row["uss_id"];
$sel_query2="Select * from accounts WHERE usr_id LIKE '$usrr_id' ORDER BY id desc LIMIT 5;";
$result2 = $con->query($sel_query2) or die($con->error);
if($row = $result2->fetch_assoc()) {
	$acc_bal = number_format($row["account_balance"]);
    echo "<span class='label label-info pull-right'>$acc_curency$acc_bal</span>";
} else {
	echo "<span class='label label-default pull-right'>Unknown</span>";
}
?>
</a>
                  </div>
                </li>
<?php }
} else {
    echo "<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Alert!</h4>
				 No user found.
                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>";
}  ?>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="clients.php" class="uppercase">View All Clients</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		
        <!-- Left col -->
        <div class="col-md-6">

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Installed Module</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
					<th>Name</th>
					<th><center>Package</center></th>
                    <th><center>Status</center></th>
                  </tr>
                  </thead>
<?php 
$sel_query="Select * from moudle ORDER BY id desc LIMIT 5;";
$result = $con->query($sel_query) or die($con->error);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
 ?>
                  <tbody>
                  <tr>
                    <td><?php echo strtoupper("SN"); ?><?php echo $row["id"] ?></td>
					 <td><a href="module.php?action=MD&&id=<?php echo $row["id"] ?>"><?php echo strtoupper($row["m_name"]); ?> </a></td>
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
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="module.php?action=list" class="btn btn-sm btn-default btn-flat pull-right">View All Modules</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		
<div class="col-md-6">

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Client Request</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
No data
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="request.php?action=list" class="btn btn-sm btn-default btn-flat pull-right">View All Request</a>
            </div>
            <!-- /.box-footer -->
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
 include('footer.php');
 ?>