<?php
require_once 'bootstrap.php';

if(!isset($_GET["id"])){
    header("location: index.php");
    exit();
}

$id = $_GET["id"];
$idStanza = $_GET["id"]; // O recuperato dai dettagli dell'alloggio
$idUtente = $_SESSION["id_utente"] ?? 3;

// Salviamo la pagina di provenienza per il link "Indietro", a meno che non venga da foto.php
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'foto.php') === false) {
    $_SESSION['previous_list_page'] = $_SERVER['HTTP_REFERER'];
}

$defaultHome = (isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == 'admin') ? "admin-index.php" : "index.php";
$backLink = $_SESSION['previous_list_page'] ?? $defaultHome;
$templateParams["back_link"] = $backLink;

// Recupero dati dal DB
$annuncio = $dbh->getFullAnnuncioById($id);
$stanze = $dbh->getStanzeByAlloggioId($id);
$foto = $dbh->getFotoByAlloggioId($id); // Usiamo quella già creata prima

if (!$annuncio) {
    header("location: index.php");
    exit();
}

$templateParams["titolo"] = "Annuncio - " . $annuncio["indirizzo"];
$templateParams["nome"] = "template/annuncio-content.php";
$templateParams["utente"] = $dbh->getUserById($idUtente);
$templateParams["annuncio"] = $annuncio;
$templateParams["stanze"] = $stanze;
$templateParams["foto"] = $foto;

require 'template/base.php';
?>