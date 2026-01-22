<?php
session_start();
require_once("db/database.php");
require_once("utils/functions.php");

$dbh = new DatabaseHelper("localhost", "root", "", "GestioneAffitti", 3306);
//var_dump($dbh);
?>