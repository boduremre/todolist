<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function login($data)
    {
        $this->db->where('username', $data['username']);//bu method ile username değeri formdaki username ile eşleşen,
        $this->db->where('password', $data['password']);//password değeri formdaki password field ile eşleşen satırları,
        $this->db->where('isActive', 1);
        $query = $this->db->get('users');//membership tablosundan çekiyoruz.

        if ($query->num_rows() == 1)
            return $query->result_array();
        else
            return array();
    }

    public function insert($data = array())
    {
        return $this->db->insert('authentication_logs', $data);
    }
}

?>