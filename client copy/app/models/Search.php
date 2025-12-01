<?php

namespace app\models;

//using the database class namespace
use app\models\Model;

class Search extends Model {

    public function getAllSearchsByNameOrType($search) {
        if ($search) {
            $query = "select * from restaurants WHERE name like :name or description like :description";
            return $this->query($query, [
                'name' => '%' . $search . '%',
                'description' => '%' . $search . '%',
            ]);
        }
        //$query = "select * from experiences";
        return $this->fetchAll($query);
    }
    
    public function getSearchById($id){
        $query = "select * from experiences where id = :id UNION select * from classes where id = :id";
        return $this->query($query, ['id' => $id]);
    }

}