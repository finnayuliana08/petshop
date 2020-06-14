<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function user_check()
    {
        $username = $this->input->post('uname');
        $password = $this->input->post('pass');

        $query = $this->db->where('uname', $username)
                          ->where('pass',md5($password))
                          ->get('tb_user');

        if($query->num_rows() > 0)
        {
            $session = array(
                            'uname'     => $username,
                            'pass'     => $password,
                            'login_status' => TRUE
            );
            $this->session->set_userdata($session);
            return true;
        } else {
          return false;
        }
    }
}
