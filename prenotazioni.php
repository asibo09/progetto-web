<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Le mie prenotazioni";
$templateParams["nome"] = "template/prenotazioniContent.php";
$fotoAlloggio = [];

$prenotazioni = $dbh->myApartamentsRented($_SESSION["email"]);
foreach ($prenotazioni as $alloggio){
    $idAlloggio = $alloggio["id_alloggio"];
    $fotoAlloggio[$idAlloggio] = $dbh->getFotoByAlloggioId($idAlloggio);
}

$numeroAffitti = count($prenotazioni);

require_once("template/base.php");
?>