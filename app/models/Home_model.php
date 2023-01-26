<?php

class Home_model
{

    private $table = 'bookings';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambahDataBooking($data)
    {
        $query = "INSERT INTO bookings VALUES(:bookingId,:userId,:dari,:tujuan,:tanggal,:jam,:jumlah,0,0)";
        $this->db->query($query);
        $this->db->bind(':bookingId', uniqid('booking'));
        $this->db->bind(':userId', $_SESSION['tbkb_user_id']);
        $this->db->bind(':dari', $data['dari']);
        $this->db->bind(':tujuan', $data['tujuan']);
        $this->db->bind(':tanggal', $data['tanggal']);
        $this->db->bind(':jam', $data['jam']);
        $this->db->bind(':jumlah', $data['jumlah']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    public function getAllBooking()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE userId = :userId ORDER BY selesai, driverId ASC');
        $this->db->bind(':userId', $_SESSION['tbkb_user_id']);
        return $this->db->resultSet();
    }

    public function getOneBooking($bookingId)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE bookingId = :bookingId');
        $this->db->bind('bookingId', $bookingId);
        return $this->db->single();
    }
    public function hapusData()
    {
        $bookingId = $_POST['bookingId'];
        $query = 'DELETE FROM ' . $this->table . ' where bookingId=:bookingId';
        $this->db->query($query);
        $this->db->bind('bookingId', $bookingId);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDriverInfo($driverId){
        $this->db->query('SELECT DISTINCT drivers.nama, drivers.telp, drivers.email FROM drivers INNER JOIN bookings ON bookings.driverId=drivers.driverId WHERE bookings.driverId = :driverId');
        $this->db->bind('driverId', $driverId);
        return $this->db->single();
    }
}
