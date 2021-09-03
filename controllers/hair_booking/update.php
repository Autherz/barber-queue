<?php 
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/workingtime.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    $serviceType = new WorkingTime(null, null, null, $data['status'], null);
    $serviceType->update($data['id']);
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'msg' => 'hair booking updated'
    ]);
    // header("Location: ../../index.php");