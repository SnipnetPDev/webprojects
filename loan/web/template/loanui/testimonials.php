<?php 
require_once "../../core/config.php";
$page = $cont[8]['pageId'];
?>
<!-- page-header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="page-section">
                        <h1 class="page-title"><?php echo $template_manifest->$page->pageTitle; ?></h1>
                        <p><?php echo $template_manifest->$page->pageDesc; ?></p>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 hidden-xs">
                    <div class="vertical-line"></div>
                </div>
                <div class="col-lg-1 col-md-1 hidden-sm hidden-xs"></div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                    <div class="page-btn">
                        <a href="application" class="btn btn-primary btn-lg btn-block">apply Now </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
<?php
echo base64_decode($cont[8]['pageHtml']);
?>