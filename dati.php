<?php
require_once("bootstrap.php");
$templateParams["nome"]="datiContent.php";
$userData = $dbh->checkLogin($_SESSION["email"], $_SESSION["password"]);
$userData = $userData[0];
require("template/base.php");
?>