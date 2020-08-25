<?php
include("../auth.php");
include 'core/header.php';
include 'core/acc_call.php';
?>
 <div class="c-toolbar u-mb-medium">
 <nav class="c-toolbar__nav u-mr-auto">
                <a class="c-toolbar__nav-item is-active" href="#tab1">Account Activity</a>
            </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>
<?php
include 'core/activity.php';
include 'core/footer.php';
?>