<?php


class Driver_model
{

    private $table = 'drivers';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function tambahDataDriver($data)
    {   $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO drivers VALUES(:driverId,:nama,:telp,:email,:password)";
        $this->db->query($query);
        $this->db->bind(':driverId', uniqid('driver_'));
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':telp', $data['telp']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $hashed_password);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function findDriverByemail($email)
    {
        $query = "SELECT * FROM drivers WHERE email = :email";
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function login($email, $password){
        $this->db->query('SELECT * from drivers where email = :email');
        $this->db->bind(':email', $email); 
        $row = $this->db->singleLogin();
        $passwordCheck = !empty($row) ? $row->password:'';
        if (password_verify($password, $passwordCheck)){
            return $row;
        } else {
            return false;
        }
    }


}
