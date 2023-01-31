<?php
class Home_driver extends controller
{

    public function index()
    {
        if (!isset($_SESSION['tbkb_driver_id'])) {
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
        if ($_SESSION['tbkb_driver_id']==1){
            header('Location:' . BASEURL . 'admin');
            exit;
        }
        if (isset($_SESSION['tbkb_driver_id'])) {
            $data['judul'] = 'List Pesanan';
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


    public function acceptBooking()
    {
        if ($_SESSION['tbkb_driver_id']==1){
            header('Location:' . BASEURL . 'admin');
            exit;
        }
        if (isset($_SESSION['tbkb_driver_id'])) {
            if ($this->model('Home_driver_model')->terimaBooking() > 0) {
                Flasher::setFlash('Pesanan', ' diterima', 'success');
                header('Location:' . BASEURL . 'home_driver');
                exit;
            } else {
                Flasher::setFlash('Pesanan', ' gagal diterima', 'danger');
                header('Location:' . BASEURL . 'home_driver');
                exit;
            }
        } else {
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }

    public function bookingList()
    {
        if ($_SESSION['tbkb_driver_id']==1){
            header('Location:' . BASEURL . 'admin');
            exit;
        }
        if (isset($_SESSION['tbkb_driver_id'])) {
            $data['judul'] = 'Pesanan yang anda terima';
            $data['kosong'] = '';
            $data['acc_booking'] = $this->model('Home_driver_model')->getAllAcceptedBooking();
            if (count($data['acc_booking']) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('home_driver/booking_list', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }
    public function bookingHistory()
    {
        if ($_SESSION['tbkb_driver_id']==1){
            header('Location:' . BASEURL . 'admin');
            exit;
        }
        if (isset($_SESSION['tbkb_driver_id'])) {
            $data['judul'] = 'Pesanan yang anda terima';
            $data['kosong'] = '';
            $data['hist_booking'] = $this->model('Home_driver_model')->getBookingHistory();
            if (count($data['hist_booking']) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('home_driver/booking_history', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }

    public function finishTrip()
    {
        if ($_SESSION['tbkb_driver_id']==1){
            header('Location:' . BASEURL . 'admin');
            exit;
        }
        if (isset($_SESSION['tbkb_driver_id'])) {
            if ($this->model('Home_driver_model')->finish() > 0) {
                Flasher::setFlash('Perjalanan', ' ini selesai', 'success');
                header('Location:' . BASEURL . 'home_driver/bookingList');
                exit;
            } else {
                Flasher::setFlash('Gagal', '', 'danger');
                header('Location:' . BASEURL . 'home_driver/bookingList');
                exit;
            }
        } else {
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }
}
