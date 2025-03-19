<?php
	session_start();
	require("ad_estconnecte_exe.php"); //Gestion de connexion
	
	// 1er test : vérifier la récupération des infos du formulaire
	//var_dump($_POST);

	$id = htmlentities($_POST["hidId"]);
	$nom = htmlentities($_POST["txtNom"]);
	$rue = htmlspecialchars($_POST["txtRue"]);
	$cp = htmlentities($_POST["txtCP"]);
	$ville = htmlentities($_POST["txtVille"]);
	$img = htmlentities($_POST["txtImg"]);
	$classe = htmlentities($_POST["nbrClasse"]);
	$parking = (isset($_POST["chkParking"]) ? 1 : 0);
	$ascenseur = (isset($_POST["chkAscenseur"]) ? 1 : 0);

	// requête sql
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	$sql = "UPDATE residences
			SET nomResidence = :nom,
				adresseResidence = :rue,
				villeResidence = :ville,
				cpResidence = :cp,
				classResidence = :classe,
				ascResidence = :ascenseur,
				parkResidence = :parking,
				photoResidence = :img
			WHERE idResidence = :id ;";

	$res = $bdd->prepare($sql);
	$res ->bindParam(':nom', $nom, PDO::PARAM_STR);
	$res ->bindParam(':rue', $rue, PDO::PARAM_STR);
	$res ->bindParam(':ville', $ville, PDO::PARAM_STR);
	$res ->bindParam(':cp', $cp, PDO::PARAM_STR);
	$res ->bindParam(':classe', $classe, PDO::PARAM_INT);
	$res ->bindParam(':ascenseur', $ascenseur, PDO::PARAM_INT);
	$res ->bindParam(':parking', $parking, PDO::PARAM_INT);
	$res ->bindParam(':img', $img, PDO::PARAM_STR);
	$res ->bindParam(':id', $id, PDO::PARAM_INT);
	$res -> execute();

	//$notif = $res === 0 ||  $res === false ? "modifko" : "modifok";

	if($res == false) {
		$notif = "modifko";
		ecrireFichierLog("Modification Résidence échouée pour".$_SESSION["login"]." sur res ".$id ,2, 0);
	} else {
		$notif = "modifok";
		ecrireFichierLog("Modification Résidence réussi pour".$_SESSION["login"]." sur res ".$id ,2, 0);
	}

	// redirection vers la page ad_res_main (une fois que tout est débuggé)
	header("location:index.php?page=ad_res_main&notif=$notif");
