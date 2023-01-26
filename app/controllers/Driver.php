    <?php
    class Driver extends Controller
    {

        public function registration()
        {

            $data = [
                'judul' => 'Driver Sign Up',
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
                    if ($this->model('driver_model')->findDriverByEmail($data['email']) > 0) {
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

                    if ($this->model('driver_model')->tambahDataDriver($data) > 0) {
                         header('location:' . BASEURL . 'verifikasi');
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

            $this->view('driver/registration', $data);
        }
    }
