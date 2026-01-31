<?php
require_once 'bootstrap.php';

// Azione Modifica
if($_POST["action"] == 2) {
    $id = $_POST["id_alloggio"];
    $tipo = $_POST["tipo_immobile"];
    $comune = $_POST["comune"];
    $indirizzo = $_POST["indirizzo"];
    $civico = $_POST["civico"];
    $dist_campus = $_POST["dist_campus"];
    $dist_centro = $_POST["dist_centro"];
    $prezzo = $_POST["prezzo"];
    $desc = $_POST["descrizione"];

    $res = $dbh->updateAlloggioAdmin($id, $tipo, $indirizzo, $civico, $comune, $dist_campus, $dist_centro, $prezzo, $desc);

    if($res) {
        $msg = "Annuncio aggiornato con successo";
        header("location: admin-index.php?msg=" . urlencode($msg));
    } else {
        $msg = "Errore durante l'aggiornamento.";
        header("location: admin-index.php?msg=" . urlencode($msg));
    }
}
?>