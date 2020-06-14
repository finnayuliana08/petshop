<?php
//defined('BASEPATH') OR exit('No direct script access allowed);

class Home extends CI_Controller
{
    public function index()
    {
        if($this->session->userdata('login_status') == TRUE){
            $data['content_view'] ='dashboard';
            $this->load->view('template', $data);
        } else {
            redirect('Tugas_Login'); 
        }
    }
}

