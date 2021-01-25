<?php


namespace app\controllers;


class User extends App
{
    public function loginAction(){
        if(isset($_POST['login'])){
            $login = $_POST['login'];
            $pass = $_POST['password'];
            $this->set(compact('login', 'pass'));
        }
    }
}