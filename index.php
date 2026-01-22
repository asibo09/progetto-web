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

if(isset($_GET["msg"])){
    $templateParams["messaggio_successo"] = $_GET["msg"];
}

$templateParams["titolo"] = "Unibo Affitti - Home";
$templateParams["nome"] = "template/index-content.php"; 
require 'template/base.php';
?>
