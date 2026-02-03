<?php
require_once 'bootstrap.php';

//Verifica che l'utente sia loggato e che arrivi un ID alloggio
if (isset($_SESSION["id_utente"]) && isset($_POST["id_alloggio"])) {
    $idStudente = $_SESSION["id_utente"];
    $idAlloggio = (int)$_POST["id_alloggio"];
    
    $dbh->salvaRicerca($idStudente, $idAlloggio);
}
?>