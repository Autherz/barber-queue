<?php 
    session_start();
    session_id();
    require_once 'vendor/autoload.php';
    require_once "database/connect.php";
    // require_once "controllers/login/verify.php";
    // #### Verify
    require_once "models/jwt.php";
    $data_token = Token::verify();
    if (isset($data_token)) {
        if ($data_token->admin) {
            header('Location:page/admin/main.php');
        } else {
            header('Location:page/customer/main.php');
        }
    } else {
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <title>เข้าสู่ระบบ</title>
    <style>
    </style>
</head>
<body>
<div class="d-flex flex-column min-vh-100">
        <?php require_once "header.php" ?>
        <div class="d-flex flex-column mx-auto  mt-4 register__content-container">
            <!-- <div class="d-flex flex-wrap  p-2">
                <div class="col-9 m-auto fw-bold">
                    <div class="d-flex flex-column">
                        <div class="mx-auto py-5" style="font-size: 25px;">
                            สวัสดีผู้ใช้งานใหม่
                        </div>
                        <div class="mx-auto">
                            ยินดีต้อนรับสู่ ร้านLike69'
                        </div>
                        <div class="mx-auto">
                            เริ่มต้นด้วยการสร้างบัญชีของคุณ
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="d-flex flex-column mt-2 " >
                <div class="d-flex flex-column mx-auto px-4 fw-bold">
                    <div class="mx-auto my-4 px-4 py-2 header-content" style="font-size: 20px;">
                        เข้าสู่ระบบ
                    </div>
                    <form id="form" action="#" method="POST">
                        <div class="d-flex my-4">
                            <label  class="pe-4 my-auto">ชื่อ - นามสกุล</label>
                            <div style="margin-left: auto;">
                                <input class="form-control" type="text" id="username" name="username">
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            <label  class="pe-4 my-auto">รหัสผ่าน</label>
                            <div style="margin-left: auto;">
                                <input class="form-control" type="password" id="password" name="password">
                            </div>
                        </div>
                    </form>

                    <div class="mx-auto">
                        <div class="d-flex px-5 my-2 text-danger" id="LoginError"></div>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <button id="login" class="mx-auto px-2 py-1" type="button">
                        ลงชื่อใช้งาน
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#login').click(function(event) {
            event.preventDefault();

            // validation username
            // validation email
            // validation password
            axios.post("controllers/login/authentication.php", {
                username: $("#username").val(),
                password: $("#password").val(),
            }).then(function(response) {
                if (response.data.isAdmin == '1') {
                    console.log('admin')
                    location.href = 'page/admin/main.php'
                } else {
                    console.log('customer')
                    location.href = 'page/customer/main.php'
                }
            }).catch((err) => {
                $('#LoginError').text(err.response.data.msg);
                console.log(err.response.data)
                console.log(err.response.status)
            })
            // $('#form').submit();
        })
    </script>
</body>