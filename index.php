<?php
require_once("bootstrap.php");

$templateParams = [];
$templateParams["titolo"] = "Home";
$templateParams["nome"] = "template/index-content.php";

if(isset($_SESSION["email"])){
    $templateParams["lastSearches"] = $dbh->lastFourSearch($_SESSION["id_utente"]);
    $templateParams['isLogged'] = "Continua la Ricerca";
}



require_once("template/base.php");
?>
