<?php 
$pagesAutorisees = ['accueil', 'coordonnees', 'residences', 'actualites'];

if (isset($_GET["page"])){
    $page=htmlentities($_GET["page"]);}
else{
    $page="accueil";}
// $page = in_array($page, $pagesAutorisees) ? $page : "accueil";
if (! in_array($page, $pagesAutorisees)) {
    $page = "accueil";
}


include("header.php");
include("$page.php");
include("footer.php");
?>