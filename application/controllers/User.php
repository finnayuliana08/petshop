<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['content_view']="User_view";
        $this->load->model('User_model');
        $data['arr']=$this->User_model->get_User();
        $this->load->view('template', $data, FALSE);
    }

    public function hapus() {
    if($this->session->Userdata('login_status') == TRUE){

        $id_user = $this->uri->segment(3);
        if($this->User_model->hapus_User($id_user)){
            $this->session->set_flashdata('pesan', 'Hapus Barang Berhasil');
            redirect('User');
        } else {
            $this->session->set_flashdata('pesan', 'Gagal Hapus Barang ');
            redirect('User');
        }
    } else {
        redirect('Tugas_Login');
    }
        }

        public function json_User_by_id(){
            if($this->session->Userdata('login_status') == TRUE){
                
                $id_User = $this->uri->segment(3);

                $data = $this->User_model->get_data_User_by_id($id_User);
                echo json_encode($data);
            }
        }
    
    public function add_User()
    {
        $this->load->model('User_model', 'bar');
        $masuk=$this->bar->add_User();
        if($masuk==true) {
            $this->session->set_flashdata('pesan', 'sukses masuk');
        } else {
            $this->session->set_flashdata('pesan', 'gagal masuk');
        }
        redirect(base_url('index.php/User'), 'refresh');
    }

public function ubah()
{
    if($this->session->Userdata('login_status')==TRUE){
    // validation form fulu
    $this->form_validation->set_rules('nama_edit', 'Nama', 'trim|required');
    $this->form_validation->set_rules('uname_edit', 'Uname', 'trim|required');
    $this->form_validation->set_rules('pass_edit', 'pass', 'trim|required');
    
    if($this->form_validation->run() == TRUE) {
        if($this->User_model->edit()== TRUE){
            $this->session->set_flashdata('pesan', 'Ubah Barang Berhasil');
            redirect('User');
        } else {
            $this->session->set_flashdata('pesan', 'Ubah Barang Gagal');
            redirect('User');
        }
        } else {
            $this->session->set_flashdata('pesan', Validation_errors());
            redirect('User');
        } 
    }else {
        redirect('Tugas_Login');
        }
    }
}
