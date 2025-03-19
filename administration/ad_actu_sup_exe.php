<?php
	session_start();
	require("ad_estconnecte_exe.php");

	// 1er test : vérifier la récupération des infos de l'url
	var_dump($_GET);
	$idActualite = htmlentities($_GET["idActualite"]);

	// requête sql
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	$sql = "DELETE FROM actualites
			WHERE idActualite = $idActualite;";
	// 2e test : affichage requête et test de la requête dans adminer
	// echo $sql;

	//exécution de la requête
	$res = $bdd->exec($sql);
	//var_dump($res);
	//$notif = $res === 0 ||  $res === false ? "supko" : "supok";

	if($res == false) {
		$notif = "supko";
		ecrireFichierLog("Suppresion Actu échouée pour".$_SESSION["login"]." sur actu ".$idActualite ,2, 0);
	} else {
		$notif = "supok";
		ecrireFichierLog("Suppresion Actu réussi pour".$_SESSION["login"]." sur actu ".$idActualite ,2, 0);
	}

	
	
	//var_dump($notif);

	// redirection vers la page ad_res_main (une fois que tout est débuggé)
	header("location:index.php?page=ad_actu_main&notif=$notif");

