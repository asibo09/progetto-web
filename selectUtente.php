<?php
require_once("bootstrap.php");


if($_SESSION["ruolo"] == "studente"){
    header("location: utente.php");
    exit();
}
else if ($_SESSION["ruolo"] == "proprietario") {
    header("location: proprietario.php");
    exit();
} else if ($_SESSION["ruolo"] == "admin") {
    header("location: profilo-admin.php");
    exit();
}
 else {
    header("location: login.php");
    exit();
}
?>