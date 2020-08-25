<?php
require('../db/index.php');
include("../auth.php");
include 'core/acc_call.php';
include 'core/header.php';
?>
 <div class="c-toolbar u-mb-medium">
 <nav class="c-toolbar__nav u-mr-auto">
                <a class="c-toolbar__nav-item is-active" href="#tab1">Help</a>
            </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>
<div class='container'>
<?php if($perm_help == $perm_act) {
include 'core/faq.php';
}else{ ?>
<div class='c-alert c-alert--warning alert'><i class='c-alert__icon fa fa-times-circle'></i> Service not available at this time, please try again later <button class='c-close' data-dismiss='alert' type='button'>&times;</button></div>
<?php } ?>
<?php
include 'core/footer.php';
?>