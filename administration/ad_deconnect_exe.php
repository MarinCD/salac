<?php
    require("./fonction.php");
    session_start();
    ecrireFichierLog("Deconnexion réussi pour".$_SESSION["login"] ,2, 1);
    session_unset();
    session_destroy();
    header("location:index.php?page=ad_login&notif=disconnect");