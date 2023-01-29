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

}
