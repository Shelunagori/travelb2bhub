<?php
require __DIR__.'/../bootstrap/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
include('custom/connection.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo $siteurl;?>adminlogin/public/packages/serverfireteam/panel/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo $siteurl;?>adminlogin/public/packages/serverfireteam/panel/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="PHP" >
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $siteurl;?>adminlogin/public/packages/zofe/rapyd/assets/demo/style.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $siteurl;?>adminlogin/public/packages/zofe/rapyd/assets/redactor/css/redactor.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $siteurl;?>adminlogin/public/packages/zofe/rapyd/assets/datepicker/datepicker3.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $siteurl;?>adminlogin/public/packages/zofe/rapyd/assets/autocomplete/autocomplete.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $siteurl;?>adminlogin/public/packages/zofe/rapyd/assets/autocomplete/bootstrap-tagsinput.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $siteurl;?>adminlogin/public/packages/zofe/rapyd/assets/colorpicker/css/bootstrap-colorpicker.min.css">
     <link media="all" type="text/css" rel="stylesheet" href="<?php echo $siteurl;?>adminlogin/public/custom/custom.css">
	<title>Statistics</title>
    <!-- compiled styles -->
    <link href="<?php echo $siteurl;?>adminlogin/public/packages/serverfireteam/panel/css/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteurl;?>adminlogin/public/packages/serverfireteam/panel/font-icon/icomoon/style.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">
    <script src="<?php echo $siteurl;?>adminlogin/public/packages/serverfireteam/panel/js/jquery-1.11.0.js"></script>
    <meta name="csrf-token" content="kMyrSJnjF7szReePuuEQWkob3bUGgI9RsbijGjVx">
</head>
<body>
<div class="loading" style="display: none;">
        <h1> LOADING </h1>
        <div class="spinner">
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div>
    </div>
    <div id="wrapper">
    <?php include('left-navbar.php');?>
    <div id="page-wrapper" style="min-height: 831px;">
    <div class="row">
                <div class="col-xs-12 text-a top-icon-bar">
                    <div class="btn-group" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <a type="button" class="btn btn-default dropdown-toggle main-link" data-toggle="dropdown" aria-expanded="false">
                                Settings
                                <span class="caret"></span>
                            </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo $siteurl;?>adminlogin/public/panel/edit"><span class="icon  ic-users "></span>Profile Edit</a></li>
                            <li><a href="<?php echo $siteurl;?>adminlogin/public/panel/changePassword"><span class="icon ic-cog"></span>Change Password</a></li>
                          </ul>
                        </div>
                        <a href="<?php echo $siteurl;?>adminlogin/public/panel/logout" type="button" class="btn btn-default main-link">Log out<span class="icon  ic-switch"></span></a>
                      </div>
                </div>
            </div>
    <?php include('state-ta-graph.php');?>
    <?php include('footer-links.php');?>
    </div>
    </div>
    <?php include('scripts.php');?>
</body>

</html>