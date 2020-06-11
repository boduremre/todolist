<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        if (get_logged_user())
            redirect(base_url());

        $this->load->view('login');
    }

    public function forget_password()
    {
        if (get_logged_user())
            redirect(base_url());

        $this->load->view('forget_password');
    }

    public function send_password()
    {
        if (get_logged_user())
            redirect(base_url());

        $this->load->view('forget_password');
    }


    public function dologin()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Kullanıcı Adı', 'trim|required');
        $this->form_validation->set_rules('password', 'Şifre', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );

            $result = $this->login_model->login($data);

            if (empty($result) == FALSE) {

                $admin_data = array(
                    'id' => $result[0]['id'],
                    'username' => $this->input->post('username'),
                    'name' => $result[0]['name'],
                    'surname' => $result[0]['surname'],
                    'is_logged_in' => TRUE
                );

                $this->login_model->insert(array(
                    "userid" => $result[0]['id'],
                    "status" => 1,
                    "date" => date("Y-m-d H:i:s")
                ));

                $this->session->set_userdata($admin_data);

                redirect(base_url('/index.php/todo'));
            } else {
                echo('Kullanıcı Adı veya Parola Hatalı');
            }
        }
    }

    public function logout()
    {
        if (!get_logged_user())
            redirect(base_url('login'));


        $this->login_model->insert(array(
            "userid" => $this->session->userdata('id'),
            "status" => 0,
            "date" => date("Y-m-d H:i:s")
        ));

        $this->session->sess_destroy();
        $this->session->unset_userdata(array('id', 'username', 'name', 'surname', 'is_logged_in'));

        redirect(base_url('/index.php/login'));
    }
}