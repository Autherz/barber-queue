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
                            ต้องการติดต่อเรา Like69 ?
                        </div>
                        <div class="mx-auto">
                            วิธีติดต่อกับเรามีดังต่อไปนี้
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column mt-2 " >
                <div class="d-flex flex-column mx-auto px-4 fw-bold">
                    <div class="mx-auto my-4 px-4 py-2 header-content" style="font-size: 20px;">
                        แบบฟอร์มติดต่อ
                    </div>
                    <form id="form" action="controllers/customer/add.php" method="POST" style="width: 400px;">
                        <div class="d-flex my-4 w-100">
                                <input class="w-100 form-control" type="text" id="name" name="name" placeholder="ชื่อ-นามสกุล">
                        </div>

                        <div class="d-flex my-4 w-100">
                                <input class="w-100 form-control"  type="text" id="email" name="email" placeholder="E-mail">
                        </div>

                        <div class="d-flex my-4 w-100">
                            
                                <input class="w-100 form-control" type="text" id="phone" name="phone" placeholder="เบอร์โทรศัพท์">
                            
                        </div>

                        <div class="d-flex my-4 w-100">
                            
                                <input class="w-100 form-control" type="text" id="title" name="title" placeholder="หัวข้อเรื่อง">
                            
                        </div>

                        <div class="d-flex my-4 w-100">
                                <div class="form-floating w-100">
                                    <textarea id="content" name="content" class="form-control w-100" placeholder="ข้อความ" id="floatingTextarea2" style="height: 300px"></textarea>
                                    <label for="floatingTextarea2">ข้อความ</label>
                                </div>
                        
                        </div>
                    </form>
                </div>
                <div class="d-flex my-3">
                    <button id="register" class="mx-auto px-5 py-2" type="button">
                        ยืนยัน
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('#register').click(function(event) {
            event.preventDefault();

            // validation username
            // validation email
            // validation password

            // $('#form').submit();
        })
    </script>
</body>