<?php 
    session_start();
    session_id();
    require_once 'vendor/autoload.php';
    require_once "database/connect.php";

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
    <title>Barber main</title>
    <style>
    </style>
  </head>
  <body>
    <div class="d-flex flex-column min-vh-100">
        <!-- Footer -->
        <?php require_once "header.php" ?>

        <div class="d-flex flex-column min-vh-100">
            <div class="m-auto">
                <img class="home__content-logo" src="assets/images/69like.jpg" alt="Logo" lazy>
            </div>

            <div class=" mx-auto mb-auto">
                <div class="p-5 bg-white" style="font-size: 28px;">
                    เลือกทรงผมที่ใช่ สไตล์ที่ชอบในแบบของคุณ
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>