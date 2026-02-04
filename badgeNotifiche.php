<?php
require_once("bootstrap.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_richiesta'], $_POST['action'])) {
    $id = (int)$_POST['id_richiesta'];
    $action = trim($_POST['action']);

    $dbh->modifica_stato_richiesta_subaffitto($id, $action);

    header('Location: badgeNotifiche.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_prenotazione'], $_POST['action_prenotazione'])) {
    $id_prenotazione = (int)$_POST['id_prenotazione'];
    $action_prenotazione = trim($_POST['action_prenotazione']);

    $dbh->modifica_stato_prenotazione($id_prenotazione, $action_prenotazione);

    header('Location: badgeNotifiche.php');
    exit();
}

$templateParams['titolo'] = "Le mie notifiche";
$templateParams['nome'] = "template/badgeNotifiche-content.php";

$templateParams['notifiche'] = $dbh->notifiche();
$templateParams['richiesteSubaffitto'] = $dbh->richieste_subaffitto($_SESSION['email']);
$templateParams['prenotazioni'] = $dbh->prenotazioni($_SESSION['email']);

require_once("template/base.php");
?>