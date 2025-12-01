<?php

namespace app\controllers;

use app\models\Order;

class OrderController extends Controller
{
    protected function validateOrder($payload)
    {
        $restId = isset($payload['restId']) ? intval($payload['restId']) : null;
        $total = isset($payload['total']) ? floatval($payload['total']) : null;
        $fees = isset($payload['fees']) ? floatval($payload['fees']) : null;
        $profit = isset($payload['profit']) ? floatval($payload['profit']) : $fees;

        $errors = [];
        if (!$restId) {
            $errors['restId'] = 'Restaurant id is required.';
        }
        if ($total === null || $total < 0) {
            $errors['total'] = 'Total must be provided and not negative.';
        }
        if ($fees === null || $fees < 0) {
            $errors['fees'] = 'Fees must be provided and not negative.';
        }

        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Unable to process order.',
                'errors' => $errors,
            ]);
            exit();
        }

        return [
            'rest_id' => $restId,
            'total' => $total,
            'fees' => $fees,
            'profit' => $profit ?? 0,
            'status' => 'pending'
        ];
    }

    public function createOrder()
    {
        $payload = json_decode(file_get_contents('php://input'), true);
        if (!is_array($payload)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Invalid request payload.'
            ]);
            exit();
        }

        $orderData = $this->validateOrder($payload);
        $order = new Order();
        $created = $order->createOrder($orderData);

        if ($created === false) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Could not save order.'
            ]);
            exit();
        }

        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Order saved.'
        ]);
        exit();
    }
}
