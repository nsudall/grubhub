<?php

namespace app\controllers;

//this is an example controller class, feel free to delete
class MainController extends Controller {

    public function homepage() {
        //remember to route relative to index.php
        //require page and exit to return an HTML page
        $this->returnView('./assets/views/main/home.html');
    }

    public function burger() {
        $this->returnView('./assets/views/menus/burger.html');
    }

    public function curry() {
        $this->returnView('./assets/views/menus/curry.html');
    }

    public function pizza() {
        $this->returnView('./assets/views/menus/pizza.html');
    }

    public function taco() {
        $this->returnView('./assets/views/menus/taco.html');
    }

    public function thai() {
        $this->returnView('./assets/views/menus/thai.html');
    }

    public function pasta() {
        $this->returnView('./assets/views/menus/pasta.html');
    }

    public function notFound() {
    }

}