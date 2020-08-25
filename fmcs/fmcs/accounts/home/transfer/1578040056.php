   <input class="c-input" type="hidden" value="1396436077" name="r_acc_no" id="r_acc_no" required>
     <div class='result' id='result'></div>

     <div class="c-field u-mb-small">
   <label class="c-field__label" for="bio">Bank name</label>
      <input type="hidden" name="trans_desc[]" class="c-input" value="BN#:">
      <input type="text" name="trans_desc[]" class="c-input" placeholder="Sky Bank PLC" required>
    </div>
	<!-- Separator end -->
	<div class="c-field u-mb-small">
   <label class="c-field__label" for="bio">Account Name</label>
      <input type="hidden" name="trans_desc[]" class="c-input" value="NAME#:">
      <input type="" name="trans_desc[]" class="c-input" placeholder="John Doe" required>
    </div>
	<!-- Separator end -->
	<div class="c-field u-mb-small">
   <label class="c-field__label" for="bio">Account Number</label>
      <input type="hidden" name="trans_desc[]" class="c-input" value="NO#:">
      <input type="text" name="trans_desc[]" class="c-input" placeholder="0230000000" required>
    </div>
	<!-- Separator end -->
	<div class="c-field u-mb-small">
   <label class="c-field__label" for="bio">Routing Number</label>
      <input type="hidden" name="trans_desc[]" class="c-input" value="RT#:">
      <input type="text" name="trans_desc[]" class="c-input" placeholder="02300062" required>
    </div>
	<!-- Separator end -->
	<div class="c-field u-mb-small">
   <label class="c-field__label" for="bio">Receiving Method</label>
      <select name="trans_desc[]" class="c-input">
	  <option value="SC:">SWIFT Code</option>
	  <option value="NID:">National ID</option>
	  <option value="IBAN:">IBAN number</option>
	  </select>
      <input type="text" name="trans_desc[]" class="c-input" required>
    </div>
	<!-- Separator end -->
	<div class="c-field u-mb-small">
   <label class="c-field__label" for="bio">Purpose for transfer</label>
   <input type="hidden" name="trans_desc[]" class="c-input" value="PTF#:">
      <textarea name="trans_desc[]" class="c-input"></textarea>
    </div>