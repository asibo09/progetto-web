<?php
require_once 'bootstrap.php';

// 1. Recupero l'ID dell'utente di cui stiamo guardando il profilo
// Se c'è un ID nell'URL lo prendiamo, altrimenti usiamo il 2 come default (temporaneo)
$idProfiloDaVedere = $_GET["id"] ?? 2; 

$utente = $dbh->getUserById($idProfiloDaVedere);

if (!$utente) {
    header("location: index.php");
    exit();
}

// 2. Recupero gli annunci del proprietario
$annunci_raw = $dbh->getAnnunciByUserId($idProfiloDaVedere);
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

// 3. RECUPERO PREFERITI UTENTE LOGGATO (per colorare i cuori correttamente)
$idUtenteLoggato = $_SESSION["id_utente"] ?? -1;
$preferitiUtente = $dbh->getPreferitiByUserId($idUtenteLoggato);
// Creiamo un array semplice con solo gli ID degli alloggi preferiti
$templateParams["preferiti_ids"] = array_column($preferitiUtente, 'id_alloggio');

$templateParams["titolo"] = "Profilo Utente";
$templateParams["nome"] = "template/profilo-altro-utente-content.php";
$templateParams["utente"] = $utente;
$templateParams["annunci"] = $annunci_formattati;

require 'template/base.php';
?>