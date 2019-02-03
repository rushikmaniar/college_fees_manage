<?= form_open("backoffice/ClassManagement/addEditClass", array('id' => 'class_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($class_data)) ? 'editClass' : 'addClass')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($class_data)) ? $class_data['class_id'] : '')) ?>

<div class="row">

    <!-- Class Code  -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'class_frm_class_id', 'id' => 'class_frm_class_id', 'class' => 'form-control', 'placeholder' => 'Class  Code', 'value' => (isset($class_data)) ? $class_data['class_id'] : '')) ?>
        </div>
    </div>

    <!-- Class Name  -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'class_frm_class_name', 'id' => 'class_frm_class_name', 'class' => 'form-control', 'placeholder' => 'Class  Name', 'value' => (isset($class_data)) ? $class_data['class_name'] : '')) ?>
        </div>
    </div>

    <!-- Select Stream -->
    <div class="col-md-6">
        <div class="form-group">
        <select name="class_frm_stream_id" id="class_frm_stream_id" style="width: 100%" class="form-control">
            <option value="" selected>-- Select Stream --</option>
            <?php foreach ($stream_list as $row): ?>
                <?php if (isset($class_data['stream_id'])): ?>
                    <?php if (($class_data['stream_id']) == $row['stream_id']): ?>
                        <option value="<?= $row['stream_id'] ?>" selected data-no_of_sem="<?= $row['no_of_semester']?>"><?= $row['stream_name'] ?></option>
                    <?php else: ?>
                        <option value="<?= $row['stream_id'] ?>" data-no_of_sem="<?= $row['no_of_semester']?>"><?= $row['stream_name'] ?></option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="<?= $row['stream_id'] ?>" data-no_of_sem="<?= $row['no_of_semester']?>"><?= $row['stream_name'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        </div>
    </div>

    <!-- Select Semester -->
    <div class="col-md-6">
        <div class="form-group">
        <select name="class_frm_semester" id="class_frm_semester" style="width: 100%"  class="form-control">
            <option value="" selected>-- Select Semester --</option>
            <?php if (isset($sem_list)): ?>
                <?php foreach ($sem_list as $row): ?>

                        <?php if (($class_data['semester']) == $row): ?>
                            <option value="<?= $row ?>" selected><?= $row ?></option>
                        <?php else: ?>
                            <option value="<?= $row ?>"><?= $row ?></option>
                        <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        </div>
    </div>


    <!-- Class Tution Fees  -->
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group-prepend">
            <span class="input-group-text">&#8377;</span>
            <?= form_input(array('name' => 'class_frm_class_tution_fees', 'id' => 'class_frm_class_tution_fees', 'class' => 'form-control', 'placeholder' => 'Class  Tution Fees', 'value' => (isset($class_data)) ? $class_data['class_tution_fees'] : '')) ?>
            </div>
        </div>
    </div>

    <!-- Class Tution Fees Deadline  -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'class_frm_class_fees_deadline', 'id' => 'class_frm_class_fees_deadline', 'class' => 'form-control', 'placeholder' => 'Class  Tution Fees','type'=>'date', 'value' => (isset($class_data)) ? $class_data['class_fees_deadline'] : '')) ?>
        </div>
    </div>


    <!-- Select Department -->
    <div class="col-sm-6">
        <div class="form-group">
            <select name="class_frm_dept_id" id="class_frm_dept_id" style="width: 100%" class="form-control">
                <option value="" selected>-- Select Department --</option>
                <?php foreach ($department_list as $row): ?>
                    <?php if (isset($class_data['dept_id'])): ?>
                        <?php if (($class_data['dept_id']) == $row['dept_id']): ?>
                            <option value="<?= $row['dept_id'] ?>" selected><?= $row['dept_name'] ?></option>
                        <?php else: ?>
                            <option value="<?= $row['dept_id'] ?>"><?= $row['dept_name'] ?></option>
                        <?php endif; ?>
                    <?php else: ?>
                        <option value="<?= $row['dept_id'] ?>"><?= $row['dept_name'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>

            </select>
        </div>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($class_data)) ? '<i class="ti-save"></i> Save' : '<i class="ti-plus"></i> Add' ?>
        </button>
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ajaxComplete(function () {
            $('#class_frm_dept_id').select2();
            $('#class_frm_stream_id').select2();
            $('#class_frm_semester').select2();

            $('#class_frm_stream_id').change(function () {
                var no_of_sem = $(this).find(':selected').data('no_of_sem');
                if(no_of_sem !== ""){
                    no_of_sem = parseInt(no_of_sem);
                    $('#class_frm_semester').html('');
                    $('#class_frm_semester').append('<option value="">-- Select Semester -- </option>');

                    for (i=1;i<=no_of_sem;i++){
                        $('#class_frm_semester').append('<option value="'+i+'">'+i+'</option>');
                    }

                }
            });

            /*************************************
             Add Edit Class
             *************************************/
            $("#class_frm").validate({
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
                    'class_frm_class_id': {
                        required: true,
                        digits:true,
                        remote: {
                            url: base_url + "backoffice/ClassManagement/checkexists/" +"class_id"+"/"+ update_id,
                            type: "post",
                            data: {
                                'table': 'class_master',
                                'field': 'class_id',
                                class_id: function () {
                                    return $('#class_frm_class_id').val();
                                }
                            }
                        }
                    },
                    'class_frm_class_name': {
                        required: true,
                        remote: {
                            url: base_url + "backoffice/ClassManagement/checkexists/" +"class_id"+"/"+ update_id,
                            type: "post",
                            data: {
                                'table': 'class_master',
                                'field': 'class_name',
                                class_name: function () {
                                    return $('#class_frm_class_name').val();
                                }
                            }
                        }
                    },
                    'class_frm_class_tution_fees': {
                        required: true,
                        digits:true
                    },
                    'class_frm_class_fees_deadline': {
                        required: true
                    },
                    'class_frm_dept_id': {
                        required: true
                    },
                    'class_frm_stream_id': {
                        required: true
                    },
                    'class_frm_semester': {
                        required: true,
                        remote: {
                            url: base_url + "backoffice/ClassManagement/checkSemester/" +"class_id"+"/"+ update_id,
                            type: "post",
                            data: {
                                'table': 'class_master',
                                'field1': 'semester',
                                semester: function () {
                                    return $('#class_frm_semester').val();
                                },
                                'field2': 'stream_id',
                                stream_id: function () {
                                    return $('#class_frm_stream_id').val();
                                }

                            }
                        }
                    }

                },

                messages: {
                    'class_frm_class_id': {
                        required: "This field is required.",
                        remote: "Class code already Exists",
                        digits: "Only Numeric Accepted"
                    },
                    'class_frm_class_name': {
                        required: "This field is required.",
                        remote: "Class Name already Exists"
                    },

                    'class_frm_class_tution_fees': {
                        required: "This field is required.",
                        digits: "Only Numeric Accepted"
                    },
                    'class_frm_class_fees_deadline': {
                        required: "This field is required."
                    },
                    'class_frm_dept_id': {
                        required: "This field is required."
                    },
                    'class_frm_stream_id': {
                        required: "This field is required."
                    },
                    'class_frm_semester': {
                        required: "This field is required.",
                        remote: "This Semester For This Stream Already Exists"
                    }
                }
            });
            /*************************************
             Add Edit Class End
             *************************************/

        });
    </script>