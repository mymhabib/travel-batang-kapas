<?php
class Admin extends Controller
{
    public function index(){
        header('Location:' . BASEURL . 'admin/driver');
        exit;
    }
    public function driver()
    {
        if (!isset($_SESSION['tbkb_driver_id'])) {
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
        if ($_SESSION['tbkb_driver_id'] != 1) {
            Flasher::setFlash('Halaman pendaftaran driver hanya untuk admin', '', 'danger');
            header('Location:' . BASEURL . 'home_driver');
            exit;
        } else {
            $data['judul'] = 'List Driver';
            $data['kosong'] = '';
            $data['drivers'] = $this->model('Admin_model')->getAllDrivers();
            if (count($data['drivers']) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('admin/driver', $data);
            $this->view('templates/footer');
        }
    }

    public function noaccess()
    {
        $data['judul'] = 'Tidak ada akses';
        $this->view('admin/noaccess', $data);
    }

    public function hapusDriver()
    {
        if (!isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home');
            exit;
        }

        if ($_SESSION['tbkb_driver_id'] != 1) {
            header('Location:' . BASEURL . 'admin/noaccess');
            exit;
        } else {
            if ($this->model('Admin_model')->hapusDriver() > 0) {
                Flasher::setFlash('Driver', ' berhasil dihapus', 'success');
                header('Location:' . BASEURL . 'admin/driver');
                exit;
            } else {
                Flasher::setFlash('gagal', ' dihapus', 'danger');
                header('Location:' . BASEURL . 'admin/driver');
                exit;
            }
        } 
    }
}
