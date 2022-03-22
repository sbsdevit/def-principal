<?php session_start();
//Hashage du mot de passe avec l'algorithme BCRYPT
function bcrypt_hash_password($password, $options=array()){
	$cost = isset($options['rounds']) ? $options['rounds'] : 10;
	$hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => $cost));

	if($hash === false) throw new Exception("BCRYPT n'est pas supporté pour le hachage dans votre serveur", 1);

	return $hash;
}

//Matching du mot de passe brut à celui hashé
function bcrypt_verify_password($password, $hashedpassword){
	return password_verify($password, $hashedpassword);
}

//Vérifie si un assujetti est connécté
function is_assujetti_logedIn(){
	return (!empty($_SESSION['NUMERODEF']) && !empty($_SESSION['IDUSER'])) ? true : false;
}

//Vérifie si tous les champs requis sont remplis
function not_empty($fields=array()){
	if (count($fields) != 0)
		foreach ($fields as $field) {
			if (empty($field) || trim($field)=='') return false;
		}
		return true;
}

//Echappe les caractères avant l'insertion de données
function escape($string){
	if (isset($string)) return htmlspecialchars(strip_tags(trim($string)));
}

//Redirige vers une autre page
function redirect($page){
	header('location:'.$page.'.php');
	exit;
}

//Notification sur formulaire
function get_alert_full($type, $message, $btn='oui', $action=''){
	($type=='success') ? $faicon='fa-check' : $faicon='fa-exclamation-triangle'; 
	($type=='success') ? $titre=' Success ! <br>' : $titre=' Oups... ! <br>';
	
	$alert='<div class="alert alert-'.$type.'" tabindex="-1">';
			if ($btn =='oui')
				$alert.='<button type="button" class="close close-alert" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				</button>';

			$alert.='<strong><i class="ace-icon fa '.$faicon.'"></i>'.$titre.'</strong>'.$message.' ';

			if ($action=='spring')
				$alert.='<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i>';
			
			$alert.='</div>';

	return $alert;
}

//Revoie l'url du serveur
function getServerUrl(){
	// protocole utilisé : http ou https ?
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
	// hôte (nom de domaine voire adresse IP)
	$url .= $_SERVER['HTTP_HOST'].'/';
	return $url;
}

//Obtenir l'adresse du client
function getIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) :
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) :
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else : $ip = $_SERVER['REMOTE_ADDR'];
    endif;
    
    return $ip;
}

//Renvoie le jour
function getDigitDay(){return $date=date('d');}