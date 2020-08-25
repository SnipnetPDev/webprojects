<?php
include 'header.php';
?>

       <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                           <h3 class="">Software Information</h3>

<br/>----------------<?php
echo 'Current PHP version: ' . phpversion();
?>--------------------
<br/>
<br/>
<?php
 require('../../db/index.php');
$sel_query="Select * from license ORDER BY soft_name desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { 
$data = $row["license_id"];
$dataf = base64_decode($data);
?>
Name:<i style="color:blue;"> <?php echo $row["soft_name"]; ?></i>
<br/>
Version:<i style="color:blue;"> <?php echo $row["soft_version"]; ?></i>
<br/>
Release Date:<i style="color:blue;"> <?php echo $row["release_date"]; ?></i>
<br/>
Support Email:<i style="color:blue;"> <?php echo $row["support_email"]; ?></i>
<br/>
Upgrade Link:<i style="color:blue;"> <a href="<?php echo $row["upgrade_link"]; ?>" TARGET="_Blank"><?php echo $row["upgrade_link"]; ?></a></i>
<br/>
-----------------------------------		
<br/>
License ID: <?php echo $dataf; ?>
<br/>
<img src="../../home/assets/img/logo.png" />
<?php } ?>
<br/><br/><br/>----------------&copy; Stock Bank Project 2017--------------------



</div>
                    </div>
                </div>
            </div>
<?php
include 'footer.php';
?>