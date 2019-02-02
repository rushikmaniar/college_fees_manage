<div class="card">
    <div class="card-body">
        <div class="col-sm-12 col-md-12">
                        <button type="button"
                                class="btn btn-success btn-top"
                                id="btn_add_user"
                                onclick="ajaxModel('backoffice/StreamManage/viewAddStreamModal','Add New Stream','modal-lg')"
                        >
                            <i class="ti-plus"></i> Add Stream
                        </button>
        </div>
            <table class="display nowrap table table-hover table-striped table-bordered dataTable" id="StreamTable">
                        <thead>
                        <tr>
                            <th>Stream ID</th>
                            <th>Stream Name</th>
                            <th>Stream No Of Semester</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($stream_data as $row): ?>
                            <tr id="row_<?=$row['stream_id']?>">
                                <td><?=$row['stream_id']?></td>
                                <td><?=$row['stream_name']?></td>
                                <td><?=$row['no_of_semester']?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button"
                                                class="btn btn-success btn-sm"
                                                data-container="body" title="Edit Stream"

                                                onclick="ajaxModel('backoffice/StreamManage/viewEditStreamModal/<?=$row['stream_id']?>','Edit Stream','modal-lg')">
                                            <i class="ti-pencil-alt"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-container="body"
                                                title="Delete Stream"
                                                onclick="deletestream(<?=$row['stream_id']?>)">
                                            <i class="ti-close"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
            </div>

    </div>
<script>
    $(document).ready(function () {

        $('#StreamTable').dataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
	/*************************************
				Delete Stream
	*************************************/
    function deletestream(stream_id)
    {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result)  {

            $.ajax({
            url: base_url + "backoffice/StreamManage/deleteStream",
            type: "POST",
            dataType: "json",
            data: {"stream_id": stream_id},
            success: function (result) {
                if (result.code == 1 && result.code != '') {
                    toastr["success"](result.message, "Success");
                    setTimeout(function () {
                        $('#row_'+stream_id).remove();
                    },1000);
                }
                else {
                    toastr["error"](result.message, "Error");
                }
            },
            error:function (result) {
                console.log(result);
            }
        });



    }).catch(swal.noop);
    }
	/*************************************
				Delete Stream End
	*************************************/
</script>