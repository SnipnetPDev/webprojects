<?php 
require_once "core/config.php";
use csrfhandler\csrf as csrf;
$Accesscheck = 'deny';
	if ( isset( $_SESSION['id'] ) && isset( $_SESSION["loggedin"] ) ) { $Accesscheck = 'pass'; }
	if ( isset($_SESSION["loggedin"]) == true) { $Accesscheck = 'pass'; }
?>
        <nav class="navbar main-nav navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="javascript:void(0);" onclick="page('en')">
                    <img class="navbar-logo" src="<?php echo APP_TROUTE.APP_THEME; ?>/images/logo.png" width="120px" height="">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="javascript:void(0);" onclick="page('howtoinvest')">How to Invest</a></li>
						 <li class="nav-item"><a class="nav-link" href="javascript:void(0);" onclick="page('support')">Support</a></li>
						 <?php if($Accesscheck !== 'pass'){ ?>
                        <li class="nav-item">
                            <a class="btn nav-link" href="login">Login</a>
                        </li>
						<?php }  ?>
						<?php if($Accesscheck == 'pass'){ ?>
						<li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" onclick="page('console')">Trade Console</a>
                        </li>
						 <li class="nav-item">
                         <a id="accountInfo" class="nav-link" href="javascript:void(0);" onclick="page('account')">My Account</a>
                                </li>
						<li class="nav-item">
                            <a class="btn nav-link" href="javascript:void(0);" onclick="logout()">Logout</a>
                        </li>
					    <?php }  ?>
                    </ul>
                </div>
            </div>
            <!-- Modal -->
        </nav><!-- main-nav-block -->