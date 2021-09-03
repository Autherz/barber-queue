<?php 
    // session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/hair_service.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    $result = HairService::getOne($_GET['id'])->fetchAll();
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'msg' => 'get hair service',
        'data' => $result
    ]);
    // header("Location: ../../index.php");