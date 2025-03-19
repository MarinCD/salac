<?php 
$pagesAutorisees = ['ad_accueil', 'ad_actu_ajout', 'ad_actu_modif', 'ad_actu_main', 'ad_login', 'ad_res_ajout', 'ad_res_modif', 'ad_res_main', 'ad_res_apparts'];

if (isset($_GET["page"])){
    $page=$_GET["page"];}
else{
    $page="ad_accueil";
}

if (! in_array($page, $pagesAutorisees)) {
    $page = "ad_accueil";
}
include("ad_header.php");
include("$page.php");
include("ad_footer.php");
?>