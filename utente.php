<?php
require_once("bootstrap.php");
$templateParams["nome"] = "template/utenteContent.php";
$userData = $dbh->checkLogin($_SESSION["email"], $_SESSION["password"]);
$userData = $userData[0];
var_dump($userData[0]);
var_dump($_SESSION["email"], $_SESSION["id_utente"]);
require_once("template/base.php");
?>