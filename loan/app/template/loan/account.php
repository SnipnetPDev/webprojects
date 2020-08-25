    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container" style="padding-top:60px;">
        <!-- page content goes here -->
        <div class="container my-4">
            <div class="card  border-0 shadow-sm ">
                <div class="card-body position-relative">
                    <div class="media">
                        <figure class="avatar avatar-50 mr-3" id="usrAvatar">
                        </figure>
                        <div class="media-body">
                            <h5 class="mb-1"><span id="usrFirstName"></span> <span id="usrLastName"></span></h5>
                            <p class="small text-mute" id="phoneNumber"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6 class="mb-1">$ <span id="Borrowlimit"></span></h6>
                            <p class="small text-mute">Borrow limit</p>
							 <span id="DpUpldErr"></span>
                        </div>
                        <div class="col-auto">
 <div class="upload-btn-wrapper">
  <button ype="submit"  id="submit-btn" class="btn btn-outline-default btn-44 shadow-sm"><i class="material-icons">photo</i></button>
  <input type="file" id="profileDp" name="myfile" onchange="imgBase64('profileDp', 'usrAvatar', 'DpUpldErr', 'uploadAvatar')" />
  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-4">
            <h6 class="page-subtitle">Personal Details</h6>
            <div class="row" id="personalTab"></div>
            <div class="row" id="addressTab"></div>
			<div class="modal-footer justify-content-between" id="saveInfoBtn">
                    <button type="button" onclick="updateinfo()" class="btn btn-default default-shadow" >Apply changes</button>
                </div>
            </div>
			        <div class="container-fluid px-0">
					<!-- 
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-dark mb-1">Email Notification</h6>
                            <p class="text-secondary mb-0 small">Default all notification will be sent</p>
                        </div>
                        <div class="col-2 pl-0 align-self-center text-right">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-dark mb-1">SMS Notification</h6>
                            <p class="text-secondary mb-0 small">Receive SMS notification</p>
                        </div>
                        <div class="col-2 pl-0 align-self-center text-right">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch4" checked>
                                <label class="custom-control-label" for="customSwitch4"></label>
                            </div>
                        </div>
                    </div>
                </li>
				
                <li class="list-group-item">
                    <a href="#" onclick="page('changePin')" class="row">
                        <div class="col">
                            <h6 class="text-dark mb-1">Change Account Pin</h6>
                            <p class="text-secondary mb-0 small">Mobile verification may be required</p>
                        </div>
                        <div class="col-2 pl-0 align-self-center text-right">
                            <i class="material-icons text-secondary">chevron_right</i>
                        </div>
                    </a>
                </li>-->
            </ul>
			<br/><br/><br/>
        </div>
    </main>
    <!-- End of page content -->