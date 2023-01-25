  <?php
    class Verifikasi extends Controller
    {

        public function index()
        {
            $data['judul'] = 'Verifikasi';
            $this->view('verifikasi/index', $data);
        }

        public function berhasil()
        {
            $data['judul'] = 'Verifikasi Berhasil';
            $this->view('verifikasi/berhasil', $data);
        }
    }
