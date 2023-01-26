<?php
class Home_driver extends controller
{

    public function index()
    {
        if (!isset($_SESSION['tbkb_driver_id'])) {
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
        if (isset($_SESSION['tbkb_driver_id'])) {
            $data['judul'] = 'Pesanan Anda';
            $data['kosong'] = '';
            $data['bookings'] = $this->model('Home_driver_model')->getAllBooking();
            if (count($data['bookings']) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('home_driver/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL . 'home/v1');
        }
    }

    public function bookingDetail($bookingId)
    {
        if (isset($_SESSION['tbkb_driver_id'])) {
            $data['judul'] = 'List Pesanan';
            $data['booking_detail'] = $this->model('Home_driver_model')->getOneBooking($bookingId);
            $data['driver_detail'] = $this->model('Home_driver_model')->getDriverInfo($data['booking_detail']['driverId']);
            if (!($data['booking_detail']) or ($data['booking_detail']['userId'] != $_SESSION['tbkb_user_id'])) {
                Flasher::setFlash('Gagal', ' Data tidak ditemukan', 'danger');
                header('Location:' . BASEURL . 'home_driver/bookingList');
                exit;
            }
            $this->view('templates/header', $data);
            $this->view('home_driver/booking_detail', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }
}
