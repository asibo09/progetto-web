<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "I miei annunci";
$templateParams["nome"] = "template/iMieiAnnunciContent.php";

$iMieiAnnunciResult = $dbh->myApartments($_SESSION["email"]);

require_once("template/base.php");

?>