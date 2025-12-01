<?php

namespace app\controllers;

use app\models\Search;

class SearchController
{

    public function getAllSearchsByNameOrType() {
        $searchModel = new Search();
        $query = !empty($_GET['search']) ? $_GET['search'] : null;
        $searchs = $searchModel->getAllSearchsByNameOrType($query);
        echo json_encode($searchs);
        exit();
    }

    public function getSearchByID($id) {
        $searchModel = new Search();
        header("Content-Type: application/json");
        $search = $searchModel->getSearchById($id);
        echo json_encode($search);
        exit();
    }


}