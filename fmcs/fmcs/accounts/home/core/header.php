<?php
require('../db/index.php');
include('../../core/settings.php');
include '../../core/super-perm.php';
?>
<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Dashboard - <?php echo $site_title; ?></title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="../../img/apple-touch-icon.png">
        <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="../../css/main.min2.css">
		
		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		<script type="text/javascript">
		//set your publishable key
		Stripe.setPublishableKey('Your_API_Publishable_Key');
		
		//callback to handle the response from stripe
		function stripeResponseHandler(status, response) {
			if (response.error) {
				//enable the submit button
				$('#payBtn').removeAttr("disabled");
				//display the errors on the form
				$(".payment-errors").html(response.error.message);
			} else {
				var form$ = $("#paymentFrm");
				//get token id
				var token = response['id'];
				//insert the token into the form
				form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
				//submit form to the server
				form$.get(0).submit();
			}
		}
		$(document).ready(function() {
			//on form submit
			$("#paymentFrm").submit(function(event) {
				//disable the submit button to prevent repeated clicks
				$('#payBtn').attr("disabled", "disabled");
				
				//create single-use token to charge the user
				Stripe.createToken({
					number: $('.card-number').val(),
					cvc: $('.card-cvc').val(),
					exp_month: $('.card-expiry-month').val(),
					exp_year: $('.card-expiry-year').val()
				}, stripeResponseHandler);
				
				//submit from callback
				return false;
			});
		});
	</script>
    </head>
<script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 

</script>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        
        <header class="c-navbar">
            <a class="c-navbar__brand" href="index.php">
                <img src="../../img/logo.png" width="200px" height="" alt="<?php echo $site_title; ?>">
            </a>
           
           <!-- Navigation items that will be collapes and toggle in small viewports -->
            <nav class="c-nav collapse" id="main-nav">
                <ul class="c-nav__list">
                    <li class="c-nav__item">
                        <a class="c-nav__link" href="index.php">SUMMARY</a>
                    </li>
                    <li class="c-nav__item">
                        <a class="c-nav__link" href="activity.php">ACTIVITY</a>
                    </li>
                    <li class="c-nav__item">
                        <a class="c-nav__link" href="transfer.php">MONEY TRANSFER</a>
                    </li>
					<?php if($perm_cards == $perm_act) { ?>
					 <li class="c-nav__item">
                        <a class="c-nav__link" href="cards.php">CARDS</a>
                    </li>
					<?php }else{ } 
					if($perm_help == $perm_act) { ?>
					<li class="c-nav__item">
                        <a class="c-nav__link" href="help.php">HELP</a>
                    </li>
					<?php }else{ } ?>
                </ul>
            </nav>
            <!-- // Navigation items  -->

            <div class="c-field has-icon-right c-navbar__search u-hidden-down@tablet u-ml-auto u-mr-small">

            </div>
            
<?php
$imageU = $_SESSION['imgname'];
$image_src = "img/profile/".$imageU;
?>            
            <div class="c-dropdown dropdown">
                <a  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="c-avatar__img" src="../../<?php echo $image_src;  ?>" alt="User's Profile Picture">
                </a>

                <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                    <a class="c-dropdown__item dropdown-item" href="settings.php">Settings</a>
                    <a class="c-dropdown__item dropdown-item" href="activity.php">View Activity</a>
                    <a class="c-dropdown__item dropdown-item" href="../../logout.php">Logout</a>
                </div>
            </div>

            <button class="c-nav-toggle" type="button" data-toggle="collapse" data-target="#main-nav">
                <span class="c-nav-toggle__bar"></span>
                <span class="c-nav-toggle__bar"></span>
                <span class="c-nav-toggle__bar"></span>
            </button><!-- // .c-nav-toggle -->
        </header>