<?php
require_once 'bootstrap.php';

// Controllo se l'ID alloggio è presente
if(!isset($_GET["id"])){
    header("location: index.php");
    exit();
}
$idUtente = $_SESSION["id_utente"];
$idAlloggio = $_GET["id"];

// Recuperiamo i dati dell'alloggio
$annuncio = $dbh->getFullAnnuncioById($idAlloggio);
// Recuperiamo tutte le foto dell'alloggio
$foto = $dbh->getFotoByAlloggioId($idAlloggio);

if (!$annuncio) {
    header("location: index.php");
    exit();
}

$templateParams["titolo"] = "Galleria Foto";
$templateParams["nome"] = "template/foto-content.php";
$templateParams["utente"] = $dbh->getUserById($idUtente);
$templateParams["annuncio"] = $annuncio;
$templateParams["foto"] = $foto;

require 'template/base.php';
?>