<?php
require('config.app/control_functions.php');//Inclut le fichier functions
require_once('config.app/constantes.php');
require_once('jwt/jwt.class.php');

function select_fetch($sql, $data=array()){
    require('config.app/connect_db.php');
	$req=$pdo->prepare($sql); $req->execute($data);
	$row=$req->fetch(PDO::FETCH_OBJ);
	$req->closeCursor();

	return $row;
}

function get_field_by_filter($field, $table, $filter, $data=array()){
	$req=select_fetch("SELECT $field FROM $table WHERE $filter=?", $data);
	return $req->$field;
}

function _select_fetch($sql, $data=array()){
    require('config.app/connect_db_liable.php');
	$req=$pdo->prepare($sql); $req->execute($data);
	$row=$req->fetch(PDO::FETCH_OBJ);
	$req->closeCursor();

	return $row;
}

function _insertUpdateDelete($sql, $data=array()){
    require('config.app/connect_db_liable.php');
	$query=$pdo->prepare($sql); $query->execute($data);
	return $query->rowCount();
}

if (isset($_POST['action']))
    extract($_POST);

    $output=array(); $output['failure']=''; $output['success']='';
    $output['typeActivite']=''; $output['categorieAssujetti']='';
    $typeActivite = '';

    //Connexion à la base
    if ($action == 'loginAssujetti') :
        if (not_empty(array($numerodef, $motdepasse, $iduser))) :
            $assujetti = select_fetch("SELECT * FROM auth_assujetti WHERE numero_def=:numerodef", array(':numerodef'=>escape($numerodef)));
            if ($assujetti) :
                $_SESSION['NUMERODEF'] = escape($assujetti->numero_def);
                $user = _select_fetch("SELECT * FROM agents WHERE matricule=:iduser OR telephone=:iduser OR nomsession=:iduser", array(':iduser'=>escape($iduser)));
                if ($user) :
                    if (bcrypt_verify_password(escape($motdepasse), escape($user->motdepasse))) :
                        $categorieAssujetti = escape($assujetti->categorie_assujetti);
                        if ($categorieAssujetti == 'Personne morale commerçante') :
                            $typeActivite = get_field_by_filter('type_activite', 'personne_morale_commercante', 'numero_def', array(escape($numerodef)));
                            $nomassujetti = get_field_by_filter('raison_sociale', 'personne_morale_commercante', 'numero_def', array(escape($numerodef)));
                        endif;

                        if ($categorieAssujetti == 'Personne morale commerçante') : $cat_assujetti = 'pmc';
                        elseif ($categorieAssujetti == 'Personne morale non commerçante') : $cat_assujetti = 'pmnc';
                        elseif ($categorieAssujetti == 'Personne physique commerçante') : $cat_assujetti = 'ppc';
                        endif;

                        $_SESSION['IDUSER'] = $iduser;
                        $_SESSION['TYPEACTIVITE'] = $typeActivite;
                        $_SESSION['CATEGORIEASSUJETTI'] = $cat_assujetti;
                        $_SESSION['NOMASSUJETTI'] = $nomassujetti;

                        /*Ceci concerne la génération et l'insertion du token*/

                        //Création de header du Token
                        $header = [
                            'alg' => 'HS256',
                            'typ' => 'JWT'
                        ];
                        //Création du contenu du Token
                        $payload = [
                            'numero_def'            => $assujetti->numero_def,
                            'id_user'               => $iduser,
                            'categorie_assujetti'   => $cat_assujetti
                        ];

                        $jwt = new JWT();
                        $token = $jwt->generateToken($header, $payload, SECRET);

                        $insert_auth = "INSERT INTO auth_token (user_token) VALUES (?)";
                        $placeholders_auth =array($token);
                        _insertUpdateDelete($insert_auth, $placeholders_auth);

                        /*Fin opération de la génération et de l'insertion du token*/

                        $output["success"] = get_alert_full('success', 'Connexion réussie, redirection...', 'non', 'spring');
                        $output['categorieAssujetti'] = $cat_assujetti;
                        
                    else : $output["failure"] = 'Pas d\'accès ! Le mot de passe saisi est incorrect.';
                    endif;
                else : $output["failure"] = 'Identifiant de l\'utilisateur non reconnu.';
                endif;
            else : $output["failure"]='Numéro DEF non trouvé ! Prière de revoir votre saisie de données.';
            endif;
        else: 
            $output['failure'] = 'Tous les champs portant (*) sont requis. Prière de les renseigner tous !';
        endif;
        echo json_encode($output);

    elseif ($action == 'loginUser') :
    endif;