<?php
require('config.app/control_functions.php');//Fichier des fonctions de contrôle
require('config.app/connect_db.php');
require('config.app/db_functions.php');
require_once('config.app/constantes.php');
$page='Plan comptable OHADA | '.NAME_PROJECT;

(is_assujetti_logedIn()) ? require_once('views/plan_comptable.view.php')  : redirect('index');