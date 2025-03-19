<?php
// to do demande de confirmation suppression
	session_start();
	require("ad_estconnecte_exe.php");

	// 1er test : vérifier la récupération des infos de l'url
	var_dump($_GET);
	$idResidence = htmlspecialchars($_GET["idResidence"]);

	// requête sql
	require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	$sql = "DELETE FROM residences
			WHERE idResidence = :idResidence;";
	// 2e test : affichage requête et test de la requête dans adminer
	// echo $sql;

	//exécution de la requête
	$res = $bdd->prepare($sql);
    $res ->bindParam(':idResidence', $idResidence, PDO::PARAM_INT);
	$res -> execute();
	//var_dump($res);
	//$notif = $res === 0 ||  $res === false ? "supko" : "supok";
	
	if($res == false) {
		$notif = "supko";
		ecrireFichierLog("Suppresion Résidence échouée pour".$_SESSION["login"]." sur res ".$idResidence ,2, 0);
	} else {
		$notif = "supok";
		ecrireFichierLog("Suppresion Résidence réussi pour".$_SESSION["login"]." sur res ".$idResidence ,2, 0);
	}
	
	//var_dump($notif);

	// redirection vers la page ad_res_main (une fois que tout est débuggé)
	header("location:index.php?page=ad_res_main&notif=$notif");

