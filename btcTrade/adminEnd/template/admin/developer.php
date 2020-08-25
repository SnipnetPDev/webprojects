<?php require_once "../../core/temp_security.php"; ?>
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
					
						<div class="d-flex align-items-center justify-content-between mt-40 mb-20">
							
						<div class="d-flex">
                        <div class="btn-group btn-group-sm" role="group">
							<button type="button" class="btn btn-outline-primary active">today</button>
							<button type="button" class="btn btn-outline-primary">week</button>
							<button type="button" class="btn btn-outline-primary">month</button>
							<button type="button" class="btn btn-outline-primary">quarter</button>
							<button type="button" class="btn btn-outline-primary">year</button>
						</div>
                    </div>
						</div>
						<div class="card">
							<div class="card-body pa-0">
								<div class="table-wrap">
									<div class="table-responsive" id="devWorkspace">
									<div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
							<button onclick="loaddevWorkspace('appsettings')" type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-layers font-15"></i> App Settings</button>
							<button onclick="loaddevWorkspace('manifest')" type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-chart font-15"></i> Manifest</button>
							<button onclick="loaddevWorkspace('faq')" type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-help font-15"></i> Features</button>
							<button type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-plus font-15"></i> More</button>
						</div>
										<table class="table table-hover mb-0">
											<thead>
												<tr>
													<th>Data Range</th>
													<th>Visits</th>
													<th>Visitors</th>
													<th>Views</th>
													<th>Failure</th>
													<th>View depth</th>
													<th>Time on site</th>
													<th>% of New</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>2000 - 4000</td>
													<td>
														<span class="d-block">3211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">86</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">1211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">1241</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">76</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">12:11</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">80%</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-info w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
												</tr>
												<tr>
													<td>3000 - 5000</td>
													<td>
														<span class="d-block">3211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-80" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">86</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-75" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">1211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-60" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">3211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-40" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">56</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-50" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">17:11</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">80%</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-info w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
												</tr>
												<tr>
													<td>7000 - 8000</td>
													<td>
														<span class="d-block">6211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-65" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">56</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-60" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">1211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-75" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">8211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-90" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">96</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-95" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">17:11</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-60" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">60%</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-info w-75" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
												</tr>
												<tr>
													<td>8000 - 9000</td>
													<td>
														<span class="d-block">7211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">66</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">5211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">3211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">86</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">12:11</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">80%</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-info w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
												</tr>
												<tr>
													<td>9000 - 10000</td>
													<td>
														<span class="d-block">4211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-50" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">66</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">1251</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-60" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">3211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-40" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">86</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-20" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">19:11</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">80%</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-info w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
												</tr>
												<tr>
													<td>10000 - 15000</td>
													<td>
														<span class="d-block">9211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">74</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-30" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">1211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-90" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">4211</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-danger w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">90</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-warning w-90" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">19:11</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-primary w-75" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
													<td>
														<span class="d-block">80%</span>
														<span class="d-block mt-5">
															<div class="progress progress-bar-xs">
																<div class="progress-bar bg-info w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>	
					</div>
                </div>
                <!-- /Row -->
			</div>
            <!-- /Container -->