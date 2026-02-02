<?php
require_once("bootstrap.php");
$templateParams["nome"] = "template/utenteAdminContent.php";

if(empty($_SESSION['email'])){
    header("location: login.php");
    exit();
}

$userData = $dbh->checkLogin($_SESSION["email"], $_SESSION["password"]);
$userData = $userData[0];
$templateParams["titolo"] = "Il tuo profilo";
require_once("template/base.php");
?>