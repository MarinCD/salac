<?php
    require("./fonction.php");
    // session_start(); déjà dans ad_header
    // var_dump($_SESSION);
    // var_dump(! isset($_SESSION["login"]));
    if( ! isset($_SESSION["login"])) {  //si on n'est pas connecté
        // redirection vers ad_login
        ecrireFichierLog("Connexion Obligatoire " ,1, 1);
        header("location:index.php?page=ad_login&notif=mustconnect");
    }