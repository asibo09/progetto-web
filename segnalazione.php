<?php
require_once("bootstrap.php");

$idUtente = $_SESSION["id_utente"] ?? 3;

//Recupero dati iniziali (da GET o da POST)
$tipo = $_GET["tipo"] ?? "";
$id = $_GET["id"] ?? "";

// Se POST, i dati potrebbero essere nei campi hidden
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_alloggio = !empty($_POST["id_alloggio"]) ? $_POST["id_alloggio"] : null;
    $id_utente_target = !empty($_POST["id_utente_target"]) ? $_POST["id_utente_target"] : null;
    
    if(empty($id)) $id = $id_alloggio ?? $id_utente_target;
    if(empty($tipo)) $tipo = !empty($id_alloggio) ? "annuncio" : "utente";
}

// salvataggio
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["categoria"])){
    $id_segnalatore = 3; // in seguito usare $_SESSION["id_utente"] dopo il login
    $id_alloggio = !empty($_POST["id_alloggio"]) ? $_POST["id_alloggio"] : null;
    $id_utente_target = !empty($_POST["id_utente_target"]) ? $_POST["id_utente_target"] : null;
    $categoria = $_POST["categoria"];
    $descrizione = $_POST["motivazione"];

    $result = $dbh->insertSegnalazione($id_segnalatore, $id_alloggio, $id_utente_target, $categoria, $descrizione);

    if($result){
        $msg = "Annuncio pubblicato con successo!";
        header("location: index.php?msg=" . urlencode($msg));
    } else {
        header("location: segnalazione.php?tipo=$tipo&id=$id&error=1");
    }
    exit();
}

$templateParams["titolo"] = "Campus Housing - Segnalazione";
$templateParams["nome"] = "template/segnalazione-form.php";
$templateParams["utente"] = $dbh->getUserById($idUtente);
$templateParams["tipo"] = $tipo;
$templateParams["id_bersaglio"] = $id;

// FLAG ERRORE: se non abbiamo tipo o id
$templateParams["errore_dati"] = (empty($tipo) || empty($id));

require_once("template/base.php");
?>