<?PHP
session_start();
require_once "../config.php";
require "../http_security.php";
$dbObj = new DB();
$CPreport = '';

  if (isset($_POST['workSpace'])) {
if($app->checkParameter($_POST["workSpace"], 'string') == 'pass'){
	$workSpace = $_POST['workSpace'];
}else{
	$CPreport = 'workSpace '.$app->checkParameter($_POST["workSpace"], 'string');
}
if($app->checkParameter($_POST["workspaceType"], 'string') == 'pass'){
	$workspaceType = $_POST['workspaceType'];
}else{
	$CPreport = 'workspaceType '.$app->checkParameter($_POST["workspaceType"], 'string');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}

if($workSpace == 'support'){
	if($workspaceType == 'products'){
	        $req_query = "SELECT * FROM trade_history t, userdata u WHERE u.userID = t.userID ORDER BY t.status ASC";
			$req_data = $dbObj->query_execute($req_query);
			$req_count = $dbObj->query_rowCount($req_data);
				if ($req_count > 0) {
					echo '<h5 style="padding:15px;">Trades</h5><table class="table table-sm table-hover mb-0">
											<thead>
												<tr>
													<th>Date</th>
													<th>Name / Mobile Number</th>
													<th>Amount (USD)</th>
													<th>Profit (USD)</th>
													<th>Duration</th>
													<th class="w-20">Status</th>
												</tr>
											</thead>
											<tbody>';
					while($request = $req_data->fetch_assoc()){
$date = date('Y-m-d', strtotime($request['trDate']. ' + '.$request['trDuration'].' days'));
if($request["status"] == 'complete'){ $ststus = 'Complete'; }elseif($request["status"] == 'running'){ $ststus = 'Running'; }elseif($request["status"] == 'suspended'){ $ststus = 'Suspended'; }
if($request["status"] == 'complete'){ $css = 'success'; }elseif($request["status"] == 'running'){ $css = 'info'; }elseif($request["status"] == 'suspended'){ $css = 'danger'; }
	$prodpanel = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/prodpanel.htm');
	$prodpanel = str_replace("%name%", $request["firstName"].' '.$request["lastName"].'('.$request["phoneNumber"].')', $prodpanel); 
	$prodpanel = str_replace("%amount%", $request["trAmount"], $prodpanel);
	$prodpanel = str_replace("%profit%", $request["trProfit"], $prodpanel);
	$prodpanel = str_replace("%duration%", $app->get_time_left($date,$app->get_date_time('date')), $prodpanel);
	$prodpanel = str_replace("%css%", $css, $prodpanel);
	$prodpanel = str_replace("%status%", $ststus, $prodpanel);
	$prodpanel = str_replace("%trId%", $request["trId"], $prodpanel);
	$prodpanel = str_replace("%transDate%", date('j M, Y', strtotime($request["trDate"])), $prodpanel);
?>
<tr title="Click to open a workspace for <?php echo $request["firstName"].' '.$request["lastName"].'('.$request["phoneNumber"].')'; ?>" onclick="newWorksheet('data', '<?php echo base64_encode($prodpanel); ?>')">
													<td><?php echo date('j M, Y', strtotime($request["trDate"])); ?></td>
													<td><?php echo $request["firstName"].' '.$request["lastName"].'('.$request["phoneNumber"].')'; ?></td>
													<td><?php echo $request["trAmount"]; ?></td>
													<td><?php echo $request["trProfit"]; ?></td>
													<td><?php echo $app->get_time_left($date,$app->get_date_time('date')); ?></td>
													<td><span class="badge badge-<?php if($request["status"] == 'complete'){ echo 'primary'; }elseif($request["status"] == 'running'){ echo 'info'; }elseif($request["status"] == 'suspended'){ echo 'danger'; } ?>"><?php echo $ststus; ?></span></td>
												</tr>
<?php				
					}
					echo '</tbody></table>';
				}else{
	$emptyTable = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/emptyTable.htm');
	$emptyTable = str_replace("%title%", "It's enpty out here.", $emptyTable); 
	$emptyTable = str_replace("%desc%", 'Try adding a few products to your store by clicking the add new product button below.', $emptyTable);
	$emptyTable = str_replace("%buttonNane%", 'Add new product', $emptyTable);
	$emptyTable = str_replace("%pageId%", 'new_prod', $emptyTable);
	echo $emptyTable;
				}
	}elseif($workspaceType == 'orders'){
		 $order_query = "SELECT * FROM topup_history t, userdata u WHERE u.userID = t.userID ORDER BY t.status ASC";
			$order_data = $dbObj->query_execute($order_query);
			$order_count = $dbObj->query_rowCount($order_data);
				if ($order_count > 0) {
					echo '<h5 style="padding:15px;">Deposit Requests</h5><table class="table table-sm table-hover mb-0">
											<thead>
												<tr>
													<th>Date</th>
													<th>Client Name / Mobile number</th>
													<th>Amount (USD)</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>';
					while($order = $order_data->fetch_assoc()){
	$orderpanel = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/orderpanel.htm');
	$orderpanel = str_replace("%name%", $order["firstName"].' '.$order["lastName"].'('.$order["phoneNumber"].')', $orderpanel); 
	$orderpanel = str_replace("%amount%", $order["USDamt"].' USD / '.$order["BTCamt"].' BTC', $orderpanel);
	$orderpanel = str_replace("%transId%", $order["TId"], $orderpanel);
	$orderpanel = str_replace("%trId%", $order["transId"], $orderpanel);
	$orderpanel = str_replace("%transDate%", date('j M, Y', strtotime($order["transDate"])), $orderpanel);

?>
												<tr title="Click to open a workspace for <?php echo $order["firstName"].' '.$order["lastName"].'('.$order["phoneNumber"].')'; ?>" onclick="newWorksheet('data', '<?php echo base64_encode($orderpanel); ?>')">
													<td><?php echo date('j M, Y', strtotime($order["transDate"])); ?></td>
													<td><?php echo $order["firstName"].' '.$order["lastName"].'('.$order["phoneNumber"].')'; ?></td>
													<td><?php echo $order["USDamt"]; ?></td>
													<td><span class="badge badge-<?php if($order["status"] == 'complete'){ echo 'primary'; }elseif($order["status"] == 'pending'){ echo 'danger'; } ?>"><?php if($order["status"] == 'complete'){ echo 'Complete'; }elseif($order["status"] == 'pending'){ echo 'Pending'; } ?></span></td>
													
												</tr>
<?php				
					}
		echo '</tbody></table>';
		}else{
	$emptyTable = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/emptyTable.htm');
	$emptyTable = str_replace("%title%", "It's enpty out here.", $emptyTable); 
	$emptyTable = str_replace("%desc%", 'Orders made from your shop will appear here.', $emptyTable);
	$emptyTable = str_replace("%buttonNane%", 'Learn more', $emptyTable);
	$emptyTable = str_replace("%pageId%", 'help', $emptyTable);
	echo $emptyTable;
				}
	}elseif($workspaceType == 'faq'){
	        $faq_query = "SELECT * FROM faq ORDER BY faq_id DESC";
			$faq_data = $dbObj->query_execute($faq_query);
			$faq_count = $dbObj->query_rowCount($faq_data);
				if ($faq_count > 0) {
	$tableContr = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/tableContr.htm');
	$tableContr = str_replace("%buttonName%", 'Add faq', $tableContr);
	$tableContr = str_replace("%buttonName2%", 'Add faq category', $tableContr);
	$tableContr = str_replace("%pageId%", 'new_faq', $tableContr);
	$tableContr = str_replace("%pageId2%", 'new_faq', $tableContr);
	echo $tableContr;
					echo '<h5 style="padding:15px;">FAQ</h5><table class="table table-sm table-hover mb-0">
											<thead>
												<tr>
													<th>Title</th>
													<th>Short Description</th>
													<th>Category</th>
												</tr>
											</thead>
											<tbody>';
					while($faq = $faq_data->fetch_assoc()){
	$faqpanel = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/faqpanel.htm');
	$faqpanel = str_replace("%title%", $faq["faq_title"], $faqpanel); 
	$faqpanel = str_replace("%desc%", $faq["faq_desc"], $faqpanel);
	$faqpanel = str_replace("%body%", $faq["faq_body"], $faqpanel);
	$faqpanel = str_replace("%qid%", $faq["faq_id"], $faqpanel);

?>
												<tr title="Click to open a workspace for <?php echo $faq["faq_title"]; ?>" onclick="newWorksheet('data', '<?php echo base64_encode($faqpanel); ?>')">
													<td><?php echo $faq["faq_title"]; ?></td>
													<td><?php echo $faq["faq_desc"]; ?></td>
													<td><span class="badge badge-<?php if($faq["faq_cat"] == 'account'){ echo 'primary'; }elseif($faq["faq_cat"] == 'payment'){ echo 'info'; }if($faq["faq_cat"] == 'security'){ echo 'success'; } ?>"><?php echo $faq["faq_cat"]; ?></span></td>
													
												</tr>
<?php				
					}
		echo '</tbody></table>';
		}else{
	$emptyTable = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/emptyTable.htm');
	$emptyTable = str_replace("%title%", "It's enpty out here.", $emptyTable); 
	$emptyTable = str_replace("%desc%", 'Try adding a few content to your FAQ by clicking the add new faq button below.', $emptyTable);
	$emptyTable = str_replace("%buttonNane%", 'Add new faq', $emptyTable);
	$emptyTable = str_replace("%pageId%", 'new_faq', $emptyTable);
	echo $emptyTable;
				}
	}
  }elseif($workSpace == 'developer'){
	  
  }elseif($workSpace == 'finance'){
	  
  }
  
  }

  if (isset($_POST['FAQcategory'])) {
if($app->checkParameter($_POST["FAQtitle"], 'string') == 'pass'){
	$FAQtitle = $_POST['FAQtitle'];
}else{
	$CPreport = 'Title '.$app->checkParameter($_POST["FAQtitle"], 'string');
}
if($app->checkParameter($_POST["FAQshortDesc"], 'string') == 'pass'){
	$FAQshortDesc = $_POST['FAQshortDesc'];
}else{
	$CPreport = 'Short Description '.$app->checkParameter($_POST["FAQshortDesc"], 'string');
}
if($app->checkParameter($_POST["FAQfullDesc"], 'string') == 'pass'){
	$FAQfullDesc = $_POST['FAQfullDesc'];
}else{
	$CPreport = 'Full Description '.$app->checkParameter($_POST["FAQfullDesc"], 'string');
}
if($app->checkParameter($_POST["FAQcategory"], 'string') == 'pass'){
	$FAQcategory = $_POST['FAQcategory'];
}else{
	$CPreport = 'Category '.$app->checkParameter($_POST["FAQcategory"], 'string');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}

$FAQslug = $app->slug($FAQtitle);

if(insertInto('faq',array('faq_slug' => $FAQslug, 'faq_title' => $FAQtitle, 'faq_desc' => $FAQshortDesc, 'faq_body' => $FAQfullDesc, 'faq_cat' => $FAQcategory)) == 'done'){
		echo 0;
	}else{
	echo 'rejected';
  }
  
}
  

if (isset($_POST['qid'])) {
if($app->checkParameter($_POST["FAQtitle"], 'string') == 'pass'){
	$FAQtitle = $_POST['FAQtitle'];
}else{
	$CPreport = 'Title '.$app->checkParameter($_POST["FAQtitle"], 'string');
}
if($app->checkParameter($_POST["FAQshortDesc"], 'string') == 'pass'){
	$FAQshortDesc = $_POST['FAQshortDesc'];
}else{
	$CPreport = 'Short Description '.$app->checkParameter($_POST["FAQshortDesc"], 'string');
}
if($app->checkParameter($_POST["FAQfullDesc"], 'string') == 'pass'){
	$FAQfullDesc = $_POST['FAQfullDesc'];
}else{
	$CPreport = 'Full Description '.$app->checkParameter($_POST["FAQfullDesc"], 'string');
}
if($app->checkParameter($_POST["qid"], 'number') == 'pass'){
	$qid = $_POST['qid'];
}else{
	$CPreport = 'qid '.$app->checkParameter($_POST["qid"], 'number');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}

$FAQslug = $app->slug($FAQtitle);
$upd_sql = "UPDATE faq SET faq_slug = '$FAQslug', faq_title = '$FAQtitle', faq_desc = '$FAQshortDesc', faq_body = '$FAQfullDesc' WHERE faq_id = '$qid'";
if($dbObj->query_execute($upd_sql)){
		echo 0;
	}else{
	echo 'rejected';
  }
  
}

if (isset($_POST['dqid'])) {
if($app->checkParameter($_POST["dqid"], 'number') == 'pass'){
	$qid = $_POST['dqid'];
}else{
	$CPreport = 'dqid '.$app->checkParameter($_POST["dqid"], 'number');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
$upd_sql = "DELETE FROM faq WHERE faq_id = '$qid'";
if($dbObj->query_execute($upd_sql)){
		echo 0;
	}else{
	echo 'Command not successfull';
  }
  
}


if (isset($_POST['trId'])) {
if($app->checkParameter($_POST["trId"], 'number') == 'pass'){
	$trId = $_POST['trId'];
}else{
	$CPreport = 'trId '.$app->checkParameter($_POST["trId"], 'number');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
	$sqlReport = $mysqli->singleSelect('topup_history', array('transId' => $trId), 'fetch', ''); 
	if($sqlReport[0]['status'] == 'pending'){
		if($sqlReport[0]['credited'] == 'no'){
			if($mysqli->custom("UPDATE userdata SET wallet = wallet + ".$sqlReport[0]['USDamt']." WHERE userID = '".$sqlReport[0]['userID']."'", 'update') == 'ok'){
			if($mysqli->custom("UPDATE topup_history SET credited = 'yes', status = 'complete' WHERE transId = '".$trId."'", 'update') == 'ok'){
			echo 0;
			}else{
		echo 1;
	}
			}else{
		echo 1;
	}
		}else{
			echo 1;
		}
	}else{
		echo 1;
	}
  
}


if (isset($_POST['newProfit']) && isset($_POST['tradeId'])) {
if($app->checkParameter($_POST["newProfit"], 'number') == 'pass'){
	$newProfit = $_POST['newProfit'];
}else{
	$CPreport = 'newProfit '.$app->checkParameter($_POST["newProfit"], 'number');
}
if($app->checkParameter($_POST["tradeId"], 'number') == 'pass'){
	$tradeId = $_POST['tradeId'];
}else{
	$CPreport = 'tradeId '.$app->checkParameter($_POST["tradeId"], 'number');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
			if($mysqli->custom("UPDATE trade_history SET trProfit = '$newProfit' WHERE trId = '$tradeId'", 'update') == 'ok'){
			echo 0;
			}else{
		echo 1;
	}

	
  
}


if (isset($_POST['modId']) && isset($_POST['modProtocol'])) {
if($app->checkParameter($_POST["modId"], 'number') == 'pass'){
	$modId = $_POST['modId'];
}else{
	$CPreport = 'modId '.$app->checkParameter($_POST["modId"], 'number');
}
if($app->checkParameter($_POST["modProtocol"], 'string') == 'pass'){
	$modProtocol = $_POST['modProtocol'];
}else{
	$CPreport = 'modProtocol '.$app->checkParameter($_POST["modProtocol"], 'string');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
if($modProtocol == 'pause'){
	if($mysqli->custom("UPDATE trade_history SET status = 'suspended' WHERE trId = '$modId'", 'update') == 'ok'){
			echo 0;
			}else{
		echo 1;
	}
}elseif($modProtocol == 'resume'){
	if($mysqli->custom("UPDATE trade_history SET status = 'running' WHERE trId = '$modId'", 'update') == 'ok'){
			echo 0;
			}else{
		echo 1;
	}
}
			
}
  

?>