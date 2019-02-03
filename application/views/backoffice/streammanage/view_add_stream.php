<?= form_open("backoffice/StreamManage/addEditStream", array('id' => 'stream_frm', 'method' => 'post')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'action', 'id' => 'action', 'value' => (isset($stream_data)) ? 'editStream' : 'addStream')) ?>
<?= form_input(array('type' => 'hidden', 'name' => 'update_id', 'id' => 'update_id', 'value' => (isset($stream_data)) ? $stream_data['stream_id'] : '')) ?>

<div class="row">

    <!-- Stream Name  -->
    <div class="col-sm-12">
        <div class="form-group">
            <?= form_input(array('name' => 'stream_frm_stream_name', 'id' => 'stream_frm_stream_name', 'class' => 'form-control', 'placeholder' => 'Stream  Name', 'value' => (isset($stream_data)) ? $stream_data['stream_name'] : '')) ?>
        </div>
    </div>

    <!-- Stream NO Of Semester  -->
    <div class="col-sm-12">
        <div class="form-group">
            <?= form_input(array('name' => 'stream_frm_no_of_semester', 'type'=>'number','id' => 'stream_frm_no_of_semester', 'class' => 'form-control', 'placeholder' => 'No of Semester', 'value' => (isset($stream_data)) ? $stream_data['no_of_semester'] : '')) ?>
        </div>
    </div>

    <!--  submit -->
    <div class="col-md-12">
        <button type="submit" id="btn-add-user" class="btn btn-success m-t-10 pull-right">
            <?= (isset($stream_data)) ? '<i class="ti-save"></i> Save' : '<i class="ti-plus"></i> Add' ?>
        </button
    </div>
    <?= form_close(); ?>

    <script>

        var update_id = $('#update_id').val();
        $(document).ready(function () {

            /*************************************
             Add Edit Stream
             *************************************/
            $("#stream_frm").validate({
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
                        'stream_frm_stream_name': {
                            required: true,
                            remote: {
                                url: base_url+"backoffice/StreamManage/checkexists/"+"stream_id"+"/"+update_id,
                                type: "post",
                                data: {
                                    'table': 'stream_master',
                                    'field': 'stream_name',
                                    stream_name: function () {
                                        return $('#stream_frm_stream_name').val();
                                    }
                                }
                            }
                        },
                        'stream_frm_no_of_semester':{
                            required: true,
                            range:[1,8]
                        }
                    },
                messages:
                    {
                        'stream_frm_stream_name': {
                            required: "This field is required.",
                            remote:"Stream Name already Exists"
                        },
                        'stream_frm_no_of_semester': {
                            required: "This field is required.",
                            range:"Should be 1 to 8"
                        }
                    }
            });
            /*************************************
             Add Edit Sream End
             *************************************/

        });
    </script>