<div class="card">

    <div class="card-body">
        <div class="col-sm-12 col-md-12">
            <button type="button" class="btn btn-success btn-top" id="btn_add_user"
                    onclick="ajaxModel('backoffice/UserManage/viewAddUserModal','Add New User','modal-lg')">
                <i class="ti-plus"></i> Add User
            </button>
        </div>
        <table class="display table table-hover table-striped table-bordered dataTable fixed-size" id="UserTable">
            <thead>
            <tr>
                <th>User Id</th>
                <th>User Email</th>
                <th>User Mobile</th>
                <th>User Type</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($user_data as $row): ?>
                <tr>
                    <!-- User Id -->
                    <td><?= $row['user_id'] ?></td>
                    <td><?= $row['user_email'] ?></td>
                    <td><?= ($row['user_mobile']) ?></td>
                    <td><?= ($row['user_type_name']);?></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm"
                                    data-container="body" title="Edit User"
                                    onclick="ajaxModel('backoffice/UserManage/viewEditUserModal/<?= $row['user_id'] ?>','Edit User',800)">
                                <i class="ti-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm"
                                    data-container="body" title="Delete User" onclick="deleteUser(<?= $row['user_id'] ?>)">
                                <i class="ti-close"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {

        $('#UserTable').dataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
    /*************************************
     Delete User
     *************************************/
    function deleteUser(user_id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {

            $.ajax({
                url: base_url + "backoffice/UserManage/deleteUser",
                type: "POST",
                dataType: "json",
                data: {"user_id": user_id},
                success: function (result) {
                    if (result.code == 1 && result.code != '') {
                        //success notifiacation
                        toastr["success"](result.message, "Success");
                    }
                    else {
                        //error notification
                        toastr["error"](result.message, "Error");
                    }
                },
                error: function (result) {
                    console.log(result);
                }
            });
            setTimeout(function () {
                location.reload();
            }, 1000);


        }).catch(swal.noop);
    }
    /*************************************
     Delete User End
     *************************************/
</script>