<?php
require('config.app/control_functions.php');//Fichier des fonctions de contrôle
require('config.app/connect_db.php');//Fichier du chemin de la base
require('config.app/db_functions.php');//Fichier des fonctions nécessitant la cnx à la base

//Vérifie si l'Id recherché existe dans la base
function findIdByfilter($table, $fieldname, $fieldvalue){
    $row = one_filter_count_sql('id', $table, $fieldname, array($fieldvalue));
    return ($row > 0) ? true : false;
}

//Vérifie si l'Id est déjà utilisé dans la table personne_morale_commercante ou non_commercante
function isUsedId($fieldname, $fieldvalue){
    $rowpmc = one_filter_count_sql('numero_def', 'personne_morale_commercante', $fieldname, array($fieldvalue));
    $rowppc = one_filter_count_sql('numero_def', 'personne_physique_commercante', $fieldname, array($fieldvalue));
    if ($rowpmc>0 || $rowppc>0) :
        return true;
    else :
        if ($fieldname !='num_rccm') :
            $rowpmnc = one_filter_count_sql('numero_def', 'personne_morale_non_commercante', $fieldname, array($fieldvalue));
            return ($rowpmnc > 0) ? true : false;
        else : $rowpmnc = 0;
        endif;
    endif;        
}

//Renvoie le message d'erreur du controle de la saisie
function validationError ($msg){
    $validation='<span class="validation label-danger label-white middle">
                    <i class="ace-icon fa fa-times bigger-120"></i>'.$msg.'
                    </span>';
    return $validation;
}

//Renvoie le message de succès du controle de la saisie
function validationSuccess ($msg){
    $validation='<span class="validation label-success label-white middle">
                    <i class="ace-icon fa fa-check bigger-120"></i>'.$msg.'
                    </span>';
    return $validation;
}

if (isset($_POST['action']))
    extract($_POST);

    $insertOutput=array(); $insertOutput['failure']=''; $insertOutput['success']='';
    $insertOutput['numdef']=''; $insertOutput['defaultpw']='';

    //Enregisrement de données des assujettis dans les tables Personnes Morales Commeçantes
    if ($action == 'Insert_Personne_Morale_Com') :
        if (not_empty(array($raisonSociale, $sigle, $lieuCreation, $dateCreation, $rccm, $nidNational, $nif, $typeSociete, 
                            $siegeScoial, $siegeExploitation, $nbreEmploye, $placeEntreprise, $secteurActivite, $typeActivite, $telephoneEntreprise))) :
            $insert="INSERT INTO personne_morale_commercante (
                numero_def, code_type_societe, code_secteur_activite, num_rccm, num_id_nat, num_nif, raison_sociale, sigle, 
                lieu_creation, date_creation, siege_social_admin, siege_exploitation, nbre_employe, place_entreprise, 
                type_activite, telephone_entreprise, email_entreprise) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $insert_auth = "INSERT INTO auth_assujetti (numero_def,categorie_assujetti) VALUES (?, ?)";

            $threelastdigit = substr(escape($telephoneEntreprise), -3); $firstletter= strtoupper(escape($sigle[0]));
            $jour = getDigitDay();
            $incrementedrow = count_sql('numero_def', 'personne_morale_commercante') + 1;
            $defformat = 'PMC/DEF/'.$incrementedrow.''.$jour.'-'.$firstletter.''.$threelastdigit;
            $defaultpw = 'PMC'.$threelastdigit;
            
            if (!empty($emailEntreprise) && !filter_var($emailEntreprise, FILTER_VALIDATE_EMAIL)) : $insertOutput['failure'] = 'Adresse email invalide';
            elseif (findIdByfilter('registre_commerce', 'rccm', $rccm) == false) : $insertOutput['failure'] = 'N° RCCM invalide';
            elseif (isUsedId('num_rccm', $rccm) == true) : $insertOutput['failure'] = 'N° RCCM déjà utilisé';
            elseif (findIdByfilter('identification_national', 'id_nat', $nidNational) == false) : $insertOutput['failure'] = 'N° ID National invalide';
            elseif (isUsedId('num_id_nat', $nidNational) == true) : $insertOutput['failure'] = 'N° ID National déjà utilisé';
            elseif (findIdByfilter('numero_impot', 'nif', $nif) == false) : $insertOutput['failure'] = 'N° Impôt (NIF) invalide';
            elseif (isUsedId('num_nif', $nif) == true) : $insertOutput['failure'] = 'N° Impôt (NIF) déjà utilisé';
            elseif (!is_numeric($nbreEmploye)) : $insertOutput['failure'] = 'Le champ Nombre d\'employé n\'accepte que le numérique';
            else :
                $placeholders=array($defformat, escape($typeSociete), escape($secteurActivite), escape($rccm), escape($nidNational), 
                                    escape($nif), strtoupper(escape($raisonSociale)), strtoupper(escape($sigle)), escape($lieuCreation), 
                                    escape($dateCreation), escape($siegeScoial), escape($siegeExploitation), escape($nbreEmploye), 
                                    escape($placeEntreprise), escape($typeActivite), escape($telephoneEntreprise), escape($emailEntreprise));
                $placeholders_auth =array($defformat, 'Personne morale commerçante');

                //Nom de la base de données de l'assujetti en cours de création
                $defnumber =  str_replace(['/', '-'], ['', ''], $defformat);
                $dbname = 'def_'.strtolower($defnumber); 

                //Requête de cration de la base de données
                $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
                $dbpdo->exec($sql);

                //Inclusion du fichier de la création de la base de données
                require('config.app/create_db_liable.php');

                if (insertUpdateDelete($insert, $placeholders)) 
                    if (insertUpdateDelete($insert_auth, $placeholders_auth))
                        $insertOutput['success'] = 'ok';
                        $insertOutput['numdef'] = $defformat;
                        $insertOutput['defaultpw'] = $defaultpw;

                        //On crée la base de données
                        $teleponeAdmin = str_replace(['(', ')'], ['', ''], escape($telephoneEntreprise));
                        connect_db_liable($dbname, $teleponeAdmin, $defaultpw);
            endif;
        else :
            $insertOutput['failure'] = 'Tous les champs portant (*) sont requis. Prière de les renseigner tous !';
        endif;

        echo json_encode($insertOutput);

    //Enregisrement de données des assujettis dans les tables Personnes Morales Non Commeçantes
    elseif ($action == 'Insert_Personne_Morale_Non_Com') :
        if (not_empty(array($secteurActivite, $nomsResponsable, $nationaliteResponsable, $fonctionResponsable, $numeroAutorisationFonctionnement, 
                            $nidNational, $nif, $siegeScoial, $siegeAdministratif, $siegeExploitation, $telephoneEntreprise))):
            $insert="INSERT INTO personne_morale_non_commercante (
                numero_def, code_secteur_activite, num_id_nat, num_nif, noms_responsable, nationalite, fonction, noms_representant,
                accord_siege, autorisation_fonction, siege_social, siege_administratif, siege_exploitation, telephone_entreprise, 
                email_entreprise) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $insert_auth = "INSERT INTO auth_assujetti (numero_def,categorie_assujetti, motdepasse_assujetti) VALUES (?, ?, ?)";

            $threelastdigit = substr(escape($telephoneEntreprise), -3); $firstletter= strtoupper(escape($nomsResponsable[0]));
            $jour = getDigitDay();
            $incrementedrow = count_sql('numero_def', 'personne_morale_non_commercante') + 1;
            $defformat = 'PMNC/DEF/'.$incrementedrow.''.$jour.'-'.$firstletter.''.$threelastdigit;
            $defaultpw = 'PMNC'.$threelastdigit;

            if (!empty($emailEntreprise) && !filter_var($emailEntreprise, FILTER_VALIDATE_EMAIL)) : $insertOutput['failure'] = 'Adresse email invalide';
            elseif (findIdByfilter('identification_national', 'id_nat', $nidNational) == false) : $insertOutput['failure'] = 'N° ID National invalide';
            elseif (isUsedId('num_id_nat', $nidNational) == true) : $insertOutput['failure'] = 'N° ID National déjà utilisé';
            elseif (findIdByfilter('numero_impot', 'nif', $nif) == false) : $insertOutput['failure'] = 'N° Impôt (NIF) invalide';
            elseif (isUsedId('num_nif', $nif) == true) : $insertOutput['failure'] = 'N° Impôt (NIF) déjà utilisé';
            else :
                $placeholders=array($defformat, escape($secteurActivite), escape($nidNational), escape($nif), 
                                    escape($nomsResponsable), escape($nationaliteResponsable), escape($fonctionResponsable), 
                                    escape($nomsRepresentant), escape($numeroAccordSiege), escape($numeroAutorisationFonctionnement),
                                    escape($siegeScoial), escape($siegeAdministratif), escape($siegeExploitation), escape($telephoneEntreprise), escape($emailEntreprise));
                $placeholders_auth =array($defformat, 'Personne morale non commerçante', bcrypt_hash_password($defaultpw));

                if (insertUpdateDelete($insert, $placeholders)) 
                    if (insertUpdateDelete($insert_auth, $placeholders_auth))
                        $insertOutput['success'] = 'ok';
                        $insertOutput['numdef'] = $defformat;
                        $insertOutput['defaultpw'] = $defaultpw;
            endif;
        else :
            $insertOutput['failure'] = 'Tous les champs portant (*) sont requis. Prière de les renseigner tous !';
        endif;

        echo json_encode($insertOutput);
    
    //Enregisrement de données des assujettis dans les tables Personnes Physiques Commeçantes
    elseif ($action == 'Insert_Personne_Physique_Com') :
        if (not_empty(array($profession, $secteurActivite, $rccm, $nidNational, $nif, $nomsAssujetti, 
            $sexe, $etatCivil, $lieuNaissance, $dateNaissance, $numeroCarteIdentite, $domicile, $adresseActivite, $nomsResponsable, 
            $nationaliteResponsable, $fonctionResponsable, $siegeScoial, $siegeExploitation, $telephoneAssujetti))):
            $insert="INSERT INTO personne_physique_commercante (
                numero_def, code_professsion_assujetti, code_profession_conjoint, code_secteur_activite, num_rccm, num_id_nat, 
                num_nif, noms_assujetti, code_sexe, etat_civil, lieu_naissance, date_naissance, numero_carte_identite, domicile_assujetti, 
                adresse_activite, noms_responsable, nationalite_responsable, fonction_responsable, noms_conjoint, type_mariage, 
                regime_matrimonial, siege_social_admin, siege_exploitation, telephone_assujetti, email_assujetti) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $insert_auth = "INSERT INTO auth_assujetti (numero_def, categorie_assujetti, motdepasse_assujetti) VALUES (?, ?, ?)";

            $threelastdigit = substr(escape($telephoneAssujetti), -3); $firstletter= strtoupper(escape($nomsAssujetti[0]));
            $jour = getDigitDay();
            $incrementedrow = count_sql('numero_def', 'personne_physique_commercante') + 1;
            $defformat = 'PPC/DEF/'.$incrementedrow.''.$jour.'-'.$firstletter.''.$threelastdigit;
            $defaultpw = 'PPC'.$threelastdigit;

            if (!empty($emailAssujetti) && !filter_var($emailAssujetti, FILTER_VALIDATE_EMAIL)) : $insertOutput['failure'] = 'Adresse email invalide';
            elseif (findIdByfilter('registre_commerce', 'rccm', $rccm) == false) : $insertOutput['failure'] = 'N° RCCM invalide';
            elseif (isUsedId('num_rccm', $rccm) == true) : $insertOutput['failure'] = 'N° RCCM déjà utilisé';
            elseif (findIdByfilter('identification_national', 'id_nat', $nidNational) == false) : $insertOutput['failure'] = 'N° ID National invalide';
            elseif (isUsedId('num_id_nat', $nidNational) == true) : $insertOutput['failure'] = 'N° ID National déjà utilisé';
            elseif (findIdByfilter('numero_impot', 'nif', $nif) == false) : $insertOutput['failure'] = 'N° Impôt (NIF) invalide';
            elseif (isUsedId('num_nif', $nif) == true) : $insertOutput['failure'] = 'N° Impôt (NIF) déjà utilisé';
            else :
                $placeholders=array($defformat, escape($profession), escape($professionConjoint), escape($secteurActivite), 
                                    escape($rccm), escape($nidNational), escape($nif), escape($nomsAssujetti), escape($sexe),
                                    escape($etatCivil), escape($lieuNaissance), escape($dateNaissance), escape($numeroCarteIdentite),
                                    escape($domicile), escape($adresseActivite), escape($nomsResponsable), escape($nationaliteResponsable), 
                                    escape($fonctionResponsable), escape($nomsConjoint), escape($typeMariage), escape($regimeMatrimonial), 
                                    escape($siegeScoial), escape($siegeExploitation), escape($telephoneAssujetti), escape($emailAssujetti));
                $placeholders_auth =array($defformat, 'Personne physique commerçante', bcrypt_hash_password($defaultpw));

                if (insertUpdateDelete($insert, $placeholders)) 
                    if (insertUpdateDelete($insert_auth, $placeholders_auth))
                        $insertOutput['success'] = 'ok';
                        $insertOutput['numdef'] = $defformat;
                        $insertOutput['defaultpw'] = $defaultpw;
            endif;
        else :
            $insertOutput['failure'] = 'Tous les champs portant (*) sont requis. Prière de les renseigner tous !';
        endif;

        echo json_encode($insertOutput);
    
        //Enregisrement de données des assujettis dans les tables Personnes Physiques Non Commeçantes
    elseif ($action == 'Insert_Personne_Physique_Non_Com') :
        if (not_empty(array($profession, $nomsAssujetti, $sexe, $etatCivil, $lieuNaissance, $dateNaissance, $numeroCarteIdentite, 
            $domicile, $adresseActivite, $telephoneAssujetti))):
            $insert="INSERT INTO personne_physique_non_commercante (
                numero_def, code_professsion_assujetti, code_profession_conjoint, noms_assujetti, code_sexe, etat_civil, 
                lieu_naissance, date_naissance, numero_carte_identite, domicile_assujetti, adresse_activite, noms_conjoint, 
                type_mariage, regime_matrimonial, telephone_assujetti, email_assujetti) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $insert_auth = "INSERT INTO auth_assujetti (numero_def, categorie_assujetti, motdepasse_assujetti) VALUES (?, ?, ?)";

            $threelastdigit = substr(escape($telephoneAssujetti), -3); $firstletter= strtoupper(escape($nomsAssujetti[0]));
            $jour = getDigitDay();
            $incrementedrow = count_sql('numero_def', 'personne_physique_non_commercante') + 1;
            $defformat = 'PPNC/DEF/'.$incrementedrow.''.$jour.'-'.$firstletter.''.$threelastdigit;
            $defaultpw = 'PPNC'.$threelastdigit;

            if (!empty($emailAssujetti) && !filter_var($emailAssujetti, FILTER_VALIDATE_EMAIL)) : 
                $insertOutput['failure'] = 'Adresse email invalide';
            else :
                $placeholders=array($defformat, escape($profession), escape($professionConjoint), escape($nomsAssujetti), 
                                    escape($sexe), escape($etatCivil), escape($lieuNaissance), escape($dateNaissance), 
                                    escape($numeroCarteIdentite), escape($domicile), escape($adresseActivite), escape($nomsConjoint), 
                                    escape($typeMariage), escape($regimeMatrimonial), escape($telephoneAssujetti), escape($emailAssujetti));
                $placeholders_auth =array($defformat, 'Personne physique non commerçante', bcrypt_hash_password($defaultpw));

                if (insertUpdateDelete($insert, $placeholders)) 
                    if (insertUpdateDelete($insert_auth, $placeholders_auth))
                        $insertOutput['success'] = 'ok';
                        $insertOutput['numdef'] = $defformat;
                        $insertOutput['defaultpw'] = $defaultpw;
            endif;
        else :
            $insertOutput['failure'] = 'Tous les champs portant (*) sont requis. Prière de les renseigner tous !';
        endif;

        echo json_encode($insertOutput);
    //Validation de la saisie
    elseif ($action == 'check') :
        if ($key == 'rccm') :       
            if (findIdByfilter('registre_commerce', 'rccm', escape($inputPost)) == true) :
                (isUsedId('num_rccm', escape($inputPost)) == true) ? $result = validationError ('N° RCCM déjà utilisé') 
                                                           : $result = validationSuccess('N° RCCM valide');
            else : $result = $result = validationError ('N° RCCM invalide');
            endif;
        elseif ($key == 'idnat') :
            if (findIdByfilter('identification_national', 'id_nat', escape($inputPost)) == true) :
                (isUsedId('num_id_nat', escape($inputPost)) == true) ? $result = validationError ('N° ID National déjà utilisé') 
                                                             : $result = validationSuccess('N° ID National valide');
            else : $result = validationError ('N° ID National invalide');
            endif;
        elseif ($key == 'nif') :
            if (findIdByfilter('numero_impot', 'nif', escape($inputPost)) == true) :
                (isUsedId('num_nif', escape($inputPost)) == true) ? $result = validationError ('N° Impôt déjà utilisé') 
                                                          : $result = validationSuccess('N° Impôt valide');
            else : $result = validationError ('N° Impôt invalide');
            endif;
        elseif ($key == 'email') :
            (!filter_var(escape($inputPost), FILTER_VALIDATE_EMAIL)) ? $result = validationError ('Adresse email invalide')
                                                             : $result = validationSuccess ('Adresse email valide'); 
        else :
        endif;

        echo $result;
    endif;