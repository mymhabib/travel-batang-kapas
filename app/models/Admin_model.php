<?php

class Admin_model
{

    private $table = 'drivers';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function getAllDrivers()
    {
        $this->db->query('SELECT * FROM ' . $this->table . '');
        return $this->db->resultSet();
    }
    public function hapusDriver()
    {
        $driverId = $_POST['driverId'];
        $query = 'DELETE FROM ' . $this->table . ' where driverId=:driverId';
        $this->db->query($query);
        $this->db->bind('driverId', $driverId);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getAllBookings()
    {
        $this->db->query('SELECT bookings.*, users.nama as nama_user, users.telp as telp_user, drivers.nama as nama_driver, drivers.telp as telp_driver FROM bookings left outer join users on bookings.userId = users.userId left outer join drivers on bookings.driverId = drivers.driverId ORDER BY bookings.selesai, bookings.driverId ASC');
        return $this->db->resultSet();
    }

}


