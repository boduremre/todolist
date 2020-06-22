<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->model('auth_model');
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

    public function password_change()
    {
        if (get_logged_user())
            redirect(base_url());

        $viewData = new stdClass();
        $viewData->email = base64_decode($this->uri->segment(3));
        $viewData->token = $this->uri->segment(4);
        $this->load->view('auth_v/password_change', $viewData);
    }

    public function password_change_save()
    {
        if (get_logged_user())
            redirect(base_url("index.php/login"));

        $this->load->library('form_validation');
        $this->load->helper('security');

        $this->form_validation->set_rules('token', 'Adı', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Şifre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('confirm_password', 'Şifre (Tekrar)', 'trim|required|matches[password]|xss_clean');
        $this->form_validation->set_rules('email', 'Eposta', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            redirect('password/reset');
        } else {
            $data = array(
                'token' => $this->input->post('username', TRUE),
                'password' => md5($this->input->post('password', TRUE))
            );

            $result = $this->auth_model->password_change_save($this->input->post('email', TRUE), $data);

            if ($result)
                toastMessageWithRedirectURI("İşlem Başarılı", "Şifreniz başarıyla güncellendi!", "login");
            else
                toastMessageWithRedirectURI("İşlem Başarısız", "Şifre güncellenemedi!", "login", "error");
        }
    }

    public function send_password()
    {
        if (get_logged_user())
            redirect(base_url());

        $from = "noreply@emrebodur.com";    //senders email address
        $subject = 'ToDo List - Şifre Sıfırlama';  //email subject
        $receiver = $this->input->post('email', TRUE); //user email adres
        $data = $this->auth_model->password_change($receiver);

        if ($data) {
            $message = 'Sayın ' . $data['name'] . ' ' . $data['surname'] . ' (' . $data['username'] . '),<br><br> E-posta adresinizi doğrulamak için lütfen aşağıdaki etkinleştirme bağlantısını tıklayın.<br><br><a href="' . base_url() . 'index.php/password/change/' . base64_encode($receiver) . '/' . $data['token'] . '">' . base_url() . 'index.php/password/change/' . base64_encode($receiver) . '/' . $data['token'] . '</a><br><br>Teşekkürler.';

            //config email settings
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.emrebodur.com';
            $config['smtp_port'] = '587';
            $config['smtp_user'] = $from;
            $config['smtp_pass'] = 'Qx83cmAh';  //sender's password
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = 'TRUE';
            $config['newline'] = "\r\n";

            $this->load->library('email', $config);
            $this->email->initialize($config);

            //send email
            $this->email->from($from);
            $this->email->to($receiver);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                toastMessageWithRedirectURI("İşlem Başarılı", "Şifre sıfırlama linki e-posta adresinize gönderildi.", "login");
            } else {
                toastMessageWithRedirectURI("İşlem Başarısız", "Şifre sıfırlama linki e-posta adresinize gönderilemedi!", "password/reset", "error");
            }
        } else {
            toastMessageWithRedirectURI("Hata", "Girilen E-posta adresine ait bir kullanıcı bulunamadı!", "password/reset", "error");
        }
    }

    public function profile()
    {
        if (!get_logged_user())
            redirect(base_url("index.php/login"));

        $viewData = new stdClass();
        $viewData->user = $this->auth_model->getUserByID($this->session->userdata('id'));
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
                    'isAdmin' => $result[0]['isAdmin'],
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
                toastMessageWithRedirectURI("Giriş İşlemi Başarısız", "Kullanıcı Adı veya Parola Hatalı veya Üyeliğiniz Aktif Değil!", "login", "error");
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

        $this->session->unset_userdata(array('id', 'username', 'name', 'surname', 'is_logged_in', 'isAdmin'));
        $this->session->sess_destroy();

        redirect(base_url('/index.php/login'));
    }

    public function emailVerifyView()
    {
        if (!get_logged_user())
            redirect(base_url('login'));

        $this->load->view('auth_v/email_verify');
    }

    //send confirm mail
    public function sendEmail()
    {
        $from = "noreply@emrebodur.com";    //senders email address
        $subject = 'ToDo - E-posta Adresini Doğrulayın';  //email subject
        $receiver = trim($this->input->post('email', TRUE)); //user email adres

        //sending confirmEmail($receiver) function calling link to the user, inside message body
        $message = "Sevgili Kullanıcı,<br><br> E-posta adresinizi doğrulamak için lütfen aşağıdaki etkinleştirme bağlantısını tıklayın.<br><br><a href='" . base_url() . "index.php/email/verify/" . base64_encode($receiver) . "'>" . base_url() . "index.php/email/verify/" . base64_encode($receiver) . "</a><br><br>Teşekkürler.";

        //config email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.emrebodur.com';
        $config['smtp_port'] = '587';
        $config['smtp_user'] = $from;
        $config['smtp_pass'] = 'Qx83cmAh';  //sender's password
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n";

        $this->load->library('email', $config);
        $this->email->initialize($config);

        //send email
        $this->email->from($from);
        $this->email->to($receiver);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            toastMessageWithRedirectURI("İşlem Başarılı", "Doğrulama linki e-posta adresinize gönderildi.", "todo");
        } else {
            toastMessageWithRedirectURI("İşlem Başarısız", "Doğrulama E-postası gönderilemedi!", "todo", "error");
        }
    }

    function confirmEmail($email)
    {
        if ($this->auth_model->verifyEmail(base64_decode($email))) {
            toastMessageWithRedirectURI("İşlem Başarılı", "E-posta adresiniz onaylandı.", "todo");
        } else {
            toastMessageWithRedirectURI("İşlem Başarısız", "Doğrulama E-postası gönderilemedi!", "todo", "error");
        }
    }

    function setUserActive($id, $status)
    {
        if ($this->auth_model->setUserActive($id, $status)) {
            toastMessageWithRedirectURI("İşlem Başarılı", "Kullanıcı aktif/deaktif edildi!", "settings");
        } else {
            toastMessageWithRedirectURI("İşlem Başarısız", "Kullanıcı aktif/deaktif edilemedi!", "settings", "error");
        }
    }

    public function logs($id)
    {
        $this->load->model("settings_model");
        $result = $this->settings_model->getLoginLog($id);
        echo json_encode($result);
    }
}