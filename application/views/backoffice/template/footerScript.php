<?php // js scripts and custom.js ?>

<!-- Optional JavaScript -->

<script src="<?= base_url(); ?>assets/backoffice/vendor/bootstrap/js/bootstrap.bundle.js"></script>

<script src="<?= base_url(); ?>assets/backoffice/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="<?= base_url(); ?>assets/backoffice/libs/js/main-js.js"></script>

<script src="<?= base_url() ?>assets/backoffice/libs/js/custom.min.js"></script>

<script type="text/javascript">

    function ajaxModel(url, title, width) {
        if (typeof(width) === 'undefined') {
            width = 'modal-lg';
        }

        //check user
        $.ajax({
            async:false,
            url: base_url + 'backoffice/Login/checkUser',
            dataType: "json",
            success: function (responce) {

                if (responce.code === 0) {

                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: responce.message
                    }).then(function (result) {}).catch(swal.noop);


                } else if (responce.code === 2) {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: responce.message
                    }).then(function (result) {}).catch(swal.noop);

                } else if(responce.code === 1){
                    if (url) {
                            $.ajax({
                                async:false,
                                url: SITE_URL + url,
                                dataType: 'html',
                                success: function (responce) {
                                    $('#college_admin_modal .modal-title').html(title);
                                    $('#college_admin_modal .modal-body').html(responce);
                                    $('#college_admin_modal .modal-dialog').addClass(width);

                                    if (!$('#college_admin_modal').hasClass('show')) {
                                        $('#college_admin_modal').modal('show');
                                    }

                                }
                            });
                        } else {
                            console.log('error');
                        }
                    }
            },
            error: function (response) {

            }
        });

    }//ajaxmodel end

    jQuery(document).ready(function ($) {


        <?php if($this->session->flashdata('error')) : ?>
        toastr["error"]('<?= $this->session->flashdata('error') ?>', "Error");
        <?php elseif($this->session->flashdata('success')) : ?>
        toastr["success"]('<?= $this->session->flashdata('success') ?>', "Success");
        <?php endif; ?>


            /*var checkuser = setInterval(function(){
                //check user
                $.ajax({
                    async: false,
                    url: base_url + 'backoffice/Login/checkUser',
                    dataType: "json",
                    success: function (responce) {

                        if (responce.code === 0) {

                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: responce.message
                            }).then(function (result) {

                            }).catch(swal.noop);
                            window.location = base_url + 'backoffice/login/logout';
                            window.clearInterval(checkuser); //pause



                        } else if (responce.code === 2) {
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: responce.message
                            }).then(function (result) {

                            }).catch(swal.noop);
                            window.location = base_url + 'backoffice/login/logout';
                            window.clearInterval(checkuser); //pause
                        } else if (responce.code === 1) {
                            //continue
                        }
                    }, error: function (responce) {

                    }
                });
            },3000);*/

    });
</script>