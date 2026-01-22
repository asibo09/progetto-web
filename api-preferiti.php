<?php
require_once 'bootstrap.php';
$idUtente = 3; // Temporaneo
// dopo il login usare $_SESSION["id_utente"];

if(isset($_POST["id_alloggio"])) {
    $idAlloggio = $_POST["id_alloggio"];
    $risultato = [];

    if($dbh->isFavorite($idUtente, $idAlloggio)) {
        $dbh->removeFavorite($idUtente, $idAlloggio);
        $risultato["stato"] = "rimosso";
    } else {
        $dbh->addFavorite($idUtente, $idAlloggio);
        $risultato["stato"] = "aggiunto";
    }

    header('Content-Type: application/json');
    echo json_encode($risultato);
}
?>