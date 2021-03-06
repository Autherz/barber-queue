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

    if (isset($_GET['hair_service_id'] )) {
        $_SESSION['hair_service_id'] = $_GET['hair_service_id'] ;
    }

    if (isset($_GET['worktime'] )) {
        $_SESSION['worktime'] = $_GET['worktime'] ;
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
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="d-flex flex-column service__content-container p-3">
                    <div class="mx-auto my-3">
                        <!-- <img class="w-100 h-100" src="" alt=""> -->
                        <span><i class="fas fa-cut fa-7x"></i></span>
                    </div>
                    <div class="mx-auto">
                        เลือกบริการ
                    </div>
                    <div class="mx-auto my-2">
                    <!-- onclick='location.href="hair_service_type.php"' -->
                        <button id="" class="m-auto service__button" data-service="hair_service_type" style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#acceptButton">ยืนยัน</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="d-flex flex-column service__content-container p-3">
                    <div class="mx-auto my-3">
                        <!-- <img class="w-100 h-100" src="" alt=""> -->
                        <span><i class="fas fa-users fa-7x"></i></span>
                    </div>
                    <div class="mx-auto">
                        เลือกช่าง
                    </div>
                    <div class="mx-auto my-2">
                    <!-- onclick='location.href="hair_dressor.php"' -->
                        <button id="" class="m-auto service__button" data-service="hair_dressor" style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#acceptButton">ยืนยัน</button>
                    </div>
                </div>
            </div>
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
            var service = $(this).data('service');
            if (service == "hair_service_type") {
                console.log(service)
                document.getElementById("addServiceButton").addEventListener('click', function(event) {
                    window.location.href='hair_service_type.php';
                });
            }

            if (service == "hair_dressor") {
                console.log(service)
                document.getElementById("addServiceButton").addEventListener('click', function(event) {
                    window.location.href='hair_dressor.php';
                });
            }
        })

        document.getElementById('file-upload').addEventListener('click', event => {
            console.log('click')
            $('#files').trigger('click');
        })

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
        $('.img-thumbnail[src=""]').hide();
        $('.img-thumbnail:not([src=""])').show();
    </script>
</body>