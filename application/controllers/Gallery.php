<?php
//defined('BASEPATH') OR exit('No direct script access allowed);

class Gallery extends CI_Controller
{
    public function index()
    {
        if($this->session->userdata('login_status') == TRUE){
            $data['content_view'] ='Gallery_view';
            $this->load->view('template', $data);
        } else {
            redirect('Tugas_Login'); 
        }
    }
}

