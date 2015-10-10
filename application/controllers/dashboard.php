<?php

class Dashboard extends CI_Controller
{
    
    public function index() 
    {
        $this->load->view('dashboard/inc/header_view');
        $this->load->view('dashboard/dashboard_view');
        $this->load->view('dashboard/inc/footer_view');
    }
    
    public function logout()
    {
        session_destroy();
        redirect('/');
    }
  
}

