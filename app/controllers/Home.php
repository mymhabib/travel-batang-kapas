<?php
class Home extends controller
{
    public function index()
    {
        header('location:' . BASEURL . 'home/v1');
    }
    public function v1()
    {
        if (isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home_driver');
        }
        $data['judul'] = 'Travel Batang Kapas Bersatu';
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function booking()
    {
        if (isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home_driver');
        }
        if (isset($_SESSION['tbkb_user_id'])) {
            if (($_POST['dari'] == "-") || ($_POST['tujuan'] == "-") || empty($_POST['tanggal']) || ($_POST['jam'] == "0") | empty($_POST['titikJemput'])) {
                Flasher::setFlash('Gagal', ' Mohon untuk mengisi semua field', 'danger');
                header('Location:' . BASEURL . 'home/v1');
                exit;
            } else {
                if ($this->model('Home_model')->tambahDataBooking($_POST) > 0) {
                    Flasher::setFlash('', 'Pesanan anda berhasil ditambahkan', 'success');
                    header('Location:' . BASEURL . 'home/v1');
                    exit;
                }
            }
            
        } else {
            Flasher::setFlash('Gagal.', ' Anda harus login terlebih dahulu', 'danger');
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }

    public function bookingList()
    {
        if (isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home_driver');
        }
        if (isset($_SESSION['tbkb_user_id'])) {
            $data['judul'] = 'Pesanan Anda';
            $data['kosong'] = '';
            $data['bookings'] = $this->model('Home_model')->getAllBooking();
            if (count($data['bookings']) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('home/booking_list', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Gagal', ' Anda harus login terlebih dahulu', 'danger');
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }

    public function bookingDetail($bookingId)
    {
        if (isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home_driver');
        }
        if (isset($_SESSION['tbkb_user_id'])) {
            $data['judul'] = 'Pesanan Anda';
            $data['booking_detail'] = $this->model('Home_model')->getOneBooking($bookingId);
            $data['driver_detail'] = $this->model('Home_model')->getDriverInfo($data['booking_detail']['driverId']);
            if (!($data['booking_detail']) or ($data['booking_detail']['userId'] != $_SESSION['tbkb_user_id'])) {
                Flasher::setFlash('Gagal', ' Data tidak ditemukan', 'danger');
                header('Location:' . BASEURL . 'home/bookingList');
                exit;
            }
            $this->view('templates/header', $data);
            $this->view('home/booking_detail', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Gagal', ' Anda harus login terlebih dahulu', 'danger');
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }

    public function hapusBooking()
    {
        if (isset($_SESSION['tbkb_driver_id'])) {
            header('location:' . BASEURL . 'home_driver');
        }
        if (isset($_SESSION['tbkb_user_id'])) {
            if ($this->model('Home_model')->hapusData() > 0) {
                Flasher::setFlash('berhasil', ' dihapus', 'success');
                header('Location:' . BASEURL . 'home/bookingList');
                exit;
            } else {
                Flasher::setFlash('gagal', 'dihapus', 'danger');
                header('Location:' . BASEURL . 'home/bookingList');
                exit;
            }
        } else {
            header('location:' . BASEURL . 'login');
        }
    }
}
