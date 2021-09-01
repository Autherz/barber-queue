<?php 
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/workingtime.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    $workingtime = new WorkingTime($data['date'], $data['start_time'], $data['end_time'], $data['status'], $data['hair_dressor_id']);
    $workingtime->add();
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'msg' => 'working time added'
    ]);
    // header("Location: ../../index.php");