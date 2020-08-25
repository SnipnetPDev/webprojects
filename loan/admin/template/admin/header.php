<?php 
require_once "core/config.php";
use csrfhandler\csrf as csrf;
$Accesscheck = 'deny';
	if ( isset( $_SESSION['id'] ) && isset( $_SESSION["loggedin"] ) ) { $Accesscheck = 'pass'; }
	if ( isset($_SESSION["loggedin"]) == true) { $Accesscheck = 'pass'; }

 if($Accesscheck == 'pass'){ ?>
  <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar hk-navbar-alt">
            <a class="navbar-toggle-btn nav-link-hover navbar-toggler" href="javascript:void(0);" data-toggle="collapse" data-target="#navbarCollapseAlt" aria-controls="navbarCollapseAlt" aria-expanded="false" aria-label="Toggle navigation"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="javascript:void(0);" onclick="page('support')">
                <img class="brand-img d-inline-block align-top" src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/dist/img/logo-light.png" alt="Build PHP Admin" width="150px" height="" />
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapseAlt">
                <div class="d-flex align-items-center justify-content-between mt-10">
							<div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
							<button onclick="loadspWorkspace('products')" type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-layers font-15"></i> Loan Products</button>
							<button onclick="loadspWorkspace('orders')" type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-inbox font-15"></i> Loan Request</button>
							<button onclick="loadspWorkspace('faq')" type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-help font-15"></i> Faq</button>
							<button onclick="loadspWorkspace('pages')" type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-chart font-15"></i> Pages</button>
							<button onclick="loadspWorkspace('settings')" type="button" class="btn btn-outline-primary"><i class="zmdi zmdi-wrench font-15"></i> Global Settigs</button>
						</div>
						</div>
            </div>
            <ul class="navbar-nav hk-navbar-content">
                <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);" onclick="logout()"><i class="dropdown-icon zmdi zmdi-power"></i><span> Log out</span></a>
                </li>
            </ul>
        </nav>
        <!-- /Top Navbar -->
		
<?php }else{ ?> 
 <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar hk-navbar-alt">
            <a class="navbar-toggle-btn nav-link-hover navbar-toggler" href="javascript:void(0);" data-toggle="collapse" data-target="#navbarCollapseAlt" aria-controls="navbarCollapseAlt" aria-expanded="false" aria-label="Toggle navigation"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="javascript:void(0);" onclick="page('support')">
                <img class="brand-img d-inline-block align-top" src="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/dist/img/logo-light.png" alt="BuildPHP Admin" width="150px" height="" />
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapseAlt">
                <ul class="navbar-nav">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="https://snipnetworks.com/project/buildphp/about" target="_BLANK">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://snipnetworks.com/project/buildphp/version" target="_BLANK">Version<span class="badge badge-success badge-sm badge-pill ml-10">1.0</span></a>
                    </li>
                </ul>
                
            </div>
        </nav>
        <!-- /Top Navbar -->
<?php } ?> 