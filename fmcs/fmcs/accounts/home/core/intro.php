<?php 
if($_SESSION['imgname'] == "default.png")
{
	?>
<div class='c-alert--default alert'>
<button class='c-btn c-btn--danger' data-dismiss='alert' type='button'>Hide section <i class="fa fa-angle-up"></i></button>
 <div class="row">
                <div class="col-sm-12">
                    <div class="u-mv-large u-text-center">
                        <h2 class="u-mb-xsmall">HI <?php echo $us_first; ?>! Welcome to your account Dashboard.</h2>
                        <p class="u-text-mute u-h6">Add an extra layer of security to your account by completing the tasks below. <a href="settings.php">Goto account settings.</a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="c-landing-card u-mb-medium">

                        <div class="c-landing-card__img">
                            <img src="../../img/profile/default.png" width="50px" height="50px">
                        </div>
                        
                        <h4 class="c-landing-card__title">Upload a visible passport photograph to your account</h4>
                        <a class="c-btn c-btn--info" href="settings.php">Upload Photo</a>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-4">
                    <div class="c-landing-card u-mb-medium">

                        <div class="c-landing-card__img">
                        <img src="../../img/id.png" width="50px" height="50px">
                        </div>
                        
                        <h4 class="c-landing-card__title">Upload your government issued ID to improve your account security</h4>

                        <a class="c-btn c-btn--info" href="settings.php">Upload ID Card</a>
                    </div>
                </div>
                <?php if($perm_cards == $perm_act) { ?>
                <div class="col-sm-12 col-lg-4">
                    <div class="c-landing-card u-mb-medium">

                        <div class="c-landing-card__img">
						<img src="../../img/card.png" width="50px" height="50px">
                        </div>
                        
                        <h4 class="c-landing-card__title">Do even more with your account by linking a Credit/Debit Card</h4>

                        <a class="c-btn c-btn--info" data-toggle="modal" data-target="#modal9">Link your card</a>

                    </div>
                </div>
				<?php }else{ } ?>
            </div>
                    </div>
<?php
}  else  {
	echo '';
}

	?>