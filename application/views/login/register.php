<?php
/**
 * Created by PhpStorm.
 * User: aakashwin81
 * Date: 026 26-01-2019
 * Time: 07:48 PM
 */?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Guru Dakshina | Site</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backoffice/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?= base_url(); ?>assets/backoffice/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backoffice/libs/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/backoffice/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <script src="<?= base_url();?>assets/backoffice/vendor/jquery/jquery-3.3.1.min.js"></script>


    <!-- toaster -->
    <link href="<?= base_url();?>assets/backoffice/plugins/toastr/toastr.min.css" rel="stylesheet">
    <script src="<?= base_url();?>assets/backoffice/plugins/toastr/toastr.min.js?>"></script>

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .invalid{
            border-color: #dc3545;
        }
        .filled {

            margin-top: 10px;
            margin-bottom: 0;
            padding: 7px 29px;
            position: relative;
            background-color: #f96a6a;
            color: #FFF;

        }
    </style>
    <script type="text/javascript">
        var base_url = "<?= base_url();?>";
        var SITE_URL = "<?= site_url(); ?>";
    </script>
</head>

<body>
<!-- ============================================================== -->
<!-- login page  -->
<!-- ============================================================== -->
<div class="splash-container">
    <div class="card ">
        <div class="card-header text-center"><a href="#"><img class="logo-img" src="<?= base_url()?>assets/images/gurudakshina-medium-logo.jpg" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">
            <form id="registerForm" method="post">
                <div class="form-group">
                    <input class="form-control form-control-lg success"  type="text" placeholder="User Email" name="registerFormEmail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="registerFormPassword" type="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg success"  type="text" placeholder="User Mobile" id="registerFormMobile" name="registerFormMobile" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign Up</button>
            </form>
        </div>
        <div class="card-footer bg-white p-0  ">
            <div class="card-footer-item card-footer-item-bordered">
                <a href="<?= base_url('login/index'); ?>" style="color: #1c95d4" class="footer-link">Already Memeber?</a>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- end login page  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="<?= base_url();?>assets/backoffice/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?= base_url();?>assets/backoffice/vendor/jquery-validation/js/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/backoffice/vendor/jquery-validation/js/additional-methods.js"></script>
<script>

    $(document).ready(function () {

        <?php if($this->session->flashdata('error')) : ?>
        toastr["error"]('<?= $this->session->flashdata('error') ?>', "Error");
        <?php elseif($this->session->flashdata('success')) : ?>
        toastr["success"]('<?= $this->session->flashdata('success') ?>', "Success");
        <?php endif; ?>

        $("#registerForm").validate({
            errorPlacement: function (e, a) {
                jQuery(a).parents(".form-group").append(e);
                jQuery(e).parent().find('ul').addClass('filled')
            },
            highlight: function (e) {
                jQuery(e).parent().find('ul').removeClass('filled').addClass('filled')
            },
            success: function (e) {
                jQuery(e).parent().find('ul').removeClass('filled');
                jQuery(e).parent().parent().find('ul').remove()
            },
            errorElement:'li',
            wrapper:'ul',
            rules:
                {
                    registerFormEmail: {
                        required: true,
                        email:true
                    },
                    registerFormPassword: {
                        required: true
                    },
                    registerFormMobile: {
                        required: true,
                        remote: {
                            url: base_url + "login/checkexists/",
                            type: "post",
                            data: {
                                'table': 'user_master',
                                'field': 'user_mobile',
                                user_mobile: function () {
                                    return $('#registerFormMobile').val();
                                }
                            }
                        }
                    }
                },
            messages:
                {
                    registerFormEmail: {
                        required: "Email Required",
                        email: "Enter Valid Email"
                    },
                    registerFormMobile: {
                        required: "Mobile Required",
                        remote:"Mobile"
                    },
                    registerFormPassword: {
                        required: "Password Required"
                    }
                }
        });
    });
</script>
</body>

</html>

