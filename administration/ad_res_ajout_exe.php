<?php
	session_start();
	require("ad_estconnecte_exe.php"); //Gestion de connexion
	
	// 1er test : vérifier la récupération des infos du formulaire
	// var_dump($_POST);

	$nom = htmlentities($_POST["txtNom"]);
	$rue = htmlentities($_POST["txtRue"]);
	$cp = htmlentities($_POST["txtCP"]);
	$ville = htmlentities($_POST["txtVille"]);
	$img = htmlentities($_POST["txtImg"]);
	$classe = htmlentities($_POST["nbrClasse"]);
	$parking = (isset($_POST["chkParking"]) ? 1 : 0);
	$ascenseur = (isset($_POST["chkAscenseur"]) ? 1 : 0);

	// requête sql
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	// $sql = "INSERT INTO residences
	// 		(nomResidence, adresseResidence, villeResidence, cpResidence, classResidence, ascResidence, parkResidence, photoResidence)
	// 		VALUES (:nom, :rue, :ville,:cp, :classe, :ascenseur, :parking, :img);";
	
	// $res = $bdd->prepare($sql);
	// $res ->bindParam(':nom', $nom, PDO::PARAM_STR);
	// $res ->bindParam(':rue', $rue, PDO::PARAM_STR);
	// $res ->bindParam(':ville', $ville, PDO::PARAM_STR);
    // $res ->bindParam(':cp', $cp, PDO::PARAM_STR);
	// $res ->bindParam(':classe', $classe, PDO::PARAM_STR);
    // $res ->bindParam(':ascenseur', $ascenseur, PDO::PARAM_INT);
	// $res ->bindParam(':parking', $parking, PDO::PARAM_INT);
	// $res ->bindParam(':img', $img, PDO::PARAM_STR);
	
	$res = $bdd->prepare('CALL insertResidence(?,?,?,?,?,?,?,?)');
	$res ->bindParam(1, $nom, PDO::PARAM_STR);
	$res ->bindParam(2, $rue, PDO::PARAM_STR);
	$res ->bindParam(3, $ville, PDO::PARAM_STR);
    $res ->bindParam(4, $cp, PDO::PARAM_STR);
	$res ->bindParam(5, $classe, PDO::PARAM_STR);
    $res ->bindParam(6, $ascenseur, PDO::PARAM_INT);
	$res ->bindParam(7, $parking, PDO::PARAM_INT);
	$res ->bindParam(8, $img, PDO::PARAM_STR);

	//Transaction
	$bdd->beginTransaction();
	$reponse = $res -> execute();
	$count = $res -> rowCount();
	$id = $bdd -> lastInsertId();
	
	//Fin Transaction
	$bdd->commit();
	var_dump($reponse);
	var_dump($count);
	var_dump($id);


	//$notif = $res === false ? "ajoutko" : "ajoutok";

	if($res == false) {
		$notif = "ajoutko";
		ecrireFichierLog("Ajout Résidence ".$id. "échouée pour ".$_SESSION["login"] ,2, 0);
	} else {
		$notif = "ajoutok";
		ecrireFichierLog("Ajout Résidence ".$id." réussi pour ".$_SESSION["login"] ,2, 0);
	}

	// redirection vers la page ad_res_main (une fois que tout est débuggé)
	header("location:index.php?page=ad_res_main&notif=$notif");
