<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FeesReceiptRecord extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $OrWhere = array();
        $val = '
        fees_receipt_records.fee_receipt_id,
        student_master.stud_name,
        user_master.user_email,
        fees_receipt_records.receipt_date,
        fees_receipt_records.academic_year,
        class_master.class_name,
        fees_receipt_records.sub_total,
        fees_receipt_records.late_fees,
        fees_receipt_records.final_total,
        fees_receipt_records.mode_of_payment
        
        ';
        $fees_receipt_records_data = $this->CommonModel
            ->dbOrderBy(array('class_master.class_id' => 'DESC'))
            ->dbjoin(
                array(
                    array(
                        'table' => 'student_master',
                        'condition' => 'fees_receipt_records.stud_id = student_master.stud_id',
                        'jointype' => 'inner'
                    )
                ),
                array(
                    array(
                        'table' => 'user_master',
                        'condition' => 'fees_receipt_records.user_id = user_master.user_id',
                        'jointype' => 'inner'
                    )
                ),
                array(
                    array(
                        'table' => 'class_master',
                        'condition' => 'fees_receipt_records.class_id = class_master.class_id',
                        'jointype' => 'inner'
                    )
                )
            )->getRecord('fees_receipt_records', $OrWhere, $val)->result_array();

        $this->pageTitle = 'Fees Record List';
        $this->pageData['fees_receipt_records_data'] = $fees_receipt_records_data;
        $this->render("feesreceiptrecord/index.php");
    }
    /**
     * View add Class modal
     *
     */
    public function viewAddClassModal()
    {
        $OrWhere = array();
        $department_data = $this->CommonModel
            ->dbOrderBy(array('dept_id' => 'ASC'))
            ->getRecord('department_master', $OrWhere, 'department_master.*')->result_array();

        $this->pageData['department_list'] = $department_data;
        $this->render("backoffice/Class/view_add_class", FALSE);

    }




    /**
     * Add or edit Class
     *
     */
    public function addEditClass()
    {


        if ($this->input->post('action') && $this->input->post('action') == "addClass") {
            $class_data = array(
                "class_id" => $this->input->post('class_frm_class_id'),
                "class_name" => $this->input->post('class_frm_class_name'),
                "class_tution_fees" => $this->input->post('class_frm_class_tution_fees'),
                "class_fees_deadline" => $this->input->post('class_frm_class_fees_deadline'),
                "dept_id" => $this->input->post('class_frm_dept_id')
            );


            $save = $this->CommonModel->save("class_master", $class_data);


            if ($save != 0) {
                $this->session->set_flashdata("success", "Class added successfully");
            } else {
                $this->session->set_flashdata("error", "problem adding Class. Try Later");
            }
        }

        if ($this->input->post('action') && $this->input->post('action') == "editClass") {
            $update_id = $this->input->post('update_id');
            if ($update_id) {
                //check entry in entry_record
                $class_data = array(
                    "class_id" => $this->input->post('class_frm_class_id'),
                    "class_name" => $this->input->post('class_frm_class_name'),
                    "class_tution_fees" => $this->input->post('class_frm_class_tution_fees'),
                    "class_fees_deadline" => $this->input->post('class_frm_class_fees_deadline'),
                    "dept_id" => $this->input->post('class_frm_dept_id')
                );

                $update = $this->CommonModel->update("class_master", $class_data, array('class_id' => $this->input->post('update_id')));
                if ($update) {
                    $this->session->set_flashdata("success", "Class updated successfully");
                } else {
                    $this->session->set_flashdata("error", "Problem Editing Class.Try Later");
                }
            } else {
                $this->session->set_flashdata("error", "Invalid Parameter . Try Later.");
            }
        }
        redirect("backoffice/ClassManagement", "refresh");
    }


    /**
     * View edit modal with set Class data
     *
     * @param int $user_id
     */
    public function viewFeesReceiptRecordModal($fee_receipt_id)
    {
        $OrWhere = array();
        $department_data = $this->CommonModel
            ->dbOrderBy(array('dept_id' => 'ASC'))
            ->getRecord('department_master', $OrWhere, 'department_master.*')->result_array();

        $this->pageData['department_list'] = $department_data;
        $class_data = $this->CommonModel->getRecord("class_master", array('class_id' => $fee_receipt_id))->row_array();
        $this->pageData['class_data'] = $class_data;
        $this->render("backoffice/Class/view_add_class", FALSE);
    }


    /**
     * Delete Class
     *
     */
    public function deleteClass()
    {
        if ($this->input->post('class_id')) {
            //check entry in entry_record

            $result = $this->CommonModel->delete("class_master", array('class_id' => $this->input->post('class_id')));
            if ($result) {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Class deleted successfully";
                echo json_encode($res_output);
                exit();
            } else {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Class not deleted";
                echo json_encode($res_output);
                exit();
            }
        } else {
            $res_output['code'] = 0;
            $res_output['status'] = "error";
            $res_output['message'] = "Request parameter not found,please try again";
            echo json_encode($res_output);
            exit();
        }
    }
}

?>