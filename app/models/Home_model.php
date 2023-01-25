<?php

class Home_model
{

    private $table = 'orders';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambahDataOrder($data)
    {
        $query = "INSERT INTO orders VALUES(:orderId,:userId,:dari,:tujuan,:tanggal,:jam,:jumlah,0,0)";
        $this->db->query($query);
        $this->db->bind(':orderId', uniqid('order'));
        $this->db->bind(':userId', $_SESSION['tbkb_user_id']);
        $this->db->bind(':dari', $data['dari']);
        $this->db->bind(':tujuan', $data['tujuan']);
        $this->db->bind(':tanggal', $data['tanggal']);
        $this->db->bind(':jam', $data['jam']);
        $this->db->bind(':jumlah', $data['jumlah']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function getAllOrder()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE userId = :userId ORDER BY selesai, driverId ASC');
        $this->db->bind(':userId', $_SESSION['tbkb_user_id']);
        return $this->db->resultSet();
    }

    public function getOneOrder($orderId)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE orderId = :orderId');
        $this->db->bind('orderId', $orderId);
        return $this->db->single();
    }
    public function hapusData()
    {
        $orderId = $_POST['orderId'];
        $query = 'DELETE FROM ' . $this->table . ' where orderId=:orderId';
        $this->db->query($query);
        $this->db->bind('orderId', $orderId);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDriverInfo($driverId){
        $this->db->query('SELECT DISTINCT drivers.nama, drivers.telp, drivers.email FROM drivers INNER JOIN orders ON orders.driverId=drivers.driverId WHERE orders.driverId = :driverId');
        $this->db->bind('driverId', $driverId);
        return $this->db->single();
    }
}
