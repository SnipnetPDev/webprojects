<?php require_once "../../core/temp_security.php"; ?>
     <div class="subheader"></div><!-- sub-header -->
    <!-- Currency Rate -->
	<br/>
  <div class="section-top-border"  style="overflow-x:hidden;">
			<div class="row">
				<div class="col-lg-8 col-md-8" style="padding-left:60px;">
					<h3 class="mb-30">Personal Information</h3>
					<div id="personalTab"></div>
						<br/><hr/>
					<h3 class="mb-30">Address Information</h3>
						<div id="addressTab"></div>
						<br/>
						<button id="updateButton" type="button" onclick="updateinfo()" class="btn buy-btn">Update Info</button>
						<br/>
				</div>
				<div class="col-lg-3 col-md-4 mt-sm-30" style="padding-left:60px;">
					<div class="single-element-widget">
						<h3 class="mb-30">Notifications</h3>
						<p class="mb-30">Send me notifications regarding</p>
						<div class="switch-wrap d-flex justify-content-between">
							<p>Payments</p>
							<div class="primary-switch">
								<input type="checkbox" id="default-switch">
								<label for="default-switch"></label>
							</div>
						</div>
						<div class="switch-wrap d-flex justify-content-between">
							<p>Products</p>
							<div class="primary-switch">
								<input type="checkbox" id="primary-switch" checked>
								<label for="primary-switch"></label>
							</div>
						</div>
						<div class="switch-wrap d-flex justify-content-between">
							<p>Account</p>
							<div class="confirm-switch">
								<input type="checkbox" id="confirm-switch" checked>
								<label for="confirm-switch"></label>
							</div>
						</div>
					</div>
					<div class="single-element-widget mt-30">
						<h3 class="mb-30">Language</h3>
						<div class="default-select" id="default-select_2">
							<select>
								<option value=" 1">English</option>
								<option value="1">Spanish</option>
								<option value="1">Arabic</option>
								<option value="1">Portuguise</option>
								<option value="1">Bengali</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>