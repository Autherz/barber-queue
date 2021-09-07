<?php 
    session_start();
    session_id();
    require_once "database/connect.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <title>ติดต่อเรา</title>
    <style>
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <?php require_once "header.php" ?>
        <div class="d-flex">
            <div class="d-flex flex-column mx-auto service__content-container p-3" style="width: 500px;">
                <div class="mx-auto">
                    ถ้าคุณต้องการเสริมบุคลิกให้ดูดี ไว้ใจเรา ให้เราเป็นคนดูแล :)
                </div>
                <div class="mx-auto mt-2">
                    เปิด 12.00-22.00
                </div>
                <div class="mx-auto mt-3">
                    จะจองคิวไว้ หรือ walk in เข้ามาได้เลยครับ
                </div>
                <div class="d-flex mx-auto mt-3">
                    <span><i class="fas fa-phone-alt px-1" style="color: red;"></i></span>
                    <div>
                    090-2737892 ช่างเต้
                    </div>
                </div>
                <div class="d-flex mx-auto">
                    <span><i class="fas fa-phone-alt px-1" style="color: red;"></i></span>
                    <div>
                    082-5350072 ช่างเจ
                    </div>
                </div>
                <div class="d-flex mx-auto">
                    <span><i class="fas fa-phone-alt px-1" style="color: red;"></i></span>
                    <div>
                    086-4615217 ช่างบูม
                    </div>
                </div>
                <div class="d-flex mx-auto mt-3">
                    <i class="fas fa-thumbtack px-1" style="color: red;"></i>
                    <div>
                    มีที่จอดรถหน้าร้านครับ
                    </div>
                </div>
                <div class="d-flex mx-auto mt-3">
                    <i class="fas fa-map-pin px-1" style="color: red;"></i>
                    <div>
                    พิกัดร้าน อยู่ติดกับ ดาราวันคอนโด
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=%E0%B8%A1%E0%B8%AB%E0%B8%B2%E0%B8%A7%E0%B8%B4%E0%B8%97%E0%B8%A2%E0%B8%B2%E0%B8%A5%E0%B8%B1%E0%B8%A2%E0%B8%82%E0%B8%AD%E0%B8%99%E0%B9%81%E0%B8%81%E0%B9%88%E0%B8%99+(%E0%B8%82%E0%B8%AD%E0%B8%99%E0%B9%81%E0%B8%81%E0%B9%88%E0%B8%99)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.maps.ie/draw-radius-circle-map/">Measure km radius</a></div>
        </div>
    </div>
</body>
