<?php
include 'header.php';
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                             <a href="install.php" class="btn btn-success btn-block waves-effect waves-light">Install Plugin</a>
                            </div>
                            <h3 class="box-title">Plugin Manager</h3>
							<?php
	if(isset($_GET['success']))
	{
		?>
       <div class='alert alert-success'>New plugin installed</div>
        <?php
	}
	else if(isset($_GET['fail']))
	{
		?>
        <div class='alert alert-danger'>Error installing Plugin</div>
        <?php
	}
	?>
	<?php
		if(isset($_GET['success_u']))
	{
		?>
       <div class='alert alert-success'>Plugin Uninstalled</div>
        <?php
	}
	else if(isset($_GET['fail_u']))
	{
		?>
        <div class='alert alert-danger'>Error Uninstalling Plugin</div>
        <?php
	}
	?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
  <tr>
    <th>#</th>
    <th>Name</th>
    <th>Publisher</th>
	<th>Date Installed</th>
    <th>Action</th>
  </tr>
                                    </thead>
                                    <tbody>
<?php
require('../../db/index.php');
$count=1;
$sel_query="Select * from plugins ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $count; ?></td>  
    <td><?php echo $row["p_name"]; ?></td>	
    <td><?php echo $row["publishedby"]; ?></td>
	<td><?php echo $row["p_ins_date"]; ?></td>
    <td><a href="launch.php?PLUGIN=<?php echo $row["id"]; ?>">Launch</a> - <a href="uninstall.php?LINK=<?php echo $row["p_link"]; ?>&PLUGIN=<?php echo $row["id"]; ?>">Uninstall</a></td>
  </tr>
<?php $count++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- chat-listing & recent comments -->
                <!-- ============================================================== -->
            </div>
<?php
include 'footer.php';
?>