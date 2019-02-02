<?php
/**
 * Created by PhpStorm.
 * User: rushikwin8
 * Date: 006 06-07-2018
 * Time: 08:54 PM
 */
?>
<form id="frm_change_password" method="post" action="<?= base_url('backoffice/Profile/updatePassword')?>">
    <div class="row col-sm-12">

        <!-- User Old Password -->
        <div class="col-sm-12 form-group">
            <div class="input-group">
                <label class="col-sm-12">Old Password</label>
                <input type="hidden" name="frm_change_password_user_id" id="frm_change_password_user_id" value="<?= $user_id ?>">
                <input type="password" class="form-control" id="frm_change_password_oldpassword"
                       name="frm_change_password_oldpassword"
                       placeholder="Enter Old Password">

            </div>
        </div>


        <!-- User New Password -->
        <div class="col-sm-12 form-group">
            <div class="input-group">
                <label class="col-sm-12">New Password</label>
                <input type="password" class="form-control" id="frm_change_password_newpassword"
                       name="frm_change_password_newpassword"
                       placeholder="Enter New Password">

            </div>
        </div>

        <!-- User Confirm Password -->
        <div class="col-sm-12 form-group">
            <div class="input-group">
                <label class="col-sm-12">Confirm Password</label>
                <input type="password" class="form-control" id="frm_change_password_confirmpassword"
                       name="frm_change_password_confirmpassword"
                       placeholder="Enter Confirm Password">

            </div>
        </div>

        <!-- submit  -->
        <div class="col-sm-6">
            <div class="input-group form-group">
                <button type="submit" class="btn btn-primary"><i class="ti-save"></i> Submit</button>
            </div>
        </div>


    </div>
</form>
<script type="text/javascript">
    $(document).ajaxComplete(function () {
        var update_id = $('#frm_change_password_user_id').val();
        $("#frm_change_password").validate({
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
            rules: {

                'frm_change_password_oldpassword': {
                    required: true,
                    remote: {
                        url: base_url + "backoffice/Profile/checkPassword/",
                        type: "post",
                        data: {
                            user_pass: function () {
                                return $('#frm_change_password_oldpassword').val();
                            }
                        }
                    }
                },
                "frm_change_password_newpassword":{
                    required:true
                },
                "frm_change_password_confirmpassword":{
                    required:true,
                    equalTo:'#frm_change_password_newpassword'
                }


            },
            messages: {
                'frm_change_password_oldpassword': {
                    required: "This field is required.",
                    remote: "Old Password Wrong"
                },
                'frm_change_password_newpassword': {
                    required: "This field is required."
                },
                "frm_change_password_confirmpassword":{
                    required: "This field is required.",
                    equalTo:"Old Password and confirm Password Should be same."
                }
            }
        });

    });

</script>

