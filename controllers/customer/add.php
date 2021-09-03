<?php
    header('Content-Type: application/json');
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/customer.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    if(empty($data['username'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'ไม่มี username'
        ]);
        return;
    }

    if(empty($data['email'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'ไม่มี email'
        ]);
        return;
    }

    if(empty($data['password'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'ไม่มี password'
        ]);
        return;
    }

    if (Customer::usernameExist($data['username'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'username ซ้ำ'
        ]);
        return;
    } else if (Customer::emailExist($data['email'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'email ซ้ำ'
        ]);
        return;
    } else {
        $customer = new Customer($data['name'], $data['username'], $data['email'], $data['phone'], $data['address'], $data['password']);
        $customer->add();
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'msg' => 'customers added!'
        ]);
        // header("Location: ../../index.php");
    }