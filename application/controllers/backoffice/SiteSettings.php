<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteSettings extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $OrWhere = array();
        $val = '
        site_settings.*
        ';
        $site_settings_data = $this->CommonModel
            ->getRecord('site_settings', $OrWhere, $val)->result_array();

        $this->pageTitle = 'Site Settings Management';
        $this->pageData['site_settings_data'] = $site_settings_data;
        $this->render("sitesettings/index.php");
    }
    /**
     * View add Class modal
     *
     */
   /* public function viewAddClassModal()
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

    }*/




    /**
     * Add or edit Class
     *
     */
    public function addEditSiteSetting()
    {


        /*if ($this->input->post('action') && $this->input->post('action') == "addClass") {
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
        }*/

        if ($this->input->post('action') && $this->input->post('action') == "editSiteSettings") {
            $update_id = $this->input->post('update_id');
            if ($update_id) {
                //check entry in entry_record
                $site_data = array(
                    "settings_key" => $this->input->post('sitesettings_frm_settings_key'),
                    "settings_value" => $this->input->post('sitesettings_frm_settings_value')
                );

                $update = $this->CommonModel->update("site_settings", $site_data, array('row_id' => $this->input->post('update_id')));
                if ($update) {
                    $this->session->set_flashdata("success", "SiteSettings updated successfully");
                } else {
                    $this->session->set_flashdata("error", "Problem Editing SiteSettings.Try Later");
                }
            } else {
                $this->session->set_flashdata("error", "Invalid Parameter . Try Later.");
            }
        }
        redirect("backoffice/SiteSettings", "refresh");
    }


    /**
     * View edit modal with set Class data
     *
     * @param int $user_id
     */
    public function viewEditSiteSettingModal($settings_id)
    {
        $OrWhere = array();

        $settings_data = $this->CommonModel
            ->getRecord("site_settings", array('row_id' => $settings_id))->row_array();
            $this->pageData['settings_data'] = $settings_data;
        $this->render("backoffice/sitesettings/view_add_settings", FALSE);
    }

}

?>