<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 25.03.2019
 * Time: 00:20
 */

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private $tableName = "authentication_log";

    public function getLoginLog($id)
    {
        // $this->db->order_by("isActive","desc");
        $this->db->order_by("date","desc");
        $this->db->where('userid', $id);
        return $this->db->get($this->tableName)->result();
    }
}