<?php 
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/workingtime.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    $result = WorkingTime::get()->fetchAll();
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'msg' => 'working time added',
        'data' => $result
    ]);
    // header("Location: ../../index.php");