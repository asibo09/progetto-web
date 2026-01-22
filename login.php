<?php
require_once("bootstrap.php");

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $login_result = $dbh->checkLogin($email, $password);
    if (count($login_result) == 0) {
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    } else {
        registerLoggedUser($login_result[0]);
    }
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