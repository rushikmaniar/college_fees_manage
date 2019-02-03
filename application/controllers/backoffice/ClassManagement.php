<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassManagement extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $OrWhere = array();
        $val = '
        class_master.*,
        department_master.dept_id,
        department_master.dept_name,
        stream_master.stream_name
        ';
        $class_data = $this->CommonModel
            ->dbOrderBy(array('class_master.class_id' => 'DESC'))
            ->dbjoin(
                array(
                    array(
                        'table' => 'department_master',
                        'condition' => 'class_master.dept_id = department_master.dept_id',
                        'jointype'=>'inner'
                    ),
                    array(
                        'table' => 'stream_master',
                        'condition' => 'class_master.stream_id = stream_master.stream_id',
                        'jointype'=>'inner'
                    )
                )
            )->getRecord('class_master', $OrWhere, $val)->result_array();

        $this->pageTitle = 'Class Management';
        $this->pageData['class_data'] = $class_data;
        $this->render("Class/index.php");
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

        $stream_data = $this->CommonModel
            ->dbOrderBy(array('stream_id' => 'DESC'))
            ->getRecord('stream_master', $OrWhere, 'stream_master.*')->result_array();

        $this->pageData['department_list'] = $department_data;
        $this->pageData['stream_list'] = $stream_data;
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
                "dept_id" => $this->input->post('class_frm_dept_id'),
                "stream_id" => $this->input->post('class_frm_stream_id'),
                "semester" => $this->input->post('class_frm_semester')
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
                    "dept_id" => $this->input->post('class_frm_dept_id'),
                    "stream_id" => $this->input->post('class_frm_stream_id'),
                    "semester" => $this->input->post('class_frm_semester')
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
    public function viewEditClassModal($class_id)
    {
        $OrWhere = array();
        $department_data = $this->CommonModel
            ->dbOrderBy(array('dept_id' => 'ASC'))
            ->getRecord('department_master', $OrWhere, 'department_master.*')->result_array();

        $stream_data = $this->CommonModel
            ->dbOrderBy(array('stream_id' => 'ASC'))
            ->getRecord('stream_master', $OrWhere, 'stream_master.*')->result_array();




        $this->pageData['department_list'] = $department_data;
        $this->pageData['stream_list'] = $stream_data;
        $class_data = $this->CommonModel
            ->dbjoin(
                array(
                    array(
                        'table' => 'stream_master',
                        'condition' => 'class_master.stream_id = stream_master.stream_id',
                        'jointype'=>'inner'
                    )
                ))
            ->getRecord("class_master", array('class_id' => $class_id),'class_master.*,stream_master.no_of_semester')->row_array();

        $sem_list_to_display = array();

        //get list of sem for stream
        $already_exists_semester_list  = $this->CommonModel->getRecord('class_master',array('stream_id'=>$class_data['stream_id'],'class_id !='=>$class_id),'class_master.semester')->result_array();
        $already_exists_semester_list = array_map(function ($arr){return $arr['semester'];},$already_exists_semester_list);

        for ($i=1;$i<=$class_data['no_of_semester'];$i++){
            if(!in_array($i,$already_exists_semester_list)){
                $sem_list_to_display[] = $i;
            }
        }

        $this->pageData['class_data'] = $class_data;
        $this->pageData['sem_list'] = $sem_list_to_display;
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

    public function checkSemester($update_field = false,$id = false)
    {
        //update field and $id  used while edit in CRUD

        $table = $this->input->post('table');
        $field1 = $this->input->post('field1');
        $value1 = $this->input->post($field1);

        $field2 = $this->input->post('field2');
        $value2 = $this->input->post($field2);

        if (isset($id) && $id != '' && isset($update_field) && $update_field != '') {
            $c = $this->CommonModel->getRecord($table, array($field1 => $value1,$field2 => $value2, "$update_field !=" => $id))->num_rows();

        } else {
            $c = $this->CommonModel->getRecord($table, array($field1 => $value1,$field2 => $value2))->num_rows();
        }

        if ($c > 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit();

    }
}

?>