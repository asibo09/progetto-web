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
    $zona = isset($_GET['zona']) && is_array($_GET['zona']) ? $_GET['zona'] : [];

    // Recupero filtri extra (booleani, switch ed enum semplici)
    $extra_filters = [];
    $allowed_extras = [
        // Booleans
        'has_ascensore', 'has_cucina', 'proprietario_vive_casa', 
        'accetta_animali', 'accetta_fumatori', 'accetta_coppie',
        'utenza_internet', 'utenza_acqua', 'utenza_gas', 'utenza_luce',
        // Enums (Exact match)
        'tipo_riscaldamento', 'genere_inquilini', 'occupazione_inquilini'
    ];

    foreach ($allowed_extras as $extra) {
        if (!empty($_GET[$extra])) {
            $extra_filters[$extra] = $_GET[$extra];
        }
    }

    // Solo se abbiamo la città, chiamiamo la ricerca
    if (!empty($citta)) {
        $templateParams['SearchResults'] = $dbh->search($citta, $nmesi, $npersone, $prezzo_max, $zona, $extra_filters);
    }
}





require_once("template/base.php");
?>