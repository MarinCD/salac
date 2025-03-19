<?php
	//TODO : suppression de l'enregistrement après la durée légale
	// 1er test : vérifier la récupération des infos du formulaire
	//var_dump($_POST);
	
	//TODO : Vérifié les informations reçus
	$nom = htmlentities($_POST["Nom"]);
	$Prenom = htmlentities($_POST["Prenom"]);
	$email = htmlentities($_POST["email"]);
	$tel = htmlentities($_POST["tel"]);
	$adress = htmlentities($_POST["adress"]);
	$ville = htmlentities($_POST["ville"]);
    $Codepost = htmlentities($_POST["Codepost"]);
	$lstDoc = htmlentities($_POST["lstDoc"]);
    $question = htmlentities($_POST["question"]);
    $consent = (isset($_POST["consent"]) ? 1 : 0);



	// requête sql
	require("./connect.php"); // instancie l'objet $bdd à partir de la classe PDO
	$sql = "INSERT INTO contacts
			(Nom, Prenom, Email, Tel, Adresse, CP, Ville, idDoc, Question, consent)
			VALUES (:nom, :Prenom, :email,:tel, :adress, :Codepost, :ville, :lstDoc, :question, :consent);";
	
	$contact = $bdd->prepare($sql);
	$contact ->bindParam(':nom', $nom, PDO::PARAM_STR);
	$contact ->bindParam(':Prenom', $Prenom, PDO::PARAM_STR);
	$contact ->bindParam(':email', $email, PDO::PARAM_STR);
    $contact ->bindParam(':tel', $tel, PDO::PARAM_INT);
	$contact ->bindParam(':adress', $adress, PDO::PARAM_STR);
    $contact ->bindParam(':ville', $ville, PDO::PARAM_STR);
	$contact ->bindParam(':Codepost', $Codepost, PDO::PARAM_INT);
	$contact ->bindParam(':lstDoc', $lstDoc, PDO::PARAM_INT);
    $contact ->bindParam(':question', $question, PDO::PARAM_STR);
    $contact ->bindParam(':consent', $consent, PDO::PARAM_INT);

	$contact -> execute();


	var_dump($contact);
	$notif = $contact === false ? "ajoutko" : "ajoutok";


	// redirection vers la page ad_res_main (une fois que tout est débuggé)
	header("location:index.php?page=coordonnees&notif=$notif");
