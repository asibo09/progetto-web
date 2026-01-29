<?php
// processa-prenotazione.php
require_once 'bootstrap.php';

$idStanza = isset($_POST["id_stanza"]) ? (int)$_POST["id_stanza"] : null;
$idAlloggio = isset($_POST["id_alloggio"]) ? (int)$_POST["id_alloggio"] : null;

if ($idStanza && $idAlloggio) {
    $successo = $dbh->prenotaStanza($_SESSION["id_utente"], $idStanza);

    if ($successo) {
        // Torniamo all'annuncio con un messaggio di successo
        header("location: annuncio.php?id=$idAlloggio&msg=Prenotazione eseguita con successo!");
    } else {
        header("location: annuncio.php?id=$idAlloggio&error=Errore durante la prenotazione.");
    }
} else {
    header("location: index.php");
}
?>