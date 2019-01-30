<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserManage extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $OrWhere = array();
        $val = '
        user_master.user_id,
        user_master.user_email,
        user_master.user_mobile,
        user_type.user_type_name
        ';
        $class_data = $this->CommonModel
            ->dbOrderBy(array('user_master.user_id' => 'DESC'))
            ->dbjoin(
                array(
                    array(
                        'table' => 'user_type',
                        'condition' => 'user_master.user_type_id = user_type.user_type_id',
                        'jointype' => 'inner'
                    )
                )
            )->getRecord('user_master', $OrWhere, $val)->result_array();

        $this->pageTitle = 'User Management';
        $this->pageData['user_data'] = $class_data;
        $this->render("usermanage/index.php");
    }


    /**
     * View add Usermodal
     *
     */
    public function viewAddUserModal()
    {
        $OrWhere = array();
        $user_type_data = $this->CommonModel
            ->dbOrderBy(array('dept_id' => 'ASC'))
            ->getRecord('user_type', $OrWhere, 'user_type.*')->result_array();

        $this->pageData['user_type_list'] = $user_type_data;
        $this->render("backoffice/Class/view_add_user", FALSE);

    }


    /**
     * Add or edit User
     *
     */
    public function addEditUser()
    {

        if ($this->input->post('action') && $this->input->post('action') == "addUser") {
            $user_data = array(
                "class_id" => $this->input->post('class_frm_class_id'),
                "class_name" => $this->input->post('class_frm_class_name'),
                "dept_id" => $this->input->post('class_frm_dept_id')
            );


            $save = $this->CommonModel->save("class_master", $user_data);


            if ($save != 0) {
                $this->session->set_flashdata("success", "Class added successfully");
            } else {
                $this->session->set_flashdata("error", "problem adding Class. Try Later");
            }
        }

        if ($this->input->post('action') && $this->input->post('action') == "editUser") {
            $update_id = $this->input->post('update_id');
            if ($update_id) {
                //check entry in entry_record
                $user_data = array(
                    "class_id" => $this->input->post('class_frm_class_id'),
                    "class_name" => $this->input->post('class_frm_class_name'),
                    "dept_id" => $this->input->post('class_frm_dept_id')
                );

                $update = $this->CommonModel->update("class_master", $user_data, array('class_id' => $this->input->post('update_id')));
                if ($update) {
                    $this->session->set_flashdata("success", "Class updated successfully");
                } else {
                    $this->session->set_flashdata("error", "Problem Editing Class.Try Later");
                }
            } else {
                $this->session->set_flashdata("error", "Entry Record Of this Class Exist . First Delete That Records");
            }
        }
        redirect("backoffice/ClassManagement", "refresh");
    }


    /**
     * View edit modal with set Userdata
     *
     * @param int $user_id
     */
    public function viewEditClassModal($class_id)
    {
        $OrWhere = array();
        $department_data = $this->CommonModel
            ->dbOrderBy(array('dept_id' => 'ASC'))
            ->getRecord('department_master', $OrWhere, 'department_master.*')->result_array();

        $this->pageData['department_list'] = $department_data;
        $class_data = $this->CommonModel->getRecord("class_master", array('class_id' => $class_id))->row_array();
        $this->pageData['class_data'] = $class_data;
        $this->render("backoffice/Class/view_add_class", FALSE);
    }


    /**
     * Delete User
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