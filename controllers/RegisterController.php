<?php

namespace controllers;

use models\User;
use myFunction\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        $this->view->render('auth/register');
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    public function login()
    {
        $this->view->render("auth/login");
    }


    public function pregistration()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $login = $_POST['login'];
            $password = $_POST['password'];

            $errors = [];
            if (empty($name) || !$this->valid_name($name)) {
                $errors[] = "Ism eng kamida 2 ta harfdan tashkil togan bolishi kerak";
            }
            if (empty($login) || !$this->valid_login($login)) {
                $errors[] = "login kamida 5 ta belgi va faqat harf va sonlardan tashkil topgan bolishi kerak";
            }

            if (empty($password) || !$this->valid_password($password)) {
                $errors[] = "Parol eng kamida 8 ta belgi va kamida 1 ta kichkina harf va 1 ta katta harf dan tashkil topgan bolishi kerak";
            }

            $userModel = new User();
            $existingUser = $userModel->getUserByLogin($login);
            if ($existingUser) {
                $errors[] = "Afsuski bu login band";
            }

            if (!empty($errors)) {
                $this->view->render('auth/register', ['errors' => $errors]);
                return;
            }else{
                $registered = $userModel->registerUser($name, $login, $password);
            }


            if ($registered) {
                $this->redirect('/register/login');
            } else {
                $this->view->render('auth/register', ['error' => 'Registration failed. Please try again.']);
            }
        } else {
            $this->view->render('auth/register');
        }
    }


    public function plogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $login = $_POST['login'];
            $password = $_POST['password'];

            $errors = [];

            if (empty($login)) {
                $errors[] = "Enter your login";
            }
            if (empty($password)) {
                $errors[] = "Enter your password";
            }
            if (!empty($errors)) {
                $this->view->render('auth/login', ['errors' => $errors]);
            }

            $userModel = new User();
            $user = $userModel->getUserByLogin($login);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $this->redirect('/product/list');

            } else {

                $this->view->render('auth/login', ['errors' => 'Invalid email or password. Please try again.']);
            }
        }


    }

}