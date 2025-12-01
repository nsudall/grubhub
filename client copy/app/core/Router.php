<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\UserController;
use app\controllers\ReviewController;
use app\controllers\SearchController;
use app\controllers\OrderController;

class Router {
    public $uriArray;

    function __construct() {
        $this->uriArray = $this->routeSplit();
        $this->handleMainRoutes();
        $this->handleUserRoutes();
        $this->handleReviewRoutes();
        $this->handleSearchRoutes();
        $this->handleOrderRoutes();
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    protected function handleMainRoutes() {
        if ($this->uriArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
        }
        if ($this->uriArray[1] === 'burger' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->burger();
        }
        if ($this->uriArray[1] === 'curry' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->curry();
        }
        if ($this->uriArray[1] === 'pizza' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->pizza();
        }
        if ($this->uriArray[1] === 'taco' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->taco();
        }
        if ($this->uriArray[1] === 'thai' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->thai();
        }
        if ($this->uriArray[1] === 'pasta' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->pasta();
        }
    }

    protected function handleReviewRoutes() {
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'reviews' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            //only id
            $id = isset($this->uriArray[3]) ? intval($this->uriArray[3]) : null;
            $reviewController = new ReviewController();
        
            if ($id) {
                $reviewController->getReviewByID($id);
            } else {
                $reviewController->getAllReviews();
            }
        }
        
        //save user
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'reviews' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewController = new ReviewController();
            $reviewController->saveReview();
        }
        
        //update user
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'reviews' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
            $reviewController = new ReviewController();
            $id = isset($this->uriArray[3]) ? intval($this->uriArray[3]) : null;
            $reviewController->updateReview($id);
        }
        
        //delete user
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'reviews' && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $reviewController = new ReviewController();
            $id = isset($this->uriArray[3]) ? intval($this->uriArray[3]) : null;
            $reviewController->deleteReview($id);
        }
        
    }

    protected function handleSearchRoutes() {
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'searchs' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            //only id
            $id = isset($this->uriArray[3]) ? intval($this->uriArray[3]) : null;
            $searchController = new SearchController();
        
            if ($id) {
                $searchController->getSearchByID($id);
            } else {
                $searchController->getAllSearchsByNameOrType();
            }
        }
    }

    protected function handleOrderRoutes() {
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'orders' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderController = new OrderController();
            $orderController->createOrder();
        }
    }

    protected function handleUserRoutes() {
        if ($this->uriArray[1] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController = new UserController();
            $userController->usersView();
        }

        //give json/API requests a api prefix
        if ($this->uriArray[1] === 'api' && $this->uriArray[2] === 'users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $userController = new UserController();
            $userController->getUsers();
        }
    }
}