<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags     -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>College Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backoffice/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?= base_url(); ?>assets/backoffice/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backoffice/libs/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backoffice/vendor/fonts/fontawesome/css/fontawesome-all.css">
</head>

<body>
<!-- ============================================================== -->
<!-- main wrapper -->
<!-- ============================================================== -->
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="<?= base_url() ?>dashboard">Fees Manage</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <input class="form-control" type="text" placeholder="Search..">
                        </div>
                    </li>
                    <li class="nav-item dropdown notification">
                        <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span
                                    class="indicator"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                            <li>
                                <div class="notification-title"> Notification</div>
                                <div class="notification-list">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action active">
                                            <div class="notification-info">
                                                <div class="notification-list-user-img"><img
                                                            src="<?= base_url(); ?>assets/backoffice/images/avatar-2.jpg"
                                                            alt="" class="user-avatar-md rounded-circle"></div>
                                                <div class="notification-list-user-block"><span
                                                            class="notification-list-user-name">Jeremy Rakestraw</span>accepted
                                                    your invitation to join the team.
                                                    <div class="notification-date">2 min ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="notification-info">
                                                <div class="notification-list-user-img"><img
                                                            src="<?= base_url(); ?>assets/backoffice/images/avatar-3.jpg"
                                                            alt="" class="user-avatar-md rounded-circle"></div>
                                                <div class="notification-list-user-block"><span
                                                            class="notification-list-user-name">
John Abraham</span>is now following you
                                                    <div class="notification-date">2 days ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="notification-info">
                                                <div class="notification-list-user-img"><img
                                                            src="<?= base_url(); ?>assets/backoffice/images/avatar-4.jpg"
                                                            alt="" class="user-avatar-md rounded-circle"></div>
                                                <div class="notification-list-user-block"><span
                                                            class="notification-list-user-name">Monaan Pechi</span> is
                                                    watching your main repository
                                                    <div class="notification-date">2 min ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="notification-info">
                                                <div class="notification-list-user-img"><img
                                                            src="<?= base_url(); ?>assets/backoffice/images/avatar-5.jpg"
                                                            alt="" class="user-avatar-md rounded-circle"></div>
                                                <div class="notification-list-user-block"><span
                                                            class="notification-list-user-name">Jessica Caruso</span>accepted
                                                    your invitation to join the team.
                                                    <div class="notification-date">2 min ago</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="list-footer"><a href="#">View all notifications</a></div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown connection">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                            <li class="connection-list">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img
                                                    src="<?= base_url(); ?>assets/backoffice/images/github.png" alt="">
                                            <span>Github</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img
                                                    src="<?= base_url(); ?>assets/backoffice/images/dribbble.png"
                                                    alt=""> <span>Dribbble</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img
                                                    src="<?= base_url(); ?>assets/backoffice/images/dropbox.png" alt="">
                                            <span>Dropbox</span></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img
                                                    src="<?= base_url(); ?>assets/backoffice/images/bitbucket.png"
                                                    alt=""> <span>Bitbucket</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img
                                                    src="<?= base_url(); ?>assets/backoffice/images/mail_chimp.png"
                                                    alt=""><span>Mail chimp</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img
                                                    src="<?= base_url(); ?>assets/backoffice/images/slack.png" alt="">
                                            <span>Slack</span></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="conntection-footer"><a href="#">More</a></div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"><img
                                    src="<?= base_url(); ?>assets/backoffice/images/avatar-1.jpg" alt=""
                                    class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                             aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">
                                    John Abraham</h5>
                                <span class="status"></span><span class="ml-2">Available</span>
                            </div>
                            <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-1" aria-controls="submenu-1"><i
                                        class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse"
                                           aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">E-Commerce</a>
                                        <div id="submenu-1-2" class="collapse submenu" style="">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">E Commerce Dashboard</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Product
                                                        List</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Product
                                                        Single</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Product
                                                        Checkout</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Finance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Sales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                           data-target="#submenu-1-1" aria-controls="submenu-1-1">Infulencer</a>
                                        <div id="submenu-1-1" class="collapse submenu" style="">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link"
                                                       href="#">Influencer</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Influencer
                                                        Finder</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Influencer
                                                        Profile</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>UI
                                Elements</a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Cards <span class="badge badge-secondary">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Carousel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">List Group</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Typography</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Accordions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Tabs</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Chart</a>
                            <div id="submenu-3" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">C3 Charts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Chartist Charts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Chart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Morris</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Sparkline</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Guage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Forms</a>
                            <div id="submenu-4" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Form Elements</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Parsely Validations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Multiselect</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Tables</a>
                            <div id="submenu-5" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">General Tables</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Data Tables</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-divider">
                            Features
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-file"></i>Pages</a>
                            <div id="submenu-6" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Invoice</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Blank Page</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Blank Page Header</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">404 page</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Sign up Page</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Forgot Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Pricing Tables</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Timeline</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Calendar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Sortable/Nestable
                                            List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Widgets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Media Objects</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Cropper</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Color Picker</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-fw fa-inbox"></i>Apps
                                <span class="badge badge-secondary">New</span></a>
                            <div id="submenu-7" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Inbox</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Email Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Email Compose</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Message Chat</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-columns"></i>Icons</a>
                            <div id="submenu-8" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">FontAwesome Icons</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Material Icons</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Simpleline Icon</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Themify Icon</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Flag Icons</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Weather Icon</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-9" aria-controls="submenu-9"><i
                                        class="fas fa-fw fa-map-marker-alt"></i>Maps</a>
                            <div id="submenu-9" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Google Maps</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Vector Maps</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                               data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder"></i>Menu
                                Level</a>
                            <div id="submenu-10" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Level 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                           data-target="#submenu-11" aria-controls="submenu-11">Level 2</a>
                                        <div id="submenu-11" class="collapse submenu" style="">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Level 1</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Level 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Level 3</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Blank Pageheader </h2>
                        <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit
                            amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blank Pageheader</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h3 class="text-center">Content goes here!</h3>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="<?= base_url(); ?>assets/backoffice/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="<?= base_url(); ?>assets/backoffice/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?= base_url(); ?>assets/backoffice/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="<?= base_url(); ?>assets/backoffice/libs/js/main-js.js"></script>
</body>

</html>