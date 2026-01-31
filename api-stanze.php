<?php
require_once 'bootstrap.php';

$idAlloggio = $_GET["id"] ?? null;
$stanze = [];

if($idAlloggio) {
    // Usiamo il metodo del DB per prendere solo le stanze disponibili
    $stanze = $dbh->getStanzeDisponibiliByAlloggio($idAlloggio);
}

header('Content-Type: application/json');
echo json_encode($stanze);
?>