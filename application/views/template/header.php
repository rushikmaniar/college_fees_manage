<?php //header ?>
<div class="top_menu row m0">
    <div class="container">
        <div class="float-left">
            <ul class="list header_social">
                <li><a href="https://www.facebook.com/pages/category/School/Christ-College-Rajkot-113567522088621/"><i class="fa fa-facebook"></i></a></li>

            </ul>
        </div>
        <div class="float-right">
            <a class="dn_btn" href="tel:+919427164732" style="font-size: medium">+91 9427 164 732</a>
            <a class="dn_btn" href="mailto:christcollegerajkot.edu.in" style="font-size: medium">christcollegerajkot.edu.in</a>
        </div>
    </div>
</div>
<div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/gurudakshina-medium-logo.jpg" style="width: 150px;height: 120px" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="<?= base_url(); ?>" style="font-size: medium" >Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>AboutUs" style="font-size: medium"  >About</a></li>
                    <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: medium" >Courses</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>Courses" style="font-size: medium" >Courses</a>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>Courses/PayForCourse" style="font-size: medium">Pay For Course</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>ContactUs" style="font-size: medium">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link"> <button type="button" data-container="body" title="Login Register" onclick="ajaxModel('Login/index','Login/Register',800)" class="main_btn btn-md">Login / Register</button></a></li>
                </ul>

            </div>
        </div>
    </nav>
</div>