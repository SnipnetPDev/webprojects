<?php
include 'templates/header.php';
?>
<script type="text/javascript" src="assets/js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{    
	$("#name").keyup(function()
	{		
		var name = $(this).val();	
		
		if(name.length > 6)
		{		
			$("#result").html('checking...');
			
			/*$.post("ipn-check.php", $("#reg-form").serialize())
				.done(function(data){
				$("#result").html(data);
			});*/
			
			$.ajax({
				
				type : 'POST',
				url  : 'ipn-check.php',
				data : $(this).serialize(),
				success : function(data)
						  {
					         $("#result").html(data);
					      }
				});
				return false;
			
		}
		else
		{
			$("#result").html('');
		}
	});
	
});
</script>
<style>
ul.breadcrumb {
    padding: 8px 16px;
    list-style: none;
    background-color: #fff;
}
ul.breadcrumb li {display: inline; padding-left:10px; padding-right:10px;}
ul.breadcrumb li+li:before {
    padding: 10px;
    color: blue;
    content: "";
    background-image: url("assets/img/crumb.png");
    background-repeat: no-repeat;
    background-position: center;
}
ul.breadcrumb li a {color: blue;}
</style>
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
<div class="card m-b-0 bg-info-light text-black p-a-md no-border">
      <div class="card-block">  
<ul class="breadcrumb">
  <li><a href="transfers.php">Amount</a></li>
  <li><a href="transfers.php">Details</a></li>
  <li><a href="#">Review</a></li>
  <li>Summary</li>
</ul>              
<?php
 
require('../db/index.php');
$tr_usr_id=$_SESSION['usr_id'];
$tr_acc_id=$row['id'];
$tr_acc_balsub=$row['account_balance'];
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$tr_acc_num =$_REQUEST['tr_acc_num'];
$tr_amount = $_REQUEST['tr_amount'];
$tr_payee = $_REQUEST['tr_payee'];
$tr_debit=$tr_acc_balsub-$tr_amount;
}
?>
<form name="form" method="post" action="transfers_new_cot_check.php"> 
<input type="hidden" name="new" value="1" />
<input type="hidden" name="tr_acc_num" value="<?php echo $tr_acc_num;?>">
<input type="hidden" name="tr_amount" value="<?php echo $tr_amount;?>">
<input type="hidden" name="tr_payee" value="<?php echo $tr_payee;?>">
<div class="form-group">

<?php
$u_id=$_SESSION['usr_id'];
$tr_cur=$row['account_cur'];
$tr_acc_bal=$row['account_balance'];
$sel_query="Select * from payee WHERE payee_id LIKE '$tr_payee' ORDER BY payee_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<div class='alert alert-success' style='font-family:courier;'>
<label for="formGroupExampleInput2">TRANSACTION DETAILS</label><br/>
AMOUNT: &nbsp;<?php echo $tr_cur;?><?php echo $tr_amount; ?> <br/>
ACCOUNT: <?php echo $tr_acc_num; ?> <br/>
DATE: &nbsp;&nbsp;&nbsp;<?php echo date("Y/m/d"); ?>
<br/><br/>
<label for="formGroupExampleInput2">PAYEE DETAILS</label><br/>
<?php echo $row["payee_bank"]; ?> <br/>
<?php echo $row["payee_name"]; ?> <br/>
<?php echo $row["payee_acc_no"]; ?>
</div>
<?php
$tr_payee_accz=$row["payee_acc_no"];
$sel_query="Select * from accounts WHERE account_no LIKE '$tr_payee_accz' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<?php } ?>
<?php } ?>
<h4><span >Insurance Policy Number</h4></span>
ZGM<input style="width:15%;" type="text" name="name" id="name" MAXLENGTH=7 />
</div>
<br/>

 <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
		<span id="result"></span>
      </div>
    </div>
</form>

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