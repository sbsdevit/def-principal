<?php
/*require_once('config.app/constantes.php');
require_once('jwt/jwt.class.php');
//Création de header du Token
$header = [
    'alg' => 'HS256',
    'typ' => 'JWT'
];

//Création du contenu du Token
$numerodef = 'PMC/DEF/105-C111';
$payload = [
    'numero_def'            => $numerodef,
    'categorie_assujetti'   => 'pmc'
];

$jwt = new JWT();
$token = $jwt->generateToken($header, $payload, SECRET);

echo $token;*/

// protocole utilisé : http ou https ?
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://"; else $url = "http://";
// hôte (nom de domaine voire adresse IP)
$url .= $_SERVER['HTTP_HOST'].'/';
// emplacement de la ressource (nom de la page affichée). Utiliser $_SERVER['PHP_SELF'] si vous ne voulez pas afficher les paramètres de la requête
//$url .= $_SERVER['REQUEST_URI'];
// on affiche l'URL de la page courante
//echo $url;
//echo 'http://' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'] ;

$nombre = '201';
echo $nombre[2];
?>
