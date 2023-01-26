<?php


class Driver_model
{

    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function tambahDataDriver($data)
    {   $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO drivers VALUES(:userId,:nama,:telp,:email,:password)";
        $this->db->query($query);
        $this->db->bind(':userId', uniqid('driver_'));
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


    // public function check_user($data){
    //     $query = "SELECT * FROM user WHERE email = :email";
    //     $this->db->query($query);
    //     $this->db->bind('email',$data['email']);
    //     $this->db->execute();

    //     return $this->db->rowCount();

    // }


}
