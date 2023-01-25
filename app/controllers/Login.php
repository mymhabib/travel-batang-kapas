<?php
class Login extends Controller
{

    public function index()
    {

        $data = [
            'judul' => 'Login',
            'email' => '',
            'password ' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'judul' => 'Login',
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];
            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $emailValidation = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";

            //validasi email
            if (empty($data['email'])) {
                $data['emailError'] = 'Mohon masukkan email';
            } elseif (!preg_match($emailValidation, $data['email'])) {
                $data['emailError'] = 'email tidak valid';
            }

            //validasi password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Mohon masukkan password';
            }

            if (empty($data['emailError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->model('Login_model')->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                    echo "berhasil";
                } else {
                    $data['passwordError'] = 'Ada kesalahan pada password atau email. Jika anda sudah membuat akun sebelumnya pastikan anda sudah melakukan verifikasi email.';

                    $this->view('login/index', $data);
                }
            }
        } else {
            $data = [
                'judul' => 'Login',
                'email' => '',
                'password ' => '',
                'emailError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('login/index', $data);
    }

    public function createUserSession($user)
    {
        $_SESSION['tbkb_user_id'] = $user->userId;
        $_SESSION['tbkb_email'] = $user->email;
        $_SESSION['tbkb_nama'] = $user->nama;
        header('location:' . BASEURL . 'home');
    }

    public function logout()
    {
        unset($_SESSION['tbkb_user_id']);
        unset($_SESSION['tbkb_email']);
        unset($_SESSION['tbkb_nama']);
        header('location:' . BASEURL . 'login');
    }
}
