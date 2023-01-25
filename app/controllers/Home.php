<?php
class Home extends controller
{
    public function index()
    {
        header('location:' . BASEURL . 'home/v1');
    }
    public function v1()
    {
        $data['judul'] = 'Travel Batang Kapas Bersatu';
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function order()
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            if (($_POST['dari'] == "-") || ($_POST['tujuan'] == "-") || empty($_POST['tanggal']) || ($_POST['jam'] == "0")) {
                Flasher::setFlash('Gagal', ' Mohon untuk mengisi semua field', 'danger');
                header('Location:' . BASEURL . 'home/v1');
                exit;
            } else {
                if ($this->model('Home_model')->tambahDataOrder($_POST) > 0) {
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

    public function orderList()
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            $data['judul'] = 'Pesanan Anda';
            $data['kosong'] = '';
            $data['orders'] = $this->model('Home_model')->getAllOrder();
            if (count($data['orders']) <= 0) {
                $data['kosong'] = 'Tidak ada data';
            }
            $this->view('templates/header', $data);
            $this->view('home/order_list', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Gagal', ' Anda harus login terlebih dahulu', 'danger');
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }

    public function orderDetail($orderId)
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            $data['judul'] = 'Pesanan Anda';
            $data['order_detail'] = $this->model('Home_model')->getOneOrder($orderId);
            $data['driver_detail'] = $this->model('Home_model')->getDriverInfo($data['order_detail']['driverId']);
            if (!($data['order_detail']) or ($data['order_detail']['userId'] != $_SESSION['tbkb_user_id'])) {
                Flasher::setFlash('Gagal', ' Data tidak ditemukan', 'danger');
                header('Location:' . BASEURL . 'home/orderList');
                exit;
                exit;
            }
            $this->view('templates/header', $data);
            $this->view('home/order_detail', $data);
            $this->view('templates/footer');
        } else {
            Flasher::setFlash('Gagal', ' Anda harus login terlebih dahulu', 'danger');
            header('Location:' . BASEURL . 'home/v1');
            exit;
        }
    }

    public function hapusOrder()
    {
        if (isset($_SESSION['tbkb_user_id'])) {
            if ($this->model('Home_model')->hapusData() > 0) {
                Flasher::setFlash('berhasil', ' dihapus', 'success');
                header('Location:' . BASEURL . 'home/orderList');
                exit;
            } else {
                Flasher::setFlash('gagal', $_POST['orderId'], 'danger');
                header('Location:' . BASEURL . 'home/orderList');
                exit;
            }
        } else {
            header('location:' . BASEURL . 'login');
        }
    }
}
