<?php
/**
 * Created by PhpStorm.
 * User: aakashwin81
 * Date: 002 02-02-2019
 * Time: 09:09 PM
 */
require_once(FCPATH . 'application/libraries/instamojo.php');

class PayStudentFees extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //if(isset($_POST['pay_student_fees_frm_stud_id'])){
        $OrWhere = array('stud_id' => 1);
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
                        'jointype' => 'inner'
                    ),
                    array(
                        'table' => 'class_master',
                        'condition' => 'student_master.stud_class_id = class_master.class_id',
                        'jointype' => 'inner'
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
                        'jointype' => 'inner'
                    )
                ))
            ->dbOrderBy(array('class_id' => 'ASC'))
            ->getRecord('class_master', 'class_master.stream_id=' . $student_details['stream_id'], 'class_master.*,stream_master.stream_name')->result_array();


        $temp = $class_list;
        $class_list = array();

        foreach ($temp as $value):
            $class_list[$value['class_id']] = $value;
        endforeach;

        //total paid class fees
        $where = array(
            'stud_id' => $student_details['stud_id'],
            'is_tution_fees' => 1,
            'paid_fees_records.stream_id' => $student_details['stream_id']
        );
        $val = '
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
                        'jointype' => 'inner'
                    ),
                    array(
                        'table' => 'stream_master',
                        'condition' => 'paid_fees_records.stream_id = stream_master.stream_id',
                        'jointype' => 'inner'
                    )
                ))
            ->getRecord('paid_fees_records', $where, $val)->result_array();


        $remaing_class_fees = $class_list;

        foreach ($paid_class_fees_list as $value):
            if (key_exists($value['class_id'], $remaing_class_fees)) {
                unset($remaing_class_fees[$value['class_id']]);
            }
        endforeach;

        $curent_date = date("Y-m-d");
        //count late fees
        foreach ($remaing_class_fees as $value):
            $dStart = new DateTime($curent_date);
            $dEnd = new DateTime($value['class_fees_deadline']);
            $dDiff = $dStart->diff($dEnd);
            if ($dDiff->days > 0) {
                $remaing_class_fees[$value['class_id']]['late_days'] = $dDiff->days;
                $remaing_class_fees[$value['class_id']]['late_fees'] = $dDiff->days * 10;
            } else {
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

    /*
     * Pay Tution Fees
     * */
    public function payTutionFeesOnline()
    {
        if (
            (isset($_POST['tution_fees_frm_stud_id'])) &&
            (isset($_POST['tution_fees_frm_class_name'])) &&
            (isset($_POST['tution_fees_frm_class_id'])) &&
            (isset($_POST['tution_fees_frm_stream_id'])) &&
            (isset($_POST['tution_fees_frm_semester'])) &&
            (isset($_POST['tution_fees_frm_tution_fees_amt']))) {

            $userdata = $this->session->userdata('dakshina-admin');
            //generate instamojo request


            $instamojo_obj = new Instamojo($this->site_settings_data['instamojo_api_key'], $this->site_settings_data['instamojo_api_token'], 'https://test.instamojo.com/api/1.1/');


            try {
                $response = $instamojo_obj->paymentRequestCreate(
                    array(
                        "purpose" => $_POST['tution_fees_frm_class_name'] . ' Tution Fees ',
                        "amount" => $_POST['tution_fees_frm_tution_fees_amt'],
                        "send_email" => true,
                        "send_sms" => true,
                        "phone" => 8238288595,
                        "email" => $userdata['user_email'],
                        "redirect_url" => base_url('backoffice/PayStudentFees/payTutionFeesOnlineResponse')
                    ));

                echo '<pre>';
                print_r($response);
                echo '</pre>';

                //store request in payment_request table
                $data = array(
                    'request_id' => $response['id'],
                    'stud_id' => $_POST['tution_fees_frm_stud_id'],
                    'class_id' => $_POST['tution_fees_frm_class_id'],
                    'stream_id' => $_POST['tution_fees_frm_stream_id'],
                    'semester' => $_POST['tution_fees_frm_semester'],
                    'is_tution_fees' => 1,
                    'payment_amt' => $_POST['tution_fees_frm_tution_fees_amt']
                );
                $this->CommonModel->save('payment_request', $data);

                header('location:' . $response['longurl']);
            } catch (Exception $e) {
                print('Error: ' . $e->getMessage());
            }
        }
        exit;
    }

    public function payTutionFeesOnlineResponse()
    {
        $api = new Instamojo($this->site_settings_data['instamojo_api_key'], $this->site_settings_data['instamojo_api_token'], 'https://test.instamojo.com/api/1.1/');
        try {
            $response = $api->paymentRequestStatus($_GET['payment_request_id']);
            $userdata = $this->session->userdata('dakshina-admin');
            if ($response['status'] == "Completed" && (isset($response['payments'][0]['payment_id'])) && (isset($response['id']))) {
                $check_exists = $this->CommonModel->getRecord('fees_receipt_records', array('payment_id' => $response['payments'][0]['payment_id']))->num_rows();
                if ($check_exists == 0) {
                    //payment successful
                    //which student payment
                    $request_data = $this->CommonModel->getRecord('payment_request', array('request_id' => $response['id']))->row_array();

                    //generate new receipt
                    $receipt_data = array(
                        'stud_id' => $request_data['stud_id'],
                        'user_id' => $userdata['user_id'],
                        'receipt_date' => date('Y-m-d'),
                        'sub_total' => $response['amount'],
                        'final_total' => $response['amount'],
                        'mode_of_payment' => 3,
                        'payment_id' => $response['payments'][0]['payment_id'],
                        'payed_amount' => $response['amount'],
                        'bank_name' => null,
                        'cheque_no' => null
                    );

                    $receipt_no = $this->CommonModel->save('fees_receipt_records', $receipt_data);


                    //insert into paid fees_record_table

                    $paid_fees_data = array(
                        'receipt_id' => $receipt_no,
                        'stud_id' => $request_data['stud_id'],
                        'class_id' => $request_data['class_id'],
                        'stream_id' => $request_data['stream_id'],
                        'semester' => $request_data['semester'],
                        'is_tution_fees' => 1,
                        'tution_fees' => $response['amount']
                    );

                    $paid_fees_record = $this->CommonModel->save('paid_fees_records', $paid_fees_data);

                    //update_peyment_requet_table
                    $payment_request = $this->CommonModel->update('payment_request', array('is_paid' => 1), array('request_id' => $response['id']));


                    //load success view
                    $student_data = $this->CommonModel->getRecord('student_master', array('stud_id' => $request_data['stud_id']))->row_array();
                    /*  echo '<pre>';
                          print_r($student_data);
                      echo '</pre>';*/


                    $succes_data = array(
                        'receipt_id' => $receipt_no,
                        'payment_id' => $response['payments'][0]['payment_id'],
                        'stud_name' => $student_data['stud_name'],
                        'user_name' => $userdata['user_email'],
                        'class_name' => $this->CommonModel->getRecord('class_master', array('class_id' => $request_data['class_id']))->row_array()['class_name'],
                        'receipt_date' => $receipt_data['receipt_date'],
                        'payed_amt' => $response['amount']
                    );

                    $this->pageTitle = 'Payment Success';
                    $this->pageData['success_data'] = $succes_data;
                    $this->render('paystudentfees/paysuccess.php');

                }else{
                    redirect(base_url('backoffice/PayStudentFees'));
                }
            }


        } catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
    }
}