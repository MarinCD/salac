<?php
    function ecrireFichierLog($message, $codeType = 0, $typeLog = 0) {
        $types = ["INFO", "WARNING", "ERROR", "ALERT, DEBUG" ];
        $fichiers = ["logsSalac", "connexions"];
        date_default_timezone_set("Europe/Paris");
        
        $file = "./logs/".$fichiers[$typeLog]."_".date("Ym")."log";


        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : "n/a";
        $type = $types[$codeType];
        $date = date("d/m/Y");
        $heure = date("H:i:s");
        $ip = $_SERVER["REMOTE_ADDR"];
        $page = $_SERVER["REQUEST_URI"];


        $ligne= "$date;$heure;$type[$codeType];$page;$ip;$login;$message\n";
        file_put_contents($file, $ligne, FILE_APPEND);

        //TODO dossier logs en 733 (xw) et fichier logs en 222 (w)

    } 