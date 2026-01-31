<?php
//session_start();
require_once("bootstrap.php");

$templateParams = [];
$templateParams['titolo'] = "Risultati Ricerca";
$templateParams['nome'] = "template/risultatiRicerca-content.php";

// Default: risultati vuoti se non è POST
$templateParams['SearchResults'] = [];


// Controllo se qualcuno è arrivato qui tramite il bottone (POST)
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['luogo'])) {
    // Recupero e sanitizzo i dati base
    $citta = trim($_GET['luogo']);
    $nmesi = !empty($_GET['nmesi']) ? (int)$_GET['nmesi'] : 1;
    $npersone = !empty($_GET['npersone']) ? (int)$_GET['npersone'] : 1;

    // Recupero i filtri avanzati
    $prezzo_max = !empty($_GET['prezzo_max']) ? (int)$_GET['prezzo_max'] : null;
    $tipologia = isset($_GET['tipologia']) && is_array($_GET['tipologia']) ? $_GET['tipologia'] : [];
    $zona = isset($_GET['zona']) && is_array($_GET['zona']) ? $_GET['zona'] : [];

    // Recupero filtri extra (booleani/switch)
    $extra_filters = [];
    $allowed_extras = ['has_ascensore', 'accetta_animali', 'utenza_internet', 'utenza_acqua'];
    foreach ($allowed_extras as $extra) {
        if (!empty($_GET[$extra])) {
            $extra_filters[$extra] = 1;
        }
    }

    // Solo se abbiamo la città, chiamiamo la ricerca
    if (!empty($citta)) {
        $templateParams['SearchResults'] = $dbh->search($citta, $nmesi, $npersone, $prezzo_max, $tipologia, $zona, $extra_filters);
    }
}





require_once("template/base.php");
?>