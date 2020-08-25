<?php
include 'templates/header.php';
?>
<?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>
        
            <!-- Left nav
            ================================================== -->
              <div class="col-lg-10 col-xs-8 col-xs-offset-1" >
<div class="m-x-n-g m-t-n-g overflow-hidden">
<div class="card m-b-0 p-a-md no-border">
<h4><span >
          Transaction History
                            </span></h4>

            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover table-condensed responsive m-b-0" data-sortable>
                <thead>
                  <tr>
	  <th class="col-md-2">Date</th>
      <th class="col-md-5">Description</th>
      <th class="col-md-2">Money in</th>
      <th class="col-md-2">Money out</th>
      <th class="col-md-2">Balance</th>
                  </tr>
                </thead>
                <tbody>
				  <?php
$u_id=$_SESSION['usr_id'];
$t_cur=$row['account_cur'];
$l_id=$row['id'];
$us_acc=$row['account_no'];
$sel_query="Select * from trans_history WHERE tr_user LIKE '$u_id' OR tr_payee LIKE '$us_acc' ORDER BY tr_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {

 ?>
    <tr>
      <td><?php echo $row["tr_date"]; ?></td>
      <td><?php echo $row["tr_desc"]; ?></td>
      <td><?php echo $t_cur; ?><?php echo $row["tr_credit"]; ?> </td>
      <td><?php echo $t_cur; ?><?php echo $row["tr_debit"]; ?> </td>
      <td><?php echo $t_cur; ?><?php echo $row["tr_end_bal"]; ?> </td>
    </tr>
<?php } ?>
                </tbody>
              </table>
        </div>  
		          </div>
         </div>
              </div>
        
<?php } 
else {  ?>
<meta http-equiv="refresh" content="0; url=index.php" />
<?php
}
?>
    <?php include 'templates/footer.php'; ?>

