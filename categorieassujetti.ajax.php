<?php 
if (isset($_POST['categorieAssujetti']))
    extract($_POST);
    require('config.app/connect_db.php');
    require('config.app/db_functions.php');//Inclut le fichier functions

    if ($categorieAssujetti == 'PersonneMoraleCommerçante') :
        ob_start();
    ?>
        <div class="col-md-10 col-md-offset-1 personne-morale-commercante">
            <div class="page-header">
                <h1 class="text-center" style="margin-top: -20px;">
                    Vous êtes une Personne morale commerçante
                </h1>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="raisonSociale" placeholder="Nom de l'Ese...">
                    <label for="raisonSociale">Raison sociale (Nom de la société) <span class="required">*</span></label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="sigle" placeholder="Votre sigle...">
                            <label for="sigle">Sigle de la société <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lieuCreation" placeholder="Lieu de création">
                            <label for="lieuCreation">Lieu de création <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control input-mask-date" id="dateCreation" placeholder="Date de création">
                            <label for="dateCreation">Date de création <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="rccm" placeholder="RCCM">
                            <label for="rccm">N° RCCM <span class="required">*</span></label>
                            <small id="validation-rccm"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nidNational" placeholder="ID National">
                            <label for="nidNational">N° ID National <span class="required">*</span></label>
                            <small id="validation-idnat"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nif" placeholder="NIF">
                            <label for="nif">N° Impôt (NIF) <span class="required">*</span></label>
                            <small id="validation-nif"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="typeSociete" aria-label="Floating label select example">
                                <?= loadDefaultCombobox('type_societe', 'code_type_societe', 'designation_type_societe'); ?>
                            </select>
                            <label for="typeSociete">Le type de la société <span class="required">*</span></label>
                        </div>					
                    </div>
                </div>
                <div class="row" style="border:1px solid #ccc;margin:0px">
                    <div class="control-group">
                        <label class="control-label" style="color: #393939;">Type d'activité <span class="required">*</span></label>
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    <input name="typeActivite" type="radio" value="Ventes des biens" class="ace typeActivite" />
                                    <span class="lbl"> Ventes des biens</span>
                                </label>
                            </div>

                            <div class="col-md-6">
                                <label>
                                    <input name="typeActivite" type="radio" value="Ventes des services" class="ace typeActivite" />
                                    <span class="lbl"> Ventes des services</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="siegeScoial" placeholder="Siège social...">
                    <label for="siegeSocial">Siège social et administratif (Av. N°/Q./C./Ville) <span class="required">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="siegeExploitation" placeholder="Siège d'exploitation...">
                    <label for="siegeExploitation">Siège d'exploitation (Nombre et lieu) <span class="required">*</span></label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nbreEmploye" placeholder="Nombre d'employé...">
                            <label for="nbreEmploye">Nombre d'employé <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="placeEntreprise" aria-label="Floating label select example">
                                <option value=""></option>
                                <option value="Importateur">Importateur</option>
                                <option value="Grossiste">Grossiste</option>
                                <option value="Demi-Grossiste">Demi-Grossiste</option>
                                <option value="Détaillant">Détaillant</option>
                            </select>
                            <label for="placeEntreprise">Place de l'entreprise... <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" id="secteurActivite" aria-label="Floating label select example">
                                <?= loadDefaultCombobox('secteur_activite', 'code_secteur_activite', 'designation_secteur_activite'); ?>
                            </select>
                            <label for="secteurActivite">Sélectionner le secteur d'activité de l'entreprise.... <span class="required">*</span></label>
                        </div>					
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telephoneEntreprise" placeholder="Contact...">
                            <label for="telephoneEntreprise">Téléphone (+243)8994... <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="emailEntreprise" placeholder="Email...">
                            <label for="emailEntreprise">Email de l'entreprise</label>
                            <small id="validation-email"></small>
                        </div>
                    </div>
                </div>
                <div class="row" style="border:1px solid #ccc;margin:0px">
                    <div class="alert alert-info">
                        <strong><i class="fa fa-info-circle"></i></strong>
                        Les champs portant (<span class="required">*</span>) sont requis.<br>
                        <strong><i class="fa fa-info-circle"></i></strong>
                        Les touches de direction Gauche et Droite de votre clavier sont des raccourcis des boutons Précédent et Suivant.
                    </div>
                </div>
            </div>
        </div>
    <?php
        $contentMoraleCommercant=ob_get_clean(); 
        echo $contentMoraleCommercant;   
    elseif ($categorieAssujetti == 'PersonneMoraleNonCommerçante') :
        ob_start();
    ?>
        <div class="col-md-10 col-md-offset-1 personne-morale-non-commercante">
            <div class="page-header">
                <h1 class="text-center" style="margin-top: -20px;">
                    Vous êtes une Personne morale non commerçante
                </h1>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" id="secteurActivite" aria-label="Floating label select example">
                                <?= loadDefaultCombobox('secteur_activite', 'code_secteur_activite', 'designation_secteur_activite'); ?>
                            </select>
                            <label for="secteurActivite">Secteur d'activité.... <span class="required">*</span></label>
                        </div>					
                    </div>
                </div>					
                <div class="row" style="margin-top:10px">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomsResponsable" placeholder="Votre nom...">
                            <label for="nomsResponsable">Nom complet du responsable <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nationaliteResponsable" placeholder="Votre nationalité...">
                            <label for="nationaliteResponsable">Nationalité <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fonctionResponsable" placeholder="Votre fonction...">
                            <label for="fonctionResponsable">Fonction du responsable <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomsRepresentant" placeholder="Nom représentant...">
                            <label for="nomsRepresentant">Nom complet du représentant <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="numeroAccordSiege" placeholder="Numéro accord...">
                            <label for="numeroAccordSiege">N° accord de siège <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="numeroAutorisationFonctionnement" placeholder="Numéro autorisation...">
                            <label for="numeroAutorisationFonctionnement">N° Autorisation de fonctionnement <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nif" placeholder="NIF">
                            <label for="nif">N° Impôt (NIF) <span class="required">*</span></label>
                            <small id="validation-nif"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nidNational" placeholder="ID National">
                            <label for="nidNational">N° ID National <span class="required">*</span></label>
                            <small id="validation-idnat"></small>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="siegeScoial" placeholder="Siège social...">
                    <label for="siegeSocial">Siège social (Av. N°/Q./C./Ville) <span class="required">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="siegeAdministratif" placeholder="Siège social...">
                    <label for="siegeAdministratif">Siège administratif (Av. N°/Q./C./Ville) <span class="required">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="siegeExploitation" placeholder="Siège d'exploitation...">
                    <label for="siegeExploitation">Siège d'exploitation (Nombre et lieu) <span class="required">*</span></label>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telephoneEntreprise" placeholder="Contact...">
                            <label for="telephoneEntreprise">Téléphone (+243)89949... <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="emailEntreprise" placeholder="Email...">
                            <label for="emailEntreprise">Email de l'entité</label>
                            <small id="validation-email"></small>
                        </div>
                    </div>
                </div>
                <div class="row" style="border:1px solid #ccc;margin:0px">
                    <div class="alert alert-info">
                        <strong><i class="fa fa-info-circle"></i></strong>
                        Les champs portant (<span class="required">*</span>) sont requis.<br>
                        <strong><i class="fa fa-info-circle"></i></strong>
                        Les touches de direction Gauche et Droite de votre clavier sont des raccourcis des boutons Précédent et Suivant.
                    </div>
                </div>
            </div>
        </div>
    <?php
        $contentMoraleNonCommercant=ob_get_clean(); 
        echo $contentMoraleNonCommercant;
    elseif ($categorieAssujetti == 'PersonnePhysiqueCommerçante') :
        ob_start();
    ?>
        <div class="col-md-10 col-md-offset-1 personne-physique-commercante">
            <div class="page-header">
                <h1 class="text-center" style="margin-top: -20px;">
                    Vous êtes une Personne physique commerçante
                </h1>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nomsAssujetti" placeholder="Votre nom...">
                    <label for="nomsAssujetti">Nom complet de l'assujetti <span class="required">*</span></label>
                </div>					
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="sexe" aria-label="Floating label select example">
                                <option value=""></option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                            <label for="sexe">Code sexe.... <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="etatCivil" aria-label="Floating label select example">
                                <option value=""></option>
                                <option value="Marié(e)">Marié(e)</option>
                                <option value="Célibataire">Célibataire</option>
                            </select>
                            <label for="sexe">Etat civil.... <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lieuNaissance" placeholder="Lieu...">
                            <label for="lieuNaissance">Lieu de naissance <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="dateNaissance" placeholder="Date...">
                            <label for="dateNaissance">Date de naissance <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="numeroCarteIdentite" placeholder="Identité...">
                            <label for="numeroCarteIdentite">N° de la carte d’identité <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="profession" aria-label="Sélectionner la profession">
                                <?= loadDefaultCombobox('profession', 'code_profession', 'designation_profession'); ?>
                            </select>
                            <label for="profession">Profession de l'assujetti <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="domicile" placeholder="Domicile...">
                            <label for="domicile">Domicile ou Lieu de résidence (Av. N°/Q./C./Ville, Province) <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="adresseActivite" placeholder="Lieu travail...">
                            <label for="adresseActivite">Adresse d’activité (lieu de travail) <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomsResponsable" placeholder="Votre nom...">
                            <label for="nomsResponsable">Nom complet du responsable <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nationaliteResponsable" placeholder="Votre nationalité...">
                            <label for="nationaliteResponsable">Nationalité responsable <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fonctionResponsable" placeholder="Votre fonction...">
                            <label for="fonctionResponsable">Fonction du responsable <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row identite-conjoint" style="margin-bottom: 10px;">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomsConjoint" placeholder="Nom du conjoint">
                            <label for="nomsConjoint">Nom complet du conjoint</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="typeMariage" aria-label="Sélection type mariage....">
                                <option value=""></option>
                                <option value="Mariage coutumier">Mariage coutumier</option>
                                <option value="Mariage civil">Mariage civil</option>
                            </select>
                            <label>Sélection type mariage....</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="regimeMatrimonial" aria-label="Régime matrimonial.........">
                                <option value=""></option>
                                <option value="Communauté des biens">Communauté des biens</option>
                                <option value="Séparation des biens">Séparation des biens</option>
                                <option value="Séparation réduite aux acquets">Séparation réduite aux acquets</option>
                            </select>
                            <label>Régime matrimonial.........</label>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                        <div class="form-floating">
                            <select class="form-select" id="professionConjoint" aria-label="Sélectionner la profession">
                                <?= loadDefaultCombobox('profession', 'code_profession', 'designation_profession'); ?>
                            </select>
                            <label for="professionConjoint">Profession du conjoint</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="secteurActivite" aria-label="Secteur d'activité...............">
                                <?= loadDefaultCombobox('secteur_activite', 'code_secteur_activite', 'designation_secteur_activite'); ?>
                            </select>
                            <label for="secteurActivite">Secteur d'activité... <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="rccm" placeholder="RCCM">
                            <label for="rccm">N° RCCM <span class="required">*</span></label>
                            <small id="validation-rccm"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nidNational" placeholder="ID National">
                            <label for="nidNational">N° ID National <span class="required">*</span></label>
                            <small id="validation-idnat"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nif" placeholder="NIF">
                            <label for="nif">N° Impôt (NIF) <span class="required">*</span></label>
                            <small id="validation-nif"></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="siegeScoial" placeholder="Siège social...">
                            <label for="siegeSocial">Siège social et administratif (Av. N°/Q./C./Ville) <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="siegeExploitation" placeholder="Siège d'exploitation...">
                            <label for="siegeExploitation">Siège d'exploitation (Nombre et lieu) <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telephoneAssujetti" placeholder="Contact...">
                            <label for="telephoneAssujetti">Téléphone (+243)89949... <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="emailAssujetti" placeholder="Email...">
                            <label for="emailAssujetti">Email de l'assujetti</label>
                            <small id="validation-email"></small>
                        </div>
                    </div>
                </div>
                <div class="row" style="border:1px solid #ccc;margin:0px">
                    <div class="alert alert-info">
                        <strong><i class="fa fa-info-circle"></i></strong>
                        Les champs portant (<span class="required">*</span>) sont requis.<br>
                        <strong><i class="fa fa-info-circle"></i></strong>
                        Les touches de direction Gauche et Droite de votre clavier sont des raccourcis des boutons Précédent et Suivant.
                    </div>
                </div>
            </div>
        </div>
    <?php
        $contentPhysiqueCommercant=ob_get_clean(); 
        echo $contentPhysiqueCommercant;
    elseif ($categorieAssujetti == 'PersonnePhysiqueNonCommerçante') :
        ob_start();
    ?>
        <div class="col-md-10 col-md-offset-1 personne-physique-non-commercante">
            <div class="page-header">
                <h1 class="text-center" style="margin-top: -20px;">
                    Vous êtes une Personne physique non commerçante
                </h1>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nomsAssujetti" placeholder="Votre nom...">
                    <label for="nomsAssujetti">Nom complet de l'assujetti <span class="required">*</span></label>
                </div>					
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="sexe" aria-label="Floating label select example">
                                <option value=""></option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                            <label for="sexe">Code sexe.... <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="etatCivil" aria-label="Floating label select example">
                                <option value=""></option>
                                <option value="Marié(e)">Marié(e)</option>
                                <option value="Célibataire">Célibataire</option>
                            </select>
                            <label for="sexe">Etat civil.... <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lieuNaissance" placeholder="Lieu...">
                            <label for="lieuNaissance">Lieu de naissance <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="dateNaissance" placeholder="Date...">
                            <label for="dateNaissance">Date de naissance <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="numeroCarteIdentite" placeholder="Identité...">
                            <label for="numeroCarteIdentite">N° de la carte d’identité <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="profession" aria-label="Sélectionner la profession">
                                <?= loadDefaultCombobox('profession', 'code_profession', 'designation_profession'); ?>
                            </select>
                            <label for="profession">Profession de l'assujetti <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="domicile" placeholder="Domicile...">
                            <label for="domicile">Domicile ou Lieu de résidence (Av. N°/Q./C./Ville, Province) <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="adresseActivite" placeholder="Lieu travail...">
                            <label for="adresseActivite">Adresse d’activité (lieu de travail) <span class="required">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row identite-conjoint" style="margin-bottom: 10px;">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomsConjoint" placeholder="Nom du conjoint">
                            <label for="nomsConjoint">Nom complet du conjoint</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="typeMariage" aria-label="Sélection type mariage....">
                                <option value=""></option>
                                <option value="Mariage coutumier">Mariage coutumier</option>
                                <option value="Mariage civil">Mariage civil</option>
                            </select>
                            <label>Sélection type mariage....</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="regimeMatrimonial" aria-label="Régime matrimonial.........">
                                <option value=""></option>
                                <option value="Communauté des biens">Communauté des biens</option>
                                <option value="Séparation des biens">Séparation des biens</option>
                                <option value="Séparation réduite aux acquets">Séparation réduite aux acquets</option>
                            </select>
                            <label>Régime matrimonial.........</label>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                        <div class="form-floating">
                            <select class="form-select" id="professionConjoint" aria-label="Sélectionner la profession">
                                <?= loadDefaultCombobox('profession', 'code_profession', 'designation_profession'); ?>
                            </select>
                            <label for="professionConjoint">Profession du conjoint</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="telephoneAssujetti" placeholder="Contact...">
                            <label for="telephoneAssujetti">Téléphone de l'assujetti <span class="required">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="emailAssujetti" placeholder="Email...">
                            <label for="emailAssujetti">Email de l'assujetti</label>
                            <small id="validation-email"></small>
                        </div>
                    </div>
                </div>
                <div class="row" style="border:1px solid #ccc;margin:0px">
                    <div class="alert alert-info">
                        <strong><i class="fa fa-info-circle"></i></strong>
                        Les champs portant (<span class="required">*</span>) sont requis.<br>
                        <strong><i class="fa fa-info-circle"></i></strong>
                        Les touches de direction Gauche et Droite de votre clavier sont des raccourcis des boutons Précédent et Suivant.
                    </div>
                </div>
            </div>
        </div>
    <?php
        $contentPhysiqueNonCommercant=ob_get_clean(); 
        echo $contentPhysiqueNonCommercant;
    else:
    endif;