<?php

namespace app\models;

use app\models\Model;

class Order extends Model {
    public function createOrder($inputData)
    {
        $query = "INSERT INTO orders (rest_id, total, fees, profit, status) VALUES (:rest_id, :total, :fees, :profit, :status);";
        return $this->query($query, $inputData);
    }
}
