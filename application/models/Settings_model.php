<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 25.03.2019
 * Time: 00:20
 */

class Settings_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tableName = "user_login_log";

    public function getLoginLog($id)
    {        
        $this->db->order_by("date","desc");
        $this->db->where('userID', $id);
		$this->db->where('status', 1);
		$this->db->limit('10');
        return $this->db->get($this->tableName)->result();
    }
}