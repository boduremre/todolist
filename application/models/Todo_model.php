<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 25.03.2019
 * Time: 00:20
 */

class Todo_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public $tableName = "todo";

    public function get_all()
    {
        $this->db->order_by("isActive","desc");
        $this->db->order_by("createdDate","desc");
        return $this->db->get($this->tableName)->result();
    }

    public function get_all_by_UserID($userID)
    {
        $this->db->order_by("isActive","desc");
        $this->db->order_by("createdDate","desc");
        $this->db->where("userID", $userID);
        return $this->db->get($this->tableName)->result();
    }

    public function insert($data = array())
    {
        return $this->db->insert($this->tableName, $data);
    }

    public function delete($id)
    {
        return $this->db->where("id", $id)->delete($this->tableName);
    }

    public function update($id, $data)
    {
        return $this->db->where("id", $id)->update($this->tableName, $data);
    }
}