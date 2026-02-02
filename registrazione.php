<?php
require_once("bootstrap.php");

if (
    isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["password"])
    && isset($_POST["cellulare"]) && isset($_POST["eta"]) && isset($_POST["ruolo"])
) {
    $nome = trim($_POST["nome"]);
    $cognome = trim($_POST["cognome"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $cellulare = trim($_POST["cellulare"]);
    $eta = trim($_POST["eta"]);
    $ruolo = trim($_POST["ruolo"]);

    $insert_registrazione = $dbh->insertUser(
        $nome,
        $cognome,
        $email,
        $password,
        $cellulare,
        $eta,
        $ruolo 
    );
    if (!$insert_registrazione) {
        //Registrazione fallita
        $templateParams["erroreRegistrazione"] = "Errore! Controllare i dati inseriti!";
    } else {
        $logRegistedUser = $dbh->checkLogin($email, $password);
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