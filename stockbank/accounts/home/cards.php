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
<div class="row">
          <div class="col-lg-9">
<h4><span >
          Linked Cards
                            </span></h4>
                
         <div class="card bg-white m-b">
          <div class="card-block p-a-0">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover table-condensed responsive m-b-0" data-sortable>
                <thead>
                  <tr>
	  <th class="col-md-3">Holder</th>
	  <th class="col-md-3">Card Number</th>
      <th class="col-md-2">Expiry Date</th>
	   <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>
				  <?php
$u_id=$_SESSION['usr_id'];
$t_cur=$row['account_cur'];
$l_id=$row['id'];
$us_acc=$row['account_no'];
$sel_query="Select * from cards WHERE u_login_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {

 ?>
    <tr>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["number"]; ?> </td>
      <td><?php echo $row["expiry"]; ?></td>
	  <td><a href="#">Remove</a> / <a href="#">Edit</a></td>
    </tr>
<?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>  
		          </div>
				            <div class="col-lg-3">
<div class="card card-block bg-white card-todo">
              <div class="todo-title">
                Menu
              </div>
              <div class="todo-body">
                <ul class="list-styled">
                  <li class="m-b">
                   
                      <label for="1"><a href="acc_request.php">Request new card</a></label>
                 
                  </li>
                </ul>
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