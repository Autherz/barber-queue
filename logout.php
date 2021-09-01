<?php 
    require_once "database/connect.php";

    session_start();
    session_id();

    unset($_SESSION['userId']);
    session_destroy();
    header("Location:index.php");