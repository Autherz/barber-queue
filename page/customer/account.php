<?php 
    session_start();
    session_id();
    require_once '../../vendor/autoload.php';
    require_once "../../database/connect.php";
    require_once "../../models/booking_detail.php";
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

    $data = BookingDetail::getByCustomerId($data_token->customer_id)->fetchAll();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../../css/style.css">
    <title>โปรไฟล์</title>
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
                            โปรไฟล์
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table caption-top bg-white">
            <caption>List of users</caption>
            <thead >
                <tr>
                    <th scope="col">Booking Id </th>
                    <th scope="col">วันที่นัด</th>
                    <th scope="col">เวลานัด</th>
                    <th scope="col">ช่าง</th>
                    <th scope="col">เบอร์ </th>
                    <th scope="col">บริการ </th>
                    <th scope="col">ราคา </th>
                    <th scope="col">รูปบริการ </th>
                    <th scope="col">สลิป </th>
                    <th scope="col">สถานะ </th>
                </tr>
            </thead>
            <tbody id="booking">
                <?php 
                    foreach($data as $k=>$v) {
                ?>
                    <tr>
                        <td scope="row">
                            <?php echo $v['booking_id']; ?>
                        </td>
                        <td>
                            <?php echo $v['hair_dressor_date']; ?>
                        </td>
                        <td>
                            <?php echo $v['start_time'] . '-' . $v['end_time']; ?>
                        </td>
                        <td>
                            <?php echo $v['hair_dressor_name']; ?>
                        </td>
                        <td>
                            <?php echo $v['hair_dressor_phone']; ?>
                        </td>
                        <td>
                            <?php echo $v['hair_service_name']; ?>
                        </td>
                        <td>
                            <?php echo $v['hair_service_price']; ?> บาท
                        </td>
                        <td>
                            <img style="max-width: 200px; max-height: 150px;" src=<?php echo '../../' . $v['hair_service_file']; ?>  alt="">               
                        </td>
                        <td>
                            <?php 
                                if( $v['slip_file'] == '') {
                            ?>
                                <button id="file-upload2" type="button" class="ml-auto my-auto py-2 px-4 slip-button" data-id=<?php echo $v['booking_id'] ; ?> style="color:#fff;background-color: #FC9C2C; border-radius: 20px;box-shadow: 0px 5px 20px 0px rgba(252, 156, 44, 0.33);border:none;" data-bs-toggle="modal" data-bs-target="#uploadImage">
                                    <!-- <input class="visuallyhidden" type="file" id="files" accept="image/*" /> -->
                                    <span>อัปโหลด</span>
                                </button>
                            <?php 
                                } else {
                                    echo '<img style="max-width: 200px; max-height: 150px;" src=' . '../../' . $v['slip_file'] . ' alt="">';
                                }
                            ?>
                        </td>
                        <td>
                            <?php 
                                if( $v['booking_status'] == 'รอดำาเนินการ') {
                                    echo '<button class="btn btn-danger booking-button" type="button"  data-id='. $v['booking_id']  .' data-status=' . $v['booking_status'] . '>' . $v['booking_status'] . '</button>';
                                } else {
                                    echo '<button class="btn btn-success booking-button" type="button" data-id='. $v['booking_id']  .' data-status=' . $v['booking_status'] . ' disabled>' . $v['booking_status'] . '</button>';
                                }
                            ?>     
                        </td>
                    </tr>
                <?php 
                    }
                ?>

            </tbody>
        </table>
        <div class="d-flex ms-5 me-auto mt-auto me-2 mb-5">
            <button onclick="window.history.back()" id="backButton" type="button" class="m-auto service__button">
                กลับ
            </button>
        </div>
    </div>

    <!-- UploadModal -->
    <div class="modal fade" id="uploadImage" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">อัปโหลดสลิป</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="modal-container">
                <input type="hidden" id="uploadBookingId">
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
            <button id="uploadSlipButton" type="button" class="btn btn-primary">อัปโหลด</button>
        </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
    $(document).ready(async function() {

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


        $('.slip-button').click(function() {
            $('#uploadBookingId').val($(this).attr('data-id'))
        })

        $('#uploadSlipButton').click(async function() {

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
            axios.put("../../controllers/booking/update.php", {
                booking_id: $('#uploadBookingId').val(),
                file: file_name
            }).then(function(response) {
                location.reload();
                // location.href = 'main.php'
            }).catch((err) => {
                console.log(err.response.data)
                console.log(err.response.status)
            })
        })
        // $('.booking-button').click(function() {
        //     console.log($(this).attr('data-id'))
        //     console.log($(this).attr('data-status'))
        //     // editWorkingId
        //     $('#editWorkingId').val($(this).attr('data-id'))
        //     $('#status').val($(this).attr('data-status'))
        // })

        // $('#editBookingButton').click(async function(event) {
        //     console.log($('#editWorkingId').val())
        //     console.log($('#status').val())

        //     axios.put("../../controllers/booking/update_status.php", {
        //         booking_id: $('#editWorkingId').val(),
        //         // status: $('#status').val()
        //         // file: $('#status').val()
        //     }).then(function(response) {
        //         location.reload();
        //     }).catch((err) => {
        //         console.log(err.response.data)
        //         console.log(err.response.status)
        //     })
        // });
    });
    </script>
</body>