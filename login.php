<?php
require_once("bootstrap.php");

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
    if (count($login_result) == 0) {
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    } else {
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn() && $login_result[0]['ruolo'] == "admin"){
    header("Location: admin-index.php");
    exit();
}


if (isUserLoggedIn()) {
    header("Location: index.php");
    exit();
} else {
    $templateParams["titolo"] = "Login";
    $templateParams["nome"] = "loginContent.php";
}
require_once("template/base.php");

?>