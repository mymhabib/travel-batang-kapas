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
        if (isset($_SESSION['tbkb_driver_id'])) {
            $data['judul'] = 'Pesanan yang anda terima';
            $data['kosong'] = '';
            $data['acc_bookings'] = $this->model('Home_driver_model')->getAllAcceptedBooking();
            if (count($data['acc_bookings']) <= 0) {
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
}
