<?php 
if (isset($_POST['action']))
    extract($_POST);
    require('config.app/control_functions.php');
    require('config.app/connect_db.php');
    require('config.app/db_functions.php');//Inclut le fichier functions

    /* Charge le treeview */
    if ($action == 'charger') :

        $classes = select_fetch_all("SELECT * FROM classes_plan_comptable ORDER BY id_classe");

        function getIcon($selecteur, $dataId, $imgname){
            return '<span id="'.$selecteur.''.$dataId.'" class="'.$selecteur.'" data-id="'.$dataId.'">
                        <img src="assets/images/icon/'.$imgname.'.PNG" alt="">
                    </span>';
        }

        function asChildren($field, $table, $filter, $data=array()){
            $rows = one_filter_count_sql($field, $table, $filter, $data);
            return ($rows > 0) ? '1' : '0';
        }

        function displayMinusIcon($selecteur, $dataId){
            return '<span id="'.$selecteur.''.$dataId.'" class="'.$selecteur.'" data-id="'.$dataId.'" style="display: none;">
                        <img src="assets/images/icon/icone-moins.PNG" alt="">
                    </span>';
        }
        
        ob_start();
    ?>
        <!-- Début de la liste des classes -->
        <ul class="list-group ul-class">
            <?php foreach ($classes as $classe) : $idClasse = escape($classe->id_classe); ?> 
            <li class="list-group-item li-classe" id="li-classe<?=$idClasse;?>">
                <span class="dotted">....</span>
                <?php echo displayMinusIcon('moins-classe', $idClasse);
                echo (asChildren('id_rubrique', 'rubriques_plan_comptable', 'id_classe', array($idClasse)) == '1') ?
                getIcon('plus-classe', $idClasse, 'icone-plus') : getIcon('none-classe', $idClasse, 'icone-none');
                ?>
                <?= '<b> CLASSE '.$idClasse.'</b> : '.strtoupper(escape($classe->nom_classe));?>
                
                <!-- Sélectionner toutes les rubriques par classes d'appartenance -->
                <?php $rubriques = select_fetch_all("SELECT * FROM rubriques_plan_comptable WHERE id_classe=? ORDER BY id_rubrique", array($idClasse));?>
                
                <!-- Début de la liste des rubriques -->
                <ul class="list-group ul-rubrique" id="ul-rubrique<?=$idClasse;?>" style="display: none;">
                    <?php foreach ($rubriques as $rubrique) : $idRubrique = escape($rubrique->id_rubrique); ?>
                    <li class="list-group-item li-rubrique" id="li-rubrique<?=$idRubrique;?>">
                        <span class="dotted">....</span>
                        <?php echo displayMinusIcon('moins-rubrique', $idRubrique);
                        echo (asChildren('id_poste', 'postes_plan_comptable', 'id_rubrique', array($idRubrique)) == '1') ?
                        getIcon('plus-rubrique', $idRubrique, 'icone-plus') : getIcon('none-rubrique', $idRubrique, 'icone-none');
                        ?>
                        <?= '<b> RUBRIQUE '.$idRubrique.'</b> : '.strtoupper(escape($rubrique->nom_rubrique));?>
                        
                        <!-- Sélectionner toutes les postes par rubriques d'appartenance -->
                        <?php $postes = select_fetch_all("SELECT * FROM postes_plan_comptable WHERE id_rubrique=? ORDER BY id_poste", array($idRubrique));?>
                        
                        <!-- Début de la liste des postes -->
                        <ul class="list-group ul-poste" id="ul-poste<?=$idRubrique;?>" style="display: none;">
                            <?php foreach ($postes as $poste) : $idPoste = escape($poste->id_poste); ?>
                            <li class="list-group-item li-poste" id="li-poste<?=$idPoste;?>">
                                <span class="dotted">....</span>
                                <?php echo displayMinusIcon('moins-poste', $idPoste);
                                echo (asChildren('id_compte', 'comptes_plan_comptable', 'id_poste', array($idPoste)) == '1') ?
                                getIcon('plus-poste', $idPoste, 'icone-plus') : getIcon('none-poste', $idPoste, 'icone-none');
                                ?>
                                <?= '<b> POSTE '.$idPoste.'</b> : '.strtoupper(escape($poste->nom_poste));?>
                            
                                <!-- Sélectionner tous les comptes par postes d'appartenance -->
                                <?php $comptes = select_fetch_all("SELECT * FROM comptes_plan_comptable WHERE id_poste=? ORDER BY id_compte", array($idPoste));?>

                                <!-- Début de la liste des comptes -->
                                <ul class="list-group ul-compte" id="ul-compte<?=$idPoste;?>" style="display: none;">
                                    <?php foreach ($comptes as $compte) : ?>
                                    <li class="list-group-item li-compte">
                                        <span class="dotted">....</span>
                                        <?= '<img src="assets/images/icon/icone-none.PNG" alt=""><b> Compte '.escape(escape($compte->id_compte)).'</b> : '.ucfirst(strtolower(escape($compte->nom_compte)));?>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <!-- Fin de la liste des postes -->
                    </li>
                    <?php endforeach;?>
                </ul>
                <!-- Fin Liste des rubriques -->

            </li>
            <?php endforeach; ?>
        </ul>
        <!-- Fin Liste des classes -->
    <?php
        $output = ob_get_clean(); 
        echo $output;   

    /* Gestion des classes */
    elseif ($action == 'chargerClasses') :
        if (!empty($id)) :
            $critere = "WHERE id_classe = ?";
            $data = array (escape($id));
        else :
            $critere = "";
            $data = array ();
        endif;

        $classes = select_fetch_all("SELECT * FROM classes_plan_comptable $critere ORDER BY id_classe", $data);

        if (count($classes) > 0) :
            foreach ($classes as $classe) :
                ob_start();
    ?>
                <tr>
                    <td style="padding: 4px;text-align : center"><?=escape($classe->id_classe);?></td>
                    <td style="padding: 4px;"><input type="text" class="form-control form-table" id="nom-classe<?=escape($classe->id_classe);?>" value="<?=strtoupper(escape($classe->nom_classe));?>"></td>
                    <td style="padding: 4px;">
                        <div class="hidden-sm hidden-xs action-buttons">
                            <a href="#" class="blue edit-classe" data-id="<?=escape($classe->id_classe);?>"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                            <a href="#" class="red delete-classe" data-id="<?=escape($classe->id_classe);?>"><i class="ace-icon fa fa-trash bigger-130"></i></a>
                        </div>
                    </td>
                </tr>
    <?php

            endforeach;
        else : 
    ?>
            <tr>
                <td colspan="3">
                    <span class="label label-danger arrowed">Aucune classe trouvée dans la base</span>
                </td>
            </tr>
    <?php
        endif;
        $output = ob_get_clean(); 
        echo $output;
    
    elseif ($action == 'update-classe') :
        $output=array(); $output['success']=''; $output['failure']='';

        if (not_empty(array($nomclasse))) :
            $classe = select_fetch("SELECT * FROM classes_plan_comptable WHERE id_classe=?", array(escape($idclasse)));
            if ($classe) :
                if (escape($nomclasse) == escape($classe->nom_classe)) :
                    $output['failure'] = 'Aucune modification détectée à la ligne en cours d\'édition.';
                else :
                    $updatesql="UPDATE classes_plan_comptable SET nom_classe=? WHERE id_classe=?";
                    $pholders = array(escape($nomclasse), escape($idclasse));
                    if (insertUpdateDelete($updatesql, $pholders)>0) $output["success"] = get_alert_full('success', 'Classe modifiée avec succès', 'non', 'spring');
                endif;
            endif;
        else : $output['failure'] = 'Le champ nom de la classe dans toutes les lignes est requis.';
        endif;

        echo json_encode($output);

    elseif ($action == 'delete-classe') :
        $output='';
        if (not_empty(array($idclasse))) :
            $deletesql="DELETE FROM classes_plan_comptable WHERE id_classe=?";
            $deletesql1="DELETE FROM rubriques_plan_comptable WHERE id_classe=?";

            $pholders = array(escape($idclasse));

            if (insertUpdateDelete($deletesql, $pholders)>0)
                insertUpdateDelete($deletesql1, $pholders);
                $output= get_alert_full('success', 'La classe '.$nomclasse.' a été supprimée avec succès', 'non', 'spring');
            
            echo $output;
        endif;
    
    elseif ($action == 'insert-classe') :

        if (!empty($addidclasse) && !empty($addnomclasse)) :
            $nbreLigneInseree=0;
            $nbreclasses=count($addnomclasse);

            if ($nbreclasses>0) :

                for ($i=0; $i < $nbreclasses; $i++) {
                    $longueur = strlen($addidclasse[$i]);

                    if ($longueur == 1) :
                        if (is_numeric($addidclasse[$i])) :
                            $insertsql="INSERT INTO classes_plan_comptable(id_classe, nom_classe) VALUES(?, ?)";
                            $pholders=array(escape($addidclasse[$i]), strtoupper(escape($addnomclasse[$i])));
                            $queryinsert=insertUpdateDelete($insertsql, $pholders);

                            if ($queryinsert>0) :
                                $nbreLigneInseree ++;
                                $success_item=array('nomclasse' => $addnomclasse[$i]);
                                $success_array[]=$success_item;
                            endif;
                        else :
                            $failure_numericid=array('id' => $addidclasse[$i]);
					        $failures_array_numericid[] = $failure_numericid;
                        endif;
                    else :
                        $failure_tailleid=array('id' => $addidclasse[$i]);
					    $failures_array_tailleid[] = $failure_tailleid;
                    endif;
                }

                if(isset($failures_array_tailleid)) :
                    if(count($failures_array_tailleid)>0) :
                        $msg='';
                        foreach ($failures_array_tailleid as $value) {
                            $msg .= 'Le format de la classe '.$value['id'].' n\'est pas valide. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if(isset($failures_array_numericid)) :
                    if(count($failures_array_numericid)>0) :
                        $msg='';
                        foreach ($failures_array_numericid as $value) {
                            $msg .= 'Le N° classe '.$value['id'].' n\'est pas valide. Seul les chiffres sont autorisés. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if (isset($success_array)) :
                    if(count($success_array)>0 && $nbreLigneInseree>0) :
                        $msgsucces='';
                        foreach ($success_array as $value) {
                            $msgsucces .= 'La classe <b> '.$value['nomclasse'].'</b> est bien ajouté dans la base<br>';
                        }
                        echo get_alert_full('success', '<b>'.$nbreLigneInseree.' ligne(s) affectée(s)</b><br>'.$msgsucces);
                    endif;
                endif;
            endif;

        else : echo get_alert_full('danger', 'Veuillez renseigner tous les champs requis', 'non', 'spring');
        endif;
    /* Fin gestion des classes */
    
    /* Gestion des rubriques */
    elseif ($action == 'chargerCmbRubriques') :
        $output = '';
        if (!empty($idclasse))
            $output = '<select class="form-select" id="filter-rubrique" style="width: 100%">
                        <option value="">Filtrer par rubrique</option>';
            $datas=select_fetch_all("SELECT * FROM rubriques_plan_comptable WHERE id_classe = ? ORDER BY id_rubrique", array(escape($idclasse)));
            foreach ($datas as $data) :
                $output.='<option value="'.$data->id_rubrique.'">RUBRIQUE '.$data->id_rubrique.' : '.$data->nom_rubrique.'</option>';
            endforeach;
            $output.= '</select>';
        echo $output;

    elseif ($action == 'chargerRubriques') :
        $output=array(); $output['table']='';
        $tableoutput = '';
        if (!empty($idclasse)) :
            if (!empty($idrubrique)) :
                $critere = "WHERE id_rubrique = ? AND id_classe = ?";
                $data = array (escape($idrubrique), escape($idclasse));
            else :
                $critere = "WHERE id_classe = ?";
                $data = array (escape($idclasse));
            endif;

            $rubriques = select_fetch_all("SELECT * FROM rubriques_plan_comptable $critere ORDER BY id_rubrique", $data);

            if (count($rubriques) > 0) :
                foreach ($rubriques as $rubrique) :
                $tableoutput.='<tr>
                        <td style="padding: 4px;text-align : center">'.escape($rubrique->id_rubrique).'</td>
                        <td style="padding: 4px;"><input type="text" class="form-control form-table" id="nom-rubrique'.escape($rubrique->id_rubrique).'" value="'.strtoupper(escape($rubrique->nom_rubrique)).'"></td>
                        <td style="padding: 4px;text-align : center">'.escape($rubrique->id_classe).'</td>
                        <td style="padding: 4px;">
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a href="#" class="blue edit-rubrique" data-id="'.escape($rubrique->id_rubrique).'"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                <a href="#" class="red delete-rubrique" data-id="'.escape($rubrique->id_rubrique).'"><i class="ace-icon fa fa-trash bigger-130"></i></a>
                            </div>
                        </td>
                    </tr>';
                endforeach;
            else : 
                $tableoutput='<tr>
                    <td colspan="3">
                        <span class="label label-danger arrowed">Aucune rubrique trouvée appartenant à la classe choisie</span>
                    </td>
                </tr>';
            endif;
        else : $tableoutput = '';
        endif;
        
        $output['table'] = $tableoutput;
        echo json_encode($output);

    elseif ($action == 'update-rubrique') :
        $output=array(); $output['success']=''; $output['failure']='';

        if (not_empty(array($nomrubrique))) :
            $rubrique = select_fetch("SELECT * FROM rubriques_plan_comptable WHERE id_rubrique=?", array(escape($idrubrique)));
            if ($rubrique) :
                if (escape($nomrubrique) == escape($rubrique->nom_rubrique)) :
                    $output['failure'] = 'Aucune modification détectée à la ligne en cours d\'édition.';
                else :
                    $updatesql="UPDATE rubriques_plan_comptable SET nom_rubrique=? WHERE id_rubrique=?";
                    $pholders = array(escape($nomrubrique), escape($idrubrique));
                    if (insertUpdateDelete($updatesql, $pholders)>0) $output["success"] = get_alert_full('success', 'Rubrique modifiée avec succès', 'non', 'spring');
                endif;
            endif;
        else : $output['failure'] = 'Le champ nom de la rubrique dans toutes les lignes est requis.';
        endif;

        echo json_encode($output);

    elseif ($action == 'delete-rubrique') :
        $output='';
        if (not_empty(array($idrubrique))) :
            $deletesql="DELETE FROM rubriques_plan_comptable WHERE id_rubrique=?";
            $deletesql1="DELETE FROM postes_plan_comptable WHERE id_rubrique=?";

            $pholders = array(escape($idrubrique));

            if (insertUpdateDelete($deletesql, $pholders)>0)
                insertUpdateDelete($deletesql1, $pholders);
                $output= get_alert_full('success', 'La rubrique '.$nomrubrique.' a été supprimée avec succès', 'non', 'spring');
            
            echo $output;
        endif;

    elseif ($action == 'insert-rubrique') :

        if (!empty($addidrubrique) && !empty($addnomrubrique) && !empty($selectclasse)) :
            $nbreLigneInseree=0;
            $nbrerubriques=count($addnomrubrique);

            if ($nbrerubriques>0) :

                for ($i=0; $i < $nbrerubriques; $i++) {

                    $firstdigit= $addidrubrique[$i][0];
                    $longueur = strlen($addidrubrique[$i]);

                    if ($firstdigit == $selectclasse) :
                        if ($longueur == 2) :
                            if (is_numeric($addidrubrique[$i])) :
                                $insertsql="INSERT INTO rubriques_plan_comptable(id_rubrique, nom_rubrique, id_classe) VALUES(?, ?, ?)";
                                $pholders=array(escape($addidrubrique[$i]), strtoupper(escape($addnomrubrique[$i])), escape($selectclasse));
                                $queryinsert=insertUpdateDelete($insertsql, $pholders);

                                if ($queryinsert>0) :
                                    $nbreLigneInseree ++;
                                    $success_item=array('nomrubrique' => $addnomrubrique[$i]);
                                    $success_array[]=$success_item;
                                endif;
                            else :
                                $failure_numericid=array('id' => $addidrubrique[$i]);
                                $failures_array_numericid[] = $failure_numericid;
                            endif;
                        else :
                            $failure_tailleid=array('id' => $addidrubrique[$i]);
					        $failures_array_tailleid[] = $failure_tailleid;
                        endif;
                    else :
                        $failure_id=array('id' => $addidrubrique[$i]);
					    $failures_array_id[] = $failure_id;
                    endif;
                }

                if(isset($failures_array_id)) :
                    if(count($failures_array_id)>0) :
                        $msg='';
                        foreach ($failures_array_id as $value) {
                            $msg .= 'Le N° Rubrique '.$value['id'].' n\'appartient pas à la classe sélectionnée. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if(isset($failures_array_tailleid)) :
                    if(count($failures_array_tailleid)>0) :
                        $msg='';
                        foreach ($failures_array_tailleid as $value) {
                            $msg .= 'Le format du N° Rubrique '.$value['id'].' n\'est pas valide. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if(isset($failures_array_numericid)) :
                    if(count($failures_array_numericid)>0) :
                        $msg='';
                        foreach ($failures_array_numericid as $value) {
                            $msg .= 'Le N° rubrique '.$value['id'].' n\'est pas valide. Seul les chiffres sont autorisés. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if (isset($success_array)) :
                    if(count($success_array)>0 && $nbreLigneInseree>0) :
                        $msgsucces='';
                        foreach ($success_array as $value) {
                            $msgsucces .= 'La rubrique <b> '.$value['nomrubrique'].'</b> est bien ajouté dans la base<br>';
                        }
                        echo get_alert_full('success', '<b>'.$nbreLigneInseree.' ligne(s) affectée(s)</b><br>'.$msgsucces);
                    endif;
                endif;
            endif;

        else : echo get_alert_full('danger', 'Veuillez renseigner tous les champs requis');
        endif;
    /* Fin Gestion des rubriques */

    /* Gestion des postes */
    elseif ($action == 'chargerCmbPostes') :
        $output = '';
        if (!empty($idrubrique))
            $output = '<select class="form-select" id="filter-poste" style="width: 100%">
                        <option value="">Filtrer par poste</option>';
            $datas=select_fetch_all("SELECT * FROM postes_plan_comptable WHERE id_rubrique = ? ORDER BY id_poste", array(escape($idrubrique)));
            foreach ($datas as $data) :
                $output.='<option value="'.$data->id_poste.'">POSTE '.$data->id_poste.' : '.$data->nom_poste.'</option>';
            endforeach;
            $output.= '</select>';
        echo $output;
    
    elseif ($action == 'chargerPostes') :
        $output=array(); $output['table']='';
        $tableoutput = '';
        if (!empty($idrubrique)) :
            if (!empty($idposte)) :
                $critere = "WHERE id_poste = ? AND id_rubrique = ?";
                $data = array (escape($idposte), escape($idrubrique));
            else :
                $critere = "WHERE id_rubrique = ?";
                $data = array (escape($idrubrique));
            endif;

            $postes = select_fetch_all("SELECT * FROM postes_plan_comptable $critere ORDER BY id_poste", $data);

            if (count($postes) > 0) :
                foreach ($postes as $poste) :
                $tableoutput.='<tr>
                        <td style="padding: 4px;text-align : center">'.escape($poste->id_poste).'</td>
                        <td style="padding: 4px;"><input type="text" class="form-control form-table" id="nom-poste'.escape($poste->id_poste).'" value="'.strtoupper(escape($poste->nom_poste)).'"></td>
                        <td style="padding: 4px;text-align : center">'.escape($poste->id_rubrique).'</td>
                        <td style="padding: 4px;">
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a href="#" class="blue edit-poste" data-id="'.escape($poste->id_poste).'"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                <a href="#" class="red delete-poste" data-id="'.escape($poste->id_poste).'"><i class="ace-icon fa fa-trash bigger-130"></i></a>
                            </div>
                        </td>
                    </tr>';
                endforeach;
            else : 
                $tableoutput='<tr>
                    <td colspan="3">
                        <span class="label label-danger arrowed">Aucun poste trouvé appartenant à la rubrique choisie</span>
                    </td>
                </tr>';
            endif;
        else : $tableoutput = '';
        endif;
        
        $output['table'] = $tableoutput;
        echo json_encode($output);

    elseif ($action == 'update-poste') :
        $output=array(); $output['success']=''; $output['failure']='';

        if (not_empty(array($nomposte))) :
            $poste = select_fetch("SELECT * FROM postes_plan_comptable WHERE id_poste=?", array(escape($idposte)));
            if ($poste) :
                if (escape($nomposte) == escape($poste->nom_poste)) :
                    $output['failure'] = 'Aucune modification détectée à la ligne en cours d\'édition.';
                else :
                    $updatesql="UPDATE postes_plan_comptable SET nom_poste=? WHERE id_poste=?";
                    $pholders = array(escape($nomposte), escape($idposte));
                    if (insertUpdateDelete($updatesql, $pholders)>0) $output["success"] = get_alert_full('success', 'Poste modifié avec succès', 'non', 'spring');
                endif;
            endif;
        else : $output['failure'] = 'Le champ nom de poste dans toutes les lignes est requis.';
        endif;

        echo json_encode($output);
    elseif ($action == 'delete-poste') :
        $output='';
        if (not_empty(array($idposte))) :
            $deletesql="DELETE FROM postes_plan_comptable WHERE id_poste=?";
            $deletesql1="DELETE FROM comptes_plan_comptable WHERE id_poste=?";

            $pholders = array(escape($idposte));

            if (insertUpdateDelete($deletesql, $pholders)>0)
                insertUpdateDelete($deletesql1, $pholders);
                $output= get_alert_full('success', 'Le Poste '.$nomposte.' a été supprimée avec succès', 'non', 'spring');
            
            echo $output;
        endif;

    elseif ($action == 'insert-poste') :

        if (!empty($addidposte) && !empty($addnomposte) && !empty($selectrubrique)) :
            $nbreLigneInseree=0;
            $nbrepostes=count($addnomposte);

            if ($nbrepostes>0) :

                for ($i=0; $i < $nbrepostes; $i++) {

                    $firstdigit= $addidposte[$i][0].''.$addidposte[$i][1];
                    $longueur = strlen($addidposte[$i]);

                    if ($firstdigit == $selectrubrique) :
                        if ($longueur > 2) :
                            if (is_numeric($addidposte[$i])) :
                                $insertsql="INSERT INTO postes_plan_comptable(id_poste, nom_poste, id_rubrique) VALUES(?, ?, ?)";
                                $pholders=array(escape($addidposte[$i]), strtoupper(escape($addnomposte[$i])), escape($selectrubrique));
                                $queryinsert=insertUpdateDelete($insertsql, $pholders);

                                if ($queryinsert>0) :
                                    $nbreLigneInseree ++;
                                    $success_item=array('nomposte' => $addnomposte[$i]);
                                    $success_array[]=$success_item;
                                endif;
                            else :
                                $failure_numericid=array('id' => $addidposte[$i]);
                                $failures_array_numericid[] = $failure_numericid;
                            endif;
                        else :
                            $failure_tailleid=array('id' => $addidposte[$i]);
                            $failures_array_tailleid[] = $failure_tailleid;
                        endif;
                    else :
                        $failure_id=array('id' => $addidposte[$i]);
                        $failures_array_id[] = $failure_id;
                    endif;
                }

                if(isset($failures_array_id)) :
                    if(count($failures_array_id)>0) :
                        $msg='';
                        foreach ($failures_array_id as $value) {
                            $msg .= 'Le N° Poste '.$value['id'].' n\'appartient pas à la rubrique sélectionnée. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if(isset($failures_array_tailleid)) :
                    if(count($failures_array_tailleid)>0) :
                        $msg='';
                        foreach ($failures_array_tailleid as $value) {
                            $msg .= 'Le format du N° Poste '.$value['id'].' n\'est pas valide. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if(isset($failures_array_numericid)) :
                    if(count($failures_array_numericid)>0) :
                        $msg='';
                        foreach ($failures_array_numericid as $value) {
                            $msg .= 'Le N° poste '.$value['id'].' n\'est pas valide. Seul les chiffres sont autorisés. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if (isset($success_array)) :
                    if(count($success_array)>0 && $nbreLigneInseree>0) :
                        $msgsucces='';
                        foreach ($success_array as $value) {
                            $msgsucces .= 'Le poste <b> '.$value['nomposte'].'</b> est bien ajouté dans la base<br>';
                        }
                        echo get_alert_full('success', '<b>'.$nbreLigneInseree.' ligne(s) affectée(s)</b><br>'.$msgsucces);
                    endif;
                endif;
            endif;

        else : echo get_alert_full('danger', 'Veuillez renseigner tous les champs requis');
        endif;
    /* Fin Gestion des postes */

    /* Gestion des comptes */
    elseif ($action == 'chargerCmbComptes') :
        $output = '';
        if (!empty($idposte))
            $output = '<select class="form-select" id="filter-compte" style="width: 100%">
                        <option value="">Filtrer par compte</option>';
            $datas=select_fetch_all("SELECT * FROM comptes_plan_comptable WHERE id_poste = ? ORDER BY id_compte", array(escape($idposte)));
            foreach ($datas as $data) :
                $output.='<option value="'.$data->id_compte.'">COMPTE '.$data->id_compte.' : '.$data->nom_compte.'</option>';
            endforeach;
            $output.= '</select>';
        echo $output;
    
    elseif ($action == 'chargerComptes') :
        $output=array(); $output['table']='';
        $tableoutput = '';
        if (!empty($idposte)) :
            if (!empty($idcompte)) :
                $critere = "WHERE id_compte = ? AND id_poste = ?";
                $data = array (escape($idcompte), escape($idposte));
            else :
                $critere = "WHERE id_poste = ?";
                $data = array (escape($idposte));
            endif;

            $comptes = select_fetch_all("SELECT * FROM comptes_plan_comptable $critere ORDER BY id_compte", $data);

            if (count($comptes) > 0) :
                foreach ($comptes as $compte) :
                $tableoutput.='<tr>
                        <td style="padding: 4px;text-align : center">'.escape($compte->id_compte).'</td>
                        <td style="padding: 4px;"><input type="text" class="form-control form-table" id="nom-compte'.escape($compte->id_compte).'" value="'.ucfirst(strtolower(escape($compte->nom_compte))).'"></td>
                        <td style="padding: 4px;text-align : center">'.escape($compte->id_poste).'</td>
                        <td style="padding: 4px;">
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a href="#" class="blue edit-compte" data-id="'.escape($compte->id_compte).'"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
                                <a href="#" class="red delete-compte" data-id="'.escape($compte->id_compte).'"><i class="ace-icon fa fa-trash bigger-130"></i></a>
                            </div>
                        </td>
                    </tr>';
                endforeach;
            else : 
                $tableoutput='<tr>
                    <td colspan="3">
                        <span class="label label-danger arrowed">Aucun compte trouvé appartenant au poste choisi</span>
                    </td>
                </tr>';
            endif;
        else : $tableoutput = '';
        endif;
        
        $output['table'] = $tableoutput;
        echo json_encode($output);

    elseif ($action == 'update-compte') :
        $output=array(); $output['success']=''; $output['failure']='';

        if (not_empty(array($nomcompte))) :
            $compte = select_fetch("SELECT * FROM comptes_plan_comptable WHERE id_compte=?", array(escape($idcompte)));
            if ($compte) :
                if (escape($nomcompte) == escape($compte->nom_compte)) :
                    $output['failure'] = 'Aucune modification détectée à la ligne en cours d\'édition.';
                else :
                    $updatesql="UPDATE comptes_plan_comptable SET nom_compte=? WHERE id_compte=?";
                    $pholders = array(escape($nomcompte), escape($idcompte));
                    if (insertUpdateDelete($updatesql, $pholders)>0) $output["success"] = get_alert_full('success', 'Compte modifié avec succès', 'non', 'spring');
                endif;
            endif;
        else : $output['failure'] = 'Le champ nom de compte dans toutes les lignes est requis.';
        endif;

        echo json_encode($output);

    elseif ($action == 'delete-compte') :
        $output='';
        if (not_empty(array($idcompte))) :
            $deletesql="DELETE FROM comptes_plan_comptable WHERE id_compte=?";

            $pholders = array(escape($idcompte));

            if (insertUpdateDelete($deletesql, $pholders)>0)
                $output= get_alert_full('success', 'Le Compte '.$nomcompte.' a été supprimée avec succès', 'non', 'spring');
            
            echo $output;
        endif;
    
    elseif ($action == 'insert-compte') :

        if (!empty($addidcompte) && !empty($addnomcompte) && !empty($selectposte)) :
            $nbreLigneInseree=0;
            $nbrecomptes=count($addnomcompte);

            if ($nbrecomptes>0) :

                for ($i=0; $i < $nbrecomptes; $i++) {

                    $firstdigit= $addidcompte[$i][0].''.$addidcompte[$i][1].''.$addidcompte[$i][2];
                    $longueur = strlen($addidcompte[$i]);

                    if ($firstdigit == $selectposte) :
                        if ($longueur > 3) :
                            if (is_numeric($addidcompte[$i])) :
                                $insertsql="INSERT INTO comptes_plan_comptable(id_compte, nom_compte, id_poste) VALUES(?, ?, ?)";
                                $pholders=array(escape($addidcompte[$i]), ucfirst(strtolower(escape($addnomcompte[$i]))), escape($selectposte));
                                $queryinsert=insertUpdateDelete($insertsql, $pholders);

                                if ($queryinsert>0) :
                                    $nbreLigneInseree ++;
                                    $success_item=array('nomcompte' => $addnomcompte[$i]);
                                    $success_array[]=$success_item;
                                endif;
                            else :
                                $failure_numericid=array('id' => $addidcompte[$i]);
                                $failures_array_numericid[] = $failure_numericid;
                            endif;
                        else :
                            $failure_tailleid=array('id' => $addidcompte[$i]);
                            $failures_array_tailleid[] = $failure_tailleid;
                        endif;
                    else :
                        $failure_id=array('id' => $addidcompte[$i]);
                        $failures_array_id[] = $failure_id;
                    endif;
                }

                if(isset($failures_array_id)) :
                    if(count($failures_array_id)>0) :
                        $msg='';
                        foreach ($failures_array_id as $value) {
                            $msg .= 'Le N° Compte '.$value['id'].' n\'appartient pas au poste sélectionné. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if(isset($failures_array_tailleid)) :
                    if(count($failures_array_tailleid)>0) :
                        $msg='';
                        foreach ($failures_array_tailleid as $value) {
                            $msg .= 'Le format du N° Compte '.$value['id'].' n\'est pas valide. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if(isset($failures_array_numericid)) :
                    if(count($failures_array_numericid)>0) :
                        $msg='';
                        foreach ($failures_array_numericid as $value) {
                            $msg .= 'Le N° compte '.$value['id'].' n\'est pas valide. Seul les chiffres sont autorisés. <br>';
                        }
                        echo get_alert_full('danger', $msg);
                    endif;
                endif;

                if (isset($success_array)) :
                    if(count($success_array)>0 && $nbreLigneInseree>0) :
                        $msgsucces='';
                        foreach ($success_array as $value) {
                            $msgsucces .= 'Le compte <b> '.$value['nomcompte'].'</b> est bien ajouté dans la base<br>';
                        }
                        echo get_alert_full('success', '<b>'.$nbreLigneInseree.' ligne(s) affectée(s)</b><br>'.$msgsucces);
                    endif;
                endif;
            endif;

        else : echo get_alert_full('danger', 'Veuillez renseigner tous les champs requis');
        endif;
    /* Fin Gestion des comptes */
    else :
    endif;