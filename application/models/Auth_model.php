<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
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

    public function getUserByID($id)
    {
        $this->db->where('id', $id);
        $this->db->where('isActive', 1);
        return $this->db->get('users')->row();
    }

    public function insert($data = array())
    {
        return $this->db->insert('user_login_log', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where("id", $id)->update("users", $data);
    }
}

?>