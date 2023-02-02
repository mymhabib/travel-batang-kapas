<?php

class Home_driver_model
{

    private $table = 'bookings';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function getAllBooking()
    {
        $this->db->query('SELECT users.nama, users.telp, ' . $this->table . '.* FROM ' . $this->table . ' INNER JOIN users ON ' . $this->table . '.userId=users.userId WHERE driverId = "0" ORDER BY tanggal ASC');
        return $this->db->resultSet();
    }

    public function getAllAcceptedBooking()
    {
        $driverId = $_SESSION['tbkb_driver_id'];
        $this->db->query('SELECT users.nama, users.telp, ' . $this->table . '.* FROM ' . $this->table . ' INNER JOIN users ON ' . $this->table . '.userId=users.userId WHERE driverId = :driverId and selesai = 0 ORDER BY tanggal ASC');
        $this->db->bind(':driverId', $driverId);
        return $this->db->resultSet();
    }

    public function getBookingHistory()
    {
        $driverId = $_SESSION['tbkb_driver_id'];
        $this->db->query('SELECT users.nama, users.telp, ' . $this->table . '.* FROM ' . $this->table . ' INNER JOIN users ON ' . $this->table . '.userId=users.userId WHERE driverId = :driverId and selesai > 0 ORDER BY tanggal ASC');
        $this->db->bind(':driverId', $driverId);
        return $this->db->resultSet();
    }


    public function terimaBooking(){
        $bookingId = $_POST['bookingId'];
        $driverId = $_SESSION['tbkb_driver_id'];
        $query = 'UPDATE bookings SET driverId = :driverId WHERE bookingId = :bookingId';
        $this->db->query($query);
        $this->db->bind('bookingId', $bookingId);
        $this->db->bind('driverId', $driverId);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function finish(){
        $bookingId = $_POST['bookingId'];
        $driverId = $_SESSION['tbkb_driver_id'];
        $query = 'UPDATE bookings SET selesai = 1 WHERE bookingId = :bookingId and driverId = :driverId';
        $this->db->query($query);
        $this->db->bind('bookingId', $bookingId);
        $this->db->bind('driverId', $driverId);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cancel(){
        $bookingId = $_POST['bookingId'];
        $driverId = $_SESSION['tbkb_driver_id'];
        $query = 'UPDATE bookings SET selesai = 2 WHERE bookingId = :bookingId and driverId = :driverId';
        $this->db->query($query);
        $this->db->bind('bookingId', $bookingId);
        $this->db->bind('driverId', $driverId);
        $this->db->execute();
        return $this->db->rowCount();
    }



}
