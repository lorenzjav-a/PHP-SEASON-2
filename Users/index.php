<?php

session_start();

if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../';</script>";
}

include("../connections.php");

include("nav.php");

?>