<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public $pageData = array();

    public $pageTitle = 'Page Title';
	public $userInfo = array();
	public $total_customer = 0;
	public $total_category = 0;
	public $total_section = 0;
	public $per_page = 10;
	protected $site_settings_data = array();

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('CommonModel');
        if( (isset($_SESSION['dakshina-admin'])) ){
            $whr = array("user_email"=>$this->session->userdata('dakshina-admin')['user_email']);
            $result = $this->CommonModel->getRecord("user_master",$whr);
            if($result->num_rows() == 1){
                //continue
                $this->site_settings_data = $this->CommonModel->getRecord('site_settings')->result_array();
                $temp = array();

                foreach ($this->site_settings_data as $value){
                    $temp[$value['settings_key']] = $value['settings_value'];
                }
                $this->site_settings_data = $temp;

            }else{
                $this->session->unset_userdata('dakshina-admin');
                redirect(base_url('backoffice/login'));
            }
        }else{
           redirect(base_url('backoffice/login'));
        }
	}
    public function checkexists($update_field = false,$id = false)
    {
        //update field and $id  used while edit in CRUD

        $table = $this->input->post('table');
        $field = $this->input->post('field');
        $value = $this->input->post($field);

        if (isset($id) && $id != '' && isset($update_field) && $update_field != '') {
            $c = $this->CommonModel->getRecord($table, array($field => $value, "$update_field !=" => $id))->num_rows();

        } else {
            $c = $this->CommonModel->getRecord($table, array($field => $value))->num_rows();
        }

        if ($c > 0) {
            echo "false";
        } else {
            echo "true";
        }
        exit();

    }
	public function render($the_view=null,$template='main')
	{
	    if($the_view)
		{
		    if($template){
			$this->pageData['page_content'] = $this->load->view('backoffice/'.$the_view,$this->pageData,TRUE);
			$this->load->view('backoffice/template/'.$template,$this->pageData);
		    }
		    else 
		    {
		        $this->load->view($the_view,$this->pageData);
		    }
		    
		}
		else
		{
		    exit("View Not Found");
		}
	}
}
