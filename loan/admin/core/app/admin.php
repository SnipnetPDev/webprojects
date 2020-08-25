<?PHP
session_start();
require_once "../config.php";
require "../http_security.php";
$dbObj = new DB();
$CPreport = '';
$appConfig = $mysqli->singleSelect('config', '', 'fetch', '');
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
	$emptyTable = str_replace("%title%", "Coming soon.", $emptyTable); 
	$emptyTable = str_replace("%desc%", 'Avaliable on our next release.', $emptyTable);
	$emptyTable = str_replace("%buttonNane%", 'Find out more', $emptyTable);
	$emptyTable = str_replace("%pageId%", 'help', $emptyTable);
	echo $emptyTable;
				}
	}elseif($workspaceType == 'pages'){
		 $pages_query = "SELECT * FROM pages";
		 $page_manifest = json_decode(file_get_contents('../../../web/template/loanui/manifest.json'));
			$pages_data = $dbObj->query_execute($pages_query);
			$pages_count = $dbObj->query_rowCount($pages_data);
				if ($pages_count > 0) {
					echo '<h5 style="padding:15px;">Pages</h5><table class="table table-sm table-hover mb-0">
											<thead>
												<tr>
												    <th>Display</th>
													<th>ID</th>
													<th>Title</th>
													<th>Auth</th>
												</tr>
											</thead>
											<tbody>';
					while($pages = $pages_data->fetch_assoc()){
					$pgSelector = $pages["pageId"];
	if($pages["pageType"] == 'text'){
		
	$pagePanel = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/pagepanelTxt.htm');
	$pagePanel = str_replace("%pageTxt%", $pages["pageTxt"], $pagePanel);
	$pagePanel = str_replace("%pageTxt2%", $pages["pageTxt2"], $pagePanel);
	$pagePanel = str_replace("%pageTxt3%", $pages["pageTxt3"], $pagePanel);
	$pagePanel = str_replace("%pageTxt4%", $pages["pageTxt4"], $pagePanel);
	$pagePanel = str_replace("%pageTxt5%", $pages["pageTxt5"], $pagePanel);
	if($pages["pageImg"] == ''){ $pages["pageImg"] = $appConfig[11]['configValue']; }
	$pagePanel = str_replace("%pageImg%", $pages["pageImg"], $pagePanel);
	if($pages["pageImg2"] == ''){ $pages["pageImg2"] = $appConfig[11]['configValue']; }
	$pagePanel = str_replace("%pageImg2%", $pages["pageImg2"], $pagePanel);
	if($pages["pageImg3"] == ''){ $pages["pageImg3"] = $appConfig[11]['configValue']; }
	$pagePanel = str_replace("%pageImg3%", $pages["pageImg3"], $pagePanel);
	if($pages["pageImg4"] == ''){ $pages["pageImg4"] = $appConfig[11]['configValue']; }
	$pagePanel = str_replace("%pageImg4%", $pages["pageImg4"], $pagePanel);
	if($pages["pageImg5"] == ''){ $pages["pageImg5"] = $appConfig[11]['configValue']; }
	$pagePanel = str_replace("%pageImg5%", $pages["pageImg5"], $pagePanel);
	
					}elseif($pages["pageType"] == 'html'){
						
    $pagePanel = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/pagepanelHtml.htm');
	$pagePanel = str_replace("%pageTxt%", base64_decode($pages["pageHtml"]), $pagePanel);

					}
	$pagePanel = str_replace("%title%", $page_manifest->$pgSelector->pageTitle, $pagePanel);
	$pagePanel = str_replace("%desc%", $page_manifest->$pgSelector->pageDesc, $pagePanel);
	if($page_manifest->$pgSelector->pageImg == ''){ $page_manifest->$pgSelector->pageImg = $appConfig[11]['configValue']; }
	$pagePanel = str_replace("%display%", $page_manifest->$pgSelector->pageImg, $pagePanel);
	$pagePanel = str_replace("%pGId%", $pages["pageId"], $pagePanel);
	if($page_manifest->$pgSelector->pageAuth == 'yes'){
	$pagePanel = str_replace("%auth%", 'checked', $pagePanel);
	}else{
	$pagePanel = str_replace("%auth%", '', $pagePanel);
	}
?>
												<tr title="Click to open a workspace for <?php echo $pages["pageId"]; ?>" onclick="newWorksheet('data', '<?php echo base64_encode($pagePanel); ?>')">
													<td><img src="data:image<?php echo $page_manifest->$pgSelector->pageImg; ?>" width="50px" height=""/></td>
													<td><?php echo $pages["pageId"]; ?></td>
													<td><?php echo $page_manifest->$pgSelector->pageTitle; ?></td>
													<td><span class="badge badge-<?php if($page_manifest->$pgSelector->pageAuth == 'yes'){ echo 'primary'; }elseif($page_manifest->$pgSelector->pageAuth == 'no'){ echo 'danger'; } ?>"><?php echo $page_manifest->$pgSelector->pageAuth; ?></span></td>
													
												</tr>
<?php				
					}
		echo '</tbody></table>';
		}else{
	$emptyTable = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/emptyTable.htm');
	$emptyTable = str_replace("%title%", "It's enpty out here.", $emptyTable); 
	$emptyTable = str_replace("%desc%", 'You have no page setup on your webspace.', $emptyTable);
	$emptyTable = str_replace("%buttonNane%", 'Learn more', $emptyTable);
	$emptyTable = str_replace("%pageId%", 'help', $emptyTable);
	echo $emptyTable;
				}
				
				
				
	}elseif($workspaceType == 'settings'){
		$appConfig = $mysqli->singleSelect('config', '', 'fetch', '');
	$settings = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/settings.htm');
	$settings = str_replace("%address%", $appConfig[0]['configValue'], $settings); 
	$settings = str_replace("%phone%", $appConfig[8]['configValue'], $settings);
	$settings = str_replace("%email%", $appConfig[2]['configValue'], $settings);
	$settings = str_replace("%hours%", $appConfig[5]['configValue'], $settings);
	$settings = str_replace("%shortAbout%", $appConfig[9]['configValue'], $settings);
	$settings = str_replace("%twitter%", $appConfig[10]['configValue'], $settings);
	$settings = str_replace("%facebook%", $appConfig[3]['configValue'], $settings);
	$settings = str_replace("%instagram%", $appConfig[6]['configValue'], $settings);
	$settings = str_replace("%android%", $appConfig[12]['configValue'], $settings);
	$settings = str_replace("%ios%", $appConfig[13]['configValue'], $settings);
	$settings = str_replace("%logo%", $appConfig[7]['configValue'], $settings);
	echo $settings;
	}elseif($workspaceType == 'orders'){
		 $order_query = "SELECT * FROM applications a, userdata u, address d WHERE u.userID = a.usrID and a.usrID = d.userID ORDER BY a.loanDate DESC";
			$order_data = $dbObj->query_execute($order_query);
			$order_count = $dbObj->query_rowCount($order_data);
				if ($order_count > 0) {
					echo '<h5 style="padding:15px;">Loan Requests</h5><table class="table table-sm table-hover mb-0">
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
	$orderpanel = str_replace("%name%", $order["firstName"].' '.$order["lastName"], $orderpanel); 
	$orderpanel = str_replace("%address%", $order["line1"].$order["line2"].', '.$order["city"].' '.$order["state"].', '.$order["country"], $orderpanel); 
	$orderpanel = str_replace("%mobile%", $order["phoneNumber"], $orderpanel);
	$orderpanel = str_replace("%email%", $order["email"], $orderpanel);
	$orderpanel = str_replace("%cname%", $order["company"], $orderpanel);
	$orderpanel = str_replace("%amount%", number_format($order["amount"]).' USD', $orderpanel);
	$orderpanel = str_replace("%loanProd%", $order["loanProd"], $orderpanel);
	$orderpanel = str_replace("%loanTerm%", $order["loanTerm"], $orderpanel);
	$orderpanel = str_replace("%loanPurpose%", $order["loanPurpose"], $orderpanel);
	$orderpanel = str_replace("%Additionalnote%", $order["Additionalnote"], $orderpanel);
	$orderpanel = str_replace("%trId%", $order["appId"], $orderpanel);
	$orderpanel = str_replace("%transDate%", date('j M, Y', strtotime($order["loanDate"])), $orderpanel);

?>
												<tr title="Click to open a workspace for <?php echo $order["firstName"].' '.$order["lastName"].'('.$order["phoneNumber"].')'; ?>" onclick="newWorksheet('data', '<?php echo base64_encode($orderpanel); ?>')">
													<td><?php echo date('j M, Y', strtotime($order["loanDate"])); ?></td>
													<td><?php echo $order["firstName"].' '.$order["lastName"].'('.$order["phoneNumber"].')'; ?></td>
													<td><?php echo number_format($order["amount"]); ?></td>
													<td><span class="badge badge-<?php if($order["loanStatus"] == 'approved'){ echo 'primary'; }elseif($order["loanStatus"] == 'processing'){ echo 'warning'; }elseif($order["loanStatus"] == 'declined'){ echo 'danger'; } ?>"><?php echo $order["loanStatus"]; ?></span></td>
													
												</tr>
<?php				
					}
		echo '</tbody></table>';
		}else{
	$emptyTable = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/emptyTable.htm');
	$emptyTable = str_replace("%title%", "It's enpty out here.", $emptyTable); 
	$emptyTable = str_replace("%desc%", 'Loan requests from your clients will appear here.', $emptyTable);
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

if (isset($_POST['pageId'])) {
if($app->checkParameter($_POST["pageContent"], 'string') == 'pass'){
	$pageContent = $_POST['pageContent'];
}else{
	$CPreport = 'pageContent '.$app->checkParameter($_POST["pageContent"], 'string');
}
if($app->checkParameter($_POST["pageId"], 'string') == 'pass'){
	$pageId = $_POST['pageId'];
}else{
	$CPreport = 'pageId '.$app->checkParameter($_POST["pageId"], 'string');
}
if($app->checkParameter($_POST["pGauth"], 'string') == 'pass'){
	if($_POST["pGauth"] == 'on'){
	$pGauth = 'yes';
	}else{
	$pGauth = 'no';
	}
}else{
	$CPreport = 'pGauth '.$app->checkParameter($_POST["pGauth"], 'string');
}
if($app->checkParameter($_POST["pGtitle"], 'string') == 'pass'){
	$pGtitle = $_POST['pGtitle'];
}else{
	$CPreport = 'pGtitle '.$app->checkParameter($_POST["pGtitle"], 'string');
}
if($app->checkParameter($_POST["pGdesc"], 'string') == 'pass'){
	$pGdesc = $_POST['pGdesc'];
}else{
	$CPreport = 'pGdesc '.$app->checkParameter($_POST["pGdesc"], 'string');
}

if($pageContent == 'text'){
if($app->checkParameter($_POST["pageTxt"], 'string') == 'pass'){
	$pageTxt = $_POST['pageTxt'];
}else{
	$CPreport = 'pageTxt '.$app->checkParameter($_POST["pageTxt"], 'string');
}
if($app->checkParameter($_POST["pageTxt2"], 'string') == 'pass'){
	$pageTxt2 = $_POST['pageTxt2'];
}else{
	$CPreport = 'pageTxt2 '.$app->checkParameter($_POST["pageTxt2"], 'string');
}
if($app->checkParameter($_POST["pageTxt3"], 'string') == 'pass'){
	$pageTxt3 = $_POST['pageTxt3'];
}else{
	$CPreport = 'pageTxt3 '.$app->checkParameter($_POST["pageTxt3"], 'string');
}
if($app->checkParameter($_POST["pageTxt4"], 'string') == 'pass'){
	$pageTxt4 = $_POST['pageTxt4'];
}else{
	$CPreport = 'pageTxt4 '.$app->checkParameter($_POST["pageTxt4"], 'string');
}
if($app->checkParameter($_POST["pageTxt5"], 'string') == 'pass'){
	$pageTxt5 = $_POST['pageTxt5'];
}else{
	$CPreport = 'pageTxt5 '.$app->checkParameter($_POST["pageTxt5"], 'string');
}
}elseif($pageContent == 'html'){
	$pageTxtHtml = base64_encode($_POST['pageTxt']);
}



if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
if($custom->replaceMnf($pGtitle, '../../../web/template/loanui/manifest.json', $pageId, 'pageTitle') == 'ok'){
if($custom->replaceMnf($pGdesc, '../../../web/template/loanui/manifest.json', $pageId, 'pageDesc') == 'ok'){
if($custom->replaceMnf($pGauth, '../../../web/template/loanui/manifest.json', $pageId, 'pageAuth') == 'ok'){
$uploadData = json_decode($app->upload(['jpg', 'jpeg', 'png', 'JPG', 'JPEG'], 'core/images/custom/', 'pGdisplay', 'base64'), true);
if($uploadData['status'] == 'ok'){ $custom->replaceMnf($uploadData['message'], '../../../web/template/loanui/manifest.json', $pageId, 'pageImg'); }
if($pageContent == 'text'){
$pageImg = json_decode($app->upload(['jpg', 'jpeg', 'png', 'JPG', 'JPEG'], 'core/images/custom/', 'pageImg', 'base64'), true);
if($pageImg['status'] == 'ok'){ $mysqli->custom("UPDATE pages SET pageImg = '".$pageImg['message']."' WHERE pageId = '".$pageId."'", 'update'); }
$pageImg2 = json_decode($app->upload(['jpg', 'jpeg', 'png', 'JPG', 'JPEG'], 'core/images/custom/', 'pageImg2', 'base64'), true);
if($pageImg2['status'] == 'ok'){ $mysqli->custom("UPDATE pages SET pageImg2 = '".$pageImg2['message']."' WHERE pageId = '".$pageId."'", 'update'); }
$pageImg3 = json_decode($app->upload(['jpg', 'jpeg', 'png', 'JPG', 'JPEG'], 'core/images/custom/', 'pageImg3', 'base64'), true);
if($pageImg3['status'] == 'ok'){ $mysqli->custom("UPDATE pages SET pageImg3 = '".$pageImg3['message']."' WHERE pageId = '".$pageId."'", 'update'); }
$pageImg4 = json_decode($app->upload(['jpg', 'jpeg', 'png', 'JPG', 'JPEG'], 'core/images/custom/', 'pageImg4', 'base64'), true);
if($pageImg4['status'] == 'ok'){ $mysqli->custom("UPDATE pages SET pageImg4 = '".$pageImg4['message']."' WHERE pageId = '".$pageId."'", 'update'); }
$pageImg5 = json_decode($app->upload(['jpg', 'jpeg', 'png', 'JPG', 'JPEG'], 'core/images/custom/', 'pageImg5', 'base64'), true);
if($pageImg5['status'] == 'ok'){ $mysqli->custom("UPDATE pages SET pageImg5 = '".$pageImg5['message']."' WHERE pageId = '".$pageId."'", 'update'); }
$mysqli->custom("UPDATE pages SET pageTxt = '$pageTxt', pageTxt2 = '$pageTxt2', pageTxt3 = '$pageTxt3', pageTxt4 = '$pageTxt4', pageTxt5 = '$pageTxt5', pageType = 'text' WHERE pageId = '".$pageId."'", 'update');
}elseif($pageContent == 'html'){
$mysqli->custom("UPDATE pages SET pageHtml = '$pageTxtHtml', pageType = 'html' WHERE pageId = '".$pageId."'", 'update');
}
	echo 0;
}else{
	echo "<font style='color:red;'>Filed to update page Auth</font>"; 
}
}else{
	echo "<font style='color:red;'>Filed to update page description</font>"; 
}
}else{
	echo "<font style='color:red;'>Filed to update page title</font>"; 
}
print_r($replaceTitle);
  
}


if(isset($_FILES['prevImg'])){
$uploadData = json_decode($app->upload(['jpg', 'jpeg', 'png'], 'core/images/custom/', 'prevImg', 'base64'), true);
if($uploadData['status'] == 'ok'){
	echo $uploadData['message'];
}else{
	echo 1;
}
exit;
}

if(isset($_POST['filesAppId'])){
if($app->checkParameter($_POST["filesAppId"], 'number') == 'pass'){
	$filesAppId = $_POST['filesAppId'];
}else{
	$CPreport = 'filesAppId '.$app->checkParameter($_POST["filesAppId"], 'number');
}
if($CPreport !== ''){
	echo "<font style='background:red;color:#fff;padding:10px;'>$CPreport</font>";
	exit;
}
$psh = "SELECT * FROM processhistory WHERE appId = '$filesAppId'";
			$psh_data = $dbObj->query_execute($psh);
				while($psHistory = $psh_data->fetch_assoc()) {
					$pshUserC = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/linklist.htm');
					$base64info = json_decode($app->mkBase64File($psHistory['respFile']), true);
					if($psHistory['respType'] == 'userUpload'){
					$pshUser .= str_replace(
					array("%title%","%file%","%mimeType%","%date%"),
					array(str_replace(' ', '', $psHistory['respTitle']), $base64info['data'], $base64info['mimeType'], $psHistory['respDate']),
					$pshUserC
					);
					}else{
					$pshAdm .= str_replace(
					array("%title%","%file%","%mimeType%","%date%"),
					array(str_replace(' ', '', $psHistory['respTitle']), $base64info['data'], $base64info['mimeType'], $psHistory['respDate']),
					$pshUserC
					);
					}
				}
				echo "<strong>My Documents</strong><br/>$pshAdm<hr/><strong>Client Documents</strong><br/>$pshUser";
		exit;		
}

if(isset($_POST['uploadFilesId'])){
if($app->checkParameter($_POST["uploadFilesId"], 'number') == 'pass'){
	$uploadFilesId = $_POST['uploadFilesId'];
}else{
	$CPreport = 'uploadFilesId '.$app->checkParameter($_POST["uploadFilesId"], 'number');
}
if($app->checkParameter($_POST["usrMobile"], 'number') == 'pass'){
	$usrMobile = $_POST['usrMobile'];
}else{
	$CPreport = 'usrMobile '.$app->checkParameter($_POST["usrMobile"], 'number');
}
if($app->checkParameter($_POST["usrName"], 'string') == 'pass'){
	$usrName = $_POST['usrName'];
}else{
	$CPreport = 'usrName '.$app->checkParameter($_POST["usrName"], 'string');
}
if($CPreport !== ''){
	echo "<font style='background:red;color:#fff;padding:10px;'>$CPreport</font>";
	exit;
}
$req_query = "SELECT * FROM applications WHERE appId = '$uploadFilesId' and loanStatus = 'processing' or loanStatus = 'approved'";
			$req_data = $dbObj->query_execute($req_query);
			$req_count = $dbObj->query_rowCount($req_data);
				if ($req_count == 0) {
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Failed to upload.</div>";
}else{
$uploadData = json_decode($app->upload(['jpg', 'jpeg', 'png', 'doc', 'pdf', 'docx', 'xls'], 'core/images/custom/', 'uploadFiles', 'base64'), true);
if($uploadData['status'] == 'ok'){
if($mysqli->insertInto('processhistory',array('appId' => $uploadFilesId, 'respType' => 'adminUpload', 'respFile' => $uploadData['message'], 'respTitle' => $uploadData['fileName'])) == 'done'){	
$processUpdate = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/sms/processUpdateUser.txt');
$processUpdate = str_replace("%siteName%", APP_NAME, $processUpdate);
$processUpdate = str_replace("%userName%", $usrName, $processUpdate);
if($custom->sendSMS($usrMobile, $processUpdate, KEY0, KEY1, KEY2) == 'sent'){
echo 0;
exit;
}
}else{
echo "<font style='color:red;'>Failed to upload file</font>";
}
}else{
	echo "<font style='color:red;'>".$uploadData['message']."</font>";
}
}
exit;
}

if(isset($_POST['address'])){
if($app->checkParameter($_POST["address"], 'string') == 'pass'){
	$address = $_POST['address'];
}else{
	$CPreport = 'address '.$app->checkParameter($_POST["address"], 'string');
}
if($app->checkParameter($_POST["phone"], 'string') == 'pass'){
	$phone = $_POST['phone'];
}else{
	$CPreport = 'phone '.$app->checkParameter($_POST["phone"], 'string');
}
if($app->checkParameter($_POST["email"], 'string') == 'pass'){
	$email = $_POST['email'];
}else{
	$CPreport = 'email '.$app->checkParameter($_POST["email"], 'string');
}
if($app->checkParameter($_POST["hours"], 'string') == 'pass'){
	$hours = $_POST['hours'];
}else{
	$CPreport = 'hours '.$app->checkParameter($_POST["hours"], 'string');
}
if($app->checkParameter($_POST["shortAbout"], 'string') == 'pass'){
	$shortAbout = $_POST['shortAbout'];
}else{
	$CPreport = 'shortAbout '.$app->checkParameter($_POST["shortAbout"], 'string');
}
if($app->checkParameter($_POST["twitter"], 'string') == 'pass'){
	$twitter = $_POST['twitter'];
}else{
	$CPreport = 'twitter '.$app->checkParameter($_POST["twitter"], 'string');
}
if($app->checkParameter($_POST["facebook"], 'string') == 'pass'){
	$facebook = $_POST['facebook'];
}else{
	$CPreport = 'facebook '.$app->checkParameter($_POST["facebook"], 'string');
}
if($app->checkParameter($_POST["instagram"], 'string') == 'pass'){
	$instagram = $_POST['instagram'];
}else{
	$CPreport = 'instagram '.$app->checkParameter($_POST["instagram"], 'string');
}
if($app->checkParameter($_POST["android"], 'string') == 'pass'){
	$android = $_POST['android'];
}else{
	$CPreport = 'android '.$app->checkParameter($_POST["android"], 'string');
}
if($app->checkParameter($_POST["ios"], 'string') == 'pass'){
	$ios = $_POST['ios'];
}else{
	$CPreport = 'ios '.$app->checkParameter($_POST["ios"], 'string');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
$logo = json_decode($app->upload(['jpg', 'jpeg', 'png'], 'core/images/custom/', 'logo', 'base64'), true);
if($logo['status'] == 'ok'){ $mysqli->custom("UPDATE config SET configValue = '".$logo['message']."' WHERE configProperty = 'logo'", 'update'); }
$mysqli->custom("UPDATE config SET configValue = '".$address."' WHERE configProperty = 'address'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$phone."' WHERE configProperty = 'phone'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$email."' WHERE configProperty = 'email'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$hours."' WHERE configProperty = 'hours'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$shortAbout."' WHERE configProperty = 'shortAbout'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$twitter."' WHERE configProperty = 'twitter'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$facebook."' WHERE configProperty = 'facebook'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$instagram."' WHERE configProperty = 'instagram'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$android."' WHERE configProperty = 'UrlAndroid'", 'update');
$mysqli->custom("UPDATE config SET configValue = '".$ios."' WHERE configProperty = 'UrlIos'", 'update');
echo 0;
exit;
}

if (isset($_POST['approvereqId'])) {
if($app->checkParameter($_POST["approvereqId"], 'string') == 'pass'){
	$approvereqId = $_POST['approvereqId'];
}else{
	$CPreport = 'approvereqId '.$app->checkParameter($_POST["approvereqId"], 'string');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
$req_query = "SELECT * FROM applications WHERE appId = '$approvereqId' and loanStatus = 'processing'";
			$req_data = $dbObj->query_execute($req_query);
			$req_count = $dbObj->query_rowCount($req_data);
				if ($req_count == 0) {
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Request status failed to update.</div>";
}else{
$upd_sql = "UPDATE applications SET loanStatus = 'approved' WHERE appId = '$approvereqId'";
if($dbObj->query_execute($upd_sql)){
	$usrdata =  $mysqli->multiSelect(array('userdata' => 'u' , 'applications' => 'a'),array('u.userID' => 'a.usrID' , 'a.appId' => ''.$approvereqId.''), 'fetch', '');
$approved = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/sms/status.txt');
$approved = str_replace("%siteName%", APP_NAME, $approved);
$approved = str_replace("%status%", 'approved', $approved);
$approved = str_replace("%userName%", $usrdata[0]['lastName'], $approved);
$approved = str_replace("%amount%", number_format($usrdata[0]['amount']).' USD', $approved);
if($custom->sendSMS($usrdata[0]['phoneNumber'], $approved, KEY0, KEY1, KEY2) == 'sent'){
echo 0;
exit;
}
	}else{
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Failed to update</div>";
  }
}
}

if (isset($_POST['ApprovalFilesId'])) {
if($app->checkParameter($_POST["ApprovalFilesId"], 'string') == 'pass'){
	$ApprovalFilesId = $_POST['ApprovalFilesId'];
}else{
	$CPreport = 'ApprovalFilesId '.$app->checkParameter($_POST["ApprovalFilesId"], 'string');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
$req_query = "SELECT * FROM applications WHERE appId = '$ApprovalFilesId' and loanStatus = 'processing'";
			$req_data = $dbObj->query_execute($req_query);
			$req_count = $dbObj->query_rowCount($req_data);
				if ($req_count == 0) {
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Request status failed to update.</div>";
}else{
$uploadData = json_decode($app->upload(['jpg', 'jpeg', 'png', 'doc', 'pdf', 'docx', 'xls'], 'core/images/custom/', 'ApprovalFiles', 'base64'), true);
if($uploadData['status'] == 'ok'){
if($mysqli->insertInto('processhistory',array('appId' => $ApprovalFilesId, 'respType' => 'adminUpload', 'respFile' => $uploadData['message'], 'respTitle' => $uploadData['fileName'])) == 'done'){
$upd_sql = "UPDATE applications SET loanStatus = 'approved' WHERE appId = '$ApprovalFilesId'";
if($dbObj->query_execute($upd_sql)){
	$usrdata =  $mysqli->multiSelect(array('userdata' => 'u' , 'applications' => 'a'),array('u.userID' => 'a.usrID' , 'a.appId' => ''.$ApprovalFilesId.''), 'fetch', '');
$approved = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/sms/status.txt');
$approved = str_replace("%siteName%", APP_NAME, $approved);
$approved = str_replace("%status%", 'approved', $approved);
$approved = str_replace("%userName%", $usrdata[0]['lastName'], $approved);
$approved = str_replace("%amount%", number_format($usrdata[0]['amount']).' USD', $approved);
if($custom->sendSMS($usrdata[0]['phoneNumber'], $approved, KEY0, KEY1, KEY2) == 'sent'){
echo 0;
exit;
}
	}else{
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Failed to update</div>";
  }
}else{
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Failed to update</div>";
  }
}else{
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Failed to upload document</div>";
  }
}
}

if (isset($_POST['declineReqId'])) {
if($app->checkParameter($_POST["declineReqId"], 'string') == 'pass'){
	$declineReqId = $_POST['declineReqId'];
}else{
	$CPreport = 'declineReqId '.$app->checkParameter($_POST["declineReqId"], 'string');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
$req_query = "SELECT * FROM applications WHERE appId = '$declineReqId' and loanStatus = 'processing'";
			$req_data = $dbObj->query_execute($req_query);
			$req_count = $dbObj->query_rowCount($req_data);
				if ($req_count == 0) {
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Request status failed to update.</div>";
}else{
$upd_sql = "UPDATE applications SET loanStatus = 'declined' WHERE appId = '$declineReqId'";
if($dbObj->query_execute($upd_sql)){
	$usrdata =  $mysqli->multiSelect(array('userdata' => 'u' , 'applications' => 'a'),array('u.userID' => 'a.usrID' , 'a.appId' => ''.$declineReqId.''), 'fetch', '');
$declined = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/sms/status.txt');
$declined = str_replace("%siteName%", APP_NAME, $declined);
$declined = str_replace("%status%", 'declined', $declined);
$declined = str_replace("%userName%", $usrdata[0]['lastName'], $declined);
$declined = str_replace("%amount%", number_format($usrdata[0]['amount']).' USD', $declined);
if($custom->sendSMS($usrdata[0]['phoneNumber'], $declined, KEY0, KEY1, KEY2) == 'sent'){
echo 0;
exit;
}
	}else{
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Failed to update</div>";
  }
}
}

if (isset($_POST['deleteReqId'])) {
if($app->checkParameter($_POST["deleteReqId"], 'string') == 'pass'){
	$deleteReqId = $_POST['deleteReqId'];
}else{
	$CPreport = 'deleteReqId '.$app->checkParameter($_POST["deleteReqId"], 'string');
}

if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
$usrData = $mysqli->singleSelect('applications', array('appId' => $deleteReqId), 'fetch', '');
$del_sql = "DELETE FROM applications WHERE appId = '$deleteReqId'";
$del_sql2 = "DELETE FROM userdata WHERE userID = '".$usrData[0]['usrID']."'";
$del_sql3 = "DELETE FROM accounts WHERE id = '".$usrData[0]['usrID']."'";
$del_sql4 = "DELETE FROM address WHERE userID = '".$usrData[0]['usrID']."'";
if($dbObj->query_execute($del_sql) && $dbObj->query_execute($del_sql2) && $dbObj->query_execute($del_sql3) && $dbObj->query_execute($del_sql4)){
		echo 0;
	}else{
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> Command not successfull</div>";
  }

}
?>