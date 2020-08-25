<?php
include 'header.php';
?>
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
				<br/><br/>
                <div class="row">
                    <div class="col-md-4 col-xs-12">

                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="img/plugin.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <BR/><BR/><BR/><BR/><BR/><BR/><BR/>
                                         <h3 class="text-white">PLUGIN INSTALLER</h3>										</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
							<form class="form-horizontal form-material" name="form" method="post" action="upload.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-12">Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="plg_name" placeholder="REG Chcker 2.1" class="form-control form-control-line" required> </div>
                                        <input type="hidden" name="plg_date" value="<?php echo date("Y/m/d"); ?>" class="form-control form-control-line">
                                        <input type="hidden" name="plg_by" value="Stock Bank and Associates" class="form-control form-control-line"> 										
								</div>
                       
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">File</label>
                                    <div class="col-md-12">
                                        <input type="file" name="file" class="btn" required> </div>
                                </div>

                                
								<div class="form-group">
                                    <div class="col-md-12">
                                     <button name="btn-upload" type="submit" class="btn btn-info">Install Plugin</button>
									 </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<?php
include 'footer.php';
?>