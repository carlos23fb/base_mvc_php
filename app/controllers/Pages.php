<?php

class Pages extends  Controller {
    public function  __construct(){
        $this->userModel = $this->model('User');

    }

    public function index(){

        $data = [
            'title' => 'Home page',
            'name' => 'Carlos'
        ];

        $this->view('pages/index', $data);
    }

    public  function about(){
        echo 'about';
    }
}