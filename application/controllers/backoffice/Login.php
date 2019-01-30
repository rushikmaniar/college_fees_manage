<?php
/**
 * Created by PhpStorm.
 * User: Rushik
 * Date: 12-04-2018
 * Time: 11:47 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CommonModel');
    }
    /**
     * Login page
     */
    public function index()
    {
        if ($this->session->userdata('dakshina-admin')){redirect('backoffice/dashboard','refresh');}

        if( (isset($_POST['LoginFormEmail']))   )
        {
            $whr = array("user_email"=>$this->input->post('LoginFormEmail'),"user_pass"=>md5($this->input->post('LoginFormPassword')));
            $result = $this->CommonModel
                ->getRecord("user_master",$whr);
            //check if it is admin

            if ($result->num_rows() == 1)
            {
                $user_data = $result->row_array();
                if($user_data[''])

                $this->session->set_userdata("dakshina-admin",$user_data[0]);
                redirect('backoffice/dashboard','refresh');
            }
            else
            {
                $this->session->set_flashdata('login_error','Incorrect username or password!');
                redirect('backoffice/login','refresh');
            }
        }
        $this->load->view('backoffice/login/index','refresh');
    }

    /* check user at ajax model*/
    public function checkUser()
    {
        $reponse_array = array();
        $session_user = $this->session->userdata('dakshina-admin');
        if($session_user){
            $user_data = $this->CommonModel->getRecord('user_master',array('user_id'=>$session_user['user_id'],'user_email'=>$session_user['user_email']));

            if($user_data->num_rows() == 1){
                $reponse_array['code'] = 1;
                $reponse_array['message'] = '1 User Exists in Database';
            }
            else {
                $reponse_array['code'] = 0;
                $reponse_array['message'] = 'No Unique User';
            }


        }else{
            $reponse_array['code'] = 2;
            $reponse_array['message'] = 'Session Expired.Reload Page.';
        }
        echo json_encode($reponse_array);exit;
    }
    /**
     * Logout functionality
     *
     */
    public function logout()
    {
        $this->session->unset_userdata('dakshina-admin');
        redirect('backoffice/login','refresh');
    }
}