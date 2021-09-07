<?php 
    session_start();
    session_id();
    require_once '../../vendor/autoload.php';
    require_once "../../database/connect.php";
    require_once "../../models/hair_dressor.php";
    require_once "../../models/workingtime.php";

    $workingtime_hair_dressor = HairDressor::getById($_GET['hair_dressor_id']);

    $workingtime_hair_dressor_data = $workingtime_hair_dressor->fetch();

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>แก้ไขการใช้บริการช่างตัดผม</title>
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
                            ตารางบอกเวลาการทำงานของช่าง
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex my-5">
            <button class="ms-auto me-5 service__button-add" data-bs-toggle="modal" data-bs-target="#addService">เพิ่มคิว</button>
        </div>
        <div class="m-5 bg-white" style="width: 400px;">
            <div class="d-flex bg-white">
                <img src=<?php echo '../../' . $workingtime_hair_dressor_data['hair_dressor_image'] ?> alt="">
                <div class="bg-white m-auto"><?php echo $_GET["hair_dressor_name"] ?></div>
            </div>
        </div>
        <table class="table caption-top bg-white" style="overflow: auto;">
            <caption>List of users</caption>
            <thead >
                <tr>
                <th scope="col">Date </th>
                <th scope="col">09.00 - 10.00</th>
                <th scope="col">10.00 - 11.00</th>
                <th scope="col">11.00 - 12.00</th>
                <th scope="col">12.00 - 13.00</th>
                <th scope="col">13.00 - 14.00</th>
                <th scope="col">14.00 - 15.00</th>
                <th scope="col">15.00 - 16.00</th>
                <th scope="col">16.00 - 17.00</th>
                <th scope="col">17.00 - 18.00</th>
                <th scope="col">18.00 - 19.00</th>
                <th scope="col">19.00 - 20.00</th>
                <th scope="col">20.00 - 21.00</th>
                </tr>
            </thead>
            <tbody id="booking">
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
                        เริ่มงาน
                    </div>
                    <div class="ms-auto">
                        <input class="datepicker" data-date-format="mm/dd/yyyy" id="date">
                    </div>
                </div>
                <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        เริ่มงาน
                    </div>
                    <div class="ms-auto">
                        <select class="" aria-label="Default select example" id="start">
                        </select>
                    </div>
                </div>
                <div class="d-flex px-5 my-2">
                    <div class="my-auto">
                        เลิกงาน
                    </div>
                    <div class="ms-auto">
                        <select class="" aria-label="Default select example" id="end">
                        </select>
                    </div>
                </div>
                <div class="d-flex px-5 my-2" id="addModalError"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="addHairDressorButton" type="button" class="btn btn-primary">เพิ่ม</button>
        </div>
        </div>
    </div>
    </div>

    <!-- WOrk Modal -->
    <div class="modal fade" id="editService" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">แก้ไข</h5>
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
                            
                            <option value="ว่าง">ว่าง</option>
                            <option value="ไม่ว่าง">ไม่ว่าง</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex px-5 my-2" id="addModalError"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="editHairDressorButton" type="button" class="btn btn-primary">แก้ไข</button>
        </div>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js" integrity="sha512-cp+S0Bkyv7xKBSbmjJR0K7va0cor7vHYhETzm2Jy//ZTQDUvugH/byC4eWuTii9o5HN9msulx2zqhEXWau20Dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(async function() {
        const params = new URLSearchParams(window.location.search)

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });

        $('#addHairDressorButton').click(async function(event) {
            event.preventDefault();

            if ( $('#date').val() == '') {
                $('#addHairDressorButton').prop("disabled",true);
            }
            
            console.log($('#end').val() - $('#start').val())

            var temp_time = moment($('#start').val() ,"HH.mm")

            for (let i = $('#start').val() ; i < $('#end').val(); i++) {
                // console.log( temp_time.format('HH.mm') +  ' - ' +  temp_time.add(1, "hours").format('HH.mm'))
                axios.post("../../controllers/hair_booking/add.php", {
                    date: $('#date').val(),
                    start_time: temp_time.format('HH.mm'),
                    end_time: temp_time.add(1, "hours").format('HH.mm'),
                    status: 'ว่าง',
                    hair_dressor_id: params.get('hair_dressor_id')
                }).then(function(response) {
                    // location.reload();
                }).catch((err) => {
                    console.log(err.response.data)
                    console.log(err.response.status)
                })
            }
            location.reload();
        })

        $('#editHairDressorButton').click(async function(event) {
            console.log($('#editWorkingId').val())
            console.log($('#status').val())

            axios.post("../../controllers/hair_booking/update.php", {
                id: $('#editWorkingId').val(),
                status: $('#status').val()
            }).then(function(response) {
                location.reload();
            }).catch((err) => {
                console.log(err.response.data)
                console.log(err.response.status)
            })
        });

        
        var listDate = [];
        const listTime = [
            '09.00 - 10.00',
            '10.00 - 11.00',
            '11.00 - 12.00',
            '12.00 - 13.00',
            '13.00 - 14.00',
            '14.00 - 15.00',
            '15.00 - 16.00',
            '16.00 - 17.00',
            '17.00 - 18.00',
            '18.00 - 19.00',
            '19.00 - 20.00',
            '20.00 - 21.00',
        ]
        const listSingleTime = [
            '09.00', '10.00', '11.00', '12.00', '13.00', '14.00', '15.00' , '16.00', '17.00', '18.00', '19.00', '20.00'
        ]
        
        // Set select option start
        var startBookingTime = []
        var endBookingTime = []
        for (let i = 0; i < listSingleTime.length; i++) {
            if (i != 0) {
                startBookingTime += '<option data-id= ' + listSingleTime[i] + '>'
                startBookingTime += listSingleTime[i]
                startBookingTime += '</option>'

                endBookingTime += '<option data-id= ' + listSingleTime[i] + '>'
                endBookingTime += listSingleTime[i]
                endBookingTime += '</option>'
            } else {
                startBookingTime += '<option data-id= ' + listSingleTime[i] + '>'
                startBookingTime += listSingleTime[i]
                startBookingTime += '</option>'
            }
        }

        $('#start').html(
            startBookingTime
        );

        $('#end').html(
            endBookingTime
        );

        $('#date').change(function() {
            if($(this).val() != "") {
                $('#addHairDressorButton').prop("disabled",false);
            }
        })

        $('#start').change(function() {
            let start = $(this).find(':selected').attr('data-id')
            let end = $("#end").find(':selected').attr('data-id')
            if( start >= end ) {
                $('#addModalError').html(
                    '<div class="mx-auto text-danger">เวลาเริ่มงานกับเลิกงานไม่ถูกต้อง</div>'
                )

                $('#addHairDressorButton').prop("disabled",true);
            } else {
                $('#addModalError').html(
                    '<div></div>'
                )

                $('#addHairDressorButton').prop("disabled",false);
            }
        });

        $('#end').change(function() {
            let start = $("#start").find(':selected').attr('data-id')
            let end = $(this).find(':selected').attr('data-id')
            if( start >= end ) {
                $('#addModalError').html(
                    '<div class="mx-auto text-danger">เวลาเริ่มงานกับเลิกงานไม่ถูกต้อง</div>'
                )

                $('#addHairDressorButton').prop("disabled",true);
            } else {
                $('#addModalError').html(
                    '<div></div>'
                )

                $('#addHairDressorButton').prop("disabled",false);
            }
        });
        
        var booking_data = []

        await axios.get("../../controllers/hair_booking/get.php?hair_dressor_id=" + params.get('hair_dressor_id') + '&date=' + moment(new Date()).format("YYYY-MM-DD"))
        .then(function(response) {
            booking_data = response.data.data
        }).catch((err) => {
            console.log(err.response.data)
            console.log(err.response.status)
        })
    
        console.log(booking_data)

        var booking;
        const dateNow = moment().format('YYYY-MM-DD');

        for(let i = 0; i < 7; i++) {
            listDate.push(moment(dateNow).add(i, 'days').format('YYYY-MM-DD'))
        }
        console.log(listDate)
        for( let i = 0; i < listDate.length ; i++) {
            booking += '<tr>'
            booking += '<th scope="row">' + listDate[i] + '</th>'
            for( let j = 0; j < listTime.length ; j++) {
                // when match all condition
                var tik = false
                for(let k = 0; k < booking_data.length; k++) {
                    if ((booking_data[k].worktime_date == listDate[i]) && (booking_data[k].start_time == listTime[j].split(" -")[0]) && booking_data[k].hair_dressor_status == 'ว่าง') {
                        booking += '<td><button class=" w-100 booking-button" style="background-color: transparent;" data-array=' + k +' data-bs-toggle="modal" data-bs-target="#editService">' + 'จอง' + '</button></td>'
                        tik = true
                    }

                    if ((booking_data[k].worktime_date == listDate[i]) && (booking_data[k].start_time == listTime[j].split(" -")[0]) && booking_data[k].hair_dressor_status == 'ไม่ว่าง') {
                        booking += '<td><button class=" w-100" style="background-color: transparent;" data-array=' + k + ' data-bs-toggle="modal" data-bs-target="#editService" disabled>' + 'ไม่ว่าง' + '</button></td>'
                        tik = true
                    }
                }
                if(!tik) {
                    booking += '<td></td>'
                }
                // booking += '<td><button class="w-100">' + 'จอง' + '</button></td>'
            }
            booking += '</tr>'
        }

        $('#booking').html(
            booking
        );

        $('.booking-button').click(function() {
            console.log(booking_data[$(this).attr('data-array')])
            // editWorkingId
            $('#editWorkingId').val(booking_data[$(this).attr('data-array')].working_time_id)
            $('#status').val(booking_data[$(this).attr('data-array')].hair_dressor_status)
        })
    });
    </script>
</body>