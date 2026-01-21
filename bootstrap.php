<?php
require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "GestioneAffitti", 3306);
var_dump($dbh);
?>