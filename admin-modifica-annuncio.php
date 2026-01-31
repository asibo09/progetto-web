<?php
require_once 'bootstrap.php';

//Controllo sicurezza Admin
if(!isUserLoggedInID() || $_SESSION["ruolo"] != 'admin'){
    header("location: login.php");
    exit();
}

$templateParams["back_link"] = "admin-index.php";

$templateParams["nome"] = "admin-modifica-annuncio-content.php";
$templateParams["azione"] = "modifica";

$idAlloggio = $_GET["id"];
$templateParams["titolo"] = "Modifica annuncio";
$templateParams["annuncio"] = $dbh->getFullAnnuncioById($idAlloggio);

require 'template/base.php';
?>