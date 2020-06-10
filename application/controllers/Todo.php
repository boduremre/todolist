<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');

        if (!get_logged_user())
            redirect(base_url("index.php/login"));


    }

    public function index()
    {
        $viewData = array(
            "items" => $this->todo_model->get_all_by_UserID($this->session->userdata('id'))
        );

        $this->load->view('todo', $viewData);
    }

    public function insert()
    {
        $todo_title = $this->input->post("todo_title");

        $this->todo_model->insert(array(
            "aciklama" => $todo_title,
            "isActive" => 1,
            "createdDate" => date("Y-m-d H:i:s"),
            "userID" => $this->session->userdata('id')
        ));

        redirect(base_url());
    }

    public function delete()
    {
        $id = $this->input->post("id");
        $this->todo_model->delete($id);
    }

    public function isCompletedSetter($id)
    {
        $completed = ($this->input->post("completed") == "true") ? 1 : 0;

        $this->todo_model->update($id, array(
            "isActive" => $completed,
            "completedDate" => date("Y-m-d H:i:s")
        ));
    }

    public function dashboard()
    {
        $this->load->model("dashboard_model");
        $viewData = array(
            "items" => $this->dashboard_model->getLoginLog($this->session->userdata('id'))
        );

        $this->load->view('dashboard', $viewData);
    }

}
