<?php
require_once("bootstrap.php");

if (
    isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"])
    && isset($_POST["cellulare"]) && isset($_POST["eta"]) && isset($_POST["ruolo"])
) {
    $insert_registrazione = $dbh->insertUser(
        $_POST["nome"],
        $_POST["cognome"],
        $_POST["email"],
        $_POST["password"],
        $_POST["cellulare"],
        $_POST["eta"],
        $_POST["ruolo"] 
    );
    if (!$insert_registrazione) {
        //Registrazione fallita
        $templateParams["erroreRegistrazione"] = "Errore! Controllare i dati inseriti!";
    } else {
        $logRegistedUser = $dbh->checkLogin($_POST["email"], $_POST["password"]);
        registerLoggedUser($logRegistedUser[0]);
    }
}

if (isUserLoggedIn()) {
    header("Location: index.php");
    exit();
} else {
    $templateParams["titolo"] = "Registrazione";
    $templateParams["nome"] = "template/registrazioneContent.php";
}

require_once("template/base.php");

?>