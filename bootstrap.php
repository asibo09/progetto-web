<?php
// Avvia sessione in modo sicuro prima di includere altri file
//serve per utilizzare $_SESSION['user_id'] che e l'utente usato in alcune query
ini_set('session.use_only_cookies', 1);
session_set_cookie_params([
	'lifetime' => 0,
	'path' => '/',
	'domain' => '',
	'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
	'httponly' => true,
	'samesite' => 'Lax'
]);
session_start();

require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "AffittiUnibo", 3306);
?>