<?php 
    session_start();
    session_id();
    require_once "../../vendor/autoload.php";
    require_once "../../database/connect.php";
    require_once "../../models/booking.php";
    require_once "../../models/jwt.php";

    $data = json_decode(file_get_contents("php://input"), TRUE);

    Booking::updateSlip($data['file'], $data['booking_id']);

    echo json_encode([
        'status' => 'success',
        'msg' => 'booking updated'
    ]);