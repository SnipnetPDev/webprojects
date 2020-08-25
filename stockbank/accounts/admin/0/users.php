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
                                <select class="form-control pull-right row b-none">
                                    <option>March 2017</option>
                                    <option>April 2017</option>
                                    <option>May 2017</option>
                                    <option>June 2017</option>
                                    <option>July 2017</option>
                                </select>
                            </div>
                            <h3 class="box-title">User Login</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
    <th>#</th>
    <th>Login ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
require('../../db/index.php');
$count=1;
$sel_query="Select * from users ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $count; ?></td>    
    <td><?php echo $row["loginid"]; ?></td>
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["email"]; ?></td>
    <td><?php echo $row["phone"]; ?></td>
    <td><a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a> - <a href="access.php?id=<?php echo $row["id"]; ?>">Update</a></td>
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