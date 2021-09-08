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
    <title>สมัครสมาชิก</title>
    <style>
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <?php require_once "header.php" ?>
        <div class="d-flex flex-column mx-auto  mt-4 register__content-container">
            <div class="d-flex flex-wrap  p-2">
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
            </div>
            <div class="d-flex flex-column mt-2 " >
                <div class="d-flex flex-column mx-auto px-4 fw-bold">
                    <div class="mx-auto my-4 px-4 py-2 header-content" style="font-size: 20px;">
                        สมัครสมาชิก
                    </div>
                    <form id="form">
                        <div class="d-flex my-4">
                            <label  class="pe-4">ชื่อ - นามสกุล</label>
                            <div style="margin-left: auto;">
                                <input class="form-control" type="text" id="name" name="name">
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            <label  class="pe-4">ชื่อใช้งาน</label>
                            <div style="margin-left: auto;">
                                <input class="form-control" type="text" id="username" name="username">
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            <label class="pe-4">E-mail</label>
                            <div style="margin-left: auto;">
                                <input class="form-control" type="text" id="email" name="email">
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            <label class="pe-3">เบอร์โทรศัพท์</label>
                            <div class="ms-auto">
                                <input class="form-control" type="tel" id="phone" name="phone">
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            <label class="pe-3">ที่อยู่ปัจจุบัน</label>
                            <div class="ms-auto">
                                <div class="form-floating">
                                    <textarea id="address" name="address" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">ที่อยู่</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            <label class="pe-3">รหัสผ่าน</label>
                            <div class="ms-auto">
                                <input class="form-control" type="password" id="password" name="password">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mx-auto">
                    <div class="d-flex px-5 my-2 text-danger" id="LoginError"></div>
                </div>
                <div class="d-flex my-3">
                    <button id="register" class="mx-auto px-5 py-2" type="button">
                        ยืนยัน
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#register').click(function(event) {
            event.preventDefault();

            axios.post("controllers/customer/add.php", {
                name: $("#name").val(),
                username: $("#username").val(),
                email: $("#email").val(),
                phone: $("#phone").val(),
                address: $("#address").val(),
                password: $("#password").val(),
            }).then(function(response) {
                location.href = "index.php"
            }).catch((err) => {
                $('#LoginError').text(err.response.data.msg);
                console.log(err.response.data)
                console.log(err.response.status)
            })

            // $('#form').submit();
        })
    </script>
</body>