<?php
require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "GestioniAffitti", 3306);
var_dump($dbh);
?>