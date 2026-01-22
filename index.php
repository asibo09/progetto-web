<?php
session_start();
require_once("bootstrap.php");

$templateParams = [];
$templateParams["titolo"] = "Home";
$templateParams["nome"] = "template/index-content.php";
$templateParams["lastSearches"] = $dbh->lastFourSearch(4);


require_once("template/base.php");
?>
