<?php

class Home extends CI_Controller
{
    
    public function index()
    {
        $this->load->view('home/inc/header_view.php');
        $this->load->view('home/home_view.php');
        $this->load->view('home/inc/footer_view.php');
    }
    
    public function test() 
    {
        $q = $this->db->get('user');
        print_r($q->result());
    }
    
}


