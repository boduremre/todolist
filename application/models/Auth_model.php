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

    public function getUserList()
    {
        return $this->db->get('users')->result();
    }

    public function insert($data = array())
    {
        return $this->db->insert('authentication_logs', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where("id", $id)->update("users", $data);
    }

    function verifyEmail($email)
    {
        $data = array('emailConfirmed' => 1);
        $this->db->where('email', $email);
        return $this->db->update('users', $data);
    }

    function setUserActive($id, $status)
    {
        $data = array('isActive' => $status);
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function password_change($user_email)
    {
        $this->db->select('email, name, surname, username, token');
        $this->db->where('email', $user_email);
        $query = $this->db->get('users');

        if ($query->row_array() > 0) {
            $data['token'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50);;
            $this->db->where('email', $user_email);
            $this->db->update('users', $data);
            return $query->row_array();
        }

        return false;
    }

    public function password_change_save($email, $data)
    {
        return $this->db->where("email", $email)->update("users", $data);
    }
}
