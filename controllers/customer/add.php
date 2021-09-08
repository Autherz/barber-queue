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
            'msg' => 'โปรดกรอกชื่อผู้ใช้'
        ]);
        return;
    }

    if(empty($data['email'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'โปรดกรอกอีเมล'
        ]);
        return;
    }

    if(empty($data['password'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'โปรดกรอกรหัสผ่าน'
        ]);
        return;
    }
    
    if(strlen($data['username']) < 8) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'ชื่อผู้ใช้ควรยาวเกินกว่า 8 ตัวอักษร'
        ]);
        return;
    }

    if(strlen($data['username']) < 8) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'ชื่อผู้ใช้ควรยาวเกินกว่า 8 ตัวอักษร'
        ]);
        return;
    }

    $regexUsername = '/^[a-zA-Z0-9]*$/m';
    if(!preg_match($regexUsername, $data['username'])){
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'โปรดกรอกชื่อผู้ใช้ให้ถูกต้อง อนุญาตให้มีตัวอักษร a-z, A-Z, 0-9 เท่านั้น'
        ]);
        return;
    }

    // $re = '/^(([^<>()\[\]\\\\.,;:\s@"]+(\.[^<>()\[\]\\\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
    $re = '/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/m';

    if(!preg_match($re, $data['email'])){
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'โปรดกรอกอีเมลให้ถูกต้อง เช่น example@example.com'
        ]);
        return;
    }

    if(strlen($data['password']) < 8) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'รหัสผ่านควรยาวเกินกว่า 8 ตัวอักษร'
        ]);
        return;
    }

    $regexNumberOnly = '/^[0-9]*$/m';

    if (!preg_match($regexNumberOnly, str_replace("-", "", $data["phone"]))) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'โปรดกรอกโทรศัพท์ให้ถูกต้อง'
        ]);
        return;
    }

    if(strlen(str_replace("-", "", $data["phone"])) != 10 ) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'โปรดกรอกโทรศัพท์ให้ถูกต้อง'
        ]);
        return;
    }

    if (Customer::usernameExist($data['username'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'ชื่อผู้ใช้ซ้ำ'
        ]);
        return;
    } else if (Customer::emailExist($data['email'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'อีเมลซ้ำ'
        ]);
        return;
    } else if (Customer::phoneExist($data['phone'])) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'msg' => 'เบอร์โทรศัพท์ซ้ำ'
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