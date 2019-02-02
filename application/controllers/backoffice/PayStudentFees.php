<?php
/**
 * Created by PhpStorm.
 * User: aakashwin81
 * Date: 002 02-02-2019
 * Time: 09:09 PM
 */

class PayStudentFees extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        if(isset($_POST['pay_student_fees_frm_stud_id'])){
            $OrWhere = array('stud_id'=>$_POST['pay_student_fees_frm_stud_id']);
            $val = '
                student_master.*
                ';
            $student_details = $this->CommonModel
                ->getRecord('student_master', $OrWhere, $val)->row_array();

            $this->pageData['student_details'] = $student_details;
        }else{

        }



        $OrWhere = array();
        $val = '
        student_master.*
        ';
        $student_data = $this->CommonModel
            ->dbOrderBy(array('student_master.stud_id' => 'DESC'))
            ->getRecord('student_master', $OrWhere, $val)->result_array();

        $this->pageTitle = 'Pay Student Fees';
        $this->pageData['student_list'] = $student_data;
        $this->render("paystudentfees/index.php");

    }
}