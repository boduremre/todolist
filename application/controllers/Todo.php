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

        $this->load->model('todo_model');
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

    public function delete($id)
    {        
		if($this->todo_model->delete($id)){
			$alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Görev başarılı bir şekilde silindi.",
                "type" => "success"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect('todo');
        }else {
			$alert = array(
				"title" => "İşlem Başarısız",
                "text" => "Silme işlemi başarısız!",
                "type" => "error"
            );
			
			$this->session->set_flashdata("alert", $alert);
            redirect('todo');
        }
    }

    public function isCompletedSetter($id)
    {
		$data = array(
            "isActive" => 0,
            "completedDate" => date("Y-m-d H:i:s")
        );
		
		if($this->todo_model->update($id, $data)){
			$alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Görev tamamlandı olarak işaretlendi.",
                "type" => "success"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect('todo');
        }else {
			$alert = array(
				"title" => "İşlem Başarısız",
                "text" => "Görev tamamlandı olarak işaretlenemedi!",
                "type" => "error"
            );
			
			$this->session->set_flashdata("alert", $alert);
            redirect('todo');
        }
    }

    public function settings()
    {
        $this->load->model("settings_model");
        $this->load->model("auth_model");
        $viewData = array(
            "items" => $this->settings_model->getLoginLog($this->session->userdata('id')),
            "users" => $this->auth_model->getUserList()
        );

        $this->load->view('settings', $viewData);
    }

}
