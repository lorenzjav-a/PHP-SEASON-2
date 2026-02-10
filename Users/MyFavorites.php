<?php

session_start();

if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../';</script>";
}

include("nav.php");

include("../connections.php");


?>