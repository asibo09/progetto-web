<?php
require_once("bootstrap.php");
$templateParams["nome"] = "template/messaggiBroadcastContent.php";

if (isset($_POST["messaggio"])) {
    $insertMessage = $dbh->insertMessage($_SESSION["id_utente"], $_POST["messaggio"]);
    if (!$insertMessage) {
        $templateParams["erroreMessaggio"] = "Errore, il messaggio non è stato mandato";
    } else {

    }
}

require_once("template/base.php");
?>