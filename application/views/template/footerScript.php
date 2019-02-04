<?php // js scripts and custom.js ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="<?= base_url(); ?>assets/js/popper.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/stellar.js"></script>
<script src="<?= base_url(); ?>assets/vendors/lightbox/simpleLightbox.min.js"></script>
<script src="<?= base_url(); ?>assets/vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="<?= base_url(); ?>assets/vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url(); ?>assets/vendors/isotope/isotope.pkgd.min.js"></script>
<script src="<?= base_url(); ?>assets/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>assets/vendors/popup/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url(); ?>assets/vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="<?= base_url(); ?>assets/vendors/counter-up/jquery.counterup.js"></script>
<script src="<?= base_url(); ?>assets/js/mail-script.js"></script>
<script src="<?= base_url(); ?>assets/js/theme.js"></script>


<script type="text/javascript">

    $(document).ready(function () {
        //blink text
       
        <?php if($this->session->flashdata('error')) : ?>
        toastr["error"]('<?= $this->session->flashdata('error') ?>', "Error");
        <?php elseif($this->session->flashdata('success')) : ?>
        toastr["success"]('<?= $this->session->flashdata('success') ?>', "Success");
        <?php endif; ?>
    });


    function ajaxModel(url, title, width) {
        if (typeof(width) === 'undefined') {
            width = 'modal-lg';
        }
        if (url) {
            $.ajax({
                url: SITE_URL + url,
                dataType: 'html',
                success: function (responce) {
                    $('#dakshina_frontsite_modal .modal-title').html(title);
                    $('#dakshina_frontsite_modal .modal-body').html(responce);
                    $('#dakshina_frontsite_modal .modal-dialog').addClass(width);

                    if (!$('#dakshina_frontsite_modal').hasClass('show')) {
                        $('#d#akshina_frontsite_modal').modal('show');
                    }

                }
            });
        }
    }
</script>
