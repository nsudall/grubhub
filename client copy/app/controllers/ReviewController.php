<?php

namespace app\controllers;

use app\models\Review;

class ReviewController
{
    public function validateReview($inputData) {
        $errors = [];
        $firstName = $inputData['firstName'];
        $lastName = $inputData['lastName'];
        $email = $inputData['email'];
        $description = $inputData['description'];

        if ($firstName) {
            $firstName = htmlspecialchars($firstName, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($firstName) < 2) {
                $errors['firstNameShort'] = 'first name is too short';
            }
        } else {
            $errors['requiredFirstName'] = 'first name is required';
        }

        if ($lastName) {
            $lastName = htmlspecialchars($lastName, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($lastName) < 2) {
                $errors['lastNameShort'] = 'last name is too short';
            }
        } else {
            $errors['requiredLastName'] = 'last name is required';
        }
        
        if ($email) {
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            if (!preg_match($regex, $email)) {
                $errors['invalidEmail'] = 'email is invalid.';
            }
        } else {
            $errors['requiredEmail'] = 'email is required';
        }

        if ($description) {
            $description = htmlspecialchars($description, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($description) < 10) {
                $errors['descriptionShort'] = 'Description is too short';
            }
        } else {
            $errors['requiredDescription'] = 'Description is required';
        }

        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }
        return [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'description' => $description,
        ];
    }

    public function getAllReviews() {
        $reviewModel = new Review();
        header("Content-Type: application/json");
        $reviews = $reviewModel->getAllReviews();

        echo json_encode($reviews);
        exit();
    }

    public function getReviewByID($id) {
        $reviewModel = new Review();
        header("Content-Type: application/json");
        $review = $reviewModel->getReviewById($id);
        echo json_encode($review);
        exit();
    }

    public function saveReview() {
        $inputData = [
            'firstName' => $_POST['firstName'] ?: null,
            'lastName' => $_POST['lastName'] ?: null,
            'email' => $_POST['email'] ?: null,
            'description' => $_POST['description'] ?: null,
        ];
        $reviewData = $this->validateReview($inputData);

        $review = new Review();
        $review->saveReview(
            [
                'firstName' => $reviewData['firstName'],
                'lastName' => $reviewData['lastName'],
                'email' => $reviewData['email'],
                'description' => $reviewData['description'],
            ]
        );

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }

    public function updateReview($id) {
        if (!$id) {
            http_response_code(404);
            exit();
        }

        //no built-in super global for PUT
        parse_str(file_get_contents('php://input'), $_PUT);

        $inputData = [
            'firstName' => $_PUT['firstName'] ?: null,
            'lastName' => $_PUT['lastName'] ?: null,
            'email' => $_PUT['email'] ?: null,
            'description' => $_PUT['description'] ?: null,
        ];
        $reviewData = $this->validateReview($inputData);
        //we could save the data off to be saved here

        $review = new Review();
        $review->updateReview(
            [
                'id' => $id,
                'firstName' => $reviewData['firstName'],
                'lastName' => $reviewData['lastName'],
                'email' => $reviewData['email'],
                'description' => $reviewData['description'],
            ]
        );

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }

    public function deleteReview($id) {
        if (!$id) {
            http_response_code(404);
            exit();
        }

        $review = new Review();
        $review->deleteReview(
            [
                'id' => $id,
            ]
        );

        http_response_code(200);
        echo json_encode([
            'success' => true
        ]);
        exit();
    }


}