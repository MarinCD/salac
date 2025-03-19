<?php
    session_start();
    // 1er test : vérifier la récupération des infos du formulaire
	// var_dump($_POST);
    require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
    require("./fonction.php");


    $login = htmlentities($_POST["login"]);
    $mdp = htmlentities($_POST["password"]);

    //vérification base de données
    
    $sql = "SELECT login, nom, prenom
            FROM users
            WHERE login = :login
            AND mdp = :mdp;";
    echo $sql; // test de la requête dans adminer
    
    $reponse = $bdd->prepare($sql);
    $reponse ->bindParam(':login', $login, PDO::PARAM_STR);
	$reponse ->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $reponse -> execute();
    $user = $reponse->fetch(PDO::FETCH_ASSOC);  // 1 enr sous forme de tableau associatif
    // var_dump($user);  // test de récupération des données
    if($user == false) {
        // echo "erreur connexion";
        header("location:index.php?page=ad_login&notif=badlogin");
        ecrireFichierLog("Connexion échouée avec $login" ,2, 1);
    }

    else{
        // echo "connecté";
        $_SESSION["login"] = $user["login"];
        ecrireFichierLog("Connexion Réussi" ,0, 1);
        header("location:index.php");
    }