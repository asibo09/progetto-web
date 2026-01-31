<?php
require_once 'bootstrap.php';

/* 1. GESTIONE LOGIN / SESSIONE REALE */
// Recuperiamo l'ID solo se esiste, altrimenti mettiamo null
$idUtenteLoggato = $_SESSION["id_utente"] ?? null;

if ($idUtenteLoggato) {
    $templateParams["utente"] = $dbh->getUserById($idUtenteLoggato);
} else {
    $templateParams["utente"] = null;
}

$templateParams["titolo"] = "Unibo Affitti - Home";
$templateParams["nome"] = "template/index-content.php"; 


if(isset($_SESSION["email"])){
    $templateParams["lastSearches"] = $dbh->lastFourSearch($_SESSION["id_utente"]);
    $templateParams['isLogged'] = "Continua la Ricerca";
}



require_once("template/base.php");
?>
