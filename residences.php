<?php
    if(isset($_GET["idResidence"])){
        $idResidence = htmlentities($_GET["idResidence"]);
    }
    else {
        $idResidence = 1; //on prend la première résidence (Ampère)
    }

    require("./connect.php"); // instancie l'objet $bdd à partir de la classe PDO  
    // Gestion de la résidence
    $sql = "SELECT nomResidence, adresseResidence, villeResidence, cpResidence, classResidence, ascResidence, parkResidence, photoResidence
            FROM residences
            WHERE idResidence = :idResidence;";
    $reponse = $bdd->prepare($sql);
    $reponse ->bindParam(':idResidence', $idResidence, PDO::PARAM_INT);
    $reponse ->execute();
    $residence = $reponse->fetch(PDO::FETCH_ASSOC); // fetch : on récupère un seul enregistrement
    
    // Gestion des types appart/studio
    $sql = "SELECT libelleAppart, loyerAppart, imgAppart
            FROM typeappart T
            INNER JOIN assoresidencetypeappart A ON T.idTypeAppart = A.idTypeAppart
            WHERE idResidence = :idResidence;";
    $reponse = $bdd->prepare($sql);
    $reponse ->bindParam(':idResidence', $idResidence, PDO::PARAM_INT);
    $reponse ->execute();
    $types = $reponse->fetchall(PDO::FETCH_ASSOC); // fetch : on récupère plusieurs enregistrements
    // var_dump($types); 
    
    $icones = ["x-circle-fill text-danger","check-circle-fill text-success"];
    // si la valeur de l'indice est 0 on récupère la croix blanche sur fond rouge, si l'indice est 1 on récupère le coche blanc sur fond vert
    
?>
<main class="container pt-3 ">
    <h1 class="text-center text-dark">
        Les résidences :
        <span class="text-secondary"><?php echo htmlentities($residence["nomResidence"]) ?></span>
    </h1>
    <hr>

    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="./photos/<?php echo htmlentities($residence["photoResidence"]) ?>" class="img-fluid rounded-start m-1" alt="ampere">
                    </div>
                    <div class="col-md-4 align-self-center">
                        <div class="card-body p-0 ps-3">
                            <h4 class="card-title">
                                Résidence <?php echo htmlentities($residence["nomResidence"]) ?>
                            </h4>
                            <p class="card-text">
                                <?php echo htmlspecialchars($residence["adresseResidence"]) ?>
                                <br>
                                <?php echo htmlentities($residence["cpResidence"]) ?> 
                                <?php echo htmlentities($residence["villeResidence"]) ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="card-body ">
                            <div class="row border-start pb-4">
                                <div class="col">
                                    <h6 class="card-subtitle text-muted text-center">
                                        Classification
                                        <?php for($i=1; $i<= $residence["classResidence"]; $i++) {
                                        ?>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        <?php }
                                        ?>                                        
                                    </h6>

                                </div>
                            </div>
                            <div class="row border-start">
                                <div class="col">
                                    <h6 class="card-subtitle text-muted text-center">
                                        Ascenseur 
                                        <i class="bi bi-<?php echo $icones[$residence["ascResidence"]] ?>"></i>
                                    </h6>
                                </div>
                                <div class="col">
                                    <h6 class="card-subtitle text-muted text-center">
                                        Parking
                                        <i class="bi bi-<?php echo $icones[$residence["parkResidence"]] ?>"></i>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-group">
<?php   foreach($types as $type){
?>
            <div class="card">
                <div class="card-body pt-2">
                    <h5 class="card-title">
                        <?php echo $type["libelleAppart"] ?>
                    </h5>
                    <p class="card-text">Loyer : <?php echo htmlentities($type["loyerAppart"] )?> €</p>
                </div>
                <img src="./photos/<?php echo htmlentities($type["imgAppart"]) ?>" class="card-img-top img-fluid" alt="<?php echo $type["imgAppart"] ?>">
            </div>
<?php   }
?>

    </div>
</main>