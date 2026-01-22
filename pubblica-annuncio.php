<?php
require_once 'bootstrap.php';

// solo i proprietari loggati possono accedere DA FARE!!!

$idUtente = 2; //segui dopo il login usare $_SESSION["id_utente"];
$utente = $dbh->getUserById($idUtente);

if (!$utente || strtolower($utente["ruolo"]) != "proprietario") {
    header("location: index.php");
    exit();
}

$templateParams["titolo"] = "Unibo Affitti - Pubblica Annuncio";
$templateParams["nome"] = "template/pubblica-annuncio-content.php";
$templateParams["utente"] = $utente;
require 'template/base.php';
?>