<?php

class Admin{
    public $id;
    public $username;
    public $password;


    public function __construct($id=null,$username=null,$password=null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public static function logInAdmin($usr, mysqli $conn)
    {
        $query = "SELECT * FROM admini WHERE username='$usr->username' and password='$usr->password'";
        return $conn->query($query);
    }
}


?>