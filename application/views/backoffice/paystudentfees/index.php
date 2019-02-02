<div class="card">
    <div class="card-body">
        <?= form_open("backoffice/PayStudentFees", array('id' => 'pay_student_fees_frm', 'method' => 'post')) ?>
        <div class="col-sm-6 col-md-6">
            <div class="col-sm-12 cold-md-12">
                <h3>Select Student</h3>
            </div>
            <div class="col-sm-12">
                <select name="pay_student_fees_frm_stud_id" id="pay_student_fees_frm_stud_id" style="width: 30%" class="form-control">
                    <?php foreach ($student_list as $row): ?>
                            <option value="<?= $row['stud_id'] ?>"><?= $row['stud_id'].'  -  '.$row['stud_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="btn-sm btn-success">Get Status </button>
            </div>
            
        </div>
        <?= form_close(); ?>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#pay_student_fees_frm_stud_id').select2();
    });
</script>