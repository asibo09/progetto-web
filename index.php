<?php
session_start();
require_once("bootstrap.php");

$templateParams = [];
$templateParams["titolo"] = "Home";
$templateParams["nome"] = "template/index-content.php";

require_once("template/base.php");
?>
