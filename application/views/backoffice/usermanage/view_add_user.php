<?= form_open("backoffice/ClassManagement/addEditClass", array('id' => 'user_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($user_data)) ? 'editUser' : 'addUser')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($user_data)) ? $user_data['user_id'] : '')) ?>

<div class="row">

    <!-- User Email -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'user_frm_user_email', 'id' => 'user_frm_user_email', 'class' => 'form-control', 'placeholder' => 'User  Email', 'value' => (isset($user_data)) ? $user_data['user_email'] : '')) ?>
        </div>
    </div>

    <!-- Class Mobile  -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'user_frm_user_mobile', 'id' => 'user_frm_user_mobile', 'class' => 'form-control', 'placeholder' => 'User Mobile', 'value' => (isset($user_data)) ? $user_data['user_mobile'] : '')) ?>
        </div>
    </div>

    <!-- User Pass -->
    <div class="col-sm-6">
        <div class="form-group">
            <?= form_input(array('name' => 'user_frm_user_pass', 'id' => 'user_frm_user_pass', 'class' => 'form-control', 'placeholder' => 'User Password','readonly'=>'readonly')) ?>
        </div>
    </div>


    <!-- User Generate Password  -->
    <div class="col-sm-6">
        <div class="form-group">
            <button type="button" class="btn btn-info btn-top" id="btn_genrate_pas" onclick="generatePassword()">Generate Password</button>
        </div>
    </div>


    <!-- Select User Type -->
    <div class="col-sm-12">
        <select name="user_frm_user_type_id" id="user_frm_user_type_id" style="width: 30%" class="form-control">
            <?php foreach ($user_type_list as $row): ?>
                <?php if (isset($user_data['user_type_id'])): ?>
                    <?php if (($user_data['user_type_id']) == $row['user_type_id']): ?>
                        <option value="<?= $row['user_type_id'] ?>" selected><?= $row['user_type_name'] ?></option>
                    <?php else: ?>
                        <option value="<?= $row['user_type_id'] ?>"><?= $row['user_type_name'] ?></option>
                    <?php endif; ?>
                <?php else: ?>
                    <option value="<?= $row['user_type_id'] ?>"><?= $row['user_type_name'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($user_data)) ? '<i class="ti-save"></i> Save' : '<i class="ti-plus"></i> Add' ?>
        </button>
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ready(function () {
            $('#user_frm_user_type_id').select2();

            /*************************************
             Add Edit User
             *************************************/
            $("#user_frm").validate({
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
                    'user_frm_user_email': {
                        required: true,
                        email: true,
                        remote: {
                            url: base_url + "backoffice/StudentManage/checkexists/" + "user_id" + "/" + update_id,
                            type: "post",
                            data: {
                                'table': 'user_master',
                                'field': 'user_email',
                                user_email: function () {
                                    return $('#user_frm_user_email').val();
                                }
                            }
                        }
                    },
                    'user_frm_user_mobile': {
                        required: true,
                        regex: '^[789]\\d{9}$',
                        remote: {
                            url: base_url + "backoffice/StudentManage/checkexists/" + "user_mobile" + "/" + update_id,
                            type: "post",
                            data: {
                                'table': 'user_master',
                                'field': 'user_mobile',
                                user_mobile: function () {
                                    return $('#user_frm_user_mobile').val();
                                }
                            }
                        }
                    },
                    'user_frm_user_type_id': {
                        required: true
                    },
                    'user_frm_user_pass': {
                        required: true
                    }

                },

                messages: {
                    'user_frm_user_email': {
                        required: "This field is required.",
                        remote: "User Email already Exists"
                    },
                    'user_frm_user_mobile': {
                        required: "This field is required.",
                        remote: "Mobile NO already Exists",
                        regex: "Invalid Mobile No"
                    },
                    'user_frm_user_type_id': {
                        required: "This field is required."
                    },
                    'user_frm_user_pass': {
                        required: "This field is required."
                    }
                }
            });
            /*************************************
             Add Edit User End
             *************************************/

        });



            function generatePassword() {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                for (var i = 0; i < 5; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));

                $('#user_frm_user_pass').val(text);
            }


    </script>
