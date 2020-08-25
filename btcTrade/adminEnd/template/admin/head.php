<head>
<title><?php echo TITLE; ?></title>
<meta name="description" content="<?php echo DESC; ?>">
<meta name="APP_URL" content="<?php echo APP_URL; ?>">
<meta name="APP_KEY" content="<?php echo APP_KEY; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>core/css/offline-theme-chrome.css" />
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>core/css/offline-language-english.css" />

<!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/favicon.ico">
    <link rel="icon" href="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/favicon.ico" type="image/x-icon">
	<!-- Morris Charts CSS -->
    <link href="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/vendors/morris.js/morris.css" rel="stylesheet" type="text/css" />
	
    <!-- Toggles CSS -->
    <link href="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
	
    <!-- Custom CSS -->
    <link href="<?php echo APP_URL.APP_TROUTE.APP_THEME; ?>/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="hk-wrapper hk-alt-nav">
<div class="hk-pg-wrapper">
<?php include APP_TROUTE.APP_THEME.'/header'.APP_THEME_EXT; ?>