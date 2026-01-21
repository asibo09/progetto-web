<?php
require_once 'bootstrap.php';

// Recupero dell'ID utente (Valore temporaneo per Roberto Rossi ID 2)
$idUtente = 2; 
/* $idUtente = $_GET["id"]; // DA USARE IN SEGUITO per rendere la pagina dinamica per ogni utente */

$utente = $dbh->getUserById($idUtente);

if (!$utente) {
    header("location: index.php");
    exit();
}

$annunci_raw = $dbh->getAnnunciByUserId($idUtente);
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
$templateParams["titolo"] = "Profilo Utente";
$templateParams["nome"] = "template/profilo-altro-utente-content.php";
$templateParams["utente"] = $utente;
$templateParams["annunci"] = $annunci_formattati;

require 'template/base.php';
?>