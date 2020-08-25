 <?php include("password_protect.php"); ?>
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
          List all payee
                            </span></h4>          

<table class="table table-striped">
  <thead>
    <tr>
      <th>S/N</th>
      <th>Payee Name</th>
      <th>Bank/Institution</th>
      <th>Account Number</th>
    </tr>
  </thead>
  <tbody>
<?php
$count=1;
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from payee WHERE user_bond LIKE '$u_id' ORDER BY payee_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {

 ?>
    <tr>
      <th scope='row'><?php echo $count; ?></th>
      <td><?php echo $row["payee_name"]; ?></td>
      <td><?php echo $row["payee_bank"]; ?> </td>
      <td><?php echo $t_cur; ?><?php echo $row["payee_acc_no"]; ?> </td>

    </tr>
<?php $count++; } ?>
  </tbody>
</table>        
<br/>
<a href="new_payee.php"><i class="fa fa-external-link"></i> Add New Payee</a>         
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

       
  </body>
</html>

