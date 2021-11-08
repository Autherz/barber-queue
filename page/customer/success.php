<?php 
    session_start();
    session_id();
    
    require_once '../../vendor/autoload.php';
    require_once "../../database/connect.php";

    require_once "../../models/workingtime.php";

    $serviceType = new WorkingTime(null, null, null, 'ไม่ว่าง', null);
    $serviceType->update($_SESSION['worktime']);

    unset($_SESSION['hair_service_id']);
    unset($_SESSION['worktime']);
    unset($_SESSION['hair_service']);
    unset($_SESSION['workingtime']);
    header("Location:main.php");