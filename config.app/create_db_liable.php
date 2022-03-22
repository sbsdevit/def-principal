<?php
//Création de la structure de base de données
function connect_db_liable ($dbname_liable, $telepone, $motdepasse){
	$dbhost = 'localhost';
	$dbuser = 'def-app';
	$dbpw = 'Sedjo120@';//Sedjo120@
	$dbname = $dbname_liable;

	$dbliablepdo= new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpw, array(
		PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8',
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
	);

    $sql = "CREATE TABLE IF NOT EXISTS `agents` (
        `telephone` varchar(25) NOT NULL,
        `matricule` varchar(25) NULL,
        `nomsession` varchar(50) NOT NULL,
        `nom` varchar(250) NOT NULL,
        `postnom` varchar(250) NOT NULL,
        `prenom` varchar(250) NOT NULL,
        `code_sexe` varchar(2) NOT NULL,
        `adresse` TEXT NULL,
        `statut` varchar(50) NOT NULL,
        `code_fonction` varchar(50) NOT NULL,
        `code_categorie` varchar(50) NOT NULL,
        `motdepasse` TEXT NOT NULL,
        PRIMARY KEY (`telephone`)
      ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

    $sql .= "CREATE TABLE IF NOT EXISTS `fonctions` (
        `code_fonction` varchar(50) NOT NULL,
        `designation_fonction` varchar(250) NULL,
        PRIMARY KEY (`code_fonction`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

    $sql .= "CREATE TABLE IF NOT EXISTS `categories` (
        `code_categorie` varchar(50) NOT NULL,
        `designation_categorie` varchar(250) NULL,
        PRIMARY KEY (`code_categorie`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

    $sql .= "CREATE TABLE IF NOT EXISTS `auth_token` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `user_token` TEXT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

    $dbliablepdo->exec($sql);


    //Insertion du compte Admin dans la table Agent
    $query=$dbliablepdo->prepare("INSERT INTO agents (telephone, matricule, nomsession, nom, postnom, prenom, 
    code_sexe, adresse, statut, code_fonction, code_categorie, motdepasse) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $placeholders = array ($telepone, '001', '@Admin', 'Admin', 'Admin', 'Admin', 'M', 'Adresse', 'Actif',
                           'Admin', 'Admin', bcrypt_hash_password($motdepasse));
    $query->execute($placeholders);
}