<?php
	session_start();
	require("ad_estconnecte_exe.php"); //Gestion de connexion

	// 1er test : vérifier la récupération des infos du formulaire
	// var_dump($_POST);

	$titre = htmlentities($_POST["txtTitre"]);
	$description = htmlentities($_POST["txtDescription"]);
	$dateDebut = htmlentities($_POST["txtDateDeb"]);
	$dateFin = htmlentities($_POST["txtDateFin"]);
	$img = htmlentities($_POST["txtImg"]);
	$important = (isset($_POST["chkImportance"]) ? 1 : 0);

	// requête sql
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	$sql = "INSERT INTO actualites
			(titre, description, dateDebut, dateFin, importance, photoActualite)
			VALUES (:titre, :description, :dateDebut,:dateFin, :important, :img);";
	//exécution de la requête
	$res = $bdd->prepare($sql);
    $res ->bindParam(':titre', $titre, PDO::PARAM_STR);
	$res ->bindParam(':description', $description, PDO::PARAM_STR);
    $res ->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
    $res ->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
    $res ->bindParam(':important', $important, PDO::PARAM_INT);
	$res ->bindParam(':img', $img, PDO::PARAM_STR);
    $res ->execute();
	//var_dump($res);

	$notif = $res === false ? "ajoutko" : "ajoutok";

	if($res == false) {
		$notif = "ajoutko";
		ecrireFichierLog("Ajout Actu".$titre."échouée pour".$_SESSION["login"] ,2, 0);
	} else {
		$notif = "ajoutok";
		ecrireFichierLog("Ajout Actu".$titre."réussi pour".$_SESSION["login"] ,2, 0);
	}

	// redirection vers la page ad_res_main (une fois que tout est débuggé)
	header("location:index.php?page=ad_actu_main&notif=$notif");
