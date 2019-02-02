<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StreamManage extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
       $OrWhere = array();
       $val = '
       stream_master.*
       ';
        $stream_data = $this->CommonModel
            ->dbOrderBy(array('stream_id'=>'DESC'))
            ->getRecord('stream_master', $OrWhere, $val)->result_array();

        $this->pageTitle = 'Stream Management';

        $this->pageData['stream_data'] = $stream_data;
        $this->render("streammanage/index.php");
    }
    
    
    /**
     * View add Stream modal
     * 
     */
    public function viewAddStreamModal()
    {
        $this->render("backoffice/streammanage/view_add_stream",FALSE);
    }

    
    /**
     * Add or edit Stream
     * 
     */
    public function addEditStream()
    {

            if ($this->input->post('action') && $this->input->post('action') == "addStream") {
                $stream_data = array(
                    "stream_id" => $this->input->post('department_frm_dept_id'),
                    "stream_name" => $this->input->post('department_frm_dept_name')
                );


                $save = $this->CommonModel->save("department_master", $stream_data);
                if ($save) {
                    $this->session->set_flashdata("success", "Department added successfully");
                } else {
                    $this->session->set_flashdata("error", "problem adding Department. Try Later");
                }
            }

            if ($this->input->post('action') && $this->input->post('action') == "editStream" && $this->input->post('update_id')) {

                $stream_data = array(
                    "stream_name" => $this->input->post('department_frm_dept_name'),
                    "no_of_semester" => $this->input->post('department_frm_dept_name')
                );

                $update = $this->CommonModel->update("stream_master", $stream_data, array('dept_id' => $this->input->post('update_id')));
                if ($update) {
                    $this->session->set_flashdata("success", "Stream updated successfully");
                } else {
                    $this->session->set_flashdata("error", "Problem Editing Stream.Try Later");
                }
            }

        redirect("backoffice/StreamManage","refresh");
    }
    
    
    /**
     * View edit modal with set Department data
     * 
     * @param int $stream_id
     */
    public function viewEditStreamModal($stream_id)
    {
        $stream_data = $this->CommonModel->getRecord("stream_master",array('stream_id'=>$stream_id))->row_array();
        $this->pageData['stream_data'] = $stream_data;
        $this->render("backoffice/StreamManage/view_add_Stream",FALSE);
    }
    
    
    /**
     * Delete Department
     * 
     */
    public function deleteStream()
    {
        if ($this->input->post('stream_id'))
        {
            $result = $this->CommonModel->delete("stream_master",array('stream_id'=>$this->input->post('stream_id')));
            if ($result)
            {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Stream deleted successfully";
                echo json_encode($res_output);
                exit();
            }
            else 
            {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Stream not delete";
                echo json_encode($res_output);
                exit();
            }
        }
        else 
        {
            $res_output['code'] = 0;
            $res_output['status'] = "error";
            $res_output['message'] = "Request parameter not found,please try again";
            echo json_encode($res_output);
            exit();
        }
    }
}
?>