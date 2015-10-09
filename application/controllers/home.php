<?php

class Home extends CI_Controller
{
    
    public function index()
    {
        $this->load->view('inc/header_view.php');
        $this->load->view('home/home_view.php');
        $this->load->view('inc/footer_view.php');
    }
    
}


