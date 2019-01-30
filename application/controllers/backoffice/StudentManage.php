<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentManage extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $OrWhere = array();
        $val = '
        student_master.stud_id,
        student_master.enroll_no,
        student_master.stud_name,
        student_master.stud_gender,
        student_master.stud_father_name,
        student_master.stud_mobile_no,
        
        class_master.class_name
        ';
        $student_data = $this->CommonModel
            ->dbOrderBy(array('student_master.stud_id' => 'DESC'))
            ->dbjoin(
                array(
                    array(
                        'table' => 'class_master',
                        'condition' => 'student_master.stud_class_id = class_master.class_id'
                    )
                )
            )->getRecord('student_master', $OrWhere, $val)->result_array();

        $this->pageTitle = 'Student Management';
        $this->pageData['student_data'] = $student_data;
        $this->render("studentmanage/index.php");
    }


    /**
     * View add Student modal
     *
     */
    public function viewAddStudentModal()
    {
        $OrWhere = array();
        $class_data = $this->CommonModel
            ->dbOrderBy(array('class_id' => 'ASC'))
            ->getRecord('class_master', $OrWhere, 'class_master.*')->result_array();

        $this->pageData['class_list'] = $class_data;
        $this->render("backoffice/studentmanage/view_add_student", FALSE);

    }


    /**
     * Add or edit Student
     *
     */
    public function addEditStudent()
    {

        if ($this->input->post('action') && $this->input->post('action') == "addStudent") {
            $student_data = array(
                "stud_id" => $this->input->post('student_frm_stud_id'),
                "enroll_no" => $this->input->post('student_frm_enroll_no'),
                "stud_name" => $this->input->post('student_frm_stud_name'),
                "stud_father_name" => $this->input->post('student_frm_stud_father_name'),
                "stud_gender" => $this->input->post('student_frm_stud_gender'),
                "stud_mobile_no" => $this->input->post('student_frm_stud_mobile_no'),
                "stud_class_id" => $this->input->post('student_frm_stud_class_id')
            );

            $save = $this->CommonModel->save("student_master", $student_data);


            if ($save != 0) {
                $this->session->set_flashdata("success", "Studnet added successfully");
            } else {
                $this->session->set_flashdata("error", "problem adding Student. Try Later");
            }
        }

        if ($this->input->post('action') && $this->input->post('action') == "editStudent") {
            $update_id = $this->input->post('update_id');
            if ($update_id) {
                //check entry in entry_record
                $student_data = array(
                    "stud_id" => $this->input->post('student_frm_stud_id'),
                    "enroll_no" => $this->input->post('student_frm_enroll_no'),
                    "stud_name" => $this->input->post('student_frm_stud_name'),
                    "stud_father_name" => $this->input->post('student_frm_stud_father_name'),
                    "stud_gender" => $this->input->post('student_frm_stud_gender'),
                    "stud_mobile_no" => $this->input->post('student_frm_stud_mobile_no'),
                    "stud_class_id" => $this->input->post('student_frm_stud_class_id')
                );

                $update = $this->CommonModel->update("student_master", $student_data, array('stud_id' => $this->input->post('update_id')));
                if ($update) {
                    $this->session->set_flashdata("success", "Student updated successfully");
                } else {
                    $this->session->set_flashdata("error", "Problem Editing Student .Try Later");
                }
            } else {
                $this->session->set_flashdata("error", "Insuffecint Parameter");
            }
        }
        redirect("backoffice/StudentManage", "refresh");
    }


    /**
     * View edit modal with set Student data
     *
     * @param int $user_id
     */
    public function viewEditStudentModal($stud_id)
    {
        $OrWhere = array();
        $student_data = $this->CommonModel
            ->dbOrderBy(array('stud_id' => 'ASC'))
            ->getRecord('student_master', $OrWhere, 'student_master.*')->row_array();

        $this->pageData['student_data'] = $student_data;
        $class_data = $this->CommonModel->getRecord("class_master")->result_array();
        $this->pageData['class_list'] = $class_data;
        $this->render("backoffice/studentmanage/view_add_student", FALSE);
    }


    /**
     * Delete Student
     *
     */
    public function deleteStudent()
    {
        if ($this->input->post('stud_id')) {

            $result = $this->CommonModel->delete("student_master", array('stud_id' => $this->input->post('stud_id')));
            if ($result) {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Student deleted successfully";
                echo json_encode($res_output);
                exit();
            } else {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Student not deleted";
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