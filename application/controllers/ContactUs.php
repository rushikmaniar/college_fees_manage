<?php
/**
 * Created by PhpStorm.
 * User: MEET
 * Date: 4-2-2019
 * Time: 5:36 PM
 */

class ContactUs extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->pageTitle = 'Contact Us';
        $this->render('contactus/index.php');
    }
}