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
        //if(isset($_POST['pay_student_fees_frm_stud_id'])){
            $OrWhere = array('stud_id'=>1);
            $val = '
                student_master.stud_id,
                student_master.enroll_no,
                student_master.stud_name,
                student_master.stud_gender,
                student_master.stud_father_name,
                student_master.stud_mobile_no,
                
                student_master.stud_class_id,
                class_master.class_name,
                stream_master.stream_id,
                stream_master.stream_name,
                student_master.stud_sem_no
                ';
            $student_details = $this->CommonModel
                ->dbjoin(
                    array(
                        array(
                            'table' => 'stream_master',
                            'condition' => 'student_master.stream_id = stream_master.stream_id',
                            'jointype'=>'inner'
                        ),
                        array(
                            'table' => 'class_master',
                            'condition' => 'student_master.stud_class_id = class_master.class_id',
                            'jointype'=>'inner'
                        )
                    ))
                ->getRecord('student_master', $OrWhere, $val)->row_array();

                $this->pageData['student_details'] = $student_details;

                //total class tutions in stream
                 $class_list = $this->CommonModel
                     ->dbjoin(
                         array(
                             array(
                                 'table' => 'stream_master',
                                 'condition' => 'class_master.stream_id = stream_master.stream_id',
                                 'jointype'=>'inner'
                             )
                         ))
                     ->dbOrderBy(array('class_id' => 'ASC'))
                     ->getRecord('class_master','class_master.stream_id='.$student_details['stream_id'],'class_master.*,stream_master.stream_name')->result_array();


                 $temp = $class_list;
                 $class_list = array();

                 foreach ($temp as $value):
                     $class_list[$value['class_id']] = $value;
                 endforeach;

                 //total paid class fees
                $where = array(
                    'stud_id'=>$student_details['stud_id'],
                    'is_tution_fees'=>1,
                    'paid_fees_records.stream_id'=>$student_details['stream_id']
                );
                $val ='
                    paid_fees_records.receipt_id,
                    paid_fees_records.stud_id,
                    class_master.class_id,
                    class_master.class_name,
                    stream_master.stream_name,
                    paid_fees_records.semester,
                    paid_fees_records.tution_fees,
                    paid_fees_records.tution_fees 
                ';
                $paid_class_fees_list = $this->CommonModel
                    ->dbjoin(
                        array(
                            array(
                                'table' => 'class_master',
                                'condition' => 'paid_fees_records.class_id = class_master.class_id',
                                'jointype'=>'inner'
                            ),
                            array(
                                'table' => 'stream_master',
                                'condition' => 'paid_fees_records.stream_id = stream_master.stream_id',
                                'jointype'=>'inner'
                            )
                        ))
                    ->getRecord('paid_fees_records',$where,$val)->result_array();



                $remaing_class_fees = $class_list;

                foreach ($paid_class_fees_list as $value):
                    if(key_exists($value['class_id'],$remaing_class_fees)){
                        unset($remaing_class_fees[$value['class_id']]);
                    }
                endforeach;

                    $curent_date = date("Y-m-d");
                    //count late fees
                    foreach ($remaing_class_fees as $value):
                        $dStart = new DateTime($curent_date);
                        $dEnd  = new DateTime($value['class_fees_deadline']);
                        $dDiff = $dStart->diff($dEnd);
                        if($dDiff->days > 0){
                            $remaing_class_fees[$value['class_id']]['late_days'] = $dDiff->days;
                            $remaing_class_fees[$value['class_id']]['late_fees'] = $dDiff->days * 10;
                        }else{
                            $remaing_class_fees[$value['class_id']]['late_days'] = 0;
                            $remaing_class_fees[$value['class_id']]['late_fees'] = 0;
                        }
                        $remaing_class_fees[$value['class_id']]['late_days'] = $dDiff->days;
                        $remaing_class_fees[$value['class_id']]['late_fees'] = $dDiff->days * 10;
                    endforeach;

                $this->pageData['paid_class_fees_list'] = $paid_class_fees_list;
                $this->pageData['remaing_class_fees'] = $remaing_class_fees;
                $this->pageData['total_class_list'] = $class_list;

                 //get paid semester fees list

       /* }else{

        }*/



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