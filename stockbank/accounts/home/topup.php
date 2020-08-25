<?php
include 'templates/header.php';
?>
<?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
$us_type=$row['account_type'];
$us_first=$row['first_name'];
$us_last=$row['last_name'];
$us_acc=$row['account_no'];
if ($row = mysqli_fetch_assoc($result)) {

 ?>
        
<div class="col-lg-10 col-xs-8 col-xs-offset-1" >

<div class="panel-heading col-sm-12 service-title" data-reactid=".0.0.0.2.1.0.0.0">
<div class="col-xs-10 panel-head" data-reactid=".0.0.0.2.1.0.0.0.0">
<h3 class="panel-title left-text text-uppercase" data-reactid=".0.0.0.2.1.0.0.0.0.0">USD RECEIVING ACCOUNT (ACH)</h3>
</div>
</div>
<div class="panel-body col-sm-12" data-reactid=".0.0.0.2.1.0.0.2">
<div data-reactid=".0.0.0.2.1.0.0.2.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.0"></span>
<table class="table table-striped" data-reactid=".0.0.0.2.1.0.0.2.0.1">
<tbody data-reactid=".0.0.0.2.1.0.0.2.0.1.0">
<tr data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BankName">
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BankName.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BankName.0.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BankName.0.0.0">Bank Name</span></span></td>
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BankName.1">Community Federal Savings Bank</td>
</tr>
<tr data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$RoutingABA">
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$RoutingABA.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$RoutingABA.0.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$RoutingABA.0.0.0">Routing (ABA)</span><span class="tool-tip" data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$RoutingABA.0.0.1">?</span><span class="tool-tip-holder RoutingABA" data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$RoutingABA.0.0.2"></span></span></td>
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$RoutingABA.1">026073150</td>
</tr>
<tr data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountNumber">
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountNumber.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountNumber.0.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountNumber.0.0.0">Account Number</span><span class="tool-tip" data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountNumber.0.0.1">?</span><span class="tool-tip-holder AccountNumber" data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountNumber.0.0.2"></span></span></td>
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountNumber.1"><?php echo $us_acc; ?></td>
</tr>
<tr data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountType">
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountType.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountType.0.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountType.0.0.0">Account Type</span></span></td>
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$AccountType.1"><?php echo $us_type; ?></td>
</tr>
<tr data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BeneficiaryName">
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BeneficiaryName.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BeneficiaryName.0.0"><span data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BeneficiaryName.0.0.0">Beneficiary Name</span></span></td>
<td data-reactid=".0.0.0.2.1.0.0.2.0.1.0.0:$BeneficiaryName.1"><?php echo $us_first; ?> <?php echo $us_last; ?></td>
</tr>
<tr class="disclaimer" data-reactid=".0.0.0.2.1.0.0.2.0.1.0.2">
<td class="not_JPY" colspan="2" data-reactid=".0.0.0.2.1.0.0.2.0.1.0.2.0">
<div>Please Note!</div>
<ul>
<li>Only ACH (US local bank) transfers in USD can be accepted</li>
<li>Transfers must be made from a company account</li>
<li>Wire transfers are not supported</li>
</ul>
</td>
</tr>
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
  </body>
</html>

