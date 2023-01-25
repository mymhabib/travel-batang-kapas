<?php


class User_model
{

    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function tambahDataUser($data)
    {   $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO users VALUES(:userId,:nama,:telp,:email,:password,:token, 0)";
        $this->db->query($query);
        $this->db->bind(':userId', uniqid('user_'));
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':telp', $data['telp']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $hashed_password);
        $this->db->bind(':token', $data['token']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function findUserByemail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $this->db->query($query);
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function verifyToken($token)
    {
        $query = ("SELECT userId FROM users WHERE token = :token AND is_activated = 0");
        $this->db->query($query);
        $this->db->bind(':token', $token);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function activateAccount($token)
    {
        $query =("UPDATE users SET is_activated = 1 WHERE token = :token");
        $this->db->query($query);
        $this->db->bind(':token', $token);
        $this->db->execute();
    }

    // public function check_user($data){
    //     $query = "SELECT * FROM user WHERE email = :email";
    //     $this->db->query($query);
    //     $this->db->bind('email',$data['email']);
    //     $this->db->execute();

    //     return $this->db->rowCount();

    // }


}
