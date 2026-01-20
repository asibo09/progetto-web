<?php
session_start();
require_once("bootstrap.php");

$templateParams = [];
$templateParams["titolo"] = "Home";
$templateParams["nome"] = "template/index-content.php";
$templateParams["lastSearches"] = $dbh->lastFourSearch("anna.bianchi@studenti.it");

require_once("template/base.php");


echo $templateParams["lastSearches"][0]["data_ricerca"];

?>
