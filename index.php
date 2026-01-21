<?php
require_once("bootstrap.php");

/* 1. GESTIONE LOGIN / SESSIONE */
// Quando avrai il sistema di login, userai una funzione come isUserLoggedIn()
// Per ora simuliamo: se vuoi testare come "non loggato", commenta la riga sotto.
$idUtente = 3; // ID di test (Luca Bianchi)

if (isset($idUtente)) {
    // Se c'è un ID, recuperiamo l'utente per far funzionare il menu in base.php
    $templateParams["utente"] = $dbh->getUserById($idUtente);
} else {
    // Se non è loggato, l'utente sarà null e base.php mostrerà il menu "studente"
    $templateParams["utente"] = null;
}

$templateParams["titolo"] = "Unibo Affitti - Home";
$templateParams["nome"] = "template/index-content.php"; 
require 'template/base.php';
?>