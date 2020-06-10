<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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

        $this->load->view('auth_v/login');
    }

    public function forget_password()
    {
        if (get_logged_user())
            redirect(base_url());

        $this->load->view('auth_v/forget_password');
    }

    public function send_password()
    {
        if (get_logged_user())
            redirect(base_url());

        $this->load->view('auth_v/forget_password');
    }

    public function profile()
    {
        if (!get_logged_user())
            redirect(base_url("index.php/login"));

        $viewData = new stdClass();
        $userID = $this->session->userdata('id');
        $viewData->user = $this->auth_model->getUserByID($userID);
        $this->load->view('profile', $viewData);
    }

    public function update()
    {
        if (!get_logged_user())
            redirect(base_url("index.php/login"));

        $this->load->library('form_validation');
        $this->load->helper('security');

        $this->form_validation->set_rules('name', 'Adı', 'trim|required|xss_clean');
        $this->form_validation->set_rules('surname', 'Soyadı', 'trim|required|xss_clean');
        $this->form_validation->set_rules('username', 'Kullanıcı Adı', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Şifre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('confirm_password', 'Şifre (Tekrar)', 'trim|required|matches[password]|xss_clean');
        $this->form_validation->set_rules('email', 'Eposta', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('profile');
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'surname' => $this->input->post('surname', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => md5($this->input->post('password', TRUE)),
                'email' => $this->input->post('email', TRUE)
            );

            $result = $this->auth_model->update($this->session->userdata('id'), $data);
            if ($result) {
                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Profil bilgileriniz başarıyla güncellendi!",
                    "type" => "success"
                );

                $this->session->set_flashdata("alert", $alert);
                $viewData = new stdClass();
                $userID = $this->session->userdata('id');
                $viewData->user = $this->auth_model->getUserByID($userID);
                $this->load->view('profile', $viewData);
            }
        }

    }

    public function dologin()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');

        $this->form_validation->set_rules('username', 'Kullanıcı Adı', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Şifre', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $alert = array(
                "title" => "Giriş İşlemi Başarısız",
                "text" => "Kullanıcı adınız ve/veya şifreniz boş geçilemez.",
                "type" => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            $this->load->view('auth_v/login');
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'password' => md5($this->input->post('password', TRUE))
            );

            $result = $this->auth_model->login($data);

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

                $this->auth_model->insert(array(
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
                $alert = array(
                    "title" => "Giriş İşlemi Başarısız",
                    "text" => "Kullanıcı Adı veya Parola Hatalı",
                    "type" => "error"
                );

                $this->session->set_flashdata("alert", $alert);
                $this->load->view('auth_v/login');
            }
        }
    }

    public function logout()
    {
        if (!get_logged_user())
            redirect(base_url('login'));

        $ip_address = getClientIP();
        $ip2loc = ip_details($ip_address);
        $this->auth_model->insert(array(
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