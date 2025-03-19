<?php
    $serveur = "localhost";
    $nomBdd = "SALAC";
    $user = "adminSALAC";
    //$user = "adminer";

    $mdp = "Liliandu22700!";
    $bdd = new PDO("mysql:host=$serveur;dbname=$nomBdd", $user, $mdp );
    $bdd->exec("set names utf8");