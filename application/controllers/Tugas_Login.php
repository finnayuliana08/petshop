<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->library('form_validation');
    }


    public function index()
    {
        if($this->session->userdata('Login_status') == TRUE){
            redirect('Home');
        } else {
            $this->load->view('Login_view');
        }
    }

    public function forgot_password()
    {
        //parameter
        $email = $this->url->segment(3);

        echo 'Saya lupa password, email saya : '. $email;
    } 

    public function act_Tugas_login()
    {
        $this->form_validation->set_rules('uname', 'uname', 'trim|required');
        $this->form_validation->set_rules('pass', 'pass', 'trim|required|min_length[8]');

        if ($this->form_validation->run() == TRUE)
        {
            if($this->Login_model->user_check() == TRUE)
            {
              redirect('Home');

            } else
              {
                $this->session->set_flashdata('notif', 'Password dan Username Tidak Benar!');
                redirect('Tugas_Login');
              }

        } else
            {
              $this->session->set_flashdata('notif', validation_errors());
              redirect('Tugas_Login');
            }
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect('Tugas_login');
    }
}