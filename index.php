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
$templateParams['isLogged'] = "";
$templateParams["lastSearches"] = "";

if(isset($_SESSION["email"])){
    $templateParams["lastSearches"] = $dbh->lastFourSearch($_SESSION["id_utente"]);
    if(count($templateParams["lastSearches"]) > 0){
        $templateParams['isLogged'] = "Continua la Ricerca";
        foreach ($templateParams["lastSearches"] as $search) {
            $idAlloggio = $search["id_alloggio"];
            $templateParams["fotoAlloggio"][$idAlloggio] = $dbh->getFotoByAlloggioId($idAlloggio);
        }
    }
}

require_once("template/base.php");
?>
