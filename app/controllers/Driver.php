<?php
class Driver extends Controller
{
    public function index(){
        header('location:' . BASEURL . 'driver/login');
    }

    public function registration()
    {
        if (!isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home');
        }

        $data = [
            'judul' => 'Driver Sign Up',
            'nama' => '',
            'email' => '',
            'password' => '',
            'telp' => '',
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
                'judul' => 'Driver Sign Up',
                'nama' => trim($_POST['nama']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'telp' => trim($_POST['telp']),
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
                if ($this->model('Driver_model')->finddriverByEmail($data['email']) > 0) {
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

                if ($this->model('Driver_model')->tambahDatadriver($data) > 0) {

                    //send email
                    //Recipients
                    header('location:' . BASEURL . 'driver/login');
                } else {
                    die('Terjadi kesalahan.');
                }
            }
        } else {
            $data = [
                'judul' => 'Driver Sign Up',
                'nama' => '',
                'email' => '',
                'password' => '',
                'telp' => '',
                'confirmPassword' => '',
                'namaError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'telpError' => '', 
            ];
        }

        $this->view('driver/registration', $data);
    }


    public function login()
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            header('location:' . BASEURL . 'home');
        }

        $data = [
            'judul' => 'Driver Login',
            'email' => '',
            'password ' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'judul' => 'Driver Login',
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
                $loggedInDriver = $this->model('Driver_model')->login($data['email'], $data['password']);

                if ($loggedInDriver) {
                    $this->createDriverSession($loggedInDriver);
                    echo "berhasil";
                } else {
                    $data['passwordError'] = 'Ada kesalahan pada password atau email. Jika anda sudah membuat akun sebelumnya pastikan anda sudah melakukan verifikasi email.';

                    $this->view('driver/login', $data);
                }
            }
        } else {
            $data = [
                'judul' => 'Driver Login',
                'email' => '',
                'password ' => '',
                'emailError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('driver/login', $data);
    }

    public function createDriverSession($driver)
    {
        $_SESSION['tbkb_driver_id'] = $driver->driverId;
        $_SESSION['tbkb_driver_email'] = $driver->email;
        $_SESSION['tbkb_driver_nama'] = $driver->nama;
        header('location:' . BASEURL . 'home_driver');
    }

    public function logout()
    {
        unset($_SESSION['tbkb_driver_id']);
        unset($_SESSION['tbkb_driver_email']);
        unset($_SESSION['tbkb_driver_nama']);
        header('location:' . BASEURL . 'driver/login');
    }

    


    
}
