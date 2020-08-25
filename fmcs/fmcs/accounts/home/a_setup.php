<?php
include 'core/header.php';
?>
<div class="c-toolbar u-justify-between u-mb-medium">
                <nav class="c-counter-nav">
                    <p class="c-counter-nav__title">Status:</p>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link" href="#">
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Online Access
                        </a>
                    </div>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link" href="#">
                            <span class="c-counter-nav__counter"><i class="fa fa-check"></i></span>Verification
                        </a>
                    </div>
                    <div class="c-counter-nav__item">
                        <a class="c-counter-nav__link is-active" href="#">
                            <span class="c-counter-nav__counter">3</span>Account Setup
                        </a>
                    </div>
                    <div class="c-counter-nav__item u-hidden-down@tablet">
                        <a class="c-counter-nav__link" href="#">
                            <span class="c-counter-nav__counter">4</span>Review
                        </a>
                    </div>
                </nav>

                <?php include("core/status.php"); ?>
            </div>
<form name="form" method="post" action="core/acc_setup.php"> 
<input type="hidden" name="new" value="1" />
<input type="hidden" name="usr_id" value="<?php echo $_SESSION['usr_id']; ?>" />
<input type="hidden" name="usr_phone" value="<?php echo $_SESSION['usr_phone']; ?>" />
<input type="hidden" name="usr_email" value="<?php echo $_SESSION['usr_email']; ?>" />
<input type="hidden" name="account_no" value="" ID="acc_no" MAXLENGTH=10 SIZE=10 />
<input type="hidden" name="account_status" value="<?php if($manual_review == 0) { echo "Active"; }else { echo "On-Hold"; } ?>" />
<input type="hidden" name="account_opening_date" value="<?php echo date("jS\ F, Y");?>" />
<input type="hidden" name="account_balance" value="0.00" />
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-8">

                        <article class="c-stage">
                            <div class="c-stage__header o-media u-justify-start">
                                <div class="c-stage__icon o-media__img">
                                    <span class="c-counter-nav__counter">3</span>
                                </div>
                                <div class="c-stage__header-title o-media__body">
                                    <h6 class="u-mb-zero">Stage 3 - Account Setup</h6>
                                    <p class="u-text-xsmall u-text-mute u-color-warning">You account is not yet setup, complete our quick online account opening form, submit and your account will be setup in less than five minutes.</p>
                                </div>
                            </div>

                            <div class="c-stage__panel u-p-medium">
							<h3 class="u-text-mute">Personal Data</h3>
                                <p class="u-text-mute u-text-uppercase u-text-small u-mb-xsmall">Required for account setup</p>
                                <div class="row u-mb-medium">
                                    <div class="col-md-6 col-lg-4">
                                        <ul>
<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">Title</label><br/>
<select class="c-select" name="title" > 
<?php include('../../core/html-option/title-option.htm'); ?>
</select>
</li>
<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">First Name</label><br/>
<input class="c-input" type="text" name="first_name" required>
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">Last Name</label><br/>
<input class="c-input" type="text" name="last_name" required>
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">Other Names</label><br/>
<input class="c-input" type="text" name="other_name">
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">Company Name (If any)</label><br/>
<input class="c-input" type="text" name="company" >
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">Address, Apt/Suite No.</label><br/>
<input class="c-input" type="text" name="street_address" required>
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">Date of Birth <font style="font-size:10px;">(MM/DD/YYYY)</font></label><br/>
<input class="c-input" type="text" name="dob" required>
</li>
 </ul>
                                    </div>

                                    <div class="col-md-6 col-lg-8">
                                        <ul>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">City</label><br/>
<input class="c-input" type="text" name="city" required>
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">State</label><br/>
<input class="c-input" type="text" name="state" required>
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">Zip/Postal Code</label><br/>
<input class="c-input" type="text" name="zip_code" required>
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">Country</label><br/>
<select name="country" class="c-select">
<?php include('../../core/html-option/country-option.htm'); ?>
</select>
</li>

<li class="u-mb-xsmall u-text-small u-color-primary">
<label class="">SSN <font style="font-size:10px;">(For US residents only)</font></label><br/>
<input class="c-input" type="text" name="ssn" />
</li>

                                        </ul>
                                    </div>
                                </div>                             
                            </div><!-- // .c-stage__panel -->
                        </article><!-- // .c-stage -->
                    </div>

                    <div class="col-xl-4">

                        <div class="c-card u-p-medium">
                            <h3 class="u-text-mute">Account Data</h3>

                            <table class="u-width-100">
                                <tbody>
                                    <tr>
                                        <td class="u-pb-xsmall u-color-primary u-text-small">
										<label class="">Type</label><br/>
<select class="c-select" name="account_type">
<?php include('../../core/html-option/account-type-option.htm'); ?>
</select>
</td>
                                    </tr>
                                    <tr>
                                        <td class="u-pb-xsmall u-color-primary u-text-small">
<label class="">Funding Mode</label><br/>
<select class="c-select" name="funding_mode" > 
<?php include('../../core/html-option/funding-mode-option.htm'); ?>
</select>
</td>

                                    </tr>
                                </tbody>
                            </table>
							<br/>
			<div class="c-alert c-alert--info">
                                <i class="c-stage__label-icon fa fa-exclamation-triangle u-color-warning"></i>
                                <p class="c-stage__label-title">By clicking "Complete Setup" you agree to our "Data Protection and Terms & Conditions" and "Indemnity to operate my account by Telephone or Email"</p>
             </div>
                            <div class="c-divider u-mv-small"></div>

                            <div class="u-flex u-justify-between u-align-items-center">
                                

                                <div>
                        
                         <button name="submit" type="submit" class="c-btn c-btn--success">
                      Complete Setup
                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- // .container -->
			</form>
<script>
function randomNumber(len) {
    var randomNumber;
    var n = '';

    for(var count = 0; count < len; count++) {
        randomNumber = Math.floor(Math.random() * 10);
        n += randomNumber.toString();
    }
    return n;
}

document.getElementById("acc_no").value = randomNumber(10);

</script>

<?php
include 'core/footer.php';
?>