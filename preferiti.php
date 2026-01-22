<?php
require_once 'bootstrap.php';

// Recupero dell'ID utente (Valore temporaneo per ID 3 - Luca Bianchi)
$idUtente = 3; 
/* $idUtente = $_SESSION["id_utente"]; // DA USARE IN SEGUITO dopo il login */

$utente = $dbh->getUserById($idUtente);

if (!$utente) {
    header("location: index.php");
    exit();
}

// Usiamo la nuova funzione per i preferiti invece di getAnnunciByUserId
$annunci_raw = $dbh->getPreferitiByUserId($idUtente);
$annunci_formattati = [];

foreach($annunci_raw as $annuncio) {
    $annuncio["lista_foto"] = $dbh->getFotoByAlloggioId($annuncio["id_alloggio"]);
    
    $stanze = $dbh->getStanzeByAlloggioId($annuncio["id_alloggio"]);
    $annuncio["disponibile"] = false;
    foreach($stanze as $s) {
        if($s["stato"] == 'Disponibile') {
            $annuncio["disponibile"] = true;
            break;
        }
    }
    
    $annunci_formattati[] = $annuncio;
}

// Passaggio parametri al template
$templateParams["titolo"] = "I miei annunci salvati";
$templateParams["nome"] = "template/preferiti-content.php";
$templateParams["utente"] = $utente;
$templateParams["annunci"] = $annunci_formattati;

require 'template/base.php';
?>