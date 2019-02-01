<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExtraFeesStructure extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $OrWhere = array();
        $val = '
        extra_fees_details_structure.row_id,
        extra_fees_details_structure.fees_name,
        extra_fees_details_structure.fees_amt
        ';
        $extra_fees_details_structure = $this->CommonModel
            ->dbOrderBy(array('extra_fees_details_structure.row_id' => 'ASC'))
            ->getRecord('extra_fees_details_structure', $OrWhere, $val)->result_array();

        $this->pageTitle = 'Extra Fees Structure';
        $this->pageData['extra_fees_details_structure'] = $extra_fees_details_structure;
        $this->render("extrafeesstructure/index.php");
    }


    /**
     * View add Extra Fees Structure  modal
     *
     */
    public function viewAddExtraFeesStructureModal()
    {
        $this->render("backoffice/extrafeesstructure/view_add_extrafeesstructure", FALSE);
    }

    /**
     * Add or edit Extra Fees Structure
     *
     */
    public function addEditExtraFeesStructure()
    {

        if ($this->input->post('action') && $this->input->post('action') == "addExtraFeesStructure") {
            $extra_fees_structure_data = array(
                "fees_name" => $this->input->post('extra_fees_structure_frm_fees_name'),
                "fees_amt" => $this->input->post('extra_fees_structure_frm_fees_amt')
            );



            $save = $this->CommonModel->save("extra_fees_details_structure", $extra_fees_structure_data);
            if ($save) {
                $this->session->set_flashdata("success", "Department added successfully");
            } else {
                $this->session->set_flashdata("error", "problem adding Department. Try Later");
            }
        }
        if ($this->input->post('action') && $this->input->post('action') == "editExtraFeesStructure") {
            $update_id = $this->input->post('update_id');
            if ($update_id) {

                $extra_fees_structure_data = array(
                    "fees_name" => $this->input->post('extra_fees_structure_frm_fees_name'),
                    "fees_amt" => $this->input->post('extra_fees_structure_frm_fees_amt')
                );

                $update = $this->CommonModel->update("extra_fees_details_structure", $extra_fees_structure_data, array('row_id' => $this->input->post('update_id')));
                if ($update) {
                    $this->session->set_flashdata("success", "Extra Fees Structure updated successfully");
                } else {
                    $this->session->set_flashdata("error", "Problem Editing Extra Fees Structure .Try Later");
                }
            } else {
                $this->session->set_flashdata("error", "Invalid Parameter . Try Later.");
            }
        }
        redirect("backoffice/ExtraFeesStructure", "refresh");
    }


    /**
     * View edit modal with set Extra Fees Structure Detail
     *
     * @param int $row_id
     */
    public function viewEditExtraFeesStructureModal($row_id)
    {
        $extra_fees_data = $this->CommonModel->getRecord("extra_fees_details_structure", array('row_id' => $row_id))->row_array();
        $this->pageData['extra_fees_data'] = $extra_fees_data;
        $this->render("backoffice/extrafeesstructure/view_add_extrafeesstructure", FALSE);
    }

    /**
     * Delete Extra Fees Structure
     *
     */
    public function deleteExtraFeesStructure()
    {
        if ($this->input->post('row_id')) {
            //check entry in entry_record

            $result = $this->CommonModel->delete("extra_fees_details_structure", array('row_id' => $this->input->post('row_id')));
            if ($result) {
                $res_output['code'] = 1;
                $res_output['status'] = "success";
                $res_output['message'] = "Extra Fees deleted successfully";
                echo json_encode($res_output);
                exit();
            } else {
                $res_output['code'] = 0;
                $res_output['status'] = "error";
                $res_output['message'] = "Extra Fees not deleted";
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