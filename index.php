<?php
require('config.app/control_functions.php');//Fichier des fonctions de contrôle
require_once('config.app/constantes.php');
$page='Authenification | '.NAME_PROJECT;

if (is_assujetti_logedIn()) :
	($_SESSION['CATEGORIEASSUJETTI'] == 'pmc' || $_SESSION['CATEGORIEASSUJETTI'] == 'ppc') ? 
	redirect('trading/dashboard_trading') : redirect('corporation/dashboard_corporation');
else : require_once('views/index.view.php');
endif;