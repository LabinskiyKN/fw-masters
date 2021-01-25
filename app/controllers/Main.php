<?php


namespace app\controllers;


class Main extends App
{

    public function indexAction() {
//        $this->layout = false;
        $name = 'Bobby';
        $title = 'Main - index';
//        echo $name;
        $this->set(compact('name', 'title'));
    }

}