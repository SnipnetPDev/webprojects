<?PHP
session_start();
require_once "../config.php";
require "../http_security.php";
$dbObj = new DB();
$CPreport = '';
if(isset($_POST["popularFAQ"])){
	$leftRow = '';
	$rightRow = '';
	$faq_q = "SELECT * FROM faq ORDER by RAND() LIMIT 5";
			$faq_data = $dbObj->query_execute($faq_q);
			while($faqD = $faq_data->fetch_assoc()) {
				$leftRow .= '<div class="card">
                    <div class="card-header" id="Lheading'.$faqD["faq_id"].'">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#L'.$faqD["faq_id"].'" aria-expanded="false" aria-controls="L'.$faqD["faq_id"].'">'.$faqD["faq_title"].'</a> </h5>
                    </div>
                    <div id="L'.$faqD["faq_id"].'" class="collapse" aria-labelledby="Lheading'.$faqD["faq_id"].'" data-parent="#popularTopics">
                      <div class="card-body">'.$faqD["faq_desc"].'</div>
                    </div>
                  </div>';
				}
				
	$faq_q2 = "SELECT * FROM faq ORDER by RAND() LIMIT 5";
			$faq_data2 = $dbObj->query_execute($faq_q2);
			while($faqD2 = $faq_data2->fetch_assoc()) {
				$rightRow .= '<div class="card">
                    <div class="card-header" id="Rheading'.$faqD2["faq_id"].'">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#R'.$faqD2["faq_id"].'" aria-expanded="false" aria-controls="R'.$faqD2["faq_id"].'">'.$faqD2["faq_title"].'</a> </h5>
                    </div>
                    <div id="R'.$faqD2["faq_id"].'" class="collapse" aria-labelledby="Rheading'.$faqD2["faq_id"].'" data-parent="#popularTopics">
                      <div class="card-body">'.$faqD2["faq_desc"].'</div>
                    </div>
                  </div>';
				}
				  
	$faq = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/faq.htm');
	$faq = str_replace("%left_row%", $leftRow, $faq); 
	$faq = str_replace("%right_row%", $rightRow, $faq);
	
	echo $faq;
}
if(isset($_POST["FAQcatID"])){
if($app->checkParameter($_POST["FAQcatID"], 'string') == 'pass'){
	$FAQcatID = $_POST["FAQcatID"];
}else{
	$CPreport = 'FAQcatID '.$app->checkParameter($_POST["FAQcatID"], 'string');
}
if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
	$faqrow = '';
	$faq_q = "SELECT * FROM faq WHERE faq_cat = '$FAQcatID' ORDER by RAND()";
			$faq_data = $dbObj->query_execute($faq_q);
			while($faqD = $faq_data->fetch_assoc()) {
				$faqrow .= '<div class="card">
                    <div class="card-header" id="Lheading'.$faqD["faq_id"].'">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#L'.$faqD["faq_id"].'" aria-expanded="false" aria-controls="L'.$faqD["faq_id"].'">'.$faqD["faq_title"].'</a> </h5>
                    </div>
                    <div id="L'.$faqD["faq_id"].'" class="collapse" aria-labelledby="Lheading'.$faqD["faq_id"].'" data-parent="#popularTopics">
                      <div class="card-body">'.$faqD["faq_desc"].'</div>
                    </div>
                  </div>';
				}

	$faq = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/faqcategory.htm');
	$faq = str_replace("%cat_title%", $FAQcatID, $faq); 
	$faq = str_replace("%faq_row%", $faqrow, $faq);
	
	echo $faq;
}
if(isset($_POST["FAQsearch"])){
if($app->checkParameter($_POST["FAQsearch"], 'string') == 'pass'){
	$FAQsearch = $_POST["FAQsearch"];
}else{
	$CPreport = 'Search Keywords '.$app->checkParameter($_POST["FAQsearch"], 'string');
}
if($CPreport !== ''){
	echo "<div class='alert alert-warning' role='alert'><i class='fa fa-exclamation-triangle'></i> $CPreport</div>";
	exit;
}
	$faqrow = '';
	$faq_q = "SELECT * FROM faq WHERE faq_title LIKE '%" . $FAQsearch . "%' ORDER by RAND()";
			$faq_data = $dbObj->query_execute($faq_q);
			while($faqD = $faq_data->fetch_assoc()) {
				$faqrow .= '<div class="card">
                    <div class="card-header" id="Lheading'.$faqD["faq_id"].'">
                      <h5 class="mb-0"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#L'.$faqD["faq_id"].'" aria-expanded="false" aria-controls="L'.$faqD["faq_id"].'">'.$faqD["faq_title"].'</a> </h5>
                    </div>
                    <div id="L'.$faqD["faq_id"].'" class="collapse" aria-labelledby="Lheading'.$faqD["faq_id"].'" data-parent="#popularTopics">
                      <div class="card-body">'.$faqD["faq_desc"].'</div>
                    </div>
                  </div>';
				}

	$faq = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/faqsearch.htm');
	$faq = str_replace("%cat_title%", $FAQsearch, $faq); 
	$faq = str_replace("%faq_row%", $faqrow, $faq);
	
	echo $faq;
}
?>