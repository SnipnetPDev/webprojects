<?php 
require_once "../../core/config.php";
$rcnt = 0;
$page = $cont[3]['pageId'];
?>
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
                                <p class="slider-text hidden-sm hidden-xs"><?php echo $template_manifest->$page->pageDesc; ?>
                                </p>
                                <a href="#" onclick="page('about')" class="btn btn-primary btn-lg hidden-sm hidden-xs">find out more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
	<br/>
    <!-- /.slider -->
    <!-- how it works -->
    <div class="space-small">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="process-text">
                        <h3>How It Works</h3>
                        <p>Here are 3 easy steps to get your urgent Loans.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="process-head">
                        <div class="process-icon"><i class="icon-notepad"></i></div>
                        <h4>Complete Application<br> Form</h4>
                        <div class="process-arrow"><i class=" icon-next-10"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="process-head">
                        <div class="process-icon"><i class="icon-clock"></i></div>
                        <h4>Get Intial Approval in<br> 
Minutes</h4>
                        <div class="process-arrow"><i class=" icon-next-10"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="process-head">
                        <div class="process-icon"><i class="icon-bank"></i></div>
                        <h4>Funds wired to 
Your <br>bank account</h4>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb0">
        <!-- /.how it works -->
        <!-- product-section -->
        <div class="space-medium">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="section-title">
                            <!-- section title-->
                            <h2>Our Lending Program</h2>
                        </div>
                        <!-- /.section title-->
                    </div>
                </div>
                <div class="row">
         <?php
$sqlReport = $mysqli->singleSelect('products', '', 'fetch', array('ORDER BY' => 'RAND() DESC'));
	while($rawD = $sqlReport[$rcnt++]){
		$productlist = file_get_contents('../../'.APP_TROUTE.APP_THEME.'/productlist.htm');
	    $productlist = str_replace("%col%", 'col-lg-4 col-md-4 col-sm-6 col-xs-12', $productlist); 
	    $productlist = str_replace("%img%", $rawD['display'], $productlist); 
	    $productlist = str_replace("%title%", $rawD['title'], $productlist);
	    $productlist = str_replace("%shortDesc%", $rawD['short_desc'], $productlist);
		echo $productlist;
	}
?>
</div>
            </div>
        </div>
        <!--/.product-section -->
  </div>
            <!-- CTA -->
            <div class="cta-wrapper" style="background: url(data:image<?php echo $cont[3]['pageImg']; ?>)no-repeat; background-size: cover;">
                <div class="container">
                    <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="cta-section">
                            <h1><?php echo $cont[3]['pageTxt']; ?></h1>
                                <p class="cta-small-text"><?php echo $cont[3]['pageTxt2']; ?></p>
                               <p> <a href="#" onclick="page('application')" class="btn btn-primary btn-lg mb20">Apply now</a>
                                
                            </div>
                            <!-- /.section title-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.CTA -->
 <!-- Testimonial -->
        <div class="space-medium">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mb30">
                        <h2>“Over 650+ happy clients from all over the world”</h2>
                        <p>We have been able to close several deals in the US, Canada, Australia and other countries across the globe.</p>
                        <a href="testimonials" class="btn btn-default btn-lg">see testimonials</a>
                    </div>
                    <!-- testimonial-1 -->
                    <div class="col-lg-offset-1 col-lg-6 col-md-offset-1 col-md-6 col-sm-6 col-xs-12">
                        <div class="testimonial-block">
                            <div class="testimonial-content">
                                <p>“<?php echo APP_NAME; ?> is quick to respond and has a user-friendly service. That was very helpful and impressing. Thanks for funding my company”</p>
                                <div class="testimonial-meta">
                                    <h3>Adams Fury</h3>
                                    <div class="rating">
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-block">
                            <div class="testimonial-content">
                                <p>“Before now, obtaining a loan for business startup has not been easy but I have experienced funding with comfort and ease wile working with <?php echo APP_NAME; ?>”</p>
                                <div class="testimonial-meta">
                                    <h3>Larry Woodbench</h3>
                                    <div class="rating">
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.testimonial-1 -->
                    </div>
                </div>
            </div>
            </div>
            </div>
            <!-- /.Testimonial -->
 <!-- about-section -->
        <div class="space-large bg-light">
            <div class="container">
                <div class="row mb60">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h2><?php echo $cont[3]['pageTxt3']; ?></h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p><?php echo $cont[3]['pageTxt4']; ?></p>
                        <p><?php echo $cont[3]['pageTxt5']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.about-section -->
<script type="text/javascript" src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/js/slider.js"></script>      