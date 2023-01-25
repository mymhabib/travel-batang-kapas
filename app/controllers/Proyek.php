<?php
class Proyek extends Controller
{

    public function index()
    {

        if (isset($_SESSION['tbkb_user_id'])) {
            $data['judul'] = 'Daftar Proyek';
            $data['tahun'] = '';
            $data['kosong'] = '';
            $data['proyek'] = $this->model('Proyek_model')->getAllProyek();
            if (count($this->model('Proyek_model')->getAllProyek()) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('proyek/index', $data);
            $this->view('templates/footer');
        } else {
            header('location:' . BASEURL . 'login');
        }
    }
    public function detail($id)
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            $data['judul'] = 'Detail Proyek';
            $data['proyek'] = $this->model('Proyek_model')->getProyekById($id);
            $this->view('templates/header', $data);
            $this->view('proyek/detail', $data);
            $this->view('templates/footer');
        } else {
            header('location:' . BASEURL . 'login');
        }
    }
    public function tambah()
    {

        if (isset($_SESSION['tbkb_user_id'])) {
            if ($_SESSION['tbkb_user_id'] == 1) {
                if (empty($_POST['pt']) || empty($_POST['nama_proyek']) || empty($_POST['tahun_proyek']) || empty($_POST['bulan_proyek']) || empty($_POST['tanggal_proyek']) || empty($_POST['lokasi']) || empty($_POST['maps']) || empty($_POST['link'])) {
                    Flasher::setFlash('gagal', ' ditambahkan', 'danger');
                    header('Location:' . BASEURL . 'proyek');
                    exit;
                } else {
                    if ($this->model('Proyek_model')->tambahDataProyek($_POST) > 0) {
                        Flasher::setFlash('berhasil', ' ditambahkan', 'success');
                        header('Location:' . BASEURL . 'proyek');
                        exit;
                    } else {
                        Flasher::setFlash('gagal', ' ditambahkan', 'danger');
                        header('Location:' . BASEURL . 'proyek');
                        exit;
                    }
                }
            } else {
                Flasher::setFlash('anda tidak memiliki akses', ' ', 'danger');
                header('Location:' . BASEURL . 'proyek');
                exit;
            }
        } else {
            header('location:' . BASEURL . 'login');
        }
    }
    public function hapus($id)
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            if ($_SESSION['tbkb_user_id'] == 1) {
                if ($this->model('proyek_model')->hapusDataProyek($id) > 0) {
                    Flasher::setFlash('berhasil', ' dihapus', 'success');
                    header('Location:' . BASEURL . 'proyek');
                    exit;
                } else {
                    Flasher::setFlash('gagal', ' dihapus', 'danger');
                    header('Location:' . BASEURL . 'proyek');
                    exit;
                }
            } else {
                Flasher::setFlash('anda tidak memiliki akses', ' ', 'danger');
                header('Location:' . BASEURL . 'proyek');
                exit;
            }
        } else {
            header('location:' . BASEURL . 'login');
        }
    }
    public function getubah()
    {
        echo json_encode($this->model('Proyek_model')->getProyekById($_POST['id']), true);
    }

    public function ubah()
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            if ($_SESSION['tbkb_user_id'] == 1) {
                if (empty($_POST['pt']) || empty($_POST['nama_proyek']) || empty($_POST['tahun_proyek']) || empty($_POST['bulan_proyek']) || empty($_POST['tanggal_proyek']) || empty($_POST['lokasi']) || empty($_POST['maps']) || empty($_POST['link'])) {
                    Flasher::setFlash('gagal', ' diubah', 'danger');
                    header('Location:' . BASEURL . 'proyek/detail/' . $_POST['id']);
                    exit;
                } else {
                    if ($this->model('Proyek_model')->ubahDataProyek($_POST) > 0) {
                        Flasher::setFlash('berhasil', ' diubah', 'success');
                        header('Location:' . BASEURL . 'proyek/detail/' . $_POST['id']);
                        exit;
                    } else {
                        Flasher::setFlash('gagal', ' diubah', 'danger');
                        header('Location:' . BASEURL . 'proyek/detail/' . $_POST['id']);
                        exit;
                    }
                }
            } else {
                Flasher::setFlash('anda tidak memiliki akses', ' ', 'danger');
                header('Location:' . BASEURL . 'proyek/detail/' . $_POST['id']);
                exit;
            }
        } else {
            header('location:' . BASEURL . 'login');
        }
    }


    public function cari()
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            $data['judul'] = 'Daftar Proyek';
            $data['tahun'] = '';
            $data['kosong'] = '';
            $data['proyek'] = $this->model('Proyek_model')->cariDataProyek();
            if (count($this->model('Proyek_model')->cariDataProyek()) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('proyek/index', $data);
            $this->view('templates/footer');
        } else {
            header('location:' . BASEURL . 'login');
        }
    }

    public function Tahun($tahun)
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            $data['judul'] = 'Daftar Proyek';
            $data['tahun'] = 'Tahun ' . $tahun;
            $data['kosong'] = '';
            $data['proyek'] = $this->model('Proyek_model')->cariDataProyekTahun($tahun);
            if (count($this->model('Proyek_model')->cariDataProyekTahun($tahun)) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('proyek/index', $data);
            $this->view('templates/footer');
        } else {
            header('location:' . BASEURL . 'login');
        }
    }
}
