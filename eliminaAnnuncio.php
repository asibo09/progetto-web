<?php
require_once("bootstrap.php");

if(isset($_GET["id"])){
    $dbh->eliminaAlloggio($_GET["id"]);
}

header("Location: iMieiAnnunci.php");
exit();
?>