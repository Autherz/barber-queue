<?php 
    date_default_timezone_set("Asia/Bangkok");
    session_start();
    session_id();
    require_once "../../vendor/autoload.php";
    require_once "../../database/connect.php";
    require_once "../../models/booking.php";
    require_once "../../models/booking_detail.php";
    require_once "../../models/jwt.php";

    $data_token = Token::verify();
    $workingtime_hair_dressor_data = $_SESSION['workingtime'];
    $hair_service_data = $_SESSION['hair_service'];
    $customer_id = $data_token->customer_id;
    // $data = json_decode(file_get_contents("php://input"), TRUE);

    $booking = new Booking(
        date("Y-m-d"),
        date("h:i"),
        $hair_service_data['hair_service_price'], 
        $hair_service_data['hair_service_price'], 
        NULL,
        NULL,
        'ยังไม่ชำระ',
        $customer_id,
        '',
        0,
    );

    $booking_id = $booking->add();
    $_SESSION['booking_id'] = $booking_id;

    $booking_detail = new BookingDetail(
        $booking_id,
        $hair_service_data['hair_service_id'],
        $workingtime_hair_dressor_data['hair_dressor_id'],
        $workingtime_hair_dressor_data['worktime_date'],
        $workingtime_hair_dressor_data['start_time'],
        $workingtime_hair_dressor_data['end_time'],
        $hair_service_data['hair_service_price']
    );
    $booking_detail->add();

    header("Location: ../../page/customer/payment_method.php?booking_id=" . $booking_id);
    // http_response_code(200);
    // echo json_encode([
    //     'status' => 'success',
    //     'msg' => 'booking added'
    // ]);
    // header("Location: ../../index.php");