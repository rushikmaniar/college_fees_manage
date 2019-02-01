<div class="card">
    <div class="card-body">
        <div class="col-sm-12 col-md-12">
            <button type="button"
                    class="btn btn-success btn-top"
                    id="btn_add_extra_fees"
                    onclick="ajaxModel('backoffice/ExtraFeesStructure/viewAddExtraFeesStructureModal','Add Extra Fees','modal-md')"
            >
                <i class="ti-plus"></i> Add Extra Fees
            </button>
        </div>
        <table class="display nowrap table table-hover table-striped table-bordered dataTable" id="FeesStructureTable">
            <thead>
            <tr>
                <th>Fees Name</th>
                <th>Fees Amount</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($extra_fees_details_structure as $row): ?>
                <tr>
                    <td><?= $row['fees_name'] ?></td>
                    <td>&#8377; <?= $row['fees_amt'] ?></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm"
                                    data-container="body" title="Edit Extra Fees Strucuture"
                                    onclick="ajaxModel('backoffice/ExtraFeesStructure/viewEditExtraFeesStructureModal/<?= $row['row_id'] ?>','Edit Fees Structure','modal-lg')">
                                <i class="ti-pencil-alt"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-danger btn-sm"
                                    data-container="body"
                                    title="Delete Extra Fees "
                                    onclick="deleteExtraFeesStructure(<?=$row['row_id']?>)">
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

        $('#FeesStructureTable').dataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });

    /*************************************
     Delete Extra Fees
     *************************************/
    function deleteExtraFeesStructure(row_id) {
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
                url: base_url + "backoffice/ExtraFeesStructure/deleteExtraFeesStructure",
                type: "POST",
                dataType: "json",
                data: {"row_id": row_id},
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
     Delete Extra Fees End
     *************************************/
</script>