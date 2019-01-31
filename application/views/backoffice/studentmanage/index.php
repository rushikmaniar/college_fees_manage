<div class="card">
    <div class="card-body">
        <div class="col-sm-12 col-md-12">
            <button type="button" class="btn btn-success btn-top" id="btn_add_user"
                    onclick="ajaxModel('backoffice/StudentManage/viewAddStudentModal','Add New Student','modal-lg')">
                <i class="ti-plus"></i> Add Student
            </button>
        </div>
        <table class="display table table-hover table-striped table-bordered dataTable" id="StudentTable">
            <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Enroll No</th>
                <th>Student Name</th>
                <th>Student Gender</th>
                <th>Student Father Name</th>
                <th>Student Mobile no</th>
                <th>Student Class</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($student_data as $row): ?>
                <tr>
                    <!-- Class Code -->
                    <td><?= $row['stud_id'] ?></td>
                    <td><?= $row['enroll_no'] ?></td>
                    <td><?= $row['stud_name'] ?></td>
                    <td><?= $row['stud_gender'] ?></td>
                    <td><?= $row['stud_father_name'] ?></td>
                    <td><?= $row['stud_mobile_no'] ?></td>
                    <td><?= $row['class_name'] ?></td>


                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm"
                                    data-container="body" title="Edit User"
                                    onclick="ajaxModel('backoffice/StudentManage/viewEditStudentModal/<?= $row['stud_id'] ?>','Edit Student',800)">
                                <i class="ti-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm"
                                    data-container="body" title="Delete Student" onclick="deleteStudent(<?= $row['stud_id'] ?>)">
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

        $('#StudentTable').dataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
    /*************************************
     Delete Student
     *************************************/
    function deleteStudent(stud_id) {
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
                url: base_url + "backoffice/StudentManage/deleteStudent",
                type: "POST",
                dataType: "json",
                data: {"stud_id": stud_id},
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
     Delete Student End
     *************************************/
</script>