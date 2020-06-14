<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_User()
    {
        $arr= $this->db->get('tb_user')->result();
        return $arr;
    }


    public function hapus_user($id)
    {
        $this->db->where('id_user', $id)
                  ->delete('tb_user');

                  if($this->db->affected_rows() > 0){
                      return TRUE;
                  } else {
                      return FALSE;
                  }
                  }
    
    public function add_user()
    {
        $arr['nama'] = $this->input->post('nama');
        $arr['uname'] = $this->input->post('uname');
        $arr['pass'] = md5($this->input->post('pass'));
        $ql_masuk=$this->db->insert('tb_user', $arr);
        return $ql_masuk;
    }

    public function get_data_user_by_id($id)
    {
    return $this->db->where('id_user',$id)
                    ->get('tb_user')
                    ->row();
    }
    public function edit()
    {
        $user = array(
            
            'nama' => $this->input->post('nama_edit'),
            'uname' => $this->input->post('uname_edit'),
            'pass' => md5($this->input->post('pass_edit'))
        );
        $this->db->where('id_user', $this->input->post('id_user_edit'))
                 ->update('tb_user', $user);

        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

    