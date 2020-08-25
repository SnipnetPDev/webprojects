<?php
require_once "../../core/config.php";
?> 
    <!-- contact-section -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
                    <div class="mb30">
                        <div class="contact-form ">
						<h1 class="page-title" style="color:#000;"><?php echo $cont[2]['pageTxt']; ?></h1>
                        <p><?php echo $cont[2]['pageTxt2']; ?>
                            <br> <?php echo $cont[2]['pageTxt3']; ?></p>
                            <div class="row" id="contactRow">
                                <!-- form -->
                                <form>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only " for="Cfname"></label>
                                            <input id="Cfname" type="text" placeholder="First Name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only " for="Clname"></label>
                                            <input id="Clname" type="text" placeholder="Last Name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only " for="Cemail"></label>
                                            <input id="Cemail" type="text" placeholder="Email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label sr-only " for="Cphone"></label>
                                            <input id="Cphone" type="text" placeholder="phone" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sendMbutton">
                                        <button class="btn btn-primary" onclick="sendMessage()">send us message</button>
                                    </div>
                            </div>
                        </div>
                        </form>
                        <!--/.form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.contact-section -->
<div class="space-medium bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-title">
                        <h2><?php echo $cont[2]['pageTxt4']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Address -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="contact-widget">
                        <div class="contact-content">
                            <h4 class="contact-widget-title">Visit Business Office</h4>
                            <p><?php echo $appConfig[0]['configValue']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /.Address -->
                <!-- Phone -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="contact-widget">
                        <div class="contact-widget-content">
                            <h4 class="contact-widget-title">Call</h4>
                            <p><span class="text-primary "><?php echo $appConfig[8]['configValue']; ?></span>
                                <br><small>Talk with one of our specialists</small> </p>
                        </div>
                    </div>
                </div>
                <!-- /.Phone -->
                <!-- Email -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="contact-widget">
                        <div class="contact-widget-content">
                            <h4 class="contact-widget-title ">Email</h4>
                            <p><?php echo $appConfig[2]['configValue']; ?>
                                <br> <small>Email our customer service team</small> </p>
                        </div>
                    </div>
                </div>
                <!-- /.Email -->
            </div>
        </div>
    </div>