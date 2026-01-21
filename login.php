<?php
session_start();
require_once("bootstrap.php");

$templateParams = [];
$templateParams["titolo"] = "Login";
$templateParams["nome"] = "template/loginContent.php";
require_once("template/base.php");

?>