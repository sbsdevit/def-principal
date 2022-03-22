<?php require('config.app/control_functions.php');

if (isset($_SESSION))
	session_destroy();
	$_SESSION[]=array();
	redirect('index');
