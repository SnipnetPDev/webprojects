<?php
error_reporting(0);
session_start();
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>
 
<?php
require('../db/index.php');  
  if($_POST) 
  {
      $name     = strip_tags($_POST['name']);
      
	  $stmt=$dbcon->prepare("SELECT cot FROM accounts WHERE cot=:name AND usr_id LIKE '$u_id'");
	  $stmt->execute(array(':name'=>$name));
	  $count=$stmt->rowCount();
	  	  
	  if($count>0)
	  {
		  echo "<button name='submit' type='submit' class='btn btn-primary'>Proceed</button>";
	  }
	  else
	  {
		  echo "<div class='alert alert-danger' style='font-family:courier;'>Invalid Cost of Transfer Code. Contact customer support. Error Code: TX9847120</div>";
	  }
  }
?>

<?php } 
else {  ?>
No data found
<?php
}
?>