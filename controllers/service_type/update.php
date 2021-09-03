<?php 
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/service_type.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    $serviceType = new ServiceType($data['name'], $data['file']);
    $serviceType->update($data['id']);
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'msg' => 'service type updated'
    ]);
    // header("Location: ../../index.php");