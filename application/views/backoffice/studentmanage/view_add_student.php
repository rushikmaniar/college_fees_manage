<?= form_open("backoffice/StudentManage/addEditStudent", array('id' => 'student_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($student_data)) ? 'editStudent' : 'addStudent')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($student_data)) ? $student_data['stud_id'] : '')) ?>

<div class="row">

    <!-- Student Id -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'student_frm_stud_id', 'id' => 'student_frm_stud_id', 'class' => 'form-control', 'placeholder' => 'Student Id', 'value' => (isset($student_data)) ? $student_data['stud_id'] : '')) ?>
        </div>
    </div>

    <!-- Student EnrollNo  -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'student_frm_enroll_no', 'id' => 'student_frm_enroll_no', 'class' => 'form-control', 'placeholder' => 'Student Enrollno', 'value' => (isset($student_data)) ? $student_data['enroll_no'] : '')) ?>
        </div>
    </div>

    <!-- Student Name  -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'student_frm_stud_name', 'id' => 'student_frm_stud_name', 'class' => 'form-control', 'placeholder' => 'Student Name', 'value' => (isset($student_data)) ? $student_data['stud_name'] : '')) ?>
        </div>
    </div>

    <!-- Student Gender -->
    <div class="col-sm-6">
        <div class="form-group">

            <label class="custom-control custom-radio custom-control-inline">
                <input type="radio" name="student_frm_stud_gender" class="custom-control-input" checked value="Male">
                <span class="custom-control-label">Male</span>
            </label>
            <label class="custom-control custom-radio custom-control-inline">
                <input type="radio" name="student_frm_stud_gender" class="custom-control-input" value="Female"
                    <?php if((isset($student_data))){
                        if($student_data['stud_gender'] == "Female"){
                            echo ' checked=""';
                        }
                    }?>
                >
                <span class="custom-control-label">Female</span>
            </label>
            <label class="custom-control custom-radio custom-control-inline">
                <input type="radio" name="student_frm_stud_gender" class="custom-control-input" value="Other"
                    <?php if((isset($student_data))){
                        if($student_data['stud_gender'] == "Other"){
                            echo ' checked=""';
                        }
                    }?>
                >
                <span class="custom-control-label">Other</span>
            </label>

        </div>
    </div>

    <!-- Student Father Name  -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'student_frm_stud_father_name', 'id' => 'student_frm_stud_father_name', 'class' => 'form-control', 'placeholder' => 'Student Father Name', 'value' => (isset($student_data)) ? $student_data['stud_father_name'] : '')) ?>
        </div>
    </div>

    <!-- Student Mobile No -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'student_frm_stud_mobile_no', 'id' => 'student_frm_stud_mobile_no', 'class' => 'form-control', 'placeholder' => 'Student Mobile No', 'value' => (isset($student_data)) ? $student_data['stud_mobile_no'] : '')) ?>
        </div>
    </div>




    <!-- Select Class -->
    <div class="col-sm-12">
        <select name="student_frm_stud_class_id" id="student_frm_stud_class_id" style="width: 30%" class="form-control">
            <?php foreach ($class_list as $row): ?>
                <?php if (isset($student_data['class_id'])): ?>
                    <?php if (($student_data['class_id']) == $row['class_id']): ?>
                        <option value="<?= $row['class_id'] ?>" selected><?= $row['class_name'] ?></option>
                    <?php else: ?>
                        <option value="<?= $row['class_id'] ?>"><?= $row['class_name'] ?></option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="<?= $row['class_id'] ?>"><?= $row['class_name'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($student_data)) ? '<i class="ti-save"></i> Save' : '<i class="ti-plus"></i> Add' ?>
        </button>
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ready(function () {
            $('#student_frm_stud_class_name').select2();

            /*************************************
             Add Edit Student
             *************************************/
            $("#student_frm").validate({
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
                    'student_frm_stud_id': {
                        required: true,
                        digits: true,
                        remote: {
                            url: base_url + "backoffice/StudentManage/checkexists/" + "stud_id" + "/" + update_id,
                            type: "post",
                            data: {
                                'table': 'student_master',
                                'field': 'stud_id',
                                stud_id: function () {
                                    return $('#student_frm_stud_id').val();
                                }
                            }
                        }
                    },
                    'student_frm_enroll_no': {
                        required: true,
                        digits: true,
                        remote: {
                            url: base_url + "backoffice/ClassManagement/checkexists/" + "class_name" + "/" + update_id,
                            type: "post",
                            data: {
                                'table': 'student_master',
                                'field': 'enroll_no',
                                class_name: function () {
                                    return $('#student_frm_enroll_no').val();
                                }
                            }
                        }
                    },
                    'student_frm_stud_name': {
                        required: true
                    },
                    'student_frm_stud_gender': {
                        required: true
                    },
                    'student_frm_stud_father_name': {
                        required: true
                    },
                    'student_frm_stud_mobile_no': {
                        required: true
                    },
                    'student_frm_stud_class_id': {
                        required: true
                    }

                },

                messages: {
                    'student_frm_stud_id': {
                        required: "This field is required.",
                        remote: "Student Id already Exists",
                        digits: "Only Numeric Accepted"
                    },
                    'student_frm_enroll_no': {
                        required: "This field is required.",
                        remote: "Enrollno already Exists",
                        digits: "Only Numeric Accepted"
                    },
                    'student_frm_stud_name': {
                        required: "This field is required."
                    },
                    'student_frm_stud_gender': {
                        required: "This field is required."
                    },
                    'student_frm_stud_father_name': {
                        required: "This field is required."
                    },
                    'student_frm_stud_mobile_no': {
                        required: "This field is required."
                    },
                    'student_frm_stud_class_id': {
                        required: "This field is required."
                    }
                }
            });
            /*************************************
             Add Edit Student End
             *************************************/

        });
    </script>