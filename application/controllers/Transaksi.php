<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
        // $this->load->library('');
    }

    public function index()
    {
      if($this->session->userdata('login_status') == TRUE){

        $data['content_view'] = 'Transaksi_view';

        //get_cart_content
        $data['cart_transaksi'] = $this->Transaksi_model->get_cart();
        $this->load->view('template', $data);
      } else {
        redirect('Tugas_Login/index');
      }
    }

      public function cari_hewan()
      {
        if($this->session->userdata('login_status') == TRUE){

          if($this->Transaksi_model->cari_hewan() == TRUE)
          {
            redirect('Transaksi/index');
          } else {
            $this->session->set_flashdata('notif', 'Cari Hewan Gagal');
             redirect('Transaksi/index');
          }
        } else {
          redirect('Tugas_Login/index');
        }
      }

        public function ubah_jumlah_cart()
        {
            if($this->session->userdata('login_status') == TRUE){

            if($this->Transaksi_model->ubah_jumlah_cart() == TRUE) {
                  echo json_encode(1);
                } else {
                  echo json_encode(0);
                }
                } else {
                    redirect('Tugas_Login/index');
                }
          }

public function get_total_belanja()
{
  if($this->session->userdata('login_status') == TRUE){

    $total_belanja['total'] = $this->Transaksi_model->get_total_belanja();
    echo json_encode($total_belanja);

  } else {
    redirect('Tugas_Login');
  }
}

  public function bayar()
  {
  if($this->session->userdata('login_status') == TRUE){

      //insert ke table transaksi dulu
      if($this->Transaksi_model->tambah_transaksi()==TRUE)
      {
        $this->session->set_flashdata('notif', 'Proses pembelian berhasil');
        redirect('Transaksi/index');

      }else {
        $this->session->set_flashdata('notif', 'Proses pembelian berhasil');
        redirect('Transaksi/index');
      }
      }else {
        redirect('Tugas_Login');
    }
  }
  public function riwayat()
  	{
  		if($this->session->userdata('login_status') == TRUE){
  			$data['content_view'] = 'riwayat_transaksi_view';
  			$data['riwayat'] = $this->Transaksi_model->get_riwayat_transaksi();

  			$this->load->view('template', $data);
  		} else {
  			redirect('login/index');
  		}
  	}

  	public function get_detil_transaksi_by_id($id)
  	{
  		if($this->session->userdata('login_status') == TRUE){
  			$detil_transaksi = $this->Transaksi_model->get_transaksi_by_id($id);
  			$data['show_detil'] = "";
  			$total = 0;
  			$no = 1;
  			$data['show_detil'] .= '<table class="table table-striped">
  									<tr>
  										<th>No</th>
  										<th>Kode hewan</th>
  										<th>Nama hewan</th>

  										<th>Stok</th>
  										<th>Harga</th>
  										<th>Jumlah</th>
  										<th>Sub Total</th>
  									</tr>';

  			foreach ($detil_transaksi as $d) {
  				$data['show_detil'] .= '<tr>
  									<td>'.$no.'</td>
  									<td>'.$d->kode_hewan.'</td>
  									<td>'.$d->nama_hewan.'</td>

  									<td>'.$d->stok.'</td>
  									<td>'.$d->harga.'</td>
  									<td>'.$d->jumlah.'</td>
  									<td>'.$d->harga*$d->jumlah.'</td>
  								</tr>';

  				$no++;
  				$total += $d->harga*$d->jumlah;
  			}
  			$data['show_detil'] .= '</table>';
  			$data['show_detil'] .= '<h3><p class="text-right">Total Belanja:</p></h3>
  									<h2><p class="text-right">Rp '.$total.',- </p></h2>';
  			echo json_encode($data);
  		} else {
  			redirect('login/index');
  		}
  	}

  	public function cetak_nota($id)
  	{
      if($this->session->userdata('login_status') == TRUE){
        $detil_transaksi = $this->Transaksi_model->get_transaksi_by_id($id);
        $transaksi = $this->Transaksi_model->get_detail_transaksi($id);
        $data['dts'] = $detil_transaksi;
        $data['ts'] = $transaksi;
        $data['total'] = 0;
        $this->load->view('cetak_nota_view',$data);
      } else {
        redirect('login/index');
      }

  	}

  }

  /* End of file Transaksi.php */
  /* Location: ./application/controllers/Transaksi.php */
