<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Richiesta Subaffitto";
$templateParams["nome"] = "template/richiestaSubaffitto-content.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stanza'], $_POST['messaggioProprietario'])) {
    $id = (int)$_POST['stanza'];
    $messaggio = trim($_POST['messaggioProprietario']);
    
    $dbh->richiedi_subaffitto_stanza($_SESSION['id_utente'], $id, $messaggio);

    header('Location: badgeNotifiche.php');
    exit();
}
$templateParams['stanze'] = $dbh->trova_stanze_utente_per_subaffitto($_SESSION['email']);

require_once("template/base.php");
?>