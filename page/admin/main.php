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
        if ($data_token->admin) {
        } else {
            header('Location:../../index.php');
        }
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
            <div class="d-flex flex-wrap bg-white p-2">
                <div class="mx-auto col-3 register__content-logo">
                    <img class="h-100 w-100" src="../../assets/images/69like.jpg" alt="">
                </div>
                <div class="col-9 m-auto fw-bold">
                    <div class="d-flex flex-column">
                        <div class="mx-auto">
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
                <div class="d-flex flex-column service__content-container bg-white p-3">
                    <div class="d-flex">
                        <button class="m-auto service__button" style="background-color: transparent;">แก้ไข</button>
                        <button class="m-auto service__button" style="background-color: transparent;">ลบ</button>
                    </div>
                    <div class="mx-auto my-3" style="width: 100px; height: 100px;">
                        <img class="w-100 h-100" src=<?php echo '../../' . $v['service_file']; ?> alt="">
                    </div>
                    <div class="mx-auto">
                        <?php echo $v['service_type_name']; ?>
                    </div>
                    <div class="mx-auto my-2">
                        <button onclick=<?php echo 'location.href="hair_service.php?service_type=' . $v['service_type_id'] . '&service_type_name=' . $v['service_type_name'] . '"'; ?> class="m-auto service__button" style="background-color: transparent;">ยืนยัน</button>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <div class="d-flex ms-auto mt-auto me-2 mb-2">
            <div class="d-flex service__content-add bg-white">
                <button class="m-auto service__button" style="background-color: transparent;width: 100px;" data-bs-toggle="modal" data-bs-target="#addService">เพิ่มบริการ</button>
                <button class="m-auto service__button" style="background-color: transparent;">ยืนยัน</button>
            </div>
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
        $('#addServiceButton').click(async function(event) {
            event.preventDefault();

            var fd = new FormData();
            var files = $("#files")[0].files;
            var file_name;
            // Check file selected or not 
            if (files.length > 0) {
                fd.append('file', files[0]);
                await axios.post("../../upload.php", fd, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function (response) {
                    if(response.data != 0) {
                        console.log('uploaded')
                        file_name = response.data ;
                    } else {
                        alert('file not uploaded')
                    }
                }).catch((err) => {
                    console.log("error upload : ", err)
                })
            } else {
                alert("Please select a file.")
            }
            
            axios.post("../../controllers/service_type/add.php", {
                name: $("#addServiceName").val(),
                // price: $("#addServicePrice").val(),
                // type: $("#addSelectType").find(':selected').data('id'),
                file: file_name
            }).then(function(response) {
                location.reload();
            }).catch((err) => {
                console.log(err.response.data)
                console.log(err.response.status)
            })
            // // $('#form').submit();
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