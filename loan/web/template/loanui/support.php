<?php 
require_once "../../core/config.php";
$page = $cont[6]['pageId'];
?>
    <!-- page-header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="page-section">
                        <h1 class="page-title"><?php echo $cont[6]['pageTxt']; ?></h1>
                        <p><?php echo $cont[6]['pageTxt2']; ?></p>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 hidden-xs">
                    <div class="vertical-line"></div>
                </div>
                <div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                    <div class="page-btn"> 
              <input class="form-control shadow-none border-0" type="search" id="search-input" placeholder="Search for answer..." onkeyup="searchFaqCat();">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
	
  
  <!-- Content
  ============================================= -->
  <div id="content">
    
    <!-- Main Topics
    ============================================= -->
    <section class="section py-3 my-3 py-sm-5 my-sm-5" style="padding-top:10px;" id="faqdashboard">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
            <div class="bg-light shadow-sm rounded p-4 text-center text-primary"> <span style="font-size:60px;"><i class="fa fa-user-circle"></i></span>
              <h3 class="text-body text-4">My Account</h3>
              <p class="mb-0"><a class="text-muted btn-link" onclick="loadFaqCat('account')" href="javascript:void(0);">See articles<span class="text-1 ml-1"><i class="fa fa-chevron-right"></i></span></a></p>
            </div>
          </div>
		  <div class="col-sm-6 col-lg-4">
            <div class="bg-light shadow-sm rounded p-4 text-center text-primary"> <span style="font-size:60px;"><i class="fa fa-credit-card"></i></span>
              <h3 class="text-body text-4">Payment</h3>
              <p class="mb-0"><a class="text-muted btn-link" onclick="loadFaqCat('payment')" href="javascript:void(0);">See articles<span class="text-1 ml-1"><i class="fa fa-chevron-right"></i></span></a></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 mb-4 mb-sm-0">
            <div class="bg-light shadow-sm rounded p-4 text-center text-primary"> <span style="font-size:60px;"><i class="fa fa-shield"></i></span>
              <h3 class="text-body text-4">Security</h3>
              <p class="mb-0"><a class="text-muted btn-link" onclick="loadFaqCat('security')" href="javascript:void(0);">See articles<span class="text-1 ml-1"><i class="fa fa-chevron-right"></i></span></a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Main Topics end -->
    
    <!-- Popular Topics
    ============================================= -->
    <section class="section" style="padding-top:10px;">
      <div class="container" id="FAQsearch"></div>
      <div class="container" id="FAQpanel"></div>
    </section>
    <!-- Popular Topics end -->
    <br/><br/><br/><center>
			  <h2 style="color:#000;"><?php echo $cont[6]['pageTxt3']; ?></h2>
			  <p style="color:#000;"><?php echo $cont[6]['pageTxt4']; ?> <a href="#" onclick="page('contact')"><b>Contact us</b></a></p>
			  </center>
  </div>
  <!-- Content end --> 
  <br/><br/>