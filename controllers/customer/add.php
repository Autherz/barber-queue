<?php 
    session_start();
    session_id();
    require_once "../../database/connect.php";
    require_once "../../models/customer.php";

    $customer = new Customer($_POST['name'], $_POST['username'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['password']);
    $customer->add();
    header("Location: ../../index.php");