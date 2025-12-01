<?php

namespace app\models;

//using the database class namespace
use app\models\Model;

class Review extends Model {

    public function getAllReviewsByNameOrEmail($name, $email) {
        $query = "select * from reviews WHERE CONCAT(firstName,' ',lastName) like :name or email like :email";
        return $this->query($query, [
            'name' => '%' . $name . '%',
            'email' => '%' . $email . '%',
        ]);
    }

    public function getAllReviews() {
        $query = "select * from reviews";
        return $this->query($query);
    }

    public function getReviewById($id){
        $query = "select * from reviews where id = :id";
        return $this->query($query, ['id' => $id]);
    }

    public function saveReview($inputData){
        $query = "insert into reviews (firstName, lastName, email, description) values (:firstName, :lastName, :email, :description);";
        return $this->query($query, $inputData);
    }

    public function updateReview($inputData){
        $query = "update reviews set firstName = :firstName, lastName = :lastName, email = :email, description = :description where id = :id";
        return $this->query($query, $inputData);
    }

    public function deleteReview($inputData){
        $query = "DELETE FROM reviews where id = :id";
        return $this->query($query, $inputData);
    }
}