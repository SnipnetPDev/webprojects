<?php
require('../db/index.php');
include("../auth.php");
include 'core/acc_call.php';
include 'core/header.php';
?>
 <div class="c-toolbar u-mb-medium">
 <nav class="c-toolbar__nav u-mr-auto">
                <a class="c-toolbar__nav-item is-active" href="#tab1">Service Request</a>
            </nav>
            <a class="c-btn c-btn--success u-ml-auto u-hidden-down@mobile" href="index.php">
                <i class="fa fa-times u-mr-xsmall u-opacity-medium"></i>Close
            </a>
        </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">

                           <ul class="c-tabs__list nav nav-tabs" id="myTab" role="tablist">
                                <li><a class="c-tabs__link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Activity</a></li>

                                <li><a class="c-tabs__link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Blocked Users</a></li>

                                <li><a class="c-tabs__link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">NDAs</a></li>

                                <li><a class="c-tabs__link u-hidden-down@tablet" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab" aria-controls="nav-customer" aria-selected="false">Customer Invoices</a></li>
                            </ul>

                            <div class="c-tabs__content tab-content u-mb-large" id="nav-tabContent">
                                <div class="c-tabs__pane active u-pb-medium" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                             place 1
                                </div>

                                <div class="c-tabs__pane u-pb-medium" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <p class="u-mb-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et quidem modi atque at aliquid expedita nemo incidunt exercitationem nihil sit. Laudantium suscipit id amet saepe ratione, accusamus. Voluptatum in, nam.</p>

                                    <p class="u-mb-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A voluptate nobis tenetur mollitia incidunt quod, est veniam, earum nemo! Alias rerum saepe aut sapiente minus sunt doloribus tempora corrupti in!</p>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea distinctio nostrum molestias assumenda, repudiandae consequuntur quae pariatur aut incidunt placeat doloremque doloribus! Recusandae nostrum dolore repudiandae libero mollitia, rem eveniet.</p>
                                </div>

                                <div class="c-tabs__pane u-pb-medium" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <p class="u-mb-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et quidem modi atque at aliquid expedita nemo incidunt exercitationem nihil sit. Laudantium suscipit id amet saepe ratione, accusamus. Voluptatum in, nam.</p>

                                    <p class="u-mb-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A voluptate nobis tenetur mollitia incidunt quod, est veniam, earum nemo! Alias rerum saepe aut sapiente minus sunt doloribus tempora corrupti in!</p>
                                </div>

                                <div class="c-tabs__pane u-pb-medium" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
                                    <p class="u-mb-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et quidem modi atque at aliquid expedita nemo incidunt exercitationem nihil sit. Laudantium suscipit id amet saepe ratione, accusamus. Voluptatum in, nam.</p>

                                    <p class="u-mb-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A voluptate nobis tenetur mollitia incidunt quod, est veniam, earum nemo! Alias rerum saepe aut sapiente minus sunt doloribus tempora corrupti in!</p>

                                    <p class="u-mb-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A voluptate nobis tenetur mollitia incidunt quod, est veniam, earum nemo! Alias rerum saepe aut sapiente minus sunt doloribus tempora corrupti in!</p>
                                    
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et quidem modi atque at aliquid expedita nemo incidunt exercitationem nihil sit. Laudantium suscipit id amet saepe ratione, accusamus. Voluptatum in, nam.</p>
                                </div>
                            </div>

                    </div>


                </div>

            </div><!-- // .container-fluid -->
            

        
      
<?php
include 'core/footer.php';
?>