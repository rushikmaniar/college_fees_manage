<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteController extends CI_Controller
{

    public $pageData = array();
    public $pageTitle = 'Page Title';
    public $userInfo = array();
    public $siteData = array();
    public $per_page = 10;
    protected $site_settings_data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CommonModel');
        //site settings
        $this->site_settings_data = $this->CommonModel->getRecord('site_settings')->result_array();

        $temp = array();

        foreach ($this->site_settings_data as $value){
            $temp[$value['settings_key']] = $value['settings_value'];
        }

        $this->site_settings_data = $temp;

        //$this->pageData['site_settings'] = $this->site_settings->result_array();
    }

    public function render($the_view = null, $template = 'main')
    {
        if ($the_view) {
            if ($template) {
                $this->pageData['page_content'] = $this->load->view($the_view, $this->pageData, TRUE);
                $this->load->view('template/' . $template, $this->pageData);
            } else {
                $this->load->view($the_view, $this->pageData);
            }

        } else {
            exit("View Not Found");
        }
    }


}
