<?php 
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/hair_dressor.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    $hairDressor = new HairDressor($data['name'], $data['phone'], $data['image'], null);
    $hairDressor->add();
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'msg' => 'hair dressor added'
    ]);
    // header("Location: ../../index.php");