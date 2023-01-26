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
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE driverId = "0" ORDER BY tanggal ASC');
        return $this->db->resultSet();
    }

    public function getAllAcceptedBooking()
    {
        $driverId = $_SESSION['tbkb_driver_id'];
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE driverId = :driverId and selesai = 0 ORDER BY tanggal ASC');
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



}
