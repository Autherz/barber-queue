<?php 
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/hair_service.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    $serviceType = new HairService($data['name'], $data['price'], $data['file'], null);
    $serviceType->update($data['id']);
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'msg' => 'service type updated'
    ]);
    // header("Location: ../../index.php");