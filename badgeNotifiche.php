<?php

session_start();
require_once("bootstrap.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_richiesta'], $_POST['action'])) {
    $id = (int)$_POST['id_richiesta'];
    $action = trim($_POST['action']);

    $dbh->modifica_stato_richiesta_subaffitto($id, $action);

    header('Location: badgeNotifiche.php');
    exit();
}
// ...existing code...
$templateParams['titolo'] = "Le tue notifiche";
$templateParams['nome'] = "template/badgeNotifiche-content.php";

$templateParams['notifiche'] = $dbh->notifiche();
$templateParams['richiesteSubaffitto'] = $dbh->richieste_subaffitto("luigi.prop@email.com");

require_once("template/base.php");
?>