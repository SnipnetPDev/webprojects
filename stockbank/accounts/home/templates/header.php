<?php
include("../auth.php");
include_once '../db/index.php';
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
<?php
$count=1;
$sel_query="Select * from settings ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<title><?php echo $row["title"]; ?></title>
<?php $count++; } ?>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <!-- page stylesheets -->
  <!-- end page stylesheets -->
  <!-- build:css({.tmp,app}) styles/app.min.css -->
  <link rel="stylesheet" href="../../styles/webfont.css">
  <link rel="stylesheet" href="../../styles/climacons-font.css">
  <link rel="stylesheet" href="../../vendor/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="../../styles/font-awesome.css">
  <link rel="stylesheet" href="../../styles/card.css">
  <link rel="stylesheet" href="../../styles/sli.css">
  <link rel="stylesheet" href="../../styles/animate.css">
  <link rel="stylesheet" href="../../styles/app.css">
  <link rel="stylesheet" href="../../styles/app.skins.css">
  <!-- endbuild -->
</head>
<script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 

</script>
<body class="page-loading">
  <!-- page loading spinner -->
  <div class="pageload">
    <div class="pageload-inner">
      <div class="sk-rotating-plane"></div>
    </div>
  </div>
  <!-- /page loading spinner -->
  <div class="app layout-fixed-header">
    <!-- sidebar panel -->
    <div class="sidebar-panel offscreen-left">
      <div class="brand">

        <!-- logo -->
        <a class="brand-logo">
          <img src="assets/img/logo.png" Alt="" width="125px" height="50px"/>
        </a>
        <!-- /logo -->
      </div>
	  
	 
      <!-- main navigation -->
      <nav role="navigation">
        <ul class="nav">
		<br/><br/>
		
          <li>
           <!-- GTranslate: https://gtranslate.io/ -->
<style type="text/css">
<!--
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
.goog-te-gadget-icon {background-image:url(//gtranslate.net/flags/gt_logo_19x19.gif) !important;background-position:0 0 !important;}
body {top:0 !important;}
-->
</style>
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay: false, includedLanguages: ''}, 'google_translate_element');}
</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
          </li>
          <li>
            <a href="index.php">
              <i class="fa fa-external-link"></i>
              <span>Summary</span>
            </a>
          </li>
		    <li>
            <a href="cards.php">
              <i class="fa fa-external-link"></i>
              <span>Linked Cards</span>
            </a>
          </li>
                   <li> <a href="acc_request.php">
				   <i class="fa fa-external-link"></i>
				  <span> Request Center</span>
				   </a></li>

                  <li>  <a href="close.php">
				  <i class="fa fa-external-link"></i>
				 <span> Close Account</span>
				  </a></li>
				 
				  
				   <li>  <a href="help.php">
				  <i class="fa fa-external-link"></i>
				 <span> Help</span>
				  </a></li>
				  <br/><br/>
		  <center> 

    <!-- #region Jssor Slider Begin -->
    <script src="slide/jssor.slider-24.0.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideWidth: 1000,
              $Cols: 2,
              $Align: 100,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1000);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <style>
        /* jssor slider bullet navigator skin 01 css */
        /*
        .jssorb01 div           (normal)
        .jssorb01 div:hover     (normal mouseover)
        .jssorb01 .av           (active)
        .jssorb01 .av:hover     (active mouseover)
        .jssorb01 .dn           (mousedown)
        */
        .jssorb01 {
            position: absolute;
        }
        .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
            position: absolute;
            /* size of bullet elment */
            width: 12px;
            height: 12px;
            filter: alpha(opacity=70);
            opacity: .7;
            overflow: hidden;
            cursor: pointer;
            border: #000 1px solid;
        }
        .jssorb01 div { background-color: gray; }
        .jssorb01 div:hover, .jssorb01 .av:hover { background-color: #d3d3d3; }
        .jssorb01 .av { background-color: #fff; }
        .jssorb01 .dn, .jssorb01 .dn:hover { background-color: #555555; }

        /* jssor slider arrow navigator skin 13 css */
        /*
        .jssora13l                  (normal)
        .jssora13r                  (normal)
        .jssora13l:hover            (normal mouseover)
        .jssora13r:hover            (normal mouseover)
        .jssora13l.jssora13ldn      (mousedown)
        .jssora13r.jssora13rdn      (mousedown)
        .jssora13l.jssora13lds      (disabled)
        .jssora13r.jssora13rds      (disabled)
        */
        .jssora13l, .jssora13r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 50px;
            cursor: pointer;
            background: url('slide/a13.png') no-repeat;
            overflow: hidden;
        }
        .jssora13l { background-position: -10px -35px; }
        .jssora13r { background-position: -70px -35px; }
        .jssora13l:hover { background-position: -130px -35px; }
        .jssora13r:hover { background-position: -190px -35px; }
        .jssora13l.jssora13ldn { background-position: -250px -35px; }
        .jssora13r.jssora13rdn { background-position: -310px -35px; }
        .jssora13l.jssora13lds { background-position: -10px -35px; opacity: .3; pointer-events: none; }
        .jssora13r.jssora13rds { background-position: -70px -35px; opacity: .3; pointer-events: none; }
    </style>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:130px;height:300px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('slide/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:130px;height:300px;overflow:hidden;">
            <div>
                <img data-u="image" src="slide/002.jpg" />
            </div>
            <div>
                <img data-u="image" src="slide/003.jpg" />
            </div>
            <div>
                <img data-u="image" src="slide/004.jpg" />
            </div>
            <div>
                <img data-u="image" src="slide/005.jpg" />
            </div>
            <div>
                <img data-u="image" src="slide/006.jpg" />
            </div>
            <div>
                <img data-u="image" src="slide/007.jpg" />
            </div>
            <div>
                <img data-u="image" src="slide/008.jpg" />
            </div>
            <div>
                <img data-u="image" src="slide/009.jpg" />
            </div>
        </div>

        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora13r" style="top:0px;left:30px;width:40px;height:50px;" data-autocenter="2"></span>
       
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>

	</center>
        </ul>
      </nav>
      <!-- /main navigation -->
    </div>
    <!-- /sidebar panel -->
    <!-- content panel -->
    <div class="main-panel">
      <!-- top header -->
      <div class="header navbar">
	  <ul class="nav navbar-nav navbar-left visible-xs">
<li> <a class="brand navbar-brand" href="index.php"><img src="assets/img/logo.png" Alt="" width="102px" height="26px"/></a>
	  </li>
	  </ul>
        <div class="brand visible-xs navbar-right">
		
			<?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>
	<a href="help.php"><span class="bg-<?php echo $row["a_status_color"]; ?>" style=" padding:3px;"><?php echo $row["account_status"]; ?></span></a>
<?php } 
else {  ?>
<span class="bg-info" style="color:white; padding:3px; font-family:tahoma;">NOT SETUP</span>
<?php
}
?>
			   
<a href="javascript:;" class="ripple" data-toggle="dropdown" style="color:#fff;">
              <span><?php echo $_SESSION['usr_name']; ?></span>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
<li><a href="index.php">Summary</a> </li>
<li><a href="activity.php">Activity</a> </li> 
<li><a href="transfers.php">Transfers</a> </li>
<li><a href="cards.php">Cards</a></li>
              <li>
                <a href="settings.php">Settings</a>
              </li>

              <li role="separator" class="divider"></li>
              <li>
                <a href="help.php">Help</a>
              </li>
              <li>
                <a href="../../logout.php">Logout</a>
              </li>
            </ul>
        </div>
        <ul class="nav navbar-nav hidden-xs">
          <li>
            <a href="help.php"  >
              <?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>
	<span class="bg-<?php echo $row["a_status_color"]; ?>" style=" padding:3px;"><?php echo $row["account_status"]; ?></span>
<?php } 
else {  ?>
<span class="bg-info" style="color:white; padding:3px; font-family:tahoma;">NOT SETUP</span>
<?php
}
?>
            </a>
          </li>

        </ul>
        <ul class="nav navbar-nav navbar-right hidden-xs">
<li> <a class="brand navbar-brand" href="index.php">Summary</a> </li>
<li><a class="brand navbar-brand" href="activity.php">Activity</a> </li>
<li><a class="brand navbar-brand" href="transfers.php">Transfers</a> </li>
<li><a class="brand navbar-brand" href="cards.php">Cards</a> </li>
		  
		       <li>
                <a href="acc_upgrade.php">Upgrade Account</a>
              </li>
          <li>
            <a href="javascript:;" class="ripple" data-toggle="dropdown">
			<?php
$imageU = $_SESSION['imgname'];
$image_src = "assets/img/DP/".$imageU;
?>
              <img src="<?php echo $image_src;  ?>" class="header-avatar img-circle" alt="user" title="user">
              <span><?php echo $_SESSION['usr_name']; ?></span>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="settings.php">Settings</a>
              </li>

              <li role="separator" class="divider"></li>
              <li>
                <a href="help.php">Help</a>
              </li>
              <li>
                <a href="../../logout.php">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
<?php
$count=1;
$sel_query="Select * from settings ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {
$Brouting_no=$row['routing_no'];
$count++; 
} 
?>
      <!-- /top header -->
	  <!-- main area -->
	  <div class="main-content">