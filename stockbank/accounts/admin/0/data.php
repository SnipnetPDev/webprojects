<?php
include 'header.php';
?>
<?php
 
require('../../db/index.php');
$id=$_REQUEST['id'];
$query = "SELECT * from accounts where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);
$acc_id=$row['usr_id'];
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">

                            <h3 class="box-title">Full account information: <strong><?php echo $row['account_no'];?></strong></h3>
    <h3 class="box-title">Account Info</h3>
    <div class="table-responsive">
   <table class="table">
   
    <thead>
    <tr>
    <th>Account NO</th>
    <th>Account Type</th>
    <th>Account PIN</th>
    <th>Account Status</th>
	<th>Account Balance</th>
     </tr>
    </thead>
	
    <tbody>
  <tr>
    <td><?php echo $row['account_no'];?></td> 
    <td><?php echo $row['account_type'];?></td>
    <td><?php echo $row['account_pin'];?></td>
    <td><?php echo $row['account_status'];?></td>
    <td><?php echo $row['account_balance'];?></td>	
  </tr>	
   </tbody>

   </table>
    </div>
	
	<h3 class="box-title">Account Codes</h3>
    <div class="table-responsive">
   <table class="table">
   
    <thead>
    <tr>
    <th>Insurance Policy Number (IPN)</th>
    <th>Cost of Transfer (COT)</th>
    <th>International Monetary Funds (IMF)</th>
     </tr>
    </thead>
	
    <tbody>
  <tr>
    <td><?php echo $row['ipn'];?></td> 
    <td><?php echo $row['cot'];?></td>
    <td><?php echo $row['imf'];?></td>
  </tr>	
   </tbody>

   </table>
    </div>
	
	    <h3 class="box-title">Holder Info</h3>
    <div class="table-responsive">
   <table class="table">
   
    <thead>
    <tr>
    <th>Full name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
	<th>Occupation</th>
    <th>Date of Birth</th>
     </tr>
    </thead>
	
    <tbody>
  <tr>
    <td><?php echo $row['title'];?> <?php echo $row['first_name'];?> <?php echo $row['last_name'];?> <?php echo $row['other_name'];?></td> 
    <td><?php echo $row['street_address'];?><br/> <?php echo $row['city'];?>, <?php echo $row['state'];?> <br/><?php echo $row['country'];?> <?php echo $row['zip_code'];?></td>
    <td><?php echo $row['phone'];?></td>
    <td><?php echo $row['email'];?></td>
    <td><?php echo $row['occupation'];?></td>
    <td><?php echo $row['dob'];?></td>	
  </tr>	
   </tbody>

   </table>
    </div>
	
		    <h3 class="box-title">Holder Identification</h3>
    <div class="table-responsive">
   <table class="table">
   
    <thead>
    <tr>
    <th>Nationality</th>
    <th>ID Type</th>
    <th>ID Number</th>
    <th>SSN</th>
    <th>Date of Birth</th>
     </tr>
    </thead>
	
    <tbody>
  <tr>
    <td><?php echo $row['citizenship'];?></td> 
    <td><?php echo $row['us_id_type'];?></td>
    <td><?php echo $row['us_id_no'];?></td>
    <td><?php echo $row['ssn'];?></td>
    <td><?php echo $row['dob'];?></td>	
  </tr>	
  <?php
 
require('../../db/index.php');
$query = "SELECT * from users where id='".$acc_id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error($con));
$row = mysqli_fetch_assoc($result);
$imageU = $row['id_front'];
$imageX = $row['id_back'];
$ids_front = "../../home/assets/img/ids/".$imageU;
$ids_back = "../../home/assets/img/ids/".$imageX;
?>
  <tr>
  <td><a href="<?php echo $ids_front; ?>"><img src="<?php echo $ids_front; ?>" width="207px" height="130px"></a></td>
    <td><a href="<?php echo $ids_back; ?>"><img src="<?php echo $ids_back; ?>" width="207px" height="130px"></a></td>
    </tr>
   </tbody>

   </table>
    </div>
</div>
                    </div>
                </div>
            </div>

<?php
include 'footer.php';
?>