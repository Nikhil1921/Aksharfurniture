<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Akshar Furniture | <?= ucwords(str_replace('-', ' ', $name)) ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" href="<?= base_url()?>assets/assets/images/favicon.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/bower_components/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url()?>assets/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/icon/feather/css/feather.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/icon/themify-icons/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/icon/icofont/css/icofont.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/icon/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/pages/data-table/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
        <!-- Notification.css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/notification/notification.css">
        <!-- Animate.css -->
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/css/pages.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/assets/css/widget.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/bower_components/datedropper/css/datedropper.min.css" />
        <link href="<?= base_url()?>assets/assets/pages/jquery.filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
        <link href="<?= base_url()?>assets/assets/pages/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="<?= base_url()?>assets/assets/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="<?= base_url()?>assets/bower_components/select2/css/select2.min.css" />
        
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/bower_components/jquery.steps/css/jquery.steps.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?= base_url()?>assets/assets/css/bootstrap-select.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    </head>
    <body>
        <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper" >
                <nav class="navbar header-navbar pcoded-header" >
                    <div class="navbar-wrapper">
                        <div class="navbar-logo"><a href="<?= base_url('admin') ?>"><img class="custom_logo img-fluid" src="<?= base_url()?>assets/assets/images/logo.png" alt="Theme-Logo"/></a><a class="mobile-menu" id="mobile-collapse" href="javascript:void(0)"><i class="feather icon-menu icon-toggle-right"></i></a><a class="mobile-options waves-effect waves-light"><i class="feather icon-more-horizontal"></i></a></div>
                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                                <li><a href="javascript:void(0)" onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class="waves-effect waves-light" ><i class="full-screen feather icon-maximize"></i></a></li>
                            </ul>
                            <ul class="nav-right">
                                <li class="user-profile header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown"><img src="<?= base_url()?>assets/images/users/<?= $_SESSION['image'] ?>" class="img-radius" alt="User-Profile-Image"><span><?= ucwords($_SESSION['username']) ?></span><i class="feather icon-chevron-down"></i></div>
                                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <li><a><i class="feather icon-mail"></i> <?= $_SESSION['email'] ?></a></li>
                                            <li><a><i class="feather icon-phone"></i> <?= $_SESSION['mobile'] ?></a></li>
                                            <li><a href="<?= base_url('admin/profile')?>"><i class="feather icon-user"></i> Profile</a></li>
                                            <li><a href="<?= base_url('admin/login/logout')?>"><i class="feather icon-log-out"></i> Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar">
                            <div class="nav-list">
                                <div class="pcoded-inner-navbar main-menu">
                                    <div class="pcoded-navigation-label" align="center">
                                        <i class="feather icon-user"></i>&nbsp&nbsp&nbsp<?= ucwords($_SESSION['role']) ?>
                                    </div>
                                    <ul class="pcoded-item pcoded-left-item">
                                        <li class="ms-hover <?= ($name == 'dashboard') ? 'active' : ''  ?>">
                                            <a href="<?= base_url('admin') ?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                                <span class="pcoded-mtext">Dashboard</span>
                                            </a>
                                        </li>
                                        <li class="ms-hover <?= ($name == 'orders') ? 'active' : ''  ?>">
                                            <a href="<?= base_url('admin/orders') ?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                                                <span class="pcoded-mtext">Orders</span>
                                            </a>
                                        </li>
                                        <li class="ms-hover <?= ($name == 'payment approval') ? 'active' : ''  ?>">
                                            <a href="<?= base_url('admin/payments') ?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                                                <span class="pcoded-mtext">Payment Approval</span>
                                            </a>
                                        </li>
                                        <li class="ms-hover <?= ($name == 'employees') ? 'active' : ''  ?>">
                                            <a href="<?= base_url('admin/employees') ?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                                                <span class="pcoded-mtext">Employees</span>
                                            </a>
                                        </li>
                                        <li class="ms-hover <?= ($name == 'products') ? 'active' : ''  ?>">
                                            <a href="<?= base_url('admin/products') ?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                                                <span class="pcoded-mtext">Products</span>
                                            </a>
                                        </li>
                                        <!-- <li class="ms-hover <?= ($name == 'category') ? 'active' : ''  ?>">
                                            <a href="<?= base_url('admin/category') ?>" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                                                <span class="pcoded-mtext">Category</span>
                                            </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <div class="pcoded-content">
                            <div class="page-header card">
                                <div class="row align-items-end">
                                    <div class="col-lg-8">
                                        <div class="page-header-title"><i class="fa <?= $icon ?> bg-c-blue"></i>
                                            <div class="d-inline">
                                                <h5><?= ucwords(str_replace('-', ' ', $name)) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="page-header-breadcrumb">
                                            <ul class=" breadcrumb breadcrumb-title">
                                                <li class="breadcrumb-item"><a href="<?= base_url('admin/') ?>"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><?= ucwords(str_replace('-', ' ', $name)) ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <?=$contents ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="styleSelector"></div>
                <div class="d-flex justify-content-between footer-copy">
                    <p>Copyright © 2019 <a href="https://densetek.com" target="_blank">Densetek Infoteck.</a> All rights reserved.</p>
                    <p>Made for &nbsp<img src="<?= base_url()?>assets/assets/images/logo.png" alt="Theme-Logo" /></p>
                </div>
                <?php if (!empty($_SESSION['success'])) {
                echo '<input type="hidden" id="success_alert" value="'.$_SESSION['success'].'" data-type="success" data-animation-in="animated fadeInDown" data-animation-out="animated fadeOutDown" data-icon="fa fa-check"'; }
                
                if (!empty($_SESSION['error'])){
                echo '<input type="hidden" id="error_alert" value="'.$_SESSION['error'].'" data-type="danger" data-animation-in="animated fadeInDown" data-animation-out="animated fadeOutDown" data-icon="fa fa-exclamation-triangle">';
                } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url()?>assets/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bower_components/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>assets/assets/pages/waves/js/waves.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/bower_components/modernizr/js/css-scrollbars.js"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url()?>assets/assets/js/bootstrap-growl.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/notification/notification.js"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-buttons/js/jszip.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/assets/js/dropzone-amd-module.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/bower_components/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url()?>assets/assets/js/jquery.inputfilter.min.js"></script>
<!-- notification js end -->
<script type="text/javascript" src="<?= base_url()?>assets/assets/js/sweetalert.min.js"></script>
<script src="<?= base_url()?>assets/assets/js/pcoded.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/assets/js/vertical/vertical-layout.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/assets/js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/bower_components/datedropper/js/datedropper.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/assets/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/assets/js/validator.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/assets/js/validation.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>

<script type="text/javascript" src="<?= base_url()?>assets/assets/js/script.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/assets/js/jQuery.print.js"></script>
<script type="-text/javascript" src="<?= base_url()?>assets/assets/js/jquery.quicksearch.js"></script>
<script src="<?= base_url()?>assets/assets/js/rocket-loader.min.js" data-cf-settings="-|49" defer=""></script>
<!-- Latest compiled and minified JavaScript -->
<script src="<?= base_url()?>assets/assets/js/bootstrap-select.min.js"></script>
<script>
</script>
</body>
</html>