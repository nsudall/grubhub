<?php

namespace app\models;

abstract class Model {

    public function findAll() {
        $query = "select * from $this->table";
        return $this->query($query);
    }

    private function connect() {
        $string = "mysql:host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME;
        $con = new \PDO($string, DBUSER, DBPASS);
        return $con;
    }

    public function query($query, $data = []) {
        $con = $this->connect();
        $stm = $con->prepare($query);
        $check = $stm->execute($data);
        if (!$check) {
            return false;
        }

        // For SELECT queries, return rows; otherwise return affected rows
        if ($stm->columnCount() > 0) {
            return $stm->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $stm->rowCount();
    }

}