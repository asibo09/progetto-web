<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "GestioneAffitti", 3306);
var_dump($dbh);
?>