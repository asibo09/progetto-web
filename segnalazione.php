<?php
require_once("bootstrap.php");

// 1. Gestione del salvataggio (POST)
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["categoria"])){
    $id_segnalatore = 1; // Qui userai $_SESSION["id_utente"] quando avremo il login
    $id_alloggio = !empty($_POST["id_alloggio"]) ? $_POST["id_alloggio"] : null;
    $id_utente_target = !empty($_POST["id_utente_target"]) ? $_POST["id_utente_target"] : null;
    $categoria = $_POST["categoria"];
    $descrizione = $_POST["motivazione"];

    $successo = $dbh->insertSegnalazione($id_segnalatore, $id_alloggio, $id_utente_target, $categoria, $descrizione);
    
    if($successo){
        // Dopo il successo possiamo reindirizzare o mostrare un messaggio
        header("location: index.php?msg=SegnalazioneInviata");
        exit();
    } else {
        $templateParams["errore"] = "Errore durante l'invio.";
    }
}

// 2. Preparazione dati per il template
$templateParams["titolo"] = "Campus Housing - Segnalazione";
$templateParams["nome"] = "template/segnalazione-form.php";

// Recuperiamo i dati: se è un POST li prendiamo dai campi nascosti, se è un GET dall'URL
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $templateParams["tipo"] = !empty($_POST["id_alloggio"]) ? "annuncio" : "utente";
    $templateParams["id_bersaglio"] = $_POST["id_alloggio"] ?? $_POST["id_utente_target"];
} else {
    $templateParams["tipo"] = $_GET["tipo"] ?? ""; 
    $templateParams["id_bersaglio"] = $_GET["id"] ?? "";
}

require_once("template/base.php");
?>