<?php
class User extends Controller
{
    public function index(){
        header('location:' . BASEURL . 'user/login');
    }

    public function registration()
    {
        if (isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home_driver');
        }
        if (isset($_SESSION['tbkb_user_id'])) {
            header('location:' . BASEURL . 'home');
        }

        $data = [
            'judul' => 'Sign Up',
            'nama' => '',
            'email' => '',
            'password' => '',
            'telp' => '',
            'token' => '',
            'is_activated' => '',
            'confirmPassword' => '',
            'namaError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
            'telpError' => '',

        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'judul' => 'Sign Up',
                'nama' => trim($_POST['nama']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'telp' => trim($_POST['telp']),
                'token' => bin2hex(random_bytes(16)),
                'is_activated' => 0,
                'confirmPassword' => trim($_POST['confirmPassword']),
                'namaError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'telpError' => '',

            ];
            $nameValidation = "/^[a-zA-Z ]*$/";
            $numberValidation = "/^[0-9]*$/";

            //validasi nama
            if (empty($data['nama'])) {
                $data['namaError'] = 'Mohon masukkan Nama';
            } elseif (!preg_match($nameValidation, $data['nama'])) {
                $data['namaError'] = 'Nama hanya boleh terdiri dari angka dan huruf';
            }

            //validasi nomor telepon
            if (empty($data['telp'])) {
                $data['telpError'] = 'Mohon masukkan no telepon';
            } elseif (!preg_match($numberValidation, $data['telp'])) {
                $data['telpError'] = 'No telepon hanya boleh terdiri dari angka';
            } elseif (strlen($data['telp']) <= 10) {
                $data['telpError'] = 'No telepon minimal 11 digit';
            } elseif (strlen($data['telp']) >= 13) {
                $data['telpError'] = 'No telepon maksimal 15 digit';
            }

            //validasi email
            if (empty($data['email'])) {
                $data['emailError'] = 'Mohon masukkan alamat email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Mohon masukkan format email yang benar ';
            } else {
                //check email, ada/tidak
                if ($this->model('User_model')->findUserByEmail($data['email']) > 0) {
                    $data['emailError'] = 'Email sudah ada';
                }
            }

            if (empty($data['password'])) {
                $data['passwordError'] = 'Mohon masukkan password';
            } elseif (strlen($data['password']) < 6) {
                echo ($data['token']);
                $data['passwordError'] = 'Password minimal 6 karakter';
            }

            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Mohon masukkan password';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Password tidak cocok, mohon coba lagi';
                }
            }

            //memastikan tidak ada error
            if (empty($data['namaError']) && empty($data['emailError']) && empty($data['telpError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                //hash password
                // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->model('User_model')->tambahDataUser($data) > 0) {

                    //send email
                    //Recipients
                    $mailer = new Mailer;
                    $mailer->send($data['email'], 'Verifikasi alamat email anda', 'Untuk bisa masuk ke website Travel Batang Kapas Bersatu, email anda harus diverifikasi terlebih dahulu.' . "<br>" . 'Klik link dibawah ini untuk melakukan verifikasi email. ' . "<br>" . '<a href="' . BASEURL . 'user/verify/' . $data['token'] . '">' . BASEURL . 'user/verify/' . $data['token'] . '</a> ' . "<br>" . 'Abaikan email ini jika anda tidak pernah meminta ini. ' . "<br>" . 'Terima kasih.' . "<br>" . 'Travel Batang Kapas Bersatu');
                    header('location:' . BASEURL . 'verifikasi');
                } else {
                    die('Terjadi kesalahan.');
                }
            }
        } else {
            $data = [
                'judul' => 'Sign Up',
                'nama' => '',
                'email' => '',
                'password' => '',
                'telp' => '',
                'token' => '',
                'is_activated' => '',
                'confirmPassword' => '',
                'namaError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'telpError' => '', 
            ];
        }

        $this->view('user/registration', $data);
    }
    public function verify($token)
    {
        if ($this->model('User_model')->verifyToken($token)) {
            // activate the user's account
            $this->model('User_model')->activateAccount($token);
            // redirect the user to the login page
            header('Location: ' . BASEURL . 'verifikasi/berhasil');
        } else {
            // display an error message
            echo 'Invalid or expired token';
        }
    }


    public function login()
    {
        if (isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home_driver');
        }
        if (isset($_SESSION['tbkb_user_id'])) {
            header('location:' . BASEURL . 'home');
        }

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
                $loggedInUser = $this->model('User_model')->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                    echo "berhasil";
                } else {
                    $data['passwordError'] = 'Ada kesalahan pada password atau email. Jika anda sudah membuat akun sebelumnya pastikan anda sudah melakukan verifikasi email.';

                    $this->view('user/login', $data);
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
        $this->view('user/login', $data);
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
        header('location:' . BASEURL . 'user/login');
    }

    


    
}
