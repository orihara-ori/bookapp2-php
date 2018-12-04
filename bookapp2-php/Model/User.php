<?php
require_once("config.php");

class User {
    private $db;
    function __construct() {
        $user = DB_USER;
        $password = DB_PASSWORD;
        $dbname = 'bookapp';
        $host = 'localhost';
        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
        $this->db = new PDO($dsn, $user, $password);
    }

    public function getUserByName($username)
    {
        $sql = "SELECT * FROM users WHERE name = :username";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(':username', $username, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addUser($username, $hashed_password)
    {
        $sql = "INSERT INTO users (name, password) VALUES (:username, :hashed_password)";
        $stm = $this->db->prepare($sql);
        $stm->bindValue(':username', $username, PDO::PARAM_STR);
        $stm->bindValue(':hashed_password', $hashed_password, PDO::PARAM_STR);
        $stm->execute();
        return $this->db->lastInsertId();
    }


}