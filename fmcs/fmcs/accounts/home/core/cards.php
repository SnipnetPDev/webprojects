<?php
$sel_query="Select * from cards WHERE u_login_id LIKE '$u_id' ORDER BY id desc;";
$result = $con->query($sel_query) or die($con->error);
while($row = $result->fetch_assoc()) {
	$number = base64_decode($row['number']);
$arr = str_split($number, strlen($number)/4);
$final = "$arr[0]  $arr[1]  $arr[2]  $arr[3]";
	?> 
 <div class="u-flex u-justify-between u-align-items-center u-border-bottom u-ph-medium u-pb-small">
  
  <span class="u-text-small u-color-primary">
  <?php 
												if ($row['c_type'] == "Visa") {
													echo "<img src='../../img/visa.png' width='30px' height=''>";
												} elseif ($row['c_type'] == "MasterCard") {
													echo "<img src='../../img/master.png' width='30px' height=''>";
												} elseif ($row['c_type'] == "Discover") {
													echo "<img src='../../img/discover.png' width='30px' height=''>";
												} elseif ($row['c_type'] == "American Express") {
													echo "<img src='../../img/amexp.png' width='30px' height=''>";
												}
												?>
  </span> 
  
   <div class="u-text-right u-color-primary">
	<span class="u-color-warning u-ml-xsmall"><strong><?php $var = $final;
$var = substr_replace($var, str_repeat("*", 19), 0, 16);
echo $var; ?> <a href="cards.php?auth=<?php echo $row['number']; ?>&&key=<?php echo base64_encode($row['u_login_id']); ?>" ><i class="fa fa-angle-down"></i></a></strong></span>
  </div>
  
</div>
<?php } ?>
