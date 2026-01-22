<?php
session_start();
define("UPLOAD_DIR", "./upload/");

require_once("db/database.php");
require_once("utils/functions.php");

$dbh = new DatabaseHelper("localhost", "root", "", "GestioneAffitti", 3306);

if (isUserLoggedIn()) {
// Usa ?? null per evitare il Warning se la chiave non esiste
    $idLoggato = $_SESSION["id_utente"] ?? 2; 

    if ($idLoggato) {
        $templateParams["utente"] = $dbh->getUserById($idLoggato);
    } else {
        $templateParams["utente"] = null;
    }
}
?>