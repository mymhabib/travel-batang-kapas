<?php


class Login_model{
    // use Session;
    private $table='user';
    private $db;

    public function __construct()
    {
        $this->db=new Database;
    }

    public function login($email, $password){
        $this->db->query('SELECT * from users where email = :email and is_activated = 1');
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


?>