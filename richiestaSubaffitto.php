<?php

//session_start();
require_once("bootstrap.php");

$templateParams["titolo"] = "Richiesta Subaffitto";
$templateParams["nome"] = "template/richiestaSubaffitto-content.php";

$templateParams["stanze"] = $dbh->trova_stanze_utente_per_subaffitto("marco.stud@email.com");
//$templateParams['stanze'] = $dbh->trova_stanze_utente_per_subaffitto($_SESSION['email']);

//$dbh->richiedi_subaffitto_stanza($_SESSION['id_utente'], $_POST['stanza'], $_POST['messaggioProprietario']);

require_once("template/base.php");



?>