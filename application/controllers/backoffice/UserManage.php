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
            ->dbOrderBy(array('user_type_id' => 'DESC'))
            ->getRecord('user_type', $OrWhere, 'user_type.*')->result_array();

        $this->pageData['user_type_list'] = $user_type_data;
        $this->render("backoffice/usermanage/view_add_user", FALSE);

    }


    /**
     * Add or edit User
     *
     */
    public function addEditUser()
    {

        if ($this->input->post('action') && $this->input->post('action') == "addUser") {
            $user_data = array(
                "user_email" => $this->input->post('user_frm_user_email'),
                "user_pass" => md5($this->input->post('user_frm_user_pass')),
                "user_type_id" => $this->input->post('user_frm_user_type_id'),
                "user_mobile" => $this->input->post('user_frm_user_mobile')
            );


            $save = $this->CommonModel->save("user_master", $user_data);


            if ($save != 0) {
                $this->session->set_flashdata("success", "User added successfully");
            } else {
                $this->session->set_flashdata("error", "problem adding User. Try Later");
            }
        }

        if ($this->input->post('action') && $this->input->post('action') == "editUser") {
            $update_id = $this->input->post('update_id');
            if ($update_id) {
                //check entry in entry_record
                $user_data = array(
                    "user_email" => $this->input->post('user_frm_user_email'),
                    "user_pass" => md5($this->input->post('user_frm_user_pass')),
                    "user_type_id" => $this->input->post('user_frm_user_type_id'),
                    "user_mobile" => $this->input->post('user_frm_user_mobile')
                );

                $update = $this->CommonModel->update("user_master", $user_data, array('user_id' => $this->input->post('update_id')));
                if ($update) {
                    $this->session->set_flashdata("success", "User updated successfully");
                } else {
                    $this->session->set_flashdata("error", "Problem Editing User.Try Later");
                }
            } else {
                $this->session->set_flashdata("error", "Insuffecient Parameters .");
            }
        }
        redirect("backoffice/UserManage", "refresh");
    }


    /**
     * View edit modal with set Userdata
     *
     * @param int $user_id
     */
    public function viewEditUserModal($user_id)
    {
        $OrWhere = array();
        $ser_type_list = $this->CommonModel
            ->dbOrderBy(array('user_type_id' => 'DESC'))
            ->getRecord('user_type', $OrWhere, 'user_type.*')->result_array();

        $this->pageData['user_type_list'] = $ser_type_list;
        $class_data = $this->CommonModel->getRecord("user_master", array('user_id' => $user_id))->row_array();
        $this->pageData['user_data'] = $class_data;
        $this->render("backoffice/usermanage/view_add_user", FALSE);
    }


    /**
     * Delete User
     *
     */
    public function deleteUser()
    {
        if ($this->input->post('user_id')) {
            //check entry in entry_record

            $result = $this->CommonModel->delete("user_master", array('user_id' => $this->input->post('user_id')));
            if ($result) {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "User deleted successfully";
                echo json_encode($res_output);
                exit();
            } else {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "User not deleted";
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