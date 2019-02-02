<div class="card">
    <div class="card-body">
        <table class="display nowrap table table-hover table-striped table-bordered dataTable" id="FeesReceiptRecord">
            <thead>
            <tr>

                <th>Fees Receipt ID</th>
                <th>Student Name</th>
                <th>User Email</th>
                <th>Receipt Date</th>
                <th>Class Name</th>
                <th>final Total</th>
                <th>Mode Of Payment</th>
                <th>Payed Amount</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($fees_receipt_records_data as $row): ?>
                <tr>
                    <!-- Class Code -->
                    <td><?= $row['fee_receipt_id'] ?></td>
                    <td><?= $row['stud_name'] ?></td>
                    <td>&#8377; <?= $row['user_email'] ?></td>
                    <td><?= $row['receipt_date'] ?></td>
                    <td><?= $row['class_name'] ?></td>
                    <td><?= $row['final_total'] ?></td>
                    <td><?= $row['mode_of_payment'] ?></td>
                    <td><?= $row['payed_amount'] ?></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm"
                                    data-container="body" title="Edit User"
                                    >
                                <i class="ti-pencil-alt"></i>
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

        $('#FeesReceiptRecord').dataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
    
</script>