<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hewan_model extends CI_Model {

    public function get_Hewan()
    {
        $arr= $this->db->get('tb_pet')->result();
        return $arr;
    }

    public function hapus_Hewan($id)
    {
        $this->db->where('id_hewan', $id)
                  ->delete('tb_pet');

                  if($this->db->affected_rows() > 0){
                      return TRUE;
                  } else {
                      return FALSE;
                  }
                  }

    public function add_Hewan()
    {
        $arr['nama_hewan'] = $this->input->post('nama_hewan');
        $arr['kode_hewan'] = $this->input->post('kode_hewan');
        $arr['jenis_kelamin'] = $this->input->post('jenis_kelamin');
        $arr['jenis_hewan'] = $this->input->post('jenis_hewan');
        $arr['stok'] = $this->input->post('stok');
        $arr['harga'] = $this->input->post('harga');
        $ql_masuk=$this->db->insert('tb_pet', $arr);
        return $ql_masuk;
    }

    public function get_data_Hewan_by_id($id)
    {
    return $this->db->where('id_hewan',$id)
                    ->get('tb_pet')
                    ->row();
    }
    public function edit()
    {
        $Hewan = array(

            'nama_hewan' => $this->input->post('nama_hewan_edit'),
            'jenis_hewan' => $this->input->post('jenis_hewan_edit'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin_edit'),
            'stok' => $this->input->post('stok_hewan_edit')
        );
        $this->db->where('id_hewan', $this->input->post('id_hewan_edit'))
                 ->update('tb_pet', $Hewan);

        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
