<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "I miei annunci";
$templateParams["nome"] = "template/iMieiAnnunciContent.php";
$fotoAlloggio = [];

$iMieiAnnunciResult = $dbh->myApartments($_SESSION["email"]);
foreach ($iMieiAnnunciResult as $alloggio){
    $idAlloggio = $alloggio["id_alloggio"];
    $fotoAlloggio[$idAlloggio] = $dbh->getFotoByAlloggioId($idAlloggio);
}

require_once("template/base.php");

?>