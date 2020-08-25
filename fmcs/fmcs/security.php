<?php
session_start();
require('accounts/db/index.php');
include('core/settings.php');
?>
<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Account Security</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="css/main.min.css">
    </head>
    <body class="c-login-wrapper">

        <div class="c-login">
		<br/>
<div class="row u-justify-center" style="text-align:center;">
               <div class="">
					<img src="img/logo.png" alt="Dashboard's Logo" width="160px" height="" >
					<br/><br/>
                       <div class='c-alert c-alert--danger alert'><i class='c-alert__icon fa fa-times-circle'></i> Your account has been disabled.
</div>
						<br/>
                    <div class="col u-mb-medium">
                    <a class="c-btn c-btn--danger" href="logout.php">
                        <i class="fa fa-close u-mr-xsmall"></i>Close
                    </a>
                </div>
					</div>
					</div>

        </div>

        <script src="js/main.min.js"></script>

    </body>
</html>