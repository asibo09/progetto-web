<?php
require_once("bootstrap.php");
$templateParams["nome"] = "template/utenteContent.php";

if(empty($_SESSION['email'])){
    header("location: login.php");
    exit();
}

$userData = $dbh->checkLogin($_SESSION["email"], $_SESSION["password"]);
$userData = $userData[0];

require_once("template/base.php");
?>