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
            <div class="d-flex flex-wrap  p-2">

                <div class="col-9 m-auto fw-bold">
                    <div class="d-flex flex-column">
                        <div class="mx-auto py-5" style="font-size: 25px;">
                            เลือกบริการตามใจคุณ
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex my-5">
            <button class="ms-auto me-5 service__button-add" data-bs-toggle="modal" data-bs-target="#addService">เพิ่มบริการ</button>
        </div>
        <div class="row justify-content-md-center m-5 p-5" id="service_list">
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
                            <button id="modalAccept" type="button" class="btn btn-primary me-auto ms-2">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addService" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal__container">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มบริการ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="modal-container">
                <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        ชื่อบริการ
                    </div>
                    <div class="ms-auto">
                        <input class="form-control" type="text" placeholder="ชื่อบริการ" id="addServiceName">
                    </div>
                </div>
                <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        อัปโหลดรูป
                    </div>
                    <div class="ms-auto">
                        <button id="file-upload" type="button" class="ml-auto my-auto py-2 px-4 modal__upload-button" >
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
            <button type="button" class="close-button" data-bs-dismiss="modal">ปิด</button>
            <button id="addServiceButton" type="button" class="px-3">เพิ่ม</button>
        </div>
        </div>
    </div>
    </div>

    
    <!-- EditModal -->
    <div class="modal fade" id="editService" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal__container">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขบริการ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-container">
                    <input type="hidden" placeholder="id" id="editServiceId">
                    <div class="d-flex px-5 my-2">
                        <div class="my-auto">
                            ชื่่อบริการ
                        </div>
                        <div class="ms-auto">
                            <input class="form-control" type="text" placeholder="ชื่่อบริการ" id="editServiceName">
                        </div>
                    </div>
                    <div class="d-flex px-5 my-2">
                        <div class="my-auto">
                            อัปโหลดรูป
                        </div>
                        <div class="ms-auto">
                            <button id="file-upload2" type="button" class="ml-auto my-auto py-2 px-4 modal__upload-button">
                                <input class="visuallyhidden" type="file" id="files2" accept="image/*" />
                                <span>อัปโหลด</span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex">
                        <img class="mx-auto mt-5 mb-2 img-thumbnail" id="preview2">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="editServiceButton" type="button" class="btn btn-primary">แก้ไข</button>
            </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>

    $(document).ready(async function() {
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

        // edit
        $('#editServiceButton').click(async function(event) {
            event.preventDefault();

            var fd = new FormData();
            var files = $("#files2")[0].files;
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
                // alert("Please select a file.")
                console.log($("#preview2").attr('src'))
                file_name = $("#preview2").attr('src').replace('../../', '')
            }
            
            axios.put("../../controllers/service_type/update.php", {
                id: $("#editServiceId").val(),
                name: $("#editServiceName").val(),
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

        // for modal 

        document.getElementById('file-upload2').addEventListener('click', event => {
            console.log('click')
            $('#files2').trigger('click');
        })

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview2").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        var services_data = [];
        var services = "";
        await axios.get("../../controllers/service_type/get.php")
        .then(function(response) {
            services_data = response.data.data
        }).catch((err) => {
            console.log(err.response.data)
            console.log(err.response.status)
        })

        for(let i = 0; i < services_data.length; i++) {
            services += '<div class="col-sm-12 col-md-4 col-lg-3 my-2">'
            services += '<div class="d-flex flex-column service__content-container p-3">'
            services +=     '<div class="d-flex">'
            services +=         '<button class="service_edit m-auto service__button"  data-array='+ i + ' data-bs-toggle="modal" data-bs-target="#editService">แก้ไข</button>'
            // services +=         '<button class="service_delete m-auto service__button"  data-array='+ i + '>ลบ</button>'
            services +=     '</div>'
            services +=     '<div class="mx-auto my-3" style="width: 100px; height: 100px;">'
            services +=         '<img class="w-100 h-100" src=../../' + services_data[i].service_file + ' alt="">'
            services +=     '</div>'
            services +=     '<div class="mx-auto">'
            services +=         services_data[i].service_type_name
            services +=     '</div>'
            services +=     '<div class="mx-auto my-2">'
            // services +=         '<button onclick="location.href=\'hair_service.php?service_type=' +  services_data[i].service_type_id + '&service_type_name=' + services_data[i].service_type_name + '\'" class="m-auto service__button" >ยืนยัน</button>'
            services +=             '<button data-id=' +  services_data[i].service_type_id + ' data-name=' + services_data[i].service_type_name + ' class="m-auto service__button" data-bs-toggle="modal" data-bs-target="#acceptButton">ยืนยัน</button>'
            services +=     '</div>'
            services +=  '</div>'
            services +=  '</div>'
        }

        $('#service_list').html(
            services
        )

        $('.service_edit').click(function() {
            console.log(services_data[$(this).attr('data-array')])
            $('#editServiceId').val(services_data[$(this).attr('data-array')].service_type_id);
            $('#editServiceName').val(services_data[$(this).attr('data-array')].service_type_name);
            $("#preview2").attr("src", '../../' + services_data[$(this).attr('data-array')].service_file);
        })

        $('.service_delete').click(async function() {
            console.log(services_data[$(this).attr('data-array')])
            await axios.put("../../controllers/service_type/delete.php", {
                id: services_data[$(this).attr('data-array')].service_type_id,
            }).then(function(response) {
                location.reload();
            }).catch((err) => {
                console.log(err.response.data)
                console.log(err.response.status)
            })
        })

        $('.service__button').click(async function(event) {
            var id = $(this).data('id');
            var name = $(this).data('name');
            console.log(id)
            if (id !== undefined) {
                document.getElementById("modalAccept").addEventListener('click', function(event) {
                    window.location.href='hair_service.php?service_type_name=' + name + '&service_type=' + id;
                });
            }

        })

    });
    </script>
</body>