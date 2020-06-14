<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Hewan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hewan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['content_view']="Hewan_view";
        $this->load->model('Hewan_model');
        $data['arr']=$this->Hewan_model->get_Hewan();
        $this->load->view('template', $data, FALSE);
    }

    public function hapus() {
    if($this->session->userdata('login_status') == TRUE){

        $id_Hewan = $this->uri->segment(3);
        if($this->Hewan_model->hapus_Hewan($id_Hewan)){
            $this->session->set_flashdata('pesan', 'Hapus Hewan Berhasil');
            redirect('Hewan');
        } else {
            $this->session->set_flashdata('pesan', 'Gagal Hapus Hewan ');
            redirect('Hewan');
        }
    } else {
        redirect('login');
    }
        }

        public function json_hewan_by_id(){
            if($this->session->userdata('login_status') == TRUE){

                $id_Hewan = $this->uri->segment(3);

                $data = $this->Hewan_model->get_data_Hewan_by_id($id_Hewan);
                echo json_encode($data);
            }
        }

    public function add_Hewan()
    {
        $this->load->model('Hewan_model', 'bar');
        $masuk=$this->bar->add_Hewan();
        if($masuk==true) {
            $this->session->set_flashdata('pesan', 'sukses masuk');
        } else {
            $this->session->set_flashdata('pesan', 'gagal masuk');
        }
        redirect(base_url('index.php/Hewan'), 'refresh');
    }

public function ubah()
{
    if($this->session->userdata('login_status')==TRUE){
    // validation form fulu
    $this->form_validation->set_rules('nama_hewan_edit', 'nama_hewan', 'trim|required');
    $this->form_validation->set_rules('jenis_hewan_edit', 'jenis_hewan', 'trim|required');
    $this->form_validation->set_rules('jenis_kelamin_edit', 'jenis_kelamin', 'trim|required');
    $this->form_validation->set_rules('stok_hewan_edit', 'stok', 'trim|required');

    if($this->form_validation->run() == TRUE) {
        if($this->Hewan_model->edit()== TRUE){
            $this->session->set_flashdata('pesan', 'Ubah Hewan Berhasil');
            redirect('Hewan');
        } else {
            $this->session->set_flashdata('pesan', 'Ubah Hewan Gagal');
            redirect('Hewan');
        }
        } else {
            $this->session->set_flashdata('pesan', Validation_errors());
            redirect('Hewan');
        }
    }else {
        redirect('login');
        }
    }
}
