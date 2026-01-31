<?php
require_once 'bootstrap.php';

$idProfiloDaVedere = $_GET["id"]; 

$utente = $dbh->getUserById($idProfiloDaVedere);

if (!$utente) {
    header("location: index.php");
    exit();
}

// Salviamo la pagina di provenienza per il link "Indietro", a meno che non venga da foto.php
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'profilo-altro-utente.php') === false) {
    $_SESSION['previous_list_page'] = $_SERVER['HTTP_REFERER'];
}

// Se non c'è una pagina precedente valida, di default torna alla home
$defaultHome = (isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == 'admin') ? "admin-index.php" : "index.php";
$backLink = $_SESSION['previous_list_page'] ?? $defaultHome;
$templateParams["back_link"] = $backLink;

// Recupero gli annunci del proprietario
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

// Recupero preferiti utente loggato
$idUtenteLoggato = $_SESSION["id_utente"];
$preferitiUtente = $dbh->getPreferitiByUserId($idUtenteLoggato);
// Creiamo un array semplice con solo gli ID degli alloggi preferiti
$templateParams["preferiti_ids"] = array_column($preferitiUtente, 'id_alloggio');

$templateParams["titolo"] = "Profilo Utente";
$templateParams["nome"] = "template/profilo-altro-utente-content.php";
$templateParams["utente"] = $utente;
$templateParams["annunci"] = $annunci_formattati;

require 'template/base.php';
?>