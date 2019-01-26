<?php
/**
 * Created by PhpStorm.
 * User: Rushik
 * Date: 23-04-2018
 * Time: 11:07 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->pageTitle = 'Dashboard.php';
        $this->render("dashboard/index");
    }
}