<?php 
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/hair_service.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    $hairService = new HairService($data['name'], $data['price'], $data['file'], $data['type']);
    $hairService->add();
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'msg' => 'service added'
    ]);
    // header("Location: ../../index.php");