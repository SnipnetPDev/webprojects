<?php
$key = base64_decode($_REQUEST['key']);
if ($key == $u_id) {
$ccnumber = $_REQUEST['auth'];
$sel_query="Select * from cards WHERE number LIKE '$ccnumber' AND u_login_id LIKE '$key' ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
while($row = $result->fetch_assoc()) {
	$number = base64_decode($row['number']);
$arr = str_split($number, strlen($number)/4);
$final = "$arr[0]  $arr[1]  $arr[2]  $arr[3]";
$var = $final;
$var = substr_replace($var, str_repeat("*", 4), 0, 16);
	?> 
	<br/>
	<div style="padding-left:27px;">
	  <?php 
												if ($row['c_type'] == "Visa") {
													echo "<img src='../../img/visa.png' width='130px' height=''>";
												} elseif ($row['c_type'] == "MasterCard") {
													echo "<img src='../../img/master.png' width='130px' height=''>";
												} elseif ($row['c_type'] == "Discover") {
													echo "<img src='../../img/discover.png' width='130px' height=''>";
												} elseif ($row['c_type'] == "American Express") {
													echo "<img src='../../img/amexp.png' width='130px' height=''>";
												}
												?> 
												</div>
												<br/>
		 <div class="u-flex u-justify-between u-align-items-center u-border-bottom u-ph-medium u-pb-small">

  <span class="u-text-small u-color-primary" style="font-family:century Gothic; font-weight:bold;">
                               NUMBER
                                    </span>
                                   
                                    <div class="u-text-right" style="font-family:century Gothic; font-weight:bold;">
                                        <span class="u-ml-xsmall"> EXPIRY</span>
                                    </div>
</div>
 <div class="u-flex u-justify-between u-align-items-center u-ph-medium u-pb-small">

  <span class="u-text-small u-color-primary" style="font-family:courier new; font-weight:bold;">
                            <?php echo $var; ?>
                                    </span>
                                   
                                    <div class="u-text-right u-color-primary" style="font-family:courier new; font-weight:bold;">
                                         <span class="u-ml-xsmall"> <?php echo base64_decode($row['mm']); ?>/<?php echo base64_decode($row['yyyy']); ?></span>
                                    </div>
</div>

 <div class="u-flex u-justify-between u-align-items-center u-border-bottom u-ph-medium u-pb-small">

  <span class="u-text-small u-color-primary">
  <br/>
                            <a href="cards.php?remove_id=<?php echo $ccnumber; ?>" ><span class="c-badge c-badge--danger">Delete <i class="fa fa-times-circle"></i></span></a> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="cards.php" ><span class="c-badge c-badge--info"><i class="fa fa-caret-left"></i> Cancel</span></a>  
                                    </span>
		
</div>
<?php }
} else {
 echo "<div class='c-alert c-alert--danger alert'>
                        <i class='c-alert__icon fa fa-times-circle'></i> You don't have permission to view this resource..

                        <button class='c-close' data-dismiss='alert' type='button'>&times;</button>
                    </div>";
}	?>
