<?php
/**
 * Created by PhpStorm.
 * User: MEET
 * Date: 4-2-2019
 * Time: 7:56 PM
 */ ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <?php if ((isset($success_data))): ?>
                <h2 class="h2 text-success" align="center">Payment Success</h2>
                <table class="display nowrap table table-hover table-striped table-bordered dataTable"
                       id="SuccessTable">
                    <thead>
                    <tr>
                        <th>Heading</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Receipt No</td>
                        <td><?= (isset($success_data['receipt_id']))?$success_data['receipt_id']:''; ?></td>
                    </tr>
                    <tr>
                        <td>Payment Id</td>
                        <td><?= (isset($success_data['payment_id']))?$success_data['payment_id']:''; ?></td>
                    </tr>
                    <tr>
                        <td>Student Name</td>
                        <td><?= (isset($success_data['stud_name']))?$success_data['stud_name']:''; ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?= (isset($success_data['user_name']))?$success_data['user_name']:''; ?></td>
                    </tr>
                    <tr>
                        <td>Class Name</td>
                        <td><?= (isset($success_data['class_name']))?$success_data['class_name']:''; ?></td>
                    </tr>
                    <tr>
                        <td>Receipt Date</td>
                        <td><?= (isset($success_data['receipt_date']))?$success_data['receipt_date']:''; ?></td>
                    </tr>
                    <tr>
                        <td>Payment Amt</td>
                        <td><?= (isset($success_data['payed_amt']))?$success_data['payed_amt']:''; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12" align="center">
                <a href="<?= base_url(); ?>backoffice/PayStudentFees/index"><button type="button" class="btn btn-success">Go Back!</button></a>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#SuccessTable').dataTable({
                    "scrollX": true,
                    dom: 'Bfrtip',
                    buttons: [
                        'pdf', 'print'
                    ]
                });

            });
        </script>
        <?php
        else:?>
            <h3 class="h3 danger">Data missing</h3>
        <?php endif; ?>
    </div>
</div>
