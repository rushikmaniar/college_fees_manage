<?= form_open("backoffice/SiteSettings/addEditSiteSetting", array('id' => 'sitesettings_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => 'editSiteSettings')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($settings_data)) ? $settings_data['row_id'] : '')) ?>

<div class="row">

    <!-- Site Key-->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'sitesettings_frm_settings_key', 'id' => 'sitesettings_frm_settings_key', 'readonly' => 'readonly', 'class' => 'form-control', 'placeholder' => 'Settings Key', 'value' => (isset($settings_data)) ? $settings_data['settings_key'] : '')) ?>
        </div>
    </div>

    <!-- Class Name  -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'sitesettings_frm_settings_value', 'id' => 'sitesettings_frm_settings_value', 'class' => 'form-control', 'placeholder' => 'Settings value', 'value' => (isset($settings_data)) ? $settings_data['settings_value'] : '')) ?>
        </div>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($settings_data)) ? '<i class="ti-save"></i> Save' : '<i class="ti-plus"></i> Add' ?>
        </button>
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ajaxComplete(function () {

            /*************************************
             Add Edit Settings
             *************************************/
            $("#sitesettings_frm").validate({
                errorPlacement: function (e, a) {
                    jQuery(a).parents(".form-group").append(e);
                    jQuery(e).parent().find('ul').addClass('filled');
                },
                highlight: function (e) {
                    jQuery(e).removeClass('is-invalid').addClass('is-invalid');
                    jQuery(e).parent().find('ul').removeClass('filled').addClass('filled');
                },
                success: function (e) {
                    $(e).addClass('is-valid');
                    jQuery(e).parent().find('ul').removeClass('filled');
                    jQuery(e).parent().parent().find('ul').remove();
                },
                errorClass: 'is-invalid',
                errorElement: 'li',
                wrapper: 'ul',
                rules: {
                    'sitesettings_frm_settings_value': {
                        required: true
                    },
                    'sitesettings_frm_settings_key': {
                        required: true
                    }
                },

                messages: {
                    'sitesettings_frm_settings_value': {
                        required: "This field is required."
                    },
                    'sitesettings_frm_settings_key': {
                        required: "This field is required."
                    }
                }
            });
            /*************************************
             Add Edit Settings End
             *************************************/

        });
    </script>