<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
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

                $ip_address = getClientIP();
                $ip2loc = ip_details($ip_address);

                $this->login_model->insert(array(
                    "userID" => $result[0]['id'],
                    "status" => 1,
                    "date" => date("Y-m-d H:i:s"),
                    "browser" => $this->agent->browser(),
                    "platform" => $this->agent->platform(),
                    "ip_address" => $ip_address,
                    "geo_loc" => $ip2loc['city'] . ', ' . $ip2loc['region'] . ', ' . $ip2loc['country'] //ilçe, il ve ülke
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

        $ip_address = getClientIP();
        $ip2loc = ip_details($ip_address);
        $this->login_model->insert(array(
            "userID" => $this->session->userdata('id'),
            "status" => 2,
            "date" => date("Y-m-d H:i:s"),
            "browser" => $this->agent->browser(),
            "platform" => $this->agent->platform(),
            "ip_address" => $ip_address,
            "geo_loc" => $ip2loc['city'] . ', ' . $ip2loc['region'] . ', ' . $ip2loc['country'] //ilçe, il ve ülke
        ));

        $this->session->unset_userdata(array('id', 'username', 'name', 'surname', 'is_logged_in'));
        $this->session->sess_destroy();

        redirect(base_url('/index.php/login'));
    }
}