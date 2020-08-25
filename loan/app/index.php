<?php 
require_once "core/config.php"; //Import configuration
if(isset($_REQUEST['page'])){
$CPreport = '';
$notFound = 404;
if($app->checkParameter($_REQUEST["page"], 'string') == 'pass'){
	$page = pathinfo($_REQUEST["page"], PATHINFO_FILENAME);;
}else{
	$CPreport = $app->checkParameter($_REQUEST["page"], 'string');
}
if($CPreport !== ''){
	echo $CPreport;
	exit;
}
if($page == 'head' or $page == 'header' or $page == 'foot' or $page == 'footer' or $page == 'noaccess' or $page == 'noauth'){ header('location: '.APP_URL.'404'); exit; }
if(empty($template_manifest->$page->pageTitle)){ $page = 404; }
define('TITLE', $template_manifest->$page->pageTitle); //Set page title
define('DESC', $template_manifest->$page->pageDesc); //Set page description
echo '<!DOCTYPE html><html lang="en">';
include APP_TROUTE.APP_THEME.'/head'.APP_THEME_EXT;

//template content start
echo '<div id="appLoader"></div>';
echo '<div id="NestLoader"></div>';
echo '<div id="content"></div>';
//template content end

include APP_TROUTE.APP_THEME.'/foot'.APP_THEME_EXT;
echo "<script>timeout = setTimeout(page('$page'), 180);</script>";
echo "</html>";
}else{
	header('location: '.APP_URL.APP_INDEX);
}
 ?>