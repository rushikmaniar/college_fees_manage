<div class="card">
    <div class="card-body">
        <?= form_open("backoffice/PayStudentFees", array('id' => 'pay_student_fees_frm', 'method' => 'post')) ?>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <h3>Select Student</h3>
                    <select name="pay_student_fees_frm_stud_id" id="pay_student_fees_frm_stud_id" style="width: 100%"
                            class="form-control">
                        <?php foreach ($student_list as $row): ?>
                            <option value="<?= $row['stud_id'] ?>"><?= $row['stud_id'] . '  -  ' . $row['stud_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <button type="button" class="btn btn-success form-control" style="margin-top: 30px"> Get Status
                    </button>
                </div>
            </div>

        </div>
        <?= form_close(); ?>

        <table class="display nowrap table table-hover table-striped table-bordered " style="width: 100%"
               id="PayFeesTable">
            <thead>
            <tr>
                <th>Heading</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Student ID</td>
                <td><?= (isset($student_details)) ? $student_details['stud_id'] : '' ?></td>
            </tr>
            <tr>
                <td>Enroll No</td>
                <td><?= (isset($student_details)) ? $student_details['enroll_no'] : '' ?></td>
            </tr>
            <tr>
                <td>Student Name</td>
                <td><?= (isset($student_details)) ? $student_details['stud_name'] : '' ?></td>
            </tr>
            <tr>
                <td>Student Gender</td>
                <td><?= (isset($student_details)) ? $student_details['stud_gender'] : '' ?></td>
            </tr>
            <tr>
                <td>Student Father Name</td>
                <td><?= (isset($student_details)) ? $student_details['stud_father_name'] : '' ?></td>
            </tr>
            <tr>
                <td>Student Mobile No</td>
                <td><?= (isset($student_details)) ? $student_details['stud_mobile_no'] : '' ?></td>
            </tr>
            <tr>
                <td>Student Stream Name</td>
                <td><?= (isset($student_details)) ? $student_details['stream_name'] : '' ?></td>
            </tr>
            <tr>
                <td>Student Current Semester</td>
                <td><?= (isset($student_details)) ? $student_details['stud_sem_no'] : '' ?></td>
            </tr>
            <tr>
                <td>Student Paid Semester Fees</td>
                <td>
                    <?php
                    if ((isset($paid_class_fees_list))):
                        foreach ($paid_class_fees_list as $value):?>
                            <ul>
                                <li>Receipt ID : <?= $value['receipt_id']; ?></li>
                                <li>Class Name : <?= $value['class_name']; ?></li>
                                <li>Stream Name : <?= $value['stream_name']; ?></li>
                                <li>Semester : <?= $value['semester']; ?></li>
                                <li>Tution Fees : <?= $value['tution_fees']; ?></li>
                            </ul>
                            <hr>
                        <?php endforeach;
                    endif;
                    ?>
                </td>
            </tr>
            <tr>
                <td>Student Pending Semester Fees</td>
                <td>
                    <?php
                    if ((isset($remaing_class_fees))):
                        foreach ($remaing_class_fees as $value):?>
                            <form name="tution_fees_frm" method="post" action="<?= base_url(); ?>backoffice/PayStudentFees/payTutionFeesOnline">
                            <ul>
                                <li>
                                    <input type="hidden" name="tution_fees_frm_stud_id" value="<?= $row['stud_id']; ?>">
                                    <input type="hidden" name="tution_fees_frm_class_id" value="<?= $value['class_id']; ?>">
                                    <input type="hidden" name="tution_fees_frm_stream_id" value="<?= $value['stream_id']; ?>">
                                    <input type="hidden" name="tution_fees_frm_semester" value="<?= $value['semester']; ?>">
                                    <input type="hidden" name="tution_fees_frm_class_name" value="<?= $value['class_name']; ?>">
                                    Class Name : <?= $value['class_name']; ?>
                                </li>
                                <li>
                                    Stream Name : <?= $value['stream_name']; ?></li>
                                <li>Semester : <?= $value['semester']; ?></li>
                                <li>
                                    <input type="hidden" name="tution_fees_frm_tution_fees_amt" value="<?=$value['class_tution_fees']?>">
                                    Tution Fees To Pay : <?= $value['class_tution_fees']; ?></li>
                                <li>
                                    <button type="submit" class="btn-sm btn-success" onclick="if(!confirm('Are U sure . Want To Pay Tution Fees'))return false;">Pay Fees Online</button>
                                </li>
                            </ul>
                            </form>
                            <hr>
                        <?php endforeach;
                    endif;
                    ?>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#pay_student_fees_frm_stud_id').select2();
    });
</script>