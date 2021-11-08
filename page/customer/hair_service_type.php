<?php 
    session_start();
    session_id();
    require_once '../../vendor/autoload.php';
    require_once "../../database/connect.php";
    require_once "../../models/service_type.php";
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
            <div class="d-flex flex-wrap p-2">
                <div class="d-flex mx-auto fw-bold">
                    <div class="d-flex ms-5 py-5 flex-column my-auto ms-3">
                        <div class="mx-auto" style="font-size: 25px;">
                            เลือกบริการตามใจคุณ
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center m-5 p-5">
            <?php
                $hairServices = ServiceType::get();
                foreach($hairServices->fetchAll() as $k=>$v) {
            ?>
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="d-flex flex-column service__content-container p-3">
                    <div class="mx-auto my-3" style="width: 100px; height: 100px;">
                        <img class="w-100 h-100" src=<?php echo '../../' . $v['service_file']; ?> alt="">
                    </div>
                    <div class="mx-auto">
                        <?php echo $v['service_type_name']; ?>
                    </div>
                    <div class="mx-auto my-2">
                        <button data-id=<?php echo $v['service_type_id']; ?> data-name=<?php echo $v['service_type_name']; ?> class="m-auto service__button" style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#acceptButton">ยืนยัน</button>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <div class="d-flex ms-5 me-auto mt-auto me-2 mb-5">
                <button onclick="window.history.back()" id="backButton" type="button" class="m-auto service__button">
                    กลับ
                </button>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="acceptButton" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header"> -->
                    <!-- <h5 class="modal-title" id="exampleModalLabel">การยืนยัน</h5> -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                <!-- </div> -->
                <div class="modal-body" style="background-color: #1A1A1A;">
                    <div class="modal-container">
                        <div class="d-flex text-white text-center" style="font-size: 24px;">
                            <div class="mx-auto my-5">
                                คุณต้องการยืนยันการทำรายการหรือไม่?
                            </div>
                        </div>
                        <div class="d-flex mx-auto">
                            <div type="button" data-bs-dismiss="modal" class="ms-auto my-auto me-2 text-white">ยกเลิก</div>
                            <button id="addServiceButton" type="button" class="btn btn-primary me-auto ms-2">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>

        $('.service__button').click(async function(event) {
            var id = $(this).data('id');
            var name = $(this).data('name');
            if (id !== undefined) {
                document.getElementById("addServiceButton").addEventListener('click', function(event) {
                    window.location.href = 'hair_service.php?service_type_name=' + name + '&service_type=' + id;
                });
            }
        })
    </script>
</body>