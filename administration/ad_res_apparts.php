<?php
    if(isset($_GET["idResidence"])){
        $idResidence = $_GET["idResidence"];
    }
    else {
        $idResidence = 1; //on prend la première résidence (Ampère)
    }
    // echo $idResidence;

    require("./ad_connect.php"); // instancie l'objet $bdd à partir de la classe PDO
    
    // Gestion des résidences
    $sql = "SELECT nomResidence, adresseResidence, villeResidence, cpResidence, classResidence, ascResidence, parkResidence, photoResidence
            FROM residences
            WHERE idResidence = :idResidence;";
    // echo $sql."<br>"; // test de la requête dans adminer
    $reponse = $bdd->prepare($sql);
    $reponse ->bindParam(':idResidence', $idResidence, PDO::PARAM_INT);
    $reponse -> execute();
    $residence = $reponse->fetch(PDO::FETCH_ASSOC); // fetch : on récupère un seul enregistrement
    // var_dump($residence);
    
    // Gestion des types appart/studio
    $sql = "SELECT libelleAppart, imgAppart, loyerAppart
            FROM typeappart T 
            LEFT OUTER JOIN assoresidencetypeappart A ON T.idTypeAppart = A.idTypeAppart
            WHERE idResidence = :idResidence;";
    $sql = "SELECT T.idTypeAppart, libelleAppart, loyerAppart, imgAppart,
            CASE WHEN A.idResidence IS NOT NULL THEN 1 ELSE 0 END AS existenceAssociation
            FROM typeappart T
            LEFT JOIN assoresidencetypeappart A ON T.idTypeAppart = A.idTypeAppart
            AND A.idResidence = :idResidence;";

    // echo $sql."<br>"; // test de la requête dans adminer
    $reponse = $bdd->query($sql);
    $reponse ->bindParam(':idResidence', $idResidence, PDO::PARAM_INT);
    $reponse -> execute();

    $types = $reponse->fetchall(PDO::FETCH_ASSOC); // fetch : on récupère plusieurs enregistrement
    //var_dump($types);

    $icones = ["x-circle-fill text-danger","check-circle-fill text-success"];
    // si la valeur de l'indice est 0 on récupère la croix blanche sur fond rouge, si l'indice est 1 on récupère le coche blanc sur fond vert
    
?>
<main class="container pt-3 ">
    <h1 class="text-center text-dark">
    <i class="bi bi-building"></i>
        Gestion des résidences  - Appartements et studios de la résidence :
        <span class="text-secondary"><?php echo $residence["nomResidence"] ?></span>
    </h1>
    <hr>

    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="../photos/<?php echo $residence["photoResidence"] ?>" class="img-fluid rounded-start m-1" alt="ampere">
                    </div>
                    <div class="col-md-4 align-self-center">
                        <div class="card-body p-0 ps-3">
                            <h4 class="card-title">
                                Résidence <?php echo $residence["nomResidence"] ?>
                            </h4>
                            <p class="card-text">
                                <?php echo $residence["adresseResidence"] ?>
                                <br>
                                <?php echo $residence["cpResidence"] ?> 
                                <?php echo $residence["villeResidence"] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="card-body text-center">
                            <a class="btn btn-primary shadow" href="index.php?page=ad_res_main" role="button">Finir l'affectation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
<?php   foreach($types as $type){ 
            $check = ($type["existenceAssociation"] == 1) ? true : false;
            $icone = $check ? "check-square-fill" : "square";
            $opacity = $check ? "opacity-100" : "opacity-50";
?>        
            <div class="col d-flex align-items-start border p-2">
                <h5>
                    <i class="bi bi-<?php echo $icone ?> text-primary me-3"></i>
                </h5>
                <div>
                    <h5 class="fw-bold mb-0"><?php echo $type["libelleAppart"] ?></h5>
                    <!-- <p>Paragraph of text beneath the heading to explain the heading.</p> -->
                    <img    src="../photos/<?php echo $type["imgAppart"] ?>" 
                            class="card-img-top img-fluid <?php echo $opacity ?>" 
                            alt="<?php echo $type["imgAppart"] ?>">
                </div>
            </div>

<?php   }
?>
    </div>


</main>