<?php
/**
 * Created by PhpStorm.
 * User: MEET
 * Date: 4-2-2019
 * Time: 4:39 PM
 */

class Home extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->pageTitle = 'Home';
        $this->render('home/index.php');
    }
}