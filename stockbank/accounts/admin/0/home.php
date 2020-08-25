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
                            <h3 class="box-title">Accounts</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
    <th>#</th>
    <th>Account NO</th>
    <th>Full Name</th>
    <th>Date Opened</th>
    <th>Account Type</th>
	<th>Account Balance</th>
    <th>Account Status</th>
    <th>Take Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
 <?php
 require('../../db/index.php');
$count=1;
$sel_query="Select * from accounts ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $count; ?></td>    
    <td><?php echo $row["account_no"]; ?></td>
    <td class="txt-oflo"><?php echo $row["title"]; ?> <?php echo $row["first_name"]; ?></td>
    <td class="txt-oflo"><?php echo $row["account_opening_date"]; ?></td>
    <td><?php echo $row["account_type"]; ?></td>
	<td><span class="text-success"><strong><?php echo $row["account_cur"]; ?> <?php echo $row["account_balance"]; ?><strong></span></td>
    <td><?php echo $row["account_status"]; ?></td>
    <td><a href="upgrade.php?id=<?php echo $row["id"]; ?>">Upgrade</a> - <a href="a_status.php?id=<?php echo $row["id"]; ?>">Status</a> - <a href="data.php?id=<?php echo $row["id"]; ?>">Data</a> - <a href="delete_acc.php?id=<?php echo $row["id"]; ?>">Close</a></td>
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