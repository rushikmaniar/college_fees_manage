<?php
/**
 * Created by PhpStorm.
 * User: MEET
 * Date: 4-2-2019
 * Time: 5:24 PM
 */

class AboutUs extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->pageTitle = 'About Us';
        $this->render('aboutus/index.php');
    }
}