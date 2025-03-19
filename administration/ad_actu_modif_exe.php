<?php
	session_start();
	require("ad_estconnecte_exe.php"); //Gestion de connexion
	
	// 1er test : vérifier la récupération des infos du formulaire
	//var_dump($_POST);

	$id = htmlentities($_POST["hidId"]);
	$titre = htmlentities($_POST["txtTitre"]);
	$description = htmlentities($_POST["txtDescription"]);
	$dateDebut = htmlentities($_POST["txtDateDeb"]);
	$dateFin = htmlentities($_POST["txtDateFin"]);
	$img = htmlentities($_POST["txtImg"]);
	$important = (isset($_POST["chkImportance"]) ? 1 : 0);

	// requête sql
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	$sql = "UPDATE actualites
			SET titre = :titre,
                description = :description,
                dateDebut = :dateDebut,
				dateFin = :dateFin,
				importance = :important,
				photoActualite = :img
			WHERE idActualite = :id ;";
	// 2e test : affichage requête et test de la requête dans adminer
	//var_dump($sql);

	//exécution de la requête
	$res = $bdd->prepare($sql);
	$res ->bindParam(':id', $id, PDO::PARAM_INT);
	$res ->bindParam(':titre', $titre, PDO::PARAM_STR);
	$res ->bindParam(':description', $description, PDO::PARAM_STR);
    $res ->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
    $res ->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
    $res ->bindParam(':img', $img, PDO::PARAM_STR);
	$res ->bindParam(':important', $important, PDO::PARAM_INT);
	$res -> execute();
	//var_dump($res);
	//$notif = $res === 0 ||  $res === false ? "modifko" : "modifok";
	if($res == false) {
		$notif = "modifko";
		ecrireFichierLog("Modif Actu échouée pour".$_SESSION["login"]." sur actu ".$id ,2, 0);
	} else {
		$notif = "modifok";
		ecrireFichierLog("Modif Actu réussi pour".$_SESSION["login"]." sur actu ".$id ,2, 0);
	}

	// redirection vers la page ad_res_main (une fois que tout est débuggé)
	header("location:index.php?page=ad_actu_main&notif=$notif");
