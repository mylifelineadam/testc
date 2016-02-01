<?php

class Home extends CI_Controller
{
    
    public function index()
    {
        $this->load->view('home/inc/header_view.php');
        $this->load->view('home/home_view.php');
        $this->load->view('home/inc/footer_view.php');
    }

    public function register()
    {
        $this->load->view('home/inc/header_view.php');
        $this->load->view('home/register_view.php');
        $this->load->view('home/inc/footer_view.php');
    }

    /*
    public function code()
    {
        # Encrypt Example
        # Encrypt uses CI library and can be decoded.

        # $this->load->library('encrypt');
        # echo $this->encrypt->encode('My Secret Password');
        # echo $this->encrypt->decode('');

        # Hash Example
        # Hash uses PHP library and cannot be decoded.
        # Also, "salt" password with a custom constant for security

        # echo hash('sha256','password here' . SALT);
    }
    */

    /*
    public function test() 
    {
    
        $this->db->select('user_id, login');
        $this->db->order_by('user_id DESC');
        $q = $this->db->get('user');
        print_r($q->result());
    
        $this->db->insert('user', [
            'login' => 'jenkins'
        ]);

        $this->db->where (['user_id'] => 4)
        $this->db->update('user', [
            'login' => 'sammy'
        ]);
    
        $this->db->delete('user', ['user_id' => 4])

    }
    */
    
}


