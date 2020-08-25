    <!-- Begin page content -->
    <main class="flex-shrink-0 pb-0">
                <div class="container mt-4">
				<br/>
				  <div class="col-12 col-sm-12 col-md-12 align-self-center">
				  <span id="appErr"></span>
                <div class="modal-header bg-default">
                    <span style="font-size:30px;padding-top:15px;">$</span><input type="text" id="amount" class="form-control form-control-lg f-30 text-white border-0 bg-none amount" placeholder="Enter Amout" autofocus>
                </div>
                <div class="modal-body" id="step1">
                    <div class="form-group" id="prodList">
                       
                    </div>
                    <div class="form-group" id="loanProdSelectPaper"></div>
					 <input type="hidden" value="" id="loanProdSelect">
                    <div class="form-group">
                        <label class="text-mute small">Loan Term (MONTHS)</label>
                        <input id="loanTerm" type="text" class="form-control" placeholder="12">
                    </div>
                    <div class="form-group">
                        <label class="text-mute small">Loan Purpose</label>
                        <input id="loanPurpose" type="text" class="form-control" placeholder="Loan Purpose"/>
                    </div>
                    <div class="form-group">
                        <label class="text-mute small">Additional Note</label>
                        <textarea id="Additionalnote" class="form-control" placeholder="Note"></textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-between" id="subAppBtn">
                    <a href="#" onclick="page('index')" class="btn btn-outline-secondary">Cancel</a>
                    <a href="#" onclick="submitApplication()" class="btn btn-default default-shadow">Apply now</a>
                </div>
				<br/><br/><br/><br/>
                    </div>
                </div>

    </main>
    <!-- End of page content -->