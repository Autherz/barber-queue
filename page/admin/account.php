<?php 
    session_start();
    session_id();
    require_once '../../vendor/autoload.php';
    require_once "../../database/connect.php";
    require_once "../../models/booking_detail.php";

    $data = BookingDetail::get()->fetchAll();
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
                    <th scope="col">รูป </th>
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
                            <?php echo $v['hair_service_price']; ?>
                        </td>
                        <td>
                            <img style="max-width: 200px; max-height: 150px;" src=<?php echo '../../' . $v['hair_service_file']; ?>  alt="">               
                        </td>
                        <td>
                            <img style="max-width: 200px; max-height: 150px;" src=<?php echo '../../' . $v['slip_file']; ?>  alt="">
                        </td>
                        <td>
                            <?php 
                                if( $v['booking_status'] == 'ยังไม่ชำระ') {
                                    echo '<button class="btn btn-danger booking-button" type="button" data-bs-toggle="modal" data-bs-target="#editService" data-id='. $v['booking_id']  .' data-status=' . $v['booking_status'] . '>' . $v['booking_status'] . '</button>';
                                } else {
                                    echo '<button class="btn btn-success booking-button" type="button" data-bs-toggle="modal" data-bs-target="#editService" data-id='. $v['booking_id']  .' data-status=' . $v['booking_status'] . ' disabled>' . $v['booking_status'] . '</button>';
                                }
                            ?>     
                        </td>
                    </tr>
                <?php 
                    }
                ?>
                <!-- <tr>
                    <th scope="row">9/1/2021</th>
                    <td>
                        <button class="w-100">
                            จอง
                        </button>
                    </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td></td>
                    <td>
                        <button class="w-100">
                            จอง
                        </button>
                    </td>
                </tr> -->

            </tbody>
        </table>
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
                        ชื่อช่างตัดผม
                    </div>
                    <div class="ms-auto">
                        <input type="text" placeholder="ชื่่อบริการ" id="addHairDressorName">
                    </div>
                </div>
                <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        เบอร์โทรศัพท์
                    </div>
                    <div class="ms-auto">
                        <input type="text" placeholder="เบอร์โทรศัพท์" id="addHairDressorPhone">
                    </div>
                </div>
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
            <button id="addHairDressorButton" type="button" class="btn btn-primary">เพิ่ม</button>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editService" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">อัพเดทการชำระ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="modal-container">
                <input type="hidden" placeholder="id" id="editWorkingId">
                <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        เลือกสถานะ
                    </div>
                    <div class="ms-auto">
                        <select class="" aria-label="Default select example" id="status">
                            
                            <option value="ยังไม่ชำระ">ยังไม่ชำระ</option>
                            <option value="ชำระแล้ว">ชำระแล้ว</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex px-5 my-2" id="addModalError"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="editBookingButton" type="button" class="btn btn-primary">แก้ไข</button>
        </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
    $(document).ready(async function() {

        $('.booking-button').click(function() {
            console.log($(this).attr('data-id'))
            console.log($(this).attr('data-status'))
            // editWorkingId
            $('#editWorkingId').val($(this).attr('data-id'))
            $('#status').val($(this).attr('data-status'))
        })

        $('#editBookingButton').click(async function(event) {
            console.log($('#editWorkingId').val())
            console.log($('#status').val())

            axios.put("../../controllers/booking/update_status.php", {
                booking_id: $('#editWorkingId').val(),
                // status: $('#status').val()
                // file: $('#status').val()
            }).then(function(response) {
                location.reload();
            }).catch((err) => {
                console.log(err.response.data)
                console.log(err.response.status)
            })
        });
    });
    </script>
</body>