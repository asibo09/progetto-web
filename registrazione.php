<?php
session_start();
require_once("bootstrap.php");

$templateParams = [];
$templateParams["titolo"] = "Registrazione";
$templateParams["nome"] = "template/registrazioneContent.php";
require_once("template/base.php");

?>