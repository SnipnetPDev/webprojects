
 <!-- Modal -->
                    <div class="c-modal c-modal--large modal fade" id="modal9" tabindex="-1" role="dialog" aria-labelledby="modal9" data-backdrop="static">
                        <div class="c-modal__dialog modal-dialog" role="document">
                            <div class="c-modal__content">
                                <div class="o-media c-card u-border-zero col-md-4">
                                    <div class="o-media__body u-p-medium">
                                        <div class="o-line u-align-items-start">
                                            <h3 class="u-mb-medium">Link your Credit Card
											<br/>
											<img src="../../img/payment.png" width="140px" height="" /></h3>
											
                                        </div>
                                       

                                        <div class="c-field u-mb-xsmall">
                                            <div class="c-field has-icon-left">
                                                <p>Link a Credit/Debit card to your account, this can enable you transfer to your account balance directly from your credit card easily.</p>
												
                                            </div>
                                        </div>
<form action="cards.php" method="post" >
<div class="c-field">
                                                    <div class="c-field has-icon-left">
                                                        <span class="c-field__icon">
                                                            <i class="fa fa-calendar-o"></i>
                                                        </span> 
                                                        <label class="c-field__label u-hidden-visually" for="input23">Card Type</label>
                                                        <select class="c-input" name="ctype" required>
														<option value="MasterCard"> MasterCard</option>
														<option value="Visa"> Visa</option>
														<option value="Discover"> Discover</option>
														<option value="American Express"> American Express</option>
														</select>
                                                    </div>
                                                </div>
                                        <div class="c-field u-mb-xsmall">
                                            <div class="c-field has-icon-left">
                                                <span class="c-field__icon">
                                                    <i class="fa fa-credit-card"></i>
                                                </span> 
                                                <label id="validate" class="c-field__label" for="input22"></label>
                                                <input size="20" class="c-input" type="text" placeholder="Card Number" name="cnumber" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="c-field">
                                                    <div class="c-field has-icon-left">
                                                        <span class="c-field__icon">
                                                            <i class="fa fa-calendar-o"></i>
                                                        </span> 
                                                        <label class="c-field__label u-hidden-visually" for="input23">MM / YYYY</label>
                                                        <input size="7" name="cexp" class="c-input" type="text" placeholder="MM/YYYY" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="c-field u-mb-small">
                                                    <div class="c-field has-icon-left">
                                                        <span class="c-field__icon">
                                                            <i class="fa fa-lock"></i>
                                                        </span> 
                                                        <label class="c-field__label u-hidden-visually" for="input24">CVC</label>
                                                        <input  size="4" autocomplete="off" name="ccvc" class="c-input" type="text" placeholder="CVC" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button name="linkcc" type="submit" class="c-btn c-btn--success c-btn--fullwidth u-mb-small">
                                            Link card
                                        </button>

                                        <span class="c-divider has-text u-mb-small">
                                            or
                                        </span>
<span class="c-modal__close u-text-mute" data-dismiss="modal" aria-label="Close">
                                        <a class="c-btn c-btn--info c-btn--fullwidth u-flex u-align-items-center u-justify-center" href="#">Cancel</a> </span>
</form>
                                    </div>
                                </div>
                            </div><!-- // .c-modal__content -->
                        </div><!-- // .c-modal__dialog -->
                    </div><!-- // .c-modal -->
                </div>
				