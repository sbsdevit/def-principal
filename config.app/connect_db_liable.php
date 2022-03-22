<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!defined('DBHOST'))
    define('DBHOST', 'localhost');

if (!defined('DBUSER'))
    define('DBUSER', 'def-app');

if (!defined('DBPW'))
    define('DBPW', 'Sedjo120@');

if (!empty($_SESSION['NUMERODEF']))
    $defnumber =  str_replace(['/', '-'], ['', ''], $_SESSION['NUMERODEF']);
    $dbname = 'def_'.strtolower($defnumber);

    if (!defined('DBNAME'))
        define('DBNAME', $dbname);

try {
	$pdo= new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPW, array(
		PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8',
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
	);
} catch (PDOException $e) {
	die('<h1>Impossible de se connecter à la Base de Données !</h1>
		<br><b>Source d\'erreur : </b>'.$e->getMessage()
	);
}