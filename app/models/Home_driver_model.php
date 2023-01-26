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

    public function getOneBooking($bookingId)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE bookingId = :bookingId');
        $this->db->bind('bookingId', $bookingId);
        return $this->db->single();
    }

}
