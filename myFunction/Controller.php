<?php

namespace myFunction;

class Controller
{
    public $view;

    public function __construct()
    {
        $this->view = new Views();
    }

    public function valid_login($login)
    {
        $length = strlen($login);
        if ($length < 5 || $length > 50) {
            return false;
        }
        if (!ctype_alnum($login)) {
            return false;
        }
        return true;
    }
    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }
    public function valid_password($password) {
            $length = strlen($password);

            if ($length < 8 || $length > 64) {
                return false;
            }
            if (!preg_match('/[0-9]/', $password)) {
                return false;
            }
            if (!preg_match('/[A-Z]/', $password)) {
                return false;
            }

            if (!preg_match('/[a-z]/', $password)) {
                return false;
            }

            return true;
        }


    public function valid_name($name) {
        $length = strlen($name);
        if ($length < 2 || $length > 32) {
            return false;
        }
        return true;
    }



}
