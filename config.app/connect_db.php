<?php
if (session_status() == PHP_SESSION_NONE)
	session_start();

if (!defined('DB_HOST'))
	define('DB_HOST', 'localhost');

if (!defined('DB_USER'))
	define('DB_USER', 'def-app');

if (!defined('DB_PW'))
	define('DB_PW', 'Sedjo120@');//Sedjo120@

if (!defined('DB_NAME'))
	define('DB_NAME', 'def_sbs');

try {
	$pdo= new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PW, array(
		PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8',
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
	);

	$dbpdo= new PDO("mysql:host=".DB_HOST, DB_USER, DB_PW, array(
		PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8',
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
	);
} catch (PDOException $e) {
	die('<h1>Impossible de se connecter à la Base de Données !</h1>
		<br><b>Source d\'erreur : </b>'.$e->getMessage()
	);
}