<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "I miei appartamenti affittati";
$templateParams["nome"] = "template/prenotazioniContent.php";

$prenotazioni = $dbh->myApartamentsRented($_SESSION["email"]);

require_once("template/base.php");
?>