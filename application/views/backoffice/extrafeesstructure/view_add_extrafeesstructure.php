<?= form_open("backoffice/ExtraFeesStructure/addEditExtraFeesStructure", array('id' => 'extra_extra_fees_structure_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => 'editFeesStructure')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($extra_fees_data)) ? $extra_fees_data['row_id'] : '')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($extra_fees_data)) ? 'editExtraFeesStructure' : 'addExtraFeesStructure')) ?>


<div class="row">


    <!-- Extra Fees Name  -->
    <div class="col-sm-6">
        <div class="form-group">
                <?= form_input(array('name' => 'extra_fees_structure_frm_fees_name', 'id' => 'extra_fees_structure_frm_fees_name', 'class' => 'form-control', 'placeholder' => 'Extra Fees Name', 'value' => (isset($extra_fees_data)) ? $extra_fees_data['fees_name'] : '')) ?>
        </div>
    </div>

    <!-- Extra Fees Amount  -->
    <div class="col-sm-6">
        <div class="form-group">
                <?= form_input(array('name' => 'extra_fees_structure_frm_fees_amt', 'id' => 'extra_fees_structure_frm_fees_amt', 'class' => 'form-control', 'placeholder' => 'Extra Fees Amount', 'value' => (isset($extra_fees_data)) ? $extra_fees_data['fees_amt'] : '')) ?>
        </div>
    </div>


    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($extra_fees_data)) ? '<i class="ti-save"></i> Save' : '<i class="ti-plus"></i> Add' ?>
        </button>
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ready(function () {


            /*************************************
              Edit Extra Fees Structure
             *************************************/
            $("#extra_extra_fees_structure_frm").validate({
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
                errorClass:'is-invalid',
                errorElement:'li',
                wrapper:'ul',
                rules: {
                    'extra_fees_structure_frm_fees_name': {
                        required: true,
                        remote: {
                            url: base_url + "backoffice/ExtraFeesStructure/checkexists/" +"row_id"+"/"+ update_id,
                            type: "post",
                            data: {
                                'table': 'extra_fees_details_structure',
                                'field': 'fees_name',
                                fees_name: function () {
                                    return $('#extra_fees_structure_frm_fees_name').val();
                                }
                            }
                        }
                    },
                    'extra_fees_structure_frm_fees_amt': {
                        required: true,
                        digits:true
                    }
                },

                messages: {
                    'extra_fees_structure_frm_fees_name': {
                        required: "This field is required.",
                        remote:"Extra Fee Name Alrady Exists"
                    },
                    'extra_fees_structure_frm_fees_amt': {
                        required: "This field is required.",
                        digits: "Only Numeric Accepted"
                    }
                }
            });
            /*************************************
             Edit Extra Fees Structure
             *************************************/

        });
    </script>