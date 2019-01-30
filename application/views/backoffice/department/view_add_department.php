<?= form_open("backoffice/Department/addEditDepartment", array('id' => 'department_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($department_data)) ? 'editDepartment' : 'addDepartment')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($department_data)) ? $department_data['dept_id'] : '')) ?>

<div class="row">


    <!-- Department Code  -->
    <div class="col-sm-12">
        <div class="form-group">
            <?= form_input(array('name' => 'department_frm_dept_id', 'id' => 'department_frm_dept_id', 'class' => 'form-control', 'placeholder' => 'Department  Code', 'value' => (isset($department_data)) ? $department_data['dept_id'] : '')) ?>
        </div>
    </div>

    <!-- Department Name  -->
    <div class="col-sm-12">
        <div class="form-group">
            <?= form_input(array('name' => 'department_frm_dept_name', 'id' => 'department_frm_dept_name', 'class' => 'form-control', 'placeholder' => 'Department  Name', 'value' => (isset($department_data)) ? $department_data['dept_name'] : '')) ?>
        </div>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($department_data)) ? '<i class="ti-save"></i> Save' : '<i class="ti-plus"></i> Add' ?>
        </button
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ready(function () {

            /*************************************
             Add Edit Department
             *************************************/
            $("#department_frm").validate({
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
                        'department_frm_dept_id': {
                            required: true,
                            digits:true,
                            remote: {
                                url: base_url+"backoffice/Department/checkexists/"+"dept_id"+"/"+update_id,
                                type: "post",
                                data: {
                                    'table': 'department_master',
                                    'field': 'dept_id',
                                    dept_id: function () {
                                        return $('#department_frm_dept_id').val();
                                    }
                                }
                            }
                        },
                        'department_frm_dept_name': {
                            required: true,
                            remote: {
                                url: base_url+"backoffice/Department/checkexists/"+"dept_name"+"/"+update_id,
                                type: "post",
                                data: {
                                    'table': 'department_master',
                                    'field': 'dept_name',
                                    dept_name: function () {
                                        return $('#department_frm_dept_name').val();
                                    }
                                }
                            }
                        }
                    },
                messages:
                    {
                        'department_frm_dept_id': {
                            required: "This field is required.",
                            remote:"Department Code already Exists",
                            digits: "Only Numeric Accepted"
                        },
                        'department_frm_dept_name': {
                            required: "This field is required.",
                            remote:"Department Name already Exists"
                        }
                    }
            });
            /*************************************
             Add Edit Department End
             *************************************/

        });
    </script>