<?php 
    session_start();
    session_id();
    require_once '../../vendor/autoload.php';
    require_once "../../database/connect.php";
    require_once "../../models/service_type.php";
    require_once "../../models/workingtime.php";
    require_once "../../models/hair_service.php";

    $hair_service = HairService::getById($_GET['hair_service_id']);
    $workingtime_hair_dressor = WorkingTime::getInner($_GET['workingtime']);

    $workingtime_hair_dressor_data = $workingtime_hair_dressor->fetch();
    $hair_service_data = $hair_service->fetch();

    $_SESSION['workingtime'] = $workingtime_hair_dressor_data;
    $_SESSION['hair_service'] = $hair_service_data;
    // #### Verify
    require_once "../../models/jwt.php";
    $data_token = Token::verify();
    if (isset($data_token)) {
        // if ($data_token->admin) {
        // } else {
        //     header('Location:../../index.php');
        // }
    } else {
        header("Location:../../index.php");
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../../css/style.css">
    <title>แก้ไขการใช้บริการ</title>
    <style>
    </style>
    
</head>
<body>
    <div class="d-flex flex-column min-vh-100 position-relative">
        <?php require_once "header.php" ?>
        <div class="d-flex flex-column mx-auto  mt-4 register__content-container">
            <div class="d-flex flex-wrap  p-2">

                <div class="col-9 m-auto fw-bold">
                    <div class="d-flex flex-column">
                        <div class="mx-auto py-5" style="font-size: 25px;">
                            แสดงรายละเอียดบริการที่คุณเลือก
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center m-5 p-5">
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="d-flex flex-column service__content-container p-3">
                    <div class="p-4" style="border: 1px solid #aaa;">
                        <div class="">
                            <?php echo $data_token->username ?>
                        </div>
                        <div class="fw-bold">
                            การใช้บริการที่คุณเลือก
                        </div>
                        <div>
                            - <?php echo $hair_service_data['hair_service_name']; ?>
                        </div>
                        <div class="service-detail-date">
                            -วันที่ <?php echo $workingtime_hair_dressor_data['worktime_date']; ?>
                        </div>
                        <div>
                            -เวลา<?php echo $workingtime_hair_dressor_data['start_time']; ?> นาฬิกา
                        </div>
                        <div>
                            -<?php echo $workingtime_hair_dressor_data['hair_dressor_name']; ?>
                        </div>
                        <div class="mt-3">
                            -ราคา <?php echo $hair_service_data['hair_service_price']; ?> บาท
                        </div>
                    </div>
                    <div class="mx-auto mb-2 mt-4">
                        <button onclick=<?php echo 'location.href="../../controllers/booking/add.php' . '"'; ?> id="bookingButton"  class="m-auto service__button">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex ms-5 me-auto mt-auto me-2 mb-5">
                <button onclick="window.history.back()" id="backButton" type="button" class="m-auto service__button">
                    กลับ
                </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addService" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มบริการ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="modal-container">
                <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        ชื่่อบริการ
                    </div>
                    <div class="ms-auto">
                        <input type="text" placeholder="ชื่่อบริการ" id="addServiceName">
                    </div>
                </div>
                <!-- <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        ราคา
                    </div>
                    <div class="ms-auto">
                        <input type="number" placeholder="ราคา" id="addServicePrice">
                    </div>
                </div> -->
                <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        อัปโหลดรูป
                    </div>
                    <div class="ms-auto">
                        <button id="file-upload" type="button" class="ml-auto my-auto py-2 px-4" style="color:#fff;background-color: #FC9C2C; border-radius: 20px;box-shadow: 0px 5px 20px 0px rgba(252, 156, 44, 0.33);border:none;">
                            <input class="visuallyhidden" type="file" id="files" accept="image/*" />
                            <span>อัปโหลด</span>
                        </button>
                    </div>
                </div>
                <div class="d-flex">
                    <img class="mx-auto mt-5 mb-2 img-thumbnail" id="preview">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="addServiceButton" type="button" class="btn btn-primary">เพิ่ม</button>
        </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
        const params = new URLSearchParams(window.location.search)
    </script>
</body>