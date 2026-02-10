<?php

include("nav.php");

session_start();
$logout = md5($_SESSION["email"]);
$email_md5 = md5($logout);
unset($_SESSION['email']);

session_unset();
session_destroy();








echo "Logging out ... Please wait ...";
echo "<script>window.location.href='index?logout=$logout&v_1=$email_md5';</script>";
exit();


?>