<?php
/**
 * Created by PhpStorm.
 * User: MEET
 * Date: 4-2-2019
 * Time: 6:06 PM
 */

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('login/index.php');
    }
}