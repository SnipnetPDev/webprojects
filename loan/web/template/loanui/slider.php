    <!-- slider-start -->
    <div class="slider">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="slider-img"> <img src="data:image<?php echo $template_manifest->$page->pageImg; ?>" alt=""></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="slider-captions">
                                <h1 class="slider-title"><?php echo $template_manifest->$page->pageTitle; ?></h1>
                                <p class="slider-text hidden-sm hidden-xs"<?php echo $template_manifest->$page->pageDesc; ?>
                                </p>
                                <a href="#" onclick="page('about')" class="btn btn-primary btn-lg hidden-sm hidden-xs">find out more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- 
            <div class="item">
                <div class="slider-img"><img src="http://localhost/loan/web/<?php echo APP_TROUTE.APP_THEME; ?>/images/slider-3.jpg" alt=""></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6  col-xs-12">
                            <div class="slider-captions">
                                <h1 class="slider-title">Loan free template, A good 
quality templatet</h1>
                                <p class="slider-text hidden-sm hidden-xs">Try our a good design template for your loan company. </p>
                                <a href="#" class="btn btn-primary btn-lg hidden-sm hidden-xs">Find out more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			-->
        </div>
    </div>
	<br/>
    <!-- /.slider -->
	<script type="text/javascript" src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/js/slider.js"></script>