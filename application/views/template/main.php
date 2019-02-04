<?php /* ?>
<!DOCTYPE html>
<html lang="en">
<!--Css Load Files -->
<?php  $this->load->view('template/scripts');?>
<body>
<!--Header Section-->

<?php $this->load->view('template/header'); ?>
<!--Header Section End-->

<!-- Body Part Starts -->
<div id="page-content">
    <?php echo $page_content;?>
</div>
<!-- Body Part Ends -->

<!--Footer Section-->
<?php $this->load->view('template/footer');?>
<!--end Footer Section-->

<!-- Footer script section-->
<?php $this->load->view('template/footerScript');?>
<!-- end Footer script section-->

</body>
</html>
<?php */ ?>
<!doctype html>
<html lang="en">
<head>
    <!--Css Load Files -->
    <?php $this->load->view('template/scripts'); ?>
</head>
<body>

<!--================Header Menu Area =================-->
<header class="header_area">
    <!--Header Section-->
    <?php $this->load->view('template/header'); ?>
</header>

<!-- Body Part Starts -->
<div id="page-content">
    <?php echo $page_content; ?>
</div>
<!--================ start footer Area  =================-->
<footer class="footer-area p_120">
    <!--Footer Section-->
    <?php $this->load->view('template/footer'); ?>
    <!--end Footer Section-->
</footer>
<!--================ End footer Area  =================-->

<!-- Footer script section-->
<?php $this->load->view('template/footerScript'); ?>
<!-- end Footer script section-->

</body>
</html>
