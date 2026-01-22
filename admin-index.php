<?php
require_once 'bootstrap.php';

// All'inizio di admin-index.php, dopo il checkAdmin()

if (isset($_GET["action"]) && isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $action = $_GET["action"];
    $target = $_GET["target"] ?? null; // 'alloggio' o 'utente'

    if ($action == "delete") {
        if ($target == "alloggio") {
            $dbh->eliminaAlloggio($id);
        } elseif ($target == "utente") {
            $dbh->eliminaUtente($id);
        }
    } elseif ($action == "ignore") {
        $dbh->eliminaSegnalazione($id);
    } elseif ($action == "delete_alloggio") { // Per la tab Gestione Annunci
        $dbh->eliminaAlloggio($id);
    }

    // Ricarica la pagina per vedere le modifiche
    header("location: admin-index.php?msg=Operazione+eseguita");
    exit();
}

$idUtente = $_SESSION["id_utente"] ?? 1;

$templateParams["segnalazioni"] = $dbh->getSegnalazioniDettagliate();

// Prepariamo la lista alloggi arricchita con la foto copertina
$alloggi_raw = $dbh->getAllAnnunciAdmin();
$alloggi_con_foto = [];

foreach($alloggi_raw as $a) {
    // Per ogni alloggio, cerchiamo la sua copertina
    $a["foto_copertina"] = $dbh->getCoverByAlloggioId($a["id_alloggio"]);
    $alloggi_con_foto[] = $a;
}

$templateParams["alloggi_totali"] = $alloggi_con_foto;

if(isset($_POST["testo_broadcast"])) {
    $testo = $_POST["testo_broadcast"];
    if(!empty(trim($testo))) {
        // Chiama la funzione che popola la tabella per tutti gli utenti
        $dbh->inviaBroadcast($testo);
        header("location: admin-index.php?msg=Notifica+inviata+a+tutti+gli+utenti");
        exit();
    }
}

// Carica lo storico per mostrarlo nella Tab
$templateParams["storico_broadcast"] = $dbh->getStoricoBroadcast();
$templateParams["titolo"] = "Admin Dashboard";
$templateParams["nome"] = "template/admin-index-content.php"; 

require 'template/base.php';
?>