<?php
//Sélectionne une occurence
function select_fetch($sql, $data=array()){
	global $pdo;
	$req=$pdo->prepare($sql); 
    $req->execute($data);
	$row=$req->fetch(PDO::FETCH_OBJ);
	$req->closeCursor();

	return $row;
}

//Sélectionne plusieurs occurences
function select_fetch_all($sql, $data=array()){
	global $pdo;
	$req=$pdo->prepare($sql); 
    $req->execute($data);
	$rows=$req->fetchAll(PDO::FETCH_OBJ);
	$req->closeCursor();

	return $rows;
}

//Facilite l'insertion, la modification et la suppression de données
function insertUpdateDelete($sql, $data=array()){
	global $pdo;
	$query=$pdo->prepare($sql); $query->execute($data);
	return $query->rowCount();
}

//Renvoie les nombres d'occurence par rapport à un seul filtre
function one_filter_count_sql($field, $table, $filter, $data=array()){
	global $pdo;
	$req=$pdo->prepare("SELECT $field FROM $table WHERE $filter=?"); 
    $req->execute($data);

	return $req->rowCount();
}

//Renvoie les nombres d'occurence sans filtre
function count_sql($field, $table){
	global $pdo;
	$req=$pdo->prepare("SELECT $field FROM $table"); 
    $req->execute();

	return $req->rowCount();
}

//Renvoie la valeur rechercher par un critère de filtre
function get_field_by_filter($field, $table, $filter, $data=array()){
	$req=select_fetch("SELECT $field FROM $table WHERE $filter=?", $data);
	return $req->$field;
}

//Charger les combos box
function loadDefaultCombobox($table, $value, $libelle){
	global $pdo;
	$output='<option value=""></option>';
	$datas=select_fetch_all("SELECT * FROM $table ORDER BY $libelle");
	foreach ($datas as $data) :
		$output.='<option value="'.$data->$value.'">'.$data->$libelle.'</option>';
    endforeach;
	return $output;
}

function loadClasses(){
	global $pdo;
	$output='<option value=""></option>';
	$datas=select_fetch_all("SELECT * FROM classes_plan_comptable ORDER BY id_classe");
	foreach ($datas as $data) :
		$output.='<option value="'.$data->id_classe.'">CLASSE '.$data->id_classe.' : '.$data->nom_classe.'</option>';
    endforeach;
	return $output;
}

function loadComboRubriques(){
	global $pdo;
	$output='<option value=""></option>';
	$datas=select_fetch_all("SELECT * FROM rubriques_plan_comptable ORDER BY id_rubrique");
	foreach ($datas as $data) :
		$output.='<option value="'.$data->id_rubrique.'">RUBRIQUE '.$data->id_rubrique.' : '.$data->nom_rubrique.'</option>';
    endforeach;
	return $output;
}

function loadComboPostes(){
	global $pdo;
	$output='<option value=""></option>';
	$datas=select_fetch_all("SELECT * FROM postes_plan_comptable ORDER BY id_poste");
	foreach ($datas as $data) :
		$output.='<option value="'.$data->id_poste.'">POSTE '.$data->id_poste.' : '.$data->nom_poste.'</option>';
    endforeach;
	return $output;
}