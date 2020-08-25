<?php
require_once "../../core/temp_security.php";
$usrID = $_SESSION["usrID"];
	        $users_q = "SELECT * FROM accounts";
			$users_data = $dbObj->query_execute($users_q);
			$users = $dbObj->query_rowCount($users_data);
?>
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header" style="display:none;">
                    <div>
						<br/>
                    <form class="navbar-search-alt" title="Search settings, statistics & more.">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><span class="feather-icon"><i class="zmdi zmdi-search font-20"></i></span></span>
                        </div>
                        <input class="form-control" type="search" placeholder="Search settings, statistics & more." aria-label="Search">
                    </div>
                </form>
					</div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
					<div id="spWorksheet">
					</div>
					</div>
					</div>
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
						<div class="hk-row" id="Dashboard" style="display:none;">
							<div class="col-lg-3 col-sm-6">
								<div class="card card-sm">
									<div class="card-body">
										<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">EMPTY TILE</span>
										<div class="d-flex align-items-center justify-content-between position-relative">
											<div>
												<span class="d-block display-5 font-weight-400 text-dark"><i class="zmdi zmdi-layers font-30"></i> VALUE</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="card card-sm">
									<div class="card-body">
										<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">EMPTY TILE</span>
										<div class="d-flex align-items-center justify-content-between position-relative">
											<div>
												<span class="d-block">
													<span class="display-5 font-weight-400 text-dark"><span class="counter-anim"><i class="zmdi zmdi-chart font-30"></i> VALUE</span></span>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="card card-sm">
									<div class="card-body">
										<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">EMPTY TILE</span>
										<div class="d-flex align-items-end justify-content-between">
											<div>
												<span class="d-block">
													<span class="display-5 font-weight-400 text-dark"><i class="zmdi zmdi-spinner font-30"></i> VALUE</span>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="card card-sm">
									<div class="card-body">
										<span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Total Registred Users</span>
										<div class="d-flex align-items-end justify-content-between">
											<div>
												<span class="d-block">
													<span class="display-5 font-weight-400 text-dark"><i class="icon icon-people font-30"></i> <?php echo $users; ?></span>
												</span>
											</div>
											<div>
												<span class="text-primary font-12 font-weight-600">+ 3000 This month</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="card">
							<div class="card-body pa-0">
								<div class="table-wrap">
									<div class="table-responsive" id="spWorkspace">
									<center><img class='ajaxpic' src='../../images/loading.webp' width="24px" height="24px"></center>
									</div>
								</div>
							</div>
						</div>		
					</div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->