<?php

namespace models;

use connection\Connection;
use PDO;

class User
{
    public $error = "there is already a user with the same name";
    public $view;
    private $db;

    public function __construct()
    {
        $conn = new Connection;
        $this->db = $conn->getConnection();
    }

    public function getUserByLogin($login)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function registerUser($name, $login, $password)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM `users` WHERE login = ?");
        $stmt->execute([$login]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $this->view->render('auth/register', ['xato' => $this->error]);
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO `users` (name, login, password, registration_date) VALUES (?, ?, ?, NOW())");
        $result = $stmt->execute([$name, $login, $hashedPassword]);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}