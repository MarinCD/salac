<?php
    require("./connect.php");
    $sql = "SELECT titre, description, dateDebut, dateFin, photoActualite, importance
            FROM actualites;";

    // var_dump($sql);

    $reponse = $bdd->prepare($sql);
    $reponse ->execute();
    
    $actus = $reponse->fetchall(PDO::FETCH_ASSOC);
    // var_dump($actus);

    $badge = [
        1 => [
            "message" => "Important",
            "couleur" => "danger"
        ],

        0 => [
            "message" => "Normal",
            "couleur" => "success"
        ]
    ];
?>

<div class="container">
    <h2 class="text-primary p-2 mb-0 ">
        Actualités
    </h2>
    <div id="monCarousel" class="carousel carousel-dark slide" data-ride="carousel">
        <div class="carousel-indicators">
<?php
                for ($i = 0; $i < count($actus); $i++) {
                    if ($i == 0) {
?>
                <button type="button" data-bs-target="#monCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
<?php
                    } 
                    else {
?>
                <button type="button" data-bs-target="#monCarousel" data-bs-slide-to="<?php echo $i ?>" aria-label="Slide <?php echo $i ?>"></button>
<?php
                    }
                }
?>
        </div>
        <div class="carousel-inner">
<?php
            $i = 0;
            foreach ($actus as $actu) {
                if ($i == 0) {
                    $active = "active";
                } else {
                    $active = "";
                }
?>
                <div class="carousel-item <?php echo $active ?>">
                    <div >
                        <img src="./photos/<?php echo $actu["photoActualite"]; ?>" alt="<?php echo $actu["photoActualite"]; ?>" height="750">
                    </div>
                    <div class="carousel-caption bg-light bg-opacity-50">
                        <h4>
<?php 
                                if($actu["importance"] == 1){
?>
                                <span class="badge bg-danger ">Important</span>
<?php 
                                } 
?>
                            
                            <span class="  badge bg-primary">New</span></h4> 
                        </h4>
                        
                        <h5>
                            <?php echo $actu["titre"]; ?> 
                        </h5>


                        <p><?php echo $actu["description"]; ?></p>
                    </div>
                </div>
<?php
                $i++;
            }
?>
            <button class="carousel-control-prev" type="button" data-bs-target="#monCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#monCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        
    </div>

</div>