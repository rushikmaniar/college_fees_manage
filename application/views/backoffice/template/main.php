<!DOCTYPE html>
<html lang="en">
<!-- Loading All Scripts -->
<?php $this->load->view('backoffice/template/script.php'); ?>
<body>

<!-- Main wrapper  -->
<div id="dashboard-main-wrapper">
    <!-- header header  -->
    <?php $this->load->view('backoffice/template/header.php'); ?>
    <!-- End header header -->
    <!-- Left Sidebar  -->
    <?php $this->load->view('backoffice/template/sidebar.php'); ?>
    <!-- End Left Sidebar  -->


        <!-- Container fluid  -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"><?= $this->pageTitle; ?> </h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit
                                amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?= $this->pageTitle; ?></li>
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
        <!-- End Container fluid  -->
        <!-- footer -->
        <?php $this->load->view('backoffice/template/footer.php'); ?>
        </div>
        <!-- End footer -->
    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->
<?php $this->load->view('backoffice/template/footerScript.php'); ?>
</body>

</html>