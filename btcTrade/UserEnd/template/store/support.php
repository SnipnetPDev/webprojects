     <div class="subheader">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="subheader-wrapper">
                        <h3>How can we help you?</h3>
                        <p>
                           Our customer service is available 24/7.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sub-header -->
  <!-- Page Header
  ============================================= -->
  <br/><br/>
  <section class="hero-wrap section">
    <div class="hero-content">
      <div class="container">
        <div class="row align-items-center text-center">
          <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
            <div class="input-group">
              <input class="form-control shadow-none border-0" type="search" id="search-input" placeholder="Search for answer..." onkeyup="searchFaqCat();">
              <div class="input-group-append"> <span class="input-group-text bg-white border-0 p-0">
                <button class="btn text-muted px-3 border-0" type="button"><i class="fa fa-search"></i></button>
                </span> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Page Header end --> 
  
  <!-- Content
  ============================================= -->
  <div id="content">
    
    <!-- Main Topics
    ============================================= -->
    <section class="section py-3 my-3 py-sm-5 my-sm-5" id="faqdashboard">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
            <div class="bg-light shadow-sm rounded p-4 text-center"> <span class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-user-circle"></i></span>
              <h3 class="text-body text-4">My Account</h3>
              <p class="mb-0"><a class="text-muted btn-link" onclick="loadFaqCat('account')" href="javascript:void(0);">See articles<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
            </div>
          </div>
		  <div class="col-sm-6 col-lg-4">
            <div class="bg-light shadow-sm rounded p-4 text-center"> <span class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-credit-card"></i></span>
              <h3 class="text-body text-4">Payment</h3>
              <p class="mb-0"><a class="text-muted btn-link" onclick="loadFaqCat('payment')" href="javascript:void(0);">See articles<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 mb-4 mb-sm-0">
            <div class="bg-light shadow-sm rounded p-4 text-center"> <span class="d-block text-17 text-primary mt-2 mb-3"><i class="fas fa-shield-alt"></i></span>
              <h3 class="text-body text-4">Security</h3>
              <p class="mb-0"><a class="text-muted btn-link" onclick="loadFaqCat('security')" href="javascript:void(0);">See articles<span class="text-1 ml-1"><i class="fas fa-chevron-right"></i></span></a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Main Topics end -->
    
    <!-- Popular Topics
    ============================================= -->
    <section class="section">
      <div class="container" id="FAQsearch"></div>
      <div class="container" id="FAQpanel"></div>
    </section>
    <!-- Popular Topics end -->
    
  </div>
  <!-- Content end --> 
  <br/><br/>