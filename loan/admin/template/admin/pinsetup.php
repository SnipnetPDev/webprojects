  <div class="container h-100">
    <!-- Login Form
    ============================================= -->
    <div class="row no-gutters h-100">
      <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4 m-auto">
	  <br/>
	  <div id="load">
	  <h2 class="text-7 text-center">Secure your account</h2>
        <p class="text-3 text-center mb-25">Create a four-digit PIN to protect your administrative account.</p> <br/>
        <form id="loginForm" method="post">
          <div class="vertical-input-group">
            <div class="input-group">
              <input type="password" class="form-control" id="pinS" pattern="\d{4}" onkeyup="enrollpinF(this.value);" maxlength="4" placeholder="PIN" required>
            </div>
          </div>
          <div class="vertical-input-group" id="second" style="display:none;">
		  <br/>
            <div class="input-group">
              <input type="password" class="form-control" id="pinSV" pattern="\d{4}" maxlength="4" placeholder="Verify PIN" onkeyup="enrollpin(this.value);" required>
            </div>
			<span id="report"></span>
          </div>
        </form>
		 </div>
		 <br/><br/>
         </div>

    </div>
    <!-- Login Form End -->
  </div>
<script src="js/vcode.js"></script> 
 <script>
 // Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}

setInputFilter(document.getElementById("pinS"), function(value) {
  return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 99999); });

setInputFilter(document.getElementById("pinSV"), function(value) {
  return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 99999); });

</script>