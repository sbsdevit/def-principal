<?php
require('../config.app/control_functions.php');//Fichier des fonctions de contrôle
require_once('../config.app/constantes.php');
$page='Menu principal | '.NAME_PROJECT;
(is_assujetti_logedIn()) ? require_once('../views/trading/dashboard_trading.view.php')  : redirect('../index');