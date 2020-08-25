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
                             <a href="c_add.php" class="btn btn-danger btn-block waves-effect waves-light">Add Currency</a>
                            </div>
                            <h3 class="box-title">Currency</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
  <tr>
    <th>#</th>
    <th>Name</th>
    <th>Shortname</th>
    <th>Sign</th>
    <th>Action</th>
  </tr>
                                    </thead>
                                    <tbody>
<?php
require('../../db/index.php');
$count=1;
$sel_query="Select * from currency ORDER BY c_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $count; ?></td>    
    <td><?php echo $row["c_name"]; ?></td>
    <td><?php echo $row["c_abbv"]; ?></td>
    <td><?php echo $row["c_sign"]; ?></td>
    <td><a href="c_edit.php?id=<?php echo $row["c_id"]; ?>">Edit</a> - <a href="c_delete.php?id=<?php echo $row["c_id"]; ?>">Delete</a></td>
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