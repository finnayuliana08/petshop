<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

  public function cari_hewan()
  {
    $data_cart = $this->db->where('tb_pet.nama_hewan', $this->input->post('kode_hewan'))
                          ->get('tb_pet')
                          ->row();

    if($data_cart != NULL){

      if($data_cart->stok > 0){
        $cart_array = array(
                        'cart_id'  =>$this->session->userdata('uname'),
                        'id_hewan' =>$data_cart->id_hewan
          );
          $this->db->insert('tb_cart',$cart_array);

          return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
    }

    public function get_data_Hewan_by_id($id)
    {
      return $this->db->where('id_hewan', $id)
                      ->get('tb_pet')
                      ->row();
    }

    public function get_cart()
    {
      return $this->db->where('tb_cart.cart_id', $this->session->userdata('uname'))
                ->join('tb_pet', 'tb_pet.id_hewan = tb_cart.id_hewan')
                ->get('tb_cart')
                ->result();
    }

    public function hapus_item_cart()
    {
      $this->db->where('id', $this->input->post('hapus_id'))
               ->delete('cart');

      if($this->db->affected_rows() > 0)
      {
        return TRUE;
      } else {
        return FALSE;
      }
    }

public function ubah_jumlah_cart()
  {
      $data = array(
        'jumlah' => $this->input->post('jumlah')
      );

      $stok_awal = $this->get_data_Hewan_by_id($this->input->post('id_hewan'))->stok;
      if($stok_awal >= $this->input->post('jumlah')){
        $this->db->where('id', $this->input->post('id'))
                 ->update('tb_cart', $data);
            return TRUE;
      } else {
        return FALSE;
      }
}
public function get_total_belanja()
{
    return $this->db->select('SUM(tb_pet.harga*tb_cart.jumlah) as total')
                    ->join('tb_pet', 'tb_pet.id_hewan = tb_cart.id_hewan')
                    ->get('tb_cart')
                    ->row()->total;
}

public function tambah_transaksi()
{
  $data_transaksi = array(
    'id_kasir'    => $this->session->userdata('uname'),
    'nama_pembeli'=> $this->input->post('nama_pembeli')
  );
  $this->db->insert('tb_transaksi', $data_transaksi);
  $last_insert_id = $this->db->insert_id();

  for($i = 0; $i < count($this->get_cart()); $i++)
  {
    $data_detil_transaksi = array(
      'id_transaksi'      => $last_insert_id,
      'id_hewan'           => $this->input->post('id_hewan')[$i],
      'jumlah'             => $this->input->post('jumlah')[$i]
    );

    $this->db->insert('tb_detil_transaksi', $data_detil_transaksi);

    $stok_awal = $this->get_data_Hewan_by_id($this->input->post('id_hewan')[$i])->stok;
    $stok_akhir = $stok_awal-$this->input->post('jumlah')[$i];
    $stok = array('stok' => $stok_akhir);
    $this->db->where('id_hewan', $this->input->post('id_hewan')[$i])
             ->update('tb_pet', $stok);
  }

  $this->db->where('cart_id', $this->session->userdata('uname'))
           ->delete('tb_cart');
           return TRUE;
         }
  public function get_riwayat_transaksi()
	{
		return $this->db->select('tb_transaksi.id_transaksi, tb_transaksi.nama_pembeli, tb_transaksi.id_kasir, tb_transaksi.tgl_beli, (SELECT SUM(tb_detil_transaksi.jumlah*tb_pet.harga) FROM tb_detil_transaksi JOIN tb_pet ON tb_pet.id_hewan = tb_detil_transaksi.id_hewan WHERE id_transaksi = tb_transaksi.id_transaksi ) as total')
						->join('tb_detil_transaksi','tb_detil_transaksi.id_transaksi = tb_transaksi.id_transaksi')
						->join('tb_pet','tb_pet.id_hewan = tb_detil_transaksi.id_hewan')
						->group_by('id_transaksi')
						->get('tb_transaksi')
						->result();
	}

	public function get_transaksi_by_id($id)
	{
		return $this->db->select('tb_pet.kode_hewan, tb_pet.nama_hewan, tb_pet.stok, tb_pet.harga, tb_detil_transaksi.jumlah')
						->where('id_transaksi', $id)
						->join('tb_pet','tb_pet.id_hewan = tb_detil_transaksi.id_hewan')
						->get('tb_detil_transaksi')
						->result();
	}

  public function get_detail_transaksi($id){
    return $this->db->where('id_transaksi',$id)->get('tb_transaksi')->row();
  }

}
